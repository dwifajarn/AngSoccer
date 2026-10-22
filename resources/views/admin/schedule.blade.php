@extends('layouts.admin')

@section('title', 'Jadwal Operasional Lapangan - AngSoccer')

@section('main')
    <!-- Header & Date Switcher -->
    <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Jadwal Operasional Lapangan</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Matriks jadwal dan okupansi slot lapangan per jam secara real-time.</p>
        </div>
        <form method="GET" action="{{ route('admin.schedule') }}" class="flex items-center gap-2 bg-[#131914] p-1.5 px-3 rounded-xl border border-white/10 shadow-lg">
            <span class="material-symbols-outlined text-emerald-400 text-[18px]">calendar_today</span>
            <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" class="bg-transparent border-none text-xs font-bold text-white focus:outline-none cursor-pointer">
            <button type="submit" class="px-3 py-1 bg-gradient-to-r from-emerald-500 to-emerald-600 text-black rounded-lg text-xs font-extrabold hover:from-emerald-400 hover:to-emerald-500 transition-all">Pilih</button>
        </form>
    </header>

    <!-- Visual Legend -->
    <div class="flex flex-wrap items-center gap-4 mb-6 bg-[#131914] border border-white/10 p-4 rounded-2xl shadow-xl">
        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Status Slot:</span>
        <div class="flex items-center gap-1.5 text-xs font-semibold text-gray-300">
            <span class="w-3 h-3 rounded-full bg-emerald-500/20 border border-emerald-500/50"></span>
            <span>Tersedia (Kosong)</span>
        </div>
        <div class="flex items-center gap-1.5 text-xs font-semibold text-gray-300">
            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
            <span>Paid (Lunas)</span>
        </div>
        <div class="flex items-center gap-1.5 text-xs font-semibold text-gray-300">
            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
            <span>Pending (Menunggu Bayar/Verifikasi)</span>
        </div>
    </div>

    <!-- Timetable Grid -->
    <div class="bg-[#131914] border border-white/10 rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            @if($lapangans->count() > 0)
                <table class="w-full border-collapse text-left text-xs">
                    <thead>
                        <tr class="bg-black/30 text-gray-400 font-bold uppercase tracking-wider border-b border-white/10">
                            <th class="px-6 py-4 w-36 border-r border-white/10">Jam Bermain</th>
                            @foreach($lapangans as $lapangan)
                                <th class="px-4 py-4 text-center border-r border-white/10 last:border-r-0 min-w-[200px]">
                                    <div class="flex flex-col items-center">
                                        <span class="text-white font-bold text-sm">{{ $lapangan->name }}</span>
                                        <span class="text-emerald-400 text-[11px] mt-0.5">{{ $lapangan->surface }} • Rp {{ number_format($lapangan->price_per_hour, 0, ',', '.') }}/jam</span>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($slots as $slot)
                            @php
                                $slotHour = intval(explode(':', $slot)[0]);
                                $endHour = $slotHour + 1;
                                $rangeLabel = sprintf('%02d:00 - %02d:00', $slotHour, $endHour);
                            @endphp
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="px-6 py-3 font-mono font-bold text-gray-300 border-r border-white/10 bg-black/20">
                                    {{ $rangeLabel }}
                                </td>
                                @foreach($lapangans as $lapangan)
                                    @php
                                        $booked = $bookings->first(function ($b) use ($lapangan, $slotHour) {
                                            if ($b->lapangan_id !== $lapangan->id) return false;
                                            $parts = explode(' - ', $b->time);
                                            if (count($parts) !== 2) return false;
                                            $bStart = intval(explode(':', $parts[0])[0]);
                                            $bEnd = intval(explode(':', $parts[1])[0]);
                                            return $slotHour >= $bStart && $slotHour < $bEnd;
                                        });
                                    @endphp
                                    <td class="p-2 border-r border-white/10 last:border-r-0">
                                        @if($booked)
                                            @if($booked->status === 'paid')
                                                <div class="p-2.5 rounded-xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 flex flex-col items-center justify-center text-center">
                                                    <span class="font-extrabold text-[11px] text-white">#{{ $booked->booking_code }}</span>
                                                    <span class="text-[10px] text-emerald-400 font-semibold truncate max-w-[170px] mt-0.5">{{ $booked->user->name }}</span>
                                                    <span class="text-[9px] uppercase tracking-wider font-bold bg-emerald-500 text-black px-2 py-0.2 rounded-full mt-1">LUNAS</span>
                                                </div>
                                            @elseif($booked->status === 'pending')
                                                <div class="p-2.5 rounded-xl bg-amber-500/20 border border-amber-500/40 text-amber-300 flex flex-col items-center justify-center text-center">
                                                    <span class="font-extrabold text-[11px] text-white">#{{ $booked->booking_code }}</span>
                                                    <span class="text-[10px] text-amber-400 font-semibold truncate max-w-[170px] mt-0.5">{{ $booked->user->name }}</span>
                                                    <span class="text-[9px] uppercase tracking-wider font-bold bg-amber-500 text-black px-2 py-0.2 rounded-full mt-1">PENDING</span>
                                                </div>
                                            @endif
                                        @else
                                            <div class="py-2.5 px-3 rounded-xl bg-white/[0.02] border border-white/5 text-gray-500 flex items-center justify-center gap-1.5 hover:border-emerald-500/20 transition-all">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500/40"></span>
                                                <span class="text-[11px] font-semibold text-gray-400">Kosong</span>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-12 text-center text-gray-500">
                    Belum ada lapangan yang terdaftar untuk menampilkan matriks jadwal.
                </div>
            @endif
        </div>
    </div>
@endsection
