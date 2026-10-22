@extends('layouts.guest')

@section('title', 'Lupa Password | AngSoccer')

@section('body-class', 'bg-[#0a0d0a] text-gray-200 min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-x-hidden selection:bg-emerald-500 selection:text-black')

@push('styles')
    <style>
        .auth-mesh {
            background-image: 
                radial-gradient(circle at 50% 20%, rgba(16, 185, 129, 0.15) 0%, transparent 45%),
                radial-gradient(circle at 80% 80%, rgba(5, 150, 105, 0.12) 0%, transparent 45%),
                radial-gradient(circle at 20% 80%, rgba(16, 185, 129, 0.04) 0%, transparent 60%);
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

@section('main-class', 'w-full max-w-[440px] flex flex-col items-center mx-auto z-10 my-auto')

@section('main')
    <!-- Top Brand & Back to Home -->
    <div class="w-full flex justify-between items-center mb-6">
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-black font-extrabold shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                <span class="material-symbols-outlined text-[20px]">sports_soccer</span>
            </div>
            <span class="text-xl font-black tracking-tight text-white font-headline">Ang<span class="text-emerald-400">Soccer</span></span>
        </a>
        <a href="{{ route('login') }}" class="text-xs font-semibold text-gray-400 hover:text-emerald-400 flex items-center gap-1 transition-colors">
            <span class="material-symbols-outlined text-[16px]">arrow_back</span>
            <span>Masuk</span>
        </a>
    </div>

    <!-- Forgot Password Card -->
    <div class="w-full bg-[#131914]/90 border border-white/10 rounded-2xl shadow-2xl backdrop-blur-xl p-6 sm:p-8 relative">
        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 mb-4">
            <span class="material-symbols-outlined text-[26px]">lock_reset</span>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-black text-white tracking-tight">Lupa Kata Sandi?</h1>
            <p class="text-xs sm:text-sm text-gray-400 mt-1">Jangan khawatir, masukkan email terdaftar Anda untuk menerima tautan pemulihan.</p>
        </div>

        @if (session('status'))
            <div class="mb-5 p-3.5 bg-emerald-500/15 border border-emerald-500/30 rounded-xl flex items-start gap-2.5 text-emerald-300 text-xs leading-relaxed animate-in fade-in duration-200">
                <span class="material-symbols-outlined text-emerald-400 text-[18px] shrink-0 mt-0.5">check_circle</span>
                <div>
                    <p class="font-bold text-emerald-200">Permintaan Terkirim</p>
                    <p class="mt-0.5 opacity-90">{{ session('status') }}</p>
                </div>
            </div>
        @endif

        @if (session('error') || $errors->any())
            <div class="mb-5 p-3.5 bg-red-500/10 border border-red-500/30 rounded-xl flex items-start gap-2.5 text-red-300 text-xs leading-relaxed animate-in fade-in duration-200">
                <span class="material-symbols-outlined text-red-400 text-[18px] shrink-0 mt-0.5">error</span>
                <div class="flex-1">
                    <p class="font-bold text-red-200">Gagal Mengirim</p>
                    <p class="mt-0.5 opacity-90">{{ $errors->first() ?? session('error') }}</p>
                </div>
            </div>
        @endif

        <form action="{{ route('password.email') }}" class="space-y-4" id="forgotPasswordForm" method="POST">
            @csrf

            <!-- Email Input -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="email">Alamat Email</label>
                <div class="relative group">
                    <span class="material-symbols-outlined absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within:text-emerald-400 transition-colors text-[20px]">mail</span>
                    <input
                        class="w-full pl-10 pr-4 py-3 bg-black/40 border border-white/10 rounded-xl text-sm text-white placeholder-gray-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all @error('email') border-red-500 @enderror"
                        id="email" name="email" type="email" value="{{ old('email') }}"
                        placeholder="nama@email.com" required autofocus>
                </div>
                @error('email')
                    <p class="text-red-400 text-xs flex items-center gap-1 mt-1">
                        <span class="material-symbols-outlined text-[14px]">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button
                class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold py-3.5 rounded-xl shadow-lg shadow-emerald-500/20 active:scale-95 transition-all flex items-center justify-center gap-2 mt-2"
                type="submit">
                <span>Kirim Tautan Reset</span>
                <span class="material-symbols-outlined text-[18px]">send</span>
            </button>
        </form>

        <!-- Back to Login -->
        <div class="mt-6 pt-5 border-t border-white/10 text-center">
            <a class="text-xs font-bold text-gray-400 hover:text-emerald-400 flex items-center justify-center gap-1.5 transition-colors"
                href="{{ route('login') }}">
                <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                <span>Kembali ke Halaman Masuk</span>
            </a>
        </div>
    </div>
@endsection
