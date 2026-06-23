@extends('layouts.guest')

@section('title', 'Login | AngSoccer')

@section('body-class', 'flex flex-col items-center justify-center p-md min-h-screen font-body-md text-on-background')

@push('styles')
    <style>
        body {
            background-color: #F8F9F8;
            background-image:
                radial-gradient(at 0% 0%, rgba(45, 90, 39, 0.03) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 110, 28, 0.03) 0px, transparent 50%);
        }

        .login-card {
            box-shadow: 0px 4px 20px rgba(26, 28, 30, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .input-focus-effect:focus {
            box-shadow: 0 0 0 4px rgba(0, 110, 28, 0.1);
        }
    </style>
@endpush

@section('main')
    <div class="mb-xl text-center">
        @include('partials.logo', ['class' => 'h-16 w-auto mx-auto mb-md'])
        <h1 class="font-headline-lg text-headline-lg text-on-background">Welcome Back</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-xs">Step back onto the pitch</p>
    </div>

    <div class="login-card w-full bg-surface-container-lowest rounded-xl p-lg md:p-xl border border-surface-variant/30">
        <form action="{{ route('login') }}" class="space-y-lg" id="loginForm" method="POST">
            @csrf

            <div class="flex flex-col gap-sm">
                <label class="font-label-md text-label-md text-on-surface" for="email">Email Address</label>
                <div class="relative group">
                    <span
                        class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary transition-colors">mail</span>
                    <input
                        class="w-full pl-xl pr-md py-3 bg-surface-container-low border border-outline/20 rounded-lg font-body-md text-body-md focus:outline-none focus:border-secondary input-focus-effect transition-all text-on-surface @error('email') border-error @enderror"
                        id="email" name="email" type="email" value="{{ old('email') }}"
                        placeholder="name@example.com" required autofocus>
                </div>
                @error('email')
                    <p class="text-error text-caption font-caption">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-sm">
                <div class="flex justify-between items-center">
                    <label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
                    <a class="font-label-md text-label-md text-secondary hover:underline"
                        href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
                <div class="relative group">
                    <span
                        class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant group-focus-within:text-secondary transition-colors">lock</span>
                    <input
                        class="w-full pl-xl pr-xl py-3 bg-surface-container-low border border-outline/20 rounded-lg font-body-md text-body-md focus:outline-none focus:border-secondary input-focus-effect transition-all text-on-surface @error('password') border-error @enderror"
                        id="password" name="password" type="password" placeholder="••••••••" required>
                    <button class="absolute right-md top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-on-surface"
                        onclick="togglePassword()" type="button">
                        <span class="material-symbols-outlined" id="eyeIcon">visibility</span>
                    </button>
                </div>
                @error('password')
                    <p class="text-error text-caption font-caption">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-sm">
                <input class="w-5 h-5 rounded border-outline/30 text-secondary focus:ring-secondary cursor-pointer"
                    id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                <label class="font-body-md text-body-md text-on-surface-variant cursor-pointer select-none"
                    for="remember">Remember Me</label>
            </div>

            <button
                class="w-full bg-secondary hover:bg-secondary/90 text-on-secondary py-4 rounded-lg font-headline-md text-headline-md flex items-center justify-center gap-sm active:scale-95 transition-all shadow-md"
                type="submit">
                <span>Login</span>
                <span class="material-symbols-outlined">arrow_forward</span>
            </button>
        </form>

        <div class="relative my-xl">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-outline/10"></div>
            </div>
            <div class="relative flex justify-center text-label-md">
                <span class="bg-surface-container-lowest px-md text-on-surface-variant font-label-md">Or continue
                    with</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-md">
            <button type="button"
                class="flex items-center justify-center gap-sm py-3 px-md border border-outline/20 rounded-lg font-label-md text-label-md text-on-surface hover:bg-surface-container-low transition-colors active:scale-95">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path
                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                        fill="currentColor"></path>
                    <path
                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                        fill="currentColor"></path>
                    <path
                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"
                        fill="currentColor"></path>
                    <path
                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                        fill="currentColor"></path>
                </svg>
                Google
            </button>
            <button type="button"
                class="flex items-center justify-center gap-sm py-3 px-md border border-outline/20 rounded-lg font-label-md text-label-md text-on-surface hover:bg-surface-container-low transition-colors active:scale-95">
                <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z">
                    </path>
                </svg>
                Facebook
            </button>
        </div>
    </div>

    <div class="mt-lg text-center">
        <p class="font-body-md text-body-md text-on-surface-variant">
            Don't have an account?
            <a class="text-secondary font-bold hover:underline decoration-2 underline-offset-4"
                href="{{ route('register') }}">Register</a>
        </p>
    </div>
@endsection

@push('scripts')
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }
    </script>
@endpush
