<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Garage — Reservasi Booking Servis & Estimasi Biaya</title>
    <meta name="description" content="Form Reservasi Servis & Kalkulator Estimasi Biaya Cepat Bengkel L-Garage.">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        garage: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                            950: '#431407',
                        },
                        darkbase: {
                            800: '#1e232d',
                            900: '#14171f',
                            950: '#0c0e14',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        @keyframes statusPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.15); }
        }
        .pulse-live { animation: statusPulse 2s infinite ease-in-out; }
    </style>
</head>
<body class="min-h-screen flex antialiased selection:bg-garage-500 selection:text-white">

    <!-- ============================================================== -->
    <!-- DESKTOP SIDEBAR -->
    <!-- ============================================================== -->
    <aside class="w-64 bg-darkbase-900 border-r border-slate-800 text-slate-300 flex flex-col fixed inset-y-0 left-0 z-30 transition-all duration-300">
        
        <!-- Logo & Brand Header -->
        <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80 bg-darkbase-950/60">
            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-600 to-garage-500 flex items-center justify-center text-white shadow-lg shadow-garage-600/30">
                    <i class="fa-solid fa-wrench text-lg"></i>
                </div>
                <div>
                    <div class="font-heading font-black text-xl tracking-tight text-white leading-tight">
                        L-GARAGE<span class="text-garage-500">.</span>
                    </div>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span>
                        <span class="text-[11px] font-semibold text-emerald-400">Workshop Buka</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Workshop Info Plate -->
        <div class="p-4 mx-4 my-4 rounded-xl bg-slate-800/50 border border-slate-700/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-garage-500/10 text-garage-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Cabang Utama</div>
                    <div class="text-xs font-bold text-white">Bengkel BSE</div>
                </div>
            </div>
            <span class="px-2 py-0.5 text-[10px] font-bold bg-garage-500/20 text-garage-400 rounded-md border border-garage-500/30">
                PRO
            </span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <div class="px-3 pt-2 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Menu Utama
            </div>

            <!-- Dashboard -->
            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                <span>Dashboard</span>
            </a>

            <!-- Active: Booking Servis -->
            <a href="{{ route('bengkel.booking') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-sm bg-gradient-to-r from-garage-500 to-garage-600 text-white shadow-md shadow-garage-600/20">
                <i class="fa-solid fa-calendar-check w-5 text-center text-base"></i>
                <span>Booking Servis</span>
                <span class="ml-auto text-[10px] font-bold px-2 py-0.5 rounded-full bg-white/20 text-white">Aktif</span>
            </a>

            <!-- Antrean & Bay Servis -->
            <a href="{{ route('bengkel.antrean') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-car-side w-5 text-center text-base"></i>
                <span>Antrean PIT Bay</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">4 Free</span>
            </a>

            <!-- Estimasi Biaya -->
            <a href="{{ route('bengkel.booking') }}#estimasi-section" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-file-invoice-dollar w-5 text-center text-base"></i>
                <span>Kalkulator Estimasi</span>
            </a>

            <div class="px-3 pt-5 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Operasional
            </div>

            <!-- Pelanggan & Kendaraan -->
            <a href="{{ route('bengkel.pelanggan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-id-card-clip w-5 text-center text-base"></i>
                <span>Pelanggan & Unit</span>
            </a>

            <!-- Work Order & Servis -->
            <a href="{{ route('bengkel.servis') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-screwdriver-wrench w-5 text-center text-base"></i>
                <span>Work Order & Servis</span>
            </a>

            <!-- Kasir & Transaksi -->
            <a href="{{ route('bengkel.invoice') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-receipt w-5 text-center text-base"></i>
                <span>Kasir & Invoice</span>
            </a>
        </nav>

        <!-- Bottom Pit Bay Status Widget -->
        <div class="p-4 border-t border-slate-800/80 bg-darkbase-950/40">
            <div class="flex items-center justify-between text-xs mb-1.5">
                <span class="text-slate-400 font-semibold flex items-center gap-1.5">
                    <i class="fa-solid fa-screwdriver-wrench text-garage-500"></i> Kapasitas Bay
                </span>
                <span class="text-white font-bold">Slot BSD: 4 Tersisa</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: 100%"></div>
            </div>
            
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-3 rounded-lg text-xs font-bold text-rose-400 hover:text-white hover:bg-rose-500/20 border border-rose-500/30 transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- ============================================================== -->
    <!-- MAIN CONTENT AREA (WEBSITE DESKTOP FULL-WIDTH) -->
    <!-- ============================================================== -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        
        <!-- TOPBAR DESKTOP -->
        <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-20 px-8 flex items-center justify-between shadow-xs">
            
            <!-- Breadcrumbs & Quick Search -->
            <div class="flex items-center gap-6">
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                        <a href="{{ route('bengkel.dashboard') }}" class="hover:text-garage-600 transition">L-Garage Workshop</a>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        <span class="text-slate-700 font-bold">Booking & Reservasi Servis</span>
                    </div>
                    <h1 class="text-lg font-heading font-black text-slate-900 mt-0.5 flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-garage-500"></span>
                        Input Reservasi Servis & Estimasi Biaya
                    </h1>
                </div>

                <!-- Global Search Input -->
                <div class="hidden lg:flex items-center relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        placeholder="Cari data booking, nomor WA, plat..." 
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                    >
                </div>
            </div>

            <!-- Right Controls: Date, Slot Badge, Notifications, Profile -->
            <div class="flex items-center gap-4">
                <!-- Slot BSD Badge -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-orange-50 border border-orange-200 text-xs font-bold text-garage-700">
                    <span class="w-2 h-2 rounded-full bg-garage-500 pulse-live"></span>
                    <span>Slot BSD: 4 Tersisa</span>
                </div>

                <!-- Date Pill -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200/80 text-xs font-semibold text-slate-600">
                    <i class="fa-regular fa-calendar text-garage-500"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Notification Bell -->
                <button type="button" class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                    <i class="fa-regular fa-bell text-sm"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-garage-500"></span>
                </button>

                <!-- Profile Dropdown Plate -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-500 to-amber-500 text-white font-black font-heading flex items-center justify-center shadow-md shadow-garage-500/20 text-sm">
                        {{ strtoupper(substr($user->name ?? 'L', 0, 1)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <div class="text-xs font-bold text-slate-800 leading-tight">
                            {{ $user->name ?? 'L-Garage Workshop' }}
                        </div>
                        <div class="text-[11px] font-semibold text-garage-600">
                            Role: {{ strtoupper($user->role ?? 'bengkel') }}
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <!-- PAGE CONTENT CONTAINER -->
        <main class="flex-1 p-8 space-y-8 max-w-[1600px] w-full mx-auto">
            
            <!-- 1. TOP HEADER BANNER & SWITCH TABS -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center text-xl shadow-md shadow-blue-500/20">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <h2 class="text-2xl font-heading font-black text-slate-900 tracking-tight">
                                    Reservasi Servis
                                </h2>
                                <span class="px-3 py-0.5 rounded-full bg-orange-100 text-garage-700 border border-orange-200 text-xs font-bold flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-garage-500"></span>
                                    Slot BSD: 4 Tersisa
                                </span>
                            </div>
                            <p class="text-slate-500 text-xs md:text-sm mt-1">
                                Formulir pendaftaran booking baru & kalkulator estimasi biaya cepat (silakan isi data di bawah).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs (Form Booking vs Kalkulator Estimasi) -->
                <div class="inline-flex p-1.5 rounded-xl bg-slate-100 border border-slate-200/80 self-start md:self-auto">
                    <button 
                        type="button" 
                        id="tab-btn-booking"
                        onclick="switchTab('booking')"
                        class="px-5 py-2.5 rounded-lg text-xs font-bold transition flex items-center gap-2 bg-white text-garage-600 shadow-sm"
                    >
                        <i class="fa-regular fa-clipboard"></i>
                        <span>Form Booking</span>
                    </button>
                    <button 
                        type="button" 
                        id="tab-btn-estimasi"
                        onclick="switchTab('estimasi')"
                        class="px-5 py-2.5 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-900 transition flex items-center gap-2"
                    >
                        <i class="fa-solid fa-calculator"></i>
                        <span>Kalkulator Estimasi</span>
                    </button>
                </div>
            </div>

            <!-- 2. TWO-COLUMNS DESKTOP LAYOUT (8 COLS : 4 COLS) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- ====================================================== -->
                <!-- LEFT COLUMN: FORM BOOKING & ESTIMASI (8 COLUMNS) -->
                <!-- ====================================================== -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <!-- STEP 1: DATA PELANGGAN & MOBIL (KOSONG SIAP DIISI) -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
                        
                        <!-- Header Step 1 -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 font-heading font-black text-sm flex items-center justify-center">
                                    1
                                </span>
                                <div>
                                    <h3 class="font-heading font-bold text-slate-900 text-base">
                                        Data Pelanggan & Mobil
                                    </h3>
                                    <p class="text-xs text-slate-400">Silakan masukkan data pelanggan dan unit kendaraan yang akan diservis.</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 border border-slate-200 text-xs font-semibold flex items-center gap-1.5">
                                <i class="fa-solid fa-user-plus text-slate-400 text-[11px]"></i>
                                Input Data Baru
                            </span>
                        </div>

                        <!-- Row 1: Nomor WhatsApp & Nama Pelanggan -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- WhatsApp Field -->
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">
                                    Nomor WhatsApp / HP <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400">
                                        <i class="fa-brands fa-whatsapp text-base text-emerald-600"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="input-wa"
                                        placeholder="Contoh: 081234567890" 
                                        oninput="updateSummaryInfo()"
                                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition font-mono"
                                    >
                                </div>
                            </div>

                            <!-- Nama Lengkap Pemilik -->
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">
                                    Nama Lengkap Pelanggan <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative flex items-center">
                                    <div class="absolute left-4 text-slate-400">
                                        <i class="fa-regular fa-user text-sm"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="input-nama"
                                        placeholder="Contoh: Pak Rahmat Hidayat / Ibu Maya" 
                                        oninput="updateSummaryInfo()"
                                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Row 2: Status Member / Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">Tier / Kategori Pelanggan</label>
                                <select 
                                    id="input-tier"
                                    onchange="updateTierDiscount()"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                                    <option value="Reguler">Member Reguler (Non Diskon)</option>
                                    <option value="Silver">Silver Tier (Diskon Rp 25.000)</option>
                                    <option value="Gold">Gold Tier (Diskon Rp 50.000)</option>
                                    <option value="Diamond">Diamond Tier (Diskon Rp 100.000)</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">
                                    Merek & Model Kendaraan <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="input-model"
                                    placeholder="Contoh: Innova Reborn 2.4 Diesel / Avanza" 
                                    oninput="updateSummaryInfo()"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">
                                    Nomor Plat Polisi <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="input-plat"
                                    placeholder="Contoh: B 2314 TZZ" 
                                    oninput="this.value = this.value.toUpperCase(); updateSummaryInfo();"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 placeholder-slate-400 uppercase font-mono focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                            </div>
                        </div>

                        <!-- Row 3: Transmisi & Odometer -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">Transmisi Kendaraan</label>
                                <select 
                                    id="input-transmisi"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                                    <option value="Automatic">Automatic (A/T)</option>
                                    <option value="Manual">Manual (M/T)</option>
                                    <option value="CVT">CVT / e-CVT</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">Odometer Terakhir (KM)</label>
                                <input 
                                    type="number" 
                                    id="input-odo"
                                    placeholder="Contoh: 58400" 
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                            </div>
                        </div>

                        <!-- Row 4: Tanggal Kedatangan & Sesi Jam / Bay -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
                            <!-- Tanggal Kedatangan -->
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">Tanggal Kedatangan</label>
                                <input 
                                    type="date" 
                                    id="input-tanggal"
                                    value="{{ date('Y-m-d') }}" 
                                    onchange="updateSummaryInfo()"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                            </div>

                            <!-- Pilihan Sesi Jam -->
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">Pilihan Sesi Jam</label>
                                <select 
                                    id="input-sesi"
                                    onchange="updateSummaryInfo()"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                                    <option value="08:00 - 09:30">08:00 - 09:30 WIB (Pagi)</option>
                                    <option value="09:00 - 10:30" selected>09:00 - 10:30 WIB (Pagi)</option>
                                    <option value="10:30 - 12:00">10:30 - 12:00 WIB (Siang)</option>
                                    <option value="13:00 - 14:30">13:00 - 14:30 WIB (Siang)</option>
                                    <option value="14:30 - 16:00">14:30 - 16:00 WIB (Sore)</option>
                                    <option value="16:00 - 17:30">16:00 - 17:30 WIB (Sore)</option>
                                </select>
                            </div>

                            <!-- Alokasi Bay Servis -->
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-2">Alokasi PIT Bay</label>
                                <select 
                                    id="input-bay"
                                    onchange="updateSummaryInfo()"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                                >
                                    <option value="Pit 01 (Lift Hidrolik)">Pit 01 (Lift Hidrolik)</option>
                                    <option value="Pit 02 (Tune Up & Oli)">Pit 02 (Tune Up & Oli)</option>
                                    <option value="Pit 03 (Bay Utama)" selected>Pit 03 (Bay Utama)</option>
                                    <option value="Pit 04 (Diagnostik & Quick)">Pit 04 (Diagnostik & Quick)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Keluhan & Catatan Khusus (KOSONG SIAP DIISI) -->
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-2">Keluhan & Catatan Khusus Servis</label>
                            <textarea 
                                id="input-keluhan"
                                rows="3" 
                                class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition leading-relaxed"
                                placeholder="Tuliskan keluhan kendaraan dari pemilik (contoh: tarikan berat, getar saat kecepatan 80 km/jam, servis berkala, dll)..."
                            ></textarea>
                        </div>

                    </div>

                    <!-- STEP 2: KALKULATOR ESTIMASI BIAYA (DEFAULT CHECKLIST KOSONG / PILIH SENDIRI) -->
                    <div id="estimasi-section" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-6">
                        
                        <!-- Header Step 2 -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-garage-100 text-garage-700 font-heading font-black text-sm flex items-center justify-center">
                                    2
                                </span>
                                <div>
                                    <h3 class="font-heading font-bold text-slate-900 text-base">
                                        Kalkulator Estimasi Biaya
                                    </h3>
                                    <p class="text-xs text-slate-400">Centang layanan atau suku cadang yang dibutuhkan untuk kalkulasi estimasi instan.</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Katalog Siap Pilih
                            </span>
                        </div>

                        <!-- SECTION A: JASA SERVIS & KALIBRASI -->
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fa-solid fa-wrench text-garage-500"></i> Pilihan Jasa Servis & Kalibrasi
                                </span>
                                <span id="display-subtotal-jasa" class="text-sm font-black font-heading text-blue-600">
                                    Rp 0
                                </span>
                            </div>

                            <div class="space-y-2.5" id="jasa-container">
                                @foreach($jasaItems as $jasa)
                                <label class="p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-slate-50/50 hover:bg-slate-50/90 flex items-start justify-between cursor-pointer transition select-none">
                                    <div class="flex items-start gap-3.5">
                                        <input 
                                            type="checkbox" 
                                            class="calc-checkbox mt-1 w-4 h-4 rounded text-blue-600 focus:ring-blue-500" 
                                            data-type="jasa" 
                                            data-title="{{ $jasa['title'] }}"
                                            data-price="{{ $jasa['price'] }}" 
                                            onchange="recalculateEstimasi()"
                                        >
                                        <div>
                                            <div class="text-xs font-bold text-slate-800">{{ $jasa['title'] }}</div>
                                            <div class="text-[11px] text-slate-500 mt-0.5">{{ $jasa['desc'] }}</div>
                                        </div>
                                    </div>
                                    <span class="text-xs font-black font-heading text-slate-800 whitespace-nowrap ml-4">
                                        Rp {{ number_format($jasa['price'], 0, ',', '.') }}
                                    </span>
                                </label>
                                @endforeach
                            </div>

                            <!-- Tambah Custom Jasa Form -->
                            <div class="mt-3 pt-2 flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="custom-jasa-title" 
                                    placeholder="Tambah jasa lain (contoh: Kuras Minyak Rem)" 
                                    class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs"
                                >
                                <input 
                                    type="number" 
                                    id="custom-jasa-price" 
                                    placeholder="Biaya (Rp)" 
                                    class="w-32 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs"
                                >
                                <button 
                                    type="button" 
                                    onclick="addCustomJasa()" 
                                    class="px-3.5 py-2 rounded-lg bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs transition"
                                >
                                    + Tambah
                                </button>
                            </div>
                        </div>

                        <!-- SECTION B: SUKU CADANG & PELUMAS ORIGINAL -->
                        <div class="pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-2">
                                    <i class="fa-solid fa-boxes-stacked text-garage-500"></i> Pilihan Suku Cadang & Pelumas
                                </span>
                                <span id="display-subtotal-part" class="text-sm font-black font-heading text-blue-600">
                                    Rp 0
                                </span>
                            </div>

                            <div class="space-y-2.5" id="part-container">
                                @foreach($sparepartItems as $part)
                                <label class="p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-slate-50/50 hover:bg-slate-50/90 flex items-start justify-between cursor-pointer transition select-none">
                                    <div class="flex items-start gap-3.5">
                                        <input 
                                            type="checkbox" 
                                            class="calc-checkbox mt-1 w-4 h-4 rounded text-blue-600 focus:ring-blue-500" 
                                            data-type="part" 
                                            data-title="{{ $part['title'] }}"
                                            data-price="{{ $part['price'] }}" 
                                            onchange="recalculateEstimasi()"
                                        >
                                        <div>
                                            <div class="text-xs font-bold text-slate-800">{{ $part['title'] }}</div>
                                            <div class="text-[11px] text-slate-500 mt-0.5">{{ $part['desc'] }}</div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-[10px] font-semibold text-emerald-600 flex items-center gap-1">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Stok: {{ $part['stock'] }}
                                                </span>
                                                <span class="text-[10px] text-slate-400">&bull; {{ $part['unit_price_label'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="text-xs font-black font-heading text-slate-800 whitespace-nowrap ml-4">
                                        Rp {{ number_format($part['price'], 0, ',', '.') }}
                                    </span>
                                </label>
                                @endforeach
                            </div>

                            <!-- Tambah Custom Sparepart Form -->
                            <div class="mt-3 pt-2 flex items-center gap-2">
                                <input 
                                    type="text" 
                                    id="custom-part-title" 
                                    placeholder="Tambah part lain (contoh: Busi Iridium 4 Pcs)" 
                                    class="flex-1 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs"
                                >
                                <input 
                                    type="number" 
                                    id="custom-part-price" 
                                    placeholder="Harga (Rp)" 
                                    class="w-32 px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg text-xs"
                                >
                                <button 
                                    type="button" 
                                    onclick="addCustomPart()" 
                                    class="px-3.5 py-2 rounded-lg bg-slate-800 hover:bg-slate-900 text-white font-bold text-xs transition"
                                >
                                    + Tambah
                                </button>
                            </div>
                        </div>

                        <!-- SECTION C: DISKON POTONGAN / KUPON -->
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-orange-500 text-white flex items-center justify-center text-sm shadow-xs">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-900">Potongan Diskon / Kupon Servis</div>
                                    <div class="text-[11px] text-slate-500" id="tier-discount-desc">Pilih tier member atau input nominal diskon</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-500">- Rp</span>
                                <input 
                                    type="number" 
                                    id="input-diskon" 
                                    value="0" 
                                    min="0"
                                    oninput="recalculateEstimasi()"
                                    class="w-32 px-3 py-1.5 bg-white border border-slate-300 rounded-lg text-xs font-bold text-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500/20"
                                >
                            </div>
                        </div>

                        <!-- SECTION D: ACTION BUTTONS -->
                        <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-4">
                            <!-- Button Simpan Booking -->
                            <button 
                                type="button" 
                                onclick="handleSimpanBooking()" 
                                class="w-full sm:flex-1 py-4 px-6 rounded-xl bg-gradient-to-r from-garage-600 to-amber-600 hover:from-garage-700 hover:to-amber-700 text-white font-bold text-sm shadow-lg shadow-garage-600/30 transition flex items-center justify-center gap-2.5 active:scale-95"
                            >
                                <i class="fa-solid fa-circle-check"></i>
                                <span>Simpan Booking & Jadwalkan</span>
                            </button>

                            <!-- Button WhatsApp -->
                            <button 
                                type="button" 
                                onclick="handleKirimWhatsApp()" 
                                class="w-full sm:w-auto py-4 px-6 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 transition flex items-center justify-center gap-2.5"
                            >
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                                <span>Kirim Estimasi Rinci ke WhatsApp Pelanggan</span>
                            </button>
                        </div>

                    </div>

                </div>

                <!-- ====================================================== -->
                <!-- RIGHT COLUMN: TOTAL ESTIMASI & RECENT BOOKINGS (4 COLS) -->
                <!-- ====================================================== -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- 1. STICKY TOTAL ESTIMASI SIAP KERJA CARD -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-md p-6 sticky top-28 space-y-4">
                        
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                Ringkasan Biaya
                            </span>
                            <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-700 text-[10px] font-bold">
                                Realtime Kalkulator
                            </span>
                        </div>

                        <!-- Live Customer & Car Preview -->
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs space-y-1">
                            <div class="flex items-center justify-between font-bold text-slate-800">
                                <span id="preview-nama">Nama: (Belum diisi)</span>
                                <span id="preview-plat" class="font-mono text-garage-600">---</span>
                            </div>
                            <div class="text-[11px] text-slate-500 truncate" id="preview-model">
                                Unit: (Belum memilih model)
                            </div>
                        </div>

                        <!-- Breakdown Rows -->
                        <div class="space-y-2 text-xs">
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Subtotal Jasa Servis</span>
                                <span id="summary-subtotal-jasa" class="font-bold text-slate-800">Rp 0</span>
                            </div>
                            <div class="flex items-center justify-between text-slate-600">
                                <span>Subtotal Suku Cadang & Pelumas</span>
                                <span id="summary-subtotal-part" class="font-bold text-slate-800">Rp 0</span>
                            </div>
                            <div class="flex items-center justify-between text-rose-600 font-semibold">
                                <span>Diskon Promo Member</span>
                                <span id="summary-diskon">- Rp 0</span>
                            </div>
                        </div>

                        <!-- Grand Total Highlight -->
                        <div class="pt-4 border-t border-slate-200">
                            <div class="text-xs text-slate-400">Total Estimasi Siap Kerja</div>
                            <div id="grand-total-display" class="text-3xl font-heading font-black text-blue-700 tracking-tight mt-0.5">
                                Rp 0
                            </div>
                            <div class="mt-2 text-[11px] text-slate-500 flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-emerald-500"></i>
                                <span>Termasuk PPN & General Checkup 21 Titik</span>
                            </div>
                        </div>

                        <!-- Booking Status Pill -->
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 text-xs flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                <span class="text-slate-600 font-semibold">Alokasi: <strong id="preview-bay">Pit 03 (Bay Utama)</strong></span>
                            </div>
                            <span class="text-[10px] font-bold text-slate-500 font-mono" id="preview-sesi">09:00 - 10:30</span>
                        </div>

                    </div>

                    <!-- 2. BOOKING MASUK TERKINI (EMPTY STATE AWAL SIAP DIISI) -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                        
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-calendar-days text-garage-500"></i>
                                <h4 class="font-heading font-bold text-slate-900 text-sm">
                                    Booking Masuk Terkini
                                </h4>
                            </div>
                            <span id="booking-count-badge" class="text-xs font-bold text-slate-400">
                                0 Reservasi
                            </span>
                        </div>

                        <!-- Container of Bookings -->
                        <div id="recent-bookings-container" class="space-y-3">
                            <!-- Empty State Display -->
                            <div id="empty-booking-state" class="py-8 px-4 text-center border-2 border-dashed border-slate-200 rounded-xl">
                                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                                    <i class="fa-regular fa-calendar-xmark text-xl"></i>
                                </div>
                                <div class="text-xs font-bold text-slate-700">Belum Ada Reservasi Masuk</div>
                                <div class="text-[11px] text-slate-400 mt-1 max-w-[220px] mx-auto leading-relaxed">
                                    Data booking baru yang Anda simpan melalui form di samping akan otomatis tampil di sini.
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </main>

        <!-- FOOTER -->
        <footer class="mt-auto px-8 py-5 bg-white border-t border-slate-200 text-slate-400 text-xs flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>L-Garage Workshop System</strong> &bull; Modul Reservasi & Estimasi.
            </div>
            <div class="flex items-center gap-4 text-[11px] font-medium">
                <span>Versi 2.4.0 (Desktop Edition)</span>
                <span>&bull;</span>
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> WhatsApp Gateway Active
                </span>
            </div>
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- INTERACTIVE JAVASCRIPT LOGIC -->
    <!-- ============================================================== -->
    <script>
        let currentGrandTotal = 0;
        let createdBookingsCount = 0;

        function recalculateEstimasi() {
            let totalJasa = 0;
            let totalPart = 0;
            const diskon = parseInt(document.getElementById('input-diskon').value || 0);

            document.querySelectorAll('.calc-checkbox').forEach(cb => {
                if (cb.checked) {
                    const price = parseInt(cb.dataset.price || 0);
                    if (cb.dataset.type === 'jasa') {
                        totalJasa += price;
                    } else if (cb.dataset.type === 'part') {
                        totalPart += price;
                    }
                }
            });

            currentGrandTotal = Math.max(0, (totalJasa + totalPart) - diskon);

            const formatRupiah = (val) => 'Rp ' + val.toLocaleString('id-ID');

            // Update UI elements
            document.getElementById('display-subtotal-jasa').innerText = formatRupiah(totalJasa);
            document.getElementById('summary-subtotal-jasa').innerText = formatRupiah(totalJasa);

            document.getElementById('display-subtotal-part').innerText = formatRupiah(totalPart);
            document.getElementById('summary-subtotal-part').innerText = formatRupiah(totalPart);

            document.getElementById('summary-diskon').innerText = '- ' + formatRupiah(diskon);
            document.getElementById('grand-total-display').innerText = formatRupiah(currentGrandTotal);
        }

        function updateTierDiscount() {
            const tier = document.getElementById('input-tier').value;
            const diskonInput = document.getElementById('input-diskon');
            const desc = document.getElementById('tier-discount-desc');

            if (tier === 'Diamond') {
                diskonInput.value = 100000;
                desc.innerText = 'Potongan Diamond VIP Tier otomatis diterapkan';
            } else if (tier === 'Gold') {
                diskonInput.value = 50000;
                desc.innerText = 'Potongan Gold Member otomatis diterapkan';
            } else if (tier === 'Silver') {
                diskonInput.value = 25000;
                desc.innerText = 'Potongan Silver Member otomatis diterapkan';
            } else {
                diskonInput.value = 0;
                desc.innerText = 'Member Reguler (Non diskon otomatis)';
            }
            recalculateEstimasi();
        }

        function updateSummaryInfo() {
            const nama = document.getElementById('input-nama').value.trim();
            const plat = document.getElementById('input-plat').value.trim();
            const model = document.getElementById('input-model').value.trim();
            const bay = document.getElementById('input-bay').value;
            const sesi = document.getElementById('input-sesi').value;

            document.getElementById('preview-nama').innerText = nama ? 'Nama: ' + nama : 'Nama: (Belum diisi)';
            document.getElementById('preview-plat').innerText = plat || '---';
            document.getElementById('preview-model').innerText = model ? 'Unit: ' + model : 'Unit: (Belum memilih model)';
            document.getElementById('preview-bay').innerText = bay;
            document.getElementById('preview-sesi').innerText = sesi;
        }

        function addCustomJasa() {
            const titleInput = document.getElementById('custom-jasa-title');
            const priceInput = document.getElementById('custom-jasa-price');
            const title = titleInput.value.trim();
            const price = parseInt(priceInput.value || 0);

            if (!title || price <= 0) {
                alert('Silakan masukkan nama jasa dan biaya yang valid.');
                return;
            }

            const container = document.getElementById('jasa-container');
            const newLabel = document.createElement('label');
            newLabel.className = 'p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-slate-50/50 hover:bg-slate-50/90 flex items-start justify-between cursor-pointer transition select-none';
            newLabel.innerHTML = `
                <div class="flex items-start gap-3.5">
                    <input type="checkbox" class="calc-checkbox mt-1 w-4 h-4 rounded text-blue-600 focus:ring-blue-500" data-type="jasa" data-title="${title}" data-price="${price}" checked onchange="recalculateEstimasi()">
                    <div>
                        <div class="text-xs font-bold text-slate-800">${title}</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Jasa Tambahan Kustom</div>
                    </div>
                </div>
                <span class="text-xs font-black font-heading text-slate-800 whitespace-nowrap ml-4">Rp ${price.toLocaleString('id-ID')}</span>
            `;
            container.appendChild(newLabel);

            titleInput.value = '';
            priceInput.value = '';
            recalculateEstimasi();
        }

        function addCustomPart() {
            const titleInput = document.getElementById('custom-part-title');
            const priceInput = document.getElementById('custom-part-price');
            const title = titleInput.value.trim();
            const price = parseInt(priceInput.value || 0);

            if (!title || price <= 0) {
                alert('Silakan masukkan nama suku cadang dan harga yang valid.');
                return;
            }

            const container = document.getElementById('part-container');
            const newLabel = document.createElement('label');
            newLabel.className = 'p-3.5 rounded-xl border border-slate-200 hover:border-slate-300 bg-slate-50/50 hover:bg-slate-50/90 flex items-start justify-between cursor-pointer transition select-none';
            newLabel.innerHTML = `
                <div class="flex items-start gap-3.5">
                    <input type="checkbox" class="calc-checkbox mt-1 w-4 h-4 rounded text-blue-600 focus:ring-blue-500" data-type="part" data-title="${title}" data-price="${price}" checked onchange="recalculateEstimasi()">
                    <div>
                        <div class="text-xs font-bold text-slate-800">${title}</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Suku Cadang Kustom</div>
                    </div>
                </div>
                <span class="text-xs font-black font-heading text-slate-800 whitespace-nowrap ml-4">Rp ${price.toLocaleString('id-ID')}</span>
            `;
            container.appendChild(newLabel);

            titleInput.value = '';
            priceInput.value = '';
            recalculateEstimasi();
        }

        function switchTab(tab) {
            const btnBooking = document.getElementById('tab-btn-booking');
            const btnEstimasi = document.getElementById('tab-btn-estimasi');
            const estimasiSec = document.getElementById('estimasi-section');

            if (tab === 'booking') {
                btnBooking.className = 'px-5 py-2.5 rounded-lg text-xs font-bold transition flex items-center gap-2 bg-white text-garage-600 shadow-sm';
                btnEstimasi.className = 'px-5 py-2.5 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-900 transition flex items-center gap-2';
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                btnEstimasi.className = 'px-5 py-2.5 rounded-lg text-xs font-bold transition flex items-center gap-2 bg-white text-garage-600 shadow-sm';
                btnBooking.className = 'px-5 py-2.5 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-900 transition flex items-center gap-2';
                estimasiSec.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function handleSimpanBooking() {
            const nama = document.getElementById('input-nama').value.trim();
            const plat = document.getElementById('input-plat').value.trim();
            const model = document.getElementById('input-model').value.trim();
            const wa = document.getElementById('input-wa').value.trim();
            const sesi = document.getElementById('input-sesi').value;
            const bay = document.getElementById('input-bay').value;
            const tanggal = document.getElementById('input-tanggal').value;

            if (!nama || !plat || !model) {
                alert('Mohon lengkapi Nama Pelanggan, Merek/Model Kendaraan, dan Nomor Plat terlebih dahulu.');
                return;
            }

            // Hapus empty state jika ada
            const emptyState = document.getElementById('empty-booking-state');
            if (emptyState) {
                emptyState.remove();
            }

            createdBookingsCount++;
            document.getElementById('booking-count-badge').innerText = createdBookingsCount + ' Reservasi';

            const container = document.getElementById('recent-bookings-container');
            const newBookingCard = document.createElement('div');
            newBookingCard.className = 'p-3.5 rounded-xl border border-emerald-200 bg-emerald-50/50 flex items-start gap-3 transition animate-fade-in shadow-xs';
            newBookingCard.innerHTML = `
                <div class="px-2.5 py-1.5 rounded-lg text-center font-bold text-[10px] leading-tight bg-blue-100 text-blue-700">
                    <div>BARU</div>
                    <div class="text-[11px] font-mono">${sesi.split(' - ')[0]}</div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <div class="font-bold text-xs text-slate-900 truncate">${model}</div>
                        <span class="px-1.5 py-0.2 rounded text-[10px] font-mono bg-slate-900 text-white font-bold">
                            ${plat}
                        </span>
                    </div>
                    <div class="text-[11px] text-slate-600 mt-0.5 truncate">
                        ${nama} &bull; ${bay}
                    </div>
                    <div class="text-[10px] text-emerald-700 font-bold mt-1">
                        Est: Rp ${currentGrandTotal.toLocaleString('id-ID')}
                    </div>
                </div>
                <div class="flex items-center gap-1 text-[11px] font-bold text-emerald-600 whitespace-nowrap">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>Tersimpan</span>
                </div>
            `;
            container.prepend(newBookingCard);

            alert(`Sukses! Reservasi booking untuk ${nama} (${model} - ${plat}) berhasil disimpan pada ${tanggal} (${sesi} di ${bay}).`);
        }

        function handleKirimWhatsApp() {
            const nama = document.getElementById('input-nama').value.trim() || 'Pelanggan';
            const model = document.getElementById('input-model').value.trim() || 'Kendaraan Anda';
            const plat = document.getElementById('input-plat').value.trim() || '-';
            const wa = document.getElementById('input-wa').value.replace(/[^0-9]/g, '');
            const sesi = document.getElementById('input-sesi').value;
            const bay = document.getElementById('input-bay').value;
            const tanggal = document.getElementById('input-tanggal').value;
            const grandTotal = document.getElementById('grand-total-display').innerText;

            let selectedServices = [];
            document.querySelectorAll('.calc-checkbox:checked').forEach(cb => {
                selectedServices.push(`• ${cb.dataset.title} (Rp ${parseInt(cb.dataset.price).toLocaleString('id-ID')})`);
            });

            const rincianText = selectedServices.length > 0 ? selectedServices.join('%0A') : '• Servis Berkala & General Checkup';

            const msg = `Halo ${nama},%0A%0ABerikut rincian Estimasi Servis L-Garage Anda:%0A- Unit: ${model} (${plat})%0A- Tanggal: ${tanggal} (${sesi} WIB)%0A- Lokasi: L-Garage BSD (${bay})%0A%0ARincian Pekerjaan:%0A${rincianText}%0A%0A*Total Estimasi Siap Kerja: ${grandTotal}*%0A%0ASilakan konfirmasi kehadiran Anda. Terima kasih!`;
            
            const targetPhone = wa.startsWith('0') ? '62' + wa.substring(1) : (wa || '6281234567890');
            window.open(`https://wa.me/${targetPhone}?text=${msg}`, '_blank');
        }
    </script>

</body>
</html>
