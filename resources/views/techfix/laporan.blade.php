<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFix Pro — Laporan Keuangan, Omzet Servis & Analitik Laba</title>
    <meta name="description" content="TechFix Pro - Rekapitulasi Finansial Real-time, Profit Margin Jasa Reparasi vs Sparepart, Komisi Teknisi, dan Rekonsiliasi Kasir">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                            950: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #0f172a; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.2); opacity: 0.4; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-beacon { animation: pulse-ring 2s infinite ease-in-out; }
        .nav-item-active { background-color: #1d4ed8; color: #ffffff !important; font-weight: 600; }
        .kpi-card { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .kpi-card:hover { transform: translateY(-1px); box-shadow: 0 10px 25px -5px rgba(15,23,42,0.06); }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.3s ease forwards; }
    </style>
</head>
<body class="min-h-screen flex text-slate-800 bg-[#f8fafc] antialiased">

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- LEFT SIDEBAR                                               -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed inset-y-0 left-0 z-40 select-none">

        <!-- Brand Header -->
        <div class="px-5 pt-5 pb-4 border-b border-slate-100">
            <div class="flex items-center gap-1.5 font-display font-extrabold text-[20px] tracking-tight text-brand-900 leading-none">
                <span>TechFix</span><span class="text-sky-500">Pro</span>
            </div>
            <div class="text-[9.5px] font-mono-code font-bold tracking-widest text-sky-600 mt-1 uppercase">HARDWARE & SERVICE OS</div>
            <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100 text-[10px] font-mono-code text-slate-500">
                <span class="font-semibold text-slate-600">SESI TEKNISI: <span class="text-emerald-600 font-bold">ACTIVE</span></span>
                <span class="px-1.5 py-0.5 rounded border border-slate-200 text-slate-400 font-bold">v4.2-PROD</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-3 py-3 space-y-1 overflow-y-auto">
            <a href="{{ route('techfix.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-ticket-simple text-sm text-slate-400"></i>
                    <span>Tiket & Workbench</span>
                </div>
                <span class="px-1.5 py-0.2 rounded text-[10px] font-mono-code font-bold bg-slate-100 text-slate-600">14</span>
            </a>
            <a href="{{ route('techfix.tracking') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-regular fa-comment-dots text-sm text-slate-400"></i>
                    <span>Tracking & Approval WA</span>
                </div>
                <span class="px-1.5 py-0.2 rounded text-[10px] font-mono-code font-bold bg-sky-100 text-sky-700">2</span>
            </a>
            <a href="{{ route('techfix.kasir') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-cash-register text-sm text-slate-400"></i>
                <span>Kasir POS & Garansi</span>
            </a>
            <a href="{{ route('techfix.stok') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-boxes-stacked text-sm text-slate-400"></i>
                    <span>Stok Sparepart & Inv</span>
                </div>
                <span class="px-1.5 py-0.2 rounded text-[10px] font-mono-code font-bold bg-rose-100 text-rose-700">12</span>
            </a>
            <a href="{{ route('techfix.crm') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-user-gear text-sm text-slate-400"></i>
                <span>CRM & Riwayat Unit</span>
            </a>
            <!-- LAPORAN & KEUANGAN ACTIVE -->
            <a href="{{ route('techfix.laporan') }}" class="nav-item-active flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-xs transition-all shadow-sm">
                <i class="fa-solid fa-chart-line text-sm"></i>
                <span>Laporan & Keuangan</span>
            </a>
            <a href="{{ route('techfix.pengaturan') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-gear text-sm text-slate-400"></i>
                <span>Pengaturan Sistem</span>
            </a>
        </nav>

        <!-- Sidebar Bottom Diagnostics -->
        <div class="p-3.5 border-t border-slate-200 bg-slate-50/60 font-mono-code">
            <div class="flex items-center justify-between text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                <span>HARDWARE DIAGNOSTICS</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
            </div>
            <div class="space-y-1.5 text-[11px] text-slate-600">
                <div class="flex justify-between items-center"><span class="text-slate-400">LAN Workshop</span><span class="font-bold text-emerald-600">192.168.1.10</span></div>
                <div class="flex justify-between items-center"><span class="text-slate-400">QR Scanner</span><span class="font-bold text-sky-600">Siap (COM4)</span></div>
                <div class="flex justify-between items-center"><span class="text-slate-400">Thermal Printer</span><span class="font-bold text-slate-700">Ready 80mm</span></div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-200 flex items-center justify-between text-[11px]">
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="font-semibold text-slate-700">{{ $shiftStatus ?? 'Shift 1 (Pagi)' }}</span>
                </div>
                <form action="{{ route('techfix.shift.toggle') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sky-600 hover:underline font-semibold text-[11px]">Ganti</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- MAIN WRAPPER                                               -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <div class="pl-64 flex-1 flex flex-col min-w-0">

        <!-- TOP NAVBAR -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <!-- Left: Branch & Breadcrumb -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2.5 cursor-pointer group" onclick="document.getElementById('branchSwitchForm').submit();">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 group-hover:bg-sky-100 transition-colors">
                        <i class="fa-solid fa-store text-xs"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 text-xs font-bold text-slate-800 leading-tight">
                            <span>{{ $currentBranch ?? 'Mangga Dua Mall Lt. 3' }}</span>
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
                <div class="hidden md:flex items-center text-[11px] font-mono-code text-slate-400 border-l border-slate-200 pl-4 gap-1.5">
                    <a href="{{ route('techfix.dashboard') }}" class="hover:text-slate-600">TechFix</a>
                    <span>/</span>
                    <span class="text-brand-700 font-semibold">Laporan/Finansial & Analitik Laba Bengkel</span>
                </div>
            </div>

            <!-- Right Navbar -->
            <div class="flex items-center gap-3">
                <div class="relative w-52 hidden lg:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="globalSearchInput" placeholder="Cari laporan..."
                        class="w-full pl-8 pr-12 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder:text-slate-400">
                    <span class="absolute right-2 top-1/2 -translate-y-1/2 text-[10px] font-mono-code bg-white px-1.5 py-0.5 border border-slate-200 rounded text-slate-400">Ctrl+K</span>
                </div>
                <div class="hidden lg:flex items-center gap-1.5 px-2.5 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-[11px] font-mono-code text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                    <span>WA Gateway: <strong>Terhubung</strong></span>
                </div>
                <div class="hidden xl:flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-mono-code text-slate-600">
                    <i class="fa-solid fa-user-astronaut text-slate-400 text-xs"></i>
                    <span>Teknisi: <strong>6/8 Standby</strong></span>
                </div>
                <button onclick="openCatatModal()" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all hover:shadow active:scale-[0.98]">
                    <i class="fa-solid fa-plus text-[11px]"></i>
                    <span>+ Catat Transaksi</span>
                </button>
                <div class="relative">
                    <button onclick="toastMsg('Notifikasi: Buku kas terhubung dengan rekonsiliasi kasir.')" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="fa-regular fa-bell text-xs"></i>
                    </button>
                </div>
                <div class="flex items-center gap-2.5 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="hidden sm:block text-left">
                        <div class="text-xs font-bold text-slate-800 leading-tight">{{ $user->name ?? 'Rian Pratama, S.Kom' }}</div>
                        <div class="text-[10px] font-medium text-slate-400">Chief Tech & Admin</div>
                    </div>
                    <div class="relative group">
                        <button class="p-1 text-slate-400 hover:text-slate-600">
                            <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-1 w-52 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 hidden group-hover:block z-50 text-xs">
                            <div class="px-3 py-1 text-[10px] font-mono-code font-bold text-slate-400 uppercase">Kelola Finansial</div>
                            <a href="{{ route('techfix.laporan.reset') }}" onclick="return confirm('Kosongkan semua data laporan keuangan?');" class="flex items-center gap-2 px-3 py-1.5 text-rose-600 hover:bg-rose-50">
                                <i class="fa-solid fa-eraser text-rose-400"></i> Kosongkan Data Laporan
                            </a>
                            <div class="border-t border-slate-100 my-1"></div>
                            <form action="{{ url('/logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-3 py-1.5 text-slate-600 hover:bg-slate-50 text-left">
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
            <div id="flashAlert" class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-xl text-xs flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('flashAlert').remove()" class="text-emerald-500 hover:text-emerald-700"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif

            <!-- ── 1. Page Header ──────────────────────────────────────── -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2.5">
                        <h1 class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            Laporan Keuangan, Omzet Servis & Analitik Laba
                        </h1>
                        @if($statsLaporan['tutup_buku_at'])
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Buku Kas Terkonsolidasi ({{ $statsLaporan['tutup_buku_at'] }})</span>
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 bg-sky-50 text-sky-700 border border-sky-200 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            <span>Buku Kas Terbuka & Real-time</span>
                        </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 mt-1 max-w-3xl leading-relaxed">
                        Rekapitulasi performa finansial real-time, profit margin jasa reparasi vs suku cadang, komisi bagi hasil teknisi, dan rekonsiliasi arus kas kasir shift harian.
                    </p>
                </div>

                <!-- Action Controls -->
                <div class="flex items-center gap-2 flex-wrap flex-shrink-0">
                    <!-- Date Picker Filter -->
                    <div class="flex items-center gap-2 bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-700 shadow-xs">
                        <i class="fa-regular fa-calendar text-slate-400"></i>
                        <span class="font-medium">Bulan Ini: 1 Feb 2025 - 28 Feb 2025</span>
                    </div>

                    <!-- Branch Filter -->
                    <div class="flex items-center gap-1.5 bg-white border border-slate-200 rounded-lg px-3 py-1.5 text-xs text-slate-700 shadow-xs">
                        <i class="fa-solid fa-store text-slate-400"></i>
                        <span>{{ $currentBranch ?? 'Mangga Dua Mall Lt. 3' }}</span>
                    </div>

                    <!-- Export -->
                    <button onclick="toastMsg('Mengekspor laporan keuangan ke format PDF/Excel...')" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-download text-slate-400"></i>
                        <span>Ekspor (PDF / Excel)</span>
                    </button>

                    <!-- Tutup Buku -->
                    <form action="{{ route('techfix.laporan.tutup_buku') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" onclick="return confirm('Tutup buku kas dan lakukan rekonsiliasi periode ini?');" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                            <i class="fa-solid fa-lock text-[10px]"></i>
                            <span>Tutup Buku & Rekonsiliasi</span>
                        </button>
                    </form>

                    <!-- Reset Data Button -->
                    <a href="{{ route('techfix.laporan.reset') }}" onclick="return confirm('Kosongkan semua data laporan keuangan? Anda dapat mengisinya kembali secara mandiri.');" class="flex items-center gap-1.5 bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-eraser text-rose-400"></i>
                        <span>Kosongkan Data</span>
                    </a>
                </div>
            </div>

            <!-- ── 2. Top KPI Cards (5 Cards) ──────────────────────────── -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">

                <!-- 1. Gross Revenue -->
                <div class="kpi-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>GROSS REVENUE</span>
                        <i class="fa-solid fa-wallet text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-xs font-bold text-slate-400 font-mono-code">Rp</span>
                        <span class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            {{ number_format($statsLaporan['gross_revenue'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5 text-[10.5px] text-emerald-600 font-semibold mt-1.5 font-mono-code">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                        <span>{{ $statsLaporan['gross_revenue'] > 0 ? '+16.4% vs bulan lalu' : '0% vs bulan lalu' }}</span>
                    </div>
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[10.5px] text-slate-400 font-mono-code">
                        <span>Target: <strong class="text-slate-600">92%</strong></span>
                        <span>Jasa {{ $statsLaporan['gross_revenue'] > 0 ? round(($statsLaporan['labor_revenue'] / $statsLaporan['gross_revenue']) * 100) : 0 }}% | Part {{ $statsLaporan['gross_revenue'] > 0 ? round(($statsLaporan['parts_revenue'] / $statsLaporan['gross_revenue']) * 100) : 0 }}%</span>
                    </div>
                </div>

                <!-- 2. Net Profit (EBITDA) -->
                <div class="kpi-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>NET PROFIT (EBITDA)</span>
                        <i class="fa-solid fa-building-columns text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-xs font-bold text-slate-400 font-mono-code">Rp</span>
                        <span class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            {{ number_format($statsLaporan['net_profit'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 mt-1.5">
                        <span class="px-1.5 py-0.5 rounded bg-brand-50 text-brand-700 font-mono-code text-[10px] font-bold">
                            Margin: {{ $statsLaporan['net_margin'] }}%
                        </span>
                        <span class="text-[10.5px] text-emerald-600 font-semibold">Sehat & Liquid</span>
                    </div>
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[10.5px] text-slate-400 font-mono-code">
                        <span>OpEx Terkendali:</span>
                        <strong class="text-slate-600">Rp {{ number_format($statsLaporan['parts_hpp'], 0, ',', '.') }}</strong>
                    </div>
                </div>

                <!-- 3. Labor Revenue -->
                <div class="kpi-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>LABOR REVENUE</span>
                        <i class="fa-solid fa-screwdriver-wrench text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-xs font-bold text-slate-400 font-mono-code">Rp</span>
                        <span class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            {{ number_format($statsLaporan['labor_revenue'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="text-[10.5px] text-slate-500 mt-1.5 font-mono-code">
                        <strong>{{ $statsLaporan['unit_reparasi'] }} Unit:</strong> Reparasi Selesai
                    </div>
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[10.5px] text-slate-400 font-mono-code">
                        <span>Rerata per Unit:</span>
                        <strong class="text-brand-700">Rp {{ number_format($statsLaporan['labor_rerata'], 0, ',', '.') }}</strong>
                    </div>
                </div>

                <!-- 4. Parts & Accessories -->
                <div class="kpi-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>PARTS & ACCESSORIES</span>
                        <i class="fa-solid fa-boxes-stacked text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-xs font-bold text-slate-400 font-mono-code">Rp</span>
                        <span class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            {{ number_format($statsLaporan['parts_revenue'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="text-[10.5px] text-slate-500 mt-1.5 font-mono-code">
                        HPP Part: Rp {{ number_format($statsLaporan['parts_hpp'], 0, ',', '.') }}
                    </div>
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[10.5px] text-slate-400 font-mono-code">
                        <span>Laba Kotor Part:</span>
                        <strong class="text-emerald-600">Rp {{ number_format($statsLaporan['parts_gross_profit'], 0, ',', '.') }}</strong>
                    </div>
                </div>

                <!-- 5. Kas vs Piutang B2B -->
                <div class="kpi-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>KAS VS PIUTANG B2B</span>
                        <i class="fa-solid fa-money-bill-transfer text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-xs font-bold text-slate-400 font-mono-code">Rp</span>
                        <span class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            {{ number_format($statsLaporan['kas_sinkron'] + $statsLaporan['piutang_b2b'], 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-[10.5px] text-slate-500 mt-1.5 font-mono-code">
                        <span>Kasir Sinkron:</span>
                        <strong class="text-emerald-600">Rp {{ number_format($statsLaporan['kas_sinkron'], 0, ',', '.') }}</strong>
                    </div>
                    <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[10.5px] text-slate-400 font-mono-code">
                        <span>TOP B2B (Tempo):</span>
                        <strong class="text-rose-500">Rp {{ number_format($statsLaporan['piutang_b2b'], 0, ',', '.') }}</strong>
                    </div>
                </div>

            </div>

            <!-- ── 3. Middle Section: Tren Grafik & Bagi Hasil Teknisi ───── -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Left (2 Cols): Tren Pendapatan Harian Chart -->
                <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h2 class="text-sm font-bold text-slate-900">
                                        Tren Pendapatan Harian & Komparasi Jasa vs Part
                                    </h2>
                                    <i class="fa-solid fa-chart-simple text-slate-400 text-xs"></i>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    Distribusi omzet per hari kalender dengan pembagian porsi reparasi & inventory/hardware
                                </p>
                            </div>
                            <div class="flex items-center bg-slate-100 p-0.5 rounded-lg text-[11px] font-medium text-slate-600">
                                <button class="px-2.5 py-1 rounded-md bg-white shadow-xs font-semibold text-brand-700">Harian (28 Hari)</button>
                                <button onclick="toastMsg('Pilihan agregasi Mingguan')" class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Mingguan</button>
                                <button onclick="toastMsg('Pilihan Kategori Kerusakan')" class="px-2.5 py-1 rounded-md hover:text-slate-900 transition-colors">Kategori Kerusakan</button>
                            </div>
                        </div>

                        <!-- Legend & Peak Indicators -->
                        <div class="flex flex-wrap items-center justify-between gap-3 my-4 text-xs font-mono-code">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-3 h-3 rounded-xs bg-brand-700"></span>
                                    <span class="text-slate-600 text-[11px]">Pendapatan Jasa Reparasi</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="w-3 h-3 rounded-xs bg-sky-400"></span>
                                    <span class="text-slate-600 text-[11px]">Penjualan Suku Cadang & Aksesoris</span>
                                </div>
                            </div>
                            <div class="text-[10.5px] text-slate-500">
                                <span>Peak Day: <strong class="text-brand-700">{{ $statsLaporan['gross_revenue'] > 0 ? '15 Feb' : '—' }}</strong></span>
                                <span class="mx-1">•</span>
                                <span>Low Day: <strong class="text-slate-600">{{ $statsLaporan['gross_revenue'] > 0 ? '03 Feb' : '—' }}</strong></span>
                            </div>
                        </div>

                        <!-- Bar Chart Container -->
                        <div class="h-44 w-full flex items-end gap-1.5 pt-4 pb-2 px-1 border-b border-slate-100">
                            @php
                                $maxVal = max(1, max(array_column($chartDays, 'total')));
                            @endphp
                            @foreach($chartDays as $cd)
                            @php
                                $totalDay = $cd['total'];
                                $heightPct = $statsLaporan['gross_revenue'] > 0 ? max(6, round(($totalDay / $maxVal) * 100)) : 4;
                                $jasaPct = $totalDay > 0 ? round(($cd['jasa'] / $totalDay) * 100) : 50;
                                $partPct = 100 - $jasaPct;
                            @endphp
                            <div class="flex-1 flex flex-col items-center h-full justify-end group relative cursor-pointer">
                                <!-- Tooltip -->
                                <div class="absolute bottom-full mb-2 hidden group-hover:flex flex-col bg-slate-900 text-white text-[10px] p-2 rounded-lg shadow-xl z-20 whitespace-nowrap pointer-events-none font-mono-code">
                                    <span class="font-bold border-b border-slate-700 pb-1 mb-1">{{ $cd['day'] }} Feb 2025</span>
                                    <span>Jasa: Rp {{ number_format($cd['jasa'], 0, ',', '.') }}</span>
                                    <span>Part: Rp {{ number_format($cd['part'], 0, ',', '.') }}</span>
                                    <span class="text-emerald-400 font-bold mt-1">Total: Rp {{ number_format($cd['total'], 0, ',', '.') }}</span>
                                </div>

                                <!-- Bar Column -->
                                <div class="w-full rounded-t-sm flex flex-col justify-end overflow-hidden transition-all duration-300 group-hover:brightness-110" style="height: {{ $heightPct }}%;">
                                    <div class="w-full bg-sky-400" style="height: {{ $partPct }}%;"></div>
                                    <div class="w-full bg-brand-700" style="height: {{ $jasaPct }}%;"></div>
                                </div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1 {{ in_array($cd['day'], ['01','05','10','15','20','25','28']) ? 'block' : 'hidden md:block' }}">{{ $cd['day'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Chart Summary Footer -->
                    <div class="grid grid-cols-3 gap-3 pt-3 text-xs font-mono-code">
                        <div class="p-2.5 bg-slate-50 rounded-lg">
                            <span class="text-[10px] text-slate-400 uppercase block">Rerata Omzet Harian</span>
                            <span class="text-xs font-bold text-slate-800">
                                Rp {{ number_format(round($statsLaporan['gross_revenue'] / 28), 0, ',', '.') }} / hari
                            </span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-lg">
                            <span class="text-[10px] text-slate-400 uppercase block">Rasio Jasa vs Sparepart</span>
                            <span class="text-xs font-bold text-brand-700">
                                {{ $statsLaporan['parts_revenue'] > 0 ? round($statsLaporan['labor_revenue'] / $statsLaporan['parts_revenue'], 2) . ' : 1' : '1 : 0' }} (Labor Lead)
                            </span>
                        </div>
                        <div class="p-2.5 bg-slate-50 rounded-lg">
                            <span class="text-[10px] text-slate-400 uppercase block">Arus Kas Masuk Netto</span>
                            <span class="text-xs font-bold text-emerald-600">
                                Rp {{ number_format(round($statsLaporan['net_profit'] / 28), 0, ',', '.') }} / hari
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Right (1 Col): Bagi Hasil Teknisi -->
                <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div>
                                <h2 class="text-sm font-bold text-slate-900 flex items-center gap-1.5">
                                    <span>Bagi Hasil Teknisi</span>
                                    <i class="fa-solid fa-hand-holding-dollar text-slate-400 text-xs"></i>
                                </h2>
                                <p class="text-[11px] text-slate-400 mt-0.5">Komisi jasa perbaikan shift Februari</p>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono-code font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                Pool 30-35%
                            </span>
                        </div>

                        <!-- Teknisi List -->
                        <div class="space-y-3 mt-4">
                            @foreach($teknisiList as $tek)
                            <div class="p-3 bg-slate-50/70 border border-slate-200/80 rounded-xl flex flex-col gap-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-lg bg-brand-700 text-white flex items-center justify-center font-display font-bold text-xs uppercase shadow-xs">
                                            {{ substr($tek['nama'], 0, 2) }}
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-800">{{ $tek['nama'] }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $tek['title'] }}</div>
                                        </div>
                                    </div>
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-mono-code font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Retur {{ $tek['retur'] }}
                                    </span>
                                </div>
                                <div class="pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px] font-mono-code">
                                    <div class="text-slate-500">
                                        <span>Tiket Selesai: <strong>{{ $tek['tiket'] }} Unit</strong></span>
                                        <span class="mx-1">•</span>
                                        <span>Omset: Rp {{ number_format($tek['omzet_jasa'], 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between text-xs font-mono-code bg-white p-2 rounded-lg border border-slate-100">
                                    <span class="text-slate-400 text-[10px]">Hak Komisi Bersih (30%):</span>
                                    <span class="font-bold text-emerald-600">Rp {{ number_format($tek['komisi'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Cetak Slip -->
                    <button onclick="toastMsg('Mencetak Slip Komisi Teknisi (.PDF)...')" class="w-full mt-4 flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 py-2 rounded-lg text-xs font-semibold transition-colors">
                        <i class="fa-solid fa-print text-slate-500"></i>
                        <span>Cetak Slip Komisi Teknisi (.PDF)</span>
                    </button>
                </div>

            </div>

            <!-- ── 4. Lower Section: Analitik Profitabilitas & Audit Garansi/Pajak -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Left (2 Cols): Analitik Profitabilitas Berdasarkan Kategori -->
                <div class="lg:col-span-2 bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                        <div>
                            <h2 class="text-sm font-bold text-slate-900">
                                Analitik Profitabilitas Berdasarkan Kategori Layanan Reparasi
                            </h2>
                            <p class="text-[11px] text-slate-400 mt-0.5">
                                Margin kontribusi bersih per kategori perbaikan hardware setelah pengurangan HPP bahan baku & consumable workshop
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="toastMsg('Filter margin aktif')" class="flex items-center gap-1 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-2.5 py-1 rounded-lg text-xs font-medium">
                                <i class="fa-solid fa-sliders text-slate-400 text-[10px]"></i>
                                <span>Filter Margin</span>
                            </button>
                            <button onclick="toastMsg('Mengunduh CSV kategori...')" class="flex items-center gap-1 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-2.5 py-1 rounded-lg text-xs font-medium">
                                <i class="fa-solid fa-file-csv text-slate-400 text-[10px]"></i>
                                <span>Unduh CSV</span>
                            </button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto mt-3">
                        <table class="w-full text-left text-xs font-mono-code">
                            <thead>
                                <tr class="text-[10px] text-slate-400 uppercase border-b border-slate-100 pb-2">
                                    <th class="py-2.5 font-bold">Kategori Servis</th>
                                    <th class="py-2.5 text-center font-bold">Tiket</th>
                                    <th class="py-2.5 text-right font-bold">Rata-Rata Tiket</th>
                                    <th class="py-2.5 text-right font-bold">Total Omzet</th>
                                    <th class="py-2.5 text-right font-bold">HPP Part/Bahan</th>
                                    <th class="py-2.5 text-right font-bold">Net Margin</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @php
                                    $totalTiketKat = 0;
                                    $totalOmzetKat = 0;
                                    $totalHppKat   = 0;
                                @endphp
                                @foreach($kategoriMap as $kat)
                                @php
                                    $totalTiketKat += $kat['tiket'];
                                    $totalOmzetKat += $kat['omzet'];
                                    $totalHppKat   += $kat['hpp'];
                                    $avgKat = $kat['tiket'] > 0 ? round($kat['omzet'] / $kat['tiket']) : 0;
                                    $marginKat = $kat['omzet'] > 0 ? round((($kat['omzet'] - $kat['hpp']) / $kat['omzet']) * 100, 1) : 0;
                                @endphp
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="py-3 pr-2">
                                        <div class="font-sans font-bold text-slate-800 text-xs">{{ $kat['nama'] }}</div>
                                        <div class="text-[10px] text-slate-400 mt-0.5 font-sans">{{ $kat['sub'] }}</div>
                                    </td>
                                    <td class="py-3 text-center font-bold text-slate-700">{{ $kat['tiket'] }}</td>
                                    <td class="py-3 text-right text-slate-600">Rp {{ number_format($avgKat, 0, ',', '.') }}</td>
                                    <td class="py-3 text-right font-bold text-slate-900">Rp {{ number_format($kat['omzet'], 0, ',', '.') }}</td>
                                    <td class="py-3 text-right text-slate-500">Rp {{ number_format($kat['hpp'], 0, ',', '.') }}</td>
                                    <td class="py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <div class="w-16 bg-slate-100 h-2 rounded-full overflow-hidden hidden sm:block">
                                                <div class="bg-emerald-500 h-full rounded-full" style="width: {{ min(100, $marginKat) }}%;"></div>
                                            </div>
                                            <span class="font-bold {{ $marginKat >= 50 ? 'text-emerald-600' : 'text-amber-600' }}">{{ $marginKat }}%</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-t-2 border-slate-200 font-bold bg-slate-50/70 text-slate-900">
                                    <td class="py-3 font-sans text-xs">TOTAL TERKONSOLIDASI ({{ $totalTiketKat }} Tiket)</td>
                                    <td class="py-3 text-center">{{ $totalTiketKat }}</td>
                                    <td class="py-3 text-right">Rerata: Rp {{ number_format($totalTiketKat > 0 ? round($totalOmzetKat / $totalTiketKat) : 0, 0, ',', '.') }}</td>
                                    <td class="py-3 text-right text-brand-700">Rp {{ number_format($totalOmzetKat, 0, ',', '.') }}</td>
                                    <td class="py-3 text-right text-slate-600">Rp {{ number_format($totalHppKat, 0, ',', '.') }}</td>
                                    <td class="py-3 text-right text-emerald-600">
                                        {{ $totalOmzetKat > 0 ? round((($totalOmzetKat - $totalHppKat) / $totalOmzetKat) * 100, 1) : 0 }}% (Avg)
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Right (1 Col): Audit Garansi & Kepatuhan Pajak -->
                <div class="space-y-4 flex flex-col justify-between">

                    <!-- Audit Garansi & Klaim RMA -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <h3 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-slate-400"></i>
                                <span>Audit Garansi & Klaim RMA</span>
                            </h3>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono-code font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Rasio 1.6% (Aman)
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-2">
                            Pengendalian mutu perbaikan unit & retur sparepart distributor dalam masa garansi 30–90 hari.
                        </p>
                        <div class="space-y-2 mt-3 text-xs font-mono-code">
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Total Klaim Bulan Ini:</span>
                                <strong class="text-slate-800">{{ $statsLaporan['unit_reparasi'] > 0 ? '4 Kasus / ' . $statsLaporan['unit_reparasi'] . ' Tiket' : '0 Kasus / 0 Tiket' }}</strong>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Biaya Ditanggung Bengkel:</span>
                                <strong class="text-rose-500">{{ $statsLaporan['gross_revenue'] > 0 ? 'Rp 350.000 (1 part defect)' : 'Rp 0' }}</strong>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-slate-500">Diganti Supplier (RMA):</span>
                                <strong class="text-emerald-600">{{ $statsLaporan['gross_revenue'] > 0 ? 'Rp 2.450.000 (100% pulih)' : 'Rp 0' }}</strong>
                            </div>
                        </div>
                        <div class="mt-3 p-2 bg-emerald-50/60 border border-emerald-100 rounded-lg text-[10.5px] text-emerald-800 flex items-center gap-1.5 font-mono-code">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-xs"></i>
                            <span>Batas toleransi loss garansi terkendali di bawah ambang target 3.0%.</span>
                        </div>
                    </div>

                    <!-- Kepatuhan Pajak & e-Faktur -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <h3 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-file-invoice text-slate-400"></i>
                                <span>Kepatuhan Pajak & e-Faktur</span>
                            </h3>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono-code font-bold bg-slate-100 text-slate-600">
                                PP 55/2022
                            </span>
                        </div>
                        <div class="mt-3">
                            <div class="flex items-center justify-between text-xs font-mono-code">
                                <span class="text-slate-500">PPh Final UMKM 0.5% (Bruto)</span>
                                <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">Siap Bayar</span>
                            </div>
                            <div class="flex items-baseline gap-1 mt-1 font-mono-code">
                                <span class="text-xs text-slate-400">Rp</span>
                                <span class="text-xl font-display font-extrabold text-slate-900">
                                    {{ number_format($statsLaporan['pph_final'], 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="text-[10px] text-slate-400 mt-0.5 font-mono-code">
                                Dihitung otomatis dari Rp {{ number_format($statsLaporan['gross_revenue'], 0, ',', '.') }} omzet kotor
                            </div>
                        </div>
                        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-xs font-mono-code">
                            <span class="text-slate-500">Faktur Masukan Sparepart:</span>
                            <strong class="text-slate-700">{{ $statsLaporan['parts_revenue'] > 0 ? '14 Faktur Valid' : '0 Faktur Valid' }}</strong>
                        </div>
                        <div class="grid grid-cols-2 gap-2 mt-3">
                            <button onclick="toastMsg('Membuka Buku Kas & Laba...')" class="flex items-center justify-center gap-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 transition-colors">
                                <i class="fa-solid fa-book text-slate-400"></i>
                                <span>Buku Kas (Laba)</span>
                            </button>
                            <button onclick="toastMsg('Mengunduh P&L Report (.pdf)...')" class="flex items-center justify-center gap-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 py-1.5 rounded-lg text-[11px] font-semibold text-slate-700 transition-colors">
                                <i class="fa-solid fa-file-pdf text-slate-400"></i>
                                <span>P&L Report (.pdf)</span>
                            </button>
                        </div>
                    </div>

                </div>

            </div>

            <!-- ── 5. Bottom Section: Rekonsiliasi Kanal Pembayaran ─────── -->
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-xs">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-scale-balanced text-brand-700 text-sm"></i>
                        <h2 class="text-sm font-bold text-slate-900">
                            Rekonsiliasi Kanal Pembayaran & Arus Kas Kasir
                        </h2>
                    </div>
                    <span class="px-2.5 py-1 rounded text-xs font-mono-code font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Selisih Kas Fisik: Rp 0 (Valid 100%)
                    </span>
                </div>

                <!-- 4 Channels Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">

                    <!-- 1. QRIS Dinamis -->
                    <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-800">QRIS Dinamis</span>
                            <span class="text-[11px] font-mono-code font-bold text-brand-700">{{ $persenKanal['qris'] }}%</span>
                        </div>
                        <div class="flex items-baseline gap-1 mt-2 font-mono-code">
                            <span class="text-xs text-slate-400">Rp</span>
                            <span class="text-lg font-display font-bold text-slate-900">
                                {{ number_format($kanalBayar['qris'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-2 font-mono-code pt-2 border-t border-slate-200/60">
                            BCA QRIS, GoPay, OVO Real-time Settlement
                        </div>
                    </div>

                    <!-- 2. Transfer / VA Bank -->
                    <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-800">Transfer / VA Bank</span>
                            <span class="text-[11px] font-mono-code font-bold text-sky-600">{{ $persenKanal['transfer'] }}%</span>
                        </div>
                        <div class="flex items-baseline gap-1 mt-2 font-mono-code">
                            <span class="text-xs text-slate-400">Rp</span>
                            <span class="text-lg font-display font-bold text-slate-900">
                                {{ number_format($kanalBayar['transfer'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-2 font-mono-code pt-2 border-t border-slate-200/60">
                            BCA Corp, Mandiri VA (Auto-Mutasi API)
                        </div>
                    </div>

                    <!-- 3. Mesin EDC Card -->
                    <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-800">Mesin EDC Card</span>
                            <span class="text-[11px] font-mono-code font-bold text-violet-600">{{ $persenKanal['edc'] }}%</span>
                        </div>
                        <div class="flex items-baseline gap-1 mt-2 font-mono-code">
                            <span class="text-xs text-slate-400">Rp</span>
                            <span class="text-lg font-display font-bold text-slate-900">
                                {{ number_format($kanalBayar['edc'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-[10px] text-slate-400 mt-2 font-mono-code pt-2 border-t border-slate-200/60">
                            Debit BCA, Visa/Mastercard (d-Batch TOG)
                        </div>
                    </div>

                    <!-- 4. Kas Tunai Kasir -->
                    <div class="p-3.5 bg-slate-50 border border-slate-200 rounded-xl">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold text-slate-800">Kas Tunai Kasir</span>
                            <span class="text-[11px] font-mono-code font-bold text-emerald-600">{{ $persenKanal['tunai'] }}%</span>
                        </div>
                        <div class="flex items-baseline gap-1 mt-2 font-mono-code">
                            <span class="text-xs text-slate-400">Rp</span>
                            <span class="text-lg font-display font-bold text-slate-900">
                                {{ number_format($kanalBayar['tunai'], 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-[10px] text-emerald-700 mt-2 font-mono-code pt-2 border-t border-slate-200/60">
                            Tersimpan di Brankas Kasir Toko
                        </div>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- MODAL: CATAT TRANSAKSI FINANSIAL / PEMBUKUAN              -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <div id="catatModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm" role="dialog" aria-modal="true">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-display font-extrabold text-slate-900">Catat Transaksi Finansial</h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Entri pembukuan omzet jasa, penjualan sparepart, atau operasional</p>
                </div>
                <button onclick="closeCatatModal()" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form action="{{ route('techfix.laporan.transaksi.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-3.5 max-h-[70vh] overflow-y-auto">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Tipe Transaksi <span class="text-rose-500">*</span></label>
                        <select name="tipe" id="tipeTransaksiSelect" onchange="handleTipeChange()" required class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-white">
                            <option value="jasa">Jasa Reparasi Hardware (Labor Revenue)</option>
                            <option value="part">Penjualan Suku Cadang & Aksesoris (Parts)</option>
                            <option value="pengeluaran">Biaya Operasional / OpEx Workshop</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Keterangan Transaksi <span class="text-rose-500">*</span></label>
                        <input type="text" name="keterangan" placeholder="Contoh: Reballing IC Power ThinkPad X1 / Baterai MacBook M1" required
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Nominal (Rp) <span class="text-rose-500">*</span></label>
                            <input type="number" name="nominal" placeholder="0" required min="0"
                                class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 font-mono-code">
                        </div>
                        <div id="hppField">
                            <label class="block text-xs font-semibold text-slate-600 mb-1">HPP / Biaya Modal (Rp)</label>
                            <input type="number" name="hpp" placeholder="0" min="0"
                                class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 font-mono-code">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Kategori Layanan</label>
                            <select name="kategori_key" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-white">
                                <option value="microsolder">Microsolder & Reballing</option>
                                <option value="lcd">Pergantian LCD & Panel</option>
                                <option value="thermal">Thermal Overhaul & Fan</option>
                                <option value="battery">Baterai, Type-C & Keyboard</option>
                                <option value="upgrade">Upgrade SSD NVMe & Clone</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Teknisi Bertugas</label>
                            <select name="teknisi_key" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-white">
                                <option value="hendra">Hendra W. (Senior Microsolder)</option>
                                <option value="faisal">Faisal (Hardware & Motherboard)</option>
                                <option value="budi">Budi Santoso (Display & Thermal)</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Kanal Pembayaran</label>
                        <select name="kanal_bayar" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-white">
                            <option value="qris">QRIS Dinamis</option>
                            <option value="transfer">Transfer / VA Bank</option>
                            <option value="edc">Mesin EDC Card</option>
                            <option value="tunai">Kas Tunai Kasir</option>
                            <option value="tempo_b2b">TOP B2B (Tempo Piutang)</option>
                        </select>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-2 bg-slate-50/60">
                    <button type="button" onclick="closeCatatModal()" class="px-4 py-2 text-xs font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-5 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm">
                        <i class="fa-solid fa-check text-[10px]"></i>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" class="fixed bottom-5 right-5 z-[100] flex flex-col gap-2 items-end pointer-events-none"></div>

    <script>
        // Toast
        function toastMsg(msg, type = 'info') {
            const container = document.getElementById('toastContainer');
            const colors = { info: 'bg-slate-800 text-white', success: 'bg-emerald-600 text-white', error: 'bg-rose-600 text-white', warning: 'bg-amber-500 text-white' };
            const icons  = { info: 'fa-circle-info', success: 'fa-circle-check', error: 'fa-circle-xmark', warning: 'fa-triangle-exclamation' };
            const toast  = document.createElement('div');
            toast.className = `pointer-events-auto flex items-center gap-2.5 px-4 py-2.5 rounded-xl shadow-lg text-xs font-medium ${colors[type]}`;
            toast.style.cssText = 'transition:all .25s ease;transform:translateY(8px);opacity:0';
            toast.innerHTML = `<i class="fa-solid ${icons[type]} text-sm"></i><span>${msg}</span>`;
            container.appendChild(toast);
            requestAnimationFrame(() => { toast.style.transform = 'translateY(0)'; toast.style.opacity = '1'; });
            setTimeout(() => { toast.style.opacity = '0'; toast.style.transform = 'translateY(4px)'; setTimeout(() => toast.remove(), 300); }, 3500);
        }

        // Modal Catat
        function openCatatModal() {
            const m = document.getElementById('catatModal');
            if (m) { m.classList.remove('hidden'); m.classList.add('flex'); }
        }
        function closeCatatModal() {
            const m = document.getElementById('catatModal');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }

        function handleTipeChange() {
            const val = document.getElementById('tipeTransaksiSelect')?.value;
            const hpp = document.getElementById('hppField');
            if (hpp) {
                hpp.style.opacity = (val === 'pengeluaran') ? '0.3' : '1';
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeCatatModal();
            if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                e.preventDefault();
                document.getElementById('globalSearchInput')?.focus();
            }
        });
    </script>
</body>
</html>
