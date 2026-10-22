<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DuitkuService
{
    protected string $merchantCode;
    protected string $apiKey;
    protected string $env;
    protected int $expiryPeriod;

    public function __construct()
    {
        $this->merchantCode = (string) config('duitku.merchant_code', '');
        $this->apiKey = (string) config('duitku.api_key', '');
        $this->env = (string) config('duitku.env', 'sandbox');
        $this->expiryPeriod = (int) config('duitku.expiry_period', 60);
    }

    public function isConfigured(): bool
    {
        return !empty($this->merchantCode) && !empty($this->apiKey);
    }

    public function getInquiryUrl(): string
    {
        return $this->env === 'production'
            ? config('duitku.production_url')
            : config('duitku.sandbox_url');
    }

    /**
     * Create an invoice on Duitku
     *
     * @return array{success: bool, payment_url?: string, reference?: string, message?: string}
     */
    public function createInvoice(Booking $booking, string $paymentMethod = 'SP'): array
    {
        if (!$this->isConfigured()) {
            return [
                'success' => false,
                'message' => 'Duitku merchant code atau API key belum dikonfigurasi pada environment.',
            ];
        }

        $merchantOrderId = $booking->booking_code;
        $paymentAmount = (int) $booking->total_price;
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        $payload = [
            'merchantCode' => $this->merchantCode,
            'paymentAmount' => $paymentAmount,
            'paymentMethod' => $paymentMethod,
            'merchantOrderId' => $merchantOrderId,
            'productDetails' => 'Sewa ' . ($booking->lapangan->name ?? 'Lapangan') . ' (' . $booking->time . ')',
            'email' => $booking->user->email ?? 'customer@angsoccer.com',
            'phoneNumber' => $booking->user->phone ?? '081234567890',
            'additionalParam' => '',
            'merchantUserInfo' => '',
            'customerVaName' => $booking->user->name ?? 'Pelanggan AngSoccer',
            'callbackUrl' => route('duitku.callback'),
            'returnUrl' => route('duitku.return'),
            'signature' => $signature,
            'expiryPeriod' => $this->expiryPeriod,
        ];

        try {
            $response = Http::timeout(15)->asJson()->post($this->getInquiryUrl(), $payload);

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['paymentUrl'])) {
                    return [
                        'success' => true,
                        'payment_url' => $data['paymentUrl'],
                        'reference' => $data['reference'] ?? null,
                    ];
                }

                $msg = $data['statusMessage'] ?? ($data['message'] ?? 'Respons tidak terduga dari Duitku');
                Log::warning('Duitku createInvoice non-paymentUrl response', ['response' => $data]);
                return [
                    'success' => false,
                    'message' => $msg,
                ];
            }

            Log::error('Duitku API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [
                'success' => false,
                'message' => 'Gagal menghubungi server Duitku (' . $response->status() . ').',
            ];
        } catch (\Throwable $e) {
            Log::error('Duitku createInvoice exception', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Terjadi kendala koneksi ke server Duitku: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Validate callback signature from Duitku webhook
     */
    public function validateCallback(array $params): bool
    {
        $merchantCode = (string) ($params['merchantCode'] ?? '');
        $amount = (string) ($params['amount'] ?? '');
        $merchantOrderId = (string) ($params['merchantOrderId'] ?? '');
        $signature = (string) ($params['signature'] ?? '');

        if (empty($merchantCode) || empty($amount) || empty($merchantOrderId) || empty($signature)) {
            return false;
        }

        if ($merchantCode !== $this->merchantCode) {
            return false;
        }

        // Duitku callback signature formula: md5(merchantCode + amount + merchantOrderId + apiKey)
        $expectedSignature = md5($merchantCode . $amount . $merchantOrderId . $this->apiKey);

        return hash_equals($expectedSignature, $signature);
    }
}
