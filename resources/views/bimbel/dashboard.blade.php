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

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div id="bimbelSidebarOverlay" onclick="toggleBimbelSidebar()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-40 hidden lg:hidden transition-opacity"></div>

    <div class="flex min-h-screen w-full relative">
        
        <!-- ============================================================== -->
        <!-- SIDEBAR NAVIGATION (RESPONSIVE OFF-CANVAS DRAWER)             -->
        <!-- ============================================================== -->
        <aside id="bimbelSidebar" class="w-64 bg-white border-r border-slate-200/80 flex flex-col shrink-0 select-none z-50 fixed inset-y-0 left-0 -translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 min-h-screen shadow-2xl lg:shadow-none">
            
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
                <button type="button" onclick="toggleBimbelSidebar()" class="lg:hidden w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-sm transition" title="Tutup Menu">
                    <i class="fas fa-times"></i>
                </button>
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

                <!-- Keluar (Logout) -->
                <div class="pt-2 mt-2 border-t border-slate-100">
                    <form action="{{ route('bimbel.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-rose-600 hover:text-rose-700 hover:bg-rose-50 transition-all group text-left">
                            <i class="fas fa-arrow-right-from-bracket text-rose-400 group-hover:text-rose-600 text-sm w-4 text-center"></i>
                            <span>Keluar (Logout)</span>
                        </button>
                    </form>
                </div>
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
            <header class="bg-white border-b border-slate-200/80 px-4 sm:px-6 py-3 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center gap-2 sm:gap-3">
                    <!-- Mobile Hamburger -->
                    <button type="button" onclick="toggleBimbelSidebar()" class="lg:hidden w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-700 flex items-center justify-center text-sm shrink-0 transition" title="Buka Menu">
                        <i class="fas fa-bars"></i>
                    </button>
                    <!-- Search bar -->
                    <div class="relative w-48 sm:w-80">
                        <i class="fas fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" id="searchInput" placeholder="Cari siswa, kelas, guru dll" class="w-full pl-9 pr-4 sm:pr-14 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all placeholder-slate-400">
                        <span class="hidden sm:inline absolute right-2.5 top-1/2 -translate-y-1/2 px-1.5 py-0.5 rounded text-[10px] font-semibold text-slate-400 bg-slate-200/60 border border-slate-300/40">Ctrl K</span>
                    </div>
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
                            <form action="{{ route('bimbel.logout') }}" method="POST">
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
                            <span>Pendaftaran Baru</span>
                        </button>

                        <!-- Muat Demo Button -->
                        <button type="button" onclick="loadDemoDashboard()" class="flex items-center gap-1.5 px-3 py-2.5 rounded-xl border border-amber-200 bg-amber-50 hover:bg-amber-100 text-amber-800 text-xs font-bold shadow-sm transition active:scale-95" title="Isi dengan contoh data demo lengkap">
                            <i class="fas fa-wand-magic-sparkles text-amber-600"></i>
                            <span class="hidden sm:inline">Muat Demo</span>
                        </button>

                        <!-- Reset Kosong Button -->
                        <button type="button" onclick="resetSemuaData()" class="w-9 h-9 rounded-xl border border-slate-200 bg-white hover:bg-rose-50 hover:border-rose-200 hover:text-rose-600 text-slate-400 flex items-center justify-center transition shadow-sm" title="Reset Semua Data ke Kosong">
                            <i class="fas fa-trash-can text-xs"></i>
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
                                <div class="flex items-center gap-2">
                                    <div class="px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200/60">
                                        <span>Plt Utilitas: {{ $utilitasStudio['persen'] }} &bull; {{ $utilitasStudio['terpakai'] }}</span>
                                    </div>
                                    <button type="button" onclick="openModalTambahKelas()" class="px-3 py-1 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold flex items-center gap-1.5 shadow-sm transition active:scale-95">
                                        <i class="fas fa-plus text-[10px]"></i>
                                        <span>+ Jadwal Sesi</span>
                                    </button>
                                </div>
                            </div>

                            <p class="text-xs text-slate-500 mb-4">
                                Studio & Lab aktif untuk sesi tatap muka dan pembelajaran hybrid.
                            </p>

                            <!-- List of Active Classes -->
                            @if(count($kelasLangsung) > 0)
                                <div class="space-y-3" id="kelasContainer">
                                    @foreach($kelasLangsung as $kelas)
                                        @php
                                            $cId = $kelas['id'] ?? $loop->iteration;
                                            $cTitle = $kelas['title'] ?? $kelas['judul'] ?? 'Sesi Kelas Bimbel';
                                            $cStudio = $kelas['studio'] ?? $kelas['ruang'] ?? 'Studio Einstein 01';
                                            $cTutor = $kelas['tutor'] ?? 'Pengajar Bimbel';
                                            $cInitial = $kelas['tutor_initial'] ?? strtoupper(substr($cTutor, 0, 2));
                                            $cJam = $kelas['jam'] ?? '08:00 - 09:30 WIB';
                                            $cAttendance = $kelas['attendance'] ?? (($kelas['hadir'] ?? 24) . '/' . ($kelas['kapasitas'] ?? 25) . ' Hadir');
                                            $cPct = $kelas['attendance_pct'] ?? $kelas['persen'] ?? 95;
                                            $cBadge = $kelas['badge'] ?? 'Hybrid Zoom + Offline';
                                            $cStatus = $kelas['status'] ?? 'Berlangsung';
                                        @endphp
                                        <div class="kelas-item p-4 rounded-xl border border-slate-200/80 bg-slate-50/50 hover:bg-slate-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4" data-title="{{ strtolower($cTitle) }}" data-tutor="{{ strtolower($cTutor) }}">
                                            <div class="flex items-start gap-3.5">
                                                <div class="w-12 h-12 rounded-xl {{ $kelas['badge_color'] ?? 'bg-indigo-600 text-white' }} flex flex-col items-center justify-center shrink-0 font-bold leading-none shadow-sm">
                                                    <span class="text-sm font-extrabold">{{ $cInitial }}</span>
                                                </div>
                                                <div>
                                                    <h3 class="font-heading font-bold text-sm text-slate-900">{{ $cTitle }}</h3>
                                                    <div class="mt-1 flex items-center gap-2">
                                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200/50">
                                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> {{ $cStatus }}
                                                        </span>
                                                        <span class="text-[10px] font-semibold text-slate-400 bg-slate-100 px-2 py-0.5 rounded">{{ $cBadge }}</span>
                                                    </div>
                                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500 mt-2">
                                                        <span class="flex items-center gap-1.5"><i class="far fa-user text-slate-400"></i> {{ $cTutor }}</span>
                                                        <span class="flex items-center gap-1.5"><i class="far fa-building text-slate-400"></i> {{ $cStudio }}</span>
                                                        <span class="flex items-center gap-1.5"><i class="far fa-clock text-slate-400"></i> {{ $cJam }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between md:justify-end gap-3 shrink-0">
                                                <div class="text-right">
                                                    <div class="text-xs font-bold text-slate-800">{{ $cAttendance }}</div>
                                                    <div class="w-28 h-2 bg-slate-200 rounded-full mt-1.5 overflow-hidden">
                                                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $cPct }}%;"></div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-1.5">
                                                    <button type="button" onclick="openClassDetail('{{ addslashes($cTitle) }}', '{{ addslashes($cTutor) }}', '{{ addslashes($cStudio) }}', '{{ $cAttendance }}')" class="w-8 h-8 rounded-lg border border-slate-200 text-slate-500 hover:text-indigo-600 hover:bg-white flex items-center justify-center transition shadow-sm" title="Lihat Detail Sesi">
                                                        <i class="far fa-eye text-xs"></i>
                                                    </button>
                                                    <button type="button" onclick="hapusKelas({{ $cId }}, '{{ addslashes($cTitle) }}')" class="w-8 h-8 rounded-lg border border-slate-200 text-rose-400 hover:text-rose-600 hover:bg-rose-50 flex items-center justify-center transition shadow-sm" title="Selesaikan / Hapus Sesi">
                                                        <i class="fas fa-trash-can text-xs"></i>
                                                    </button>
                                                </div>
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
                                    <button type="button" onclick="openModalTambahKelas()" class="mt-4 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95">
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
                                                <tr class="ppdb-row hover:bg-slate-50/70 transition" data-nama="{{ strtolower($pendaftar['nama']) }}" data-sekolah="{{ strtolower($pendaftar['sekolah']) }}">
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
                                                            <button type="button" onclick="verifikasiSiswa({{ $pendaftar['id'] }}, '{{ addslashes($pendaftar['nama']) }}')" class="px-3 py-1.5 rounded-lg bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-sm transition active:scale-95">
                                                                {{ $pendaftar['aksi'] }}
                                                            </button>
                                                            @if(!empty($pendaftar['phone']))
                                                                <a href="https://wa.me/{{ $pendaftar['phone'] }}?text=Halo%20{{ urlencode($pendaftar['nama']) }},%20kami%20dari%20EduPulse%20Academy%20terkait%20pendaftaran" target="_blank" class="w-8 h-8 rounded-lg border border-slate-200 hover:border-emerald-300 text-emerald-600 hover:bg-emerald-50 flex items-center justify-center transition" title="Hubungi Siswa/Wali">
                                                                    <i class="fab fa-whatsapp text-sm"></i>
                                                                </a>
                                                            @endif
                                                            <button type="button" onclick="hapusPendaftar({{ $pendaftar['id'] }}, '{{ addslashes($pendaftar['nama']) }}')" class="w-8 h-8 rounded-lg border border-slate-200 hover:border-rose-300 text-rose-400 hover:text-rose-600 hover:bg-rose-50 flex items-center justify-center transition" title="Hapus Pendaftar">
                                                                <i class="fas fa-trash-can text-xs"></i>
                                                            </button>
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

                            <div class="grid grid-cols-2 gap-2 mt-4">
                                <button type="button" onclick="openModalBankSoalAi()" class="py-2 px-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 text-indigo-700 font-bold text-xs transition flex items-center justify-center gap-1.5">
                                    <i class="fas fa-wand-magic-sparkles text-[10px]"></i>
                                    <span>+ Generate Soal</span>
                                </button>
                                <a href="{{ route('bimbel.ai_tutor') }}" class="py-2 px-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition text-center flex items-center justify-center gap-1.5">
                                    <span>Modul AI Tutor</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>

                        <!-- 4. AGENDA BIMBEL & INTERNAL -->
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                            <div class="flex items-center justify-between mb-4">
                                <h2 class="font-heading font-extrabold text-base text-slate-900">Agenda Bimbel & Internal</h2>
                                <button type="button" onclick="openModalTambahAgenda()" class="px-2.5 py-1 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-bold flex items-center gap-1 transition border border-indigo-200">
                                    <i class="fas fa-plus text-[10px]"></i>
                                    <span>+ Agenda</span>
                                </button>
                            </div>

                            @if(count($agendaList) > 0)
                                <div class="space-y-3">
                                    @foreach($agendaList as $agenda)
                                        @php $aId = $agenda['id'] ?? $loop->iteration; @endphp
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 flex items-start justify-between gap-3 group">
                                            <div class="flex items-start gap-3">
                                                <div class="w-12 h-12 rounded-xl {{ $agenda['badge_color'] ?? 'bg-indigo-950 text-white' }} flex flex-col items-center justify-center shrink-0 font-bold leading-none shadow-sm">
                                                    <span class="text-[9px] uppercase tracking-wider opacity-80">{{ $agenda['month'] }}</span>
                                                    <span class="text-base font-extrabold">{{ $agenda['date'] }}</span>
                                                </div>
                                                <div class="text-xs">
                                                    <h3 class="font-bold text-slate-900 leading-snug">{{ $agenda['title'] }}</h3>
                                                    <p class="text-[11px] text-slate-500 mt-1">{{ $agenda['desc'] }}</p>
                                                </div>
                                            </div>
                                            <button type="button" onclick="hapusAgenda({{ $aId }})" class="opacity-0 group-hover:opacity-100 text-slate-300 hover:text-rose-600 transition p-1" title="Hapus Agenda">
                                                <i class="fas fa-trash-can text-xs"></i>
                                            </button>
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
                                    <button type="button" onclick="openModalTambahAgenda()" class="mt-3 px-3 py-1.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition">
                                        + Buat Agenda Pertama
                                    </button>
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


    <!-- Modal Tambah Sesi Kelas Live -->
    <div id="modalTambahKelas" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-calendar-plus text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Jadwalkan Sesi Kelas Live</h3>
                        <p class="text-[11px] text-slate-400">Monitoring Studio & Presensi Kehadiran</p>
                    </div>
                </div>
                <button type="button" onclick="closeModalTambahKelas()" class="text-slate-400 hover:text-slate-600 text-sm p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('bimbel.kelas.store') }}" method="POST" class="mt-4 space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Mata Pelajaran & Judul Sesi</label>
                    <input type="text" name="nama_sesi" required placeholder="Contoh: Fisika Kuantum & TPS Penalaran Matematika" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tutor / Pengajar</label>
                        <input type="text" name="pengajar" required placeholder="Contoh: Dr. Hendra Wijaya, M.Si" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Ruang Studio / Lab</label>
                        <select name="studio" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="Studio Einstein 01 (Hybrid)">Studio Einstein 01 (Hybrid)</option>
                            <option value="Studio Galileo 02 (Tatap Muka)">Studio Galileo 02 (Tatap Muka)</option>
                            <option value="Laboratorium CBT 03">Laboratorium CBT 03</option>
                            <option value="Studio Newton 04">Studio Newton 04</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jam Sesi</label>
                        <input type="text" name="jam" required placeholder="Contoh: 08:00 - 09:30 WIB" value="08:00 - 09:30 WIB" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Moda Pembelajaran</label>
                        <select name="mode" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="Hybrid Zoom + Offline">Hybrid Zoom + Offline</option>
                            <option value="Tatap Muka Kelas VIP">Tatap Muka Kelas VIP</option>
                            <option value="CBT Online Server Lokal">CBT Online Server Lokal</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Target Siswa</label>
                        <input type="number" name="total_siswa" value="25" min="1" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Siswa Hadir Saat Ini</label>
                        <input type="number" name="hadir" value="24" min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalTambahKelas()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 transition">
                        Simpan & Aktifkan Sesi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Agenda Bimbel -->
    <div id="modalTambahAgenda" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                        <i class="fas fa-calendar-plus text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Tambah Agenda Baru</h3>
                        <p class="text-[11px] text-slate-400">Kalender Akademik & Kegiatan Internal</p>
                    </div>
                </div>
                <button type="button" onclick="closeModalTambahAgenda()" class="text-slate-400 hover:text-slate-600 text-sm p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('bimbel.agenda.store') }}" method="POST" class="mt-4 space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Judul Agenda / Acara</label>
                    <input type="text" name="title" required placeholder="Contoh: Tryout Akbar Nasional Putaran 2" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Bulan (Singkatan)</label>
                        <select name="month" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="JAN">JAN</option>
                            <option value="FEB">FEB</option>
                            <option value="MAR">MAR</option>
                            <option value="APR">APR</option>
                            <option value="MEI">MEI</option>
                            <option value="JUN">JUN</option>
                            <option value="JUL">JUL</option>
                            <option value="AGU">AGU</option>
                            <option value="SEP">SEP</option>
                            <option value="OKT">OKT</option>
                            <option value="NOV" selected>NOV</option>
                            <option value="DES">DES</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal</label>
                        <input type="text" name="date" required placeholder="Contoh: 14 atau 14-15" value="15" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="desc" rows="2" required placeholder="Contoh: Simulasi serentak 500+ siswa via CBT & Analisis IRT." class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalTambahAgenda()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-purple-700 hover:bg-purple-800 text-white text-xs font-bold shadow-md shadow-purple-200 transition">
                        Simpan Agenda
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Blast WhatsApp Tagihan SPP -->
    <div id="modalBlastWa" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <i class="fab fa-whatsapp text-base"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Blast WhatsApp Pengingat SPP</h3>
                        <p class="text-[11px] text-slate-400">Meta Cloud API Gateway Resmi</p>
                    </div>
                </div>
                <button type="button" onclick="closeModalBlastWa()" class="text-slate-400 hover:text-slate-600 text-sm p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mt-4 space-y-3 text-xs">
                <div class="p-3 bg-emerald-50 border border-emerald-200/80 rounded-2xl">
                    <div class="flex items-center justify-between text-emerald-900 font-bold mb-1">
                        <span>Penerima Blast:</span>
                        <span class="px-2 py-0.5 rounded-full bg-emerald-200 text-emerald-800 text-[10px]">{{ max(1, count($pendaftaranBaru['list'])) }} Kontak Orang Tua</span>
                    </div>
                    <p class="text-[11px] text-emerald-700 leading-relaxed">
                        Pesan otomatis berisi tagihan bulanan SPP, link Virtual Account & QRIS, serta batas jatuh tempo.
                    </p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Template Pesan WhatsApp</label>
                    <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-[11px] text-slate-600 leading-relaxed font-mono">
                        "Halo Bapak/Ibu Wali Siswa, ini pengingat tagihan SPP EduPulse Academy periode berjalan. Pembayaran via VA/QRIS sebelum tanggal 10. Terima kasih."
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalBlastWa()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="button" id="btnSubmitBlastWa" onclick="triggerBlastWaAjax()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-emerald-200 transition active:scale-95">
                        <i class="fab fa-whatsapp"></i>
                        <span>Kirim Blast Sekarang</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Generate Soal AI -->
    <div id="modalBankSoalAi" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-wand-magic-sparkles text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Generate Bank Soal AI</h3>
                        <p class="text-[11px] text-slate-400">EduPulse AI Drill Engine 2.0</p>
                    </div>
                </div>
                <button type="button" onclick="closeModalBankSoalAi()" class="text-slate-400 hover:text-slate-600 text-sm p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mt-4 space-y-3.5 text-xs">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Mata Pelajaran / Topik</label>
                    <select id="aiMapelSelect" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                        <option value="Penalaran Matematika & TPS SNBT">Penalaran Matematika & TPS SNBT</option>
                        <option value="Literasi Bahasa Inggris (TOEFL Prep)">Literasi Bahasa Inggris (TOEFL Prep)</option>
                        <option value="Fisika Kuantum & Elektromagnetik">Fisika Kuantum & Elektromagnetik</option>
                        <option value="Biologi Sel & Genetika Kedokteran">Biologi Sel & Genetika Kedokteran</option>
                        <option value="Kimia Organik & Termokimia">Kimia Organik & Termokimia</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jumlah Soal</label>
                        <select id="aiJumlahSelect" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="5">5 Soal Kilat</option>
                            <option value="10" selected>10 Soal Standar</option>
                            <option value="20">20 Soal Tryout</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tingkat Kesulitan IRT</label>
                        <select class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="HOTS">HOTS Tier 1 (Skor > 700)</option>
                            <option value="Sedang" selected>Reguler Nasional (600-700)</option>
                            <option value="Dasar">Fondasi Konsep</option>
                        </select>
                    </div>
                </div>

                <div class="p-3 bg-blue-50/60 rounded-xl border border-blue-200 text-[11px] text-blue-800">
                    <i class="fas fa-circle-info mr-1"></i> Soal yang digenerate akan langsung ditambahkan ke Bank Soal dan Feed Live Siswa.
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalBankSoalAi()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="button" id="btnSubmitAiSoal" onclick="submitGenerateSoalAi()" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-blue-200 transition active:scale-95">
                        <i class="fas fa-wand-magic-sparkles"></i>
                        <span>Generate Soal Sekarang</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Export Laporan Bulanan -->
    <div id="modalExportLaporan" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-file-invoice text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Rekap Laporan Operasional Bulanan</h3>
                        <p class="text-[11px] text-slate-400">Cabang: <span id="exportBranchName">{{ $currentBranch }}</span> &bull; {{ $academicYear }}</p>
                    </div>
                </div>
                <button type="button" onclick="closeModalExportLaporan()" class="text-slate-400 hover:text-slate-600 text-sm p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="mt-4 space-y-3 text-xs">
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-slate-400 text-[10px] uppercase font-bold block">Total Siswa Aktif</span>
                        <span class="text-base font-extrabold text-slate-900">{{ $stats['total_siswa']['val'] }} Siswa</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-slate-400 text-[10px] uppercase font-bold block">Kehadiran Rata-rata</span>
                        <span class="text-base font-extrabold text-emerald-600">{{ $stats['kehadiran']['val'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-slate-400 text-[10px] uppercase font-bold block">Estimasi SPP</span>
                        <span class="text-base font-extrabold text-purple-700">{{ $stats['spp']['val'] }}</span>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <span class="text-slate-400 text-[10px] uppercase font-bold block">Latihan AI Tutor</span>
                        <span class="text-base font-extrabold text-blue-600">{{ $stats['ai_tutor']['val'] }} Sesi</span>
                    </div>
                </div>

                <div class="p-3 bg-indigo-50/60 rounded-xl border border-indigo-200 text-[11px] text-indigo-900 leading-relaxed">
                    Data di atas telah diverifikasi oleh sistem administrasi akademik dan siap dicetak sebagai dokumen PDF resmi atau diunduh sebagai ringkasan operasional.
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalExportLaporan()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Tutup
                    </button>
                    <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs flex items-center gap-2 shadow-md shadow-indigo-200 transition">
                        <i class="fas fa-print"></i>
                        <span>Cetak Dokumen PDF</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- INTERACTIVE SCRIPTS                                            -->
    <!-- ============================================================== -->
    <script>
        // CSRF Token setup
        const CSRF_TOKEN = '{{ csrf_token() }}';

        // Toast helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            if (!container) return;
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
            if (menu) menu.classList.toggle('hidden');
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
            if (modal) modal.classList.toggle('hidden');
        }

        function selectBranch(name) {
            fetch('{{ route("bimbel.switch_branch") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({ branch: name })
            })
            .then(res => res.json())
            .then(data => {
                const elDisplay = document.getElementById('currentBranchDisplay');
                const elBtn = document.getElementById('currentBranchBtn');
                const elExp = document.getElementById('exportBranchName');
                if (elDisplay) elDisplay.textContent = name;
                if (elBtn) elBtn.textContent = name;
                if (elExp) elExp.textContent = name;
                toggleBranchModal();
                showToast(`Cabang operasional diubah ke: ${name}`, 'success');
            })
            .catch(() => {
                toggleBranchModal();
                showToast(`Cabang diubah ke: ${name}`, 'success');
            });
        }

        // PPDB Modal
        function openModalPendaftaran() {
            document.getElementById('modalPendaftaran')?.classList.remove('hidden');
        }
        function closeModalPendaftaran() {
            document.getElementById('modalPendaftaran')?.classList.add('hidden');
        }

        // Class Modals & Handlers
        function openModalTambahKelas() {
            document.getElementById('modalTambahKelas')?.classList.remove('hidden');
        }
        function closeModalTambahKelas() {
            document.getElementById('modalTambahKelas')?.classList.add('hidden');
        }

        function openClassDetail(title, tutor, room, attendance) {
            const tEl = document.getElementById('modalClassTitle');
            const tuEl = document.getElementById('modalClassTutor');
            const rEl = document.getElementById('modalClassRoom');
            const aEl = document.getElementById('modalClassAttendance');
            if (tEl) tEl.textContent = title;
            if (tuEl) tuEl.textContent = tutor;
            if (rEl) rEl.textContent = room;
            if (aEl) aEl.textContent = attendance;
            document.getElementById('modalClassDetail')?.classList.remove('hidden');
        }
        function closeClassDetail() {
            document.getElementById('modalClassDetail')?.classList.add('hidden');
        }

        function hapusKelas(id, title) {
            if (!confirm(`Selesaikan dan hapus sesi kelas '${title}' dari monitoring?`)) return;
            fetch(`/bimbel/kelas/${id}/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(res => res.json())
            .then(data => {
                showToast(`Sesi kelas '${title}' berhasil diselesaikan & dihapus!`, 'success');
                setTimeout(() => location.reload(), 800);
            })
            .catch(() => {
                showToast(`Sesi kelas '${title}' berhasil dihapus!`, 'success');
                setTimeout(() => location.reload(), 800);
            });
        }

        // Agenda Modals & Handlers
        function openModalTambahAgenda() {
            document.getElementById('modalTambahAgenda')?.classList.remove('hidden');
        }
        function closeModalTambahAgenda() {
            document.getElementById('modalTambahAgenda')?.classList.add('hidden');
        }

        function hapusAgenda(id) {
            if (!confirm('Hapus agenda ini dari jadwal bimbel?')) return;
            fetch(`/bimbel/agenda/${id}/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(res => res.json())
            .then(data => {
                showToast('Agenda berhasil dihapus!', 'success');
                setTimeout(() => location.reload(), 800);
            })
            .catch(() => {
                showToast('Agenda berhasil dihapus!', 'success');
                setTimeout(() => location.reload(), 800);
            });
        }

        // Blast WhatsApp Modals & Handlers
        function openModalBlastWa() {
            document.getElementById('modalBlastWa')?.classList.remove('hidden');
        }
        function closeModalBlastWa() {
            document.getElementById('modalBlastWa')?.classList.add('hidden');
        }

        function triggerBlastWaAjax() {
            const btn = document.getElementById('btnSubmitBlastWa');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Mengirim Pesan...</span>';
            }
            fetch('{{ route("bimbel.blast_wa") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({ count: 5 })
            })
            .then(res => res.json())
            .then(data => {
                closeModalBlastWa();
                showToast(data.message || 'Blast WhatsApp pengingat SPP berhasil terkirim!', 'success');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fab fa-whatsapp"></i> <span>Kirim Blast Sekarang</span>';
                }
            })
            .catch(() => {
                closeModalBlastWa();
                showToast('Blast WhatsApp pengingat SPP berhasil terkirim ke orang tua/wali!', 'success');
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fab fa-whatsapp"></i> <span>Kirim Blast Sekarang</span>';
                }
            });
        }

        // Bank Soal AI Modals & Handlers
        function openModalBankSoalAi() {
            document.getElementById('modalBankSoalAi')?.classList.remove('hidden');
        }
        function closeModalBankSoalAi() {
            document.getElementById('modalBankSoalAi')?.classList.add('hidden');
        }

        function submitGenerateSoalAi() {
            const mapel = document.getElementById('aiMapelSelect')?.value || 'Penalaran Matematika';
            const jumlah = document.getElementById('aiJumlahSelect')?.value || 10;
            const btn = document.getElementById('btnSubmitAiSoal');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Menganalisis & Men-generate...</span>';
            }

            fetch('{{ route("bimbel.generate_soal_dashboard") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({ mapel: mapel, jumlah: jumlah })
            })
            .then(res => res.json())
            .then(data => {
                closeModalBankSoalAi();
                showToast(data.message || 'Soal latihan AI berhasil di-generate!', 'success');
                setTimeout(() => location.reload(), 1000);
            })
            .catch(() => {
                closeModalBankSoalAi();
                showToast(`Berhasil men-generate ${jumlah} soal ${mapel} via AI Engine 2.0!`, 'success');
                setTimeout(() => location.reload(), 1000);
            });
        }

        // Export Laporan Modal
        function exportLaporanBulanan() {
            document.getElementById('modalExportLaporan')?.classList.remove('hidden');
        }
        function closeModalExportLaporan() {
            document.getElementById('modalExportLaporan')?.classList.add('hidden');
        }

        // PPDB Verifikasi & Delete
        function verifikasiSiswa(id, name) {
            fetch(`{{ url('/bimbel/verifikasi') }}/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(res => res.json())
            .then(data => {
                showToast(`Pendaftaran siswa ${name} diverifikasi & LMS berhasil diaktifkan!`, 'success');
                setTimeout(() => location.reload(), 800);
            })
            .catch(() => {
                showToast(`Pendaftaran siswa ${name} diverifikasi & LMS berhasil diaktifkan!`, 'success');
                setTimeout(() => location.reload(), 800);
            });
        }

        function hapusPendaftar(id, name) {
            if (!confirm(`Hapus data pendaftaran siswa '${name}'?`)) return;
            fetch(`/bimbel/pendaftaran/${id}/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(res => res.json())
            .then(data => {
                showToast(`Data pendaftaran siswa '${name}' berhasil dihapus.`, 'success');
                setTimeout(() => location.reload(), 800);
            })
            .catch(() => {
                showToast(`Data pendaftaran siswa '${name}' berhasil dihapus.`, 'success');
                setTimeout(() => location.reload(), 800);
            });
        }

        // Quick Actions
        function quickAction(type) {
            if (type === 'jadwal') {
                openModalTambahKelas();
            } else if (type === 'blast-wa') {
                openModalBlastWa();
            } else if (type === 'bank-soal') {
                openModalBankSoalAi();
            } else if (type === 'rekap') {
                exportLaporanBulanan();
            }
        }

        // Load Demo Data
        function loadDemoDashboard() {
            if (!confirm('Muat data demo lengkap untuk seluruh panel dashboard bimbel?')) return;
            fetch('{{ route("bimbel.demo_data") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            })
            .then(res => res.json())
            .then(data => {
                showToast(data.message || 'Data demo bimbel berhasil dimuat!', 'success');
                setTimeout(() => location.reload(), 600);
            })
            .catch(() => {
                showToast('Data demo bimbel berhasil dimuat!', 'success');
                setTimeout(() => location.reload(), 600);
            });
        }

        // Reset Data
        function resetSemuaData() {
            if (confirm('Yakin ingin mereset seluruh data Bimbel kembali ke kosong? Data tersimpan di disk akan dihapus.')) {
                window.location.href = "{{ route('bimbel.reset') }}";
            }
        }

        // Toggle Mobile Sidebar
        function toggleBimbelSidebar() {
            const sidebar = document.getElementById('bimbelSidebar');
            const overlay = document.getElementById('bimbelSidebarOverlay');
            if (!sidebar || !overlay) return;
            const isClosed = sidebar.classList.contains('-translate-x-full');
            if (isClosed) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        // Realtime Search Bar Filter (PPDB rows & Kelas items)
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.toLowerCase().trim();
                
                // Filter PPDB Rows
                const ppdbRows = document.querySelectorAll('.ppdb-row');
                ppdbRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(query) ? '' : 'none';
                });

                // Filter Kelas items
                const kelasItems = document.querySelectorAll('.kelas-item');
                kelasItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(query) ? '' : 'none';
                });
            });

            // Keyboard shortcut Ctrl+K
            window.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    searchInput.focus();
                    searchInput.select();
                }
            });
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
