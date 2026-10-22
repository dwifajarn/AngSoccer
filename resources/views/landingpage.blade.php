<!DOCTYPE html>
<html class="dark" lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>AngSoccer | Platform Booking Lapangan Sepak Bola & Mini Soccer No. 1</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#10b981",
                        "primary-dark": "#059669",
                        "primary-glow": "#34d399",
                        secondary: "#006e1c",
                        background: "#0a0d0a",
                        surface: "#111612",
                        "surface-card": "#161d17",
                        "surface-border": "rgba(255, 255, 255, 0.08)",
                        "on-background": "#f3f4f6",
                        "on-surface-variant": "#9ca3af",
                    },
                    fontFamily: {
                        headline: ["Montserrat", "sans-serif"],
                        body: ["Inter", "sans-serif"]
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0d0a;
            color: #f3f4f6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .font-headline {
            font-family: 'Montserrat', sans-serif;
        }

        .hero-mesh {
            background-image: 
                radial-gradient(circle at 20% 20%, rgba(16, 185, 129, 0.18) 0%, transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(0, 110, 28, 0.22) 0%, transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.05) 0%, transparent 60%);
        }

        .glass-panel {
            background: rgba(22, 29, 23, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-panel:hover {
            border-color: rgba(16, 185, 129, 0.3);
        }

        .primary-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .text-glow {
            text-shadow: 0 0 30px rgba(16, 185, 129, 0.4);
        }

        .pitch-pattern {
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        }
    </style>
</head>

<body class="selection:bg-primary selection:text-black">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full z-50 transition-all duration-300" id="main-nav">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-10 h-10 rounded-xl primary-gradient flex items-center justify-center text-black font-extrabold text-xl shadow-lg shadow-primary/20 group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-[24px]">sports_soccer</span>
                </div>
                <span class="text-2xl font-black tracking-tight text-white font-headline">Ang<span class="text-primary">Soccer</span></span>
            </a>

            <div class="hidden md:flex items-center gap-8 text-sm font-semibold text-gray-300">
                <a href="#home" class="hover:text-primary transition-colors">Home</a>
                <a href="#fields" class="hover:text-primary transition-colors">Lapangan</a>
                <a href="#features" class="hover:text-primary transition-colors">Fitur Unggulan</a>
                <a href="#how-it-works" class="hover:text-primary transition-colors">Cara Booking</a>
                <a href="#faq" class="hover:text-primary transition-colors">FAQ</a>
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('fields.index') }}" class="px-5 py-2.5 rounded-xl primary-gradient text-black font-bold text-sm shadow-md hover:opacity-95 transition-all">
                        Masuk Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-xl text-sm font-semibold text-gray-300 hover:text-white transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl primary-gradient text-black font-bold text-sm shadow-lg shadow-primary/25 hover:opacity-95 transition-all active:scale-95">
                        Daftar Gratis
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen pt-32 pb-20 flex items-center hero-mesh pitch-pattern overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-12 items-center relative z-10">
            <!-- Left Headline -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-panel text-primary text-xs font-bold tracking-wide uppercase">
                    <span class="w-2 h-2 rounded-full bg-primary animate-ping"></span>
                    Platform Booking Lapangan Terpercaya
                </div>

                <h1 class="text-4xl sm:text-6xl font-black text-white leading-tight font-headline tracking-tight">
                    Booking Lapangan <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-primary-glow to-emerald-200 text-glow">
                        Sepak Bola & Mini Soccer
                    </span><br>
                    Tanpa Antre, Cepat & Pasti.
                </h1>

                <p class="text-gray-300 text-base sm:text-lg max-w-xl mx-auto lg:mx-0 leading-relaxed font-body">
                    Pilih lapangan favorit, cek ketersediaan slot jam secara visual, dan kunci jadwal main tim Anda dalam hitungan detik dengan QRIS instan.
                </p>

                <!-- Action CTA -->
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="{{ route('fields.index') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl primary-gradient text-black font-extrabold text-base flex items-center justify-center gap-2 shadow-xl shadow-primary/20 hover:scale-102 transition-all active:scale-95">
                        <span>Pesan Lapangan Sekarang</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                    <a href="#fields" class="w-full sm:w-auto px-8 py-4 rounded-xl glass-panel text-white font-bold text-base hover:bg-white/10 transition-all text-center">
                        Lihat Lapangan Tersedia
                    </a>
                </div>

                <!-- Social Proof Badges -->
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-white/10 max-w-lg mx-auto lg:mx-0">
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-white font-headline">500+</div>
                        <div class="text-xs text-gray-400 mt-0.5">Match Terlaksana</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-primary font-headline">100%</div>
                        <div class="text-xs text-gray-400 mt-0.5">Jadwal Real-Time</div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-white font-headline">4.9/5</div>
                        <div class="text-xs text-gray-400 mt-0.5">Kepuasan Pemain</div>
                    </div>
                </div>
            </div>

            <!-- Right Hero Card / Visual Preview -->
            <div class="lg:col-span-5 relative">
                <div class="relative mx-auto max-w-md">
                    <!-- Glow Behind -->
                    <div class="absolute -inset-4 bg-primary/20 rounded-3xl blur-2xl"></div>

                    <!-- Main Stadium Card -->
                    <div class="relative glass-panel rounded-2xl overflow-hidden p-3 shadow-2xl">
                        <div class="relative h-64 rounded-xl overflow-hidden">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDyW_UDmgqIclhJgJQLG7p0o3goIu_NBgfouZH_mYGWFQNVO4R7MldHQOZz88FHEMzfpsZ9dp6EyH8dibSs12tLw7UtBylBKQCFMoshk05omUsEcoJ_2FXifI8K8Rmgara8KWGtymBWWzsMjzSe2Qt2Ecj5FDq0f41xXYHID2E8jut-DrcTes7yu0yCrphQ9OmZk74u9QFG69654V3x0C2rVbiKMiRIkBdlwRzzYMVPep-Si-1YTw68f9WOAjNEyXxUh1zAj89mfmy6" alt="Mini Soccer Pitch" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute top-3 left-3 bg-primary text-black font-extrabold text-xs px-3 py-1 rounded-full uppercase tracking-wider">
                                Slot Aktif
                            </div>
                            <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end text-white">
                                <div>
                                    <h3 class="font-bold text-lg">Mini Soccer Sintetis A</h3>
                                    <p class="text-xs text-gray-300">Rumput Standar FIFA • Lampu LED</p>
                                </div>
                                <span class="font-extrabold text-primary text-sm">Rp 150.000/jam</span>
                            </div>
                        </div>

                        <!-- Time Slot Quick Grid Mockup -->
                        <div class="p-4 space-y-3">
                            <div class="flex justify-between items-center text-xs font-semibold text-gray-300">
                                <span>Pilihan Jadwal Hari Ini</span>
                                <span class="text-primary flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-primary"></span>
                                    Tersedia
                                </span>
                            </div>

                            <div class="grid grid-cols-4 gap-2 text-xs">
                                <div class="p-2 rounded-lg bg-white/5 border border-white/10 text-center opacity-40">16:00</div>
                                <div class="p-2 rounded-lg bg-white/5 border border-white/10 text-center opacity-40">17:00</div>
                                <div class="p-2 rounded-lg bg-primary/20 border border-primary text-primary font-bold text-center">19:00</div>
                                <div class="p-2 rounded-lg bg-primary text-black font-bold text-center shadow-md">20:00</div>
                            </div>

                            <div class="pt-2 flex items-center justify-between text-xs text-gray-400">
                                <span>Estimasi Konfirmasi: Instant</span>
                                <span class="text-white font-semibold">QRIS Terverifikasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Field Showcase Section -->
    <section id="fields" class="py-24 max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-4">
            <div>
                <span class="text-primary text-xs font-bold uppercase tracking-widest">Pilihan Lapangan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-headline mt-1">Lapangan Pilihan Untuk Performa Terbaik</h2>
                <p class="text-gray-400 text-sm mt-2 max-w-xl">Dari rumput sintetis standar internasional hingga vinyl indoor berstandar turnamen.</p>
            </div>
            <a href="{{ route('fields.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-primary hover:underline">
                Lihat Semua Lapangan <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($featuredFields as $field)
                <div class="glass-panel rounded-2xl overflow-hidden group hover:-translate-y-2 transition-all duration-300 flex flex-col justify-between">
                    <div>
                        <div class="relative h-52 overflow-hidden">
                            <img src="{{ $field->image_url }}" alt="{{ $field->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                            <span class="absolute top-4 left-4 px-3 py-1 bg-black/60 backdrop-blur-md rounded-full text-xs font-bold text-primary uppercase">
                                {{ $field->type }}
                            </span>
                            <span class="absolute bottom-3 left-4 text-xs font-medium text-gray-300 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                {{ $field->location }}
                            </span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white font-headline">{{ $field->name }}</h3>
                            <p class="text-gray-400 text-xs mt-2 line-clamp-2">{{ $field->description }}</p>
                            
                            @php
                                $facilitiesList = is_array($field->facilities) ? $field->facilities : array_filter(array_map('trim', explode(',', (string)$field->facilities)));
                            @endphp
                            @if(!empty($facilitiesList))
                                <div class="flex flex-wrap gap-1.5 mt-4">
                                    @foreach(array_slice($facilitiesList, 0, 3) as $fac)
                                        <span class="text-[11px] font-medium px-2 py-0.5 rounded-md bg-white/5 border border-white/10 text-gray-300">
                                            {{ $fac }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="p-6 pt-0 border-t border-white/5 mt-4 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-gray-400 block uppercase">Harga Sewa</span>
                            <span class="text-lg font-black text-primary font-headline">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}<span class="text-xs text-gray-400 font-normal">/jam</span></span>
                        </div>
                        <a href="{{ route('booking.create', $field->id) }}" class="px-4 py-2 rounded-xl primary-gradient text-black font-extrabold text-xs hover:opacity-90 transition-all">
                            Pesan Slot
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 glass-panel rounded-2xl">
                    <p class="text-gray-400">Belum ada lapangan yang ditampilkan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Features / Bento Grid -->
    <section id="features" class="py-20 bg-surface/50 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-primary text-xs font-bold uppercase tracking-widest">Kenapa AngSoccer?</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-headline mt-1">Teknologi Olahraga Yang Memudahkan Anda</h2>
                <p class="text-gray-400 text-sm mt-2">Didesain khusus untuk para pemain dan pengelola komunitas sepak bola.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-panel p-8 rounded-2xl space-y-4">
                    <div class="w-14 h-14 rounded-xl primary-gradient text-black flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[30px]">schedule</span>
                    </div>
                    <h3 class="text-xl font-bold text-white font-headline">Jadwal Visual Interaktif</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Lihat langsung slot kosong dan terisi secara visual. Tidak perlu lagi chat manual tanya jadwal ke admin.
                    </p>
                </div>

                <div class="glass-panel p-8 rounded-2xl space-y-4">
                    <div class="w-14 h-14 rounded-xl bg-white/10 text-primary flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[30px]">qr_code_2</span>
                    </div>
                    <h3 class="text-xl font-bold text-white font-headline">QRIS Instan & Fleksibel</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Bayar via mobile banking atau e-wallet pilihan Anda. Cepat, tanpa biaya tersembunyi, dan bukti transaksi tersimpan rapi.
                    </p>
                </div>

                <div class="glass-panel p-8 rounded-2xl space-y-4">
                    <div class="w-14 h-14 rounded-xl bg-white/10 text-primary flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[30px]">lock</span>
                    </div>
                    <h3 class="text-xl font-bold text-white font-headline">Anti Bentrok / Double Booking</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Sistem database atomik mengunci slot secara langsung. Tidak ada risiko jadwal Anda tertumpuk dengan tim lain.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 max-w-7xl mx-auto px-6">
        <div class="text-center max-w-xl mx-auto mb-16">
            <span class="text-primary text-xs font-bold uppercase tracking-widest">Alur Mudah</span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white font-headline mt-1">4 Langkah Mulai Bertanding</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="glass-panel p-6 rounded-2xl text-center space-y-4 relative">
                <div class="w-12 h-12 rounded-full primary-gradient text-black font-black text-xl flex items-center justify-center mx-auto">1</div>
                <h4 class="font-bold text-lg text-white font-headline">Pilih Lapangan</h4>
                <p class="text-gray-400 text-xs">Cari lapangan favorit dengan fasilitas dan lokasi yang Anda inginkan.</p>
            </div>

            <div class="glass-panel p-6 rounded-2xl text-center space-y-4 relative">
                <div class="w-12 h-12 rounded-full bg-white/10 text-primary font-black text-xl flex items-center justify-center mx-auto">2</div>
                <h4 class="font-bold text-lg text-white font-headline">Tentukan Waktu</h4>
                <p class="text-gray-400 text-xs">Pilih tanggal dan klik slot jam yang masih hijau di grid visual.</p>
            </div>

            <div class="glass-panel p-6 rounded-2xl text-center space-y-4 relative">
                <div class="w-12 h-12 rounded-full bg-white/10 text-primary font-black text-xl flex items-center justify-center mx-auto">3</div>
                <h4 class="font-bold text-lg text-white font-headline">Bayar QRIS</h4>
                <p class="text-gray-400 text-xs">Scan QRIS lalu upload bukti pembayaran dengan mudah dari smartphone.</p>
            </div>

            <div class="glass-panel p-6 rounded-2xl text-center space-y-4 relative">
                <div class="w-12 h-12 rounded-full bg-white/10 text-primary font-black text-xl flex items-center justify-center mx-auto">4</div>
                <h4 class="font-bold text-lg text-white font-headline">Kick Off!</h4>
                <p class="text-gray-400 text-xs">Tunjukkan konfirmasi booking di lokasi dan nikmati pertandingan tim Anda.</p>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section id="faq" class="py-20 bg-surface/40 border-t border-white/5">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-primary text-xs font-bold uppercase tracking-widest">Tanya Jawab</span>
                <h2 class="text-3xl font-extrabold text-white font-headline mt-1">Pertanyaan Umum (FAQ)</h2>
            </div>

            <div class="space-y-4">
                <details class="glass-panel rounded-xl p-5 group [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-white text-sm">
                        <span>Bagaimana cara melakukan booking lapangan?</span>
                        <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-gray-400 text-xs mt-3 leading-relaxed">
                        Pilih menu "Jadwal Lapangan", tentukan lapangan yang diinginkan, pilih tanggal & jam bermain, kemudian selesaikan proses pembayaran melalui QRIS.
                    </p>
                </details>

                <details class="glass-panel rounded-xl p-5 group [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-white text-sm">
                        <span>Apakah saya bisa membatalkan pesanan jika salah jam?</span>
                        <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-gray-400 text-xs mt-3 leading-relaxed">
                        Bisa! Selama booking masih berstatus pending dan Anda belum mengunggah bukti bayar, Anda dapat menekan tombol "Batal" di halaman Booking Saya untuk melepaskan slot secara instan.
                    </p>
                </details>

                <details class="glass-panel rounded-xl p-5 group [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                    <summary class="flex justify-between items-center font-bold text-white text-sm">
                        <span>Berapa lama batas waktu pembayaran?</span>
                        <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <p class="text-gray-400 text-xs mt-3 leading-relaxed">
                        Batas waktu pembayaran adalah 30 menit sejak booking dibuat. Jika lewat 30 menit tanpa bukti bayar, slot akan otomatis dilepas oleh sistem untuk pemain lain.
                    </p>
                </details>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-white/10 text-center text-xs text-gray-400">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="text-base font-black text-white font-headline">Ang<span class="text-primary">Soccer</span></span>
                <span>• Digitalizing the Pitch</span>
            </div>
            <p>© {{ date('Y') }} AngSoccer. All rights reserved.</p>
        </div>
    </footer>

    <script>
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('main-nav');
            if (window.scrollY > 30) {
                nav.classList.add('bg-black/80', 'backdrop-blur-md', 'border-b', 'border-white/10');
            } else {
                nav.classList.remove('bg-black/80', 'backdrop-blur-md', 'border-b', 'border-white/10');
            }
        });
    </script>
</body>
</html>
