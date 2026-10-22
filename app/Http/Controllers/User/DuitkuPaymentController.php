<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\DuitkuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DuitkuPaymentController extends Controller
{
    public function __construct(protected DuitkuService $duitkuService)
    {
    }

    /**
     * Initiate Duitku checkout invoice and redirect to payment page
     */
    public function checkout($bookingId)
    {
        $booking = Booking::with('lapangan')->findOrFail($bookingId);
        abort_if($booking->user_id !== Auth::id(), 403);
        abort_if($booking->status !== 'pending', 400, 'Pemesanan ini sudah tidak dalam status pending.');

        if (!empty($booking->payment_url)) {
            return redirect()->away($booking->payment_url);
        }

        $result = $this->duitkuService->createInvoice($booking);

        if (!$result['success']) {
            return back()->with('error', $result['message'] ?? 'Gagal membuat tagihan Duitku.');
        }

        $booking->update([
            'payment_method' => 'duitku',
            'payment_url' => $result['payment_url'],
            'duitku_reference' => $result['reference'] ?? null,
        ]);

        return redirect()->away($result['payment_url']);
    }

    /**
     * Webhook callback called asynchronously by Duitku server
     */
    public function callback(Request $request)
    {
        Log::info('Duitku callback received', $request->all());

        if (!$this->duitkuService->validateCallback($request->all())) {
            Log::warning('Duitku callback signature mismatch', $request->all());
            return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
        }

        $merchantOrderId = $request->input('merchantOrderId');
        $resultCode = $request->input('resultCode');

        $booking = Booking::where('booking_code', $merchantOrderId)->first();

        if (!$booking) {
            Log::warning('Duitku callback booking not found: ' . $merchantOrderId);
            return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
        }

        if ($resultCode === '00') {
            $booking->update([
                'status' => 'paid',
                'payment_method' => 'duitku',
                'duitku_reference' => $request->input('reference', $booking->duitku_reference),
            ]);
            Log::info("Booking #{$booking->booking_code} marked as paid via Duitku");
        } else {
            Log::info("Booking #{$booking->booking_code} payment status: {$resultCode}");
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Return page when user is redirected back from Duitku checkout
     */
    public function returnPage(Request $request)
    {
        $merchantOrderId = $request->query('merchantOrderId');
        $resultCode = $request->query('resultCode');

        $booking = $merchantOrderId ? Booking::where('booking_code', $merchantOrderId)->first() : null;

        if ($resultCode === '00' || ($booking && $booking->status === 'paid')) {
            return redirect()->route('bookings.history')
                ->with('success', 'Pembayaran berhasil dikonfirmasi! Jadwal pemesanan lapangan Anda telah aktif.');
        }

        if ($resultCode === '01') {
            return redirect()->route('bookings.history')
                ->with('info', 'Pembayaran Anda sedang diproses. Mohon tunggu beberapa saat hingga verifikasi selesai.');
        }

        return redirect()->route('bookings.history')
            ->with('error', 'Pembayaran belum berhasil diselesaikan atau telah dibatalkan.');
    }
}
