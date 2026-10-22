<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class BookingAutoExpiryTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Lapangan $lapangan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'Test Player',
            'email' => 'player@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->lapangan = Lapangan::create([
            'name' => 'Lapangan Expiry Test',
            'type' => 'futsal',
            'surface' => 'vinyl',
            'location' => 'Bandung',
            'price_per_hour' => 120000,
            'image_url' => 'https://example.com/field.jpg',
            'status' => 'active',
        ]);
    }

    public function test_expired_pending_booking_is_not_treated_as_active_block(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-08-01 10:00:00'));

        // Booking dibuat 35 menit lalu tanpa bukti bayar
        $expiredBooking = Booking::create([
            'booking_code' => 'BK-OLD',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-08-01',
            'time' => '15:00 - 16:00',
            'duration' => 1,
            'total_price' => 120000,
            'status' => 'pending',
            'payment_proof' => null,
        ]);
        $expiredBooking->created_at = Carbon::now()->subMinutes(35);
        $expiredBooking->save();

        // Slot harusnya tidak muncul di getBookings (karena sudah expired > 30 menit)
        $response = $this->actingAs($this->user)
            ->getJson(route('booking.slots', ['id' => $this->lapangan->id, 'date' => '2026-08-01']));

        $response->assertStatus(200);
        $response->assertJsonMissing(['time' => '15:00 - 16:00']);

        // User baru boleh memesan slot jam 15:00 yang tadinya diblokir booking kadaluarsa ini
        $storeResponse = $this->actingAs($this->user)
            ->post(route('booking.store'), [
                'lapangan_id' => $this->lapangan->id,
                'date' => '2026-08-01',
                'time' => '15:00',
                'duration' => 1,
            ]);

        $storeResponse->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-08-01',
            'time' => '15:00 - 16:00',
            'status' => 'pending',
            'user_id' => $this->user->id,
        ]);
    }

    public function test_cleanup_expired_artisan_command_marks_old_pending_as_cancelled(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-08-01 12:00:00'));

        $oldPending = Booking::create([
            'booking_code' => 'BK-CLEAN-1',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-08-01',
            'time' => '17:00 - 18:00',
            'duration' => 1,
            'total_price' => 120000,
            'status' => 'pending',
            'payment_proof' => null,
        ]);
        $oldPending->created_at = Carbon::now()->subMinutes(40);
        $oldPending->save();

        $recentPending = Booking::create([
            'booking_code' => 'BK-CLEAN-2',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-08-01',
            'time' => '18:00 - 19:00',
            'duration' => 1,
            'total_price' => 120000,
            'status' => 'pending',
            'payment_proof' => null,
        ]);
        $recentPending->created_at = Carbon::now()->subMinutes(10);
        $recentPending->save();

        $this->artisan('bookings:cleanup-expired')->assertSuccessful();

        $this->assertDatabaseHas('bookings', [
            'id' => $oldPending->id,
            'status' => 'cancelled',
        ]);

        $this->assertDatabaseHas('bookings', [
            'id' => $recentPending->id,
            'status' => 'pending',
        ]);
    }
}
