@extends('layouts.user')

@section('title', 'Profil Saya - AngSoccer')

@section('main')
    <!-- Header Profil -->
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Profil Akun Saya</h1>
        <p class="text-xs sm:text-sm text-gray-400 mt-1">Kelola data profil, informasi kontak, dan foto akun Anda.</p>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-sm shadow-sm">
            <span class="material-symbols-outlined text-emerald-400 text-[22px]">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-12 gap-8 max-w-5xl">
        <!-- User Info Hero Card -->
        <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
            <div class="bg-[#131914] border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl flex flex-col items-center text-center">
                <div class="relative mb-4">
                    <img class="w-28 h-28 rounded-full object-cover border-2 border-emerald-500/50 shadow-xl" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}">
                </div>
                <h2 class="text-xl font-bold text-white font-headline">{{ $user->name }}</h2>
                <span class="mt-2 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    {{ strtoupper($user->role) }} MEMBER
                </span>

                <div class="w-full mt-6 pt-6 border-t border-white/10 flex flex-col gap-3 text-left text-xs">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-emerald-400 shrink-0">
                            <span class="material-symbols-outlined text-[18px]">mail</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Email</p>
                            <p class="font-semibold text-white truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-emerald-400 shrink-0">
                            <span class="material-symbols-outlined text-[18px]">call</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">No. Telepon</p>
                            <p class="font-semibold text-white">{{ $user->phone ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-emerald-400 shrink-0">
                            <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Bergabung</p>
                            <p class="font-semibold text-white">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
            <div class="bg-[#131914] border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl">
                <div class="flex items-center gap-2.5 mb-6 pb-4 border-b border-white/10">
                    <span class="material-symbols-outlined text-emerald-400 text-[22px]">manage_accounts</span>
                    <h3 class="text-base font-bold text-white font-headline">Ubah Informasi Akun</h3>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 font-body transition-all" required>
                        @error('name')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="email">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 font-body transition-all" required>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="phone">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500 font-body transition-all">
                        @error('phone')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-1.5 pt-2">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider" for="avatar">Ganti Foto Profil</label>
                        <input type="file" name="avatar" id="avatar" class="w-full px-3.5 py-2 bg-black/40 border border-white/10 rounded-xl text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-500/20 file:text-emerald-400 hover:file:bg-emerald-500/30">
                        @error('avatar')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold rounded-xl text-xs shadow-lg shadow-emerald-500/20 active:scale-95 transition-all flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">save</span>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
