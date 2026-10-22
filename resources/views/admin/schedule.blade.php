@extends('layouts.admin')

@section('title', 'Jadwal Lapangan - AngSoccer')

@section('main')
    <!-- Header & Date Switcher -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-xl gap-lg">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-primary font-bold text-3xl">Jadwal Operasional Lapangan</h2>
            <p class="text-on-surface-variant font-body-md mt-1">Matriks jadwal dan okupansi lapangan per jam.</p>
        </div>
        <form method="GET" action="{{ route('admin.schedule') }}" class="flex items-center gap-sm bg-surface-container-lowest p-xs px-sm rounded-xl border border-outline-variant/30 shadow-sm">
            <span class="material-symbols-outlined text-secondary">calendar_today</span>
            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" class="bg-transparent border-none text-sm font-semibold text-on-surface focus:outline-none cursor-pointer">
            <button type="submit" class="px-sm py-1 bg-secondary text-white rounded-lg text-xs font-semibold hover:bg-secondary/90 transition-all">Pilih</button>
        </form>
    </header>

    <!-- Visual Legend -->
    <div class="flex flex-wrap items-center gap-md mb-lg bg-surface-container-lowest p-md rounded-xl border border-outline-variant/20">
        <span class="text-xs font-bold text-outline uppercase tracking-wider">Keterangan:</span>
        <div class="flex items-center gap-xs text-xs font-semibold">
            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
            <span>Tersedia (Kosong)</span>
        </div>
        <div class="flex items-center gap-xs text-xs font-semibold">
            <span class="w-3 h-3 rounded-full bg-secondary"></span>
            <span>Paid (Lunas)</span>
        </div>
        <div class="flex items-center gap-xs text-xs font-semibold">
            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
            <span>Pending (Menunggu Bayar/Verifikasi)</span>
        </div>
    </div>

    <!-- Timetable Grid -->
    <div class="bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/20 overflow-hidden">
        <div class="overflow-x-auto">
            @if($lapangans->count() > 0)
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant font-label-md text-sm border-b border-outline-variant/20">
                            <th class="px-lg py-md font-bold uppercase tracking-wider w-36 border-r border-outline-variant/20">Waktu</th>
                            @foreach($lapangans as $lapangan)
                                <th class="px-md py-md font-bold text-center border-r border-outline-variant/20 last:border-r-0 min-w-[200px]">
                                    <div class="flex flex-col items-center">
                                        <span class="text-on-surface font-headline-md font-bold">{{ $lapangan->name }}</span>
                                        <span class="text-caption text-outline text-xs mt-0.5">{{ $lapangan->surface }} • Rp {{ number_format($lapangan->price_per_hour, 0, ',', '.') }}/jam</span>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20 text-sm">
                        @foreach($slots as $slot)
                            @php
                                $slotHour = intval(explode(':', $slot)[0]);
                                $endHour = $slotHour + 1;
                                $rangeLabel = sprintf('%02d:00 - %02d:00', $slotHour, $endHour);
                            @endphp
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="px-lg py-sm font-mono font-bold text-on-surface border-r border-outline-variant/20 bg-surface-container-low/60">
                                    {{ $rangeLabel }}
                                </td>
                                @foreach($lapangans as $lapangan)
                                    @php
                                        $booked = $bookings->first(function ($b) use ($lapangan, $slotHour) {
                                            if ($b->lapangan_id !== $lapangan->id) return false;
                                            $parts = explode(' - ', $b->time);
                                            if (count($parts) !== 2) return false;
                                            $start = intval(explode(':', $parts[0])[0]);
                                            $end = intval(explode(':', $parts[1])[0]);
                                            return $slotHour >= $start && $slotHour < $end;
                                        });
                                    @endphp
                                    <td class="p-xs border-r border-outline-variant/20 last:border-r-0 text-center align-middle">
                                        @if($booked)
                                            <div class="p-sm rounded-lg text-left shadow-xs transition-all {{ $booked->status === 'paid' ? 'bg-secondary-container text-on-secondary-container border border-secondary/30' : 'bg-tertiary-fixed-dim text-on-tertiary-fixed border border-amber-300' }}">
                                                <div class="flex items-center justify-between gap-xs">
                                                    <span class="font-bold text-xs truncate max-w-[130px]">{{ $booked->user->name ?? 'Customer' }}</span>
                                                    <span class="text-[10px] font-bold px-1.5 py-0.2 rounded-full uppercase {{ $booked->status === 'paid' ? 'bg-secondary text-white' : 'bg-amber-600 text-white' }}">
                                                        {{ $booked->status }}
                                                    </span>
                                                </div>
                                                <div class="text-[11px] font-mono opacity-80 mt-1">
                                                    #{{ $booked->booking_code }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="py-sm px-md rounded-lg bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200/60 inline-flex items-center justify-center gap-xs">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                <span>Kosong</span>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-2xl text-center text-on-surface-variant">
                    <p>Belum ada data lapangan aktif.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
