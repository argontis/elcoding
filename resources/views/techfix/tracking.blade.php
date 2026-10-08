<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking & Approval WhatsApp — TechFix Pro OS</title>
    <meta name="description" content="Portal Tracking & Otomasi Approval WhatsApp - TechFix Pro Enterprise">
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

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .font-mono-code {
            font-family: 'JetBrains Mono', monospace;
        }

        @keyframes pulse-ring {
            0% { transform: scale(0.95); opacity: 0.8; }
            50% { transform: scale(1.2); opacity: 0.4; }
            100% { transform: scale(0.95); opacity: 0.8; }
        }
        .pulse-beacon {
            animation: pulse-ring 2s infinite ease-in-out;
        }

        .nav-item-active {
            background-color: #1d4ed8;
            color: #ffffff !important;
            font-weight: 600;
        }

        .wa-bubble-chat {
            background-color: #ffffff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            border-radius: 12px;
            position: relative;
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
            <!-- 1. Tiket & Workbench -->
            <a href="{{ route('techfix.dashboard') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-ticket-simple text-sm text-slate-400"></i>
                    <span>Tiket & Workbench</span>
                </div>
            </a>

            <!-- 2. Tracking & Approval WA (Active) -->
            <a href="{{ route('techfix.tracking') }}" class="nav-item-active flex items-center justify-between px-3 py-2.5 rounded-lg text-xs transition-all shadow-sm">
                <div class="flex items-center gap-2.5">
                    <i class="fa-regular fa-comment-dots text-sm"></i>
                    <span>Tracking & Approval WA</span>
                </div>
                <span class="bg-white/20 text-white px-2 py-0.5 rounded-full text-[10.5px] font-mono-code font-bold">
                    {{ count($approvalList) }}
                </span>
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
                <button onclick="openEstimasiModal()" class="flex items-center gap-2 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all hover:shadow active:scale-[0.98]">
                    <i class="fa-solid fa-plus text-[11px]"></i>
                    <span>+ Buat Estimasi Baru</span>
                </button>

                <!-- Notification Bell -->
                <div class="relative">
                    <button onclick="toastMsg('Gateway WhatsApp aktif memantau status pesan.')" class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-colors">
                        <i class="fa-regular fa-bell text-xs"></i>
                    </button>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white rounded-full text-[9px] font-mono-code font-bold flex items-center justify-center">0</span>
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
                </div>

            </div>
        </header>

        <!-- ===================================================== -->
        <!-- MAIN CONTENT AREA                                     -->
        <!-- ===================================================== -->
        <main class="flex-1 p-6 space-y-4 overflow-y-auto">

            <!-- Flash Alert -->
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

            <!-- 1. Page Header & Actions -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
                <div>
                    <div class="text-[11px] font-mono-code font-medium text-slate-400 flex items-center gap-1.5">
                        <span>Operasional Pelanggan</span>
                        <i class="fa-solid fa-chevron-right text-[8px]"></i>
                        <span class="text-slate-600">Estimasi Biaya & Approval WhatsApp</span>
                    </div>
                    <h1 class="text-xl font-display font-extrabold text-slate-900 tracking-tight mt-1">
                        Portal Tracking & Otomasi Approval WhatsApp
                    </h1>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Otomatisasi pengiriman notifikasi, pelacakan interaksi link approval, dan audit digital persetujuan pelanggan.
                    </p>
                </div>

                <!-- Top Right Action Buttons -->
                <div class="flex items-center gap-2 flex-wrap">
                    <button onclick="openTemplateModal()" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-regular fa-file-lines text-slate-400"></i>
                        <span>Template Pesan Servis</span>
                    </button>
                    <button onclick="triggerBulkPing()" class="flex items-center gap-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-3 py-1.5 rounded-lg text-xs font-medium shadow-xs transition-colors">
                        <i class="fa-solid fa-paper-plane text-sky-600 text-[10px]"></i>
                        <span>Kirim Pengingat Masal (Bulk Ping)</span>
                    </button>
                    <button onclick="openEstimasiModal()" class="flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>+ Buat Estimasi Baru</span>
                    </button>
                </div>
            </div>

            <!-- 2. Meta Cloud API Status Bar (Cyan/Emerald Info Bar) -->
            <div class="bg-sky-50/50 border border-sky-100 rounded-xl px-4 py-2.5 flex flex-wrap items-center justify-between text-xs font-mono-code gap-3">
                <div class="flex items-center gap-2 text-slate-700 font-semibold">
                    <i class="fa-solid fa-arrows-rotate text-sky-600 text-xs"></i>
                    <span>Meta Cloud API Resmi Terhubung</span>
                </div>
                <div class="flex items-center gap-6 text-[11px] text-slate-600">
                    <div>
                        <span class="text-slate-400">Nomor Pengirim:</span>
                        <strong class="text-slate-800 ml-1">+62 821-3344-9900</strong>
                    </div>
                    <div>
                        <span class="text-slate-400">Kuota Blast:</span>
                        <strong class="text-slate-800 ml-1">9.420 / 10.000</strong>
                    </div>
                    <div>
                        <span class="text-slate-400">Speed:</span>
                        <strong class="text-emerald-600 ml-1">Real-time 0.8s</strong>
                    </div>
                </div>
                <div>
                    <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-0.5 rounded-full text-[10.5px] font-semibold">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Webhook Live Webhook 200 OK</span>
                    </span>
                </div>
            </div>

            <!-- 3. Metrics Summary Row (4 Cards) -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3.5">
                
                <!-- Card 1: Total Estimasi Menunggu -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>TOTAL ESTIMASI MENUNGGU</span>
                        <i class="fa-solid fa-hourglass-half text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $statsWa['total_menunggu']['val'] }}</span>
                        <span class="text-xs font-medium text-slate-500">Tiket</span>
                    </div>
                    <div class="flex items-center justify-between text-[11px] text-slate-500 mt-2">
                        <span class="truncate">{{ $statsWa['total_menunggu']['total_rp'] }} total nilai</span>
                        <span class="bg-amber-50 text-amber-700 border border-amber-200 px-1.5 py-0.2 rounded text-[9.5px] font-mono-code font-bold">
                            {{ $statsWa['total_menunggu']['belum_baca'] }} Belum Baca
                        </span>
                    </div>
                </div>

                <!-- Card 2: Tingkat Approval Customer -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>TINGKAT APPROVAL CUSTOMER</span>
                        <i class="fa-regular fa-thumbs-up text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $statsWa['approval_rate'] }}</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-2 flex items-center justify-between">
                        <span>Rata-rata respon 0 menit</span>
                        <span class="text-emerald-600 font-mono-code font-bold text-[10px]">Standby</span>
                    </div>
                </div>

                <!-- Card 3: Approval Diterima Hari Ini -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>APPROVAL DITERIMA HARI INI</span>
                        <i class="fa-regular fa-circle-check text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $statsWa['approval_diterima'] }}</span>
                        <span class="text-xs font-medium text-slate-500">Tiket</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-2 flex items-center justify-between">
                        <span>Auto-routing ke teknisi</span>
                        <span class="bg-sky-50 text-sky-700 border border-sky-200 px-1.5 py-0.2 rounded text-[9.5px] font-mono-code font-bold">100% Synced</span>
                    </div>
                </div>

                <!-- Card 4: Estimasi Ditolak / Cancel -->
                <div class="bg-white border border-slate-200 rounded-xl p-3.5 shadow-xs relative overflow-hidden">
                    <div class="flex items-center justify-between text-[10.5px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-1">
                        <span>ESTIMASI DITOLAK / CANCEL</span>
                        <i class="fa-regular fa-circle-xmark text-slate-300 text-xs"></i>
                    </div>
                    <div class="flex items-baseline gap-1.5">
                        <span class="text-2xl font-display font-extrabold text-slate-900 leading-none">{{ $statsWa['estimasi_ditolak'] }}</span>
                        <span class="text-xs font-medium text-slate-500">Tiket</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-2 flex items-center justify-between">
                        <span>Unit dikembalikan tanpa biaya</span>
                        <span class="bg-slate-100 text-slate-600 border border-slate-200 px-1.5 py-0.2 rounded text-[9.5px] font-mono-code">Form Diisi</span>
                    </div>
                </div>

            </div>

            <!-- 4. Main Two-Column Content Area -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">

                <!-- ================================================= -->
                <!-- LEFT COLUMN: TABEL APPROVAL & AUDIT LOG (7 COLS)  -->
                <!-- ================================================= -->
                <div class="lg:col-span-7 space-y-4">
                    
                    <!-- Table Card -->
                    <div class="bg-white border border-slate-200 rounded-xl shadow-xs overflow-hidden">
                        
                        <!-- Filter Tabs & Search Header -->
                        <div class="p-3.5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/50">
                            <!-- Filter Tabs -->
                            <div class="flex items-center gap-1 text-xs">
                                <a href="{{ route('techfix.tracking') }}?status=all" 
                                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors {{ $filter === 'all' ? 'bg-white text-slate-900 border border-slate-200 shadow-2xs' : 'text-slate-500 hover:text-slate-800' }}">
                                    Semua ({{ count($approvalList) }})
                                </a>
                                <a href="{{ route('techfix.tracking') }}?status=Menunggu Respon" 
                                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors {{ $filter === 'Menunggu Respon' ? 'bg-white text-slate-900 border border-slate-200 shadow-2xs' : 'text-slate-500 hover:text-slate-800' }}">
                                    Menunggu Respon ({{ count(array_filter($approvalList, fn($x) => ($x['status'] ?? '') === 'Menunggu Respon')) }})
                                </a>
                                <a href="{{ route('techfix.tracking') }}?status=Disetujui" 
                                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors {{ $filter === 'Disetujui' ? 'bg-white text-slate-900 border border-slate-200 shadow-2xs' : 'text-slate-500 hover:text-slate-800' }}">
                                    Disetujui ({{ count(array_filter($approvalList, fn($x) => ($x['status'] ?? '') === 'Disetujui')) }})
                                </a>
                                <a href="{{ route('techfix.tracking') }}?status=Ditolak" 
                                    class="px-2.5 py-1 rounded-lg font-semibold transition-colors {{ $filter === 'Ditolak' ? 'bg-white text-slate-900 border border-slate-200 shadow-2xs' : 'text-slate-500 hover:text-slate-800' }}">
                                    Ditolak ({{ count(array_filter($approvalList, fn($x) => ($x['status'] ?? '') === 'Ditolak')) }})
                                </a>
                            </div>

                            <!-- Search Input -->
                            <div class="relative w-44">
                                <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                <input type="text" id="filterInput" placeholder="Cari SN / Nama..." 
                                    class="w-full pl-7 pr-3 py-1 text-xs bg-white border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 placeholder:text-slate-400">
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead class="bg-slate-50 text-slate-400 uppercase font-mono-code text-[10px] tracking-wider border-b border-slate-100">
                                    <tr>
                                        <th class="py-2.5 px-3.5 font-bold">TIKET / UNIT</th>
                                        <th class="py-2.5 px-3.5 font-bold">PELANGGAN</th>
                                        <th class="py-2.5 px-3.5 font-bold">DIAGNOSA & BIAYA</th>
                                        <th class="py-2.5 px-3.5 font-bold text-right">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-700">
                                    @forelse($filteredList as $item)
                                    <tr onclick="window.location='{{ route('techfix.tracking') }}?id={{ $item['id'] }}'"
                                        class="hover:bg-slate-50/80 cursor-pointer transition-colors {{ ($selectedApproval['id'] ?? '') === $item['id'] ? 'bg-sky-50/40' : '' }}">
                                        
                                        <!-- Tiket / Unit -->
                                        <td class="py-3 px-3.5">
                                            <div class="font-mono-code font-bold text-brand-700 text-xs">{{ $item['kode'] }}</div>
                                            <div class="font-bold text-slate-900 mt-0.5">{{ $item['device'] }}</div>
                                            <div class="text-[10px] font-mono-code text-slate-400">SN: {{ $item['serial'] ?? '—' }}</div>
                                        </td>

                                        <!-- Pelanggan -->
                                        <td class="py-3 px-3.5">
                                            <div class="font-semibold text-slate-800">{{ $item['nama_pelanggan'] }}</div>
                                            <div class="text-[10px] font-mono-code text-slate-400">{{ $item['phone'] }}</div>
                                            <span class="inline-block mt-1 px-1.5 py-0.2 rounded text-[9.5px] font-bold font-mono-code {{ ($item['segment'] ?? '') === 'VIP' ? 'bg-purple-50 text-purple-700 border border-purple-200' : 'bg-slate-100 text-slate-600' }}">
                                                {{ $item['segment'] ?? 'Reguler' }}
                                            </span>
                                        </td>

                                        <!-- Diagnosa & Biaya -->
                                        <td class="py-3 px-3.5">
                                            <div class="text-[11px] text-slate-700 font-medium line-clamp-2 max-w-[200px]">
                                                {{ $item['diagnosa'] }}
                                            </div>
                                            <div class="font-mono-code font-bold text-brand-700 mt-1">
                                                {{ $item['biaya'] }}
                                            </div>
                                        </td>

                                        <!-- Status & Aksi -->
                                        <td class="py-3 px-3.5 text-right" onclick="event.stopPropagation()">
                                            @if(($item['status'] ?? '') === 'Disetujui')
                                            <span class="inline-flex items-center gap-1 text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded text-[10px] font-bold font-mono-code">
                                                <i class="fa-solid fa-check text-[9px]"></i> Disetujui
                                            </span>
                                            @elseif(($item['status'] ?? '') === 'Ditolak')
                                            <span class="inline-flex items-center gap-1 text-rose-700 bg-rose-50 border border-rose-200 px-2 py-0.5 rounded text-[10px] font-bold font-mono-code">
                                                <i class="fa-solid fa-xmark text-[9px]"></i> Ditolak
                                            </span>
                                            @else
                                            <span class="inline-flex items-center gap-1 text-amber-700 bg-amber-50 border border-amber-200 px-2 py-0.5 rounded text-[10px] font-bold font-mono-code">
                                                <i class="fa-regular fa-clock text-[9px]"></i> Menunggu
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <!-- Clean Empty State Row -->
                                    <tr>
                                        <td colspan="4" class="py-12 px-4 text-center">
                                            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 border border-sky-100 flex items-center justify-center text-xl mx-auto mb-2.5">
                                                <i class="fa-regular fa-comment-dots"></i>
                                            </div>
                                            <div class="font-bold text-slate-800 text-sm">Belum Ada Antrean Approval WhatsApp</div>
                                            <p class="text-xs text-slate-400 max-w-sm mx-auto mt-1 mb-3.5">
                                                Data antrean approval saat ini masih kosong. Silakan klik tombol di bawah untuk membuat penawaran estimasi WhatsApp pertama Anda.
                                            </p>
                                            <button onclick="openEstimasiModal()" class="inline-flex items-center gap-1.5 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-xs transition-colors">
                                                <i class="fa-solid fa-plus text-[10px]"></i>
                                                <span>+ Buat Estimasi Baru</span>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Table Footer Pagination -->
                        <div class="p-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400 font-mono-code bg-slate-50/40">
                            <span>Menampilkan {{ count($filteredList) }} antrean approval aktif</span>
                            <div class="flex items-center gap-1">
                                <span class="px-2 py-1 rounded border border-slate-200 bg-white text-slate-400 cursor-not-allowed">Sebelumnya</span>
                                <span class="px-2.5 py-1 rounded bg-brand-700 text-white font-bold">1</span>
                                <span class="px-2 py-1 rounded border border-slate-200 bg-white text-slate-400 cursor-not-allowed">Selanjutnya</span>
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Box: Log Audit Digital Approval & Tanda Tangan -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                                <i class="fa-solid fa-shield-halved text-brand-600"></i>
                                <span>Log Audit Digital Approval & Tanda Tangan</span>
                            </div>
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200 font-mono-code text-[10px] font-bold px-2 py-0.5 rounded">
                                Enkripsi SHA-256 Valid
                            </span>
                        </div>

                        <div class="space-y-2.5">
                            @forelse($auditLogs as $log)
                            <div class="p-2.5 bg-slate-50 border border-slate-100 rounded-lg text-xs font-mono-code flex items-start justify-between gap-3">
                                <div>
                                    <div class="font-bold text-slate-800">{{ $log['title'] }}</div>
                                    <div class="text-[11px] text-slate-500 mt-0.5">{{ $log['desc'] }}</div>
                                    <div class="text-[10px] text-slate-400 mt-1">IP: {{ $log['ip'] }}</div>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <div class="text-[10.5px] font-bold text-slate-500">{{ $log['time'] }}</div>
                                    <span class="inline-block mt-1 text-[9px] font-bold bg-emerald-100 text-emerald-800 px-1.5 py-0.2 rounded border border-emerald-200">
                                        {{ $log['valid_hash'] ?? 'SAH SECARA HUKUM' }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="p-4 text-center text-xs text-slate-400 bg-slate-50/50 rounded-lg border border-dashed border-slate-200">
                                <i class="fa-solid fa-signature text-slate-300 text-base mb-1"></i>
                                <div>Belum ada log approval digital tercatat.</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Saat customer menyetujui penawaran WhatsApp, sertifikat digital otomatis terbit di sini.</div>
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <!-- ================================================= -->
                <!-- RIGHT COLUMN: LIVE INTERACTIVE PREVIEWS (5 COLS)  -->
                <!-- ================================================= -->
                <div class="lg:col-span-5 space-y-4">
                    
                    <!-- Widget 1: Live WhatsApp Message Preview -->
                    <div class="bg-white border border-slate-200 rounded-xl shadow-xs overflow-hidden">
                        
                        <!-- Header -->
                        <div class="p-3 border-b border-slate-100 flex items-center justify-between bg-slate-50/60">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                <span>Live WhatsApp Message Preview</span>
                            </div>
                            <span class="bg-brand-50 text-brand-700 border border-brand-200 font-mono-code text-[10px] font-bold px-2 py-0.5 rounded">
                                Tiket Aktif: {{ $selectedApproval['kode'] ?? '#TK-XXXX' }}
                            </span>
                        </div>

                        <!-- Phone Chat Container -->
                        <div class="p-4 bg-[#e5ddd5]/40 min-h-[380px]">
                            
                            <!-- WhatsApp Business Contact Header -->
                            <div class="bg-[#075e54] text-white p-2.5 rounded-xl shadow-xs flex items-center justify-between mb-3 text-xs">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center font-bold text-sm">
                                        <i class="fa-solid fa-screwdriver-wrench text-xs text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold flex items-center gap-1 leading-tight">
                                            <span>TechFix Pro Official Service</span>
                                            <i class="fa-solid fa-circle-check text-[10px] text-sky-400"></i>
                                        </div>
                                        <div class="text-[10px] text-emerald-100">Akun Resmi Layanan Perbaikan Hardware</div>
                                    </div>
                                </div>
                                <i class="fa-solid fa-ellipsis-vertical text-white/70"></i>
                            </div>

                            <!-- Chat Date Pill -->
                            <div class="text-center my-2">
                                <span class="bg-white/80 border border-slate-200 text-slate-500 font-mono-code text-[9.5px] font-bold px-2 py-0.5 rounded-full uppercase shadow-2xs">
                                    HARI INI
                                </span>
                            </div>

                            <!-- WhatsApp Message Balloon -->
                            <div class="wa-bubble-chat p-3.5 text-xs text-slate-800 space-y-2.5 border border-slate-200/60">
                                
                                <div>
                                    <p class="leading-relaxed">
                                        Halo Bpk./Ibu <strong>{{ $selectedApproval['nama_pelanggan'] ?? '[Nama Pelanggan]' }}</strong>,
                                    </p>
                                    <p class="leading-relaxed mt-1 text-slate-600">
                                        Unit laptop/perangkat Anda <strong>{{ $selectedApproval['device'] ?? '[Perangkat]' }}</strong> (Tiket: <span class="font-mono-code text-brand-700 font-bold">{{ $selectedApproval['kode'] ?? '#TK-XXXX' }}</span>) telah selesai diperiksa oleh tim teknisi kami.
                                    </p>
                                </div>

                                <!-- Box Hasil Diagnosa Teknisi -->
                                <div class="bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-[11px]">
                                    <div class="text-[9.5px] font-mono-code font-bold text-sky-700 uppercase tracking-wider mb-1 flex items-center gap-1">
                                        <i class="fa-solid fa-microscope text-[10px]"></i>
                                        <span>Hasil Diagnosa Teknisi:</span>
                                    </div>
                                    <div class="text-slate-700 leading-relaxed font-medium">
                                        {{ $selectedApproval['diagnosa'] ?? 'Ditemukan kerusakan kelistrikan pada komponen internal.' }}
                                    </div>
                                </div>

                                <!-- Box Rincian Estimasi Biaya -->
                                <div class="bg-slate-50 border border-slate-200 rounded-lg p-2.5 text-[11px] font-mono-code">
                                    <div class="text-[9.5px] font-bold text-slate-500 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                                        <span>RINCIAN ESTIMASI BIAYA:</span>
                                    </div>
                                    <div class="space-y-1 text-slate-600">
                                        @if(!empty($selectedApproval['rincian']))
                                            @foreach($selectedApproval['rincian'] as $r)
                                            <div class="flex justify-between">
                                                <span>• {{ $r['item'] }}</span>
                                                <span class="font-bold text-slate-800">{{ $r['harga'] }}</span>
                                            </div>
                                            @endforeach
                                        @else
                                            <div class="flex justify-between">
                                                <span>• Jasa Perbaikan & Rekonstruksi</span>
                                                <span class="font-bold text-slate-800">{{ $selectedApproval['biaya'] ?? 'Rp 0' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex justify-between items-center pt-2 mt-2 border-t border-slate-200 text-slate-900 font-bold">
                                        <span>TOTAL ESTIMASI:</span>
                                        <span class="text-brand-700 text-xs">{{ $selectedApproval['biaya'] ?? 'Rp 0' }}</span>
                                    </div>
                                </div>

                                <!-- Waktu & Tracking Link -->
                                <div class="text-[10.5px] text-slate-500 leading-relaxed">
                                    Estimasi waktu pengerjaan: <strong>{{ $selectedApproval['estimasi_waktu'] ?? '1 - 2 Hari Kerja' }}</strong> setelah disetujui.
                                </div>
                                <div class="text-[10.5px] font-mono-code text-sky-600 hover:underline flex items-center gap-1">
                                    <i class="fa-solid fa-link text-[9px]"></i>
                                    <span>{{ $selectedApproval['tracking_url'] ?? 'https://track.techfix.id/TK-XXXX/approval' }}</span>
                                </div>

                                <div class="text-right text-[10px] font-mono-code text-slate-400 flex items-center justify-end gap-1">
                                    <span>{{ $selectedApproval['created_at'] ?? '13:42' }}</span>
                                    <i class="fa-solid fa-check-double text-sky-500 text-[10px]"></i>
                                </div>
                            </div>

                            <!-- Interactive WhatsApp Action Buttons (Simulasi) -->
                            <div class="mt-2.5 space-y-1.5">
                                @if($selectedApproval)
                                <form action="{{ route('techfix.tracking.status', $selectedApproval['id']) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="Disetujui">
                                    <button type="submit" 
                                        class="w-full py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold flex items-center justify-center gap-1.5 shadow-xs transition-colors">
                                        <i class="fa-solid fa-circle-check text-xs"></i>
                                        <span>✓ Setujui & Kerjakan Unit</span>
                                    </button>
                                </form>

                                <div class="grid grid-cols-2 gap-1.5">
                                    <form action="{{ route('techfix.tracking.status', $selectedApproval['id']) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="Ditolak">
                                        <button type="submit" 
                                            class="w-full py-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-rose-600 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition-colors">
                                            <i class="fa-solid fa-xmark text-xs"></i>
                                            <span>Tolak & Ambil</span>
                                        </button>
                                    </form>
                                    <button type="button" onclick="toastMsg('Membuka live chat komunikasi teknisi...')"
                                        class="py-1.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition-colors">
                                        <i class="fa-regular fa-comment text-xs"></i>
                                        <span>Tanya Teknisi</span>
                                    </button>
                                </div>
                                @else
                                <div class="p-3 bg-white/70 border border-slate-200 rounded-xl text-center text-[11px] text-slate-400">
                                    Pilih atau buat estimasi tiket untuk menguji interaksi tombol WhatsApp.
                                </div>
                                @endif
                            </div>

                        </div>

                    </div>

                    <!-- Widget 2: Tampilan Web Tracking Pelanggan (Mobile Viewport) -->
                    <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-xs">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3 text-xs">
                            <div class="flex items-center gap-2 font-bold text-slate-800">
                                <i class="fa-solid fa-mobile-screen-button text-brand-600"></i>
                                <span>Tampilan Web Tracking Pelanggan</span>
                            </div>
                            <span class="text-slate-400 font-mono-code text-[10.5px]">Mobile Viewport</span>
                        </div>

                        <!-- Stepper Progress 5 Langkah -->
                        <div class="mb-4">
                            <div class="text-[10px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-2">
                                STATUS PROGRES SERVIS LIVE
                            </div>
                            <div class="flex items-center justify-between text-center relative">
                                <div class="absolute left-3 right-3 top-3 h-0.5 bg-slate-200 -z-0"></div>
                                
                                <div class="flex flex-col items-center relative z-10">
                                    <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-mono-code text-[10px] font-bold flex items-center justify-center shadow-xs">✓</span>
                                    <span class="text-[9.5px] font-bold text-slate-700 mt-1">Check-In</span>
                                </div>
                                <div class="flex flex-col items-center relative z-10">
                                    <span class="w-6 h-6 rounded-full bg-emerald-500 text-white font-mono-code text-[10px] font-bold flex items-center justify-center shadow-xs">✓</span>
                                    <span class="text-[9.5px] font-bold text-slate-700 mt-1">Diagnosa</span>
                                </div>
                                <div class="flex flex-col items-center relative z-10">
                                    <span class="w-6 h-6 rounded-full bg-brand-700 text-white font-mono-code text-[10px] font-bold flex items-center justify-center shadow-xs">3</span>
                                    <span class="text-[9.5px] font-bold text-brand-700 mt-1">Approval</span>
                                </div>
                                <div class="flex flex-col items-center relative z-10">
                                    <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-400 border border-slate-200 font-mono-code text-[10px] font-bold flex items-center justify-center">4</span>
                                    <span class="text-[9.5px] text-slate-400 mt-1">Pengerjaan</span>
                                </div>
                                <div class="flex flex-col items-center relative z-10">
                                    <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-400 border border-slate-200 font-mono-code text-[10px] font-bold flex items-center justify-center">5</span>
                                    <span class="text-[9.5px] text-slate-400 mt-1">Ambil Unit</span>
                                </div>
                            </div>
                        </div>

                        <!-- Dokumentasi Bukti Kerusakan Fisik -->
                        <div class="mb-4">
                            <div class="text-[10px] font-mono-code font-bold text-slate-400 uppercase tracking-wider mb-2">
                                DOKUMENTASI BUKTI KERUSAKAN FISIK
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-center text-xs">
                                <div class="bg-slate-900 text-white rounded-lg p-2.5 h-16 flex flex-col justify-end relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                    <span class="relative z-10 text-[10px] font-bold">Korosi Jalur Motherboard</span>
                                </div>
                                <div class="bg-slate-900 text-white rounded-lg p-2.5 h-16 flex flex-col justify-end relative overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                    <span class="relative z-10 text-[10px] font-bold">Battery Diagnostic Log</span>
                                </div>
                            </div>
                        </div>

                        <!-- Jaminan Garansi TechFix -->
                        <div class="p-3 bg-sky-50/70 border border-sky-100 rounded-xl flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved text-sky-600 text-base"></i>
                                <div>
                                    <div class="font-bold text-slate-800 leading-tight">Jaminan Garansi TechFix</div>
                                    <div class="text-[10px] text-slate-500 mt-0.5">Garansi Jasa 30 Hari + Garansi Sparepart 180 Hari</div>
                                </div>
                            </div>
                            <span class="bg-sky-100 text-sky-700 font-mono-code text-[9.5px] font-bold px-2 py-0.5 rounded">
                                TERLINDUNGI
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- ========================================================= -->
    <!-- MODAL: + BUAT ESTIMASI BARU                               -->
    <!-- ========================================================= -->
    <div id="estimasiModal" class="fixed inset-y-0 inset-x-0 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-lg w-full p-6 shadow-2xl animate-in">
            
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-700 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-plus text-xs"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-display font-bold text-slate-900 leading-tight">Buat Penawaran Estimasi WhatsApp</h3>
                        <p class="text-[11px] text-slate-400">Kirim rincian biaya & link persetujuan langsung ke nomor pelanggan</p>
                    </div>
                </div>
                <button onclick="closeEstimasiModal()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <form action="{{ route('techfix.tracking.store') }}" method="POST" class="space-y-3.5 text-xs">
                @csrf

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nama Pelanggan *</label>
                        <input type="text" name="nama_pelanggan" required placeholder="Contoh: Ir. Bambang Sutedjo"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Nomor WhatsApp *</label>
                        <input type="text" name="phone" required placeholder="+62 811-xxxx-xxxx"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Perangkat / Device *</label>
                        <input type="text" name="device" required placeholder="Lenovo ThinkPad X1 / MacBook M1"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Serial Number</label>
                        <input type="text" name="serial" placeholder="PF29A098"
                            class="w-full px-3 py-2 font-mono-code border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Diagnosa Kerusakan & Komponen *</label>
                    <textarea name="diagnosa" required rows="2" placeholder="Jelaskan temuan kerusakan teknisi..."
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600 resize-none"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Total Estimasi Biaya (Rp) *</label>
                        <input type="number" name="biaya" required placeholder="1850000"
                            class="w-full px-3 py-2 font-mono-code border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                    <div>
                        <label class="block font-semibold text-slate-700 mb-1">Estimasi Waktu Pengerjaan</label>
                        <input type="text" name="estimasi_waktu" placeholder="1 - 2 Hari Kerja"
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-600">
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeEstimasiModal()" class="px-4 py-2 border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 font-medium">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-brand-700 hover:bg-brand-800 text-white rounded-lg font-semibold shadow-xs">
                        Kirim Approval via WhatsApp
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- MODAL: TEMPLATE PESAN SERVIS                              -->
    <!-- ========================================================= -->
    <div id="templateModal" class="fixed inset-y-0 inset-x-0 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center z-50 p-4 hidden">
        <div class="bg-white rounded-2xl border border-slate-200 max-w-lg w-full p-6 shadow-2xl animate-in text-xs">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                <div class="font-bold text-slate-900 text-sm">Template Pesan WhatsApp Otomatis</div>
                <button onclick="document.getElementById('templateModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="space-y-3">
                <div>
                    <label class="font-semibold text-slate-700 block mb-1">Template Penawaran Biaya (Approval)</label>
                    <textarea rows="4" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-lg font-mono-code text-[11px]" readonly>Halo Bpk/Ibu @{{nama_pelanggan}}, unit @{{device}} (@{{kode_tiket}}) telah selesai didiagnosa: @{{diagnosa}}. Total estimasi: @{{biaya}}. Setujui melalui link: @{{tracking_url}}</textarea>
                </div>
                <div>
                    <label class="font-semibold text-slate-700 block mb-1">Template Pengingat (Reminder 24 Jam)</label>
                    <textarea rows="2" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-lg font-mono-code text-[11px]" readonly>Halo Bpk/Ibu @{{nama_pelanggan}}, penawaran servis tiket @{{kode_tiket}} menunggu respon persetujuan Anda.</textarea>
                </div>
            </div>
            <div class="flex justify-end pt-3 mt-3 border-t border-slate-100">
                <button onclick="document.getElementById('templateModal').classList.add('hidden'); toastMsg('Template pesan diperbarui!')" 
                    class="px-4 py-1.5 bg-brand-700 text-white rounded-lg font-semibold">Tutup & Simpan</button>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- JAVASCRIPT HELPERS                                        -->
    <!-- ========================================================= -->
    <script>
        function openEstimasiModal() {
            document.getElementById('estimasiModal').classList.remove('hidden');
        }
        function closeEstimasiModal() {
            document.getElementById('estimasiModal').classList.add('hidden');
        }

        function openTemplateModal() {
            document.getElementById('templateModal').classList.remove('hidden');
        }

        function triggerBulkPing() {
            alert('Mengirim pengingat WhatsApp secara masal ke semua tiket yang belum merespon dalam 12 jam terakhir...\nSistem selesai memproses broadcast.');
        }

        function toastMsg(msg) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-5 right-5 bg-slate-900 text-white text-xs px-4 py-2.5 rounded-xl shadow-xl z-50 flex items-center gap-2 border border-slate-800 animate-in';
            toast.innerHTML = `<i class="fa-solid fa-circle-info text-sky-400"></i> <span>${msg}</span>`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3200);
        }

        // Live filter on table
        document.getElementById('filterInput')?.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase().trim();
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(term)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
