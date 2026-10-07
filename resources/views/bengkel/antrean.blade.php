<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Garage — Antrean PIT Bay & Monitor Live Servis</title>
    <meta name="description" content="Monitor antrean kendaraan dan status PIT Bay bengkel L-Garage secara real-time.">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        garage: {
                            50: '#fff7ed', 100: '#ffedd5', 200: '#fed7aa', 300: '#fdba74',
                            400: '#fb923c', 500: '#f97316', 600: '#ea580c', 700: '#c2410c',
                            800: '#9a3412', 900: '#7c2d12', 950: '#431407',
                        },
                        darkbase: { 800: '#1e232d', 900: '#14171f', 950: '#0c0e14' }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        @keyframes statusPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.15); }
        }
        .pulse-live { animation: statusPulse 2s infinite ease-in-out; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in { animation: slideIn 0.22s ease forwards; }

        @keyframes timerTick {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
        .timer-blink { animation: timerTick 1.2s infinite; }

        /* PIT Card states */
        .pit-card-kosong { border-color: #6ee7b7; background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); }
        .pit-card-terisi  { border-color: #f97316; background: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%); }
        .pit-card-selesai { border-color: #60a5fa; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); }
        .pit-card-masalah { border-color: #f87171; background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%); }

        .queue-item { transition: all 0.2s ease; }
        .queue-item:hover { transform: translateX(4px); }
    </style>
</head>
<body class="min-h-screen flex antialiased selection:bg-garage-500 selection:text-white">

    <!-- ============================================================== -->
    <!-- DESKTOP SIDEBAR -->
    <!-- ============================================================== -->
    <aside class="w-64 bg-darkbase-900 border-r border-slate-800 text-slate-300 flex flex-col fixed inset-y-0 left-0 z-30">

        <!-- Logo & Brand Header -->
        <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80 bg-darkbase-950/60">
            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-600 to-garage-500 flex items-center justify-center text-white shadow-lg shadow-garage-600/30">
                    <i class="fa-solid fa-wrench text-lg"></i>
                </div>
                <div>
                    <div class="font-heading font-black text-xl tracking-tight text-white leading-tight">
                        L-GARAGE<span class="text-garage-500">.</span>
                    </div>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span>
                        <span class="text-[11px] font-semibold text-emerald-400">Workshop Buka</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Workshop Info Plate -->
        <div class="p-4 mx-4 my-4 rounded-xl bg-slate-800/50 border border-slate-700/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-garage-500/10 text-garage-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Cabang Utama</div>
                    <div class="text-xs font-bold text-white">Bengkel BSE</div>
                </div>
            </div>
            <span class="px-2 py-0.5 text-[10px] font-bold bg-garage-500/20 text-garage-400 rounded-md border border-garage-500/30">PRO</span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <div class="px-3 pt-2 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Menu Utama</div>

            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('bengkel.booking') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-calendar-check w-5 text-center text-base"></i>
                <span>Booking Servis</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-800 text-slate-400">0</span>
            </a>

            <!-- Active: Antrean PIT Bay -->
            <a href="{{ route('bengkel.antrean') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-sm bg-gradient-to-r from-garage-500 to-garage-600 text-white shadow-md shadow-garage-600/20">
                <i class="fa-solid fa-car-side w-5 text-center text-base"></i>
                <span>Antrean PIT Bay</span>
                <span id="sidebar-pit-count" class="ml-auto text-[10px] font-bold px-2 py-0.5 rounded-full bg-white/20 text-white">Aktif</span>
            </a>

            <div class="px-3 pt-5 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">Operasional</div>

            <a href="{{ route('bengkel.pelanggan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-id-card-clip w-5 text-center text-base"></i>
                <span>Pelanggan & Unit</span>
            </a>

            <a href="{{ route('bengkel.servis') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-screwdriver-wrench w-5 text-center text-base"></i>
                <span>Work Order & Servis</span>
            </a>

            <a href="{{ route('bengkel.invoice') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-receipt w-5 text-center text-base"></i>
                <span>Kasir & Invoice</span>
            </a>
        </nav>

        <!-- Bottom Status -->
        <div class="p-4 border-t border-slate-800/80 bg-darkbase-950/40">
            <div class="flex items-center justify-between text-xs mb-1.5">
                <span class="text-slate-400 font-semibold flex items-center gap-1.5">
                    <i class="fa-solid fa-car-side text-garage-500"></i> Kapasitas Bay
                </span>
                <span id="sidebar-bay-label" class="text-emerald-400 font-bold">4 Kosong</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div id="sidebar-bay-bar" class="h-full bg-garage-500 rounded-full transition-all duration-700" style="width: 0%"></div>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-3 rounded-lg text-xs font-bold text-rose-400 hover:text-white hover:bg-rose-500/20 border border-rose-500/30 transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- ============================================================== -->
    <!-- MAIN CONTENT -->
    <!-- ============================================================== -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        <!-- TOPBAR -->
        <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-20 px-8 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-6">
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                        <a href="{{ route('bengkel.dashboard') }}" class="hover:text-garage-600 transition">L-Garage Workshop</a>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        <span class="text-slate-700 font-bold">Antrean PIT Bay</span>
                    </div>
                    <h1 class="text-lg font-heading font-black text-slate-900 mt-0.5 flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Monitor Antrean & Status PIT Bay Live
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <!-- Live Clock -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-darkbase-900 border border-slate-700 text-xs font-mono font-bold text-emerald-400">
                    <span class="timer-blink">●</span>
                    <span id="live-clock">--:--:--</span>
                </div>

                <!-- Date Pill -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200/80 text-xs font-semibold text-slate-600">
                    <i class="fa-regular fa-calendar text-garage-500"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Bell -->
                <button type="button" class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                    <i class="fa-regular fa-bell text-sm"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-garage-500"></span>
                </button>

                <!-- Profile -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-500 to-amber-500 text-white font-black font-heading flex items-center justify-center shadow-md shadow-garage-500/20 text-sm">
                        {{ strtoupper(substr($user->name ?? 'L', 0, 1)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <div class="text-xs font-bold text-slate-800 leading-tight">{{ $user->name ?? 'L-Garage Workshop' }}</div>
                        <div class="text-[11px] font-semibold text-garage-600">Role: {{ strtoupper($user->role ?? 'bengkel') }}</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-8 space-y-7 max-w-[1600px] w-full mx-auto">

            <!-- 1. HEADER BANNER + ACTIONS -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col lg:flex-row lg:items-center justify-between gap-5">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-tr from-slate-800 to-slate-700 text-white flex items-center justify-center text-2xl shadow-md">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h2 class="text-2xl font-heading font-black text-slate-900 tracking-tight">Antrean PIT Bay</h2>
                            <span id="total-antrean-badge" class="px-3 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200 text-xs font-bold flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                0 Kendaraan
                            </span>
                        </div>
                        <p class="text-slate-500 text-sm mt-0.5">
                            Monitor status antrean kendaraan, alokasi bay, dan estimasi waktu selesai servis secara live.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2.5">
                    <button
                        type="button"
                        onclick="openAddAntreanModal()"
                        id="btn-tambah-antrean"
                        class="px-5 py-3 rounded-xl bg-slate-900 hover:bg-black text-white font-bold text-xs shadow-md transition flex items-center gap-2 active:scale-95"
                    >
                        <i class="fa-solid fa-plus"></i>
                        <span>+ Tambah Kendaraan</span>
                    </button>

                    <button
                        type="button"
                        onclick="loadDemoAntrean()"
                        class="px-4 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition flex items-center gap-1.5 border border-slate-200"
                    >
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                        <span class="hidden sm:inline">Contoh Data</span>
                    </button>

                    <button
                        type="button"
                        onclick="clearAllAntrean()"
                        class="px-3.5 py-3 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs transition border border-rose-200"
                        title="Kosongkan semua antrean"
                    >
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>

            <!-- 2. SUMMARY KPI ROW -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Total Antrean</span>
                        <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                            <i class="fa-solid fa-list-ol text-sm"></i>
                        </div>
                    </div>
                    <div id="kpi-total" class="text-3xl font-black font-heading text-slate-900">0</div>
                    <div class="text-[11px] text-slate-400 mt-1">Kendaraan masuk hari ini</div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Bay Terisi</span>
                        <div class="w-10 h-10 rounded-xl bg-garage-50 text-garage-600 flex items-center justify-center">
                            <i class="fa-solid fa-car text-sm"></i>
                        </div>
                    </div>
                    <div id="kpi-terisi" class="text-3xl font-black font-heading text-garage-600">0 / 4</div>
                    <div class="text-[11px] text-slate-400 mt-1">Kapasitas bay aktif</div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Menunggu</span>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                            <i class="fa-solid fa-hourglass-half text-sm"></i>
                        </div>
                    </div>
                    <div id="kpi-menunggu" class="text-3xl font-black font-heading text-amber-600">0</div>
                    <div class="text-[11px] text-slate-400 mt-1">Belum masuk bay</div>
                </div>

                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-bold text-slate-500">Selesai Hari Ini</span>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                            <i class="fa-solid fa-circle-check text-sm"></i>
                        </div>
                    </div>
                    <div id="kpi-selesai" class="text-3xl font-black font-heading text-emerald-600">0</div>
                    <div class="text-[11px] text-slate-400 mt-1">Kendaraan sudah diambil</div>
                </div>

            </div>

            <!-- 3. PIT BAY GRID (4 BAY VISUAL CARDS) -->
            <div>
                <h3 class="text-sm font-heading font-black text-slate-900 flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-warehouse text-garage-500"></i>
                    Status PIT Bay Real-Time
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5" id="pit-bay-grid">

                    @foreach($pitBays as $idx => $pit)
                    <div
                        id="pit-card-{{ $pit['no'] }}"
                        class="pit-card-{{ $pit['status'] }} rounded-3xl border-2 p-6 flex flex-col gap-4 transition-all duration-400 relative overflow-hidden group"
                    >
                        <!-- Bay Number Header -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-white/70 backdrop-blur-sm border border-white/50 flex items-center justify-center font-heading font-black text-xl text-slate-900 shadow-sm">
                                    {{ $pit['no'] }}
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-500">PIT BAY</div>
                                    <div class="text-sm font-black text-slate-900">Bay #{{ $pit['no'] }}</div>
                                </div>
                            </div>
                            <span id="pit-badge-{{ $pit['no'] }}" class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200 text-[11px] font-bold">
                                Kosong
                            </span>
                        </div>

                        <!-- Vehicle Info (Hidden when empty) -->
                        <div id="pit-vehicle-{{ $pit['no'] }}" class="hidden space-y-2">
                            <div class="bg-white/60 backdrop-blur-sm rounded-xl p-3 border border-white/50 space-y-1.5">
                                <div id="pit-vname-{{ $pit['no'] }}" class="text-sm font-bold text-slate-900 truncate">—</div>
                                <div id="pit-vmodel-{{ $pit['no'] }}" class="text-[11px] text-slate-500 font-semibold truncate">—</div>
                                <div id="pit-vplat-{{ $pit['no'] }}" class="text-[11px] font-mono font-black text-slate-800 tracking-wider">—</div>
                            </div>

                            <!-- Progress Bar -->
                            <div>
                                <div class="flex items-center justify-between text-[10px] font-bold text-slate-500 mb-1.5">
                                    <span id="pit-vjob-{{ $pit['no'] }}">Menunggu</span>
                                    <span id="pit-vpct-{{ $pit['no'] }}">0%</span>
                                </div>
                                <div class="h-2 w-full bg-white/50 rounded-full overflow-hidden">
                                    <div id="pit-vbar-{{ $pit['no'] }}" class="h-full bg-garage-500 rounded-full transition-all duration-700" style="width:0%"></div>
                                </div>
                            </div>

                            <!-- Mekanik & Timer -->
                            <div class="flex items-center justify-between text-[11px] font-semibold text-slate-500">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-user-gear text-[10px]"></i>
                                    <span id="pit-vmek-{{ $pit['no'] }}">—</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-garage-700 font-bold">
                                    <i class="fa-regular fa-clock text-[10px]"></i>
                                    <span id="pit-vtime-{{ $pit['no'] }}">—</span>
                                </div>
                            </div>
                        </div>

                        <!-- Empty State -->
                        <div id="pit-empty-{{ $pit['no'] }}" class="flex flex-col items-center justify-center py-6 text-slate-400 text-center gap-2">
                            <i class="fa-solid fa-parking text-4xl text-slate-200"></i>
                            <span class="text-xs font-bold text-slate-400">Bay Tersedia</span>
                            <button
                                type="button"
                                onclick="openAddAntreanModal('{{ $pit['no'] }}')"
                                class="mt-1 px-3 py-1.5 rounded-lg bg-white/80 hover:bg-white text-slate-700 font-bold text-[11px] border border-slate-200/80 transition shadow-sm"
                            >
                                <i class="fa-solid fa-plus text-[10px]"></i> Isi Bay
                            </button>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <!-- 4. ANTREAN LIST TABLE -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <!-- Table Header -->
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm border border-amber-100">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-heading font-black text-slate-900">Daftar Antrean Masuk</h3>
                            <p class="text-[11px] text-slate-400 font-medium">Kelola urutan kendaraan dan alokasi bay servis</p>
                        </div>
                    </div>

                    <!-- Filter Tabs -->
                    <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200/80 self-start sm:self-auto text-[11px]">
                        <button id="tab-semua"   onclick="setFilter('semua')"   class="px-3 py-1.5 rounded-lg font-bold transition bg-slate-900 text-white shadow-sm">Semua</button>
                        <button id="tab-tunggu"  onclick="setFilter('tunggu')"  class="px-3 py-1.5 rounded-lg font-semibold text-slate-500 hover:text-slate-800 transition">Menunggu</button>
                        <button id="tab-dikerjakan" onclick="setFilter('dikerjakan')" class="px-3 py-1.5 rounded-lg font-semibold text-slate-500 hover:text-slate-800 transition">Dikerjakan</button>
                        <button id="tab-selesai" onclick="setFilter('selesai')" class="px-3 py-1.5 rounded-lg font-semibold text-slate-500 hover:text-slate-800 transition">Selesai</button>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="px-6 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">No. Antrean</th>
                                <th class="px-4 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">Pemilik & Kendaraan</th>
                                <th class="px-4 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">Pekerjaan</th>
                                <th class="px-4 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">Bay</th>
                                <th class="px-4 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">Mekanik</th>
                                <th class="px-4 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">Masuk</th>
                                <th class="px-4 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">Status</th>
                                <th class="px-4 py-3.5 font-bold text-slate-500 uppercase tracking-wide text-[10px]">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="antrean-table-body">
                            <!-- Rendered by JS -->
                        </tbody>
                    </table>
                </div>

                <!-- Empty State Table -->
                <div id="table-empty-state" class="py-16 flex flex-col items-center justify-center text-center gap-3">
                    <div class="w-16 h-16 rounded-3xl bg-slate-100 text-slate-400 flex items-center justify-center text-3xl">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                    <div>
                        <h4 class="font-heading font-black text-slate-900 text-base">Belum Ada Antrean Kendaraan</h4>
                        <p class="text-xs text-slate-400 mt-1 max-w-xs mx-auto leading-relaxed">
                            Daftar antrean masih kosong. Tambahkan kendaraan baru atau muat contoh data.
                        </p>
                    </div>
                    <div class="flex gap-3 mt-2">
                        <button onclick="openAddAntreanModal()" class="px-4 py-2 rounded-xl bg-slate-900 text-white font-bold text-xs transition hover:bg-black flex items-center gap-2">
                            <i class="fa-solid fa-plus"></i> Tambah Kendaraan
                        </button>
                        <button onclick="loadDemoAntrean()" class="px-4 py-2 rounded-xl bg-slate-100 border border-slate-200 text-slate-700 font-bold text-xs transition hover:bg-slate-200 flex items-center gap-2">
                            <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i> Muat Contoh
                        </button>
                    </div>
                </div>

            </div>

            <!-- 5. MEKANIK AVAILABILITY PANEL -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <h3 class="text-sm font-heading font-black text-slate-900 flex items-center gap-2 mb-5">
                    <i class="fa-solid fa-helmet-safety text-garage-500"></i>
                    Ketersediaan Mekanik
                </h3>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($mekaniks as $mk)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-center space-y-3 hover:border-garage-300 transition">
                        <div class="w-12 h-12 rounded-xl bg-{{ $mk['color'] }}-100 text-{{ $mk['color'] }}-700 font-black font-heading text-lg flex items-center justify-center border border-{{ $mk['color'] }}-200 mx-auto">
                            {{ $mk['initial'] }}
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900">{{ $mk['name'] }}</div>
                            <div class="text-[10px] text-slate-500 font-semibold">{{ $mk['level'] }} Mekanik</div>
                        </div>
                        <span class="mekanik-avail-badge inline-block px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200 text-[10px] font-bold"
                              data-name="{{ $mk['name'] }}">
                            Tersedia
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

        </main>

        <!-- FOOTER -->
        <footer class="mt-auto px-8 py-5 bg-white border-t border-slate-200 text-slate-400 text-xs flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>&copy; {{ date('Y') }} <strong>L-Garage Workshop System</strong> &bull; Modul Antrean PIT Bay & Monitor Servis Live.</div>
            <div class="flex items-center gap-4 text-[11px] font-medium">
                <span>Versi 2.4.0 (Desktop Edition)</span>
                <span>&bull;</span>
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span> Bay Monitor Live
                </span>
            </div>
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- MODAL: TAMBAH KENDARAAN KE ANTREAN -->
    <!-- ============================================================== -->
    <div id="add-antrean-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-xl w-full shadow-2xl overflow-hidden">

            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-slate-900 to-slate-800 p-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/10 text-white flex items-center justify-center text-lg">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-white text-lg">Tambah ke Antrean</h3>
                        <p class="text-slate-400 text-xs font-medium">Daftarkan kendaraan ke PIT Bay workshop</p>
                    </div>
                </div>
                <button type="button" onclick="closeAddAntreanModal()" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form onsubmit="handleSaveAntrean(event)" class="p-6 space-y-4">

                <!-- Auto No. Antrean -->
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <i class="fa-solid fa-hashtag text-slate-500 text-sm"></i>
                    <div>
                        <div class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Nomor Antrean (Auto)</div>
                        <div id="modal-antrean-number" class="text-sm font-black font-heading text-slate-900">A-001</div>
                    </div>
                </div>

                <!-- Nama & No HP -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Nama Pemilik *</label>
                        <input type="text" id="modal-a-nama" required placeholder="Contoh: Pak Rahmat"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">No. WhatsApp</label>
                        <input type="text" id="modal-a-hp" placeholder="081298xxxxxx"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                    </div>
                </div>

                <!-- Model & Plat -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Merek & Tipe Kendaraan *</label>
                        <input type="text" id="modal-a-model" required placeholder="Contoh: Toyota Innova 2.4"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Nomor Plat *</label>
                        <input type="text" id="modal-a-plat" required placeholder="B 2314 TZZ"
                            oninput="this.value = this.value.toUpperCase()"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-bold uppercase text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                    </div>
                </div>

                <!-- Pekerjaan & Bay -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Jenis Pekerjaan *</label>
                        <input type="text" id="modal-a-job" required placeholder="Contoh: Ganti oli + tune up"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Alokasi Bay</label>
                        <select id="modal-a-bay"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                            <option value="">— Tunggu (Belum Dialokasi) —</option>
                            <option value="01">Bay #01</option>
                            <option value="02">Bay #02</option>
                            <option value="03">Bay #03</option>
                            <option value="04">Bay #04</option>
                        </select>
                    </div>
                </div>

                <!-- Mekanik & Estimasi -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Mekanik</label>
                        <select id="modal-a-mekanik"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                            <option value="">— Pilih Mekanik —</option>
                            <option value="Agus Widodo">Agus Widodo (Senior)</option>
                            <option value="Budi Santoso">Budi Santoso (Senior)</option>
                            <option value="Candra Putra">Candra Putra (Junior)</option>
                            <option value="Deni Firmansyah">Deni Firmansyah (Junior)</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Estimasi Selesai</label>
                        <input type="text" id="modal-a-estimasi" placeholder="Contoh: 14:30 WIB"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-400 transition">
                    </div>
                </div>

                <!-- Status Awal -->
                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-2">Status Awal</label>
                    <div class="flex gap-2 flex-wrap">
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 cursor-pointer hover:border-amber-300 transition has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50">
                            <input type="radio" name="a-status" value="tunggu" checked class="accent-amber-500">
                            <span class="text-xs font-semibold text-slate-700">Menunggu</span>
                        </label>
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 cursor-pointer hover:border-garage-300 transition has-[:checked]:border-garage-500 has-[:checked]:bg-garage-50">
                            <input type="radio" name="a-status" value="dikerjakan" class="accent-garage-500">
                            <span class="text-xs font-semibold text-slate-700">Dikerjakan</span>
                        </label>
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 cursor-pointer hover:border-emerald-300 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
                            <input type="radio" name="a-status" value="selesai" class="accent-emerald-500">
                            <span class="text-xs font-semibold text-slate-700">Selesai</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-2 border-t border-slate-100">
                    <button type="button" onclick="closeAddAntreanModal()" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-slate-900 hover:bg-black text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-check"></i> Simpan Antrean
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- JAVASCRIPT -->
    <!-- ============================================================== -->
    <script>
        // ── STATE ──────────────────────────────────────────────────────
        let antreanData = [];
        let antreanCounter = 1;
        let currentFilter = 'semua';
        let preSelectedBay = '';

        const STATUS_CONFIG = {
            tunggu:     { label: 'Menunggu',    badgeCls: 'bg-amber-100 text-amber-700 border-amber-200',   rowCls: '' },
            dikerjakan: { label: 'Dikerjakan',  badgeCls: 'bg-garage-100 text-garage-700 border-garage-200', rowCls: 'bg-garage-50/30' },
            selesai:    { label: 'Selesai',     badgeCls: 'bg-emerald-100 text-emerald-700 border-emerald-200', rowCls: 'bg-emerald-50/20' },
        };

        // ── CLOCK ──────────────────────────────────────────────────────
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            const el = document.getElementById('live-clock');
            if (el) el.textContent = `${h}:${m}:${s}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        // ── MODAL ─────────────────────────────────────────────────────
        function openAddAntreanModal(bayPreset = '') {
            preSelectedBay = bayPreset;
            const modal = document.getElementById('add-antrean-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.getElementById('modal-antrean-number').textContent = `A-${String(antreanCounter).padStart(3, '0')}`;

            if (bayPreset) {
                document.getElementById('modal-a-bay').value = bayPreset;
            }
        }

        function closeAddAntreanModal() {
            const modal = document.getElementById('add-antrean-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            preSelectedBay = '';
        }

        document.getElementById('add-antrean-modal').addEventListener('click', function(e) {
            if (e.target === this) closeAddAntreanModal();
        });

        // ── SAVE ─────────────────────────────────────────────────────
        function handleSaveAntrean(e) {
            e.preventDefault();
            const status = document.querySelector('input[name="a-status"]:checked')?.value || 'tunggu';

            const item = {
                id: antreanCounter,
                no: `A-${String(antreanCounter).padStart(3, '0')}`,
                nama: document.getElementById('modal-a-nama').value.trim(),
                hp: document.getElementById('modal-a-hp').value.trim(),
                model: document.getElementById('modal-a-model').value.trim(),
                plat: document.getElementById('modal-a-plat').value.trim().toUpperCase(),
                job: document.getElementById('modal-a-job').value.trim(),
                bay: document.getElementById('modal-a-bay').value,
                mekanik: document.getElementById('modal-a-mekanik').value,
                estimasi: document.getElementById('modal-a-estimasi').value.trim(),
                status: status,
                waktuMasuk: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                progress: status === 'selesai' ? 100 : (status === 'dikerjakan' ? 40 : 0),
            };

            antreanData.push(item);
            antreanCounter++;
            closeAddAntreanModal();
            e.target.reset();
            renderAll();
        }

        // ── DELETE ────────────────────────────────────────────────────
        function deleteAntrean(id) {
            antreanData = antreanData.filter(a => a.id !== id);
            renderAll();
        }

        // ── STATUS CYCLE ──────────────────────────────────────────────
        function cycleStatus(id) {
            const item = antreanData.find(a => a.id === id);
            if (!item) return;
            const cycle = ['tunggu', 'dikerjakan', 'selesai'];
            const idx = cycle.indexOf(item.status);
            item.status = cycle[(idx + 1) % cycle.length];
            item.progress = item.status === 'selesai' ? 100 : (item.status === 'dikerjakan' ? 50 : 0);
            renderAll();
        }

        // ── FILTER ────────────────────────────────────────────────────
        function setFilter(f) {
            currentFilter = f;
            ['semua', 'tunggu', 'dikerjakan', 'selesai'].forEach(tab => {
                const el = document.getElementById(`tab-${tab}`);
                if (el) {
                    if (tab === f) {
                        el.className = 'px-3 py-1.5 rounded-lg font-bold transition bg-slate-900 text-white shadow-sm';
                    } else {
                        el.className = 'px-3 py-1.5 rounded-lg font-semibold text-slate-500 hover:text-slate-800 transition';
                    }
                }
            });
            renderAll();
        }

        // ── RENDER ALL ────────────────────────────────────────────────
        function renderAll() {
            renderKPIs();
            renderPitBays();
            renderTable();
            renderMekanik();
            renderSidebar();
        }

        function renderKPIs() {
            const total   = antreanData.length;
            const terisi  = antreanData.filter(a => a.status === 'dikerjakan' && a.bay).length;
            const tunggu  = antreanData.filter(a => a.status === 'tunggu').length;
            const selesai = antreanData.filter(a => a.status === 'selesai').length;

            document.getElementById('kpi-total').textContent   = total;
            document.getElementById('kpi-terisi').textContent  = `${terisi} / 4`;
            document.getElementById('kpi-menunggu').textContent = tunggu;
            document.getElementById('kpi-selesai').textContent  = selesai;

            document.getElementById('total-antrean-badge').innerHTML =
                `<span class="w-1.5 h-1.5 rounded-full bg-${total > 0 ? 'garage' : 'emerald'}-500"></span> ${total} Kendaraan`;
        }

        function renderPitBays() {
            const bayNos = ['01', '02', '03', '04'];

            bayNos.forEach(no => {
                const card = document.getElementById(`pit-card-${no}`);
                const badge = document.getElementById(`pit-badge-${no}`);
                const vInfo = document.getElementById(`pit-vehicle-${no}`);
                const empty = document.getElementById(`pit-empty-${no}`);

                // Find vehicle assigned to this bay with dikerjakan status
                const vehicle = antreanData.find(a => a.bay === no && a.status === 'dikerjakan');
                const done    = antreanData.find(a => a.bay === no && a.status === 'selesai');

                card.classList.remove('pit-card-kosong', 'pit-card-terisi', 'pit-card-selesai', 'pit-card-masalah');

                if (vehicle) {
                    card.classList.add('pit-card-terisi');
                    badge.textContent = 'Sedang Dikerjakan';
                    badge.className = 'px-3 py-1 rounded-full bg-garage-100 text-garage-700 border border-garage-200 text-[11px] font-bold';
                    vInfo.classList.remove('hidden');
                    empty.classList.add('hidden');

                    document.getElementById(`pit-vname-${no}`).textContent  = vehicle.nama;
                    document.getElementById(`pit-vmodel-${no}`).textContent = vehicle.model;
                    document.getElementById(`pit-vplat-${no}`).textContent  = vehicle.plat;
                    document.getElementById(`pit-vjob-${no}`).textContent   = vehicle.job;
                    document.getElementById(`pit-vpct-${no}`).textContent   = `${vehicle.progress}%`;
                    document.getElementById(`pit-vbar-${no}`).style.width   = `${vehicle.progress}%`;
                    document.getElementById(`pit-vmek-${no}`).textContent   = vehicle.mekanik || '—';
                    document.getElementById(`pit-vtime-${no}`).textContent  = vehicle.estimasi || '—';

                } else if (done) {
                    card.classList.add('pit-card-selesai');
                    badge.textContent = 'Selesai';
                    badge.className = 'px-3 py-1 rounded-full bg-blue-100 text-blue-700 border border-blue-200 text-[11px] font-bold';
                    vInfo.classList.remove('hidden');
                    empty.classList.add('hidden');

                    document.getElementById(`pit-vname-${no}`).textContent  = done.nama;
                    document.getElementById(`pit-vmodel-${no}`).textContent = done.model;
                    document.getElementById(`pit-vplat-${no}`).textContent  = done.plat;
                    document.getElementById(`pit-vjob-${no}`).textContent   = 'Selesai — Siap Ambil';
                    document.getElementById(`pit-vpct-${no}`).textContent   = '100%';
                    document.getElementById(`pit-vbar-${no}`).style.width   = '100%';
                    document.getElementById(`pit-vbar-${no}`).classList.replace('bg-garage-500', 'bg-emerald-500');
                    document.getElementById(`pit-vmek-${no}`).textContent   = done.mekanik || '—';
                    document.getElementById(`pit-vtime-${no}`).textContent  = done.estimasi || '—';

                } else {
                    card.classList.add('pit-card-kosong');
                    badge.textContent = 'Kosong';
                    badge.className = 'px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200 text-[11px] font-bold';
                    vInfo.classList.add('hidden');
                    empty.classList.remove('hidden');
                }
            });
        }

        function renderTable() {
            const tbody = document.getElementById('antrean-table-body');
            const emptyState = document.getElementById('table-empty-state');

            let filtered = antreanData;
            if (currentFilter !== 'semua') {
                filtered = antreanData.filter(a => a.status === currentFilter);
            }

            if (filtered.length === 0) {
                tbody.innerHTML = '';
                emptyState.style.display = '';
                return;
            }
            emptyState.style.display = 'none';

            tbody.innerHTML = filtered.map(item => {
                const cfg = STATUS_CONFIG[item.status] || STATUS_CONFIG.tunggu;
                return `
                    <tr class="border-b border-slate-100 hover:bg-slate-50/60 transition queue-item slide-in ${cfg.rowCls}">
                        <td class="px-6 py-4">
                            <span class="font-mono font-black text-xs text-slate-700">${item.no}</span>
                        </td>
                        <td class="px-4 py-4">
                            <div class="font-bold text-slate-900 text-xs">${item.nama}</div>
                            <div class="text-[11px] text-slate-400 font-semibold">${item.model}</div>
                            <div class="text-[11px] font-mono font-black text-slate-600">${item.plat}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-xs font-semibold text-slate-700 max-w-[160px] truncate" title="${item.job}">${item.job}</div>
                        </td>
                        <td class="px-4 py-4">
                            ${item.bay
                                ? `<span class="px-2 py-0.5 rounded-lg bg-slate-100 text-slate-700 font-bold text-[10px] border border-slate-200">Bay #${item.bay}</span>`
                                : `<span class="text-slate-400 text-[11px] italic">Belum dialokasi</span>`
                            }
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-[11px] font-semibold text-slate-600">${item.mekanik || '—'}</div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-[11px] font-semibold text-slate-600">${item.waktuMasuk}</div>
                            ${item.estimasi ? `<div class="text-[10px] text-garage-600 font-bold flex items-center gap-1"><i class="fa-regular fa-clock text-[9px]"></i> Est: ${item.estimasi}</div>` : ''}
                        </td>
                        <td class="px-4 py-4">
                            <button onclick="cycleStatus(${item.id})" class="px-2.5 py-1 rounded-full border text-[10px] font-bold ${cfg.badgeCls} hover:opacity-80 transition">
                                ${cfg.label}
                            </button>
                        </td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                ${item.hp ? `
                                <a href="https://wa.me/62${item.hp.replace(/^0/, '')}" target="_blank"
                                   class="w-7 h-7 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-600 flex items-center justify-center text-[11px] border border-emerald-200 transition"
                                   title="WhatsApp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>` : ''}
                                <button onclick="deleteAntrean(${item.id})"
                                    class="w-7 h-7 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-400 flex items-center justify-center text-[11px] border border-rose-200 transition"
                                    title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function renderMekanik() {
            const badges = document.querySelectorAll('.mekanik-avail-badge');
            badges.forEach(badge => {
                const name = badge.dataset.name;
                const busy = antreanData.some(a => a.mekanik === name && a.status === 'dikerjakan');
                if (busy) {
                    badge.textContent = 'Sedang Bekerja';
                    badge.className = 'mekanik-avail-badge inline-block px-2.5 py-0.5 rounded-full bg-garage-100 text-garage-700 border border-garage-200 text-[10px] font-bold';
                } else {
                    badge.textContent = 'Tersedia';
                    badge.className = 'mekanik-avail-badge inline-block px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200 text-[10px] font-bold';
                }
                badge.dataset.name = name; // preserve
            });
        }

        function renderSidebar() {
            const terisi = antreanData.filter(a => a.status === 'dikerjakan' && a.bay).length;
            const pct = Math.round((terisi / 4) * 100);
            document.getElementById('sidebar-bay-bar').style.width = `${pct}%`;
            document.getElementById('sidebar-bay-label').textContent = terisi > 0 ? `${terisi}/4 Terisi` : '4 Kosong';
            document.getElementById('sidebar-pit-count').textContent = terisi > 0 ? `${terisi} Terisi` : 'Aktif';
        }

        // ── DEMO DATA ────────────────────────────────────────────────
        function loadDemoAntrean() {
            antreanData = [
                {
                    id: 1, no: 'A-001',
                    nama: 'Pak Rahmat Hidayat', hp: '081298432210',
                    model: 'Toyota Innova Reborn 2.4 Diesel', plat: 'B 2314 TZZ',
                    job: 'Servis Berkala 60.000 KM + Ganti Oli Full Synthetic',
                    bay: '01', mekanik: 'Agus Widodo', estimasi: '12:30 WIB',
                    status: 'dikerjakan', waktuMasuk: '08:15', progress: 65,
                },
                {
                    id: 2, no: 'A-002',
                    nama: 'Pak Hendra Setiawan', hp: '081192348819',
                    model: 'Mitsubishi Pajero Sport Dakar', plat: 'B 8899 DKR',
                    job: 'Spooring 3D & Balancing 4 Roda + Ganti Oli',
                    bay: '02', mekanik: 'Budi Santoso', estimasi: '13:00 WIB',
                    status: 'dikerjakan', waktuMasuk: '09:00', progress: 30,
                },
                {
                    id: 3, no: 'A-003',
                    nama: 'Ibu Cindy Patricia', hp: '087855214320',
                    model: 'Honda CR-V 1.5L Turbo', plat: 'B 2041 RFS',
                    job: 'Cek bunyi suspensi depan + Tune Up',
                    bay: '', mekanik: 'Candra Putra', estimasi: '14:30 WIB',
                    status: 'tunggu', waktuMasuk: '09:45', progress: 0,
                },
                {
                    id: 4, no: 'A-004',
                    nama: 'Pak Dony Kusuma', hp: '085633219901',
                    model: 'Suzuki Ertiga GX', plat: 'D 4411 SKZ',
                    job: 'Tune Up 25.000 KM + AC Service',
                    bay: '04', mekanik: 'Deni Firmansyah', estimasi: '11:00 WIB',
                    status: 'selesai', waktuMasuk: '07:30', progress: 100,
                },
                {
                    id: 5, no: 'A-005',
                    nama: 'Ibu Maya Anggraini', hp: '081234567890',
                    model: 'Daihatsu Xenia 1.3 R CVT', plat: 'B 7788 KJL',
                    job: 'Ganti Kampas Rem Belakang + Bleeding',
                    bay: '', mekanik: '', estimasi: '',
                    status: 'tunggu', waktuMasuk: '10:20', progress: 0,
                },
            ];
            antreanCounter = 6;
            renderAll();
        }

        function clearAllAntrean() {
            if (antreanData.length === 0) return;
            if (confirm('Yakin ingin mengosongkan semua data antrean?')) {
                antreanData = [];
                antreanCounter = 1;
                renderAll();
            }
        }

        // ── INIT ─────────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', () => {
            renderAll();
        });
    </script>

</body>
</html>
