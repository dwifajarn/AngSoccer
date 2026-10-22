@extends('layouts.app')

@section('body-class', 'bg-[#0c100d] text-gray-200 min-h-screen font-body antialiased selection:bg-emerald-500 selection:text-black')

@push('styles')
    <style>
        .nav-link-active {
            color: #34d399;
            position: relative;
        }
        .nav-link-active::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #10b981;
            border-radius: 9999px;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.6);
        }
    </style>
@endpush

@section('content')
    <!-- TopNavBar -->
    <header class="bg-[#0c100d]/90 backdrop-blur-md border-b border-white/10 sticky top-0 z-50 transition-all">
        <nav class="flex justify-between items-center w-full px-4 sm:px-8 max-w-7xl mx-auto h-20">
            <!-- Brand -->
            <a href="{{ route('fields.index') }}" class="flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-black font-extrabold shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-[24px]">sports_soccer</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-black tracking-tight text-white font-headline leading-tight">Ang<span class="text-emerald-400">Soccer</span></span>
                    <span class="text-[9px] font-bold uppercase tracking-widest text-emerald-400/80">Arena Booking</span>
                </div>
            </a>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center gap-8">
                <a class="text-xs uppercase tracking-wider font-bold transition-all hover:text-emerald-400 {{ request()->routeIs('fields.index') || request()->routeIs('booking.create') ? 'nav-link-active' : 'text-gray-400' }}" href="{{ route('fields.index') }}">
                    Jadwal Lapangan
                </a>
                <a class="text-xs uppercase tracking-wider font-bold transition-all hover:text-emerald-400 {{ request()->routeIs('bookings.history') ? 'nav-link-active' : 'text-gray-400' }}" href="{{ route('bookings.history') }}">
                    Booking Saya
                </a>
                <a class="text-xs uppercase tracking-wider font-bold transition-all hover:text-emerald-400 {{ request()->routeIs('profile.*') ? 'nav-link-active' : 'text-gray-400' }}" href="{{ route('profile.show') }}">
                    Profil Akun
                </a>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold hover:bg-emerald-500/20 transition-all">
                            <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span>
                            <span>Admin Panel</span>
                        </a>
                    @endif

                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2 p-1.5 pr-3 rounded-full bg-white/[0.04] border border-white/10 hover:border-emerald-500/40 transition-all">
                        <img class="w-8 h-8 rounded-full object-cover border border-emerald-500/50" src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user()->name }}">
                        <span class="text-xs font-bold text-white max-w-[100px] truncate hidden sm:inline">{{ auth()->user()->name }}</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-400 hover:bg-red-500/10 rounded-xl transition-all" title="Logout">
                            <span class="material-symbols-outlined text-[20px]">logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 rounded-xl bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold text-xs shadow-lg shadow-emerald-500/20 active:scale-95 transition-all">
                        Masuk / Daftar
                    </a>
                @endauth

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 text-gray-400 hover:text-white rounded-xl bg-white/5 border border-white/10" id="mobileMenuBtn" onclick="toggleMobileMenu()">
                    <span class="material-symbols-outlined text-[22px]">menu</span>
                </button>
            </div>
        </nav>

        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-white/10 bg-[#0c100d] px-4 py-4 space-y-2">
            <a class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('fields.index') || request()->routeIs('booking.create') ? 'bg-emerald-500/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5' }}" href="{{ route('fields.index') }}">
                Jadwal Lapangan
            </a>
            <a class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('bookings.history') ? 'bg-emerald-500/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5' }}" href="{{ route('bookings.history') }}">
                Booking Saya
            </a>
            <a class="block px-3 py-2 rounded-lg text-xs font-bold {{ request()->routeIs('profile.*') ? 'bg-emerald-500/20 text-emerald-400' : 'text-gray-300 hover:bg-white/5' }}" href="{{ route('profile.show') }}">
                Profil Akun
            </a>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a class="block px-3 py-2 rounded-lg text-xs font-bold text-emerald-400 bg-emerald-500/10 border border-emerald-500/20" href="{{ route('admin.dashboard') }}">
                    Ke Admin HQ
                </a>
            @endif
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8 sm:py-10">
        @yield('main')
    </main>

    <footer class="border-t border-white/10 bg-[#070a08] py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 flex flex-col sm:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold">
                    <span class="material-symbols-outlined text-[18px]">sports_soccer</span>
                </div>
                <span class="text-base font-black text-white font-headline">Ang<span class="text-emerald-400">Soccer</span></span>
            </div>

            <div class="flex items-center gap-6 text-xs text-gray-400">
                <a class="hover:text-emerald-400 transition-colors" href="#">Kebijakan Privasi</a>
                <a class="hover:text-emerald-400 transition-colors" href="#">Syarat &amp; Ketentuan</a>
                <a class="hover:text-emerald-400 transition-colors" href="#">Pusat Bantuan</a>
            </div>

            <p class="text-xs text-gray-500">© {{ date('Y') }} AngSoccer. Digitalizing the Pitch.</p>
        </div>
    </footer>
@endsection

@push('scripts')
<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('hidden');
    }
</script>
@endpush
