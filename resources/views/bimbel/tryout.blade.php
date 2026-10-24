<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Pengecekan Hasil Tryout &amp; Asesmen Terbuka — {{ $institution['name'] ?? 'Apex Edu' }}</title>
    <meta name="description" content="Cek skor tryout, analisis kelemahan materi (IRT Score), dan ranking nasional Apex Edu Cabang Tebet.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #0f172a; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        ::-webkit-scrollbar { width: 7px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .tryout-card { transition: all 0.2s ease-in-out; }
        .tryout-card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px -6px rgba(15, 23, 42, 0.08); }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col bg-[#f8fafc] text-slate-800 overflow-x-hidden">

{{-- ===================================================================
     1. TOP ANNOUNCEMENT BAR
     =================================================================== --}}
<div class="bg-blue-700 text-xs text-blue-100 py-2.5 px-4 sm:px-6 lg:px-8 border-b border-blue-800 w-full overflow-hidden">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-2 font-medium text-center md:text-left">
        <div class="flex items-center gap-2 justify-center md:justify-start">
            <i class="fa-solid fa-bullhorn text-xs text-blue-200 shrink-0"></i>
            <span class="text-white text-xs">Pendaftaran Gelombang 2 UTBK–SNBT &amp; Ujian Sekolah 2025 Sedang Dibuka! Diskon Early Bird s.d 25%.</span>
        </div>
        <div class="flex items-center gap-3 text-xs text-blue-100 shrink-0 justify-center">
            <div class="flex items-center gap-1.5">
                <i class="fa-solid fa-headset text-blue-200"></i>
                <span>Hotline CS: <strong class="text-white font-bold">{{ $institution['hotline'] ?? '(021) 8370-1920' }}</strong></span>
            </div>
            <span class="text-blue-300">|</span>
            <span class="text-white font-bold">Sisa Kuota: {{ $institution['sisa_kuota'] ?? 18 }} Kursi</span>
        </div>
    </div>
</div>

{{-- ===================================================================
     2. MAIN NAVBAR
     =================================================================== --}}
<header class="bg-white sticky top-0 z-40 border-b border-slate-200/90 shadow-sm w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-3">

        <!-- Brand -->
        <a href="{{ route('bimbel.landing') }}" class="flex items-center gap-2.5 group shrink-0">
            <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/20 group-hover:bg-blue-700 transition shrink-0">
                <i class="fa-solid fa-graduation-cap text-base"></i>
            </div>
            <div>
                <div class="flex items-center gap-1.5">
                    <span class="font-heading font-extrabold text-lg sm:text-xl tracking-tight text-blue-700">Apex Edu</span>
                    <span class="text-[10px] font-bold bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full border border-blue-200 whitespace-nowrap">Cabang Tebet Clean</span>
                </div>
                <p class="text-[9px] text-slate-400 font-mono -mt-0.5">localhost:8000/clean</p>
            </div>
        </a>

        <!-- Desktop Nav Links -->
        <nav class="hidden lg:flex items-center gap-2 xl:gap-3.5 2xl:gap-5 text-xs xl:text-[13px] font-semibold text-slate-600 whitespace-nowrap">
            <a href="{{ route('bimbel.landing') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Beranda</a>
            <a href="{{ route('bimbel.program.page') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Program &amp; Biaya</a>
            <a href="{{ route('bimbel.pendaftaran') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Pendaftaran Baru</a>
            <a href="{{ route('bimbel.tryout') }}" class="px-3 py-1.5 bg-blue-600 text-white font-bold rounded-xl shadow-sm transition hover:bg-blue-700 whitespace-nowrap">Cek Nilai Tryout</a>
            <a href="{{ route('bimbel.portal') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Portal Siswa &amp; Ortu</a>
            <a href="{{ route('bimbel.kontak') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Kontak Cabang</a>
        </nav>

        <!-- Right: Masuk Akun + Hamburger -->
        <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
            <a href="{{ url('/bimbel-dashboard') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-white bg-blue-900 hover:bg-blue-800 rounded-xl shadow-sm transition whitespace-nowrap">
                <i class="fa-solid fa-arrow-right-to-bracket text-[11px]"></i>
                <span>Masuk Akun</span>
            </a>

            <!-- Hamburger Button -->
            <button id="bimbel-hamburger" onclick="toggleBimbelNav()"
                    class="lg:hidden flex flex-col items-center justify-center w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 transition gap-1 shrink-0"
                    aria-label="Buka menu">
                <span class="block w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bbar1"></span>
                <span class="block w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bbar2"></span>
                <span class="block w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bbar3"></span>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Overlay & Drawer -->
<div id="bimbel-nav-overlay" onclick="closeBimbelNav()"
     class="lg:hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm"
     style="opacity:0;visibility:hidden;transition:opacity 0.25s ease,visibility 0.25s ease;"></div>

<div id="bimbel-nav-drawer"
     class="lg:hidden fixed top-0 right-0 h-full w-[290px] z-50 bg-white shadow-2xl border-l border-slate-200 flex flex-col"
     style="transform:translateX(100%);transition:transform 0.3s cubic-bezier(0.4,0,0.2,1);">
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center"><i class="fa-solid fa-graduation-cap text-sm"></i></div>
            <div>
                <div class="font-heading font-extrabold text-base text-blue-700 leading-none">Apex Edu</div>
                <div class="text-[10px] text-slate-400">Cabang Tebet Clean</div>
            </div>
        </div>
        <button onclick="closeBimbelNav()" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 flex items-center justify-center">
            <i class="fa-solid fa-times text-sm"></i>
        </button>
    </div>
    <nav class="p-4 space-y-1 flex-1 overflow-y-auto">
        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-2">Navigasi Utama</p>
        <a href="{{ route('bimbel.landing') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-house text-slate-400 w-5"></i> Beranda
        </a>
        <a href="{{ route('bimbel.program.page') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-layer-group text-slate-400 w-5"></i> Program &amp; Biaya
        </a>
        <a href="{{ route('bimbel.pendaftaran') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-user-plus text-slate-400 w-5"></i> Pendaftaran Baru
        </a>
        <a href="{{ route('bimbel.tryout') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-sm transition">
            <i class="fa-solid fa-chart-simple w-5"></i> Cek Nilai Tryout
        </a>
        <a href="{{ url('/bimbel-dashboard') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-id-card-clip text-slate-400 w-5"></i> Portal Siswa &amp; Ortu
        </a>
        <a href="#footer" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-phone text-slate-400 w-5"></i> Kontak Cabang
        </a>
        <div class="border-t border-slate-100 my-3"></div>
        <a href="{{ url('/bimbel-dashboard') }}" onclick="closeBimbelNav()" class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-bold text-white bg-blue-900 hover:bg-blue-800 transition shadow-sm">
            <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Masuk Akun
        </a>
    </nav>
    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50 text-xs text-slate-500">
        <p class="font-bold text-slate-700">Apex Edu Hotline</p>
        <p>{{ $institution['hotline'] ?? '(021) 8370-1920' }}</p>
    </div>
</div>

{{-- ===================================================================
     3. HERO SECTION — HEADER & SEARCH FORM (Sesuai Screenshot Asli)
     =================================================================== --}}
<section class="py-10 px-4 sm:px-8 bg-gradient-to-b from-blue-50/50 via-white to-slate-50 border-b border-slate-200/60">
    <div class="max-w-4xl mx-auto text-center space-y-4">

        <!-- Top Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-100/70 border border-blue-200 rounded-full text-xs font-bold text-blue-800">
            <i class="fa-solid fa-circle-check text-blue-600 text-xs"></i>
            <span>Akses Terbuka Hasil CBT • Real-time IRT Algorithm Engine</span>
        </div>

        <!-- Heading & Subheading -->
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading tracking-tight">
            Pusat Pengecekan Hasil Tryout &amp; Asesmen Terbuka
        </h1>
        <p class="text-sm text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Cek skor tryout, analisis kelemahan materi (IRT Score), dan ranking nasional cukup dengan memasukkan Nomor Peserta Tryout atau NISN.
        </p>

        <!-- Search Bar Box (Sesuai Screenshot) -->
        <div class="pt-4 max-w-2xl mx-auto">
            <div class="bg-white p-2 sm:p-2.5 rounded-2xl shadow-lg border border-slate-200 flex flex-col sm:flex-row items-center gap-2">
                <div class="flex items-center gap-3 px-3.5 py-2 flex-1 w-full">
                    <i class="fa-regular fa-id-card text-slate-400 text-base"></i>
                    <input type="text"
                           value=""
                           placeholder="Masukkan Nomor Peserta Tryout / NISN (Contoh: TO-SNBT-2025-0418)"
                           class="w-full text-sm font-semibold text-slate-800 focus:outline-none bg-transparent placeholder-slate-400">
                </div>
                <button type="button"
                        onclick="tampilkanPemberitahuan()"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-sm transition whitespace-nowrap">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    <span>Cari Hasil Tryout</span>
                </button>
            </div>

            <!-- Search Result Meta Status -->
            <div class="mt-3 flex flex-wrap items-center justify-center gap-2 text-[11px] text-slate-500">
                <span class="inline-flex items-center gap-1.5 font-semibold text-blue-700">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    Contoh Pratinjau: <strong>Format Asesmen SNBT</strong> • Siswa Kelas 12
                </span>
                <span class="text-slate-300">|</span>
                <span>Ujian: <strong>Simulasi Nasional SNBT Batch #4</strong></span>
                <span class="text-slate-300">|</span>
                <span class="text-slate-600">Metode: <strong>IRT 3-Parameter Logistic</strong></span>
            </div>
        </div>

    </div>
</section>

{{-- ===================================================================
     4. PEMBERITAHUAN BANNER (INFORMASI RESMI AKUN)
     =================================================================== --}}
<section class="py-6 px-4 sm:px-8 bg-white border-b border-slate-100">
    <div class="max-w-6xl mx-auto">
        <div class="bg-blue-50/80 border border-blue-200 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm mt-0.5 sm:mt-0">
                    <i class="fa-solid fa-circle-info text-lg"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-sm font-bold text-blue-900 font-heading">Pemberitahuan Akses Hasil &amp; Analisis Nilai</h2>
                        <span class="text-[10px] font-extrabold bg-blue-200 text-blue-800 px-2 py-0.5 rounded-full">Informasi Sistem</span>
                    </div>
                    <p class="text-xs text-blue-800/90 mt-1 leading-relaxed">
                        Halaman ini merupakan <strong>halaman pemberitahuan pratinjau format asesmen</strong>. Untuk mengakses rapor lengkap, riwayat tryout mandiri, kunci pembahasan, dan rekomendasi bimbingan personal siswa, silakan masuk ke <strong>Portal Siswa &amp; Orang Tua</strong>.
                    </p>
                </div>
            </div>
            <a href="{{ url('/bimbel-dashboard') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-sm transition shrink-0 w-full sm:w-auto justify-center">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                <span>Buka Portal Siswa</span>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================================
     5. MAIN CONTENT: CONTOH HASIL ASESMEN TERBUKA (Sesuai Foto Persis)
     =================================================================== --}}
