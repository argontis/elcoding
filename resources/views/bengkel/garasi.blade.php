<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garasi Saya (Member) — Rekam Medis &amp; Telemetri Mobil | {{ $workshop['name'] }}</title>
    <meta name="description" content="Dashboard Garasi Member MotoPro Workshop. Pantau rekam medis digital komponen mobil, odometer terhubung OBD-II, sisa umur oli mesin, kampas rem, dan riwayat servis cloud.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        motoblue: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#1d4ed8',
                            700: '#1e40af',
                            800: '#1e3a8a',
                            900: '#172554',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Pulse live indicator */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 0.3; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-live {
            animation: pulse-ring 2s infinite ease-in-out;
        }

        /* Circular radial meter */
        .progress-circle {
            transition: stroke-dashoffset 0.6s ease;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        .car-card-active {
            border-color: #3b82f6 !important;
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.12), 0 8px 10px -6px rgba(59, 130, 246, 0.08);
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- ========================================================= -->
    <!-- 1. TOP ANNOUNCEMENT BAR (Live Workshop Status & Drop Pass) -->
    <!-- ========================================================= -->
    <div class="bg-[#0b0f19] text-xs text-slate-300 border-b border-slate-800 py-2.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3 font-medium">
            <!-- Left: Status Bengkel & Jam Operasional -->
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-2 bg-emerald-950/80 text-emerald-400 border border-emerald-500/30 px-2.5 py-0.5 rounded-full text-[11px] font-semibold tracking-wide">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    BENGKEL AKTIF ({{ $workshop['jam_buka'] }})
                </span>
                <span class="hidden md:inline-block text-slate-600">•</span>
                <div class="hidden sm:flex items-center gap-1.5 text-slate-300">
                    <i class="fa-solid fa-warehouse text-blue-400 text-xs"></i>
                    <span>Stall Kapasitas: <strong class="text-white font-bold">{{ $workshop['stall_terisi'] }} Terisi</strong> / <span class="text-emerald-400 font-bold">1 Siap Masuk</span></span>
                </div>
            </div>

            <!-- Right: State Switcher Helper (Data Kosong vs Data Demo) -->
            <div class="flex items-center gap-3 text-xs">
                @if($isDemo)
                    <div class="flex items-center gap-2 bg-amber-500/10 border border-amber-500/30 text-amber-300 px-2.5 py-0.5 rounded-full text-[11px] font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                        <span>Mode Data Demo (Pratinjau Desain)</span>
                    </div>
                    <a href="{{ route('bengkel.garasi.page') }}" class="text-slate-300 hover:text-white underline text-[11px] font-medium transition">
                        Beralih ke Data Kosong
                    </a>
                @else
                    <div class="flex items-center gap-2 bg-blue-500/10 border border-blue-500/30 text-blue-300 px-2.5 py-0.5 rounded-full text-[11px] font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                        <span>Mode Garasi: Data Kosong (Clean)</span>
                    </div>
                    <a href="{{ route('bengkel.garasi.page', ['demo' => 1]) }}" class="text-amber-300 hover:text-amber-200 font-bold text-[11px] transition flex items-center gap-1">
                        <i class="fa-solid fa-eye text-xs"></i>
                        <span>Lihat Data Demo (Agus Setiawan)</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 2. MAIN HEADER & NAVBAR -->
    <!-- ========================================================= -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-3.5 flex items-center justify-between gap-4">
            
            <!-- Brand Logo -->
            <a href="{{ url('/bengkel') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/20 group-hover:bg-blue-700 transition">
                    <i class="fa-solid fa-car-side text-lg"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-heading font-extrabold text-xl sm:text-2xl tracking-tight text-slate-900">MotoPro</span>
                        <span class="text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-700 px-1.5 py-0.5 rounded border border-slate-200">Workshop</span>
                    </div>
                    <p class="text-[10px] text-slate-500 font-semibold tracking-wider uppercase -mt-0.5">Automotive Precision Care</p>
                </div>
            </a>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden lg:flex items-center gap-6 text-sm font-semibold text-slate-600">
                <a href="{{ url('/bengkel') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Beranda &amp; Layanan</span>
                </a>
                <a href="{{ route('bengkel.booking.page') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Booking Servis Cepat</span>
                </a>
                <a href="{{ route('bengkel.tracking.page') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Live Tracking Servis</span>
                </a>
                <a href="{{ route('bengkel.garasi.page') }}" class="bg-slate-900 text-white px-3.5 py-1.5 rounded-lg font-bold flex items-center gap-1.5 shadow-2xs">
                    <span>Garasi Saya (Member)</span>
                </a>
            </nav>

            <!-- Quick Plat Search & Action Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Stall Status Pill -->
                <a href="{{ route('bengkel.stall.page') }}" class="hidden xl:flex items-center gap-1.5 bg-blue-50/80 hover:bg-blue-100 text-blue-700 border border-blue-200/60 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $workshop['status_bengkel'] }}</span>
                </a>

                <!-- Quick Plate Search in Header -->
                <form action="{{ route('bengkel.lacak') }}" method="POST" class="hidden md:flex items-center relative">
                    @csrf
                    <div class="relative">
                        <input type="text" name="plat_nomor" placeholder="Cek Plat Nomor (B 1234 CD)..." 
                            class="w-48 lg:w-56 bg-slate-100/90 text-slate-800 placeholder-slate-400 text-xs font-mono font-semibold py-2 pl-8 pr-3 rounded-lg border border-slate-200 focus:bg-white focus:w-60 focus:border-blue-500 focus:outline-none transition-all">
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    </div>
                </form>

                <!-- Guest Access Button -->
                <a href="{{ route('bengkel.booking.page') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition border border-slate-200">
                    <i class="fa-regular fa-user text-slate-500 text-xs"></i>
                    <span>AKSES TAMU</span>
                </a>

                <!-- Member / Garasi Active Indicator -->
                <div class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-bold text-white bg-slate-900 rounded-lg shadow-sm">
                    <i class="fa-solid fa-shield-halved text-blue-400 text-xs"></i>
                    <span class="hidden sm:inline">Masuk / Daftar</span>
                    <span>Garasi Member</span>
                    <i class="fa-solid fa-circle-user text-slate-300 ml-0.5"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- ========================================================= -->
    <!-- 3. TOP BANNER NOTICE (DATA KOSONG vs DATA DEMO) -->
    <!-- ========================================================= -->
    @if(!$isDemo)
        <div class="bg-gradient-to-r from-blue-50 via-indigo-50/60 to-blue-50 border-b border-blue-200/70 py-3 px-4 sm:px-8">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2.5 text-blue-900">
                    <div class="w-6 h-6 rounded-lg bg-blue-600 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-info text-[11px]"></i>
                    </div>
                    <div>
                        <strong class="font-bold text-blue-950">Tampilan Awal Garasi Member (Data Masih Kosong).</strong>
                        <span class="text-blue-800">Saat ini belum ada mobil atau riwayat servis terdaftar. Tambahkan kendaraan pertama Anda atau muat data demo untuk melihat preview desain lengkap.</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" onclick="openAddCarModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-3.5 rounded-lg text-xs transition flex items-center gap-1.5 shadow-xs">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>+ Tambah Mobil</span>
                    </button>
                    <a href="{{ route('bengkel.garasi.page', ['demo' => 1]) }}" class="bg-white hover:bg-blue-50 text-blue-700 border border-blue-300 font-bold py-1.5 px-3.5 rounded-lg text-xs transition flex items-center gap-1.5">
                        <i class="fa-solid fa-play text-[10px]"></i>
                        <span>Muat Data Demo</span>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="bg-gradient-to-r from-amber-50 via-orange-50/50 to-amber-50 border-b border-amber-200 py-3 px-4 sm:px-8">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                <div class="flex items-center gap-2.5 text-amber-950">
                    <div class="w-6 h-6 rounded-lg bg-amber-500 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-bolt text-[11px]"></i>
                    </div>
                    <div>
                        <strong class="font-bold text-amber-950">Pratinjau Desain Aktif (Data Demo Agus Setiawan).</strong>
                        <span class="text-amber-900">Menampilkan simulasi Innova Zenix &amp; HR-V, telemetri sensor OBD-II, dan riwayat servis digital lengkap sesuai desain acuan.</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('bengkel.garasi.page') }}" class="bg-white hover:bg-amber-100/60 text-amber-900 border border-amber-300 font-bold py-1.5 px-3.5 rounded-lg text-xs transition flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate-left text-[10px]"></i>
                        <span>Kembali ke Data Kosong</span>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================================= -->
    <!-- 4. MAIN GARASI CONTAINER -->
    <!-- ========================================================= -->
    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-6 w-full space-y-6">

        <!-- ===================================================== -->
        <!-- 4.1 MEMBER HEADER PROFILE CARD -->
        <!-- ===================================================== -->
        @if($isDemo && $member)
            <!-- FILLED STATE (DEMO) -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-5">
                
                <!-- Left: Avatar, Name & Member Badge -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-slate-900 text-white flex items-center justify-center font-heading font-extrabold text-xl tracking-wider shadow-md">
                            {{ $member['initial'] }}
                        </div>
                        <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px] border-2 border-white shadow-xs">
                            <i class="fa-solid fa-check"></i>
                        </span>
                    </div>

                    <div>
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h1 class="font-heading font-extrabold text-xl sm:text-2xl text-slate-900 tracking-tight">
                                {{ $member['name'] }}
                            </h1>
                            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-200 text-[11px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wide">
                                <i class="fa-solid fa-shield text-[10px]"></i>
                                {{ $member['tier'] }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-1">
                            Member sejak {{ $member['since'] }} &bull; ID Member: <span class="font-mono font-bold text-slate-700">{{ $member['member_id'] }}</span>
                        </p>
                    </div>
                </div>

                <!-- Right: Loyalty Points & Action Buttons -->
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Loyalty Points Card -->
                    <div class="bg-blue-50/70 border border-blue-200/80 rounded-xl px-4 py-2.5 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-blue-600 text-white flex items-center justify-center shadow-xs">
                            <i class="fa-solid fa-coins text-sm"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-blue-900 block font-mono">LOYALTY POINTS</span>
                            <div class="flex items-baseline gap-1.5">
                                <strong class="font-heading font-extrabold text-lg text-blue-700">{{ $member['points_fmt'] }}</strong>
                                <span class="text-[11px] text-slate-500">(= {{ $member['discount_eq'] }})</span>
                            </div>
                        </div>
                    </div>

                    <!-- Account Buttons -->
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="showSwitchAccountModal()" class="px-3.5 py-2 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-arrows-rotate text-xs text-slate-500"></i>
                            <span>Beralih Akun</span>
                        </button>
                        <a href="{{ route('bengkel.landing') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold text-slate-600 hover:text-slate-900 bg-white hover:bg-slate-50 border border-slate-200 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-arrow-right-from-bracket text-xs text-slate-400"></i>
                            <span>Keluar ke Mode Tamu</span>
                        </a>
                    </div>
                </div>

            </div>
        @else
            <!-- EMPTY STATE (DATA KOSONG) -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-5">
                
                <!-- Left: Unregistered Avatar & Status -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 border border-slate-200 flex items-center justify-center text-xl">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-slate-400 text-white flex items-center justify-center text-[9px] border-2 border-white">
                            <i class="fa-solid fa-minus"></i>
                        </span>
                    </div>

                    <div>
                        <div class="flex flex-wrap items-center gap-2.5">
                            <h1 class="font-heading font-extrabold text-xl sm:text-2xl text-slate-900 tracking-tight">
                                Mode Tamu / Garasi Baru
                            </h1>
                            <span class="inline-flex items-center gap-1.5 bg-slate-100 text-slate-600 border border-slate-200 text-[11px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wide font-mono">
                                AKUN BELUM TERHUBUNG
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium mt-1">
                            Silakan masuk atau daftarkan nomor telepon Anda untuk menghubungkan data servis &amp; riwayat poin kendaraan.
                        </p>
                    </div>
                </div>

                <!-- Right: 0 Loyalty Points & Login/Demo Actions -->
                <div class="flex flex-wrap items-center gap-4">
                    <div class="bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-slate-200 text-slate-600 flex items-center justify-center">
                            <i class="fa-solid fa-coins text-sm"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 block font-mono">LOYALTY POINTS</span>
                            <div class="flex items-baseline gap-1.5">
                                <strong class="font-heading font-extrabold text-lg text-slate-700">0 Pts</strong>
                                <span class="text-[11px] text-slate-400">(= Rp 0 Diskon)</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" onclick="openLoginModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 transition flex items-center gap-1.5 shadow-xs">
                            <i class="fa-solid fa-key text-xs text-blue-400"></i>
                            <span>Masuk / Daftar Akun</span>
                        </button>
                        <a href="{{ route('bengkel.garasi.page', ['demo' => 1]) }}" class="px-3.5 py-2 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 transition flex items-center gap-1.5">
                            <i class="fa-solid fa-play text-xs"></i>
                            <span>Contoh Data</span>
                        </a>
                    </div>
                </div>

            </div>
        @endif

        <!-- ===================================================== -->
        <!-- 4.2 VOUCHER & BENEFIT CARDS (2 Columns) -->
        <!-- ===================================================== -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            
            @if($isDemo && count($vouchers) >= 2)
                <!-- CARD 1: VOUCHER KUPON (FILLED DEMO) -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-xl bg-slate-900 text-white flex items-center justify-center shrink-0 text-base font-bold">
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono block">VOUCHER KUPON</span>
                            <h3 class="font-heading font-extrabold text-base text-slate-900">Diskon Servis 10%</h3>
                            <p class="text-[11px] text-slate-500 mt-0.5">Berlaku untuk Jasa Servis &amp; Tune Up &bull; Exp: 30 Des 2025</p>
                        </div>
                    </div>
                    <button type="button" onclick="useVoucher('Diskon Servis 10%')" class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2 rounded-xl transition shrink-0 cursor-pointer">
                        Gunakan
                    </button>
                </div>

                <!-- CARD 2: BENEFIT MEMBER (FILLED DEMO) -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 text-base">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600 font-mono block">BENEFIT MEMBER</span>
                            <h3 class="font-heading font-extrabold text-base text-slate-900">Gratis Spooring Roda 3D</h3>
                            <p class="text-[11px] text-slate-500 mt-0.5">1x penukaran garansi kalibrasi sudut suspensi</p>
                        </div>
                    </div>
                    <button type="button" onclick="claimBenefit('Gratis Spooring Roda 3D')" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition shrink-0 cursor-pointer shadow-xs">
                        Klaim
                    </button>
                </div>
            @else
                <!-- CARD 1: VOUCHER KUPON (EMPTY STATE) -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center shrink-0 text-base font-bold">
                            <i class="fa-solid fa-ticket"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono block">VOUCHER KUPON</span>
                            <h3 class="font-heading font-extrabold text-base text-slate-700">Belum Ada Kupon Aktif</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Selesaikan servis perdana untuk mendapatkan kupon diskon jasa 10%.</p>
                        </div>
                    </div>
                    <a href="{{ route('bengkel.booking.page') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold px-3.5 py-2 rounded-xl transition shrink-0 border border-slate-200">
                        Cek Promo
                    </a>
                </div>

                <!-- CARD 2: BENEFIT MEMBER (EMPTY STATE) -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center shrink-0 text-base">
                            <i class="fa-solid fa-award"></i>
                        </div>
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono block">BENEFIT MEMBER</span>
                            <h3 class="font-heading font-extrabold text-base text-slate-700">Benefit Siap Diaktifkan</h3>
                            <p class="text-[11px] text-slate-400 mt-0.5">Dapatkan benefit gratis Spooring 3D setelah mendaftarkan kendaraan pertama.</p>
                        </div>
                    </div>
                    <button type="button" onclick="openAddCarModal()" class="bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold px-3.5 py-2 rounded-xl transition shrink-0 border border-blue-200">
                        Daftar Mobil
                    </button>
                </div>
            @endif

        </div>

        <!-- ===================================================== -->
        <!-- 4.3 SECTION: ARMADA TERDAFTAR (GARASI SAYA UNIT AKTIF) -->
        <!-- ===================================================== -->
        <section class="space-y-4">
            <!-- Section Header -->
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600 font-mono">ARMADA TERDAFTAR</span>
                    <h2 class="font-heading font-extrabold text-2xl text-slate-900 tracking-tight">
                        Garasi Saya (Unit Aktif)
                    </h2>
                </div>

                <button type="button" onclick="openAddCarModal()" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-blue-600 hover:text-blue-700 bg-white hover:bg-blue-50 border border-blue-200 transition shadow-2xs">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Tambah Mobil ke Garasi</span>
                </button>
            </div>

            @if($isDemo && count($vehicles) > 0)
                <!-- VEHICLES GRID (FILLED DEMO STATE) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                    
                    <!-- UNIT 1 (SELECTED / AKTIF DIPILIH): TOYOTA INNOVA ZENIX -->
                    <div id="unit-zenix" class="lg:col-span-7 bg-white rounded-2xl p-5 sm:p-6 border-2 border-blue-500 shadow-md shadow-blue-500/10 flex flex-col justify-between relative transition-all">
                        
                        <!-- Top Bar inside Card -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="bg-slate-900 text-white text-[10px] font-bold font-mono px-2.5 py-1 rounded-md tracking-wider uppercase">
                                UNIT DIPILIH
                            </span>

                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-blue-700 bg-blue-50 border border-blue-200 px-2.5 py-0.5 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                    <span>OBD-II Terkoneksi</span>
                                </span>
                            </div>
                        </div>

                        <!-- Card Body (Image + Details) -->
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-5 items-center">
                            <!-- Car Image with Year Badge -->
                            <div class="sm:col-span-5 relative rounded-xl overflow-hidden bg-slate-100 border border-slate-200 aspect-[4/3] group">
                                <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&w=800&q=80" 
                                     alt="Toyota Innova Zenix" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute bottom-2 left-2 bg-slate-900/80 backdrop-blur-xs text-white text-[10px] font-mono font-bold px-2 py-0.5 rounded">
                                    Tahun 2023
                                </span>
                            </div>

                            <!-- Car Specs & Plate -->
                            <div class="sm:col-span-7 space-y-3">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600 font-mono block">
                                        MPV PREMIUM &bull; TRANSMISI CVT
                                    </span>
                                    <h3 class="font-heading font-extrabold text-xl text-slate-900 mt-0.5">
                                        Toyota Innova Zenix 2.0 V
                                    </h3>
                                    <p class="text-[11px] text-slate-400 font-mono mt-0.5 truncate">
                                        Nomor Rangka: MHFA40G29P0021948
                                    </p>
                                </div>

                                <!-- Plate & Odo Box -->
                                <div class="grid grid-cols-2 gap-3 pt-2 border-t border-slate-100">
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-bold block uppercase font-mono">PLAT NOMOR</span>
                                        <strong class="font-heading font-extrabold text-lg text-slate-900 block font-mono">
                                            B 1408 WKR
                                        </strong>
                                    </div>
                                    <div>
                                        <span class="text-[10px] text-slate-400 font-bold block uppercase font-mono">ODOMETER REALTIME</span>
                                        <strong class="font-heading font-extrabold text-lg text-blue-600 block font-mono">
                                            39.850 <span class="text-xs font-normal">KM</span>
                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="mt-5 pt-3.5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-regular fa-clock text-slate-400 text-[11px]"></i>
                                <span>Servis terakhir: <strong>15 Jan 2025</strong></span>
                            </span>

                            <a href="#telemetri-section" class="text-blue-600 hover:text-blue-700 font-bold flex items-center gap-1 transition">
                                <span>Dipantau Aktif</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>

                    </div>

                    <!-- UNIT 2 (SECONDARY): HONDA HR-V -->
                    <div id="unit-hrv" class="lg:col-span-5 bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-2xs flex flex-col justify-between transition-all">
                        
                        <!-- Top Bar inside Card -->
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono block">
                                COMPACT SUV
                            </span>

                            <button type="button" onclick="selectCarUnit('hrv')" class="text-[11px] font-bold text-blue-600 hover:text-blue-700 transition">
                                Ganti Unit
                            </button>
                        </div>

                        <!-- Card Body (Image + Details) -->
                        <div class="space-y-4">
                            <!-- Car Image with Year Badge -->
                            <div class="relative rounded-xl overflow-hidden bg-slate-100 border border-slate-200 aspect-[16/9] group">
                                <img src="https://images.unsplash.com/photo-1590362891988-f778047831d6?auto=format&fit=crop&w=800&q=80" 
                                     alt="Honda HR-V" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                <span class="absolute bottom-2 left-2 bg-slate-900/80 backdrop-blur-xs text-white text-[10px] font-mono font-bold px-2 py-0.5 rounded">
                                    Tahun 2022
                                </span>
                            </div>

                            <div>
                                <h3 class="font-heading font-extrabold text-lg text-slate-900">
                                    Honda HR-V 1.5 SE CVT
                                </h3>
                                <p class="text-xs text-slate-500 font-mono mt-0.5">
                                    B 2099 JKP &bull; 24.120 KM
                                </p>
                            </div>

                            <div class="bg-emerald-50/70 border border-emerald-200/60 rounded-xl p-2.5 flex items-center gap-2 text-xs text-emerald-800">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i>
                                <span>Status Komponen: <strong>Semua Sensor Normal (Siap Pakai)</strong></span>
                            </div>
                        </div>

                        <!-- Card Action -->
                        <div class="mt-5 pt-3.5 border-t border-slate-100">
                            <button type="button" onclick="selectCarUnit('hrv')" class="w-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 py-2.5 px-4 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                                <span>Pilih Mobil Ini</span>
                            </button>
                        </div>

                    </div>

                </div>
            @else
                <!-- EMPTY GARAGE STATE (DATA KOSONG) -->
                <div class="bg-white rounded-2xl p-8 sm:p-14 border border-dashed border-slate-300 text-center shadow-2xs space-y-4">
                    <div class="w-20 h-20 rounded-3xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto border border-blue-100">
                        <i class="fa-solid fa-warehouse text-3xl"></i>
                    </div>

                    <div class="max-w-md mx-auto">
                        <h3 class="font-heading font-extrabold text-xl text-slate-900">
                            Garasi Digital Anda Masih Kosong
                        </h3>
                        <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">
                            Belum ada unit kendaraan yang didaftarkan ke sistem garasi MotoPro. Daftarkan kendaraan Anda untuk memantau kilometer realtime, status wear &amp; tear oli, filter, rem, dan aki otomatis.
                        </p>
                    </div>

                    <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                        <button type="button" onclick="openAddCarModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition flex items-center gap-2 shadow-md shadow-blue-500/20 cursor-pointer">
                            <i class="fa-solid fa-plus text-xs"></i>
                            <span>+ Daftarkan Mobil Pertama Anda</span>
                        </button>
                        <a href="{{ route('bengkel.garasi.page', ['demo' => 1]) }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-4 rounded-xl text-xs transition border border-slate-200 flex items-center gap-2">
                            <i class="fa-solid fa-eye text-xs text-blue-600"></i>
                            <span>Pratinjau Data Penuh (Demo)</span>
                        </a>
                    </div>
                </div>
            @endif

        </section>

        <!-- ===================================================== -->
        <!-- 4.4 SECTION: TELEMETRI WEAR & TEAR (REKAM MEDIS KOMPONEN) -->
        <!-- ===================================================== -->
        <section id="telemetri-section" class="space-y-4 pt-2">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-600 font-mono">
                        <i class="fa-solid fa-heart-pulse text-xs"></i>
                        <span>TELEMETRI WEAR &amp; TEAR</span>
                    </span>
                    <h2 class="font-heading font-extrabold text-2xl text-slate-900 tracking-tight">
                        Rekam Medis Digital Komponen
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        @if($isDemo && $telemetry)
                            {{ $telemetry['vehicle_summary'] }}
                        @else
                            Data kalkulasi wear &amp; tear membutuhkan unit mobil aktif yang terdaftar di garasi.
                        @endif
                    </p>
                </div>

                <div>
                    <a href="{{ route('bengkel.booking.page') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold py-2.5 px-4 rounded-xl shadow-md shadow-blue-500/20 transition">
                        <i class="fa-solid fa-bolt text-amber-300 text-xs"></i>
                        <span>Booking Servis Cepat untuk Mobil Ini (Auto-Fill Data)</span>
                    </a>
                </div>
            </div>

            @if($isDemo && $telemetry)
                <!-- FILLED TELEMETRY DATA (SESUAI SCREENSHOT) -->
                
                <!-- WhatsApp Telemetry Trigger Banner -->
                <div class="bg-gradient-to-r from-[#0b1329] via-[#0f1f42] to-[#0b1329] text-white rounded-2xl p-4 sm:p-5 border border-blue-900/60 shadow-lg flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-600/30">
                            <i class="fa-solid fa-comment-sms text-lg"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="bg-blue-500 text-white text-[10px] font-bold font-mono px-2 py-0.5 rounded uppercase tracking-wider">
                                    PENGINGAT OTOMATIS AKTIF
                                </span>
                                <span class="text-xs font-bold text-slate-200">WhatsApp Telemetri</span>
                            </div>
                            <p class="text-xs text-slate-300 mt-1">
                                Notifikasi WhatsApp akan otomatis dikirim ke nomor <strong class="text-white">{{ $telemetry['wa_reminder']['phone'] }}</strong> saat KM mencapai <strong class="text-white">{{ $telemetry['wa_reminder']['target_km'] }}</strong> ({{ $telemetry['wa_reminder']['est_time'] }}).
                            </p>
                        </div>
                    </div>

                    <div class="shrink-0">
                        <span class="inline-block bg-slate-900/90 border border-slate-700 text-slate-300 text-xs font-mono font-bold px-3 py-1.5 rounded-lg">
                            {{ $telemetry['wa_reminder']['trigger'] }}
                        </span>
                    </div>
                </div>

                <!-- 4 COMPONENT WEAR & TEAR CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    
                    <!-- COMPONENT 1: OLI MESIN (TMO FULL SYN) -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-sm border border-rose-100">
                                    <i class="fa-solid fa-oil-can"></i>
                                </div>
                                <span class="bg-rose-50 text-rose-600 border border-rose-200 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full font-mono">
                                    PERLU GANTI SEGERA
                                </span>
                            </div>

                            <h4 class="font-heading font-bold text-sm text-slate-900">Oli Mesin (TMO Full Syn)</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">Viskositas SAE 0W-20 SN GF-5</p>

                            <!-- Progress Bar -->
                            <div class="mt-4 space-y-1.5">
                                <div class="flex justify-between text-xs font-mono">
                                    <strong class="text-slate-900 font-bold">4.850 / 5.000 KM</strong>
                                    <span class="text-rose-600 font-bold">97% Terpakai</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-rose-500 h-2 rounded-full" style="width: 97%;"></div>
                                </div>
                            </div>

                            <!-- Alert Warning Box -->
                            <div class="mt-3.5 p-2 bg-rose-50 border border-rose-100 rounded-lg text-rose-700 text-[11px] font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-triangle-exclamation text-rose-600 text-xs"></i>
                                <span>Sisa 150 KM / Waktunya Ganti Oli!</span>
                            </div>
                        </div>

                        <div class="mt-5 pt-3 border-t border-slate-100 text-[10px] text-slate-500 flex items-center justify-between">
                            <span>Stall Rekomendasi</span>
                            <strong class="text-slate-800 font-mono">PIT Bay Express 01</strong>
                        </div>
                    </div>

                    <!-- COMPONENT 2: FILTER UDARA & KABIN -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm border border-blue-100">
                                    <i class="fa-solid fa-wind"></i>
                                </div>
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full font-mono">
                                    CEK BERKALA
                                </span>
                            </div>

                            <h4 class="font-heading font-bold text-sm text-slate-900">Filter Udara &amp; Kabin</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">Denso Air Clean Technology</p>

                            <!-- Progress Bar -->
                            <div class="mt-4 space-y-1.5">
                                <div class="flex justify-between text-xs font-mono">
                                    <strong class="text-slate-900 font-bold">9.850 / 10.000 KM</strong>
                                    <span class="text-blue-700 font-bold">98.5% Siklus</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: 98.5%;"></div>
                                </div>
                            </div>

                            <p class="text-[11px] text-slate-500 mt-3 leading-relaxed">
                                Rekomendasi ganti pada servis berikutnya (Est. 40.000 KM)
                            </p>
                        </div>

                        <div class="mt-5 pt-3 border-t border-slate-100 text-[10px] text-slate-500 flex items-center justify-between">
                            <span>Kesiapan Part</span>
                            <strong class="text-slate-800">Tersedia di Gudang (28 pcs)</strong>
                        </div>
                    </div>

                    <!-- COMPONENT 3: KAMPAS REM DEPAN & BELAKANG -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm border border-blue-100">
                                    <i class="fa-solid fa-circle-dot"></i>
                                </div>
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full font-mono">
                                    KONDISI PRIMA
                                </span>
                            </div>

                            <h4 class="font-heading font-bold text-sm text-slate-900">Kampas Rem Depan &amp; Belakang</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">OEM Akebono High-Heat Friction</p>

                            <!-- Circular Gauge Display -->
                            <div class="mt-3.5 flex items-center gap-3">
                                <div class="relative w-14 h-14 flex items-center justify-center shrink-0">
                                    <svg class="w-14 h-14" viewBox="0 0 36 36">
                                        <path class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                        <path class="text-blue-600 progress-circle" stroke-dasharray="72, 100" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    </svg>
                                    <span class="absolute font-heading font-extrabold text-xs text-blue-700">7.2<span class="text-[8px]">mm</span></span>
                                </div>

                                <div>
                                    <strong class="font-heading font-bold text-xs text-slate-900 block">Ketebalan: 7.2 mm</strong>
                                    <span class="text-[10px] text-slate-400 block">Batas minimum pabrikan: 2.0 mm</span>
                                </div>
                            </div>

                            <p class="text-[11px] text-slate-500 mt-2.5">
                                Kondisi Baik &bull; Aman hingga interval 60.000 KM
                            </p>
                        </div>

                        <div class="mt-5 pt-3 border-t border-slate-100 text-[10px] text-slate-500 flex items-center justify-between">
                            <span>Inspeksi Fisik</span>
                            <strong class="text-slate-800">15 Jan 2025</strong>
                        </div>
                    </div>

                    <!-- COMPONENT 4: AKI KERING (MF BATTERY) -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm border border-blue-100">
                                    <i class="fa-solid fa-car-battery"></i>
                                </div>
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full font-mono">
                                    OPTIMAL
                                </span>
                            </div>

                            <h4 class="font-heading font-bold text-sm text-slate-900">Aki Kering (MF Battery)</h4>
                            <p class="text-[11px] text-slate-400 mt-0.5">GS Astra MF 55D23L (12V 60Ah)</p>

                            <!-- Volt Display -->
                            <div class="mt-4 flex items-baseline gap-2">
                                <strong class="font-heading font-extrabold text-2xl text-slate-900">12.6</strong>
                                <span class="text-xs font-bold text-blue-600 font-mono">Volt</span>
                                <span class="text-slate-300 mx-1">&bull;</span>
                                <span class="text-xs text-slate-500">Usia: 14 Bulan</span>
                            </div>

                            <p class="text-[11px] text-slate-500 mt-2.5 leading-relaxed">
                                Output alternator &amp; CCA (Cold Cranking) stabil
                            </p>
                        </div>

                        <div class="mt-5 pt-3 border-t border-slate-100 text-[10px] text-slate-500 flex items-center justify-between">
                            <span>Garansi Aki</span>
                            <strong class="text-emerald-600 font-semibold">Aktif s/d Nov 2025</strong>
                        </div>
                    </div>

                </div>
            @else
                <!-- EMPTY TELEMETRY STATE (DATA KOSONG) -->
                <div class="bg-white rounded-2xl p-6 sm:p-10 border border-dashed border-slate-300 text-center shadow-2xs">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-3">
                        <i class="fa-solid fa-satellite-dish text-2xl"></i>
                    </div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900">
                        Sensor Telemetri Belum Terhubung
                    </h3>
                    <p class="text-xs text-slate-500 max-w-md mx-auto mt-1 mb-6 leading-relaxed">
                        Tambahkan atau pilih mobil di atas untuk memantau status kesehatan komponen vital seperti oli mesin, filter kabin, kampas rem, dan voltase aki secara otomatis.
                    </p>

                    <!-- 4 Outline Dummy Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-left">
                        <div class="bg-slate-50/70 border border-slate-200 rounded-xl p-4 opacity-75">
                            <span class="text-[10px] font-mono text-slate-400 block uppercase">KOMPONEN #1</span>
                            <strong class="font-heading text-xs text-slate-700 block mt-0.5">Oli Mesin</strong>
                            <span class="text-[11px] text-slate-400 block mt-2">Menunggu unit mobil aktif</span>
                        </div>
                        <div class="bg-slate-50/70 border border-slate-200 rounded-xl p-4 opacity-75">
                            <span class="text-[10px] font-mono text-slate-400 block uppercase">KOMPONEN #2</span>
                            <strong class="font-heading text-xs text-slate-700 block mt-0.5">Filter Udara &amp; AC</strong>
                            <span class="text-[11px] text-slate-400 block mt-2">Menunggu unit mobil aktif</span>
                        </div>
                        <div class="bg-slate-50/70 border border-slate-200 rounded-xl p-4 opacity-75">
                            <span class="text-[10px] font-mono text-slate-400 block uppercase">KOMPONEN #3</span>
                            <strong class="font-heading text-xs text-slate-700 block mt-0.5">Kampas Rem 4 Roda</strong>
                            <span class="text-[11px] text-slate-400 block mt-2">Menunggu unit mobil aktif</span>
                        </div>
                        <div class="bg-slate-50/70 border border-slate-200 rounded-xl p-4 opacity-75">
                            <span class="text-[10px] font-mono text-slate-400 block uppercase">KOMPONEN #4</span>
                            <strong class="font-heading text-xs text-slate-700 block mt-0.5">Aki &amp; Alternator</strong>
                            <span class="text-[11px] text-slate-400 block mt-2">Menunggu unit mobil aktif</span>
                        </div>
                    </div>
                </div>
            @endif

        </section>

        <!-- ===================================================== -->
        <!-- 4.5 SECTION: AUDIT LOG • CLOUD VERIFIED (BUKU SERVIS DIGITAL) -->
        <!-- ===================================================== -->
        <section class="space-y-4 pt-2">
            
            <!-- Section Header & Filter Pills -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600 font-mono">AUDIT LOG &bull; CLOUD VERIFIED</span>
                    <h2 class="font-heading font-extrabold text-2xl text-slate-900 tracking-tight">
                        Riwayat Servis Lengkap (Buku Servis Digital)
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Rekam jejak transparansi pengerjaan, suku cadang OEM, dan mekanik bersertifikat MotoPro.
                    </p>
                </div>

                <!-- Filter Category Pills -->
                <div class="flex items-center gap-1.5 flex-wrap">
                    @if($isDemo)
                        <button type="button" onclick="filterHistory('all')" class="bg-slate-900 text-white text-xs font-bold px-3.5 py-1.5 rounded-lg shadow-2xs filter-btn active">
                            Semua Servis (12)
                        </button>
                        <button type="button" onclick="filterHistory('oli')" class="bg-white hover:bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 transition filter-btn">
                            Ganti Oli
                        </button>
                        <button type="button" onclick="filterHistory('berat')" class="bg-white hover:bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 transition filter-btn">
                            Perbaikan Berat
                        </button>
                        <button type="button" onclick="filterHistory('spooring')" class="bg-white hover:bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 transition filter-btn">
                            Spooring &amp; Balancing
                        </button>
                    @else
                        <button type="button" class="bg-slate-900 text-white text-xs font-bold px-3.5 py-1.5 rounded-lg shadow-2xs">
                            Semua Servis (0)
                        </button>
                        <button type="button" class="bg-slate-100 text-slate-400 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 cursor-not-allowed">
                            Ganti Oli
                        </button>
                        <button type="button" class="bg-slate-100 text-slate-400 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 cursor-not-allowed">
                            Perbaikan Berat
                        </button>
                        <button type="button" class="bg-slate-100 text-slate-400 text-xs font-semibold px-3 py-1.5 rounded-lg border border-slate-200 cursor-not-allowed">
                            Spooring &amp; Balancing
                        </button>
                    @endif
                </div>
            </div>

            <!-- Official Certification Info Strip -->
            <div class="bg-blue-50/80 border border-blue-200/80 rounded-xl p-3 flex items-center gap-2.5 text-xs text-blue-900 font-medium">
                <i class="fa-solid fa-shield-halved text-blue-600 text-sm shrink-0"></i>
                <span>Semua catatan di bawah ini <strong>tervalidasi resmi oleh MotoPro Workshop OS</strong> dan sinkron otomatis dengan riwayat garansi pabrikan.</span>
            </div>

            @if($isDemo && count($serviceHistory) > 0)
                <!-- SERVICE HISTORY CARDS (FILLED DEMO STATE) -->
                <div class="space-y-3.5">
                    
                    @foreach($serviceHistory as $history)
                        <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-5 history-item category-{{ $history['category'] }}">
                            
                            <!-- Left: Date Box & Work Details -->
                            <div class="flex items-start gap-4">
                                <!-- Blue Date Block -->
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-2.5 text-center shrink-0 w-16">
                                    <span class="font-heading font-extrabold text-lg text-blue-700 block leading-none">
                                        {{ $history['date_day'] }}
                                    </span>
                                    <span class="text-[10px] font-bold text-blue-900 uppercase tracking-wider block font-mono mt-1">
                                        {{ $history['date_month'] }}
                                    </span>
                                    <span class="text-[9px] text-slate-400 block font-mono">
                                        {{ $history['date_year'] }}
                                    </span>
                                </div>

                                <!-- Description & Mechanic -->
                                <div class="space-y-1.5">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="bg-blue-600 text-white text-[11px] font-bold font-mono px-2 py-0.5 rounded">
                                            {{ $history['odometer'] }}
                                        </span>
                                        <h3 class="font-heading font-extrabold text-base text-slate-900">
                                            {{ $history['title'] }}
                                        </h3>
                                        <span class="bg-slate-100 text-slate-700 text-[10px] font-bold font-mono px-2 py-0.5 rounded border border-slate-200">
                                            {{ $history['stall'] }}
                                        </span>
                                    </div>

                                    <p class="text-xs text-slate-600 leading-relaxed max-w-2xl">
                                        Pekerjaan: {{ $history['job_details'] }}
                                    </p>

                                    <div class="flex items-center gap-3 text-[11px] text-slate-400 pt-0.5">
                                        <span class="flex items-center gap-1">
                                            <i class="fa-solid fa-wrench text-slate-400 text-[10px]"></i>
                                            <span>Mekanik Senior: <strong class="text-slate-700">{{ $history['mechanic'] }}</strong></span>
                                        </span>
                                        <span>&bull;</span>
                                        <span class="flex items-center gap-1">
                                            <i class="fa-regular fa-clock text-slate-400 text-[10px]"></i>
                                            <span>Durasi: {{ $history['duration'] }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Cost & PDF Invoice Download Button -->
                            <div class="flex md:flex-col items-center md:items-end justify-between md:justify-center gap-3 shrink-0 pt-3 md:pt-0 border-t md:border-t-0 border-slate-100">
                                <div class="text-left md:text-right">
                                    <span class="text-[10px] text-slate-400 uppercase font-mono block">TOTAL BIAYA</span>
                                    <strong class="font-heading font-extrabold text-base text-slate-900 block">
                                        {{ $history['total_cost'] }}
                                    </strong>
                                    <span class="text-[10px] text-emerald-600 font-semibold block">
                                        {{ $history['payment'] }}
                                    </span>
                                </div>

                                <button type="button" onclick="downloadInvoice('{{ $history['id'] }}', '{{ $history['title'] }}', '{{ $history['total_cost'] }}')" class="bg-white hover:bg-slate-50 text-blue-600 border border-blue-200 hover:border-blue-300 font-bold py-1.5 px-3.5 rounded-xl text-xs flex items-center gap-1.5 transition shadow-2xs cursor-pointer">
                                    <i class="fa-solid fa-file-pdf text-red-500 text-xs"></i>
                                    <span>Unduh PDF Invoice</span>
                                </button>
                            </div>

                        </div>
                    @endforeach

                </div>

                <!-- DOWNLOAD FULL SERVICE BOOKLET BANNER -->
                <div class="bg-slate-50 border border-slate-200/90 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-slate-200 text-slate-700 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-file-invoice text-lg"></i>
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-sm text-slate-900">
                                Butuh Buku Servis Lengkap dalam 1 Berkas?
                            </h4>
                            <p class="text-xs text-slate-500">
                                Kompilasi riwayat untuk keperluan appraisal penjualan mobil atau klaim garansi resmi.
                            </p>
                        </div>
                    </div>

                    <button type="button" onclick="downloadFullBooklet()" class="bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center gap-2 transition shrink-0 shadow-xs cursor-pointer">
                        <i class="fa-solid fa-download text-xs"></i>
                        <span>Unduh Buku Servis Lengkap (.PDF)</span>
                    </button>
                </div>
            @else
                <!-- EMPTY SERVICE HISTORY STATE (DATA KOSONG) -->
                <div class="bg-white rounded-2xl p-8 sm:p-14 border border-dashed border-slate-300 text-center shadow-2xs space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                        <i class="fa-solid fa-book-medical text-2xl"></i>
                    </div>

                    <div class="max-w-md mx-auto">
                        <h3 class="font-heading font-extrabold text-lg sm:text-xl text-slate-900">
                            Belum Ada Riwayat Servis Tercatat
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            Setelah kendaraan Anda selesai diservis di MotoPro Workshop, setiap catatan penggantian oli, suku cadang OEM, telemetri, dan faktur digital akan otomatis tersimpan di sini dan dapat diunduh dalam format PDF.
                        </p>
                    </div>

                    <div class="pt-2 flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('bengkel.booking.page') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition flex items-center gap-2 shadow-md shadow-blue-500/20">
                            <i class="fa-solid fa-calendar-check text-xs"></i>
                            <span>Booking Servis Pertama Anda</span>
                        </a>
                        <a href="{{ route('bengkel.garasi.page', ['demo' => 1]) }}" class="bg-white hover:bg-slate-50 text-slate-700 font-bold py-2.5 px-4 rounded-xl text-xs transition border border-slate-200">
                            Lihat Contoh Buku Servis
                        </a>
                    </div>
                </div>
            @endif

        </section>

    </main>

    <!-- ========================================================= -->
    <!-- 5. FOOTER (SESUAI MOTOPRO STANDARDS) -->
    <!-- ========================================================= -->
    <footer class="bg-white border-t border-slate-200/80 mt-12 py-8 px-4 sm:px-8 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto space-y-6">
            
            <!-- 4 Quick Columns Footer Strip -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 pb-6 border-b border-slate-100">
                <!-- Col 1: Brand Info -->
                <div>
                    <div class="flex items-center gap-2 mb-1.5">
                        <span class="font-heading font-extrabold text-base text-slate-900">{{ $workshop['name'] }}</span>
                    </div>
                    <p class="text-[11px] text-slate-500 leading-relaxed">
                        Sistem servis kendaraan modern berstandar OBD industrial. Transparansi biaya, spare part terjamin, dan live workshop inspection telemetry.
                    </p>
                </div>

                <!-- Col 2: Darurat 24 Jam -->
                <div>
                    <div class="flex items-center gap-2 font-bold text-slate-800 mb-1">
                        <i class="fa-solid fa-truck-pickup text-rose-500"></i>
                        <span>Darurat &amp; Derek 24 Jam</span>
                    </div>
                    <p class="text-[11px] text-slate-500 mb-1.5">Hubungi Service Roadside Assistance kami untuk penjemputan armada bermasalah.</p>
                    <a href="tel:{{ $workshop['no_darurat'] }}" class="text-rose-600 font-bold text-xs hover:underline block">
                        {{ $workshop['no_darurat'] }} (Bebas Pulsa)
                    </a>
                </div>

                <!-- Col 3: Google Maps Cabang -->
                <div>
                    <div class="flex items-center gap-2 font-bold text-slate-800 mb-1">
                        <i class="fa-solid fa-location-dot text-blue-600"></i>
                        <span>Google Maps Cabang</span>
                    </div>
                    <p class="text-[11px] text-slate-500 mb-1.5">{{ $workshop['alamat'] }}</p>
                    <a href="{{ $workshop['maps_url'] }}" target="_blank" class="text-blue-600 font-bold text-xs hover:underline flex items-center gap-1">
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        <span>Buka Navigasi Google Maps</span>
                    </a>
                </div>

                <!-- Col 4: WhatsApp Konsultasi -->
                <div>
                    <div class="flex items-center gap-2 font-bold text-slate-800 mb-1">
                        <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                        <span>WhatsApp Konsultasi</span>
                    </div>
                    <p class="text-[11px] text-slate-500 mb-1.5">Tanya estimasi servis, suku cadang OEM, atau kendala transmisi &amp; mesin.</p>
                    <a href="https://api.whatsapp.com/send?phone={{ $workshop['no_whatsapp'] }}" target="_blank" class="text-emerald-700 font-bold text-xs hover:underline flex items-center gap-1">
                        <i class="fa-regular fa-comments text-xs"></i>
                        <span>Chat Advisor MotoPro</span>
                    </a>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="text-center text-[11px] text-slate-400">
                &copy; {{ date('Y') }} MotoPro Automotive Service Systems. Hak Cipta Dilindungi.
            </div>

        </div>
    </footer>

    <!-- ========================================================= -->
    <!-- 6. MODALS: TAMBAH MOBIL KE GARASI -->
    <!-- ========================================================= -->
    <div id="addCarModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Close Button -->
            <button type="button" onclick="closeAddCarModal()" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <!-- Modal Header -->
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-xs">
                    <i class="fa-solid fa-car text-base"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900">Tambah Mobil ke Garasi</h3>
                    <p class="text-xs text-slate-500">Daftarkan profil kendaraan untuk rekam medis digital</p>
                </div>
            </div>

            <!-- Form -->
            <form id="formAddCar" onsubmit="submitAddCar(event)" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Merek Mobil</label>
                        <select id="inputBrand" required class="w-full text-xs font-semibold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none">
                            <option value="">Pilih Merek...</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Honda">Honda</option>
                            <option value="Daihatsu">Daihatsu</option>
                            <option value="Mitsubishi">Mitsubishi</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Hyundai">Hyundai</option>
                            <option value="Wuling">Wuling</option>
                            <option value="Mazda">Mazda</option>
                            <option value="Nissan">Nissan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Model / Varian</label>
                        <input type="text" id="inputModel" required placeholder="Contoh: Innova Zenix 2.0 V" 
                               class="w-full text-xs font-semibold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Plat Nomor Polisi</label>
                        <input type="text" id="inputPlate" required placeholder="B 1234 ABC" 
                               class="w-full text-xs font-mono font-bold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none uppercase tracking-wider">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Tahun Unit</label>
                        <input type="number" id="inputYear" required min="1990" max="2026" placeholder="2023" 
                               class="w-full text-xs font-mono font-bold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase font-mono mb-1">Odometer Terakhir (KM)</label>
                    <input type="number" id="inputOdo" required min="0" placeholder="Contoh: 35000" 
                           class="w-full text-xs font-mono font-bold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeAddCarModal()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:text-slate-800 bg-slate-100 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/20 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan ke Garasi</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 7. MODALS: PREVIEW PDF INVOICE -->
    <!-- ========================================================= -->
    <div id="invoiceModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-xl w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Close Button -->
            <button type="button" onclick="closeInvoiceModal()" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <div class="flex items-center gap-3 pb-4 border-b border-slate-100 mb-4">
                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 border border-red-200 flex items-center justify-center">
                    <i class="fa-solid fa-file-pdf text-xl"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900" id="invTitle">Invoice Servis Resmi</h3>
                    <p class="text-xs text-slate-500" id="invSubtitle">Nomor Faktur: SRV-20250115 &bull; Lunas</p>
                </div>
            </div>

            <div class="space-y-3 text-xs text-slate-600 bg-slate-50 p-4 rounded-xl border border-slate-200 font-mono mb-4">
                <div class="flex justify-between">
                    <span>Bengkel Penerbit:</span>
                    <strong class="text-slate-900">{{ $workshop['name'] }}</strong>
                </div>
                <div class="flex justify-between">
                    <span>Status Verifikasi:</span>
                    <span class="text-emerald-600 font-bold">[VERIFIED] OBD-II Cloud Audit</span>
                </div>
                <div class="flex justify-between">
                    <span>Total Biaya:</span>
                    <strong class="text-blue-700 text-sm" id="invCost">Rp 890.000</strong>
                </div>
                <div class="flex justify-between">
                    <span>Status Pembayaran:</span>
                    <span class="text-emerald-700 font-bold">LUNAS</span>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="window.print()" class="px-4 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition flex items-center gap-1.5">
                    <i class="fa-solid fa-print text-xs"></i>
                    <span>Cetak Faktur</span>
                </button>
                <button type="button" onclick="simulateDownloadPdf()" class="px-4 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/20 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-download text-xs"></i>
                    <span>Unduh File .PDF</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toastNotification" class="fixed bottom-5 right-5 z-50 bg-slate-900 text-white px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 text-xs hidden transition-all duration-300">
        <i id="toastIcon" class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
        <span id="toastMsg">Aksi berhasil dilakukan.</span>
    </div>

    <!-- ========================================================= -->
    <!-- 8. JAVASCRIPT LOGIC & INTERACTIONS -->
    <!-- ========================================================= -->
    <script>
        // Modal Handlers
        function openAddCarModal() {
            document.getElementById('addCarModal').classList.remove('hidden');
        }
        function closeAddCarModal() {
            document.getElementById('addCarModal').classList.add('hidden');
        }

        function downloadInvoice(id, title, cost) {
            document.getElementById('invTitle').innerText = title;
            document.getElementById('invSubtitle').innerText = 'Nomor Faktur: ' + id + ' • Terverifikasi Cloud';
            document.getElementById('invCost').innerText = cost;
            document.getElementById('invoiceModal').classList.remove('hidden');
        }
        function closeInvoiceModal() {
            document.getElementById('invoiceModal').classList.add('hidden');
        }

        function simulateDownloadPdf() {
            showToast('Mengunduh faktur PDF resmi MotoPro Workshop...', 'fa-file-pdf', 'text-blue-400');
            setTimeout(() => {
                closeInvoiceModal();
            }, 1000);
        }

        function downloadFullBooklet() {
            showToast('Menyiapkan kompilasi Buku Servis Lengkap (.PDF)...', 'fa-download', 'text-emerald-400');
        }

        function useVoucher(name) {
            showToast('Voucher "' + name + '" berhasil diterapkan untuk booking servis berikutnya!', 'fa-ticket', 'text-emerald-400');
        }

        function claimBenefit(name) {
            showToast('Benefit "' + name + '" berhasil diklaim ke profil member!', 'fa-gift', 'text-blue-400');
        }

        function openLoginModal() {
            window.location.href = "{{ route('login') }}";
        }

        function showSwitchAccountModal() {
            showToast('Fitur beralih akun: Masukkan PIN atau nomor WhatsApp akun lain.', 'fa-arrows-rotate', 'text-blue-400');
        }

        function selectCarUnit(unitId) {
            showToast('Unit aktif beralih ke Honda HR-V (B 2099 JKP). Telemetri diperbarui.', 'fa-car-side', 'text-emerald-400');
            // Visual toggle
            const zenix = document.getElementById('unit-zenix');
            const hrv = document.getElementById('unit-hrv');
            if (zenix && hrv) {
                zenix.classList.remove('border-2', 'border-blue-500');
                zenix.classList.add('border', 'border-slate-200/90');
                hrv.classList.remove('border', 'border-slate-200/90');
                hrv.classList.add('border-2', 'border-blue-500', 'shadow-md');
            }
        }

        function filterHistory(category) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('bg-slate-900', 'text-white', 'shadow-2xs');
                btn.classList.add('bg-white', 'text-slate-600', 'border', 'border-slate-200');
            });
            event.target.classList.remove('bg-white', 'text-slate-600', 'border');
            event.target.classList.add('bg-slate-900', 'text-white', 'shadow-2xs');

            const items = document.querySelectorAll('.history-item');
            items.forEach(item => {
                if (category === 'all' || item.classList.contains('category-' + category)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function submitAddCar(e) {
            e.preventDefault();
            const brand = document.getElementById('inputBrand').value;
            const model = document.getElementById('inputModel').value;
            const plate = document.getElementById('inputPlate').value.toUpperCase();
            const year = document.getElementById('inputYear').value;
            const odo = document.getElementById('inputOdo').value;

            closeAddCarModal();
            showToast('Kendaraan ' + brand + ' ' + model + ' (' + plate + ') berhasil ditambahkan ke Garasi!', 'fa-circle-check', 'text-emerald-400');

            // Redirect ke demo untuk menampilkan mobil terisi atau segarkan
            setTimeout(() => {
                window.location.href = "{{ route('bengkel.garasi.page', ['demo' => 1]) }}";
            }, 1200);
        }

        function showToast(msg, icon = 'fa-circle-check', color = 'text-emerald-400') {
            const toast = document.getElementById('toastNotification');
            const toastMsg = document.getElementById('toastMsg');
            const toastIcon = document.getElementById('toastIcon');

            toastMsg.innerText = msg;
            toastIcon.className = 'fa-solid ' + icon + ' ' + color + ' text-sm';
            toast.classList.remove('hidden');

            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3500);
        }
    </script>
</body>
</html>
