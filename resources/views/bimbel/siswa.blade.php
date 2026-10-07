<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduPulse Academy SaaS — Pendaftaran & Direktori Siswa</title>
    <meta name="description" content="Pusat kendali pendaftaran, verifikasi berkas SNBT/Reguler, profil 360°, dan status SPP siswa EduPulse Academy.">

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
                <!-- Dashboard -->
                <a href="{{ route('bimbel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <i class="fas fa-grid-2 text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Siswa & Pendaftaran (ACTIVE) -->
                <a href="{{ route('bimbel.siswa') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-sm shadow-indigo-200 transition-all">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-user-group text-sm w-4 text-center"></i>
                        <span>Siswa & Pendaftaran</span>
                    </div>
                    <span class="px-1.5 py-0.5 rounded-md text-[10px] font-bold bg-white/20 text-white">PPDB</span>
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

                <!-- Progress & Rapor -->
                <a href="{{ route('bimbel.progress') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-chart-line-up text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                        <span>Progress & Rapor</span>
                    </div>
                </a>

                <!-- AI Tutor Assistant -->
                <a href="{{ route('bimbel.ai_tutor') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all group">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-brain text-slate-400 group-hover:text-indigo-600 text-sm w-4 text-center"></i>
                        <span>AI Tutor Assistant</span>
                    </div>
                    <span class="px-1.5 py-0.5 rounded-md text-[9px] font-extrabold bg-emerald-50 text-emerald-600 border border-emerald-200 uppercase">AI 2.0</span>
                </a>

                <!-- Pengaturan -->
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
                    <input type="text" id="topSearchInput" placeholder="Cari siswa, kelas, guru dll" class="w-full pl-9 pr-14 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition-all placeholder-slate-400">
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
                    <button type="button" onclick="showToast('Sistem online: Direktori siswa aktif.', 'info')" class="w-9 h-9 rounded-xl border border-slate-200 text-slate-500 hover:text-slate-800 hover:bg-slate-50 flex items-center justify-center relative transition">
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

            <!-- Main Scrollable Content -->
            <main class="flex-1 p-6 md:p-8 space-y-6 max-w-[1600px] w-full mx-auto">
                
                <!-- ============================================================== -->
                <!-- BREADCRUMB & HEADER                                            -->
                <!-- ============================================================== -->
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                    <div>
                        <!-- Breadcrumb -->
                        <div class="text-xs font-medium text-slate-400 mb-1">
                            <span>Portal Administrasi</span> <span class="mx-1">/</span> <span class="text-indigo-600 font-bold">Direktori Siswa</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <h1 class="font-heading font-extrabold text-2xl md:text-3xl text-slate-900 tracking-tight">
                                Pendaftaran & Direktori Siswa
                            </h1>
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                T.A. 2024/2025 Genap
                            </span>
                        </div>
                        <p class="text-xs md:text-sm text-slate-500 mt-1 max-w-2xl">
                            Pusat kendali pendaftaran, verifikasi berkas SNBT/Reguler, profil 360°, dan status SPP siswa.
                        </p>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-wrap items-center gap-2.5">
                        <!-- Broadcast Button -->
                        <button type="button" onclick="openModalBroadcast()" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 shadow-sm transition">
                            <i class="fas fa-bullhorn text-indigo-600 text-xs"></i>
                            <span>Broadcast Info Siswa</span>
                        </button>

                        <!-- Export Data Siswa -->
                        <button type="button" onclick="exportDataSiswa()" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 shadow-sm transition">
                            <i class="fas fa-arrow-down-to-bracket text-slate-500 text-xs"></i>
                            <span>Export Data Siswa</span>
                        </button>

                        <!-- Daftarkan Siswa Baru Button -->
                        <button type="button" onclick="openModalSiswa()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 hover:shadow-indigo-300 transition active:scale-95">
                            <i class="fas fa-user-plus text-xs"></i>
                            <span>+ Daftarkan Siswa Baru</span>
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
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                    <span>{{ $stats['total_siswa_aktif']['val'] }}</span>
                                    <span class="text-xs font-medium text-slate-400">Siswa</span>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-2 text-xs">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-slate-100 text-slate-600 border border-slate-200">+0%</span>
                            <span class="text-slate-400 text-[11px] truncate">dibandingkan semester lalu</span>
                        </div>
                    </div>

                    <!-- 2. PENDAFTAR BARU (BULAN INI) -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pendaftar Baru (Bulan Ini)</span>
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                    <span>{{ $stats['pendaftar_baru']['val'] }}</span>
                                    <span class="text-xs font-medium text-slate-400">Siswa</span>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                                <i class="fas fa-clipboard-user"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-400 text-[11px]">Gelombang Target SNBT & Reguler</span>
                        </div>
                    </div>

                    <!-- 3. MENUNGGU VERIFIKASI -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Menunggu Verifikasi</span>
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                    <span>{{ $stats['menunggu_verifikasi']['val'] }}</span>
                                    <span class="text-xs font-medium text-slate-400">Calon Siswa</span>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base">
                                <i class="fas fa-folder-open"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full {{ $stats['menunggu_verifikasi']['val'] > 0 ? 'bg-amber-500' : 'bg-slate-300' }}"></span>
                                <span class="text-slate-500 text-[11px]">{{ $stats['menunggu_verifikasi']['sub'] }}</span>
                            </div>
                            <a href="javascript:void(0)" onclick="showToast('Semua berkas pendaftaran telah terverifikasi.', 'info')" class="text-indigo-600 font-bold text-[11px] hover:underline">Periksa</a>
                        </div>
                    </div>

                    <!-- 4. RATA-RATA KEHADIRAN GLOBAL -->
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Rata-Rata Kehadiran Global</span>
                                <div class="font-heading font-black text-3xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                    <span>{{ $stats['kehadiran_global']['val'] }}</span>
                                    <span class="text-xs font-medium text-slate-400">Konsisten</span>
                                </div>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-base">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                            <div class="w-28 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-teal-500 rounded-full" style="width: {{ $stats['kehadiran_global']['val'] }};"></div>
                            </div>
                            <span class="text-slate-400 text-[11px] font-medium">+0.0%</span>
                        </div>
                    </div>

                </div>

                <!-- ============================================================== -->
                <!-- FILTER & SEARCH BAR                                            -->
                <!-- ============================================================== -->
                <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <div class="flex flex-wrap items-center gap-2.5 flex-1">
                        <!-- Search Box -->
                        <div class="relative flex-1 min-w-[240px]">
                            <i class="fas fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="filterSearch" placeholder="Cari nama siswa, NIS, atau sekolah asal..." value="{{ request('search') }}" onkeyup="handleFilterKey(event)" class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                        </div>

                        <!-- Dropdown Filter Program -->
                        <select id="filterProgram" onchange="applyFilters()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-indigo-500">
                            <option value="semua">Semua Program Bimbel</option>
                            <option value="Super Intensif SNBT">Super Intensif SNBT</option>
                            <option value="Kedokteran Excellence">Kedokteran Excellence</option>
                            <option value="Olimpiade Sains">Olimpiade Sains (OSN)</option>
                            <option value="English Mastery">English Mastery & SAT</option>
                        </select>

                        <!-- Dropdown Filter Status -->
                        <select id="filterStatus" onchange="applyFilters()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-indigo-500">
                            <option value="semua">Semua Status</option>
                            <option value="aktif">Aktif Belajar</option>
                            <option value="cuti">Cuti Ujian</option>
                            <option value="verifikasi">Verifikasi Berkas</option>
                        </select>

                        <!-- Dropdown Filter Jenjang -->
                        <select id="filterJenjang" onchange="applyFilters()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-indigo-500">
                            <option value="semua">Semua Jenjang / Ruang</option>
                            <option value="12">Kelas 12 SMA</option>
                            <option value="11">Kelas 11 SMA</option>
                            <option value="10">Kelas 10 SMA</option>
                        </select>
                    </div>

                    <!-- Right counter & Custom column button -->
                    <div class="flex items-center gap-3 shrink-0 text-xs">
                        <span class="text-slate-400">
                            Menampilkan <strong class="text-slate-700">{{ count($filteredList) }}</strong> dari <strong class="text-slate-700">{{ count($siswaList) }}</strong> siswa
                        </span>
                        <button type="button" onclick="showToast('Kustomisasi kolom tabel siap diaktifkan.', 'info')" class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-600 font-semibold transition">
                            <i class="fas fa-sliders text-slate-400 text-xs"></i>
                            <span>Kolom Kustom</span>
                        </button>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- SPLIT VIEW: LEFT (TABLE 62%) & RIGHT (PROFIL 360° 38%)       -->
                <!-- ============================================================== -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                    
                    <!-- ========================================== -->
                    <!-- LEFT COLUMN: TABEL SISWA (7 COLS)          -->
                    <!-- ========================================== -->
                    <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
                        
                        <div class="p-4 border-b border-slate-100 flex items-center justify-between text-xs text-slate-400 font-bold uppercase tracking-wider">
                            <span>Siswa & Institusi Asal</span>
                            <span>Program & Kelas</span>
                        </div>

                        <!-- Table body / List -->
                        <div class="divide-y divide-slate-100 min-h-[380px]">
                            @if(count($filteredList) > 0)
                                @foreach($filteredList as $item)
                                    <div onclick="selectStudent({{ $item['id'] }})" class="p-4 flex items-center justify-between gap-4 hover:bg-slate-50/80 cursor-pointer transition {{ isset($selectedSiswa['id']) && $selectedSiswa['id'] == $item['id'] ? 'bg-indigo-50/40 border-l-4 border-indigo-600' : '' }}">
                                        
                                        <!-- Left Info -->
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-bold text-xs flex items-center justify-center shrink-0 shadow-sm">
                                                {{ $item['initial'] }}
                                            </div>
                                            <div class="min-w-0">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-bold text-sm text-slate-900 truncate">{{ $item['nama'] }}</span>
                                                    @if(strtolower($item['status']) === 'aktif')
                                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">Aktif</span>
                                                    @elseif(stripos($item['status'], 'cuti') !== false)
                                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200">Cuti Ujian</span>
                                                    @else
                                                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200">Verifikasi Berkas</span>
                                                    @endif
                                                </div>
                                                <div class="text-[11px] text-slate-400 mt-0.5 truncate">
                                                    NIS: {{ $item['nis'] }} &bull; {{ $item['sekolah'] }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right Info -->
                                        <div class="text-right shrink-0">
                                            <div class="text-xs font-bold text-slate-800">{{ $item['program'] }}</div>
                                            <div class="text-[11px] text-slate-400 mt-0.5 flex items-center justify-end gap-1">
                                                <i class="far fa-building text-[10px]"></i>
                                                <span>{{ $item['kelas_ruang'] }}</span>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            @else
                                <!-- Modern Clean Empty State (Data Kosong) -->
                                <div class="py-16 px-6 text-center flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 rounded-3xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center text-2xl mb-4 shadow-sm">
                                        <i class="fas fa-users-slash"></i>
                                    </div>
                                    <h3 class="font-heading font-extrabold text-base text-slate-900">Belum Ada Siswa Terdaftar di Direktori</h3>
                                    <p class="text-xs text-slate-400 mt-1 max-w-sm leading-relaxed">
                                        Data direktori siswa saat ini masih kosong bersih. Silakan daftarkan siswa pertama Anda melalui tombol di bawah.
                                    </p>
                                    <button type="button" onclick="openModalSiswa()" class="mt-5 px-5 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 hover:shadow-indigo-300 transition active:scale-95 flex items-center gap-2">
                                        <i class="fas fa-plus"></i>
                                        <span>+ Daftarkan Siswa Baru</span>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <!-- Pagination Footer -->
                        <div class="p-4 border-t border-slate-100 bg-slate-50/40 flex items-center justify-between text-xs text-slate-500">
                            <div class="flex items-center gap-2">
                                <span>Baris per halaman:</span>
                                <select class="px-2 py-1 rounded-lg border border-slate-200 bg-white text-xs font-semibold text-slate-700">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-1">
                                <button type="button" class="w-7 h-7 rounded-lg border border-slate-200 bg-white flex items-center justify-center text-slate-400 hover:text-slate-700 transition" disabled>
                                    <i class="fas fa-chevron-left text-[10px]"></i>
                                </button>
                                <button type="button" class="w-7 h-7 rounded-lg bg-[#3b49df] text-white font-bold text-xs flex items-center justify-center shadow-sm">
                                    1
                                </button>
                                <button type="button" class="w-7 h-7 rounded-lg border border-slate-200 bg-white flex items-center justify-center text-slate-400 hover:text-slate-700 transition" disabled>
                                    <i class="fas fa-chevron-right text-[10px]"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- ========================================== -->
                    <!-- RIGHT COLUMN: PROFIL 360° SISWA (5 COLS)   -->
                    <!-- ========================================== -->
                    <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm">
                        
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <span class="text-[10px] font-extrabold uppercase tracking-widest text-indigo-600 block">Profil 360° Siswa</span>
                                <h2 class="font-heading font-extrabold text-lg text-slate-900 mt-0.5">Detail Terintegrasi</h2>
                            </div>
                            @if($selectedSiswa)
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> {{ $selectedSiswa['status'] }}
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                    Standby
                                </span>
                            @endif
                        </div>

                        @if($selectedSiswa)
                            
                            <!-- Student Mini Identity Card -->
                            <div class="p-4 rounded-2xl bg-gradient-to-br from-slate-50 to-indigo-50/40 border border-slate-200/80 flex items-center gap-3.5 mb-5">
                                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-sm flex items-center justify-center shrink-0 shadow-md shadow-indigo-200">
                                    {{ $selectedSiswa['initial'] }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="font-heading font-bold text-base text-slate-900 leading-tight truncate">{{ $selectedSiswa['nama'] }}</h3>
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        NIS: <strong class="text-slate-700">{{ $selectedSiswa['nis'] }}</strong>
                                    </div>
                                    <div class="text-[11px] font-semibold text-indigo-700 mt-0.5 truncate">
                                        {{ $selectedSiswa['sekolah'] }}
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4 text-xs">
                                
                                <!-- 1. Target Kampus & Jurusan Impian -->
                                <div>
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block mb-2">Target Kampus & Jurusan Impian</span>
                                    <div class="grid grid-cols-2 gap-2.5">
                                        
                                        <!-- Pilihan 1 -->
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                                            <span class="text-[10px] font-extrabold text-indigo-600 block mb-1">Pilihan 1 (Utama)</span>
                                            <div class="font-bold text-slate-800 leading-snug">{{ $selectedSiswa['target_ptn1']['jurusan'] ?? 'Teknik Elektro' }}</div>
                                            <div class="text-[11px] text-slate-500 mt-0.5">{{ $selectedSiswa['target_ptn1']['kampus'] ?? 'Universitas Indonesia' }}</div>
                                            <div class="mt-2 text-[10px] font-extrabold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded inline-block">
                                                Tryout: {{ $selectedSiswa['target_ptn1']['skor_tryout'] ?? '684.5 Pts' }}
                                            </div>
                                        </div>

                                        <!-- Pilihan 2 -->
                                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70">
                                            <span class="text-[10px] font-extrabold text-slate-500 block mb-1">Pilihan 2</span>
                                            <div class="font-bold text-slate-800 leading-snug">{{ $selectedSiswa['target_ptn2']['jurusan'] ?? 'STEI - Rekayasa' }}</div>
                                            <div class="text-[11px] text-slate-500 mt-0.5">{{ $selectedSiswa['target_ptn2']['kampus'] ?? 'Institut Teknologi Bandung' }}</div>
                                            <div class="mt-2 text-[10px] font-extrabold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded inline-block">
                                                Peluang: {{ $selectedSiswa['target_ptn2']['peluang'] ?? '82%' }}
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- 2. Riwayat Kehadiran & Sesi -->
                                <div class="p-3.5 rounded-xl border border-slate-200/80 bg-slate-50/50">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Riwayat Kehadiran & Sesi</span>
                                        <span class="text-xs font-bold text-emerald-600">{{ $selectedSiswa['kehadiran']['persen'] ?? '96.0%' }} ({{ $selectedSiswa['kehadiran']['status_label'] ?? 'Sangat Baik' }})</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 py-1">
                                        @foreach(($selectedSiswa['kehadiran']['sesi_blocks'] ?? ['H', 'H', 'H', 'H', 'S', 'H', '-']) as $block)
                                            <div class="flex-1 h-7 rounded-lg flex items-center justify-center font-bold text-[11px] {{ $block === 'H' ? 'bg-emerald-600 text-white' : ($block === 'S' ? 'bg-amber-500 text-white' : 'bg-slate-200 text-slate-500') }}">
                                                {{ $block }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="text-[10px] text-slate-400 mt-2 leading-relaxed">
                                        {{ $selectedSiswa['kehadiran']['terdaftar_sejak'] ?? 'Terdaftar via PPDB Online' }}
                                    </p>
                                </div>

                                <!-- 3. Status Cicilan SPP Bimbel -->
                                <div class="p-3.5 rounded-xl border border-slate-200/80 bg-slate-50/50">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status Cicilan SPP Bimbel</span>
                                        <span class="text-xs font-bold text-indigo-600">{{ $selectedSiswa['spp']['status_termin'] ?? 'Lunas' }}</span>
                                    </div>
                                    <div class="space-y-1.5 text-xs">
                                        <div class="flex justify-between text-slate-600">
                                            <span>Paket Kursus:</span>
                                            <span class="font-bold text-slate-800">{{ $selectedSiswa['spp']['paket_biaya'] ?? 'Rp 12.500.000' }}</span>
                                        </div>
                                        <div class="flex justify-between text-slate-600">
                                            <span>Total Terbayar:</span>
                                            <span class="font-bold text-emerald-600">{{ $selectedSiswa['spp']['total_terbayar'] ?? 'Rp 12.500.000' }}</span>
                                        </div>
                                        <div class="flex justify-between text-slate-600 pt-1 border-t border-slate-200/60">
                                            <span>Tagihan Berikutnya:</span>
                                            <span class="font-bold text-slate-800">{{ $selectedSiswa['spp']['tagihan_berikutnya'] ?? 'Rp 0' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Data Orang Tua / Wali -->
                                <div class="p-3.5 rounded-xl bg-indigo-50/50 border border-indigo-100">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span class="font-bold text-slate-900">{{ $selectedSiswa['wali']['nama'] ?? 'Orang Tua' }}</span>
                                        <span class="text-[10px] font-bold text-indigo-600 bg-indigo-100/70 px-2 py-0.5 rounded">{{ $selectedSiswa['wali']['hubungan'] ?? 'Ayah Kandung' }}</span>
                                    </div>
                                    <div class="text-[11px] text-slate-600">
                                        Pekerjaan: {{ $selectedSiswa['wali']['pekerjaan'] ?? 'Wiraswasta' }}
                                    </div>
                                    <div class="text-[11px] text-slate-600">
                                        Email: {{ $selectedSiswa['wali']['email'] ?? 'wali@example.com' }}
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="space-y-2 pt-2">
                                    @if(!empty($selectedSiswa['wali']['phone']))
                                        <a href="https://wa.me/{{ $selectedSiswa['wali']['phone'] }}?text=Halo%20Bapak/Ibu%20{{ urlencode($selectedSiswa['wali']['nama'] ?? '') }},%20kami%20dari%20EduPulse%20Academy%20terkait%20siswa%20{{ urlencode($selectedSiswa['nama']) }}" target="_blank" class="w-full py-2.5 px-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs flex items-center justify-center gap-2 transition active:scale-95 shadow-sm shadow-emerald-200">
                                            <i class="fab fa-whatsapp"></i>
                                            <span>Hubungi Wali via WhatsApp</span>
                                        </a>
                                    @endif

                                    <div class="grid grid-cols-2 gap-2">
                                        <button type="button" onclick="showToast('Rapor diagnostik tryout {{ $selectedSiswa['nama'] }} siap diunduh.', 'info')" class="py-2 rounded-xl border border-slate-200 hover:bg-slate-50 font-bold text-xs text-slate-700 transition flex items-center justify-center gap-1.5">
                                            <i class="fas fa-chart-simple text-indigo-600 text-[11px]"></i>
                                            <span>Rapor Tryout</span>
                                        </button>
                                        <form action="{{ route('bimbel.siswa.destroy', $selectedSiswa['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                                            @csrf
                                            <button type="submit" class="w-full py-2 rounded-xl border border-rose-200 hover:bg-rose-50 font-bold text-xs text-rose-600 transition flex items-center justify-center gap-1.5">
                                                <i class="fas fa-trash text-[11px]"></i>
                                                <span>Hapus Siswa</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        @else
                            <!-- Empty State for 360 Profile -->
                            <div class="py-20 px-4 text-center border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 flex flex-col items-center justify-center">
                                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-xl mb-3 shadow-sm">
                                    <i class="fas fa-id-card-clip"></i>
                                </div>
                                <h4 class="font-heading font-bold text-sm text-slate-800">Pilih Siswa untuk Melihat Detail 360°</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-xs leading-relaxed">
                                    Informasi target PTN impian, riwayat absensi, status cicilan SPP, dan kontak orang tua/wali akan tampil di panel ini saat siswa dipilih.
                                </p>
                                <button type="button" onclick="openModalSiswa()" class="mt-4 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition">
                                    <i class="fas fa-plus mr-1.5"></i> + Input Siswa Baru
                                </button>
                            </div>
                        @endif

                    </div>

                </div>

            </main>

        </div>

    </div>

    <!-- ============================================================== -->
    <!-- MODALS & POPUPS                                                -->
    <!-- ============================================================== -->

    <!-- Modal Daftarkan Siswa Baru -->
    <div id="modalSiswa" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-xl w-full p-6 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-user-plus text-sm"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-base text-slate-900">Input Data Siswa Baru (Direktori)</h3>
                        <p class="text-[11px] text-slate-400">EduPulse Academy &bull; Profil Akademik Lengkap</p>
                    </div>
                </div>
                <button type="button" onclick="closeModalSiswa()" class="text-slate-400 hover:text-slate-600 text-sm p-1">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('bimbel.siswa.store') }}" method="POST" class="mt-4 space-y-3.5">
                @csrf
                
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Siswa</label>
                        <input type="text" name="nama" required placeholder="Contoh: Dimas Arya Putra" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">NIS (Nomor Induk Siswa)</label>
                        <input type="text" name="nis" placeholder="Auto-generate jika kosong" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Asal Sekolah</label>
                        <input type="text" name="sekolah" required placeholder="Contoh: SMAN 8 Jakarta" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Program Kursus / Bimbel</label>
                        <select name="program" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="12 IPA - Super Intensif SNBT 2025">12 IPA - Super Intensif SNBT 2025</option>
                            <option value="Kedokteran Excellence (Private 1-on-1)">Kedokteran Excellence (Private 1-on-1)</option>
                            <option value="Olimpiade Sains (OSN) Biologi">Olimpiade Sains (OSN) Biologi</option>
                            <option value="English Mastery & SAT Prep">English Mastery & SAT Prep</option>
                            <option value="Target Kedinasan (STIS & STAN)">Target Kedinasan (STIS & STAN)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Ruang Studio / Kelas</label>
                        <input type="text" name="kelas_ruang" placeholder="Contoh: Ruang Newton (Lantai 2)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Belajar</label>
                        <select name="status" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50">
                            <option value="Aktif">Aktif</option>
                            <option value="Cuti Ujian">Cuti Ujian</option>
                            <option value="Verifikasi Berkas">Verifikasi Berkas</option>
                        </select>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-indigo-50/40 border border-indigo-100 space-y-2">
                    <span class="text-xs font-extrabold text-indigo-700 block">Target PTN Impian:</span>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <input type="text" name="target_kampus_1" placeholder="Pilihan 1: Kampus (contoh: UI)" class="px-3 py-2 rounded-lg border border-slate-200 bg-white">
                        <input type="text" name="target_jurusan_1" placeholder="Pilihan 1: Jurusan (contoh: Teknik Elektro)" class="px-3 py-2 rounded-lg border border-slate-200 bg-white">
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <input type="text" name="target_kampus_2" placeholder="Pilihan 2: Kampus (contoh: ITB)" class="px-3 py-2 rounded-lg border border-slate-200 bg-white">
                        <input type="text" name="target_jurusan_2" placeholder="Pilihan 2: Jurusan (contoh: STEI)" class="px-3 py-2 rounded-lg border border-slate-200 bg-white">
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 space-y-2">
                    <span class="text-xs font-bold text-slate-800 block">Data Orang Tua / Wali:</span>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <input type="text" name="nama_wali" placeholder="Nama Orang Tua / Wali" class="px-3 py-2 rounded-lg border border-slate-200 bg-white">
                        <input type="text" name="phone_wali" placeholder="No WhatsApp (08xxxxxxxxxx)" class="px-3 py-2 rounded-lg border border-slate-200 bg-white">
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalSiswa()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 transition">
                        Simpan ke Direktori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Broadcast Info Siswa -->
    <div id="modalBroadcast" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-slate-100 toast-slide">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <i class="fas fa-bullhorn text-indigo-600"></i>
                    <h3 class="font-heading font-extrabold text-base text-slate-900">Broadcast Info Siswa</h3>
                </div>
                <button type="button" onclick="closeModalBroadcast()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <div class="py-3 text-xs space-y-3">
                <p class="text-slate-500 leading-relaxed">
                    Kirim pengumuman penting atau instruksi tryout langsung ke seluruh nomor WhatsApp siswa & wali yang terdaftar.
                </p>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Isi Pesan Broadcast</label>
                    <textarea rows="4" placeholder="Tulis pesan Anda di sini..." class="w-full p-3 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-indigo-500 bg-slate-50"></textarea>
                </div>
            </div>
            <div class="pt-2 flex justify-end gap-2">
                <button type="button" onclick="closeModalBroadcast()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600">
                    Batal
                </button>
                <button type="button" onclick="kirimBroadcast()" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-sm">
                    Kirim Broadcast Sekarang
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
            toggleBranchModal();
            showToast(`Cabang operasional diubah ke: ${name}`, 'success');
        }

        // Modals
        function openModalSiswa() {
            document.getElementById('modalSiswa').classList.remove('hidden');
        }
        function closeModalSiswa() {
            document.getElementById('modalSiswa').classList.add('hidden');
        }

        function openModalBroadcast() {
            document.getElementById('modalBroadcast').classList.remove('hidden');
        }
        function closeModalBroadcast() {
            document.getElementById('modalBroadcast').classList.add('hidden');
        }

        function kirimBroadcast() {
            closeModalBroadcast();
            showToast('Pesan broadcast WhatsApp berhasil dikirim ke saluran siswa/wali.', 'success');
        }

        function exportDataSiswa() {
            showToast('Export data direktori siswa berhasil di-generate (Format Excel/PDF siap).', 'success');
        }

        function selectStudent(id) {
            const url = new URL(window.location.href);
            url.searchParams.set('id', id);
            window.location.href = url.toString();
        }

        // Filters
        function handleFilterKey(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        }

        function applyFilters() {
            const search = document.getElementById('filterSearch').value;
            const program = document.getElementById('filterProgram').value;
            const status = document.getElementById('filterStatus').value;
            const jenjang = document.getElementById('filterJenjang').value;

            const url = new URL(window.location.origin + window.location.pathname);
            if (search) url.searchParams.set('search', search);
            if (program && program !== 'semua') url.searchParams.set('program', program);
            if (status && status !== 'semua') url.searchParams.set('status', status);
            if (jenjang && jenjang !== 'semua') url.searchParams.set('jenjang', jenjang);

            window.location.href = url.toString();
        }

        // Reset Data
        function resetSemuaData() {
            if (confirm('Yakin ingin mereset seluruh data kembali ke kosong?')) {
                window.location.href = "{{ route('bimbel.reset') }}";
            }
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
