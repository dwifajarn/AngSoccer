@extends('layouts.admin')

@section('title', 'Profil Admin - AngSoccer')

@section('main')
    <header class="mb-10">
        <h2 class="text-3xl font-bold text-black tracking-tight font-headline">Profil Admin</h2>
        <p class="text-black mt-1 font-body">Kelola informasi pribadi dan pengaturan keamanan akun Anda.</p>
    </header>

    @if(session('success'))
        <div class="mb-lg p-md bg-secondary-container text-on-secondary-container rounded-lg font-body-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-12 gap-lg">
        <div class="col-span-12 lg:col-span-4 flex flex-col gap-6">
            <div class="bg-white rounded-xl p-8 shadow-[0px_4px_20px_rgba(26,28,30,0.08)] flex flex-col items-center text-center relative overflow-hidden border border-surface-container-high">
                <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(#000000 1px, transparent 1px); background-size: 20px 20px;"></div>
                <div class="relative mb-6">
                    <img class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md shadow-slate-200" src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}">
                </div>
                <h3 class="text-2xl font-bold text-black font-headline">{{ $user->name }}</h3>
                <span class="bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest mt-2 font-label">{{ strtoupper($user->role) }}</span>
                
                <div class="w-full mt-8 pt-8 border-t border-surface-container-high flex flex-col gap-4">
                    <div class="flex items-center gap-4 text-left">
                        <div class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-label">Email</p>
                            <p class="font-medium text-black font-body">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 text-left">
                        <div class="w-10 h-10 rounded-full bg-surface-container-low flex items-center justify-center text-secondary">
                            <span class="material-symbols-outlined">call</span>
                        </div>
                        <div>
                            <p class="text-xs text-on-surface-variant font-label">Telepon</p>
                            <p class="font-medium text-black font-body">{{ $user->phone ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
            <section class="bg-white rounded-xl p-8 shadow-[0px_4px_20px_rgba(26,28,30,0.08)] border border-surface-container-high">
                <div class="flex items-center gap-3 mb-8">
                    <span class="material-symbols-outlined text-secondary">badge</span>
                    <h3 class="text-xl font-bold text-black font-headline">Informasi Akun</h3>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-label text-black">Nama Lengkap</label>
                        <input name="name" class="w-full bg-surface-container-low border-none rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary transition-all text-black" type="text" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="text-error text-caption font-caption">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-label text-black">Role Akses</label>
                        <input class="w-full bg-surface-container-low border-none rounded-md px-4 py-3 opacity-60 cursor-not-allowed text-black" disabled type="text" value="{{ ucfirst($user->role) }}">
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-label text-black">Alamat Email</label>
                        <input name="email" class="w-full bg-surface-container-low border-none rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary transition-all text-black" type="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="text-error text-caption font-caption">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-label text-black">Nomor Telepon</label>
                        <input name="phone" class="w-full bg-surface-container-low border-none rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary transition-all text-black" type="tel" value="{{ old('phone', $user->phone) }}" required>
                        @error('phone')
                            <p class="text-error text-caption font-caption">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-full flex flex-col gap-2">
                        <label class="text-sm font-label text-black">Foto Profil</label>
                        <input name="avatar" type="file" class="w-full bg-surface-container-low border border-outline-variant rounded-md px-4 py-2 text-black">
                        @error('avatar')
                            <p class="text-error text-caption font-caption">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-full flex flex-col gap-2">
                        <label class="text-sm font-label text-black">Alamat Kantor</label>
                        <textarea class="w-full bg-surface-container-low border-none rounded-md px-4 py-3 focus:ring-2 focus:ring-secondary transition-all text-black" rows="3">Jl. Atletik No. 45, Kompleks Olahraga Senayan, Jakarta Pusat</textarea>
                    </div>
                    <div class="col-span-full">
                        <button type="submit" class="bg-secondary text-on-secondary text-white px-xl py-sm rounded-lg font-bold font-label-md text-label-md transition-all active:scale-95 hover:bg-secondary/90">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection