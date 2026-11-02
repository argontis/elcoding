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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
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

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="bengkelSidebarOverlay" onclick="toggleBengkelSidebar()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 hidden lg:hidden transition-opacity"></div>

    <!-- ============================================================== -->
    <!-- SIDEBAR (RESPONSIVE DRAWER ON MOBILE) -->
    <!-- ============================================================== -->
    <aside id="bengkelSidebar" class="w-64 bg-darkbase-900 border-r border-slate-800 text-slate-300 flex flex-col fixed inset-y-0 left-0 z-50 -translate-x-full lg:translate-x-0 transition-transform duration-300 shadow-2xl lg:shadow-none">
        
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
            <!-- Close Button for Mobile -->
            <button type="button" onclick="toggleBengkelSidebar()" class="lg:hidden w-8 h-8 rounded-lg bg-slate-800 text-slate-400 hover:text-white flex items-center justify-center text-sm transition" title="Tutup Menu">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <!-- Workshop Info Plate -->
        <div class="p-4 mx-4 my-4 rounded-xl bg-slate-800/50 border border-slate-700/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-garage-500/10 text-garage-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Cabang Cibubur</div>
                    <div class="text-xs font-bold text-white truncate max-w-[120px]">Ruko Kranggan</div>
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
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-800 text-slate-400">{{ $stats['booking_hari_ini'] }}</span>
            </a>

            <!-- Antrean & Bay Servis -->
            <a href="{{ route('bengkel.antrean') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-car-side w-5 text-center text-base"></i>
                <span>Antrean PIT Bay</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded {{ $stats['pit_aktif'] < 4 ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400' }}">
                    {{ 4 - $stats['pit_aktif'] }} Free
                </span>
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

            <div class="px-3 pt-5 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Pusat Informasi
            </div>

            <a href="{{ url('/bengkel') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/40 transition">
                <i class="fa-solid fa-arrow-up-right-from-square w-5 text-center"></i>
                <span>Halaman Pengunjung</span>
            </a>
        </nav>

        <!-- Bottom Pit Bay Status Widget -->
        <div class="p-4 border-t border-slate-800/80 bg-darkbase-950/40">
            <div class="flex items-center justify-between text-xs mb-1.5">
                <span class="text-slate-400 font-semibold flex items-center gap-1.5">
                    <i class="fa-solid fa-screwdriver-wrench text-garage-500"></i> Kapasitas Bay
                </span>
                <span class="text-white font-bold">{{ $stats['pit_aktif'] }}/{{ $stats['pit_total'] }} ({{ $stats['pit_persen'] }})</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full bg-garage-500 rounded-full transition-all duration-500" style="width: {{ $stats['pit_persen'] }}"></div>
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
    <!-- MAIN CONTENT AREA -->
    <!-- ============================================================== -->
    <div class="flex-1 ml-0 lg:ml-64 flex flex-col min-h-screen min-w-0">
        
        <!-- TOPBAR -->
        <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-20 px-4 sm:px-8 flex items-center justify-between shadow-xs">
            
            <!-- Mobile Hamburger & Title -->
            <div class="flex items-center gap-3 sm:gap-6 flex-1 min-w-0">
                <button type="button" onclick="toggleBengkelSidebar()" class="lg:hidden w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center text-base shrink-0 transition" title="Buka Menu">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                        <span class="hidden sm:inline">L-Garage Workshop</span>
                        <i class="fa-solid fa-chevron-right text-[10px] hidden sm:inline"></i>
                        <span class="text-slate-700 font-bold">Dashboard Operasional</span>
                    </div>
                    <h1 class="text-base sm:text-lg font-heading font-black text-slate-900 mt-0.5 leading-tight truncate">
                        Sistem Manajemen Servis Kendaraan
                    </h1>
                </div>

                <!-- Global Live Search Input -->
                <div class="hidden lg:flex items-center relative w-80 ml-4">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        id="globalSearchInput"
                        oninput="handleGlobalSearch(this.value)"
                        placeholder="Cari plat nomor, nama pelanggan..." 
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                    >
                </div>
            </div>

            <!-- Right Controls: Date, Cek Status & Quick Actions -->
            <div class="flex items-center gap-3 shrink-0">
                <!-- Date Pill -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200/80 text-xs font-semibold text-slate-600">
                    <i class="fa-regular fa-calendar text-garage-500"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Quick Button: Cek Status -->
                <button 
                    type="button" 
                    onclick="openModalCekStatus()" 
                    class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs flex items-center gap-1.5 transition"
                    title="Cek Status Plat Nomor"
                >
                    <i class="fa-solid fa-magnifying-glass text-slate-500"></i>
                    <span class="hidden sm:inline">Cek Status</span>
                </button>

                <!-- Profile Dropdown Plate -->
                <div class="flex items-center gap-2.5 pl-2 sm:pl-3 border-l border-slate-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-500 to-amber-500 text-white font-black font-heading flex items-center justify-center shadow-md shadow-garage-500/20 text-sm">
                        {{ strtoupper(substr($user->name ?? 'L', 0, 1)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <div class="text-xs font-bold text-slate-800 leading-tight">
                            {{ $user->name ?? 'L-Garage Workshop' }}
                        </div>
                        <div class="text-[10px] font-semibold text-garage-600 uppercase">
                            Admin Bengkel
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <!-- FLASH NOTIFICATIONS -->
        @if(session('success'))
            <div class="mx-4 sm:mx-8 mt-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center justify-between shadow-xs animate-in fade-in">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800"><i class="fa-solid fa-times"></i></button>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-4 sm:mx-8 mt-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-center justify-between shadow-xs animate-in fade-in">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-triangle-exclamation text-rose-600 text-sm"></i>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-600 hover:text-rose-800"><i class="fa-solid fa-times"></i></button>
            </div>
        @endif

        @if(session('info'))
            <div class="mx-4 sm:mx-8 mt-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-xs flex items-center justify-between shadow-xs animate-in fade-in">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-info text-blue-600 text-sm"></i>
                    <span class="font-semibold">{{ session('info') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-blue-600 hover:text-blue-800"><i class="fa-solid fa-times"></i></button>
            </div>
        @endif

        {{-- Banner: Kosongkan data demo lama jika sesi masih berisi data sebelumnya --}}
        @if(count($workOrders) > 0 && !session('_bengkel_clean_notified'))
            @php session(['_bengkel_clean_notified' => true]) @endphp
            <div id="bannerDataLama" class="mx-4 sm:mx-8 mt-6 p-4 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 text-xs flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-triangle-exclamation text-amber-500 text-sm"></i>
                    <span class="font-semibold">Terdapat <strong>{{ count($workOrders) }} data</strong> yang tersimpan dari sesi sebelumnya. Klik <strong>"Kosongkan"</strong> jika ingin mulai dari awal dengan data kosong.</span>
                </div>
                <form action="{{ route('bengkel.reset_data') }}" method="POST" class="inline ml-3 shrink-0">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-amber-500 hover:bg-amber-600 text-white font-bold text-[11px] transition whitespace-nowrap">
                        <i class="fa-solid fa-trash-can mr-1"></i> Kosongkan
                    </button>
                </form>
            </div>
        @endif

        <!-- PAGE CONTENT CONTAINER -->
        <main class="flex-1 p-4 sm:p-8 space-y-6 sm:space-y-8 max-w-[1600px] w-full mx-auto">
            
            <!-- 1. GREETING BANNER WITH ACTIONS -->
            <div class="p-6 md:p-8 rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-darkbase-900 border border-slate-800 text-white shadow-lg relative overflow-hidden flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <!-- Background decorative glow -->
                <div class="absolute -right-12 -top-12 w-64 h-64 bg-garage-500/20 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white/90 text-xs font-semibold backdrop-blur-sm mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Sistem Operasional Aktif &bull; Workshop Cabang Cibubur
                    </div>
                    <h2 class="text-2xl md:text-3xl font-heading font-black tracking-tight text-white">
                        Panel Kerja, <span class="text-garage-400">{{ $user->name ?? 'L-Garage Workshop' }}</span> 👋
                    </h2>
                    <p class="text-slate-300 text-xs md:text-sm mt-1 max-w-xl leading-relaxed">
                        Kelola antrean booking, pengerjaan servis mekanik, estimasi biaya, dan pemantauan transaksi bengkel secara realtime di satu dashboard terpadu.
                    </p>
                </div>

                <!-- Quick Action Buttons -->
                <div class="relative z-10 flex flex-wrap items-center gap-2.5">
                    <!-- Tombol Tambah Servis -->
                    <button 
                        type="button" 
                        onclick="openModalTambahServis()"
                        class="px-5 py-3 rounded-xl bg-gradient-to-r from-garage-500 to-garage-600 hover:from-garage-600 hover:to-garage-700 text-white font-bold text-xs md:text-sm shadow-lg shadow-garage-600/30 transition flex items-center gap-2 cursor-pointer active:scale-95"
                    >
                        <i class="fa-solid fa-plus"></i>
                        <span>Booking / Servis Baru</span>
                    </button>

                    <!-- Tombol Cek Status -->
                    <button 
                        type="button" 
                        onclick="openModalCekStatus()" 
                        class="px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs md:text-sm border border-white/20 backdrop-blur-sm transition flex items-center gap-2 cursor-pointer"
                    >
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Cek Plat Nomor</span>
                    </button>

                    <!-- Tombol Form Estimasi Biaya -->
                    <a 
                        href="{{ route('bengkel.booking') }}#estimasi-section" 
                        class="px-4 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs md:text-sm border border-white/20 backdrop-blur-sm transition flex items-center gap-2"
                    >
                        <i class="fa-solid fa-calculator"></i>
                        <span>Kalkulator Biaya</span>
                    </a>

                    <!-- Tombol Demo & Reset Data -->
                    <div class="flex items-center gap-1.5 ml-auto sm:ml-0">
                        <form action="{{ route('bengkel.demo_data') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold border border-slate-700 transition" title="Muat Contoh 4 Kendaraan Aktif">
                                <i class="fa-solid fa-wand-magic-sparkles mr-1 text-amber-400"></i> Muat Demo
                            </button>
                        </form>

                        <form action="{{ route('bengkel.reset_data') }}" method="POST" class="inline" onsubmit="return confirm('Kosongkan seluruh data antrean servis?');">
                            @csrf
                            <button type="submit" class="px-3 py-3 rounded-xl bg-slate-800/80 hover:bg-rose-950 text-slate-400 hover:text-rose-300 text-xs font-semibold border border-slate-700 transition" title="Kosongkan Data Servis">
                                <i class="fa-solid fa-rotate-left"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 2. FOUR STAT CARDS GRID (REALTIME METRICS) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Stat 1: Total Booking / Unit Terdaftar -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-bold">
                            <i class="fa-regular fa-calendar-check"></i>
                        </span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-600">
                            {{ $stats['booking_hari_ini'] }} Terdaftar
                        </span>
                    </div>
                    <div class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $stats['booking_hari_ini'] }}
                    </div>
                    <div class="text-xs font-bold text-slate-700 mt-1">Total Unit Terdaftar</div>
                    <div class="text-[11px] text-slate-400">Booking & servis aktif di bengkel</div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-amber-500 opacity-80 group-hover:h-1.5 transition-all"></div>
                </div>

                <!-- Stat 2: Sedang Diservis (Pemeriksaan / Pengerjaan) -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg font-bold">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $stats['pit_aktif'] }} PIT Terisi
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
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-100">
                            QC Lolos
                        </span>
                    </div>
                    <div class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $stats['siap_ambil'] }}
                    </div>
                    <div class="text-xs font-bold text-slate-700 mt-1">Siap Diambil</div>
                    <div class="text-[11px] text-slate-400">Servis rampung & menunggu serah terima</div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-emerald-500 opacity-80 group-hover:h-1.5 transition-all"></div>
                </div>

                <!-- Stat 4: Servis Selesai & Kasir -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="w-12 h-12 rounded-xl bg-garage-50 text-garage-600 flex items-center justify-center text-lg font-bold">
                            <i class="fa-solid fa-circle-check"></i>
                        </span>
                        <span class="text-[11px] font-bold px-2 py-0.5 rounded-full bg-garage-50 text-garage-700 border border-garage-100">
                            Invoice: {{ $stats['total_invoice'] }}
                        </span>
                    </div>
                    <div class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        {{ $stats['servis_selesai'] }}
                    </div>
                    <div class="text-xs font-bold text-slate-700 mt-1">Servis Selesai</div>
                    <div class="text-[11px] text-slate-400">Unit tuntas & faktur tercatat</div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-garage-600 opacity-80 group-hover:h-1.5 transition-all"></div>
                </div>

            </div>

            <!-- 3. WORK ORDER PIPELINE TABS (FILTER CEPAT) -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-bars-progress text-garage-500"></i>
                            Pipeline Pengerjaan Servis (Klik Tab untuk Filter)
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Pantau dan kelola pergerakan kendaraan berdasarkan tahapan servis.</p>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                        <span class="w-2.5 h-2.5 rounded-full {{ $stats['pit_aktif'] < 4 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                        <span>{{ 4 - $stats['pit_aktif'] }} PIT Bay Siap Pakai</span>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                    <!-- Tab Semua -->
                    <button 
                        type="button" 
                        onclick="filterPipeline('Semua', this)"
                        class="pipeline-tab p-3.5 rounded-xl border border-garage-300 bg-garage-50/70 text-left transition flex items-center justify-between cursor-pointer active-tab"
                    >
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg bg-garage-600 text-white font-bold text-xs flex items-center justify-center">
                                {{ count($workOrders) }}
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900">Semua</div>
                                <div class="text-[10px] text-slate-500">Total Tiket</div>
                            </div>
                        </div>
                    </button>

                    @foreach($pipeline as $pipe)
                    <button 
                        type="button" 
                        onclick="filterPipeline('{{ $pipe['label'] }}', this)"
                        class="pipeline-tab p-3.5 rounded-xl border border-slate-200 bg-slate-50/70 hover:bg-white hover:border-slate-300 text-left transition flex items-center justify-between cursor-pointer"
                    >
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-xs
                                @if($pipe['color'] === 'amber') bg-amber-100 text-amber-800
                                @elseif($pipe['color'] === 'blue') bg-blue-100 text-blue-800
                                @elseif($pipe['color'] === 'orange') bg-orange-100 text-orange-800
                                @else bg-emerald-100 text-emerald-800 @endif
                            ">
                                {{ $pipe['count'] }}
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900">{{ $pipe['label'] }}</div>
                                <div class="text-[10px] text-slate-500">Tahap {{ $loop->iteration }}</div>
                            </div>
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- 4. TWO-COLUMNS DESKTOP LAYOUT -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- LEFT COLUMN: DAFTAR WORK ORDER & KENDARAAN (8 COLUMNS) -->
                <div class="lg:col-span-8 space-y-6">
                    
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        
                        <!-- Table Card Header & Filters -->
                        <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="font-heading font-black text-slate-900 text-base flex items-center gap-2">
                                    <i class="fa-solid fa-clipboard-list text-garage-500"></i>
                                    Daftar Servis & Antrean Kendaraan Aktif
                                </h3>
                                <p class="text-xs text-slate-400 mt-0.5">
                                    Menampilkan <span id="visibleCount" class="font-bold text-slate-700">{{ count($workOrders) }}</span> unit dalam database
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-2">
                                <!-- Filter Status Dropdown -->
                                <select 
                                    id="filterStatusSelect" 
                                    onchange="filterPipeline(this.value)" 
                                    class="px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-50 border border-slate-200 text-slate-700 focus:outline-none focus:border-garage-500"
                                >
                                    <option value="Semua">Semua Status</option>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Pemeriksaan">Pemeriksaan</option>
                                    <option value="Pengerjaan">Pengerjaan</option>
                                    <option value="Siap Diambil">Siap Diambil</option>
                                    <option value="Selesai">Selesai</option>
                                </select>

                                <!-- Tombol Tambah Servis Baru -->
                                <button 
                                    type="button" 
                                    onclick="openModalTambahServis()" 
                                    class="px-3.5 py-1.5 rounded-lg text-xs font-bold bg-garage-500 hover:bg-garage-600 text-white shadow-xs transition flex items-center gap-1.5 cursor-pointer"
                                >
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Tambah Servis</span>
                                </button>
                            </div>
                        </div>

                        <!-- LIVE SEARCH BOX ATAS TABEL -->
                        <div class="px-5 py-3 bg-slate-50 border-b border-slate-200/80 flex items-center gap-3">
                            <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs"></i>
                            <input 
                                type="text" 
                                id="tableSearchInput" 
                                oninput="handleTableSearch(this.value)"
                                placeholder="Ketik plat nomor, nama pelanggan, atau tipe kendaraan..." 
                                class="w-full bg-transparent text-xs text-slate-800 placeholder-slate-400 focus:outline-none"
                            >
                            <button type="button" onclick="document.getElementById('tableSearchInput').value=''; handleTableSearch('');" class="text-slate-400 hover:text-slate-600 text-xs">
                                Reset
                            </button>
                        </div>

                        <!-- LIST / TABEL KENDARAAN AKTIF -->
                        @if(count($workOrders) > 0)
                            <div class="divide-y divide-slate-100" id="workOrdersList">
                                @foreach($workOrders as $wo)
                                <div class="wo-card p-4 sm:p-5 hover:bg-slate-50/80 transition flex flex-col md:flex-row md:items-center justify-between gap-4"
                                     data-status="{{ $wo['status'] ?? 'Menunggu' }}"
                                     data-search="{{ strtolower(($wo['vehicle_plate'] ?? '') . ' ' . ($wo['vehicle_model'] ?? '') . ' ' . ($wo['customer_name'] ?? '') . ' ' . ($wo['service_package'] ?? '')) }}"
                                >
                                    <!-- Left: Vehicle & Customer Info -->
                                    <div class="flex items-start gap-3.5 min-w-0 flex-1">
                                        <div class="w-11 h-11 rounded-xl 
                                            @if(($wo['status'] ?? '') === 'Pengerjaan') bg-orange-100 text-orange-700
                                            @elseif(($wo['status'] ?? '') === 'Pemeriksaan') bg-blue-100 text-blue-700
                                            @elseif(($wo['status'] ?? '') === 'Siap Diambil' || ($wo['status'] ?? '') === 'Selesai') bg-emerald-100 text-emerald-700
                                            @else bg-amber-100 text-amber-700 @endif
                                            flex items-center justify-center shrink-0 font-bold text-base shadow-xs"
                                        >
                                            <i class="fa-solid fa-car-side"></i>
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <span class="font-mono font-bold text-xs sm:text-sm bg-slate-900 text-white px-2.5 py-0.5 rounded-md tracking-wider">
                                                    {{ $wo['vehicle_plate'] }}
                                                </span>
                                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm truncate">
                                                    {{ $wo['vehicle_model'] }}
                                                </h4>
                                                <span class="text-[10px] text-slate-400 font-mono">
                                                    #{{ $wo['id'] }}
                                                </span>
                                            </div>

                                            <p class="text-xs text-slate-600 mt-1 font-medium leading-relaxed">
                                                {{ $wo['service_package'] }}
                                            </p>

                                            <!-- Metadata strip -->
                                            <div class="flex flex-wrap items-center gap-3 text-[11px] text-slate-500 mt-2">
                                                <span class="flex items-center gap-1 font-semibold text-slate-700">
                                                    <i class="fa-solid fa-user text-[10px] text-slate-400"></i>
                                                    {{ $wo['customer_name'] }}
                                                </span>
                                                <a href="https://wa.me/{{ $wo['customer_wa'] ?? '6281234567890' }}?text={{ urlencode('Halo ' . $wo['customer_name'] . ', update servis unit Anda ' . $wo['vehicle_model'] . ' (' . $wo['vehicle_plate'] . ') di L-Garage saat ini berstatus: ' . $wo['status']) }}" 
                                                   target="_blank" 
                                                   class="text-emerald-700 hover:text-emerald-800 font-bold flex items-center gap-1">
                                                    <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                                                    {{ $wo['customer_phone'] ?? '-' }}
                                                </a>
                                                <span class="text-slate-300">&bull;</span>
                                                <span class="text-slate-600 font-medium">
                                                    <i class="fa-solid fa-warehouse text-slate-400 text-[10px]"></i>
                                                    {{ $wo['pit_bay'] ?? 'PIT 1' }}
                                                </span>
                                                <span class="text-slate-300">&bull;</span>
                                                <span class="text-slate-600 font-medium">
                                                    <i class="fa-solid fa-user-gear text-slate-400 text-[10px]"></i>
                                                    {{ $wo['mekanik'] ?? 'Mekanik' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right: Status, Biaya & Quick Actions -->
                                    <div class="flex md:flex-col items-center md:items-end justify-between md:justify-center gap-2 shrink-0 border-t md:border-t-0 pt-3 md:pt-0 border-slate-100">
                                        <!-- Estimasi Biaya -->
                                        <div class="text-right">
                                            <div class="text-xs font-bold text-slate-900 font-heading">
                                                {{ $wo['estimasi_biaya_label'] ?? 'Rp 0' }}
                                            </div>
                                            <div class="text-[10px] text-slate-400">
                                                {{ $wo['created_time'] ?? '' }}
                                            </div>
                                        </div>

                                        <!-- Status Badge & Form Update Cepat -->
                                        <form action="{{ route('bengkel.work_orders.update_status', $wo['id']) }}" method="POST" class="inline-flex items-center gap-1.5">
                                            @csrf
                                            <select 
                                                name="status" 
                                                onchange="this.form.submit()" 
                                                class="text-[11px] font-bold rounded-lg px-2.5 py-1 border focus:outline-none cursor-pointer transition
                                                    @if(($wo['status'] ?? '') === 'Pengerjaan') bg-orange-50 text-orange-700 border-orange-200
                                                    @elseif(($wo['status'] ?? '') === 'Pemeriksaan') bg-blue-50 text-blue-700 border-blue-200
                                                    @elseif(($wo['status'] ?? '') === 'Siap Diambil') bg-purple-50 text-purple-700 border-purple-200
                                                    @elseif(($wo['status'] ?? '') === 'Selesai') bg-emerald-50 text-emerald-800 border-emerald-300
                                                    @else bg-amber-50 text-amber-800 border-amber-200 @endif
                                                "
                                                title="Klik untuk ubah tahapan servis"
                                            >
                                                <option value="Menunggu" {{ ($wo['status'] ?? '') === 'Menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                                <option value="Pemeriksaan" {{ ($wo['status'] ?? '') === 'Pemeriksaan' ? 'selected' : '' }}>🔍 Pemeriksaan</option>
                                                <option value="Pengerjaan" {{ ($wo['status'] ?? '') === 'Pengerjaan' ? 'selected' : '' }}>⚙️ Pengerjaan</option>
                                                <option value="Siap Diambil" {{ ($wo['status'] ?? '') === 'Siap Diambil' ? 'selected' : '' }}>🚗 Siap Diambil</option>
                                                <option value="Selesai" {{ ($wo['status'] ?? '') === 'Selesai' ? 'selected' : '' }}>✅ Selesai & Lunas</option>
                                            </select>
                                        </form>

                                        <!-- Aksi Tombol -->
                                        <div class="flex items-center gap-1.5">
                                            <!-- Lihat Faktur / Invoice -->
                                            <a href="{{ route('bengkel.invoice') }}?wo={{ $wo['id'] }}" class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs transition" title="Lihat Faktur / Cetak">
                                                <i class="fa-solid fa-receipt"></i>
                                            </a>

                                            <!-- Hapus Work Order -->
                                            <form action="{{ route('bengkel.work_orders.destroy', $wo['id']) }}" method="POST" onsubmit="return confirm('Hapus work order {{ $wo['id'] }} ({{ $wo['vehicle_plate'] }})?')" class="inline">
                                                @csrf
                                                <button type="submit" class="p-1.5 rounded-lg bg-slate-100 hover:bg-rose-100 text-slate-400 hover:text-rose-600 text-xs transition" title="Hapus Work Order">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <!-- EMPTY STATE DISPLAY -->
                            <div class="p-12 text-center flex flex-col items-center justify-center" id="emptyStateContainer">
                                
                                <div class="w-20 h-20 rounded-3xl bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-400 mb-4 shadow-inner">
                                    <i class="fa-solid fa-car text-3xl text-slate-300"></i>
                                </div>

                                <h4 class="font-heading font-bold text-slate-800 text-base sm:text-lg">
                                    Belum Ada Kendaraan Dalam Antrean
                                </h4>
                                
                                <p class="text-xs text-slate-500 max-w-md mt-1 leading-relaxed">
                                    Seluruh bay servis saat ini kosong. Anda dapat mendaftarkan booking baru, input servis walk-in langsung, atau memuat contoh data simulasi operasional.
                                </p>

                                <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                                    <button 
                                        type="button"
                                        onclick="openModalTambahServis()" 
                                        class="px-5 py-2.5 rounded-xl bg-garage-500 hover:bg-garage-600 text-white font-bold text-xs shadow-md shadow-garage-500/20 transition flex items-center gap-2 cursor-pointer"
                                    >
                                        <i class="fa-solid fa-plus"></i>
                                        <span>+ Input Servis Walk-in</span>
                                    </button>

                                    <form action="{{ route('bengkel.demo_data') }}" method="POST">
                                        @csrf
                                        <button 
                                            type="submit" 
                                            class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition cursor-pointer flex items-center gap-1.5"
                                        >
                                            <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                                            <span>Muat Data Contoh Bengkel</span>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endif

                    </div>

                </div>

                <!-- RIGHT COLUMN: KASIR, STATUS PIT BAY & TREN (4 COLUMNS) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- 1. PENDAPATAN HARI INI CARD -->
                    <div class="bg-gradient-to-br from-slate-900 to-darkbase-900 rounded-2xl p-6 text-white border border-slate-800 shadow-md relative overflow-hidden">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                Kasir &amp; Pendapatan Hari Ini
                            </span>
                            <span class="px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 text-[10px] font-bold">
                                Realtime Kasir
                            </span>
                        </div>

                        <div class="text-3xl font-heading font-black text-white tracking-tight">
                            {{ $stats['pendapatan_hari'] }}
                        </div>
                        
                        <div class="text-xs text-slate-400 mt-1 flex items-center justify-between">
                            <span>Total Invoice Lunas:</span>
                            <span class="text-white font-bold">{{ $stats['total_invoice'] }} Transaksi</span>
                        </div>

                        <div class="mt-5 pt-4 border-t border-slate-800 flex items-center justify-between text-xs">
                            <a href="{{ route('bengkel.invoice') }}" class="text-garage-400 hover:underline font-bold flex items-center gap-1">
                                <span>Buka Halaman Kasir</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                            <span class="text-slate-400 text-[11px] font-mono">L-Garage POS v2.4</span>
                        </div>
                    </div>

                    <!-- 2. STATUS 4 BAY & PIT SERVIS (LIVE MONITOR) -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm space-y-3">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <h4 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-warehouse text-garage-500"></i>
                                Status Bay Servis (4 Bay)
                            </h4>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $stats['pit_aktif'] > 0 ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700' }}">
                                {{ $stats['pit_aktif'] }}/4 Terisi
                            </span>
                        </div>

                        <div class="space-y-2.5">
                            @foreach($pitBays as $pit)
                            <div class="p-3 rounded-xl border {{ $pit['assigned'] ? 'border-amber-200 bg-amber-50/40' : 'border-slate-100 bg-slate-50' }} flex items-center justify-between">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="w-6 h-6 rounded-lg {{ $pit['assigned'] ? 'bg-amber-500 text-white' : 'bg-slate-200 text-slate-700' }} font-bold text-xs flex items-center justify-center shrink-0">
                                        {{ $pit['no'] }}
                                    </span>
                                    <div class="min-w-0">
                                        <div class="text-xs font-bold text-slate-800 truncate">{{ $pit['name'] }}</div>
                                        @if($pit['assigned'])
                                            <div class="text-[10px] text-amber-700 font-bold truncate">
                                                {{ $pit['assigned']['vehicle_plate'] }} &bull; {{ $pit['assigned']['status'] }}
                                            </div>
                                        @else
                                            <div class="text-[10px] text-slate-400">{{ $pit['desc'] }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($pit['assigned'])
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-800 shrink-0">
                                        {{ $pit['assigned']['status'] }}
                                    </span>
                                @else
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-emerald-100 text-emerald-700 shrink-0">
                                        Tersedia
                                    </span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 3. TREN PENDAPATAN 7 HARI -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-chart-line text-garage-500"></i>
                                Tren Pendapatan 7 Hari
                            </h4>
                            <span class="text-xs font-bold text-garage-600">{{ $weeklyRevenue['total'] }}</span>
                        </div>

                        <div class="h-36 flex items-end justify-between gap-2 pt-4 px-2">
                            @foreach($weeklyRevenue['labels'] as $idx => $day)
                            @php
                                $nominal = $weeklyRevenue['data'][$idx] ?? 0;
                                $height = $nominal > 0 ? min(90, max(15, round(($nominal / 6000000) * 80))) : 8;
                            @endphp
                            <div class="flex-1 flex flex-col items-center gap-1.5" title="{{ $day }}: Rp {{ number_format($nominal, 0, ',', '.') }}">
                                <div class="w-full bg-slate-100 rounded-t-md h-24 flex items-end justify-center relative overflow-hidden group">
                                    <div class="w-full bg-gradient-to-t from-garage-600 to-garage-400 rounded-t-md transition-all duration-500 group-hover:from-garage-700 group-hover:to-garage-500" 
                                         style="height: {{ $height }}%;"></div>
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
                <span>Versi 2.4.0 (Full Functional Desktop)</span>
                <span>&bull;</span>
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Database Connected
                </span>
            </div>
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- MODAL 1: FORM TAMBAH BOOKING / SERVIS BARU -->
    <!-- ============================================================== -->
    <div id="modalTambahServis" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative my-8 animate-in fade-in zoom-in-95 duration-200">
            <!-- Close Button -->
            <button type="button" onclick="closeModalTambahServis()" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-times text-lg"></i>
            </button>

            <!-- Modal Header -->
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-garage-500 text-white flex items-center justify-center shadow-md shadow-garage-500/20">
                    <i class="fa-solid fa-plus text-base"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900">Tambah Booking / Servis Baru</h3>
                    <p class="text-xs text-slate-500">Daftarkan work order servis kendaraan ke dalam antrean bengkel</p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('bengkel.work_orders.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Pemilik / Pelanggan <span class="text-rose-500">*</span></label>
                        <input type="text" name="customer_name" required placeholder="Contoh: Pak Rahmat Hidayat" class="w-full text-xs font-semibold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Aktif</label>
                        <input type="text" name="customer_phone" placeholder="Contoh: 081298432210" class="w-full text-xs font-semibold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Plat Polisi <span class="text-rose-500">*</span></label>
                        <input type="text" name="vehicle_plate" required placeholder="Contoh: B 1982 SYZ" class="w-full text-xs font-mono font-bold uppercase px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Merek &amp; Model Mobil <span class="text-rose-500">*</span></label>
                        <input type="text" name="vehicle_model" required placeholder="Contoh: Innova Zenix / HR-V" class="w-full text-xs font-semibold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Paket Layanan / Servis <span class="text-rose-500">*</span></label>
                        <select name="service_package" required class="w-full text-xs font-semibold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                            <option value="Servis Berkala 40K KM & Ganti Oli">Servis Berkala 40K KM &amp; Ganti Oli</option>
                            <option value="Tune Up Injeksi & Scanner OBD-II">Tune Up Injeksi &amp; Scanner OBD-II</option>
                            <option value="Spooring 3D & Balancing 4 Roda">Spooring 3D &amp; Balancing 4 Roda</option>
                            <option value="Overhaul Rem & Kuras Minyak Rem">Overhaul Rem &amp; Kuras Minyak Rem</option>
                            <option value="Ganti Oli Synthetic 0W-20 & Filter">Ganti Oli Synthetic 0W-20 &amp; Filter</option>
                            <option value="Perbaikan AC & Flushing Freon">Perbaikan AC &amp; Flushing Freon</option>
                            <option value="General Checkup 32 Titik">General Checkup 32 Titik</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Estimasi Biaya Total (Rp)</label>
                        <input type="number" name="estimasi_biaya" value="750000" min="0" step="50000" class="w-full text-xs font-bold px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Alokasi PIT Bay</label>
                        <select name="pit_bay" class="w-full text-xs font-semibold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                            <option value="PIT 1 (Lift Hidrolik)">PIT 1 (Lift Hidrolik)</option>
                            <option value="PIT 2 (Tune Up & Oli)">PIT 2 (Tune Up &amp; Oli)</option>
                            <option value="PIT 3 (Spooring & Balancing)">PIT 3 (Spooring)</option>
                            <option value="PIT 4 (Diagnostik & Kelistrikan)">PIT 4 (Diagnostik)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Teknisi / Mekanik</label>
                        <select name="mekanik" class="w-full text-xs font-semibold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                            <option value="Agus Widodo">Agus Widodo (Senior)</option>
                            <option value="Budi Santoso">Budi Santoso (Senior)</option>
                            <option value="Candra Putra">Candra Putra (Junior)</option>
                            <option value="Deni Firmansyah">Deni Firmansyah (Junior)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tahap Awal</label>
                        <select name="status" class="w-full text-xs font-bold px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none">
                            <option value="Menunggu">⏳ Menunggu</option>
                            <option value="Pemeriksaan">🔍 Pemeriksaan</option>
                            <option value="Pengerjaan" selected>⚙️ Pengerjaan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Keluhan Tambahan / Catatan Khusus</label>
                    <textarea name="keluhan" rows="2" placeholder="Catatan kendala mesin, getar kaki-kaki, atau permintaan cek spare part..." class="w-full text-xs font-medium px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-garage-500 focus:outline-none"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalTambahServis()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-garage-500 hover:bg-garage-600 shadow-md shadow-garage-500/20 transition flex items-center gap-1.5 cursor-pointer">
                        <i class="fa-solid fa-check"></i>
                        <span>Simpan &amp; Masukkan Antrean</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL 2: CEK STATUS KENDARAAN CEPAT -->
    <!-- ============================================================== -->
    <div id="modalCekStatus" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative animate-in fade-in zoom-in-95 duration-200">
            <button type="button" onclick="closeModalCekStatus()" class="absolute right-4 top-4 text-slate-400 hover:text-slate-600 p-2">
                <i class="fa-solid fa-times text-lg"></i>
            </button>

            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-600/20">
                    <i class="fa-solid fa-magnifying-glass text-base"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900">Cek Status Kendaraan Live</h3>
                    <p class="text-xs text-slate-500">Cari informasi progres servis berdasarkan plat nomor polisi</p>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex gap-2">
                    <input 
                        type="text" 
                        id="cekStatusPlateInput" 
                        placeholder="Masukkan Plat Nomor (Contoh: B 1982 SYZ)..." 
                        class="flex-1 text-xs font-mono font-bold uppercase px-3.5 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-600 focus:outline-none"
                        onkeydown="if(event.key === 'Enter') handleCekStatusAjax();"
                    >
                    <button 
                        type="button" 
                        onclick="handleCekStatusAjax()" 
                        class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition cursor-pointer flex items-center gap-1.5 shrink-0"
                    >
                        <i class="fa-solid fa-search"></i>
                        <span>Cari</span>
                    </button>
                </div>

                <!-- Result Container -->
                <div id="cekStatusResult" class="hidden">
                    <!-- Populated by JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT: Interaktivitas Lengkap & Filter Realtime -->
    <script>
        // Toggle Sidebar
        function toggleBengkelSidebar() {
            const sidebar = document.getElementById('bengkelSidebar');
            const overlay = document.getElementById('bengkelSidebarOverlay');
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Modal Tambah Servis
        function openModalTambahServis() {
            const modal = document.getElementById('modalTambahServis');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModalTambahServis() {
            const modal = document.getElementById('modalTambahServis');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Modal Cek Status
        function openModalCekStatus() {
            const modal = document.getElementById('modalCekStatus');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            document.getElementById('cekStatusPlateInput').focus();
        }

        function closeModalCekStatus() {
            const modal = document.getElementById('modalCekStatus');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        // Filter Pipeline Tab & Dropdown
        let currentFilterStatus = 'Semua';
        let currentSearchQuery = '';

        function filterPipeline(status, btnElement = null) {
            currentFilterStatus = status;

            // Update dropdown jika ada
            const select = document.getElementById('filterStatusSelect');
            if (select) select.value = status;

            // Update active styling tab jika diklik
            if (btnElement) {
                document.querySelectorAll('.pipeline-tab').forEach(t => {
                    t.classList.remove('border-garage-300', 'bg-garage-50/70', 'border-amber-300', 'border-blue-300', 'border-orange-300', 'border-emerald-300');
                    t.classList.add('border-slate-200', 'bg-slate-50/70');
                });
                btnElement.classList.remove('border-slate-200', 'bg-slate-50/70');
                btnElement.classList.add('border-garage-300', 'bg-garage-50/70');
            }

            applyFilters();
        }

        // Realtime Table Search
        function handleTableSearch(val) {
            currentSearchQuery = val.toLowerCase().trim();
            applyFilters();
        }

        function handleGlobalSearch(val) {
            currentSearchQuery = val.toLowerCase().trim();
            const tableInput = document.getElementById('tableSearchInput');
            if (tableInput) tableInput.value = val;
            applyFilters();
        }

        function applyFilters() {
            const cards = document.querySelectorAll('.wo-card');
            let visible = 0;

            cards.forEach(card => {
                const status = card.getAttribute('data-status') || '';
                const search = card.getAttribute('data-search') || '';

                const matchesStatus = (currentFilterStatus === 'Semua') || (status === currentFilterStatus);
                const matchesSearch = !currentSearchQuery || search.includes(currentSearchQuery);

                if (matchesStatus && matchesSearch) {
                    card.style.display = '';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            const countEl = document.getElementById('visibleCount');
            if (countEl) countEl.innerText = visible;
        }

        // Ajax Cek Status Kendaraan di Modal
        function handleCekStatusAjax() {
            const input = document.getElementById('cekStatusPlateInput');
            const resultBox = document.getElementById('cekStatusResult');
            const plat = input.value.trim();

            if (!plat) {
                alert('Harap ketik nomor plat kendaraan Anda.');
                return;
            }

            resultBox.classList.remove('hidden');
            resultBox.innerHTML = `
                <div class="p-4 bg-slate-50 rounded-xl text-center text-xs text-slate-500">
                    <i class="fa-solid fa-spinner fa-spin text-base text-blue-600 mb-1"></i>
                    <div>Mencari catatan servis untuk ${plat}...</div>
                </div>
            `;

            fetch('{{ route("bengkel.cek_status_json") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ plat: plat })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.data) {
                    const d = data.data;
                    resultBox.innerHTML = `
                        <div class="p-4 rounded-2xl border border-blue-200 bg-blue-50/70 space-y-3 animate-in fade-in">
                            <div class="flex items-center justify-between pb-2 border-b border-blue-100">
                                <div>
                                    <span class="font-mono font-bold text-sm bg-slate-900 text-white px-2 py-0.5 rounded">${d.vehicle_plate}</span>
                                    <div class="text-xs font-bold text-slate-900 mt-1">${d.vehicle_model}</div>
                                </div>
                                <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-blue-600 text-white">
                                    ${d.status}
                                </span>
                            </div>

                            <div class="space-y-1.5 text-xs text-slate-700">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Pemilik:</span>
                                    <strong>${d.customer_name}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Layanan:</span>
                                    <strong>${d.service_package}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Alokasi PIT:</span>
                                    <strong>${d.pit_bay || 'PIT 1'}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Teknisi:</span>
                                    <strong>${d.mekanik || '-'}</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Estimasi Selesai:</span>
                                    <strong class="text-emerald-700">${d.estimasi_selesai || 'Hari ini'}</strong>
                                </div>
                            </div>

                            <div class="pt-2 border-t border-blue-100 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-900">Total: ${d.estimasi_biaya_label || 'Rp 0'}</span>
                                <a href="https://wa.me/${d.customer_wa || '6281234567890'}?text=${encodeURIComponent('Halo ' + d.customer_name + ', mengenai unit ' + d.vehicle_model + ' (' + d.vehicle_plate + ') status pengerjaan: ' + d.status)}" target="_blank" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-1.5">
                                    <i class="fa-brands fa-whatsapp"></i> Chat WA
                                </a>
                            </div>
                        </div>
                    `;
                } else {
                    resultBox.innerHTML = `
                        <div class="p-4 rounded-xl border border-amber-200 bg-amber-50 text-xs text-amber-800">
                            <div class="font-bold mb-1"><i class="fa-solid fa-circle-exclamation mr-1"></i> Data Tidak Ditemukan</div>
                            <p>${data.message || 'Kendaraan dengan plat tersebut tidak ada dalam antrean aktif.'}</p>
                        </div>
                    `;
                }
            })
            .catch(err => {
                console.error(err);
                resultBox.innerHTML = `
                    <div class="p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs">
                        Gagal memeriksa status. Silakan coba lagi.
                    </div>
                `;
            });
        }

        // Close modal on Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModalTambahServis();
                closeModalCekStatus();
            }
        });
    </script>
</body>
</html>
