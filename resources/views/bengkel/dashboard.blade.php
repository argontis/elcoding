<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Garage — Dashboard Bengkel & Workshop Management</title>
    <meta name="description" content="Sistem Manajemen Operasional & Servis Bengkel Profesional L-Garage.">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Tailwind CSS CDN & Chart.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /* Subtle pulse for live status indicator */
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
            <div class="flex items-center gap-3">
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
            </div>
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

            <!-- Active Dashboard -->
            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-sm bg-gradient-to-r from-garage-500 to-garage-600 text-white shadow-md shadow-garage-600/20">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                <span>Dashboard</span>
            </a>

            <!-- Booking & Estimasi -->
            <a href="{{ route('bengkel.booking') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-calendar-check w-5 text-center text-base"></i>
                <span>Booking Servis</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-800 text-slate-400">0</span>
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
                <span>Buat Estimasi</span>
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
                <span class="text-white font-bold">{{ $stats['pit_aktif'] }}/{{ $stats['pit_total'] }} (0%)</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full bg-garage-500 rounded-full" style="width: 0%"></div>
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
                        <span>L-Garage Workshop</span>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        <span class="text-slate-700">Dashboard Utama</span>
                    </div>
                    <h1 class="text-lg font-heading font-black text-slate-900 mt-0.5">
                        Panel Operasional Bengkel
                    </h1>
                </div>

                <!-- Global Search Input -->
                <div class="hidden lg:flex items-center relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        placeholder="Cari plat nomor, nama pelanggan..." 
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                    >
                </div>
            </div>

            <!-- Right Controls: Date, Notifications, Profile -->
            <div class="flex items-center gap-4">
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
            
            <!-- 1. GREETING BANNER WITH ACTIONS -->
            <div class="p-6 md:p-8 rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-darkbase-900 border border-slate-800 text-white shadow-lg relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6">
                <!-- Background decorative glow -->
                <div class="absolute -right-12 -top-12 w-64 h-64 bg-garage-500/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white/90 text-xs font-semibold backdrop-blur-sm mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Sistem Siap Digunakan &bull; Mode Website Desktop
                    </div>
                    <h2 class="text-2xl md:text-3xl font-heading font-black tracking-tight text-white">
                        Selamat Datang, <span class="text-garage-400">{{ $user->name ?? 'L-Garage Workshop' }}</span> 👋
                    </h2>
                    <p class="text-slate-300 text-xs md:text-sm mt-1 max-w-xl leading-relaxed">
                        Kelola antrean booking, pengerjaan servis mekanik, estimasi biaya, dan pemantauan pendapatan bengkel secara efisien di satu dashboard terintegrasi.
                    </p>
                </div>

                <!-- Quick Action Buttons -->
                <div class="relative z-10 flex flex-wrap items-center gap-3">
                    <a 
                        href="{{ route('bengkel.booking') }}" 
                        class="px-5 py-3 rounded-xl bg-gradient-to-r from-garage-500 to-garage-600 hover:from-garage-600 hover:to-garage-700 text-white font-bold text-xs md:text-sm shadow-lg shadow-garage-600/30 transition flex items-center gap-2 active:scale-95"
                    >
                        <i class="fa-solid fa-plus"></i>
                        <span>+ Booking Baru</span>
                    </a>

                    <a 
                        href="{{ route('bengkel.booking') }}#estimasi-section" 
                        class="px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs md:text-sm border border-white/20 backdrop-blur-sm transition flex items-center gap-2"
                    >
                        <i class="fa-solid fa-file-invoice"></i>
                        <span>Buat Estimasi</span>
                    </a>

                    <button 
                        type="button" 
                        onclick="alert('Pencarian Status Kendaraan siap digunakan!');" 
                        class="px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs md:text-sm border border-white/20 backdrop-blur-sm transition flex items-center gap-2"
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Cek Status</span>
                    </button>
                </div>
            </div>

            <!-- 2. FOUR WIDE KPI / STAT CARDS GRID -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Stat 1: Booking Hari Ini -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-bold">
                            <i class="fa-regular fa-calendar-check"></i>
                        </span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">
                            +0 baru
                        </span>
                    </div>
                    <div class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $stats['booking_hari_ini'] }}
                    </div>
                    <div class="text-xs font-bold text-slate-700 mt-1">Booking Hari Ini</div>
                    <div class="text-[11px] text-slate-400">Kendaraan terjadwal masuk</div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-amber-500 opacity-80 group-hover:h-1.5 transition-all"></div>
                </div>

                <!-- Stat 2: Sedang Diservis -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg font-bold">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-600 border border-blue-100">
                            Bay Servis
                        </span>
                    </div>
                    <div class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $stats['sedang_diservis'] }}
                    </div>
                    <div class="text-xs font-bold text-slate-700 mt-1">Sedang Diservis</div>
                    <div class="text-[11px] text-slate-400">Unit dalam pengerjaan teknisi</div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-blue-600 opacity-80 group-hover:h-1.5 transition-all"></div>
                </div>

                <!-- Stat 3: Siap Diambil -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-bold">
                            <i class="fa-solid fa-car"></i>
                        </span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                            QC Approved
                        </span>
                    </div>
                    <div class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $stats['siap_ambil'] }}
                    </div>
                    <div class="text-xs font-bold text-slate-700 mt-1">Siap Diambil</div>
                    <div class="text-[11px] text-slate-400">Servis tuntas & menunggu serah terima</div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 opacity-80 group-hover:h-1.5 transition-all"></div>
                </div>

                <!-- Stat 4: Servis Selesai -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-12 h-12 rounded-xl bg-garage-50 text-garage-600 flex items-center justify-center text-lg font-bold">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-garage-50 text-garage-600 border border-garage-100">
                            Hari Ini
                        </span>
                    </div>
                    <div class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $stats['servis_selesai'] }}
                    </div>
                    <div class="text-xs font-bold text-slate-700 mt-1">Servis Selesai</div>
                    <div class="text-[11px] text-slate-400">Total unit terselesaikan hari ini</div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-garage-600 opacity-80 group-hover:h-1.5 transition-all"></div>
                </div>

            </div>

            <!-- 3. WORK ORDER PIPELINE TABS (DESKTOP WIDE) -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-bars-progress text-garage-500"></i>
                            Pipeline Pengerjaan Servis
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Alur tahapan kendaraan dari kedatangan hingga checkout.</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Semua PIT Bay Tersedia
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach($pipeline as $pipe)
                    <div class="p-3.5 rounded-xl border border-slate-100 bg-slate-50/70 hover:bg-white hover:border-slate-300 transition flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-xs
                                @if($pipe['color'] === 'amber') bg-amber-100 text-amber-700
                                @elseif($pipe['color'] === 'blue') bg-blue-100 text-blue-700
                                @elseif($pipe['color'] === 'orange') bg-orange-100 text-orange-700
                                @else bg-emerald-100 text-emerald-700 @endif
                            ">
                                {{ $pipe['count'] }}
                            </div>
                            <span class="text-xs font-bold text-slate-700">{{ $pipe['label'] }}</span>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- 4. TWO-COLUMNS DESKTOP LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: SERVIS PRIORITAS & DAFTAR WORK ORDER (8 COLUMNS) -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        
                        <!-- Table Card Header -->
                        <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="font-heading font-black text-slate-900 text-base flex items-center gap-2">
                                    <i class="fa-solid fa-clipboard-list text-garage-500"></i>
                                    Daftar Servis & Antrean Kendaraan
                                </h3>
                                <p class="text-xs text-slate-400 mt-0.5">Daftar work order aktif dalam pengerjaan dan antrean servis.</p>
                            </div>

                            <div class="flex items-center gap-2">
                                <button type="button" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 hover:bg-slate-200 transition">
                                    Filter: Semua
                                </button>
                                <button type="button" onclick="alert('Formulir Booking Baru siap dibuatkan!');" class="px-3.5 py-1.5 rounded-lg text-xs font-bold bg-garage-500 hover:bg-garage-600 text-white shadow-xs transition flex items-center gap-1.5">
                                    <i class="fa-solid fa-plus"></i> Tambah
                                </button>
                            </div>
                        </div>

                        <!-- EMPTY STATE DISPLAY (SESUAI REQUEST: DATA KOSONG) -->
                        <div class="p-12 text-center flex flex-col items-center justify-center">
                            
                            <div class="w-24 h-24 rounded-3xl bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-400 mb-4 shadow-inner">
                                <i class="fa-solid fa-car text-4xl text-slate-300"></i>
                            </div>

                            <h4 class="font-heading font-bold text-slate-800 text-lg">
                                Belum Ada Kendaraan Dalam Antrean
                            </h4>
                            
                            <p class="text-xs text-slate-500 max-w-md mt-1.5 leading-relaxed">
                                Saat ini seluruh bay servis kosong dan belum ada antrean booking hari ini. Anda dapat membuat booking baru atau mencatat servis langsung untuk memulai data operasional.
                            </p>

                            <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                                <a 
                                    href="{{ route('bengkel.booking') }}" 
                                    class="px-5 py-2.5 rounded-xl bg-garage-500 hover:bg-garage-600 text-white font-bold text-xs shadow-md shadow-garage-500/20 transition flex items-center gap-2"
                                >
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Buat Booking Baru</span>
                                </a>

                                <button 
                                    type="button" 
                                    onclick="alert('Fitur Pendaftaran Kendaraan Langsung siap digunakan!');" 
                                    class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition"
                                >
                                    Input Servis Walk-in
                                </button>
                            </div>

                            <!-- Quick Tip -->
                            <div class="mt-8 px-4 py-3 rounded-xl bg-amber-50 border border-amber-200/70 text-amber-800 text-xs flex items-center gap-2.5 max-w-md text-left">
                                <i class="fa-solid fa-lightbulb text-amber-500 text-base"></i>
                                <span><strong>Tips Workshop:</strong> Sambungkan modul barcode atau RFID untuk proses check-in kendaraan yang lebih cepat.</span>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT COLUMN: FINANCIAL & WORKSHOP CAPACITY (4 COLUMNS) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- 1. PENDAPATAN HARI INI CARD -->
                    <div class="bg-gradient-to-br from-slate-900 to-darkbase-900 rounded-2xl p-6 text-white border border-slate-800 shadow-md relative overflow-hidden">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Pendapatan Hari Ini
                            </span>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 text-[10px] font-bold">
                                Realtime Kasir
                            </span>
                        </div>

                        <div class="text-3xl font-heading font-black text-white tracking-tight">
                            {{ $stats['pendapatan_hari'] }}
                        </div>
                        
                        <div class="text-xs text-slate-400 mt-1">
                            Total Invoice: <span class="text-white font-bold">{{ $stats['total_invoice'] }} Transaksi</span>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-800 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Rata-rata per Servis:</span>
                            <span class="text-white font-bold">Rp 0</span>
                        </div>
                    </div>

                    <!-- 2. STATUS BAY & PIT SERVIS -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-warehouse text-garage-500"></i>
                                Status Bay Servis (4 Bay)
                            </h4>
                            <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                Semua Kosong
                            </span>
                        </div>

                        <div class="space-y-2.5">
                            <div class="p-3 rounded-xl border border-slate-100 bg-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-6 h-6 rounded-lg bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center">1</span>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">PIT 1 (Lift Hidrolik)</div>
                                        <div class="text-[10px] text-slate-400">Servis Berat & Kaki-kaki</div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">Tersedia</span>
                            </div>

                            <div class="p-3 rounded-xl border border-slate-100 bg-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-6 h-6 rounded-lg bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center">2</span>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">PIT 2 (Tune Up & Oli)</div>
                                        <div class="text-[10px] text-slate-400">Perawatan Rutin Cepat</div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">Tersedia</span>
                            </div>

                            <div class="p-3 rounded-xl border border-slate-100 bg-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-6 h-6 rounded-lg bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center">3</span>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">PIT 3 (Spooring & Balancing)</div>
                                        <div class="text-[10px] text-slate-400">Roda & Kemudi</div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">Tersedia</span>
                            </div>

                            <div class="p-3 rounded-xl border border-slate-100 bg-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-6 h-6 rounded-lg bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center">4</span>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">PIT 4 (Diagnostik & Kelistrikan)</div>
                                        <div class="text-[10px] text-slate-400">Scanner ECU & Wiring</div>
                                    </div>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-700">Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <!-- 3. TREN PENDAPATAN MINGGUAN -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-chart-line text-garage-500"></i>
                                Tren Pendapatan 7 Hari
                            </h4>
                            <span class="text-xs font-bold text-slate-400">Rp 0</span>
                        </div>

                        <div class="h-40 flex items-end justify-between gap-2 pt-4 px-2">
                            @foreach($weeklyRevenue['labels'] as $idx => $day)
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                                <div class="w-full bg-slate-100 rounded-t-md h-24 flex items-end justify-center relative overflow-hidden group">
                                    <div class="w-full bg-garage-500 rounded-t-md transition-all duration-500 group-hover:bg-garage-600" style="height: 4px;"></div>
                                </div>
                                <span class="text-[10px] font-semibold text-slate-400">{{ $day }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>

        </main>

        <!-- FOOTER -->
        <footer class="mt-auto px-8 py-5 bg-white border-t border-slate-200 text-slate-400 text-xs flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>L-Garage Workshop System</strong> &bull; Elcoding Platform.
            </div>
            <div class="flex items-center gap-4 text-[11px] font-medium">
                <span>Versi 2.4.0 (Desktop Edition)</span>
                <span>&bull;</span>
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Database Connected
                </span>
            </div>
        </footer>

    </div>

</body>
</html>
