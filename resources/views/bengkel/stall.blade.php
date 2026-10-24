<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Floor Bay Monitor &amp; Status Ketersediaan Stall — {{ $workshop['name'] }}</title>
    <meta name="description" content="Pantau ketersediaan lift stall pit bay bengkel secara realtime. Status lift hidrolik, waktu tunggu walk-in, okupansi jam operasional, dan live CCTV bay monitor.">

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

        /* Pulsing dot */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 0.3; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-live {
            animation: pulse-ring 2s infinite ease-in-out;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- ========================================================= -->
    <!-- 1. TOP ANNOUNCEMENT BAR (Dark Precision Live Status) -->
    <!-- ========================================================= -->
    <div class="bg-[#0b0f19] text-xs text-slate-300 border-b border-slate-800 py-2.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3 font-medium">
            
            <!-- Left: Back to Home & Page Scope -->
            <div class="flex items-center gap-2.5">
                <a href="{{ url('/bengkel') }}" class="text-slate-400 hover:text-white transition flex items-center gap-1.5 font-bold uppercase tracking-wider text-[11px] font-mono">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                    <span>BERANDA</span>
                </a>
                <span class="text-slate-700">/</span>
                <span class="text-slate-300 font-bold uppercase tracking-wider text-[11px] font-mono">
                    TELEMETRI STALL PIT BAY &amp; KAPASITAS LANTAI
                </span>
            </div>

            <!-- Right: Sync status & State Switcher -->
            <div class="flex items-center gap-4 text-xs font-mono">
                <div class="flex items-center gap-2 text-slate-400">
                    <span class="w-2 h-2 rounded-full bg-blue-500 pulse-live"></span>
                    <span class="text-slate-200">SYNC OBD-GRID: <strong class="text-emerald-400">ONLINE (0.4s)</strong></span>
                    <span class="text-slate-600">|</span>
                    <span class="text-slate-400 hidden sm:inline">STATION: #JKT-UTARA-08</span>
                </div>

                @if($isDemo)
                    <a href="{{ route('bengkel.stall.page') }}" class="text-amber-300 hover:text-amber-200 underline text-[11px] font-sans font-medium transition">
                        Beralih ke Data Kosong
                    </a>
                @else
                    <a href="{{ route('bengkel.stall.page', ['demo' => 1]) }}" class="text-amber-300 hover:text-amber-200 font-bold text-[11px] font-sans transition flex items-center gap-1">
                        <i class="fa-solid fa-eye text-xs"></i>
                        <span>Lihat Data Demo (3 Terisi &amp; 1 Siap)</span>
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
                <a href="{{ route('bengkel.garasi.page') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Garasi Saya (Member)</span>
                </a>
            </nav>

            <!-- Quick Plat Search & Action Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Stall Status Pill (ACTIVE ON THIS PAGE) -->
                <a href="{{ route('bengkel.stall.page') }}" class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border-2 border-blue-500 px-3 py-1.5 rounded-lg text-xs font-bold shadow-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $workshop['status_bengkel'] }}</span>
                </a>

                <!-- Quick Plate Search in Header -->
                <form action="{{ route('bengkel.lacak') }}" method="POST" class="hidden md:flex items-center relative">
                    @csrf
                    <div class="relative">
                        <input type="text" name="plat_nomor" placeholder="Cek Plat Nomor (B 1234 CD)..." 
                            class="w-44 lg:w-52 bg-slate-100/90 text-slate-800 placeholder-slate-400 text-xs font-mono font-semibold py-2 pl-8 pr-3 rounded-lg border border-slate-200 focus:bg-white focus:w-60 focus:border-blue-500 focus:outline-none transition-all">
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    </div>
                </form>

                <!-- Guest Access Button -->
                <a href="{{ route('bengkel.booking.page') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition border border-slate-200">
                    <i class="fa-regular fa-user text-slate-500 text-xs"></i>
                    <span>AKSES TAMU</span>
                </a>

                <!-- Member / Garasi Login Button -->
                <a href="{{ route('bengkel.garasi.page') }}" class="inline-flex items-center gap-2 px-3.5 py-2 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-shield-halved text-blue-400 text-xs"></i>
                    <span class="hidden sm:inline">Masuk / Daftar</span>
                    <span>Garasi Member</span>
                </a>
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
                        <strong class="font-bold text-blue-950">Mode Live Floor Bay Monitor: Data Kosong (Clean Initial State).</strong>
                        <span class="text-blue-800">Saat ini seluruh 4 stall angkat kosong dan belum ada pengerjaan berjalan hari ini. Anda dapat memuat data demo untuk melihat preview lengkap.</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('bengkel.booking.page') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-1.5 px-3.5 rounded-lg text-xs transition flex items-center gap-1.5 shadow-xs">
                        <i class="fa-solid fa-calendar-check text-[10px]"></i>
                        <span>Booking Masuk Stall</span>
                    </a>
                    <a href="{{ route('bengkel.stall.page', ['demo' => 1]) }}" class="bg-white hover:bg-blue-50 text-blue-700 border border-blue-300 font-bold py-1.5 px-3.5 rounded-lg text-xs transition flex items-center gap-1.5">
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
                        <strong class="font-bold text-amber-950">Pratinjau Desain Aktif (Data Demo 3 Stall Terisi + 1 Siap).</strong>
                        <span class="text-amber-900">Menampilkan simulasi live telemetri PIT 01 (Fortuner), PIT 02 (HR-V), PIT 03 (Zenix), serta PIT 04 Standby Fast-Lane sesuai desain acuan.</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <a href="{{ route('bengkel.stall.page') }}" class="bg-white hover:bg-amber-100/60 text-amber-900 border border-amber-300 font-bold py-1.5 px-3.5 rounded-lg text-xs transition flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate-left text-[10px]"></i>
                        <span>Kembali ke Data Kosong</span>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================================= -->
    <!-- 4. MAIN CONTAINER -->
    <!-- ========================================================= -->
    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-6 w-full space-y-7">

        <!-- ===================================================== -->
        <!-- 4.1 HERO TITLE & REFRESH ACTION ROW -->
        <!-- ===================================================== -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-200 text-[11px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wide font-mono">
                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-ping"></span>
                    <span>BENGKEL BUKA &bull; REALTIME TELEMETRI AKTIF</span>
                </span>
                <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-1.5">
                    Status Ketersediaan Stall &amp; Antrean PIT Bay Hari Ini
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-3xl leading-relaxed">
                    @if($isDemo)
                        Pantau ketersediaan lift stall secara transparan sebelum Anda meluncur ke bengkel. Tersedia <strong class="text-blue-700">1 stall kosong (PIT 04 Express)</strong> siap melayani servis cepat tanpa perlu antre panjang.
                    @else
                        Pantau ketersediaan lift stall secara transparan sebelum Anda meluncur ke bengkel. Seluruh <strong class="text-blue-700">4 lift stall saat ini tersedia dan bebas antrean</strong> siap melayani pengerjaan walk-in kilat.
                    @endif
                </p>
            </div>

            <!-- Action Buttons on Top Right -->
            <div class="flex items-center gap-2.5 shrink-0">
                <button type="button" onclick="triggerRefreshTelemetri()" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-3.5 py-2.5 rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-2xs cursor-pointer">
                    <i id="refreshIcon" class="fa-solid fa-arrows-rotate text-xs text-slate-400"></i>
                    <span>Refresh Telemetri</span>
                </button>

                <button type="button" onclick="openClaimPitModal('PIT 04')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs transition flex items-center gap-2 shadow-md shadow-blue-500/20 cursor-pointer">
                    <i class="fa-solid fa-bolt text-amber-300 text-xs"></i>
                    <span>Klaim PIT 04 Sekarang</span>
                </button>
            </div>
        </div>

        <!-- ===================================================== -->
        <!-- 4.2 TOP 4 KEY METRIC CARDS -->
        <!-- ===================================================== -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            
            <!-- CARD 1: STATUS STALL ANGKAT -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono">STATUS STALL ANGKAT</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-elevator"></i>
                        </div>
                    </div>

                    <div class="flex items-baseline gap-2 mt-1">
                        <strong class="font-heading font-extrabold text-2xl text-slate-900 font-mono">
                            {{ $metrics['stall_val'] }}
                        </strong>
                        <span class="text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-200 px-2 py-0.5 rounded font-mono">
                            {{ $metrics['stall_badge'] }}
                        </span>
                    </div>

                    <p class="text-[11px] text-slate-500 mt-2">
                        {{ $metrics['stall_sub'] }}
                    </p>
                </div>
            </div>

            <!-- CARD 2: WAKTU TUNGGU WALK-IN -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono">WAKTU TUNGGU WALK-IN</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                    </div>

                    <div class="flex items-baseline gap-1.5 mt-1">
                        <strong class="font-heading font-extrabold text-2xl text-blue-600 font-mono">
                            {{ $metrics['wait_val'] }}
                        </strong>
                        <span class="text-xs font-bold text-slate-700">{{ $metrics['wait_unit'] }}</span>
                    </div>

                    <p class="text-[11px] text-slate-500 mt-2">
                        {{ $metrics['wait_sub'] }}
                    </p>

                    <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center gap-1.5 text-[10px] text-blue-700 font-bold font-mono">
                        <i class="fa-regular fa-circle-check text-emerald-500"></i>
                        <span>{{ $metrics['wait_badge'] }}</span>
                    </div>
                </div>
            </div>

            <!-- CARD 3: TEKNISI SIAGA (STANDBY) -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono">TEKNISI SIAGA (STANDBY)</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                    </div>

                    <div class="flex items-baseline gap-1.5 mt-1">
                        <strong class="font-heading font-extrabold text-2xl text-slate-900 font-mono">
                            {{ $metrics['tech_val'] }}
                        </strong>
                        <span class="text-xs font-bold text-slate-700">{{ $metrics['tech_unit'] }}</span>
                    </div>

                    <p class="text-[11px] text-slate-500 mt-2">
                        {{ $metrics['tech_sub'] }}
                    </p>

                    <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center gap-1.5 text-[10px] text-slate-600">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>{{ $metrics['tech_note'] }}</span>
                    </div>
                </div>
            </div>

            <!-- CARD 4: AVG. SERVIS CEPAT -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 font-mono">AVG. SERVIS CEPAT</span>
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-gauge-high"></i>
                        </div>
                    </div>

                    <div class="flex items-baseline gap-1.5 mt-1">
                        <strong class="font-heading font-extrabold text-2xl text-slate-900 font-mono">
                            {{ $metrics['avg_val'] }}
                        </strong>
                        <span class="text-xs font-bold text-slate-700">{{ $metrics['avg_unit'] }}</span>
                    </div>

                    <p class="text-[11px] text-slate-500 mt-2">
                        {{ $metrics['avg_sub'] }}
                    </p>

                    <div class="mt-2.5 pt-2 border-t border-slate-100 text-[10px] text-slate-400 font-mono">
                        {{ $metrics['avg_note'] }}
                    </div>
                </div>
            </div>

        </div>

        <!-- ===================================================== -->
        <!-- 4.3 SECTION: LIVE FLOOR BAY MONITOR (STALL 01 – 04) -->
        <!-- ===================================================== -->
        <section class="space-y-4">
            
            <!-- Section Header & Legend -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600 font-mono">LANTAI OPERASIONAL BENGKEL</span>
                    <h2 class="font-heading font-extrabold text-xl sm:text-2xl text-slate-900 tracking-tight">
                        Live Floor Bay Monitor (Stall 01 – 04)
                    </h2>
                </div>

                <!-- Legend Pills -->
                <div class="flex items-center gap-2">
                    @if($isDemo)
                        <span class="inline-flex items-center gap-1.5 bg-slate-900 text-white text-[11px] font-bold px-3 py-1 rounded-full font-mono">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                            <span>3 Terisi (In-Progress)</span>
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-200 text-[11px] font-bold px-3 py-1 rounded-full font-mono">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>1 Kosong &amp; Siap</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold px-3 py-1 rounded-full font-mono">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>4 Kosong &amp; Siap Pakai</span>
                        </span>
                    @endif
                </div>
            </div>

            <!-- 4 STALLS GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 items-stretch">
                
                @foreach($stalls as $stall)
                    @if(isset($stall['is_standby']) && $stall['is_standby'])
                        <!-- PIT 04: STANDBY / FAST-LANE READY -->
                        <div class="bg-gradient-to-b from-blue-50/50 via-white to-white rounded-2xl p-5 border-2 border-blue-500 shadow-md shadow-blue-500/10 flex flex-col justify-between relative">
                            
                            <!-- Header with Badge -->
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <strong class="font-heading font-extrabold text-base text-slate-900">{{ $stall['name'] }}</strong>
                                        <span class="text-[11px] text-slate-500 font-mono">{{ $stall['type'] }}</span>
                                    </div>
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded font-mono">
                                        {{ $stall['status'] }}
                                    </span>
                                </div>

                                <div class="text-center py-1 mb-3">
                                    <span class="bg-blue-600 text-white text-[10px] font-bold font-mono px-3 py-1 rounded-full uppercase tracking-wider shadow-xs">
                                        {{ $stall['badge_top'] }}
                                    </span>
                                </div>

                                <!-- Fast-Lane Ready Banner -->
                                <div class="bg-blue-50/80 border border-blue-200/80 rounded-xl p-3.5 mb-4 text-xs">
                                    <div class="flex items-center gap-1.5 text-blue-700 font-bold font-mono text-[11px] mb-1">
                                        <i class="fa-solid fa-bolt text-amber-500 text-xs"></i>
                                        <span>{{ $stall['banner_title'] }}</span>
                                    </div>
                                    <p class="text-[11px] text-slate-600 leading-relaxed">
                                        <strong class="text-slate-900 block font-bold mb-0.5">Stall Kosong &amp; Alat Dikalibrasi</strong>
                                        Lift hidrolik turun level 0, OBD-II telemetry scanner terhubung, toolset lengkap.
                                    </p>
                                </div>

                                <!-- Metadata Rows -->
                                <div class="space-y-2 text-xs">
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 flex items-center gap-1.5">
                                            <i class="fa-solid fa-wrench text-[10px]"></i>
                                            <span>Teknisi Bertugas:</span>
                                        </span>
                                        <strong class="text-slate-800 text-[11px] truncate max-w-[150px]">{{ $stall['mechanic'] }}</strong>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 flex items-center gap-1.5">
                                            <i class="fa-regular fa-clock text-[10px]"></i>
                                            <span>Waktu Masuk:</span>
                                        </span>
                                        <strong class="text-blue-600 text-[11px] font-bold">{{ $stall['entry_time'] }}</strong>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 flex items-center gap-1.5">
                                            <i class="fa-solid fa-stopwatch text-[10px]"></i>
                                            <span>Durasi Ditahan:</span>
                                        </span>
                                        <span class="font-mono text-emerald-600 font-bold text-[11px]" id="holdTimer">{{ $stall['hold_duration'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-5 pt-3.5 border-t border-slate-100 space-y-2">
                                <button type="button" onclick="openClaimPitModal('PIT 04')" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-3 rounded-xl text-xs flex items-center justify-center gap-1.5 transition shadow-xs cursor-pointer">
                                    <i class="fa-solid fa-lock text-xs"></i>
                                    <span>Amankan Slot PIT 04 Sekarang</span>
                                </button>
                                <a href="{{ $workshop['maps_url'] }}" target="_blank" class="w-full bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold py-2 px-3 rounded-xl text-xs flex items-center justify-center gap-1.5 transition">
                                    <i class="fa-solid fa-location-arrow text-blue-600 text-xs"></i>
                                    <span>Navigasi Langsung ke Bengkel</span>
                                </a>
                            </div>

                        </div>
                    @elseif(isset($stall['is_empty']) && $stall['is_empty'])
                        <!-- EMPTY STATE CARD FOR STALL -->
                        <div class="bg-white rounded-2xl p-5 border border-dashed border-slate-300 shadow-2xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <strong class="font-heading font-extrabold text-base text-slate-900">{{ $stall['name'] }}</strong>
                                        <span class="text-[11px] text-slate-500 font-mono">{{ $stall['type'] }}</span>
                                    </div>
                                    <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded font-mono">
                                        {{ $stall['status'] }}
                                    </span>
                                </div>

                                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 mb-4 text-xs text-slate-600">
                                    <div class="flex items-center gap-1.5 text-emerald-600 font-bold text-[11px] mb-1 font-mono">
                                        <i class="fa-solid fa-circle-check text-xs"></i>
                                        <span>SIAP DIGUNAKAN</span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 leading-relaxed">
                                        {{ $stall['desc'] }}
                                    </p>
                                </div>

                                <div class="space-y-2 text-xs text-slate-500">
                                    <div class="flex justify-between">
                                        <span>Status Sensor:</span>
                                        <strong class="font-mono text-slate-800 text-[11px]">{{ $stall['sensor_status'] }}</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Waktu Tunggu:</span>
                                        <strong class="text-blue-600 text-[11px] font-bold">0 Menit (Langsung)</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Teknisi Siaga:</span>
                                        <span class="text-slate-800 text-[11px]">Siap Ditugaskan</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 pt-3.5 border-t border-slate-100">
                                <a href="{{ route('bengkel.booking.page') }}" class="w-full bg-slate-100 hover:bg-blue-50 hover:text-blue-700 text-slate-700 border border-slate-200 py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 text-center">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                    <span>Gunakan {{ $stall['name'] }} Sekarang</span>
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- OCCUPIED STALL (PIT 01, 02, 03) -->
                        <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                            <div>
                                <!-- Top: Stall Name & Status Badge -->
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-2">
                                        <strong class="font-heading font-extrabold text-base text-slate-900">{{ $stall['name'] }}</strong>
                                        <span class="text-[11px] text-slate-500 font-mono">{{ $stall['type'] }}</span>
                                    </div>
                                    <span class="{{ $stall['status_type'] === 'soon' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-slate-900 text-white' }} text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded font-mono">
                                        {{ $stall['status'] }}
                                    </span>
                                </div>

                                <!-- Plate & Progress Bar -->
                                <div class="space-y-2 mb-3">
                                    <div class="flex items-center justify-between">
                                        <span class="font-heading font-extrabold text-sm text-slate-900 font-mono tracking-wider bg-slate-100 border border-slate-200 px-2 py-0.5 rounded">
                                            {{ $stall['plate'] }}
                                        </span>
                                        <span class="text-xs font-bold text-blue-600 font-mono">{{ $stall['progress'] }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="bg-blue-600 h-1.5 rounded-full" style="width: {{ $stall['progress'] }}%;"></div>
                                    </div>
                                </div>

                                <!-- Vehicle & Service Details -->
                                <div class="space-y-1 mb-3">
                                    <h4 class="font-heading font-bold text-sm text-slate-900">{{ $stall['vehicle'] }}</h4>
                                    <p class="text-[11px] text-slate-500 leading-tight">{{ $stall['service'] }}</p>
                                </div>

                                <!-- Metadata Rows -->
                                <div class="space-y-1.5 text-xs border-t border-slate-100 pt-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 flex items-center gap-1.5">
                                            <i class="fa-solid fa-wrench text-[10px]"></i>
                                            <span>Teknisi:</span>
                                        </span>
                                        <strong class="text-slate-800 text-[11px]">{{ $stall['mechanic'] }}</strong>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 flex items-center gap-1.5">
                                            <i class="fa-regular fa-clock text-[10px]"></i>
                                            <span>Estimasi Selesai:</span>
                                        </span>
                                        <strong class="text-blue-600 text-[11px] font-mono">{{ $stall['est_remaining'] }}</strong>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-400 text-[11px]">Tahap: <strong class="text-slate-700">{{ $stall['stage'] }}</strong></span>
                                        <span class="text-slate-400 text-[10px] font-mono">{{ $stall['duration'] }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer Sensor Status -->
                            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-500 font-mono">
                                <span>{{ $stall['footer_sensor'] }}</span>
                                <strong class="{{ $stall['footer_badge'] }}">{{ $stall['footer_status'] }}</strong>
                            </div>

                        </div>
                    @endif
                @endforeach

            </div>

        </section>

        <!-- ===================================================== -->
        <!-- 4.4 SECTION: ANALISIS WAKTU TUNGGU REAL-TIME (JAM OPERASIONAL) -->
        <!-- ===================================================== -->
        <section class="space-y-4 pt-2">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-600 font-mono">
                        <i class="fa-solid fa-chart-simple text-xs"></i>
                        <span>ANALISIS WAKTU TUNGGU REAL-TIME</span>
                    </span>
                    <h2 class="font-heading font-extrabold text-xl text-slate-900 tracking-tight">
                        Grafik Kepadatan Jam Operasional Hari Ini
                    </h2>
                </div>

                <div class="inline-flex items-center gap-2 bg-blue-50/80 border border-blue-200/80 text-blue-700 px-3 py-1.5 rounded-xl text-xs font-semibold">
                    <i class="fa-regular fa-clock text-blue-600"></i>
                    <span>Waktu terbaik datang: <strong>Sebelum pukul 10:30 WIB</strong></span>
                </div>
            </div>

            <!-- 5 Hourly Load Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">
                
                @foreach($hourlyLoad as $hour)
                    <div class="bg-white rounded-2xl p-4 border {{ $hour['badge'] ? 'border-blue-400 shadow-xs' : 'border-slate-200/90' }} shadow-2xs flex flex-col justify-between">
                        <div>
                            <!-- Time & Badge -->
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-heading font-bold text-xs text-slate-900 font-mono">{{ $hour['time'] }}</span>
                                @if($hour['badge'])
                                    <span class="bg-blue-600 text-white text-[9px] font-bold uppercase px-1.5 py-0.5 rounded font-mono">
                                        {{ $hour['badge'] }}
                                    </span>
                                @endif
                            </div>

                            <strong class="font-heading font-bold text-xs block {{ $hour['status_col'] }} mb-1">
                                {{ $hour['status'] }}
                            </strong>

                            <p class="text-[10px] text-slate-400 leading-tight">
                                {{ $hour['desc'] }}
                            </p>
                        </div>

                        <!-- Progress Bar & Percentage -->
                        <div class="mt-4 pt-2 border-t border-slate-100">
                            <div class="flex justify-between text-[10px] text-slate-500 font-mono mb-1">
                                <span>Okupansi Est.</span>
                                <strong>{{ $hour['percent'] }}%</strong>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                <div class="{{ $hour['bar_color'] }} h-1.5 rounded-full" style="width: {{ $hour['percent'] }}%;"></div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </section>

        <!-- ===================================================== -->
        <!-- 4.5 SECTION: REKOMENDASI PAKET LANGSUNG JALAN -->
        <!-- ===================================================== -->
        <section class="space-y-4 pt-2">
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold uppercase tracking-wider text-blue-600 font-mono">
                        <i class="fa-solid fa-bolt text-xs"></i>
                        <span>REKOMENDASI PAKET LANGSUNG JALAN</span>
                    </span>
                    <h2 class="font-heading font-extrabold text-xl text-slate-900 tracking-tight">
                        Servis Cepat untuk PIT 04 (Tanpa Inap)
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Pilih paket di bawah dan dapatkan pengerjaan kilat dengan jaminan SOP pabrikan.
                    </p>
                </div>

                <a href="{{ url('/bengkel#layanan') }}" class="text-blue-600 hover:text-blue-700 text-xs font-bold flex items-center gap-1 transition">
                    <span>Lihat Semua Katalog Servis</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            <!-- 3 Package Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                
                @foreach($packages as $pkg)
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                        <div>
                            <!-- Badge Row -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded font-mono">
                                    {{ $pkg['badge'] }}
                                </span>
                                @if(isset($pkg['member_badge']))
                                    <span class="bg-blue-600 text-white text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded font-mono">
                                        {{ $pkg['member_badge'] }}
                                    </span>
                                @else
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-xs">
                                        <i class="{{ $pkg['icon'] }}"></i>
                                    </div>
                                @endif
                            </div>

                            <h3 class="font-heading font-extrabold text-base text-slate-900 mb-1.5">
                                {{ $pkg['title'] }}
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                {{ $pkg['desc'] }}
                            </p>

                            <!-- Features List -->
                            <ul class="space-y-2 text-xs text-slate-600 mb-5">
                                @foreach($pkg['features'] as $feat)
                                    <li class="flex items-center gap-2">
                                        <i class="fa-solid fa-check text-blue-600 text-xs shrink-0"></i>
                                        <span>{{ $feat }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Price & Action -->
                        <div class="pt-4 border-t border-slate-100">
                            <div class="flex items-baseline justify-between mb-3">
                                <span class="text-[11px] text-slate-400 font-mono">{{ $pkg['price_label'] }}</span>
                                <strong class="font-heading font-extrabold text-lg text-slate-900 {{ isset($pkg['is_free']) ? 'text-blue-600' : '' }}">
                                    {{ $pkg['price'] }}
                                </strong>
                            </div>

                            <button type="button" onclick="openClaimPitModal('PIT 04', '{{ $pkg['title'] }}')" class="w-full {{ $pkg['btn_style'] }} py-2.5 px-3 rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 cursor-pointer">
                                <span>{{ $pkg['btn_text'] }}</span>
                            </button>
                        </div>
                    </div>
                @endforeach

            </div>

        </section>

        <!-- ===================================================== -->
        <!-- 4.6 BOTTOM ROW: CCTV LIVE FEED & CUSTOMER LOUNGE -->
        <!-- ===================================================== -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch pt-2">
            
            <!-- LEFT: CCTV CAM-04 LIVE FEED (Col 6) -->
            <div class="lg:col-span-6 bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <!-- Camera Header -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-ping"></span>
                            <strong class="font-heading font-bold text-xs text-slate-900 tracking-wide uppercase font-mono">
                                CCTV CAM-04 LIVE FEED
                            </strong>
                        </div>
                        <span class="bg-slate-100 text-slate-600 text-[10px] font-bold font-mono px-2 py-0.5 rounded border border-slate-200">
                            1080P &bull; 30FPS
                        </span>
                    </div>

                    <!-- Image Frame -->
                    <div class="relative rounded-xl overflow-hidden aspect-[16/9] bg-slate-900 border border-slate-200 group">
                        <img src="https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=1000&q=80" 
                             alt="Live PIT 04 Camera" 
                             class="w-full h-full object-cover opacity-85 group-hover:scale-105 transition duration-700">
                        
                        <!-- Top Left HUD -->
                        <div class="absolute top-2.5 left-2.5 bg-slate-950/80 backdrop-blur-xs text-white text-[10px] font-mono px-2 py-1 rounded border border-slate-700">
                            PIT-04: EMPTY / READY
                        </div>

                        <!-- Bottom Right HUD -->
                        <div class="absolute bottom-2.5 right-2.5 bg-slate-950/80 backdrop-blur-xs text-emerald-400 text-[10px] font-mono px-2 py-1 rounded border border-slate-700">
                            CAM_BAY_04_SOUTH
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-[11px] text-slate-500 mt-3 font-mono">
                        <span>Area: <strong>Fast-Track Inbound Lane</strong></span>
                        <span class="text-emerald-600 font-bold">Akses Gerbang: Tanpa Hambatan</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 pt-3 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <a href="{{ $workshop['maps_url'] }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-3 rounded-xl text-xs flex items-center justify-center gap-1.5 transition shadow-xs text-center">
                        <i class="fa-solid fa-diamond-turn-right text-xs"></i>
                        <span>Buka Rute Navigasi Google Maps</span>
                    </a>
                    <a href="https://api.whatsapp.com/send?phone={{ $workshop['no_whatsapp'] }}" target="_blank" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 font-bold py-2 px-3 rounded-xl text-xs flex items-center justify-center gap-1.5 transition text-center">
                        <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                        <span>Hubungi Service Advisor</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT: EXECUTIVE CUSTOMER LOUNGE (Col 6) -->
            <div class="lg:col-span-6 bg-white rounded-2xl p-5 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                <div>
                    <!-- Lounge Header -->
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-couch text-blue-600 text-xs"></i>
                            <strong class="font-heading font-bold text-xs text-slate-900 tracking-wide uppercase font-mono">
                                EXECUTIVE CUSTOMER LOUNGE
                            </strong>
                        </div>
                        <span class="bg-blue-50 text-blue-700 border border-blue-200 text-[10px] font-bold font-mono px-2 py-0.5 rounded">
                            FREE ACCESS
                        </span>
                    </div>

                    <!-- Lounge Photo Frame -->
                    <div class="relative rounded-xl overflow-hidden aspect-[16/9] bg-slate-900 border border-slate-200 group">
                        <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?auto=format&fit=crop&w=1000&q=80" 
                             alt="Customer Lounge" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        
                        <div class="absolute bottom-2.5 left-2.5 bg-slate-950/80 backdrop-blur-xs text-white text-[10px] font-mono px-2.5 py-1 rounded border border-slate-700">
                            View Kaca Langsung ke Pengerjaan Lift Mobil
                        </div>
                    </div>

                    <!-- 4 Amenity Badges -->
                    <div class="grid grid-cols-4 gap-2 text-center mt-3 text-xs">
                        <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                            <i class="fa-regular fa-snowflake text-blue-600 text-xs block mb-1"></i>
                            <span class="text-[10px] font-bold text-slate-700 block">AC Dingin</span>
                        </div>
                        <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                            <i class="fa-solid fa-wifi text-blue-600 text-xs block mb-1"></i>
                            <span class="text-[10px] font-bold text-slate-700 block">WiFi 150 Mbps</span>
                        </div>
                        <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                            <i class="fa-solid fa-mug-saucer text-blue-600 text-xs block mb-1"></i>
                            <span class="text-[10px] font-bold text-slate-700 block">Free Espresso</span>
                        </div>
                        <div class="bg-slate-50 border border-slate-100 rounded-lg p-2">
                            <i class="fa-solid fa-eye text-blue-600 text-xs block mb-1"></i>
                            <span class="text-[10px] font-bold text-slate-700 block">Live Glass View</span>
                        </div>
                    </div>
                </div>

                <!-- Bottom Lounge Note -->
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span class="flex items-center gap-1.5 text-[11px]">
                        <i class="fa-solid fa-plug text-slate-400 text-[10px]"></i>
                        <span>Ruang kerja &amp; colokan laptop tersedia di area lounge atas.</span>
                    </span>
                    <a href="{{ route('bengkel.tracking.page') }}" class="text-blue-600 hover:text-blue-700 font-bold text-[11px] flex items-center gap-1">
                        <span>Cek Live Tracking</span>
                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                </div>
            </div>

        </div>

    </main>

    <!-- ========================================================= -->
    <!-- 5. FOOTER (SESUAI MOTOPRO WORKSHOP) -->
    <!-- ========================================================= -->
    <footer class="bg-white border-t border-slate-200/80 mt-12 py-8 px-4 sm:px-8 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto space-y-6">
            
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

            <div class="text-center text-[11px] text-slate-400">
                &copy; {{ date('Y') }} MotoPro Automotive Service Systems. Hak Cipta Dilindungi.
            </div>

        </div>
    </footer>

    <!-- ========================================================= -->
    <!-- 6. MODAL: KLAIM / AMANKAN SLOT PIT 04 -->
    <!-- ========================================================= -->
    <div id="claimModal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative animate-in fade-in zoom-in-95 duration-200">
            <!-- Close Button -->
            <button type="button" onclick="closeClaimPitModal()" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <!-- Header -->
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-xs">
                    <i class="fa-solid fa-bolt text-amber-300 text-lg"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900" id="modalStallTitle">Amankan Slot PIT 04 Express</h3>
                    <p class="text-xs text-slate-500">Stall akan ditahan 15 menit sampai Anda tiba di bengkel</p>
                </div>
            </div>

            <!-- Form -->
            <form onsubmit="submitClaimSlot(event)" class="space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 uppercase font-mono mb-1">Nomor Plat Mobil</label>
                    <input type="text" id="claimPlate" required placeholder="Contoh: B 1234 CD" 
                           class="w-full font-mono font-bold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none uppercase tracking-wider">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase font-mono mb-1">Nama Pemilik</label>
                        <input type="text" id="claimName" required placeholder="Nama Anda" 
                               class="w-full font-semibold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase font-mono mb-1">No. WhatsApp</label>
                        <input type="tel" id="claimWa" required placeholder="081234567890" 
                               class="w-full font-semibold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase font-mono mb-1">Pilihan Paket Servis Kilat</label>
                    <select id="claimPackage" class="w-full font-semibold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:outline-none">
                        <option value="Ganti Oli Express & Filter (30 Menit Kilat)">Ganti Oli Express &amp; Filter (30 Menit Kilat) — Rp 380.000</option>
                        <option value="General Checkup 24 Titik OBD-II (20 Menit Scan)">General Checkup 24 Titik OBD-II (20 Menit Scan) — FREE (Member)</option>
                        <option value="Uji Emisi & Fast Tune-Up (40 Menit Performa)">Uji Emisi &amp; Fast Tune-Up (40 Menit Performa) — Rp 350.000</option>
                        <option value="Layanan Lainnya / Konsultasi di Stall">Layanan Lainnya / Konsultasi di Stall</option>
                    </select>
                </div>

                <div class="p-3 bg-blue-50 rounded-xl border border-blue-200 text-blue-800 text-[11px] leading-relaxed">
                    <i class="fa-solid fa-circle-info text-blue-600 mr-1"></i>
                    Tiket Drop-Pass instan dan rute tercepat akan dikirimkan otomatis ke WhatsApp Anda setelah konfirmasi.
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeClaimPitModal()" class="px-4 py-2 font-bold text-slate-600 hover:text-slate-800 bg-slate-100 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-md shadow-blue-500/20 transition flex items-center gap-1.5">
                        <i class="fa-solid fa-circle-check text-xs"></i>
                        <span>Konfirmasi &amp; Amankan Slot</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toastNotification" class="fixed bottom-5 right-5 z-50 bg-slate-900 text-white px-4 py-3 rounded-xl shadow-xl flex items-center gap-3 text-xs hidden transition-all duration-300">
        <i id="toastIcon" class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
        <span id="toastMsg">Aksi berhasil dilakukan.</span>
    </div>

    <!-- ========================================================= -->
    <!-- 7. SCRIPT & MICRO-INTERACTIONS -->
    <!-- ========================================================= -->
    <script>
        function openClaimPitModal(stallName = 'PIT 04', pkgTitle = null) {
            document.getElementById('modalStallTitle').innerText = 'Amankan Slot ' + stallName + ' Express';
            if (pkgTitle) {
                const sel = document.getElementById('claimPackage');
                for (let i = 0; i < sel.options.length; i++) {
                    if (sel.options[i].text.includes(pkgTitle)) {
                        sel.selectedIndex = i;
                        break;
                    }
                }
            }
            document.getElementById('claimModal').classList.remove('hidden');
        }

        function closeClaimPitModal() {
            document.getElementById('claimModal').classList.add('hidden');
        }

        function submitClaimSlot(e) {
            e.preventDefault();
            const plate = document.getElementById('claimPlate').value.toUpperCase();
            closeClaimPitModal();
            showToast('Slot PIT 04 berhasil diamankan untuk plat ' + plate + '! Estimasi tahan slot 15 menit.', 'fa-bolt', 'text-amber-400');
        }

        function triggerRefreshTelemetri() {
            const icon = document.getElementById('refreshIcon');
            icon.classList.add('fa-spin');
            setTimeout(() => {
                icon.classList.remove('fa-spin');
                showToast('Telemetri sensor OBD & PIT Bay berhasil disinkronkan ulang.', 'fa-rotate', 'text-blue-400');
            }, 800);
        }

        // Countdown timer for 14:58
        let totalSeconds = 14 * 60 + 58;
        const holdEl = document.getElementById('holdTimer');
        if (holdEl) {
            setInterval(() => {
                if (totalSeconds > 0) {
                    totalSeconds--;
                    const m = Math.floor(totalSeconds / 60);
                    const s = totalSeconds % 60;
                    holdEl.innerText = (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s + ' (Tahan Slot)';
                }
            }, 1000);
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
