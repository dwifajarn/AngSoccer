<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Tests\TestCase;

class BookingTimeSlotGridTest extends TestCase
{
    use \Illuminate\Foundation\Testing\RefreshDatabase;

    private function createLapangan(): Lapangan
    {
        return Lapangan::create([
            'name' => 'Mini Soccer Sintetis Test',
            'type' => 'Soccer',
            'surface' => 'Sintetis',
            'location' => 'Jakarta Selatan',
            'price_per_hour' => 350000,
            'status' => 'active',
            'facilities' => 'Rumput Sintetis, Ruang Ganti, Toilet',
        ]);
    }

    public function test_booking_page_renders_visual_legend_and_time_slots()
    {
        $user = User::factory()->create();
        $lapangan = $this->createLapangan();

        $response = $this->actingAs($user)->get("/booking-lapangan/{$lapangan->id}");

        $response->assertStatus(200);
        $response->assertSee('Tersedia');
        $response->assertSee('Terisi');
        $response->assertSee('Lewat');
        $response->assertSee('Terpilih');
        $response->assertSee('Pilih Waktu Mulai');
        $response->assertSee('07:00');
        $response->assertSee('08:00');
        $response->assertSee('22:00');
        $response->assertSee('Mini Soccer Sintetis Test');
    }

    public function test_booking_endpoint_returns_json_bookings()
    {
        $user = User::factory()->create();
        $lapangan = $this->createLapangan();

        Booking::create([
            'booking_code' => 'BK-TEST-1',
            'user_id' => $user->id,
            'lapangan_id' => $lapangan->id,
            'date' => now()->toDateString(),
            'time' => '15:00 - 17:00',
            'duration' => 2,
            'total_price' => $lapangan->price_per_hour * 2,
            'status' => 'paid',
        ]);

        $response = $this->actingAs($user)->getJson("/booking-lapangan/{$lapangan->id}/bookings?date=" . now()->toDateString());

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'date' => now()->toDateString(),
            'time' => '15:00 - 17:00',
            'duration' => 2,
        ]);
    }

    public function test_guest_cannot_access_booking_page()
    {
        $lapangan = $this->createLapangan();

        $response = $this->get("/booking-lapangan/{$lapangan->id}");

        $response->assertRedirect('/login');
    }

    public function test_user_cannot_book_overlapping_slot()
    {
        $user = User::factory()->create();
        $lapangan = $this->createLapangan();

        Booking::create([
            'booking_code' => 'BK-EXISTING',
            'user_id' => $user->id,
            'lapangan_id' => $lapangan->id,
            'date' => now()->addDay()->toDateString(),
            'time' => '10:00 - 12:00',
            'duration' => 2,
            'total_price' => $lapangan->price_per_hour * 2,
            'status' => 'paid',
        ]);

        $response = $this->actingAs($user)->post('/bookings', [
            'lapangan_id' => $lapangan->id,
            'date' => now()->addDay()->toDateString(),
            'time' => '11:00',
            'duration' => 2, // 11:00 - 13:00, overlaps with 10:00 - 12:00
        ]);

        $response->assertSessionHasErrors(['time']);
    }

    public function test_user_can_book_available_slot()
    {
        $user = User::factory()->create();
        $lapangan = $this->createLapangan();

        $response = $this->actingAs($user)->post('/bookings', [
            'lapangan_id' => $lapangan->id,
            'date' => now()->addDay()->toDateString(),
            'time' => '08:00',
            'duration' => 2,
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'lapangan_id' => $lapangan->id,
            'duration' => 2,
            'time' => '08:00 - 10:00',
        ]);
    }
}
