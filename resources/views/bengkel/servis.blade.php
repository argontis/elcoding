<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Garage — Work Order & Manajemen Servis</title>
    <meta name="description" content="Sistem manajemen work order dan pengerjaan servis kendaraan L-Garage Workshop.">

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
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                            950: '#431407',
                        },
                        darkbase: {
                            800: '#1e232d',
                            900: '#14171f',
                            950: '#0c0e14',
                        }
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Custom Scrollbar */
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
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in { animation: slideIn 0.25s ease forwards; }

        /* Kanban column drag-over */
        .kanban-col.drag-over { outline: 2px dashed #f97316; background: #fff7ed; }
        .wo-card { cursor: grab; }
        .wo-card:active { cursor: grabbing; }
    </style>
</head>
<body class="min-h-screen flex antialiased selection:bg-garage-500 selection:text-white">

    <!-- ============================================================== -->
    <!-- DESKTOP SIDEBAR -->
    <!-- ============================================================== -->
    <aside class="w-64 bg-darkbase-900 border-r border-slate-800 text-slate-300 flex flex-col fixed inset-y-0 left-0 z-30 transition-all duration-300">

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
            <span class="px-2 py-0.5 text-[10px] font-bold bg-garage-500/20 text-garage-400 rounded-md border border-garage-500/30">
                PRO
            </span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <div class="px-3 pt-2 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Menu Utama
            </div>

            <!-- Dashboard -->
            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                <span>Dashboard</span>
            </a>

            <!-- Booking Servis -->
            <a href="{{ route('bengkel.booking') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-calendar-check w-5 text-center text-base"></i>
                <span>Booking Servis</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-800 text-slate-400">0</span>
            </a>

            <!-- Antrean & Bay Servis -->
            <a href="{{ route('bengkel.antrean') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-car-side w-5 text-center text-base"></i>
                <span>Antrean PIT Bay</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">4 Free</span>
            </a>

            <div class="px-3 pt-5 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Operasional
            </div>

            <!-- Pelanggan & Unit -->
            <a href="{{ route('bengkel.pelanggan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-id-card-clip w-5 text-center text-base"></i>
                <span>Pelanggan & Unit</span>
            </a>

            <!-- Active: Work Order & Servis -->
            <a href="{{ route('bengkel.servis') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-sm bg-gradient-to-r from-garage-500 to-garage-600 text-white shadow-md shadow-garage-600/20">
                <i class="fa-solid fa-screwdriver-wrench w-5 text-center text-base"></i>
                <span>Work Order & Servis</span>
                <span class="ml-auto text-[10px] font-bold px-2 py-0.5 rounded-full bg-white/20 text-white">Aktif</span>
            </a>

            <!-- Kasir & Invoice -->
            <a href="{{ route('bengkel.invoice') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-receipt w-5 text-center text-base"></i>
                <span>Kasir & Invoice</span>
            </a>
        </nav>

        <!-- Bottom PIT Status -->
        <div class="p-4 border-t border-slate-800/80 bg-darkbase-950/40">
            <div class="flex items-center justify-between text-xs mb-1.5">
                <span class="text-slate-400 font-semibold flex items-center gap-1.5">
                    <i class="fa-solid fa-screwdriver-wrench text-garage-500"></i> Work Order
                </span>
                <span id="sidebar-wo-count" class="text-amber-400 font-bold">0 Aktif</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div id="sidebar-wo-bar" class="h-full bg-garage-500 rounded-full transition-all duration-500" style="width: 0%"></div>
            </div>

            <!-- Logout Form -->
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
    <!-- MAIN CONTENT AREA -->
    <!-- ============================================================== -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        <!-- TOPBAR DESKTOP -->
        <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-20 px-8 flex items-center justify-between shadow-xs">

            <div class="flex items-center gap-6">
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                        <a href="{{ route('bengkel.dashboard') }}" class="hover:text-garage-600 transition">L-Garage Workshop</a>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        <span class="text-slate-700 font-bold">Work Order & Manajemen Servis</span>
                    </div>
                    <h1 class="text-lg font-heading font-black text-slate-900 mt-0.5 flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-garage-500"></span>
                        Board Pengerjaan Servis Kendaraan
                    </h1>
                </div>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-garage-50 border border-garage-200 text-xs font-bold text-garage-700">
                    <span class="w-2 h-2 rounded-full bg-garage-500 pulse-live"></span>
                    <span>Workshop Aktif</span>
                </div>

                <!-- Date Pill -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200/80 text-xs font-semibold text-slate-600">
                    <i class="fa-regular fa-calendar text-garage-500"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Notification Bell -->
                <button type="button" class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                    <i class="fa-regular fa-bell text-sm"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-garage-500"></span>
                </button>

                <!-- Profile Plate -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-500 to-amber-500 text-white font-black font-heading flex items-center justify-center shadow-md shadow-garage-500/20 text-sm">
                        {{ strtoupper(substr($user->name ?? 'L', 0, 1)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <div class="text-xs font-bold text-slate-800 leading-tight">
                            {{ $user->name ?? 'L-Garage Workshop' }}
                        </div>
                        <div class="text-[11px] font-semibold text-garage-600">
                            Role: {{ strtoupper($user->role ?? 'bengkel') }}
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-8 space-y-7 max-w-[1600px] w-full mx-auto">

            <!-- 1. PAGE HEADER + ACTIONS -->
            <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-garage-500 to-amber-500 text-white flex items-center justify-center text-xl shadow-md shadow-garage-500/20">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h2 class="text-2xl font-heading font-black text-slate-900 tracking-tight">
                                Work Order & Servis
                            </h2>
                            <span id="total-wo-badge" class="px-3 py-0.5 rounded-full bg-garage-100 text-garage-800 border border-garage-200 text-xs font-bold flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-garage-500"></span>
                                0 Aktif
                            </span>
                        </div>
                        <p class="text-slate-500 text-sm mt-0.5">
                            Kelola alur pengerjaan kendaraan dari penerimaan hingga selesai servis.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2.5">
                    <button
                        type="button"
                        onclick="openAddWOModal()"
                        id="btn-tambah-wo"
                        class="px-5 py-3 rounded-xl bg-garage-600 hover:bg-garage-700 text-white font-bold text-xs shadow-md shadow-garage-600/20 transition flex items-center gap-2 active:scale-95"
                    >
                        <i class="fa-solid fa-plus"></i>
                        <span>+ Buat Work Order</span>
                    </button>

                    <button
                        type="button"
                        onclick="loadDemoWO()"
                        class="px-4 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition flex items-center gap-1.5 border border-slate-200"
                        title="Muat contoh data"
                    >
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                        <span class="hidden sm:inline">Contoh Data</span>
                    </button>

                    <button
                        type="button"
                        onclick="clearAllWO()"
                        class="px-3.5 py-3 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs transition border border-rose-200"
                        title="Kosongkan semua work order"
                    >
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </div>
            </div>

            <!-- 2. PIT BAY STATUS ROW -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                @php
                    $pitBays = [
                        ['no' => '01', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
                        ['no' => '02', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
                        ['no' => '03', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
                        ['no' => '04', 'status' => 'Kosong', 'color' => 'emerald', 'icon' => 'fa-circle-check'],
                    ];
                @endphp

                @foreach($pitBays as $pit)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-4 flex items-center gap-4 group hover:border-{{ $pit['color'] }}-300 transition-all duration-200">
                    <div class="w-12 h-12 rounded-xl bg-{{ $pit['color'] }}-50 text-{{ $pit['color'] }}-600 border border-{{ $pit['color'] }}-200 flex items-center justify-center text-xl font-black font-heading">
                        {{ $pit['no'] }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">PIT BAY</div>
                        <div class="text-sm font-black text-slate-900 truncate">Bay #{{ $pit['no'] }}</div>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-{{ $pit['color'] }}-500"></span>
                            <span class="text-[11px] font-bold text-{{ $pit['color'] }}-600">{{ $pit['status'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- 3. KANBAN BOARD WORK ORDER -->
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-heading font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-columns text-garage-500 text-sm"></i>
                        Pipeline Pengerjaan Servis
                    </h3>
                    <div class="flex items-center gap-3 text-xs font-semibold text-slate-500">
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-400"></span> Menunggu</span>
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Pemeriksaan</span>
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-garage-500"></span> Pengerjaan</span>
                        <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Selesai</span>
                    </div>
                </div>

                <!-- Kanban Columns -->
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

                    <!-- Column: Menunggu -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between px-1">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-amber-400"></span>
                                <span class="text-xs font-bold text-slate-700">Menunggu</span>
                            </div>
                            <span id="count-menunggu" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">0</span>
                        </div>
                        <div
                            id="col-menunggu"
                            ondragover="handleDragOver(event)"
                            ondrop="handleDrop(event, 'menunggu')"
                            class="kanban-col min-h-36 rounded-2xl border-2 border-dashed border-slate-200 p-2 space-y-3 transition-all"
                        >
                            <!-- Empty state -->
                            <div id="empty-menunggu" class="flex flex-col items-center justify-center py-8 text-slate-400 text-xs text-center gap-2">
                                <i class="fa-solid fa-hourglass text-2xl text-slate-300"></i>
                                <span>Belum ada antrian</span>
                            </div>
                        </div>
                    </div>

                    <!-- Column: Pemeriksaan -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between px-1">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                                <span class="text-xs font-bold text-slate-700">Pemeriksaan</span>
                            </div>
                            <span id="count-pemeriksaan" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">0</span>
                        </div>
                        <div
                            id="col-pemeriksaan"
                            ondragover="handleDragOver(event)"
                            ondrop="handleDrop(event, 'pemeriksaan')"
                            class="kanban-col min-h-36 rounded-2xl border-2 border-dashed border-slate-200 p-2 space-y-3 transition-all"
                        >
                            <div id="empty-pemeriksaan" class="flex flex-col items-center justify-center py-8 text-slate-400 text-xs text-center gap-2">
                                <i class="fa-solid fa-magnifying-glass text-2xl text-slate-300"></i>
                                <span>Belum ada pemeriksaan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Column: Pengerjaan -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between px-1">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-garage-500"></span>
                                <span class="text-xs font-bold text-slate-700">Pengerjaan</span>
                            </div>
                            <span id="count-pengerjaan" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-garage-100 text-garage-700">0</span>
                        </div>
                        <div
                            id="col-pengerjaan"
                            ondragover="handleDragOver(event)"
                            ondrop="handleDrop(event, 'pengerjaan')"
                            class="kanban-col min-h-36 rounded-2xl border-2 border-dashed border-slate-200 p-2 space-y-3 transition-all"
                        >
                            <div id="empty-pengerjaan" class="flex flex-col items-center justify-center py-8 text-slate-400 text-xs text-center gap-2">
                                <i class="fa-solid fa-wrench text-2xl text-slate-300"></i>
                                <span>Belum ada pengerjaan</span>
                            </div>
                        </div>
                    </div>

                    <!-- Column: Selesai -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between px-1">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                                <span class="text-xs font-bold text-slate-700">Selesai</span>
                            </div>
                            <span id="count-selesai" class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">0</span>
                        </div>
                        <div
                            id="col-selesai"
                            ondragover="handleDragOver(event)"
                            ondrop="handleDrop(event, 'selesai')"
                            class="kanban-col min-h-36 rounded-2xl border-2 border-dashed border-slate-200 p-2 space-y-3 transition-all"
                        >
                            <div id="empty-selesai" class="flex flex-col items-center justify-center py-8 text-slate-400 text-xs text-center gap-2">
                                <i class="fa-solid fa-circle-check text-2xl text-slate-300"></i>
                                <span>Belum ada yang selesai</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Empty Board CTA -->
                <div id="board-empty-cta" class="mt-6 bg-white rounded-2xl border border-slate-200 shadow-sm p-10 text-center flex flex-col items-center justify-center">
                    <div class="w-20 h-20 rounded-3xl bg-garage-50 text-garage-500 flex items-center justify-center text-3xl mb-4 border border-garage-100">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <h4 class="font-heading font-black text-slate-900 text-lg">
                        Board Servis Masih Kosong
                    </h4>
                    <p class="text-xs text-slate-500 max-w-sm mt-1.5 leading-relaxed">
                        Buat Work Order pertama hari ini atau muat contoh data untuk melihat tampilan board pengerjaan servis.
                    </p>
                    <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
                        <button
                            type="button"
                            onclick="openAddWOModal()"
                            class="px-5 py-2.5 rounded-xl bg-garage-600 hover:bg-garage-700 text-white font-bold text-xs shadow-md transition flex items-center gap-2"
                        >
                            <i class="fa-solid fa-plus"></i>
                            <span>Buat Work Order Pertama</span>
                        </button>
                        <button
                            type="button"
                            onclick="loadDemoWO()"
                            class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition border border-slate-200 flex items-center gap-2"
                        >
                            <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                            <span>Muat Contoh Data</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. MEKANIK PERFORMANCE WIDGET -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-sm font-heading font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-helmet-safety text-garage-500"></i>
                        Mekanik Aktif Hari Ini
                    </h3>
                    <button
                        type="button"
                        onclick="openAddWOModal()"
                        class="text-xs font-bold text-garage-600 hover:text-garage-700 flex items-center gap-1 transition"
                    >
                        <i class="fa-solid fa-plus text-[10px]"></i> Tugaskan WO
                    </button>
                </div>

                <div id="mekanik-container" class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @php
                        $mekaniks = [
                            ['name' => 'Agus Widodo', 'initial' => 'AW', 'level' => 'Senior', 'color' => 'blue'],
                            ['name' => 'Budi Santoso', 'initial' => 'BS', 'level' => 'Senior', 'color' => 'indigo'],
                            ['name' => 'Candra Putra', 'initial' => 'CP', 'level' => 'Junior', 'color' => 'teal'],
                            ['name' => 'Deni Firmansyah', 'initial' => 'DF', 'level' => 'Junior', 'color' => 'purple'],
                        ];
                    @endphp

                    @foreach($mekaniks as $mk)
                    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-4 flex flex-col items-center text-center gap-3 hover:border-garage-300 transition">
                        <div class="w-14 h-14 rounded-2xl bg-{{ $mk['color'] }}-100 text-{{ $mk['color'] }}-700 font-black font-heading text-lg flex items-center justify-center border border-{{ $mk['color'] }}-200">
                            {{ $mk['initial'] }}
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-900">{{ $mk['name'] }}</div>
                            <div class="text-[10px] text-slate-500 font-semibold">{{ $mk['level'] }} Mekanik</div>
                        </div>
                        <div class="w-full">
                            <div class="flex justify-between text-[10px] font-semibold text-slate-400 mb-1">
                                <span>WO Ditangani</span>
                                <span class="mekanik-wo-count font-bold text-slate-700">0</span>
                            </div>
                            <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                <div class="mekanik-wo-bar h-full bg-{{ $mk['color'] }}-400 rounded-full transition-all duration-500" style="width: 0%"></div>
                            </div>
                        </div>
                        <span class="mekanik-status px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200 text-[10px] font-bold">
                            Standby
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>

        </main>

        <!-- FOOTER -->
        <footer class="mt-auto px-8 py-5 bg-white border-t border-slate-200 text-slate-400 text-xs flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>L-Garage Workshop System</strong> &bull; Modul Work Order & Manajemen Servis.
            </div>
            <div class="flex items-center gap-4 text-[11px] font-medium">
                <span>Versi 2.4.0 (Desktop Edition)</span>
                <span>&bull;</span>
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Workshop Engine Connected
                </span>
            </div>
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- MODAL: BUAT WORK ORDER BARU -->
    <!-- ============================================================== -->
    <div id="add-wo-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-2xl w-full shadow-2xl overflow-hidden">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-garage-600 to-amber-500 p-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm text-white flex items-center justify-center text-lg">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-black text-white text-lg">Buat Work Order Baru</h3>
                        <p class="text-garage-100 text-xs font-medium">Lengkapi data kendaraan & jenis pekerjaan servis</p>
                    </div>
                </div>
                <button type="button" onclick="closeAddWOModal()" class="w-9 h-9 rounded-xl bg-white/20 hover:bg-white/30 flex items-center justify-center text-white transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form onsubmit="handleSaveWO(event)" class="p-6 space-y-5 overflow-y-auto max-h-[70vh]">

                <!-- Nomor WO (auto-generated) -->
                <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                    <i class="fa-solid fa-hashtag text-garage-500 text-sm"></i>
                    <div>
                        <div class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Nomor Work Order (Auto)</div>
                        <div id="modal-wo-number" class="text-sm font-black font-heading text-slate-900">#LG-{{ date('Y') }}-0001</div>
                    </div>
                </div>

                <!-- Row 1: Nama & No HP -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Nama Pemilik Kendaraan *</label>
                        <input
                            type="text"
                            id="modal-wo-nama"
                            required
                            placeholder="Contoh: Pak Rahmat"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Nomor WhatsApp</label>
                        <input
                            type="text"
                            id="modal-wo-hp"
                            placeholder="Contoh: 081298xxxxxx"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                    </div>
                </div>

                <!-- Row 2: Merek & Plat Nomor -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Merek & Tipe Kendaraan *</label>
                        <input
                            type="text"
                            id="modal-wo-model"
                            required
                            placeholder="Contoh: Toyota Innova Reborn 2.4"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Nomor Plat *</label>
                        <input
                            type="text"
                            id="modal-wo-plat"
                            required
                            placeholder="Contoh: B 2314 TZZ"
                            oninput="this.value = this.value.toUpperCase()"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-bold uppercase text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                    </div>
                </div>

                <!-- Row 3: Odometer & Mekanik -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Odometer (KM)</label>
                        <input
                            type="text"
                            id="modal-wo-odo"
                            placeholder="Contoh: 58.400 KM"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Mekanik Penanggungjawab</label>
                        <select
                            id="modal-wo-mekanik"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                            <option value="">— Pilih Mekanik —</option>
                            <option value="Agus Widodo">Agus Widodo (Senior)</option>
                            <option value="Budi Santoso">Budi Santoso (Senior)</option>
                            <option value="Candra Putra">Candra Putra (Junior)</option>
                            <option value="Deni Firmansyah">Deni Firmansyah (Junior)</option>
                        </select>
                    </div>
                </div>

                <!-- Row 4: PIT Bay & Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">PIT Bay</label>
                        <select
                            id="modal-wo-pit"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                            <option value="">— Pilih Bay —</option>
                            <option value="Bay #01">Bay #01</option>
                            <option value="Bay #02">Bay #02</option>
                            <option value="Bay #03">Bay #03</option>
                            <option value="Bay #04">Bay #04</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-700 block mb-1.5">Status Awal</label>
                        <select
                            id="modal-wo-status"
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition"
                        >
                            <option value="menunggu">Menunggu (Baru Masuk)</option>
                            <option value="pemeriksaan">Pemeriksaan Awal</option>
                            <option value="pengerjaan">Langsung Dikerjakan</option>
                        </select>
                    </div>
                </div>

                <!-- Deskripsi Keluhan -->
                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-1.5">Keluhan / Pekerjaan yang Diminta *</label>
                    <textarea
                        id="modal-wo-keluhan"
                        required
                        rows="3"
                        placeholder="Contoh: Ganti oli mesin full synthetic, cek rem belakang bunyi, tune up berkala 60.000 KM..."
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/30 focus:border-garage-500 transition resize-none"
                    ></textarea>
                </div>

                <!-- Priority -->
                <div>
                    <label class="text-xs font-bold text-slate-700 block mb-2">Prioritas Pengerjaan</label>
                    <div class="flex gap-2">
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 cursor-pointer hover:border-garage-300 transition has-[:checked]:border-garage-500 has-[:checked]:bg-garage-50">
                            <input type="radio" name="priority" value="normal" checked class="accent-garage-500">
                            <span class="text-xs font-semibold text-slate-700">Normal</span>
                        </label>
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 cursor-pointer hover:border-amber-300 transition has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50">
                            <input type="radio" name="priority" value="rush" class="accent-amber-500">
                            <span class="text-xs font-semibold text-slate-700">Rush / Kilat</span>
                        </label>
                        <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 cursor-pointer hover:border-rose-300 transition has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50">
                            <input type="radio" name="priority" value="urgent" class="accent-rose-500">
                            <span class="text-xs font-semibold text-slate-700">Urgent!</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-slate-100">
                    <button type="button" onclick="closeAddWOModal()" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-garage-600 hover:bg-garage-700 text-white font-bold text-xs shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        Simpan Work Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- JAVASCRIPT LOGIC -->
    <!-- ============================================================== -->
    <script>
        // ───────────────────────────────────────────────────────────────
        // DATA STATE
        // ───────────────────────────────────────────────────────────────
        let workOrders = [];
        let woCounter = 1;
        let draggingId = null;

        const COLUMNS = ['menunggu', 'pemeriksaan', 'pengerjaan', 'selesai'];

        const COL_COLORS = {
            menunggu:    { badge: 'bg-amber-100 text-amber-700',   card: 'border-l-amber-400',   dot: 'bg-amber-400'   },
            pemeriksaan: { badge: 'bg-blue-100 text-blue-700',     card: 'border-l-blue-500',    dot: 'bg-blue-500'    },
            pengerjaan:  { badge: 'bg-garage-100 text-garage-700', card: 'border-l-garage-500',  dot: 'bg-garage-500'  },
            selesai:     { badge: 'bg-emerald-100 text-emerald-700', card: 'border-l-emerald-500', dot: 'bg-emerald-500' },
        };

        const PRIORITY_LABELS = {
            normal: { label: 'Normal',   cls: 'bg-slate-100 text-slate-600 border-slate-200'  },
            rush:   { label: 'Rush',     cls: 'bg-amber-100 text-amber-700 border-amber-200'  },
            urgent: { label: 'Urgent!',  cls: 'bg-rose-100 text-rose-700 border-rose-200'     },
        };

        // ───────────────────────────────────────────────────────────────
        // MODAL
        // ───────────────────────────────────────────────────────────────
        function openAddWOModal() {
            const modal = document.getElementById('add-wo-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            const num = String(woCounter).padStart(4, '0');
            document.getElementById('modal-wo-number').textContent = `#LG-{{ date('Y') }}-${num}`;
        }

        function closeAddWOModal() {
            const modal = document.getElementById('add-wo-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal on backdrop click
        document.getElementById('add-wo-modal').addEventListener('click', function(e) {
            if (e.target === this) closeAddWOModal();
        });

        // ───────────────────────────────────────────────────────────────
        // SAVE NEW WO
        // ───────────────────────────────────────────────────────────────
        function handleSaveWO(e) {
            e.preventDefault();

            const priority = document.querySelector('input[name="priority"]:checked')?.value || 'normal';

            const wo = {
                id: woCounter,
                no: `#LG-{{ date('Y') }}-${String(woCounter).padStart(4, '0')}`,
                nama: document.getElementById('modal-wo-nama').value.trim(),
                hp: document.getElementById('modal-wo-hp').value.trim(),
                model: document.getElementById('modal-wo-model').value.trim(),
                plat: document.getElementById('modal-wo-plat').value.trim().toUpperCase(),
                odo: document.getElementById('modal-wo-odo').value.trim(),
                mekanik: document.getElementById('modal-wo-mekanik').value,
                pit: document.getElementById('modal-wo-pit').value,
                keluhan: document.getElementById('modal-wo-keluhan').value.trim(),
                status: document.getElementById('modal-wo-status').value,
                priority: priority,
                time: new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }),
                progress: 0,
            };

            workOrders.push(wo);
            woCounter++;
            closeAddWOModal();
            e.target.reset();
            renderBoard();
        }

        // ───────────────────────────────────────────────────────────────
        // RENDER KANBAN BOARD
        // ───────────────────────────────────────────────────────────────
        function renderBoard() {
            COLUMNS.forEach(col => {
                const colEl = document.getElementById(`col-${col}`);
                const countEl = document.getElementById(`count-${col}`);
                const emptyEl = document.getElementById(`empty-${col}`);
                const items = workOrders.filter(wo => wo.status === col);

                countEl.textContent = items.length;

                // Remove existing cards (keep empty placeholder)
                Array.from(colEl.querySelectorAll('.wo-card')).forEach(el => el.remove());

                if (items.length === 0) {
                    if (emptyEl) emptyEl.style.display = '';
                } else {
                    if (emptyEl) emptyEl.style.display = 'none';
                    items.forEach(wo => {
                        colEl.appendChild(buildWOCard(wo));
                    });
                }
            });

            updateStats();
            updateSidebar();
            updateBoardCTA();
        }

        function buildWOCard(wo) {
            const colors = COL_COLORS[wo.status];
            const prio = PRIORITY_LABELS[wo.priority] || PRIORITY_LABELS.normal;

            const card = document.createElement('div');
            card.className = `wo-card bg-white rounded-xl border border-l-4 ${colors.card} border-slate-200 shadow-sm p-4 space-y-3 slide-in hover:shadow-md transition`;
            card.draggable = true;
            card.dataset.woid = wo.id;

            card.addEventListener('dragstart', (e) => {
                draggingId = wo.id;
                e.dataTransfer.effectAllowed = 'move';
                card.classList.add('opacity-50');
            });
            card.addEventListener('dragend', () => {
                draggingId = null;
                card.classList.remove('opacity-50');
            });

            card.innerHTML = `
                <div class="flex items-start justify-between gap-2">
                    <div class="flex items-center gap-2 flex-1 min-w-0">
                        <span class="text-[10px] font-black text-slate-400 font-mono">${wo.no}</span>
                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold border ${prio.cls}">${prio.label}</span>
                    </div>
                    <button onclick="deleteWO(${wo.id})" class="w-6 h-6 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-400 flex items-center justify-center text-[10px] transition shrink-0">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div>
                    <div class="font-bold text-sm text-slate-900 truncate">${wo.nama}</div>
                    <div class="text-[10px] text-slate-400 font-semibold mt-0.5">${wo.model} &bull; <span class="font-mono">${wo.plat}</span></div>
                </div>

                <div class="text-[11px] text-slate-600 font-medium leading-relaxed line-clamp-2 italic">
                    "${wo.keluhan}"
                </div>

                <div class="grid grid-cols-2 gap-1.5 text-[10px]">
                    ${wo.mekanik ? `<div class="flex items-center gap-1 text-slate-500"><i class="fa-solid fa-user-gear text-[9px]"></i> ${wo.mekanik}</div>` : ''}
                    ${wo.pit ? `<div class="flex items-center gap-1 text-slate-500"><i class="fa-solid fa-warehouse text-[9px]"></i> ${wo.pit}</div>` : ''}
                    ${wo.odo ? `<div class="flex items-center gap-1 text-slate-500 col-span-2"><i class="fa-solid fa-gauge-high text-[9px]"></i> ${wo.odo}</div>` : ''}
                </div>

                <div class="flex items-center justify-between pt-1 border-t border-slate-100">
                    <span class="text-[10px] text-slate-400 font-medium flex items-center gap-1">
                        <i class="fa-regular fa-clock text-[9px]"></i> Masuk: ${wo.time}
                    </span>
                    <div class="flex gap-1">
                        ${COLUMNS.filter(c => c !== wo.status).map(col => `
                            <button onclick="moveWO(${wo.id}, '${col}')" title="Pindah ke ${col}" class="w-5 h-5 rounded text-[8px] font-bold ${COL_COLORS[col].badge} flex items-center justify-center border border-current/20 hover:opacity-80 transition">
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        `).join('')}
                    </div>
                </div>
            `;

            return card;
        }

        // ───────────────────────────────────────────────────────────────
        // DRAG & DROP
        // ───────────────────────────────────────────────────────────────
        function handleDragOver(e) {
            e.preventDefault();
            e.currentTarget.classList.add('drag-over');
        }

        function handleDrop(e, targetStatus) {
            e.preventDefault();
            e.currentTarget.classList.remove('drag-over');
            document.querySelectorAll('.kanban-col').forEach(c => c.classList.remove('drag-over'));

            if (draggingId !== null) {
                moveWO(draggingId, targetStatus);
            }
        }

        document.querySelectorAll('.kanban-col').forEach(col => {
            col.addEventListener('dragleave', () => col.classList.remove('drag-over'));
        });

        // ───────────────────────────────────────────────────────────────
        // HELPERS
        // ───────────────────────────────────────────────────────────────
        function moveWO(id, newStatus) {
            const wo = workOrders.find(w => w.id === id);
            if (wo) { wo.status = newStatus; renderBoard(); }
        }

        function deleteWO(id) {
            workOrders = workOrders.filter(w => w.id !== id);
            renderBoard();
        }

        function updateStats() {
            const total = workOrders.length;
            const badge = document.getElementById('total-wo-badge');
            badge.innerHTML = `<span class="w-1.5 h-1.5 rounded-full bg-garage-500"></span> ${total} Aktif`;
        }

        function updateSidebar() {
            const active = workOrders.filter(w => w.status !== 'selesai').length;
            const total = Math.max(workOrders.length, 1);
            document.getElementById('sidebar-wo-count').textContent = `${active} Aktif`;
            document.getElementById('sidebar-wo-bar').style.width = `${Math.round((active / total) * 100)}%`;

            // Mekanik status
            const mekanikStatuses = document.querySelectorAll('.mekanik-status');
            const mekanikCounts = document.querySelectorAll('.mekanik-wo-count');
            const mekanikBars = document.querySelectorAll('.mekanik-wo-bar');
            const mekanikNames = ['Agus Widodo', 'Budi Santoso', 'Candra Putra', 'Deni Firmansyah'];

            mekanikNames.forEach((name, i) => {
                const count = workOrders.filter(w => w.mekanik === name && w.status !== 'selesai').length;
                mekanikCounts[i].textContent = count;
                mekanikBars[i].style.width = `${Math.min(count * 25, 100)}%`;
                if (count > 0) {
                    mekanikStatuses[i].textContent = 'Bekerja';
                    mekanikStatuses[i].className = 'mekanik-status px-2.5 py-0.5 rounded-full bg-garage-100 text-garage-700 border border-garage-200 text-[10px] font-bold';
                } else {
                    mekanikStatuses[i].textContent = 'Standby';
                    mekanikStatuses[i].className = 'mekanik-status px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200 text-[10px] font-bold';
                }
            });
        }

        function updateBoardCTA() {
            const cta = document.getElementById('board-empty-cta');
            cta.style.display = workOrders.length === 0 ? '' : 'none';
        }

        // ───────────────────────────────────────────────────────────────
        // DEMO DATA
        // ───────────────────────────────────────────────────────────────
        function loadDemoWO() {
            workOrders = [
                {
                    id: 101, no: '#LG-{{ date('Y') }}-0101',
                    nama: 'Pak Rahmat Hidayat', hp: '0812-9843-2210',
                    model: 'Toyota Innova Reborn 2.4 Diesel', plat: 'B 2314 TZZ',
                    odo: '58.400 KM', mekanik: 'Agus Widodo', pit: 'Bay #01',
                    keluhan: 'Servis berkala 60.000 KM, ganti oli full synthetic, cek seluruh sistem rem',
                    status: 'pengerjaan', priority: 'normal', time: '08:15', progress: 65
                },
                {
                    id: 102, no: '#LG-{{ date('Y') }}-0102',
                    nama: 'Pak Hendra Setiawan', hp: '0811-9234-8819',
                    model: 'Mitsubishi Pajero Sport Dakar', plat: 'B 8899 DKR',
                    odo: '41.200 KM', mekanik: 'Budi Santoso', pit: 'Bay #02',
                    keluhan: 'Ganti oli mesin & filter, spooring 3D dan balancing 4 roda',
                    status: 'pemeriksaan', priority: 'rush', time: '09:00', progress: 20
                },
                {
                    id: 103, no: '#LG-{{ date('Y') }}-0103',
                    nama: 'Ibu Cindy Patricia', hp: '0878-5521-4320',
                    model: 'Honda CR-V 1.5L Turbo', plat: 'B 2041 RFS',
                    odo: '32.150 KM', mekanik: 'Candra Putra', pit: 'Bay #03',
                    keluhan: 'Bunyi aneh di area suspensi depan saat melewati jalan bergelombang',
                    status: 'menunggu', priority: 'urgent', time: '09:45', progress: 0
                },
                {
                    id: 104, no: '#LG-{{ date('Y') }}-0104',
                    nama: 'Pak Dony Kusuma', hp: '0856-3321-9901',
                    model: 'Suzuki Ertiga GX', plat: 'D 4411 SKZ',
                    odo: '25.000 KM', mekanik: 'Deni Firmansyah', pit: 'Bay #04',
                    keluhan: 'Tune up berkala 25.000 KM, cuci mesin & AC',
                    status: 'selesai', priority: 'normal', time: '07:30', progress: 100
                },
            ];
            woCounter = 105;
            renderBoard();
        }

        function clearAllWO() {
            if (workOrders.length === 0) return;
            if (confirm('Yakin ingin menghapus semua work order aktif?')) {
                workOrders = [];
                woCounter = 1;
                renderBoard();
            }
        }

        // ───────────────────────────────────────────────────────────────
        // INIT
        // ───────────────────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', () => {
            renderBoard();
        });
    </script>

</body>
</html>
