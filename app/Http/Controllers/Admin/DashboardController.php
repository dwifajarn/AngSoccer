<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalFields = Lapangan::count();
        $totalBookings = Booking::count();
        $pendingPayments = Booking::where('status', 'pending')->count();
        $totalRevenue = Booking::where('status', 'paid')->sum('total_price');

        $recentBookings = Booking::with(['user', 'lapangan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalFields',
            'totalBookings',
            'pendingPayments',
            'totalRevenue',
            'recentBookings'
        ));
    }

    public function revenue(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $status = $request->query('status');

        $dailyRevenue = Booking::where('status', 'paid')
            ->whereDate('date', today())
            ->sum('total_price');
        $weeklyRevenue = Booking::where('status', 'paid')
            ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('total_price');
        $monthlyRevenue = Booking::where('status', 'paid')
            ->whereMonth('date', now()->month)
            ->sum('total_price');
        $annualRevenue = Booking::where('status', 'paid')
            ->whereYear('date', now()->year)
            ->sum('total_price');

        $query = Booking::with(['user', 'lapangan'])->orderBy('date', 'desc');

        if ($startDate) {
            $query->whereDate('date', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('date', '<=', $endDate);
        }
        if ($status && in_array($status, ['paid', 'pending', 'cancelled'])) {
            $query->where('status', $status);
        }

        $filteredRevenue = (clone $query)->where('status', 'paid')->sum('total_price');
        $transactions = $query->paginate(10)->withQueryString();

        return view('admin.revenue', compact(
            'dailyRevenue',
            'weeklyRevenue',
            'monthlyRevenue',
            'annualRevenue',
            'filteredRevenue',
            'transactions',
            'startDate',
            'endDate',
            'status'
        ));
    }

    public function exportRevenueCsv(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $status = $request->query('status');

        $query = Booking::with(['user', 'lapangan'])->orderBy('date', 'desc');

        if ($startDate) {
            $query->whereDate('date', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('date', '<=', $endDate);
        }
        if ($status && in_array($status, ['paid', 'pending', 'cancelled'])) {
            $query->where('status', $status);
        }

        $filename = 'revenue_report_' . date('Ymd_His') . '.csv';

        // ponytail: stream response via php://output stdlib fputcsv, add when asynchronous background queued export is needed for >50k rows
        return response()->streamDownload(function () use ($query) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Booking Code', 'Venue Name', 'Customer Name', 'Customer Email', 'Date', 'Time Slot', 'Duration (Hours)', 'Amount (IDR)', 'Status', 'Created At']);

            $query->chunk(200, function ($bookings) use ($handle) {
                foreach ($bookings as $b) {
                    fputcsv($handle, [
                        $b->booking_code,
                        $b->lapangan->name ?? '-',
                        $b->user->name ?? '-',
                        $b->user->email ?? '-',
                        $b->date,
                        $b->time,
                        $b->duration,
                        $b->total_price,
                        $b->status,
                        $b->created_at ? $b->created_at->format('Y-m-d H:i:s') : '-',
                    ]);
                }
            });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    public function schedule(Request $request)
    {
        $date = $request->query('date', today()->toDateString());
        $lapangans = Lapangan::where('status', 'active')->get();

        $bookings = Booking::with('user')
            ->whereDate('date', $date)
            ->activeReservation()
            ->get();

        $slots = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'];

        return view('admin.schedule', compact('date', 'lapangans', 'bookings', 'slots'));
    }
}
