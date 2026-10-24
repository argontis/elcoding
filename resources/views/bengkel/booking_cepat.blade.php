<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Servis Kendaraan — {{ $workshop['name'] }} Fast Lane</title>
    <meta name="description" content="Pilih metode reservasi cepat tanpa login atau sinkronisasikan riwayat servis Anda dengan akun Garasi Member.">

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

        /* Selection cards */
        .service-checkbox:checked + label {
            border-color: #2563eb;
            background-color: #eff6ff;
        }
        .service-checkbox:checked + label .check-icon {
            background-color: #2563eb;
            border-color: #2563eb;
            color: #ffffff;
        }

        /* Day pills */
        .day-pill.active {
            border-color: #2563eb;
            background-color: #eff6ff;
            box-shadow: 0 4px 12px -2px rgba(37, 99, 235, 0.15);
        }
        .day-pill.active .day-name { color: #1d4ed8; font-weight: 800; }
        .day-pill.active .day-num { color: #1d4ed8; }

        /* Time pills */
        .time-pill.active {
            border-color: #2563eb;
            background-color: #eff6ff;
            color: #1e40af;
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between">

    <!-- ========================================================= -->
    <!-- 1. TOP ANNOUNCEMENT BAR (Dark Precision Live Status) -->
    <!-- ========================================================= -->
    <div class="bg-[#0b0f19] text-xs text-slate-300 border-b border-slate-800 py-2.5 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-3 font-medium">
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

            <div class="flex items-center gap-4 text-xs">
                <div class="flex items-center gap-1.5 text-slate-300">
                    <i class="fa-solid fa-stopwatch text-amber-400 text-xs"></i>
                    <span>Rata-rata Servis Ringan: <strong class="text-white">{{ $workshop['rata_durasi'] }}</strong></span>
                </div>
                <span class="text-slate-700 hidden sm:inline-block">|</span>
                <a href="{{ url('/bengkel') }}" class="hidden sm:inline-flex items-center gap-1.5 text-blue-400 hover:text-blue-300 font-medium transition cursor-pointer">
                    <i class="fa-solid fa-qrcode text-xs"></i>
                    <span>Download Real-time OBD &amp; Drop Pass</span>
                </a>
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
                <a href="{{ url('/bengkel') }}" class="hover:text-blue-600 transition flex items-center gap-1.5">
                    <span>Beranda &amp; Layanan</span>
                </a>
                <a href="{{ route('bengkel.booking.page') }}" class="bg-slate-900 text-white px-3.5 py-1.5 rounded-lg font-bold flex items-center gap-1.5 shadow-2xs">
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
                <!-- Stall Status Pill -->
                <a href="{{ route('bengkel.stall.page') }}" class="hidden xl:flex items-center gap-1.5 bg-blue-50/80 hover:bg-blue-100 text-blue-700 border border-blue-200/60 px-3 py-1.5 rounded-lg text-xs font-bold transition">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $workshop['status_bengkel'] }}</span>
                </a>

                <form action="{{ route('bengkel.lacak') }}" method="POST" class="hidden md:flex items-center relative">
                    @csrf
                    <div class="relative">
                        <input type="text" name="plat_nomor" placeholder="Cek Plat (B 1234 CD)..." 
                            class="w-44 lg:w-48 bg-slate-100/90 text-slate-800 placeholder-slate-400 text-xs font-mono font-semibold py-2 pl-8 pr-3 rounded-lg border border-slate-200 focus:bg-white focus:border-blue-500 focus:outline-none transition-all">
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    </div>
                </form>

                <a href="{{ route('bengkel.booking.page') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition border border-slate-200">
                    <i class="fa-regular fa-user text-slate-500 text-xs"></i>
                    <span>AKSES TAMU</span>
                </a>

                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-shield-halved text-blue-400 text-xs"></i>
                    <span>Masuk / Daftar Garasi Member</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Success Feedback Notification -->
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
    <!-- 3. MAIN BOOKING FORM CONTENT -->
    <!-- ========================================================= -->
    <main class="max-w-7xl mx-auto px-4 sm:px-8 py-8 w-full">
        
        <!-- Top Title Bar & Live Capacity Pill -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2 text-xs font-bold font-mono tracking-wider text-blue-600 uppercase mb-1">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>MOTOPRO FAST LANE RESERVATION • ID #BK-{{ date('ym') }}-7892</span>
                </div>
                <h1 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight">
                    Booking Servis Kendaraan
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 leading-relaxed">
                    Pilih metode reservasi cepat tanpa login atau sinkronisasikan riwayat servis Anda dengan akun Garasi Member.
                </p>
            </div>

            <!-- Capacity Right Card -->
            <div class="bg-blue-50/80 border border-blue-200/90 rounded-2xl p-3.5 sm:px-5 sm:py-3.5 flex items-center gap-3.5 shadow-2xs self-start md:self-auto shrink-0">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/20 text-lg">
                    <i class="fa-solid fa-gauge"></i>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider block font-mono">STALL KAPASITAS HARI INI</span>
                    <strong class="text-xs sm:text-sm text-slate-900 font-extrabold flex items-center gap-1.5">
                        <span>5 Stall Aktif</span>
                        <span class="text-slate-400">•</span>
                        <span class="text-emerald-600">Ready Check-in</span>
                    </strong>
                </div>
            </div>
        </div>

        <!-- Mode Toggle Strip -->
        <div class="flex flex-wrap items-center gap-3 mb-6">
            <button type="button" class="bg-slate-900 text-white px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-bolt text-amber-400"></i>
                <span>Booking Mode Tamu (Tanpa Login) - Cepat 1 Menit</span>
                <span class="bg-slate-800 text-[10px] uppercase font-mono px-1.5 py-0.5 rounded text-amber-300">POPULER</span>
            </button>

            <a href="{{ route('bengkel.garasi.page') }}" class="bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 px-4 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 transition">
                <i class="fa-solid fa-shield-halved text-blue-600"></i>
                <span>Sudah Punya Akun Langganan? Masuk Garasi Saya</span>
                <span class="bg-blue-50 text-[10px] uppercase font-mono px-1.5 py-0.5 rounded text-blue-700 font-extrabold border border-blue-200">HEMAT 5%</span>
            </a>
        </div>

        <!-- Info Notice Box -->
        <div class="bg-blue-50/60 border border-blue-200/90 rounded-2xl p-4 sm:p-5 mb-8 flex items-start gap-3.5">
            <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                <i class="fa-regular fa-message text-base"></i>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <strong class="text-xs sm:text-sm font-bold text-slate-900">Tanpa ribet pendaftaran akun!</strong>
                    <span class="text-[10px] font-bold uppercase bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-mono">Instan &amp; Transparan</span>
                </div>
                <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                    Cukup cantumkan nomor WhatsApp dan data plat kendaraan. Sistem telemetry MotoPro langsung mengirimkan tiket barcode QR, link live-tracking CCTV mekanik, dan rincian estimasi pengerjaan.
                </p>
            </div>
        </div>

        <!-- MAIN GRID: Left Form (4 Steps) vs Right Summary -->
        <form action="{{ route('bengkel.booking.store') }}" method="POST" id="mainBookingForm">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: 4 STEPS FORM (DATA KOSONG SIAP DIISI) -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- STEP 1: IDENTITAS KENDARAAN -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 rounded-lg bg-slate-900 text-white font-bold text-xs flex items-center justify-center">1</span>
                                <div>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">Identitas Kendaraan</h2>
                                    <p class="text-xs text-slate-500">Spesifikasi mobil untuk kalkulasi fluida &amp; suku cadang OEM yang presisi</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-car text-slate-300 text-xl"></i>
                        </div>

                        <div class="space-y-4 text-xs">
                            <!-- Row 1: Plat Nomor & Odometer -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <div class="flex justify-between items-center mb-1.5">
                                        <label class="font-bold text-slate-700">Nomor Plat Kendaraan</label>
                                        <span class="text-[10px] font-bold text-blue-600 uppercase font-mono">WAJIB DIISI</span>
                                    </div>
                                    <div class="relative flex items-center">
                                        <span class="absolute left-3 font-mono font-bold text-xs text-slate-500 border-r border-slate-300 pr-2">INA</span>
                                        <input type="text" id="formPlat" name="plat_nomor" required
                                            placeholder="B 2099 JKP"
                                            value=""
                                            oninput="updateSummary()"
                                            class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-14 pr-3 text-slate-900 font-mono font-bold tracking-wider text-xs focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                    </div>
                                </div>

                                <div>
                                    <div class="flex justify-between items-center mb-1.5">
                                        <label class="font-bold text-slate-700">Kilometer Terakhir (Odo)</label>
                                        <span class="text-[10px] text-slate-400">Untuk kalibrasi servis</span>
                                    </div>
                                    <div class="relative flex items-center">
                                        <input type="number" id="formOdo" name="odometer"
                                            placeholder="24120"
                                            value=""
                                            oninput="updateSummary()"
                                            class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-3 pr-10 text-slate-900 font-mono font-semibold text-xs focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                        <span class="absolute right-3 font-mono text-xs font-bold text-slate-400">KM</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Row 2: Merek, Model & Varian, Tahun & Transmisi -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label class="block font-bold text-slate-700 mb-1.5">Merek Pabrikan</label>
                                    <select id="formBrand" name="brand" onchange="updateSummary()" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3 text-slate-800 text-xs font-semibold focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                        <option value="">-- Pilih Merek --</option>
                                        @foreach($carBrands as $brand)
                                            <option value="{{ $brand }}">{{ $brand }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block font-bold text-slate-700 mb-1.5">Model &amp; Varian Seri</label>
                                    <input type="text" id="formModel" name="merk_model" required
                                        placeholder="cth: Innova Zenix 2.0 V CVT"
                                        value=""
                                        oninput="updateSummary()"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3 text-slate-900 text-xs font-semibold focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                </div>

                                <div>
                                    <label class="block font-bold text-slate-700 mb-1.5">Tahun &amp; Transmisi</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="text" id="formYear" name="tahun" placeholder="2023" value="" oninput="updateSummary()"
                                            class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-3 text-slate-900 text-xs font-semibold focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                        <select id="formTrans" name="transmisi" onchange="updateSummary()" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-2 text-slate-800 text-xs font-semibold focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                            <option value="">Transmisi</option>
                                            <option value="Matik / CVT">Matik / CVT</option>
                                            <option value="Manual">Manual</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 2: KATEGORI SERVIS & KELUHAN -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 rounded-lg bg-slate-900 text-white font-bold text-xs flex items-center justify-center">2</span>
                                <div>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">Kategori Servis &amp; Keluhan</h2>
                                    <p class="text-xs text-slate-500">Pilih paket dasar atau konsultasikan indikasi permasalahan kendaraan</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-toolbox text-slate-300 text-xl"></i>
                        </div>

                        <!-- 4 Service Packages Checkbox Grid (Kosong / Unchecked by default) -->
                        <div class="mb-4">
                            <label class="block font-bold text-slate-700 text-xs mb-3">
                                Pilih Jenis Pengerjaan <span class="text-slate-400 font-normal">(Bisa lebih dari satu)</span>
                            </label>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5">
                                @foreach($serviceOptions as $svc)
                                    <div class="relative">
                                        <input type="checkbox" 
                                            id="{{ $svc['id'] }}" 
                                            name="layanan_dipilih[]" 
                                            value="{{ $svc['title'] }}"
                                            data-price="{{ $svc['price'] }}"
                                            data-minutes="{{ $svc['minutes'] }}"
                                            data-title="{{ $svc['title'] }}"
                                            data-fmt="{{ $svc['price_fmt'] }}"
                                            onchange="updateSummary()"
                                            class="service-checkbox sr-only">
                                        <label for="{{ $svc['id'] }}" class="h-full border border-slate-200 rounded-xl p-4 flex flex-col justify-between cursor-pointer hover:border-blue-300 transition-all">
                                            <div>
                                                <div class="flex items-start justify-between gap-2 mb-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <div class="check-icon w-4 h-4 rounded-md border border-slate-300 flex items-center justify-center text-[10px] text-transparent transition">
                                                            <i class="fa-solid fa-check"></i>
                                                        </div>
                                                        <strong class="font-heading font-bold text-xs text-slate-900">{{ $svc['title'] }}</strong>
                                                    </div>
                                                    <span class="text-[10px] font-bold text-blue-700 bg-blue-100/70 px-2 py-0.5 rounded font-mono shrink-0">
                                                        {{ $svc['duration'] }}
                                                    </span>
                                                </div>
                                                <p class="text-[11px] text-slate-500 leading-relaxed ml-6">
                                                    {{ $svc['desc'] }}
                                                </p>
                                            </div>
                                            <div class="mt-3 pt-2.5 border-t border-slate-100/80 flex items-center justify-between ml-6">
                                                <span class="text-[10px] text-slate-400 font-medium">Estimasi Biaya</span>
                                                <strong class="font-mono font-bold text-xs text-slate-900">{{ $svc['price_fmt'] }}</strong>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Keluhan Tambahan Textarea -->
                        <div>
                            <div class="flex justify-between items-center mb-1.5 text-xs">
                                <label class="font-bold text-slate-700">Deskripsi Gejala / Keluhan Tambahan</label>
                                <span class="text-[10px] text-slate-400">Membantu mekanik mendiagnosis lebih cepat</span>
                            </div>
                            <textarea name="catatan" rows="3"
                                placeholder="cth: Rem berdecit halus saat deselerasi dari 60 ke 20 km/jam, dan stir agak bergetar saat melintas di jalan tol beton..."
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-slate-900 text-xs focus:bg-white focus:border-blue-500 focus:outline-none transition"></textarea>
                        </div>
                    </div>

                    <!-- STEP 3: LOKASI CABANG & JADWAL STALL -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 rounded-lg bg-slate-900 text-white font-bold text-xs flex items-center justify-center">3</span>
                                <div>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">Lokasi Cabang &amp; Jadwal Stall</h2>
                                    <p class="text-xs text-slate-500">Pilih workshop MotoPro dan slot waktu yang tidak padat antrean</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-calendar-days text-slate-300 text-xl"></i>
                        </div>

                        <!-- Pilih Cabang -->
                        <div class="mb-5 text-xs">
                            <label class="block font-bold text-slate-700 mb-1.5">Pilih Cabang Bengkel</label>
                            <div class="relative">
                                <select name="cabang" id="formCabang" onchange="updateSummary()" class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-3 pr-10 text-slate-900 text-xs font-semibold focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                    <option value="Cabang Utama Jaksel">Bengkel Cabang Utama - Jakarta Selatan (Jl. Otomotif Presisi No. 88) • [Stall Siap]</option>
                                    <option value="Cabang BSD Tangerang">Bengkel Cabang BSD Tangerang (Kawasan EduTown Blok C1) • [Tersedia]</option>
                                    <option value="Cabang Bekasi Barat">Bengkel Cabang Bekasi Barat (Sentra Niaga Kalimalang) • [Tersedia]</option>
                                </select>
                                <i class="fa-solid fa-location-dot absolute right-3.5 top-1/2 -translate-y-1/2 text-blue-600 text-xs"></i>
                            </div>
                        </div>

                        <!-- 7 Hari Kedatangan -->
                        <div class="mb-5 text-xs">
                            <div class="flex items-center justify-between mb-2">
                                <label class="font-bold text-slate-700">Pilih Hari Kedatangan (7 Hari Ke Depan)</label>
                                <span class="text-[10px] font-mono font-bold text-blue-600 uppercase">BULAN BERJALAN • {{ strtoupper(date('F Y')) }}</span>
                            </div>

                            <input type="hidden" name="tanggal" id="selectedDate" value="{{ $days[0]['val'] }}">

                            <div class="grid grid-cols-4 sm:grid-cols-7 gap-2">
                                @foreach($days as $idx => $day)
                                    <button type="button" 
                                        onclick="selectDay('{{ $day['val'] }}', '{{ $day['day_name'] }}, {{ $day['day_num'] }}', this)"
                                        class="day-pill p-2.5 rounded-xl border border-slate-200 bg-white text-center cursor-pointer transition hover:border-blue-300 {{ $idx === 0 ? 'active' : '' }}">
                                        <div class="day-name text-[10px] uppercase font-mono font-bold text-slate-500">{{ $day['day_name'] }}</div>
                                        <div class="day-num font-heading font-extrabold text-lg text-slate-900 my-0.5">{{ $day['day_num'] }}</div>
                                        <div class="text-[9px] font-semibold text-slate-400 capitalize">{{ $day['badge'] }}</div>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Pilihan Jam Kedatangan (Live Bay Dispatch) -->
                        <div class="text-xs">
                            <label class="block font-bold text-slate-700 mb-2">Pilih Jam Kedatangan (Live Bay Dispatch)</label>
                            
                            <input type="hidden" name="jam" id="selectedTime" value="08:30 WIB">

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                                @foreach($timeSlots as $idx => $ts)
                                    <button type="button" 
                                        {{ $ts['disabled'] ? 'disabled' : '' }}
                                        onclick="selectTime('{{ $ts['time'] }}', this)"
                                        class="time-pill p-3 rounded-xl border text-left cursor-pointer transition {{ $ts['disabled'] ? 'bg-slate-100 border-slate-200 opacity-50 cursor-not-allowed' : ($idx === 0 ? 'active border-blue-600 bg-blue-50 text-blue-900' : 'bg-white border-slate-200 hover:border-blue-300') }}">
                                        <div class="flex items-center justify-between mb-1">
                                            <strong class="font-heading font-bold text-xs">{{ $ts['time'] }}</strong>
                                            @if($ts['disabled'])
                                                <i class="fa-solid fa-lock text-slate-400 text-[10px]"></i>
                                            @elseif($idx === 0)
                                                <i class="fa-solid fa-circle-check text-blue-600 text-xs"></i>
                                            @else
                                                <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                                            @endif
                                        </div>
                                        <div class="text-[10px] font-bold uppercase font-mono flex items-center gap-1 {{ $ts['disabled'] ? 'text-slate-400' : ($ts['ready'] ? 'text-blue-700' : 'text-slate-500') }}">
                                            @if(!$ts['disabled'])
                                                <span class="w-1.5 h-1.5 rounded-full {{ $ts['ready'] ? 'bg-blue-600' : 'bg-emerald-500' }}"></span>
                                            @endif
                                            <span>{{ $ts['badge'] }}</span>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- STEP 4: KONTAK NOTIFIKASI WHATSAPP -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs">
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                            <div class="flex items-center gap-3">
                                <span class="w-7 h-7 rounded-lg bg-slate-900 text-white font-bold text-xs flex items-center justify-center">4</span>
                                <div>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">Kontak Notifikasi WhatsApp</h2>
                                    <p class="text-xs text-slate-500">Sistem mengirimkan bukti SPK elektronik, status pengerjaan, dan tautan live report</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-address-card text-slate-300 text-xl"></i>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1.5">Nama Lengkap Pemilik / Driver</label>
                                <div class="relative flex items-center">
                                    <input type="text" id="formNama" name="nama" required
                                        placeholder="cth: Raditya Pratama"
                                        value=""
                                        oninput="updateSummary()"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-3 pr-10 text-slate-900 text-xs font-semibold focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                    <i class="fa-regular fa-user absolute right-3.5 text-slate-400 text-xs"></i>
                                </div>
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-1.5">
                                    <label class="font-bold text-slate-700">Nomor WhatsApp Aktif</label>
                                    <span class="text-[10px] font-bold text-blue-600 font-mono">Aktif &amp; Terhubung</span>
                                </div>
                                <div class="relative flex items-center">
                                    <span class="absolute left-3 font-mono font-bold text-xs text-slate-500 border-r border-slate-300 pr-2">+62</span>
                                    <input type="tel" id="formWa" name="whatsapp" required
                                        placeholder="812-8876-4321"
                                        value=""
                                        oninput="updateSummary()"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 pl-14 pr-10 text-slate-900 font-mono font-bold text-xs focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                    <i class="fa-brands fa-whatsapp absolute right-3.5 text-emerald-600 text-sm"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN: RINGKASAN ESTIMASI BOOKING & LIVE CCTV FEED -->
                <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                    
                    <!-- SUMMARY ESTIMATION CARD -->
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-md">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                            <span class="text-[10px] font-bold uppercase font-mono tracking-wider text-slate-500">RINGKASAN ESTIMASI BOOKING</span>
                            <span class="text-[10px] font-bold uppercase font-mono px-2 py-0.5 rounded bg-blue-50 text-blue-700 border border-blue-200">SLOT TAMU</span>
                        </div>

                        <!-- Dynamic Plate and Model Header -->
                        <div class="mb-4">
                            <h3 id="sumPlate" class="font-mono font-extrabold text-xl text-slate-900 tracking-wider">-</h3>
                            <p id="sumModel" class="text-xs text-slate-500 mt-0.5">Silakan lengkapi identitas mobil</p>
                        </div>

                        <!-- Schedule details -->
                        <div class="bg-slate-50 rounded-xl p-3.5 space-y-2 text-xs border border-slate-100 mb-4">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Lokasi Kedatangan:</span>
                                <strong id="sumCabang" class="text-slate-900">Cabang Utama Jaksel</strong>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Jadwal Terpilih:</span>
                                <strong id="sumJadwal" class="text-slate-900">{{ $days[0]['day_name'] }}, {{ $days[0]['day_num'] }} &bull; 08:30 WIB</strong>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Estimasi Waktu Kerja:</span>
                                <strong id="sumDurasi" class="text-blue-700 font-mono">0 Menit</strong>
                            </div>
                        </div>

                        <!-- Service Items List -->
                        <div class="space-y-2 text-xs pb-3 border-b border-slate-100 mb-3" id="sumItemsContainer">
                            <div id="sumEmptyText" class="text-slate-400 italic text-center py-2 text-[11px]">
                                (Belum ada paket dipilih — silakan centang jenis pengerjaan)
                            </div>
                        </div>

                        <!-- Free Diagnostic Tag -->
                        <div class="flex justify-between items-center text-xs text-slate-600 mb-4">
                            <span>Jasa Mekanik &amp; Diagnosis OBD-II</span>
                            <span class="font-mono font-bold text-emerald-600 uppercase text-[11px]">GRATIS</span>
                        </div>

                        <!-- Grand Total -->
                        <div class="flex items-baseline justify-between pt-3 border-t border-slate-200 mb-4">
                            <div>
                                <span class="text-xs text-slate-500 font-bold block">Estimasi Total Awal</span>
                                <span class="text-[10px] text-slate-400 font-normal">Termasuk PPN &amp; Inspeksi</span>
                            </div>
                            <strong id="sumGrandTotal" class="font-heading font-extrabold text-2xl text-slate-900 tracking-tight">
                                Rp 0
                            </strong>
                        </div>

                        <p class="text-[10px] text-slate-400 leading-relaxed mb-5">
                            *Harga final dapat disesuaikan jika membutuhkan penggantian suku cadang tambahan setelah persetujuan Anda via WhatsApp.
                        </p>

                        <!-- Guarantees & Cancellation Policy -->
                        <div class="space-y-2.5 mb-5 text-[11px]">
                            <div class="flex items-start gap-2 text-slate-700 bg-emerald-50/70 border border-emerald-200/60 p-2.5 rounded-lg">
                                <i class="fa-solid fa-shield-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                                <span class="leading-tight">
                                    <strong class="font-bold">Garansi Servis Resmi 1.000 KM</strong><br>
                                    Atau 14 hari jaminan kualitas suku cadang &amp; kalibrasi mesin.
                                </span>
                            </div>

                            <div class="flex items-start gap-2 text-slate-600 bg-blue-50/50 border border-blue-100 p-2.5 rounded-lg">
                                <i class="fa-solid fa-circle-info text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span class="leading-tight">
                                    Tidak ada biaya penalti pembatalan. Pembayaran dilakukan di kasir bengkel secara transparan setelah kendaraan selesai diuji.
                                </span>
                            </div>
                        </div>

                        <!-- Auto-Register Member Checkbox -->
                        <div class="mb-5 flex items-start gap-2.5 text-xs">
                            <input type="checkbox" id="chkMember" name="buat_akun_member" value="1" class="rounded text-blue-600 mt-0.5 focus:ring-blue-500">
                            <label for="chkMember" class="text-slate-600 leading-snug cursor-pointer text-[11px]">
                                Ingin simpan data mobil ini untuk servis berikutnya? <strong class="text-slate-900">Centang untuk otomatis buat akun Garasi Member</strong> dengan nomor WhatsApp ini.
                            </label>
                        </div>

                        <!-- Main Submit Button -->
                        <button type="submit" id="btnKonfirmasi" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-3.5 px-4 rounded-xl text-xs flex items-center justify-center gap-2 shadow-lg shadow-slate-900/10 transition cursor-pointer">
                            <i class="fa-solid fa-calendar-check text-sm"></i>
                            <span>Konfirmasi Booking Servis (Gratis)</span>
                        </button>

                        <!-- WhatsApp Advisor Button -->
                        <a href="https://api.whatsapp.com/send?phone={{ $workshop['no_whatsapp'] }}&text=Halo%20MotoPro%20Workshop,%20saya%20butuh%20bantuan%20jadwal%20servis%20darurat" target="_blank" class="w-full mt-2.5 text-slate-600 hover:text-blue-600 text-center py-1.5 text-xs font-semibold flex items-center justify-center gap-1.5 transition">
                            <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                            <span>Butuh bantuan jadwal darurat? Chat Tim Advisor</span>
                        </a>

                    </div>

                    <!-- LIVE CCTV & MEKANIK TELEMETRI CARD -->
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-2xs">
                        <div class="p-3.5 bg-slate-900 text-white flex items-center justify-between text-xs">
                            <span class="font-mono font-bold tracking-wider text-[11px] uppercase">LIVE CCTV &amp; MEKANIK TELEMETRI</span>
                            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-red-400 bg-red-950/80 px-2 py-0.5 rounded border border-red-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-ping"></span>
                                Live Feed
                            </span>
                        </div>

                        <div class="relative h-44 bg-slate-800">
                            <img src="https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=800&q=80" alt="CCTV Pit Bay" class="w-full h-full object-cover opacity-90">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                            
                            <!-- Overlay Badges -->
                            <div class="absolute bottom-2.5 left-3 right-3 flex items-center justify-between text-white text-[10px] font-mono">
                                <span class="bg-black/60 px-2 py-0.5 rounded backdrop-blur-xs">STALL 02 • QUICK SERVICE BAY</span>
                                <span class="bg-emerald-600/80 px-2 py-0.5 rounded backdrop-blur-xs font-bold">60 FPS Telemetry</span>
                            </div>
                        </div>

                        <div class="p-3 bg-slate-50 flex items-center justify-between text-[11px] text-slate-500 border-t border-slate-200">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-clock-rotate-left text-blue-600"></i>
                                <span>Rata-rata pengerjaan: <strong>48 Menit</strong></span>
                            </span>
                            <span>Lead Tech: <strong class="text-slate-800">Budi Santoso</strong></span>
                        </div>
                    </div>

                </div>

            </div>
        </form>

    </main>

    <!-- ========================================================= -->
    <!-- 4. FOOTER (Matching MotoPro) -->
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
                        <span>Chat Advisor MotoPro</span>
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

    <!-- Interactive Calculations Script -->
    <script>
        let selectedDateLabel = '{{ $days[0]['day_name'] }}, {{ $days[0]['day_num'] }}';
        let selectedTimeLabel = '08:30 WIB';

        function selectDay(dateVal, dateLabel, btn) {
            document.getElementById('selectedDate').value = dateVal;
            selectedDateLabel = dateLabel;
            document.querySelectorAll('.day-pill').forEach(el => el.classList.remove('active'));
            btn.classList.add('active');
            updateSummary();
        }

        function selectTime(timeVal, btn) {
            document.getElementById('selectedTime').value = timeVal;
            selectedTimeLabel = timeVal;
            document.querySelectorAll('.time-pill').forEach(el => {
                el.classList.remove('active', 'border-blue-600', 'bg-blue-50', 'text-blue-900');
                if (!el.disabled) {
                    el.classList.add('bg-white', 'border-slate-200');
                }
            });
            btn.classList.remove('bg-white', 'border-slate-200');
            btn.classList.add('active', 'border-blue-600', 'bg-blue-50', 'text-blue-900');
            updateSummary();
        }

        function updateSummary() {
            // 1. Plat nomor & Model
            const plat = document.getElementById('formPlat').value.trim();
            const brand = document.getElementById('formBrand').value;
            const model = document.getElementById('formModel').value.trim();
            const year = document.getElementById('formYear').value.trim();
            const trans = document.getElementById('formTrans').value;

            const sumPlate = document.getElementById('sumPlate');
            const sumModel = document.getElementById('sumModel');

            sumPlate.textContent = plat ? plat.toUpperCase() : '-';

            let modelDesc = [];
            if (brand) modelDesc.push(brand);
            if (model) modelDesc.push(model);
            if (year) modelDesc.push(year);
            if (trans) modelDesc.push(trans);

            sumModel.textContent = modelDesc.length > 0 ? modelDesc.join(' • ') : 'Silakan lengkapi identitas mobil';

            // 2. Cabang & Jadwal
            const cabang = document.getElementById('formCabang').value;
            document.getElementById('sumCabang').textContent = cabang;
            document.getElementById('sumJadwal').innerHTML = `${selectedDateLabel} &bull; ${selectedTimeLabel}`;

            // 3. Checked Services & Totals
            const checkboxes = document.querySelectorAll('.service-checkbox:checked');
            const container = document.getElementById('sumItemsContainer');
            let total = 0;
            let totalMinutes = 0;

            if (checkboxes.length === 0) {
                container.innerHTML = `
                    <div id="sumEmptyText" class="text-slate-400 italic text-center py-2 text-[11px]">
                        (Belum ada paket dipilih — silakan centang jenis pengerjaan)
                    </div>
                `;
            } else {
                let html = '';
                checkboxes.forEach(cb => {
                    const price = parseInt(cb.dataset.price) || 0;
                    const min = parseInt(cb.dataset.minutes) || 0;
                    const title = cb.dataset.title;
                    const fmt = cb.dataset.fmt;

                    total += price;
                    totalMinutes += min;

                    html += `
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-700 truncate pr-2">${title}</span>
                            <span class="font-mono font-bold text-slate-900 shrink-0">${fmt}</span>
                        </div>
                    `;
                });
                container.innerHTML = html;
            }

            // Duration calculation
            if (totalMinutes === 0) {
                document.getElementById('sumDurasi').textContent = '0 Menit';
            } else if (totalMinutes < 60) {
                document.getElementById('sumDurasi').textContent = `~ ${totalMinutes} Menit`;
            } else {
                const hours = Math.floor(totalMinutes / 60);
                const remMinutes = totalMinutes % 60;
                document.getElementById('sumDurasi').textContent = remMinutes > 0 ? `~ ${hours} Jam ${remMinutes} Menit` : `~ ${hours} Jam`;
            }

            // Grand Total calculation
            document.getElementById('sumGrandTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', updateSummary);
    </script>
</body>
</html>
