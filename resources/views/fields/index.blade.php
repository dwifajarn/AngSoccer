@extends('layouts.user')

@section('title', 'Jadwal & Sewa Lapangan - AngSoccer')

@section('main')
    <!-- Hero Heading Section -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                Katalog Lapangan Olahraga
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight font-headline">Pilih &amp; Sewa Arena Terbaik</h1>
            <p class="text-sm text-gray-400 mt-1 max-w-2xl">Temukan lapangan futsal dan mini soccer berstandar turnamen dengan rumput sintetis premium dan penerangan malam floodlight.</p>
        </div>
        <div class="text-xs text-gray-400 bg-white/[0.03] border border-white/10 px-4 py-2.5 rounded-2xl flex items-center gap-2">
            <span class="material-symbols-outlined text-emerald-400 text-[18px]">verified</span>
            <span>Konfirmasi Cepat Tanpa Ribet</span>
        </div>
    </div>

    <!-- Filter Bar -->
    <section class="mb-10">
        <form method="GET" action="{{ route('fields.index') }}" class="bg-[#131914] border border-white/10 p-4 sm:p-5 rounded-2xl shadow-xl flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Pencarian Lapangan</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full pl-10 pr-4 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all font-body" placeholder="Cari nama lapangan, area, atau fasilitas..." type="text">
                </div>
            </div>
            <div class="w-full md:w-56">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider mb-1.5">Tipe Lapangan</label>
                <select name="type" class="w-full px-4 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 cursor-pointer font-semibold">
                    <option value="">Semua Tipe Arena</option>
                    <option value="Futsal" {{ request('type') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                    <option value="Soccer" {{ request('type') == 'Soccer' ? 'selected' : '' }}>Soccer</option>
                </select>
            </div>
            <button type="submit" class="w-full md:w-auto px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold text-xs rounded-xl shadow-lg shadow-emerald-500/20 active:scale-95 transition-all flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">search</span>
                <span>Temukan Lapangan</span>
            </button>
        </form>
    </section>

    <!-- Grid of Field Cards -->
    <section>
        @if($fields->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($fields as $field)
                    <div class="group bg-[#131914] border border-white/10 rounded-2xl overflow-hidden shadow-xl hover:border-emerald-500/40 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <!-- Card Image Hero -->
                            <div class="relative h-56 overflow-hidden">
                                <img alt="{{ $field->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $field->image_url }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#131914] via-transparent to-black/30"></div>
                                
                                <!-- Top Status Badge -->
                                <div class="absolute top-3.5 right-3.5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-black/60 backdrop-blur-md border border-white/10 text-emerald-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        {{ ucfirst($field->status) }}
                                    </span>
                                </div>

                                <!-- Bottom Type Badge & Rating -->
                                <div class="absolute bottom-3.5 left-3.5 right-3.5 flex justify-between items-center">
                                    <span class="px-3 py-1 bg-emerald-500 text-black font-extrabold rounded-lg text-xs tracking-wider uppercase shadow-md">
                                        {{ $field->type }}
                                    </span>
                                    <div class="flex items-center gap-1 bg-black/60 backdrop-blur-md px-2.5 py-1 rounded-lg border border-white/10 text-amber-400 font-bold text-xs">
                                        <span class="material-symbols-outlined text-[16px] text-amber-400" style="font-variation-settings: 'FILL' 1;">star</span>
                                        <span>{{ number_format($field->rating, 1) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-white font-headline group-hover:text-emerald-400 transition-colors">{{ $field->name }}</h3>
                                
                                <div class="flex items-center text-gray-400 mt-2 gap-1.5 text-xs">
                                    <span class="material-symbols-outlined text-[16px] text-emerald-400 shrink-0">location_on</span>
                                    <span class="truncate">{{ $field->location }}</span>
                                </div>

                                <div class="mt-3 flex items-center gap-2">
                                    <span class="text-[11px] font-semibold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-full">
                                        {{ $field->surface }}
                                    </span>
                                    @if($field->facilities)
                                        <span class="text-[11px] text-gray-400 truncate max-w-[180px]">
                                            • {{ explode(',', $field->facilities)[0] ?? 'Lengkap' }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-5 pt-0">
                            <div class="flex justify-between items-center border-t border-white/10 pt-4 mt-2">
                                <div>
                                    <span class="text-[10px] uppercase font-bold text-gray-400 block tracking-wider">Mulai dari</span>
                                    <p class="text-emerald-400 font-extrabold text-lg">
                                        Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}<span class="text-xs font-normal text-gray-500">/jam</span>
                                    </p>
                                </div>
                                <a href="{{ route('booking.create', $field->id) }}" class="inline-flex items-center gap-1.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black px-4 py-2 rounded-xl font-extrabold text-xs shadow-md shadow-emerald-500/20 active:scale-95 transition-all">
                                    <span>Book Now</span>
                                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center items-center">
                {{ $fields->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-[#131914] border border-white/10 rounded-2xl shadow-xl p-8">
                <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-gray-500 mx-auto mb-4">
                    <span class="material-symbols-outlined text-[36px]">stadium</span>
                </div>
                <h3 class="text-lg font-bold text-white font-headline mb-1">Lapangan Tidak Ditemukan</h3>
                <p class="text-xs text-gray-400 max-w-md mx-auto">Silakan cari kata kunci lain atau pilih tipe lapangan yang berbeda.</p>
                <div class="mt-5">
                    <a href="{{ route('fields.index') }}" class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold text-white transition-all inline-block">
                        Lihat Semua Lapangan
                    </a>
                </div>
            </div>
        @endif
    </section>
@endsection
