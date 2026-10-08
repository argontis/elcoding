<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFix Pro — Hardware & Service OS</title>
    <meta name="description" content="TechFix Pro Enterprise - Sistem Manajemen Operasional Reparasi Hardware & Service Center">
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .font-mono-code {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Pulse Animations */
        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.2); opacity: 0.4; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-beacon {
            animation: pulse-ring 2s infinite ease-in-out;
        }

        /* Card Hover Effects */
        .ticket-card {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .ticket-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08);
        }

        /* Active sidebar link */
        .nav-item-active {
            background-color: #1d4ed8;
            color: #ffffff !important;
            font-weight: 600;
        }

        /* Line clamps */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="min-h-screen flex text-slate-800 bg-[#f8fafc] antialiased">

    <!-- ========================================================= -->
    <!-- LEFT SIDEBAR                                              -->
    <!-- ========================================================= -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed inset-y-0 left-0 z-40 select-none">
        
        <!-- Brand Header -->
        <div class="px-5 pt-5 pb-4 border-b border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-1.5 font-display font-extrabold text-[20px] tracking-tight text-brand-900 leading-none">
                        <span>TechFix</span>
                        <span class="text-sky-500">Pro</span>
                    </div>
                    <div class="text-[9.5px] font-mono-code font-bold tracking-widest text-sky-600 mt-1 uppercase">
                        HARDWARE & SERVICE OS
                    </div>
                </div>
            </div>

            <!-- Sesi Teknisi Active Tag -->
            <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100 text-[10px] font-mono-code text-slate-500">
                <span class="font-semibold text-slate-600">SESI TEKNISI: <span class="text-emerald-600 font-bold">ACTIVE</span></span>
                <span class="px-1.5 py-0.5 rounded border border-slate-200 text-slate-400 font-bold">v4.2-PROD</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-3 py-3 space-y-1 overflow-y-auto">
            <!-- 1. Tiket & Workbench (Active) -->
            <a href="{{ route('techfix.dashboard') }}" class="nav-item-active flex items-center justify-between px-3 py-2.5 rounded-lg text-xs transition-all shadow-sm">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-ticket-simple text-sm"></i>
                    <span>Tiket & Workbench</span>
                </div>
                <span class="bg-white/20 text-white px-2 py-0.5 rounded-full text-[10.5px] font-mono-code font-bold">
                    {{ count($tiketDiagnosa) + count($tiketApproval) + count($tiketDikerjakan) + count($tiketQc) }}
                </span>
            </a>

            <!-- 2. Tracking & Approval WA -->
            <a href="{{ route('techfix.tracking') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-regular fa-comment-dots text-sm text-slate-400"></i>
                    <span>Tracking & Approval WA</span>
                </div>
                <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full text-[10px] font-mono-code font-bold">3</span>
            </a>

            <!-- 3. Kasir POS & Garansi -->
            <a href="{{ route('techfix.kasir') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-cash-register text-sm text-slate-400"></i>
                    <span>Kasir POS & Garansi</span>
                </div>
            </a>

            <!-- 4. Stok Sparepart & Inv -->
            <a href="{{ route('techfix.stok') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-boxes-stacked text-sm text-slate-400"></i>
                    <span>Stok Sparepart & Inv</span>
                </div>
            </a>

            <!-- 5. CRM & Riwayat Unit -->
            <a href="{{ route('techfix.crm') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-user-gear text-sm text-slate-400"></i>
                    <span>CRM & Riwayat Unit</span>
                </div>
            </a>

            <!-- 6. Laporan & Keuangan -->
            <a href="{{ route('techfix.laporan') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-chart-line text-sm text-slate-400"></i>
                    <span>Laporan & Keuangan</span>
                </div>
            </a>

            <!-- 7. Pengaturan Sistem -->
            <a href="{{ route('techfix.pengaturan') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-gear text-sm text-slate-400"></i>
                    <span>Pengaturan Sistem</span>
                </div>
            </a>
        </nav>

        <!-- Sidebar Bottom: Hardware Diagnostics & Shift Status -->
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

            <!-- Shift Row -->
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

    <!-- ========================================================= -->
    <!-- MAIN APPLICATION WRAPPER                                  -->
    <!-- ========================================================= -->
    <div class="pl-64 flex-1 flex flex-col min-w-0">

        <!-- ===================================================== -->
        <!-- TOP NAVBAR                                            -->
        <!-- ===================================================== -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            
            <!-- Left: Branch Selector -->
            <div class="flex items-center gap-4">
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

                <form id="branchSwitchForm" action="{{ route('techfix.branch.switch') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>

            <!-- Center & Right: Search, Status Badges, Action Button, User -->
            <div class="flex items-center gap-3">
                
                <!-- Search with shortcut -->
                <div class="relative w-64 hidden md:block">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="globalSearchInput" placeholder="Cari tiket, SN, customer..." 
                        class="w-full pl-8 pr-16 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder:text-slate-400">
                    <span class="absolute right-2 top-1/2 -translate-y-1/2 text-[10px] font-mono-code bg-white px-1.5 py-0.5 border border-slate-200 rounded text-slate-400">Ctrl+K</span>
                </div>

                <!-- WA Gateway Badge -->
                <div class="hidden lg:flex items-center gap-1.5 px-2.5 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-[11px] font-mono-code text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                    <span>WA Gateway: <strong>Terhubung</strong></span>
                </div>

                <!-- Teknisi Standby Badge -->
                <div class="hidden xl:flex items-center gap-1.5 px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-[11px] font-mono-code text-slate-600">
                    <i class="fa-solid fa-user-astronaut text-slate-400 text-xs"></i>
                    <span>Teknisi: <strong>6/8 Standby</strong></span>
                </div>

                <!-- Primary Action: + Tiket Baru (F1) -->
                <button onclick="openNewTicketModal()" class="flex items-center gap-2 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all hover:shadow active:scale-[0.98]">
                    <i class="fa-solid fa-plus text-[11px]"></i>
                    <span>Tiket Baru <span class="font-mono-code text-[10px] opacity-80">(F1)</span></span>
                </button>

                <!-- Notification Bell -->
                <div class="relative">
                    <button onclick="toastMsg('3 Notifikasi: 1 Tiket VIP baru masuk, 2 approval disetujui customer.')" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="fa-regular fa-bell text-xs"></i>
                    </button>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white rounded-full text-[9px] font-mono-code font-bold flex items-center justify-center">3</span>
                </div>

                <!-- User Profile -->
                <div class="flex items-center gap-2.5 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold shadow-xs">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="hidden sm:block text-left">
                        <div class="text-xs font-bold text-slate-800 leading-tight">Rian Pratama, S.Kom</div>
                        <div class="text-[10px] font-medium text-slate-400">Chief Tech & Admin</div>
                    </div>
                    
                    <!-- Menu dropdown helper -->
                    <div class="relative group">
                        <button class="p-1 text-slate-400 hover:text-slate-600">
                            <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 hidden group-hover:block z-50 text-xs">
                            <div class="px-3 py-1 text-[10px] font-mono-code font-bold text-slate-400 uppercase">Kelola Dashboard</div>
                            <a href="{{ route('techfix.reset') }}?mode=empty" class="flex items-center gap-2 px-3 py-1.5 text-slate-700 hover:bg-slate-50">
                                <i class="fa-solid fa-eraser text-slate-400"></i> Mode Data Bersih (Kosong)
                            </a>
                            <a href="{{ route('techfix.reset') }}?mode=default" class="flex items-center gap-2 px-3 py-1.5 text-slate-700 hover:bg-slate-50">
                                <i class="fa-solid fa-rotate-left text-slate-400"></i> Muat Ulang Tampilan Demo
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

        <!-- ===================================================== -->
        <!-- MAIN CONTENT AREA                                     -->
        <!-- ===================================================== -->
        <main class="flex-1 p-6 space-y-5 overflow-y-auto">

            <!-- Flash Message -->
            @if(session('success'))
            <div id="flashAlert" class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-xl text-xs flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('flashAlert').remove()" class="text-emerald-500 hover:text-emerald-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endif

            <!-- 1. Header Title & Top Actions Row -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-mono-code font-medium text-slate-400 flex items-center gap-1.5">
                        <span>Operasional Servis</span>
                        <i class="fa-solid fa-chevron-right text-[8px]"></i>
                        <span class="text-slate-600">Papan Tiket & Workbench Teknisi</span>
                    </div>
                    <div class="flex items-center gap-3 mt-1">
                        <h1 class="text-xl font-display font-extrabold text-slate-900 tracking-tight">
                            Tiket Servis & Workbench Aktif
                        </h1>
                        <span class="inline-flex items-center gap-1.5 bg-sky-50 text-sky-700 border border-sky-200/80 px-2.5 py-0.5 rounded-full text-xs font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-sky-500"></span>
                            <span>24 Tiket Dalam Pengerjaan Hari Ini</span>
                        </span>
                    </div>
                </div>

                <!-- Action Button Group -->
                <div class="flex items-center gap-2 flex-wrap">
                    <button onclick="openNewTicketModal()" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Buat Tiket Masuk (F1)</span>
                    </button>
                    <button onclick="openBarcodeModal()" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-barcode text-slate-500"></i>
                        <span>Cetak Barcode QR</span>
                    </button>
                    <button onclick="openTechnicianFilter()" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-filter text-slate-400"></i>
                        <span>Filter Teknisi</span>
                        <i class="fa-solid fa-chevron-down text-[8px] text-slate-400"></i>
                    </button>
                    <button onclick="exportTicketLog()" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-arrow-up-from-bracket text-slate-400"></i>
                        <span>Ekspor Log</span>
                    </button>
                </div>
            </div>

            <!-- 2. Metrics Stats Row (5 Cards) -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3.5">
                
                <!-- Stat 1: Total Tiket Aktif -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>TOTAL TIKET AKTIF</span>
                        <i class="fa-regular fa-folder-open text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $stats['tiket_aktif']['val'] ?? 38 }}</span>
                        <span class="text-xs font-medium text-slate-500">{{ $stats['tiket_aktif']['unit'] ?? 'Unit' }}</span>
                    </div>
                    <div class="text-[11px] text-sky-600 font-medium mt-2 flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[9px]"></i>
                        <span>{{ $stats['tiket_aktif']['sub'] ?? '+4 unit masuk hari ini' }}</span>
                    </div>
                </div>

                <!-- Stat 2: Pending Approval WA -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>PENDING APPROVAL WA</span>
                        <i class="fa-regular fa-comment-dots text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $stats['pending_approval']['val'] ?? 6 }}</span>
                        <span class="text-xs font-medium text-slate-500">{{ $stats['pending_approval']['unit'] ?? 'Tiket' }}</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-2 truncate">
                        <span>{{ $stats['pending_approval']['sub'] ?? 'Rp 8.450.000 tertunda' }}</span>
                    </div>
                </div>

                <!-- Stat 3: Sedang Diperbaiki -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>SEDANG DIPERBAIKI</span>
                        <i class="fa-solid fa-screwdriver-wrench text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $stats['sedang_diperbaiki']['val'] ?? 14 }}</span>
                        <span class="text-xs font-medium text-slate-500">{{ $stats['sedang_diperbaiki']['unit'] ?? 'Unit' }}</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-2 flex items-center gap-1">
                        <i class="fa-regular fa-clock text-[9px] text-slate-400"></i>
                        <span>{{ $stats['sedang_diperbaiki']['sub'] ?? 'Avg lead time: 1.8 hari' }}</span>
                    </div>
                </div>

                <!-- Stat 4: QC & Siap Diambil -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>QC & SIAP DIAMBIL</span>
                        <i class="fa-regular fa-circle-check text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $stats['qc_siap_diambil']['val'] ?? 9 }}</span>
                        <span class="text-xs font-medium text-slate-500">{{ $stats['qc_siap_diambil']['unit'] ?? 'Unit' }}</span>
                    </div>
                    <div class="text-[11px] text-emerald-600 font-medium mt-2 flex items-center gap-1">
                        <i class="fa-solid fa-check text-[9px]"></i>
                        <span>{{ $stats['qc_siap_diambil']['sub'] ?? 'Siap serah terima kasir' }}</span>
                    </div>
                </div>

                <!-- Stat 5: Rasio Sukses Reparasi -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>RASIO SUKSES REPARASI</span>
                        <i class="fa-solid fa-chart-simple text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $stats['rasio_sukses']['val'] ?? '94.2%' }}</span>
                        <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-1.5 py-0.5 rounded text-[10px] font-mono-code font-bold">Optimal</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-2 truncate">
                        <span>Target: <strong>>90%</strong> | <span class="text-emerald-600">+1.8% vs pekan lalu</span></span>
                    </div>
                </div>

            </div>

            <!-- 3. Kanban Board (4 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-start">

                <!-- ================================================= -->
                <!-- COLUMN 1: DIAGNOSA AWAL                           -->
                <!-- ================================================= -->
                <div class="bg-slate-100/70 border border-slate-200/80 rounded-xl p-3 flex flex-col min-h-[460px]">
                    <!-- Column Header -->
                    <div class="flex items-center justify-between mb-3 px-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                            <span class="text-xs font-bold text-slate-800">Diagnosa Awal</span>
                        </div>
                        <span class="w-5 h-5 rounded-full bg-white border border-slate-200 text-slate-600 text-[11px] font-mono-code font-bold flex items-center justify-center shadow-2xs">
                            {{ count($tiketDiagnosa) }}
                        </span>
                    </div>

                    <!-- Cards Container -->
                    <div class="space-y-3 flex-1">
                        @forelse($tiketDiagnosa as $tiket)
                            <div onclick="window.location='{{ route('techfix.dashboard') }}?tiket={{ $tiket['id'] }}'"
                                class="ticket-card bg-white rounded-xl border {{ ($selectedTiket['id'] ?? '') === $tiket['id'] ? 'border-brand-500 ring-2 ring-brand-100' : 'border-slate-200' }} p-3.5 cursor-pointer shadow-xs">
                                
                                <!-- Card Header -->
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-1.5 font-mono-code text-[11px] font-bold">
                                        <span class="text-brand-700">{{ $tiket['kode'] ?? '#' . $tiket['id'] }}</span>
                                    </div>
                                    @if(!empty($tiket['priority']))
                                    <span class="text-[9.5px] font-bold px-2 py-0.5 rounded-full {{ $tiket['priority'] === 'Priority VIP' ? 'bg-purple-100 text-purple-700 border border-purple-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                        {{ $tiket['priority'] }}
                                    </span>
                                    @endif
                                </div>

                                <!-- Device Title -->
                                <div class="font-bold text-sm text-slate-900 leading-snug mb-0.5">
                                    {{ $tiket['device'] }}
                                </div>

                                @if(!empty($tiket['serial']))
                                <div class="text-[10px] font-mono-code text-slate-400 mb-2">
                                    SN: {{ $tiket['serial'] }}
                                </div>
                                @endif

                                <!-- Keluhan Box -->
                                @if(!empty($tiket['keluhan']))
                                <div class="bg-slate-50 border border-slate-100 rounded-lg p-2.5 text-[11px] mb-2.5">
                                    <div class="text-[9.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                                        {{ $tiket['box_label'] ?? 'GEJALA KERUSAKAN:' }}
                                    </div>
                                    <div class="text-slate-700 italic leading-relaxed">
                                        {{ $tiket['keluhan'] }}
                                    </div>
                                </div>
                                @endif

                                <!-- Info Row: Pelanggan & Teknisi -->
                                <div class="text-[11px] space-y-1 mb-2.5">
                                    <div class="flex items-center justify-between text-slate-600">
                                        <span class="text-slate-400">Pelanggan:</span>
                                        <span class="font-medium text-slate-800">{{ $tiket['nama_pelanggan'] }}</span>
                                    </div>
                                    @if(!empty($tiket['teknisi']))
                                    <div class="flex items-center justify-between text-slate-600">
                                        <span class="text-slate-400">Teknisi:</span>
                                        <span class="font-medium {{ $tiket['teknisi'] === 'Belum Assign' ? 'text-amber-600' : 'text-slate-800' }}">
                                            {{ $tiket['teknisi'] }}
                                        </span>
                                    </div>
                                    @endif
                                    @if(!empty($tiket['kelengkapan']) && empty($tiket['step_tag']))
                                    <div class="text-[10.5px] bg-slate-50 px-2 py-1 rounded text-slate-600 mt-1">
                                        <span class="text-slate-400">Kelengkapan:</span> {{ $tiket['kelengkapan'] }}
                                    </div>
                                    @endif
                                </div>

                                <!-- Card Footer: Status Step & Timestamp -->
                                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[10.5px] font-mono-code text-slate-400">
                                    @if(!empty($tiket['step_tag']))
                                    <span class="flex items-center gap-1 text-slate-600 font-medium">
                                        <i class="fa-solid fa-gear text-[10px] text-slate-400"></i>
                                        <span>{{ $tiket['step_tag'] }}</span>
                                    </span>
                                    @elseif($tiket['teknisi'] === 'Belum Assign')
                                    <span class="text-amber-600 font-semibold flex items-center gap-1">
                                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> Belum Assign
                                    </span>
                                    @else
                                    <span class="text-slate-500">{{ $tiket['status'] }}</span>
                                    @endif
                                    <span>{{ $tiket['time_ago'] ?? 'Baru saja' }}</span>
                                </div>

                            </div>
                        @empty
                            <div class="p-8 text-center text-xs text-slate-400 bg-white/70 rounded-xl border border-dashed border-slate-200 flex flex-col items-center justify-center">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mb-2">
                                    <i class="fa-regular fa-folder-open text-xs"></i>
                                </div>
                                <div class="font-medium text-slate-600 mb-0.5">Antrian Kosong</div>
                                <div class="text-[10.5px] text-slate-400 mb-2.5">Belum ada unit terdaftar</div>
                                <button onclick="openNewTicketModal()" class="text-sky-600 hover:text-sky-700 font-semibold text-[11px] flex items-center gap-1">
                                    <i class="fa-solid fa-plus text-[9px]"></i> Tambah Unit
                                </button>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- ================================================= -->
                <!-- COLUMN 2: APPROVAL WA                             -->
                <!-- ================================================= -->
                <div class="bg-slate-100/70 border border-slate-200/80 rounded-xl p-3 flex flex-col min-h-[460px]">
                    <!-- Column Header -->
                    <div class="flex items-center justify-between mb-3 px-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-sky-500"></span>
                            <span class="text-xs font-bold text-slate-800">Approval WA</span>
                        </div>
                        <span class="w-5 h-5 rounded-full bg-white border border-slate-200 text-slate-600 text-[11px] font-mono-code font-bold flex items-center justify-center shadow-2xs">
                            {{ count($tiketApproval) }}
                        </span>
                    </div>

                    <!-- Cards Container -->
                    <div class="space-y-3 flex-1">
                        @forelse($tiketApproval as $tiket)
                            <div onclick="window.location='{{ route('techfix.dashboard') }}?tiket={{ $tiket['id'] }}'"
                                class="ticket-card bg-white rounded-xl border {{ ($selectedTiket['id'] ?? '') === $tiket['id'] ? 'border-brand-500 ring-2 ring-brand-100' : 'border-slate-200' }} p-3.5 cursor-pointer shadow-xs">
                                
                                <!-- Card Header -->
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-mono-code text-[11px] font-bold text-brand-700">{{ $tiket['kode'] ?? '#' . $tiket['id'] }}</span>
                                    @if(!empty($tiket['badge_pill']))
                                    <span class="text-[9.5px] font-mono-code font-bold px-2 py-0.5 rounded-full {{ ($tiket['pill_type'] ?? '') === 'warning' ? 'bg-amber-100 text-amber-700 border border-amber-200' : 'bg-sky-100 text-sky-700 border border-sky-200' }}">
                                        {{ $tiket['badge_pill'] }}
                                    </span>
                                    @endif
                                </div>

                                <!-- Device Title -->
                                <div class="font-bold text-sm text-slate-900 leading-snug mb-0.5">
                                    {{ $tiket['device'] }}
                                </div>
                                <div class="text-[11px] text-slate-500 mb-2">
                                    Pelanggan: <span class="font-medium text-slate-700">{{ $tiket['nama_pelanggan'] }}</span>
                                </div>

                                <!-- Diagnosa Box -->
                                <div class="bg-slate-50 border border-slate-100 rounded-lg p-2.5 text-[11px] mb-2.5">
                                    <div class="text-[9.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                                        {{ $tiket['box_label'] ?? 'DIAGNOSA & SPAREPART:' }}
                                    </div>
                                    <div class="text-slate-700 leading-relaxed font-medium">
                                        {{ $tiket['keluhan'] }}
                                    </div>
                                </div>

                                <!-- Estimasi Biaya -->
                                <div class="flex items-center justify-between text-xs mb-3">
                                    <span class="text-slate-400 text-[11px]">Estimasi Biaya:</span>
                                    <span class="font-mono-code font-bold text-slate-900 text-sm">{{ $tiket['estimasi_biaya'] }}</span>
                                </div>

                                <!-- Action Buttons -->
                                @if(!empty($tiket['has_buttons']))
                                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-100">
                                    <button type="button" onclick="event.stopPropagation(); toastMsg('Pesan penawaran WhatsApp telah dikirim ulang ke customer!')"
                                        class="flex items-center justify-center gap-1.5 py-1 px-2 rounded-lg border border-slate-200 text-slate-700 text-[11px] font-medium hover:bg-slate-50 transition-colors">
                                        <i class="fa-solid fa-paper-plane text-[10px] text-sky-600"></i>
                                        <span>Resend WA</span>
                                    </button>
                                    <form action="{{ route('techfix.tiket.status', $tiket['id']) }}" method="POST" onclick="event.stopPropagation()">
                                        @csrf
                                        <input type="hidden" name="status" value="Sedang Dikerjakan">
                                        <button type="submit"
                                            class="w-full flex items-center justify-center gap-1.5 py-1 px-2 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-semibold hover:bg-emerald-100 transition-colors">
                                            <i class="fa-solid fa-check text-[10px]"></i>
                                            <span>ACC Manual</span>
                                        </button>
                                    </form>
                                </div>
                                @elseif(!empty($tiket['has_phone_btn']))
                                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                                    <span class="text-rose-600 font-mono-code font-medium text-[10.5px]">
                                        <i class="fa-regular fa-clock text-[10px]"></i> {{ $tiket['time_ago'] ?? '> 6 Jam Menunggu' }}
                                    </span>
                                    <a href="javascript:void(0)" onclick="event.stopPropagation(); toastMsg('Menghubungi customer via telepon...')" class="text-sky-600 hover:underline font-semibold">
                                        Hubungi Telp
                                    </a>
                                </div>
                                @endif

                            </div>
                        @empty
                            <div class="p-8 text-center text-xs text-slate-400 bg-white/70 rounded-xl border border-dashed border-slate-200 flex flex-col items-center justify-center">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mb-2">
                                    <i class="fa-regular fa-comment-dots text-xs"></i>
                                </div>
                                <div class="font-medium text-slate-600 mb-0.5">Approval Kosong</div>
                                <div class="text-[10.5px] text-slate-400">Tidak ada tiket menunggu WA</div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- ================================================= -->
                <!-- COLUMN 3: SEDANG DIKERJAKAN                       -->
                <!-- ================================================= -->
                <div class="bg-slate-100/70 border border-slate-200/80 rounded-xl p-3 flex flex-col min-h-[460px]">
                    <!-- Column Header -->
                    <div class="flex items-center justify-between mb-3 px-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                            <span class="text-xs font-bold text-slate-800">Sedang Dikerjakan</span>
                        </div>
                        <span class="w-5 h-5 rounded-full bg-white border border-slate-200 text-slate-600 text-[11px] font-mono-code font-bold flex items-center justify-center shadow-2xs">
                            {{ count($tiketDikerjakan) }}
                        </span>
                    </div>

                    <!-- Cards Container -->
                    <div class="space-y-3 flex-1">
                        @forelse($tiketDikerjakan as $tiket)
                            <div onclick="window.location='{{ route('techfix.dashboard') }}?tiket={{ $tiket['id'] }}'"
                                class="ticket-card bg-white rounded-xl border {{ ($selectedTiket['id'] ?? '') === $tiket['id'] ? 'border-brand-500 ring-2 ring-brand-100' : 'border-slate-200' }} p-3.5 cursor-pointer shadow-xs">
                                
                                <!-- Card Header -->
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-mono-code text-[11px] font-bold text-brand-700">{{ $tiket['kode'] ?? '#' . $tiket['id'] }}</span>
                                    <span class="text-[9.5px] font-mono-code font-bold px-2 py-0.5 rounded-full bg-sky-100 text-sky-700 border border-sky-200">
                                        {{ $tiket['badge_pill'] ?? 'ETA: 16:30' }}
                                    </span>
                                </div>

                                <!-- Device Title -->
                                <div class="font-bold text-sm text-slate-900 leading-snug mb-0.5">
                                    {{ $tiket['device'] }}
                                </div>
                                <div class="text-[10.5px] font-mono-code text-slate-500 mb-2 flex items-center justify-between">
                                    @if(!empty($tiket['serial']))
                                    <span>SN: {{ $tiket['serial'] }}</span>
                                    @endif
                                    <span class="text-brand-700 font-semibold">{{ $tiket['teknisi'] }}</span>
                                </div>

                                <!-- Description Box -->
                                <div class="bg-slate-50 border border-slate-100 rounded-lg p-2.5 text-[11px] mb-2.5 leading-relaxed text-slate-700">
                                    {{ $tiket['box_content'] ?? $tiket['keluhan'] }}
                                </div>

                                <!-- Progress Bar -->
                                <div class="mb-3">
                                    <div class="flex items-center justify-between text-[10px] font-mono-code text-slate-500 mb-1">
                                        <span>Status Progres:</span>
                                        <span class="font-bold text-brand-700">{{ $tiket['progress'] ?? 75 }}%</span>
                                    </div>
                                    <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-brand-600 rounded-full transition-all" style="width: {{ $tiket['progress'] ?? 75 }}%"></div>
                                    </div>
                                </div>

                                <!-- Card Footer: Step & Update Button -->
                                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                                    <span class="font-mono-code text-slate-500 text-[10.5px]">{{ $tiket['step_tag'] ?? 'Pengerjaan' }}</span>
                                    
                                    @if(($tiket['action_btn'] ?? '') === 'Tandai Selesai')
                                    <form action="{{ route('techfix.tiket.status', $tiket['id']) }}" method="POST" onclick="event.stopPropagation()">
                                        @csrf
                                        <input type="hidden" name="status" value="QC & Siap Diambil">
                                        <button type="submit" class="px-2 py-0.5 rounded border border-emerald-300 bg-emerald-50 text-emerald-700 hover:bg-emerald-100 font-medium text-[10.5px]">
                                            Tandai Selesai
                                        </button>
                                    </form>
                                    @else
                                    <button type="button" onclick="event.stopPropagation(); toastMsg('Status step reparasi diperbarui!')"
                                        class="px-2 py-0.5 rounded border border-slate-200 hover:bg-slate-50 text-slate-700 font-medium text-[10.5px]">
                                        {{ $tiket['action_btn'] ?? 'Update Step' }}
                                    </button>
                                    @endif
                                </div>

                            </div>
                        @empty
                            <div class="p-8 text-center text-xs text-slate-400 bg-white/70 rounded-xl border border-dashed border-slate-200 flex flex-col items-center justify-center">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mb-2">
                                    <i class="fa-solid fa-screwdriver-wrench text-xs"></i>
                                </div>
                                <div class="font-medium text-slate-600 mb-0.5">Meja Kerja Standby</div>
                                <div class="text-[10.5px] text-slate-400">Belum ada unit sedang diperbaiki</div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- ================================================= -->
                <!-- COLUMN 4: QC & TESTING                            -->
                <!-- ================================================= -->
                <div class="bg-slate-100/70 border border-slate-200/80 rounded-xl p-3 flex flex-col min-h-[460px]">
                    <!-- Column Header -->
                    <div class="flex items-center justify-between mb-3 px-1">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-bold text-slate-800">QC & Testing</span>
                        </div>
                        <span class="w-5 h-5 rounded-full bg-white border border-slate-200 text-slate-600 text-[11px] font-mono-code font-bold flex items-center justify-center shadow-2xs">
                            {{ count($tiketQc) }}
                        </span>
                    </div>

                    <!-- Cards Container -->
                    <div class="space-y-3 flex-1">
                        @forelse($tiketQc as $tiket)
                            <div onclick="window.location='{{ route('techfix.dashboard') }}?tiket={{ $tiket['id'] }}'"
                                class="ticket-card bg-white rounded-xl border {{ ($selectedTiket['id'] ?? '') === $tiket['id'] ? 'border-brand-500 ring-2 ring-brand-100' : 'border-slate-200' }} p-3.5 cursor-pointer shadow-xs">
                                
                                <!-- Card Header -->
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-mono-code text-[11px] font-bold text-brand-700">{{ $tiket['kode'] ?? '#' . $tiket['id'] }}</span>
                                    <span class="text-[9.5px] font-mono-code font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        QC Pass
                                    </span>
                                </div>

                                <!-- Device Title -->
                                <div class="font-bold text-sm text-slate-900 leading-snug mb-0.5">
                                    {{ $tiket['device'] }}
                                </div>
                                @if(!empty($tiket['serial']))
                                <div class="text-[10px] font-mono-code text-slate-400 mb-2.5">
                                    SN: {{ $tiket['serial'] }}
                                </div>
                                @endif

                                <!-- Checklist Box -->
                                <div class="bg-slate-50 border border-slate-100 rounded-lg p-2.5 text-[11px] mb-3 space-y-1.5">
                                    <div class="flex items-center gap-2 text-slate-700 font-mono-code">
                                        <i class="fa-solid fa-check text-emerald-600 text-[10px]"></i>
                                        <span>Cinebench R23 pass</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-700 font-mono-code">
                                        <i class="fa-solid fa-check text-emerald-600 text-[10px]"></i>
                                        <span>MemTest86 pass 0 error</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-700 font-mono-code">
                                        <i class="fa-solid fa-check text-emerald-600 text-[10px]"></i>
                                        <span>Port I/O (OK)</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-slate-700 font-mono-code">
                                        <i class="fa-solid fa-check text-emerald-600 text-[10px]"></i>
                                        <span>Webcam (OK)</span>
                                    </div>
                                </div>

                                <!-- Footer -->
                                <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                                    <span class="text-slate-500 font-mono-code">QC: <strong>{{ $tiket['qc_officer'] ?? 'Sandy T.' }}</strong></span>
                                    <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i> Siap Ambil
                                    </span>
                                </div>

                            </div>
                        @empty
                            <div class="p-8 text-center text-xs text-slate-400 bg-white/70 rounded-xl border border-dashed border-slate-200 flex flex-col items-center justify-center">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center mb-2">
                                    <i class="fa-regular fa-circle-check text-xs"></i>
                                </div>
                                <div class="font-medium text-slate-600 mb-0.5">QC Standby</div>
                                <div class="text-[10.5px] text-slate-400">Belum ada unit siap diambil</div>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- ===================================================== -->
            <!-- 4. ACTIVE WORKBENCH INSPECTOR (DETAIL PANEL BAWAH)     -->
            <!-- ===================================================== -->
            @if($selectedTiket)
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-xs transition-all">
                
                <!-- Drawer Top Header Bar -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 border border-sky-100 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h2 class="text-base font-display font-bold text-slate-900 leading-tight">
                                    {{ $selectedTiket['device_detail'] ?? $selectedTiket['device'] }}
                                </h2>
                                <span class="bg-brand-50 text-brand-700 border border-brand-200 font-mono-code text-[11px] font-bold px-2 py-0.5 rounded">
                                    {{ $selectedTiket['kode'] ?? '#' . $selectedTiket['id'] }}
                                </span>
                                @if(!empty($selectedTiket['priority']))
                                <span class="bg-purple-50 text-purple-700 border border-purple-200 text-[10px] font-bold px-2 py-0.5 rounded-full">
                                    {{ $selectedTiket['priority'] }}
                                </span>
                                @endif
                            </div>
                            <div class="text-[11px] text-slate-500 font-mono-code mt-1 flex items-center gap-2 flex-wrap">
                                <span>Serial: <strong>{{ $selectedTiket['serial'] ?? '—' }}</strong></span>
                                <span>•</span>
                                <span>Customer: <strong>{{ $selectedTiket['nama_pelanggan'] }} ({{ $selectedTiket['phone'] ?? '+62 812-8821-9981' }})</strong></span>
                                <span>•</span>
                                <span>Kelengkapan: <strong>{{ $selectedTiket['kelengkapan'] ?? 'Unit saja (Tanpa Charger)' }}</strong></span>
                                <span>•</span>
                                <span>Teknisi Utama: <strong class="text-brand-700">{{ $selectedTiket['teknisi_station'] ?? $selectedTiket['teknisi'] }}</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Buttons: Print & Save -->
                    <div class="flex items-center gap-2 self-start lg:self-auto flex-shrink-0">
                        <button onclick="window.print()" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                            <i class="fa-solid fa-print text-slate-500"></i>
                            <span>Cetak Job Sheet</span>
                        </button>
                        <button onclick="toastMsg('Perubahan data diagnosa & komponen berhasil disimpan!')" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                            <i class="fa-regular fa-floppy-disk"></i>
                            <span>Simpan Perubahan <span class="font-mono-code text-[10px] opacity-80">(Ctrl+S)</span></span>
                        </button>
                    </div>
                </div>

                <!-- 3 Columns Inside Workbench Panel -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 pt-4">

                    <!-- Sub Column 1: Log Diagnosa Hardware & Mikrosolder -->
                    <div class="border border-slate-100 rounded-xl p-4 bg-slate-50/50 flex flex-col justify-between">
                        <div>
                            <!-- Header Box -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                                    <i class="fa-solid fa-microscope text-brand-600"></i>
                                    <span>Log Diagnosa Hardware & Mikrosolder</span>
                                </div>
                                <span class="bg-sky-100 text-sky-700 text-[9.5px] font-mono-code font-bold px-1.5 py-0.5 rounded border border-sky-200">
                                    LIVE SCOPE
                                </span>
                            </div>

                            <!-- Motherboard Signal Rails (Grid) -->
                            <div class="mb-3">
                                <div class="text-[9.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1.5 flex justify-between">
                                    <span>MOTHERBOARD SIGNAL RAILS</span>
                                    <span class="text-sky-600">RAIL MULTI-METER CHECK</span>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-[10.5px] font-mono-code">
                                    @php
                                        $rails = $selectedTiket['rails'] ?? [
                                            ['label' => 'PPBUS_G3H', 'val' => '12.26V', 'status' => 'PASS', 'type' => 'pass'],
                                            ['label' => 'PP3V3_G3H', 'val' => '3.29V', 'status' => 'PASS', 'type' => 'pass'],
                                            ['label' => 'PPVOUT_S0_LCDBKLT', 'val' => '1.20V', 'status' => 'SHORT', 'type' => 'short'],
                                            ['label' => 'EDP_BKLT_EN', 'val' => '3.30V', 'status' => 'HIGH', 'type' => 'high'],
                                        ];
                                    @endphp
                                    @foreach($rails as $r)
                                    <div class="bg-white border {{ $r['type'] === 'short' ? 'border-rose-300 bg-rose-50/30' : 'border-slate-200' }} rounded-lg p-2">
                                        <div class="text-slate-400 text-[9.5px] truncate">{{ $r['label'] }}</div>
                                        <div class="flex items-center justify-between font-bold mt-0.5">
                                            <span class="text-slate-800">{{ $r['val'] }}</span>
                                            <span class="{{ $r['type'] === 'short' ? 'text-rose-600 font-extrabold' : ($r['type'] === 'high' ? 'text-blue-600' : 'text-emerald-600') }}">
                                                [{{ $r['status'] }}]
                                            </span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Catatan Investigasi Teknisi -->
                            <div class="mb-3">
                                <div class="text-[9.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                                    CATATAN INVESTIGASI TEKNISI:
                                </div>
                                <p class="text-xs text-slate-700 leading-relaxed bg-white border border-slate-200 rounded-lg p-2.5">
                                    {{ $selectedTiket['investigasi'] ?? 'Ditemukan korosi ringan akibat kelembapan pada jalur backlight IC U8400 pin 4 & 5. Tegangan PPVOUT_S0_LCDBKLT drop drastis ke 1.2V karena kapasitor bypass C8412 breakdown to ground.' }}
                                </p>
                            </div>

                            <!-- Langkah Solusi -->
                            <div class="mb-3">
                                <div class="text-[9.5px] font-mono-code font-bold text-sky-600 uppercase tracking-wider mb-1">
                                    Langkah Solusi:
                                </div>
                                <p class="text-xs text-slate-700 leading-relaxed bg-white border border-slate-200 rounded-lg p-2.5">
                                    {{ $selectedTiket['solusi'] ?? 'Ultrasonic cleaning area backlight, re-soldering trace U8400, penggantian kapasitor high-voltage C8412 (0402 10uF 50V) dan thermal pad refresh.' }}
                                </p>
                            </div>
                        </div>

                        <!-- Footer Box Level & Durasi -->
                        <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-[10.5px] font-mono-code text-slate-500">
                            <span class="flex items-center gap-1">
                                <i class="fa-solid fa-award text-amber-500"></i>
                                <span>Level Reparasi: <strong>{{ $selectedTiket['level_reparasi'] ?? 'Mikrosolder L3' }}</strong></span>
                            </span>
                            <span>Durasi Pengerjaan: <strong>{{ $selectedTiket['durasi'] ?? '1h 40m' }}</strong></span>
                        </div>
                    </div>

                    <!-- Sub Column 2: Rincian Komponen & Jasa -->
                    <div class="border border-slate-100 rounded-xl p-4 bg-slate-50/50 flex flex-col justify-between">
                        <div>
                            <!-- Header Box -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                                    <i class="fa-solid fa-receipt text-brand-600"></i>
                                    <span>Rincian Komponen & Jasa</span>
                                </div>
                                <span class="bg-blue-100 text-blue-700 text-[9.5px] font-mono-code font-bold px-1.5 py-0.5 rounded border border-blue-200">
                                    {{ count($selectedTiket['items'] ?? []) ?: 2 }} ITEM
                                </span>
                            </div>

                            <!-- Items List -->
                            <div class="space-y-2 mb-3">
                                @php
                                    $items = $selectedTiket['items'] ?? [
                                        ['nama' => 'Jasa Mikrosolder Level 3', 'desc' => 'Reparasi IC Power & Rekonstruksi Jalur', 'biaya' => 'Rp 650.000'],
                                        ['nama' => 'Komponen IC Backlight & SMD Cap', 'desc' => 'Kode Rak: PART-APL-C8412', 'biaya' => 'Rp 150.000'],
                                    ];
                                @endphp

                                @foreach($items as $item)
                                <div class="bg-white border border-slate-200 rounded-lg p-2.5 flex items-start justify-between gap-2 shadow-2xs">
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">{{ $item['nama'] }}</div>
                                        <div class="text-[10px] text-slate-400 font-mono-code mt-0.5">{{ $item['desc'] }}</div>
                                    </div>
                                    <div class="text-xs font-mono-code font-bold text-slate-900 flex-shrink-0">
                                        {{ $item['biaya'] }}
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Add Sparepart Button -->
                            <button onclick="openAddPartModal('{{ $selectedTiket['id'] }}')" 
                                class="w-full py-2 px-3 border border-dashed border-sky-300 bg-sky-50/50 hover:bg-sky-50 text-sky-700 rounded-lg text-xs font-semibold flex items-center justify-center gap-1.5 transition-colors mb-4">
                                <i class="fa-solid fa-plus text-[10px]"></i>
                                <span>Tambah Sparepart dari Inventory</span>
                            </button>
                        </div>

                        <!-- Price Calculation Summary -->
                        <div class="border-t border-slate-200 pt-3 space-y-1.5 font-mono-code text-xs">
                            <div class="flex justify-between text-slate-500">
                                <span>Subtotal Jasa & Part:</span>
                                <span>{{ $selectedTiket['subtotal'] ?? 'Rp 800.000' }}</span>
                            </div>
                            <div class="flex justify-between text-slate-500">
                                <span>Diskon Member VIP:</span>
                                <span>{{ $selectedTiket['diskon'] ?? '- Rp 0' }}</span>
                            </div>
                            <div class="flex justify-between items-baseline pt-2 border-t border-slate-200 text-slate-900 font-bold">
                                <span class="font-sans text-sm">Total Tagihan:</span>
                                <span class="text-lg text-brand-700 font-extrabold">{{ $selectedTiket['total'] ?? 'Rp 800.000' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sub Column 3: Portal Live WA Tracking -->
                    <div class="border border-slate-100 rounded-xl p-4 bg-slate-50/50 flex flex-col justify-between">
                        <div>
                            <!-- Header Box -->
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                                    <i class="fa-solid fa-tower-broadcast text-emerald-600"></i>
                                    <span>Portal Live WA Tracking</span>
                                </div>
                                <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                            </div>

                            <!-- QR Code Visual Block -->
                            <div class="bg-white border border-slate-200 rounded-xl p-4 flex flex-col items-center justify-center shadow-2xs mb-3 text-center">
                                
                                <!-- Realistic Simulated QR Code Matrix -->
                                <div class="w-32 h-32 bg-slate-900 rounded-lg p-2.5 flex items-center justify-center mb-2 shadow-xs">
                                    <svg viewBox="0 0 100 100" class="w-full h-full text-white fill-current">
                                        <!-- Top-left Finder -->
                                        <rect x="5" y="5" width="28" height="28" fill="#fff" rx="4"/>
                                        <rect x="10" y="10" width="18" height="18" fill="#0f172a" rx="2"/>
                                        <rect x="14" y="14" width="10" height="10" fill="#fff" rx="1"/>
                                        
                                        <!-- Top-right Finder -->
                                        <rect x="67" y="5" width="28" height="28" fill="#fff" rx="4"/>
                                        <rect x="72" y="10" width="18" height="18" fill="#0f172a" rx="2"/>
                                        <rect x="76" y="14" width="10" height="10" fill="#fff" rx="1"/>
                                        
                                        <!-- Bottom-left Finder -->
                                        <rect x="5" y="67" width="28" height="28" fill="#fff" rx="4"/>
                                        <rect x="10" y="72" width="18" height="18" fill="#0f172a" rx="2"/>
                                        <rect x="14" y="76" width="10" height="10" fill="#fff" rx="1"/>

                                        <!-- Center data bits pattern -->
                                        <rect x="42" y="10" width="6" height="6"/>
                                        <rect x="52" y="15" width="6" height="6"/>
                                        <rect x="40" y="25" width="8" height="8"/>
                                        <rect x="45" y="42" width="12" height="12"/>
                                        <rect x="25" y="45" width="6" height="8"/>
                                        <rect x="65" y="45" width="8" height="6"/>
                                        <rect x="78" y="55" width="6" height="6"/>
                                        <rect x="42" y="65" width="10" height="6"/>
                                        <rect x="58" y="72" width="8" height="8"/>
                                        <rect x="70" y="80" width="6" height="10"/>
                                        <rect x="85" y="70" width="6" height="6"/>
                                    </svg>
                                </div>

                                <div class="text-[10px] font-mono-code text-slate-400">URL Tracking Real-Time:</div>
                                <a href="javascript:void(0)" onclick="toastMsg('URL tracking disalin ke clipboard!')" 
                                    class="text-[11px] font-mono-code text-sky-600 hover:underline font-bold mt-0.5 break-all">
                                    {{ $selectedTiket['tracking_url'] ?? 'https://track.techfix.id/' . $selectedTiket['id'] }}
                                </a>
                            </div>

                            <!-- Status Approval Customer -->
                            <div class="flex items-center justify-between text-xs p-2.5 bg-amber-50/70 border border-amber-200/80 rounded-lg mb-3">
                                <span class="text-amber-800 text-[11px] font-medium">Status Approval Customer:</span>
                                <span class="bg-amber-100 text-amber-800 text-[10px] font-bold px-2 py-0.5 rounded font-mono-code">
                                    {{ $selectedTiket['wa_status'] ?? 'Menunggu Persetujuan' }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons: Push WA & Manual ACC -->
                        <div class="grid grid-cols-2 gap-2 pt-2 border-t border-slate-200">
                            <button onclick="toastMsg('Pesan notifikasi status dan link tracking dikirim ke nomor WhatsApp customer!')"
                                class="flex items-center justify-center gap-1.5 py-2 px-3 border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 rounded-lg text-xs font-semibold shadow-2xs transition-colors">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                <span>Push WA</span>
                            </button>

                            <form action="{{ route('techfix.tiket.status', $selectedTiket['id']) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Sedang Dikerjakan">
                                <button type="submit" 
                                    class="w-full flex items-center justify-center gap-1.5 py-2 px-3 bg-brand-700 hover:bg-brand-800 text-white rounded-lg text-xs font-semibold shadow-2xs transition-colors">
                                    <i class="fa-solid fa-lock text-[10px]"></i>
                                    <span>Manual ACC</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
            @else
            <!-- EMPTY STATE WORKBENCH DRAWER -->
            <div class="bg-white border border-slate-200 rounded-2xl p-8 shadow-xs text-center flex flex-col items-center justify-center">
                <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 border border-sky-100 flex items-center justify-center text-xl mb-3 shadow-2xs">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <h3 class="text-sm font-display font-bold text-slate-800">Meja Kerja Workbench Diagnosa Standby</h3>
                <p class="text-xs text-slate-400 max-w-md mt-1 mb-4 leading-relaxed">
                    Data antrian saat ini masih kosong. Silakan gunakan tombol <strong>"+ Buat Tiket Masuk (F1)"</strong> di atas untuk mendaftarkan unit servis pelanggan pertama Anda.
                </p>
                <button onclick="openNewTicketModal()" class="flex items-center gap-2 bg-brand-700 hover:bg-brand-800 text-white px-4 py-2 rounded-xl text-xs font-semibold shadow-xs transition-all hover:scale-[1.02]">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>+ Buat Tiket Servis Baru (F1)</span>
                </button>
            </div>
            @endif

        </main>
    </div>

    <!-- ========================================================= -->
    <!-- MODAL: + TIKET BARU (F1)                                  -->
    <!-- ========================================================= -->
    <div id="newTicketModal" class="fixed inset-y-0 inset-x-0 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-lg w-full p-6 shadow-2xl animate-in">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-700 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-plus text-xs"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-display font-bold text-slate-900 leading-tight">Buat Tiket Masuk Servis Baru</h3>
                        <p class="text-[11px] text-slate-400">Input registrasi unit hardware ke meja diagnosa</p>
                    </div>
                </div>
                <button onclick="closeNewTicketModal()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form action="{{ route('techfix.tiket.store') }}" method="POST" class="space-y-3.5 text-xs">
                @csrf

                <!-- Nama Pelanggan & WhatsApp -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nama Pelanggan *</label>
                        <input type="text" name="nama_pelanggan" required placeholder="Contoh: Dimas Anggara"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nomor WhatsApp *</label>
                        <input type="text" name="phone" placeholder="+62 812-xxxx-xxxx"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                </div>

                <!-- Perangkat & Serial Number -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Perangkat / Device *</label>
                        <input type="text" name="device" required placeholder="MacBook Pro M1 / Asus ROG / iPhone"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Serial Number</label>
                        <input type="text" name="serial" placeholder="C02FD012MD6R"
                            class="w-full px-3 py-2 font-mono-code border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                </div>

                <!-- Keluhan & Gejala -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Keluhan / Gejala Kerusakan *</label>
                    <textarea name="keluhan" required rows="2" placeholder="Jelaskan kondisi kerusakan perangkat..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600 resize-none"></textarea>
                </div>

                <!-- Prioritas, Teknisi & Estimasi Biaya -->
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Prioritas</label>
                        <select name="priority" class="w-full px-2.5 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                            <option value="Regular">Regular</option>
                            <option value="Priority VIP">Priority VIP</option>
                            <option value="Priority">Priority</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Teknisi</label>
                        <select name="teknisi" class="w-full px-2.5 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                            <option value="Hendra W.">Hendra W.</option>
                            <option value="Rian Pratama">Rian Pratama</option>
                            <option value="Budi Santoso">Budi Santoso</option>
                            <option value="Sandy T.">Sandy T.</option>
                            <option value="Belum Assign">Belum Assign</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Estimasi Biaya</label>
                        <input type="text" name="estimasi_biaya" placeholder="Rp 0"
                            class="w-full px-3 py-2 font-mono-code border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                </div>

                <!-- Kelengkapan -->
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kelengkapan Unit</label>
                    <input type="text" name="kelengkapan" placeholder="Unit saja / Charger / Box / Kabel"
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeNewTicketModal()" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 font-medium">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-brand-700 hover:bg-brand-800 text-white rounded-lg font-semibold shadow-xs">
                        Daftarkan Tiket Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- MODAL: + TAMBAH SPAREPART / JASA                           -->
    <!-- ========================================================= -->
    <div id="addPartModal" class="fixed inset-y-0 inset-x-0 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-md w-full p-6 shadow-2xl animate-in">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-boxes-stacked text-brand-600"></i>
                    <h3 class="text-sm font-bold text-slate-900">Tambah Komponen / Jasa</h3>
                </div>
                <button onclick="closeAddPartModal()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="addPartForm" method="POST" action="" class="space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Item / Jasa *</label>
                    <input type="text" name="nama" required placeholder="Contoh: Thermal Paste PTM7950 / Baterai OEM"
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Keterangan / Kode Rak</label>
                    <input type="text" name="desc" placeholder="Kode Rak: PART-APL-xxx atau Garansi 3 Bulan"
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Biaya / Harga Satuan (Rp) *</label>
                    <input type="number" name="biaya" required placeholder="250000"
                        class="w-full px-3 py-2 font-mono-code border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                </div>

                <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeAddPartModal()" class="px-3 py-1.5 border border-slate-200 rounded-lg text-slate-600">Batal</button>
                    <button type="submit" class="px-4 py-1.5 bg-brand-700 hover:bg-brand-800 text-white rounded-lg font-semibold">Simpan Item</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- JAVASCRIPT LOGIC & INTERACTION                            -->
    <!-- ========================================================= -->
    <script>
        // Modal Controls
        function openNewTicketModal() {
            document.getElementById('newTicketModal').classList.remove('hidden');
        }
        function closeNewTicketModal() {
            document.getElementById('newTicketModal').classList.add('hidden');
        }

        function openAddPartModal(ticketId) {
            const form = document.getElementById('addPartForm');
            form.action = `/techfix/tiket/${ticketId}/item`;
            document.getElementById('addPartModal').classList.remove('hidden');
        }
        function closeAddPartModal() {
            document.getElementById('addPartModal').classList.add('hidden');
        }

        // Barcode Preview Modal
        function openBarcodeModal() {
            alert('Menghubungkan ke Thermal Barcode Printer 80mm...\nCetak label stiker barcode unit siap dijalankan.');
        }

        function openTechnicianFilter() {
            const teknisi = prompt("Filter berdasarkan nama teknisi:\n- Hendra W.\n- Rian Pratama\n- Budi Santoso\n- Sandy T.\n- Semua Teknisi");
            if (teknisi) {
                toastMsg("Menampilkan tiket untuk teknisi: " + teknisi);
            }
        }

        function exportTicketLog() {
            alert("Mengekspor rekap operasional hari ini ke format Excel / CSV...\nFile berhasil diunduh.");
        }

        function openSettingsModal() {
            alert("Pengaturan Sistem TechFix Pro:\n- Konfigurasi WhatsApp API Gateway\n- Serial Port Diagnostic Scanner COM4\n- Format Nomor Tiket dan SLA Perbaikan");
        }

        // Toast feedback
        function toastMsg(msg) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-5 right-5 bg-slate-900 text-white text-xs px-4 py-2.5 rounded-xl shadow-xl z-50 flex items-center gap-2 border border-slate-800 animate-in';
            toast.innerHTML = `<i class="fa-solid fa-circle-info text-sky-400"></i> <span>${msg}</span>`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3200);
        }

        // Global Keyboard Shortcuts (F1, Ctrl+K, Ctrl+S)
        document.addEventListener('keydown', function(e) {
            // F1: Buat Tiket Masuk Baru
            if (e.key === 'F1') {
                e.preventDefault();
                openNewTicketModal();
            }
            // Ctrl + K: Fokus ke Pencarian
            if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
                e.preventDefault();
                const search = document.getElementById('globalSearchInput');
                if (search) search.focus();
            }
            // Ctrl + S: Simpan Perubahan Workbench
            if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S')) {
                e.preventDefault();
                toastMsg('Perubahan data diagnosa & komponen tersimpan!');
            }
            // Escape: Tutup modal
            if (e.key === 'Escape') {
                closeNewTicketModal();
                closeAddPartModal();
            }
        });

        // Quick Search on Kanban Cards
        document.getElementById('globalSearchInput')?.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            const cards = document.querySelectorAll('.ticket-card');
            cards.forEach(card => {
                const text = card.innerText.toLowerCase();
                if (text.includes(term)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
