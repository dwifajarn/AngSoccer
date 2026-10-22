<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminScheduleMatrixTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;
    protected Lapangan $lapangan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Scheduler',
            'email' => 'admin.sched@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->user = User::create([
            'name' => 'Customer Budi',
            'email' => 'budi.sched@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->lapangan = Lapangan::create([
            'name' => 'Stadion Mini Utama',
            'type' => 'futsal',
            'surface' => 'vinyl',
            'location' => 'Jakarta Selatan',
            'price_per_hour' => 175000,
            'image_url' => 'https://example.com/stadium.jpg',
            'status' => 'active',
        ]);
    }

    public function test_guest_or_regular_user_cannot_access_schedule_matrix(): void
    {
        $this->get(route('admin.schedule'))->assertRedirect(route('login'));

        $this->actingAs($this->user)
            ->get(route('admin.schedule'))
            ->assertStatus(403);
    }

    public function test_admin_can_view_daily_court_schedule_matrix(): void
    {
        Booking::create([
            'booking_code' => 'BK-SCHED-99',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-10-15',
            'time' => '09:00 - 11:00',
            'duration' => 2,
            'total_price' => 350000,
            'status' => 'paid',
        ]);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.schedule', ['date' => '2026-10-15']));

        $response->assertStatus(200);
        $response->assertSee('Stadion Mini Utama');
        $response->assertSee('Customer Budi');
        $response->assertSee('BK-SCHED-99');
        $response->assertSee('09:00 - 10:00');
        $response->assertSee('10:00 - 11:00');
    }
}
