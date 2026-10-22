@extends('layouts.admin')

@section('title', 'Profil Admin - AngSoccer')

@section('main')
    <header class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-black text-white tracking-tight font-headline">Profil Akun Admin</h1>
        <p class="text-xs sm:text-sm text-gray-400 mt-1">Kelola informasi identitas akun dan keamanan kata sandi Anda.</p>
    </header>

    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl flex items-center gap-3 text-emerald-400 text-sm shadow-sm">
            <span class="material-symbols-outlined text-emerald-400 text-[22px]">check_circle</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-12 gap-6">
        <!-- Left Side: Profile Summary Card -->
        <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
            <div class="bg-[#131914] border border-white/10 rounded-2xl p-6 shadow-xl flex flex-col items-center text-center relative overflow-hidden">
                <div class="relative mb-4">
                    <img class="w-28 h-28 rounded-full object-cover border-2 border-emerald-500/40 shadow-xl" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}">
                </div>
                <h3 class="text-xl font-bold text-white font-headline">{{ $user->name }}</h3>
                <span class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest mt-2">
                    {{ strtoupper($user->role) }}
                </span>

                <div class="w-full mt-6 pt-6 border-t border-white/10 flex flex-col gap-3 text-left">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-emerald-400 shrink-0">
                            <span class="material-symbols-outlined text-[18px]">mail</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Email</p>
                            <p class="text-xs font-semibold text-white truncate">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-emerald-400 shrink-0">
                            <span class="material-symbols-outlined text-[18px]">call</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">No. Telepon / WA</p>
                            <p class="text-xs font-semibold text-white">{{ $user->phone ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Edit Form Card -->
        <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
            <section class="bg-[#131914] border border-white/10 rounded-2xl p-6 sm:p-8 shadow-xl">
                <div class="flex items-center gap-2.5 mb-6 border-b border-white/10 pb-4">
                    <span class="material-symbols-outlined text-emerald-400 text-[22px]">badge</span>
                    <h2 class="text-base font-bold text-white font-headline">Informasi Akun</h2>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Nama Lengkap</label>
                            <input name="name" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" type="text" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Role Akses</label>
                            <input class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-gray-500 cursor-not-allowed" disabled type="text" value="{{ ucfirst($user->role) }}">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Email (Akun Utama)</label>
                            <input name="email" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" type="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Nomor HP</label>
                            <input name="phone" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" type="text" value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-1.5 pt-2">
                        <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Ganti Foto Profil</label>
                        <input name="avatar" type="file" class="w-full px-3.5 py-2 bg-black/40 border border-white/10 rounded-xl text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-500/20 file:text-emerald-400 hover:file:bg-emerald-500/30">
                        @error('avatar')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-6 border-t border-white/10 mt-6">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-amber-400 text-[20px]">lock_reset</span>
                            <h3 class="text-sm font-bold text-white font-headline">Ganti Kata Sandi (Opsional)</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Kata Sandi Baru</label>
                                <input name="password" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" type="password" placeholder="Kosongkan jika tidak diubah">
                                @error('password')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1.5">
                                <label class="block text-xs font-bold text-gray-300 uppercase tracking-wider">Konfirmasi Kata Sandi Baru</label>
                                <input name="password_confirmation" class="w-full px-3.5 py-2.5 bg-black/40 border border-white/10 rounded-xl text-xs text-white focus:outline-none focus:border-emerald-500" type="password" placeholder="Ulangi kata sandi baru">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-400 hover:to-emerald-500 text-black font-extrabold rounded-xl text-xs shadow-lg shadow-emerald-500/20 active:scale-95 transition-all flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">save</span>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection
