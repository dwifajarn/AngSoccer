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

    public function revenue()
    {
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

        $transactions = Booking::with(['user', 'lapangan'])
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('admin.revenue', compact(
            'dailyRevenue',
            'weeklyRevenue',
            'monthlyRevenue',
            'annualRevenue',
            'transactions'
        ));
    }
}
