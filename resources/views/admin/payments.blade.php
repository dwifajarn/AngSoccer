@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran - AngSoccer')

@section('main')
    <header class="mb-xl">
        <h2 class="font-headline-lg text-headline-lg text-on-background font-bold text-3xl">Konfirmasi Pembayaran</h2>
        <p class="text-on-surface-variant font-body-md mt-1">Review bukti pembayaran dari pengguna dan berikan konfirmasi pemesanan.</p>
    </header>

    @if(session('success'))
        <div class="mb-lg p-md bg-secondary-container text-on-secondary-container rounded-lg font-body-md">
            {{ session('success') }}
        </div>
    @endif

    <section class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden border border-surface-container">
        <table class="w-full border-collapse text-left">
            <thead class="bg-surface-container-low border-b border-surface-container">
                <tr>
                    <th class="p-lg font-label-md text-on-surface-variant">Booking ID</th>
                    <th class="p-lg font-label-md text-on-surface-variant">Pelanggan</th>
                    <th class="p-lg font-label-md text-on-surface-variant">Lapangan</th>
                    <th class="p-lg font-label-md text-on-surface-variant">Total Tagihan</th>
                    <th class="p-lg font-label-md text-on-surface-variant text-center">Bukti Transfer</th>
                    <th class="p-lg font-label-md text-on-surface-variant text-center">Status</th>
                    <th class="p-lg font-label-md text-on-surface-variant text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-container">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-surface-container-low transition-colors">
                        <td class="p-lg font-mono text-secondary font-bold">#{{ $booking->booking_code }}</td>
                        <td class="p-lg">
                            <div class="flex flex-col">
                                <span class="font-bold text-on-surface">{{ $booking->user->name }}</span>
                                <span class="text-caption text-on-surface-variant">{{ $booking->user->phone }}</span>
                            </div>
                        </td>
                        <td class="p-lg">
                            <div class="flex flex-col">
                                <span class="text-on-surface font-semibold">{{ $booking->lapangan->name }}</span>
                                <span class="text-caption text-on-surface-variant">{{ date('d M Y', strtotime($booking->date)) }}, {{ $booking->time }}</span>
                            </div>
                        </td>
                        <td class="p-lg font-bold text-secondary">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td class="p-lg text-center">
                            @if($booking->payment_proof)
                                <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="inline-flex items-center gap-xs px-md py-sm bg-secondary-container text-on-secondary-container rounded-lg font-label-md hover:underline">
                                    <span class="material-symbols-outlined text-[18px]">image</span>
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="text-caption text-on-surface-variant italic">Belum diupload</span>
                            @endif
                        </td>
                        <td class="p-lg text-center">
                            @if($booking->status == 'paid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container">
                                    Paid
                                </span>
                            @elseif($booking->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-tertiary-fixed-dim text-on-tertiary-fixed">
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-error-container text-on-error-container">
                                    Cancelled
                                </span>
                            @endif
                        </td>
                        <td class="p-lg text-right">
                            @if($booking->status == 'pending' && $booking->payment_proof)
                                <div class="flex justify-end gap-sm">
                                    <form action="{{ route('admin.payments.approve', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-md py-sm bg-secondary text-on-secondary text-white rounded-lg font-label-md text-caption hover:opacity-90 active:scale-95 transition-all">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.payments.reject', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-md py-sm bg-error-container text-error rounded-lg font-label-md text-caption hover:opacity-90 active:scale-95 transition-all">Tolak</button>
                                    </form>
                                </div>
                            @elseif($booking->status == 'pending' && !$booking->payment_proof)
                                <span class="text-caption text-on-surface-variant italic">Menunggu pembayaran</span>
                            @else
                                <span class="text-caption text-on-surface-variant">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-lg text-center text-on-surface-variant">
                            Tidak ada transaksi booking saat ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-lg border-t border-surface-container bg-surface-container-lowest">
            {{ $bookings->links() }}
        </div>
    </section>
@endsection