@extends('layouts.app')

@section('content')
    <!-- SideNavBar Shell -->
    <aside class="fixed left-0 top-0 h-full w-64 bg-surface-container dark:bg-surface-container-high shadow-sm flex flex-col p-md gap-sm z-50">
        <div class="mb-xl px-sm">
            <h1 class="text-headline-md font-headline-md font-bold text-secondary dark:text-secondary-fixed">AngSoccer</h1>
            <p class="font-label-md text-label-md text-on-surface-variant">Admin Panel</p>
        </div>
        <nav class="flex-grow flex flex-col gap-xs">
            <!-- Active: Dashboard -->
            <a class="flex items-center gap-md p-2 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-secondary-container dark:bg-secondary text-on-secondary-container dark:text-on-secondary font-bold scale-98' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-highest dark:hover:bg-inverse-surface' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">dashboard</span>
                <span class="font-label-md text-label-md">Dashboard</span>
            </a>
            <!-- Kelola Lapangan -->
            <a class="flex items-center gap-md p-2 rounded-lg transition-all {{ request()->routeIs('admin.lapangan.*') ? 'bg-secondary-container dark:bg-secondary text-on-secondary-container dark:text-on-secondary font-bold scale-98' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-highest dark:hover:bg-inverse-surface' }}" href="{{ route('admin.lapangan.index') }}">
                <span class="material-symbols-outlined">stadium</span>
                <span class="font-label-md text-label-md">Kelola Lapangan</span>
            </a>
            <!-- Konfirmasi Pembayaran -->
            <a class="flex items-center gap-md p-2 rounded-lg transition-all {{ request()->routeIs('admin.payments.*') ? 'bg-secondary-container dark:bg-secondary text-on-secondary-container dark:text-on-secondary font-bold scale-98' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-highest dark:hover:bg-inverse-surface' }}" href="{{ route('admin.payments.index') }}">
                <span class="material-symbols-outlined">payments</span>
                <span class="font-label-md text-label-md">Konfirmasi Pembayaran</span>
            </a>
            <!-- Revenue -->
            <a class="flex items-center gap-md p-2 rounded-lg transition-all {{ request()->routeIs('admin.revenue') ? 'bg-secondary-container dark:bg-secondary text-on-secondary-container dark:text-on-secondary font-bold scale-98' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-highest dark:hover:bg-inverse-surface' }}" href="{{ route('admin.revenue') }}">
                <span class="material-symbols-outlined">payments</span>
                <span class="font-label-md text-label-md">Revenue</span>
            </a>
            <!-- Profile -->
            <a class="flex items-center gap-md p-2 rounded-lg transition-all {{ request()->routeIs('admin.profile') ? 'bg-secondary-container dark:bg-secondary text-on-secondary-container dark:text-on-secondary font-bold scale-98' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-highest dark:hover:bg-inverse-surface' }}" href="{{ route('admin.profile') }}">
                <span class="material-symbols-outlined">person</span>
                <span class="font-label-md text-label-md">Profile</span>
            </a>
        </nav>
        <div class="mt-auto pt-md border-t border-outline-variant flex flex-col gap-sm">
            <a href="{{ route('admin.profile') }}" class="flex items-center gap-sm px-sm mb-xs hover:opacity-85 transition-opacity">
                <img class="w-10 h-10 rounded-full object-cover border border-secondary" src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user()->name }}">
                <div class="flex flex-col">
                    <span class="font-bold text-xs text-on-surface">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] text-on-surface-variant">Admin</span>
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full text-on-surface-variant dark:text-surface-variant p-2 flex items-center gap-md hover:bg-error-container hover:text-on-error-container rounded-lg transition-colors">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="font-label-md text-label-md">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Canvas -->
    <main class="ml-64 p-gutter max-w-7xl mx-auto min-h-screen">
        @yield('main')
    </main>
@endsection
