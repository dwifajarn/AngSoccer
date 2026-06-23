@extends('layouts.guest')

@section('title', 'Register - AngSoccer')

@section('body-class',
    'bg-background min-h-screen flex items-center justify-center font-body-md text-on-background
    antialiased relative overflow-x-hidden')

@section('main-class', 'w-full max-w-[480px] px-md py-xl z-10')

@push('styles')
    <style>
        body {
            background: radial-gradient(circle at 74.5312% 85.2539%, rgba(148, 249, 144, 0.05) 0%, transparent 50%), rgb(249, 249, 252);
        }

        .pitch-pattern {
            background-color: #f9f9fc;
            background-image: radial-gradient(#2d5a27 0.5px, transparent 0.5px), radial-gradient(#2d5a27 0.5px, #f9f9fc 0.5px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            opacity: 0.05;
        }

        .focused-input:focus-within {
            box-shadow: 0 0 0 4px rgba(0, 110, 28, 0.1);
        }
    </style>
@endpush

@section('background')
    <div class="fixed inset-0 pitch-pattern pointer-events-none"></div>
    <div class="fixed inset-0 bg-gradient-to-tr from-primary/5 via-transparent to-secondary/5 pointer-events-none"></div>
    <div class="fixed inset-0 pointer-events-none opacity-20" id="ball-container"></div>
@endsection

@section('main')
    <div
        class="bg-surface-container-lowest rounded-xl shadow-lg border border-outline-variant/30 overflow-hidden transition-all duration-500 hover:shadow-xl">
        <div class="p-lg md:p-xl">
            <div class="flex flex-col items-center mb-lg">
                @include('partials.logo', ['class' => 'h-16 w-auto mb-sm'])
                <h1 class="font-headline-md text-headline-md text-secondary mt-xs">Buat Akun</h1>
                <p class="text-on-surface-variant font-body-md text-center mt-xs">Gabung sekarang dan booking lapangan
                    favoritmu dengan mudah.</p>
            </div>

            <form action="{{ route('register') }}" class="space-y-md" id="registrationForm" method="POST">
                @csrf

                <div class="space-y-xs">
                    <label class="block font-label-md text-label-md text-on-surface-variant" for="name">Full
                        Name</label>
                    <div class="relative group focused-input rounded-lg border border-outline/30 bg-white transition-all">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary">person</span>
                        <input
                            class="w-full bg-transparent border-none focus:ring-0 py-3 pl-11 pr-4 font-body-md text-on-surface @error('name') border-error @enderror"
                            id="name" name="name" type="text" value="{{ old('name') }}" placeholder="John Doe"
                            required>
                    </div>
                    @error('name')
                        <p class="text-error text-caption font-caption">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-xs">
                    <label class="block font-label-md text-label-md text-on-surface-variant" for="email">Email</label>
                    <div class="relative group focused-input rounded-lg border border-outline/30 bg-white transition-all">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary">mail</span>
                        <input
                            class="w-full bg-transparent border-none focus:ring-0 py-3 pl-11 pr-4 font-body-md text-on-surface @error('email') border-error @enderror"
                            id="email" name="email" type="email" value="{{ old('email') }}"
                            placeholder="john@example.com" required>
                    </div>
                    @error('email')
                        <p class="text-error text-caption font-caption">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-xs">
                    <label class="block font-label-md text-label-md text-on-surface-variant" for="phone">Phone
                        Number</label>
                    <div class="relative group focused-input rounded-lg border border-outline/30 bg-white transition-all">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary">call</span>
                        <input
                            class="w-full bg-transparent border-none focus:ring-0 py-3 pl-11 pr-4 font-body-md text-on-surface @error('phone') border-error @enderror"
                            id="phone" name="phone" type="tel" value="{{ old('phone') }}"
                            placeholder="081234567890" required>
                    </div>
                    @error('phone')
                        <p class="text-error text-caption font-caption">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    <div class="space-y-xs">
                        <label class="block font-label-md text-label-md text-on-surface-variant"
                            for="password">Password</label>
                        <div
                            class="relative group focused-input rounded-lg border border-outline/30 bg-white transition-all">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary">lock</span>
                            <input
                                class="w-full bg-transparent border-none focus:ring-0 py-3 pl-11 pr-4 font-body-md text-on-surface @error('password') border-error @enderror"
                                id="password" name="password" type="password" placeholder="••••••••" required>
                        </div>
                        @error('password')
                            <p class="text-error text-caption font-caption">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="space-y-xs">
                        <label class="block font-label-md text-label-md text-on-surface-variant"
                            for="password_confirmation">Confirm Password</label>
                        <div
                            class="relative group focused-input rounded-lg border border-outline/30 bg-white transition-all">
                            <span
                                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary">verified_user</span>
                            <input
                                class="w-full bg-transparent border-none focus:ring-0 py-3 pl-11 pr-4 font-body-md text-on-surface"
                                id="password_confirmation" name="password_confirmation" type="password"
                                placeholder="••••••••" required>
                        </div>
                    </div>
                </div>

                <button
                    class="w-full bg-secondary hover:bg-primary text-white font-label-md py-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 active:scale-95 flex items-center justify-center gap-sm mt-lg"
                    type="submit">
                    <span>Register</span>
                    <span class="material-symbols-outlined text-[18px]">sports_soccer</span>
                </button>
            </form>

            <div class="mt-xl pt-lg border-t border-outline-variant/30 text-center">
                <p class="font-body-md text-on-surface-variant">
                    Already have an account?
                    <a class="text-secondary font-semibold hover:underline decoration-2 underline-offset-4 transition-all"
                        href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('mousemove', (e) => {
            const x = (e.clientX / window.innerWidth) * 100;
            const y = (e.clientY / window.innerHeight) * 100;
            document.body.style.background =
                `radial-gradient(circle at ${x}% ${y}%, rgba(148, 249, 144, 0.05) 0%, transparent 50%), #f9f9fc`;
        });

        function createBall() {
            const ball = document.createElement('span');
            ball.className =
                'material-symbols-outlined absolute text-secondary-fixed opacity-10 animate-pulse transition-all duration-1000';
            ball.textContent = 'sports_soccer';
            ball.style.fontSize = Math.random() * 40 + 20 + 'px';
            ball.style.left = Math.random() * 100 + 'vw';
            ball.style.top = Math.random() * 100 + 'vh';
            ball.style.transform = `rotate(${Math.random() * 360}deg)`;
            document.getElementById('ball-container').appendChild(ball);
            setTimeout(() => ball.remove(), 10000);
        }

        for (let i = 0; i < 8; i++) createBall();
        setInterval(createBall, 3000);
    </script>
@endpush
