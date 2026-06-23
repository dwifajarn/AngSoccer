@extends('layouts.admin')

@section('title', 'Revenue Reports - AngSoccer')

@section('main')
    <!-- Header & Filter Section -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-xl gap-lg">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-primary font-bold text-3xl">Revenue Reports</h2>
            <p class="text-on-surface-variant font-body-md mt-1">Laporan analisis pendapatan operasional sewa lapangan.</p>
        </div>
    </header>

    <!-- Top Section: Summary Widgets -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-lg mb-2xl">
        <!-- Daily -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/20 hover-lift">
            <div class="flex justify-between items-center mb-md">
                <span class="text-caption font-label-md uppercase tracking-wider text-outline text-xs">Daily Revenue</span>
                <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">today</span>
            </div>
            <div class="text-headline-md font-headline-md text-on-surface font-bold text-2xl">Rp {{ number_format($dailyRevenue, 0, ',', '.') }}</div>
            <div class="flex items-center gap-xs mt-sm text-xs">
                <span class="text-on-secondary-container font-label-md font-semibold">Hari ini</span>
            </div>
        </div>
        <!-- Weekly -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/20 hover-lift">
            <div class="flex justify-between items-center mb-md">
                <span class="text-caption font-label-md uppercase tracking-wider text-outline text-xs">Weekly Revenue</span>
                <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">date_range</span>
            </div>
            <div class="text-headline-md font-headline-md text-on-surface font-bold text-2xl">Rp {{ number_format($weeklyRevenue, 0, ',', '.') }}</div>
            <div class="flex items-center gap-xs mt-sm text-xs">
                <span class="text-on-secondary-container font-label-md font-semibold">Minggu ini</span>
            </div>
        </div>
        <!-- Monthly -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/20 hover-lift">
            <div class="flex justify-between items-center mb-md">
                <span class="text-caption font-label-md uppercase tracking-wider text-outline text-xs">Monthly Revenue</span>
                <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">calendar_month</span>
            </div>
            <div class="text-headline-md font-headline-md text-on-surface font-bold text-2xl">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</div>
            <div class="flex items-center gap-xs mt-sm text-xs">
                <span class="text-on-secondary-container font-label-md font-semibold">Bulan ini</span>
            </div>
        </div>
        <!-- Annual -->
        <div class="bg-surface-container-lowest p-lg rounded-xl shadow-sm border border-outline-variant/20 hover-lift">
            <div class="flex justify-between items-center mb-md">
                <span class="text-caption font-label-md uppercase tracking-wider text-outline text-xs">Annual Revenue</span>
                <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">account_balance</span>
            </div>
            <div class="text-headline-md font-headline-md text-on-surface font-bold text-2xl">Rp {{ number_format($annualRevenue, 0, ',', '.') }}</div>
            <div class="flex items-center gap-xs mt-sm text-xs">
                <span class="text-on-secondary-container font-label-md font-semibold">Tahun ini</span>
            </div>
        </div>
    </section>

    <!-- Bottom Section: Detailed Transactions -->
    <section class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/20 overflow-hidden">
        <div class="px-lg py-lg border-b border-outline-variant/20 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-md bg-surface-container-low">
            <h3 class="font-headline-md text-headline-md text-primary font-bold text-lg">Transaction History</h3>
        </div>
        <div class="overflow-x-auto">
            @if($transactions->count() > 0)
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md">
                            <th class="px-lg py-md font-semibold">Transaction ID</th>
                            <th class="px-lg py-md font-semibold">Venue Name</th>
                            <th class="px-lg py-md font-semibold">Customer</th>
                            <th class="px-lg py-md font-semibold">Date &amp; Time</th>
                            <th class="px-lg py-md font-semibold text-right">Amount</th>
                            <th class="px-lg py-md font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-surface-container-lowest transition-all group">
                                <td class="px-lg py-md font-label-md text-outline font-mono text-sm">#{{ $transaction->booking_code }}</td>
                                <td class="px-lg py-md">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-on-surface">{{ $transaction->lapangan->name }}</span>
                                        <span class="text-caption text-outline text-xs">{{ $transaction->lapangan->surface }}</span>
                                    </div>
                                </td>
                                <td class="px-lg py-md text-on-surface">{{ $transaction->user->name }}</td>
                                <td class="px-lg py-md text-outline text-sm">{{ date('d M Y', strtotime($transaction->date)) }}, {{ $transaction->time }}</td>
                                <td class="px-lg py-md text-right font-bold text-secondary">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                <td class="px-lg py-md text-center">
                                    @if($transaction->status == 'paid')
                                        <span class="px-sm py-xs bg-secondary-container text-on-secondary-container rounded-full text-caption font-bold text-xs">Success</span>
                                    @elseif($transaction->status == 'pending')
                                        <span class="px-sm py-xs bg-tertiary-fixed-dim text-on-tertiary-fixed rounded-full text-caption font-bold text-xs">Pending</span>
                                    @else
                                        <span class="px-sm py-xs bg-error-container text-on-error-container rounded-full text-caption font-bold text-xs">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-xl">
                    <p class="text-on-surface-variant">Belum ada transaksi.</p>
                </div>
            @endif
        </div>
        <!-- Pagination -->
        <div class="px-lg py-md bg-surface-container-low border-t border-outline-variant/20 flex justify-between items-center">
            {{ $transactions->links() }}
        </div>
    </section>
@endsection