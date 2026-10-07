<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RestoHub OS — Culinary Operations &amp; POS</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
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
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .pulse-subtle {
            animation: pulseSubtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulseSubtle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.75; transform: scale(1.05); }
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
                <a href="{{ route('resto.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#8c280e] text-white shadow-sm shadow-orange-900/20 transition-all">
                    <i class="fas fa-cash-register text-sm w-4 text-center"></i>
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

                <a href="{{ route('resto.marketing') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fab fa-whatsapp text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>WhatsApp Marketing</span>
                </a>

                <a href="{{ route('resto.laporan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                    <i class="fas fa-chart-pie text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                    <span>Laporan &amp; Pengaturan</span>
                </a>
            </nav>

            <!-- Bottom Sync Status -->
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

            <!-- Reset & Logout -->
            <div class="p-3 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('resto.reset') }}" onclick="return confirm('Kosongkan kembali semua data RestoHub?')" class="text-[11px] font-bold text-slate-500 hover:text-[#8c280e] flex items-center gap-1.5">
                    <i class="fas fa-rotate-left text-xs"></i>
                    <span>Reset Data</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-[11px] font-bold text-rose-600 hover:text-rose-700 flex items-center gap-1">
                        <i class="fas fa-arrow-right-from-bracket text-xs"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>

        </aside>

        <!-- ============================================================== -->
        <!-- 2. MAIN CENTER AREA (FLOOR PLAN & QUICK ADD)                   -->
        <!-- ============================================================== -->
        <main class="flex-1 flex flex-col min-w-0 bg-[#f8fafc] overflow-y-auto">

            <!-- Top Header Bar -->
            <header class="bg-white border-b border-slate-200/80 px-6 py-3 shrink-0 flex flex-col gap-3 sticky top-0 z-20 shadow-sm">
                
                <!-- Row 1: Branch, Sync status, Profile -->
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <button type="button" onclick="toggleBranchModal()" class="flex items-center gap-2.5 px-3 py-1.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl text-left text-xs font-bold text-slate-800 transition">
                                <i class="fas fa-store text-[#8c280e]"></i>
                                <span>{{ $currentBranch }}</span>
                                <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                            </button>
                        </div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-subtle"></span>
                            Live Sync Kitchen &amp; POS
                        </span>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="button" onclick="showToast('Tidak ada notifikasi sistem.', 'info')" class="w-8 h-8 rounded-xl border border-slate-200 text-slate-500 hover:text-slate-800 hover:bg-slate-50 flex items-center justify-center text-xs relative transition">
                            <i class="far fa-bell"></i>
                        </button>
                        
                        <div class="flex items-center gap-2.5 pl-3 border-l border-slate-200">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#8c280e] to-orange-500 text-white font-bold text-xs flex items-center justify-center shadow-sm">
                                {{ strtoupper(substr($user->name ?? 'BP', 0, 2)) }}
                            </div>
                            <div class="text-left">
                                <div class="text-xs font-black text-slate-900 leading-tight">{{ $user->name ?? 'Budi Pratama' }}</div>
                                <div class="text-[10px] text-slate-400 font-semibold leading-tight">Store Manager</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Shift, Cash, Search, Action Buttons -->
                <div class="flex flex-wrap items-center justify-between gap-3 pt-2 border-t border-slate-100 text-xs">
                    <div class="flex flex-wrap items-center gap-2 text-slate-600 font-semibold">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 text-[11px] font-bold">
                            <i class="fas fa-clock text-slate-400"></i>
                            {{ $shiftInfo['shift_kode'] }} {{ $shiftInfo['jam'] }}
                        </span>
                        <span class="text-slate-400">&bull;</span>
                        <span>Kasir: <strong class="text-slate-800">{{ $shiftInfo['kasir'] }}</strong></span>
                        <span class="text-slate-400">&bull;</span>
                        <span>Kas Awal: <strong class="text-slate-800">Rp {{ number_format($shiftInfo['kas_awal'], 0, ',', '.') }}</strong></span>
                    </div>

                    <div class="flex items-center gap-2.5">
                        <div class="relative">
                            <i class="fas fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="menuSearch" placeholder="Cari Menu / Barcode F2" class="pl-8 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-[#8c280e] focus:bg-white w-48 transition">
                        </div>

                        <button type="button" onclick="openModalNewTable()" class="px-3.5 py-1.5 rounded-xl bg-[#8c280e] hover:bg-[#721f0a] text-white font-bold text-xs shadow-sm flex items-center gap-1.5 transition">
                            <i class="fas fa-plus text-[10px]"></i>
                            <span>Buka Meja Baru</span>
                        </button>

                        <button type="button" onclick="openModalNewMenu()" class="px-3.5 py-1.5 rounded-xl bg-orange-100 hover:bg-orange-200 text-[#8c280e] font-bold text-xs shadow-sm flex items-center gap-1.5 transition">
                            <i class="fas fa-utensils text-[10px]"></i>
                            <span>+ Tambah Menu</span>
                        </button>
                    </div>
                </div>

                <!-- Row 3: Service Type Filters -->
                <div class="flex items-center gap-2 pt-1 border-t border-slate-100 overflow-x-auto text-xs font-bold">
                    <button type="button" class="px-3 py-1 rounded-lg bg-[#8c280e] text-white flex items-center gap-1.5 shadow-sm">
                        <i class="fas fa-utensils text-[11px]"></i>
                        <span>Dine-In ({{ $serviceCounters['dine_in'] }})</span>
                    </button>
                    <button type="button" onclick="showToast('Mode Takeaway dipilih.', 'info')" class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center gap-1.5 transition">
                        <i class="fas fa-bag-shopping text-slate-400"></i>
                        <span>Takeaway ({{ $serviceCounters['takeaway'] }})</span>
                    </button>
                    <button type="button" onclick="showToast('Mode Online / Ojol dipilih.', 'info')" class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center gap-1.5 transition">
                        <i class="fas fa-motorcycle text-slate-400"></i>
                        <span>Online / Ojol ({{ $serviceCounters['online'] }})</span>
                    </button>
                    <button type="button" onclick="showToast('Mode QR Self-Order dipilih.', 'info')" class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center gap-1.5 transition">
                        <i class="fas fa-qrcode text-slate-400"></i>
                        <span>QR Self-Order ({{ $serviceCounters['qr_self_order'] }})</span>
                    </button>
                </div>

            </header>

            <!-- Center Content Scrollable Body -->
            <div class="p-6 space-y-6">

                <!-- Switcher Bar & Status Legend -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-3 rounded-2xl border border-slate-200/80 shadow-sm">
                    <div class="flex items-center gap-2">
                        <button type="button" class="px-3.5 py-2 rounded-xl bg-orange-50 text-[#8c280e] font-black text-xs flex items-center gap-2 border border-orange-200/60 shadow-sm">
                            <i class="fas fa-border-all text-xs"></i>
                            <span>Denah Meja (Floor Plan)</span>
                        </button>
                        <button type="button" onclick="document.getElementById('katalogSection').scrollIntoView({behavior: 'smooth'})" class="px-3.5 py-2 rounded-xl text-slate-600 hover:bg-slate-50 font-bold text-xs flex items-center gap-2 transition">
                            <i class="fas fa-book-open text-xs text-slate-400"></i>
                            <span>Katalog Menu Cepat</span>
                        </button>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-xs font-semibold text-slate-600">
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Kosong</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> Terisi</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span> QR Pending</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-slate-600"></span> Reservasi</span>
                    </div>
                </div>

                <!-- ========================================== -->
                <!-- AREA 1: INDOOR AC                          -->
                <!-- ========================================== -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#8c280e]"></span>
                            <h3 class="font-heading font-black text-sm text-slate-900">Area Indoor AC (Lantai 1)</h3>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 font-bold text-[10px]">{{ count($indoorTables) }} Meja</span>
                        </div>
                        <span class="text-slate-400 font-semibold">Area Bebas Asap Rokok</span>
                    </div>

                    @if(count($indoorTables) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($indoorTables as $t)
                                <div onclick="selectTableForTicket('{{ $t['label'] }}', 'Area Indoor AC', '{{ $t['kursi'] }}')" class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm relative flex flex-col justify-between hover:border-[#8c280e] hover:shadow-md transition cursor-pointer">
                                    <div>
                                        <div class="flex items-start justify-between">
                                            <div class="w-11 h-11 rounded-xl bg-[#8c280e] text-white flex flex-col items-center justify-center font-heading font-black shadow-sm">
                                                <span class="text-base leading-none">{{ $t['label'] }}</span>
                                            </div>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-black {{ $t['badge_color'] ?? 'bg-emerald-100 text-emerald-700' }}">{{ $t['status_badge'] ?? 'Siap Pakai' }}</span>
                                        </div>

                                        <div class="mt-3">
                                            <div class="text-xs font-bold text-slate-800">{{ $t['kursi'] }}</div>
                                            @if(!empty($t['guest']))
                                                <div class="text-[11px] text-slate-500 mt-0.5 truncate">{{ $t['guest'] }}</div>
                                            @endif
                                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $t['info'] ?? 'Meja Bersih & Siap' }}</div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold">
                                        <span class="text-[#8c280e]">Rp {{ number_format($t['total'] ?? 0, 0, ',', '.') }}</span>
                                        <span class="text-slate-400 hover:text-slate-700 flex items-center gap-1 text-[11px]">
                                            <span>Pilih</span> <i class="fas fa-arrow-right text-[9px]"></i>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Modern Empty State Indoor -->
                        <div class="py-12 px-4 text-center border-2 border-dashed border-slate-200 rounded-3xl bg-white flex flex-col items-center justify-center">
                            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#8c280e] flex items-center justify-center text-xl mb-3 shadow-sm">
                                <i class="fas fa-chair"></i>
                            </div>
                            <h4 class="font-heading font-bold text-sm text-slate-800">Belum Ada Meja di Area Indoor AC</h4>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto leading-relaxed">
                                Data meja indoor masih kosong. Tambahkan meja pertama Anda sekarang untuk memulai operasional kasir.
                            </p>
                            <button type="button" onclick="openModalNewTable('indoor')" class="mt-4 px-4 py-2 rounded-xl bg-[#8c280e] hover:bg-[#721f0a] text-white font-bold text-xs shadow-md shadow-orange-950/20 transition">
                                <i class="fas fa-plus mr-1.5"></i> + Buka Meja Indoor Baru
                            </button>
                        </div>
                    @endif
                </div>

                <!-- ========================================== -->
                <!-- AREA 2: OUTDOOR TERRACE & GARDEN           -->
                <!-- ========================================== -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                            <h3 class="font-heading font-black text-sm text-slate-900">Area Outdoor Terrace &amp; Garden</h3>
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 font-bold text-[10px]">{{ count($outdoorTables) }} Meja</span>
                        </div>
                        <span class="text-slate-400 font-semibold">Smoking Area &amp; Live Music</span>
                    </div>

                    @if(count($outdoorTables) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($outdoorTables as $t)
                                <div onclick="selectTableForTicket('{{ $t['label'] }}', 'Area Outdoor Terrace', '{{ $t['kursi'] }}')" class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm relative flex flex-col justify-between hover:border-emerald-500 hover:shadow-md transition cursor-pointer">
                                    <div>
                                        <div class="flex items-start justify-between">
                                            <div class="w-11 h-11 rounded-xl bg-slate-800 text-white flex flex-col items-center justify-center font-heading font-black shadow-sm">
                                                <span class="text-base leading-none">{{ $t['label'] }}</span>
                                            </div>
                                            <span class="px-2 py-0.5 rounded-md text-[10px] font-black {{ $t['badge_color'] ?? 'bg-emerald-100 text-emerald-700' }}">{{ $t['status_badge'] ?? 'Siap Pakai' }}</span>
                                        </div>

                                        <div class="mt-3">
                                            <div class="text-xs font-bold text-slate-800">{{ $t['kursi'] }}</div>
                                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $t['note'] ?? 'Meja Outdoor Bersih' }}</div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold">
                                        <span class="text-slate-800">Rp {{ number_format($t['total'] ?? 0, 0, ',', '.') }}</span>
                                        <span class="text-slate-400 hover:text-slate-700 flex items-center gap-1 text-[11px]">
                                            <span>Pilih</span> <i class="fas fa-arrow-right text-[9px]"></i>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Modern Empty State Outdoor -->
                        <div class="py-12 px-4 text-center border-2 border-dashed border-slate-200 rounded-3xl bg-white flex flex-col items-center justify-center">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl mb-3 shadow-sm">
                                <i class="fas fa-umbrella-beach"></i>
                            </div>
                            <h4 class="font-heading font-bold text-sm text-slate-800">Belum Ada Meja di Area Outdoor</h4>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto leading-relaxed">
                                Data meja outdoor masih kosong bersih. Tambahkan meja outdoor sekarang untuk mengaktifkan pemesanan taman.
                            </p>
                            <button type="button" onclick="openModalNewTable('outdoor')" class="mt-4 px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-md shadow-emerald-950/20 transition">
                                <i class="fas fa-plus mr-1.5"></i> + Buka Meja Outdoor Baru
                            </button>
                        </div>
                    @endif
                </div>

                <!-- ========================================== -->
                <!-- AREA 3: KATALOG MENU & QUICK ADD           -->
                <!-- ========================================== -->
                <div id="katalogSection" class="space-y-3 pt-4 border-t border-slate-200">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <h3 class="font-heading font-black text-base text-slate-900">Katalog Menu &amp; Quick Add</h3>
                            <p class="text-xs text-slate-500">Pilih item untuk menambahkan langsung ke Tiket Aktif (Meja {{ $activeTicket['meja_id'] }})</p>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="openModalNewMenu()" class="px-3 py-1.5 rounded-xl bg-[#8c280e] hover:bg-[#721f0a] text-white text-xs font-bold shadow-sm flex items-center gap-1.5">
                                <i class="fas fa-plus text-[10px]"></i> + Tambah Menu Baru
                            </button>
                        </div>
                    </div>

                    @if(count($menuKatalog) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($menuKatalog as $menu)
                                <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm flex flex-col justify-between hover:shadow-md transition group">
                                    <div class="relative h-28 w-full overflow-hidden bg-slate-100">
                                        <img src="{{ $menu['img'] }}" alt="{{ $menu['nama'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        <span class="absolute top-2 left-2 px-2 py-0.5 rounded-md text-[10px] font-black {{ $menu['badge_color'] }} backdrop-blur-sm shadow-sm">
                                            {{ $menu['badge'] }}
                                        </span>
                                    </div>
                                    
                                    <div class="p-3 flex-1 flex flex-col justify-between">
                                        <div>
                                            <div class="text-[9px] font-extrabold uppercase tracking-wider text-[#8c280e]">{{ $menu['kategori'] }}</div>
                                            <h4 class="font-heading font-bold text-xs text-slate-900 line-clamp-1 mt-0.5">{{ $menu['nama'] }}</h4>
                                            <p class="text-[10px] text-slate-400 line-clamp-1 mt-0.5">{{ $menu['deskripsi'] }}</p>
                                        </div>

                                        <div class="mt-3 flex items-center justify-between pt-2 border-t border-slate-100">
                                            <div class="font-heading font-black text-xs text-slate-900">
                                                Rp {{ number_format($menu['harga'], 0, ',', '.') }}
                                            </div>
                                            <form action="{{ route('resto.order.item.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="menu_id" value="{{ $menu['id'] }}">
                                                <input type="hidden" name="nama" value="{{ $menu['nama'] }}">
                                                <input type="hidden" name="harga" value="{{ $menu['harga'] }}">
                                                <button type="submit" class="w-7 h-7 rounded-lg bg-[#8c280e] hover:bg-[#721f0a] text-white flex items-center justify-center text-xs shadow-sm transition active:scale-95" title="Tambah ke Tiket">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Modern Empty State Menu -->
                        <div class="py-12 px-4 text-center border-2 border-dashed border-slate-200 rounded-3xl bg-white flex flex-col items-center justify-center">
                            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#8c280e] flex items-center justify-center text-xl mb-3 shadow-sm">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h4 class="font-heading font-bold text-sm text-slate-800">Katalog Menu Masih Kosong</h4>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto leading-relaxed">
                                Belum ada menu kuliner yang terdaftar di sistem. Daftarkan menu makanan, minuman, dan snack sekarang.
                            </p>
                            <button type="button" onclick="openModalNewMenu()" class="mt-4 px-4 py-2 rounded-xl bg-[#8c280e] hover:bg-[#721f0a] text-white font-bold text-xs shadow-md shadow-orange-950/20 transition">
                                <i class="fas fa-plus mr-1.5"></i> + Daftarkan Menu Pertama
                            </button>
                        </div>
                    @endif
                </div>

            </div>

        </main>

        <!-- ============================================================== -->
        <!-- 3. RIGHT PANEL: ACTIVE ORDER TICKET                            -->
        <!-- ============================================================== -->
        <aside class="w-96 bg-white border-l border-slate-200/80 flex flex-col shrink-0 select-none z-30 shadow-sm">
            
            <!-- Ticket Header -->
            <div class="p-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-[#8c280e] text-white flex flex-col items-center justify-center font-heading font-black shadow-md shadow-orange-950/20">
                        <span class="text-xs leading-none">Meja</span>
                        <span class="text-base leading-none">{{ $activeTicket['meja_id'] }}</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-heading font-black text-sm text-slate-900">{{ $activeTicket['area'] }}</h3>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600">{{ $activeTicket['pax'] }} Pax</span>
                        </div>
                        <div class="text-[10px] text-slate-400 font-semibold mt-0.5">
                            Tiket {{ $activeTicket['tiket_no'] }} &bull; {{ $activeTicket['waktu_buat'] }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-1.5">
                    <button type="button" onclick="showToast('Menu Meja & Tiket.', 'info')" class="w-8 h-8 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-500 hover:text-slate-800 flex items-center justify-center text-xs transition">
                        <i class="fas fa-arrow-right-arrow-left"></i>
                    </button>
                </div>
            </div>

            <!-- Order Items List (Scrollable) -->
            <div class="flex-1 p-4 overflow-y-auto divide-y divide-slate-100 space-y-3">
                @forelse($activeTicket['items'] as $item)
                    <div class="pt-3 first:pt-0">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex items-start gap-2">
                                <span class="px-1.5 py-0.5 rounded bg-orange-100 text-[#8c280e] font-black text-[11px] shrink-0">
                                    {{ $item['qty'] }}x
                                </span>
                                <div>
                                    <div class="font-bold text-xs text-slate-900">{{ $item['nama'] }}</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 leading-snug">{{ $item['catatan'] }}</div>
                                    <div class="mt-1 flex items-center gap-2">
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-600">
                                            <i class="fas fa-check-circle"></i> {{ $item['status'] ?? 'Pesanan Aktif' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-right shrink-0">
                                <div class="font-heading font-black text-xs text-slate-900">
                                    Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}
                                </div>
                                <form action="{{ route('resto.order.item.remove') }}" method="POST" class="mt-1">
                                    @csrf
                                    <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                                    <button type="submit" class="text-[10px] text-rose-500 hover:text-rose-700">
                                        <i class="far fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Modern Clean Empty Ticket State -->
                    <div class="py-16 text-center text-slate-400 flex flex-col items-center justify-center">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center text-xl mb-3">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <div class="text-xs font-bold text-slate-700">Tiket Belum Berisi Pesanan</div>
                        <div class="text-[11px] text-slate-400 mt-1 max-w-[200px]">
                            Pilih menu dari katalog cepat di sebelah kiri untuk membuat pesanan.
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Action Strip -->
            <div class="px-4 py-2.5 border-t border-slate-100 bg-slate-50/50 flex items-center justify-between gap-2 text-xs">
                <button type="button" onclick="openCatatanDapurModal()" class="flex-1 py-1.5 px-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-[11px] flex items-center justify-center gap-1.5 transition">
                    <i class="far fa-comment-dots text-slate-400"></i>
                    <span>+ Catatan Dapur</span>
                </button>
                <form action="{{ route('resto.order.kds') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-1.5 px-2 rounded-xl bg-orange-100 hover:bg-orange-200 text-[#8c280e] font-bold text-[11px] flex items-center justify-center gap-1.5 transition">
                        <i class="fas fa-fire text-[#8c280e]"></i>
                        <span>Fire KDS</span>
                    </button>
                </form>
            </div>

            <!-- Cost Calculation Breakdown -->
            <div class="p-4 border-t border-slate-100 bg-white space-y-1.5 text-xs">
                <div class="flex items-center justify-between text-slate-600">
                    <span>Subtotal ({{ count($activeTicket['items']) }} Item)</span>
                    <span class="font-bold text-slate-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                
                @if($diskonPoin > 0)
                    <div class="flex items-center justify-between text-rose-600">
                        <span>Diskon Member Loyalty</span>
                        <span class="font-bold">-Rp {{ number_format($diskonPoin, 0, ',', '.') }}</span>
                    </div>
                @endif

                <div class="flex items-center justify-between text-slate-500">
                    <span>Service Charge (5%)</span>
                    <span>Rp {{ number_format($serviceCharge, 0, ',', '.') }}</span>
                </div>

                <div class="flex items-center justify-between text-slate-500">
                    <span>Pajak Restoran PB1 (10%)</span>
                    <span>Rp {{ number_format($pb1, 0, ',', '.') }}</span>
                </div>

                <!-- Big Total Highlight -->
                <div class="pt-2 mt-2 border-t border-slate-100 flex items-baseline justify-between">
                    <div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Tagihan</div>
                    </div>
                    <div class="text-right">
                        <div class="font-heading font-black text-2xl text-[#8c280e]">
                            Rp {{ number_format($totalTagihan, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Method Quick Pills -->
            <div class="px-4 py-2 border-t border-slate-100 bg-slate-50/70">
                <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1.5">Metode Bayar Kasir</div>
                <div class="grid grid-cols-3 gap-1.5 text-[11px] font-bold text-slate-700">
                    <button type="button" onclick="selectPaymentMethod('QRIS')" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:border-[#8c280e] hover:bg-orange-50/40 text-center transition">
                        <i class="fas fa-qrcode block mb-0.5 text-slate-500"></i>
                        <span>QRIS</span>
                    </button>
                    <button type="button" onclick="selectPaymentMethod('EDC BCA')" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:border-[#8c280e] hover:bg-orange-50/40 text-center transition">
                        <i class="far fa-credit-card block mb-0.5 text-slate-500"></i>
                        <span>EDC BCA</span>
                    </button>
                    <button type="button" onclick="selectPaymentMethod('Tunai Pas')" class="p-1.5 rounded-lg border border-slate-200 bg-white hover:border-[#8c280e] hover:bg-orange-50/40 text-center transition">
                        <i class="fas fa-money-bill block mb-0.5 text-emerald-600"></i>
                        <span>Tunai Pas</span>
                    </button>
                </div>
            </div>

            <!-- Bottom Payment Button Strip -->
            <div class="p-4 border-t border-slate-100 bg-white">
                <form action="{{ route('resto.order.pay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="metode" id="payMethodInput" value="Tunai Pas">
                    <input type="hidden" name="nominal" value="{{ $totalTagihan }}">
                    <button type="submit" {{ $totalTagihan <= 0 ? 'disabled' : '' }} class="w-full py-3.5 px-4 rounded-2xl bg-[#8c280e] hover:bg-[#721f0a] disabled:opacity-50 disabled:cursor-not-allowed text-white font-heading font-black text-sm flex items-center justify-between shadow-lg shadow-orange-950/25 transition active:scale-98">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-cash-register text-base"></i>
                            <span>Bayar Sekarang</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <span>Rp {{ number_format($totalTagihan, 0, ',', '.') }}</span>
                            <span class="px-1.5 py-0.5 rounded bg-white/20 text-[10px] font-bold">F8</span>
                        </span>
                    </button>
                </form>
            </div>

        </aside>

    </div>

    <!-- ============================================================== -->
    <!-- MODALS & POPUPS                                                -->
    <!-- ============================================================== -->

    <!-- Modal Buka Meja Baru -->
    <div id="modalNewTable" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h4 class="font-heading font-black text-base text-slate-900">Buka / Daftarkan Meja Baru</h4>
                <button type="button" onclick="closeModalNewTable()" class="w-8 h-8 rounded-full hover:bg-slate-100 text-slate-400 flex items-center justify-center"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('resto.table.create') }}" method="POST" class="mt-4 space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nomor / Kode Meja</label>
                    <input type="text" name="label" required placeholder="Contoh: T-01, O-01, VIP-1" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-[#8c280e]">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Area Restoran</label>
                    <select name="area" id="areaSelectInput" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-800">
                        <option value="indoor">Area Indoor AC (Lantai 1)</option>
                        <option value="outdoor">Area Outdoor Terrace &amp; Garden</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kapasitas Kursi</label>
                    <input type="text" name="kursi" required placeholder="Contoh: 4 Kursi • Meja Keluarga" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Tamu (Opsional)</label>
                    <input type="text" name="guest" placeholder="Nama Tamu / Pelanggan" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModalNewTable()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold shadow-md shadow-orange-950/20">Simpan Meja</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Menu Baru -->
    <div id="modalNewMenu" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h4 class="font-heading font-black text-base text-slate-900">Tambah Menu ke Katalog</h4>
                <button type="button" onclick="closeModalNewMenu()" class="w-8 h-8 rounded-full hover:bg-slate-100 text-slate-400 flex items-center justify-center"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('resto.menu.create') }}" method="POST" class="mt-4 space-y-3 text-xs">
                @csrf
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nama Menu</label>
                    <input type="text" name="nama" required placeholder="Contoh: Wagyu Ribeye Steak 200g" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-[#8c280e]">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Kategori Menu</label>
                    <select name="kategori" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl font-semibold text-slate-800">
                        <option value="Main Course">Main Course</option>
                        <option value="Pasta & Pizza">Pasta &amp; Pizza</option>
                        <option value="Signature Coffee">Signature Coffee</option>
                        <option value="Snack & Bites">Snack &amp; Bites</option>
                        <option value="Beverages">Beverages</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Harga Satuan (Rp)</label>
                    <input type="number" name="harga" required placeholder="Contoh: 85000" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <input type="text" name="deskripsi" placeholder="Contoh: Creamy fettuccine, beef & parmesan" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Badge Ketersediaan</label>
                    <input type="text" name="badge" placeholder="Contoh: Tersedia, Sisa 6, Favorit" value="Tersedia" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModalNewMenu()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold shadow-md shadow-orange-950/20">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Catatan Dapur -->
    <div id="modalCatatanDapur" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h4 class="font-heading font-black text-base text-slate-900">Catatan Khusus Dapur / Bar</h4>
                <button type="button" onclick="closeCatatanDapurModal()" class="w-8 h-8 rounded-full hover:bg-slate-100 text-slate-400 flex items-center justify-center"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('resto.order.catatan') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Tambahan untuk Koki</label>
                    <textarea name="catatan" rows="3" placeholder="Contoh: Pisahkan sambal, tidak pakai MSG, alergi kacang..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-[#8c280e]">{{ $activeTicket['catatan_dapur'] ?? '' }}</textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeCatatanDapurModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold shadow-md shadow-orange-950/20">Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Cabang -->
    <div id="modalBranch" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-slate-100">
            <h4 class="font-heading font-black text-base text-slate-900 mb-3">Pilih Cabang Restoran</h4>
            <div class="space-y-2 text-xs">
                @foreach($branches as $b)
                    <form action="{{ route('resto.branch.switch') }}" method="POST">
                        @csrf
                        <input type="hidden" name="branch" value="{{ $b }}">
                        <button type="submit" class="w-full p-3 rounded-xl border text-left font-bold transition flex items-center justify-between {{ $currentBranch === $b ? 'border-[#8c280e] bg-orange-50/50 text-[#8c280e]' : 'border-slate-200 hover:bg-slate-50 text-slate-700' }}">
                            <span>{{ $b }}</span>
                            @if($currentBranch === $b)
                                <i class="fas fa-check text-xs"></i>
                            @endif
                        </button>
                    </form>
                @endforeach
            </div>
            <button type="button" onclick="toggleBranchModal()" class="w-full mt-4 py-2 text-center text-xs font-bold text-slate-500 hover:text-slate-800">Tutup</button>
        </div>
    </div>

    <!-- Hidden Form for Selecting Table -->
    <form id="selectTableForm" action="{{ route('resto.table.select') }}" method="POST" class="hidden">
        @csrf
        <input type="hidden" name="table_id" id="selTableId">
        <input type="hidden" name="area" id="selArea">
        <input type="hidden" name="pax" id="selPax" value="4">
    </form>

    <!-- Scripts -->
    <script>
        function showToast(message, type = 'info') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl ${type === 'success' ? 'bg-emerald-600' : 'bg-slate-900'} text-white shadow-xl text-xs font-semibold animate-fade-in transition-all duration-300`;
            toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-info-circle text-amber-400'} text-base"></i><span>${message}</span>`;
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function selectTableForTicket(tableId, area, kursi) {
            document.getElementById('selTableId').value = tableId;
            document.getElementById('selArea').value = area;
            document.getElementById('selectTableForm').submit();
        }

        function selectPaymentMethod(metode) {
            document.getElementById('payMethodInput').value = metode;
            showToast(`Metode bayar dipilih: ${metode}`, 'info');
        }

        function toggleBranchModal() {
            const m = document.getElementById('modalBranch');
            m.classList.toggle('hidden');
            m.classList.toggle('flex');
        }

        function openModalNewTable(defaultArea = 'indoor') {
            const m = document.getElementById('modalNewTable');
            document.getElementById('areaSelectInput').value = defaultArea;
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
        function closeModalNewTable() {
            const m = document.getElementById('modalNewTable');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function openModalNewMenu() {
            const m = document.getElementById('modalNewMenu');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
        function closeModalNewMenu() {
            const m = document.getElementById('modalNewMenu');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        function openCatatanDapurModal() {
            const m = document.getElementById('modalCatatanDapur');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
        function closeCatatanDapurModal() {
            const m = document.getElementById('modalCatatanDapur');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }

        window.addEventListener('keydown', function(e) {
            if (e.key === 'F2') {
                e.preventDefault();
                document.getElementById('menuSearch').focus();
            }
            if (e.key === 'F8') {
                e.preventDefault();
                const btn = document.querySelector('form[action="{{ route('resto.order.pay') }}"] button');
                if (btn && !btn.disabled) btn.click();
            }
        });
    </script>
</body>
</html>