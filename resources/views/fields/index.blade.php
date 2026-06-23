@extends('layouts.user')

@section('title', 'Jadwal Lapangan - AngSoccer')

@section('main')
    <!-- Filter Bar -->
    <section class="mb-2xl sticky top-20 z-40">
        <form method="GET" action="{{ route('fields.index') }}" class="bg-surface-container-low p-md rounded-xl shadow-sm flex flex-col md:flex-row gap-md items-end">
            <div class="flex-1 w-full">
                <label class="block font-label-md text-label-md text-on-surface-variant mb-xs ml-xs">Nama Lapangan</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">search</span>
                    <input name="search" value="{{ request('search') }}" class="w-full pl-xl pr-md py-sm bg-surface-container-lowest border border-outline/20 rounded-lg focus:ring-2 focus:ring-secondary/50 focus:outline-none font-body-md" placeholder="Cari Lapangan..." type="text">
                </div>
            </div>
            <div class="w-full md:w-48">
                <label class="block font-label-md text-label-md text-on-surface-variant mb-xs ml-xs">Tipe Lapangan</label>
                <select name="type" class="w-full px-md py-[10px] bg-surface-container-lowest border border-outline/20 rounded-lg focus:ring-2 focus:ring-secondary/50 focus:outline-none font-body-md">
                    <option value="">Semua Tipe</option>
                    <option value="Futsal" {{ request('type') == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                    <option value="Soccer" {{ request('type') == 'Soccer' ? 'selected' : '' }}>Soccer</option>
                </select>
            </div>
            <button type="submit" class="bg-secondary text-on-secondary px-xl py-[10px] rounded-lg font-bold font-label-md text-label-md hover:bg-primary transition-all active:scale-95 w-full md:w-auto">
                Cari
            </button>
        </form>
    </section>

    <!-- Grid of Field Cards -->
    <section class="">
        @if($fields->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-xl">
                @foreach($fields as $field)
                    <div class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-md border border-outline-variant/30 transition-all duration-300 hover:-translate-y-2">
                        <div class="relative h-56">
                            <img alt="{{ $field->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="{{ $field->image_url }}">
                            <div class="absolute top-md right-md bg-secondary text-on-secondary px-sm py-1 rounded-full font-label-md text-[10px] uppercase tracking-widest flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-secondary-fixed rounded-full animate-pulse"></span>
                                {{ ucfirst($field->status) }}
                            </div>
                            <div class="absolute bottom-md left-md">
                                <span class="bg-white/90 backdrop-blur-md text-secondary font-bold px-sm py-1 rounded-lg font-label-md text-label-md">
                                    {{ $field->type }}
                                </span>
                            </div>
                        </div>
                        <div class="p-lg">
                            <div class="flex justify-between items-start mb-sm">
                                <h3 class="font-headline-md text-headline-md text-on-surface">{{ $field->name }}</h3>
                                <div class="flex items-center text-secondary">
                                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="font-bold ml-1">{{ number_format($field->rating, 1) }}</span>
                                </div>
                            </div>
                            <div class="flex items-center text-on-surface-variant mb-md gap-sm">
                                <span class="material-symbols-outlined text-[20px]">location_on</span>
                                <span class="font-body-md text-body-md">{{ $field->location }}</span>
                            </div>
                            <div class="flex justify-between items-center border-t border-outline/10 pt-md">
                                <div>
                                    <span class="text-on-surface-variant font-label-md text-label-md">Mulai dari</span>
                                    <p class="text-secondary font-bold text-headline-md">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}<span class="text-body-md font-normal text-on-surface-variant">/jam</span></p>
                                </div>
                                <a href="{{ route('booking.create', $field->id) }}" class="bg-secondary text-on-secondary px-lg py-sm rounded-lg font-bold font-label-md text-label-md transition-all active:scale-95 hover:bg-secondary/90">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="mt-2xl flex justify-center items-center gap-sm">
                {{ $fields->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-2xl bg-surface-container-lowest rounded-xl shadow-sm border border-outline-variant/30">
                <span class="material-symbols-outlined text-[64px] text-on-surface-variant opacity-50 mb-md">stadium</span>
                <h3 class="text-headline-md text-on-surface mb-xs">Lapangan Tidak Ditemukan</h3>
                <p class="text-body-md text-on-surface-variant">Silakan cari kata kunci lain atau pilih tipe lapangan yang berbeda.</p>
            </div>
        @endif
    </section>
@endsection
