<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Garage — Data Pelanggan & CRM Servis</title>
    <meta name="description" content="Sistem Manajemen Relasi Pelanggan & CRM Bengkel L-Garage.">

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

            <!-- Booking Servis -->
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
                <span>Kalkulator Estimasi</span>
            </a>

            <div class="px-3 pt-5 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Operasional
            </div>

            <!-- Active: Pelanggan & Kendaraan -->
            <a href="{{ route('bengkel.pelanggan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-sm bg-gradient-to-r from-garage-500 to-garage-600 text-white shadow-md shadow-garage-600/20">
                <i class="fa-solid fa-id-card-clip w-5 text-center text-base"></i>
                <span>Pelanggan & Unit</span>
                <span class="ml-auto text-[10px] font-bold px-2 py-0.5 rounded-full bg-white/20 text-white">Aktif</span>
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
                    <i class="fa-solid fa-users text-garage-500"></i> CRM Pelanggan
                </span>
                <span class="text-emerald-400 font-bold">Aktif</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full bg-garage-500 rounded-full" style="width: 100%"></div>
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
                        <span class="text-slate-700 font-bold">Data Pelanggan & CRM</span>
                    </div>
                    <h1 class="text-lg font-heading font-black text-slate-900 mt-0.5 flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-600"></span>
                        Database Pelanggan & Riwayat Servis Unit
                    </h1>
                </div>

                <!-- Global Search Input -->
                <div class="hidden lg:flex items-center relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        id="global-search-input"
                        placeholder="Cari nama, no HP, atau plat nomor..." 
                        oninput="filterCustomers()"
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                    >
                </div>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-blue-50 border border-blue-200 text-xs font-bold text-blue-700">
                    <span class="w-2 h-2 rounded-full bg-blue-600 pulse-live"></span>
                    <span>CRM Gateway Ready</span>
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
            
            <!-- 1. TOP HEADER BANNER & ACTION CONTROLS (MATCHES SCREENSHOT) -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3.5">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-700 text-white flex items-center justify-center text-xl shadow-md shadow-blue-500/20">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <h2 class="text-2xl font-heading font-black text-slate-900 tracking-tight">
                                    Data Pelanggan & CRM
                                </h2>
                                <span id="header-total-badge" class="px-3 py-0.5 rounded-full bg-blue-100 text-blue-800 border border-blue-200 text-xs font-bold flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span>
                                    0 Terdaftar
                                </span>
                            </div>
                            <p class="text-slate-500 text-xs md:text-sm mt-1">
                                Manajemen relasi pelanggan, riwayat servis kendaraan & otomatisasi pengingat servis terpadu.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Primary Action Buttons -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <button 
                        type="button" 
                        onclick="openAddCustomerModal()" 
                        class="px-5 py-3 rounded-xl bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs shadow-md shadow-blue-950/20 transition flex items-center gap-2 active:scale-95"
                    >
                        <i class="fa-solid fa-user-plus"></i>
                        <span>+ Tambah Pelanggan</span>
                    </button>

                    <button 
                        type="button" 
                        onclick="handleBroadcastWA()" 
                        class="px-4 py-3 rounded-xl bg-emerald-100 hover:bg-emerald-200 text-emerald-800 font-bold text-xs border border-emerald-200 transition flex items-center gap-2"
                    >
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span id="broadcast-btn-text">Broadcast (0)</span>
                    </button>

                    <!-- Toggle Demo Data -->
                    <button 
                        type="button" 
                        onclick="loadDemoCustomers()"
                        class="px-3.5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition flex items-center gap-1.5 border border-slate-200"
                        title="Tampilkan contoh data seperti di gambar"
                    >
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                        <span class="hidden sm:inline">Contoh Gambar</span>
                    </button>

                    <button 
                        type="button" 
                        onclick="clearCustomers()"
                        class="px-3.5 py-3 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs transition border border-rose-200"
                        title="Kosongkan semua data"
                    >
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>

            <!-- 2. FOUR WIDE KPI / STAT CARDS GRID (EXACT SCREENSHOT STATS) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Stat 1: Total Pelanggan -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Total Pelanggan</span>
                        <span class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </div>
                    <div id="stat-total" class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        0
                    </div>
                    <div class="text-[11px] font-bold text-emerald-600 mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                        <span id="stat-sub-total">+0 bulan ini</span>
                    </div>
                </div>

                <!-- Stat 2: Pelanggan Aktif -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Pelanggan Aktif</span>
                        <span class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-shield-halved"></i>
                        </span>
                    </div>
                    <div id="stat-aktif" class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        0
                    </div>
                    <div class="text-[11px] text-slate-400 mt-1">
                        Servis &lt; 3 bln terakhir
                    </div>
                </div>

                <!-- Stat 3: Siap Servis / Oli -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Siap Servis / Oli</span>
                        <span class="w-10 h-10 rounded-xl bg-orange-50 text-garage-600 flex items-center justify-center text-sm font-bold">
                            <i class="fa-regular fa-calendar-check"></i>
                        </span>
                    </div>
                    <div id="stat-siap" class="text-3xl font-black font-heading text-garage-600 tracking-tight">
                        0 Unit
                    </div>
                    <div class="text-[11px] font-semibold text-garage-700 mt-1 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-garage-500"></span>
                        Perlu diingatkan
                    </div>
                </div>

                <!-- Stat 4: Tingkat Retensi -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/90 shadow-sm relative overflow-hidden group">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Tingkat Retensi</span>
                        <span class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-bullseye"></i>
                        </span>
                    </div>
                    <div id="stat-retensi" class="text-3xl font-black font-heading text-slate-900 tracking-tight">
                        0%
                    </div>
                    <div class="text-[11px] text-slate-400 mt-1">
                        Tier Member Aktif
                    </div>
                </div>

            </div>

            <!-- 3. REMINDER ALERT BANNER (MATCHES SCREENSHOT) -->
            <div id="reminder-banner-box" class="p-5 md:p-6 rounded-2xl bg-orange-50/80 border border-orange-200 text-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-2xl bg-orange-100 text-garage-600 flex items-center justify-center text-xl shrink-0 mt-0.5">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-heading font-bold text-slate-900 text-sm md:text-base">
                                Jadwal Servis & Ganti Oli Hari Ini
                            </h3>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-orange-200/70 text-garage-800">
                                Prioritas
                            </span>
                        </div>
                        <p id="reminder-desc-text" class="text-xs text-slate-600 mt-1 leading-relaxed">
                            Belum ada jadwal jatuh tempo servis berkala atau ganti oli yang terlewat hari ini.
                        </p>
                    </div>
                </div>

                <button 
                    type="button" 
                    onclick="handleBroadcastWA()" 
                    class="px-5 py-3 rounded-xl bg-garage-600 hover:bg-garage-700 text-white font-bold text-xs shadow-md shadow-garage-600/20 transition flex items-center justify-center gap-2 shrink-0 active:scale-95"
                >
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    <span>Kirim Pengingat Cepat via WA</span>
                </button>
            </div>

            <!-- 4. SEARCH, FILTER TABS, AND CUSTOMER CARDS -->
            <div class="space-y-5">
                
                <!-- Filter & Search Toolbar -->
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    
                    <!-- Search Input -->
                    <div class="relative flex-1 max-w-md">
                        <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3 text-slate-400 text-xs"></i>
                        <input 
                            type="text" 
                            id="customer-search-input" 
                            placeholder="Cari nama, no HP, atau plat nomor..." 
                            oninput="filterCustomers()"
                            class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                        >
                    </div>

                    <!-- Filter Tabs -->
                    <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200/80 self-start sm:self-auto">
                        <button 
                            type="button" 
                            id="tab-filter-all" 
                            onclick="setCustomerFilter('all')" 
                            class="px-4 py-2 rounded-lg text-xs font-bold transition bg-blue-900 text-white shadow-sm"
                        >
                            Semua (<span id="count-all">0</span>)
                        </button>
                        <button 
                            type="button" 
                            id="tab-filter-due" 
                            onclick="setCustomerFilter('due')" 
                            class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-800 transition"
                        >
                            Perlu Servis (<span id="count-due">0</span>)
                        </button>
                        <button 
                            type="button" 
                            id="tab-filter-vip" 
                            onclick="setCustomerFilter('vip')" 
                            class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-800 transition"
                        >
                            Loyal / VIP (<span id="count-vip">0</span>)
                        </button>
                    </div>

                </div>

                <!-- CUSTOMERS LIST CONTAINER (INITIAL EMPTY STATE) -->
                <div id="customers-cards-container" class="space-y-4">
                    
                    <!-- EMPTY STATE INITIAL DISPLAY -->
                    <div id="empty-customers-box" class="bg-white rounded-3xl border border-slate-200 shadow-sm p-12 text-center flex flex-col items-center justify-center">
                        <div class="w-20 h-20 rounded-3xl bg-blue-50 text-blue-600 flex items-center justify-center text-3xl mb-4 border border-blue-100">
                            <i class="fa-solid fa-address-book"></i>
                        </div>
                        <h4 class="font-heading font-black text-slate-900 text-lg">
                            Belum Ada Data Pelanggan Terdaftar
                        </h4>
                        <p class="text-xs text-slate-500 max-w-md mt-1.5 leading-relaxed">
                            Database pelanggan bengkel Anda saat ini masih kosong. Anda dapat menambahkan data pelanggan secara mandiri atau memuat contoh data simulasi seperti pada tampilan sistem.
                        </p>
                        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                            <button 
                                type="button" 
                                onclick="openAddCustomerModal()" 
                                class="px-5 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs shadow-md transition flex items-center gap-2"
                            >
                                <i class="fa-solid fa-user-plus"></i>
                                <span>Tambah Pelanggan Baru</span>
                            </button>

                            <button 
                                type="button" 
                                onclick="loadDemoCustomers()" 
                                class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition border border-slate-200 flex items-center gap-2"
                            >
                                <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                                <span>Muat Contoh Seperti Gambar</span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>

            <!-- 5. PROGRAM RETENSI L-GARAGE CRM BANNER (MATCHES SCREENSHOT) -->
            <div class="p-6 md:p-8 rounded-3xl bg-gradient-to-r from-slate-900 via-darkbase-900 to-slate-800 text-white shadow-xl relative overflow-hidden flex flex-col md:flex-row md:items-center justify-between gap-6 border border-slate-800">
                <div class="space-y-2 max-w-2xl relative z-10">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white text-[11px] font-bold backdrop-blur-sm">
                        <span>PROGRAM RETENSI L-GARAGE</span>
                        <span class="text-amber-400 flex items-center gap-1">
                            <i class="fa-solid fa-lock-open text-[10px]"></i> Auto-Reward
                        </span>
                    </div>
                    <h3 class="text-xl md:text-2xl font-heading font-black tracking-tight text-white">
                        Diskon Jasa 10% di Kunjungan Ke-4
                    </h3>
                    <p class="text-xs md:text-sm text-slate-300 leading-relaxed">
                        Tingkatkan loyalitas bengkel dengan akumulasi poin otomatis di setiap faktur digital. Pelanggan senang, kunjungan berkala meningkat hingga 34%.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <span class="w-7 h-7 rounded-full bg-amber-500 text-slate-950 font-black text-xs flex items-center justify-center">RH</span>
                        <span class="w-7 h-7 rounded-full bg-blue-500 text-white font-black text-xs flex items-center justify-center">HS</span>
                        <span class="w-7 h-7 rounded-full bg-teal-500 text-white font-black text-xs flex items-center justify-center">CP</span>
                        <span class="text-xs text-slate-400 ml-2 font-medium">+ Program loyalty aktif</span>
                    </div>
                </div>

                <div class="relative z-10">
                    <button 
                        type="button" 
                        onclick="alert('Pengaturan Tier & Poin Loyalty siap dikonfigurasi!');" 
                        class="px-5 py-3 rounded-xl bg-white hover:bg-slate-100 text-slate-900 font-bold text-xs md:text-sm shadow-md transition flex items-center gap-2"
                    >
                        <span>Atur Loyalty Tier</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>

        </main>

        <!-- FOOTER -->
        <footer class="mt-auto px-8 py-5 bg-white border-t border-slate-200 text-slate-400 text-xs flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>L-Garage Workshop System</strong> &bull; Modul Data Pelanggan & CRM Terpadu.
            </div>
            <div class="flex items-center gap-4 text-[11px] font-medium">
                <span>Versi 2.4.0 (Desktop Edition)</span>
                <span>&bull;</span>
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> CRM Database Connected
                </span>
            </div>
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- MODAL: TAMBAH PELANGGAN BARU -->
    <!-- ============================================================== -->
    <div id="add-customer-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl space-y-5 animate-fade-in">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-slate-900 text-lg">Tambah Pelanggan Baru</h3>
                        <p class="text-xs text-slate-400">Daftarkan pelanggan dan unit kendaraan ke CRM.</p>
                    </div>
                </div>
                <button type="button" onclick="closeAddCustomerModal()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form onsubmit="handleSaveCustomer(event)" class="space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-1">Nama Lengkap Pelanggan *</label>
                    <input type="text" id="modal-nama" required placeholder="Contoh: Pak Rahmat Hidayat" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Nomor WhatsApp *</label>
                        <input type="text" id="modal-wa" required placeholder="Contoh: 081298432210" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1">Tier / Kategori Member</label>
                        <select id="modal-tier" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white">
                            <option value="Reguler">Member Reguler</option>
                            <option value="Silver Member">Silver Member</option>
                            <option value="Gold Member">Gold Member</option>
                            <option value="Diamond" selected>Diamond Member (VIP)</option>
                        </select>
                    </div>
                </div>

                <div class="pt-2 border-t border-slate-100">
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Unit Kendaraan Utama</div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Merek & Tipe Unit *</label>
                            <input type="text" id="modal-model" required placeholder="Contoh: Toyota Innova Reborn" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Nomor Plat *</label>
                            <input type="text" id="modal-plat" required placeholder="Contoh: B 2314 TZZ" oninput="this.value = this.value.toUpperCase()" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-bold uppercase text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Odometer Terakhir (KM)</label>
                            <input type="text" id="modal-odo" placeholder="Contoh: 58.400 KM" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-slate-700 block mb-1">Status Kendaraan</label>
                            <select id="modal-status" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white">
                                <option value="Sehat" selected>🟢 Sehat / Terawat</option>
                                <option value="Due Service">🟠 Waktunya Servis / Ganti Oli</option>
                                <option value="Sedang Dikerjakan">🔵 Sedang Dikerjakan di Bay</option>
                                <option value="Standby">⚪ Standby</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeAddCustomerModal()" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs shadow-md">
                        Simpan Pelanggan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- INTERACTIVE JAVASCRIPT LOGIC -->
    <!-- ============================================================== -->
    <script>
        let customersData = [];
        let currentFilter = 'all';

        function renderCustomers() {
            const container = document.getElementById('customers-cards-container');
            const totalCountBadge = document.getElementById('header-total-badge');
            const statTotal = document.getElementById('stat-total');
            const statAktif = document.getElementById('stat-aktif');
            const statSiap = document.getElementById('stat-siap');
            const statRetensi = document.getElementById('stat-retensi');
            const countAll = document.getElementById('count-all');
            const countDue = document.getElementById('count-due');
            const countVip = document.getElementById('count-vip');
            const broadcastBtnText = document.getElementById('broadcast-btn-text');
            const reminderText = document.getElementById('reminder-desc-text');

            // Filter logic
            const searchTerm = (document.getElementById('customer-search-input')?.value || document.getElementById('global-search-input')?.value || '').toLowerCase();
            
            let filtered = customersData.filter(c => {
                const matchSearch = c.name.toLowerCase().includes(searchTerm) || 
                                    c.phone.includes(searchTerm) || 
                                    c.vehicles.some(v => v.model.toLowerCase().includes(searchTerm) || v.plate.toLowerCase().includes(searchTerm));
                
                if (!matchSearch) return false;

                if (currentFilter === 'due') {
                    return c.alert !== null || c.vehicles.some(v => v.status.includes('Due') || v.status.includes('Servis'));
                } else if (currentFilter === 'vip') {
                    return c.tier.includes('Diamond') || c.tier.includes('Gold');
                }
                return true;
            });

            // Update stats
            const total = customersData.length;
            const dueCount = customersData.filter(c => c.alert !== null || c.vehicles.some(v => v.status.includes('Due'))).length;
            const vipCount = customersData.filter(c => c.tier.includes('Diamond') || c.tier.includes('Gold')).length;

            statTotal.innerText = total;
            statAktif.innerText = total > 0 ? Math.max(0, total - 1) : 0;
            statSiap.innerText = dueCount + ' Unit';
            statRetensi.innerText = total > 0 ? '88.4%' : '0%';
            totalCountBadge.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> ${total} Terdaftar`;

            countAll.innerText = total;
            countDue.innerText = dueCount;
            countVip.innerText = vipCount;
            broadcastBtnText.innerText = `Broadcast (${dueCount})`;

            if (dueCount > 0) {
                reminderText.innerText = `Ada ${dueCount} pelanggan setia yang jatuh tempo ganti oli pelumas berkala minggu ini.`;
            } else {
                reminderText.innerText = `Belum ada jadwal jatuh tempo servis berkala atau ganti oli yang terlewat hari ini.`;
            }

            // Render container
            if (filtered.length === 0) {
                container.innerHTML = `
                    <div id="empty-customers-box" class="bg-white rounded-3xl border border-slate-200 shadow-sm p-12 text-center flex flex-col items-center justify-center">
                        <div class="w-20 h-20 rounded-3xl bg-blue-50 text-blue-600 flex items-center justify-center text-3xl mb-4 border border-blue-100">
                            <i class="fa-solid fa-address-book"></i>
                        </div>
                        <h4 class="font-heading font-black text-slate-900 text-lg">
                            ${total === 0 ? 'Belum Ada Data Pelanggan Terdaftar' : 'Tidak Ditemukan Pelanggan Sesuai Filter'}
                        </h4>
                        <p class="text-xs text-slate-500 max-w-md mt-1.5 leading-relaxed">
                            ${total === 0 ? 'Database pelanggan bengkel Anda saat ini masih kosong. Silakan tambahkan data pelanggan baru atau muat contoh data simulasi.' : 'Coba gunakan kata kunci pencarian lain atau pilih tab filter "Semua".'}
                        </p>
                        ${total === 0 ? `
                        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                            <button type="button" onclick="openAddCustomerModal()" class="px-5 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                                <i class="fa-solid fa-user-plus"></i>
                                <span>Tambah Pelanggan Baru</span>
                            </button>
                            <button type="button" onclick="loadDemoCustomers()" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition border border-slate-200 flex items-center gap-2">
                                <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                                <span>Muat Contoh Seperti Gambar</span>
                            </button>
                        </div>` : ''}
                    </div>
                `;
                return;
            }

            container.innerHTML = '';
            filtered.forEach(customer => {
                const card = document.createElement('div');
                card.className = 'bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition p-6 space-y-4';

                // Vehicles list HTML
                let vehiclesHtml = '';
                customer.vehicles.forEach(v => {
                    let badgeColor = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                    let dotColor = 'bg-emerald-500';
                    if (v.status.includes('Due')) {
                        badgeColor = 'bg-amber-100 text-amber-800 border-amber-200';
                        dotColor = 'bg-amber-500';
                    } else if (v.status.includes('Estimasi') || v.status.includes('Pit')) {
                        badgeColor = 'bg-blue-100 text-blue-800 border-blue-200';
                        dotColor = 'bg-blue-500';
                    } else if (v.status.includes('Standby')) {
                        badgeColor = 'bg-slate-100 text-slate-600 border-slate-200';
                        dotColor = 'bg-slate-400';
                    }

                    vehiclesHtml += `
                        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-200/70 text-slate-600 flex items-center justify-center text-base">
                                    <i class="fa-solid fa-car"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-xs text-slate-900">${v.model}</div>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="px-2 py-0.2 rounded font-mono text-[10px] font-bold bg-slate-900 text-white">${v.plate}</span>
                                        <span class="text-[11px] text-slate-400">&bull; Odo: ${v.odometer}</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border flex items-center gap-1.5 ${badgeColor}">
                                <span class="w-1.5 h-1.5 rounded-full ${dotColor}"></span>
                                ${v.status}
                            </span>
                        </div>
                    `;
                });

                // Alert notification banner inside customer card if any
                let alertHtml = '';
                if (customer.alert) {
                    if (customer.alert.type === 'warning') {
                        alertHtml = `
                            <div class="p-3.5 rounded-2xl bg-orange-50/90 border border-orange-200 text-orange-950 flex items-start gap-3">
                                <div class="w-7 h-7 rounded-lg bg-orange-200 text-orange-800 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fa-solid fa-triangle-exclamation text-xs"></i>
                                </div>
                                <div class="space-y-0.5 text-xs">
                                    <div class="font-bold text-orange-900">${customer.alert.title}</div>
                                    <div class="text-[11px] text-orange-800 leading-snug">${customer.alert.desc}</div>
                                </div>
                            </div>
                        `;
                    } else if (customer.alert.type === 'progress') {
                        alertHtml = `
                            <div class="p-3.5 rounded-2xl bg-blue-50/90 border border-blue-200 text-blue-950 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <span class="w-2.5 h-2.5 rounded-full bg-blue-600 pulse-live"></span>
                                    <div>
                                        <div class="font-bold text-xs text-blue-900">${customer.alert.title}</div>
                                        <div class="text-[11px] text-blue-700">${customer.alert.desc}</div>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 rounded-lg bg-blue-600 text-white text-[10px] font-bold">
                                    In Progress
                                </span>
                            </div>
                        `;
                    }
                }

                // Tier badge style
                let tierBadge = `<span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">${customer.tier}</span>`;
                if (customer.tier.includes('Diamond')) {
                    tierBadge = `<span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700 border border-blue-200 flex items-center gap-1"><i class="fa-solid fa-star text-amber-500 text-[9px]"></i> Diamond Member</span>`;
                } else if (customer.tier.includes('Gold')) {
                    tierBadge = `<span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200 flex items-center gap-1"><i class="fa-solid fa-crown text-amber-600 text-[9px]"></i> Gold Member</span>`;
                } else if (customer.tier.includes('Silver')) {
                    tierBadge = `<span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">Silver Member</span>`;
                }

                card.innerHTML = `
                    <!-- Top Customer Info -->
                    <div class="flex items-start justify-between gap-4 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3.5">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-2xl bg-blue-900 text-white font-heading font-black text-sm flex items-center justify-center shadow-md">
                                    ${customer.avatar || customer.name.substring(0, 2).toUpperCase()}
                                </div>
                                <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[10px] border-2 border-white">
                                    <i class="fa-brands fa-whatsapp text-[9px]"></i>
                                </span>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-heading font-black text-slate-900 text-base">${customer.name}</h4>
                                    ${tierBadge}
                                </div>
                                <div class="text-xs text-slate-500 font-mono mt-0.5 flex items-center gap-2">
                                    <i class="fa-solid fa-phone text-[10px] text-slate-400"></i>
                                    <span>${customer.phone}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="tel:${customer.phone}" class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition">
                                <i class="fa-solid fa-phone text-xs"></i>
                            </a>
                            <button type="button" onclick="deleteCustomer(${customer.id})" class="w-9 h-9 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 flex items-center justify-center transition" title="Hapus pelanggan">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </div>

                    ${alertHtml}

                    <!-- Garasi Kendaraan -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-xs font-bold text-slate-400 uppercase tracking-wider">
                            <span>Garasi Kendaraan (${customer.vehicles.length} Unit)</span>
                            <span class="text-blue-600 font-bold normal-case text-[11px] cursor-pointer" onclick="alert('Form tambah unit baru ke profil ${customer.name}')">+ Tambah Unit</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5">
                            ${vehiclesHtml}
                        </div>
                    </div>

                    <!-- Servis Terakhir & Jadwal Berikutnya -->
                    <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-100 text-xs flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <div class="text-slate-400 text-[11px] font-semibold">Servis Terakhir:</div>
                            <div class="text-slate-800 font-bold mt-0.5">${customer.last_service || 'Belum ada riwayat'}</div>
                            <div class="text-[11px] text-slate-500">${customer.last_service_detail || '-'}</div>
                        </div>
                        <div class="sm:text-right">
                            <div class="text-slate-400 text-[11px] font-semibold">Jadwal Servis Berikutnya:</div>
                            <div class="text-garage-600 font-bold mt-0.5">${customer.next_service || 'Belum dijadwalkan'}</div>
                        </div>
                    </div>

                    <!-- Actions Bar -->
                    <div class="pt-2 flex flex-wrap items-center gap-2.5">
                        <button type="button" onclick="alert('Membuka riwayat lengkap transaksi dan servis ${customer.name}');" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition flex items-center gap-1.5">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span>Riwayat</span>
                        </button>

                        <button type="button" onclick="sendCustomerWhatsApp('${customer.name}', '${customer.phone}', '${customer.vehicles[0]?.model || 'Kendaraan'}')" class="px-4 py-2.5 rounded-xl bg-emerald-100 hover:bg-emerald-200 text-emerald-800 font-bold text-xs transition flex items-center gap-1.5">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Kirim WA</span>
                        </button>

                        <a href="{{ route('bengkel.booking') }}" class="px-5 py-2.5 rounded-xl bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs shadow-xs transition flex items-center gap-1.5 ml-auto">
                            <i class="fa-regular fa-calendar-plus"></i>
                            <span>Booking Servis</span>
                        </a>
                    </div>
                `;
                container.appendChild(card);
            });
        }

        function setCustomerFilter(filter) {
            currentFilter = filter;
            const tabAll = document.getElementById('tab-filter-all');
            const tabDue = document.getElementById('tab-filter-due');
            const tabVip = document.getElementById('tab-filter-vip');

            tabAll.className = filter === 'all' ? 'px-4 py-2 rounded-lg text-xs font-bold transition bg-blue-900 text-white shadow-sm' : 'px-4 py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-800 transition';
            tabDue.className = filter === 'due' ? 'px-4 py-2 rounded-lg text-xs font-bold transition bg-blue-900 text-white shadow-sm' : 'px-4 py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-800 transition';
            tabVip.className = filter === 'vip' ? 'px-4 py-2 rounded-lg text-xs font-bold transition bg-blue-900 text-white shadow-sm' : 'px-4 py-2 rounded-lg text-xs font-semibold text-slate-500 hover:text-slate-800 transition';

            renderCustomers();
        }

        function filterCustomers() {
            renderCustomers();
        }

        function openAddCustomerModal() {
            document.getElementById('add-customer-modal').classList.remove('hidden');
        }

        function closeAddCustomerModal() {
            document.getElementById('add-customer-modal').classList.add('hidden');
        }

        function handleSaveCustomer(e) {
            e.preventDefault();
            const nama = document.getElementById('modal-nama').value.trim();
            const wa = document.getElementById('modal-wa').value.trim();
            const tier = document.getElementById('modal-tier').value;
            const model = document.getElementById('modal-model').value.trim();
            const plat = document.getElementById('modal-plat').value.trim();
            const odo = document.getElementById('modal-odo').value.trim() || '0 KM';
            const status = document.getElementById('modal-status').value;

            const newCust = {
                id: Date.now(),
                name: nama,
                avatar: nama.substring(0, 2).toUpperCase(),
                phone: wa,
                tier: tier,
                vehicles: [
                    {
                        model: model,
                        plate: plat,
                        odometer: odo,
                        status: status,
                        status_color: status === 'Sehat' ? 'emerald' : (status.includes('Due') ? 'amber' : 'blue')
                    }
                ],
                last_service: 'Baru Terdaftar',
                last_service_detail: 'Belum ada pengerjaan servis sebelumnya',
                next_service: 'Segera Dijadwalkan',
                alert: status.includes('Due') ? {
                    type: 'warning',
                    title: 'Jadwal Servis Berkala & Pengecekan Rutin',
                    desc: 'Kendaraan terdeteksi membutuhkan pengecekan oli & filter.'
                } : null
            };

            customersData.unshift(newCust);
            closeAddCustomerModal();
            renderCustomers();
            alert(`Pelanggan ${nama} (${model} - ${plat}) berhasil didaftarkan ke CRM L-Garage!`);
        }

        function deleteCustomer(id) {
            if (confirm('Yakin ingin menghapus data pelanggan ini?')) {
                customersData = customersData.filter(c => c.id !== id);
                renderCustomers();
            }
        }

        function clearCustomers() {
            if (confirm('Kosongkan semua data pelanggan?')) {
                customersData = [];
                renderCustomers();
            }
        }

        function loadDemoCustomers() {
            customersData = [
                {
                    id: 1,
                    name: 'Pak Rahmat Hidayat',
                    avatar: 'RH',
                    phone: '0812-9843-2210',
                    tier: 'Diamond',
                    vehicles: [
                        {
                            model: 'Toyota Innova Reborn 2.4 Diesel',
                            plate: 'B 2314 TZZ',
                            odometer: '58.400 KM',
                            status: 'Sehat',
                            status_color: 'emerald'
                        },
                        {
                            model: 'Honda HR-V 1.5 SE',
                            plate: 'B 1024 PUZ',
                            odometer: '74.100 KM',
                            status: 'Standby',
                            status_color: 'slate'
                        }
                    ],
                    last_service: '24 Okt 2024 (Kemarin)',
                    last_service_detail: 'Ganti Oli Full Synthetic & Tune Up - Rp 2.000.000 (Lunas)',
                    next_service: '24 Jan 2025 (~65.000 KM)',
                    alert: null
                },
                {
                    id: 2,
                    name: 'Pak Hendra Setiawan',
                    avatar: 'HS',
                    phone: '0811-9234-8819',
                    tier: 'Gold Member',
                    vehicles: [
                        {
                            model: 'Mitsubishi Pajero Sport Dakar 4x2',
                            plate: 'B 8899 DKR',
                            odometer: '41.200 KM',
                            status: 'Due Service',
                            status_color: 'amber'
                        }
                    ],
                    last_service: '12 Mei 2024',
                    last_service_detail: 'Servis Berkala 30.000 KM & Spooring Balancing',
                    next_service: 'Jatuh Tempo Terlewat',
                    alert: {
                        type: 'warning',
                        title: 'Waktunya Ganti Oli & Pengecekan Rem',
                        desc: 'Jatuh tempo terlewat 12 hari atau estimasi +1.200 KM dari jadwal ideal.'
                    }
                },
                {
                    id: 3,
                    name: 'Ibu Cindy Patricia',
                    avatar: 'CP',
                    phone: '0878-5521-4320',
                    tier: 'Silver Member',
                    vehicles: [
                        {
                            model: 'Honda CR-V 1.5L Turbo',
                            plate: 'B 2041 RFS',
                            odometer: '32.150 KM',
                            status: 'Estimasi: 15:30 WIB',
                            status_color: 'blue'
                        }
                    ],
                    last_service: 'Sedang Dikerjakan di Pit 03',
                    last_service_detail: 'Work Order #LG-8942 • Mekanik Agus W.',
                    next_service: 'Dalam Pengerjaan (65%)',
                    alert: {
                        type: 'progress',
                        title: 'Sedang Dikerjakan di Pit 03',
                        desc: 'Work Order #LG-8942 • Mekanik Agus W. (65% Progress)'
                    }
                }
            ];
            renderCustomers();
        }

        function sendCustomerWhatsApp(nama, phone, model) {
            const cleanPhone = phone.replace(/[^0-9]/g, '');
            const target = cleanPhone.startsWith('0') ? '62' + cleanPhone.substring(1) : cleanPhone;
            const msg = `Halo ${nama},%0A%0AKami dari L-Garage Workshop ingin mengingatkan jadwal servis berkala kendaraan Anda (${model}). Apakah ingin kami jadwalkan waktu servis di bengkel minggu ini? Terima kasih!`;
            window.open(`https://wa.me/${target}?text=${msg}`, '_blank');
        }

        function handleBroadcastWA() {
            const dueCount = customersData.filter(c => c.alert !== null || c.vehicles.some(v => v.status.includes('Due'))).length;
            if (dueCount === 0) {
                alert('Tidak ada pelanggan yang jatuh tempo servis saat ini.');
                return;
            }
            alert(`Sistem siap mengirimkan pengingat servis WhatsApp ke ${dueCount} pelanggan yang jatuh tempo!`);
        }

        // Initialize on load with empty data
        document.addEventListener('DOMContentLoaded', () => {
            renderCustomers();
        });
    </script>

</body>
</html>
