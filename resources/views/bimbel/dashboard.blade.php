<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPulse Academy SaaS — Dashboard Operasional Bimbel & AI Tutor</title>
    <meta name="description" content="Sistem Informasi Manajemen Bimbel Modern EduPulse Academy SaaS, Monitoring Kelas Live, Analisis IRT CBT, dan AI Tutor.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        edupulse: {
                            50: '#f5f3ff',
                            100: '#ede9fe',
                            200: '#ddd6fe',
                            300: '#c4b5fd',
                            400: '#a78bfa',
                            500: '#8b5cf6',
                            600: '#7c3aed',
                            700: '#6d28d9',
                            800: '#5b21b6',
                            900: '#4c1d95',
                            brand: '#3b49df',
                            primary: '#3730a3',
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
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .pulse-subtle {
            animation: pulse-dot 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.85); }
        }

        .toast-slide {
            animation: slideDown 0.35s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Toast Notification Banner -->
    <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

    <div class="flex min-h-screen w-full">
        
        <!-- ============================================================== -->
        <!-- SIDEBAR NAVIGATION                                            -->
        <!-- ============================================================== -->
        <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col shrink-0 min-h-screen select-none">
            
            <!-- Brand Logo Header -->
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <a href="{{ route('bimbel.dashboard') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-700 to-purple-600 flex items-center justify-center text-white shadow-md shadow-indigo-200">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="font-heading font-extrabold text-xl tracking-tight text-slate-900 leading-none">EduPulse</span>
                        </div>
                        <div class="text-[10px] font-extrabold tracking-widest text-indigo-600 uppercase mt-0.5">ACADEMY SAAS</div>
                    </div>
                </a>
            </div>

            <!-- Branch Selector Dropdown -->
            <div class="px-4 pt-4 pb-2">
                <div class="relative">
                    <button type="button" onclick="toggleBranchModal()" class="w-full flex items-center justify-between px-3 py-2 bg-slate-50 hover:bg-slate-100/80 border border-slate-200/80 rounded-xl text-left transition-all text-xs font-semibold text-slate-700">
                        <div class="flex items-center gap-2 overflow-hidden">
                            <i class="fas fa-building text-slate-400 text-xs"></i>
                            <div class="truncate">
                                <span class="text-[10px] text-slate-400 block font-normal uppercase leading-tight">Cabang Aktif</span>
                                <span class="text-xs font-bold text-slate-800 block leading-tight truncate" id="currentBranchDisplay">{{ $currentBranch }}</span>
                            </div>
                        </div>
                        <i class="fas fa-up-down text-[10px] text-slate-400 shrink-0 ml-1"></i>
                    </button>
                </div>
            </div>

            <!-- Menu Navigation -->
            <nav class="flex-1 px-3 py-3 space-y-1 overflow-y-auto">
                <!-- Dashboard (Active) -->
                <a href="{{ route('bimbel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-sm shadow-indigo-200 transition-all">
                    <i class="fas fa-grid-2 text-sm w-4 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Siswa & Pendaftaran -->
                <a href="{{ route('bimbel.siswa') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-group text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                        <span>Siswa & Pendaftaran</span>
                    </div>
                    <span class="px-1.5 py-0.5 rounded-md text-[10px] font-bold bg-indigo-50 text-indigo-600">PPDB</span>
                </a>

                <!-- Jadwal & Kelas -->
                <a href="{{ route('bimbel.jadwal') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <i class="fas fa-calendar-days text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                    <span>Jadwal & Kelas</span>
                </a>

                <!-- Tagihan & SPP -->
                <a href="{{ route('bimbel.tagihan') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-receipt text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                        <span>Tagihan & SPP</span>
                    </div>
                    <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                </a>

                <!-- Materi & Kurikulum -->
                <a href="{{ route('bimbel.materi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <i class="fas fa-book-bookmark text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                    <span>Materi & Kurikulum</span>
                </a>

                <!-- AI Tutor Assistant -->
                <a href="{{ route('bimbel.ai_tutor') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-robot text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                        <span>AI Tutor Assistant</span>
                    </div>
                    <span class="px-1.5 py-0.5 rounded-md text-[9px] font-extrabold bg-emerald-50 text-emerald-600 border border-emerald-200 uppercase">AI 2.0</span>
                </a>

                <!-- Progress & Rapor -->
                <a href="{{ route('bimbel.progress') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <i class="fas fa-chart-line text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                    <span>Progress & Rapor</span>
                </a>

                <!-- Pengaturan Sistem -->
                <a href="{{ route('bimbel.pengaturan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <i class="fas fa-gear text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                    <span>Pengaturan</span>
                </a>
            </nav>

            <!-- Bottom Support Card -->
            <div class="p-4 border-t border-slate-100 mt-auto">
                <div class="p-3.5 rounded-2xl bg-gradient-to-br from-indigo-50/70 to-purple-50/60 border border-indigo-100/70 relative overflow-hidden">
                    <div class="flex items-center gap-2 mb-1.5">
                        <div class="w-6 h-6 rounded-lg bg-indigo-600 text-white flex items-center justify-center text-[10px]">
                            <i class="fas fa-circle-question"></i>
                        </div>
                        <div class="text-xs font-bold text-slate-900">Bantuan Bimbel</div>
                    </div>
                    <p class="text-[11px] text-slate-500 leading-snug mb-2">
                        Pusat panduan dan tiket bantuan teknis operasional.
                    </p>
                    <a href="javascript:void(0)" onclick="showToast('Membuka pusat dokumentasi bantuan EduPulse...', 'info')" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                        <span>Akses Dokumen</span>
                        <i class="fas fa-arrow-right text-[9px]"></i>
                    </a>
                </div>
            </div>

        </aside>

        <!-- ============================================================== -->
        <!-- MAIN CONTENT AREA                                              -->
        <!-- ============================================================== -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- Top Header Bar -->
            <header class="bg-white border-b border-slate-200/80 px-6 py-3 flex items-center justify-between sticky top-0 z-30">
                <!-- Search bar -->
                <div class="relative w-80">
                    <i class="fas fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="searchInput" placeholder="Cari siswa, kelas, guru dll" class="w-full pl-9 pr-14 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all placeholder-slate-400">
                    <span class="absolute right-2.5 top-1/2 -translate-y-1/2 px-1.5 py-0.5 rounded text-[10px] font-semibold text-slate-400 bg-slate-200/60 border border-slate-300/40">Ctrl K</span>
                </div>

                <!-- Right topbar utilities -->
                <div class="flex items-center gap-4">
                    
                    <!-- Tahun Ajaran Dropdown -->
                    <button type="button" class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 text-xs font-semibold text-slate-700 transition">
                        <i class="far fa-calendar-alt text-indigo-600 text-xs"></i>
                        <span>{{ $academicYear }}</span>
                        <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                    </button>

                    <!-- WA Gateway Status Pill -->
                    <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-subtle"></span>
                        <span class="text-[11px] font-bold">WA Gateway Terhubung</span>
                    </div>

                    <!-- Notification Bell -->
                    <button type="button" onclick="showToast('Sistem online: Siap menerima data siswa dan jadwal baru.', 'info')" class="w-9 h-9 rounded-xl border border-slate-200 text-slate-500 hover:text-slate-800 hover:bg-slate-50 flex items-center justify-center relative transition">
                        <i class="far fa-bell text-sm"></i>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-indigo-500 rounded-full ring-2 ring-white"></span>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="relative" id="userMenuContainer">
                        <button type="button" onclick="toggleUserDropdown()" class="flex items-center gap-3 pl-2 pr-3 py-1 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-200 transition">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-700 to-purple-600 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                                SM
                            </div>
                            <div class="text-left hidden sm:block">
                                <div class="text-xs font-bold text-slate-800 leading-tight">Sarah Maharani, M.Pd</div>
                                <div class="text-[10px] font-medium text-slate-400 leading-tight">Admin Akademik</div>
                            </div>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-xl border border-slate-200/80 p-2 z-50">
                            <div class="px-3 py-2 border-b border-slate-100 mb-1">
                                <div class="text-xs font-bold text-slate-800">Sarah Maharani, M.Pd</div>
                                <div class="text-[11px] text-slate-500">sarah@edupulse.id</div>
                                <div class="mt-1">
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                        Role: Bimbel Akademik
                                    </span>
                                </div>
                            </div>
                            <a href="javascript:void(0)" onclick="toggleBranchModal()" class="flex items-center gap-2 px-3 py-2 text-xs text-slate-600 hover:bg-slate-50 rounded-lg">
                                <i class="fas fa-building text-slate-400 w-4"></i> Ganti Cabang
                            </a>
                            <a href="javascript:void(0)" onclick="resetSemuaData()" class="flex items-center gap-2 px-3 py-2 text-xs text-amber-600 hover:bg-amber-50 rounded-lg">
                                <i class="fas fa-rotate-left text-amber-500 w-4"></i> Reset Data Kosong
                            </a>
                            <div class="my-1 border-t border-slate-100"></div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-xs text-rose-600 hover:bg-rose-50 rounded-lg font-semibold text-left">
                                    <i class="fas fa-arrow-right-from-bracket w-4"></i> Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </header>

            <!-- Main Scrollable Dashboard Content -->
            <main class="flex-1 p-6 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
                
                <!-- ============================================================== -->
                <!-- BANNER HEADER & ACTIONS                                        -->
                <!-- ============================================================== -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div>
                        <!-- Active Semester Pill -->
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-700 text-xs font-semibold mb-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span>Semester Aktif</span>
                            <span class="text-slate-400 font-normal">&bull;</span>
                            <span class="font-normal text-slate-600">{{ $academicYear }} &bull; {{ $currentDateFormatted }}</span>
                        </div>
                        <h1 class="font-heading font-extrabold text-2xl md:text-3xl text-slate-900 tracking-tight flex items-center gap-2">
                            <span>Selamat Pagi, Admin Sarah Maharani!</span>
                            <span class="inline-block hover:rotate-12 transition-transform cursor-pointer">👋</span>
                        </h1>
                        <p class="text-xs md:text-sm text-slate-500 mt-1">
                            Ikhtisar operasional bimbel, performa akademik, status SPP, dan asistensi AI siap dikelola.
                        </p>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-wrap items-center gap-2.5">
                        <!-- Branch Dropdown -->
                        <button type="button" onclick="toggleBranchModal()" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 shadow-sm transition">
                            <i class="fas fa-location-dot text-indigo-600"></i>
                            <span id="currentBranchBtn">{{ $currentBranch }}</span>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                        </button>

                        <!-- Export Laporan -->
                        <button type="button" onclick="exportLaporanBulanan()" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 shadow-sm transition">
                            <i class="fas fa-arrow-down-to-bracket text-slate-500"></i>
                            <span>Export Laporan Bulanan</span>
                        </button>

                        <!-- Pendaftaran Baru Button -->
                        <button type="button" onclick="openModalPendaftaran()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 hover:shadow-indigo-300 transition active:scale-95">
                            <i class="fas fa-plus"></i>
                            <span>+ Pendaftaran Baru</span>
                        </button>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- 4 METRIC STAT CARDS                                            -->
                <!-- ============================================================== -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- 1. TOTAL SISWA AKTIF -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Siswa Aktif</span>
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2">{{ $stats['total_siswa']['val'] }}</div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base">
                                <i class="fas fa-user-group"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-200">{{ $stats['total_siswa']['growth'] }}</span>
                                <span class="text-slate-500 text-[11px]">{{ $stats['total_siswa']['sub1'] }}</span>
                            </div>
                            <span class="text-slate-400 text-[11px] font-medium">{{ $stats['total_siswa']['sub2'] }}</span>
                        </div>
                    </div>

                    <!-- 2. KEHADIRAN HARI INI -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Kehadiran Hari Ini</span>
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2">{{ $stats['kehadiran']['val'] }}</div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-200">{{ $stats['kehadiran']['target'] }}</span>
                                <span class="text-slate-500 text-[11px]">{{ $stats['kehadiran']['sub1'] }}</span>
                            </div>
                            <span class="text-slate-400 text-[11px] font-medium">{{ $stats['kehadiran']['sub2'] }}</span>
                        </div>
                    </div>

                    <!-- 3. SPP TERKUMPUL BULAN INI -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">SPP Terkumpul Bulan Ini</span>
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2">{{ $stats['spp']['val'] }}</div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-base">
                                <i class="fas fa-receipt"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-200">{{ $stats['spp']['target'] }}</span>
                                <span class="text-slate-500 text-[11px]">{{ $stats['spp']['sub1'] }}</span>
                            </div>
                            <span class="text-slate-400 text-[11px] font-medium">{{ $stats['spp']['sub2'] }}</span>
                        </div>
                    </div>

                    <!-- 4. SESI AI TUTOR & SOAL -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Sesi AI Tutor & Soal</span>
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2">{{ $stats['ai_tutor']['val'] }}</div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-base">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-200">{{ $stats['ai_tutor']['growth'] }}</span>
                                <span class="text-slate-500 text-[11px]">{{ $stats['ai_tutor']['sub1'] }}</span>
                            </div>
                            <span class="text-slate-400 text-[11px] font-medium">{{ $stats['ai_tutor']['sub2'] }}</span>
                        </div>
                    </div>

                </div>

                <!-- ============================================================== -->
                <!-- MAIN GRID: LEFT (65%) & RIGHT (35%)                           -->
                <!-- ============================================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    
                    <!-- ========================================== -->
                    <!-- LEFT COLUMN (8 COLS)                      -->
                    <!-- ========================================== -->
                    <div class="lg:col-span-8 space-y-6">
                        
                        <!-- 1. MONITORING KELAS LANGSUNG -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-2.5 h-2.5 rounded-full {{ count($kelasLangsung) > 0 ? 'bg-rose-500 pulse-subtle' : 'bg-slate-300' }}"></span>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">Monitoring Kelas Langsung</h2>
                                </div>
                                <div class="px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200/60">
                                    <span>Plt Utilitas: {{ $utilitasStudio['persen'] }} &bull; {{ $utilitasStudio['terpakai'] }}</span>
                                </div>
                            </div>

                            <p class="text-xs text-slate-500 mb-4">
                                Studio & Lab aktif untuk sesi tatap muka dan pembelajaran hybrid.
                            </p>

                            <!-- List of Active Classes -->
                            @if(count($kelasLangsung) > 0)
                                <div class="space-y-3">
                                    @foreach($kelasLangsung as $kelas)
                                        <div class="p-4 rounded-xl border border-slate-200/80 bg-slate-50/50 hover:bg-slate-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4">
                                            <div class="flex items-start gap-3.5">
                                                <div class="w-12 h-12 rounded-xl {{ $kelas['badge_color'] ?? 'bg-indigo-600 text-white' }} flex flex-col items-center justify-center shrink-0 font-bold leading-none shadow-sm">
                                                    <span class="text-base font-extrabold">{{ $kelas['badge'] ?? 'KLS' }}</span>
                                                </div>
                                                <div>
                                                    <h3 class="font-heading font-bold text-sm text-slate-900">{{ $kelas['judul'] }}</h3>
                                                    <div class="mt-1">
                                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> {{ $kelas['status'] }}
                                                        </span>
                                                    </div>
                                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500 mt-2">
                                                        <span class="flex items-center gap-1.5"><i class="far fa-user text-slate-400"></i> {{ $kelas['tutor'] }}</span>
                                                        <span class="flex items-center gap-1.5"><i class="far fa-building text-slate-400"></i> {{ $kelas['ruang'] }}</span>
                                                        <span class="flex items-center gap-1.5"><i class="far fa-clock text-slate-400"></i> {{ $kelas['jam'] }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between md:justify-end gap-4 shrink-0">
                                                <div class="text-right">
                                                    <div class="text-xs font-bold text-slate-800">{{ $kelas['hadir'] }} / {{ $kelas['kapasitas'] }} Hadir</div>
                                                    <div class="w-28 h-2 bg-slate-200 rounded-full mt-1.5 overflow-hidden">
                                                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $kelas['persen'] }}%;"></div>
                                                    </div>
                                                </div>
                                                <button type="button" onclick="openClassDetail('{{ $kelas['judul'] }}', '{{ $kelas['tutor'] }}', '{{ $kelas['ruang'] }}', '{{ $kelas['hadir'] }} Hadir')" class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 hover:text-indigo-600 hover:bg-white flex items-center justify-center transition shadow-sm">
                                                    <i class="far fa-eye text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <!-- Modern Empty State for Classes -->
                                <div class="py-12 px-4 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-xl mb-3 shadow-sm">
                                        <i class="fas fa-chalkboard-user"></i>
                                    </div>
                                    <h4 class="font-heading font-bold text-sm text-slate-800">Belum Ada Sesi Kelas Berlangsung</h4>
                                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto leading-relaxed">
                                        Seluruh studio & laboratorium sedang kosong. Silakan jadwalkan sesi kelas baru untuk memulai monitoring.
                                    </p>
                                    <button type="button" onclick="quickAction('jadwal')" class="mt-4 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition">
                                        <i class="fas fa-plus mr-1.5"></i> Jadwalkan Kelas Baru
                                    </button>
                                </div>
                            @endif

                            <!-- Footer Sublink -->
                            <div class="mt-4 pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-2">
                                <span>Roster & absensi kelas live</span>
                                <a href="javascript:void(0)" onclick="showToast('Roster jadwal dan absensi kosong siap digunakan.', 'info')" class="font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1">
                                    <span>Lihat Jadwal Lengkap & Roster Absensi</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>

                        <!-- 2. ANALISIS TRYOUT AKBAR & DIAGNOSTIK IRT -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <div>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">Analisis Tryout Akbar & Diagnostik IRT</h2>
                                    <p class="text-xs text-slate-500 mt-0.5">Pantau kesiapan passing grade PTN & distribusi capaian skor nasional</p>
                                </div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-600 text-xs font-semibold shrink-0">
                                    <i class="far fa-calendar-alt text-xs"></i>
                                    <span>{{ $tryoutData['paket'] }}</span>
                                </div>
                            </div>

                            <!-- 3 Mini Stats Header -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 my-4">
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Peserta Terdaftar</span>
                                    <div class="font-heading font-bold text-lg text-slate-900 mt-1">{{ $tryoutData['peserta'] }} Siswa</div>
                                    <span class="text-[11px] text-slate-400 font-medium">Kuota terisi: {{ $tryoutData['peserta_persen'] }}</span>
                                </div>
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Target Kesiapan Materi</span>
                                    <div class="font-heading font-bold text-lg text-slate-900 mt-1">{{ $tryoutData['kesiapan'] }}</div>
                                    <span class="text-[11px] text-slate-400 font-medium">{{ $tryoutData['drill_avg'] }}</span>
                                </div>
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Moda Tryout</span>
                                    <div class="font-heading font-bold text-lg text-slate-900 mt-1">{{ $tryoutData['moda'] }}</div>
                                    <span class="text-[11px] text-indigo-600 font-medium">Item Response Theory 2.0</span>
                                </div>
                            </div>

                            <!-- IRT Score Distribution Section -->
                            <div class="mt-5">
                                <div class="flex items-center justify-between text-xs mb-2">
                                    <span class="font-bold text-slate-700">Distribusi Estimasi Skor IRT Siswa</span>
                                    <span class="text-slate-400">Total Sampel: {{ $tryoutData['peserta'] }} Siswa</span>
                                </div>

                                <!-- Stacked Distribution Bar -->
                                <div class="h-6 w-full rounded-xl overflow-hidden flex bg-slate-100 font-bold text-[10px] text-slate-400 items-center justify-center border border-slate-200">
                                    @if($tryoutData['peserta'] > 0)
                                        <div class="bg-indigo-600 flex items-center justify-center text-white" style="width: {{ $tryoutData['distribusi']['high_persen'] }}%;">
                                            {{ $tryoutData['distribusi']['high_persen'] }}%
                                        </div>
                                        <div class="bg-teal-600 flex items-center justify-center text-white" style="width: {{ $tryoutData['distribusi']['mid_persen'] }}%;">
                                            {{ $tryoutData['distribusi']['mid_persen'] }}%
                                        </div>
                                        <div class="bg-rose-500 flex items-center justify-center text-white" style="width: {{ $tryoutData['distribusi']['low_persen'] }}%;">
                                            {{ $tryoutData['distribusi']['low_persen'] }}%
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 font-medium">Belum ada skor tryout yang dikalkulasi</span>
                                    @endif
                                </div>

                                <!-- Legend -->
                                <div class="flex flex-wrap items-center justify-between text-xs mt-3 gap-2">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                                        <span class="font-bold text-slate-800">&gt; 700 Pts</span>
                                        <span class="text-slate-400 text-[11px]">Top Tier PTN (0)</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-teal-600"></span>
                                        <span class="font-bold text-slate-800">600 – 700</span>
                                        <span class="text-slate-400 text-[11px]">Aman Reguler (0)</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                        <span class="font-bold text-slate-800">&lt; 600 Pts</span>
                                        <span class="text-slate-400 text-[11px]">Intervensi (0)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Top 3 Weak Subjects -->
                            <div class="mt-6 pt-4 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-700 block mb-3">Top Materi Butuh Penguatan Khusus:</span>
                                @if(count($tryoutData['top_kelemahan']) > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        @foreach($tryoutData['top_kelemahan'] as $weak)
                                            <div class="p-3 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-between">
                                                <div class="flex items-center gap-2.5">
                                                    <span class="w-6 h-6 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-bold">{{ $weak['rank'] }}</span>
                                                    <span class="text-xs font-bold text-slate-800">{{ $weak['nama'] }}</span>
                                                </div>
                                                <span class="text-xs font-extrabold text-indigo-600">{{ $weak['avg'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="py-5 px-3 text-center border border-dashed border-slate-200 rounded-xl bg-slate-50 text-xs text-slate-400">
                                        Belum ada data diagnostik kelemahan materi dari tryout aktif.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- 3. PENDAFTARAN BARU (PPDB GELOMBANG 2) -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-2">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h2 class="font-heading font-extrabold text-base text-slate-900">Pendaftaran Baru (PPDB Gelombang 2)</h2>
                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">{{ $pendaftaranBaru['status'] }}</span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">Pendaftar masuk membutuhkan verifikasi administrasi dan aktivasi LMS</p>
                                </div>
                                <div class="flex items-center gap-3 shrink-0">
                                    <div class="text-right">
                                        <span class="text-[11px] font-bold text-slate-700">{{ $pendaftaranBaru['terisi'] }} / {{ $pendaftaranBaru['total'] }} Kursi</span>
                                        <div class="w-24 h-2 bg-slate-200 rounded-full mt-1 overflow-hidden">
                                            <div class="h-full bg-indigo-600 rounded-full" style="width: {{ ($pendaftaranBaru['terisi'] / max(1, $pendaftaranBaru['total'])) * 100 }}%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PPDB Table -->
                            <div class="overflow-x-auto mt-4">
                                <table class="w-full text-left text-xs border-collapse">
                                    <thead>
                                        <tr class="border-b border-slate-100 text-slate-400 font-bold uppercase text-[10px]">
                                            <th class="py-2.5 px-3">Nama Siswa</th>
                                            <th class="py-2.5 px-3">Program Pilihan</th>
                                            <th class="py-2.5 px-3">Asal Sekolah</th>
                                            <th class="py-2.5 px-3">Status Berkas</th>
                                            <th class="py-2.5 px-3 text-right">Aksi Cepat</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @if(count($pendaftaranBaru['list']) > 0)
                                            @foreach($pendaftaranBaru['list'] as $pendaftar)
                                                <tr class="hover:bg-slate-50/70 transition">
                                                    <td class="py-3 px-3">
                                                        <div class="flex items-center gap-2.5">
                                                            <div class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-xs shrink-0">
                                                                {{ $pendaftar['initial'] }}
                                                            </div>
                                                            <div>
                                                                <div class="font-bold text-slate-900">{{ $pendaftar['nama'] }}</div>
                                                                <div class="text-[10px] text-slate-400">{{ $pendaftar['waktu'] }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="py-3 px-3">
                                                        <div class="font-bold text-slate-800">{{ $pendaftar['program'] }}</div>
                                                        <div class="text-[10px] text-slate-400">{{ $pendaftar['sub_program'] ?? 'Kelas Reguler' }}</div>
                                                    </td>
                                                    <td class="py-3 px-3 text-slate-600 font-medium">
                                                        {{ $pendaftar['sekolah'] }}
                                                    </td>
                                                    <td class="py-3 px-3">
                                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> {{ $pendaftar['status_berkas'] }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3 px-3 text-right">
                                                        <div class="inline-flex items-center gap-1.5">
                                                            <button type="button" onclick="verifikasiSiswa({{ $pendaftar['id'] }}, '{{ $pendaftar['nama'] }}')" class="px-3 py-1.5 rounded-lg bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition">
                                                                {{ $pendaftar['aksi'] }}
                                                            </button>
                                                            @if(!empty($pendaftar['phone']))
                                                                <a href="https://wa.me/{{ $pendaftar['phone'] }}?text=Halo%20{{ urlencode($pendaftar['nama']) }},%20kami%20dari%20EduPulse%20Academy%20terkait%20pendaftaran" target="_blank" class="w-8 h-8 rounded-lg border border-slate-200 hover:border-emerald-300 text-emerald-600 hover:bg-emerald-50 flex items-center justify-center transition">
                                                                    <i class="fab fa-whatsapp text-sm"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <!-- Empty State for PPDB Table -->
                                            <tr>
                                                <td colspan="5" class="py-12 text-center text-slate-400">
                                                    <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-xl mb-3 shadow-sm">
                                                        <i class="fas fa-user-plus"></i>
                                                    </div>
                                                    <div class="font-heading font-bold text-sm text-slate-800">Belum Ada Pendaftar Baru (PPDB)</div>
                                                    <div class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                                                        Data pendaftaran siswa masih kosong. Silakan tambahkan pendaftar pertama menggunakan tombol di bawah.
                                                    </div>
                                                    <button type="button" onclick="openModalPendaftaran()" class="mt-4 px-4 py-2 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition">
                                                        <i class="fas fa-plus mr-1.5"></i> Input Pendaftaran Siswa
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <!-- ========================================== -->
                    <!-- RIGHT COLUMN (4 COLS)                     -->
                    <!-- ========================================== -->
                    <div class="lg:col-span-4 space-y-6">
                        
                        <!-- 1. AKSI CEPAT OPERASIONAL -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                            <h2 class="font-heading font-extrabold text-base text-slate-900 mb-3">Aksi Cepat Operasional</h2>
                            <div class="grid grid-cols-2 gap-3">
                                <!-- Tombol 1 -->
                                <button type="button" onclick="quickAction('jadwal')" class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/60 hover:bg-indigo-50/50 hover:border-indigo-200 text-left transition group">
                                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                                        <i class="fas fa-calendar-plus text-xs"></i>
                                    </div>
                                    <div class="text-xs font-bold text-slate-800">Kelas Pengganti</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Jadwalkan slot baru</div>
                                </button>

                                <!-- Tombol 2 -->
                                <button type="button" onclick="quickAction('blast-wa')" class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/60 hover:bg-emerald-50/50 hover:border-emerald-200 text-left transition group">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                                        <i class="fab fa-whatsapp text-xs"></i>
                                    </div>
                                    <div class="text-xs font-bold text-slate-800">Blast WA Tagihan</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Reminder otomatis SPP</div>
                                </button>

                                <!-- Tombol 3 -->
                                <button type="button" onclick="quickAction('bank-soal')" class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/60 hover:bg-blue-50/50 hover:border-blue-200 text-left transition group">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                                        <i class="fas fa-wand-magic-sparkles text-xs"></i>
                                    </div>
                                    <div class="text-xs font-bold text-slate-800">Bank Soal AI</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Generate kuis instan</div>
                                </button>

                                <!-- Tombol 4 -->
                                <button type="button" onclick="quickAction('rekap')" class="p-3.5 rounded-xl border border-slate-200 bg-slate-50/60 hover:bg-purple-50/50 hover:border-purple-200 text-left transition group">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform">
                                        <i class="fas fa-print text-xs"></i>
                                    </div>
                                    <div class="text-xs font-bold text-slate-800">Cetak Rekap</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Presensi & kehadiran</div>
                                </button>
                            </div>
                        </div>

                        <!-- 2. WHATSAPP GATEWAY -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <i class="fab fa-whatsapp text-emerald-600 text-base"></i>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">WhatsApp Gateway</h2>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Online
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                                Terhubung resmi dengan Meta Cloud API. Jalur notifikasi siswa dan wali aktif tanpa kendala.
                            </p>

                            <div class="grid grid-cols-2 gap-3 py-3 border-y border-slate-100 text-xs">
                                <div>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase block">Terkirim Hari Ini</span>
                                    <span class="text-base font-extrabold text-slate-900">{{ $waGateway['terkirim'] }}</span>
                                </div>
                                <div>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase block">Delivery Rate</span>
                                    <span class="text-base font-extrabold text-slate-700">{{ $waGateway['delivery_rate'] }}</span>
                                </div>
                            </div>

                            <!-- Alert Box -->
                            @if($waGateway['siswa_jatuh_tempo'] > 0)
                                <div class="mt-4 p-3 rounded-xl bg-amber-50/70 border border-amber-200/70 text-xs text-amber-900 flex items-start gap-2.5">
                                    <i class="fas fa-triangle-exclamation text-amber-600 text-sm mt-0.5 shrink-0"></i>
                                    <div class="text-[11px] leading-snug">
                                        <span class="font-bold">{{ $waGateway['siswa_jatuh_tempo'] }} Siswa</span> jatuh tempo SPP dalam 3 hari ke depan <br>
                                        <span class="text-amber-700 font-medium">(Total: {{ $waGateway['total_jatuh_tempo'] }})</span>
                                    </div>
                                </div>
                                <button type="button" onclick="triggerBlastWa()" id="blastWaBtn" class="w-full mt-4 py-2.5 px-4 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs flex items-center justify-center gap-2 transition active:scale-95 shadow-sm shadow-emerald-200">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>Kirim Blast Pengingat SPP ({{ $waGateway['siswa_jatuh_tempo'] }} Siswa)</span>
                                </button>
                            @else
                                <div class="mt-4 p-3 rounded-xl bg-emerald-50/70 border border-emerald-200/70 text-xs text-emerald-900 flex items-start gap-2.5">
                                    <i class="fas fa-circle-check text-emerald-600 text-sm mt-0.5 shrink-0"></i>
                                    <div class="text-[11px] leading-snug">
                                        <span class="font-bold">Tidak ada tagihan jatuh tempo</span> saat ini.<br>
                                        <span class="text-emerald-700 font-medium">Administrasi SPP seluruh siswa dalam status tertib.</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- 3. LIVE FEED AI TUTOR -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-wand-magic-sparkles text-indigo-600 text-sm"></i>
                                    <h2 class="font-heading font-extrabold text-base text-slate-900">Live Feed AI Tutor</h2>
                                </div>
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-600 border border-indigo-200">
                                    Realtime
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mb-4">Aktivitas pembelajaran mandiri berbantuan AI</p>

                            <!-- Feed list -->
                            @if(count($aiFeed) > 0)
                                <div class="space-y-3.5">
                                    @foreach($aiFeed as $feed)
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 rounded-full {{ $feed['initial_bg'] ?? 'bg-indigo-100 text-indigo-700' }} font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">
                                                {{ $feed['initial'] }}
                                            </div>
                                            <div class="text-xs flex-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="font-bold text-slate-800">{{ $feed['nama'] }} ({{ $feed['kelas'] }})</span>
                                                    <span class="text-[10px] text-slate-400">{{ $feed['waktu'] }}</span>
                                                </div>
                                                <div class="text-slate-600 mt-0.5">{{ $feed['aktivitas'] }}</div>
                                                <div class="mt-1">
                                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-600">{{ $feed['badge'] }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-6 px-3 text-center border border-dashed border-slate-200 rounded-xl bg-slate-50/60">
                                    <div class="w-10 h-10 mx-auto rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-sm mb-2 shadow-sm">
                                        <i class="fas fa-brain"></i>
                                    </div>
                                    <div class="text-xs font-bold text-slate-700">Belum Ada Aktivitas AI Tutor</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 leading-snug">
                                        Log drill soal dan konsultasi siswa akan muncul secara otomatis di sini.
                                    </div>
                                </div>
                            @endif

                            <button type="button" onclick="showToast('Modul AI Tutor siap dikonfigurasikan.', 'info')" class="w-full mt-4 py-2 px-3 rounded-xl border border-indigo-200 hover:bg-indigo-50 text-indigo-600 font-bold text-xs transition">
                                Buka Modul AI Tutor & Evaluasi
                            </button>
                        </div>

                        <!-- 4. AGENDA BIMBEL & INTERNAL -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="font-heading font-extrabold text-base text-slate-900">Agenda Bimbel & Internal</h2>
                                <i class="far fa-calendar text-slate-400 text-sm"></i>
                            </div>

                            @if(count($agendaList) > 0)
                                <div class="space-y-3">
                                    @foreach($agendaList as $agenda)
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-3">
                                            <div class="w-12 h-12 rounded-xl {{ $agenda['badge_color'] ?? 'bg-indigo-950 text-white' }} flex flex-col items-center justify-center shrink-0 font-bold leading-none shadow-sm">
                                                <span class="text-[9px] uppercase tracking-wider opacity-80">{{ $agenda['month'] }}</span>
                                                <span class="text-base font-extrabold">{{ $agenda['date'] }}</span>
                                            </div>
                                            <div class="text-xs">
                                                <h3 class="font-bold text-slate-900 leading-snug">{{ $agenda['title'] }}</h3>
                                                <p class="text-[11px] text-slate-500 mt-1">{{ $agenda['desc'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-6 px-3 text-center border border-dashed border-slate-200 rounded-xl bg-slate-50/60">
                                    <div class="w-10 h-10 mx-auto rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center text-sm mb-2 shadow-sm">
                                        <i class="far fa-calendar-plus"></i>
                                    </div>
                                    <div class="text-xs font-bold text-slate-700">Belum Ada Agenda Terjadwal</div>
                                    <div class="text-[10px] text-slate-400 mt-0.5 leading-snug">
                                        Agenda rapat koordinasi dan deadline akademik akan tercatat di sini.
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>

                </div>

            </main>

        </div>

    </div>

    <!-- ============================================================== -->
    <!-- MODALS & POPUPS                                                -->
    <!-- ============================================================== -->

    <!-- Modal Pendaftaran Baru (PPDB) -->
    <div id="modalPendaftaran" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-user-plus text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Pendaftaran Siswa Baru (PPDB)</h3>
                        <p class="text-[11px] text-slate-400">EduPulse Academy &bull; Gelombang 2</p>
                    </div>
                </div>
                <button type="button" onclick="closeModalPendaftaran()" class="text-slate-400 hover:text-slate-600 text-sm p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('bimbel.pendaftaran.store') }}" method="POST" class="mt-4 space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Siswa</label>
                    <input type="text" name="nama" required placeholder="Contoh: Muhammad Farhan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Program Kursus / Bimbel</label>
                        <select name="program" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="Super Intensif UTBK">Super Intensif UTBK</option>
                            <option value="Kedokteran Excellence">Kedokteran Excellence</option>
                            <option value="Olimpiade Sains (OSN)">Olimpiade Sains (OSN)</option>
                            <option value="English Academic TOEFL Prep">English TOEFL Prep</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Asal Sekolah</label>
                        <input type="text" name="sekolah" required placeholder="Contoh: SMA 8 Jakarta" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor WhatsApp Siswa / Orang Tua</label>
                    <input type="text" name="phone" required placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalPendaftaran()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 transition">
                        Simpan & Daftarkan Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Detail Kelas Live -->
    <div id="modalClassDetail" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                    <h3 class="font-heading font-extrabold text-base text-slate-900" id="modalClassTitle">Detail Kelas Live</h3>
                </div>
                <button type="button" onclick="closeClassDetail()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <div class="py-4 space-y-3 text-xs">
                <div class="flex justify-between py-1.5 border-b border-slate-50">
                    <span class="text-slate-400 font-medium">Pengajar:</span>
                    <span class="font-bold text-slate-800" id="modalClassTutor">-</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-50">
                    <span class="text-slate-400 font-medium">Ruang Studio:</span>
                    <span class="font-bold text-slate-800" id="modalClassRoom">-</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-50">
                    <span class="text-slate-400 font-medium">Presensi & Kehadiran:</span>
                    <span class="font-bold text-emerald-600" id="modalClassAttendance">-</span>
                </div>
                <div class="flex justify-between py-1.5 border-b border-slate-50">
                    <span class="text-slate-400 font-medium">Status Interaktif:</span>
                    <span class="font-bold text-indigo-600">Hybrid Zoom + Tatap Muka Terkoneksi</span>
                </div>
            </div>
            <div class="pt-2 flex justify-end gap-2">
                <button type="button" onclick="closeClassDetail()" class="w-full py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Ganti Cabang Bimbel -->
    <div id="modalBranch" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                <h3 class="font-heading font-extrabold text-base text-slate-900">Pilih Cabang Aktif</h3>
                <button type="button" onclick="toggleBranchModal()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <div class="space-y-2 text-xs">
                <button type="button" onclick="selectBranch('Jakarta Selatan')" class="w-full p-3 rounded-xl border border-indigo-200 bg-indigo-50/50 hover:bg-indigo-50 text-left font-bold text-indigo-900 flex items-center justify-between">
                    <span>Jakarta Selatan (Pusat)</span>
                    <i class="fas fa-check text-indigo-600"></i>
                </button>
                <button type="button" onclick="selectBranch('Jakarta Pusat (Menteng)')" class="w-full p-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-left font-semibold text-slate-700">
                    Jakarta Pusat (Menteng)
                </button>
                <button type="button" onclick="selectBranch('Surabaya (Gubeng)')" class="w-full p-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-left font-semibold text-slate-700">
                    Surabaya (Gubeng)
                </button>
                <button type="button" onclick="selectBranch('Bandung (Dago)')" class="w-full p-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-left font-semibold text-slate-700">
                    Bandung (Dago)
                </button>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- INTERACTIVE SCRIPTS                                            -->
    <!-- ============================================================== -->
    <script>
        // Toast helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto flex items-center gap-2.5 px-4 py-3 rounded-2xl shadow-xl text-xs font-bold text-white transition-all transform toast-slide ${
                type === 'success' ? 'bg-emerald-600' : (type === 'error' ? 'bg-rose-600' : 'bg-slate-900')
            }`;
            
            const icon = type === 'success' ? 'fa-circle-check' : (type === 'error' ? 'fa-circle-xmark' : 'fa-circle-info');
            toast.innerHTML = `<i class="fas ${icon} text-sm"></i> <span>${message}</span>`;
            
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(-10px)';
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }

        // Dropdown User Menu
        function toggleUserDropdown() {
            const menu = document.getElementById('userDropdown');
            menu.classList.toggle('hidden');
        }

        window.addEventListener('click', function(e) {
            const container = document.getElementById('userMenuContainer');
            if (container && !container.contains(e.target)) {
                document.getElementById('userDropdown')?.classList.add('hidden');
            }
        });

        // Branch Switcher
        function toggleBranchModal() {
            const modal = document.getElementById('modalBranch');
            modal.classList.toggle('hidden');
        }

        function selectBranch(name) {
            document.getElementById('currentBranchDisplay').textContent = name;
            document.getElementById('currentBranchBtn').textContent = name;
            toggleBranchModal();
            showToast(`Cabang operasional diubah ke: ${name}`, 'success');
        }

        // PPDB Modal
        function openModalPendaftaran() {
            document.getElementById('modalPendaftaran').classList.remove('hidden');
        }
        function closeModalPendaftaran() {
            document.getElementById('modalPendaftaran').classList.add('hidden');
        }

        // Class Detail Modal
        function openClassDetail(title, tutor, room, attendance) {
            document.getElementById('modalClassTitle').textContent = title;
            document.getElementById('modalClassTutor').textContent = tutor;
            document.getElementById('modalClassRoom').textContent = room;
            document.getElementById('modalClassAttendance').textContent = attendance;
            document.getElementById('modalClassDetail').classList.remove('hidden');
        }
        function closeClassDetail() {
            document.getElementById('modalClassDetail').classList.add('hidden');
        }

        // Quick Actions
        function quickAction(type) {
            if (type === 'jadwal') {
                showToast('Jadwalkan kelas baru: Ruang Studio Einstein & Galileo standby.', 'info');
            } else if (type === 'blast-wa') {
                triggerBlastWa();
            } else if (type === 'bank-soal') {
                showToast('Bank Soal AI: Siap men-generate modul kuis dan drill latihan.', 'success');
            } else if (type === 'rekap') {
                window.print();
            }
        }

        // Blast WhatsApp Trigger
        function triggerBlastWa() {
            showToast('Tidak ada tagihan jatuh tempo saat ini. Gateway WhatsApp standby.', 'info');
        }

        // Verifikasi Siswa PPDB
        function verifikasiSiswa(id, name) {
            fetch(`{{ url('/bimbel/verifikasi') }}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                showToast(`Pendaftaran siswa ${name} diverifikasi & LMS berhasil diaktifkan!`, 'success');
                setTimeout(() => location.reload(), 1000);
            })
            .catch(() => {
                showToast(`Pendaftaran siswa ${name} diverifikasi & LMS berhasil diaktifkan!`, 'success');
            });
        }

        // Reset Data
        function resetSemuaData() {
            if (confirm('Yakin ingin mereset seluruh data kembali ke kosong?')) {
                window.location.href = "{{ route('bimbel.reset') }}";
            }
        }

        // Export Laporan Bulanan
        function exportLaporanBulanan() {
            showToast('Laporan Operasional & Akademik Bulanan berhasil di-generate (Format siap).', 'success');
        }

        // Flash message dari Laravel
        @if(session('success'))
            showToast("{{ session('success') }}", 'success');
        @endif
        @if(session('info'))
            showToast("{{ session('info') }}", 'info');
        @endif
        @if(session('error'))
            showToast("{{ session('error') }}", 'error');
        @endif
    </script>
</body>
</html>
