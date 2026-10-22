@extends('layouts.user')

@section('title', 'Booking Saya - AngSoccer')

@section('main')
    <!-- Header Section -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Booking Saya</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Pantau dan kelola seluruh riwayat pemesanan lapangan Anda.</p>
        </div>
        <a href="{{ route('fields.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black rounded-xl text-xs font-extrabold shadow-md shadow-emerald-500/20 active:scale-95 transition-all">
            <span class="material-symbols-outlined text-[18px]">add_circle</span>
            <span>Sewa Lapangan Baru</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-sm shadow-sm">
            <span class="material-symbols-outlined text-emerald-400 text-[22px]">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Management View Container -->
    <div class="bg-[#131914] border border-white/10 rounded-2xl shadow-xl overflow-hidden">
        <!-- Filters & Search -->
        <div class="p-5 flex flex-col md:flex-row gap-4 justify-between items-center border-b border-white/10 bg-black/30">
            <div class="relative w-full md:w-96">
                <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 text-[20px]">search</span>
                <input id="searchInput" class="w-full pl-10 pr-4 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 font-body transition-all" placeholder="Cari Booking ID (#BK-...) atau nama lapangan..." type="text">
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider hidden sm:block">Status:</span>
                <select id="statusFilter" class="flex-1 md:flex-none px-4 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs font-semibold text-white focus:outline-none focus:border-emerald-500 cursor-pointer">
                    <option value="all">Semua Status</option>
                    <option value="paid">Paid (Lunas)</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            @if($bookings->count() > 0)
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-black/20 text-gray-400 font-bold uppercase tracking-wider border-b border-white/10">
                            <th class="py-4 px-6">Booking ID</th>
                            <th class="py-4 px-6">Lapangan</th>
                            <th class="py-4 px-6">Tanggal Main</th>
                            <th class="py-4 px-6">Waktu / Jadwal</th>
                            <th class="py-4 px-6">Total Biaya</th>
                            <th class="py-4 px-6 text-center">Status</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bookingsTableBody" class="divide-y divide-white/5">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-white/[0.02] transition-colors group" data-status="{{ $booking->status }}">
                                <td class="py-4 px-6 font-mono text-emerald-400 font-bold text-sm">
                                    #{{ $booking->booking_code }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-white text-sm">{{ $booking->lapangan->name }}</span>
                                        <span class="text-[11px] text-gray-400 mt-0.5">{{ $booking->lapangan->surface }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-300">
                                    {{ date('d M Y', strtotime($booking->date)) }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-lg border border-emerald-500/20">
                                        {{ $booking->time }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 font-bold text-white text-sm">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if($booking->status == 'paid')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-500/10 border border-emerald-500/30 text-emerald-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                            Paid
                                        </span>
                                    @elseif($booking->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-amber-500/10 border border-amber-500/30 text-amber-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-red-500/10 border border-red-500/30 text-red-400">
                                            Cancelled
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right">
                                    @if($booking->status == 'pending')
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('pembayaran.konfirmasi', $booking->id) }}" class="px-3.5 py-1.5 rounded-lg bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold text-xs shadow-md transition-all active:scale-95">
                                                Bayar
                                            </a>
                                            @if(!$booking->payment_proof)
                                                <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini? Slot akan langsung dilepas.')">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1.5 rounded-lg border border-red-500/30 text-red-400 hover:bg-red-500/20 text-xs font-bold transition-all">
                                                        Batal
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @elseif($booking->status == 'paid')
                                        <span class="text-xs text-emerald-400 font-semibold flex items-center justify-end gap-1">
                                            <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                            <span>Disetujui</span>
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-500">Dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-16 p-8">
                    <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-500 mx-auto mb-4">
                        <span class="material-symbols-outlined text-[36px]">history</span>
                    </div>
                    <h3 class="text-lg font-bold text-white font-headline mb-1">Belum Ada Pemesanan</h3>
                    <p class="text-xs text-gray-400 mb-5">Anda belum memesan lapangan futsal atau sepak bola apapun.</p>
                    <a href="{{ route('fields.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black rounded-xl text-xs font-extrabold shadow-lg shadow-emerald-500/20 active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-[18px]">sports_soccer</span>
                        <span>Cari Lapangan Sekarang</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Search Filter
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', filterBookings);
    }

    // Status Filter
    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', filterBookings);
    }

    function filterBookings() {
        const query = searchInput.value.toLowerCase();
        const selectedStatus = statusFilter.value;
        const rows = document.querySelectorAll('#bookingsTableBody tr');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowStatus = row.getAttribute('data-status');

            const matchesSearch = text.includes(query);
            const matchesStatus = (selectedStatus === 'all' || rowStatus === selectedStatus);

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush
