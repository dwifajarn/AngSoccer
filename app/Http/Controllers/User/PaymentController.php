<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function showKonfirmasi($bookingId)
    {
        $booking = Booking::with('lapangan')->findOrFail($bookingId);
        abort_if($booking->user_id !== Auth::id(), 403);
        abort_if($booking->status !== 'pending', 400, 'Pemesanan ini sudah tidak dalam status pending.');

        return view('pembayaran.konfirmasi', compact('booking'));
    }

    public function submitPayment(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        abort_if($booking->user_id !== Auth::id(), 403);
        abort_if($booking->status !== 'pending', 400, 'Pemesanan ini sudah tidak dalam status pending.');

        $request->validate([
            'payment_proof' => 'required|image|max:5120', // Max 5MB
        ]);

        if ($request->hasFile('payment_proof')) {
            if ($booking->payment_proof) {
                Storage::disk('public')->delete($booking->payment_proof);
            }

            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $booking->update([
                'payment_proof' => $path,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('bookings.history')
            ->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu konfirmasi admin.');
    }
}