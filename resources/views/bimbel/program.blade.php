<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilihan Program Belajar & Estimasi Investasi Pendidikan 2025/2026 — EduPulse Academy</title>
    <meta name="description" content="Kurikulum adaptif, bimbingan personal mentor, serta simulasi tryout berstandar komputer untuk memperbesar peluang lolos PTN negeri dan sekolah favorit impian.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        apexblue: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 7px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Card transition */
        .bimbel-card {
            transition: all 0.25s ease-in-out;
        }
        .bimbel-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 28px -8px rgba(37, 99, 235, 0.12), 0 4px 12px -2px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col justify-between overflow-x-hidden">

    <!-- ========================================================= -->
    <!-- 1. TOP ANNOUNCEMENT BAR (Sesuai Foto Asli Screenshot)     -->
    <!-- ========================================================= -->
    <div class="bg-blue-700 text-xs text-blue-100 py-2.5 px-4 sm:px-6 lg:px-8 border-b border-blue-800 w-full overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-2 font-medium text-center md:text-left">
            <!-- Left: Info Pengumuman -->
            <div class="flex items-center gap-2 justify-center md:justify-start">
                <i class="fa-solid fa-bullhorn text-xs text-blue-200 shrink-0"></i>
                <span class="text-white font-medium text-xs">Pendaftaran Gelombang 2 UTBK–SNBT &amp; Ujian Sekolah 2025 Sedang Dibuka! Diskon Early Bird s.d 25%.</span>
            </div>

            <!-- Right: Hotline CS & Sisa Kuota -->
            <div class="flex items-center gap-3 text-xs text-blue-100 shrink-0 justify-center">
                <div class="flex items-center gap-1.5">
                    <i class="fa-solid fa-headset text-blue-200"></i>
                    <span>Hotline CS: <strong class="text-white font-bold">(021) 8370–1920</strong></span>
                </div>
                <span class="text-blue-300">|</span>
                <span class="text-white font-bold">Sisa Kuota: 18 Kursi</span>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- 2. MAIN HEADER & NAVBAR (Sesuai Foto Asli Screenshot)     -->
    <!-- ========================================================= -->
    <header class="bg-white sticky top-0 z-40 border-b border-slate-200/90 shadow-xs w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-3">
            
            <!-- Brand Logo: EduPulse Academy + Cabang Tebet Clean -->
            <a href="{{ url('/bimbel') }}" class="flex items-center gap-2.5 group shrink-0">
                <div class="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shadow-md shadow-blue-500/20 group-hover:bg-blue-700 transition shrink-0">
                    <i class="fa-solid fa-graduation-cap text-base"></i>
                </div>
                <div>
                    <div class="flex items-center gap-1.5">
                        <span class="font-heading font-extrabold text-lg sm:text-xl tracking-tight text-blue-700">EduPulse Academy</span>
                        <span class="text-[10px] font-bold bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full border border-blue-200 whitespace-nowrap">Cabang Tebet Clean</span>
                    </div>
                    <p class="text-[9px] text-slate-400 font-mono -mt-0.5">localhost:8000/clean</p>
                </div>
            </a>

            <!-- Navigation Links (Selalu Kesamping / No-Wrap) -->
            <nav class="hidden lg:flex items-center gap-2 xl:gap-3.5 2xl:gap-5 text-xs xl:text-[13px] font-semibold text-slate-600 whitespace-nowrap shrink-0">
                <a href="{{ route('bimbel.landing') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Beranda</a>
                <a href="{{ route('bimbel.program.page') }}" class="px-3 py-1.5 bg-blue-600 text-white font-bold rounded-xl shadow-sm transition whitespace-nowrap">Program &amp; Biaya</a>
                <a href="{{ route('bimbel.pendaftaran') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Pendaftaran Baru</a>
                <a href="{{ route('bimbel.tryout') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Cek Nilai Tryout</a>
                <a href="{{ route('bimbel.portal') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Portal Siswa &amp; Ortu</a>
                <a href="{{ route('bimbel.kontak') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Kontak Cabang</a>
            </nav>

            <!-- Right Actions: Masuk Akun -->
            <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
                <a href="{{ url('/bimbel-dashboard') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-white bg-blue-900 hover:bg-blue-800 rounded-xl shadow-sm transition whitespace-nowrap">
                    <i class="fa-solid fa-arrow-right-to-bracket text-[11px]"></i>
                    <span>Masuk Akun</span>
                </a>

                <!-- Hamburger Button (Mobile & Tablet) -->
                <button id="bimbel-hamburger"
                        onclick="toggleBimbelNav()"
                        class="lg:hidden flex flex-col items-center justify-center w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 transition gap-1.5 shrink-0"
                        aria-label="Buka menu navigasi">
                    <span class="block w-5 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bbar1"></span>
                    <span class="block w-5 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bbar2"></span>
                    <span class="block w-5 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bbar3"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- ========================================================= -->
    <!-- MOBILE NAVIGATION DRAWER                                  -->
    <!-- ========================================================= -->
    <div id="bimbel-nav-overlay" onclick="closeBimbelNav()"
         class="lg:hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm"
         style="opacity:0; visibility:hidden; transition: opacity 0.25s ease, visibility 0.25s ease;"></div>

    <div id="bimbel-nav-drawer"
         class="lg:hidden fixed top-0 right-0 h-full w-[290px] z-50 bg-white shadow-2xl border-l border-slate-200"
         style="transform: translateX(100%); transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);">
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                </div>
                <div>
                    <div class="font-heading font-extrabold text-base text-slate-900 leading-none">EduPulse Academy</div>
                    <div class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider">Program &amp; Biaya</div>
                </div>
            </div>
            <button onclick="closeBimbelNav()" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                <i class="fa-solid fa-times text-sm"></i>
            </button>
        </div>

        <nav class="p-4 space-y-1">
            <a href="{{ route('bimbel.landing') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 transition">
                <i class="fa-solid fa-house text-slate-400 w-5"></i> Beranda
            </a>
            <a href="{{ route('bimbel.program.page') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold bg-blue-50 text-blue-700 transition">
                <i class="fa-solid fa-book-open text-blue-600 w-5"></i> Program &amp; Biaya
            </a>
            <a href="#fasilitas" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 transition">
                <i class="fa-solid fa-chalkboard-user text-slate-400 w-5"></i> Fasilitas &amp; Tutor
            </a>
            <a href="#simulasi" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 transition">
                <i class="fa-solid fa-calculator text-slate-400 w-5"></i> Kalkulator Biaya
            </a>
            <a href="#matriks" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 transition">
                <i class="fa-solid fa-table-columns text-slate-400 w-5"></i> Komparasi Fasilitas
            </a>
            <a href="#testimoni" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 transition">
                <i class="fa-solid fa-award text-slate-400 w-5"></i> Hasil Kelulusan
            </a>
            <a href="{{ url('/bimbel-dashboard') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 transition">
                <i class="fa-solid fa-arrow-right-to-bracket text-slate-400 w-5"></i> Portal Siswa
            </a>
            <div class="border-t border-slate-100 my-3"></div>
            <button type="button" onclick="closeBimbelNav(); openRegistrationModal()" class="w-full py-3 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition">
                Daftar Program Ini
            </button>
        </nav>
    </div>

    <!-- Alert Success Notification -->
    @if(session('success_daftar'))
        <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4">
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-emerald-800 text-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                    <div>
                        <strong class="font-bold">Pendaftaran Berhasil!</strong> {{ session('success_daftar') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ========================================================= -->
    <!-- 3. BREADCRUMB & HEADER SECTION (Sesuai Foto Asli)         -->
    <!-- ========================================================= -->
    <section class="pt-6 pb-6 px-4 sm:px-8 bg-gradient-to-b from-blue-50/50 to-white">
        <div class="max-w-7xl mx-auto">
            
            <!-- Breadcrumbs Row -->
            <div class="flex flex-wrap items-center justify-between gap-3 text-xs text-slate-400 font-medium mb-4">
                <div class="flex items-center gap-2">
                    <a href="{{ url('/bimbel') }}" class="hover:text-blue-600">Beranda</a>
                    <span>&rsaquo;</span>
                    <span class="text-slate-600">Biaya &amp; Program Belajar</span>
                    <span>&rsaquo;</span>
                    <span class="text-blue-600 font-bold">Pilihan Paket 2025/2026</span>
                </div>
                <div class="hidden sm:flex items-center gap-1.5 text-slate-500 font-medium">
                    <i class="fa-regular fa-calendar-check text-blue-600"></i>
                    <span>Periode Akademik 2025/2026 &bull; Semester Genap</span>
                </div>
            </div>

            <!-- Headline Section with Right Stats Box -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-slate-200/80">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 bg-blue-100/80 border border-blue-200 text-blue-800 text-xs font-bold px-3.5 py-1 rounded-full mb-3">
                        <i class="fa-solid fa-star text-amber-500 text-xs"></i>
                        <span>ESTIMASI BIAYA &amp; PENDAFTARAN TAHUN AJARAN 2025/2026</span>
                    </div>
                    <h1 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight leading-[1.18]">
                        Pilihan Program Belajar &amp; Estimasi Investasi Pendidikan 2025/2026
                    </h1>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed mt-3">
                        Kurikulum adaptif, bimbingan personal mentor, serta simulasi tryout berstandar komputer untuk memperbesar peluang lolos PTN negeri dan sekolah favorit impian.
                    </p>
                </div>

                <!-- Stats Badges Strip (91.4% & 1:10) -->
                <div class="flex items-center gap-3 shrink-0">
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs text-center min-w-[130px]">
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-blue-600">91.4%</div>
                        <div class="text-[11px] text-slate-500 font-semibold mt-0.5">Tingkat Kelulusan</div>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-2xs text-center min-w-[130px]">
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900">1:10</div>
                        <div class="text-[11px] text-slate-500 font-semibold mt-0.5">Rasio Maksimal Guru &amp; Siswa</div>
                    </div>
                </div>
            </div>

            <!-- Filter Pills Categories (Sesuai Foto) -->
            <div class="flex items-center gap-2 pt-6 overflow-x-auto pb-2 scrollbar-hide">
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white shadow-xs whitespace-nowrap">Semua Program</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap">SD Juara (4-6)</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap">SMP Prestasi (7-9)</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap">SMA Reguler (10-12)</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap">Intensif UTBK SNBT</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap">Kedinasan / Akmil / Akpol</button>
                <button type="button" class="px-4 py-2 rounded-xl text-xs font-bold bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap">Privat Garansi 1-on-1</button>
            </div>

            <!-- Gelombang Notice Strip (Sesuai Foto) -->
            <div class="mt-4 p-4 bg-blue-50/80 border border-blue-200/90 rounded-2xl flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs text-blue-900">
                <div class="flex items-center gap-2.5">
                    <div class="w-6 h-6 rounded-full bg-blue-600 text-white flex items-center justify-center shrink-0 text-xs">
                        <i class="fa-solid fa-info"></i>
                    </div>
                    <div>
                        <strong class="font-bold">INFO GELOMBANG PENDAFTARAN BARU:</strong>
                        <span> Dapatkan diskon early bird s.d 20% + Free 2x Diagnostic Test untuk pendaftaran sebelum 30 Juni 2025. Kuota Terbatas!</span>
                    </div>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" onclick="openRegistrationModal('Klaim Diskon Early Bird')" class="px-3.5 py-1.5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-lg transition shadow-2xs">
                        Klaim Diskon
                    </button>
                    <button type="button" onclick="alert('Syarat & Ketentuan: Diskon berlaku untuk pendaftaran paket tahunan dan pembayaran lunas di awal.')" class="px-3.5 py-1.5 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-bold rounded-lg transition">
                        Detail Syarat &amp; Ketentuan
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 4. 4 PRICING CARDS (Sesuai Foto Asli)                     -->
    <!-- ========================================================= -->
    <section class="py-10 px-4 sm:px-8 bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- CARD 1: SD Juara & Olimpiade -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 bimbel-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg border bg-blue-50 text-blue-700 border-blue-200">
                                KELAS 4 - 6 SD
                            </span>
                        </div>

                        <h3 class="font-heading font-extrabold text-xl text-slate-900 mb-1.5">SD Juara &amp; Olimpiade</h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Pembinaan dasar calistung, sains &amp; logika, persiapan masuk SMP favorit berstandar.</p>

                        <div class="mb-5 pb-5 border-b border-slate-100">
                            <span class="text-xs text-slate-400 font-semibold">Biaya Investasi Mulai</span>
                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="text-xs font-bold text-slate-500">Rp</span>
                                <span class="font-heading font-extrabold text-2xl text-slate-900">750.000</span>
                                <span class="text-xs text-slate-500 font-medium">/ bln</span>
                            </div>
                        </div>

                        <ul class="space-y-2.5 text-xs text-slate-600 mb-6">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>3x Pertemuan Tatap Muka / Pekan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Maksimal 10 Siswa per Kelas</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Modul &amp; Bank Soal Tematik Lengkap</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Laporan Nilai Bulanan ke Orang Tua</span>
                            </li>
                        </ul>
                    </div>

                    <button type="button" onclick="openRegistrationModal('SD Juara & Olimpiade')"
                            class="w-full py-2.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 border border-slate-200 transition flex items-center justify-center gap-2">
                        <span>PILIH PROGRAM INI &rarr;</span>
                    </button>
                </div>

                <!-- CARD 2: SMP Prestasi & SMA Unggulan -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 bimbel-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg border bg-indigo-50 text-indigo-700 border-indigo-200">
                                KELAS 7 - 9 SMP
                            </span>
                        </div>

                        <h3 class="font-heading font-extrabold text-xl text-slate-900 mb-1.5">SMP Prestasi &amp; SMA Unggulan</h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Fokus materi esensial MTK, IPA, &amp; Bahasa Inggris, pemantapan nilai rapor serta asesmen kelulusan.</p>

                        <div class="mb-5 pb-5 border-b border-slate-100">
                            <span class="text-xs text-slate-400 font-semibold">Biaya Investasi Mulai</span>
                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="text-xs font-bold text-slate-500">Rp</span>
                                <span class="font-heading font-extrabold text-2xl text-slate-900">950.000</span>
                                <span class="text-xs text-slate-500 font-medium">/ bln</span>
                            </div>
                        </div>

                        <ul class="space-y-2.5 text-xs text-slate-600 mb-6">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>4x Pertemuan Tatap Muka / Pekan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Simulasi Tryout CBT Komputer Berkala</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Drill Soal Olimpiade &amp; Soal HOTS</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Free Konsultasi PR &amp; Tugas Sekolah</span>
                            </li>
                        </ul>
                    </div>

                    <button type="button" onclick="openRegistrationModal('SMP Prestasi & SMA Unggulan')"
                            class="w-full py-2.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 border border-slate-200 transition flex items-center justify-center gap-2">
                        <span>PILIH PROGRAM INI &rarr;</span>
                    </button>
                </div>

                <!-- CARD 3: UTBK Mandiri & SNBT Kilat (Highlighted) -->
                <div class="bg-white rounded-3xl p-6 border-2 border-blue-600 shadow-xl shadow-blue-500/10 bimbel-card flex flex-col justify-between relative">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-wider px-3.5 py-0.5 rounded-full shadow-sm whitespace-nowrap">
                        Program Unggulan Rekomendasi Mentor
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg border bg-blue-600 text-white border-blue-600 shadow-sm">
                                PALING DIMINATI
                            </span>
                        </div>

                        <h3 class="font-heading font-extrabold text-xl text-slate-900 mb-1.5">UTBK Mandiri &amp; SNBT Kilat</h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Drill super intensif TPS, Penalaran Umum, Literasi B. Indo &amp; B. Inggris serta Tes Skolastik.</p>

                        <div class="mb-5 pb-5 border-b border-slate-100">
                            <span class="text-xs text-slate-400 font-semibold">Biaya Investasi Mulai</span>
                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="text-xs font-bold text-slate-500">Rp</span>
                                <span class="font-heading font-extrabold text-2xl text-slate-900">1.450.000</span>
                                <span class="text-xs text-slate-500 font-medium">/ bln</span>
                            </div>
                        </div>

                        <ul class="space-y-2.5 text-xs text-slate-600 mb-6">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>5x Pertemuan Tambahan Latihan / Pekan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>15x Tryout Resmi CBT IRT (Item Response)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Prediksi Rasionalisasi Peluang Jurusan</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Masterclass Bedah Soal HOTS &amp; Trik Kilat</span>
                            </li>
                        </ul>
                    </div>

                    <button type="button" onclick="openRegistrationModal('UTBK Mandiri & SNBT Kilat')"
                            class="w-full py-2.5 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-sm transition flex items-center justify-center gap-2">
                        <span>PILIH PROGRAM INI &rarr;</span>
                    </button>
                </div>

                <!-- CARD 4: Garansi PTN Privat Maksimal -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 bimbel-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg border bg-amber-50 text-amber-700 border-amber-300">
                                GARANSI LOLOS 100%
                            </span>
                        </div>

                        <h3 class="font-heading font-extrabold text-xl text-slate-900 mb-1.5">Garansi PTN Privat Maksimal</h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">Bimbingan 1 on 1 eksklusif modul khusus target UI, ITB, UGM, Kedokteran &amp; Sekolah Kedinasan.</p>

                        <div class="mb-5 pb-5 border-b border-slate-100">
                            <span class="text-xs text-slate-400 font-semibold">Biaya Investasi Mulai</span>
                            <div class="flex items-baseline gap-1 mt-0.5">
                                <span class="text-xs font-bold text-slate-500">Rp</span>
                                <span class="font-heading font-extrabold text-2xl text-slate-900">2.800.000</span>
                                <span class="text-xs text-slate-500 font-medium">/ bln</span>
                            </div>
                        </div>

                        <ul class="space-y-2.5 text-xs text-slate-600 mb-6">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Jadwal Fleksibel (Bisa di Rumah / Online)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Tutor Lulusan PTN Top &amp; Berpengalaman</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Konsultasi Jurusan Bersama Psikolog</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                                <span>Jaminan Garansi Belajar Ulang Gratis</span>
                            </li>
                        </ul>
                    </div>

                    <button type="button" onclick="openRegistrationModal('Garansi PTN Privat Maksimal')"
                            class="w-full py-2.5 rounded-xl text-xs font-bold bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 border border-slate-200 transition flex items-center justify-center gap-2">
                        <span>PILIH PROGRAM INI &rarr;</span>
                    </button>
                </div>

            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 5. INTERACTIVE SIMULATOR (Sesuai Foto Asli)               -->
    <!-- ========================================================= -->
    <section id="simulasi" class="py-12 sm:py-16 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            
            <div class="bg-white border-2 border-blue-200/80 rounded-3xl p-6 sm:p-10 shadow-lg shadow-blue-500/5">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Left: Form inputs -->
                    <div class="lg:col-span-7">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">KALKULATOR INVESTASI</span>
                        <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                            Simulasikan Kebutuhan Belajar Anda
                        </h2>
                        <p class="text-xs sm:text-sm text-slate-500 mt-1 mb-6">
                            Hitung estimasi total investasi pendidikan berdasarkan jenjang bimbingan &amp; opsi skema pembayaran.
                        </p>

                        <div class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pilih Program Bimbingan</label>
                                    <select id="sim-program" onchange="calculateSimulator()" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs font-semibold py-2.5 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                                        <option value="1450000" selected>UTBK Mandiri &amp; SNBT Kilat (Rp 1.450.000 / bln)</option>
                                        <option value="750000">SD Juara &amp; Olimpiade (Rp 750.000 / bln)</option>
                                        <option value="950000">SMP Prestasi &amp; SMA Unggulan (Rp 950.000 / bln)</option>
                                        <option value="2800000">Garansi PTN Privat Maksimal (Rp 2.800.000 / bln)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Skema Pembayaran</label>
                                    <select id="sim-skema" onchange="calculateSimulator()" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs font-semibold py-2.5 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                                        <option value="10" selected>Lunas 1 Tahun Penuh (Diskon 1 Bulan)</option>
                                        <option value="6">Per Semester (6 Bulan)</option>
                                        <option value="1">Bulanan Fleksibel</option>
                                    </select>
                                </div>
                            </div>

                            <div class="pt-2">
                                <label class="block text-xs font-semibold text-slate-700 mb-2">Tambahan Layanan (Opsional)</label>
                                <div class="space-y-2">
                                    <label class="flex items-center gap-2.5 text-xs text-slate-600 cursor-pointer">
                                        <input type="checkbox" id="sim-addon-modul" onchange="calculateSimulator()" checked class="w-4 h-4 text-blue-600 rounded">
                                        <span>Modul Fisik Eksklusif + Tryout Cetak (+ Rp 300.000)</span>
                                    </label>
                                    <label class="flex items-center gap-2.5 text-xs text-slate-600 cursor-pointer">
                                        <input type="checkbox" id="sim-addon-tryout" onchange="calculateSimulator()" checked class="w-4 h-4 text-blue-600 rounded">
                                        <span>Bimbingan Privat 1-on-1 Intensif (+ Rp 200.000)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Result summary card (Total: Rp 13.550.000 Sesuai Foto) -->
                    <div class="lg:col-span-5">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-2xl p-6">
                            <div class="flex items-center justify-between pb-3 border-b border-blue-200/80 mb-3 text-xs">
                                <span class="font-bold text-slate-700">Ringkasan Estimasi Biaya</span>
                                <span class="text-[11px] font-bold text-blue-700 bg-blue-100 px-2 py-0.5 rounded">T.A 2025/2026</span>
                            </div>

                            <div class="space-y-2 text-xs text-slate-600 mb-4">
                                <div class="flex justify-between">
                                    <span>Biaya Program / bln</span>
                                    <strong id="sim-res-pokok" class="text-slate-900 font-mono">Rp 14.500.000</strong>
                                </div>
                                <div class="flex justify-between text-emerald-600">
                                    <span>Diskon Gelombang Early Bird</span>
                                    <strong id="sim-res-diskon" class="font-mono">- Rp 1.450.000</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span>Tambahan Layanan</span>
                                    <strong id="sim-res-addon" class="text-slate-900 font-mono">+ Rp 500.000</strong>
                                </div>
                            </div>

                            <div class="pt-3 border-t border-blue-200/80 mb-5">
                                <span class="text-[11px] text-slate-500 font-semibold block">Total Biaya Investasi Belajar</span>
                                <div class="font-heading font-extrabold text-2xl sm:text-3xl text-blue-700 mt-0.5">
                                    Rp <span id="sim-res-total">13.550.000</span>
                                </div>
                                <p class="text-[10px] text-slate-500 mt-0.5">*Dapat dicicil hingga 3x pembayaran tanpa bunga.</p>
                            </div>

                            <button type="button" onclick="openRegistrationModal('Hasil Simulasi Biaya')" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                                <i class="fa-solid fa-file-invoice text-xs"></i>
                                <span>Daftarkan Program Ini &rarr;</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 6. COMPARISON MATRIX TABLE (Sesuai Foto Asli)             -->
    <!-- ========================================================= -->
    <section id="matriks" class="py-12 sm:py-16 px-4 sm:px-8 bg-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">MATRIKS PERBANDINGAN</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight mt-2">
                    Bandingkan Fasilitas &amp; Keunggulan Antar Program
                </h2>
                <p class="text-slate-600 text-sm mt-2">
                    Transparan tanpa biaya tersembunyi. Semua fasilitas tercatat detail sebelum Anda mendaftar.
                </p>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-200 shadow-2xs">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-slate-800 font-heading font-bold uppercase text-[11px] border-b border-slate-200">
                        <tr>
                            <th class="p-4 sm:p-5">Fasilitas / Fitur</th>
                            <th class="p-4 sm:p-5">SD Juara</th>
                            <th class="p-4 sm:p-5">SMP Prestasi</th>
                            <th class="p-4 sm:p-5 bg-blue-50 text-blue-700">UTBK Intensif</th>
                            <th class="p-4 sm:p-5">Garansi PTN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 sm:p-5 font-bold text-slate-800">Kapasitas per Kelas</td>
                            <td class="p-4 sm:p-5">Maks 10 Siswa</td>
                            <td class="p-4 sm:p-5">Maks 10 Siswa</td>
                            <td class="p-4 sm:p-5 bg-blue-50/50 font-bold text-blue-800">Maks 10 Siswa</td>
                            <td class="p-4 sm:p-5 font-bold text-amber-700">1-on-1 Eksklusif</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 sm:p-5 font-bold text-slate-800">Pertemuan Tatap Muka</td>
                            <td class="p-4 sm:p-5">3x / Pekan</td>
                            <td class="p-4 sm:p-5">4x / Pekan</td>
                            <td class="p-4 sm:p-5 bg-blue-50/50 font-bold text-blue-800">5x / Pekan</td>
                            <td class="p-4 sm:p-5 font-bold text-amber-700">6x / Pekan Fleksibel</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 sm:p-5 font-bold text-slate-800">Latihan CBT Komputer</td>
                            <td class="p-4 sm:p-5">-</td>
                            <td class="p-4 sm:p-5">4x / Semester</td>
                            <td class="p-4 sm:p-5 bg-blue-50/50 font-bold text-blue-800">15x Tryout IRT</td>
                            <td class="p-4 sm:p-5 font-bold text-amber-700">Unlimited Tryout Pribadi</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 sm:p-5 font-bold text-slate-800">Tanya PR &amp; Konsultasi 1-on-1</td>
                            <td class="p-4 sm:p-5">Terbatas Jam Tertentu</td>
                            <td class="p-4 sm:p-5">1x / Pekan Gratis</td>
                            <td class="p-4 sm:p-5 bg-blue-50/50 font-bold text-blue-800">3x / Pekan Gratis</td>
                            <td class="p-4 sm:p-5 font-bold text-amber-700">Bebas Setiap Hari</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 sm:p-5 font-bold text-slate-800">Pemetaan Minat &amp; Psikotes</td>
                            <td class="p-4 sm:p-5">-</td>
                            <td class="p-4 sm:p-5">-</td>
                            <td class="p-4 sm:p-5 bg-blue-50/50 font-bold text-blue-800">Ada (Tes Minat Bakat)</td>
                            <td class="p-4 sm:p-5 font-bold text-amber-700">Full Profiling Psikolog Khusus</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 sm:p-5 font-bold text-slate-800">Garansi Belajar Ulang / Cashback</td>
                            <td class="p-4 sm:p-5">-</td>
                            <td class="p-4 sm:p-5">-</td>
                            <td class="p-4 sm:p-5 bg-blue-50/50 font-bold text-blue-800">Diskon Re-enrollment 50%</td>
                            <td class="p-4 sm:p-5 font-bold text-amber-700">Garansi 100% Uang Kembali*</td>
                        </tr>
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 sm:p-5 font-bold text-slate-800">Akses Modul &amp; Portal Siswa</td>
                            <td class="p-4 sm:p-5">Akses Selama Aktif</td>
                            <td class="p-4 sm:p-5">Akses Selama Aktif</td>
                            <td class="p-4 sm:p-5 bg-blue-50/50 font-bold text-blue-800">Full Akses 1 Tahun Penuh</td>
                            <td class="p-4 sm:p-5 font-bold text-amber-700">Akses Seumur Hidup (Lifetime)</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 7. INCLUDED MODERN FACILITIES (Sesuai Foto Asli)          -->
    <!-- ========================================================= -->
    <section id="fasilitas" class="py-12 sm:py-16 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">STANDAR FASILITAS EduPulse Academy</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                    Semua Program Sudah Termasuk Fasilitas Modern Ini
                </h2>
                <p class="text-slate-600 text-sm mt-1">
                    Semua sarana dan prasarana belajar berstandar tinggi tanpa biaya ekstra.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-2xs bimbel-card">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg mb-3">
                        <i class="fa-solid fa-snowflake"></i>
                    </div>
                    <h4 class="font-heading font-bold text-sm text-slate-900 mb-1">Kelas Nyaman &amp; Full AC</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Suasana belajar dingin &amp; tenang dengan kapasitas maksimal 10 siswa per kelas.</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-2xs bimbel-card">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg mb-3">
                        <i class="fa-solid fa-desktop"></i>
                    </div>
                    <h4 class="font-heading font-bold text-sm text-slate-900 mb-1">Laboratorium Komputer CBT</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">PC spesifikasi tinggi dengan simulasi interface UTBK SNBT sesungguhnya.</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-2xs bimbel-card">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg mb-3">
                        <i class="fa-solid fa-mug-saucer"></i>
                    </div>
                    <h4 class="font-heading font-bold text-sm text-slate-900 mb-1">Study Lounge &amp; Cafe</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Area santai dengan free WiFi berkecepatan tinggi &amp; minuman hangat gratis.</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-2xs bimbel-card">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg mb-3">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h4 class="font-heading font-bold text-sm text-slate-900 mb-1">Tanya PR Setiap Saat Bebas</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Bebas konsultasi tugas sekolah di luar jam bimbingan tanpa dipungut biaya.</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-2xs bimbel-card">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg mb-3">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                    </div>
                    <h4 class="font-heading font-bold text-sm text-slate-900 mb-1">Aplikasi Portal Siswa Modern</h4>
                    <p class="text-[11px] text-slate-500 leading-relaxed">Akses modul materi, rekaman zoom, jadwal kelas, dan rapor berkala real-time.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 8. LEARNING ENVIRONMENT GALLERY (Sesuai Foto Asli)        -->
    <!-- ========================================================= -->
    <section id="lingkungan" class="py-12 sm:py-16 px-4 sm:px-8 bg-white border-t border-slate-200/80">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">ATMOSFER KELAS NYAMAN</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                    Lingkungan Belajar yang Menumbuhkan Prestasi
                </h2>
                <p class="text-slate-600 text-sm mt-1">
                    Fasilitas fisik yang didesain estetik agar siswa betah berlama-lama belajar &amp; berdiskusi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Photo 1 -->
                <div class="group relative rounded-2xl overflow-hidden border border-slate-200 shadow-xs h-64 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=700&q=80"
                         alt="Kelas Interaktif" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h4 class="font-heading font-bold text-base">Kelas Interaktif Maksimal 10 Siswa</h4>
                        <p class="text-xs text-slate-300 mt-0.5">Tutor dapat membimbing setiap kesulitan siswa secara individual.</p>
                    </div>
                </div>

                <!-- Photo 2 -->
                <div class="group relative rounded-2xl overflow-hidden border border-slate-200 shadow-xs h-64 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80"
                         alt="Simulasi CBT" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h4 class="font-heading font-bold text-base">Simulasi CBT Tryout UTBK Komputer</h4>
                        <p class="text-xs text-slate-300 mt-0.5">Membiasakan siswa dengan manajemen waktu ujian sesungguhnya.</p>
                    </div>
                </div>

                <!-- Photo 3 -->
                <div class="group relative rounded-2xl overflow-hidden border border-slate-200 shadow-xs h-64 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=700&q=80"
                         alt="Konsultasi PR" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <h4 class="font-heading font-bold text-base">Konsultasi Privat Bebas Tanya PR</h4>
                        <p class="text-xs text-slate-300 mt-0.5">Study lounge nyaman untuk tugas sekolah kapan saja.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 9. TESTIMONIALS (Sesuai Foto Asli)                        -->
    <!-- ========================================================= -->
    <section id="testimoni" class="py-12 sm:py-16 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">BUKTI KELULUSAN ALUMNI</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                    Investasi Masa Depan yang Terbukti Membuahkan Hasil
                </h2>
                <p class="text-slate-600 text-sm mt-1">
                    Cerita nyata dari siswa yang berhasil mewujudkan impian masuk PTN idaman.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs bimbel-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic mb-6">
                            "Investasi di kelas UTBK Kilat EduPulse Academy adalah keputusan terbaik saya. Soal-soal tryoutnya persis polanya dan bimbingan mentornya sangat terstruktur."
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">
                            FR
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-sm text-slate-900 leading-tight">Farel Ramadhan</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Lolos STEI ITB 2024 (Alumni SMAN 28)</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs bimbel-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic mb-6">
                            "Biaya bimbingan sangat sebanding dengan kemajuan anak saya. Dulunya matematika nilai 60, sekarang langganan juara kelas dan lolos SMPN 1."
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs">
                            DA
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-sm text-slate-900 leading-tight">Ibu Dini Anggraeni</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Orang Tua Siswa SD Juara</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs bimbel-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic mb-6">
                            "Program privat garansi beneran mendampingi dari nol sampai hari H pengumuman SNBT. Profiling jurusan dari psikolognya sangat akurat."
                        </p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs">
                            NP
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-sm text-slate-900 leading-tight">Nabila Putri, S.Ked</h4>
                            <p class="text-[11px] text-slate-500 mt-0.5">Lolos FK UI 2024 (Alumni Program Garansi)</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 10. CTA BANNER (Sesuai Foto Asli)                         -->
    <!-- ========================================================= -->
    <section class="py-8 sm:py-12 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 rounded-3xl p-8 sm:p-12 text-white shadow-xl shadow-blue-600/10 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div class="max-w-xl">
                    <span class="text-xs font-bold uppercase tracking-wider bg-white/20 text-white px-2.5 py-0.5 rounded-md">KONSULTASI GRATIS JURUSAN &amp; BIAYA</span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl mt-2 leading-tight">
                        Belum Yakin Memilih Program yang Tepat?
                    </h2>
                    <p class="text-xs sm:text-sm text-blue-100 mt-2 leading-relaxed">
                        Diskusikan kebutuhan belajar ananda bersama master konselor akademik kami untuk pemetaan skor dan pemilihan jenjang yang paling ideal.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <button type="button" onclick="openRegistrationModal('Konsultasi Program')" class="px-6 py-3.5 bg-white hover:bg-slate-100 text-blue-700 font-bold text-xs sm:text-sm rounded-xl transition shadow-sm">
                        Jadwalkan Konsultasi
                    </button>
                    <a href="https://wa.me/6281299887711" target="_blank"
                       class="px-6 py-3.5 bg-blue-800/80 hover:bg-blue-800 text-white border border-blue-400/40 font-bold text-xs sm:text-sm rounded-xl transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                        <span>Chat WhatsApp Konselor</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 11. FOOTER (Sesuai Foto Asli)                             -->
    <!-- ========================================================= -->
    <footer class="bg-white border-t border-slate-200 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            <!-- Brand Column -->
            <div>
                <div class="flex items-center gap-2.5 mb-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <span class="font-heading font-extrabold text-lg text-slate-900">EduPulse Academy</span>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-4">
                    Pusat bimbingan belajar dan persiapan masuk PTN, kedinasan, dan sekolah unggulan terkemuka di Indonesia.
                </p>
            </div>

            <!-- Cabang & Kontak -->
            <div>
                <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Cabang Jakarta Selatan</h4>
                <p class="leading-relaxed">Jl. Pendidikan Prestasi No. 45, Kebayoran Baru, Jakarta Selatan 12150</p>
                <p class="mt-2"><strong class="text-slate-700">Hotline CS:</strong> 0812-9988-7711</p>
                <p class="mt-1"><strong class="text-slate-700">Jam Layanan:</strong> 08:00 - 20:00 WIB</p>
            </div>

            <!-- Akses Cepat -->
            <div>
                <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Akses Cepat Siswa</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/bimbel') }}" class="hover:text-blue-600 transition">Beranda Utama</a></li>
                    <li><a href="{{ url('/bimbel') }}" class="hover:text-blue-600 transition">Rincian Program &amp; Biaya</a></li>
                    <li><a href="{{ url('/bimbel-dashboard') }}" class="hover:text-blue-600 transition">Portal Nilai Siswa (Login)</a></li>
                </ul>
            </div>

            <!-- Layanan Terkait -->
            <div>
                <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Layanan &amp; Komunitas</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="hover:text-blue-600 transition">Kursus IT &amp; Coding</a></li>
                    <li><a href="{{ url('/magang') }}" class="hover:text-blue-600 transition">Portal PKL / Magang</a></li>
                    <li><a href="{{ url('/bengkel') }}" class="hover:text-blue-600 transition">MotoPro Workshop</a></li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-400 text-[11px]">
            <p>&copy; 2025 EduPulse Academy &bull; elc.my.id. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- ========================================================= -->
    <!-- MODAL PENDAFTARAN & PILIH CABANG                          -->
    <!-- ========================================================= -->
    <div id="modal-registrasi" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative">
            <button type="button" onclick="closeRegistrationModal()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                <i class="fa-solid fa-times"></i>
            </button>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900 leading-tight">Daftar &amp; Rincian Biaya</h3>
                    <p class="text-xs text-slate-500">Pendaftaran kelas baru periode 2025/2026</p>
                </div>
            </div>

            <form action="{{ route('bimbel.daftar') }}" method="POST" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Siswa</label>
                    <input type="text" name="nama_siswa" required placeholder="Nama lengkap siswa..."
                           class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm py-2 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp</label>
                    <input type="text" name="no_whatsapp" required placeholder="08123456789..."
                           class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm py-2 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Paket Bimbingan Dipilih</label>
                    <input type="text" id="modal-paket-input" name="jenjang" value="UTBK Mandiri & SNBT Kilat"
                           class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm py-2 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Asal Sekolah</label>
                    <input type="text" name="sekolah_asal" placeholder="Nama sekolah saat ini..."
                           class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm py-2 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane text-xs"></i>
                        <span>Kirim Pendaftaran Program</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Branch Modal -->
    <div id="modal-branch" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-slate-200 relative">
            <button type="button" onclick="closeBranchModal()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                <i class="fa-solid fa-times"></i>
            </button>
            <h3 class="font-heading font-extrabold text-base text-slate-900 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-location-dot text-blue-600"></i> Pilih Cabang EduPulse Academy
            </h3>
            <div class="space-y-2 text-xs">
                <div class="p-3 bg-blue-50 border border-blue-200 rounded-xl font-bold text-blue-700 flex items-center justify-between">
                    <span>Cabang Jakarta Selatan (Pusat)</span>
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-100 transition cursor-pointer" onclick="closeBranchModal()">
                    <span>Cabang Jakarta Timur (Rawamangun)</span>
                </div>
                <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-100 transition cursor-pointer" onclick="closeBranchModal()">
                    <span>Cabang Depok &amp; Margonda</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================================= -->
    <!-- JAVASCRIPT LOGIC                                          -->
    <!-- ========================================================= -->
    <script>
        // Drawer Mobile Navigation
        const bimbelDrawer  = document.getElementById('bimbel-nav-drawer');
        const bimbelOverlay = document.getElementById('bimbel-nav-overlay');
        const bbar1 = document.getElementById('bbar1');
        const bbar2 = document.getElementById('bbar2');
        const bbar3 = document.getElementById('bbar3');
        let bimbelNavOpen = false;

        function openBimbelNav() {
            bimbelDrawer.style.transform = 'translateX(0)';
            bimbelOverlay.style.opacity = '1';
            bimbelOverlay.style.visibility = 'visible';
            document.body.style.overflow = 'hidden';
            bbar1.style.transform = 'translateY(6px) rotate(45deg)';
            bbar2.style.opacity = '0';
            bbar3.style.transform = 'translateY(-6px) rotate(-45deg)';
            bimbelNavOpen = true;
        }

        function closeBimbelNav() {
            bimbelDrawer.style.transform = 'translateX(100%)';
            bimbelOverlay.style.opacity = '0';
            bimbelOverlay.style.visibility = 'hidden';
            document.body.style.overflow = '';
            bbar1.style.transform = '';
            bbar2.style.opacity = '1';
            bbar3.style.transform = '';
            bimbelNavOpen = false;
        }

        function toggleBimbelNav() {
            bimbelNavOpen ? closeBimbelNav() : openBimbelNav();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (bimbelNavOpen) closeBimbelNav();
                closeRegistrationModal();
                closeBranchModal();
            }
        });

        // Simulator Calculation
        function calculateSimulator() {
            const price = parseInt(document.getElementById('sim-program').value) || 0;
            const months = parseInt(document.getElementById('sim-skema').value) || 1;
            const addonModul = document.getElementById('sim-addon-modul').checked ? 300000 : 0;
            const addonTryout = document.getElementById('sim-addon-tryout').checked ? 200000 : 0;
            const totalAddon = addonModul + addonTryout;

            const totalPokok = price * (months === 10 ? 10 : (months === 6 ? 6 : 1));
            // Discount 1 month if paying 1 year
            const discount = (months === 10 && price > 0) ? price : 0;
            const grandTotal = Math.max(0, totalPokok - discount + totalAddon);

            const formatRupiah = (num) => new Intl.NumberFormat('id-ID').format(num);

            document.getElementById('sim-res-pokok').innerText = 'Rp ' + formatRupiah(totalPokok);
            document.getElementById('sim-res-diskon').innerText = '- Rp ' + formatRupiah(discount);
            document.getElementById('sim-res-addon').innerText = '+ Rp ' + formatRupiah(totalAddon);
            document.getElementById('sim-res-total').innerText = formatRupiah(grandTotal);
        }

        // Registration Modal Handlers
        function openRegistrationModal(paketName) {
            if (paketName) {
                document.getElementById('modal-paket-input').value = paketName;
            }
            const modal = document.getElementById('modal-registrasi');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeRegistrationModal() {
            const modal = document.getElementById('modal-registrasi');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function openBranchModal() {
            const m = document.getElementById('modal-branch');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }

        function closeBranchModal() {
            const m = document.getElementById('modal-branch');
            m.classList.add('hidden');
            m.classList.remove('flex');
        }
    </script>
</body>
</html>
