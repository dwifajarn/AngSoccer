@extends('layouts.admin')

@section('title', 'Laporan Pendapatan - AngSoccer')

@section('main')
    <!-- Header & Filter Section -->
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Laporan Revenue</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Analisis arus kas masuk dan rekapitulasi transaksi sewa lapangan.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.revenue.export', request()->query()) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black rounded-xl text-xs font-extrabold shadow-lg shadow-emerald-500/20 active:scale-95 transition-all">
                <span class="material-symbols-outlined text-[18px]">download</span>
                <span>Export CSV</span>
            </a>
        </div>
    </header>

    <!-- Filter Bar Card -->
    <section class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl mb-8">
        <form method="GET" action="{{ route('admin.revenue') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
            <div class="space-y-1.5">
                <label for="start_date" class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Dari Tanggal</label>
                <input type="date" name="start_date" id="start_date" value="{{ $startDate }}" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 cursor-pointer">
            </div>
            <div class="space-y-1.5">
                <label for="end_date" class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Sampai Tanggal</label>
                <input type="date" name="end_date" id="end_date" value="{{ $endDate }}" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 cursor-pointer">
            </div>
            <div class="space-y-1.5">
                <label for="status" class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Status Pembayaran</label>
                <select name="status" id="status" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="paid" {{ $status === 'paid' ? 'selected' : '' }}>Paid (Lunas)</option>
                    <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="flex items-center gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 bg-emerald-500 hover:bg-emerald-400 text-black rounded-xl text-xs font-extrabold transition-all flex items-center justify-center gap-1.5 active:scale-95 shadow-md">
                    <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                    <span>Terapkan</span>
                </button>
                @if($startDate || $endDate || $status)
                    <a href="{{ route('admin.revenue') }}" class="py-2.5 px-3 bg-white/5 hover:bg-white/10 text-gray-300 rounded-xl text-xs font-semibold border border-white/10 transition-all text-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </section>

    <!-- Top Section: Summary Widgets -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        <!-- Daily -->
        <div class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl flex flex-col justify-between">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Hari Ini</span>
                <span class="material-symbols-outlined text-emerald-400 text-[20px]">today</span>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl font-black text-white font-headline">Rp {{ number_format($dailyRevenue, 0, ',', '.') }}</h3>
                <span class="text-[11px] text-emerald-400 mt-1 block font-medium">Daily Revenue</span>
            </div>
        </div>

        <!-- Weekly -->
        <div class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl flex flex-col justify-between">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">7 Hari Terakhir</span>
                <span class="material-symbols-outlined text-blue-400 text-[20px]">date_range</span>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl font-black text-white font-headline">Rp {{ number_format($weeklyRevenue, 0, ',', '.') }}</h3>
                <span class="text-[11px] text-blue-400 mt-1 block font-medium">Weekly Revenue</span>
            </div>
        </div>

        <!-- Monthly -->
        <div class="bg-[#131914] border border-white/10 p-5 rounded-2xl shadow-xl flex flex-col justify-between">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Bulan Berjalan</span>
                <span class="material-symbols-outlined text-purple-400 text-[20px]">calendar_month</span>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl font-black text-white font-headline">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</h3>
                <span class="text-[11px] text-purple-400 mt-1 block font-medium">Monthly Revenue</span>
            </div>
        </div>

        <!-- Filtered / Grand Total -->
        <div class="bg-[#131914] border border-emerald-500/30 p-5 rounded-2xl shadow-xl flex flex-col justify-between">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-400">Total Omzet Filter</span>
                <span class="material-symbols-outlined text-emerald-400 text-[20px]">account_balance_wallet</span>
            </div>
            <div>
                <h3 class="text-xl sm:text-2xl font-black text-emerald-400 font-headline">Rp {{ number_format($filteredRevenue, 0, ',', '.') }}</h3>
                <span class="text-[11px] text-gray-400 mt-1 block font-medium">Total Omzet Filter</span>
            </div>
        </div>
    </section>

    <!-- Transactions Detailed Table -->
    <section class="bg-[#131914] border border-white/10 rounded-2xl shadow-xl overflow-hidden">
        <div class="p-6 border-b border-white/10 flex justify-between items-center">
            <div>
                <h3 class="text-base font-bold text-white font-headline">Rincian Transaksi Pendapatan</h3>
                <p class="text-xs text-gray-400 mt-0.5">Daftar transaksi sewa yang terfilter pada rentang tanggal.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            @if($transactions->count() > 0)
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-black/30 text-gray-400 font-bold uppercase tracking-wider border-b border-white/10">
                            <th class="py-4 px-6">ID &amp; Tanggal</th>
                            <th class="py-4 px-6">Pelanggan</th>
                            <th class="py-4 px-6">Lapangan</th>
                            <th class="py-4 px-6">Waktu Main</th>
                            <th class="py-4 px-6">Nominal</th>
                            <th class="py-4 px-6 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($transactions as $b)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <span class="font-mono font-bold text-emerald-400">#{{ $b->booking_code }}</span>
                                        <span class="text-[10px] text-gray-400 mt-0.5">{{ $b->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-white font-semibold">
                                    {{ $b->user->name }}
                                </td>
                                <td class="py-4 px-6 text-gray-300">
                                    {{ $b->lapangan->name }}
                                </td>
                                <td class="py-4 px-6 text-gray-400">
                                    {{ date('d M Y', strtotime($b->date)) }} • <span class="text-white">{{ $b->time }}</span>
                                </td>
                                <td class="py-4 px-6 font-bold text-emerald-400 text-sm">
                                    Rp {{ number_format($b->total_price, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    @if($b->status === 'paid')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
                                            Paid
                                        </span>
                                    @elseif($b->status === 'pending')
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-500/10 border border-amber-500/30 text-amber-400">
                                            Pending
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-500/10 border border-red-500/30 text-red-400">
                                            Cancelled
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-12 text-center text-gray-500">
                    Tidak ada data transaksi yang sesuai dengan filter pencarian.
                </div>
            @endif
        </div>

        <div class="p-4 border-t border-white/10 bg-black/20">
            {{ $transactions->appends(request()->query())->links() }}
        </div>
    </section>
@endsection
