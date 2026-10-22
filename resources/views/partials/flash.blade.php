{{-- Floating Flash Notifications --}}
@if (session('success') || session('error') || session('status') || $errors->any())
    <div id="flash-notification-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-sm max-w-md w-full pointer-events-none transition-all">
        @if (session('success'))
            <div class="pointer-events-auto bg-surface-container-lowest border-l-4 border-secondary p-md rounded-xl shadow-xl flex items-start gap-md animate-in fade-in slide-in-from-top-4 duration-200">
                <span class="material-symbols-outlined text-secondary text-[24px]">check_circle</span>
                <div class="flex-1">
                    <p class="font-bold text-sm text-on-surface">Berhasil!</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="pointer-events-auto bg-surface-container-lowest border-l-4 border-error p-md rounded-xl shadow-xl flex items-start gap-md animate-in fade-in slide-in-from-top-4 duration-200">
                <span class="material-symbols-outlined text-error text-[24px]">error</span>
                <div class="flex-1">
                    <p class="font-bold text-sm text-error">Terjadi Kesalahan</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">{{ session('error') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if (session('status'))
            <div class="pointer-events-auto bg-surface-container-lowest border-l-4 border-secondary p-md rounded-xl shadow-xl flex items-start gap-md animate-in fade-in slide-in-from-top-4 duration-200">
                <span class="material-symbols-outlined text-secondary text-[24px]">info</span>
                <div class="flex-1">
                    <p class="font-bold text-sm text-on-surface">Informasi</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">{{ session('status') }}</p>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-on-surface">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        @if ($errors->any() && !request()->routeIs('login') && !request()->routeIs('register'))
            <div class="pointer-events-auto bg-surface-container-lowest border-l-4 border-error p-md rounded-xl shadow-xl flex items-start gap-md animate-in fade-in slide-in-from-top-4 duration-200">
                <span class="material-symbols-outlined text-error text-[24px]">warning</span>
                <div class="flex-1">
                    <p class="font-bold text-sm text-error">Perhatian</p>
                    <ul class="text-xs text-on-surface-variant mt-0.5 list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-on-surface">
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
