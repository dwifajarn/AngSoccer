<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class DuitkuPaymentTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Lapangan $lapangan;
    protected string $merchantCode = 'DS12345';
    protected string $apiKey = 'secret_api_key_123';

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('duitku.merchant_code', $this->merchantCode);
        Config::set('duitku.api_key', $this->apiKey);
        Config::set('duitku.env', 'sandbox');

        $this->user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567890',
        ]);

        $this->lapangan = Lapangan::create([
            'name' => 'Lapangan Sintetis A',
            'type' => 'Soccer',
            'surface' => 'Sintetis',
            'location' => 'Jakarta',
            'price_per_hour' => 150000,
            'status' => 'active',
        ]);
    }

    private function createPendingBooking(): Booking
    {
        return Booking::create([
            'booking_code' => 'BK-DUITKU1',
            'user_id' => $this->user->id,
            'lapangan_id' => $this->lapangan->id,
            'date' => '2026-08-01',
            'time' => '10:00 - 11:00',
            'duration' => 1,
            'total_price' => 150000,
            'status' => 'pending',
        ]);
    }

    public function test_user_can_initiate_duitku_checkout_and_redirects_to_payment_url(): void
    {
        $booking = $this->createPendingBooking();

        Http::fake([
            config('duitku.sandbox_url') => Http::response([
                'merchantCode' => $this->merchantCode,
                'reference' => 'DREF-998877',
                'paymentUrl' => 'https://sandbox.duitku.com/checkout/pay?ref=DREF-998877',
                'statusCode' => '00',
                'statusMessage' => 'SUCCESS',
            ], 200),
        ]);

        $response = $this->actingAs($this->user)
            ->post(route('duitku.checkout', $booking->id));

        $response->assertRedirect('https://sandbox.duitku.com/checkout/pay?ref=DREF-998877');

        $booking->refresh();
        $this->assertEquals('duitku', $booking->payment_method);
        $this->assertEquals('https://sandbox.duitku.com/checkout/pay?ref=DREF-998877', $booking->payment_url);
        $this->assertEquals('DREF-998877', $booking->duitku_reference);
    }

    public function test_duitku_callback_with_valid_signature_marks_booking_as_paid(): void
    {
        $booking = $this->createPendingBooking();
        $amount = (string) $booking->total_price;
        $orderId = $booking->booking_code;

        // md5(merchantCode + amount + merchantOrderId + apiKey)
        $signature = md5($this->merchantCode . $amount . $orderId . $this->apiKey);

        $payload = [
            'merchantCode' => $this->merchantCode,
            'amount' => $amount,
            'merchantOrderId' => $orderId,
            'productDetail' => 'Sewa Lapangan',
            'additionalParam' => '',
            'paymentCode' => 'VA',
            'resultCode' => '00',
            'merchantUserId' => '',
            'reference' => 'DREF-112233',
            'signature' => $signature,
        ];

        $response = $this->postJson(route('duitku.callback'), $payload);

        $response->assertStatus(200);
        $response->assertJson(['status' => 'success']);

        $booking->refresh();
        $this->assertEquals('paid', $booking->status);
        $this->assertEquals('duitku', $booking->payment_method);
        $this->assertEquals('DREF-112233', $booking->duitku_reference);
    }

    public function test_duitku_callback_with_invalid_signature_is_rejected(): void
    {
        $booking = $this->createPendingBooking();

        $payload = [
            'merchantCode' => $this->merchantCode,
            'amount' => '150000',
            'merchantOrderId' => $booking->booking_code,
            'resultCode' => '00',
            'signature' => 'invalid_signature_hash',
        ];

        $response = $this->postJson(route('duitku.callback'), $payload);

        $response->assertStatus(400);
        $response->assertJson(['status' => 'error', 'message' => 'Invalid signature']);

        $booking->refresh();
        $this->assertEquals('pending', $booking->status);
    }

    public function test_duitku_return_redirects_to_history_with_success_message(): void
    {
        $booking = $this->createPendingBooking();

        $response = $this->actingAs($this->user)
            ->get(route('duitku.return', [
                'merchantOrderId' => $booking->booking_code,
                'resultCode' => '00',
                'reference' => 'DREF-554433',
            ]));

        $response->assertRedirect(route('bookings.history'));
        $response->assertSessionHas('success');
    }
}
