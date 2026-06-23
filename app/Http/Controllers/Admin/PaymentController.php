<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'lapangan'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.payments', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'paid']);

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran berhasil disetujui!');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);

        return redirect()->route('admin.payments.index')->with('success', 'Pemesanan berhasil dibatalkan!');
    }
}