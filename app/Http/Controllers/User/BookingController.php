<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function history()
    {
        $bookings = Booking::with('lapangan')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('booking.history', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $requestedDate = $request->date;
        $requestedStartHour = intval($request->time);
        $requestedDuration = intval($request->duration);
        $requestedEndHour = $requestedStartHour + $requestedDuration;

        // Check if date is today and requested time is in the past
        if ($requestedDate === today()->toDateString() && $requestedStartHour <= now()->hour) {
            return back()->withErrors(['time' => 'Waktu pemesanan sudah lewat.'])->withInput();
        }

        // Check for overlapping bookings
        $overlapping = Booking::where('lapangan_id', $request->lapangan_id)
            ->whereDate('date', $requestedDate)
            ->whereIn('status', ['paid', 'pending'])
            ->get()
            ->filter(function($b) use ($requestedStartHour, $requestedEndHour) {
                $parts = explode(' - ', $b->time);
                if (count($parts) === 2) {
                    $start = intval(explode(':', $parts[0])[0]);
                    $end = intval(explode(':', $parts[1])[0]);
                    return max($requestedStartHour, $start) < min($requestedEndHour, $end);
                }
                return false;
            });

        if ($overlapping->isNotEmpty()) {
            return back()->withErrors(['time' => 'Waktu yang Anda pilih bentrok dengan pesanan lain.'])->withInput();
        }

        $lapangan = Lapangan::findOrFail($request->lapangan_id);
        $totalPrice = $lapangan->price_per_hour * $request->duration;
        $bookingCode = 'BK-' . rand(1000, 9999);

        // Ensure unique code
        while (Booking::where('booking_code', $bookingCode)->exists()) {
            $bookingCode = 'BK-' . rand(1000, 9999);
        }

        $booking = Booking::create([
            'booking_code' => $bookingCode,
            'user_id' => Auth::id(),
            'lapangan_id' => $lapangan->id,
            'date' => $request->date,
            'time' => $request->time . ' - ' . ($requestedEndHour < 10 ? '0' . $requestedEndHour : $requestedEndHour) . ':00',
            'duration' => $request->duration,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->route('pembayaran.konfirmasi', $booking->id)
            ->with('success', 'Booking berhasil dibuat! Selesaikan pembayaran Anda.');
    }
}