<main class="py-10 px-4 sm:px-8 flex-1">
    <div class="max-w-6xl mx-auto space-y-8">

        {{-- TOP SUMMARY BLUE CARD (Sesuai Foto Persis) --}}
        <div class="bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-800 rounded-3xl p-6 sm:p-8 text-white shadow-xl shadow-blue-500/10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">

                <!-- Left Col: Skor IRT -->
                <div class="space-y-2 border-b md:border-b-0 md:border-r border-blue-400/30 pb-5 md:pb-0 md:pr-6">
                    <div class="inline-flex items-center gap-2 text-[10px] font-extrabold tracking-wider uppercase text-blue-200 bg-white/10 px-3 py-1 rounded-full border border-white/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        HASIL TERVERIFIKASI IRT • Selesai: 24 Jan 2025
                    </div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl sm:text-5xl font-extrabold font-heading text-white tracking-tight">685.50</span>
                        <span class="text-sm font-semibold text-blue-200">/ 1000 Poin</span>
                    </div>
                    <p class="text-xs text-blue-100 leading-relaxed">
                        Target Passing Grade Kedokteran UI: <strong class="text-white">710.00</strong>. Peluang lolos masuk rentang <strong class="text-emerald-300">84% Moderat–Tinggi</strong>.
                    </p>
                </div>

                <!-- Mid Col: Kedudukan Ranking -->
                <div class="space-y-3 border-b md:border-b-0 md:border-r border-blue-400/30 pb-5 md:pb-0 md:pr-6">
                    <div class="text-[10px] font-extrabold uppercase tracking-wider text-blue-200">KEDUDUKAN RANKING</div>
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center justify-between bg-white/10 rounded-xl px-3.5 py-2.5 border border-white/15">
                            <span class="flex items-center gap-2 text-blue-100">
                                <i class="fa-solid fa-location-dot text-amber-300"></i> Peringkat Cabang
                            </span>
                            <span class="font-extrabold text-white text-sm">14 <span class="text-[11px] font-normal text-blue-200">/ 850 Peserta</span></span>
                        </div>
                        <div class="flex items-center justify-between bg-white/10 rounded-xl px-3.5 py-2.5 border border-white/15">
                            <span class="flex items-center gap-2 text-blue-100">
                                <i class="fa-solid fa-earth-americas text-sky-300"></i> Peringkat Nasional
                            </span>
                            <span class="font-extrabold text-white text-sm">142 <span class="text-[11px] font-normal text-blue-200">/ 12,400 Peserta</span></span>
                        </div>
                    </div>
                </div>

                <!-- Right Col: Indeks Lolos Circular Ring -->
                <div class="flex flex-col items-center justify-center text-center space-y-2">
                    <div class="relative w-24 h-24 rounded-full border-4 border-white/20 border-t-amber-400 border-r-amber-400 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-2xl font-extrabold font-heading text-white">84%</div>
                            <div class="text-[9px] uppercase font-bold text-blue-200 tracking-wider">Indeks Lolos</div>
                        </div>
                    </div>
                    <div class="text-xs font-semibold text-emerald-300">
                        Status: Top 1.2% Nasional
                    </div>
                </div>

            </div>
        </div>

        {{-- TWO COLUMNS: RINCIAN SUBTES + SIMULASI PTN --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT COLUMN (7 COLS): RINCIAN SKOR SUBTES & REMEDIAL -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Table Card -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 font-heading">Rincian Skor per Subtes TPS &amp; Literasi</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Penilaian Item Response Theory (IRT) memperhitungkan bobot kesulitan tiap butir soal.</p>
                        </div>
                        <span class="text-[11px] font-bold bg-slate-100 text-slate-600 px-2.5 py-1 rounded-lg">7 Subtes Total</span>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                    <th class="py-2.5">SUBTES ASESMEN</th>
                                    <th class="py-2.5 text-center">SKOR IRT</th>
                                    <th class="py-2.5 text-center">AKURASI</th>
                                    <th class="py-2.5 text-center">KATEGORI EVALUASI</th>
                                    <th class="py-2.5 text-right">TINDAKAN</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <!-- 1. PU -->
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3">
                                        <div class="font-bold text-slate-900">Penalaran Umum (PU)</div>
                                        <div class="text-[11px] text-slate-400">30 Soal • Silogisme, Deduktif, Induktif</div>
                                    </td>
                                    <td class="py-3 text-center font-extrabold text-blue-700 text-sm">720</td>
                                    <td class="py-3 text-center font-semibold text-slate-700">88%</td>
                                    <td class="py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold text-[10px] border border-blue-200">Sangat Kuat</span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ url('/bimbel-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-[11px]">Lihat &rarr;</a>
                                    </td>
                                </tr>
                                <!-- 2. PPU -->
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3">
                                        <div class="font-bold text-slate-900">Pengetahuan &amp; Pemahaman Umum (PPU)</div>
                                        <div class="text-[11px] text-slate-400">20 Soal • Konteks Makna, Kosakata Baru</div>
                                    </td>
                                    <td class="py-3 text-center font-extrabold text-blue-700 text-sm">650</td>
                                    <td class="py-3 text-center font-semibold text-slate-700">76%</td>
                                    <td class="py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px]">Baik</span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ url('/bimbel-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-[11px]">Lihat &rarr;</a>
                                    </td>
                                </tr>
                                <!-- 3. PBM -->
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3">
                                        <div class="font-bold text-slate-900">Pemahaman Bacaan &amp; Menulis (PBM)</div>
                                        <div class="text-[11px] text-slate-400">20 Soal • EBI, Kohesi &amp; Koherensi Kalimat</div>
                                    </td>
                                    <td class="py-3 text-center font-extrabold text-blue-700 text-sm">690</td>
                                    <td class="py-3 text-center font-semibold text-slate-700">82%</td>
                                    <td class="py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px]">Baik</span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ url('/bimbel-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-[11px]">Lihat &rarr;</a>
                                    </td>
                                </tr>
                                <!-- 4. PK -->
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3">
                                        <div class="font-bold text-slate-900">Pengetahuan Kuantitatif (PK)</div>
                                        <div class="text-[11px] text-slate-400">15 Soal • Aljabar, Aritmetika, Geometri</div>
                                    </td>
                                    <td class="py-3 text-center font-extrabold text-blue-700 text-sm">680</td>
                                    <td class="py-3 text-center font-semibold text-slate-700">78%</td>
                                    <td class="py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-bold text-[10px]">Baik</span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ url('/bimbel-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-[11px]">Lihat &rarr;</a>
                                    </td>
                                </tr>
                                <!-- 5. Literasi -->
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3">
                                        <div class="font-bold text-slate-900">Literasi Bhs Indonesia &amp; Inggris</div>
                                        <div class="text-[11px] text-slate-400">50 Soal • Critical Reading &amp; Inference</div>
                                    </td>
                                    <td class="py-3 text-center font-extrabold text-blue-700 text-sm">710</td>
                                    <td class="py-3 text-center font-semibold text-slate-700">85%</td>
                                    <td class="py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded-full bg-blue-50 text-blue-700 font-bold text-[10px] border border-blue-200">Sangat Kuat</span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ url('/bimbel-dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-[11px]">Lihat &rarr;</a>
                                    </td>
                                </tr>
                                <!-- 6. PM (Warning) -->
                                <tr class="bg-rose-50/40 hover:bg-rose-50/70 transition">
                                    <td class="py-3">
                                        <div class="font-bold text-rose-700 flex items-center gap-1.5">
                                            <span>Penalaran Matematika (PM) !</span>
                                        </div>
                                        <div class="text-[11px] text-rose-400">20 Soal • Model Matematika &amp; Analisis Data</div>
                                    </td>
                                    <td class="py-3 text-center font-extrabold text-rose-700 text-sm">662</td>
                                    <td class="py-3 text-center font-semibold text-rose-700">72%</td>
                                    <td class="py-3 text-center">
                                        <span class="inline-block px-2 py-0.5 rounded-full bg-rose-100 text-rose-700 font-bold text-[10px] border border-rose-200">Butuh Latihan Lebih</span>
                                    </td>
                                    <td class="py-3 text-right">
                                        <a href="{{ url('/bimbel-dashboard') }}" class="text-rose-600 hover:text-rose-800 font-bold text-[11px]">Remedial &rarr;</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Rekomendasi Remedial Card (Sesuai Foto Persis) -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-lightbulb text-sm"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 font-heading">Rekomendasi Remedial &amp; Drilling Materi Lemah</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                Rekomendasi sistem berbasis IRT: <strong class="text-slate-900">"Tingkatkan penguasaan Logika Proposisi &amp; Aljabar Matriks"</strong>. Subtes Penalaran Matematika kamu berada 48 poin di bawah rata-rata top 100 FK UI.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 pt-2">
                        <a href="{{ url('/bimbel-dashboard') }}"
                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-sm transition">
                            <i class="fa-solid fa-download text-xs"></i>
                            <span>Unduh Modul Pembahasan Soal</span>
                        </a>
                        <a href="{{ url('/bimbel-dashboard') }}"
                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition border border-slate-200">
                            <i class="fa-solid fa-circle-play text-xs text-blue-600"></i>
                            <span>Tonton Video Pembahasan Nomor 15–20</span>
                        </a>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN (5 COLS): SIMULASI PELUANG MASUK PTN & PEMBAHASAN CBT -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Simulasi Peluang Masuk PTN (Sesuai Foto Persis) -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-5">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 font-heading">Simulasi Peluang Masuk PTN</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Rasionalisasi jurusan berdasarkan histori nilai lolos tahun 2024.</p>
                    </div>

                    <!-- PILIHAN 1 -->
                    <div class="bg-blue-50/60 rounded-2xl border border-blue-200/80 p-4 space-y-2.5">
                        <div class="flex items-center justify-between text-[10px] font-bold text-slate-400">
                            <span>PILIHAN 1 (PRIORITAS)</span>
                            <span class="text-blue-700 font-extrabold text-xs">#1</span>
                        </div>
                        <div>
                            <div class="text-base font-extrabold text-slate-900 font-heading leading-tight">Kedokteran</div>
                            <div class="text-xs text-slate-500">Universitas Indonesia (Depok)</div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-xs font-semibold mb-1">
                                <span class="text-slate-600">Peluang Kelulusan:</span>
                                <span class="font-extrabold text-blue-700">84%</span>
                            </div>
                            <div class="w-full h-2 bg-blue-200/70 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600 rounded-full" style="width: 84%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 bg-amber-50 rounded-xl p-2 border border-amber-200/80 text-[11px] text-amber-800">
                            <i class="fa-solid fa-lightbulb text-amber-600 shrink-0"></i>
                            <span>Butuh +25 poin ekstra pada Pengetahuan Kuantitatif</span>
                        </div>
                    </div>

                    <!-- PILIHAN 2 -->
                    <div class="bg-slate-50 rounded-2xl border border-slate-200 p-4 space-y-2.5">
                        <div class="flex items-center justify-between text-[10px] font-bold text-slate-400">
                            <span>PILIHAN 2</span>
                            <span class="text-slate-500 font-bold text-xs">#2</span>
                        </div>
                        <div>
                            <div class="text-base font-extrabold text-slate-900 font-heading leading-tight">Farmasi</div>
                            <div class="text-xs text-slate-500">Universitas Padjadjaran (Jatinangor)</div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between text-xs font-semibold mb-1">
                                <span class="text-slate-600">Peluang Kelulusan:</span>
                                <span class="font-extrabold text-emerald-600">95%</span>
                            </div>
                            <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width: 95%"></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 bg-emerald-50 rounded-xl p-2 border border-emerald-200/80 text-[11px] text-emerald-800">
                            <i class="fa-solid fa-circle-check text-emerald-600 shrink-0"></i>
                            <span>Kategori AMAN: Nilai di atas passing grade SNBT 2024.</span>
                        </div>
                    </div>

                    <!-- Ganti Simulasi Jurusan Notice -->
                    <div class="bg-indigo-50/50 rounded-2xl border border-indigo-100 p-4 text-xs space-y-2">
                        <div class="font-bold text-indigo-900 flex items-center gap-1.5">
                            <i class="fa-solid fa-shuffle text-indigo-600"></i>
                            <span>Ganti Simulasi Jurusan?</span>
                        </div>
                        <p class="text-slate-600 text-[11px] leading-relaxed">
                            Ingin cek jurusan ITB, UGM, atau UNAIR? Konsultasikan rasionalisasi jurusan lengkap bersama Master Tutor Apex Edu Tebet.
                        </p>
                        <a href="https://wa.me/{{ $institution['whatsapp'] ?? '6281299003420' }}?text=Halo+Apex+Edu%2C+saya+ingin+konsultasi+rasionalisasi+jurusan+SNBT."
                           target="_blank"
                           class="inline-flex items-center gap-1.5 text-blue-700 hover:text-blue-900 font-bold text-[11px]">
                            <span>Jadwalkan Konsultasi Gratis</span> &rarr;
                        </a>
                    </div>
                </div>

                <!-- Informasi Pembahasan CBT Card (Sesuai Foto Persis) -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-3.5">
                    <h4 class="text-sm font-bold text-slate-900 font-heading">Informasi Pembahasan CBT</h4>
                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-slate-500">Total Soal Dikerjakan</span>
                            <span class="font-bold text-slate-900">155 / 155 Butir</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-slate-500">Jawaban Benar</span>
                            <span class="font-bold text-emerald-600">128 Soal</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-slate-500">Jawaban Salah / Kosong</span>
                            <span class="font-bold text-rose-600">27 Soal</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500">Waktu Pengerjaan Total</span>
                            <span class="font-bold text-slate-900">178 Menit</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- ===================================================================
             6. PROMO SECTION: MAU NAIKKAN SKOR TRYOUT HINGGA 750+? (Sesuai Foto Persis)
             =================================================================== --}}
        <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 rounded-3xl p-7 sm:p-9 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl">
                <div class="inline-flex items-center gap-2 text-[10px] font-extrabold uppercase tracking-wider text-amber-300">
                    <i class="fa-solid fa-bolt text-xs"></i> Program Intensif Gelombang Terakhir
                </div>
                <h3 class="text-2xl sm:text-3xl font-extrabold font-heading text-white leading-tight">
                    Mau Naikkan Skor Tryout Hingga 750+?
                </h3>
                <p class="text-xs text-blue-100 leading-relaxed">
                    Gabung Kelas Super Intensive UTBK 30 Hari Terakhir. Drilling 1.500+ bank soal tipe HOTS, bedah trik pengerjaan cepat subtes PM &amp; PK bersama Master Tutor Terbaik UI &amp; ITB.
                </p>
            </div>
            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full md:w-auto">
                <a href="{{ route('bimbel.pendaftaran') }}"
                   class="w-full sm:w-auto text-center px-6 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl shadow-md transition">
                    Daftar Kelas Pendampingan
                </a>
                <a href="https://wa.me/{{ $institution['whatsapp'] ?? '6281299003420' }}?text=Halo+Apex+Edu%2C+saya+mau+tanya+kelas+intensif+UTBK."
                   target="_blank"
                   class="w-full sm:w-auto text-center px-6 py-3.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs rounded-xl transition">
                    Tanya Admin via WA
                </a>
            </div>
        </div>

        {{-- ===================================================================
             7. SINKRONISASI BASIS DATA AKADEMIK APEX EDU (Sesuai Foto Persis)
             =================================================================== --}}
        <div class="bg-blue-50/50 rounded-2xl border border-blue-100 p-4 flex items-start gap-3 text-xs text-slate-500">
            <i class="fa-solid fa-database text-blue-600 text-sm mt-0.5 shrink-0"></i>
            <div class="leading-relaxed text-[11px]">
                <strong class="text-slate-800">Sinkronisasi Basis Data Akademik Apex Edu:</strong> Data nilai ini bersumber langsung dari modul Akademik &amp; Tryout CBT di Dashboard Admin Bimbel. Hasil tryout bersifat terbuka untuk monitoring progres siswa dan orang tua. Pembaruan peringkat nasional dilakukan otomatis setiap 60 menit saat sesi ujian regional selesai.
            </div>
        </div>

    </div>
</main>

{{-- ===================================================================
     8. FOOTER (Sesuai Screenshot Persis)
     =================================================================== --}}
<footer id="footer" class="bg-white border-t border-slate-200 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500 mt-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">

        <!-- Col 1: Brand Info -->
        <div class="space-y-3">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold">
                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                </div>
                <span class="font-heading font-extrabold text-lg text-slate-900">Apex Edu</span>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed">
                Lembaga bimbingan belajar intensif berfokus pada kelulusan PTN Impian (UTBK-SNBT, SIMAK UI, UTUL UGM) &amp; Peringkat Paralel Sekolah dengan kurikulum Adaptif-Presisi.
            </p>
            <div class="pt-2 flex items-center gap-2">
                <span class="inline-block px-2.5 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-lg border border-blue-200">
                    Akreditasi A Kemendikbud
                </span>
                <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-600 text-[10px] font-medium rounded-lg">
                    SK: 421/BMB-JS/2023
                </span>
            </div>
        </div>

        <!-- Col 2: Cabang Jakarta Selatan -->
        <div class="space-y-2.5">
            <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Cabang Jakarta Selatan</h4>
            <div class="flex items-start gap-2 text-xs">
                <i class="fa-solid fa-location-dot text-blue-600 mt-0.5 shrink-0"></i>
                <p class="leading-relaxed">{{ $institution['branch_full_address'] ?? 'Jl. Tebet Barat Dalam Raya No. 42B, RT.06 / RW.02, Tebet Barat, Jakarta Selatan, DKI Jakarta 12810' }}</p>
            </div>
            <div class="flex items-center gap-2 text-xs pt-1">
                <i class="fa-solid fa-phone text-blue-600 shrink-0"></i>
                <span>Hotline / WhatsApp: <strong class="text-slate-800">{{ $institution['front_office_phone'] ?? '+62 812-9900-3420' }}</strong></span>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <i class="fa-regular fa-clock text-blue-600 shrink-0"></i>
                <span>{{ $institution['jam_buka'] ?? 'Senin - Sabtu: 08.00 - 20.30 WIB' }}</span>
            </div>
        </div>

        <!-- Col 3: Akses Cepat Siswa -->
        <div>
            <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Akses Cepat Siswa</h4>
            <ul class="space-y-2 text-xs">
                <li><a href="{{ route('bimbel.landing') }}" class="hover:text-blue-600 transition">Biaya Bimbel UTBK &amp; Kedinasan 2025</a></li>
                <li><a href="{{ route('bimbel.tryout') }}" class="hover:text-blue-600 transition font-semibold text-blue-700">Ranking Tryout Nasional SNBT IRT</a></li>
                <li><a href="{{ route('bimbel.program.page') }}" class="hover:text-blue-600 transition">Jadwal Konsultasi Rasionalisasi Jurusan</a></li>
                <li><a href="{{ route('bimbel.pendaftaran') }}" class="hover:text-blue-600 transition">Beasiswa Prestasi &amp; Tahfidz</a></li>
                <li><a href="{{ url('/bimbel-dashboard') }}" class="hover:text-blue-600 transition">Unduh Silabus &amp; Modul Bank Soal</a></li>
            </ul>
        </div>

        <!-- Col 4: Layanan & Komunitas -->
        <div>
            <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Layanan &amp; Komunitas</h4>
            <p class="text-xs text-slate-500 leading-relaxed mb-3">
                Dapatkan tips pengerjaan soal TPS, Penalaran Matematika, dan info kuota PTN langsung dari tutor Master.
            </p>
            <div class="flex items-center gap-2 text-slate-400">
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-regular fa-newspaper"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-brands fa-discord"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-solid fa-globe"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>

    </div>

    <!-- Bottom Copyright -->
    <div class="max-w-7xl mx-auto pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-400 text-[11px]">
        <p>&copy; {{ date('Y') }} Bimbel Apex Edu Cabang Jakarta Selatan. Seluruh Hak Cipta Dilindungi Undang-Undang.</p>
        <div class="flex items-center gap-4">
            <a href="#" class="hover:text-slate-600">Syarat &amp; Ketentuan</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-slate-600">Kebijakan Privasi Data Siswa</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-slate-600">Standar Operasional Belajar</a>
        </div>
    </div>
</footer>

<!-- MODAL PEMBERITAHUAN (JIKA KLIK CARI HASIL) -->
<div id="modal-notif" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 text-center space-y-4 shadow-2xl border border-slate-200">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto text-2xl border border-blue-100">
            <i class="fa-solid fa-circle-info"></i>
        </div>
        <h3 class="text-lg font-bold text-slate-900 font-heading">Pemberitahuan Sistem</h3>
        <p class="text-xs text-slate-600 leading-relaxed">
            Data yang ditampilkan adalah contoh format pratinjau asesmen terbuka. Untuk mencari hasil tryout personal peserta lainnya, silakan masuk melalui <strong>Portal Siswa &amp; Orang Tua</strong> menggunakan NISN dan kata sandi akun Anda.
        </p>
        <div class="pt-2 flex items-center justify-center gap-3">
            <button onclick="tutupPemberitahuan()" class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition">
                Tutup
            </button>
            <a href="{{ url('/bimbel-dashboard') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-sm transition">
                Masuk ke Portal
            </a>
        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    function toggleBimbelNav() {
        const drawer = document.getElementById('bimbel-nav-drawer');
        const isOpen = drawer.style.transform === 'translateX(0%)';
        isOpen ? closeBimbelNav() : openBimbelNav();
    }
    function openBimbelNav() {
        document.getElementById('bimbel-nav-drawer').style.transform = 'translateX(0%)';
        document.getElementById('bimbel-nav-overlay').style.opacity = '1';
        document.getElementById('bimbel-nav-overlay').style.visibility = 'visible';
        document.getElementById('bbar1').style.transform = 'rotate(45deg) translate(4px, 4px)';
        document.getElementById('bbar2').style.opacity = '0';
        document.getElementById('bbar3').style.transform = 'rotate(-45deg) translate(4px, -4px)';
    }
    function closeBimbelNav() {
        document.getElementById('bimbel-nav-drawer').style.transform = 'translateX(100%)';
        document.getElementById('bimbel-nav-overlay').style.opacity = '0';
        document.getElementById('bimbel-nav-overlay').style.visibility = 'hidden';
        document.getElementById('bbar1').style.transform = 'none';
        document.getElementById('bbar2').style.opacity = '1';
        document.getElementById('bbar3').style.transform = 'none';
    }
    function tampilkanPemberitahuan() {
        const m = document.getElementById('modal-notif');
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    function tutupPemberitahuan() {
        const m = document.getElementById('modal-notif');
        m.classList.add('hidden');
        m.classList.remove('flex');
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeBimbelNav();
            tutupPemberitahuan();
        }
    });
</script>
</body>
</html>
