<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RestoHub OS — Inventaris Bahan Baku & Recipe Costing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        terracotta: {
                            50: '#fdf6f3',
                            100: '#fbece5',
                            200: '#f6d8cb',
                            500: '#b84221',
                            600: '#a33315',
                            700: '#8c280e',
                            800: '#6f210c',
                            900: '#551a0b',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .pulse-subtle { animation: pulseSubtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulseSubtle { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.75; transform: scale(1.05); } }
        .tab-btn.active { background-color: #ffffff; color: #0f172a; box-shadow: 0 1px 3px rgba(0,0,0,0.08); font-weight: 700; }
        .filter-chip.active { background-color: #0f172a; color: #ffffff; border-color: #0f172a; font-weight: 700; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col selection:bg-orange-500 selection:text-white">

    <!-- Toast Notifications Container -->
    <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-2 pointer-events-none">
        @if(session('success'))
            <div class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-600 text-white shadow-xl text-xs font-semibold animate-bounce">
                <i class="fas fa-check-circle text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('info'))
            <div class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-900 text-white shadow-xl text-xs font-semibold">
                <i class="fas fa-info-circle text-base text-amber-400"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif
    </div>

    <!-- MAIN APP WRAPPER -->
    <div class="flex h-screen overflow-hidden w-full">

        <!-- ============================================================== -->
        <!-- 1. LEFT SIDEBAR                                                -->
        <!-- ============================================================== -->
        <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col shrink-0 select-none z-30">
            
            <!-- Logo Header -->
            <div class="p-5 border-b border-slate-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#a33315] to-[#c2410c] text-white flex items-center justify-center text-lg font-black shadow-md shadow-orange-950/20">
                    <i class="fas fa-utensils"></i>
                </div>
                <div>
                    <div class="font-heading font-black text-xl tracking-tight text-slate-900 leading-none">RestoHub</div>
                    <div class="text-[9px] font-extrabold tracking-widest text-[#a33315] uppercase mt-0.5">CULINARY OPERATIONS</div>
                </div>
            </div>

            <!-- Shift Status Card -->
            <div class="px-4 py-3.5 border-b border-slate-100 bg-slate-50/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 pulse-subtle"></span>
                        <span class="text-xs font-bold text-slate-800">{{ $shiftInfo['shift_name'] }}</span>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">Aktif</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-3 py-3 space-y-1 overflow-y-auto">
                <a href="{{ route('resto.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fas fa-cash-register text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>Kasir &amp; Order Meja</span>
                </a>

                <a href="{{ route('resto.kds') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fas fa-fire-burner text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>Kitchen Display</span>
                </a>

                <a href="{{ route('resto.inventaris') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#8c280e] text-white shadow-sm shadow-orange-900/20 transition-all">
                    <i class="fas fa-boxes-stacked text-sm w-4 text-center"></i>
                    <span>Inventaris &amp; Resep</span>
                </a>

                <a href="{{ route('resto.member') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fas fa-address-book text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>Reservasi &amp; Member</span>
                </a>

                <a href="{{ route('resto.marketing') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fab fa-whatsapp text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>WhatsApp Marketing</span>
                </a>

                <a href="{{ route('resto.laporan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fas fa-chart-pie text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>Laporan &amp; Pengaturan</span>
                </a>
            </nav>

            <!-- Bottom Sync Info -->
            <div class="p-3 border-t border-slate-100 bg-slate-50/70">
                <div class="flex items-center justify-between text-xs font-semibold text-slate-600">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-cloud text-slate-400 text-xs"></i>
                        <span class="text-[11px] font-bold text-slate-700">Live Cloud Sync</span>
                    </div>
                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">100% OK</span>
                </div>
                <div class="text-[10px] text-slate-400 mt-1">Latensi 24ms &bull; Auto Backup</div>
            </div>

            <!-- Profile & Reset Actions -->
            <div class="p-3 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('resto.reset') }}" onclick="return confirm('Kosongkan kembali semua data RestoHub?')" class="text-[11px] font-bold text-slate-500 hover:text-[#8c280e] flex items-center gap-1.5 transition-colors">
                    <i class="fas fa-rotate-left text-xs"></i>
                    <span>Reset Data</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[11px] font-bold text-rose-600 hover:text-rose-700 flex items-center gap-1 transition-colors">
                        <i class="fas fa-arrow-right-from-bracket text-xs"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ============================================================== -->
        <!-- 2. MAIN CONTENT                                                -->
        <!-- ============================================================== -->
        <div class="flex-1 flex flex-col overflow-hidden bg-[#f8fafc]">

            <!-- TOP NAVBAR -->
            <header class="bg-white border-b border-slate-200/80 px-6 py-3 flex items-center justify-between shrink-0 z-20">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-xs">
                        <i class="fas fa-store text-[#a33315] text-xs"></i>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Cabang Aktif</span>
                    </div>
                    <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-xs font-bold text-slate-800">
                        <i class="fas fa-location-dot text-[#a33315] text-xs"></i>
                        <span>{{ $currentBranch }}</span>
                        <i class="fas fa-chevron-down text-slate-400 text-[10px]"></i>
                    </div>
                    <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-[11px] font-bold text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 pulse-subtle"></span>
                        Live Sync Kitchen &amp; POS
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button onclick="showToast('Tidak ada notifikasi sistem baru.', 'info')" class="relative w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:border-[#a33315] hover:text-[#a33315] transition-all">
                        <i class="fas fa-bell text-xs"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-rose-500"></span>
                    </button>
                    <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-[#a33315] to-[#c2410c] text-white flex items-center justify-center text-xs font-black shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name ?? 'B', 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 leading-none">{{ auth()->user()->name ?? 'Budi Pratama' }}</div>
                            <div class="text-[10px] text-slate-400 leading-none mt-0.5">Store Manager</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- SCROLLABLE PAGE BODY -->
            <main class="flex-1 overflow-y-auto px-6 py-5 space-y-5">

                <!-- HEADER TITLE & ACTION BUTTONS -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-extrabold tracking-widest text-[#a33315] uppercase bg-orange-50 border border-orange-200/60 px-2 py-0.5 rounded-md flex items-center gap-1">
                                <i class="fas fa-boxes-stacked text-[9px]"></i> GUDANG &amp; HPP INTELLIGENCE
                            </span>
                            <span class="text-[11px] font-semibold text-slate-400">&bull; Real-Time Kitchen Deduction</span>
                        </div>
                        <h1 class="font-heading font-black text-2xl tracking-tight text-slate-900 leading-tight">
                            Inventaris Bahan Baku &amp; Recipe Costing
                        </h1>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            Pantau perputaran stok aktif, kalkulasi margin laba kotor per porsi, dan otomatisasi reorder bahan dapur.
                        </p>
                    </div>

                    <!-- 4 Action Buttons -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <button onclick="openModal('kalkulatorModal')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                            <i class="fas fa-calculator text-slate-400"></i>
                            <span>Kalkulator HPP</span>
                        </button>
                        <button onclick="openModal('stockOpnameModal')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                            <i class="fas fa-clipboard-check text-slate-400"></i>
                            <span>Stock Opname</span>
                        </button>
                        <button onclick="openModal('poModal')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                            <i class="fas fa-truck-ramp-box text-slate-400"></i>
                            <span>+ Buat PO</span>
                        </button>
                        <button onclick="openModal('tambahBahanModal')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20 transition-all">
                            <i class="fas fa-circle-plus"></i>
                            <span>+ Tambah Bahan Baku</span>
                        </button>
                    </div>
                </div>

                <!-- 4 SUMMARY CARDS (KPIs) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Card 1: Valuasi Stok Aktif -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Valuasi Stok Aktif</div>
                                <div class="font-heading font-black text-2xl text-slate-900 mt-1">
                                    Rp {{ number_format($totalValuasi, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-orange-50 text-[#a33315] flex items-center justify-center text-sm">
                                <i class="fas fa-box-archive"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-3 mt-2 border-t border-slate-100 text-[11px]">
                            <span class="font-bold text-emerald-600 flex items-center gap-1">
                                <i class="fas fa-arrow-trend-up"></i> +0.0% vs minggu lalu
                            </span>
                            <span class="text-slate-400 font-medium">Chiller &amp; Dry Storage</span>
                        </div>
                    </div>

                    <!-- Card 2: Rata-Rata Food Cost (COGS) -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Rata-Rata Food Cost (COGS)</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-heading font-black text-2xl text-slate-900">{{ $cogsPercent }}%</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">SEHAT</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-3 mt-2 border-t border-slate-100 text-[11px]">
                            <span class="text-slate-500 font-medium">Batas Toleransi: &lt; 35%</span>
                            <span class="font-bold text-slate-700">Target 30%</span>
                        </div>
                    </div>

                    <!-- Card 3: Peringatan Reorder -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Peringatan Reorder</div>
                                <div class="flex items-baseline gap-1 mt-1">
                                    <span class="font-heading font-black text-2xl text-rose-600">{{ $reorderCount }}</span>
                                    <span class="text-xs font-bold text-slate-600">Bahan dibawah ambang</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-sm">
                                <i class="fas fa-triangle-exclamation"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-3 mt-2 border-t border-slate-100 text-[11px]">
                            <span class="font-bold {{ $kritisCount > 0 ? 'text-rose-600' : 'text-slate-400' }}">
                                {{ $kritisCount }} Kritis (Out-of-stock risk)
                            </span>
                            <a href="#tableSection" class="text-rose-600 font-extrabold hover:underline flex items-center gap-0.5">
                                Cek Stok <i class="fas fa-arrow-right text-[9px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Card 4: Estimasi Waste Bulan Ini -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm relative overflow-hidden flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Estimasi Waste Bulan Ini</div>
                                <div class="flex items-baseline gap-1 mt-1">
                                    <span class="font-heading font-black text-2xl text-slate-900">0.0%</span>
                                    <span class="text-xs font-semibold text-slate-500">(Rp 0)</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center text-sm">
                                <i class="fas fa-trash-can"></i>
                            </div>
                        </div>
                        <div class="flex items-center justify-between pt-3 mt-2 border-t border-slate-100 text-[11px]">
                            <span class="font-bold text-emerald-600 flex items-center gap-1">
                                <i class="fas fa-circle-check text-[10px]"></i> Di bawah batas aman (2.5%)
                            </span>
                            <span class="text-slate-400 font-medium">0 Log Catatan</span>
                        </div>
                    </div>

                </div>

                <!-- SUB-NAV TABS & REAL-TIME STATUS BADGE -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200/80 pb-2">
                    <div class="flex items-center gap-1 p-1 bg-slate-200/60 rounded-xl max-w-fit">
                        <button class="tab-btn active flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs transition-all">
                            <i class="fas fa-boxes-stacked text-xs"></i>
                            <span>Daftar Stok Bahan Baku</span>
                            <span class="w-4 h-4 rounded-full bg-rose-500 text-white text-[9px] font-black flex items-center justify-center">{{ $totalBahan }}</span>
                        </button>
                        <button onclick="openModal('resepModal')" class="tab-btn text-slate-600 hover:text-slate-900 flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs transition-all font-semibold">
                            <i class="fas fa-receipt text-xs text-slate-400"></i>
                            <span>Resep &amp; HPP Menu</span>
                        </button>
                        <button onclick="openModal('poModal')" class="tab-btn text-slate-600 hover:text-slate-900 flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs transition-all font-semibold">
                            <i class="fas fa-truck text-xs text-slate-400"></i>
                            <span>Purchase Order &amp; Supplier</span>
                        </button>
                        <button onclick="showToast('Modul Pencatatan Waste & Rusak siap digunakan.', 'info')" class="tab-btn text-slate-600 hover:text-slate-900 flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs transition-all font-semibold">
                            <i class="fas fa-trash-can text-xs text-slate-400"></i>
                            <span>Pencatatan Waste &amp; Rusak</span>
                        </button>
                    </div>

                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-600 bg-emerald-50/80 border border-emerald-200 px-3 py-1.5 rounded-xl">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-subtle"></span>
                        <span class="text-slate-700">POS Kitchen Deduction:</span>
                        <span class="font-bold text-emerald-700">Aktif Real-Time</span>
                        <i class="fas fa-circle-info text-slate-400 cursor-pointer" title="Setiap order POS otomatis mengurangi stok bahan baku."></i>
                    </div>
                </div>

                <!-- FILTER ROW: Search & Category Chips -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
                    <div class="flex items-center gap-2 flex-1 flex-wrap">
                        <!-- Search Input -->
                        <div class="relative min-w-[240px]">
                            <i class="fas fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Cari kode, nama bahan..." class="w-full pl-8 pr-3 py-2 bg-white border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-[#a33315] focus:ring-1 focus:ring-[#a33315]">
                        </div>

                        <!-- Category Chips -->
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <button onclick="filterCategory('semua', this)" class="filter-chip active px-3 py-1.5 rounded-lg text-xs border border-slate-200 transition-all">
                                Semua ({{ $totalBahan }})
                            </button>
                            <button onclick="filterCategory('Daging & Unggas', this)" class="filter-chip px-3 py-1.5 rounded-lg text-xs bg-white text-slate-600 border border-slate-200 hover:border-slate-300 transition-all font-medium">
                                🥩 Daging &amp; Unggas
                            </button>
                            <button onclick="filterCategory('Dairy & Keju', this)" class="filter-chip px-3 py-1.5 rounded-lg text-xs bg-white text-slate-600 border border-slate-200 hover:border-slate-300 transition-all font-medium">
                                🧀 Dairy &amp; Keju
                            </button>
                            <button onclick="filterCategory('Kopi & Minuman', this)" class="filter-chip px-3 py-1.5 rounded-lg text-xs bg-white text-slate-600 border border-slate-200 hover:border-slate-300 transition-all font-medium">
                                ☕ Kopi &amp; Minuman
                            </button>
                            <button onclick="filterCategory('Dry Goods & Seasoning', this)" class="filter-chip px-3 py-1.5 rounded-lg text-xs bg-white text-slate-600 border border-slate-200 hover:border-slate-300 transition-all font-medium">
                                🧂 Dry Goods
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 self-end lg:self-auto">
                        <select id="statusFilter" onchange="filterTable()" class="px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-[#a33315]">
                            <option value="semua">Semua Status</option>
                            <option value="KRITIS">Kritis</option>
                            <option value="MENIPIS">Menipis</option>
                            <option value="AMAN">Aman</option>
                        </select>
                        <button onclick="exportCSV()" class="flex items-center gap-1.5 px-3 py-2 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 hover:bg-slate-50 transition-all shadow-sm">
                            <i class="fas fa-file-arrow-down text-slate-400"></i>
                            <span>Export CSV</span>
                        </button>
                    </div>
                </div>

                <!-- TABLE SECTION -->
                <div id="tableSection" class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50/80 border-b border-slate-200 text-[10px] font-extrabold uppercase tracking-wider text-slate-500 select-none">
                                <tr>
                                    <th class="px-5 py-3.5">KODE &amp; NAMA BAHAN</th>
                                    <th class="px-4 py-3.5">KATEGORI</th>
                                    <th class="px-4 py-3.5">STOK SAAT INI</th>
                                    <th class="px-4 py-3.5">MIN. AMBANG</th>
                                    <th class="px-4 py-3.5">HARGA BELI RATA-RATA</th>
                                    <th class="px-4 py-3.5">STATUS STOK</th>
                                    <th class="px-4 py-3.5">SUPPLIER UTAMA</th>
                                    <th class="px-4 py-3.5 text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryTableBody" class="divide-y divide-slate-100">
                                @forelse($bahanList as $b)
                                <tr class="hover:bg-slate-50/60 transition-colors item-row" 
                                    data-category="{{ $b['kategori'] ?? '' }}" 
                                    data-status="{{ $b['status'] ?? '' }}" 
                                    data-search="{{ strtolower(($b['kode'] ?? '') . ' ' . ($b['nama'] ?? '') . ' ' . ($b['supplier'] ?? '')) }}">
                                    
                                    <!-- Kode & Nama Bahan -->
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-start gap-3">
                                            <span class="w-7 h-7 rounded-lg bg-orange-100 text-[#a33315] font-black text-[10px] flex items-center justify-center shrink-0 mt-0.5">
                                                {{ $b['kode'] ?? 'B01' }}
                                            </span>
                                            <div>
                                                <div class="font-bold text-slate-900 text-xs">{{ $b['nama'] ?? 'Bahan' }}</div>
                                                <div class="text-[10px] text-slate-400 mt-0.5">
                                                    Batch: {{ $b['batch'] ?? '-' }} &bull; Kedaluwarsa: {{ $b['kedaluwarsa'] ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Kategori -->
                                    <td class="px-4 py-3.5">
                                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-100 text-slate-600">
                                            {{ $b['kategori'] ?? '-' }}
                                        </span>
                                    </td>

                                    <!-- Stok Saat Ini -->
                                    <td class="px-4 py-3.5">
                                        <div class="font-bold text-slate-900">
                                            {{ $b['stok'] ?? 0 }} {{ $b['satuan'] ?? 'kg' }}
                                        </div>
                                        @if(($b['stok'] ?? 0) <= ($b['min_ambang'] ?? 0))
                                            <div class="text-[10px] font-bold text-rose-600">
                                                Kurang {{ max(0, ($b['min_ambang'] ?? 0) - ($b['stok'] ?? 0)) }} {{ $b['satuan'] ?? 'kg' }}
                                            </div>
                                        @else
                                            <div class="text-[10px] font-medium text-emerald-600">
                                                Tersedia aman
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Min. Ambang -->
                                    <td class="px-4 py-3.5 font-semibold text-slate-700">
                                        {{ $b['min_ambang'] ?? 0 }} {{ $b['satuan'] ?? 'kg' }}
                                    </td>

                                    <!-- Harga Beli Rata-Rata -->
                                    <td class="px-4 py-3.5 font-bold text-slate-900">
                                        Rp {{ number_format($b['harga_beli'] ?? 0, 0, ',', '.') }}
                                        <span class="text-[10px] font-normal text-slate-400">/{{ $b['satuan'] ?? 'kg' }}</span>
                                    </td>

                                    <!-- Status Stok -->
                                    <td class="px-4 py-3.5">
                                        @if(($b['status'] ?? '') === 'KRITIS')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-rose-100 text-rose-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span> KRITIS
                                            </span>
                                        @elseif(($b['status'] ?? '') === 'MENIPIS')
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-100 text-amber-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span> MENIPIS
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span> AMAN
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Supplier Utama -->
                                    <td class="px-4 py-3.5">
                                        <div class="font-bold text-slate-800">{{ $b['supplier'] ?? '-' }}</div>
                                        <div class="text-[10px] text-slate-400">Lead Time: {{ $b['lead_time'] ?? '1 Hari' }}</div>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-4 py-3.5 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="openQuickPo('{{ $b['nama'] ?? '' }}', '{{ $b['supplier'] ?? '' }}')" class="w-7 h-7 rounded-lg text-rose-600 hover:bg-rose-50 flex items-center justify-center transition-all" title="Reorder / Buat PO">
                                                <i class="fas fa-cart-shopping text-xs"></i>
                                            </button>
                                            <form action="{{ route('resto.inventaris.delete', $b['id'] ?? '') }}" method="POST" onsubmit="return confirm('Hapus bahan ini dari inventaris?')" class="inline">
                                                @csrf
                                                <button type="submit" class="w-7 h-7 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-slate-100 flex items-center justify-center transition-all" title="Hapus Bahan">
                                                    <i class="fas fa-trash-can text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <!-- EMPTY STATE (Default) -->
                                <tr>
                                    <td colspan="8" class="py-16 text-center">
                                        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                            <div class="w-20 h-20 rounded-3xl bg-slate-100 border border-slate-200/60 flex items-center justify-center text-3xl text-slate-400 mb-3 shadow-inner">
                                                <i class="fas fa-boxes-stacked"></i>
                                            </div>
                                            <h3 class="font-heading font-black text-lg text-slate-800 mb-1">
                                                Belum Ada Bahan Baku
                                            </h3>
                                            <p class="text-xs text-slate-400 font-medium leading-relaxed mb-4">
                                                Inventaris gudang masih kosong. Klik tombol di bawah untuk mendaftarkan bahan baku pertama Anda dan mulai melacak kalkulasi HPP.
                                            </p>
                                            <button onclick="openModal('tambahBahanModal')" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20 transition-all">
                                                <i class="fas fa-circle-plus"></i>
                                                <span>+ Tambah Bahan Baku Pertama</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination / Footer Info -->
                    <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-2 text-xs text-slate-500">
                        <div>
                            Menampilkan <span class="font-bold text-slate-800">{{ $totalBahan }}</span> total bahan baku &bull; 
                            <span class="text-rose-600 font-bold">{{ $kritisCount }} Kritis</span> &bull; 
                            <span class="text-amber-600 font-bold">{{ $menipisCount }} Menipis</span> &bull; 
                            <span class="text-emerald-600 font-bold">{{ $amanCount }} Aman</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <button class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white text-slate-400 cursor-not-allowed font-medium text-[11px]">Sebelumnya</button>
                            <button class="px-2.5 py-1 rounded-lg bg-[#8c280e] text-white font-bold text-[11px]">1</button>
                            <button class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white text-slate-400 cursor-not-allowed font-medium text-[11px]">Selanjutnya</button>
                        </div>
                    </div>
                </div>

                <!-- BOTTOM 2-COLUMN SECTION -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    
                    <!-- Left: Mekanisme Real-Time Auto-Depletion (2 Cols) -->
                    <div class="lg:col-span-2 bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-base text-[#a33315] font-black">⇄</span>
                                    <h3 class="font-heading font-black text-base text-slate-900">
                                        Mekanisme Real-Time Auto-Depletion
                                    </h3>
                                </div>
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800">
                                    Sub-second Engine
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                                Setiap kasir mengetuk tombol bayar di POS atau pesanan meja ditandai siap di KDS Kitchen, resep yang terikat memecah gramatur bahan dan memotong inventaris gudang secara akurat.
                            </p>

                            <!-- 3 Step Flow -->
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div class="p-3 rounded-xl bg-orange-50/50 border border-orange-100/80">
                                    <div class="flex items-center justify-between text-[10px] font-extrabold text-[#a33315] uppercase mb-1">
                                        <span>LANGKAH 1</span>
                                        <i class="fas fa-cash-register"></i>
                                    </div>
                                    <div class="font-bold text-slate-800 text-xs mb-1">Order POS Terjual</div>
                                    <div class="text-[11px] text-slate-500 leading-tight">
                                        Meja 08 pesan 2x Smoked Truffle Carbonara &amp; 1x Cappuccino.
                                    </div>
                                </div>

                                <div class="p-3 rounded-xl bg-amber-50/50 border border-amber-100/80">
                                    <div class="flex items-center justify-between text-[10px] font-extrabold text-amber-700 uppercase mb-1">
                                        <span>LANGKAH 2</span>
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div class="font-bold text-slate-800 text-xs mb-1">Ekspansi Bill of Material</div>
                                    <div class="text-[11px] text-slate-500 leading-tight">
                                        Sistem mengurai 240g Fettuccine, 160ml Cream, 80g Beef &amp; 30ml Truffle Oil.
                                    </div>
                                </div>

                                <div class="p-3 rounded-xl bg-emerald-50/50 border border-emerald-100/80">
                                    <div class="flex items-center justify-between text-[10px] font-extrabold text-emerald-700 uppercase mb-1">
                                        <span>LANGKAH 3</span>
                                        <i class="fas fa-boxes-packing"></i>
                                    </div>
                                    <div class="font-bold text-slate-800 text-xs mb-1">Stok &amp; COGS Tercatat</div>
                                    <div class="text-[11px] text-slate-500 leading-tight">
                                        Stok riil berkurang otomatis, laporan HPP harian terupdate tanpa input manual.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 mt-4 border-t border-slate-100 text-xs">
                            <span class="font-semibold text-slate-600 flex items-center gap-1.5">
                                <i class="fas fa-circle-check text-emerald-500"></i> Akurasi estimasi stock opname vs aktual: <strong class="text-slate-800">99.4%</strong>
                            </span>
                            <a href="javascript:void(0)" onclick="showToast('Log auto-deduction hari ini sinkron dengan semua pesanan POS.', 'info')" class="text-[#a33315] font-bold hover:underline flex items-center gap-1">
                                Lihat Log Deductions Hari Ini <i class="fas fa-chevron-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Right: TOP MARGIN CONTRIBUTOR (1 Col) -->
                    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">TOP MARGIN CONTRIBUTOR</div>
                            <h3 class="font-heading font-black text-base text-slate-900 mb-3">
                                Smoked Beef Truffle Carbonara
                            </h3>

                            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100 mb-3">
                                <div class="w-12 h-12 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-xl shrink-0">
                                    <i class="fas fa-bowl-food"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] text-slate-400 font-semibold">Laba Bersih per Porsi:</div>
                                    <div class="font-heading font-black text-emerald-600 text-base leading-none mt-0.5">
                                        Rp 58.800
                                    </div>
                                    <div class="text-[10px] font-extrabold text-slate-600 mt-0.5">
                                        Margin Kotor: <span class="text-emerald-600">69.2%</span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-1.5 text-xs text-slate-600">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Harga Menu:</span>
                                    <span class="font-bold text-slate-800">Rp 85.000</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">HPP (Food Cost):</span>
                                    <span class="font-bold text-rose-600">Rp 26.200 (30.8%)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-400">Terjual Bulan Ini:</span>
                                    <span class="font-extrabold text-slate-800">342 Porsi</span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 mt-3 border-t border-slate-100">
                            <button onclick="openModal('resepModal')" class="w-full py-2.5 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold transition-all shadow-md shadow-orange-900/20 flex items-center justify-center gap-2">
                                <i class="fas fa-magnifying-glass"></i>
                                <span>Buka Bedah Resep Lengkap</span>
                            </button>
                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODALS                                                         -->
    <!-- ============================================================== -->

    <!-- 1. Modal Tambah Bahan Baku -->
    <div id="tambahBahanModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#a33315] flex items-center justify-center text-lg font-black">
                        <i class="fas fa-circle-plus"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Tambah Bahan Baku</h3>
                        <p class="text-xs text-slate-400">Daftarkan bahan baku baru ke stok gudang</p>
                    </div>
                </div>
                <button onclick="closeModal('tambahBahanModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('resto.inventaris.create') }}" method="POST" class="space-y-3.5">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Kode Bahan (Opsional)</label>
                        <input type="text" name="kode" placeholder="Misal: D01" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Kategori *</label>
                        <select name="kategori" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="Daging & Unggas">🥩 Daging &amp; Unggas</option>
                            <option value="Dairy & Keju">🧀 Dairy &amp; Keju</option>
                            <option value="Kopi & Minuman">☕ Kopi &amp; Minuman</option>
                            <option value="Sayur & Buah">🥬 Sayur &amp; Buah</option>
                            <option value="Dry Goods & Seasoning">🧂 Dry Goods &amp; Seasoning</option>
                            <option value="Bahan Pelengkap">🥣 Bahan Pelengkap</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Nama Bahan Baku *</label>
                    <input type="text" name="nama" required placeholder="Misal: Daging Wagyu Ribeye Meltique" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Stok Awal *</label>
                        <input type="number" step="0.01" name="stok" required placeholder="10.0" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Satuan *</label>
                        <select name="satuan" required class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="kg">kg</option>
                            <option value="Liter">Liter</option>
                            <option value="Pack">Pack</option>
                            <option value="Botol">Botol</option>
                            <option value="Gram">Gram</option>
                            <option value="Pcs">Pcs</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Min. Ambang *</label>
                        <input type="number" step="0.01" name="min_ambang" required placeholder="5.0" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Harga Beli Rata-Rata (Rp) *</label>
                        <input type="number" name="harga_beli" required placeholder="Misal: 285000" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Supplier Utama</label>
                        <input type="text" name="supplier" placeholder="Misal: PT Sukanda Djaya" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Lead Time</label>
                        <input type="text" name="lead_time" placeholder="1 Hari" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">No. Batch</label>
                        <input type="text" name="batch" placeholder="#WGY-2403" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Kedaluwarsa</label>
                        <input type="text" name="kedaluwarsa" placeholder="14 Hari" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeModal('tambahBahanModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20">
                        Simpan ke Inventaris
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. Modal Kalkulator HPP & Bedah Resep -->
    <div id="kalkulatorModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#a33315] flex items-center justify-center text-lg font-black">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Kalkulator HPP / Recipe Costing</h3>
                        <p class="text-xs text-slate-400">Simulasi biaya porsi, target margin, dan harga jual menu</p>
                    </div>
                </div>
                <button onclick="closeModal('kalkulatorModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-4 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Nama Menu</label>
                    <input type="text" id="calcNamaMenu" value="Smoked Beef Truffle Carbonara" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Total Biaya Bahan (COGS)</label>
                        <input type="number" id="calcCogs" value="26200" oninput="calculateHpp()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Target Food Cost (%)</label>
                        <input type="number" id="calcTargetPct" value="30" oninput="calculateHpp()" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-orange-50/60 border border-orange-200/80 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500 font-semibold">Rekomendasi Harga Jual:</span>
                        <span id="calcHargaJual" class="font-heading font-black text-lg text-[#a33315]">Rp 87.333</span>
                    </div>
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="text-slate-500">Estimasi Margin Kotor:</span>
                        <span id="calcMarginKotor" class="font-bold text-emerald-600">70.0% (Rp 61.133)</span>
                    </div>
                </div>

                <button onclick="closeModal('kalkulatorModal'); showToast('Simulasi HPP berhasil disimpan.', 'success')" class="w-full py-2.5 rounded-xl bg-[#8c280e] text-white font-bold text-xs shadow-md shadow-orange-900/20">
                    Terapkan ke Menu
                </button>
            </div>
        </div>
    </div>

    <!-- 3. Modal Stock Opname -->
    <div id="stockOpnameModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-lg font-black">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Stock Opname Fisik</h3>
                        <p class="text-xs text-slate-400">Sinkronkan stok riil di chiller &amp; rak gudang</p>
                    </div>
                </div>
                <button onclick="closeModal('stockOpnameModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3.5 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Pilih Bahan Baku</label>
                    <select id="opnameBahanSelect" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                        @forelse($bahanList as $b)
                            <option value="{{ $b['id'] }}">{{ $b['kode'] }} - {{ $b['nama'] }} (Stok Sistem: {{ $b['stok'] }} {{ $b['satuan'] }})</option>
                        @empty
                            <option value="">Belum ada bahan baku terdaftar</option>
                        @endforelse
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Stok Fisik Aktual</label>
                    <input type="number" step="0.01" id="opnameAktual" placeholder="Masukkan jumlah fisik di gudang" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Catatan Penyesuaian</label>
                    <textarea rows="2" placeholder="Contoh: Susut defrost, tumpah, atau selisih timbangan" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeModal('stockOpnameModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Batal</button>
                    <button onclick="closeModal('stockOpnameModal'); showToast('✅ Stock Opname berhasil disesuaikan.', 'success')" class="px-5 py-2 rounded-xl bg-slate-900 text-white text-xs font-bold">
                        Simpan Penyesuaian
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Modal Buat Purchase Order (PO) -->
    <div id="poModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg font-black">
                        <i class="fas fa-truck-ramp-box"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Buat Purchase Order (PO)</h3>
                        <p class="text-xs text-slate-400">Order bahan ulang ke supplier resmi</p>
                    </div>
                </div>
                <button onclick="closeModal('poModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3.5 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Bahan yang Dipesan</label>
                    <input type="text" id="poBahanName" placeholder="Nama bahan baku" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Jumlah Order</label>
                        <input type="number" id="poQty" placeholder="10" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Supplier Tujuan</label>
                        <input type="text" id="poSupplierName" placeholder="PT Sukanda Djaya" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Tanggal Pengiriman Diharapkan</label>
                    <input type="date" value="{{ date('Y-m-d') }}" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeModal('poModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Batal</button>
                    <button onclick="closeModal('poModal'); showToast('🚀 Purchase Order (PO) berhasil diterbitkan ke supplier!', 'success')" class="px-5 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold shadow-md shadow-orange-900/20">
                        Kirim PO Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Modal Bedah Resep Lengkap -->
    <div id="resepModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-2xl w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-[#a33315] flex items-center justify-center text-lg font-black">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Bedah Resep: Smoked Beef Truffle Carbonara</h3>
                        <p class="text-xs text-slate-400">Komposisi gramatur bahan baku, COGS porsi, dan rasio margin</p>
                    </div>
                </div>
                <button onclick="closeModal('resepModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-4 text-xs">
                <div class="grid grid-cols-3 gap-3 p-3.5 bg-slate-50 rounded-2xl">
                    <div>
                        <span class="text-slate-400 font-medium">Harga Jual:</span>
                        <div class="font-heading font-black text-base text-slate-900">Rp 85.000</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">Total COGS:</span>
                        <div class="font-heading font-black text-base text-rose-600">Rp 26.200 (30.8%)</div>
                    </div>
                    <div>
                        <span class="text-slate-400 font-medium">Laba Kotor:</span>
                        <div class="font-heading font-black text-base text-emerald-600">Rp 58.800 (69.2%)</div>
                    </div>
                </div>

                <div class="border border-slate-100 rounded-2xl overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-extrabold uppercase text-slate-400">
                            <tr>
                                <th class="px-4 py-2.5">Bahan Baku</th>
                                <th class="px-4 py-2.5">Gramatur / Takaran</th>
                                <th class="px-4 py-2.5">Harga Satuan</th>
                                <th class="px-4 py-2.5 text-right">Biaya per Porsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium">
                            <tr>
                                <td class="px-4 py-2 font-bold text-slate-800">Pasta Fettuccine Import</td>
                                <td class="px-4 py-2">120 gram</td>
                                <td class="px-4 py-2 text-slate-500">Rp 35.000 / kg</td>
                                <td class="px-4 py-2 text-right font-bold text-slate-800">Rp 4.200</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-bold text-slate-800">Cooking Cream Anchor</td>
                                <td class="px-4 py-2">80 ml</td>
                                <td class="px-4 py-2 text-slate-500">Rp 72.500 / Liter</td>
                                <td class="px-4 py-2 text-right font-bold text-slate-800">Rp 5.800</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-bold text-slate-800">Smoked Beef Strips</td>
                                <td class="px-4 py-2">40 gram</td>
                                <td class="px-4 py-2 text-slate-500">Rp 180.000 / kg</td>
                                <td class="px-4 py-2 text-right font-bold text-slate-800">Rp 7.200</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-bold text-slate-800">Truffle Oil White Grade A</td>
                                <td class="px-4 py-2">15 ml</td>
                                <td class="px-4 py-2 text-slate-500">Rp 480.000 / Liter</td>
                                <td class="px-4 py-2 text-right font-bold text-slate-800">Rp 7.200</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 font-bold text-slate-800">Parmesan &amp; Seasoning</td>
                                <td class="px-4 py-2">1 porsi</td>
                                <td class="px-4 py-2 text-slate-500">Standard Pack</td>
                                <td class="px-4 py-2 text-right font-bold text-slate-800">Rp 1.800</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button onclick="closeModal('resepModal')" class="px-5 py-2.5 rounded-xl bg-slate-900 text-white font-bold text-xs">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- JAVASCRIPT                                                     -->
    <!-- ============================================================== -->
    <script>
        // Modal Handlers
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Quick PO Helper
        function openQuickPo(nama, supplier) {
            document.getElementById('poBahanName').value = nama;
            document.getElementById('poSupplierName').value = supplier;
            openModal('poModal');
        }

        // Interactive Table Search & Filter
        let activeCategory = 'semua';

        function filterCategory(cat, btn) {
            activeCategory = cat;
            document.querySelectorAll('.filter-chip').forEach(c => {
                c.classList.remove('active', 'bg-[#0f172a]', 'text-white');
                c.classList.add('bg-white', 'text-slate-600');
            });
            btn.classList.add('active', 'bg-[#0f172a]', 'text-white');
            btn.classList.remove('bg-white', 'text-slate-600');
            filterTable();
        }

        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('.item-row');

            rows.forEach(row => {
                const matchSearch = row.dataset.search.includes(search);
                const matchCategory = (activeCategory === 'semua' || row.dataset.category === activeCategory);
                const matchStatus = (status === 'semua' || row.dataset.status === status);

                if (matchSearch && matchCategory && matchStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Kalkulator HPP
        function calculateHpp() {
            const cogs = parseFloat(document.getElementById('calcCogs').value) || 0;
            const targetPct = parseFloat(document.getElementById('calcTargetPct').value) || 30;
            if (targetPct > 0) {
                const harga = cogs / (targetPct / 100);
                const laba = harga - cogs;
                const margin = (laba / harga) * 100;
                document.getElementById('calcHargaJual').textContent = 'Rp ' + Math.round(harga).toLocaleString('id-ID');
                document.getElementById('calcMarginKotor').textContent = margin.toFixed(1) + '% (Rp ' + Math.round(laba).toLocaleString('id-ID') + ')';
            }
        }

        // Export CSV
        function exportCSV() {
            const rows = document.querySelectorAll('.item-row');
            if (rows.length === 0) {
                showToast('Tidak ada data bahan untuk diekspor ke CSV.', 'info');
                return;
            }
            let csv = "Kode,Nama Bahan,Kategori,Stok,Harga Beli,Status,Supplier\n";
            rows.forEach(r => {
                const text = r.innerText.replace(/\n+/g, ' | ').replace(/,/g, ';');
                csv += text + "\n";
            });
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('href', url);
            a.setAttribute('download', 'inventaris_restohub_' + new Date().toISOString().slice(0,10) + '.csv');
            a.click();
            showToast('✅ Berhasil mengekspor inventaris ke CSV.', 'success');
        }

        // Toast Helper
        function showToast(msg, type = 'info') {
            const c = document.getElementById('toastContainer');
            const colors = { success: 'bg-emerald-600', info: 'bg-slate-900', error: 'bg-rose-600' };
            const icons = { success: 'fa-check-circle', info: 'fa-info-circle', error: 'fa-circle-exclamation' };
            const t = document.createElement('div');
            t.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl ${colors[type]} text-white shadow-xl text-xs font-semibold transition-all`;
            t.innerHTML = `<i class="fas ${icons[type]} text-base ${type === 'info' ? 'text-amber-400' : ''}"></i><span>${msg}</span>`;
            c.appendChild(t);
            setTimeout(() => {
                t.style.opacity = '0';
                t.style.transform = 'translateX(20px)';
                setTimeout(() => t.remove(), 300);
            }, 3500);
        }
    </script>
</body>
</html>