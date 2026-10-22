@extends('layouts.guest')

@section('title', 'Daftar Akun | AngSoccer')

@section('body-class', 'bg-[#0a0d0a] text-gray-200 min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-x-hidden selection:bg-emerald-500 selection:text-black')

@push('styles')
    <style>
        .auth-mesh {
            background-image: 
                radial-gradient(circle at 85% 15%, rgba(16, 185, 129, 0.15) 0%, transparent 45%),
                radial-gradient(circle at 15% 85%, rgba(5, 150, 105, 0.12) 0%, transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.04) 0%, transparent 60%);
        }
        .pitch-grid {
            background-size: 32px 32px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
        }
    </style>
@endpush

@section('background')
    <div class="fixed inset-0 auth-mesh pitch-grid pointer-events-none"></div>
@endsection

@section('main-class', 'w-full max-w-[500px] flex flex-col items-center mx-auto z-10 my-auto py-8')

@section('main')
    <!-- Top Brand & Back to Home -->
    <div class="w-full flex justify-between items-center mb-6">
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-black font-extrabold shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[20px]">sports_soccer</span>
            </div>
            <span class="text-xl font-black tracking-tight text-white font-headline">Ang<span class="text-emerald-400">Soccer</span></span>
        </a>
        <a href="/" class="text-xs font-semibold text-gray-400 hover:text-emerald-400 flex items-center gap-1 transition-colors">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span>Beranda</span>
        </a>
    </div>

    <!-- Register Card -->
    <div class="w-full bg-[#131914]/90 border border-white/10 rounded-2xl shadow-2xl backdrop-blur-xl p-6 sm:p-8 relative">
        <div class="mb-6">
            <h1 class="text-2xl font-black text-white tracking-tight">Buat Akun Baru</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Daftar sekarang dan nikmati kemudahan booking lapangan bola & mini soccer.</p>
        </div>

        @if (session('error') || $errors->any())
            <div class="mb-5 p-3.5 bg-red-500/10 border border-red-500/30 rounded-xl flex items-start gap-2.5 text-red-300 text-xs leading-relaxed animate-in fade-in duration-200">
                <span class="material-symbols-outlined text-red-400 text-[18px] shrink-0 mt-0.5">error</span>
                <div class="flex-1">
                    <p class="font-bold text-red-200">Pendaftaran Belum Berhasil</p>
                    <p class="mt-0.5 opacity-90">{{ $errors->first() ?? session('error') }}</p>
                </div>
            </div>
        @endif

        <form action="{{ route('register') }}" class="space-y-4" id="registrationForm" method="POST">
            @csrf

            <!-- Name Input -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="name">Nama Lengkap</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">person</span>
                    <input
                        class="w-full pl-10 pr-4 py-3 bg-black/40 border border-white/10 rounded-xl text-sm text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all @error('name') border-red-500 @enderror"
                        id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required autofocus>
                </div>
                @error('name')
                    <p class="text-red-400 text-xs flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email Input -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="email">Alamat Email</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">mail</span>
                    <input
                        class="w-full pl-10 pr-4 py-3 bg-black/40 border border-white/10 rounded-xl text-sm text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all @error('email') border-red-500 @enderror"
                        id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                </div>
                @error('email')
                    <p class="text-red-400 text-xs flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Phone Input -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="phone">Nomor WhatsApp / HP</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">call</span>
                    <input
                        class="w-full pl-10 pr-4 py-3 bg-black/40 border border-white/10 rounded-xl text-sm text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all @error('phone') border-red-500 @enderror"
                        id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="081234567890" required>
                </div>
                @error('phone')
                    <p class="text-red-400 text-xs flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password & Confirm Password (Grid) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="password">Kata Sandi</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">lock</span>
                        <input
                            class="w-full pl-10 pr-4 py-3 bg-black/40 border border-white/10 rounded-xl text-sm text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all @error('password') border-red-500 @enderror"
                            id="password" name="password" type="password" placeholder="Min. 8 karakter" required>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-xs flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-[14px]">error</span>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="password_confirmation">Ulangi Sandi</label>
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">verified_user</span>
                        <input
                            class="w-full pl-10 pr-4 py-3 bg-black/40 border border-white/10 rounded-xl text-sm text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all"
                            id="password_confirmation" name="password_confirmation" type="password" placeholder="Ulangi sandi" required>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button
                class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold py-3.5 rounded-xl shadow-lg shadow-emerald-500/20 active:scale-95 transition-all flex items-center justify-center gap-2 mt-4"
                type="submit">
                <span>Daftar Akun</span>
                <span class="material-symbols-outlined text-[18px]">sports_soccer</span>
            </button>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/10"></div>
            </div>
            <div class="relative flex justify-center text-xs">
                <span class="bg-[#131914] px-3 text-gray-500">atau daftar dengan</span>
            </div>
        </div>

        <!-- Google OAuth -->
        <a href="{{ route('auth.google') }}"
            class="w-full flex items-center justify-center gap-2.5 py-3 px-4 bg-black/30 hover:bg-white/5 border border-white/10 rounded-xl text-xs font-bold text-white transition-all active:scale-95">
            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
            </svg>
            <span>Daftar Cepat via Google</span>
        </a>

        <!-- Switch to Login -->
        <p class="text-center text-xs text-gray-400 mt-6">
            Sudah memiliki akun?
            <a class="text-emerald-400 font-bold hover:underline transition-all ml-1"
                href="{{ route('login') }}">Masuk Disini</a>
        </p>
    </div>
@endsection
