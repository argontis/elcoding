<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFix Pro — Laporan & Audit Log Pengaturan Sistem</title>
    <meta name="description" content="TechFix Pro - Rekapitulasi Riwayat Konfigurasi Sistem Bengkel, Audit Akses Pengguna, dan Telemetri Hardware">
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
        .metric-card { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .metric-card:hover { transform: translateY(-1px); box-shadow: 0 10px 25px -5px rgba(15,23,42,0.06); }
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
                <span class="px-1.5 py-0.2 rounded text-[10px] font-mono-code font-bold bg-sky-100 text-sky-700">3</span>
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
            <a href="{{ route('techfix.laporan') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-chart-line text-sm text-slate-400"></i>
                <span>Laporan & Keuangan</span>
            </a>
            <!-- PENGATURAN SISTEM ACTIVE -->
            <a href="{{ route('techfix.pengaturan') }}" class="nav-item-active flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-xs transition-all shadow-sm">
                <i class="fa-solid fa-gear text-sm"></i>
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
            <!-- Left: Branch -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2.5 cursor-pointer group" onclick="document.getElementById('branchSwitchForm').submit();">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 group-hover:bg-sky-100 transition-colors">
                        <i class="fa-solid fa-store text-xs"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5 text-xs font-bold text-slate-800 leading-tight">
                            <span>{{ $currentBranch ?? 'Mangga Dua Mall (Pusat)' }}</span>
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
            </div>

            <!-- Right Navbar -->
            <div class="flex items-center gap-3">
                <div class="relative w-64 hidden md:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="globalSearchInput" placeholder="Cari No. Tiket, SN Laptop, IMEI, atau Nama Cus..."
                        class="w-full pl-8 pr-12 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder:text-slate-400">
                    <span class="absolute right-2 top-1/2 -translate-y-1/2 text-[10px] font-mono-code bg-white px-1.5 py-0.5 border border-slate-200 rounded text-slate-400">Ctrl+K</span>
                </div>
                <div class="hidden lg:flex items-center gap-1.5 px-2.5 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-[11px] font-mono-code text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                    <span>WA Gateway: <strong>Connected</strong></span>
                </div>
                <div class="relative">
                    <button onclick="toastMsg('Notifikasi audit sistem: Enkripsi TLS 1.3 aktif.')" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="fa-regular fa-bell text-xs"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full"></span>
                    </button>
                </div>
                <div class="relative">
                    <button onclick="toastMsg('Arsip log tersinkronisasi ke NAS & Cloud.')" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="fa-solid fa-hard-drive text-xs"></i>
                    </button>
                </div>
                <div class="flex items-center gap-2.5 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="hidden sm:block text-left">
                        <div class="text-xs font-bold text-slate-800 leading-tight">{{ $user->name ?? 'Rian Pratama' }}</div>
                        <div class="text-[10px] font-medium text-slate-400">Chief Tech & Admin</div>
                    </div>
                    <div class="relative group">
                        <button class="p-1 text-slate-400 hover:text-slate-600">
                            <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-1 w-52 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 hidden group-hover:block z-50 text-xs">
                            <div class="px-3 py-1 text-[10px] font-mono-code font-bold text-slate-400 uppercase">Aksi Audit</div>
                            <a href="{{ route('techfix.pengaturan.reset') }}" onclick="return confirm('Kosongkan semua data audit log pengaturan sistem?');" class="flex items-center gap-2 px-3 py-1.5 text-rose-600 hover:bg-rose-50">
                                <i class="fa-solid fa-eraser text-rose-400"></i> Kosongkan Data Audit
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

            <!-- ── Top Compliance Badges ───────────────────────────────── -->
            <div class="flex items-center gap-2 text-[10px] font-mono-code font-bold flex-wrap">
                <span class="px-2.5 py-1 rounded-md bg-sky-50 text-sky-700 border border-sky-200 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                    <span>SOC-2 Type II Compliant</span>
                </span>
                <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 border border-slate-200 flex items-center gap-1.5">
                    <i class="fa-solid fa-shield-cat text-slate-400"></i>
                    <span>Audit Hash: SHA-256 Verified</span>
                </span>
                <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-600 border border-slate-200">
                    Retention: 365 Hari Aktif
                </span>
            </div>

            <!-- ── 1. Page Header ──────────────────────────────────────── -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div>
                    <h1 class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                        Laporan & Audit Log Pengaturan Sistem
                    </h1>
                    <p class="text-xs text-slate-500 mt-1 max-w-3xl leading-relaxed">
                        Rekapitulasi riwayat konfigurasi sistem bengkel, audit akses pengguna, log transaksi API WhatsApp, sinkronisasi periferal hardware, dan integritas pencadangan database.
                    </p>
                </div>

                <!-- Action Controls -->
                <div class="flex items-center gap-2 flex-wrap flex-shrink-0">
                    <button onclick="toastMsg('Mengekspor berkas audit log ke format PDF...')" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-file-pdf text-rose-500"></i>
                        <span>Export PDF</span>
                    </button>
                    <button onclick="toastMsg('Mengunduh arsip CSV (.zip) konfigurasi...')" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-file-zipper text-amber-500"></i>
                        <span>Unduh CSV (.zip)</span>
                    </button>
                    <button onclick="openCatatLogModal()" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>+ Catat Log Konfigurasi</span>
                    </button>
                    <a href="{{ route('techfix.pengaturan.reset') }}" onclick="return confirm('Kosongkan semua data audit log pengaturan sistem? Anda dapat mengisinya kembali secara mandiri.');" class="flex items-center gap-1.5 bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-eraser text-rose-400"></i>
                        <span>Kosongkan Data</span>
                    </a>
                </div>
            </div>

            <!-- ── 2. Filter Bar ──────────────────────────────────────── -->
            <div class="bg-white border border-slate-200 rounded-xl p-3 shadow-xs flex flex-wrap items-center justify-between gap-3 text-xs">
                <div class="flex flex-wrap items-center gap-2.5">
                    <!-- Date Filter -->
                    <div class="flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-slate-700">
                        <i class="fa-regular fa-calendar text-slate-400"></i>
                        <span class="font-medium">1 Feb 2025 - 28 Feb 2025</span>
                    </div>

                    <!-- Category Filter -->
                    <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-slate-700">
                        <i class="fa-solid fa-sliders text-slate-400"></i>
                        <span>Semua Kategori Audit</span>
                        <i class="fa-solid fa-chevron-down text-[9px] text-slate-400 ml-1"></i>
                    </div>

                    <!-- Branch Filter -->
                    <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-lg px-3 py-1.5 text-slate-700">
                        <i class="fa-solid fa-store text-slate-400"></i>
                        <span>Cabang: {{ $currentBranch ?? 'Mangga Dua Mall (Pusat)' }}</span>
                        <i class="fa-solid fa-chevron-down text-[9px] text-slate-400 ml-1"></i>
                    </div>
                </div>

                <div class="text-[10px] font-mono-code font-bold text-slate-500 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                    <span>STREAM: LIVE SYNC ACTIVE (1.2s DELAY)</span>
                </div>
            </div>

            <!-- ── 3. Top 4 Metric KPI Cards ───────────────────────────── -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- 1. Total Aktivitas Log -->
                <div class="metric-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>TOTAL AKTIVITAS LOG</span>
                        <div class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                            <i class="fa-solid fa-clipboard-list text-xs"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-display font-extrabold text-slate-900 tracking-tight mt-1">
                        {{ number_format($statsPengaturan['total_logs'], 0, ',', '.') }}
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] font-mono-code">
                        <span class="px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold">99.98% Berhasil</span>
                        <span class="text-slate-400">0 Anomali Teratasi</span>
                    </div>
                </div>

                <!-- 2. Perubahan Konfigurasi -->
                <div class="metric-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>PERUBAHAN KONFIGURASI</span>
                        <div class="w-7 h-7 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center">
                            <i class="fa-solid fa-gear text-xs"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-2xl font-display font-extrabold text-slate-900 tracking-tight">
                            {{ $statsPengaturan['total_revisi'] }}
                        </span>
                        <span class="text-xs text-slate-400 font-mono-code font-semibold">Revisi</span>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] font-mono-code text-slate-500">
                        <span class="flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-brand-700"></span>
                            <span>4 Admin & Super User</span>
                        </span>
                        <span class="text-sky-600 font-semibold">0 Pending Peer Rev</span>
                    </div>
                </div>

                <!-- 3. WA Quota & Delivery -->
                <div class="metric-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>WA QUOTA & DELIVERY</span>
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="fa-brands fa-whatsapp text-xs"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-2xl font-display font-extrabold text-slate-900 tracking-tight">
                            {{ $statsPengaturan['wa_pesan'] > 0 ? number_format($statsPengaturan['wa_pesan'], 0, ',', '.') : '9.420' }}
                        </span>
                        <span class="text-xs text-slate-400 font-mono-code font-semibold">Pesan</span>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] font-mono-code">
                        <span class="px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold">99.4% Delivery</span>
                        <span class="text-slate-400">Latensi ~1.2s</span>
                    </div>
                </div>

                <!-- 4. Status Backup Database -->
                <div class="metric-card bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>STATUS BACKUP DATABASE</span>
                        <div class="w-7 h-7 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center">
                            <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline justify-between mt-1">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-2xl font-display font-extrabold text-slate-900 tracking-tight">
                                {{ $statsPengaturan['total_backup'] > 0 ? $statsPengaturan['total_backup'] . '/' . $statsPengaturan['total_backup'] : '28/28' }}
                            </span>
                            <span class="text-xs font-mono-code font-bold text-emerald-600">100%</span>
                        </div>
                        <span class="text-xs font-mono-code font-bold text-emerald-600">Valid</span>
                    </div>
                    <div class="mt-2.5 pt-2 border-t border-slate-100 text-[10px] font-mono-code text-slate-400 flex items-center gap-1">
                        <i class="fa-solid fa-server text-[9px]"></i>
                        <span>NAS & GCS Cloud 03:00 WIB</span>
                    </div>
                </div>

            </div>

            <!-- ── 4. Main Section: Table & Side Panels ────────────────── -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <!-- Left (2 Cols): Category Tabs, Search & Audit Log Table -->
                <div class="lg:col-span-2 space-y-4">

                    <!-- Category Filter Tabs -->
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('techfix.pengaturan', ['kategori' => 'all']) }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold transition-all shadow-xs {{ $filterCat === 'all' ? 'bg-brand-700 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-list-check text-xs"></i>
                            <span>Semua Log Audit (Live)</span>
                            <span class="px-1.5 py-0.2 rounded-full text-[10px] font-mono-code {{ $filterCat === 'all' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">
                                {{ count($logs) }}
                            </span>
                        </a>
                        <a href="{{ route('techfix.pengaturan', ['kategori' => 'kebijakan']) }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold transition-all shadow-xs {{ $filterCat === 'kebijakan' ? 'bg-brand-700 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-file-contract text-xs"></i>
                            <span>Perubahan Kebijakan & SLA</span>
                        </a>
                        <a href="{{ route('techfix.pengaturan', ['kategori' => 'auth']) }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold transition-all shadow-xs {{ $filterCat === 'auth' ? 'bg-brand-700 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-user-lock text-xs"></i>
                            <span>Log Autentikasi & Staf</span>
                        </a>
                        <a href="{{ route('techfix.pengaturan', ['kategori' => 'telemetri']) }}"
                           class="flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold transition-all shadow-xs {{ $filterCat === 'telemetri' ? 'bg-brand-700 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
                            <i class="fa-solid fa-microchip text-xs"></i>
                            <span>Telemetri Hardware & Printer</span>
                        </a>
                    </div>

                    <!-- Search and Level Filter Bar -->
                    <div class="bg-white border border-slate-200 rounded-xl p-3 shadow-xs flex flex-wrap items-center justify-between gap-3 text-xs">
                        <div class="relative flex-1 min-w-60">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="logSearchInput" placeholder="Cari aktor, IP address, entitas atau parameter konfigurasi..."
                                class="w-full pl-8 py-1 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white placeholder:text-slate-400">
                        </div>

                        <div class="flex items-center gap-1 font-mono-code text-[11px]">
                            <span class="text-slate-400 mr-1 text-[10px] uppercase">TINGKAT:</span>
                            <button onclick="filterLogLevel('ALL')" class="px-2 py-0.5 rounded text-[10px] font-bold bg-brand-700 text-white">ALL</button>
                            <button onclick="filterLogLevel('INFO')" class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200">INFO</button>
                            <button onclick="filterLogLevel('WARN')" class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200">WARN</button>
                            <button onclick="filterLogLevel('CRIT')" class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 hover:bg-slate-200">CRIT</button>
                        </div>
                    </div>

                    <!-- Audit Log Table -->
                    <div class="bg-white border border-slate-200 rounded-xl shadow-xs overflow-hidden">
                        @if(empty($filteredLogs))
                        <!-- Empty State -->
                        <div class="p-12 text-center fade-in-up">
                            <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-shield-halved text-3xl text-slate-300"></i>
                            </div>
                            <div class="text-sm font-bold text-slate-700 mb-1">Belum Ada Aktivitas Audit Log</div>
                            <p class="text-xs text-slate-400 max-w-sm mx-auto mb-5">
                                Seluruh konfigurasi sistem berjalan dalam kondisi bersih (*clean slate*). Catat konfigurasi baru atau lakukan perubahan untuk melihat jejak audit log.
                            </p>
                            <button onclick="openCatatLogModal()" class="inline-flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                                <i class="fa-solid fa-plus text-[10px]"></i>
                                <span>+ Catat Log Konfigurasi Pertama</span>
                            </button>
                        </div>
                        @else
                        <!-- Table Content -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs font-mono-code">
                                <thead>
                                    <tr class="bg-slate-50/70 border-b border-slate-200/80 text-[10px] text-slate-400 uppercase">
                                        <th class="py-2.5 px-4 font-bold">WAKTU & TANGGAL</th>
                                        <th class="py-2.5 px-3 font-bold">AKTOR / STAF</th>
                                        <th class="py-2.5 px-3 font-bold">MODUL & KATEGORI</th>
                                        <th class="py-2.5 px-4 font-bold">TINDAKAN / NILAI KONFIGURASI</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100" id="auditTableBody">
                                    @foreach($filteredLogs as $l)
                                    <tr class="hover:bg-slate-50/70 transition-colors log-row" data-level="{{ $l['level'] ?? 'INFO' }}">
                                        <td class="py-3 px-4 whitespace-nowrap text-slate-500">
                                            <div class="font-bold text-slate-700 text-xs">{{ $l['waktu'] }}</div>
                                            <div class="text-[10px] text-slate-400 mt-0.5">{{ $l['jam'] }}</div>
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            <div class="flex items-center gap-2.5 font-sans">
                                                <div class="w-7 h-7 rounded-lg bg-brand-700 text-white flex items-center justify-center font-display font-bold text-xs uppercase flex-shrink-0">
                                                    {{ substr($l['aktor'], 0, 2) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-slate-800 text-xs leading-snug">{{ $l['aktor'] }}</div>
                                                    <div class="text-[10px] text-slate-400 font-mono-code">{{ $l['role'] }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            <span class="px-2 py-0.5 rounded text-[10.5px] font-medium bg-slate-100 text-slate-700 border border-slate-200/80">
                                                {{ $l['modul'] }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-slate-700">
                                            <div class="text-xs leading-relaxed font-sans font-medium text-slate-800">
                                                {{ $l['tindakan'] }}
                                            </div>
                                            <div class="mt-1 flex items-center gap-2">
                                                <span class="px-1.5 py-0.2 rounded text-[9.5px] font-bold font-mono-code {{ ($l['level'] ?? 'INFO') === 'WARN' ? 'bg-amber-100 text-amber-700' : (($l['level'] ?? 'INFO') === 'CRIT' ? 'bg-rose-100 text-rose-700' : 'bg-sky-100 text-sky-700') }}">
                                                    {{ $l['level'] ?? 'INFO' }}
                                                </span>
                                                <span class="text-[10px] font-mono-code text-slate-400">{{ $l['id'] }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Table Footer / Pagination -->
                        <div class="px-4 py-3 border-t border-slate-100 bg-slate-50/60 flex items-center justify-between text-xs font-mono-code text-slate-500">
                            <div>
                                Menampilkan <strong class="text-slate-700">1 – {{ count($filteredLogs) }}</strong> dari <strong class="text-slate-700">{{ count($logs) }}</strong> aktivitas tercatat
                            </div>
                            <div class="flex items-center gap-1">
                                <button class="w-6 h-6 rounded border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-100"><i class="fa-solid fa-chevron-left text-[9px]"></i></button>
                                <button class="w-6 h-6 rounded bg-brand-700 text-white font-bold flex items-center justify-center text-xs">1</button>
                                <button class="w-6 h-6 rounded border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-slate-100"><i class="fa-solid fa-chevron-right text-[9px]"></i></button>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Bottom Chart: Distribusi Frekuensi Audit & Event Konfigurasi -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                                <i class="fa-solid fa-chart-area text-slate-400"></i>
                                <span>Distribusi Frekuensi Audit & Event Konfigurasi</span>
                            </h3>
                            <span class="text-[10px] font-mono-code text-slate-400">Frekuensi 24 Jam Terakhir</span>
                        </div>
                        <div class="h-24 w-full flex items-end gap-2 pt-4 px-2">
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-slate-200 rounded-t-sm" style="height: 15%;"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">00:00 WIB</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-slate-200 rounded-t-sm" style="height: 10%;"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">03:00 WIB</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-brand-700 rounded-t-sm" style="height: {{ count($logs) > 0 ? '70%' : '15%' }};"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">06:00 WIB</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-slate-200 rounded-t-sm" style="height: 12%;"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">09:00 WIB</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-brand-600 rounded-t-sm" style="height: {{ count($logs) > 0 ? '55%' : '15%' }};"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">12:00 WIB</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-brand-700 rounded-t-sm" style="height: {{ count($logs) > 0 ? '85%' : '15%' }};"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">15:00 WIB</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-brand-600 rounded-t-sm" style="height: {{ count($logs) > 0 ? '60%' : '15%' }};"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">18:00 WIB</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-end h-full">
                                <div class="w-full bg-slate-200 rounded-t-sm" style="height: 20%;"></div>
                                <span class="text-[9px] font-mono-code text-slate-400 mt-1">Sekarang</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right (1 Col): Security, Peripherals & Compliance Exports -->
                <div class="space-y-4">

                    <!-- 1. Kepatuhan Keamanan Panel -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <h3 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-shield-halved text-brand-700"></i>
                                <span>Kepatuhan Keamanan</span>
                            </h3>
                            <span class="px-2 py-0.5 rounded text-[10px] font-mono-code font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                STATUS: OPTIMAL
                            </span>
                        </div>

                        <div class="space-y-3 mt-3">
                            <!-- Breach Status -->
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg">
                                <div class="flex items-center justify-between text-xs font-bold text-slate-800">
                                    <span>0 Insiden Kebocoran Data</span>
                                    <span class="text-[10px] font-mono-code text-emerald-600 bg-emerald-50 px-1 rounded">0 Breach</span>
                                </div>
                                <p class="text-[10.5px] text-slate-400 mt-1">
                                    Enkripsi TLS 1.3 dan hashing credential Argon2id valid tanpa percobaan brute-force.
                                </p>
                            </div>

                            <!-- New IP Warning -->
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg">
                                <div class="flex items-center justify-between text-xs font-bold text-slate-800">
                                    <span>2 Peringatan IP Baru</span>
                                    <span class="text-[10px] font-mono-code text-sky-600 bg-sky-50 px-1 rounded">2FA Passed</span>
                                </div>
                                <p class="text-[10.5px] text-slate-400 mt-1">
                                    Akses login dari IP eksternal (Telkomsel Dynamic IP) berhasil diotentikasi dengan WhatsApp OTP 6 digit.
                                </p>
                            </div>

                            <!-- WhatsApp Quota -->
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg">
                                <div class="flex items-center justify-between text-xs font-bold text-slate-800">
                                    <span>Kuota WhatsApp: 94.2%</span>
                                    <span class="text-[10px] font-mono-code text-emerald-600 bg-emerald-50 px-1 rounded">Auto Top-up OK</span>
                                </div>
                                <p class="text-[10.5px] text-slate-400 mt-1">
                                    Sisa 888 pesan — trigger isi ulang otomatis siap di Rp 250k balance.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Periferal & Lab Node Panel -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <h3 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-network-wired text-slate-500"></i>
                                <span>Periferal & Lab Node</span>
                            </h3>
                            <button onclick="toastMsg('Menyegarkan status periferal hardware...')" class="text-slate-400 hover:text-slate-600 text-xs">
                                <i class="fa-solid fa-rotate"></i>
                            </button>
                        </div>

                        <div class="space-y-2.5 mt-3 text-xs font-mono-code">
                            <!-- Printer -->
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800">Epson TM-T82X (Kasir POS)</span>
                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-1 rounded">99.8% Uptime</span>
                                </div>
                                <div class="flex justify-between items-center text-[10px] text-slate-400 mt-1">
                                    <span>Cetak: 1.420 Struk</span>
                                    <span class="text-emerald-600">0 Paper Jam</span>
                                </div>
                            </div>

                            <!-- Barcode Scanner -->
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800">Zebra DS2208 2D Imager</span>
                                    <span class="text-[10px] font-bold text-sky-600 bg-sky-50 px-1 rounded">Ready / USB</span>
                                </div>
                                <div class="flex justify-between items-center text-[10px] text-slate-400 mt-1">
                                    <span>Total Decode: 3.210 Part</span>
                                    <span>Error Rate: 0.00%</span>
                                </div>
                            </div>

                            <!-- Bench DC -->
                            <div class="p-2.5 bg-slate-50 border border-slate-200 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800">Bench DC Telemetry (Lab #01)</span>
                                    <span class="text-[10px] font-bold text-brand-700 bg-brand-50 px-1 rounded">Stabil 12ms</span>
                                </div>
                                <div class="flex justify-between items-center text-[10px] text-slate-400 mt-1">
                                    <span>Rail 12V / 5V / 3.3V Kalibrasi</span>
                                    <span class="text-emerald-600">▲ 0.02V Drift</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Ekspor Berkas Kepatuhan Panel -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <h3 class="text-xs font-bold text-slate-900 flex items-center gap-1.5">
                                <i class="fa-solid fa-box-archive text-slate-500"></i>
                                <span>Ekspor Berkas Kepatuhan</span>
                            </h3>
                            <span class="text-[10px] font-mono-code text-slate-400">FEBRUARI 2025</span>
                        </div>

                        <div class="space-y-2 mt-3 text-xs">
                            <div class="p-2 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-file-pdf text-rose-500 text-sm"></i>
                                    <div>
                                        <div class="font-bold text-slate-800 text-[11.5px]">Audit SLA & Garansi Bengkel</div>
                                        <div class="text-[9.5px] font-mono-code text-slate-400">PDF • 4.2 MB • Resmi TTD Digital</div>
                                    </div>
                                </div>
                                <button onclick="toastMsg('Mengunduh berkas Audit SLA & Garansi...')" class="w-7 h-7 rounded border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-white"><i class="fa-solid fa-download text-xs"></i></button>
                            </div>

                            <div class="p-2 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i>
                                    <div>
                                        <div class="font-bold text-slate-800 text-[11.5px]">Log Revisi Harga & Stok Sparepart</div>
                                        <div class="text-[9.5px] font-mono-code text-slate-400">XLSX • 8.1 MB • Raw Data Format</div>
                                    </div>
                                </div>
                                <button onclick="toastMsg('Mengunduh Log Revisi Harga & Stok...')" class="w-7 h-7 rounded border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-white"><i class="fa-solid fa-download text-xs"></i></button>
                            </div>

                            <div class="p-2 bg-slate-50 border border-slate-200 rounded-lg flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-file-shield text-brand-700 text-sm"></i>
                                    <div>
                                        <div class="font-bold text-slate-800 text-[11.5px]">Hak Akses Role & Privilege Matrix</div>
                                        <div class="text-[9.5px] font-mono-code text-slate-400">PDF • 1.8 MB • ISO Compliance</div>
                                    </div>
                                </div>
                                <button onclick="toastMsg('Mengunduh Privilege Matrix...')" class="w-7 h-7 rounded border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-white"><i class="fa-solid fa-download text-xs"></i></button>
                            </div>
                        </div>

                        <div class="mt-3 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] font-mono-code text-slate-400">
                            <span>Archive Retention: 7 Tahun Cloud</span>
                            <button onclick="toastMsg('Membuka arsip kepatuhan lama...')" class="text-brand-700 hover:underline font-bold">Lihat Arsip Lama →</button>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- MODAL: CATAT LOG KONFIGURASI / AUDIT BARU                 -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <div id="catatLogModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm" role="dialog" aria-modal="true">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-display font-extrabold text-slate-900">Catat Log Pengaturan Sistem</h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Entri aktivitas audit, perubahan kebijakan bengkel, atau telemetri hardware</p>
                </div>
                <button onclick="closeCatatLogModal()" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form action="{{ route('techfix.pengaturan.log.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-3.5 max-h-[70vh] overflow-y-auto">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Aktor / Staf <span class="text-rose-500">*</span></label>
                            <input type="text" name="aktor" placeholder="Contoh: Rian Pratama / Hendra Wijaya" required
                                class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Role / Jabatan</label>
                            <input type="text" name="role" placeholder="Chief Admin / Senior Tech / Cron"
                                class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Modul Pengaturan <span class="text-rose-500">*</span></label>
                            <input type="text" name="modul" placeholder="Contoh: Kebijakan Garansi / WA Gateway" required
                                class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Kategori Audit</label>
                            <select name="kategori_key" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-white">
                                <option value="kebijakan">Perubahan Kebijakan & SLA</option>
                                <option value="auth">Log Autentikasi & Staf</option>
                                <option value="telemetri">Telemetri Hardware & Printer</option>
                                <option value="whatsapp">WhatsApp Gateway API</option>
                                <option value="backup">Backup & Storage</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Tingkat / Level Log</label>
                        <select name="level" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-white font-mono-code">
                            <option value="INFO">INFO — Operasional Normal / Perubahan Terencana</option>
                            <option value="WARN">WARN — Peringatan Konfigurasi / Threshold</option>
                            <option value="CRIT">CRIT — Perubahan Kritis / Security Override</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Tindakan / Nilai Konfigurasi <span class="text-rose-500">*</span></label>
                        <textarea name="tindakan" rows="3" placeholder="Contoh: Mengubah SLA garansi mikrosolder dari 45 Hari ke 60 Hari..." required
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 resize-none"></textarea>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-2 bg-slate-50/60">
                    <button type="button" onclick="closeCatatLogModal()" class="px-4 py-2 text-xs font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-5 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm">
                        <i class="fa-solid fa-check text-[10px]"></i>
                        Simpan Log Audit
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

        // Modal
        function openCatatLogModal() {
            const m = document.getElementById('catatLogModal');
            if (m) { m.classList.remove('hidden'); m.classList.add('flex'); }
        }
        function closeCatatLogModal() {
            const m = document.getElementById('catatLogModal');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }

        // Level Filter
        function filterLogLevel(level) {
            document.querySelectorAll('.log-row').forEach(row => {
                const rowLevel = row.getAttribute('data-level');
                if (level === 'ALL' || rowLevel === level) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
            toastMsg(`Menyaring tingkat log: ${level}`);
        }

        // Search in Table
        document.getElementById('logSearchInput')?.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            document.querySelectorAll('.log-row').forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(term) ? '' : 'none';
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeCatatLogModal();
            if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                e.preventDefault();
                document.getElementById('globalSearchInput')?.focus();
            }
        });
    </script>
</body>
</html>
