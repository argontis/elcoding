<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RestoHub OS — WhatsApp Marketing & Otomasi CRM</title>
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
        .wa-chat-bg {
            background-color: #0b141a;
            background-image: radial-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 16px 16px;
        }
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

                <a href="{{ route('resto.member') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fas fa-address-book text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>Reservasi &amp; Member</span>
                </a>

                <a href="{{ route('resto.marketing') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#8c280e] text-white shadow-sm shadow-orange-900/20 transition-all">
                    <i class="fab fa-whatsapp text-sm w-4 text-center"></i>
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
                    <button onclick="showToast('Tidak ada pesan gagal terkirim.', 'info')" class="relative w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:border-[#a33315] hover:text-[#a33315] transition-all">
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

                <!-- 1. OFFICIAL WABA STATUS BANNER -->
                <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="relative w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center text-2xl shadow-md shadow-emerald-500/20 shrink-0">
                            <i class="fab fa-whatsapp"></i>
                            <span class="absolute -bottom-1 -right-1 w-5 h-5 rounded-full bg-emerald-600 border-2 border-white flex items-center justify-center text-[10px]">
                                <i class="fas fa-check"></i>
                            </span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h2 class="font-heading font-black text-xl text-slate-900 leading-none">
                                    RestoHub Gourmet Official
                                </h2>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 flex items-center gap-1">
                                    <i class="fas fa-badge-check text-[9px]"></i> Meta Verified Official
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-slate-100 text-slate-600">
                                    Tier 3 (High Limit)
                                </span>
                            </div>
                            <div class="flex items-center gap-3 text-xs text-slate-500 mt-1.5 flex-wrap">
                                <span class="font-semibold text-slate-700 flex items-center gap-1">
                                    <i class="fas fa-phone text-slate-400 text-[10px]"></i> +62 821-3300-8800
                                </span>
                                <span class="text-slate-300">&bull;</span>
                                <span class="font-bold text-emerald-600 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 pulse-subtle"></span> Webhook Cloud API Aktif (200 OK)
                                </span>
                                <span class="text-slate-300">&bull;</span>
                                <span class="text-slate-500 font-medium">Quality Rating: <strong class="text-emerald-600">Tinggi (Green)</strong></span>
                            </div>
                        </div>
                    </div>

                    <!-- Right Buttons -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <button onclick="openModal('templateMetaModal')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                            <i class="fas fa-layer-group text-slate-400"></i>
                            <span>Pengaturan Template Meta</span>
                        </button>
                        <button onclick="openModal('quickBroadcastModal')" class="flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-bold text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                            <i class="fas fa-bolt text-amber-500"></i>
                            <span>Broadcast Cepat Jam Sepi</span>
                        </button>
                        <button onclick="openModal('kampanyeModal')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20 transition-all">
                            <i class="fas fa-circle-plus"></i>
                            <span>+ Buat Kampanye Baru</span>
                        </button>
                    </div>
                </div>

                <!-- 2. 4 TOP METRIC CARDS (KPIs) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Card 1: Kuota Blast Bulan Ini -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Kuota Blast Bulan Ini</div>
                                <div class="flex items-baseline gap-1 mt-1">
                                    <span class="font-heading font-black text-2xl text-slate-900">{{ number_format($totalBlast, 0, ',', '.') }}</span>
                                    <span class="text-xs font-bold text-slate-400">/ 10.000</span>
                                    <span class="ml-1 text-[10px] font-extrabold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded">{{ round(($totalBlast / 10000) * 100, 1) }}%</span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-orange-50 text-[#a33315] flex items-center justify-center text-sm">
                                <i class="fas fa-paper-plane"></i>
                            </div>
                        </div>
                        <div class="pt-3 mt-2 border-t border-slate-100 text-[11px] text-slate-500 font-medium">
                            Sisa <strong class="text-slate-800">{{ number_format($kuotaSisa, 0, ',', '.') }}</strong> kuota &bull; Reset dlm 9 hari
                        </div>
                    </div>

                    <!-- Card 2: Rata-Rata Open Rate -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Rata-Rata Open Rate</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-heading font-black text-2xl text-slate-900">{{ $openRate }}%</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700 flex items-center gap-1">
                                        <i class="fas fa-arrow-trend-up text-[9px]"></i> +3.4%
                                    </span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">
                                <i class="fas fa-eye"></i>
                            </div>
                        </div>
                        <div class="pt-3 mt-2 border-t border-slate-100 text-[11px] text-slate-500 font-medium">
                            Benchmark industri kuliner: ~82%
                        </div>
                    </div>

                    <!-- Card 3: Voucher Redeem Rate -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Voucher Redeem Rate</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-heading font-black text-2xl text-slate-900">{{ $redeemRate }}%</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">
                                        +0 Klaim
                                    </span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm">
                                <i class="fas fa-ticket"></i>
                            </div>
                        </div>
                        <div class="pt-3 mt-2 border-t border-slate-100 text-[11px] text-slate-500 font-medium">
                            Diverifikasi langsung oleh POS kasir
                        </div>
                    </div>

                    <!-- Card 4: Omzet Tambahan WA -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Omzet Tambahan WA</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="font-heading font-black text-2xl text-slate-900">{{ $omzetTambahan }}</span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-orange-100 text-orange-800">
                                        ROI 6.8x
                                    </span>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm">
                                <i class="fas fa-money-bill-trend-up"></i>
                            </div>
                        </div>
                        <div class="pt-3 mt-2 border-t border-slate-100 text-[11px] text-slate-500 font-medium">
                            Biaya Meta API: Rp 0
                        </div>
                    </div>

                </div>

                <!-- 3. MIDDLE SECTION: 2 COLUMNS (Triggers/Broadcasts & Live Chat Preview) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 items-start">
                    
                    <!-- LEFT 2 COLS: Triggers & Broadcasts -->
                    <div class="lg:col-span-2 space-y-5">
                        
                        <!-- CARD A: Otomasi Retensi Pelanggan (Always-On Triggers) -->
                        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-arrows-spin text-[#a33315] text-base"></i>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h3 class="font-heading font-black text-base text-slate-900">
                                                Otomasi Retensi Pelanggan (Always-On Triggers)
                                            </h3>
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800">
                                                4 Aktif
                                            </span>
                                        </div>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            Pemicu otomatis berjalan 24/7 tersinkronisasi database POS &amp; CRM RestoHub
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                @foreach($triggers as $t)
                                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/70 flex items-start justify-between gap-3 transition-all hover:bg-slate-100/50">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-orange-100 text-[#a33315] flex items-center justify-center text-xs shrink-0 mt-0.5">
                                            @if($loop->index == 0)
                                                <i class="fas fa-cake-candles"></i>
                                            @elseif($loop->index == 1)
                                                <i class="fas fa-rotate-left"></i>
                                            @elseif($loop->index == 2)
                                                <i class="fas fa-hourglass-end"></i>
                                            @else
                                                <i class="fas fa-star"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4 class="font-bold text-xs text-slate-900">{{ $t['judul'] }}</h4>
                                                <span class="px-1.5 py-0.2 rounded text-[9px] font-extrabold bg-emerald-100 text-emerald-700">Aktif</span>
                                            </div>
                                            <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">
                                                {{ $t['deskripsi'] }}
                                            </p>
                                            <div class="text-[10px] text-slate-400 mt-1 flex items-center gap-3">
                                                <span>{{ $t['target'] }}</span>
                                                <span>&bull;</span>
                                                <span>{{ $t['redeem'] }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col items-end gap-1 shrink-0">
                                        <!-- Interactive Toggle Switch -->
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked onchange="toggleTriggerAjax('{{ $t['id'] }}')" class="sr-only peer">
                                            <div class="w-9 h-5 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#a33315]"></div>
                                        </label>
                                        <button onclick="openModal('editTriggerModal')" class="text-[10px] font-bold text-rose-700 hover:underline">
                                            Ubah Template &rarr;
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CARD B: Kampanye Broadcast Terjadwal & Segmentasi -->
                        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                                <div>
                                    <h3 class="font-heading font-black text-base text-slate-900">
                                        Kampanye Broadcast Terjadwal &amp; Segmentasi
                                    </h3>
                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Laporan performa pengiriman pesan berbasis segmen audiens CRM
                                    </p>
                                </div>
                                <span class="px-2.5 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    Semua Cabang
                                </span>
                            </div>

                            <div class="space-y-3" id="campaignsContainer">
                                @forelse($campaigns as $c)
                                <div class="p-4 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow transition-all space-y-2">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full {{ ($c['status'] ?? '') === 'Selesai Berjalan' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                            <h4 class="font-bold text-xs text-slate-900">{{ $c['judul'] }}</h4>
                                        </div>
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold {{ ($c['status'] ?? '') === 'Selesai Berjalan' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                            {{ $c['status'] }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 leading-snug">{{ $c['deskripsi'] }}</p>
                                    <div class="grid grid-cols-4 gap-2 pt-2 border-t border-slate-100 text-[11px]">
                                        <div>
                                            <div class="text-[10px] text-slate-400">Target:</div>
                                            <div class="font-bold text-slate-800">{{ $c['target'] }} Audiens</div>
                                        </div>
                                        <div>
                                            <div class="text-[10px] text-slate-400">Terkirim:</div>
                                            <div class="font-bold text-slate-800">{{ $c['terkirim'] }} (100%)</div>
                                        </div>
                                        <div>
                                            <div class="text-[10px] text-slate-400">Dibaca:</div>
                                            <div class="font-bold text-slate-800">{{ $c['dibaca'] }}</div>
                                        </div>
                                        <div>
                                            <div class="text-[10px] text-slate-400">Voucher Dipakai:</div>
                                            <div class="font-bold text-emerald-600">{{ $c['voucher'] }} Transaksi</div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <!-- EMPTY STATE (Default) -->
                                <div class="py-12 text-center">
                                    <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center text-2xl mx-auto mb-3 shadow-inner">
                                        <i class="fas fa-bullhorn"></i>
                                    </div>
                                    <h4 class="font-heading font-black text-base text-slate-800 mb-1">
                                        Belum Ada Kampanye Broadcast
                                    </h4>
                                    <p class="text-xs text-slate-400 max-w-sm mx-auto mb-4 font-medium leading-relaxed">
                                        Belum ada pesan blast promosi atau pengumuman yang dijadwalkan. Klik tombol di bawah untuk mengirim pesan ke segmen pelanggan setia.
                                    </p>
                                    <button onclick="openModal('kampanyeModal')" class="px-4 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20 transition-all inline-flex items-center gap-2">
                                        <i class="fas fa-circle-plus"></i>
                                        <span>+ Buat Kampanye Baru</span>
                                    </button>
                                </div>
                                @endforelse
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT 1 COL: Live Chat Preview (Pelanggan) -->
                    <div class="space-y-4">
                        
                        <div class="bg-white rounded-3xl p-4 border border-slate-200/80 shadow-md">
                            
                            <!-- WhatsApp Preview Header -->
                            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-mobile-screen-button text-slate-400"></i>
                                    <span class="font-heading font-black text-xs text-slate-900">Live Chat Preview (Pelanggan)</span>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">WhatsApp Business App</span>
                            </div>

                            <!-- Phone Screen Frame -->
                            <div class="rounded-2xl overflow-hidden border border-slate-800 shadow-2xl bg-[#0b141a]">
                                
                                <!-- Top Bar WhatsApp App -->
                                <div class="bg-[#202c33] px-3 py-2.5 flex items-center justify-between text-white border-b border-slate-800">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-arrow-left text-slate-400 text-xs"></i>
                                        <div class="w-7 h-7 rounded-full bg-emerald-600 flex items-center justify-center text-xs font-bold">
                                            <i class="fas fa-utensils"></i>
                                        </div>
                                        <div>
                                            <div class="text-[11px] font-bold leading-tight flex items-center gap-1">
                                                RestoHub Gourmet <i class="fas fa-badge-check text-emerald-400 text-[10px]"></i>
                                            </div>
                                            <div class="text-[9px] text-slate-400 leading-tight">Official Business Account</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 text-slate-400 text-xs">
                                        <i class="fas fa-video"></i>
                                        <i class="fas fa-phone"></i>
                                        <i class="fas fa-ellipsis-vertical"></i>
                                    </div>
                                </div>

                                <!-- Chat Body Area -->
                                <div class="wa-chat-bg p-3 space-y-2.5 min-h-[380px] flex flex-col justify-end text-xs">
                                    
                                    <!-- Meta Security Notice -->
                                    <div class="p-2 rounded-lg bg-[#182229] border border-slate-800 text-center text-[9px] text-amber-200/70 leading-tight">
                                        <i class="fas fa-lock text-[8px]"></i> Pesan ke akun bisnis ini dilindungi enkripsi end-to-end Meta Official API.
                                    </div>

                                    <!-- Date Pill -->
                                    <div class="text-center">
                                        <span class="px-2 py-0.5 rounded bg-[#182229] text-[9px] text-slate-400 font-bold uppercase tracking-wider">HARI INI</span>
                                    </div>

                                    <!-- WhatsApp Rich Message Card Bubble -->
                                    <div class="bg-[#202c33] text-white rounded-2xl rounded-tl-none overflow-hidden max-w-[280px] shadow-lg border border-slate-700/50">
                                        
                                        <!-- Header Image Preview -->
                                        <div class="relative bg-gradient-to-tr from-amber-900 to-orange-800 h-28 flex items-center justify-center p-3 text-center overflow-hidden">
                                            <div class="absolute inset-0 bg-black/40"></div>
                                            <div class="relative z-10">
                                                <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-amber-400 text-slate-900 uppercase tracking-wider">
                                                    Gold Member Exclusive
                                                </span>
                                                <div class="font-heading font-black text-sm text-white mt-1">Classic Tiramisu</div>
                                                <div class="text-[10px] text-amber-200">Complimentary Special Dessert</div>
                                            </div>
                                        </div>

                                        <!-- Message Body Text -->
                                        <div class="p-3 space-y-2 text-[11px] leading-relaxed text-slate-200">
                                            <p>Halo <strong class="text-amber-400">Kak Hendra!</strong> 👋</p>
                                            <p class="text-slate-300">
                                                Kami rindu kehadiran Anda di <strong>RestoHub Bistro &amp; Cafe Grand Indonesia</strong>.
                                            </p>
                                            <p class="text-slate-300">
                                                Spesial untuk Gold Member kami, nikmati Compliment Dessert <em>'Classic Tiramisu'</em> dan diskon 15% untuk dine-in akhir pekan ini.
                                            </p>

                                            <!-- Personal Voucher Box -->
                                            <div class="p-2 rounded-xl bg-[#111b21] border border-amber-500/40 text-center">
                                                <div class="text-[9px] text-slate-400 uppercase font-extrabold tracking-wider">KODE VOUCHER PERSONAL:</div>
                                                <div class="font-mono font-black text-xs text-amber-400 tracking-wider my-0.5">RH - GOLD - HENDRA</div>
                                                <div class="text-[8px] text-slate-400">Berlaku s/d 20 Okt</div>
                                            </div>

                                            <p class="text-[10px] text-slate-400">
                                                Tunjukkan QR kode promo ini saat order di kasir atau pesan meja via link:
                                                <a href="#" class="text-sky-400 underline block">https://restohub.id/book/hendra</a>
                                            </p>

                                            <div class="text-right text-[9px] text-slate-400 flex items-center justify-end gap-1">
                                                <span>14:32</span>
                                                <i class="fas fa-check-double text-sky-400"></i>
                                            </div>
                                        </div>

                                        <!-- Interactive Template Action Buttons -->
                                        <div class="border-t border-slate-700/80 divide-y divide-slate-700/80 text-[11px] text-center font-bold text-sky-400">
                                            <button onclick="showToast('Simulasi klik tombol Reservasi Meja.', 'info')" class="w-full py-2 hover:bg-slate-700/40 flex items-center justify-center gap-1.5">
                                                <i class="fas fa-calendar-check text-xs"></i> <span>Reservasi Meja Sekarang</span>
                                            </button>
                                            <button onclick="showToast('Simulasi klik tombol Lihat Menu.', 'info')" class="w-full py-2 hover:bg-slate-700/40 flex items-center justify-center gap-1.5">
                                                <i class="fas fa-book-open text-xs"></i> <span>Lihat Menu Baru &amp; Promo</span>
                                            </button>
                                        </div>

                                    </div>

                                </div>

                                <!-- WhatsApp Message Input Mockup -->
                                <div class="bg-[#202c33] p-2 flex items-center gap-2 border-t border-slate-800">
                                    <div class="flex-1 bg-[#2a3942] rounded-full px-3 py-1.5 text-[11px] text-slate-400 flex items-center gap-2">
                                        <i class="far fa-face-smile"></i>
                                        <span>Balas ke RestoHub...</span>
                                    </div>
                                    <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-xs">
                                        <i class="fas fa-microphone"></i>
                                    </div>
                                </div>

                            </div>

                            <!-- Test Send Preview Action -->
                            <div class="mt-3 p-3 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-orange-100 text-[#a33315] flex items-center justify-center text-xs">
                                        <i class="fas fa-paper-plane"></i>
                                    </div>
                                    <div>
                                        <div class="text-[11px] font-bold text-slate-800">Uji Kirim WhatsApp Preview</div>
                                        <div class="text-[9px] text-slate-400">Kirim sampel ke WhatsApp manager</div>
                                    </div>
                                </div>
                                <button onclick="showToast('Sampel preview WA terkirim ke WhatsApp Manager (+62 812-9988-xxxx).', 'success')" class="px-2.5 py-1.5 rounded-lg bg-slate-900 text-white text-[10px] font-bold hover:bg-slate-800 transition-all">
                                    Kirim ke HP Manager
                                </button>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- 4. BOTTOM 3 METRIC TILES -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    
                    <!-- Tile 1: Tingkat Pengiriman Cloud API -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-heading font-black text-xs text-slate-900">Tingkat Pengiriman Cloud API</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-100 text-emerald-800">99.8% Sukses</span>
                            </div>
                            <p class="text-[11px] text-slate-400 leading-tight">Latensi rata-rata pengantaran pesan: 1.2 detik</p>
                        </div>
                        <div class="pt-3 mt-3 border-t border-slate-100">
                            <!-- Days histogram -->
                            <div class="flex items-end justify-between gap-1 h-12">
                                <div class="flex-1 bg-slate-200 h-6 rounded-t text-center text-[8px] text-slate-400"></div>
                                <div class="flex-1 bg-slate-200 h-8 rounded-t text-center text-[8px] text-slate-400"></div>
                                <div class="flex-1 bg-slate-200 h-7 rounded-t text-center text-[8px] text-slate-400"></div>
                                <div class="flex-1 bg-slate-200 h-10 rounded-t text-center text-[8px] text-slate-400"></div>
                                <div class="flex-1 bg-[#a33315] h-12 rounded-t text-center text-[8px] text-white"></div>
                                <div class="flex-1 bg-[#a33315] h-11 rounded-t text-center text-[8px] text-white"></div>
                            </div>
                            <div class="flex justify-between text-[9px] text-slate-400 mt-1">
                                <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tile 2: Kategori Promo Konversi Tertinggi -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-heading font-black text-xs text-slate-900">Kategori Promo Konversi Tertinggi</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-orange-100 text-orange-800">Top 3</span>
                            </div>
                            <p class="text-[11px] text-slate-400 leading-tight">Berdasarkan rasio penukaran kode di kasir</p>
                        </div>
                        <div class="space-y-2 pt-3 mt-2 border-t border-slate-100 text-xs">
                            <div>
                                <div class="flex justify-between text-[11px] mb-0.5">
                                    <span class="font-bold text-slate-700">Ulang Tahun (Diskon 20%)</span>
                                    <span class="font-black text-emerald-600">64.2%</span>
                                </div>
                                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-emerald-500 h-full rounded-full" style="width: 64.2%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[11px] mb-0.5">
                                    <span class="font-bold text-slate-700">VIP Menu Tasting Preview</span>
                                    <span class="font-black text-emerald-600">47.0%</span>
                                </div>
                                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-amber-500 h-full rounded-full" style="width: 47%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-[11px] mb-0.5">
                                    <span class="font-bold text-slate-700">Flash Promo Happy Hour</span>
                                    <span class="font-black text-slate-700">28.1%</span>
                                </div>
                                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-[#a33315] h-full rounded-full" style="width: 28.1%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tile 3: Meta Compliance & Opt-Out -->
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-sm flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="font-heading font-black text-xs text-slate-900">Meta Compliance &amp; Opt-Out</h4>
                                <span class="px-2 py-0.5 rounded text-[10px] font-extrabold bg-emerald-100 text-emerald-800">Aman</span>
                            </div>
                            <p class="text-[11px] text-slate-400 leading-tight">Perlindungan pemblokiran nomor WA bisnis</p>
                        </div>
                        <div class="space-y-1.5 pt-3 mt-2 border-t border-slate-100 text-[11px]">
                            <div class="flex items-center justify-between text-slate-600">
                                <span class="flex items-center gap-1.5"><i class="fas fa-circle-check text-emerald-500 text-[10px]"></i> Unsubscribe Otomatis</span>
                                <strong class="text-slate-800">Balas 'STOP'</strong>
                            </div>
                            <div class="flex items-center justify-between text-slate-600">
                                <span class="flex items-center gap-1.5"><i class="fas fa-circle-check text-emerald-500 text-[10px]"></i> Cool-Down Antar Pesan</span>
                                <strong class="text-slate-800">Min. 72 Jam</strong>
                            </div>
                            <div class="flex items-center justify-between text-slate-600">
                                <span class="flex items-center gap-1.5"><i class="fas fa-circle-check text-emerald-500 text-[10px]"></i> Block / Spam Rate</span>
                                <strong class="text-emerald-600">0.02% (Sangat Rendah)</strong>
                            </div>
                            <a href="javascript:void(0)" onclick="showToast('Kebijakan Meta Cloud API memenuhi standar.', 'info')" class="text-[#a33315] font-bold text-[10px] hover:underline block pt-1">
                                Lihat Log Kebijakan Privasi &amp; WhatsApp Meta Guidelines &rarr;
                            </a>
                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODALS                                                         -->
    <!-- ============================================================== -->

    <!-- 1. Modal Buat Kampanye Baru -->
    <div id="kampanyeModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#a33315] flex items-center justify-center text-lg font-black">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Buat Kampanye WhatsApp</h3>
                        <p class="text-xs text-slate-400">Broadcast pesan promosi ke segmen audiens CRM</p>
                    </div>
                </div>
                <button onclick="closeModal('kampanyeModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('resto.marketing.campaign.create') }}" method="POST" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Judul Kampanye *</label>
                    <input type="text" name="judul" required placeholder="Contoh: Flash Promo Happy Hour Selasa 14:00 - 17:00" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Target Segmen Audiens</label>
                        <select name="segmen" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="Semua Member">Semua Member Terdaftar</option>
                            <option value="VIP / Gold Member Saja">VIP / Gold Member Saja</option>
                            <option value="Pelanggan Pasif (>30 Hari)">Pelanggan Pasif (&gt;30 Hari)</option>
                            <option value="Ulang Tahun Bulan Ini">Member Ulang Tahun Bulan Ini</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Tipe Pesan</label>
                        <select name="tipe" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="Flash Promo">Flash Promo Diskon</option>
                            <option value="Undangan VIP">Undangan Tasting Menu VIP</option>
                            <option value="Weekend Special">Weekend Special</option>
                            <option value="Pengingat Poin">Pengingat Poin Loyalty</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Estimasi Target Penerima</label>
                        <input type="number" name="target_count" value="250" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Waktu Pengiriman</label>
                        <select name="jadwal" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]">
                            <option value="Sekarang">Kirim Sekarang (Instant)</option>
                            <option value="Besok Jam 10:00 WIB">Jadwalkan: Besok 10:00 WIB</option>
                            <option value="Jumat 16:00 WIB">Jadwalkan: Jumat 16:00 WIB</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Isi Pesan Promosi</label>
                    <textarea name="pesan" rows="3" placeholder="Diskon 30% Pasta & Mocktail untuk mendongkrak omzet jam operasional sepi weekday..." class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:border-[#a33315]"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeModal('kampanyeModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#8c280e] hover:bg-[#731e09] text-white text-xs font-bold shadow-md shadow-orange-900/20">
                        Luncurkan Broadcast
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. Modal Pengaturan Template Meta -->
    <div id="templateMetaModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-800 flex items-center justify-center text-lg font-black">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Template Meta WABA</h3>
                        <p class="text-xs text-slate-400">Template pesan resmi yang telah disetujui Meta</p>
                    </div>
                </div>
                <button onclick="closeModal('templateMetaModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3 text-xs">
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <div class="flex items-center justify-between font-bold text-slate-800">
                        <span>rh_birthday_voucher_v1</span>
                        <span class="text-[10px] text-emerald-600 font-extrabold">APPROVED</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5">Kategori: MARKETING &bull; Bahasa: id_ID</div>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <div class="flex items-center justify-between font-bold text-slate-800">
                        <span>rh_winback_dormant_v2</span>
                        <span class="text-[10px] text-emerald-600 font-extrabold">APPROVED</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5">Kategori: MARKETING &bull; Bahasa: id_ID</div>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <div class="flex items-center justify-between font-bold text-slate-800">
                        <span>rh_point_expiry_alert</span>
                        <span class="text-[10px] text-emerald-600 font-extrabold">APPROVED</span>
                    </div>
                    <div class="text-[11px] text-slate-500 mt-0.5">Kategori: UTILITY &bull; Bahasa: id_ID</div>
                </div>

                <button onclick="closeModal('templateMetaModal'); showToast('Sinkronisasi template Meta berhasil.', 'info')" class="w-full py-2.5 rounded-xl bg-[#8c280e] text-white font-bold text-xs">
                    Sinkronkan Template Baru dari Meta
                </button>
            </div>
        </div>
    </div>

    <!-- 3. Modal Broadcast Cepat Jam Sepi -->
    <div id="quickBroadcastModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg font-black">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Broadcast Cepat Jam Sepi</h3>
                        <p class="text-xs text-slate-400">Kirim promo instan ke tamu radius terdekat</p>
                    </div>
                </div>
                <button onclick="closeModal('quickBroadcastModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3.5 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Pilih Penawaran Kilat</label>
                    <select class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                        <option>Diskon 25% Semua Pasta & Kopi (Hanya 14:00 - 17:00)</option>
                        <option>Buy 1 Get 1 Free Mocktail / Specialty Coffee</option>
                        <option>Free Dessert Tiramisu setiap pemesanan Main Course</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Target Radius Pelanggan</label>
                    <input type="text" value="Member dalam radius 3 km dari cabang Grand Indonesia" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeModal('quickBroadcastModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Batal</button>
                    <button onclick="closeModal('quickBroadcastModal'); showToast('⚡ Broadcast jam sepi berhasil terkirim ke 150 member terdekat!', 'success')" class="px-5 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold">
                        Kirim Kilat Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Modal Edit Trigger Otomasi -->
    <div id="editTriggerModal" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#a33315] flex items-center justify-center text-lg font-black">
                        <i class="fas fa-sliders"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-lg text-slate-900">Ubah Template Trigger</h3>
                        <p class="text-xs text-slate-400">Atur pesan dan insentif voucher otomatis</p>
                    </div>
                </div>
                <button onclick="closeModal('editTriggerModal')" class="w-8 h-8 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 flex items-center justify-center">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-3.5 text-xs">
                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Voucher Diskon (%)</label>
                    <input type="number" value="20" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase mb-1">Masa Berlaku Voucher (Hari)</label>
                    <input type="number" value="7" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800">
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button onclick="closeModal('editTriggerModal')" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600">Batal</button>
                    <button onclick="closeModal('editTriggerModal'); showToast('Konfigurasi pemicu otomasi diperbarui.', 'success')" class="px-5 py-2 rounded-xl bg-slate-900 text-white text-xs font-bold">
                        Simpan Aturan
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

        // Trigger Toggle Helper
        function toggleTriggerAjax(triggerId) {
            showToast('Status pemicu otomasi berhasil diubah.', 'info');
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