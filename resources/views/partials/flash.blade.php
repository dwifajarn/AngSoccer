{{-- Floating Flash Toast Notifications --}}
@if (session('success') || session('error') || session('status') || $errors->any())
    <div id="flash-notification-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 max-w-md w-full pointer-events-none transition-all duration-300">
        @if (session('success'))
            <div class="pointer-events-auto bg-[#121813]/95 border border-emerald-500/30 text-white p-4 rounded-2xl shadow-2xl backdrop-blur-xl flex items-start gap-3 animate-in fade-in slide-in-from-top-4 duration-300">
                <div class="w-9 h-9 rounded-xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 shrink-0">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="font-bold text-sm text-emerald-400">Berhasil!</p>
                    <p class="text-xs text-gray-300 mt-0.5 leading-relaxed">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="this.closest('.pointer-events-auto').remove()" class="text-gray-400 hover:text-white transition-colors p-1" aria-label="Tutup">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="pointer-events-auto bg-[#1a1214]/95 border border-red-500/30 text-white p-4 rounded-2xl shadow-2xl backdrop-blur-xl flex items-start gap-3 animate-in fade-in slide-in-from-top-4 duration-300">
                <div class="w-9 h-9 rounded-xl bg-red-500/20 border border-red-500/40 flex items-center justify-center text-red-400 shrink-0">
                    <span class="material-symbols-outlined text-[20px]">error</span>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="font-bold text-sm text-red-400">Terjadi Kesalahan</p>
                    <p class="text-xs text-gray-300 mt-0.5 leading-relaxed">{{ session('error') }}</p>
                </div>
                <button type="button" onclick="this.closest('.pointer-events-auto').remove()" class="text-gray-400 hover:text-white transition-colors p-1" aria-label="Tutup">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if (session('status'))
            <div class="pointer-events-auto bg-[#121813]/95 border border-emerald-500/30 text-white p-4 rounded-2xl shadow-2xl backdrop-blur-xl flex items-start gap-3 animate-in fade-in slide-in-from-top-4 duration-300">
                <div class="w-9 h-9 rounded-xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 shrink-0">
                    <span class="material-symbols-outlined text-[20px]">info</span>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="font-bold text-sm text-emerald-400">Informasi</p>
                    <p class="text-xs text-gray-300 mt-0.5 leading-relaxed">{{ session('status') }}</p>
                </div>
                <button type="button" onclick="this.closest('.pointer-events-auto').remove()" class="text-gray-400 hover:text-white transition-colors p-1" aria-label="Tutup">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if ($errors->any() && !request()->routeIs('login') && !request()->routeIs('register'))
            <div class="pointer-events-auto bg-[#1a1214]/95 border border-red-500/30 text-white p-4 rounded-2xl shadow-2xl backdrop-blur-xl flex items-start gap-3 animate-in fade-in slide-in-from-top-4 duration-300">
                <div class="w-9 h-9 rounded-xl bg-red-500/20 border border-red-500/40 flex items-center justify-center text-red-400 shrink-0">
                    <span class="material-symbols-outlined text-[20px]">warning</span>
                </div>
                <div class="flex-1 pt-0.5">
                    <p class="font-bold text-sm text-red-400">Perhatian</p>
                    <ul class="text-xs text-gray-300 mt-1 list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" onclick="this.closest('.pointer-events-auto').remove()" class="text-gray-400 hover:text-white transition-colors p-1" aria-label="Tutup">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const container = document.getElementById('flash-notification-container');
                if (container) {
                    container.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(() => container.remove(), 500);
                }
            }, 5000);
        });
    </script>
@endif
