<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFix Pro — CRM Pelanggan & Riwayat Unit</title>
    <meta name="description" content="TechFix Pro - Sistem CRM Pelanggan & Riwayat Siklus Unit Servis">
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
        .customer-card { transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .customer-card:hover { transform: translateY(-1px); box-shadow: 0 8px 20px -4px rgba(15,23,42,0.08); }
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
            <a href="{{ route('techfix.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-ticket-simple text-sm text-slate-400"></i><span>Tiket & Workbench</span>
            </a>
            <a href="{{ route('techfix.tracking') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-regular fa-comment-dots text-sm text-slate-400"></i><span>Tracking & Approval WA</span>
            </a>
            <a href="{{ route('techfix.kasir') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-cash-register text-sm text-slate-400"></i><span>Kasir POS & Garansi</span>
            </a>
            <a href="{{ route('techfix.stok') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-boxes-stacked text-sm text-slate-400"></i><span>Stok Sparepart & Inv</span>
            </a>
            <!-- CRM ACTIVE -->
            <a href="{{ route('techfix.crm') }}" class="nav-item-active flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-xs transition-all shadow-sm">
                <i class="fa-solid fa-user-gear text-sm"></i><span>CRM & Riwayat Unit</span>
            </a>
            <a href="{{ route('techfix.laporan') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-chart-line text-sm text-slate-400"></i><span>Laporan & Keuangan</span>
            </a>
            <a href="{{ route('techfix.pengaturan') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <i class="fa-solid fa-gear text-sm text-slate-400"></i><span>Pengaturan Sistem</span>
            </a>
        </nav>

        <!-- Sidebar Bottom -->
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
                            <span>{{ $currentBranch ?? 'Cabang Utama' }}</span>
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

            <!-- Right -->
            <div class="flex items-center gap-3">
                <div class="relative w-64 hidden md:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="globalSearchInput" placeholder="Cari pelanggan, SN unit, model..."
                        class="w-full pl-8 pr-16 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder:text-slate-400">
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
                <button onclick="openAddCustomerModal()" class="flex items-center gap-2 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all hover:shadow active:scale-[0.98]">
                    <i class="fa-solid fa-user-plus text-[11px]"></i>
                    <span>Tambah Pelanggan Baru</span>
                </button>
                <div class="relative">
                    <button onclick="toastMsg('Notifikasi sistem CRM.')" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="fa-regular fa-bell text-xs"></i>
                    </button>
                </div>
                <div class="flex items-center gap-2.5 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="hidden sm:block text-left">
                        <div class="text-xs font-bold text-slate-800 leading-tight">{{ $user->name ?? 'Admin' }}</div>
                        <div class="text-[10px] font-medium text-slate-400">Chief Tech & Admin</div>
                    </div>
                    <div class="relative group">
                        <button class="p-1 text-slate-400 hover:text-slate-600">
                            <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 hidden group-hover:block z-50 text-xs">
                            <a href="{{ route('techfix.crm.reset') }}" class="flex items-center gap-2 px-3 py-1.5 text-slate-700 hover:bg-slate-50">
                                <i class="fa-solid fa-eraser text-slate-400"></i> Kosongkan Data CRM
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
            <div id="flashAlert" class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-xl text-xs flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('flashAlert').remove()" class="text-emerald-500 hover:text-emerald-700"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif

            @if(session('error'))
            <div id="flashError" class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-2.5 rounded-xl text-xs flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation text-rose-600 text-sm"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="document.getElementById('flashError').remove()" class="text-rose-500 hover:text-rose-700"><i class="fa-solid fa-xmark"></i></button>
            </div>
            @endif

            <!-- ── 1. Page Header ──────────────────────────────────────── -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-mono-code font-medium text-slate-400 flex items-center gap-1.5">
                        <span>Database Pelanggan</span>
                        <i class="fa-solid fa-chevron-right text-[8px]"></i>
                        <span class="text-slate-600">CRM & Riwayat Siklus Unit Servis</span>
                    </div>
                    <div class="flex items-center gap-3 mt-1">
                        <h1 class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            CRM Pelanggan & Riwayat Siklus Unit Servis
                        </h1>
                        <span class="inline-flex items-center gap-1.5 bg-violet-50 text-violet-700 border border-violet-200/80 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full {{ count($customers) > 0 ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                            <span>{{ count($customers) }} Pelanggan Terdaftar</span>
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-1 max-w-2xl">
                        Manajemen profil pelanggan untuk korporat, distributor, maupun pelanggan personal. Kelola LTV, riwayat servis, dan informasi broadcast pemeliharaan berkala.
                    </p>
                </div>
                <div class="flex items-center gap-2 flex-wrap flex-shrink-0">
                    <a href="{{ route('techfix.crm.reset') }}" onclick="return confirm('Kosongkan semua data pelanggan CRM?');" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-eraser text-slate-400"></i>
                        <span>Kosongkan Data</span>
                    </a>
                    <button onclick="toastMsg('Fitur ekspor data CRM (CSV/Excel) segera aktif!')" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-file-arrow-down text-slate-500"></i>
                        <span>Export Data</span>
                    </button>
                    <button onclick="openAddCustomerModal()" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                        <i class="fa-solid fa-user-plus text-[10px]"></i>
                        <span>Tambah Pelanggan Baru</span>
                    </button>
                </div>
            </div>

            <!-- ── 2. Stats Row ────────────────────────────────────────── -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3.5">
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>TOTAL PELANGGAN</span><i class="fa-solid fa-users text-slate-300 text-xs"></i>
                    </div>
                    <div class="text-2xl font-display font-extrabold text-slate-800 leading-none">
                        {{ $statsCrm['total_pelanggan'] > 0 ? $statsCrm['total_pelanggan'] : '0' }}
                    </div>
                    <div class="text-[10px] text-slate-400 mt-1">
                        {{ $statsCrm['total_pelanggan'] > 0 ? 'Pelanggan aktif' : 'Belum ada data' }}
                    </div>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>UNIT DITANGANI</span><i class="fa-solid fa-laptop text-slate-300 text-xs"></i>
                    </div>
                    <div class="text-2xl font-display font-extrabold text-slate-800 leading-none">
                        {{ $statsCrm['unit_ditangani'] > 0 ? $statsCrm['unit_ditangani'] : '0' }}
                    </div>
                    <div class="text-[10px] text-slate-400 mt-1">
                        {{ $statsCrm['unit_ditangani'] > 0 ? 'Unit hardware armada' : 'Belum ada data' }}
                    </div>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>REPEAT SERVICE</span><i class="fa-solid fa-rotate text-slate-300 text-xs"></i>
                    </div>
                    <div class="text-2xl font-display font-extrabold text-slate-800 leading-none">
                        {{ $statsCrm['repeat_rate'] }}%
                    </div>
                    <div class="text-[10px] text-slate-400 mt-1">
                        {{ $statsCrm['repeat_rate'] > 0 ? 'Rasio servis berulang' : 'Belum ada data' }}
                    </div>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>LTV RATA-RATA</span><i class="fa-solid fa-coins text-slate-300 text-xs"></i>
                    </div>
                    <div class="text-xl font-display font-extrabold text-slate-800 leading-none">
                        {{ $statsCrm['avg_ltv'] }}
                    </div>
                    <div class="text-[10px] text-slate-400 mt-1">Lifetime value klien</div>
                </div>
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>JADWAL MAINTENANCE</span><i class="fa-solid fa-calendar-check text-slate-300 text-xs"></i>
                    </div>
                    <div class="text-2xl font-display font-extrabold text-slate-800 leading-none">
                        {{ $statsCrm['jadwal_maintenance'] }}
                    </div>
                    <div class="text-[10px] text-slate-400 mt-1">Pengingat berkala</div>
                </div>
            </div>

            <!-- ── 3. Filter Bar ──────────────────────────────────────── -->
            <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs flex flex-wrap items-center gap-2.5">
                <div class="relative flex-1 min-w-48">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="crmSearchInput" placeholder="Cari nama, HP, perusahaan, merk unit..."
                        class="w-full pl-8 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder:text-slate-400">
                </div>
                <div class="flex items-center gap-1.5 ml-auto text-[11px]">
                    <span class="text-slate-400 font-mono-code text-[10px]">Filter Tipe:</span>
                    <button onclick="filterType('all')" id="btnFilterAll" class="px-2.5 py-1 rounded-full bg-brand-700 text-white text-[10.5px] font-semibold transition-colors">Semua</button>
                    <button onclick="filterType('personal')" id="btnFilterPersonal" class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 text-[10.5px] font-medium transition-colors">Personal</button>
                    <button onclick="filterType('korporat')" id="btnFilterKorporat" class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 text-[10.5px] font-medium transition-colors">Korporat</button>
                    <button onclick="filterType('distributor')" id="btnFilterDistributor" class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 text-[10.5px] font-medium transition-colors">Distributor</button>
                </div>
            </div>

            <!-- ── 4. Split Layout ────────────────────────────────────── -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">

                <!-- Left: Customer Directory -->
                <div class="lg:col-span-2 space-y-3">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider font-mono-code">
                            DIREKTORI PELANGGAN <span class="text-slate-400 normal-case">({{ count($customers) }} Terdaftar)</span>
                        </h2>
                    </div>

                    @if(empty($customers))
                    <!-- Empty State -->
                    <div class="bg-white border border-dashed border-slate-300 rounded-xl p-10 text-center fade-in-up">
                        <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-users text-3xl text-slate-300"></i>
                        </div>
                        <div class="text-sm font-bold text-slate-600 mb-1">Belum Ada Pelanggan</div>
                        <p class="text-xs text-slate-400 mb-5 max-w-xs mx-auto">
                            Database pelanggan masih kosong. Tambahkan pelanggan pertama untuk mulai mengelola riwayat servis & armada unit.
                        </p>
                        <button onclick="openAddCustomerModal()" class="inline-flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-4 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm">
                            <i class="fa-solid fa-user-plus text-[11px]"></i>
                            Tambah Pelanggan Pertama
                        </button>
                    </div>
                    @else
                    <!-- Customer Cards List -->
                    <div class="space-y-2.5 max-h-[calc(100vh-320px)] overflow-y-auto pr-1">
                        @foreach($customers as $c)
                        @php
                            $isSelected = $selectedCustomer && $selectedCustomer['id'] === $c['id'];
                            $unitCount  = count($c['units'] ?? []);
                        @endphp
                        <a href="{{ route('techfix.crm', ['customer_id' => $c['id']]) }}"
                           class="customer-card block p-3.5 rounded-xl border {{ $isSelected ? 'bg-sky-50/70 border-sky-400 shadow-sm ring-1 ring-sky-300' : 'bg-white border-slate-200 hover:border-slate-300' }} transition-all"
                           data-type="{{ $c['tipe'] ?? 'personal' }}"
                           data-name="{{ strtolower($c['nama']) }}"
                           data-hp="{{ $c['hp'] }}"
                           data-company="{{ strtolower($c['perusahaan'] ?? '') }}">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-9 h-9 rounded-xl {{ $isSelected ? 'bg-brand-700 text-white' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center text-xs font-bold font-display uppercase flex-shrink-0">
                                        {{ substr($c['nama'], 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800 leading-snug">{{ $c['nama'] }}</div>
                                        <div class="text-[11px] font-mono-code text-slate-500">{{ $c['hp'] }}</div>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-semibold font-mono-code uppercase {{ ($c['tipe'] ?? '') === 'korporat' ? 'bg-violet-100 text-violet-700' : (($c['tipe'] ?? '') === 'distributor' ? 'bg-amber-100 text-amber-700' : 'bg-slate-100 text-slate-600') }}">
                                    {{ $c['tipe'] ?? 'personal' }}
                                </span>
                            </div>

                            <div class="mt-2.5 pt-2 border-t {{ $isSelected ? 'border-sky-200/60' : 'border-slate-100' }} flex items-center justify-between text-[11px] text-slate-500">
                                <span class="flex items-center gap-1 font-mono-code">
                                    <i class="fa-solid fa-laptop text-[10px] text-slate-400"></i>
                                    <strong>{{ $unitCount }}</strong> unit
                                </span>
                                <span class="text-slate-400">|</span>
                                <span class="font-mono-code text-slate-600">
                                    LTV: <strong>Rp {{ number_format($c['total_spent'] ?? 0, 0, ',', '.') }}</strong>
                                </span>
                                <span class="text-slate-400">|</span>
                                <span class="font-mono-code text-[10px] text-slate-400">{{ $c['id'] }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Right: Detail Panel -->
                <div class="lg:col-span-3 space-y-4">

                    @if(!$selectedCustomer)
                    <!-- Profil Detail: Empty State -->
                    <div class="bg-white border border-dashed border-slate-300 rounded-xl p-10 text-center fade-in-up">
                        <div class="w-16 h-16 rounded-2xl bg-violet-50 flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-user-gear text-3xl text-violet-300"></i>
                        </div>
                        <div class="text-sm font-bold text-slate-600 mb-1">Pilih Pelanggan</div>
                        <p class="text-xs text-slate-400 max-w-xs mx-auto">
                            Klik salah satu pelanggan di direktori kiri untuk melihat profil lengkap, riwayat servis, armada unit, dan kronologi tiket.
                        </p>
                    </div>
                    @else
                    <!-- Profil Detail Card -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs fade-in-up">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-700 to-sky-600 text-white flex items-center justify-center font-display font-bold text-sm shadow-xs uppercase">
                                    {{ substr($selectedCustomer['nama'], 0, 2) }}
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-sm font-bold text-slate-900">{{ $selectedCustomer['nama'] }}</h3>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-mono-code font-bold uppercase {{ ($selectedCustomer['tipe'] ?? '') === 'korporat' ? 'bg-violet-100 text-violet-700' : 'bg-slate-100 text-slate-600' }}">
                                            {{ $selectedCustomer['tipe'] ?? 'personal' }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] font-mono-code text-slate-400 mt-0.5 flex items-center gap-2">
                                        <span>ID: <strong>{{ $selectedCustomer['id'] }}</strong></span>
                                        <span>•</span>
                                        <span>Terdaftar: {{ $selectedCustomer['tgl_daftar'] ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @php
                                    $rawHp = preg_replace('/[^0-9]/', '', $selectedCustomer['hp'] ?? '');
                                    if(str_starts_with($rawHp, '0')) {
                                        $rawHp = '62' . substr($rawHp, 1);
                                    }
                                @endphp
                                <a href="https://wa.me/{{ $rawHp }}?text=Halo%20{{ urlencode($selectedCustomer['nama']) }}%2C%20kami%20dari%20TechFix%20Pro..." target="_blank"
                                   class="flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-xs">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>Chat WhatsApp</span>
                                </a>
                                <button onclick="openAddUnitModal()" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-xs">
                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                    <span>+ Tambah Unit</span>
                                </button>
                            </div>
                        </div>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3 text-xs">
                            <div class="p-2.5 bg-slate-50 rounded-lg">
                                <span class="text-[10px] font-mono-code text-slate-400 uppercase block">No. WhatsApp</span>
                                <span class="font-bold text-slate-700 font-mono-code">{{ $selectedCustomer['hp'] }}</span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded-lg">
                                <span class="text-[10px] font-mono-code text-slate-400 uppercase block">Email</span>
                                <span class="font-medium text-slate-700 truncate block">{{ $selectedCustomer['email'] ?? '-' }}</span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded-lg">
                                <span class="text-[10px] font-mono-code text-slate-400 uppercase block">Perusahaan</span>
                                <span class="font-medium text-slate-700 truncate block">{{ $selectedCustomer['perusahaan'] ?? '-' }}</span>
                            </div>
                            <div class="p-2.5 bg-slate-50 rounded-lg">
                                <span class="text-[10px] font-mono-code text-slate-400 uppercase block">Term Pembayaran</span>
                                <span class="font-bold text-slate-700 uppercase font-mono-code">{{ $selectedCustomer['term'] ?? 'cash' }}</span>
                            </div>
                        </div>
                        <div class="mt-2 text-xs text-slate-500 bg-slate-50/60 p-2.5 rounded-lg flex items-start gap-2">
                            <i class="fa-solid fa-location-dot text-slate-400 text-xs mt-0.5"></i>
                            <div>
                                <span class="text-[10px] font-mono-code text-slate-400 uppercase block">Alamat / Catatan:</span>
                                <span>{{ $selectedCustomer['alamat'] ?? '-' }}</span>
                                @if(!empty($selectedCustomer['catatan']) && $selectedCustomer['catatan'] !== '-')
                                    <span class="text-slate-400"> | Catatan: {{ $selectedCustomer['catatan'] }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Armada Unit -->
                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-xs">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-bold text-slate-700 flex items-center gap-2">
                                <i class="fa-solid fa-laptop text-slate-400"></i>
                                Status Kesehatan Armada Unit
                            </h3>
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-mono-code text-slate-400">{{ count($selectedCustomer['units'] ?? []) }} Unit Terdaftar</span>
                                <button onclick="openAddUnitModal()" class="text-sky-600 hover:text-sky-700 text-xs font-bold">
                                    + Tambah
                                </button>
                            </div>
                        </div>

                        @if(empty($selectedCustomer['units']))
                        <div class="p-8 text-center">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-laptop-code text-xl text-slate-300"></i>
                            </div>
                            <p class="text-xs text-slate-400 mb-3">Belum ada unit terdaftar pada klien ini.</p>
                            <button onclick="openAddUnitModal()" class="inline-flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors">
                                <i class="fa-solid fa-plus text-[10px]"></i> Tambah Unit Pertama
                            </button>
                        </div>
                        @else
                        <div class="divide-y divide-slate-100">
                            @foreach($selectedCustomer['units'] as $u)
                            <div class="p-3.5 flex items-center justify-between hover:bg-slate-50/60 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-laptop"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">{{ $u['brand'] }} {{ $u['model'] }}</div>
                                        <div class="text-[10px] font-mono-code text-slate-400">S/N: <span class="text-slate-600 font-bold">{{ $u['sn'] }}</span> • Masuk: {{ $u['tgl_masuk'] ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-semibold font-mono-code uppercase {{ ($u['kondisi'] ?? '') === 'baik' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200' }}">
                                        {{ str_replace('_', ' ', $u['kondisi'] ?? 'normal') }}
                                    </span>
                                    <a href="{{ route('techfix.dashboard') }}" class="text-xs font-semibold text-brand-700 hover:underline px-2 py-1 bg-brand-50 rounded">
                                        Buat Tiket
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Kronologi Servis -->
                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-xs">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-bold text-slate-700 flex items-center gap-2">
                                <i class="fa-solid fa-timeline text-slate-400"></i>
                                Kronologi Siklus Servis & Klaim Garansi
                            </h3>
                            <span class="text-[10px] font-mono-code text-slate-400">{{ count($selectedCustomer['riwayat_servis'] ?? []) }} Riwayat</span>
                        </div>

                        @if(empty($selectedCustomer['riwayat_servis']))
                        <div class="p-8 text-center">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-clock-rotate-left text-xl text-slate-300"></i>
                            </div>
                            <p class="text-xs text-slate-400">Belum ada riwayat perbaikan tiket untuk pelanggan ini.</p>
                        </div>
                        @else
                        <div class="divide-y divide-slate-100">
                            @foreach($selectedCustomer['riwayat_servis'] as $r)
                            <div class="p-3.5 flex items-center justify-between hover:bg-slate-50/60 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-wrench"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">{{ $r['tiket_id'] }} — {{ $r['unit'] }}</div>
                                        <div class="text-[10px] text-slate-500">{{ $r['keluhan'] }} • <span class="font-mono-code text-slate-400">{{ $r['tanggal'] }}</span></div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs font-bold font-mono-code text-slate-800">Rp {{ number_format($r['biaya'] ?? 0, 0, ',', '.') }}</div>
                                    <span class="text-[10px] font-mono-code text-emerald-600 font-bold uppercase">{{ $r['status'] }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Pengingat Maintenance -->
                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-xs">
                        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-xs font-bold text-slate-700 flex items-center gap-2">
                                <i class="fa-solid fa-bell text-slate-400"></i>
                                Pengingat Jadwal Maintenance Berkala (Fleet Kantor)
                            </h3>
                            <span class="text-[10px] bg-amber-50 text-amber-600 border border-amber-200 px-2 py-0.5 rounded font-mono-code font-bold">
                                Trigger: WhatsApp
                            </span>
                        </div>
                        <div class="p-4 flex flex-col sm:flex-row items-center justify-between gap-3 bg-amber-50/30">
                            <div>
                                <div class="text-xs font-bold text-slate-800">
                                    {{ !empty($selectedCustomer['jadwal_maintenance']) ? 'Jadwal Servis Berkala: ' . $selectedCustomer['jadwal_maintenance'] : 'Maintenance berkala belum dijadwalkan' }}
                                </div>
                                <p class="text-[11px] text-slate-500 mt-0.5">
                                    Kirim notifikasi otomatis pengingat ganti thermal paste, cleaning fan, dan pembersihan laptop armada kantor.
                                </p>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <a href="https://wa.me/{{ $rawHp }}?text=Halo%20Bapak%2FIbu%20{{ urlencode($selectedCustomer['nama']) }}%2C%20ini%20pengingat%20jadwal%20maintenance%20rutin%20unit%20dari%20TechFix%20Pro." target="_blank"
                                   class="flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-xs">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    Kirim WA Pengingat
                                </a>
                                <a href="{{ route('techfix.dashboard') }}" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors shadow-xs">
                                    <i class="fa-solid fa-file-medical"></i>
                                    Buat Tiket Servis
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </main>
    </div>

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- MODAL: TAMBAH PELANGGAN BARU                              -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <div id="addCustomerModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm" role="dialog" aria-modal="true" aria-labelledby="modalCustomerTitle">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden">

            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 id="modalCustomerTitle" class="text-base font-display font-extrabold text-slate-900">Tambah Pelanggan Baru</h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Isi data profil pelanggan & unit awal yang akan ditangani</p>
                </div>
                <button onclick="closeAddCustomerModal()" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <!-- Modal Body Form -->
            <form action="{{ route('techfix.crm.store') }}" method="POST">
                @csrf
                <div class="p-6 overflow-y-auto max-h-[70vh]">
                    <!-- Bagian: Data Pelanggan -->
                    <div class="mb-5">
                        <div class="text-[10px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-user text-slate-300"></i> DATA PELANGGAN
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2">
                                <label for="inputNama" class="block text-xs font-semibold text-slate-600 mb-1">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <input type="text" id="inputNama" name="nama" placeholder="Contoh: PT Surya Informatika / Bapak Hendra" required
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all">
                            </div>
                            <div>
                                <label for="inputHp" class="block text-xs font-semibold text-slate-600 mb-1">Nomor HP / WhatsApp <span class="text-rose-500">*</span></label>
                                <input type="text" id="inputHp" name="hp" placeholder="Contoh: 081234567890" required
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all">
                            </div>
                            <div>
                                <label for="inputEmail" class="block text-xs font-semibold text-slate-600 mb-1">Alamat Email</label>
                                <input type="email" id="inputEmail" name="email" placeholder="email@perusahaan.com"
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all">
                            </div>
                            <div>
                                <label for="inputTipe" class="block text-xs font-semibold text-slate-600 mb-1">Tipe Pelanggan</label>
                                <select id="inputTipe" name="tipe" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 transition-all bg-white">
                                    <option value="personal">Personal</option>
                                    <option value="korporat">Korporat / Kantor</option>
                                    <option value="distributor">Distributor / Toko</option>
                                    <option value="instansi">Instansi Pemerintah</option>
                                </select>
                            </div>
                            <div>
                                <label for="inputPerusahaan" class="block text-xs font-semibold text-slate-600 mb-1">Nama Perusahaan / Instansi</label>
                                <input type="text" id="inputPerusahaan" name="perusahaan" placeholder="Kosongkan jika personal"
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all">
                            </div>
                            <div class="col-span-2">
                                <label for="inputAlamat" class="block text-xs font-semibold text-slate-600 mb-1">Alamat Lengkap</label>
                                <input type="text" id="inputAlamat" name="alamat" placeholder="Gedung / Jalan, Kota, Provinsi"
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all">
                            </div>
                            <div>
                                <label for="inputPembayaran" class="block text-xs font-semibold text-slate-600 mb-1">Metode Pembayaran Favorit</label>
                                <select id="inputPembayaran" name="pembayaran" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 transition-all bg-white">
                                    <option value="cash">Cash / Tunai</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="qris">QRIS</option>
                                    <option value="invoice">Invoice / Termin</option>
                                </select>
                            </div>
                            <div>
                                <label for="inputTerm" class="block text-xs font-semibold text-slate-600 mb-1">Term Pembayaran</label>
                                <select id="inputTerm" name="term" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 transition-all bg-white">
                                    <option value="cash">Cash Langsung</option>
                                    <option value="net14">Net 14 Hari</option>
                                    <option value="net30">Net 30 Hari</option>
                                    <option value="net60">Net 60 Hari</option>
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="inputCatatan" class="block text-xs font-semibold text-slate-600 mb-1">Catatan Khusus</label>
                                <textarea id="inputCatatan" name="catatan" rows="2" placeholder="Catatan preferensi servis, PIC, dll..."
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all resize-none"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian: Unit Pertama -->
                    <div class="border-t border-slate-100 pt-5">
                        <div class="text-[10px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-laptop text-slate-300"></i> UNIT PERTAMA (OPSIONAL)
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="inputBrand" class="block text-xs font-semibold text-slate-600 mb-1">Merk / Brand</label>
                                <input type="text" id="inputBrand" name="brand" placeholder="Contoh: Lenovo, ASUS, Apple, Dell"
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all">
                            </div>
                            <div>
                                <label for="inputModel" class="block text-xs font-semibold text-slate-600 mb-1">Model / Tipe Unit</label>
                                <input type="text" id="inputModel" name="model" placeholder="Contoh: ThinkPad X1 Carbon Gen 9"
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all">
                            </div>
                            <div>
                                <label for="inputSN" class="block text-xs font-semibold text-slate-600 mb-1">Serial Number (S/N)</label>
                                <input type="text" id="inputSN" name="sn" placeholder="Nomor S/N unit..."
                                    class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all font-mono-code">
                            </div>
                            <div>
                                <label for="inputKondisi" class="block text-xs font-semibold text-slate-600 mb-1">Kondisi Saat Ini</label>
                                <select id="inputKondisi" name="kondisi" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 transition-all bg-white">
                                    <option value="baik">Baik / Normal</option>
                                    <option value="perlu_servis">Perlu Servis</option>
                                    <option value="rusak_berat">Rusak Berat</option>
                                    <option value="dalam_garansi">Dalam Garansi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-2 bg-slate-50/60">
                    <button type="button" onclick="closeAddCustomerModal()" class="px-4 py-2 text-xs font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-5 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm">
                        <i class="fa-solid fa-user-plus text-[10px]"></i>
                        Simpan Pelanggan Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════════════ -->
    <!-- MODAL: TAMBAH UNIT BARU KE PELANGGAN AKTIF                -->
    <!-- ═══════════════════════════════════════════════════════════ -->
    <div id="addUnitModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/60 backdrop-blur-sm" role="dialog" aria-modal="true">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-display font-extrabold text-slate-900">Tambah Unit Armada</h2>
                    <p class="text-[11px] text-slate-400 mt-0.5">Daftarkan unit ke klien: <strong>{{ $selectedCustomer['nama'] ?? 'Pelanggan' }}</strong></p>
                </div>
                <button onclick="closeAddUnitModal()" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <form action="{{ route('techfix.crm.unit.store') }}" method="POST">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $selectedCustomer['id'] ?? '' }}">
                <div class="p-6 space-y-3.5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Merk / Brand <span class="text-rose-500">*</span></label>
                        <input type="text" name="brand" placeholder="Contoh: ASUS, Lenovo, Apple, HP" required
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Model / Tipe Unit <span class="text-rose-500">*</span></label>
                        <input type="text" name="model" placeholder="Contoh: ROG Zephyrus G14, MacBook Pro M2" required
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Serial Number (S/N)</label>
                        <input type="text" name="sn" placeholder="Nomor seri unit..."
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 font-mono-code">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1">Kondisi Saat Ini</label>
                        <select name="kondisi" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-white">
                            <option value="baik">Baik / Normal</option>
                            <option value="perlu_servis">Perlu Servis / Rusak</option>
                            <option value="dalam_garansi">Dalam Masa Garansi</option>
                        </select>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-slate-100 flex items-center justify-end gap-2 bg-slate-50/60">
                    <button type="button" onclick="closeAddUnitModal()" class="px-4 py-2 text-xs font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-5 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        Simpan Unit
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

        // Modal Pelanggan
        function openAddCustomerModal() {
            const m = document.getElementById('addCustomerModal');
            m.classList.remove('hidden'); m.classList.add('flex');
            setTimeout(() => document.getElementById('inputNama')?.focus(), 100);
        }
        function closeAddCustomerModal() {
            const m = document.getElementById('addCustomerModal');
            m.classList.add('hidden'); m.classList.remove('flex');
        }

        // Modal Unit
        function openAddUnitModal() {
            const m = document.getElementById('addUnitModal');
            if (m) { m.classList.remove('hidden'); m.classList.add('flex'); }
        }
        function closeAddUnitModal() {
            const m = document.getElementById('addUnitModal');
            if (m) { m.classList.add('hidden'); m.classList.remove('flex'); }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAddCustomerModal();
                closeAddUnitModal();
            }
            if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                e.preventDefault();
                document.getElementById('globalSearchInput')?.focus();
            }
        });

        // Filter tipe
        function filterType(type) {
            ['btnFilterAll','btnFilterPersonal','btnFilterKorporat','btnFilterDistributor'].forEach(id => {
                const b = document.getElementById(id);
                if (b) {
                    b.className = 'px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 hover:bg-slate-200 text-[10.5px] font-medium transition-colors';
                }
            });
            const activeMap = {
                'all': 'btnFilterAll',
                'personal': 'btnFilterPersonal',
                'korporat': 'btnFilterKorporat',
                'distributor': 'btnFilterDistributor'
            };
            const activeBtn = document.getElementById(activeMap[type]);
            if (activeBtn) {
                activeBtn.className = 'px-2.5 py-1 rounded-full bg-brand-700 text-white text-[10.5px] font-semibold transition-colors';
            }

            document.querySelectorAll('.customer-card').forEach(card => {
                const cardType = card.getAttribute('data-type');
                if (type === 'all' || cardType === type) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Search Pelanggan
        ['globalSearchInput','crmSearchInput'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', function(e) {
                const term = e.target.value.toLowerCase().trim();
                document.querySelectorAll('.customer-card').forEach(c => {
                    const name = c.getAttribute('data-name') || '';
                    const hp   = c.getAttribute('data-hp') || '';
                    const comp = c.getAttribute('data-company') || '';
                    const match = name.includes(term) || hp.includes(term) || comp.includes(term);
                    c.style.display = match ? 'block' : 'none';
                });
            });
        });
    </script>
</body>
</html>
