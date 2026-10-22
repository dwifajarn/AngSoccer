@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran - AngSoccer')

@section('main')
    <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Konfirmasi Pembayaran</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Verifikasi bukti transfer pembayaran dari pengguna dan konfirmasi pesanan lapangan.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 rounded-xl bg-white/5 border border-white/10 text-xs font-semibold text-gray-300">
                Total: {{ $bookings->count() }} Transaksi
            </span>
        </div>
    </header>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-sm shadow-sm">
            <span class="material-symbols-outlined text-emerald-400 text-[22px]">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <section class="bg-[#131914] border border-white/10 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-black/30 text-gray-400 font-bold uppercase tracking-wider border-b border-white/10">
                        <th class="py-4 px-6">Booking ID</th>
                        <th class="py-4 px-6">Pelanggan</th>
                        <th class="py-4 px-6">Lapangan &amp; Waktu</th>
                        <th class="py-4 px-6">Total Tagihan</th>
                        <th class="py-4 px-6 text-center">Bukti Transfer</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-right">Aksi Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="py-4 px-6 font-mono text-emerald-400 font-bold text-sm">
                                #{{ $booking->booking_code }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-bold text-white text-sm">{{ $booking->user->name }}</span>
                                    <span class="text-[11px] text-gray-400 mt-0.5">{{ $booking->user->phone ?? $booking->user->email }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="text-white font-semibold">{{ $booking->lapangan->name }}</span>
                                    <span class="text-[11px] text-gray-400 mt-0.5">{{ date('d M Y', strtotime($booking->date)) }} • <span class="text-emerald-400">{{ $booking->time }}</span></span>
                                </div>
                            </td>
                            <td class="py-4 px-6 font-bold text-emerald-400 text-sm">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($booking->payment_proof)
                                    <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-lg text-xs font-bold hover:bg-emerald-500/20 transition-all">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        <span>Lihat Bukti</span>
                                    </a>
                                @else
                                    <span class="text-[11px] text-gray-500 italic">Belum diunggah</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                @if($booking->status == 'paid')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
                                        Paid (Lunas)
                                    </span>
                                @elseif($booking->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-amber-500/10 border border-amber-500/30 text-amber-400">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-500/10 border border-red-500/30 text-red-400">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                @if($booking->status == 'pending')
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.payments.approve', $booking->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa pembayaran ini telah valid?')">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold rounded-lg text-xs shadow-md transition-all active:scale-95 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[16px]">check</span>
                                                <span>Setujui</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.payments.reject', $booking->id) }}" method="POST" onsubmit="return confirm('Tolak pembayaran ini dan batalkan booking?')">
                                            @csrf
                                            <button type="submit" class="px-3 py-1.5 bg-white/5 hover:bg-red-500/20 text-gray-300 hover:text-red-400 border border-white/10 rounded-lg text-xs font-bold transition-all active:scale-95 flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[16px]">close</span>
                                                <span>Tolak</span>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-[11px] text-gray-500 font-medium">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center text-gray-500">
                                Tidak ada transaksi pembayaran yang perlu dikonfirmasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
