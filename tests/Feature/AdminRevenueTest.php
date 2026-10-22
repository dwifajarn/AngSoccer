<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRevenueTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;
    protected Lapangan $lapangan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin.test@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->user = User::create([
            'name' => 'Regular User',
            'email' => 'user.test@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->lapangan = Lapangan::create([
            'name' => 'Test Field',
            'type' => 'futsal',
            'surface' => 'vinyl',
            'location' => 'Jakarta',
            'price_per_hour' => 150000,
            'image_url' => 'https://example.com/field.jpg',
            'status' => 'active',
        ]);
    }

    public function test_revenue_page_requires_admin(): void
    {
        $this->actingAs($this->user)
            ->get(route('admin.revenue'))
            ->assertStatus(403);
    }

    public function test_admin_can_filter_revenue_and_view_filtered_sum(): void
    {
        Booking::create([
            'booking_code' => 'BK-1111',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-05-10',
            'time' => '10:00 - 11:00',
            'duration' => 1,
            'total_price' => 150000,
            'status' => 'paid',
        ]);

        Booking::create([
            'booking_code' => 'BK-2222',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-06-10',
            'time' => '10:00 - 11:00',
            'duration' => 1,
            'total_price' => 150000,
            'status' => 'paid',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.revenue', [
                'start_date' => '2026-05-01',
                'end_date' => '2026-05-31',
            ]));

        $response->assertStatus(200);
        $response->assertSee('BK-1111');
        $response->assertDontSee('BK-2222');
        $response->assertSee('Total Omzet Filter');
    }

    public function test_admin_can_export_revenue_csv(): void
    {
        Booking::create([
            'booking_code' => 'BK-CSV99',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-05-15',
            'time' => '14:00 - 15:00',
            'duration' => 1,
            'total_price' => 150000,
            'status' => 'paid',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.revenue.export', [
                'start_date' => '2026-05-01',
                'end_date' => '2026-05-31',
            ]));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('BK-CSV99', $response->streamedContent());
    }
}
