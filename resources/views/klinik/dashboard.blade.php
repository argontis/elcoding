<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Operasional Klinik — {{ $user->name ?? 'Klinik Utama' }}</title>
    <meta name="description" content="Sistem Informasi & Manajemen Antrean Pasien Klinik.">

    <!-- Fonts & Icons -->
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
                        clinic: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0284c7',
                            600: '#0369a1',
                            700: '#075985',
                            800: '#0c4a6e',
                            900: '#0f3a56',
                        },
                        tealmed: {
                            700: '#0e495a',
                            800: '#0a3a47',
                            900: '#062d38',
                            950: '#041f27',
                        },
                        darknavy: {
                            800: '#162b48',
                            850: '#112239',
                            900: '#0d1b2e',
                            950: '#091321',
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
            color: #0f172a;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        @keyframes pulseDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.2); }
        }
        .pulse-live { animation: pulseDot 2s infinite ease-in-out; }
    </style>
</head>
<body class="min-h-screen flex flex-col md:flex-row bg-slate-50 antialiased selection:bg-clinic-600 selection:text-white">

    <!-- ============================================================== -->
    <!-- DESKTOP SIDEBAR (HANYA 4 MENU UTAMA) -->
    <!-- ============================================================== -->
    <aside class="w-64 bg-darknavy-900 border-r border-slate-800 text-slate-300 flex flex-col fixed inset-y-0 left-0 z-30 transition-all duration-300 hidden md:flex">
        
        <!-- Logo & Brand Header -->
        <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80 bg-darknavy-950/70">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-cyan-600 to-teal-400 flex items-center justify-center text-white shadow-lg shadow-teal-500/20 font-black text-xl">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <div>
                    <div class="font-heading font-black text-lg tracking-tight text-white leading-tight">
                        KLINIK CARE<span class="text-teal-400">.</span>
                    </div>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 pulse-live"></span>
                        <span class="text-[11px] font-semibold text-emerald-400">Layanan Aktif</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profil Ringkas Klinik -->
        <div class="p-3.5 mx-4 my-4 rounded-xl bg-slate-800/60 border border-slate-700/60 flex items-center justify-between">
            <div class="flex items-center gap-2.5 overflow-hidden">
                <div class="w-9 h-9 rounded-lg bg-teal-500/20 border border-teal-400/30 flex items-center justify-center text-teal-300 font-bold shrink-0">
                    <i class="fa-solid fa-hospital-user text-sm"></i>
                </div>
                <div class="overflow-hidden">
                    <div class="text-xs font-bold text-white truncate max-w-[110px]">{{ $user->name ?? 'Klinik Utama' }}</div>
                    <div class="text-[10px] text-slate-400 truncate">Poli Umum & Spesialis</div>
                </div>
            </div>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 shrink-0">
                Online
            </span>
        </div>

        <!-- 4 MENU UTAMA PERSIS SESUAI PERMINTAAN -->
        <nav class="flex-1 px-4 py-2 space-y-2">
            <div class="px-3 pb-1 text-[11px] font-extrabold uppercase tracking-wider text-slate-400">MENU UTAMA</div>

            <!-- 1. DASHBOARD / BERANDA -->
            <button onclick="switchTab('dashboard')" id="nav-dashboard" class="w-full flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all bg-clinic-600 text-white shadow-md shadow-clinic-600/30">
                <i class="fa-solid fa-table-cells-large w-5 text-center text-base"></i>
                <span>Dashboard</span>
            </button>

            <!-- 2. ANTREAN (DENGAN BADGE) -->
            <button onclick="switchTab('antrean')" id="nav-antrean" class="w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition-all text-slate-300 hover:text-white hover:bg-slate-800/70">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-ticket-simple w-5 text-center text-base"></i>
                    <span>Antrean</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[11px] font-extrabold bg-teal-400 text-darknavy-950" id="badgeNavAntrean">0</span>
            </button>

            <!-- 3. PASIEN -->
            <button onclick="switchTab('pasien')" id="nav-pasien" class="w-full flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all text-slate-300 hover:text-white hover:bg-slate-800/70">
                <i class="fa-solid fa-id-badge w-5 text-center text-base"></i>
                <span>Pasien</span>
            </button>

            <!-- 4. KASIR -->
            <button onclick="switchTab('kasir')" id="nav-kasir" class="w-full flex items-center gap-3 px-3.5 py-3 rounded-xl text-sm font-semibold transition-all text-slate-300 hover:text-white hover:bg-slate-800/70">
                <i class="fa-solid fa-receipt w-5 text-center text-base"></i>
                <span>Kasir</span>
            </button>
        </nav>

        <!-- Sidebar Footer / Logout -->
        <div class="p-4 border-t border-slate-800/80 bg-darknavy-950/80">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2.5 px-4 py-2.5 rounded-xl text-xs font-bold text-rose-300 bg-rose-500/10 hover:bg-rose-500/20 border border-rose-500/20 transition-all">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ============================================================== -->
    <!-- MAIN WRAPPER -->
    <!-- ============================================================== -->
    <div class="flex-1 md:ml-64 flex flex-col min-h-screen pb-20 md:pb-6">

        <!-- TOP BAR PERSIS SEPERTI GAMBAR REFERENSI -->
        <header class="h-16 bg-white border-b border-slate-200/90 px-4 md:px-8 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            <!-- Left Header: Brand Icon & Clinic Selector -->
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-teal-700 text-white flex items-center justify-center font-bold text-base shadow-sm">
                    <i class="fa-solid fa-plus-minus text-xs"></i>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 hover:bg-slate-200 text-xs font-bold text-slate-700 cursor-pointer border border-slate-200 transition-all">
                            <span class="w-2 h-2 rounded-full bg-teal-600"></span>
                            <span>{{ $user->name ?? 'Klinik Utama Sehat' }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-400 ml-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Header: Search, Notification Bell, User Avatar -->
            <div class="flex items-center gap-3">
                <button class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-sm transition-all">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <div class="relative">
                    <button class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-sm transition-all">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-500 text-white text-[10px] font-black flex items-center justify-center border-2 border-white">
                        3
                    </span>
                </div>

                <div class="w-9 h-9 rounded-full bg-tealmed-900 text-white flex items-center justify-center text-sm font-bold shadow-xs">
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>
        </header>

        <!-- ============================================================== -->
        <!-- TAB 1: DASHBOARD / BERANDA (DEFAULT AKTIF, DATA KOSONG SIAP INPUT) -->
        <!-- ============================================================== -->
        <main id="tabContent-dashboard" class="flex-1 p-4 md:p-8 max-w-4xl mx-auto w-full space-y-4">
            
            <!-- 1. SHIFT & DOKTER PROFILE CARD -->
            <div class="rounded-3xl bg-gradient-to-br from-tealmed-900 via-tealmed-800 to-tealmed-950 text-white p-5 border border-teal-800/50 shadow-md space-y-3">
                <div class="flex items-center justify-between text-xs font-semibold">
                    <span class="text-cyan-200/90 text-[11px] font-bold">
                        SHIFT AKTIF &bull; 08:00 – 15:00 WIB
                    </span>
                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-white/10 text-cyan-200 border border-white/15">
                        &bull; Aktif
                    </span>
                </div>

                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-full bg-white/10 border-2 border-cyan-300/40 flex items-center justify-center font-bold text-lg text-cyan-200 shrink-0">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white leading-tight">{{ $user->name ?? 'Dokter Jaga' }}</h2>
                        <div class="text-xs text-cyan-200/80 mt-0.5">Klinik Utama Sudirman (Lantai 2)</div>
                    </div>
                </div>

                <div class="pt-2 border-t border-white/10 flex items-center justify-between text-xs">
                    <div class="flex items-center gap-2 text-cyan-200/90">
                        <i class="fa-solid fa-shield-halved text-cyan-300 text-xs"></i>
                        <span class="font-medium text-[11px]">Status Operasional Normal</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-bold bg-teal-500/20 text-cyan-200 border border-teal-400/30" id="dashPoliAktif">
                        1 Poli Aktif
                    </span>
                </div>
            </div>

            <!-- 2. 4 METRIC CARDS (GRID 2x2 — KOSONG SIAP INPUT) -->
            <div class="grid grid-cols-2 gap-3">
                <!-- Pasien Hari Ini -->
                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">Pasien Hari Ini</span>
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-clinic-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <div class="mt-2 flex items-baseline gap-1.5">
                        <span class="text-3xl font-black font-heading text-slate-900" id="dashStatPasien">0</span>
                        <span class="text-xs text-slate-400 font-medium">pasien</span>
                    </div>
                    <div class="mt-2 text-xs font-bold text-emerald-600 flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
                        <span id="dashStatPasienTrend">+0% vs kemarin</span>
                    </div>
                </div>

                <!-- Dalam Antrean -->
                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">Dalam Antrean</span>
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-clinic-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                    </div>
                    <div class="mt-2 flex items-baseline gap-1.5">
                        <span class="text-3xl font-black font-heading text-slate-900" id="dashStatAntrean">0</span>
                        <span class="text-xs text-slate-400 font-medium">menunggu</span>
                    </div>
                    <div class="mt-2 text-xs text-slate-400 font-medium flex items-center gap-1">
                        <i class="fa-regular fa-clock text-[11px]"></i>
                        <span id="dashStatAvgTunggu">Avg ~0 mnt</span>
                    </div>
                </div>

                <!-- Selesai Poli -->
                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">Selesai Poli</span>
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-clinic-600 flex items-center justify-center text-xs">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                    </div>
                    <div class="mt-2 flex items-baseline gap-1.5">
                        <span class="text-3xl font-black font-heading text-slate-900" id="dashStatSelesai">0</span>
                        <span class="text-xs text-slate-400 font-medium">/ <span id="dashStatTotalPoli">0</span> total</span>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-3">
                        <div class="bg-tealmed-900 h-full rounded-full transition-all duration-300" id="dashProgressBar" style="width: 0%;"></div>
                    </div>
                </div>

                <!-- Omset Kasir -->
                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-500">Omset Kasir</span>
                        <div class="w-8 h-8 rounded-xl bg-sky-50 text-clinic-600 flex items-center justify-center text-xs">
                            <i class="fa-solid fa-cash-register"></i>
                        </div>
                    </div>
                    <div class="mt-2 flex items-baseline gap-1.5">
                        <span class="text-2xl font-black font-heading text-slate-900" id="dashStatOmset">Rp 0</span>
                    </div>
                    <div class="mt-2">
                        <span class="px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-sky-100 text-clinic-800" id="dashStatTargetOmset">
                            0% Target
                        </span>
                    </div>
                </div>
            </div>

            <!-- 3. ALERT STOK FARMASI -->
            <div class="bg-white rounded-2xl p-3.5 sm:p-4 border border-slate-200/90 shadow-xs flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-sky-50 text-clinic-600 flex items-center justify-center text-base shrink-0">
                        <i class="fa-solid fa-prescription-bottle-medical"></i>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800 flex items-center gap-1.5">
                            <span id="dashStokTitle">Stok Farmasi Aman</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500" id="dashStokDot"></span>
                        </div>
                        <div class="text-[11px] text-slate-400 mt-0.5 truncate max-w-[200px] sm:max-w-xs" id="dashStokDesc">
                            Persediaan obat-obatan tercukupi
                        </div>
                    </div>
                </div>
                <button onclick="openModalTambahObat()" class="px-3.5 py-1.5 rounded-xl text-xs font-bold bg-sky-50 text-clinic-700 hover:bg-sky-100 border border-sky-100 shrink-0">
                    + Cek / Tambah Stok
                </button>
            </div>

            <!-- 4. AKSI CEPAT TIM MEDIS -->
            <div class="space-y-2.5 pt-1">
                <div class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">AKSI CEPAT TIM MEDIS</div>
                <div class="grid grid-cols-4 gap-2 text-center">
                    <button onclick="openModalTambahPasienRme()" class="flex flex-col items-center group">
                        <div class="w-14 h-14 rounded-full bg-tealmed-900 text-white flex items-center justify-center text-xl shadow-sm group-hover:scale-105 transition-all">
                            <i class="fa-solid fa-user-plus text-lg"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 mt-1.5">Daftar Pasien</span>
                    </button>

                    <button onclick="switchTab('antrean')" class="flex flex-col items-center group">
                        <div class="w-14 h-14 rounded-full bg-teal-700 text-white flex items-center justify-center text-xl shadow-sm group-hover:scale-105 transition-all">
                            <i class="fa-solid fa-bullhorn text-lg"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 mt-1.5">Panggil Antrean</span>
                    </button>

                    <button onclick="openModalJanjiTemu()" class="flex flex-col items-center group">
                        <div class="w-14 h-14 rounded-full bg-sky-100/70 text-clinic-700 flex items-center justify-center text-xl group-hover:scale-105 transition-all">
                            <i class="fa-regular fa-calendar-check text-lg"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 mt-1.5">Janji Temu</span>
                    </button>

                    <button onclick="switchTab('kasir')" class="flex flex-col items-center group">
                        <div class="w-14 h-14 rounded-full bg-sky-100/70 text-clinic-700 flex items-center justify-center text-xl group-hover:scale-105 transition-all">
                            <i class="fa-solid fa-cash-register text-lg"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-700 mt-1.5">Kasir & Billing</span>
                    </button>
                </div>
            </div>

            <!-- 5. SEDANG BERLANGSUNG -->
            <div class="space-y-2.5 pt-1">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs font-extrabold text-slate-800">
                        <span class="w-2 h-2 rounded-full bg-teal-600 pulse-live"></span>
                        <span>SEDANG BERLANGSUNG</span>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-sky-100 text-clinic-700">
                        Poli Umum &bull; Ruang 102
                    </span>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs space-y-3">
                    <div class="flex items-center gap-3.5">
                        <div class="w-14 h-14 rounded-2xl bg-tealmed-900 text-white flex flex-col items-center justify-center font-black shrink-0">
                            <span class="text-xs text-cyan-300 font-bold">A-</span>
                            <span class="text-2xl font-black leading-none" id="dashActiveQueueNum">--</span>
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-900" id="dashActivePatientName">Belum Ada Pasien Dilayani</div>
                            <div class="text-xs text-slate-400 mt-0.5" id="dashActivePatientRm">Silakan panggil antrean atau input pasien untuk memulai konsultasi</div>
                            <div class="text-xs text-teal-600 font-semibold mt-1 flex items-center gap-1.5" id="dashActivePatientEst">
                                <i class="fa-regular fa-clock"></i>
                                <span>Est. selesai: --:-- WIB</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2.5 pt-1">
                        <button onclick="openModalTambahPasienRme()" class="py-2.5 px-3 rounded-xl bg-sky-50 hover:bg-sky-100 text-clinic-700 border border-sky-100 text-xs font-bold flex items-center justify-center gap-1.5 transition-all">
                            <i class="fa-solid fa-file-medical text-xs"></i>
                            <span>+ Input Pasien</span>
                        </button>
                        <button onclick="panggilAntreanBerikutnya()" class="py-2.5 px-3 rounded-xl bg-tealmed-900 hover:bg-tealmed-950 text-white text-xs font-bold flex items-center justify-center gap-1.5 transition-all">
                            <i class="fa-solid fa-bell text-xs"></i>
                            <span id="dashBtnPanggilLanjut">Panggil Antrean</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 6. KETERSEDIAAN DOKTER JAGA -->
            <div class="space-y-2.5 pt-1">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">KETERSEDIAAN DOKTER JAGA</span>
                    <button onclick="openModalTambahDokter()" class="text-xs font-bold text-clinic-600 hover:underline flex items-center gap-1">
                        <i class="fa-solid fa-plus text-[10px]"></i> Tambah Dokter Jaga
                    </button>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs space-y-3" id="dashDokterContainer">
                    <div id="dashDokterEmpty" class="text-center py-6 text-slate-400">
                        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xl mx-auto mb-2">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-700">Belum Ada Dokter Jaga Hari Ini</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Klik tombol di atas untuk menambahkan jadwal dokter jaga.</p>
                        <button onclick="openModalTambahDokter()" class="mt-3 px-3.5 py-1.5 rounded-xl bg-tealmed-900 hover:bg-tealmed-950 text-white text-xs font-bold inline-flex items-center gap-1.5 shadow-xs">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            <span>+ Tambah Dokter Jaga</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- 7. AKTIVITAS TERKINI -->
            <div class="space-y-2.5 pt-1">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">AKTIVITAS TERKINI</span>
                    <span class="text-xs text-slate-400 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-teal-500"></span> Real-time sync
                    </span>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs space-y-3" id="dashAktivitasContainer">
                    <div id="dashAktivitasEmpty" class="text-center py-6 text-slate-400">
                        <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xl mx-auto mb-2">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <p class="text-xs font-bold text-slate-700">Belum Ada Aktivitas Hari Ini</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">Setiap pendaftaran pasien, panggilan antrean, dan pembayaran kasir yang Anda input akan tampil di sini secara realtime.</p>
                    </div>
                </div>
            </div>

        </main>


        <!-- ============================================================== -->
        <!-- TAB 2: TAMPILAN ANTREAN (KOSONG SIAP INPUT) -->
        <!-- ============================================================== -->
        <main id="tabContent-antrean" class="flex-1 p-4 md:p-8 max-w-4xl mx-auto w-full space-y-4 hidden">

            <!-- Card 1: Poliklinik & Dokter + Toggle Menerima Pasien -->
            <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <div>
                        <div class="text-[11px] font-semibold text-slate-400">Poliklinik & Dokter</div>
                        <div class="flex items-center gap-1.5 cursor-pointer font-bold text-slate-800 text-sm hover:text-teal-700">
                            <span id="activePoliTitle">Poli Umum &bull; {{ $user->name ?? 'dr. Dokter Jaga' }}</span>
                            <i class="fa-solid fa-chevron-down text-xs text-slate-400"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between sm:justify-end gap-3 pt-2 sm:pt-0 border-t sm:border-0 border-slate-100">
                    <span class="text-xs font-bold text-slate-600">Menerima Pasien</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="toggleMenerimaPasien" checked onchange="toggleStatusLayanan(this)" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-700"></div>
                    </label>
                </div>
            </div>

            <!-- Card 2: 4 Mini Stat Boxes (Total, Diperiksa, Menunggu, Selesai) -->
            <div class="grid grid-cols-4 gap-2.5 sm:gap-3.5">
                <div class="bg-sky-50/80 rounded-2xl p-3 sm:p-4 text-center border border-sky-100">
                    <div class="text-[11px] font-semibold text-slate-500">Total</div>
                    <div class="text-xl sm:text-2xl font-black font-heading text-slate-900 mt-0.5" id="antreanStatTotal">0</div>
                </div>
                <div class="bg-sky-50/80 rounded-2xl p-3 sm:p-4 text-center border border-sky-100">
                    <div class="text-[11px] font-semibold text-slate-500">Diperiksa</div>
                    <div class="text-xl sm:text-2xl font-black font-heading text-slate-900 mt-0.5" id="antreanStatDiperiksa">0</div>
                </div>
                <div class="bg-cyan-100/70 rounded-2xl p-3 sm:p-4 text-center border border-cyan-200">
                    <div class="text-[11px] font-semibold text-cyan-900">Menunggu</div>
                    <div class="text-xl sm:text-2xl font-black font-heading text-cyan-900 mt-0.5" id="antreanStatMenunggu">0</div>
                </div>
                <div class="bg-sky-50/80 rounded-2xl p-3 sm:p-4 text-center border border-sky-100">
                    <div class="text-[11px] font-semibold text-slate-500">Selesai</div>
                    <div class="text-xl sm:text-2xl font-black font-heading text-slate-900 mt-0.5" id="antreanStatSelesai">0</div>
                </div>
            </div>

            <!-- Card 3: NOMOR ANTREAN AKTIF -->
            <div class="rounded-3xl bg-gradient-to-br from-tealmed-900 via-tealmed-800 to-tealmed-950 text-white p-5 sm:p-6 shadow-xl border border-teal-800/40 relative overflow-hidden">
                <div class="flex items-center justify-between mb-4 text-xs font-semibold">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-cyan-200 border border-white/10 text-[11px]">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 pulse-live"></span>
                        <span id="activeRoomLabel">SEDANG DILAYANI DI RUANG 1</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 text-cyan-200/90 text-xs font-mono">
                        <i class="fa-regular fa-clock"></i>
                        <span id="liveTimeClock">--:--</span>
                    </span>
                </div>

                <!-- Nomor Antrean Aktif Besar -->
                <div class="text-center py-2">
                    <div class="text-[11px] font-bold tracking-widest text-cyan-300 uppercase">NOMOR ANTREAN AKTIF</div>
                    <div class="text-6xl sm:text-7xl font-black font-heading tracking-tight text-white my-1" id="activeQueueBigNumber">
                        ---
                    </div>
                </div>

                <!-- Detail Pasien Aktif Box -->
                <div class="mt-4 p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/10">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <div class="text-base sm:text-lg font-bold text-white flex items-center gap-2">
                                <span id="activePatientName">Belum Ada Pasien Dilayani</span>
                                <span class="text-xs text-cyan-200 font-normal" id="activePatientAge"></span>
                            </div>
                            <div class="text-xs text-cyan-200/80 mt-0.5" id="activePatientRm">
                                No. Rekam Medis: <span class="font-mono text-white">-</span>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-cyan-500/30 text-cyan-200 border border-cyan-400/30 shrink-0" id="activePatientType">
                            -
                        </span>
                    </div>

                    <div class="mt-3 pt-2.5 border-t border-white/10 text-xs text-cyan-100 flex items-center gap-2">
                        <i class="fa-solid fa-notes-medical text-cyan-300 text-sm"></i>
                        <span>Keluhan: <strong class="text-white font-semibold" id="activePatientComplaint">Silakan input antrean baru atau panggil antrean berikutnya</strong></span>
                    </div>
                </div>

                <!-- 3 Tombol Aksi: Panggil Ulang, Selesaikan, Lewati -->
                <div class="grid grid-cols-3 gap-2.5 sm:gap-3 mt-5">
                    <button onclick="handlePanggilUlang()" class="py-2.5 px-3 rounded-xl bg-white/15 hover:bg-white/25 border border-white/15 text-white text-xs font-bold flex items-center justify-center gap-2 transition-all">
                        <i class="fa-solid fa-bullhorn text-cyan-300"></i>
                        <span>Panggil Ulang</span>
                    </button>
                    <button onclick="handleSelesaikanAktif()" class="py-2.5 px-3 rounded-xl bg-cyan-300 hover:bg-cyan-200 text-tealmed-950 text-xs font-extrabold flex items-center justify-center gap-2 shadow-md transition-all">
                        <i class="fa-solid fa-circle-check text-tealmed-900"></i>
                        <span>Selesaikan</span>
                    </button>
                    <button onclick="handleLewatiAktif()" class="py-2.5 px-3 rounded-xl bg-white/15 hover:bg-white/25 border border-white/15 text-white text-xs font-bold flex items-center justify-center gap-2 transition-all">
                        <i class="fa-solid fa-forward-step text-cyan-300"></i>
                        <span>Lewati</span>
                    </button>
                </div>
            </div>

            <!-- Card 4: Antrean Selanjutnya Banner -->
            <div class="bg-tealmed-900 rounded-2xl p-3.5 sm:p-4 text-white flex items-center justify-between shadow-xs border border-teal-800">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-cyan-300 text-base shrink-0">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-cyan-300">ANTREAN SELANJUTNYA</div>
                        <div class="text-xs sm:text-sm font-bold text-white" id="nextQueueBannerText">Belum ada antrean menunggu</div>
                    </div>
                </div>
                <button onclick="panggilAntreanBerikutnya()" class="px-3.5 py-1.5 rounded-xl bg-white/20 hover:bg-white/30 text-white text-xs font-bold flex items-center gap-1.5 border border-white/20 transition-all">
                    <span>Panggil</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
            </div>

            <!-- Filter Tabs Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1">
                <button onclick="filterQueueList('semua')" id="btnFilterSemua" class="px-4 py-2 rounded-full text-xs font-bold bg-tealmed-900 text-white shrink-0">
                    Semua (<span id="countFilterSemua">0</span>)
                </button>
                <button onclick="filterQueueList('menunggu')" id="btnFilterMenunggu" class="px-4 py-2 rounded-full text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 shrink-0">
                    Menunggu (<span id="countFilterMenunggu">0</span>)
                </button>
                <button onclick="filterQueueList('dipanggil')" id="btnFilterDipanggil" class="px-4 py-2 rounded-full text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 shrink-0">
                    Dipanggil (<span id="countFilterDipanggil">0</span>)
                </button>
                <button onclick="filterQueueList('selesai')" id="btnFilterSelesai" class="px-4 py-2 rounded-full text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 shrink-0">
                    Selesai (<span id="countFilterSelesai">0</span>)
                </button>
                <button onclick="openInputAntreanModal()" class="ml-auto px-3.5 py-2 rounded-xl text-xs font-bold text-white bg-tealmed-900 hover:bg-tealmed-950 shrink-0 flex items-center gap-1.5 shadow-xs">
                    <i class="fa-solid fa-plus text-[10px]"></i> Input Antrean
                </button>
            </div>

            <!-- Section Header: Daftar Antrean Poli & Subtitle -->
            <div class="flex items-center justify-between pt-1">
                <h3 class="font-extrabold text-slate-900 text-sm">Daftar Antrean Poli</h3>
                <span class="text-xs text-slate-400 font-medium">Perkiraan Waktu Realtime</span>
            </div>

            <!-- List Cards Daftar Antrean Poli (KOSONG SIAP INPUT) -->
            <div class="space-y-3" id="queueCardsContainer">
                <div id="queueEmptyState" class="bg-white rounded-2xl p-8 border border-slate-200/90 shadow-xs text-center text-slate-400">
                    <div class="w-14 h-14 rounded-2xl bg-sky-50 text-clinic-600 flex items-center justify-center text-2xl mx-auto mb-3">
                        <i class="fa-solid fa-ticket-simple"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-800">Belum Ada Antrean Pasien Hari Ini</h4>
                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Silakan klik tombol "+ Input Antrean" di atas untuk menambahkan pasien ke antrean poli.</p>
                    <button onclick="openInputAntreanModal()" class="mt-4 px-4 py-2 rounded-xl bg-tealmed-900 hover:bg-tealmed-950 text-white text-xs font-bold inline-flex items-center gap-1.5 shadow-sm transition-all">
                        <i class="fa-solid fa-plus text-xs"></i>
                        <span>+ Input Antrean Pasien</span>
                    </button>
                </div>
            </div>

            <!-- Card 5: Monitor TV Ruang Tunggu Banner -->
            <div class="bg-sky-50 rounded-2xl p-4 border border-sky-100 flex items-center justify-between">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-tealmed-900 text-white flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-tv"></i>
                    </div>
                    <div>
                        <div class="text-xs font-extrabold text-slate-900">Monitor TV Ruang Tunggu</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Sinkronisasi layar antrean panggilan ruang poli</div>
                    </div>
                </div>
                <button onclick="bukaLayarMonitor()" class="px-4 py-2 rounded-xl bg-tealmed-900 hover:bg-tealmed-950 text-white text-xs font-bold flex items-center gap-2 shadow-xs transition-all">
                    <i class="fa-solid fa-desktop text-xs"></i>
                    <span>Buka Layar</span>
                </button>
            </div>

        </main>


        <!-- ============================================================== -->
        <!-- TAB 3: PASIEN / REKAM MEDIS (RME) — PERSIS GAMBAR REFERENSI -->
        <!-- ============================================================== -->
        <main id="tabContent-pasien" class="flex-1 p-4 md:p-8 max-w-4xl mx-auto w-full space-y-4 hidden">
            
            <!-- Header Rekam Medis (RME) & Standar SATUSEHAT Kemenkes RI -->
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-heading font-black text-slate-900">Rekam Medis (RME)</h2>
                    <div class="flex items-center gap-1.5 text-xs text-slate-500 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-teal-600"></span>
                        <span class="font-medium text-slate-600">Standar SATUSEHAT Kemenkes RI</span>
                    </div>
                </div>
                <button onclick="openModalTambahPasienRme()" class="px-4 py-2 rounded-xl bg-tealmed-900 hover:bg-tealmed-950 text-white text-xs font-bold flex items-center gap-2 shadow-sm transition-all">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    <span>+ Pasien Baru</span>
                </button>
            </div>

            <!-- Search Input Bar (dengan Barcode/Scan & Clear) -->
            <div class="relative flex items-center">
                <i class="fa-solid fa-magnifying-glass absolute left-4 text-slate-400 text-sm"></i>
                <input type="text" id="inputSearchRme" value="RM-2024-1102" onkeyup="handleFilterRme(this.value)" placeholder="Cari nama pasien, No. RM, atau NIK..." class="w-full pl-11 pr-20 py-3 rounded-2xl bg-white border border-slate-200/90 text-xs font-semibold text-slate-800 shadow-xs focus:ring-2 focus:ring-teal-600 focus:outline-none">
                <div class="absolute right-3 flex items-center gap-2 text-slate-400">
                    <button type="button" class="w-7 h-7 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-barcode"></i>
                    </button>
                    <button type="button" onclick="document.getElementById('inputSearchRme').value=''; handleFilterRme('');" class="w-6 h-6 rounded-full hover:bg-slate-100 flex items-center justify-center text-xs">
                        &times;
                    </button>
                </div>
            </div>

            <!-- Filter Pills Row -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs">
                <button class="px-4 py-2 rounded-full font-bold bg-tealmed-900 text-white shrink-0">
                    Semua (2.840)
                </button>
                <button class="px-4 py-2 rounded-full font-bold bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 shrink-0">
                    Umum
                </button>
                <button class="px-4 py-2 rounded-full font-bold bg-cyan-100 text-cyan-900 border border-cyan-200 shrink-0 flex items-center gap-1.5">
                    <i class="fa-solid fa-check text-[10px]"></i>
                    <span>BPJS Kesehatan</span>
                </button>
                <button class="px-4 py-2 rounded-full font-bold bg-white text-slate-700 border border-slate-200 hover:bg-slate-100 shrink-0">
                    Asuransi Swasta
                </button>
            </div>

            <!-- Total Pasien Terdaftar Summary Card -->
            <div class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-xl bg-sky-50 text-clinic-600 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="text-xl font-black font-heading text-slate-900">2.840</div>
                        <div class="text-[11px] font-medium text-slate-400">Total Pasien Terdaftar</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="inline-flex items-center gap-1.5 text-xs font-bold text-teal-600">
                        <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                        <span>+18 Baru</span>
                    </div>
                    <div class="text-[11px] font-medium text-slate-400">Minggu Ini</div>
                </div>
            </div>

            <!-- MAIN PATIENT DETAIL CARD (NY. RINA KUSUMA) -->
            <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/90 shadow-xs space-y-4" id="cardPatientDetail">
                
                <!-- Profil Pasien Header -->
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-3.5">
                        <div class="w-13 h-13 w-12 h-12 rounded-full bg-tealmed-900 text-white font-black text-sm flex items-center justify-center shrink-0 relative">
                            <span>RK</span>
                            <span class="absolute bottom-0 right-0 w-3.5 h-3.5 rounded-full bg-cyan-400 border-2 border-white"></span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base font-bold text-slate-900" id="rmePatientName">Ny. Rina Kusuma</h3>
                                <span class="text-xs text-slate-400 font-semibold" id="rmePatientAge">34 Th</span>
                            </div>
                            <div class="text-xs text-slate-400 mt-0.5">
                                <span class="font-mono" id="rmePatientRm">#RM-2024-1102</span> &bull; NIK: <span class="font-mono">3174****0003</span>
                            </div>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-clinic-700 border border-sky-200/70 shrink-0">
                        &bull; Aktif
                    </span>
                </div>

                <!-- Tags Row: BPJS Faskes 1, Gol. Darah O+ -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="px-3 py-1 rounded-xl text-xs font-bold bg-cyan-50 text-cyan-800 border border-cyan-200/60 inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved text-[11px] text-cyan-600"></i>
                        <span>BPJS Faskes 1</span>
                    </span>
                    <span class="px-3 py-1 rounded-xl text-xs font-bold bg-sky-50 text-clinic-800 border border-sky-200/60">
                        Gol. Darah: O+
                    </span>
                </div>

                <!-- Alert Alergi Penisilin (Penting!) -->
                <div class="px-4 py-2.5 rounded-xl bg-rose-50 border border-rose-200/80 text-rose-700 text-xs font-bold flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-rose-500"></i>
                    <span>Alergi Penisilin (Penting!)</span>
                </div>

                <!-- Sub-Tabs: Catatan SOAP, Resep & Obat, Hasil Lab -->
                <div class="flex items-center gap-2 border-b border-slate-100 pb-2 text-xs font-bold">
                    <button class="px-3 py-1.5 rounded-xl bg-slate-100 text-slate-800 flex items-center gap-1.5 border border-slate-200">
                        <i class="fa-regular fa-clipboard text-slate-600"></i>
                        <span>Catatan SOAP</span>
                    </button>
                    <button class="px-3 py-1.5 rounded-xl text-slate-500 hover:bg-slate-50 flex items-center gap-1.5">
                        <i class="fa-solid fa-receipt text-slate-400"></i>
                        <span>Resep & Obat</span>
                    </button>
                    <button class="px-3 py-1.5 rounded-xl text-slate-500 hover:bg-slate-50 flex items-center gap-1.5">
                        <i class="fa-solid fa-flask text-slate-400"></i>
                        <span>Hasil Lab</span>
                    </button>
                </div>

                <!-- SOAP CLINICAL CARD (KOTAK DETAIL PEMERIKSAAN MEDIS) -->
                <div class="rounded-2xl bg-sky-50/60 border border-sky-100/90 p-4 sm:p-5 space-y-4">
                    
                    <!-- Doctor Header inside SOAP -->
                    <div class="flex items-start justify-between gap-3 pb-3 border-b border-sky-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-tealmed-900 text-white flex items-center justify-center text-sm shrink-0">
                                <i class="fa-solid fa-stethoscope"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">dr. Budi Pratama, Sp.PD</h4>
                                <div class="text-[11px] text-slate-500 mt-0.5">Poli Penyakit Dalam &bull; Rawat Jalan</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium shrink-0">
                            <i class="fa-regular fa-calendar"></i>
                            <span>15 Okt 2024</span>
                        </div>
                    </div>

                    <!-- S: Subjektif (Keluhan Utama) -->
                    <div>
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-800 mb-1">
                            <span class="w-5 h-5 rounded-md bg-tealmed-900 text-white flex items-center justify-center text-[10px] font-black">S</span>
                            <span>Subjektif (Keluhan Utama)</span>
                        </div>
                        <p class="text-xs text-slate-600 leading-relaxed pl-7">
                            Pasien mengeluh pusing berputar sejak 2 hari yang lalu secara intermiten. Terasa memberat saat bangun tidur, disertai mual tanpa muntah di pagi hari.
                        </p>
                    </div>

                    <!-- O: Objektif (Tanda Vital & Pemeriksaan Fisik) -->
                    <div>
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-800 mb-2">
                            <span class="w-5 h-5 rounded-md bg-tealmed-900 text-white flex items-center justify-center text-[10px] font-black">O</span>
                            <span>Objektif (Tanda Vital & Pemeriksaan Fisik)</span>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pl-7">
                            <div class="bg-white rounded-xl p-2.5 border border-sky-100 text-center">
                                <div class="text-[10px] text-slate-400 font-semibold">Tensi</div>
                                <div class="text-xs font-bold text-slate-900 mt-0.5">130/85</div>
                                <div class="text-[9px] text-slate-400">mmHg</div>
                            </div>
                            <div class="bg-white rounded-xl p-2.5 border border-sky-100 text-center">
                                <div class="text-[10px] text-slate-400 font-semibold">Nadi</div>
                                <div class="text-xs font-bold text-slate-900 mt-0.5">82</div>
                                <div class="text-[9px] text-slate-400">x/mnt</div>
                            </div>
                            <div class="bg-white rounded-xl p-2.5 border border-sky-100 text-center">
                                <div class="text-[10px] text-slate-400 font-semibold">Suhu</div>
                                <div class="text-xs font-bold text-slate-900 mt-0.5">36.8°</div>
                                <div class="text-[9px] text-slate-400">Celcius</div>
                            </div>
                            <div class="bg-white rounded-xl p-2.5 border border-sky-100 text-center">
                                <div class="text-[10px] text-slate-400 font-semibold">SpO2</div>
                                <div class="text-xs font-bold text-teal-600 mt-0.5">98%</div>
                                <div class="text-[9px] text-slate-400">Normal</div>
                            </div>
                        </div>
                    </div>

                    <!-- A: Asesmen (Diagnosis Kerja) -->
                    <div>
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-800 mb-1.5">
                            <span class="w-5 h-5 rounded-md bg-tealmed-900 text-white flex items-center justify-center text-[10px] font-black">A</span>
                            <span>Asesmen (Diagnosis Kerja)</span>
                        </div>
                        <div class="pl-7 space-y-1.5">
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                                <span>Vertigo Perifer</span>
                                <span class="px-2 py-0.5 rounded-md bg-sky-100 text-clinic-700 text-[10px] font-mono border border-sky-200">ICD-10: H81.3</span>
                            </div>
                            <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                                <span>Dispepsia Fungsional</span>
                                <span class="px-2 py-0.5 rounded-md bg-sky-100 text-clinic-700 text-[10px] font-mono border border-sky-200">ICD-10: K30</span>
                            </div>
                        </div>
                    </div>

                    <!-- P: Plan (Terapi & Instruksi) -->
                    <div>
                        <div class="flex items-center gap-2 text-xs font-bold text-slate-800 mb-1.5">
                            <span class="w-5 h-5 rounded-md bg-tealmed-900 text-white flex items-center justify-center text-[10px] font-black">P</span>
                            <span>Plan (Terapi & Instruksi)</span>
                        </div>
                        <div class="pl-7 space-y-2 text-xs text-slate-600">
                            <div class="flex items-start gap-2">
                                <i class="fa-solid fa-capsules text-clinic-600 mt-0.5"></i>
                                <span><strong class="text-slate-800">Betahistine Mesylate 6 mg:</strong> 3 x 1 tablet sesudah makan (10 hari).</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <i class="fa-solid fa-capsules text-clinic-600 mt-0.5"></i>
                                <span><strong class="text-slate-800">Domperidone 10 mg:</strong> 3 x 1 tablet 15 menit a.c. (prn jika mual).</span>
                            </div>
                            <div class="flex items-start gap-2 text-slate-500">
                                <i class="fa-solid fa-circle-info text-amber-500 mt-0.5"></i>
                                <span>Edukasi hindari perubahan posisi kepala mendadak, cukupi cairan 2L/hari. Kontrol ulang bila 5 hari keluhan menetap.</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Tombol Aksi SOAP & Pasien -->
                <div class="space-y-2.5 pt-2">
                    <button onclick="openModalTambahSoap()" class="w-full py-3 rounded-2xl bg-tealmed-900 hover:bg-tealmed-950 text-white text-xs font-bold flex items-center justify-center gap-2 shadow-sm transition-all">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Tulis Catatan SOAP Baru</span>
                    </button>

                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="alert('Mengirim pesan WhatsApp pengingat kontrol ke pasien.')" class="py-2.5 px-3 rounded-xl bg-cyan-50 hover:bg-cyan-100 text-cyan-800 border border-cyan-200/80 text-xs font-bold flex items-center justify-center gap-2 transition-all">
                            <i class="fa-brands fa-whatsapp text-sm text-emerald-600"></i>
                            <span>Kirim WA Kontrol</span>
                        </button>
                        <button onclick="window.print()" class="py-2.5 px-3 rounded-xl bg-sky-50 hover:bg-sky-100 text-clinic-800 border border-sky-200/80 text-xs font-bold flex items-center justify-center gap-2 transition-all">
                            <i class="fa-solid fa-print text-sm text-clinic-600"></i>
                            <span>Cetak Resume</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- SECTION: PASIEN TERAKHIR DIKUNJUNGI -->
            <div class="space-y-3 pt-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                        <i class="fa-solid fa-user-clock text-slate-400"></i>
                        <span>Pasien Terakhir Dikunjungi</span>
                    </div>
                    <button class="text-xs font-bold text-clinic-600 hover:underline">Lihat Semua</button>
                </div>

                <div class="space-y-2.5">
                    <!-- Item 1: Tn. Bambang Irawan -->
                    <div onclick="pilihPasienRme('Tn. Bambang Irawan', '45 Th', 'RM-2024-1101')" class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs flex items-center justify-between hover:bg-slate-50/80 cursor-pointer transition-all">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-full bg-slate-100 text-slate-600 font-bold text-xs flex items-center justify-center shrink-0">
                                BI
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900">Tn. Bambang Irawan <span class="text-[11px] text-slate-400 font-normal">45 Th</span></div>
                                <div class="text-[11px] text-slate-400 mt-0.5">#RM-2024-1101 &bull; Kontrol Hipertensi R...</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-slate-800">09:15</div>
                            <div class="text-[10px] text-slate-400">Hari ini</div>
                        </div>
                    </div>

                    <!-- Item 2: An. Keisha Aurelia -->
                    <div onclick="pilihPasienRme('An. Keisha Aurelia', '5 Th', 'RM-2024-1100')" class="bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs flex items-center justify-between hover:bg-slate-50/80 cursor-pointer transition-all">
                        <div class="flex items-center gap-3.5">
                            <div class="w-11 h-11 rounded-full bg-cyan-100 text-cyan-800 font-bold text-xs flex items-center justify-center shrink-0">
                                KA
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900">An. Keisha Aurelia <span class="text-[11px] text-slate-400 font-normal">5 Th</span></div>
                                <div class="text-[11px] text-slate-400 mt-0.5">#RM-2024-1100 &bull; Imunisasi DPT Lanj...</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-slate-800">08:30</div>
                            <div class="text-[10px] text-slate-400">Hari ini</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SINKRONISASI RME SATUSEHAT BANNER (BAWAH) -->
            <div class="bg-tealmed-900 rounded-2xl p-3.5 px-4 text-white flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-arrows-rotate text-cyan-300 text-sm"></i>
                    <span class="text-xs font-bold">Sinkronisasi RME SatuSehat Terverifikasi</span>
                </div>
                <i class="fa-solid fa-circle-check text-cyan-300 text-base"></i>
            </div>

        </main>


        <!-- ============================================================== -->
        <!-- TAB 4: KASIR & BILLING — PERSIS GAMBAR REFERENSI -->
        <!-- ============================================================== -->
        <main id="tabContent-kasir" class="flex-1 p-4 md:p-8 max-w-4xl mx-auto w-full space-y-4 hidden">
            
            <!-- Card 1: Invoice Header & Pasien Info -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs space-y-3">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                        <i class="fa-regular fa-newspaper text-slate-400"></i>
                        <span class="font-mono">#INV/20241018/0042</span>
                    </div>
                    <span class="px-3 py-1 rounded-full text-[11px] font-semibold bg-sky-50 text-clinic-700 border border-sky-100">
                        18 Okt 2024 &bull; 10:18
                    </span>
                </div>

                <div class="flex items-start justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-bold text-slate-900">Tn. Hendra Wijaya</h3>
                            <span class="text-xs text-slate-400 font-normal">(42 Th)</span>
                        </div>
                        <div class="text-xs text-slate-400 mt-0.5">
                            No. RM: <span class="font-mono text-slate-700 font-bold">RM-2024-0891</span>
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-slate-600 font-medium mt-1.5">
                            <i class="fa-solid fa-stethoscope text-teal-600 text-xs"></i>
                            <span>dr. Budi Pratama, Sp.PD</span>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-xl text-xs font-bold bg-cyan-50 text-cyan-800 border border-cyan-200/70 shrink-0">
                        Mandiri (Umum)
                    </span>
                </div>
            </div>

            <!-- Card 2: Rincian Tagihan Klinis -->
            <div class="bg-white rounded-2xl p-4 sm:p-5 border border-slate-200/90 shadow-xs space-y-3.5">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2.5">
                    <div class="flex items-center gap-2 text-xs font-bold text-slate-800">
                        <i class="fa-regular fa-rectangle-list text-slate-400"></i>
                        <span>Rincian Tagihan Klinis</span>
                    </div>
                    <span class="text-xs text-slate-400 font-medium">5 Item Tindakan & Obat</span>
                </div>

                <!-- Item 1: Konsultasi Spesialis -->
                <div class="flex items-start justify-between gap-3 text-xs">
                    <div>
                        <div class="font-bold text-slate-800">Konsultasi Spesialis Penyakit Dalam</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Jasa Medis &bull; 1x Sesi</div>
                    </div>
                    <div class="font-bold text-slate-900 shrink-0">Rp 150.000</div>
                </div>

                <!-- Item 2: Pemeriksaan Gula Darah -->
                <div class="flex items-start justify-between gap-3 text-xs">
                    <div>
                        <div class="font-bold text-slate-800">Pemeriksaan Gula Darah (GDS Rapid)</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Laboratorium Cepat &bull; Strip Reagen</div>
                    </div>
                    <div class="font-bold text-slate-900 shrink-0">Rp 45.000</div>
                </div>

                <!-- Item 3: Sub-Box Resep Farmasi Terverifikasi -->
                <div class="rounded-2xl bg-sky-50/70 border border-sky-100/90 p-3.5 space-y-2 text-xs">
                    <div class="flex items-center gap-2 font-bold text-slate-800 border-b border-sky-100 pb-2">
                        <i class="fa-solid fa-prescription-bottle-medical text-clinic-600"></i>
                        <span>Resep Farmasi Terverifikasi</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-700">
                        <span>Paracetamol 500mg <span class="text-slate-400 text-[11px]">(10 Tab)</span></span>
                        <span class="font-semibold text-slate-800">Rp 15.000</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-700">
                        <span>Cefixime 200mg <span class="text-slate-400 text-[11px]">(10 Kapsul)</span></span>
                        <span class="font-semibold text-slate-800">Rp 85.000</span>
                    </div>
                    <div class="flex items-center justify-between text-slate-700">
                        <span>Ambroxol 30mg <span class="text-slate-400 text-[11px]">(10 Tab)</span></span>
                        <span class="font-semibold text-slate-800">Rp 18.000</span>
                    </div>
                </div>

                <!-- Item 4: Administrasi Rekam Medis -->
                <div class="flex items-start justify-between gap-3 text-xs">
                    <div>
                        <div class="font-bold text-slate-800">Administrasi Rekam Medis & Layanan</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">Biaya operasional & arsip rekam digital</div>
                    </div>
                    <div class="font-bold text-slate-900 shrink-0">Rp 10.000</div>
                </div>

                <!-- Item 5: Diskon Member Klinik -->
                <div class="flex items-start justify-between gap-3 text-xs p-2.5 rounded-xl bg-cyan-50/60 border border-cyan-100/80">
                    <div class="flex items-start gap-2">
                        <i class="fa-solid fa-tag text-cyan-600 mt-0.5"></i>
                        <div>
                            <div class="font-bold text-cyan-900">Diskon Member Klinik</div>
                            <div class="text-[11px] text-cyan-700 mt-0.5">Promo Bulan Sehat Aktif</div>
                        </div>
                    </div>
                    <div class="font-bold text-teal-700 shrink-0">- Rp 23.000</div>
                </div>

                <!-- Kalkulasi Total Tagihan Box -->
                <div class="rounded-2xl bg-sky-50/80 border border-sky-100 p-4 space-y-2 text-xs">
                    <div class="flex items-center justify-between text-slate-600">
                        <span>Subtotal Tindakan & Obat</span>
                        <span class="font-semibold text-slate-800">Rp 323.000</span>
                    </div>
                    <div class="flex items-center justify-between text-teal-700 font-semibold">
                        <span>Potongan Hemat</span>
                        <span>- Rp 23.000</span>
                    </div>
                    <div class="pt-2 border-t border-sky-200/60 flex items-baseline justify-between">
                        <div>
                            <div class="text-[10px] font-black uppercase tracking-wider text-slate-500">TOTAL TAGIHAN</div>
                            <div class="text-[10px] text-slate-400">Nett PPN 0% Medis</div>
                        </div>
                        <div class="text-2xl font-black font-heading text-darknavy-900" id="kasirTotalAmountDisplay">
                            Rp 300.000
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Metode Pembayaran -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-extrabold text-slate-800">Metode Pembayaran</h3>
                    <span class="text-xs font-bold text-teal-600 flex items-center gap-1">
                        <i class="fa-solid fa-bolt text-[11px]"></i> Instan
                    </span>
                </div>

                <!-- 4 Metode Grid 2x2 -->
                <div class="grid grid-cols-2 gap-3 text-left">
                    <!-- 1. QRIS Dinamis (Active) -->
                    <button onclick="pilihMetodeKasir('qris')" id="btnMetode-qris" class="p-3 rounded-2xl bg-tealmed-900 text-white border-2 border-tealmed-900 flex items-center gap-3 shadow-sm transition-all">
                        <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center text-cyan-300 text-base shrink-0">
                            <i class="fa-solid fa-qrcode"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-xs font-bold leading-tight truncate">QRIS Dinamis</div>
                            <div class="text-[10px] text-cyan-200/80 truncate">E-Wallet & M-Ba...</div>
                        </div>
                    </button>

                    <!-- 2. Tunai / Kasir -->
                    <button onclick="pilihMetodeKasir('tunai')" id="btnMetode-tunai" class="p-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 flex items-center gap-3 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 text-base shrink-0">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-xs font-bold leading-tight truncate">Tunai / Kasir</div>
                            <div class="text-[10px] text-slate-400 truncate">Input uang fisik</div>
                        </div>
                    </button>

                    <!-- 3. Virtual Account -->
                    <button onclick="pilihMetodeKasir('va')" id="btnMetode-va" class="p-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 flex items-center gap-3 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 text-base shrink-0">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-xs font-bold leading-tight truncate">Virtual Account</div>
                            <div class="text-[10px] text-slate-400 truncate">BCA, Mandiri, BRI</div>
                        </div>
                    </button>

                    <!-- 4. Kartu EDC -->
                    <button onclick="pilihMetodeKasir('edc')" id="btnMetode-edc" class="p-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 flex items-center gap-3 transition-all">
                        <div class="w-9 h-9 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 text-base shrink-0">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-xs font-bold leading-tight truncate">Kartu EDC</div>
                            <div class="text-[10px] text-slate-400 truncate">Debit & Kartu Kre...</div>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Panel QRIS Dinamis (PERSIS GAMBAR) -->
            <div id="panelMetode-qris" class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-xs space-y-4 text-center">
                <div class="flex items-center justify-between text-xs">
                    <span class="px-2.5 py-0.5 rounded-md bg-rose-600 text-white font-black tracking-wider text-[11px]">
                        QRIS
                    </span>
                    <span class="text-slate-600 font-bold text-[11px]">Standar Pembayaran Nasional</span>
                    <span class="text-[10px] font-mono text-slate-400">NMID: ID102024098129</span>
                </div>

                <!-- QR CODE GRAPHIC -->
                <div class="py-2 flex flex-col items-center justify-center">
                    <div class="p-4 bg-white rounded-2xl border-2 border-slate-800 shadow-sm inline-block">
                        <!-- Stylized QR SVG -->
                        <svg class="w-48 h-48 sm:w-52 sm:h-52 text-darknavy-900" viewBox="0 0 200 200" fill="currentColor">
                            <!-- Corner 1 -->
                            <rect x="10" y="10" width="55" height="55" rx="10" fill="#0c2338"/>
                            <rect x="22" y="22" width="31" height="31" rx="4" fill="#ffffff"/>
                            <rect x="29" y="29" width="17" height="17" rx="3" fill="#0c2338"/>
                            <!-- Corner 2 -->
                            <rect x="135" y="10" width="55" height="55" rx="10" fill="#0c2338"/>
                            <rect x="147" y="22" width="31" height="31" rx="4" fill="#ffffff"/>
                            <rect x="154" y="29" width="17" height="17" rx="3" fill="#0c2338"/>
                            <!-- Corner 3 -->
                            <rect x="10" y="135" width="55" height="55" rx="10" fill="#0c2338"/>
                            <rect x="22" y="147" width="31" height="31" rx="4" fill="#ffffff"/>
                            <rect x="29" y="154" width="17" height="17" rx="3" fill="#0c2338"/>
                            <!-- Patterns & Dots -->
                            <rect x="75" y="15" width="14" height="24" rx="2" fill="#0c2338"/>
                            <rect x="95" y="15" width="28" height="14" rx="2" fill="#0c2338"/>
                            <rect x="15" y="75" width="24" height="14" rx="2" fill="#0c2338"/>
                            <rect x="15" y="95" width="14" height="28" rx="2" fill="#0c2338"/>
                            <rect x="75" y="48" width="14" height="14" rx="2" fill="#0c2338"/>
                            <rect x="100" y="38" width="22" height="14" rx="2" fill="#0c2338"/>
                            <!-- Center logo -->
                            <rect x="80" y="80" width="40" height="40" rx="8" fill="#0c2338"/>
                            <path d="M92 100 L98 106 L108 94" stroke="#ffffff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                            <!-- Bottom Right pattern -->
                            <rect x="135" y="75" width="14" height="14" rx="2" fill="#0c2338"/>
                            <rect x="160" y="75" width="28" height="14" rx="2" fill="#0c2338"/>
                            <rect x="135" y="100" width="14" height="35" rx="2" fill="#0c2338"/>
                            <rect x="160" y="100" width="25" height="14" rx="2" fill="#0c2338"/>
                            <rect x="75" y="135" width="40" height="14" rx="2" fill="#0c2338"/>
                            <rect x="75" y="160" width="20" height="25" rx="2" fill="#0c2338"/>
                            <rect x="105" y="160" width="30" height="25" rx="2" fill="#0c2338"/>
                            <rect x="145" y="145" width="45" height="20" rx="2" fill="#0c2338"/>
                        </svg>
                    </div>

                    <!-- Nominal Pas Pill -->
                    <div class="mt-3">
                        <span class="px-5 py-1.5 rounded-full bg-darknavy-900 text-white font-extrabold text-xs shadow-xs tracking-wide">
                            Nominal Pas: Rp 300.000
                        </span>
                    </div>
                </div>

                <!-- Status Pemindaian & Countdown Timer -->
                <div class="text-xs space-y-1">
                    <div class="font-bold text-slate-800 flex items-center justify-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-teal-500 pulse-live"></span>
                        <span>Menunggu Pemindaian Pasien...</span>
                    </div>
                    <div class="text-slate-400 font-medium">
                        Berlaku hingga: <span class="text-rose-600 font-mono font-bold" id="countdownKasir">04:54</span> detik
                    </div>
                </div>

                <!-- Provider Support Footer -->
                <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-[11px] text-slate-500 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-shield-halved text-slate-400"></i>
                    <span>Didukung GoPay, OVO, Dana, BCA Mobile, Livin, dll.</span>
                </div>
            </div>

            <!-- Panel Tunai (Hidden by Default) -->
            <div id="panelMetode-tunai" class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-xs space-y-3 hidden">
                <h4 class="text-xs font-bold text-slate-800">Pembayaran Tunai di Meja Kasir</h4>
                <div>
                    <label class="block text-[11px] font-bold text-slate-500 mb-1">Nominal Uang Diterima (Rp)</label>
                    <input type="number" id="inUangTunai" value="300000" onkeyup="hitungKembalian(this.value)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-bold">
                </div>
                <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Kembalian:</span>
                    <span class="font-black text-emerald-600 text-sm" id="displayKembalian">Rp 0</span>
                </div>
            </div>

            <!-- Action Buttons: Konfirmasi & Proses Pembayaran -->
            <div class="space-y-2.5 pt-1">
                <button onclick="handleKonfirmasiPembayaran()" class="w-full py-3.5 rounded-2xl bg-tealmed-900 hover:bg-tealmed-950 text-white text-xs font-bold flex items-center justify-center gap-2 shadow-md transition-all">
                    <i class="fa-regular fa-circle-check text-base"></i>
                    <span>Konfirmasi & Proses Pembayaran</span>
                </button>

                <div class="grid grid-cols-2 gap-3">
                    <button onclick="alert('Mengirim invoice dan rincian resep obat ke WhatsApp pasien.')" class="py-2.5 px-3 rounded-xl bg-cyan-50 hover:bg-cyan-100 text-cyan-800 border border-cyan-200/80 text-xs font-bold flex items-center justify-center gap-2 transition-all">
                        <i class="fa-brands fa-whatsapp text-sm text-emerald-600"></i>
                        <span>Kirim Resep via WA</span>
                    </button>
                    <button onclick="window.print()" class="py-2.5 px-3 rounded-xl bg-sky-50 hover:bg-sky-100 text-clinic-800 border border-sky-200/80 text-xs font-bold flex items-center justify-center gap-2 transition-all">
                        <i class="fa-solid fa-print text-sm text-clinic-600"></i>
                        <span>Cetak Thermal POS</span>
                    </button>
                </div>
            </div>

        </main>


    </div>

    <!-- ============================================================== -->
    <!-- MOBILE / RESPONSIVE BOTTOM NAVBAR (HANYA 4 MENU UTAMA) -->
    <!-- ============================================================== -->
    <div class="md:hidden fixed bottom-0 inset-x-0 bg-white border-t border-slate-200 py-2 px-4 flex items-center justify-around z-40 shadow-lg">
        <button onclick="switchTab('dashboard')" id="bnav-dashboard" class="flex flex-col items-center gap-1 text-slate-400 text-xs font-semibold">
            <i class="fa-solid fa-table-cells-large text-lg"></i>
            <span>Beranda</span>
        </button>

        <button onclick="switchTab('antrean')" id="bnav-antrean" class="flex flex-col items-center gap-1 text-teal-700 text-xs font-bold relative">
            <span class="relative">
                <i class="fa-solid fa-ticket-simple text-lg"></i>
                <span class="absolute -top-1.5 -right-2.5 w-4 h-4 rounded-full bg-teal-600 text-white text-[9px] font-bold flex items-center justify-center">6</span>
            </span>
            <span>Antrean</span>
        </button>

        <button onclick="switchTab('pasien')" id="bnav-pasien" class="flex flex-col items-center gap-1 text-slate-400 text-xs font-semibold">
            <i class="fa-solid fa-id-badge text-lg"></i>
            <span>Pasien</span>
        </button>

        <button onclick="switchTab('kasir')" id="bnav-kasir" class="flex flex-col items-center gap-1 text-slate-400 text-xs font-semibold">
            <i class="fa-solid fa-receipt text-lg"></i>
            <span>Kasir</span>
        </button>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: INPUT / TAMBAH ANTREAN PASIEN BARU -->
    <!-- ============================================================== -->
    <div id="modalInputAntrean" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl border border-slate-200 overflow-hidden animate-in fade-in zoom-in duration-150">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-tealmed-900 text-white flex items-center justify-center text-sm">
                        <i class="fa-solid fa-ticket-simple"></i>
                    </div>
                    <h3 class="font-heading font-bold text-slate-800 text-base">Input Antrean Pasien</h3>
                </div>
                <button onclick="closeInputAntreanModal()" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
            </div>

            <form onsubmit="handleFormInputAntrean(event)" class="p-6 space-y-3.5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Antrean *</label>
                    <input type="text" id="inAntreanNo" required placeholder="Contoh: A-028" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Pasien *</label>
                    <input type="text" id="inNamaPasien" required placeholder="Contoh: Siti Rahma" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Usia Pasien</label>
                        <input type="text" id="inUsiaPasien" placeholder="Contoh: 29 Th" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Jaminan</label>
                        <select id="inJenisJaminan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs bg-white focus:ring-2 focus:ring-teal-500 focus:outline-none">
                            <option value="Pasien Umum">Pasien Umum</option>
                            <option value="BPJS Kesehatan">BPJS Kesehatan</option>
                            <option value="Prioritas Anak">Prioritas Anak</option>
                            <option value="Prioritas Lansia">Prioritas Lansia</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Perkiraan Waktu / Jam</label>
                    <input type="text" id="inEstWaktu" placeholder="Est. 11:15 WIB" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-500 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Keluhan Pasien</label>
                    <textarea id="inKeluhan" rows="2" placeholder="Keluhan utama pasien" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-500 focus:outline-none"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeInputAntreanModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-tealmed-900 hover:bg-tealmed-950 text-white shadow-md">Simpan ke Antrean</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- INTERACTIVE JAVASCRIPT LOGIC -->
    <!-- ============================================================== -->
    <script>
        // Update live clock
        function updateLiveClock() {
            const now = new Date();
            const clockEl = document.getElementById('liveTimeClock');
            if (clockEl) {
                clockEl.innerText = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            }
        }
        setInterval(updateLiveClock, 1000);
        updateLiveClock();

        // 4 TABS NAVIGATION LOGIC
        function switchTab(tabName) {
            const tabs = ['dashboard', 'antrean', 'pasien', 'kasir'];
            tabs.forEach(t => {
                const content = document.getElementById('tabContent-' + t);
                const navBtn = document.getElementById('nav-' + t);
                const bnavBtn = document.getElementById('bnav-' + t);

                if (t === tabName) {
                    if (content) content.classList.remove('hidden');
                    
                    // Desktop sidebar styling
                    if (navBtn) {
                        navBtn.className = "w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition-all bg-clinic-600 text-white shadow-md shadow-clinic-600/30";
                    }
                    // Mobile bottom nav styling
                    if (bnavBtn) {
                        bnavBtn.classList.remove('text-slate-400');
                        bnavBtn.classList.add('text-teal-700', 'font-bold');
                    }
                } else {
                    if (content) content.classList.add('hidden');
                    
                    // Desktop sidebar styling
                    if (navBtn) {
                        navBtn.className = "w-full flex items-center justify-between px-3.5 py-3 rounded-xl text-sm font-semibold transition-all text-slate-300 hover:text-white hover:bg-slate-800/70";
                    }
                    // Mobile bottom nav styling
                    if (bnavBtn) {
                        bnavBtn.classList.add('text-slate-400');
                        bnavBtn.classList.remove('text-teal-700', 'font-bold');
                    }
                }
            });
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Toggle Switch Menerima Pasien
        function toggleStatusLayanan(chk) {
            const label = document.getElementById('activeRoomLabel');
            if (chk.checked) {
                label.innerText = 'SEDANG DILAYANI DI RUANG 1';
                alert('Layanan antrean diaktifkan.');
            } else {
                label.innerText = 'LAYANAN POLI DITUTUP SEMENTARA';
                alert('Layanan antrean ditutup sementara.');
            }
        }

        // Action Buttons for Active Queue
        function handlePanggilUlang() {
            const current = document.getElementById('activeQueueBigNumber').innerText;
            const name = document.getElementById('activePatientName').innerText;
            alert('📢 Memanggil ulang nomor antrean: ' + current + ' atas nama ' + name + ' ke Ruang 1');
        }

        function handleSelesaikanAktif() {
            const current = document.getElementById('activeQueueBigNumber').innerText;
            const name = document.getElementById('activePatientName').innerText;
            if (confirm('Tandai pasien ' + current + ' (' + name + ') telah selesai diperiksa?')) {
                // Update stats
                let selesai = parseInt(document.getElementById('antreanStatSelesai').innerText) || 0;
                document.getElementById('antreanStatSelesai').innerText = selesai + 1;
                alert('Pemeriksaan pasien ' + current + ' selesai. Mengalihkan ke kasir & resep.');
                panggilAntreanBerikutnya();
            }
        }

        function handleLewatiAktif() {
            const current = document.getElementById('activeQueueBigNumber').innerText;
            if (confirm('Lewati nomor antrean ' + current + ' ke urutan belakang?')) {
                alert('Antrean ' + current + ' dilewati.');
                panggilAntreanBerikutnya();
            }
        }

        // Panggil Antrean Berikutnya
        function panggilAntreanBerikutnya() {
            const firstQueue = document.querySelector('.queue-item[data-status="menunggu"]');
            if (firstQueue) {
                const noEl = firstQueue.querySelector('.font-extrabold.leading-none');
                const nameEl = firstQueue.querySelector('.text-sm.font-bold');
                if (noEl && nameEl) {
                    const no = noEl.innerText.trim();
                    const name = nameEl.innerText.split('(')[0].trim();
                    callSpecificQueue(no, name, '30 Th', 'RM-2024-' + Math.floor(1000 + Math.random()*9000), 'Pasien Umum', 'Pemeriksaan Rutin');
                    firstQueue.remove();
                    updateCounts();
                }
            } else {
                alert('Semua antrean saat ini telah selesai dipanggil.');
            }
        }

        function callSpecificQueue(no, name, age, rm, type, complaint) {
            document.getElementById('activeQueueBigNumber').innerText = no;
            document.getElementById('activePatientName').innerText = name;
            document.getElementById('activePatientAge').innerText = '(' + age + ')';
            document.getElementById('activePatientRm').innerHTML = 'No. Rekam Medis: <span class="font-mono text-white">' + rm + '</span>';
            document.getElementById('activePatientType').innerText = type;
            document.getElementById('activePatientComplaint').innerText = complaint;
            document.getElementById('nextQueueBannerText').innerText = 'Panggil Antrean Berikutnya';

            alert('📢 Memanggil Nomor Antrean: ' + no + ' - ' + name + ' menuju Ruang 1');
        }

        // Filter Daftar Antrean
        function filterQueueList(status) {
            const buttons = ['btnFilterSemua', 'btnFilterMenunggu', 'btnFilterDipanggil', 'btnFilterSelesai'];
            buttons.forEach(b => {
                const btn = document.getElementById(b);
                btn.className = "px-4 py-2 rounded-full text-xs font-bold bg-white text-slate-600 border border-slate-200 hover:bg-slate-100 shrink-0";
            });

            if (status === 'semua') {
                document.getElementById('btnFilterSemua').className = "px-4 py-2 rounded-full text-xs font-bold bg-tealmed-900 text-white shrink-0";
            } else if (status === 'menunggu') {
                document.getElementById('btnFilterMenunggu').className = "px-4 py-2 rounded-full text-xs font-bold bg-tealmed-900 text-white shrink-0";
            } else if (status === 'dipanggil') {
                document.getElementById('btnFilterDipanggil').className = "px-4 py-2 rounded-full text-xs font-bold bg-tealmed-900 text-white shrink-0";
            } else if (status === 'selesai') {
                document.getElementById('btnFilterSelesai').className = "px-4 py-2 rounded-full text-xs font-bold bg-tealmed-900 text-white shrink-0";
            }

            const items = document.querySelectorAll('.queue-item');
            items.forEach(it => {
                const itemStatus = it.getAttribute('data-status');
                if (status === 'semua' || itemStatus === status) {
                    it.classList.remove('hidden');
                } else {
                    it.classList.add('hidden');
                }
            });
        }

        function bukaLayarMonitor() {
            alert('Membuka tampilan TV Antrean Ruang Tunggu (Display Mode).');
        }

        // Modal Input Antrean Pasien
        function openInputAntreanModal() {
            document.getElementById('modalInputAntrean').classList.remove('hidden');
        }
        function closeInputAntreanModal() {
            document.getElementById('modalInputAntrean').classList.add('hidden');
        }

        function handleFormInputAntrean(e) {
            e.preventDefault();
            const no = document.getElementById('inAntreanNo').value;
            const nama = document.getElementById('inNamaPasien').value;
            const usia = document.getElementById('inUsiaPasien').value || '25 Th';
            const jaminan = document.getElementById('inJenisJaminan').value;
            const est = document.getElementById('inEstWaktu').value || 'Est. 11:00 WIB';
            const keluhan = document.getElementById('inKeluhan').value || 'Pemeriksaan Poli';

            const container = document.getElementById('queueCardsContainer');
            const newCard = document.createElement('div');
            newCard.className = "bg-white rounded-2xl p-4 border border-slate-200/90 shadow-xs flex items-center justify-between hover:shadow-sm transition-all queue-item animate-in fade-in duration-200";
            newCard.setAttribute('data-status', 'menunggu');

            newCard.innerHTML = `
                <div class="flex items-center gap-3.5">
                    <div class="w-14 h-14 rounded-2xl bg-sky-100/80 text-clinic-700 flex flex-col items-center justify-center font-black shrink-0 border border-sky-200/70">
                        <span class="text-[9px] font-bold text-clinic-500 uppercase">NO</span>
                        <span class="text-base font-extrabold leading-none">${no}</span>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-slate-900">${nama} <span class="text-xs text-slate-400 font-normal">(${usia})</span></div>
                        <div class="text-xs text-slate-400 font-medium mt-0.5 flex items-center gap-1.5">
                            <i class="fa-regular fa-clock text-[11px]"></i>
                            <span>${est}</span>
                        </div>
                        <div class="mt-1.5">
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-cyan-100 text-cyan-800 border border-cyan-200">
                                ${jaminan}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-cyan-50 text-cyan-700 border border-cyan-200/60">
                        Menunggu
                    </span>
                    <button onclick="callSpecificQueue('${no}', '${nama}', '${usia}', 'RM-${Math.floor(1000+Math.random()*9000)}', '${jaminan}', '${keluhan}')" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-teal-50 hover:text-teal-700 text-slate-600 flex items-center justify-center text-sm transition-all border border-slate-200">
                        <i class="fa-solid fa-volume-high"></i>
                    </button>
                </div>
            `;

            container.prepend(newCard);
            updateCounts();
            e.target.reset();
            closeInputAntreanModal();
            alert('Antrean baru ' + no + ' atas nama ' + nama + ' berhasil ditambahkan!');
        }

        // RME Patient Helper Functions
        function pilihPasienRme(name, age, rm) {
            document.getElementById('rmePatientName').innerText = name;
            document.getElementById('rmePatientAge').innerText = age;
            document.getElementById('rmePatientRm').innerText = '#' + rm;
            document.getElementById('inputSearchRme').value = rm;
            window.scrollTo({ top: 180, behavior: 'smooth' });
        }

        function handleFilterRme(query) {
            query = query.toLowerCase().trim();
            const card = document.getElementById('cardPatientDetail');
            if (!query) {
                if (card) card.classList.remove('hidden');
                return;
            }
            const name = document.getElementById('rmePatientName').innerText.toLowerCase();
            const rm = document.getElementById('rmePatientRm').innerText.toLowerCase();
            if (name.includes(query) || rm.includes(query)) {
                if (card) card.classList.remove('hidden');
            } else {
                // Keep visible or show search match
            }
        }

        function openModalTambahPasienRme() {
            document.getElementById('modalTambahPasienRme').classList.remove('hidden');
        }
        function closeModalTambahPasienRme() {
            document.getElementById('modalTambahPasienRme').classList.add('hidden');
        }

        function handleFormTambahPasienRme(e) {
            e.preventDefault();
            const nama = document.getElementById('inRmeNama').value;
            const usia = document.getElementById('inRmeUsia').value || '30 Th';
            const nik = document.getElementById('inRmeNik').value || '3174****0001';
            const jaminan = document.getElementById('inRmeJaminan').value;
            const golDarah = document.getElementById('inRmeGolDarah').value;
            const rm = 'RM-2024-' + Math.floor(1100 + Math.random() * 900);

            pilihPasienRme(nama, usia, rm);
            alert('Pasien baru ' + nama + ' (No. RM: ' + rm + ') berhasil ditambahkan ke SATUSEHAT!');
            e.target.reset();
            closeModalTambahPasienRme();
        }

        function openModalTambahSoap() {
            document.getElementById('modalTambahSoap').classList.remove('hidden');
        }
        function closeModalTambahSoap() {
            document.getElementById('modalTambahSoap').classList.add('hidden');
        }

        function handleFormTambahSoap(e) {
            e.preventDefault();
            alert('Catatan SOAP baru berhasil disimpan & disinkronkan ke rekam medis SATUSEHAT!');
            closeModalTambahSoap();
        }

        // KASIR & BILLING HELPER FUNCTIONS
        function pilihMetodeKasir(metode) {
            const list = ['qris', 'tunai', 'va', 'edc'];
            list.forEach(m => {
                const btn = document.getElementById('btnMetode-' + m);
                const panel = document.getElementById('panelMetode-' + m);
                if (m === metode) {
                    if (btn) btn.className = "p-3 rounded-2xl bg-tealmed-900 text-white border-2 border-tealmed-900 flex items-center gap-3 shadow-sm transition-all";
                    if (panel) panel.classList.remove('hidden');
                } else {
                    if (btn) btn.className = "p-3 rounded-2xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 flex items-center gap-3 transition-all";
                    if (panel) panel.classList.add('hidden');
                }
            });
        }

        function hitungKembalian(val) {
            const bayar = parseInt(val) || 0;
            const tagihan = 300000;
            const kembalian = bayar - tagihan;
            const disp = document.getElementById('displayKembalian');
            if (kembalian >= 0) {
                disp.innerText = 'Rp ' + kembalian.toLocaleString('id-ID');
                disp.className = 'font-black text-emerald-600 text-sm';
            } else {
                disp.innerText = 'Kurang Rp ' + Math.abs(kembalian).toLocaleString('id-ID');
                disp.className = 'font-black text-rose-600 text-sm';
            }
        }

        function handleKonfirmasiPembayaran() {
            alert('✅ Pembayaran Invoice #INV/20241018/0042 sebesar Rp 300.000 atas nama Tn. Hendra Wijaya BERHASIL DITERIMA & LUNAS!');
            const disp = document.getElementById('kasirTotalAmountDisplay');
            if (disp) {
                disp.innerHTML = '<span class="text-emerald-600 text-lg flex items-center gap-1.5"><i class="fa-solid fa-check"></i> LUNAS</span>';
            }
        }

        // Countdown Kasir Timer
        let kasirSeconds = 294; // 04:54
        setInterval(() => {
            if (kasirSeconds > 0) {
                kasirSeconds--;
                const m = String(Math.floor(kasirSeconds / 60)).padStart(2, '0');
                const s = String(kasirSeconds % 60).padStart(2, '0');
                const cdEl = document.getElementById('countdownKasir');
                if (cdEl) cdEl.innerText = m + ':' + s;
            }
        }, 1000);

        // === STUB FUNCTIONS FOR NEW DASHBOARD BUTTONS ===
        function openModalTambahObat() {
            alert('Fitur Manajemen Stok Farmasi sedang disiapkan. Silakan hubungi admin untuk penambahan stok obat.');
        }

        function openModalJanjiTemu() {
            alert('Fitur Janji Temu akan segera hadir. Pasien dapat membuat janji melalui WhatsApp atau datang langsung.');
        }

        function openModalTambahDokter() {
            const nama = prompt('Nama dokter jaga yang ingin ditambahkan:');
            if (nama && nama.trim()) {
                const spesialis = prompt('Spesialis / Poli:') || 'Poli Umum';
                const container = document.getElementById('dashDokterContainer');
                const emptyDiv = document.getElementById('dashDokterEmpty');
                if (emptyDiv) emptyDiv.classList.add('hidden');

                const card = document.createElement('div');
                card.className = 'flex items-center justify-between border-b border-slate-100 pb-3 last:border-0 last:pb-0';
                card.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-800 font-bold flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-user-doctor text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">${nama}</h4>
                            <div class="text-[11px] text-slate-400 mt-0.5">${spesialis} &bull; Siap Melayani</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-cyan-100 text-cyan-800">Tersedia</span>
                        <div class="text-[10px] text-slate-400 mt-0.5">Hari Ini</div>
                    </div>
                `;
                container.appendChild(card);
                alert('Dokter ' + nama + ' berhasil ditambahkan ke jadwal jaga hari ini!');
            }
        }

        // Update count badges in antrean filter tabs & sidebar badge
        function updateCounts() {
            const items = document.querySelectorAll('.queue-item');
            let total = 0, menunggu = 0, dipanggil = 0, selesai = 0;
            items.forEach(it => {
                const s = it.getAttribute('data-status');
                total++;
                if (s === 'menunggu') menunggu++;
                else if (s === 'dipanggil') dipanggil++;
                else if (s === 'selesai') selesai++;
            });

            const tTotal = document.getElementById('countFilterSemua');
            const tMenunggu = document.getElementById('countFilterMenunggu');
            const tDipanggil = document.getElementById('countFilterDipanggil');
            const tSelesai = document.getElementById('countFilterSelesai');

            if (tTotal) tTotal.innerText = total;
            if (tMenunggu) tMenunggu.innerText = menunggu;
            if (tDipanggil) tDipanggil.innerText = dipanggil;
            if (tSelesai) tSelesai.innerText = selesai;

            // Update antrean stats
            const sTotal = document.getElementById('antreanStatTotal');
            const sMenunggu = document.getElementById('antreanStatMenunggu');
            const sSelesai = document.getElementById('antreanStatSelesai');
            if (sTotal) sTotal.innerText = total;
            if (sMenunggu) sMenunggu.innerText = menunggu;
            if (sSelesai) sSelesai.innerText = selesai;

            // Update sidebar badge
            const badge = document.getElementById('badgeNavAntrean');
            if (badge) badge.innerText = menunggu;

            // Update dashboard stat
            const dashAntrean = document.getElementById('dashStatAntrean');
            if (dashAntrean) dashAntrean.innerText = menunggu;

            // Show/hide empty state
            const emptyState = document.getElementById('queueEmptyState');
            if (emptyState) {
                emptyState.style.display = total === 0 ? 'block' : 'none';
            }

            // Update next queue banner
            const nextBanner = document.getElementById('nextQueueBannerText');
            if (nextBanner && menunggu > 0) {
                const firstWaiting = document.querySelector('.queue-item[data-status="menunggu"]');
                if (firstWaiting) {
                    const noEl = firstWaiting.querySelector('.font-extrabold.leading-none');
                    if (noEl) nextBanner.innerText = 'Panggil Antrean ' + noEl.innerText.trim();
                }
            } else if (nextBanner && menunggu === 0) {
                nextBanner.innerText = 'Belum ada antrean menunggu';
            }
        }

        // Run updateCounts on page load to initialise empty state
        document.addEventListener('DOMContentLoaded', function () {
            updateCounts();
            switchTab('dashboard'); // Ensure dashboard is the default active tab
        });
    </script>

    <!-- MODAL: TAMBAH PASIEN BARU RME -->
    <div id="modalTambahPasienRme" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl border border-slate-200 overflow-hidden animate-in fade-in zoom-in duration-150">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-tealmed-900 text-white flex items-center justify-center text-sm">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <h3 class="font-heading font-bold text-slate-800 text-base">Tambah Pasien Baru (RME)</h3>
                </div>
                <button onclick="closeModalTambahPasienRme()" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
            </div>

            <form onsubmit="handleFormTambahPasienRme(event)" class="p-6 space-y-3.5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Pasien *</label>
                    <input type="text" id="inRmeNama" required placeholder="Contoh: Ny. Rina Kusuma" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold focus:ring-2 focus:ring-teal-600 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Usia Pasien</label>
                        <input type="text" id="inRmeUsia" placeholder="34 Th" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-600 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Golongan Darah</label>
                        <select id="inRmeGolDarah" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs bg-white focus:ring-2 focus:ring-teal-600 focus:outline-none">
                            <option value="O+">O+</option>
                            <option value="A+">A+</option>
                            <option value="B+">B+</option>
                            <option value="AB+">AB+</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NIK (KTP Pasien)</label>
                    <input type="text" id="inRmeNik" placeholder="3174123456780003" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-600 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Jaminan</label>
                    <select id="inRmeJaminan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs bg-white focus:ring-2 focus:ring-teal-600 focus:outline-none">
                        <option value="BPJS Faskes 1">BPJS Faskes 1</option>
                        <option value="Pasien Umum">Pasien Umum</option>
                        <option value="Asuransi Swasta">Asuransi Swasta</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Riwayat Alergi (Jika Ada)</label>
                    <input type="text" placeholder="Contoh: Alergi Penisilin" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-600 focus:outline-none">
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalTambahPasienRme()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-tealmed-900 hover:bg-tealmed-950 text-white shadow-md">Simpan Data Pasien</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: TULIS CATATAN SOAP BARU -->
    <div id="modalTambahSoap" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-lg shadow-2xl border border-slate-200 overflow-hidden animate-in fade-in zoom-in duration-150">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-tealmed-900 text-white flex items-center justify-center text-sm">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <h3 class="font-heading font-bold text-slate-800 text-base">Tulis Catatan Medis SOAP Baru</h3>
                </div>
                <button onclick="closeModalTambahSoap()" class="text-slate-400 hover:text-slate-600 text-xl font-bold">&times;</button>
            </div>

            <form onsubmit="handleFormTambahSoap(event)" class="p-6 space-y-3.5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">S: Subjektif (Keluhan Pasien)</label>
                    <textarea rows="2" placeholder="Keluhan utama dan riwayat penyakit sekarang..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-600 focus:outline-none"></textarea>
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Tensi (mmHg)</label>
                        <input type="text" placeholder="120/80" class="w-full px-2.5 py-1.5 rounded-lg border border-slate-300 text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Nadi (x/m)</label>
                        <input type="text" placeholder="80" class="w-full px-2.5 py-1.5 rounded-lg border border-slate-300 text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Suhu (°C)</label>
                        <input type="text" placeholder="36.5" class="w-full px-2.5 py-1.5 rounded-lg border border-slate-300 text-xs">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">SpO2 (%)</label>
                        <input type="text" placeholder="99" class="w-full px-2.5 py-1.5 rounded-lg border border-slate-300 text-xs">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">A: Asesmen / Diagnosis Kerja (ICD-10)</label>
                    <input type="text" placeholder="Diagnosis kerja dan kode ICD-10..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-600 focus:outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">P: Plan (Resep, Terapi & Edukasi)</label>
                    <textarea rows="2" placeholder="Resep obat, dosis, dan petunjuk kontrol..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-teal-600 focus:outline-none"></textarea>
                </div>

                <div class="pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                    <button type="button" onclick="closeModalTambahSoap()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Batal</button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-xs font-bold bg-tealmed-900 hover:bg-tealmed-950 text-white shadow-md">Simpan Catatan SOAP</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
