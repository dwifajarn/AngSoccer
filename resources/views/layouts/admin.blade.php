@extends('layouts.app')

@section('body-class', 'bg-[#0c100d] text-gray-200 min-h-screen font-body antialiased selection:bg-emerald-500 selection:text-black')

@push('styles')
    <style>
        .admin-sidebar {
            background: linear-gradient(180deg, #101611 0%, #0c100d 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }
        .admin-nav-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .admin-nav-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
        }
        .admin-nav-item.active {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.1) 100%);
            border-left: 3px solid #10b981;
            color: #34d399;
            font-weight: 700;
        }
        .admin-nav-item.active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1;
        }
    </style>
@endpush

@section('content')
    <!-- Desktop Sidebar -->
    <aside class="fixed left-0 top-0 h-full w-64 admin-sidebar flex flex-col p-5 z-50">
        <!-- Brand Header -->
        <div class="mb-8 px-2 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-black font-extrabold shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-[22px]">sports_soccer</span>
                </div>
                <div>
                    <h1 class="text-lg font-black tracking-tight text-white font-headline leading-tight">Ang<span class="text-emerald-400">Soccer</span></h1>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-400/80 bg-emerald-500/10 px-1.5 py-0.5 rounded">Admin HQ</span>
                </div>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-grow flex flex-col gap-1.5 overflow-y-auto">
            <!-- Dashboard -->
            <a class="admin-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-400 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Dashboard</span>
            </a>

            <!-- Kelola Lapangan -->
            <a class="admin-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-400 {{ request()->routeIs('admin.lapangan.*') ? 'active' : '' }}" href="{{ route('admin.lapangan.index') }}">
                <span class="material-symbols-outlined text-[20px]">stadium</span>
                <span>Kelola Lapangan</span>
            </a>

            <!-- Konfirmasi Pembayaran -->
            <a class="admin-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-400 {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
                <span class="material-symbols-outlined text-[20px]">payments</span>
                <span>Pembayaran</span>
            </a>

            <!-- Jadwal Operasional -->
            <a class="admin-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-400 {{ request()->routeIs('admin.schedule') ? 'active' : '' }}" href="{{ route('admin.schedule') }}">
                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                <span>Jadwal Operasional</span>
            </a>

            <!-- Revenue -->
            <a class="admin-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-400 {{ request()->routeIs('admin.revenue*') ? 'active' : '' }}" href="{{ route('admin.revenue') }}">
                <span class="material-symbols-outlined text-[20px]">trending_up</span>
                <span>Laporan Revenue</span>
            </a>

            <!-- Profil Admin -->
            <a class="admin-nav-item flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-gray-400 {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
                <span class="material-symbols-outlined text-[20px]">person</span>
                <span>Profil Akun</span>
            </a>
        </nav>

        <!-- Bottom User Card & Logout -->
        <div class="mt-auto pt-4 border-t border-white/10 flex flex-col gap-2">
            <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 p-2 rounded-xl bg-white/[0.03] border border-white/5 hover:border-emerald-500/30 transition-all">
                <img class="w-9 h-9 rounded-full object-cover border border-emerald-500/40" src="{{ auth()->user()->getAvatarUrl() }}" alt="{{ auth()->user()->name }}">
                <div class="flex flex-col min-w-0 flex-1">
                    <span class="font-bold text-xs text-white truncate">{{ auth()->user()->name }}</span>
                    <span class="text-[10px] text-emerald-400 font-medium">Super Admin</span>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full text-xs font-bold text-red-400 hover:text-red-300 p-2.5 flex items-center justify-center gap-2 hover:bg-red-500/10 rounded-xl transition-all">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="ml-64 p-6 sm:p-8 max-w-7xl mx-auto min-h-screen">
        @yield('main')
    </main>
@endsection
