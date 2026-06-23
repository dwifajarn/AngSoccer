@extends('layouts.admin')

@section('title', 'Admin Dashboard - AngSoccer')

@section('main')
    <!-- Header -->
    <header class="flex justify-between items-end mb-xl">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background font-bold text-3xl">Dashboard</h2>
            <p class="text-on-surface-variant font-body-md mt-1">Selamat datang kembali di panel manajemen AngSoccer.</p>
        </div>
        <div class="flex gap-sm">
            <button class="bg-surface-container-highest p-sm rounded-lg hover:scale-95 transition-transform">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container font-bold overflow-hidden">
                <span class="material-symbols-outlined">person</span>
            </div>
        </div>
    </header>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter mb-xl">
        <!-- Card 1 -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] flex flex-col gap-sm border border-transparent hover:border-secondary transition-all">
            <div class="flex justify-between items-start">
                <div class="p-sm bg-secondary-container rounded-lg text-on-secondary-container">
                    <span class="material-symbols-outlined">stadium</span>
                </div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Total Lapangan</p>
            <h3 class="font-headline-md text-headline-md text-on-surface font-bold text-2xl">{{ $totalFields }}</h3>
        </div>
        <!-- Card 2 -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] flex flex-col gap-sm border border-transparent hover:border-secondary transition-all">
            <div class="flex justify-between items-start">
                <div class="p-sm bg-primary-container rounded-lg text-on-primary-container">
                    <span class="material-symbols-outlined">book_online</span>
                </div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Total Booking</p>
            <h3 class="font-headline-md text-headline-md text-on-surface font-bold text-2xl">{{ $totalBookings }}</h3>
        </div>
        <!-- Card 3 -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] flex flex-col gap-sm border border-transparent hover:border-secondary transition-all">
            <div class="flex justify-between items-start">
                <div class="p-sm bg-error-container rounded-lg text-on-error-container">
                    <span class="material-symbols-outlined">pending_actions</span>
                </div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Pending Payments</p>
            <h3 class="font-headline-md text-headline-md text-on-surface font-bold text-2xl text-error">{{ $pendingPayments }}</h3>
        </div>
        <!-- Card 4 -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] flex flex-col gap-sm border border-transparent hover:border-secondary transition-all">
            <div class="flex justify-between items-start">
                <div class="p-sm bg-secondary-fixed rounded-lg text-on-secondary-fixed">
                    <span class="material-symbols-outlined">monetization_on</span>
                </div>
            </div>
            <p class="font-label-md text-label-md text-on-surface-variant">Total Revenue</p>
            <h3 class="font-headline-md text-headline-md text-on-surface font-bold text-2xl text-secondary">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Middle Row: Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter mb-xl">
        <!-- Revenue Trend -->
        <div class="lg:col-span-2 bg-surface-container-lowest p-lg rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)]">
            <div class="flex justify-between items-center mb-xl">
                <h4 class="font-headline-md text-headline-md text-on-surface font-bold">Revenue Growth</h4>
                <select class="bg-surface-container-low border-none rounded-lg text-label-md font-label-md px-md py-xs focus:ring-secondary">
                    <option>Last 7 Days</option>
                    <option>Last 30 Days</option>
                </select>
            </div>
            <div class="chart-container flex items-end gap-sm px-md h-48">
                <!-- Fake Bar Chart Visualization -->
                <div class="flex-grow flex items-end justify-between h-40 gap-xs">
                    <div class="w-full bg-secondary-container/20 rounded-t-sm h-[40%] hover:bg-secondary transition-colors cursor-pointer group relative">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white px-2 py-1 rounded text-[10px] opacity-0 group-hover:opacity-100 transition-opacity">12M</div>
                    </div>
                    <div class="w-full bg-secondary-container/20 rounded-t-sm h-[55%] hover:bg-secondary transition-colors cursor-pointer group relative">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white px-2 py-1 rounded text-[10px] opacity-0 group-hover:opacity-100 transition-opacity">15M</div>
                    </div>
                    <div class="w-full bg-secondary-container/20 rounded-t-sm h-[45%] hover:bg-secondary transition-colors cursor-pointer group relative">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white px-2 py-1 rounded text-[10px] opacity-0 group-hover:opacity-100 transition-opacity">13M</div>
                    </div>
                    <div class="w-full bg-secondary-container rounded-t-sm h-[75%] hover:bg-secondary transition-colors cursor-pointer group relative">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white px-2 py-1 rounded text-[10px] opacity-0 group-hover:opacity-100 transition-opacity">22M</div>
                    </div>
                    <div class="w-full bg-secondary-container/20 rounded-t-sm h-[60%] hover:bg-secondary transition-colors cursor-pointer group relative">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white px-2 py-1 rounded text-[10px] opacity-0 group-hover:opacity-100 transition-opacity">18M</div>
                    </div>
                    <div class="w-full bg-secondary-container/20 rounded-t-sm h-[85%] hover:bg-secondary transition-colors cursor-pointer group relative">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white px-2 py-1 rounded text-[10px] opacity-0 group-hover:opacity-100 transition-opacity">26M</div>
                    </div>
                    <div class="w-full bg-primary-container rounded-t-sm h-[95%] hover:bg-secondary transition-colors cursor-pointer group relative">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-on-background text-white px-2 py-1 rounded text-[10px] opacity-0 group-hover:opacity-100 transition-opacity">30M</div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-md px-md text-caption text-on-surface-variant">
                <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
            </div>
        </div>
        <!-- Booking Distribution -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] flex flex-col">
            <h4 class="font-headline-md text-headline-md text-on-surface mb-xl font-bold">Field Usage</h4>
            <div class="flex-grow flex flex-col justify-center gap-md">
                <div class="flex flex-col gap-xs">
                    <div class="flex justify-between text-label-md">
                        <span>Main Pitch A (Soccer)</span>
                        <span>82%</span>
                    </div>
                    <div class="w-full h-2 bg-surface-container rounded-full overflow-hidden">
                        <div class="h-full bg-secondary w-[82%] rounded-full"></div>
                    </div>
                </div>
                <div class="flex flex-col gap-xs">
                    <div class="flex justify-between text-label-md">
                        <span>San Siro (Futsal)</span>
                        <span>64%</span>
                    </div>
                    <div class="w-full h-2 bg-surface-container rounded-full overflow-hidden">
                        <div class="h-full bg-secondary-fixed-dim w-[64%] rounded-full"></div>
                    </div>
                </div>
                <div class="flex flex-col gap-xs">
                    <div class="flex justify-between text-label-md">
                        <span>Mini Wembley</span>
                        <span>41%</span>
                    </div>
                    <div class="w-full h-2 bg-surface-container rounded-full overflow-hidden">
                        <div class="h-full bg-primary-fixed-dim w-[41%] rounded-full"></div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.revenue') }}" class="mt-xl w-full border border-outline py-sm rounded-lg font-label-md text-secondary hover:bg-secondary-container/10 transition-colors text-center inline-block">
                View Full Analytics
            </a>
        </div>
    </div>

    <!-- Bottom Row: Recent Bookings -->
    <div class="bg-surface-container-lowest rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] overflow-hidden">
        <div class="p-lg flex justify-between items-center border-b border-outline-variant">
            <h4 class="font-headline-md text-headline-md text-on-surface font-bold">Recent Bookings</h4>
        </div>
        <div class="overflow-x-auto">
            @if($recentBookings->count() > 0)
                <table class="w-full text-left">
                    <thead class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md">
                        <tr>
                            <th class="px-lg py-md">Booking ID</th>
                            <th class="px-lg py-md">Customer</th>
                            <th class="px-lg py-md">Field</th>
                            <th class="px-lg py-md">Date &amp; Time</th>
                            <th class="px-lg py-md">Status</th>
                            <th class="px-lg py-md text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @foreach($recentBookings as $booking)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-lg py-md font-mono text-body-md text-secondary">#{{ $booking->booking_code }}</td>
                                <td class="px-lg py-md">
                                    <div class="flex items-center gap-sm">
                                        <div class="w-8 h-8 rounded-full bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center text-[10px] font-bold">
                                            {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                                        </div>
                                        <span class="font-label-md">{{ $booking->user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-lg py-md font-body-md">{{ $booking->lapangan->name }}</td>
                                <td class="px-lg py-md text-body-md">{{ date('d M Y', strtotime($booking->date)) }}, {{ $booking->time }}</td>
                                <td class="px-lg py-md">
                                    @if($booking->status == 'paid')
                                        <span class="bg-secondary-container/50 text-on-secondary-container px-2 py-1 rounded-full text-caption font-bold">Confirmed</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="bg-error-container/50 text-error px-2 py-1 rounded-full text-caption font-bold">Pending</span>
                                    @else
                                        <span class="bg-surface-variant text-on-surface-variant px-2 py-1 rounded-full text-caption font-bold">Cancelled</span>
                                    @endif
                                </td>
                                <td class="px-lg py-md text-right">
                                    @if($booking->status == 'pending')
                                        <a href="{{ route('admin.payments.index') }}" class="text-secondary hover:underline text-sm font-bold">Review</a>
                                    @else
                                        <button class="text-on-surface-variant hover:text-secondary transition-colors"><span class="material-symbols-outlined">more_vert</span></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-xl">
                    <p class="text-on-surface-variant">Belum ada pemesanan terbaru.</p>
                </div>
            @endif
        </div>
    </div>
@endsection