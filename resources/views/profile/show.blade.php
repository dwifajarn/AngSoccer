@extends('layouts.user')

@section('title', 'Profil Saya - AngSoccer')

@section('main')
    <!-- Header Profil -->
    <div class="mb-xl text-left">
        <h1 class="font-headline-lg text-headline-lg text-on-background mb-sm font-bold">Profil Saya</h1>
        <p class="text-on-surface-variant font-body-md">Kelola informasi akun dan tinjau riwayat aktivitas Anda.</p>
    </div>

    @if (session('success'))
        <div class="mb-lg p-md bg-secondary-container text-on-secondary-container rounded-lg font-body-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-lg max-w-4xl">
        <!-- User Info Card -->
        <div class="bg-surface-container-lowest p-xl rounded-xl shadow-sm border border-outline-variant">
            <div class="flex flex-col md:flex-row items-center gap-xl">
                <div class="relative">
                    <img class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-md"
                        src="{{ $user->getAvatarUrl() }}" alt="{{ $user->name }}">
                </div>
                <div class="flex-1 text-center md:text-left">
                    <h2 class="font-headline-md text-headline-md text-on-background font-bold">{{ $user->name }}</h2>
                    <p class="text-on-surface-variant mb-md">Member sejak {{ $user->created_at->format('M Y') }}</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-md">
                        <div class="flex items-center gap-sm justify-center md:justify-start text-on-surface">
                            <span class="material-symbols-outlined text-secondary">mail</span>
                            <span class="font-body-md">{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center gap-sm justify-center md:justify-start text-on-surface">
                            <span class="material-symbols-outlined text-secondary">phone</span>
                            <span class="font-body-md">{{ $user->phone ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="bg-surface-container-lowest p-xl rounded-xl shadow-sm border border-outline-variant">
            <h3 class="font-headline-md text-headline-md text-on-background mb-lg font-bold">Ubah Informasi Akun</h3>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-lg">
                @csrf
                <div class="flex flex-col gap-sm">
                    <label class="font-label-md text-label-md text-on-surface" for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary/50 focus:outline-none font-body-md"
                        required>
                    @error('name')
                        <p class="text-error text-caption font-caption">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-sm">
                    <label class="font-label-md text-label-md text-on-surface" for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary/50 focus:outline-none font-body-md"
                        required>
                    @error('email')
                        <p class="text-error text-caption font-caption">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-sm">
                    <label class="font-label-md text-label-md text-on-surface" for="phone">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:ring-2 focus:ring-secondary/50 focus:outline-none font-body-md"
                        required>
                    @error('phone')
                        <p class="text-error text-caption font-caption">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-sm">
                    <label class="font-label-md text-label-md text-on-surface" for="avatar">Foto Profil</label>
                    <input type="file" name="avatar" id="avatar"
                        class="w-full px-md py-sm bg-surface-container-lowest border border-outline-variant rounded-lg focus:outline-none font-body-md">
                    @error('avatar')
                        <p class="text-error text-caption font-caption">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-secondary text-on-secondary px-xl py-sm rounded-lg font-bold font-label-md text-label-md transition-all active:scale-95 hover:bg-secondary/90">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
@endsection
