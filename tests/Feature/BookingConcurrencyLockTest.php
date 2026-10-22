<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class BookingConcurrencyLockTest extends TestCase
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
            'email' => 'concur1@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->user2 = User::create([
            'name' => 'User Two',
            'email' => 'concur2@angsoccer.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $this->lapangan = Lapangan::create([
            'name' => 'Lapangan Locking',
            'type' => 'futsal',
            'surface' => 'interlock',
            'location' => 'Jakarta Timur',
            'price_per_hour' => 150000,
            'image_url' => 'https://example.com/field.jpg',
            'status' => 'active',
        ]);
    }

    public function test_transaction_prevents_overlap_booking_on_same_slot(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-09-01 08:00:00'));

        // Booking pertama sukses
        $res1 = $this->actingAs($this->user1)->post(route('booking.store'), [
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-09-02',
            'time' => '14:00',
            'duration' => 2, // 14:00 - 16:00
        ]);
        $res1->assertRedirect();
        $this->assertDatabaseHas('bookings', [
            'lapangan_id' => $this->lapangan->id,
            'time' => '14:00 - 16:00',
            'status' => 'pending',
            'user_id' => $this->user1->id,
        ]);

        // Booking kedua yang bertabrakan (15:00 - 17:00) ditolak oleh validasi transaksi
        $res2 = $this->actingAs($this->user2)->from('/booking-lapangan/' . $this->lapangan->id)->post(route('booking.store'), [
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-09-02',
            'time' => '15:00',
            'duration' => 2,
        ]);

        $res2->assertRedirect('/booking-lapangan/' . $this->lapangan->id);
        $res2->assertSessionHasErrors('time');

        // Total booking tetap hanya 1
        $this->assertEquals(1, Booking::where('lapangan_id', $this->lapangan->id)->count());
    }
}
