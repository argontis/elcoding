<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RestoHub OS — Reservasi & Loyalty Hub</title>
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
        .tier-chip.active { background-color: #0f172a; color: #ffffff; font-weight: 700; }
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

                <a href="{{ route('resto.inventaris') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fas fa-boxes-stacked text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>Inventaris &amp; Resep</span>
                </a>

                <a href="{{ route('resto.member') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#8c280e] text-white shadow-sm shadow-orange-900/20 transition-all">
                    <i class="fas fa-address-book text-sm w-4 text-center"></i>
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
                            <span class="text-[10px] font-extrabold tracking-widest text-rose-700 uppercase bg-rose-50 border border-rose-200/60 px-2 py-0.5 rounded-md flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-600 pulse-subtle"></span> LIVE DESK
                            </span>
                            <span class="text-[11px] font-semibold text-slate-400">
                                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                            </span>
                        </div>
                        <h1 class="font-heading font-black text-2xl tracking-tight text-slate-900 leading-tight">
                            Reservasi &amp; Loyalty Hub
                        </h1>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            Kelola pemesanan meja real-time, retensi pelanggan setia, dan pertumbuhan poin rewards.
                        </p>
                    </div>

                    <!-- 4 Action Buttons -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <button onclick="openModal('reservasiModal')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20 transition-all">
                            <i class="fas fa-circle-plus"></i>
                            <span>+ Input Reservasi Baru</span>
                        </button>
                        <button onclick="openModal('memberModal')" class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-sm transition-all">
                            <i class="fas fa-user-plus"></i>
                            <span>+ Daftarkan Member</span>
                        </button>
                        <button onclick="openModal('tierModal')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                            <i class="fas fa-crown text-amber-500"></i>
                            <span>Kelola Tier</span>
                        </button>
                        <button onclick="exportMemberCSV()" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                            <i class="fas fa-file-export text-slate-400"></i>
                            <span>Ekspor CRM</span>
                        </button>
                    </div>
                </div>

                <!-- 6 SUMMARY STAT CARDS -->
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5">
                    
                    <!-- Card 1: Total Reservasi -->
                    <div class="bg-white rounded-2xl p-3.5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">Total Reservasi</div>
                            <i class="fas fa-calendar-check text-[#a33315] text-xs"></i>
                        </div>
                        <div class="my-1.5">
                            <div class="flex items-baseline gap-1">
                                <span class="font-heading font-black text-2xl text-slate-900">{{ $totalReservasi }}</span>
                                <span class="text-[10px] font-bold text-slate-500">Meja Hari Ini</span>
                            </div>
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">
                            <span class="text-rose-600 font-bold">{{ $totalReservasi > 0 ? '100%' : '0%' }}</span> Kapasitas Dinner
                        </div>
                    </div>

                    <!-- Card 2: Terkonfirmasi & Duduk -->
                    <div class="bg-white rounded-2xl p-3.5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">Terkonfirmasi &amp; Duduk</div>
                            <i class="fas fa-circle-check text-emerald-600 text-xs"></i>
                        </div>
                        <div class="my-1.5">
                            <div class="flex items-baseline gap-1.5">
                                <span class="font-heading font-black text-2xl text-slate-900">{{ $terkonfirmasi }}</span>
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-extrabold bg-emerald-100 text-emerald-700">+{{ $terkonfirmasi }} Hadir</span>
                            </div>
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">
                            {{ $terkonfirmasi }} Terkonfirmasi, 0 In-House
                        </div>
                    </div>

                    <!-- Card 3: Menunggu DP -->
                    <div class="bg-white rounded-2xl p-3.5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">Menunggu DP</div>
                            <i class="fas fa-hourglass-half text-amber-500 text-xs"></i>
                        </div>
                        <div class="my-1.5">
                            <div class="flex items-baseline gap-1">
                                <span class="font-heading font-black text-2xl text-slate-900">{{ $menungguDp }}</span>
                                <span class="text-[10px] font-bold text-slate-500">Slot</span>
                            </div>
                        </div>
                        <div class="text-[10px] text-rose-600 font-bold">
                            {{ $menungguDp }} Kadaluarsa dlm 30m
                        </div>
                    </div>

                    <!-- Card 4: Member CRM -->
                    <div class="bg-white rounded-2xl p-3.5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">Member CRM</div>
                            <i class="fas fa-users text-indigo-600 text-xs"></i>
                        </div>
                        <div class="my-1.5">
                            <div class="flex items-baseline gap-1.5">
                                <span class="font-heading font-black text-2xl text-slate-900">{{ number_format($totalMember, 0, ',', '.') }}</span>
                                <span class="text-[9px] font-bold text-emerald-600">+{{ $totalMember }} mgg ini</span>
                            </div>
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">
                            Database terverifikasi
                        </div>
                    </div>

                    <!-- Card 5: Repeat Rate -->
                    <div class="bg-white rounded-2xl p-3.5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">Repeat Rate</div>
                            <i class="fas fa-arrows-rotate text-orange-600 text-xs"></i>
                        </div>
                        <div class="my-1.5">
                            <div class="flex items-baseline gap-1">
                                <span class="font-heading font-black text-2xl text-slate-900">{{ $repeatRate }}%</span>
                                <span class="text-[10px] font-semibold text-slate-500">retensi</span>
                            </div>
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-[#a33315] h-full rounded-full" style="width: {{ $repeatRate }}%"></div>
                        </div>
                    </div>

                    <!-- Card 6: Poin Beredar -->
                    <div class="bg-white rounded-2xl p-3.5 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">Poin Beredar</div>
                            <i class="fas fa-coins text-amber-500 text-xs"></i>
                        </div>
                        <div class="my-1.5">
                            <div class="flex items-baseline gap-1">
                                <span class="font-heading font-black text-2xl text-slate-900">{{ number_format($totalPoin, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-bold text-amber-600">pts</span>
                            </div>
                        </div>
                        <div class="text-[10px] text-slate-400 font-medium">
                            Estimasi: Rp {{ number_format($poinValuasi, 0, ',', '.') }}
                        </div>
                    </div>

                </div>

                <!-- MIDDLE SECTION: 2 COLUMNS (Reservations List & Loyalty Rules/Search) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">
                    
                    <!-- LEFT 2 COLS: Live Desk Reservasi List -->
                    <div class="lg:col-span-2 space-y-3.5">
                        
                        <!-- Filter Bar for Reservations -->
                        <div class="bg-white rounded-2xl p-3 border border-slate-200/80 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1 px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-700 bg-slate-50">
                                    <i class="fas fa-calendar-day text-slate-400"></i>
                                    <span>{{ date('d M Y') }}</span>
                                </div>
                                <div class="flex items-center p-0.5 rounded-xl bg-slate-100 text-xs font-semibold text-slate-600">
                                    <button class="px-3 py-1 rounded-lg hover:text-slate-900">Lunch (11:30 - 15:00)</button>
                                    <button class="px-3 py-1 rounded-lg bg-white text-slate-900 font-bold shadow-sm">Dinner (18:00 - 22:00)</button>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-[11px] font-medium text-slate-400">Tampilan:</span>
                                <button class="w-7 h-7 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-xs">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <button class="w-7 h-7 rounded-lg text-slate-400 hover:bg-slate-100 flex items-center justify-center text-xs">
                                    <i class="fas fa-border-all"></i>
                                </button>
                            </div>
                        </div>

                        <!-- RESERVATION CARDS CONTAINER -->
                        <div class="space-y-3" id="reservationListContainer">
                            @forelse($reservasiList as $r)
                            <div class="bg-white rounded-2xl p-4 border-l-4 {{ ($r['status'] ?? '') === 'Menunggu DP' ? 'border-amber-500' : 'border-emerald-500' }} border-y border-r border-slate-200/80 shadow-sm flex flex-col sm:flex-row sm:items-start justify-between gap-4 transition-all hover:shadow-md">
                                
                                <div class="flex items-start gap-4">
                                    <!-- Time box -->
                                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-center min-w-[70px]">
                                        <div class="font-heading font-black text-base text-slate-900 leading-none">{{ $r['jam'] ?? '19:00' }}</div>
                                        <div class="text-[10px] font-black text-rose-700 uppercase mt-1">{{ $r['meja'] ?? 'VIP' }}</div>
                                        <div class="text-[9px] text-slate-400">{{ $r['jumlah_tamu'] ?? 2 }} Tamu</div>
                                    </div>

                                    <!-- Guest Details -->
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <h4 class="font-heading font-black text-sm text-slate-900">{{ $r['nama'] ?? 'Tamu' }}</h4>
                                            @if(($r['tier'] ?? '') === 'VIP' || ($r['tier'] ?? '') === 'GOLD')
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-amber-100 text-amber-800">★ VIP MEMBER</span>
                                            @elseif(($r['tier'] ?? '') === 'SILVER')
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-slate-200 text-slate-700">SILVER MEMBER</span>
                                            @elseif(($r['tier'] ?? '') === 'BRONZE')
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-orange-100 text-orange-800">BRONZE MEMBER</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-semibold bg-slate-100 text-slate-500">Non-Member</span>
                                            @endif

                                            <!-- DP Status Badge -->
                                            @if(($r['nominal_dp'] ?? 0) > 0)
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-emerald-100 text-emerald-700 flex items-center gap-1">
                                                    <i class="fas fa-check text-[8px]"></i> DP Lunas (Rp {{ number_format($r['nominal_dp'], 0, ',', '.') }})
                                                </span>
                                            @elseif(($r['status'] ?? '') === 'Menunggu DP')
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-amber-100 text-amber-800 flex items-center gap-1">
                                                    <i class="fas fa-clock text-[8px]"></i> Menunggu DP
                                                </span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-sky-100 text-sky-700 flex items-center gap-1">
                                                    <i class="fab fa-whatsapp text-[8px]"></i> Confirmed via WA
                                                </span>
                                            @endif
                                        </div>

                                        <div class="text-xs text-slate-500 flex items-center gap-3">
                                            <span class="font-medium">Acara: <strong class="text-slate-700">{{ $r['acara'] ?? 'Casual Dining' }}</strong></span>
                                            <span class="text-slate-300">&bull;</span>
                                            <span class="flex items-center gap-1"><i class="fab fa-whatsapp text-emerald-600"></i> {{ $r['phone'] ?? '-' }}</span>
                                            <span class="text-slate-300">&bull;</span>
                                            <span class="text-slate-400">{{ $r['area'] ?? 'Indoor' }}</span>
                                        </div>

                                        @if(!empty($r['catatan']))
                                        <div class="p-2 rounded-xl bg-amber-50 border border-amber-200/80 text-[11px] text-amber-900 mt-1.5 flex items-start gap-1.5">
                                            <i class="fas fa-circle-exclamation text-amber-600 text-xs mt-0.5"></i>
                                            <div><strong>Catatan Khusus:</strong> {{ $r['catatan'] }}</div>
                                        </div>
                                        @endif

                                        @if(!empty($r['fasilitas']))
                                        <div class="text-[11px] text-slate-500 flex items-center gap-1 mt-1">
                                            <i class="fas fa-chair text-slate-400"></i>
                                            <span><strong>Fasilitas:</strong> {{ $r['fasilitas'] }}</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:items-end gap-2 shrink-0">
                                    @if(($r['status'] ?? '') === 'Menunggu DP')
                                        <button onclick="showToast('Link tagihan DP QRIS berhasil dikirim via WA.', 'info')" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-[#8c280e] text-white text-xs font-bold shadow-sm hover:bg-[#731e09]">
                                            <i class="fas fa-qrcode text-xs"></i> Tagih DP QRIS
                                        </button>
                                    @else
                                        <form action="{{ route('resto.member.reservasi.status', $r['id'] ?? '') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="Tamu Tiba (Seated)">
                                            <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-600 text-white text-xs font-bold shadow-sm hover:bg-emerald-700">
                                                <i class="fas fa-chair text-xs"></i> Tamu Tiba (Seat)
                                            </button>
                                        </form>
                                    @endif

                                    <div class="flex items-center gap-1.5">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $r['phone'] ?? '') }}" target="_blank" class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 flex items-center justify-center text-xs" title="Chat WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <form action="{{ route('resto.member.reservasi.delete', $r['id'] ?? '') }}" method="POST" onsubmit="return confirm('Hapus reservasi ini?')" class="inline">
                                            @csrf
                                            <button type="submit" class="w-7 h-7 rounded-lg bg-slate-100 text-slate-400 hover:text-rose-600 flex items-center justify-center text-xs" title="Batalkan Reservasi">
                                                <i class="fas fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            @empty
                            <!-- EMPTY STATE (Default) -->
                            <div class="bg-white rounded-2xl p-12 border border-slate-200/80 shadow-sm text-center">
                                <div class="w-16 h-16 rounded-2xl bg-orange-50 text-[#a33315] flex items-center justify-center text-2xl mx-auto mb-3 shadow-sm">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <h3 class="font-heading font-black text-lg text-slate-800 mb-1">
                                    Belum Ada Reservasi Hari Ini
                                </h3>
                                <p class="text-xs text-slate-400 max-w-sm mx-auto mb-4 font-medium leading-relaxed">
                                    Tidak ada antrean atau reservasi meja untuk sesi ini. Klik tombol di bawah untuk mencatat reservasi tamu meja indoor maupun outdoor.
                                </p>
                                <button onclick="openModal('reservasiModal')" class="px-4 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20 transition-all inline-flex items-center gap-2">
                                    <i class="fas fa-circle-plus"></i>
                                    <span>+ Input Reservasi Baru</span>
                                </button>
                            </div>
                            @endforelse
                        </div>

                    </div>

                    <!-- RIGHT 1 COL: Loyalty Tier Rules & Quick Guest Lookup -->
                    <div class="space-y-4">
                        
                        <!-- Card 1: Tingkatan Loyalty Points -->
                        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                                <div>
                                    <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400">ATURAN PROGRAM</div>
                                    <h3 class="font-heading font-black text-sm text-slate-900">Tingkatan Loyalty Points</h3>
                                </div>
                                <button onclick="openModal('tierModal')" class="text-[11px] font-bold text-rose-700 hover:underline flex items-center gap-1">
                                    Atur Benefit <i class="fas fa-sliders text-[9px]"></i>
                                </button>
                            </div>

                            <div class="space-y-2.5">
                                <!-- Bronze -->
                                <div class="p-3 rounded-xl bg-orange-50/60 border border-orange-100 flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-orange-100 text-orange-800 flex items-center justify-center text-xs font-black">
                                            <i class="fas fa-shield"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-xs text-slate-800">BRONZE <span class="text-[10px] text-slate-400 font-normal">0 - 500 Pts</span></div>
                                            <div class="text-[10px] text-slate-500">Cashback 3% Poin Belanja</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-black text-slate-800 font-heading">{{ $bronzeCount }}</span>
                                        <div class="text-[9px] text-slate-400">Member</div>
                                    </div>
                                </div>

                                <!-- Silver -->
                                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-black">
                                            <i class="fas fa-medal"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-xs text-slate-800">SILVER <span class="text-[10px] text-slate-400 font-normal">501 - 2.000 Pts</span></div>
                                            <div class="text-[10px] text-slate-500">Cashback 5% + Free Welcome Drink</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-black text-slate-800 font-heading">{{ $silverCount }}</span>
                                        <div class="text-[9px] text-slate-400">Member</div>
                                    </div>
                                </div>

                                <!-- Gold / VIP -->
                                <div class="p-3 rounded-xl bg-amber-50/70 border border-amber-200/80 flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center text-xs font-black">
                                            <i class="fas fa-crown"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-xs text-slate-800">GOLD / VIP <span class="text-[10px] text-slate-400 font-normal">2.000+ Pts</span></div>
                                            <div class="text-[10px] text-slate-500">Cashback 10% + Free Dessert &bull; Prioritas Booking</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-black text-amber-700 font-heading">{{ $goldCount }}</span>
                                        <div class="text-[9px] text-slate-400">VIP</div>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-3 mt-3 border-t border-slate-100 text-[11px] text-slate-500 flex items-center justify-between">
                                <span>Distribusi Reduksi Poin Bulan Ini:</span>
                                <strong class="text-slate-800">Rp {{ number_format($poinValuasi * 0.15, 0, ',', '.') }} Ditukarkan</strong>
                            </div>
                        </div>

                        <!-- Card 2: Quick Guest Search & Loyalty Actions -->
                        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm space-y-3">
                            <div class="flex items-center justify-between">
                                <h3 class="font-heading font-black text-sm text-slate-900">Pencarian Tamu Meja</h3>
                                <i class="fas fa-id-card-clip text-slate-400"></i>
                            </div>
                            <p class="text-[11px] text-slate-400 leading-tight">
                                Ketik nama atau nomor WhatsApp tamu untuk verifikasi voucher atau status reservasi.
                            </p>

                            <div class="relative">
                                <i class="fas fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                <input type="text" id="quickSearchInput" onkeyup="filterMemberTable()" placeholder="Cari nama, WhatsApp, ID Member..." class="w-full pl-8 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            </div>

                            <div class="grid grid-cols-2 gap-2 pt-1">
                                <button onclick="openModal('tukarHadiahModal')" class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-bold text-slate-700 shadow-sm transition-all">
                                    <i class="fas fa-gift text-rose-500"></i>
                                    <span>Tukar Hadiah</span>
                                </button>
                                <button onclick="openModal('topupModal')" class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-bold text-slate-700 shadow-sm transition-all">
                                    <i class="fas fa-coins text-amber-500"></i>
                                    <span>Top-up Poin</span>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- BOTTOM FULL-WIDTH: Database Membership & CRM -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                    
                    <!-- Table Header & Controls -->
                    <div class="p-5 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-heading font-black text-base text-slate-900">
                                    Database Membership &amp; CRM
                                </h3>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-600">
                                    {{ $totalMember }} Member Aktif
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">
                                Pantau histori kunjungan, nilai belanja seumur hidup (LTV), serta preferensi menu tamu.
                            </p>
                        </div>

                        <!-- Tier Filter Chips & Search -->
                        <div class="flex items-center gap-2 flex-wrap">
                            <div class="flex items-center p-0.5 bg-slate-100 rounded-xl text-xs font-semibold">
                                <button onclick="filterMemberTier('semua', this)" class="tier-chip active px-3 py-1.5 rounded-lg transition-all">Semua Tier</button>
                                <button onclick="filterMemberTier('GOLD', this)" class="tier-chip px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition-all">Gold</button>
                                <button onclick="filterMemberTier('SILVER', this)" class="tier-chip px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition-all">Silver</button>
                                <button onclick="filterMemberTier('BRONZE', this)" class="tier-chip px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 transition-all">Bronze</button>
                            </div>

                            <div class="relative min-w-[180px]">
                                <input type="text" id="memberTableSearch" onkeyup="filterMemberTable()" placeholder="Filter member..." class="w-full px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:bg-white focus:outline-none focus:border-[#a33315]">
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-slate-50/80 border-b border-slate-200 text-[10px] font-extrabold uppercase tracking-wider text-slate-500 select-none">
                                <tr>
                                    <th class="px-5 py-3.5">PROFIL MEMBER</th>
                                    <th class="px-4 py-3.5">TIER LOYALITAS</th>
                                    <th class="px-4 py-3.5">SALDO POIN</th>
                                    <th class="px-4 py-3.5">KUNJUNGAN</th>
                                    <th class="px-4 py-3.5">TOTAL BELANJA (LTV)</th>
                                    <th class="px-4 py-3.5">MENU FAVORIT TAMU</th>
                                    <th class="px-4 py-3.5">KUNJUNGAN TERAKHIR</th>
                                    <th class="px-4 py-3.5 text-center">AKSI CEPAT</th>
                                </tr>
                            </thead>
                            <tbody id="memberTableBody" class="divide-y divide-slate-100">
                                @forelse($memberList as $m)
                                <tr class="hover:bg-slate-50/60 transition-colors member-row" 
                                    data-tier="{{ strtoupper($m['tier'] ?? '') }}" 
                                    data-search="{{ strtolower(($m['nama'] ?? '') . ' ' . ($m['phone'] ?? '')) }}">
                                    
                                    <!-- Profil Member -->
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-orange-100 text-[#a33315] font-black text-xs flex items-center justify-center shrink-0">
                                                {{ $m['initials'] ?? 'MB' }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900">{{ $m['nama'] ?? '-' }}</div>
                                                <div class="text-[10px] text-slate-400 flex items-center gap-1">
                                                    <i class="fab fa-whatsapp text-emerald-500"></i> {{ $m['phone'] ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Tier Loyalitas -->
                                    <td class="px-4 py-3.5">
                                        @if(($m['tier'] ?? '') === 'GOLD' || ($m['tier'] ?? '') === 'VIP')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-black bg-amber-100 text-amber-800">
                                                <i class="fas fa-crown text-[9px]"></i> GOLD VIP
                                            </span>
                                        @elseif(($m['tier'] ?? '') === 'SILVER')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-black bg-slate-200 text-slate-700">
                                                <i class="fas fa-medal text-[9px]"></i> SILVER
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-black bg-orange-100 text-orange-800">
                                                <i class="fas fa-shield text-[9px]"></i> BRONZE
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Saldo Poin -->
                                    <td class="px-4 py-3.5">
                                        <div class="font-heading font-black text-slate-900 text-sm">
                                            {{ number_format($m['poin'] ?? 0, 0, ',', '.') }} <span class="text-xs text-amber-600">Pts</span>
                                        </div>
                                        <div class="text-[10px] text-slate-400">
                                            Setara Rp {{ number_format(($m['poin'] ?? 0) * 100, 0, ',', '.') }}
                                        </div>
                                    </td>

                                    <!-- Kunjungan -->
                                    <td class="px-4 py-3.5 font-heading font-black text-base text-slate-800">
                                        {{ $m['kunjungan'] ?? 1 }}x
                                    </td>

                                    <!-- Total Belanja LTV -->
                                    <td class="px-4 py-3.5">
                                        <div class="font-bold text-slate-900">
                                            Rp {{ number_format($m['ltv'] ?? 0, 0, ',', '.') }}
                                        </div>
                                        <div class="text-[10px] text-slate-400">
                                            Rata-rata: Rp {{ number_format(($m['ltv'] ?? 0) / max(1, $m['kunjungan'] ?? 1), 0, ',', '.') }}/visit
                                        </div>
                                    </td>

                                    <!-- Menu Favorit -->
                                    <td class="px-4 py-3.5">
                                        <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[11px] font-medium">
                                            {{ $m['menu_favorit'] ?? 'Belum Terdata' }}
                                        </span>
                                    </td>

                                    <!-- Kunjungan Terakhir -->
                                    <td class="px-4 py-3.5 text-slate-600">
                                        {{ $m['terakhir'] ?? 'Hari ini' }}
                                    </td>

                                    <!-- Aksi Cepat -->
                                    <td class="px-4 py-3.5 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $m['phone'] ?? '') }}" target="_blank" class="w-7 h-7 rounded-lg text-emerald-600 hover:bg-emerald-50 flex items-center justify-center" title="Kirim WA Voucher">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            <button onclick="showToast('Poin reward tamu berhasil ditambah.', 'success')" class="w-7 h-7 rounded-lg text-amber-600 hover:bg-amber-50 flex items-center justify-center" title="Tambah Poin">
                                                <i class="fas fa-circle-plus"></i>
                                            </button>
                                            <form action="{{ route('resto.member.delete', $m['id'] ?? '') }}" method="POST" onsubmit="return confirm('Hapus member ini dari database?')" class="inline">
                                                @csrf
                                                <button type="submit" class="w-7 h-7 rounded-lg text-slate-400 hover:text-rose-600 flex items-center justify-center" title="Hapus Member">
                                                    <i class="fas fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <!-- EMPTY STATE (Default) -->
                                <tr>
                                    <td colspan="8" class="py-14 text-center">
                                        <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                            <div class="w-16 h-16 rounded-2xl bg-slate-100 border border-slate-200/60 flex items-center justify-center text-2xl text-slate-400 mb-3 shadow-inner">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <h4 class="font-heading font-black text-base text-slate-800 mb-1">
                                                Belum Ada Data Member
                                            </h4>
                                            <p class="text-xs text-slate-400 font-medium leading-relaxed mb-4">
                                                Database membership masih kosong. Daftarkan pelanggan setia baru untuk mulai mengakumulasikan poin dan riwayat pesanan.
                                            </p>
                                            <button onclick="openModal('memberModal')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-sm transition-all">
                                                <i class="fas fa-user-plus"></i>
                                                <span>+ Daftarkan Member Pertama</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer / Pagination -->
                    <div class="px-5 py-3 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between text-xs text-slate-500">
                        <div>
                            Menampilkan <span class="font-bold text-slate-800">{{ $totalMember }}</span> member terdaftar
                        </div>
                        <div class="flex items-center gap-1">
                            <button class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white text-slate-400 cursor-not-allowed font-medium text-[11px]">Sebelumnya</button>
                            <button class="px-2.5 py-1 rounded-lg bg-[#8c280e] text-white font-bold text-[11px]">1</button>
                            <button class="px-2.5 py-1 rounded-lg border border-slate-200 bg-white text-slate-400 cursor-not-allowed font-medium text-[11px]">Selanjutnya</button>
                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODALS                                                         -->
    <!-- ============================================================== -->

    <!-- 1. Modal Input Reservasi Baru -->
    <div id="reservasiModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#a33315] flex items-center justify-center text-lg font-black">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Input Reservasi Baru</h3>
                        <p class="text-xs text-slate-400">Catat reservasi meja tamu untuk shift mendatang</p>
                    </div>
                </div>
                <button onclick="closeModal('reservasiModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('resto.member.reservasi.create') }}" method="POST" class="space-y-3.5">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Nama Tamu *</label>
                        <input type="text" name="nama" required placeholder="Bpk. Irwan Santoso" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">No. WhatsApp *</label>
                        <input type="text" name="phone" required placeholder="+62 811-3329-8871" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Jam Kedatangan</label>
                        <input type="time" name="jam" value="19:00" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Pilih Meja</label>
                        <input type="text" name="meja" placeholder="VIP-01 / Meja 04" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Jumlah Tamu</label>
                        <input type="number" name="jumlah_tamu" value="4" min="1" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Area Meja</label>
                        <select name="area" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="Indoor AC">Indoor AC</option>
                            <option value="Al Fresco Outdoor">Al Fresco Outdoor</option>
                            <option value="Private VIP Room">Private VIP Room</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Status Tamu</label>
                        <select name="tier" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="VIP">★ VIP Member</option>
                            <option value="GOLD">Gold Member</option>
                            <option value="SILVER">Silver Member</option>
                            <option value="BRONZE">Bronze Member</option>
                            <option value="Non-Member">Non-Member</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Nominal DP (Rp)</label>
                        <input type="number" name="nominal_dp" placeholder="0" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Acara / Momen</label>
                    <input type="text" name="acara" placeholder="Ulang Tahun Keluarga / Wedding Anniversary" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Catatan Khusus Tamu</label>
                    <textarea name="catatan" rows="2" placeholder="Contoh: Bawa kue sendiri, request table decor bunga & piring dessert extra" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeModal('reservasiModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20">
                        Simpan Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. Modal Daftarkan Member -->
    <div id="memberModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center text-lg font-black">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Daftarkan Member CRM</h3>
                        <p class="text-xs text-slate-400">Registrasi pelanggan ke program loyalitas</p>
                    </div>
                </div>
                <button onclick="closeModal('memberModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('resto.member.create') }}" method="POST" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Nama Lengkap *</label>
                    <input type="text" name="nama" required placeholder="Hendra Gunawan" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">No. WhatsApp *</label>
                    <input type="text" name="phone" required placeholder="+62 812-9843-7721" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Tier Loyalitas</label>
                        <select name="tier" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="BRONZE">BRONZE (0-500 pts)</option>
                            <option value="SILVER">SILVER (501-2.000 pts)</option>
                            <option value="GOLD">GOLD VIP (2.000+ pts)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Bonus Poin Awal</label>
                        <input type="number" name="poin" value="100" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Menu Favorit (Opsional)</label>
                    <input type="text" name="menu_favorit" placeholder="Wagyu Ribeye, Iced Spanish Latte" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeModal('memberModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold shadow-sm">
                        Simpan Member
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Modal Kelola Tier -->
    <div id="tierModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg font-black">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Kelola Benefit Tier</h3>
                        <p class="text-xs text-slate-400">Atur batas poin &amp; persentase cashback loyalty</p>
                    </div>
                </div>
                <button onclick="closeModal('tierModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3.5 text-xs">
                <div class="p-3 rounded-xl bg-orange-50 border border-orange-100 space-y-1">
                    <div class="font-bold text-slate-800 flex items-center justify-between">
                        <span>Tier Bronze</span>
                        <span class="text-[10px] text-orange-700 font-extrabold">3% Cashback</span>
                    </div>
                    <div class="text-[11px] text-slate-500">Ambang: 0 - 500 Poin. Berlaku untuk seluruh pelanggan baru.</div>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 space-y-1">
                    <div class="font-bold text-slate-800 flex items-center justify-between">
                        <span>Tier Silver</span>
                        <span class="text-[10px] text-slate-700 font-extrabold">5% Cashback + Free Drink</span>
                    </div>
                    <div class="text-[11px] text-slate-500">Ambang: 501 - 2.000 Poin. Otomatis naik setelah 5x transaksi.</div>
                </div>

                <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 space-y-1">
                    <div class="font-bold text-slate-800 flex items-center justify-between">
                        <span>Tier Gold / VIP</span>
                        <span class="text-[10px] text-amber-700 font-extrabold">10% Cashback + Prioritas</span>
                    </div>
                    <div class="text-[11px] text-slate-500">Ambang: 2.000+ Poin. Prioritas meja tanpa antre & free dessert.</div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeModal('tierModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Tutup</button>
                    <button onclick="closeModal('tierModal'); showToast('Konfigurasi tier berhasil disimpan.', 'success')" class="px-5 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold">
                        Simpan Aturan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Modal Tukar Hadiah -->
    <div id="tukarHadiahModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg font-black">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Tukar Poin Hadiah</h3>
                        <p class="text-xs text-slate-400">Pilih voucher diskon atau menu gratis</p>
                    </div>
                </div>
                <button onclick="closeModal('tukarHadiahModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3.5 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp Member</label>
                    <input type="text" placeholder="Masukkan nomor telepon member" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Pilihan Reward</label>
                    <select class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                        <option>Voucher Potongan Rp 25.000 (250 Poin)</option>
                        <option>Free Iced Spanish Latte (350 Poin)</option>
                        <option>Voucher Potongan Rp 50.000 (500 Poin)</option>
                        <option>Free Dessert Tiramisu Klasik (450 Poin)</option>
                        <option>Diskon 20% Total Bill (1.000 Poin)</option>
                    </select>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeModal('tukarHadiahModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Batal</button>
                    <button onclick="closeModal('tukarHadiahModal'); showToast('🎉 Voucher hadiah berhasil ditukarkan!', 'success')" class="px-5 py-2 rounded-xl bg-emerald-600 text-white text-xs font-bold">
                        Tukarkan Poin
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Modal Top-up Poin -->
    <div id="topupModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-black">
                        <i class="fas fa-coins"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Top-up / Koreksi Poin</h3>
                        <p class="text-xs text-slate-400">Tambahkan poin loyalitas untuk pelanggan</p>
                    </div>
                </div>
                <button onclick="closeModal('topupModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3.5 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp Tamu</label>
                    <input type="text" placeholder="+62 8xx-xxxx-xxxx" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Jumlah Poin Tambahan</label>
                    <input type="number" value="200" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Alasan Penambahan</label>
                    <input type="text" placeholder="Promo event ulang tahun / kompensasi layanan" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeModal('topupModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Batal</button>
                    <button onclick="closeModal('topupModal'); showToast('✅ Saldo poin tamu berhasil ditambah.', 'success')" class="px-5 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold">
                        Tambah Poin
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- JAVASCRIPT                                                     -->
    <!-- ============================================================== -->
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }
        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        // Filter Member Table
        let activeMemberTier = 'semua';

        function filterMemberTier(tier, btn) {
            activeMemberTier = tier;
            document.querySelectorAll('.tier-chip').forEach(c => {
                c.classList.remove('active', 'bg-[#0f172a]', 'text-white');
                c.classList.add('text-slate-600');
            });
            btn.classList.add('active', 'bg-[#0f172a]', 'text-white');
            btn.classList.remove('text-slate-600');
            filterMemberTable();
        }

        function filterMemberTable() {
            const search = (document.getElementById('memberTableSearch').value || document.getElementById('quickSearchInput').value || '').toLowerCase();
            const rows = document.querySelectorAll('.member-row');

            rows.forEach(r => {
                const matchSearch = r.dataset.search.includes(search);
                const matchTier = (activeMemberTier === 'semua' || r.dataset.tier === activeMemberTier);
                if (matchSearch && matchTier) {
                    r.style.display = '';
                } else {
                    r.style.display = 'none';
                }
            });
        }

        // Export Member CSV
        function exportMemberCSV() {
            const rows = document.querySelectorAll('.member-row');
            if (rows.length === 0) {
                showToast('Database member masih kosong untuk diekspor.', 'info');
                return;
            }
            let csv = "Nama,WhatsApp,Tier,Poin,Kunjungan,LTV,Menu Favorit\n";
            rows.forEach(r => {
                const text = r.innerText.replace(/\n+/g, ' | ').replace(/,/g, ';');
                csv += text + "\n";
            });
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('href', url);
            a.setAttribute('download', 'crm_member_restohub_' + new Date().toISOString().slice(0,10) + '.csv');
            a.click();
            showToast('✅ Berhasil mengekspor data CRM ke CSV.', 'success');
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