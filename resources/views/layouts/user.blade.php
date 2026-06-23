@extends('layouts.app')

@section('content')
    <!-- TopNavBar -->
    <header class="bg-surface shadow-md sticky top-0 z-50">
        <nav class="flex justify-between items-center w-full px-gutter max-w-7xl mx-auto h-16">
            <a href="{{ route('fields.index') }}" class="text-headline-md font-headline-md font-bold text-secondary">AngSoccer</a>
            <div class="hidden md:flex items-center gap-xl">
                <a class="font-label-md text-label-md {{ request()->routeIs('fields.index') || request()->routeIs('booking.create') ? 'text-secondary border-b-2 border-secondary font-bold pb-1' : 'text-on-surface-variant hover:text-secondary' }} transition-colors" href="{{ route('fields.index') }}">Jadwal Lapangan</a>
                <a class="font-label-md text-label-md {{ request()->routeIs('bookings.history') ? 'text-secondary border-b-2 border-secondary font-bold pb-1' : 'text-on-surface-variant hover:text-secondary' }}" href="{{ route('bookings.history') }}">Booking Saya</a>
                <a class="font-label-md text-label-md {{ request()->routeIs('profile.*') ? 'text-secondary border-b-2 border-secondary font-bold pb-1' : 'text-on-surface-variant hover:text-secondary' }}" href="{{ route('profile.show') }}">Profile</a>
            </div>
            <div class="flex items-center gap-md">
                @auth
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-sm">
                        <img class="w-8 h-8 rounded-full object-cover border border-secondary" src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user()->name }}">
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="font-label-md text-label-md px-md py-sm rounded-lg bg-primary-container text-on-primary hover:opacity-90 transition-all active:scale-95 duration-150">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-label-md text-label-md px-md py-sm rounded-lg bg-secondary text-on-secondary hover:opacity-90 transition-all active:scale-95 duration-150">Login</a>
                @endauth
                <button class="md:hidden flex items-center">
                    <span class="material-symbols-outlined text-on-surface">menu</span>
                </button>
            </div>
        </nav>
    </header>

    <main class="max-w-7xl mx-auto px-gutter py-xl">
        @yield('main')
    </main>

    <footer class="bg-on-background text-surface-container-low py-xl mt-2xl">
        <div class="max-w-7xl mx-auto px-gutter text-center">
            <p class="font-headline-md mb-md text-surface-bright">AngSoccer</p>
            <div class="flex justify-center gap-xl mb-lg">
                <a class="text-caption hover:text-secondary-fixed transition-colors" href="#">Kebijakan Privasi</a>
                <a class="text-caption hover:text-secondary-fixed transition-colors" href="#">Syarat &amp; Ketentuan</a>
                <a class="text-caption hover:text-secondary-fixed transition-colors" href="#">Pusat Bantuan</a>
            </div>
            <p class="text-caption opacity-60">© 2023 AngSoccer. Digitalizing the Pitch.</p>
        </div>
    </footer>
@endsection