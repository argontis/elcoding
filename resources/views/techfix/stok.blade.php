<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Sparepart & Inventaris — TechFix Pro</title>
    <meta name="description" content="Manajemen Stok Sparepart, Gudang & Komponen Reparasi TechFix Pro">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans','sans-serif'],
                        mono: ['JetBrains Mono','monospace'],
                        display: ['Space Grotesk','sans-serif'],
                    },
                    colors: {
                        brand: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a',950:'#0f172a' }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family:'Plus Jakarta Sans',sans-serif; background:#f8fafc; color:#0f172a; }
        ::-webkit-scrollbar { width:6px; height:6px; }
        ::-webkit-scrollbar-track { background:#f1f5f9; }
        ::-webkit-scrollbar-thumb { background:#cbd5e1; border-radius:99px; }
        ::-webkit-scrollbar-thumb:hover { background:#94a3b8; }
        .font-mono-code { font-family:'JetBrains Mono',monospace; }
        @keyframes pulse-ring { 0%{transform:scale(0.95);opacity:.8;}50%{transform:scale(1.2);opacity:.4;}100%{transform:scale(0.95);opacity:.8;} }
        .pulse-beacon { animation:pulse-ring 2s infinite ease-in-out; }
        .nav-item-active { background:linear-gradient(135deg,#1d4ed8 0%,#1e40af 100%); color:#fff; font-weight:600; }
        .part-row { transition:background .15s; }
        .part-row:hover { background:#f8fafc; }
        .badge-kritis { background:#fef2f2; color:#dc2626; border:1px solid #fecaca; }
        .badge-menipis { background:#fffbeb; color:#d97706; border:1px solid #fde68a; }
        .badge-aman { background:#f0fdf4; color:#16a34a; border:1px solid #bbf7d0; }
        .tab-cat { transition:all .15s; cursor:pointer; }
        .tab-cat.active { background:#1d4ed8; color:#fff; }
        .stat-card { transition:box-shadow .2s; }
        .stat-card:hover { box-shadow:0 4px 16px -4px rgba(15,23,42,.10); }
    </style>
</head>
<body class="min-h-screen flex">

<!-- ============================= SIDEBAR ============================= -->
<aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed top-0 left-0 h-full z-40 shadow-sm">
    <div class="h-16 px-4 flex items-center border-b border-slate-200 gap-3">
        <div class="w-9 h-9 rounded-xl bg-brand-700 flex items-center justify-center shadow-sm flex-shrink-0">
            <i class="fa-solid fa-microchip text-white text-sm"></i>
        </div>
        <div>
            <div class="font-display font-bold text-slate-900 text-sm leading-tight">TechFix Pro</div>
            <div class="text-[10px] font-mono-code text-slate-400">Service Center OS v2.4</div>
        </div>
    </div>

    <!-- Sesi Info -->
    <div class="px-4 pt-3 pb-2 border-b border-slate-100">
        <div class="flex items-center justify-between text-[10px] font-mono-code text-slate-500">
            <span class="font-semibold text-slate-600">SESI TEKNISI: <span class="text-emerald-600 font-bold">ACTIVE</span></span>
            <span class="px-1.5 py-0.5 rounded border border-slate-200 text-slate-400 font-bold">v4.2-PROD</span>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto px-3 py-3 space-y-0.5">
        <a href="{{ route('techfix.dashboard') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-ticket-simple text-sm text-slate-400"></i>
                <span>Tiket & Workbench</span>
            </div>
        </a>

        <a href="{{ route('techfix.tracking') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2.5">
                <i class="fa-regular fa-comment-dots text-sm text-slate-400"></i>
                <span>Tracking & Approval WA</span>
            </div>
        </a>

        <a href="{{ route('techfix.kasir') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-cash-register text-sm text-slate-400"></i>
                <span>Kasir POS & Garansi</span>
            </div>
        </a>

        <!-- ACTIVE -->
        <a href="{{ route('techfix.stok') }}" class="nav-item-active flex items-center justify-between px-3 py-2.5 rounded-lg text-xs transition-all shadow-sm">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-boxes-stacked text-sm"></i>
                <span>Stok Sparepart & Inv</span>
            </div>
            @if($statsStok['kritis'] > 0)
            <span class="bg-white/20 text-white px-2 py-0.5 rounded-full text-[10.5px] font-mono-code font-bold">! {{ $statsStok['kritis'] }}</span>
            @endif
        </a>

        <a href="{{ route('techfix.crm') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-user-gear text-sm text-slate-400"></i>
                <span>CRM & Riwayat Unit</span>
            </div>
        </a>

        <a href="{{ route('techfix.laporan') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-chart-line text-sm text-slate-400"></i>
                <span>Laporan & Keuangan</span>
            </div>
        </a>

        <a href="{{ route('techfix.pengaturan') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-gear text-sm text-slate-400"></i>
                <span>Pengaturan Sistem</span>
            </div>
        </a>
    </nav>

    <!-- Sidebar Bottom -->
    <div class="p-3.5 border-t border-slate-200 bg-slate-50/60 font-mono-code">
        <div class="flex items-center justify-between text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">
            <span>HARDWARE DIAGNOSTICS</span>
            <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
        </div>
        <div class="space-y-1.5 text-[11px] text-slate-600">
            <div class="flex justify-between items-center">
                <span class="text-slate-400">LAN Workshop</span>
                <span class="font-bold text-emerald-600">192.168.1.10</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">QR Scanner</span>
                <span class="font-bold text-sky-600">Siap (COM4)</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-slate-400">Thermal Printer</span>
                <span class="font-bold text-slate-700">Ready 80mm</span>
            </div>
        </div>
        <div class="mt-3 pt-2.5 border-t border-slate-200 flex items-center justify-between text-[11px]">
            <div class="flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="font-semibold text-slate-700">{{ $shiftStatus }}</span>
            </div>
            <form action="{{ route('techfix.shift.toggle') }}" method="POST">
                @csrf
                <button type="submit" class="text-sky-600 hover:underline font-semibold text-[11px]">Ganti</button>
            </form>
        </div>
    </div>
</aside>

<!-- ============================= MAIN ============================= -->
<div class="pl-64 flex-1 flex flex-col min-w-0">

    <!-- TOP NAVBAR -->
    <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
        <div class="flex items-center gap-4">
            <!-- Branch -->
            <div class="flex items-center gap-2.5 cursor-pointer group" onclick="document.getElementById('branchSwitchForm').submit();">
                <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 group-hover:bg-sky-100 transition-colors">
                    <i class="fa-solid fa-store text-xs"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5 text-xs font-bold text-slate-800 leading-tight">
                        <span>{{ $currentBranch }}</span>
                        <i class="fa-solid fa-chevron-down text-[9px] text-slate-400 group-hover:text-slate-600"></i>
                    </div>
                    <div class="text-[10px] font-mono-code text-slate-400 flex items-center gap-1 mt-0.5">
                        <span class="text-emerald-500 font-bold">● Live</span>
                        <span>|</span>
                        <span>Hardware Sync 18ms</span>
                    </div>
                </div>
            </div>
            <form id="branchSwitchForm" action="{{ route('techfix.branch.switch') }}" method="POST" class="hidden">@csrf</form>

            <!-- Breadcrumb hint -->
            <div class="hidden md:flex items-center gap-1.5 text-[11px] text-slate-400">
                <i class="fa-solid fa-chevron-right text-[9px]"></i>
                <span class="font-medium text-slate-600">Sparepart Komputer & Komponen</span>
                <span class="font-mono-code text-slate-300">WH-M2-04</span>
            </div>
        </div>

        <div class="flex items-center gap-2.5">
            <!-- WA Gateway -->
            <div class="hidden lg:flex items-center gap-1.5 px-2.5 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-[11px] font-mono-code text-emerald-700">
                <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                <span>WA Gateway: <strong>Terhubung</strong></span>
            </div>
            <!-- Teknisi -->
            <div class="hidden xl:flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-mono-code text-slate-600">
                <i class="fa-solid fa-user-astronaut text-slate-400 text-xs"></i>
                <span>Teknisi: <strong>6/8 Standby</strong></span>
            </div>
            <!-- Add Part Button -->
            <button onclick="openAddPartModal()" class="flex items-center gap-2 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all hover:shadow active:scale-[0.98]">
                <i class="fa-solid fa-plus text-[11px]"></i>
                <span>+ Tambah Sparepart Baru</span>
            </button>
            <!-- Notif -->
            <div class="relative">
                <button onclick="toastMsg('Notifikasi: Stok kritis perlu segera diproses PO!')" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                    <i class="fa-regular fa-bell text-xs"></i>
                </button>
                @if($statsStok['kritis'] > 0)
                <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white rounded-full text-[9px] font-mono-code font-bold flex items-center justify-center">{{ $statsStok['kritis'] }}</span>
                @endif
            </div>
            <!-- User -->
            <div class="flex items-center gap-2.5 pl-2 border-l border-slate-200">
                <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="hidden sm:block text-left">
                    <div class="text-xs font-bold text-slate-800 leading-tight">{{ $user->name ?? 'Admin Gudang' }}</div>
                    <div class="text-[10px] font-medium text-slate-400">Chief Tech & Admin</div>
                </div>
                <div class="relative group">
                    <button class="p-1 text-slate-400 hover:text-slate-600"><i class="fa-solid fa-ellipsis-vertical text-xs"></i></button>
                    <div class="absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 hidden group-hover:block z-50 text-xs">
                        <a href="{{ route('techfix.stok.reset') }}" class="flex items-center gap-2 px-3 py-1.5 text-slate-700 hover:bg-slate-50">
                            <i class="fa-solid fa-eraser text-slate-400"></i> Kosongkan Data Stok
                        </a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <form action="{{ url('/logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-3 py-1.5 text-rose-600 hover:bg-rose-50 text-left">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar (Logout)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 space-y-5 overflow-y-auto">

        @if(session('success'))
        <div id="flashAlert" class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-xl text-xs flex items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="document.getElementById('flashAlert').remove()" class="text-emerald-500 hover:text-emerald-700"><i class="fa-solid fa-xmark"></i></button>
        </div>
        @endif

        <!-- PAGE TITLE -->
        <div class="flex items-start justify-between">
            <div>
                <h1 class="text-2xl font-display font-bold text-slate-900">Stok Sparepart, Gudang & Komponen Reparasi</h1>
                <p class="text-xs text-slate-400 mt-1">Sistem manajemen pergudangan presisi untuk kebutuhan kanibal, part baru OEM/original, buffer stok minimum & integrasi PO distributor.</p>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="toastMsg('Export Excel / CSV sedang diproses...')" class="flex items-center gap-1.5 px-3 py-1.5 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-file-csv text-emerald-600 text-sm"></i> Export Excel / CSV
                </button>
                <button onclick="toastMsg('Memulai Stock Opname Fisik...')" class="flex items-center gap-1.5 px-3 py-1.5 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-clipboard-check text-sky-600 text-sm"></i> Stock Opname Fisik
                </button>
                <button onclick="toastMsg('Fitur Purchase Order (PO) aktif!')" class="flex items-center gap-1.5 px-3 py-1.5 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-truck text-violet-600 text-sm"></i> Purchase Order (PO)
                </button>
                <button onclick="openAddPartModal()" class="flex items-center gap-1.5 px-3.5 py-1.5 bg-brand-700 text-white rounded-lg text-xs font-semibold hover:bg-brand-800 transition-colors shadow-sm">
                    <i class="fa-solid fa-plus text-[11px]"></i> + Tambah Sparepart Baru
                </button>
            </div>
        </div>

        <!-- ========================= STAT CARDS ========================= -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Total Valuasi Stok -->
            <div class="stat-card bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
                <div class="flex items-start justify-between mb-2">
                    <div class="text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-widest">TOTAL VALUASI STOK</div>
                    <div class="w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-warehouse text-brand-600 text-xs"></i>
                    </div>
                </div>
                <div class="text-2xl font-display font-bold text-slate-900 leading-tight">
                    {{ $statsStok['valuasi'] > 0 ? 'Rp '.number_format($statsStok['valuasi'],0,',','.') : 'Rp 0' }}
                </div>
                <div class="flex items-center gap-3 mt-2.5 pt-2.5 border-t border-slate-100 text-[10px] font-mono-code text-slate-500">
                    <span><strong class="text-slate-700">{{ $statsStok['total_sku'] }}</strong> SKU Aktif</span>
                    <span><strong class="text-slate-700">{{ $statsStok['display_unit'] }}</strong> Unit Hak Display</span>
                </div>
            </div>

            <!-- Stok Kritis/Habis -->
            <div class="stat-card bg-white rounded-xl border {{ $statsStok['kritis'] > 0 ? 'border-rose-200' : 'border-slate-200' }} p-4 shadow-xs relative overflow-hidden">
                @if($statsStok['kritis'] > 0)
                <div class="absolute top-0 right-0 w-16 h-16 bg-rose-50 rounded-bl-full opacity-60"></div>
                @endif
                <div class="flex items-start justify-between mb-2">
                    <div class="text-[10px] font-mono-code font-bold {{ $statsStok['kritis'] > 0 ? 'text-rose-500' : 'text-slate-500' }} uppercase tracking-widest">STOK KRITIS / HABIS</div>
                    <div class="w-8 h-8 rounded-lg {{ $statsStok['kritis'] > 0 ? 'bg-rose-50' : 'bg-slate-50' }} flex items-center justify-center flex-shrink-0 relative z-10">
                        <i class="fa-solid fa-triangle-exclamation {{ $statsStok['kritis'] > 0 ? 'text-rose-500' : 'text-slate-400' }} text-xs"></i>
                    </div>
                </div>
                <div class="text-2xl font-display font-bold {{ $statsStok['kritis'] > 0 ? 'text-rose-600' : 'text-slate-900' }} leading-tight relative z-10">
                    {{ $statsStok['kritis'] }} Part
                    @if($statsStok['kritis'] > 0)<span class="text-sm font-semibold text-rose-400 ml-1">Kritis</span>@endif
                </div>
                @if($statsStok['kritis'] > 0)
                <div class="flex items-center gap-2 mt-2.5 pt-2.5 border-t border-rose-100 text-[10px] font-mono-code text-rose-500 relative z-10">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 pulse-beacon"></span>
                    <span>Perlu Restock ● Tiket Servis Segera Pending</span>
                </div>
                @else
                <div class="mt-2.5 pt-2.5 border-t border-slate-100 text-[10px] font-mono-code text-slate-400">
                    Semua stok dalam kondisi aman
                </div>
                @endif
            </div>

            <!-- Komponen Terpasang -->
            <div class="stat-card bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
                <div class="flex items-start justify-between mb-2">
                    <div class="text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-widest">KOMPONEN TERPASANG (BULAN INI)</div>
                    <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-screwdriver-wrench text-sky-600 text-xs"></i>
                    </div>
                </div>
                <div class="text-2xl font-display font-bold text-slate-900 leading-tight">
                    {{ $statsStok['terpasang'] }} Unit Part
                </div>
                <div class="flex items-center gap-2 mt-2.5 pt-2.5 border-t border-slate-100 text-[10px] font-mono-code text-slate-500">
                    <span>Margin Rata-Rata: <strong class="text-slate-700">{{ $statsStok['margin'] }}</strong></span>
                    <span class="{{ $statsStok['margin_trend'] >= 0 ? 'text-emerald-600' : 'text-rose-500' }} font-bold">
                        {{ $statsStok['margin_trend'] >= 0 ? '+' : '' }}{{ $statsStok['margin_trend'] }}% vs Bulan Lalu
                    </span>
                </div>
            </div>

            <!-- PO Menunggu -->
            <div class="stat-card bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
                <div class="flex items-start justify-between mb-2">
                    <div class="text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-widest">PO MENUNGGU PENGIRIMAN</div>
                    <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-truck-clock text-violet-600 text-xs"></i>
                    </div>
                </div>
                <div class="text-2xl font-display font-bold text-slate-900 leading-tight">
                    {{ $statsStok['po_pending'] }} Faktur PO
                </div>
                @if($statsStok['po_pending'] > 0)
                <div class="flex items-center gap-2 mt-2.5 pt-2.5 border-t border-slate-100 text-[10px] font-mono-code text-slate-500">
                    <span>Dari <strong class="text-slate-700">{{ $statsStok['po_supplier'] }}</strong> Distributor</span>
                    <span class="px-1.5 py-0.5 bg-sky-100 text-sky-700 rounded font-bold">Tiba Hari Ini</span>
                </div>
                @else
                <div class="mt-2.5 pt-2.5 border-t border-slate-100 text-[10px] font-mono-code text-slate-400">
                    Tidak ada PO pending saat ini
                </div>
                @endif
            </div>
        </div>

        <!-- ========================= SEARCH & FILTER ========================= -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-xs">
            <div class="px-5 py-3 border-b border-slate-100 flex flex-wrap items-center gap-3">
                <!-- Search -->
                <div class="relative flex-1 min-w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="searchPart" placeholder="Cari Nama Part, Part Number (PN), Kompatibil"
                        class="w-full pl-8 pr-20 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder:text-slate-400"
                        oninput="filterTable()">
                    <span class="absolute right-2 top-1/2 -translate-y-1/2 text-[10px] font-mono-code bg-white px-1.5 py-0.5 border border-slate-200 rounded text-slate-400">F3 Scan</span>
                </div>

                <!-- Status Filter Tabs -->
                <div class="flex items-center bg-slate-100 rounded-lg p-0.5 text-[11px] font-semibold gap-0.5">
                    <button id="tabSemua" onclick="filterStatus('semua')" class="tab-cat active px-3 py-1 rounded-md">Semua Status</button>
                    <button id="tabKritis" onclick="filterStatus('kritis')" class="tab-cat px-3 py-1 rounded-md text-slate-500 hover:text-slate-800 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Stok Kritis
                    </button>
                    <button id="tabAman" onclick="filterStatus('aman')" class="tab-cat px-3 py-1 rounded-md text-slate-500 hover:text-slate-800">Stok Aman</button>
                    <button id="tabPo" onclick="filterStatus('po')" class="tab-cat px-3 py-1 rounded-md text-slate-500 hover:text-slate-800">Ready Order Supplier</button>
                </div>
            </div>

            <!-- Category Tabs -->
            <div class="px-5 py-2 border-b border-slate-100 flex items-center gap-2 overflow-x-auto">
                <span class="text-[10px] font-mono-code text-slate-400 flex-shrink-0"><i class="fa-solid fa-filter mr-1"></i>KATEGORI:</span>
                <div class="flex items-center gap-1.5 flex-nowrap">
                    @foreach($kategoris as $idx => $kat)
                    <button onclick="filterKategori('{{ $kat['slug'] }}')"
                        class="cat-tab flex-shrink-0 px-2.5 py-1 rounded-full text-[11px] font-semibold transition-all
                        {{ $idx === 0 ? 'bg-brand-700 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                        data-slug="{{ $kat['slug'] }}">
                        {{ $kat['label'] }}
                        @if(isset($kat['count']))<span class="ml-1 opacity-70">({{ $kat['count'] }})</span>@endif
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- TABLE HEADER -->
            <div class="px-5 py-2.5 bg-slate-50 border-b border-slate-100 grid grid-cols-12 text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-wider">
                <div class="col-span-4">PART NUMBER & NAMA KOMPONEN</div>
                <div class="col-span-2">KATEGORI</div>
                <div class="col-span-3">KOMPATIBILITAS</div>
                <div class="col-span-2">STOK (TOTAL GUDANG)</div>
                <div class="col-span-1">AKSI</div>
            </div>

            <!-- PART LIST -->
            <div id="partList" class="divide-y divide-slate-50">
                @forelse($partList as $part)
                <div class="px-5 py-3.5 grid grid-cols-12 items-start part-row part-data"
                    data-status="{{ $part['status_stok'] ?? 'aman' }}"
                    data-kategori="{{ $part['kategori_slug'] ?? 'semua' }}"
                    data-search="{{ strtolower(($part['nama'] ?? '') . ' ' . ($part['part_number'] ?? '') . ' ' . ($part['kompatibel'] ?? '')) }}">

                    <!-- Part Number & Nama -->
                    <div class="col-span-4 flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5
                            {{ ($part['status_stok'] ?? '') === 'kritis' ? 'bg-rose-50' : (($part['status_stok'] ?? '') === 'menipis' ? 'bg-amber-50' : 'bg-slate-100') }}">
                            <i class="{{ $part['icon'] ?? 'fa-solid fa-microchip' }} text-xs
                                {{ ($part['status_stok'] ?? '') === 'kritis' ? 'text-rose-500' : (($part['status_stok'] ?? '') === 'menipis' ? 'text-amber-500' : 'text-slate-400') }}"></i>
                        </div>
                        <div>
                            <div class="text-[10px] font-mono-code font-bold text-slate-400 uppercase">{{ $part['part_number'] ?? '-' }}</div>
                            <div class="text-xs font-semibold text-slate-800 mt-0.5">{{ $part['nama'] ?? '-' }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">{{ $part['deskripsi'] ?? '' }}</div>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="col-span-2">
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600">{{ $part['kategori'] ?? '-' }}</span>
                    </div>

                    <!-- Kompatibilitas -->
                    <div class="col-span-3 text-[11px] text-slate-500">{{ $part['kompatibel'] ?? '-' }}</div>

                    <!-- Stok -->
                    <div class="col-span-2">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-display font-bold {{ ($part['status_stok'] ?? '') === 'kritis' ? 'text-rose-600' : (($part['status_stok'] ?? '') === 'menipis' ? 'text-amber-600' : 'text-slate-800') }}">
                                {{ $part['stok_gudang'] ?? 0 }} Pc
                            </span>
                            <span class="px-1.5 py-0.5 rounded text-[9.5px] font-bold
                                {{ ($part['status_stok'] ?? '') === 'kritis' ? 'badge-kritis' : (($part['status_stok'] ?? '') === 'menipis' ? 'badge-menipis' : 'badge-aman') }}">
                                {{ ($part['status_stok'] ?? '') === 'kritis' ? 'Kritis' : (($part['status_stok'] ?? '') === 'menipis' ? 'Menipis' : 'Aman') }}
                            </span>
                        </div>
                        <div class="text-[10px] font-mono-code text-slate-400 mt-0.5">Toko: {{ $part['stok_toko'] ?? 0 }}</div>
                    </div>

                    <!-- Aksi -->
                    <div class="col-span-1 flex items-center gap-1">
                        <button onclick="toastMsg('Edit part: {{ $part['part_number'] ?? '' }}')" class="w-6 h-6 rounded flex items-center justify-center text-slate-400 hover:text-brand-600 hover:bg-brand-50 transition-colors">
                            <i class="fa-solid fa-pen text-[10px]"></i>
                        </button>
                        <button onclick="toastMsg('PO part: {{ $part['part_number'] ?? '' }}')" class="w-6 h-6 rounded flex items-center justify-center text-slate-400 hover:text-violet-600 hover:bg-violet-50 transition-colors">
                            <i class="fa-solid fa-cart-plus text-[10px]"></i>
                        </button>
                    </div>
                </div>
                @empty
                <div class="py-16 text-center" id="emptyPart">
                    <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-boxes-stacked text-slate-300 text-3xl"></i>
                    </div>
                    <div class="text-base font-semibold text-slate-400">Belum ada data stok sparepart</div>
                    <div class="text-xs text-slate-300 mt-1">Klik <strong>"+ Tambah Sparepart Baru"</strong> untuk menambah part pertama Anda</div>
                    <button onclick="openAddPartModal()" class="mt-4 px-5 py-2 bg-brand-700 text-white rounded-lg text-xs font-semibold hover:bg-brand-800 transition-colors shadow-sm">
                        <i class="fa-solid fa-plus mr-1.5"></i> Tambah Sparepart Pertama
                    </button>
                </div>
                @endforelse
            </div>

            <!-- Pagination Footer -->
            <div class="px-5 py-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                <span>Menampilkan <strong class="text-slate-600">{{ count($partList) }}</strong> dari <strong class="text-slate-600">{{ count($partList) }}</strong> baris · Baris per halaman: <strong class="text-slate-600">10</strong></span>
                <div class="flex items-center gap-1">
                    <button class="px-2 py-0.5 rounded bg-brand-700 text-white font-bold text-[10px]">1</button>
                </div>
            </div>
        </div>

        <!-- ========================= BOTTOM PANELS ========================= -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

            <!-- LEFT: Data Supplier -->
            <div class="xl:col-span-2 bg-white rounded-xl border border-slate-200 shadow-xs">
                <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-2 text-sm font-bold text-slate-800">
                            <i class="fa-solid fa-star text-sky-500 text-xs"></i>
                            Data Supplier Terhubung & Lead Time Pemenuhan
                        </div>
                        <div class="text-[10px] font-mono-code text-slate-400">Pemasok terpilih dengan integrasi katalog instan untuk menghindari bottleneck waktu tunggu pengerjaan unit servis pelanggan.</div>
                    </div>
                    <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-[11px] font-mono-code text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 pulse-beacon"></span>
                        <span>Sync API Aktif</span>
                    </div>
                </div>

                <div class="p-5">
                    @forelse($supplierList as $sup)
                    <div class="flex items-start gap-4 p-3.5 rounded-xl bg-slate-50 border border-slate-100 mb-3">
                        <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center flex-shrink-0 shadow-xs">
                            <i class="fa-solid fa-building text-slate-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <div class="text-xs font-bold text-slate-800">{{ $sup['nama'] }}</div>
                                <div class="flex items-center gap-1.5 px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-bold">
                                    SLA <span>{{ $sup['sla'] }}%</span>
                                </div>
                            </div>
                            <div class="text-[11px] text-slate-500 mt-0.5">{{ $sup['deskripsi'] }}</div>
                            <div class="flex items-center gap-3 mt-1.5 text-[10px] font-mono-code text-slate-500">
                                <span>Lead Time: <strong class="text-slate-700">{{ $sup['lead_time'] }}</strong></span>
                                <span>·</span>
                                <span>{{ $sup['total_sku'] }} SKU</span>
                                @if(!empty($sup['garansi']))<span>· <strong class="text-slate-700">{{ $sup['garansi'] }}</strong></span>@endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-8 text-center">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-building text-slate-300 text-xl"></i>
                        </div>
                        <div class="text-xs font-semibold text-slate-400">Belum ada supplier terdaftar</div>
                        <div class="text-[11px] text-slate-300 mt-0.5">Tambah supplier untuk integrasi PO otomatis</div>
                        <button onclick="toastMsg('Fitur tambah supplier segera hadir!')" class="mt-3 px-4 py-1.5 bg-brand-700 text-white rounded-lg text-xs font-semibold hover:bg-brand-800">
                            <i class="fa-solid fa-plus mr-1"></i> Tambah Supplier
                        </button>
                    </div>
                    @endforelse

                    <!-- Auto PO Banner -->
                    <div class="mt-4 p-3.5 rounded-xl bg-amber-50 border border-amber-200 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-robot text-amber-600"></i>
                        </div>
                        <div class="flex-1">
                            <div class="text-xs font-bold text-amber-800">Otomasi Pemesanan Stok Kritis</div>
                            <div class="text-[11px] text-amber-700 mt-0.5">
                                {{ $statsStok['kritis'] > 0 ? $statsStok['kritis'] . ' komponen di bawah ambang batas siap diproses sekaligus' : 'Tidak ada stok kritis saat ini. Sistem siap monitor otomatis.' }}
                            </div>
                        </div>
                        @if($statsStok['kritis'] > 0)
                        <button onclick="toastMsg('Membuat PO otomatis untuk ' . {{ $statsStok['kritis'] }} . ' part kritis...')" class="flex-shrink-0 px-3 py-1.5 bg-amber-600 text-white rounded-lg text-xs font-semibold hover:bg-amber-700 transition-colors">
                            <i class="fa-solid fa-cart-shopping mr-1.5"></i> Buat PO Otomatis
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- RIGHT: Hardware Diagnostic Inset -->
            <div class="flex flex-col gap-4">
                <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                    <div class="px-4 py-3.5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <div class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                                Hardware Diagnostic Inset
                            </div>
                            <div class="text-[10px] font-mono-code text-slate-400">Thermal Printer & Barcode Integration</div>
                        </div>
                    </div>
                    <div class="p-4 space-y-3 font-mono-code text-[11px]">
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <span class="text-slate-500">Thermal Label:</span>
                            <span class="font-bold text-emerald-600">Direct 40x30mm (Ready)</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <span class="text-slate-500">Auto SN Binding:</span>
                            <span class="font-bold text-sky-600">ON (Katalog & Tiket)</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <span class="text-slate-500">Part Opname Terakhir:</span>
                            <span class="font-bold text-slate-700">{{ $lastOpname }}</span>
                        </div>
                    </div>
                    <div class="px-4 pb-4 space-y-2">
                        <button onclick="toastMsg('Mencetak barcode label terpilih...')" class="w-full py-2 flex items-center justify-center gap-1.5 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-50 transition-colors">
                            <i class="fa-solid fa-print text-slate-400"></i> Cetak Barcode Label Terpilih
                        </button>
                        <button onclick="toastMsg('Tes Scanner COM4 Handheld aktif...')" class="w-full py-2 flex items-center justify-center gap-1.5 border border-brand-200 text-brand-700 bg-brand-50 rounded-lg text-xs font-semibold hover:bg-brand-100 transition-colors">
                            <i class="fa-solid fa-barcode text-brand-600"></i> Tes Scanner COM4 Handheld
                        </button>
                    </div>
                </div>
            </div>

        </div><!-- end bottom panels -->

    </main>
</div><!-- end main wrapper -->

<!-- ========================= MODAL: TAMBAH SPAREPART ========================= -->
<div id="addPartModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white rounded-t-2xl z-10">
            <div>
                <div class="text-base font-bold text-slate-800">Tambah Sparepart / Komponen Baru</div>
                <div class="text-[11px] font-mono-code text-slate-400">Isi data part untuk inventaris gudang</div>
            </div>
            <button onclick="closeAddPartModal()" class="text-slate-400 hover:text-slate-600 w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-100">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('techfix.stok.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <!-- Part Number & Nama -->
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Part Number (PN) <span class="text-rose-500">*</span></label>
                    <input type="text" name="part_number" placeholder="Contoh: SSD-SM-980PRO-1TB"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code uppercase" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Komponen <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama" placeholder="Nama lengkap part"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50" required>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Deskripsi / Spesifikasi</label>
                <input type="text" name="deskripsi" placeholder="Contoh: SN Tracked: SN882916A, SN882911A"
                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50">
            </div>

            <!-- Kategori & Kompatibilitas -->
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                    <select name="kategori" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="SSD & Storage">SSD & Storage</option>
                        <option value="RAM Memory">RAM Memory</option>
                        <option value="Baterai Laptop">Baterai Laptop</option>
                        <option value="Fan & Heatsink">Fan & Heatsink</option>
                        <option value="Thermal Material">Thermal Material</option>
                        <option value="Layar & LCD">Layar & LCD</option>
                        <option value="Keyboard & LCD">Keyboard & LCD</option>
                        <option value="IC & Komponen">IC & Komponen</option>
                        <option value="Kabel & Konektor">Kabel & Konektor</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kompatibilitas</label>
                    <input type="text" name="kompatibel" placeholder="Contoh: MacBook Pro M1, Dell XPS 15"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50">
                </div>
            </div>

            <!-- Stok & Harga -->
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Stok Gudang <span class="text-rose-500">*</span></label>
                    <input type="number" name="stok_gudang" placeholder="0" min="0"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Stok Toko</label>
                    <input type="number" name="stok_toko" placeholder="0" min="0"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Stok Minimum</label>
                    <input type="number" name="stok_min" placeholder="1" min="0"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code">
                </div>
            </div>

            <!-- Harga Modal & Jual -->
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Harga Modal (Rp)</label>
                    <input type="number" name="harga_modal" placeholder="0" min="0"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Harga Jual (Rp)</label>
                    <input type="number" name="harga_jual" placeholder="0" min="0"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code">
                </div>
            </div>

            <!-- Supplier -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Supplier</label>
                <input type="text" name="supplier" placeholder="Nama distributor / supplier resmi"
                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeAddPartModal()" class="px-4 py-2 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-50">Batal</button>
                <button type="submit" class="px-5 py-2 bg-brand-700 text-white rounded-lg text-xs font-semibold hover:bg-brand-800 transition-colors">
                    <i class="fa-solid fa-floppy-disk mr-1.5"></i> Simpan ke Inventaris
                </button>
            </div>
        </form>
    </div>
</div>

<!-- TOAST -->
<div id="toastContainer" class="fixed bottom-5 right-5 z-[999] space-y-2 pointer-events-none"></div>

<script>
    function toastMsg(msg, type = 'info') {
        const colors = { info:'bg-slate-800 text-white', success:'bg-emerald-600 text-white', warning:'bg-amber-500 text-white', error:'bg-rose-600 text-white' };
        const toast = document.createElement('div');
        toast.className = `pointer-events-auto px-4 py-3 rounded-xl shadow-xl text-xs font-semibold flex items-center gap-2.5 transition-all ${colors[type]||colors.info}`;
        toast.innerHTML = `<i class="fa-solid fa-circle-info"></i> ${msg}`;
        document.getElementById('toastContainer').appendChild(toast);
        setTimeout(() => toast.remove(), 3500);
    }

    function openAddPartModal() { document.getElementById('addPartModal').classList.remove('hidden'); }
    function closeAddPartModal() { document.getElementById('addPartModal').classList.add('hidden'); }

    // Filter by status tab
    const allTabs = ['Semua','Kritis','Aman','Po'];
    function filterStatus(status) {
        allTabs.forEach(t => {
            const el = document.getElementById('tab'+t);
            if (el) { el.classList.remove('active'); el.classList.add('text-slate-500'); }
        });
        const activeId = 'tab' + status.charAt(0).toUpperCase() + status.slice(1);
        const activeEl = document.getElementById(activeId);
        if (activeEl) { activeEl.classList.add('active'); activeEl.classList.remove('text-slate-500'); }

        document.querySelectorAll('.part-data').forEach(row => {
            const s = row.dataset.status || 'aman';
            row.style.display = (status === 'semua' || s === status) ? '' : 'none';
        });
    }

    // Filter by category
    function filterKategori(slug) {
        document.querySelectorAll('.cat-tab').forEach(btn => {
            if (btn.dataset.slug === slug) {
                btn.classList.add('bg-brand-700','text-white');
                btn.classList.remove('bg-slate-100','text-slate-600');
            } else {
                btn.classList.remove('bg-brand-700','text-white');
                btn.classList.add('bg-slate-100','text-slate-600');
            }
        });
        document.querySelectorAll('.part-data').forEach(row => {
            const cat = row.dataset.kategori || '';
            row.style.display = (slug === 'semua' || cat === slug) ? '' : 'none';
        });
    }

    // Search filter
    function filterTable() {
        const q = document.getElementById('searchPart').value.toLowerCase();
        document.querySelectorAll('.part-data').forEach(row => {
            const s = row.dataset.search || '';
            row.style.display = s.includes(q) ? '' : 'none';
        });
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeAddPartModal();
        if (e.key === 'F3') { e.preventDefault(); document.getElementById('searchPart').focus(); }
    });

    setTimeout(() => {
        const el = document.getElementById('flashAlert');
        if (el) el.remove();
    }, 4000);
</script>
</body>
</html>
