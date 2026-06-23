@extends('layouts.guest')

@section('title', 'Forgot Password - AngSoccer')

@section('body-class', 'bg-background font-body-md text-on-background min-h-screen flex flex-col items-center
    justify-center p-md bg-pattern')

    @push('styles')
        <style>
            .success-animation {
                animation: slideUp 0.5s ease-out forwards;
            }

            @keyframes slideUp {
                from {
                    transform: translateY(20px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .bg-pattern {
                background-color: #f9f9fc;
                background-image: radial-gradient(#2d5a27 0.5px, transparent 0.5px);
                background-size: 24px 24px;
            }
        </style>
    @endpush

@section('main')
    <div class="flex flex-col items-center mb-xl">
        @include('partials.logo', ['class' => 'w-24 h-24 mb-md'])
        <h1 class="font-headline-md text-headline-md text-primary tracking-tight">AngSoccer</h1>
    </div>

    <div class="bg-surface-container-lowest p-xl rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] transition-all duration-300"
        id="request-card">
        <div class="mb-lg">
            <h2 class="font-headline-md text-headline-md text-on-surface mb-xs">Forgot Password?</h2>
            <p class="font-body-md text-on-surface-variant">No worries, we'll send you reset instructions to your inbox.</p>
        </div>

        @if (session('status'))
            <div class="mb-lg p-md bg-secondary-container text-on-secondary-container rounded-lg font-body-md">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" class="space-y-lg" id="forgot-password-form" method="POST">
            @csrf
            <div class="space-y-xs">
                <label class="font-label-md text-label-md text-on-surface" for="email">Email Address</label>
                <div class="relative">
                    <span
                        class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-on-surface-variant">mail</span>
                    <input
                        class="w-full pl-11 pr-md py-3 bg-surface-container-lowest border border-outline/20 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-body-md text-on-surface placeholder:text-outline @error('email') border-error @enderror"
                        id="email" name="email" type="email" value="{{ old('email') }}"
                        placeholder="Enter your email" required autofocus>
                </div>
                @error('email')
                    <p class="text-error text-caption font-caption">{{ $message }}</p>
                @enderror
            </div>
            <button
                class="w-full bg-secondary hover:bg-secondary-container hover:text-on-secondary-container text-on-secondary font-label-md text-label-md py-4 rounded-lg shadow-sm transition-all active:scale-[0.98] flex items-center justify-center gap-sm"
                type="submit">
                Send Reset Link
                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </button>
        </form>

        <div class="mt-xl pt-lg border-t border-outline-variant flex justify-center">
            <a class="font-label-md text-label-md text-primary flex items-center gap-xs hover:underline transition-all"
                href="{{ route('login') }}">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Back to Login
            </a>
        </div>
    </div>

    <div class="hidden bg-surface-container-lowest p-xl rounded-xl shadow-[0px_4px_20px_rgba(26,28,30,0.08)] success-animation"
        id="success-card">
        <div class="flex flex-col items-center text-center">
            <div
                class="w-16 h-16 bg-secondary-container text-on-secondary-container rounded-full flex items-center justify-center mb-lg">
                <span class="material-symbols-outlined text-[32px]"
                    style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </div>
            <h2 class="font-headline-md text-headline-md text-on-surface mb-xs">Check your email</h2>
            <p class="font-body-md text-on-surface-variant mb-xl">
                We've sent a password reset link to <span class="font-semibold text-on-surface" id="display-email"></span>
            </p>
            <div class="w-full space-y-md">
                <button
                    class="w-full bg-secondary text-on-secondary font-label-md text-label-md py-4 rounded-lg shadow-sm transition-all hover:opacity-90 active:scale-[0.98]"
                    type="button" onclick="location.reload()">
                    Open Email App
                </button>
                <button
                    class="w-full bg-transparent text-on-surface-variant font-label-md text-label-md py-3 rounded-lg hover:bg-surface-container transition-all"
                    type="button" onclick="resetView()">
                    Didn't receive the email? <span class="text-secondary font-bold">Click to resubmit</span>
                </button>
            </div>
            <div class="mt-xl pt-lg border-t border-outline-variant w-full flex justify-center">
                <a class="font-label-md text-label-md text-primary flex items-center gap-xs hover:underline transition-all"
                    href="{{ route('login') }}">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    Back to Login
                </a>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <p class="text-center mt-xl font-caption text-caption text-on-surface-variant w-full max-w-[440px]">
        Trouble with your account? <a class="text-secondary underline" href="#">Contact Support</a>
    </p>
@endsection

@push('scripts')
    <script>
        function resetView() {
            const requestCard = document.getElementById('request-card');
            const successCard = document.getElementById('success-card');

            successCard.classList.add('opacity-0');
            setTimeout(() => {
                successCard.classList.add('hidden');
                successCard.classList.remove('opacity-0');
                requestCard.classList.remove('hidden', 'opacity-0', 'scale-95');
            }, 300);
        }
    </script>
@endpush
