<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $workshop['name'] }} — {{ $workshop['tagline'] }}</title>
    <meta name="description" content="{{ $workshop['subheadline'] }}">

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
                        },
                        darkpit: '#0b1329',
                        darkcard: '#0f172a',
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

        /* Smooth card hover transitions */
        .service-card {
            transition: all 0.25s ease-in-out;
        }
        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 28px -8px rgba(30, 64, 175, 0.12), 0 4px 12px -2px rgba(0, 0, 0, 0.04);
        }

        /* Pulsing indicator */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.3); opacity: 0.3; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-live {
            animation: pulse-ring 2s infinite ease-in-out;
        }

        /* License plate input styling */
        .plate-box {
            background: #ffffff;
            border: 2px solid #cbd5e1;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);
            letter-spacing: 2px;
            font-weight: 700;
        }
        .plate-box:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- ========================================================= -->
    <!-- 1. TOP ANNOUNCEMENT BAR (Dark Precision Live Status) -->
    <!-- ========================================================= -->
    <div class="bg-[#0b0f19] text-xs text-slate-300 border-b border-slate-800 py-2.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3 font-medium">
            <!-- Left: Active status & operating hours -->
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

            <!-- Right: Duration & Drop Pass -->
            <div class="flex items-center gap-4 text-xs">
                <div class="flex items-center gap-1.5 text-slate-300">
                    <i class="fa-solid fa-stopwatch text-amber-400 text-xs"></i>
                    <span>Rata-rata Servis Ringan: <strong class="text-white">{{ $workshop['rata_durasi'] }}</strong></span>
                </div>
                <span class="text-slate-700 hidden sm:inline-block">|</span>
                <button type="button" onclick="openDropPassModal()" class="hidden sm:inline-flex items-center gap-1.5 text-blue-400 hover:text-blue-300 font-medium transition cursor-pointer">
                    <i class="fa-solid fa-qrcode text-xs"></i>
                    <span>Download Real-time OBD &amp; Drop Pass</span>
                </button>
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
            <nav class="hidden lg:flex items-center gap-7 text-sm font-semibold text-slate-600">
                <a href="{{ url('/bengkel#layanan') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Beranda &amp; Layanan</span>
                </a>
                <a href="{{ route('bengkel.booking.page') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Booking Servis Cepat</span>
                </a>
                <a href="{{ route('bengkel.tracking.page') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Live Tracking Servis</span>
                </a>
                <a href="#member-section" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Garansi Saya (Member)</span>
                </a>
            </nav>

            <!-- Quick Plat Search & Action Buttons -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Stall Status Pill -->
                <div class="hidden xl:flex items-center gap-1.5 bg-blue-50/80 text-blue-700 border border-blue-200/60 px-3 py-1.5 rounded-lg text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $workshop['status_bengkel'] }}</span>
                </div>

                <!-- Quick Plate Search in Header -->
                <form action="{{ route('bengkel.lacak') }}" method="POST" class="hidden md:flex items-center relative">
                    @csrf
                    <div class="relative">
                        <input type="text" name="plat_nomor" placeholder="Cek Plat (B 1234 CD)..." 
                            value="{{ $searchPlate }}"
                            class="w-44 lg:w-52 bg-slate-100/90 text-slate-800 placeholder-slate-400 text-xs font-mono font-semibold py-2 pl-8 pr-3 rounded-lg border border-slate-200 focus:bg-white focus:w-60 focus:border-blue-500 focus:outline-none transition-all">
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    </div>
                </form>

                <!-- Guest Access Button -->
                <button type="button" onclick="openBookingModal('Mode Tamu')" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition border border-slate-200">
                    <i class="fa-regular fa-user text-slate-500 text-xs"></i>
                    <span>AKSES TAMU</span>
                </button>

                <!-- Member / Garasi Login Button -->
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-shield-halved text-blue-400 text-xs"></i>
                    <span>Masuk / Daftar Garasi Member</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Success Message / Alert Notifications -->
    @if(session('success_booking'))
        <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4">
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-emerald-800 text-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                    <div>
                        <strong class="font-bold">Booking Terkirim!</strong> {{ session('success_booking') }}
                    </div>
                </div>
                @if(session('wa_redirect'))
                    <a href="{{ session('wa_redirect') }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-emerald-700 transition">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>Buka Chat WhatsApp</span>
                    </a>
                @endif
            </div>
        </div>
    @endif

    <!-- ========================================================= -->
    <!-- 3. HERO SECTION (Split: Value Pitch vs Tracking & Booking) -->
    <!-- ========================================================= -->
    <section class="py-8 sm:py-12 px-4 sm:px-8 bg-gradient-to-b from-blue-50/40 via-white to-[#f8fafc]">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
            
            <!-- LEFT COLUMN: Headline & Value Proposition -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <!-- Precision Standard Tag -->
                <div class="inline-flex items-center gap-2 bg-blue-100/70 border border-blue-200 text-blue-800 text-xs font-bold px-3 py-1 rounded-full w-fit mb-4">
                    <i class="fa-solid fa-wrench text-blue-600 text-xs"></i>
                    <span>{{ $workshop['tagline'] }}</span>
                </div>

                <!-- Main Heading -->
                <h1 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight leading-[1.18] mb-4">
                    {{ $workshop['headline'] }} <span class="text-blue-600 underline decoration-blue-200 decoration-wavy decoration-2">{{ $workshop['headline_accent'] }}</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6 max-w-2xl">
                    {{ $workshop['subheadline'] }}
                </p>

                <!-- Live Diagnostic Telemetry Live Feed Box -->
                <div class="bg-blue-50/90 border border-blue-200/90 rounded-2xl p-4 sm:p-5 mb-8 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-500/25">
                            <i class="fa-solid fa-gauge-high text-xl"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-sm text-slate-900">{{ $telemetry['title'] }}</span>
                                <span class="inline-block w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                            </div>
                            <p class="text-xs text-slate-600 mt-0.5 font-medium">{{ $telemetry['detail'] }}</p>
                        </div>
                    </div>
                    <div class="bg-white border border-blue-200 text-blue-700 text-xs font-mono font-bold px-3.5 py-1.5 rounded-lg shadow-2xs whitespace-nowrap">
                        <i class="fa-solid fa-circle-dot text-emerald-500 mr-1.5 text-[10px]"></i>{{ $telemetry['stall_ready'] }}
                    </div>
                </div>

                <!-- Key Metrics & Counter Strip -->
                <div class="grid grid-cols-3 gap-4 pt-2 border-t border-slate-200/80">
                    <div>
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">{{ $metrics['unit_terlayani'] }}</div>
                        <div class="text-xs text-slate-500 font-medium mt-0.5">Unit Terlayani</div>
                    </div>
                    <div class="border-l border-slate-200/80 pl-4">
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">{{ $metrics['kepuasan_pemilik'] }}</div>
                        <div class="text-xs text-slate-500 font-medium mt-0.5">Kepuasan Pemilik</div>
                    </div>
                    <div class="border-l border-slate-200/80 pl-4">
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">{{ $metrics['garansi_servis'] }}</div>
                        <div class="text-xs text-slate-500 font-medium mt-0.5">Garansi Servis &amp; PK</div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Dual Interactive Cards (Lacak Servis & Booking Jadwal) -->
            <div class="lg:col-span-5 flex flex-col gap-5" id="lacak-section">
                
                <!-- CARD 1: Lacak Servis Tanpa Login (MODE TAMU) -->
                <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-md relative overflow-hidden">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-600 pulse-live"></span>
                            <h2 class="font-heading font-bold text-base text-slate-900">Lacak Servis Tanpa Login</h2>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 px-2 py-0.5 rounded border border-blue-200/60 font-mono">
                            MODE TAMU
                        </span>
                    </div>

                    <p class="text-xs text-slate-500 leading-relaxed mb-4">
                        Masukkan nomor registrasi plat polisi kendaraan Anda untuk memeriksa status pengerjaan saat ini &amp; laporan inspeksi digital.
                    </p>

                    <!-- Form Plat Nomor (Default Kosong sesuai request user) -->
                    <form id="trackingForm" onsubmit="handleTrackSubmit(event)">
                        <div class="mb-3">
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                                <span>Plat Nomor Kendaraan</span>
                                <span class="text-slate-400 font-normal lowercase">cth: b 1982 syz</span>
                            </label>
                            <div class="relative">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center gap-1.5 text-slate-400">
                                    <i class="fa-solid fa-id-card text-sm"></i>
                                    <span class="font-mono text-xs font-bold text-slate-500 border-r border-slate-300 pr-1.5">ID</span>
                                </div>
                                <input type="text" id="inputPlat" name="plat_nomor" 
                                    placeholder="MASUKKAN PLAT (CTH: B 1982 SYZ)"
                                    value="{{ $searchPlate }}"
                                    class="plate-box w-full py-3 pl-16 pr-4 rounded-xl text-sm uppercase text-slate-900 font-mono font-bold tracking-widest placeholder-slate-400">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="btnCekStatus" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-md shadow-blue-500/25 flex items-center justify-center gap-2 text-sm transition cursor-pointer">
                            <i class="fa-solid fa-bolt-lightning text-xs"></i>
                            <span>Cek Status Live Pengerjaan</span>
                        </button>
                    </form>

                    <!-- Footer of Card 1: Security & Demo quick fill -->
                    <div class="flex items-center justify-between mt-3 text-[11px] text-slate-500 pt-2 border-t border-slate-100">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-lock text-emerald-600 text-[10px]"></i>
                            <span>Enkripsi Protokol Bengkel</span>
                        </span>
                        <button type="button" onclick="fillDemoPlate()" class="text-blue-600 hover:text-blue-800 font-bold transition cursor-pointer">
                            Coba Plat Demo (B 1982 SYZ)
                        </button>
                    </div>

                    <!-- Tracking Result Interactive Container -->
                    <div id="trackResultBox" class="mt-4 pt-4 border-t border-slate-200 {{ $trackResult ? '' : 'hidden' }}">
                        @if($trackResult && $trackResult['found'])
                            <div class="bg-blue-50/70 border border-blue-200 rounded-xl p-4">
                                <div class="flex items-center justify-between mb-2 pb-2 border-b border-blue-200/80">
                                    <div>
                                        <span class="font-mono font-bold text-base text-slate-900 bg-white px-2 py-0.5 rounded border border-blue-300">{{ $trackResult['plat_formatted'] }}</span>
                                        <div class="text-xs text-slate-600 mt-1 font-semibold">{{ $trackResult['model'] }}</div>
                                    </div>
                                    <span class="text-xs font-bold text-emerald-700 bg-emerald-100 border border-emerald-200 px-2 py-1 rounded-md flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        {{ $trackResult['status'] }}
                                    </span>
                                </div>

                                <div class="space-y-1.5 text-xs text-slate-700 mb-3">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Lokasi Stall:</span>
                                        <strong class="text-slate-900">{{ $trackResult['stall'] }}</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Mekanik Handal:</span>
                                        <strong class="text-slate-900">{{ $trackResult['mekanik'] }}</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Paket Dikerjakan:</span>
                                        <strong class="text-blue-700">{{ $trackResult['paket'] }}</strong>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Estimasi Selesai:</span>
                                        <strong class="text-slate-900">{{ $trackResult['estimasi_selesai'] }}</strong>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-3">
                                    <div class="flex justify-between text-[11px] font-bold text-slate-700 mb-1">
                                        <span>Progres Pengerjaan</span>
                                        <span class="text-blue-600">{{ $trackResult['progress'] }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" style="width: {{ $trackResult['progress'] }}%"></div>
                                    </div>
                                </div>

                                <button type="button" onclick="openDetailModal()" class="w-full bg-white hover:bg-slate-50 text-blue-700 border border-blue-300 font-bold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5 transition">
                                    <i class="fa-solid fa-file-waveform"></i>
                                    <span>Lihat Laporan Lengkap &amp; Telemetri OBD</span>
                                </button>
                            </div>
                        @elseif($trackResult && !$trackResult['found'])
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3.5 text-xs text-amber-800">
                                <div class="flex items-start gap-2">
                                    <i class="fa-solid fa-circle-exclamation text-amber-600 text-sm mt-0.5"></i>
                                    <div>
                                        <strong>Plat Tidak Ditemukan:</strong> {{ $trackResult['message'] }}
                                        <div class="mt-2">
                                            <button type="button" onclick="openBookingModal('{{ $trackResult['plat_formatted'] }}')" class="font-bold text-blue-700 underline hover:text-blue-900">
                                                Booking antrean untuk unit ini sekarang &rarr;
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- CARD 2: Booking Jadwal Servis (HEMAT WAKTU) -->
                <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/90 shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="font-heading font-bold text-base text-slate-900">Booking Jadwal Servis</h2>
                        <span class="text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 px-2 py-0.5 rounded border border-emerald-200/60 font-mono">
                            HEMAT WAKTU
                        </span>
                    </div>

                    <p class="text-xs text-slate-500 leading-relaxed mb-4">
                        Pilih slot kedatangan tanpa antre di bengkel. Konfirmasi instan via WhatsApp dan live alert reminder.
                    </p>

                    <div class="grid grid-cols-2 gap-3 mb-3" id="booking-section">
                        <!-- Booking Tamu Button -->
                        <button type="button" onclick="openBookingModal('Mode Tamu')" class="bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 px-3 rounded-xl text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                            <i class="fa-regular fa-calendar-check text-slate-400"></i>
                            <span>Booking Tamu</span>
                        </button>

                        <!-- Masuk Member Button -->
                        <a href="{{ route('login') }}" class="bg-white hover:bg-slate-50 text-slate-800 border border-slate-300 font-bold py-2.5 px-3 rounded-xl text-xs flex items-center justify-center gap-2 transition text-center">
                            <i class="fa-solid fa-crown text-amber-500"></i>
                            <span>Masuk Member <span class="text-[10px] text-blue-600">(Diskon 5%)</span></span>
                        </a>
                    </div>

                    <!-- Towing & Pick-up service subtext -->
                    <div class="flex items-center gap-2 text-[11px] text-slate-500 bg-slate-50 border border-slate-200/60 px-3 py-2 rounded-lg">
                        <i class="fa-solid fa-truck-pickup text-blue-600"></i>
                        <span>Tersedia fasilitas pick-up &amp; towing radius 15 KM</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 4. THREE VALUE PROPOSITIONS BAR -->
    <!-- ========================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-4 w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($values as $v)
                <div class="bg-white rounded-xl p-4 border border-slate-200/80 shadow-2xs flex items-center gap-3.5 hover:border-blue-300 transition">
                    <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 border border-blue-100 flex items-center justify-center shrink-0">
                        <i class="{{ $v['icon'] }} text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-sm text-slate-900 leading-snug">{{ $v['title'] }}</h3>
                        <p class="text-xs text-slate-500 leading-tight mt-0.5">{{ $v['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 5. KATALOG SERVIS STANDAR PRESISI (4 Service Cards) -->
    <!-- ========================================================= -->
    <section id="layanan" class="py-12 sm:py-16 px-4 sm:px-8 bg-white border-t border-slate-200/60">
        <div class="max-w-7xl mx-auto">
            
            <!-- Section Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 font-mono">KATALOG SERVIS STANDAR PRESISI</span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight mt-1">
                        Paket Servis Transparan &amp; Terukur
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-2 max-w-2xl leading-relaxed">
                        Tidak ada biaya tersembunyi. Estimasi waktu tertera dengan jaminan mekanik tersertifikasi ASE &amp; BNSP.
                    </p>
                </div>
                <div class="text-right shrink-0">
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg">
                        <i class="fa-solid fa-clipboard-check text-blue-600"></i>
                        <span>Termasuk jasa + inspeksi digital 20 titik</span>
                    </span>
                </div>
            </div>

            <!-- Grid of 4 Precision Service Packages -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($packages as $pkg)
                    <div class="service-card bg-white rounded-2xl border border-slate-200/90 overflow-hidden flex flex-col justify-between shadow-2xs group">
                        
                        <!-- Top Image & Badges -->
                        <div>
                            <div class="relative h-44 overflow-hidden bg-slate-100">
                                <img src="{{ $pkg['image'] }}" alt="{{ $pkg['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                                
                                <!-- Top Pill: Category & Duration -->
                                <div class="absolute top-3 left-3 right-3 flex items-center justify-between text-xs">
                                    <span class="font-bold text-[10px] px-2.5 py-1 rounded-md uppercase font-mono tracking-wider {{ $pkg['id'] === 'servis-berkala' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white/90 text-slate-900 backdrop-blur-xs' }}">
                                        {{ $pkg['badge'] }}
                                    </span>
                                    <span class="bg-black/60 backdrop-blur-xs text-white text-[11px] font-semibold px-2 py-0.5 rounded flex items-center gap-1">
                                        <i class="fa-regular fa-clock text-[10px]"></i>
                                        {{ $pkg['durasi'] }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <h3 class="font-heading font-bold text-lg text-slate-900 tracking-tight mb-1.5">{{ $pkg['title'] }}</h3>
                                <p class="text-xs text-slate-500 leading-relaxed mb-4 min-h-[38px]">{{ $pkg['desc'] }}</p>

                                <!-- Checklist Cakupan Pekerjaan -->
                                <div class="pt-3 border-t border-slate-100">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-2 font-mono">CAKUPAN PEKERJAAN:</span>
                                    <ul class="space-y-1.5 text-xs text-slate-700">
                                        @foreach($pkg['cakupan'] as $point)
                                            <li class="flex items-start gap-2">
                                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                                <span class="leading-tight">{{ $point }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Price & Action Button -->
                        <div class="p-5 pt-0 mt-2">
                            <div class="flex items-baseline justify-between mb-3 pt-3 border-t border-slate-100">
                                <span class="text-[11px] text-slate-500 font-medium">Mulai Dari</span>
                                <span class="font-heading font-extrabold text-lg text-blue-600 tracking-tight">{{ $pkg['harga'] }}</span>
                            </div>

                            <button type="button" 
                                onclick="openBookingModal('{{ $pkg['title'] }}')"
                                class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded-xl text-xs flex items-center justify-center gap-1.5 transition cursor-pointer group-hover:bg-blue-600">
                                <span>Pilih Paket</span>
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 6. FLEKSIBILITAS PELANGGAN (Mode Tamu vs Garasi Member) -->
    <!-- ========================================================= -->
    <section id="member-section" class="py-12 sm:py-16 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 font-mono">FLEKSIBILITAS PELANGGAN</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-1">
                    Pilih Cara Anda Servis di {{ $workshop['name'] }}
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Mau cepat tanpa registrasi akun, atau kumpulkan poin dengan rekam medis kendaraan terstruktur? Keduanya tetap transparan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-stretch">
                
                <!-- CARD A: Mode Tamu (Tanpa Akun) -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/90 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-bold text-slate-500 uppercase font-mono tracking-wider">CEPAT &amp; PRAKTIS</span>
                            <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                                <i class="fa-regular fa-user text-sm"></i>
                            </div>
                        </div>

                        <h3 class="font-heading font-extrabold text-xl text-slate-900 mb-2">Mode Tamu (Tanpa Akun)</h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-6">
                            Cocok untuk pengemudi yang ingin servis instan hari ini tanpa ribet mengingat password atau mendaftar profil akun.
                        </p>

                        <ul class="space-y-4 text-xs text-slate-700">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-blue-600 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-slate-900 block font-bold mb-0.5">Booking Instan</strong>
                                    <span class="text-slate-500 leading-relaxed">Cukup isi nama, nomor WhatsApp, plat mobil, dan paket servis.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-blue-600 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-slate-900 block font-bold mb-0.5">Live Tracking Plat Nomer</strong>
                                    <span class="text-slate-500 leading-relaxed">Cek progress stall mekanik kapan saja dari halaman utama via nomor plat.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-check text-blue-600 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-slate-900 block font-bold mb-0.5">Nota Digital WhatsApp</strong>
                                    <span class="text-slate-500 leading-relaxed">Salinan PDF SPK, hasil scan OBD, dan nota resmi dikirimkan langsung ke nomor ponsel Anda.</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <button type="button" onclick="openBookingModal('Mode Tamu')" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold py-3 px-4 rounded-xl text-xs flex items-center justify-center gap-2 transition cursor-pointer">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            <span>Lanjut Servis Sebagai Tamu</span>
                        </button>
                    </div>
                </div>

                <!-- CARD B: Garasi Member Langganan (Dark Navy Card) -->
                <div class="bg-[#0b1329] text-white rounded-2xl p-6 sm:p-8 border border-blue-900/60 shadow-xl shadow-blue-950/20 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-12 -top-12 w-48 h-48 bg-blue-600/10 rounded-full blur-2xl"></div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-bold text-blue-400 bg-blue-950/80 border border-blue-800/60 px-2.5 py-0.5 rounded-full uppercase font-mono tracking-wider">
                                PILIHAN PENGEMUDI CERDAS
                            </span>
                            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/30">
                                <i class="fa-solid fa-shield-cat text-sm"></i>
                            </div>
                        </div>

                        <h3 class="font-heading font-extrabold text-xl text-white mb-2">Garasi Member Langganan</h3>
                        <p class="text-xs text-slate-300 leading-relaxed mb-6">
                            Optimal untuk pemilik kendaraan pribadi atau manajer armada keluarga yang menghendaki pemeliharaan jangka panjang teratur.
                        </p>

                        <ul class="space-y-3.5 text-xs text-slate-300">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-blue-400 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-white block font-bold mb-0.5">Auto-Fill Multi-Kendaraan</strong>
                                    <span class="text-slate-400 leading-relaxed">Simpan profil beberapa mobil, tanpa perlu ketik ulang data spesifikasi mesin.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-blue-400 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-white block font-bold mb-0.5">Buku Servis Digital (Health Record)</strong>
                                    <span class="text-slate-400 leading-relaxed">Riwayat penggantian oli, ketebalan kampas rem, dan usia aki tersimpan rapi.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-blue-400 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-white block font-bold mb-0.5">Pengingat Berkala Cerdas</strong>
                                    <span class="text-slate-400 leading-relaxed">Notifikasi WhatsApp &amp; SMS otomatis saat kendaraan mendekati waktu servis atau ganti oli.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-blue-400 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-white block font-bold mb-0.5">Cashback &amp; Poin Diskon 5%</strong>
                                    <span class="text-slate-400 leading-relaxed">Potongan harga otomatis untuk jasa servis dan suku cadang asli OEM.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-blue-400 text-sm mt-0.5 shrink-0"></i>
                                <div>
                                    <strong class="text-white block font-bold mb-0.5">Konsultasi Mekanik VIP</strong>
                                    <span class="text-slate-400 leading-relaxed">Jalur tanya jawab prioritas via WhatsApp dengan Chief Technical Advisor bengkel.</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-800 relative z-10">
                        <a href="{{ route('login') }}" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-lg shadow-blue-600/30 transition text-center">
                            <i class="fa-solid fa-crown text-amber-300"></i>
                            <span>Daftar Gratis Garasi Member</span>
                        </a>
                        <p class="text-[10px] text-slate-400 text-center mt-2.5">
                            Pendaftaran hanya butuh 30 detik menggunakan No. WhatsApp
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 7. STANDAR MUTU BENGKEL (4 Guarantee Cards) -->
    <!-- ========================================================= -->
    <section class="py-12 sm:py-16 px-4 sm:px-8 bg-white border-t border-slate-200/60">
        <div class="max-w-7xl mx-auto">
            
            <div class="mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 font-mono">STANDAR MUTU BENGKEL</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-1">
                    Garansi Kepastian &amp; Kenyamanan Anda
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-2 leading-relaxed">
                    Setiap rupiah yang Anda keluarkan dilindungi oleh sistem audit pengerjaan terstandarisasi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($guarantees as $g)
                    <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-5 hover:bg-white hover:border-blue-300 transition-all shadow-2xs">
                        <div class="w-10 h-10 rounded-xl bg-blue-100/70 text-blue-600 flex items-center justify-center mb-4">
                            <i class="{{ $g['icon'] }} text-base"></i>
                        </div>
                        <h3 class="font-heading font-bold text-base text-slate-900 mb-2">{{ $g['title'] }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $g['desc'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 8. TESTIMONIALS SECTION -->
    <!-- ========================================================= -->
    <section class="py-12 sm:py-16 px-4 sm:px-8 bg-[#f8fafc] border-t border-slate-200/60">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 font-mono">ULASAN PELANGGAN</span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-1">
                        Dipercaya Ribuan Pemilik Kendaraan
                    </h2>
                </div>
                <div class="flex items-center gap-2 bg-white px-3.5 py-1.5 rounded-xl border border-slate-200 shadow-2xs">
                    <div class="flex text-amber-400 text-xs">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="text-xs font-extrabold text-slate-900">4.9 / 5.0</span>
                    <span class="text-[11px] text-slate-500">(1.840+ Google Reviews)</span>
                </div>
            </div>

            <!-- Testimonial Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($testimonials as $t)
                    <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-2xs flex flex-col justify-between">
                        <div>
                            <!-- 5 Stars -->
                            <div class="flex text-amber-400 text-xs gap-1 mb-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>

                            <p class="text-xs text-slate-600 leading-relaxed italic mb-6">
                                &ldquo;{{ $t['comment'] }}&rdquo;
                            </p>
                        </div>

                        <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700 font-bold text-xs flex items-center justify-center shrink-0">
                                {{ $t['initial'] }}
                            </div>
                            <div>
                                <h4 class="font-bold text-xs text-slate-900">{{ $t['name'] }}</h4>
                                <div class="text-[11px] text-slate-500 flex items-center gap-1.5">
                                    <span>{{ $t['vehicle'] }}</span>
                                    <span>&bull;</span>
                                    <span class="text-blue-600 font-semibold">{{ $t['badge'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 9. BOTTOM CALL TO ACTION BANNER -->
    <!-- ========================================================= -->
    <section class="max-w-7xl mx-auto px-4 sm:px-8 py-6 w-full">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
            <div>
                <h3 class="font-heading font-extrabold text-xl sm:text-2xl text-slate-900 tracking-tight">
                    Siap Merawat Mobil Anda Hari Ini?
                </h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Pesan slot waktu sekarang dan nikmati pengecekan berstandar presisi tanpa perlu menunggu giliran.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <button type="button" onclick="openBookingModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs shadow-md shadow-blue-500/20 transition cursor-pointer">
                    Ambil Antrean Online Sekarang
                </button>
                <a href="https://api.whatsapp.com/send?phone={{ $workshop['no_whatsapp'] }}&text=Halo%20MotoPro%20Workshop,%20saya%20ingin%20tanya%20estimasi%20servis" target="_blank" class="bg-white hover:bg-slate-50 text-slate-800 border border-slate-300 font-bold py-2.5 px-4 rounded-xl text-xs transition flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                    <span>Konsultasi WA Dulu</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 10. COMPREHENSIVE FOOTER -->
    <!-- ========================================================= -->
    <footer class="bg-slate-100/90 border-t border-slate-200 mt-10 text-xs text-slate-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 sm:py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <!-- Col 1: Workshop Branding -->
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

                <!-- Col 2: Emergency & Towing -->
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

                <!-- Col 3: Google Maps & Branch -->
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

                <!-- Col 4: WhatsApp Consultation -->
                <div>
                    <h4 class="font-bold text-slate-900 text-xs uppercase tracking-wider mb-2 flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                        <span>WhatsApp Konsultasi</span>
                    </h4>
                    <p class="text-slate-500 text-xs mb-2">
                        Tanya estimasi servis, suku cadang OEM, atau konsultasi kendala transmisi/mesin.
                    </p>
                    <a href="https://api.whatsapp.com/send?phone={{ $workshop['no_whatsapp'] }}" target="_blank" class="font-bold text-emerald-700 hover:underline flex items-center gap-1">
                        <span>Chat Advisor MotoPro</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

            </div>

            <!-- Bottom Copyright Bar -->
            <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-400">
                <p>&copy; {{ date('Y') }} {{ $workshop['name'] }} Automotive Service System. Hak Cipta Dilindungi.</p>
                <div class="flex items-center gap-4 text-slate-500">
                    <a href="{{ route('login') }}" class="hover:text-blue-600">Area Admin Bengkel</a>
                    <span>&bull;</span>
                    <a href="#layanan" class="hover:text-blue-600">Ketentuan Garansi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========================================================= -->
    <!-- MODAL: BOOKING SERVIS CPAT (Data Kosong Siap Diisi User) -->
    <!-- ========================================================= -->
    <div id="bookingModal" class="fixed inset-0 z-50 hidden bg-slate-950/70 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200 my-8 relative">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900">Reservasi Servis Mobil</h3>
                    <p class="text-xs text-slate-500">Isi data kendaraan Anda untuk konfirmasi jadwal stall</p>
                </div>
                <button type="button" onclick="closeBookingModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('bengkel.booking.store') }}" method="POST" id="modalBookingForm">
                @csrf
                <div class="space-y-3.5 text-xs">
                    
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" required placeholder="Masukkan nama Anda" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">No. WhatsApp</label>
                            <input type="tel" name="whatsapp" required placeholder="08123456789" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Plat Nomor Mobil</label>
                            <input type="text" id="modalPlat" name="plat_nomor" required placeholder="B 1234 ABC" class="w-full uppercase font-mono font-bold bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Merk &amp; Tipe Mobil</label>
                            <input type="text" name="merk_model" required placeholder="Cth: Avanza 2022" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Pilihan Paket Servis</label>
                            <select id="modalPaketSelect" name="paket_servis" required class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none">
                                <option value="">-- Pilih Paket Servis --</option>
                                @foreach($packages as $p)
                                    <option value="{{ $p['title'] }}">{{ $p['title'] }} ({{ $p['harga'] }})</option>
                                @endforeach
                                <option value="Pemeriksaan Keluhan Umum">Pemeriksaan / Keluhan Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Pilihan Waktu / Jam</label>
                            <select name="jam" required class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none">
                                <option value="08:30 WIB">08:30 WIB (Pagi)</option>
                                <option value="10:00 WIB">10:00 WIB (Pagi)</option>
                                <option value="13:00 WIB">13:00 WIB (Siang)</option>
                                <option value="15:00 WIB">15:00 WIB (Sore)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Catatan / Keluhan Tambahan (Opsional)</label>
                        <textarea name="catatan" rows="2" placeholder="Tuliskan kendala stir getar, rem bunyi, atau bunyi mesin..." class="w-full bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-slate-900 focus:bg-white focus:border-blue-500 focus:outline-none"></textarea>
                    </div>

                </div>

                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-end gap-2">
                    <button type="button" onclick="closeBookingModal()" class="px-4 py-2 rounded-lg text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-lg text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-md shadow-blue-500/20 transition flex items-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-check"></i>
                        <span>Konfirmasi Booking &amp; Buka WA</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- MODAL: LAPORAN TELEMETRI & INSPEKSI OBD LENGKAP -->
    <!-- ========================================================= -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden bg-slate-950/70 backdrop-blur-xs flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-2xl border border-slate-200 my-8 relative">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center text-sm">
                        <i class="fa-solid fa-car-on"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Laporan Telemetri &amp; Servis Real-Time</h3>
                        <p class="text-xs text-slate-500">Live Pit Bay Inspection Diagnostics</p>
                    </div>
                </div>
                <button type="button" onclick="closeDetailModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition cursor-pointer">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-4 text-xs">
                <!-- Vehicle Header Info -->
                <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 flex items-center justify-between">
                    <div>
                        <span class="font-mono font-bold text-sm text-slate-900 bg-white px-2 py-0.5 rounded border border-slate-300">B 1982 SYZ</span>
                        <div class="text-xs text-slate-600 font-semibold mt-1">Toyota Innova Zenix 2.0 V CVT</div>
                    </div>
                    <div class="text-right">
                        <span class="text-emerald-700 bg-emerald-100 font-bold px-2.5 py-1 rounded-md text-[11px]">
                            Stall #2 (Pit Express)
                        </span>
                        <div class="text-[10px] text-slate-500 mt-1">Mekanik: Reza Kurniawan (ASE)</div>
                    </div>
                </div>

                <!-- Live OBD Sensor Health -->
                <div>
                    <h4 class="font-bold text-slate-800 uppercase tracking-wider text-[11px] mb-2 font-mono flex items-center gap-1.5">
                        <i class="fa-solid fa-microchip text-blue-600"></i>
                        <span>STATUS SCANNER OBD-II &amp; TELEMETRI SENSOR</span>
                    </h4>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-blue-50/60 p-2.5 rounded-lg border border-blue-100">
                            <span class="text-slate-500 block text-[10px]">ECU Diagnostic Code</span>
                            <strong class="text-emerald-600 font-mono">DTC Clear (0 Error)</strong>
                        </div>
                        <div class="bg-blue-50/60 p-2.5 rounded-lg border border-blue-100">
                            <span class="text-slate-500 block text-[10px]">Tegangan Aki / Battery</span>
                            <strong class="text-slate-900 font-mono">12.6 Volt (100% OK)</strong>
                        </div>
                        <div class="bg-blue-50/60 p-2.5 rounded-lg border border-blue-100">
                            <span class="text-slate-500 block text-[10px]">Kampas Rem Depan / Belakang</span>
                            <strong class="text-slate-900 font-mono">8 mm / 7 mm (Aman)</strong>
                        </div>
                        <div class="bg-blue-50/60 p-2.5 rounded-lg border border-blue-100">
                            <span class="text-slate-500 block text-[10px]">Kondisi Oli Mesin Baru</span>
                            <strong class="text-blue-700 font-mono">Full Synthetic 0W-20</strong>
                        </div>
                    </div>
                </div>

                <!-- 5 Tahapan Checklist -->
                <div>
                    <h4 class="font-bold text-slate-800 uppercase tracking-wider text-[11px] mb-2 font-mono">
                        TAHAPAN PENGERJAAN PIT
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between p-2 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-check-circle text-emerald-600"></i>
                                <span>1. Check-in &amp; Inspeksi Fisik 20 Titik</span>
                            </span>
                            <span class="text-[10px] font-bold uppercase font-mono">Selesai</span>
                        </div>
                        <div class="flex items-center justify-between p-2 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200">
                            <span class="flex items-center gap-2">
                                <i class="fa-solid fa-check-circle text-emerald-600"></i>
                                <span>2. Kuras Oli Mesin &amp; Filter Oli OEM</span>
                            </span>
                            <span class="text-[10px] font-bold uppercase font-mono">Selesai</span>
                        </div>
                        <div class="flex items-center justify-between p-2 rounded-lg bg-blue-50 text-blue-900 border border-blue-200">
                            <span class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-600 animate-ping"></span>
                                <span>3. Gurah Mesin &amp; Tune Up Throttle Body</span>
                            </span>
                            <span class="text-[10px] font-bold uppercase font-mono text-blue-700">Dikerjakan</span>
                        </div>
                        <div class="flex items-center justify-between p-2 rounded-lg bg-slate-50 text-slate-500 border border-slate-200">
                            <span class="flex items-center gap-2">
                                <i class="fa-regular fa-clock text-slate-400"></i>
                                <span>4. Spooring 3D &amp; Uji Jalan Akhir</span>
                            </span>
                            <span class="text-[10px] font-bold uppercase font-mono">Antre</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-end">
                <button type="button" onclick="closeDetailModal()" class="px-5 py-2 rounded-lg text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- MODAL: DROP PASS & OBD QR MODAL -->
    <!-- ========================================================= -->
    <div id="dropPassModal" class="fixed inset-0 z-50 hidden bg-slate-950/70 backdrop-blur-xs flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-2xl border border-slate-200 text-center relative">
            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-qrcode text-xl"></i>
            </div>
            <h3 class="font-heading font-extrabold text-lg text-slate-900">Drop &amp; Go Service Pass</h3>
            <p class="text-xs text-slate-500 mt-1 mb-4 leading-relaxed">
                Tunjukkan QR Pass ini ke Service Advisor di gerbang bengkel untuk check-in express tanpa antre.
            </p>
            <div class="p-4 bg-slate-100 rounded-xl border border-slate-200 inline-block mb-4">
                <i class="fa-solid fa-qrcode text-7xl text-slate-800"></i>
            </div>
            <div class="text-[11px] text-slate-600 font-mono font-bold bg-blue-50 py-1.5 px-3 rounded-lg border border-blue-200 mb-4">
                PASS ID: MP-{{ date('ymd') }}-STALL4
            </div>
            <button type="button" onclick="closeDropPassModal()" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-2.5 rounded-xl text-xs transition">
                Tutup
            </button>
        </div>
    </div>

    <!-- JavaScript Actions & Handlers -->
    <script>
        // Modal Booking Handlers
        function openBookingModal(pkgTitle = '') {
            const modal = document.getElementById('bookingModal');
            const select = document.getElementById('modalPaketSelect');
            if (pkgTitle && select) {
                for (let i = 0; i < select.options.length; i++) {
                    if (select.options[i].value === pkgTitle || select.options[i].text.includes(pkgTitle)) {
                        select.selectedIndex = i;
                        break;
                    }
                }
            }
            modal.classList.remove('hidden');
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
        }

        // Modal Telemetri Handlers
        function openDetailModal() {
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Modal Drop Pass Handlers
        function openDropPassModal() {
            document.getElementById('dropPassModal').classList.remove('hidden');
        }

        function closeDropPassModal() {
            document.getElementById('dropPassModal').classList.add('hidden');
        }

        // Demo Plate Helper
        function fillDemoPlate() {
            const input = document.getElementById('inputPlat');
            input.value = 'B 1982 SYZ';
            handleTrackSubmit(new Event('submit'));
        }

        // AJAX Track Submit Handler
        function handleTrackSubmit(e) {
            e.preventDefault();
            const input = document.getElementById('inputPlat');
            const plat = input.value.trim().toUpperCase().replace(/[\s\-\.]/g, '');
            const resultBox = document.getElementById('trackResultBox');
            const btn = document.getElementById('btnCekStatus');

            if (!plat) {
                alert('Silakan masukkan nomor plat kendaraan terlebih dahulu.');
                input.focus();
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-xs"></i> <span>Memeriksa Telemetri...</span>';

            fetch('{{ route("bengkel.lacak") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ plat_nomor: plat })
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-bolt-lightning text-xs"></i> <span>Cek Status Live Pengerjaan</span>';
                resultBox.classList.remove('hidden');

                if (res.success && res.data.found) {
                    const d = res.data;
                    resultBox.innerHTML = `
                        <div class="bg-blue-50/70 border border-blue-200 rounded-xl p-4 animate-fade-in">
                            <div class="flex items-center justify-between mb-2 pb-2 border-b border-blue-200/80">
                                <div>
                                    <span class="font-mono font-bold text-base text-slate-900 bg-white px-2 py-0.5 rounded border border-blue-300">${d.plat_formatted}</span>
                                    <div class="text-xs text-slate-600 mt-1 font-semibold">${d.model}</div>
                                </div>
                                <span class="text-xs font-bold text-emerald-700 bg-emerald-100 border border-emerald-200 px-2 py-1 rounded-md flex items-center gap-1.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    ${d.status}
                                </span>
                            </div>

                            <div class="space-y-1.5 text-xs text-slate-700 mb-3">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Lokasi Stall:</span>
                                    <strong class="text-slate-900">${d.stall}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Mekanik:</span>
                                    <strong class="text-slate-900">${d.mekanik}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Paket Dikerjakan:</span>
                                    <strong class="text-blue-700">${d.paket}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Estimasi Selesai:</span>
                                    <strong class="text-slate-900">${d.estimasi_selesai}</strong>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="flex justify-between text-[11px] font-bold text-slate-700 mb-1">
                                    <span>Progres Pengerjaan</span>
                                    <span class="text-blue-600">${d.progress}%</span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" style="width: ${d.progress}%"></div>
                                </div>
                            </div>

                            <button type="button" onclick="openDetailModal()" class="w-full bg-white hover:bg-slate-50 text-blue-700 border border-blue-300 font-bold py-2 rounded-lg text-xs flex items-center justify-center gap-1.5 transition">
                                <i class="fa-solid fa-file-waveform"></i>
                                <span>Lihat Laporan Lengkap &amp; Telemetri OBD</span>
                            </button>
                        </div>
                    `;
                } else {
                    const msg = (res.data && res.data.message) ? res.data.message : 'Plat nomor tidak ditemukan dalam antrean servis aktif.';
                    resultBox.innerHTML = `
                        <div class="bg-amber-50 border border-amber-200 rounded-xl p-3.5 text-xs text-amber-800">
                            <div class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-exclamation text-amber-600 text-sm mt-0.5"></i>
                                <div>
                                    <strong>Status:</strong> ${msg}
                                    <div class="mt-2">
                                        <button type="button" onclick="openBookingModal()" class="font-bold text-blue-700 underline hover:text-blue-900">
                                            Booking antrean untuk unit ini sekarang &rarr;
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-bolt-lightning text-xs"></i> <span>Cek Status Live Pengerjaan</span>';
                console.error(err);
            });
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            ['bookingModal', 'detailModal', 'dropPassModal'].forEach(id => {
                const el = document.getElementById(id);
                if (el && e.target === el) {
                    el.classList.add('hidden');
                }
            });
        });
    </script>
</body>
</html>
