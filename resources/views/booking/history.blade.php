@extends('layouts.user')

@section('title', 'Booking Saya - AngSoccer')

@section('main')
    <!-- Header Section -->
    <div class="mb-xl">
        <h1 class="font-headline-lg text-headline-lg text-on-surface mb-sm font-bold">Booking Saya</h1>
        <p class="font-body-md text-body-md text-on-surface-variant">Kelola riwayat pemesanan lapangan futsal dan sepak bola Anda dalam satu tempat.</p>
    </div>

    @if(session('success'))
        <div class="mb-lg p-md bg-secondary-container text-on-secondary-container rounded-lg font-body-md">
            {{ session('success') }}
        </div>
    @endif

    <!-- Management View Container -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant overflow-hidden mx-auto">
        <!-- Filters & Search -->
        <div class="p-lg flex flex-col md:flex-row gap-md justify-between items-center border-b border-outline-variant bg-surface-container-low">
            <div class="relative w-full md:w-96">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                <input id="searchInput" class="w-full pl-10 pr-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-secondary/20 focus:border-secondary font-body-md text-body-md" placeholder="Cari Booking ID atau Lapangan..." type="text">
            </div>
            <div class="flex items-center gap-sm w-full md:w-auto">
                <span class="font-label-md text-label-md text-on-surface-variant hidden sm:block">Status:</span>
                <select id="statusFilter" class="flex-1 md:flex-none px-4 py-2 bg-surface-container-lowest border border-outline-variant rounded-lg focus:outline-none focus:border-secondary font-label-md text-label-md">
                    <option value="all">Semua Status</option>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            @if($bookings->count() > 0)
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-left">
                            <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Booking ID</th>
                            <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Lapangan</th>
                            <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Tanggal</th>
                            <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Jadwal</th>
                            <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Total</th>
                            <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-center">Status</th>
                            <th class="px-lg py-md font-label-md text-label-md text-on-surface-variant uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bookingsTableBody" class="divide-y divide-outline-variant">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-surface-container-low transition-colors group" data-status="{{ $booking->status }}">
                                <td class="px-lg py-md font-label-md text-label-md text-secondary font-bold">#{{ $booking->booking_code }}</td>
                                <td class="px-lg py-md font-body-md text-body-md">{{ $booking->lapangan->name }}</td>
                                <td class="px-lg py-md font-body-md text-body-md">{{ date('d M Y', strtotime($booking->date)) }}</td>
                                <td class="px-lg py-md font-body-md text-body-md">{{ $booking->time }}</td>
                                <td class="px-lg py-md font-label-md text-label-md font-semibold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                <td class="px-lg py-md text-center">
                                    @if($booking->status == 'paid')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-secondary-container text-on-secondary-container">
                                            <span class="w-1.5 h-1.5 rounded-full bg-on-secondary-container mr-1.5"></span>
                                            Paid
                                        </span>
                                    @elseif($booking->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-tertiary-fixed-dim text-on-tertiary-fixed">
                                            <span class="w-1.5 h-1.5 rounded-full bg-on-tertiary-fixed-variant mr-1.5 animate-pulse"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-error-container text-on-error-container">
                                            <span class="w-1.5 h-1.5 rounded-full bg-error mr-1.5"></span>
                                            Cancelled
                                        </span>
                                    @endif
                                </td>
                                <td class="px-lg py-md text-right">
                                    @if($booking->status == 'pending')
                                        <a href="{{ route('pembayaran.konfirmasi', $booking->id) }}" class="inline-block px-4 py-1.5 rounded-lg bg-secondary font-label-md text-label-md text-on-secondary hover:opacity-90 transition-all text-center">Bayar</a>
                                    @else
                                        <button class="px-4 py-1.5 rounded-lg bg-surface-container-highest font-label-md text-label-md text-on-surface hover:bg-secondary-container hover:text-on-secondary-container transition-all">Detail</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-2xl">
                    <span class="material-symbols-outlined text-[64px] text-on-surface-variant opacity-50 mb-md">history</span>
                    <h3 class="text-headline-md text-on-surface mb-xs">Belum Ada Pemesanan</h3>
                    <p class="text-body-md text-on-surface-variant mb-lg">Anda belum memesan lapangan futsal atau sepak bola apapun.</p>
                    <a href="{{ route('fields.index') }}" class="bg-secondary text-on-secondary px-lg py-sm rounded-lg font-bold font-label-md text-label-md">Cari Lapangan Sekarang</a>
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
