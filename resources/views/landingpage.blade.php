<!DOCTYPE html>

<html class="dark" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>AngSoccer | Premium Soccer Field Booking</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-container": "#4e5051",
                        "on-tertiary": "#2f3131",
                        "secondary-fixed": "#e5e2e1",
                        "on-primary-fixed": "#002201",
                        "primary": "#a1d494",
                        "on-primary": "#0a3909",
                        "primary-fixed-dim": "#a1d494",
                        "on-tertiary-fixed": "#1a1c1c",
                        "on-background": "#e2e3dc",
                        "on-tertiary-fixed-variant": "#454747",
                        "surface-tint": "#a1d494",
                        "tertiary-fixed-dim": "#c6c6c7",
                        "on-secondary": "#313030",
                        "inverse-on-surface": "#2e312c",
                        "inverse-primary": "#3b6934",
                        "tertiary": "#c6c6c7",
                        "secondary-fixed-dim": "#c8c6c5",
                        "surface-dim": "#111410",
                        "outline": "#8c9387",
                        "primary-container": "#2d5a27",
                        "on-surface-variant": "#c2c9bb",
                        "on-secondary-fixed-variant": "#474646",
                        "surface-variant": "#333631",
                        "surface-container": "#1d201c",
                        "on-primary-fixed-variant": "#23501e",
                        "secondary": "#c8c6c5",
                        "surface": "#111410",
                        "primary-fixed": "#bcf0ae",
                        "secondary-container": "#4a4949",
                        "on-primary-container": "#9dd090",
                        "surface-container-low": "#191c18",
                        "on-error": "#690005",
                        "surface-bright": "#373a35",
                        "on-secondary-container": "#bab8b7",
                        "on-secondary-fixed": "#1c1b1b",
                        "tertiary-fixed": "#e2e2e2",
                        "on-tertiary-container": "#c2c2c3",
                        "error": "#ffb4ab",
                        "on-surface": "#e2e3dc",
                        "surface-container-highest": "#333631",
                        "surface-container-lowest": "#0c0f0b",
                        "outline-variant": "#42493e",
                        "on-error-container": "#ffdad6",
                        "surface-container-high": "#282b26",
                        "background": "#111410",
                        "error-container": "#93000a",
                        "inverse-surface": "#e2e3dc"
                    },
                    "borderRadius": {
                        "DEFAULT": "1rem",
                        "lg": "2rem",
                        "xl": "3rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "stack-sm": "12px",
                        "stack-lg": "48px",
                        "section-padding": "120px",
                        "container-max": "1280px",
                        "gutter": "24px",
                        "stack-md": "24px",
                        "base": "8px"
                    },
                    "fontFamily": {
                        "headline-xl-mobile": ["Montserrat"],
                        "label-bold": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "headline-md": ["Montserrat"],
                        "body-md": ["Montserrat"],
                        "headline-lg": ["Montserrat"],
                        "headline-xl": ["Montserrat"],
                        "caption": ["Montserrat"]
                    },
                    "fontSize": {
                        "headline-xl-mobile": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "800"
                        }],
                        "label-bold": ["14px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "headline-md": ["32px", {
                            "lineHeight": "40px",
                            "fontWeight": "700"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }],
                        "headline-xl": ["64px", {
                            "lineHeight": "72px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "800"
                        }],
                        "caption": ["12px", {
                            "lineHeight": "16px",
                            "fontWeight": "500"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            backdrop-filter: blur(30px);
            border: 1px solid rgba(161, 212, 148, 0.4);
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px -10px rgba(161, 212, 148, 0.15);
        }

        .primary-gradient {
            background: linear-gradient(135deg, #a1d494 0%, #bcf0ae 100%);
            position: relative;
            overflow: hidden;
        }

        .primary-gradient::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to bottom right,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0) 40%,
                    rgba(255, 255, 255, 0.4) 50%,
                    rgba(255, 255, 255, 0) 60%,
                    rgba(255, 255, 255, 0) 100%);
            transform: rotate(45deg);
            transition: all 0.7s;
            opacity: 0;
        }

        .primary-gradient:hover::after {
            opacity: 1;
            left: 100%;
            top: 100%;
        }

        .glow-effect {
            position: relative;
        }

        .glow-effect::before {
            content: '';
            position: absolute;
            top: -10%;
            left: -10%;
            width: 40%;
            height: 40%;
            background: radial-gradient(circle, rgba(161, 212, 148, 0.1) 0%, transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-answer.open {
            max-height: 200px;
        }

        #hero-parallax {
            will-change: transform;
            transition: transform 0.1s ease-out;
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md scroll-smooth selection:bg-primary selection:text-on-primary">
    <!-- TopNavBar -->
    <nav class="fixed top-0 w-full z-50 bg-white/0 backdrop-blur-[0px] border-b border-transparent transition-all duration-500"
        id="navbar">
        <div class="max-w-container-max mx-auto px-gutter py-4 flex justify-between items-center">
            <div class="font-headline-md text-headline-md font-bold text-primary tracking-tighter cursor-pointer"
                onclick="window.scrollTo({top: 0, behavior: 'smooth'})">AngSoccer</div>
            <div class="hidden md:flex items-center gap-8">
                <a class="font-label-bold text-label-bold text-primary border-b-2 border-primary pb-1 transition-colors duration-200"
                    href="#home">Home</a>
                <a class="font-label-bold text-label-bold text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#about">Tentang Kami</a>
                <a class="font-label-bold text-label-bold text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#fields">Lapangan</a>
                <a class="font-label-bold text-label-bold text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#testimonials">Testimoni</a>
                <a class="font-label-bold text-label-bold text-on-surface-variant hover:text-primary transition-colors duration-200"
                    href="#faq">FAQ</a>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('fields.index') }}"
                        class="font-label-bold text-label-bold px-6 py-2 rounded-full primary-gradient text-on-primary hover:opacity-90 transition-all active:scale-95 duration-200">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-label-bold text-label-bold px-6 py-2 rounded-full border border-white/20 text-on-background hover:bg-white/10 transition-all active:scale-95 duration-200">Login</a>
                    <a href="{{ route('register') }}"
                        class="font-label-bold text-label-bold px-6 py-2 rounded-full primary-gradient text-on-primary font-bold shadow-lg shadow-primary/20 hover:opacity-90 active:scale-95 transition-all duration-200">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-24 overflow-hidden" id="home">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-background via-background/60 to-transparent z-10"></div>
            <img alt="Hero background soccer field"
                class="w-[110%] h-[110%] -top-[5%] -left-[5%] object-cover opacity-60 absolute" id="hero-parallax"
                src="https://lh3.googleusercontent.com/aida/AP1WRLumIhbSUy71egoLHlAIhk7E34T_zQh9R4Nl4nzg8pDSixkxhnW0A6etltt4Up4vWdp_5aVxUzKISWd8NvPt1mVigiTBixr5CO-yyIMSc7eWmaKCn_TphygbxKXC9A5ekCGiTAoFD2jxYl8JQmcs3ImcugnbQLgoaXm-QglN7GkzUj79NcjR9jb_KmX1yupjUxESVhyX-I3dF5bI6aKZ0Cb-uvcn4LFdYCZlOn9Xun6liV_pprz850wffDQ" />
        </div>
        <div class="relative z-20 max-w-container-max mx-auto px-gutter w-full grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-stack-lg">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    <span class="text-primary font-label-bold text-caption uppercase tracking-widest">Platform No. 1 di
                        Indonesia</span>
                </div>
                <h1 class="font-headline-xl text-headline-xl text-on-background leading-none">
                    Booking Lapangan <br />
                    <span class="text-primary">Sepak Bola</span> <br />
                    Jadi Lebih Mudah
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg">
                    Pesan lapangan favorit Anda kapan saja dan di mana saja melalui AngSoccer. Teknologi presisi untuk
                    pengalaman olahraga terbaik.
                </p>
                <div class="flex flex-wrap gap-stack-md pt-4">
                    @auth
                        <a href="{{ route('fields.index') }}"
                            class="primary-gradient text-on-primary font-bold px-8 py-4 rounded-full font-label-bold text-label-bold flex items-center gap-2 hover:shadow-xl hover:shadow-primary/30 transition-all active:scale-95 justify-center">
                            Booking Sekarang
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="primary-gradient text-on-primary font-bold px-8 py-4 rounded-full font-label-bold text-label-bold flex items-center gap-2 hover:shadow-xl hover:shadow-primary/30 transition-all active:scale-95 justify-center">
                            Booking Sekarang
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    @endauth
                    <a href="#fields"
                        class="border-1.5 border-white/30 text-on-background px-8 py-4 rounded-full font-label-bold text-label-bold hover:bg-white/5 transition-all active:scale-95 text-center inline-block">
                        Lihat Lapangan
                    </a>
                </div>
                <!-- Stats HUD -->
                <div class="grid grid-cols-3 gap-8 pt-12 border-t border-white/10">
                    <div>
                        <div class="text-primary font-headline-md text-headline-md">500+</div>
                        <div class="text-on-surface-variant text-caption font-label-bold uppercase">Lapangan</div>
                    </div>
                    <div>
                        <div class="text-primary font-headline-md text-headline-md">10k+</div>
                        <div class="text-on-surface-variant text-caption font-label-bold uppercase">Pemain Aktif</div>
                    </div>
                    <div>
                        <div class="text-primary font-headline-md text-headline-md">24/7</div>
                        <div class="text-on-surface-variant text-caption font-label-bold uppercase">Layanan</div>
                    </div>
                </div>
            </div>
            <!-- Visual Floating HUD Elements -->
            <div class="hidden md:block relative">
                <div
                    class="glass-card p-6 rounded-lg absolute top-0 right-0 w-64 transform translate-x-12 -translate-y-12">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full primary-gradient flex items-center justify-center">
                            <span class="material-symbols-outlined text-on-primary">stadium</span>
                        </div>
                        <div>
                            <div class="text-on-background font-label-bold">PITCH PERFECT</div>
                            <div class="text-primary text-caption">Available Now</div>
                        </div>
                    </div>
                    <div class="h-1 rounded-full bg-surface-variant overflow-hidden">
                        <div class="h-full bg-primary w-3/4"></div>
                    </div>
                </div>
                <div
                    class="glass-card p-4 rounded-lg absolute bottom-0 left-0 w-56 transform -translate-x-8 translate-y-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-on-surface-variant text-caption">Booking ID</span>
                        <span class="text-primary font-label-bold">#28910</span>
                    </div>
                    <div class="text-on-background font-headline-md text-headline-md">20:00</div>
                    <div class="text-on-surface-variant text-caption">Main Field • Dec 12</div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section -->
    <section class="py-section-padding bg-surface-dim reveal" id="about">
        <div class="max-w-container-max mx-auto px-gutter">
            <div class="grid md:grid-cols-2 gap-24 items-center">
                <div class="relative group">
                    <div
                        class="absolute -inset-4 bg-primary/10 rounded-lg blur-xl opacity-50 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="rounded-lg overflow-hidden relative border border-white/10">
                        <img alt="Modern Soccer Stadium"
                            class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDyW_UDmgqIclhJgJQLG7p0o3goIu_NBgfouZH_mYGWFQNVO4R7MldHQOZz88FHEMzfpsZ9dp6EyH8dibSs12tLw7UtBylBKQCFMoshk05omUsEcoJ_2FXifI8K8Rmgara8KWGtymBWWzsMjzSe2Qt2Ecj5FDq0f41xXYHID2E8jut-DrcTes7yu0yCrphQ9OmZk74u9QFG69654V3x0C2rVbiKMiRIkBdlwRzzYMVPep-Si-1YTw68f9WOAjNEyXxUh1zAj89mfmy6" />
                    </div>
                </div>
                <div class="space-y-stack-md">
                    <span class="text-primary font-label-bold uppercase tracking-widest text-caption">Tentang
                        Kami</span>
                    <h2 class="font-headline-lg text-headline-lg text-on-background leading-tight">Elevasi Performa Anda
                        Dengan <span class="text-primary">AngSoccer</span></h2>
                    <p class="text-on-surface-variant text-body-lg leading-relaxed">
                        Kami adalah pionir sports-tech yang menghubungkan komunitas sepak bola dengan infrastruktur
                        terbaik. Dengan platform kami, setiap aspek dari pencarian hingga pembayaran dioptimalkan untuk
                        efisiensi atletik yang maksimal.
                    </p>
                    <div class="grid gap-6 pt-8">
                        <div class="glass-card p-6 rounded-lg glow-effect flex gap-4 items-start">
                            <div
                                class="w-12 h-12 shrink-0 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">schedule</span>
                            </div>
                            <div>
                                <h3 class="text-on-background font-headline-md text-body-lg mb-1">Booking Online 24/7
                                </h3>
                                <p class="text-on-surface-variant text-body-md">Akses penuh kapan saja tanpa hambatan
                                    jam operasional kantor.</p>
                            </div>
                        </div>
                        <div class="glass-card p-6 rounded-lg glow-effect flex gap-4 items-start">
                            <div
                                class="w-12 h-12 shrink-0 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">payments</span>
                            </div>
                            <div>
                                <h3 class="text-on-background font-headline-md text-body-lg mb-1">Pembayaran Mudah</h3>
                                <p class="text-on-surface-variant text-body-md">Mendukung QRIS instan secara aman.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Bento Grid -->
    <section class="py-section-padding reveal" id="fields">
        <div class="max-w-container-max mx-auto px-gutter text-center mb-16">
            <span class="text-primary font-label-bold uppercase tracking-widest text-caption">Fitur Utama</span>
            <h2 class="font-headline-lg text-headline-lg mt-4">Solusi Menyeluruh Untuk Tim Anda</h2>
        </div>
        <div class="max-w-container-max mx-auto px-gutter grid md:grid-cols-4 grid-rows-2 gap-6 md:h-[600px]">
            <div
                class="glass-card md:col-span-2 md:row-span-2 p-10 rounded-lg flex flex-col justify-end relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-t from-background to-transparent z-10"></div>
                <img alt="Soccer fields"
                    class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuC1vwCyEjSDI3tb_Z2NfBHU9hP_ph8V_DRAnvWbS2byVvZtgb_XDXqncm6YP-owKvknP75O45Jrt6qcmgFy-0-ofOc7Qi4SmkRR5vxCj1_AENDVciy1acI0zrantw9M0rIAKjsPmGUqCrqrYIUBxJFx5UVTmNrVouSqvLOFjO2Z_IVHgmalnzEkGFc2wsHuG8dvtUKE4yBBstSq49xLGc09QmIejoAOUA7UQOE-K3_eqE8xckoCEbFN792sLtJt-dqMBndNAwKSd4hd" />
                <div class="relative z-20">
                    <div class="w-16 h-16 rounded-lg primary-gradient flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-on-primary text-headline-md">search</span>
                    </div>
                    <h3 class="text-headline-md text-on-background mb-4">Cari Lapangan Terdekat</h3>
                    <p class="text-on-surface-variant max-w-sm">Temukan lapangan berkualitas terbaik di sekitar lokasi
                        Anda dengan filter fasilitas premium.</p>
                </div>
            </div>
            <div class="glass-card md:col-span-2 p-10 rounded-lg flex items-center gap-8 group">
                <div class="flex-1">
                    <h3 class="text-headline-md text-on-background mb-2">Booking Instan</h3>
                    <p class="text-on-surface-variant">Konfirmasi slot Anda hanya dalam beberapa klik. Tanpa perlu
                        menelpon atau menunggu balasan admin.</p>
                </div>
                <div
                    class="w-24 h-24 shrink-0 rounded-full border-2 border-primary/20 flex items-center justify-center group-hover:rotate-12 transition-transform duration-500">
                    <span class="material-symbols-outlined text-primary text-headline-lg"
                        style="font-variation-settings: 'FILL' 1;">event_available</span>
                </div>
            </div>
            <div class="glass-card p-8 rounded-lg flex flex-col justify-between group">
                <div
                    class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-500">
                    <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-body-lg text-on-background mb-2">Pembayaran Aman</h3>
                    <p class="text-on-surface-variant text-caption">Sistem enkripsi untuk semua transaksi keuangan
                        Anda.</p>
                </div>
            </div>
            <div class="glass-card p-8 rounded-lg flex flex-col justify-between group">
                <div
                    class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center group-hover:bg-primary/20 transition-colors duration-500">
                    <span class="material-symbols-outlined text-primary">verified_user</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-body-lg text-on-background mb-2">Konfirmasi Cepat</h3>
                    <p class="text-on-surface-variant text-caption">Detail pesanan dikirim otomatis ke dashboard akun
                        Anda.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- How It Works (Timeline) -->
    <section class="py-section-padding bg-surface-container-low reveal">
        <div class="max-w-container-max mx-auto px-gutter">
            <div class="text-center mb-24">
                <h2 class="font-headline-lg text-headline-lg">Langkah Mudah Bermain</h2>
            </div>
            <div class="relative">
                <div
                    class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-surface-variant -translate-y-1/2 z-0">
                </div>
                <div class="grid md:grid-cols-4 gap-12 relative z-10">
                    <div class="flex flex-col items-center text-center space-y-6 group">
                        <div
                            class="w-20 h-20 rounded-full primary-gradient border-8 border-background flex items-center justify-center text-on-primary font-bold text-headline-md transition-transform group-hover:scale-110">
                            1</div>
                        <div>
                            <h4 class="font-headline-md text-body-lg text-on-background">Cari Lapangan</h4>
                            <p class="text-on-surface-variant text-body-md">Pilih lokasi sesuai area Anda</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-6 group">
                        <div
                            class="w-20 h-20 rounded-full glass-card border-8 border-background flex items-center justify-center text-primary font-bold text-headline-md transition-transform group-hover:scale-110">
                            2</div>
                        <div>
                            <h4 class="font-headline-md text-body-lg text-on-background">Pilih Jadwal</h4>
                            <p class="text-on-surface-variant text-body-md">Tentukan waktu main favorit</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-6 group">
                        <div
                            class="w-20 h-20 rounded-full glass-card border-8 border-background flex items-center justify-center text-primary font-bold text-headline-md transition-transform group-hover:scale-110">
                            3</div>
                        <div>
                            <h4 class="font-headline-md text-body-lg text-on-background">Lakukan Pembayaran</h4>
                            <p class="text-on-surface-variant text-body-md">Proses cepat dan beragam pilihan</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center space-y-6 group">
                        <div
                            class="w-20 h-20 rounded-full glass-card border-8 border-background flex items-center justify-center text-primary font-bold text-headline-md transition-transform group-hover:scale-110">
                            4</div>
                        <div>
                            <h4 class="font-headline-md text-body-lg text-on-background">Main Sepak Bola</h4>
                            <p class="text-on-surface-variant text-body-md">Datang dan tunjukkan performa!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials -->
    <section class="py-section-padding reveal" id="testimonials">
        <div class="max-w-container-max mx-auto px-gutter">
            <div class="text-center mb-16">
                <span class="text-primary font-label-bold uppercase tracking-widest text-caption">Testimoni</span>
                <h2 class="font-headline-lg text-headline-lg mt-4">Apa Kata Mereka?</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="glass-card p-10 rounded-lg relative">
                    <span
                        class="material-symbols-outlined text-primary text-headline-xl absolute top-8 right-8 opacity-20">format_quote</span>
                    <div class="flex items-center gap-4 mb-8">
                        <img alt="Budi Santoso" class="w-14 h-14 rounded-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDqUhCl9FS1eAoaN3qYh5CHCtrrqMnAEn1EPs3aGMN5noaJQf_RXdLh0Vz___wR34SpFsEKLrL3derEoZCiHGE6JSAviYL_BXpf4eIGJ3ZYPCPqydDEzj3CYxs5kx7m-y3ZMl65G4GvKT7WYxf9Kpto5x3HRxQgn6j_WP0CJWMwGob6r0sPy3J-squuoGjgqdKCd3Jv0BT21_tlOQJWNE3ovyk85dzJ9g5fDrkpluPpVxI_A60lRxClhTM14_HDnTgPaA6Dk4M-FIGE" />
                        <div>
                            <div class="font-label-bold text-on-background">Budi Santoso</div>
                            <div class="text-caption text-on-surface-variant">Kapten Tim Garuda</div>
                        </div>
                    </div>
                    <p class="text-on-background text-body-md italic leading-relaxed">"AngSoccer benar-benar mengubah
                        cara tim kami mengelola jadwal tanding. Sistem pembayarannya sangat praktis."</p>
                    <div class="flex gap-1 mt-6 text-primary">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                </div>
                <div class="glass-card p-10 rounded-lg relative">
                    <span
                        class="material-symbols-outlined text-primary text-headline-xl absolute top-8 right-8 opacity-20">format_quote</span>
                    <div class="flex items-center gap-4 mb-8">
                        <img alt="Ahmad Rizky" class="w-14 h-14 rounded-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqIow3O3isN570QEuQ8dDugtZ-fIYbRuL5XEyvtBKMi8_GTaEIxOmpMeTx9OfkCJHKMgWm3XBrIYUd_5MvODC4HvWoon7dlm-pyfX_SIoII6Oe8rYsw0c99oKEXMUusgtDBH03G5NlBv7_XmsMG-W41C571TIqoQSQuADhcpGjxHiDqetZNrAFNgfhRweiLPDlkE5fK8tgaE3HhryBTwGzWlhFOJzvfydQSoXdZcgnK5O5o4uFthZvQVlp295w_4aJZISJldN2f4-A" />
                        <div>
                            <div class="font-label-bold text-on-background">Ahmad Rizky</div>
                            <div class="text-caption text-on-surface-variant">Pelatih Akademi</div>
                        </div>
                    </div>
                    <p class="text-on-background text-body-md italic leading-relaxed">"Sangat membantu saya dalam
                        mencari lapangan yang sesuai standar untuk latihan akademi."</p>
                    <div class="flex gap-1 mt-6 text-primary">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                </div>
                <div class="glass-card p-10 rounded-lg relative">
                    <span
                        class="material-symbols-outlined text-primary text-headline-xl absolute top-8 right-8 opacity-20">format_quote</span>
                    <div class="flex items-center gap-4 mb-8">
                        <img alt="Dimas Pratama" class="w-14 h-14 rounded-full object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIQi6FUbriqwRj90JIQaj5mjo3Cilv5vToFtnUKSmJd9vtEpRrvKrOXRrNLrIAIWwlW32QaCJXfBdb7ZknXuIvRb7AMpvMA9L8mpzy8Gn8Tb5gmJ9cP6NonjDhs60hsjLu-ndV0k1iWv3AJG2hqRsxk_4sZv3T6UjmP9_9s2riXXxcaYN3blRGJ2a0WapRqT-pnFxbcf_eomTTNw4J4psfH_LkWfeBE-noXdwQCQf8x4h2XF5QhykyM3_Av7FvoeZg6E9LUKE2MoyD" />
                        <div>
                            <div class="font-label-bold text-on-background">Dimas Pratama</div>
                            <div class="text-caption text-on-surface-variant">Pemain Amatir</div>
                        </div>
                    </div>
                    <p class="text-on-background text-body-md italic leading-relaxed">"Sekarang lewat AngSoccer, mau
                        main jam 12 malam pun bisa langsung booking dan konfirmasi instan."</p>
                    <div class="flex gap-1 mt-6 text-primary">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- FAQ Accordion -->
    <section class="py-section-padding bg-surface-dim reveal" id="faq">
        <div class="max-w-3xl mx-auto px-gutter">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg">Pertanyaan Umum</h2>
            </div>
            <div class="space-y-4">
                <div class="glass-card rounded-lg overflow-hidden">
                    <button class="w-full p-6 flex justify-between items-center text-left hover:bg-white/5 group"
                        onclick="toggleAccordion(this)">
                        <span class="font-label-bold text-on-background">Bagaimana cara melakukan booking
                            lapangan?</span>
                        <span class="material-symbols-outlined transition-transform duration-500">expand_more</span>
                    </button>
                    <div class="faq-answer px-6">
                        <div class="pb-6 text-on-surface-variant">
                            Untuk melakukan booking, silakan pilih lapangan yang tersedia, tentukan tanggal dan jam
                            bermain, lalu lakukan pembayaran sesuai instruksi yang diberikan. Setelah pembayaran
                            dikonfirmasi, status booking akan berubah menjadi "Terkonfirmasi".
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-lg overflow-hidden">
                    <button class="w-full p-6 flex justify-between items-center text-left hover:bg-white/5 group"
                        onclick="toggleAccordion(this)">
                        <span class="font-label-bold text-on-background">Apakah saya harus memiliki akun untuk
                            melakukan booking?</span>
                        <span class="material-symbols-outlined transition-transform duration-500">expand_more</span>
                    </button>
                    <div class="faq-answer px-6">
                        <div class="pb-6 text-on-surface-variant">
                            Ya. Pengguna harus mendaftar dan login terlebih dahulu agar dapat melakukan booking, melihat
                            riwayat pemesanan, dan mengunggah bukti pembayaran.
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-lg overflow-hidden">
                    <button class="w-full p-6 flex justify-between items-center text-left hover:bg-white/5 group"
                        onclick="toggleAccordion(this)">
                        <span class="font-label-bold text-on-background">Bagaimana cara mengetahui ketersediaan
                            lapangan?</span>
                        <span class="material-symbols-outlined transition-transform duration-500">expand_more</span>
                    </button>
                    <div class="faq-answer px-6">
                        <div class="pb-6 text-on-surface-variant">
                            Ketersediaan lapangan dapat dilihat pada halaman jadwal booking. Slot yang sudah dipesan
                            tidak dapat dipilih oleh pengguna lain.
                        </div>
                    </div>
                </div>
                <div class="glass-card rounded-lg overflow-hidden">
                    <button class="w-full p-6 flex justify-between items-center text-left hover:bg-white/5 group"
                        onclick="toggleAccordion(this)">
                        <span class="font-label-bold text-on-background">Metode pembayaran apa yang tersedia?</span>
                        <span class="material-symbols-outlined transition-transform duration-500">expand_more</span>
                    </button>
                    <div class="faq-answer px-6">
                        <div class="pb-6 text-on-surface-variant">
                            Saat ini pembayaran dilakukan melalui transfer bank atau metode pembayaran yang disediakan
                            oleh pengelola. Setelah melakukan pembayaran, pengguna wajib mengunggah bukti pembayaran.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Final CTA Section -->
    <section class="py-section-padding px-gutter reveal">
        <div
            class="max-w-container-max mx-auto primary-gradient rounded-xl p-12 md:p-24 relative overflow-hidden text-center group">
            <div
                class="absolute -top-24 -left-24 w-64 h-64 bg-white/20 rounded-full blur-3xl transition-transform duration-1000 group-hover:scale-150">
            </div>
            <div
                class="absolute -bottom-24 -right-24 w-64 h-64 bg-black/10 rounded-full blur-3xl transition-transform duration-1000 group-hover:scale-150">
            </div>
            <div class="relative z-10">
                <h2 class="font-headline-xl text-headline-xl text-on-primary mb-8 leading-tight">Siap Bermain Hari Ini?
                </h2>
                <p class="text-on-primary/80 font-body-lg text-body-lg max-w-2xl mx-auto mb-12">
                    Jangan biarkan lawan Anda mengambil slot favorit. Daftar sekarang dan mulai petualangan sepak bola
                    Anda dengan platform tercanggih.
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ route('fields.index') }}"
                            class="bg-on-primary text-primary font-bold px-10 py-5 rounded-full font-label-bold text-label-bold transition-all hover:scale-105 active:scale-95 shadow-xl hover:shadow-black/20 inline-block text-center">
                            Booking Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-on-primary text-primary font-bold px-10 py-5 rounded-full font-label-bold text-label-bold transition-all hover:scale-105 active:scale-95 shadow-xl hover:shadow-black/20 inline-block text-center">
                            Booking Sekarang
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-transparent border-2 border-on-primary text-on-primary font-bold px-10 py-5 rounded-full font-label-bold text-label-bold transition-all hover:bg-on-primary/10 active:scale-95 inline-block text-center">
                            Daftar Gratis
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="w-full bg-surface-container-lowest border-t border-outline-variant">
        <div class="max-w-container-max mx-auto px-gutter py-stack-lg">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-2">
                    <div class="font-headline-md text-headline-md font-bold text-primary mb-6">AngSoccer</div>
                    <p class="text-on-surface-variant text-body-md max-w-sm mb-6">
                        Penyedia platform booking lapangan olahraga tercanggih di Indonesia. Menggabungkan teknologi dan
                        semangat olahraga.
                    </p>
                </div>
                <div>
                    <h4 class="text-on-background font-label-bold mb-6">Navigasi</h4>
                    <ul class="space-y-4 text-on-surface-variant font-body-md">
                        <li><a class="hover:text-primary transition-colors" href="#about">Tentang Kami</a></li>
                        <li><a class="hover:text-primary transition-colors" href="#fields">Lapangan</a></li>
                        <li><a class="hover:text-primary transition-colors" href="#testimonials">Testimoni</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-on-background font-label-bold mb-6">Bantuan</h4>
                    <ul class="space-y-4 text-on-surface-variant font-body-md">
                        <li><a class="hover:text-primary transition-colors" href="#faq">Pusat Bantuan</a></li>
                        <li><a class="hover:text-primary transition-colors" href="#">Daftarkan Lapangan</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-outline-variant text-center">
                <p class="text-caption font-caption text-on-surface-variant">© 2024 AngSoccer. All rights reserved.
                    High-performance sports-tech.</p>
            </div>
        </div>
    </footer>
    <script>
        // Scroll-Triggered Reveals
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Hero Parallax Effect
        const heroImage = document.getElementById('hero-parallax');
        document.addEventListener('mousemove', (e) => {
            const x = (window.innerWidth / 2 - e.pageX) / 40;
            const y = (window.innerHeight / 2 - e.pageY) / 40;
            heroImage.style.transform = `translate(${x}px, ${y}px)`;
        });

        // Navigation Scroll Behavior & Blur Intensity
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            const scrollPercent = Math.min(window.scrollY / 200, 1);
            navbar.style.backgroundColor = `rgba(255, 255, 255, ${scrollPercent * 0.05})`;
            navbar.style.backdropFilter = `blur(${scrollPercent * 20}px)`;
            navbar.style.borderBottomColor = `rgba(255, 255, 255, ${scrollPercent * 0.15})`;

            if (window.scrollY > 50) {
                navbar.classList.add('py-2');
                navbar.classList.remove('py-4');
            } else {
                navbar.classList.remove('py-2');
                navbar.classList.add('py-4');
            }
        });

        // Smooth Scroll for all anchors
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // FAQ Micro-interactions
        function toggleAccordion(button) {
            const answer = button.nextElementSibling;
            const icon = button.querySelector('.material-symbols-outlined');

            const isOpen = answer.classList.contains('open');

            // Close other items
            document.querySelectorAll('.faq-answer.open').forEach(el => {
                el.classList.remove('open');
                el.previousElementSibling.querySelector('.material-symbols-outlined').style.transform =
                    'rotate(0deg)';
            });

            if (!isOpen) {
                answer.classList.add('open');
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.remove('open');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>

</html>
