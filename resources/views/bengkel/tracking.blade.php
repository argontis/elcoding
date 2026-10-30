<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Tracking Servis &amp; Telemetri Pit Bay — {{ $workshop['name'] }}</title>
    <meta name="description" content="Pantau pengerjaan unit Anda secara real-time. Live status inspeksi OBD-II, pit bay telemetry, dan rincian SPK digital.">

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

        /* Pulse animation */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 0.3; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-live {
            animation: pulse-ring 2s infinite ease-in-out;
        }

        /* Circular Progress Meter */
        .progress-ring__circle {
            transition: stroke-dashoffset 0.5s ease-in-out;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- ========================================================= -->
    <!-- 1. TOP ANNOUNCEMENT BAR (Dark Telemetry Node Status) -->
    <!-- ========================================================= -->
    <div class="bg-[#0b0f19] text-xs text-slate-300 border-b border-slate-800 py-2.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3 font-medium">
            <div class="flex items-center gap-2.5">
                <span class="w-2 h-2 rounded-full bg-blue-500 pulse-live"></span>
                <span class="text-xs font-semibold text-slate-200 uppercase tracking-wide font-mono">
                    TERHUBUNG LANGSUNG KE TELEMETRI PIT BAY BENGKEL &bull; LIVE REAL-TIME DATA
                </span>
            </div>

            <div class="flex items-center gap-3 text-xs font-mono text-slate-400">
                <span class="text-emerald-400 flex items-center gap-1.5">
                    <i class="fa-solid fa-satellite-dish text-[11px] animate-pulse"></i>
                    <span>Node ID: PIT-BAY-03 // OBD-II Sync Active</span>
                </span>
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
                        <span class="font-heading font-extrabold text-lg sm:text-xl xl:text-2xl tracking-tight text-slate-900">L-GARAGE</span>
                        <span class="text-[9px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 px-1.5 py-0.5 rounded border border-blue-200 whitespace-nowrap">Pusat Informasi</span>
                    </div>
                    <p class="text-[9px] text-slate-500 font-semibold tracking-wider uppercase -mt-0.5">Automotive Precision Care</p>
                </div>
            </a>

            <!-- Navigation Links (Desktop - Selalu Kesamping / No-Wrap) -->
            <nav class="hidden lg:flex items-center gap-2.5 xl:gap-4 2xl:gap-6 text-xs xl:text-[13px] font-semibold text-slate-600 whitespace-nowrap shrink-0">
                <a href="{{ url('/bengkel') }}" class="hover:text-blue-600 transition flex items-center gap-1 whitespace-nowrap px-1 py-0.5">
                    <span>Beranda &amp; Layanan</span>
                </a>
                <a href="{{ route('bengkel.booking.page') }}" class="hover:text-blue-600 transition flex items-center gap-1 whitespace-nowrap px-1 py-0.5">
                    <span>Booking Servis Cepat</span>
                </a>
                <a href="{{ route('bengkel.tracking.page') }}" class="bg-slate-900 text-white px-3 py-1.5 rounded-lg font-bold flex items-center gap-1 shadow-2xs whitespace-nowrap">
                    <span>Live Tracking Servis</span>
                </a>
                <a href="{{ route('bengkel.garasi.page') }}" class="hover:text-blue-600 transition flex items-center gap-1 whitespace-nowrap px-1 py-0.5">
                    <span>Garasi Saya (Member)</span>
                </a>
            </nav>

            <!-- Quick Plat Search & Action Buttons -->
            <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
                <a href="{{ route('bengkel.booking.page') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition border border-slate-200 whitespace-nowrap">
                    <i class="fa-regular fa-user text-slate-500 text-xs"></i>
                    <span>AKSES TAMU</span>
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition whitespace-nowrap">
                    <i class="fa-solid fa-shield-halved text-blue-400 text-xs"></i>
                    <span>Masuk Member</span>
                </a>
            </div>
        </div>
    </header>

    <!-- ========================================================= -->
    <!-- 3. SEARCH BAR BANNER (LACAK KENDARAAN) -->
    <!-- ========================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 pt-6 pb-2 w-full">
        <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-2xs flex flex-col md:flex-row items-center justify-between gap-4">
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-magnifying-glass-location text-lg"></i>
                </div>
                <div>
                    <h2 class="font-heading font-extrabold text-sm sm:text-base text-slate-900">Lacak Kendaraan Servis Lainnya?</h2>
                    <p class="text-xs text-slate-500">Mode Tamu Tanpa Login &bull; Masukkan Plat Nomor Polisi atau Nomor SPK WO</p>
                </div>
            </div>

            <!-- Search Form (Data Kosong Default) -->
            <form action="{{ route('bengkel.tracking.page') }}" method="GET" class="w-full md:w-auto flex items-center gap-2">
                <div class="relative w-full md:w-72">
                    <i class="fa-solid fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" name="plat" 
                        value="{{ $query }}"
                        placeholder="Masukkan Plat (cth: B 1982 SYZ)..." 
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-9 pr-3 text-xs font-mono font-bold uppercase text-slate-900 placeholder-slate-400 focus:bg-white focus:border-blue-500 focus:outline-none transition">
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs flex items-center gap-1.5 transition shrink-0 cursor-pointer shadow-sm">
                    <i class="fa-solid fa-search"></i>
                    <span>Lacak</span>
                </button>
            </form>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 4. MAIN CONTENT AREA (KOSONG vs TERSEDIA DATA TRACKING) -->
    <!-- ========================================================= -->
    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-6 w-full space-y-6">

        @if($tracking && $tracking['found'])
            
            <!-- 4.1 VEHICLE HEADER & RADIAL TELEMETRY SECTION -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">
                
                <!-- Left Box: Vehicle & Mechanic Profile (Col 8) -->
                <div class="lg:col-span-8 bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs flex flex-col justify-between">
                    <div>
                        <!-- Badges & Category Row -->
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-extrabold text-xs px-2.5 py-1 rounded-md bg-slate-100 text-slate-900 border border-slate-200 tracking-wider">
                                    {{ $tracking['plat'] }}
                                </span>
                                <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 border border-blue-200">
                                    {{ $tracking['wo_number'] }}
                                </span>
                            </div>

                            <div class="flex items-center gap-1.5 text-xs text-blue-700 bg-blue-50/80 px-3 py-1 rounded-lg border border-blue-200/60 font-semibold">
                                <i class="fa-regular fa-compass"></i>
                                <span>KATEGORI SERVIS: <strong>{{ $tracking['service_category'] }}</strong></span>
                            </div>
                        </div>

                        <!-- Vehicle Title -->
                        <h1 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mb-1">
                            {{ $tracking['vehicle_title'] }}
                        </h1>
                        <p class="text-xs text-slate-500 mb-6">
                            Pemilik: <strong class="text-slate-800">{{ $tracking['owner_name'] }}</strong> &bull; Status Akses: <span class="text-blue-700 font-semibold">{{ $tracking['access_status'] }}</span>
                        </p>
                    </div>

                    <!-- 3 Info Pills Strip -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-4 border-t border-slate-100">
                        <!-- Pill 1: SA -->
                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center shrink-0">
                                {{ $tracking['service_advisor']['initial'] }}
                            </div>
                            <div class="min-w-0">
                                <span class="text-[10px] text-slate-400 font-medium block">Service Advisor</span>
                                <strong class="text-xs text-slate-900 block truncate">{{ $tracking['service_advisor']['name'] }}</strong>
                                <a href="{{ $tracking['service_advisor']['wa_link'] }}" target="_blank" class="text-[10px] text-emerald-600 hover:underline font-bold flex items-center gap-1 mt-0.5">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    <span>Chat SA WhatsApp</span>
                                </a>
                            </div>
                        </div>

                        <!-- Pill 2: Mechanic Lead -->
                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-wrench"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="text-[10px] text-slate-400 font-medium block">Mekanik Lead &amp; Stall</span>
                                <strong class="text-xs text-slate-900 block truncate">{{ $tracking['lead_mechanic']['name'] }}</strong>
                                <span class="text-[10px] text-slate-500 block truncate mt-0.5">{{ $tracking['lead_mechanic']['stall'] }}</span>
                            </div>
                        </div>

                        <!-- Pill 3: Odometer -->
                        <div class="bg-slate-50 rounded-xl p-3 border border-slate-100 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-gauge"></i>
                            </div>
                            <div class="min-w-0">
                                <span class="text-[10px] text-slate-400 font-medium block">Odometer Masuk</span>
                                <strong class="text-xs text-slate-900 font-mono block">{{ $tracking['odometer']['km'] }}</strong>
                                <span class="text-[10px] text-slate-500 block truncate mt-0.5">{{ $tracking['odometer']['checkin'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Box: Dark Pit Telemetry Radial Gauge (Col 4) -->
                <div class="lg:col-span-4 bg-[#0b0f19] text-white rounded-2xl p-6 border border-slate-800 shadow-md flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-[10px] text-slate-400 font-mono uppercase tracking-wider block">TELEMETRI PENGERJAAN</span>
                                <strong class="text-xs font-bold text-white">{{ $tracking['telemetry']['stall_name'] }}</strong>
                            </div>
                            <span class="text-[10px] font-bold uppercase font-mono px-2 py-0.5 rounded-full bg-blue-950 text-blue-400 border border-blue-800">
                                AKTIF
                            </span>
                        </div>

                        <!-- Radial 50% Meter -->
                        <div class="flex flex-col items-center justify-center my-3">
                            <div class="relative w-36 h-36 flex items-center justify-center">
                                <svg class="w-full h-full" viewBox="0 0 100 100">
                                    <circle class="text-slate-800 stroke-current" stroke-width="8" cx="50" cy="50" r="40" fill="transparent"></circle>
                                    <circle class="text-blue-500 stroke-current progress-ring__circle" stroke-width="8" stroke-linecap="round" cx="50" cy="50" r="40" fill="transparent"
                                        stroke-dasharray="251.2"
                                        stroke-dashoffset="{{ 251.2 * (1 - $tracking['telemetry']['percentage'] / 100) }}"></circle>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                                    <span class="font-heading font-extrabold text-3xl text-white">{{ $tracking['telemetry']['percentage'] }}%</span>
                                    <span class="text-[10px] font-mono text-slate-400 uppercase tracking-wider">{{ $tracking['telemetry']['elapsed_minutes'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Telemetry Stats Bottom -->
                    <div class="pt-4 border-t border-slate-800 text-xs space-y-1.5">
                        <div class="flex justify-between text-slate-400">
                            <span>Waktu Berjalan:</span>
                            <strong class="text-white font-mono">{{ $tracking['telemetry']['elapsed_minutes'] }}</strong>
                        </div>
                        <div class="flex justify-between text-slate-400">
                            <span>Target Estimasi Selesai:</span>
                            <strong class="text-emerald-400 font-mono">{{ $tracking['telemetry']['estimated_target'] }}</strong>
                        </div>
                    </div>
                </div>

            </div>

            <!-- 4.2 STATUS ALUR KERJA SERVIS (5 PIPELINE STAGES) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100 mb-6">
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Status Alur Kerja Servis</h3>
                        <p class="text-xs text-slate-500">Sinkronisasi otomatis dengan SPK Digital mekanik di lantai bengkel</p>
                    </div>
                    <button type="button" onclick="location.reload()" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-arrows-rotate text-[11px]"></i>
                        <span>Auto-refresh tiap 30 detik</span>
                    </button>
                </div>

                <!-- 5 Workflow Stages Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">
                    @foreach($tracking['workflow_stages'] as $stg)
                        <div class="rounded-xl p-4 border flex flex-col justify-between transition-all {{ 
                            $stg['status'] === 'selesai' ? 'bg-white border-blue-200' : (
                            $stg['status'] === 'aktif' ? 'bg-blue-50/80 border-blue-500 ring-2 ring-blue-500/20' : (
                            $stg['status'] === 'warning' ? 'bg-red-50/60 border-red-300' : 'bg-slate-50 border-slate-200 opacity-60'
                            )) }}">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs {{
                                        $stg['status'] === 'selesai' ? 'bg-blue-100 text-blue-700' : (
                                        $stg['status'] === 'aktif' ? 'bg-blue-600 text-white animate-spin' : (
                                        $stg['status'] === 'warning' ? 'bg-red-600 text-white' : 'bg-slate-200 text-slate-400'
                                        )) }}">
                                        @if($stg['status'] === 'selesai')
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                        @elseif($stg['status'] === 'aktif')
                                            <i class="fa-solid fa-gear text-[10px]"></i>
                                        @elseif($stg['status'] === 'warning')
                                            <i class="fa-solid fa-exclamation text-[10px]"></i>
                                        @else
                                            <i class="fa-regular fa-clock text-[10px]"></i>
                                        @endif
                                    </span>

                                    <span class="text-[10px] font-mono font-bold {{
                                        $stg['status'] === 'warning' ? 'bg-red-100 text-red-700 px-1.5 py-0.5 rounded' : 'text-slate-500'
                                    }}">
                                        {{ $stg['time'] }}
                                    </span>
                                </div>

                                <span class="text-[9px] font-extrabold uppercase font-mono block mb-1 {{
                                    $stg['status'] === 'warning' ? 'text-red-700' : ($stg['status'] === 'aktif' ? 'text-blue-700' : 'text-slate-400')
                                }}">
                                    {{ $stg['badge'] }}
                                </span>

                                <strong class="font-heading font-bold text-xs text-slate-900 block mb-1">
                                    {{ $stg['title'] }}
                                </strong>

                                <p class="text-[11px] text-slate-500 leading-relaxed">
                                    {{ $stg['desc'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 4.3 TEMUAN INSPEKSI MEMBUTUHKAN PERSETUJUAN ANDA (RED WARNING CARD) -->
            @if(isset($tracking['inspection_alert']))
                <div class="bg-red-50/70 border border-red-200 rounded-2xl p-6 shadow-2xs">
                    
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-red-200/80 mb-5">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-red-600 text-white flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-triangle-exclamation text-base"></i>
                            </div>
                            <div>
                                <h3 class="font-heading font-extrabold text-base text-red-950">
                                    {{ $tracking['inspection_alert']['title'] }}
                                </h3>
                                <p class="text-xs text-red-800">
                                    {{ $tracking['inspection_alert']['subtitle'] }}
                                </p>
                            </div>
                        </div>

                        <span class="text-[10px] font-mono font-bold bg-red-600 text-white px-3 py-1 rounded-full uppercase tracking-wider self-start sm:self-auto">
                            {{ $tracking['inspection_alert']['status_badge'] }}
                        </span>
                    </div>

                    <!-- Split: Micrometer Photo vs Recommended Actions -->
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                        
                        <!-- Left: Inspection Evidence Photo (Col 5) -->
                        <div class="lg:col-span-5">
                            <div class="relative rounded-xl overflow-hidden bg-slate-900 border border-red-200 shadow-sm">
                                <img src="{{ $tracking['inspection_alert']['image'] }}" alt="Bukti Foto Inspeksi" class="w-full h-52 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                
                                <div class="absolute top-3 left-3 text-[10px] font-mono text-white bg-black/60 px-2 py-0.5 rounded backdrop-blur-xs">
                                    BUKTI FOTO INSPEKSI DIGITAL (PIT BAY 03)
                                </div>

                                <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-white text-[11px] font-mono">
                                    <span class="bg-red-600 font-bold px-2 py-0.5 rounded shadow-sm">
                                        {{ $tracking['inspection_alert']['measure_badge'] }}
                                    </span>
                                    <span class="text-slate-300 text-[10px]">
                                        {{ $tracking['inspection_alert']['timestamp'] }}
                                    </span>
                                </div>
                            </div>
                            
                            <p class="text-[11px] text-red-900/80 italic mt-2 leading-relaxed">
                                &ldquo;{{ $tracking['inspection_alert']['mechanic_quote'] }}&rdquo;
                            </p>
                        </div>

                        <!-- Right: Part & Labor Recommendations (Col 7) -->
                        <div class="lg:col-span-7 space-y-3.5">
                            <span class="text-[10px] font-bold font-mono uppercase text-slate-500 tracking-wider block">
                                REKOMENDASI TINDAKAN &amp; SUKU CADANG OEM:
                            </span>

                            @foreach($tracking['inspection_alert']['actions'] as $act)
                                <div class="bg-white rounded-xl p-3.5 border border-red-200 flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-[10px] font-bold font-mono px-2 py-1 rounded {{ $act['type'] === 'PART' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                            {{ $act['type'] }}
                                        </span>
                                        <div>
                                            <strong class="font-heading font-bold text-xs text-slate-900 block">{{ $act['name'] }}</strong>
                                            <span class="text-[10px] text-slate-500 block">{{ $act['spec'] }}</span>
                                        </div>
                                    </div>
                                    <div class="text-right shrink-0">
                                        <strong class="font-heading font-extrabold text-sm text-slate-900 block">{{ $act['price'] }}</strong>
                                        <span class="text-[10px] text-slate-400 block">{{ $act['subtext'] }}</span>
                                    </div>
                                </div>
                            @endforeach

                            <div class="pt-3 border-t border-red-200/80 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-700">Subtotal Penambahan Servis:</span>
                                <strong class="font-heading font-extrabold text-lg text-slate-900">{{ $tracking['inspection_alert']['total_penambahan'] }}</strong>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                                <button type="button" onclick="alert('Terima kasih! Persetujuan penggantian komponen telah dikirimkan ke tablet mekanik Joko Pratama.')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-sm transition cursor-pointer">
                                    <i class="fa-solid fa-check"></i>
                                    <span>Setujui Penggantian Komponen</span>
                                </button>

                                <button type="button" onclick="alert('Penggantian komponen ditunda. Tim SA akan mendiskusikan kembali saat pengambilan unit.')" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                                    <i class="fa-solid fa-xmark"></i>
                                    <span>Tolak / Tunda Penggantian</span>
                                </button>
                            </div>

                            <div class="text-center pt-1">
                                <a href="{{ $tracking['service_advisor']['wa_link'] }}" target="_blank" class="text-xs text-blue-700 hover:underline font-semibold inline-flex items-center gap-1.5">
                                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                    <span>Tanya Service Advisor Terlebih Dahulu via WhatsApp</span>
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            @endif

            <!-- 4.4 RINCIAN ESTIMASI BIAYA & NOTA BERJALAN (SPK DIGITAL) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100 mb-6">
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Rincian Estimasi Biaya &amp; Nota Berjalan (SPK Digital)</h3>
                        <p class="text-xs text-slate-500">Perhitungan biaya transparan berbasis suku cadang resmi &amp; satuan waktu pengerjaan</p>
                    </div>

                    <button type="button" onclick="window.print()" class="text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 border border-slate-200 px-3.5 py-2 rounded-xl flex items-center gap-1.5 transition cursor-pointer self-start sm:self-auto">
                        <i class="fa-solid fa-file-pdf text-red-500"></i>
                        <span>Unduh Struk PDF</span>
                    </button>
                </div>

                <!-- Table & Cashier QR Split -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    
                    <!-- Table Items (Col 8) -->
                    <div class="lg:col-span-8 overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-[10px] uppercase font-mono font-bold text-slate-400 border-b border-slate-200 pb-2">
                                    <th class="py-2.5">DESKRIPSI LAYANAN &amp; PART</th>
                                    <th class="py-2.5 text-center">QTY / SATUAN</th>
                                    <th class="py-2.5 text-right">HARGA SATUAN</th>
                                    <th class="py-2.5 text-right">SUBTOTAL</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($tracking['invoice_items'] as $item)
                                    <tr class="{{ $item['is_extra'] ? 'bg-blue-50/50 font-medium' : '' }}">
                                        <td class="py-3 pr-3">
                                            <strong class="font-heading font-bold text-slate-900 block text-xs {{ $item['is_extra'] ? 'text-blue-700' : '' }}">
                                                {{ $item['desc'] }}
                                            </strong>
                                            <span class="text-[10px] text-slate-400 block">{{ $item['subdesc'] }}</span>
                                        </td>
                                        <td class="py-3 px-2 text-center text-slate-600 font-mono">{{ $item['qty'] }}</td>
                                        <td class="py-3 px-2 text-right text-slate-600 font-mono">{{ $item['price'] }}</td>
                                        <td class="py-3 pl-2 text-right font-heading font-bold text-slate-900 {{ $item['is_extra'] ? 'text-blue-700' : '' }}">
                                            {{ $item['subtotal'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Cashier QR & Billing Box (Col 4) -->
                    <div class="lg:col-span-4 bg-slate-50 border border-slate-200 rounded-xl p-5 text-xs">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-200 mb-3">
                            <span class="font-bold text-slate-700 uppercase font-mono text-[10px]">SIMULASI TAGIHAN KASIR</span>
                            <span class="text-[10px] text-slate-400">PPN 11% Included</span>
                        </div>

                        <div class="space-y-1.5 text-slate-600 mb-4">
                            <div class="flex justify-between">
                                <span>Subtotal Jasa:</span>
                                <strong class="text-slate-800 font-mono">{{ $tracking['billing_summary']['subtotal_jasa'] }}</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>Subtotal Spare Part:</span>
                                <strong class="text-slate-800 font-mono">{{ $tracking['billing_summary']['subtotal_part'] }}</strong>
                            </div>
                            <div class="flex justify-between text-blue-600">
                                <span>Diskon Promo Booking:</span>
                                <strong class="font-mono">{{ $tracking['billing_summary']['diskon_promo'] }}</strong>
                            </div>
                            <div class="flex justify-between">
                                <span>PPN Terhitung (11%):</span>
                                <strong class="text-slate-800 font-mono">{{ $tracking['billing_summary']['ppn_nominal'] }}</strong>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-200 flex items-baseline justify-between mb-4">
                            <div>
                                <span class="text-[10px] text-slate-400 font-medium block">Total Estimasi:</span>
                            </div>
                            <strong class="font-heading font-extrabold text-2xl text-blue-600 tracking-tight">
                                {{ $tracking['billing_summary']['total_estimasi'] }}
                            </strong>
                        </div>

                        <p class="text-[10px] text-slate-400 leading-tight mb-4">
                            *Tagihan final dicetak kasir saat serah terima unit di front-office.
                        </p>

                        <!-- QRIS Fast Payment Box -->
                        <div class="bg-white p-3.5 rounded-xl border border-slate-200 text-center">
                            <span class="text-[10px] font-bold font-mono text-slate-500 uppercase block mb-1">OPSI BAYAR CEPAT: QRIS DINAMIS INSTAN</span>
                            <p class="text-[10px] text-slate-400 mb-2 leading-tight">
                                Bayar lebih awal tanpa antre di kasir. Notifikasi pelunasan otomatis masuk ke tablet mekanik.
                            </p>
                            <div class="p-2 bg-slate-100 rounded-lg inline-block border border-slate-200 mb-2">
                                <i class="fa-solid fa-qrcode text-6xl text-slate-800"></i>
                            </div>
                            <div class="text-[10px] text-slate-400 font-semibold">
                                Mendukung BCA, Mandiri, GoPay, OVO, ShopeePay
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        @elseif($tracking && !$tracking['found'])
            
            <!-- 4.2 NOT FOUND STATE (JIKA DICARI TIDAK ADA) -->
            <div class="bg-white rounded-2xl p-8 sm:p-12 border border-slate-200 text-center shadow-2xs">
                <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center mx-auto mb-4 border border-amber-200">
                    <i class="fa-solid fa-car-tunnel text-2xl"></i>
                </div>
                <h3 class="font-heading font-extrabold text-lg sm:text-xl text-slate-900 mb-1">
                    Kendaraan Belum Terdaftar di Antrean Servis Aktif
                </h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto mb-6 leading-relaxed">
                    {{ $tracking['message'] }}
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="{{ route('bengkel.tracking.page', ['plat' => 'B 1982 SYZ']) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition">
                        Tampilkan Data Demo (Plat B 1982 SYZ)
                    </a>
                    <a href="{{ route('bengkel.booking.page') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 px-5 rounded-xl text-xs transition border border-slate-200">
                        Booking Servis Sekarang
                    </a>
                </div>
            </div>

        @else
            
            <!-- 4.3 DEFAULT CLEAN / EMPTY STATE (SESUAI REQUEST USER) -->
            <div class="bg-white rounded-2xl p-8 sm:p-16 border border-slate-200 text-center shadow-2xs">
                <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-4 border border-blue-100">
                    <i class="fa-solid fa-satellite-dish text-2xl"></i>
                </div>
                <h3 class="font-heading font-extrabold text-xl sm:text-2xl text-slate-900 mb-2">
                    Live Tracking &amp; Telemetri Kendaraan
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 max-w-lg mx-auto mb-6 leading-relaxed">
                    Masukkan nomor plat polisi kendaraan Anda pada form pencarian di atas untuk memeriksa status alur kerja, telemetri sensor OBD-II, dan estimasi biaya secara real-time.
                </p>
                
                <div class="inline-flex flex-col sm:flex-row items-center gap-3">
                    <a href="{{ route('bengkel.tracking.page', ['plat' => 'B 1982 SYZ']) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl text-xs flex items-center gap-2 shadow-md shadow-blue-500/20 transition">
                        <i class="fa-solid fa-play text-xs"></i>
                        <span>Muat Contoh Telemetri Lengkap (Plat B 1982 SYZ)</span>
                    </a>
                    <a href="{{ route('bengkel.booking.page') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 px-5 rounded-xl text-xs transition border border-slate-200">
                        Daftar Servis Baru
                    </a>
                </div>
            </div>

        @endif

        <!-- 4.5 BOTTOM HELP STRIP (CUSTOMER SUPPORT & FRONT OFFICE) -->
        <div class="bg-blue-50/70 border border-blue-200/80 rounded-2xl p-5 flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-headset text-lg"></i>
                </div>
                <div>
                    <h4 class="font-heading font-bold text-sm text-slate-900">Butuh Bantuan atau Ingin Ubah Permintaan Servis?</h4>
                    <p class="text-xs text-slate-500">Customer Support Frontline L-Garage siap melayani konsultasi teknis selama servis berlangsung.</p>
                </div>
            </div>

            <div class="flex items-center gap-2.5 shrink-0">
                <a href="tel:{{ $workshop['no_darurat'] }}" class="bg-white hover:bg-slate-50 text-slate-800 border border-slate-200 font-bold py-2 px-3.5 rounded-xl text-xs flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-phone text-blue-600 text-[10px]"></i>
                    <span>Hotline Bebas Pulsa</span>
                </a>
                <a href="https://api.whatsapp.com/send?phone={{ $workshop['no_whatsapp'] }}&text=Halo%20Front%20Office%20L-Garage,%20saya%20ingin%20konsultasi%20mengenai%20unit%20yang%20sedang%20diservis" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl text-xs flex items-center gap-1.5 shadow-sm transition">
                    <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                    <span>Hubungi Front Office</span>
                </a>
            </div>
        </div>

    </main>

    <!-- ========================================================= -->
    <!-- 5. FOOTER (Matching L-Garage) -->
    <!-- ========================================================= -->
    <footer class="bg-slate-100/90 border-t border-slate-200 mt-12 text-xs text-slate-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 sm:py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-7 h-7 rounded-lg bg-blue-600 text-white flex items-center justify-center text-xs">
                            <i class="fa-solid fa-car-side"></i>
                        </div>
                        <span class="font-heading font-extrabold text-base text-slate-900 tracking-tight">{{ $workshop['name'] }}</span>
                    </div>
                    <p class="text-slate-500 leading-relaxed text-xs">
                        Sistem servis kendaraan modern berstandar OBD industrial. Transparansi biaya, sparepart terjamin, dan live workshop inspection telemetry.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-truck-medical text-red-500"></i>
                        <span>Darurat &amp; Derek 24 Jam</span>
                    </h4>
                    <p class="text-slate-500 text-xs mb-2">
                        Hubungi Service Roadside Assistance kami untuk penjemputan armada bermasalah.
                    </p>
                    <a href="tel:{{ $workshop['no_darurat'] }}" class="font-heading font-extrabold text-sm text-red-600 hover:text-red-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-phone text-xs"></i>
                        <span>{{ $workshop['no_darurat'] }} (Bebas Pulsa)</span>
                    </a>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-blue-600"></i>
                        <span>Google Maps Cabang</span>
                    </h4>
                    <p class="text-slate-500 text-xs mb-2">
                        {{ $workshop['alamat'] }}
                    </p>
                    <a href="{{ $workshop['maps_url'] }}" target="_blank" class="font-bold text-blue-600 hover:underline flex items-center gap-1">
                        <span>Buka Navigasi Google Maps</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                        <span>WhatsApp Konsultasi</span>
                    </h4>
                    <p class="text-slate-500 text-xs mb-2">
                        Tanya estimasi servis, suku cadang OEM, atau konsultasi kendala transmisi/mesin.
                    </p>
                    <a href="https://api.whatsapp.com/send?phone={{ $workshop['no_whatsapp'] }}" target="_blank" class="font-bold text-emerald-700 hover:underline flex items-center gap-1">
                        <span>Chat Advisor L-Garage</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-400">
                <p>&copy; {{ date('Y') }} {{ $workshop['name'] }} Automotive Service System. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4 text-slate-500">
                    <a href="{{ url('/bengkel') }}" class="hover:text-blue-600">Beranda Bengkel</a>
                    <span>&bull;</span>
                    <a href="{{ route('login') }}" class="hover:text-blue-600">Area Admin Bengkel</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
