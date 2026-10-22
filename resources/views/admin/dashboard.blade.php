@extends('layouts.admin')

@section('title', 'Admin Dashboard - AngSoccer')

@section('main')
    <!-- Header -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Dashboard Operasional</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Pantau performa lapangan, status pesanan, dan arus pendapatan AngSoccer.</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                Sistem Live
            </span>
        </div>
    </header>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        <!-- Card 1: Total Lapangan -->
        <div class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl hover:border-emerald-500/30 transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">stadium</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-gray-500 tracking-wider">Unit Aktif</span>
            </div>
            <div>
                <span class="text-xs text-gray-400 font-medium">Total Lapangan</span>
                <h3 class="text-2xl font-black text-white font-headline mt-0.5">{{ $totalFields }}</h3>
            </div>
        </div>

        <!-- Card 2: Total Booking -->
        <div class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl hover:border-emerald-500/30 transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">sports_soccer</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-gray-500 tracking-wider">Akumulasi</span>
            </div>
            <div>
                <span class="text-xs text-gray-400 font-medium">Total Booking</span>
                <h3 class="text-2xl font-black text-white font-headline mt-0.5">{{ $totalBookings }}</h3>
            </div>
        </div>

        <!-- Card 3: Pending Payments -->
        <div class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl hover:border-amber-500/30 transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">pending_actions</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-amber-400/80 bg-amber-500/10 px-2 py-0.5 rounded-full tracking-wider">Perlu Tindakan</span>
            </div>
            <div>
                <span class="text-xs text-gray-400 font-medium">Menunggu Verifikasi</span>
                <h3 class="text-2xl font-black text-amber-400 font-headline mt-0.5">{{ $pendingPayments }}</h3>
            </div>
        </div>

        <!-- Card 4: Total Revenue -->
        <div class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl hover:border-emerald-500/30 transition-all flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center">
                    <span class="material-symbols-outlined text-[22px]">monetization_on</span>
                </div>
                <span class="text-[10px] uppercase font-bold text-emerald-400/80 bg-emerald-500/10 px-2 py-0.5 rounded-full tracking-wider">Omset Lunas</span>
            </div>
            <div>
                <span class="text-xs text-gray-400 font-medium">Total Revenue</span>
                <h3 class="text-xl sm:text-2xl font-black text-emerald-400 font-headline mt-0.5">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Middle Row: Analytics & Quick Schedule -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Revenue Bar Chart Preview -->
        <div class="lg:col-span-2 bg-[#131914] border border-white/10 p-6 rounded-2xl shadow-xl">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-base font-bold text-white font-headline">Aktivitas & Estimasi Pertumbuhan</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Ringkasan okupansi mingguan seluruh arena AngSoccer.</p>
                </div>
                <a href="{{ route('admin.revenue') }}" class="text-xs font-bold text-emerald-400 hover:underline flex items-center gap-1">
                    Detail Laporan <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>

            <div class="h-44 flex items-end gap-3 pt-6 px-2">
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full bg-white/5 rounded-t-lg h-20 group-hover:bg-emerald-500/40 transition-all relative">
                        <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">40%</span>
                    </div>
                    <span class="text-[11px] text-gray-500 font-semibold">Sen</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full bg-white/5 rounded-t-lg h-28 group-hover:bg-emerald-500/40 transition-all relative">
                        <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">60%</span>
                    </div>
                    <span class="text-[11px] text-gray-500 font-semibold">Sel</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full bg-white/5 rounded-t-lg h-24 group-hover:bg-emerald-500/40 transition-all relative">
                        <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">50%</span>
                    </div>
                    <span class="text-[11px] text-gray-500 font-semibold">Rab</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full bg-white/5 rounded-t-lg h-32 group-hover:bg-emerald-500/40 transition-all relative">
                        <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">70%</span>
                    </div>
                    <span class="text-[11px] text-gray-500 font-semibold">Kam</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full bg-white/10 rounded-t-lg h-36 group-hover:bg-emerald-500/40 transition-all relative">
                        <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-gray-300 opacity-0 group-hover:opacity-100 transition-opacity">80%</span>
                    </div>
                    <span class="text-[11px] text-gray-400 font-semibold">Jum</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full bg-emerald-500/30 rounded-t-lg h-40 group-hover:bg-emerald-400 transition-all relative">
                        <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity">95%</span>
                    </div>
                    <span class="text-[11px] text-emerald-400 font-bold">Sab</span>
                </div>
                <div class="flex-1 flex flex-col items-center gap-2 group">
                    <div class="w-full bg-emerald-500/30 rounded-t-lg h-40 group-hover:bg-emerald-400 transition-all relative">
                        <span class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity">90%</span>
                    </div>
                    <span class="text-[11px] text-emerald-400 font-bold">Min</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Operasional -->
        <div class="bg-[#131914] border border-white/10 p-6 rounded-2xl shadow-xl flex flex-col justify-between">
            <div>
                <h3 class="text-base font-bold text-white font-headline">Aksi Cepat Admin</h3>
                <p class="text-xs text-gray-400 mt-0.5">Navigasi langsung ke modul manajemen harian.</p>

                <div class="space-y-3 mt-5">
                    <a href="{{ route('admin.lapangan.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-white/[0.03] border border-white/5 hover:border-emerald-500/30 hover:bg-white/[0.06] transition-all">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-emerald-400 text-[20px]">add_circle</span>
                            <span class="text-xs font-bold text-white">Kelola & Tambah Lapangan</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-500 text-[16px]">chevron_right</span>
                    </a>

                    <a href="{{ route('admin.payments.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-white/[0.03] border border-white/5 hover:border-emerald-500/30 hover:bg-white/[0.06] transition-all">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-400 text-[20px]">receipt_long</span>
                            <span class="text-xs font-bold text-white">Verifikasi Bukti Transfer</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-500 text-[16px]">chevron_right</span>
                    </a>

                    <a href="{{ route('admin.schedule') }}" class="flex items-center justify-between p-3 rounded-xl bg-white/[0.03] border border-white/5 hover:border-emerald-500/30 hover:bg-white/[0.06] transition-all">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-blue-400 text-[20px]">calendar_view_week</span>
                            <span class="text-xs font-bold text-white">Cek Matriks Okupansi</span>
                        </div>
                        <span class="material-symbols-outlined text-gray-500 text-[16px]">chevron_right</span>
                    </a>
                </div>
            </div>

            <div class="pt-5 border-t border-white/10 mt-5">
                <span class="text-[11px] text-gray-400">Pusat kendali otomatisasi jadwal & verifikasi keuangan.</span>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Recent Bookings Table -->
    <div class="bg-[#131914] border border-white/10 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 border-b border-white/10">
            <div>
                <h3 class="text-base font-bold text-white font-headline">Pesanan Terbaru</h3>
                <p class="text-xs text-gray-400 mt-0.5">Daftar transaksi booking yang baru masuk ke sistem.</p>
            </div>
            <a href="{{ route('admin.payments.index') }}" class="text-xs font-bold text-emerald-400 hover:underline">
                Kelola Semua Pesanan →
            </a>
        </div>

        <div class="overflow-x-auto">
            @if($recentBookings->count() > 0)
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-black/30 text-gray-400 font-bold uppercase tracking-wider border-b border-white/10">
                            <th class="py-3.5 px-6">Kode Booking</th>
                            <th class="py-3.5 px-6">Pemesan</th>
                            <th class="py-3.5 px-6">Lapangan</th>
                            <th class="py-3.5 px-6">Jadwal Main</th>
                            <th class="py-3.5 px-6">Status</th>
                            <th class="py-3.5 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($recentBookings as $booking)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="py-4 px-6 font-mono font-bold text-emerald-400">
                                    #{{ $booking->booking_code }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-emerald-500/20 text-emerald-400 font-bold flex items-center justify-center text-[10px]">
                                            {{ strtoupper(substr($booking->user->name, 0, 2)) }}
                                        </div>
                                        <span class="font-semibold text-white">{{ $booking->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-300">
                                    {{ $booking->lapangan->name }}
                                </td>
                                <td class="py-4 px-6 text-gray-400">
                                    {{ date('d M Y', strtotime($booking->date)) }} • <span class="text-white">{{ $booking->time }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    @if($booking->status === 'paid')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
                                            Paid
                                        </span>
                                    @elseif($booking->status === 'pending')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-500/10 border border-amber-500/30 text-amber-400">
                                            Pending
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-500/10 border border-red-500/30 text-red-400">
                                            Cancelled
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('admin.payments.index') }}" class="px-3 py-1.5 rounded-lg bg-white/5 hover:bg-emerald-500/20 text-gray-300 hover:text-emerald-400 font-bold transition-all inline-block">
                                        Periksa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-8 text-center text-gray-500 text-xs">
                    Belum ada transaksi pemesanan terbaru.
                </div>
            @endif
        </div>
    </div>
@endsection
