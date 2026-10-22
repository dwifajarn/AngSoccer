<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BookingSecurityAndCancellationTest extends TestCase
{
    use RefreshDatabase;

    protected User $user1;
    protected User $user2;
    protected Lapangan $lapangan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user1 = User::create([
            'name' => 'User One',
            'email' => 'user1@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->user2 = User::create([
            'name' => 'User Two',
            'email' => 'user2@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->lapangan = Lapangan::create([
            'name' => 'Lapangan Test',
            'type' => 'futsal',
            'surface' => 'vinyl',
            'location' => 'Jakarta',
            'price_per_hour' => 100000,
            'image_url' => 'https://example.com/test.jpg',
            'status' => 'active',
        ]);
    }

    public function test_user_cannot_view_or_submit_payment_for_another_users_booking(): void
    {
        $booking = Booking::create([
            'booking_code' => 'BK-USER1',
            'user_id' => $this->user1->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-07-01',
            'time' => '10:00 - 11:00',
            'duration' => 1,
            'total_price' => 100000,
            'status' => 'pending',
        ]);

        // User 2 attempts to view User 1's confirmation page -> 403 Forbidden
        $responseView = $this->actingAs($this->user2)
            ->get(route('pembayaran.konfirmasi', $booking->id));
        $responseView->assertStatus(403);

        // User 2 attempts to upload proof to User 1's booking -> 403 Forbidden
        Storage::fake('public');
        $file = UploadedFile::fake()->image('fake_proof.jpg');

        $responseSubmit = $this->actingAs($this->user2)
            ->post(route('pembayaran.submit', $booking->id), [
                'payment_proof' => $file,
            ]);
        $responseSubmit->assertStatus(403);
    }

    public function test_user_can_self_cancel_their_pending_booking(): void
    {
        $booking = Booking::create([
            'booking_code' => 'BK-CANCEL-1',
            'user_id' => $this->user1->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-07-02',
            'time' => '11:00 - 12:00',
            'duration' => 1,
            'total_price' => 100000,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user1)
            ->post(route('booking.cancel', $booking->id));

        $response->assertRedirect(route('bookings.history'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_user_cannot_cancel_another_users_booking(): void
    {
        $booking = Booking::create([
            'booking_code' => 'BK-CANCEL-2',
            'user_id' => $this->user1->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-07-03',
            'time' => '14:00 - 15:00',
            'duration' => 1,
            'total_price' => 100000,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($this->user2)
            ->post(route('booking.cancel', $booking->id));

        $response->assertStatus(403);
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'status' => 'pending',
        ]);
    }
}
