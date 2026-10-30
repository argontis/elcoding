<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Siswa &amp; Orang Tua — {{ $institution['name'] ?? 'EduPulse Academy' }}</title>
    <meta name="description" content="Informasi &amp; Akses Portal Siswa dan Orang Tua EduPulse Academy Cabang Tebet. Pantau presensi, rapor tryout IRT, jadwal kelas bimbingan, dan modul belajar digital.">

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

        .portal-card { transition: all 0.2s ease-in-out; }
        .portal-card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px -6px rgba(15, 23, 42, 0.08); }
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
                    <span class="font-heading font-extrabold text-lg sm:text-xl tracking-tight text-blue-700">EduPulse Academy</span>
                    <span class="text-[10px] font-bold bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full border border-blue-200 whitespace-nowrap">Cabang Tebet Clean</span>
                </div>
                <p class="text-[9px] text-slate-400 font-mono -mt-0.5">localhost:8000/clean</p>
            </div>
        </a>

        <!-- Desktop Nav Links (Selalu Kesamping / No-Wrap) -->
        <nav class="hidden lg:flex items-center gap-2 xl:gap-3.5 2xl:gap-5 text-xs xl:text-[13px] font-semibold text-slate-600 whitespace-nowrap shrink-0">
            <a href="{{ route('bimbel.landing') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Beranda</a>
            <a href="{{ route('bimbel.program.page') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Program &amp; Biaya</a>
            <a href="{{ route('bimbel.pendaftaran') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Pendaftaran Baru</a>
            <a href="{{ route('bimbel.tryout') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Cek Nilai Tryout</a>
            <a href="{{ route('bimbel.portal') }}" class="px-3 py-1.5 bg-blue-600 text-white font-bold rounded-xl shadow-sm transition hover:bg-blue-700 whitespace-nowrap">Portal Siswa &amp; Ortu</a>
            <a href="{{ route('bimbel.kontak') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Kontak Cabang</a>
        </nav>

        <!-- Right: Masuk Akun + Hamburger -->
        <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
            <button type="button"
                    onclick="bukaModalLogin()"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-white bg-blue-900 hover:bg-blue-800 rounded-xl shadow-sm transition whitespace-nowrap">
                <i class="fa-solid fa-arrow-right-to-bracket text-[11px]"></i>
                <span>Masuk Akun</span>
            </button>

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
                <div class="font-heading font-extrabold text-base text-blue-700 leading-none">EduPulse Academy</div>
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
        <a href="{{ route('bimbel.tryout') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-chart-simple text-slate-400 w-5"></i> Cek Nilai Tryout
        </a>
        <a href="{{ route('bimbel.portal') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-sm transition">
            <i class="fa-solid fa-id-card-clip w-5"></i> Portal Siswa &amp; Ortu
        </a>
        <a href="#footer" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-phone text-slate-400 w-5"></i> Kontak Cabang
        </a>
        <div class="border-t border-slate-100 my-3"></div>
        <button type="button" onclick="closeBimbelNav(); bukaModalLogin();" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-bold text-white bg-blue-900 hover:bg-blue-800 transition shadow-sm">
            <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Masuk Akun
        </button>
    </nav>
    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50 text-xs text-slate-500">
        <p class="font-bold text-slate-700">EduPulse Academy Hotline</p>
        <p>{{ $institution['hotline'] ?? '(021) 8370-1920' }}</p>
    </div>
</div>

{{-- ===================================================================
     3. HERO SECTION — PEMBERITAHUAN PORTAL AKADEMIK
     =================================================================== --}}
<section class="py-12 px-4 sm:px-8 bg-gradient-to-b from-blue-50/60 via-white to-slate-50 border-b border-slate-200/60">
    <div class="max-w-4xl mx-auto text-center space-y-4">

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-100/80 border border-blue-200 rounded-full text-xs font-bold text-blue-800">
            <i class="fa-solid fa-shield-halved text-blue-600 text-xs"></i>
            <span>Sistem Informasi Akademik Terpadu Siswa &amp; Wali Murid</span>
        </div>

        <!-- Heading & Subheading -->
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading tracking-tight leading-tight">
            Portal Akademik Siswa &amp; Orang Tua
        </h1>
        <p class="text-sm text-slate-600 max-w-2xl mx-auto leading-relaxed">
            Layanan pemantauan terpadu presensi kehadiran, progres skor tryout SNBT, modul digital, serta konsultasi belajar interaktif bersama Master Tutor EduPulse Academy Tebet.
        </p>

        <!-- Action Buttons -->
        <div class="pt-3 flex flex-wrap items-center justify-center gap-3">
            <button type="button"
                    onclick="bukaModalLogin()"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-md shadow-blue-500/20 transition">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                <span>Masuk ke Akun Portal</span>
            </button>
            <a href="{{ route('bimbel.pendaftaran') }}"
               class="inline-flex items-center gap-2 px-5 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition border border-slate-200">
                <i class="fa-solid fa-user-plus text-xs text-blue-600"></i>
                <span>Daftar Siswa Baru</span>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================================
     4. BANNER PEMBERITAHUAN RESMI
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
                        <h2 class="text-sm font-bold text-blue-900 font-heading">Pemberitahuan Akses Portal</h2>
                        <span class="text-[10px] font-extrabold bg-blue-200 text-blue-800 px-2 py-0.5 rounded-full">Informasi Resmi</span>
                    </div>
                    <p class="text-xs text-blue-800/90 mt-1 leading-relaxed">
                        Halaman ini merupakan <strong>halaman pemberitahuan &amp; pratinjau publik</strong> mengenai fasilitas Portal Siswa &amp; Orang Tua EduPulse Academy. Karena sistem portal terhubung dengan data akun privat (NISN &amp; password terenkripsi), silakan gunakan tombol <strong>Masuk Akun</strong> untuk membuka dasbor akademik pribadi Anda.
                    </p>
                </div>
            </div>
            <button type="button"
                    onclick="bukaModalLogin()"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-sm transition shrink-0 w-full sm:w-auto justify-center">
                <i class="fa-solid fa-lock text-xs"></i>
                <span>Masuk Akun</span>
            </button>
        </div>
    </div>
</section>

{{-- ===================================================================
     5. PRATINJAU DASBOR PORTAL (SESUAI CONTOH GAMBAR)
     =================================================================== --}}
<main class="py-10 px-4 sm:px-8 flex-1">
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- SECTION TITLE: PRATINJAU ANTARMUKA PORTAL -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-200">
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">
                    Pratinjau Antarmuka Portal
                </span>
                <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 font-heading mt-1">
                    Fasilitas Lengkap Dasbor Siswa &amp; Orang Tua
                </h2>
            </div>
            <div class="text-xs text-slate-500">
                Mode Akses: <strong class="text-slate-700">Akun Siswa Aktif &bull; Akun Wali Murid</strong>
            </div>
        </div>

        {{-- TOP STATS ROW (Sesuai Foto: Presensi 96%, Skor 685.5, Tugas 18/20, SPP Lunas) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Stat 1: Presensi -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs portal-card">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span class="font-medium">Presensi Kehadiran</span>
                    <i class="fa-regular fa-calendar-check text-blue-600 text-sm"></i>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold font-heading text-slate-900">96%</span>
                    <span class="text-[11px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Tinggi</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-2">24 dari 25 Sesi Hadir (1 Izin Sakit)</p>
            </div>

            <!-- Stat 2: Skor Tryout -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs portal-card">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span class="font-medium">Rata-rata Skor Tryout</span>
                    <i class="fa-solid fa-chart-line text-blue-600 text-sm"></i>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold font-heading text-slate-900">685.5</span>
                    <span class="text-[11px] font-bold text-blue-700 bg-blue-50 px-2 py-0.5 rounded-full">+45 Poin</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-2">Peluang Masuk PTN: <strong class="text-blue-600">Sangat Kompetitif</strong></p>
            </div>

            <!-- Stat 3: Tugas & Quiz -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs portal-card">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span class="font-medium">Tugas &amp; Quiz Mandiri</span>
                    <i class="fa-solid fa-clipboard-check text-amber-600 text-sm"></i>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold font-heading text-slate-900">18 <span class="text-base font-normal text-slate-400">/ 20</span></span>
                    <span class="text-[11px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full">90% Tuntas</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-2">2 Modul Pengayaan TPS selesai dikerjakan</p>
            </div>

            <!-- Stat 4: SPP & Tagihan -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs portal-card">
                <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                    <span class="font-medium">Status Tagihan SPP</span>
                    <i class="fa-solid fa-receipt text-emerald-600 text-sm"></i>
                </div>
                <div class="flex items-baseline gap-2">
                    <span class="text-xs font-extrabold uppercase px-2.5 py-1 rounded-lg bg-emerald-100 text-emerald-800">
                        &bull; LUNAS
                    </span>
                    <span class="text-xs text-slate-500">Maret 2025</span>
                </div>
                <p class="text-[11px] text-slate-400 mt-2">Berikutnya: April 2025 (Jatuh tempo 10 Apr)</p>
            </div>
        </div>

        {{-- JADWAL BIMBINGAN MINGGU INI (Sesuai Foto Persis) --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-900 font-heading flex items-center gap-2">
                        <i class="fa-regular fa-calendar-days text-blue-600"></i>
                        Jadwal Bimbingan Minggu Ini
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Sesi tatap muka di Cabang Tebet &amp; Akses Kelas Hybrid Live Streaming</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-bold border border-blue-200">
                        <i class="fa-solid fa-qrcode text-[11px]"></i> Presensi QR Cabang
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-semibold">
                        <i class="fa-solid fa-link text-[11px]"></i> Link Kelas Hybrid
                    </span>
                </div>
            </div>

            <!-- 3 Class Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Sesi 1 -->
                <div class="rounded-2xl border border-blue-200 bg-blue-50/40 p-4 space-y-3">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="font-bold text-blue-700">SELASA, 18 MARET 2025</span>
                        <span class="px-2 py-0.5 bg-blue-600 text-white font-extrabold text-[9px] rounded-full">Hari Ini</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Penalaran Matematika &amp; TPS HOTS</h4>
                        <p class="text-xs text-slate-500 mt-0.5"><i class="fa-regular fa-clock text-[10px]"></i> 16.30 - 18.30 WIB (2 Jam Sesi)</p>
                    </div>
                    <div class="flex items-center gap-2.5 pt-1 border-t border-blue-100 text-xs">
                        <div class="w-7 h-7 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center text-[11px]">KF</div>
                        <div class="text-[11px] leading-tight">
                            <div class="font-bold text-slate-800">Kak Farhan, M.Si.</div>
                            <div class="text-slate-400">Ruang 302 &bull; Lab CBT Lantai 3</div>
                        </div>
                    </div>
                </div>

                <!-- Sesi 2 -->
                <div class="rounded-2xl border border-slate-200 bg-white p-4 space-y-3">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="font-bold text-slate-600">KAMIS, 20 MARET 2025</span>
                        <span class="px-2 py-0.5 bg-slate-100 text-slate-600 font-semibold text-[9px] rounded-full">Sesi Reguler</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Literasi Bahasa Inggris &amp; Reading Strategy</h4>
                        <p class="text-xs text-slate-500 mt-0.5"><i class="fa-regular fa-clock text-[10px]"></i> 16.30 - 18.30 WIB</p>
                    </div>
                    <div class="flex items-center gap-2.5 pt-1 border-t border-slate-100 text-xs">
                        <div class="w-7 h-7 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-[11px]">KN</div>
                        <div class="text-[11px] leading-tight">
                            <div class="font-bold text-slate-800">Kak Nadia, S.Hum.</div>
                            <div class="text-slate-400">Ruang 201 &bull; Kelas Diskusi</div>
                        </div>
                    </div>
                </div>

                <!-- Sesi 3 -->
                <div class="rounded-2xl border border-purple-200 bg-purple-50/40 p-4 space-y-3">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="font-bold text-purple-700">SABTU, 22 MARET 2025</span>
                        <span class="px-2 py-0.5 bg-purple-600 text-white font-extrabold text-[9px] rounded-full">Simulasi Ujian</span>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Tryout Mandiri CBT Nasional #5 (Sistem IRT)</h4>
                        <p class="text-xs text-slate-500 mt-0.5"><i class="fa-regular fa-clock text-[10px]"></i> 09.00 - 12.00 WIB (155 Soal)</p>
                    </div>
                    <div class="flex items-center gap-2.5 pt-1 border-t border-purple-100 text-xs">
                        <div class="w-7 h-7 rounded-full bg-purple-600 text-white font-bold flex items-center justify-center text-[11px]">CBT</div>
                        <div class="text-[11px] leading-tight">
                            <div class="font-bold text-slate-800">Simulasi Real UTBK</div>
                            <div class="text-slate-400">Laptop CBT Bimbel atau Mandiri</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TWO COLUMNS: MATERI & BANK SOAL (KIRI) + TANYA TENTOR AI (KANAN) --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

            <!-- LEFT (7 COLS): PUSAT UNDUHAN MATERI & BANK SOAL -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <h3 class="text-base font-bold text-slate-900 font-heading">Pusat Unduhan Materi &amp; Bank Soal</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Modul resmi bimbel kurikulum UTBK-SNBT 2025 terverifikasi tim litbang.</p>
                        </div>
                        <span class="text-[11px] font-bold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-lg border border-blue-200">3 Modul Baru</span>
                    </div>

                    <!-- Modul Items List -->
                    <div class="space-y-3">
                        <!-- Modul 1 -->
                        <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-200 transition">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg shrink-0">
                                    <i class="fa-regular fa-file-pdf"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Ringkasan Rumus Cepat Kuantitatif &amp; Matdas</h4>
                                    <p class="text-[11px] text-slate-400">Update Edisi Revisi &bull; 48 Halaman &bull; Format PDF (4.2 MB)</p>
                                    <span class="inline-block mt-1 text-[9px] font-bold bg-blue-100 text-blue-800 px-2 py-0.2 rounded">Trik 30 Detik</span>
                                </div>
                            </div>
                            <button onclick="bukaModalLogin()" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-xs transition shrink-0">
                                <i class="fa-solid fa-download text-[11px]"></i> Unduh PDF
                            </button>
                        </div>

                        <!-- Modul 2 -->
                        <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-200 transition">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-lg shrink-0">
                                    <i class="fa-regular fa-file-lines"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">E-Book 500 Soal HOTS SNBT 2025 + Kunci Kemenkeu/PTN</h4>
                                    <p class="text-[11px] text-slate-400">Paket Latihan Lengkap / Subtes UTBK &bull; Format PDF (17.5 MB)</p>
                                    <span class="inline-block mt-1 text-[9px] font-bold bg-amber-100 text-amber-800 px-2 py-0.2 rounded">Bank Soal Prediksi</span>
                                </div>
                            </div>
                            <button onclick="bukaModalLogin()" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-xs transition shrink-0">
                                <i class="fa-solid fa-download text-[11px]"></i> Unduh PDF
                            </button>
                        </div>

                        <!-- Modul 3 -->
                        <div class="flex items-center justify-between p-3.5 bg-slate-50 rounded-2xl border border-slate-100 hover:border-blue-200 transition">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-lg shrink-0">
                                    <i class="fa-regular fa-file-zipper"></i>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-900">Bank Soal &amp; Pembahasan Tryout Nasional IRT #4</h4>
                                    <p class="text-[11px] text-slate-400">Lengkap Pembobotan Nilai Butir Soal IRT &bull; Format PDF (8.1 MB)</p>
                                    <span class="inline-block mt-1 text-[9px] font-bold bg-emerald-100 text-emerald-800 px-2 py-0.2 rounded">Pembahasan Video Ready</span>
                                </div>
                            </div>
                            <button onclick="bukaModalLogin()" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-xs transition shrink-0">
                                <i class="fa-solid fa-download text-[11px]"></i> Unduh PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT (5 COLS): TANYA TENTOR AI & CHECKLIST PTN -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Tanya Tentor AI Card (Sesuai Foto Persis) -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-robot"></i>
                            </div>
                            <h3 class="text-sm font-bold text-slate-900 font-heading">Tanya Tentor AI &amp; Jaga</h3>
                        </div>
                        <span class="inline-flex items-center gap-1 text-[10px] font-extrabold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live 24 Jam
                        </span>
                    </div>

                    <p class="text-xs text-slate-500 leading-relaxed">
                        Bantu pengerjaan PR atau latihan soal? Masukkan soal atau upload foto untuk pembahasan rumus langkah-demi-langkah.
                    </p>

                    <!-- Mini Chat Preview -->
                    <div class="space-y-2 bg-slate-50 rounded-2xl p-3 border border-slate-100 text-xs">
                        <div class="bg-blue-100/70 text-blue-900 p-2.5 rounded-xl rounded-tl-none max-w-[85%] text-[11px] leading-relaxed">
                            Halo! Siap bantu bahas soal TPS, Matematika, Biologi, Kimia, atau Fisika hari ini. Ketik teks atau upload foto soal ya!
                        </div>
                        <div class="bg-blue-700 text-white p-2.5 rounded-xl rounded-tr-none max-w-[85%] ml-auto text-[11px] leading-relaxed">
                            Kak, rumus cepat turunan fungsi limit x &rarr; 0 untuk (sin 3x)/tan 6x bagaimana?
                        </div>
                        <div class="bg-blue-100/70 text-blue-900 p-2.5 rounded-xl rounded-tl-none max-w-[85%] text-[11px] leading-relaxed">
                            Gunakan kausalitas L'Hopital atau rumus dasar: lim x &rarr; 0 sin(ax)/tan(bx) = a/b = 3/6 = 1/2. Praktis dan tuntas dalam 5 detik!
                        </div>
                    </div>

                    <!-- Input Mock -->
                    <div class="space-y-2">
                        <div class="flex items-center gap-2">
                            <input type="text"
                                   placeholder="Ketik soal atau materi yang ingin ditanyakan..."
                                   class="flex-1 text-xs border border-slate-200 rounded-xl px-3 py-2.5 bg-slate-50 focus:outline-none focus:border-blue-500">
                        </div>
                        <div class="flex items-center justify-between gap-2">
                            <button type="button" onclick="bukaModalLogin()" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-xl flex items-center gap-1.5 transition">
                                <i class="fa-solid fa-camera text-[11px] text-blue-600"></i> Upload Foto
                            </button>
                            <button type="button" onclick="bukaModalLogin()" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold rounded-xl flex items-center gap-1.5 shadow-xs transition">
                                <i class="fa-solid fa-paper-plane text-[10px]"></i> Kirim Pertanyaan
                            </button>
                        </div>
                    </div>

                    <!-- Meja Konsultasi Fisik -->
                    <div class="p-3 bg-amber-50 rounded-2xl border border-amber-100 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-chalkboard-user text-amber-600"></i>
                            <span class="text-amber-900 font-medium text-[11px]">Tutor Jaga Fisik di Tebet (Meja Konsul Lt. 2)</span>
                        </div>
                        <button onclick="bukaModalLogin()" class="text-blue-700 font-bold hover:underline text-[11px]">Booking Sesi &rarr;</button>
                    </div>
                </div>

                <!-- Checklist Syarat PTN Impian (Sesuai Foto Persis) -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <h4 class="text-sm font-bold text-slate-900 font-heading">Checklist Syarat PTN Impian</h4>
                        <i class="fa-solid fa-graduation-cap text-blue-600"></i>
                    </div>
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center gap-2 text-slate-700">
                            <i class="fa-solid fa-square-check text-blue-600 text-sm"></i>
                            <span>Portofolio &amp; Rapor Semester 1–5 (Valid)</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700">
                            <i class="fa-solid fa-square-check text-blue-600 text-sm"></i>
                            <span>Simulasi IRT Skor di atas 670 (Tercapai)</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-700">
                            <i class="fa-regular fa-square text-slate-400 text-sm"></i>
                            <span>Simulasi Ujian Mandiri SIMAK UI (April)</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- SINKRONISASI BASIS DATA OTOMATIS (Sesuai Foto Persis) --}}
        <div class="bg-blue-50/50 rounded-2xl border border-blue-100 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs text-slate-500">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-network-wired text-blue-600 text-sm shrink-0"></i>
                <div class="text-[11px]">
                    <strong class="text-slate-800">Keterhubungan Sistem &amp; Sinkronisasi Otomatis:</strong> Seluruh data presensi dan nilai tersinkronisasi real-time dengan modul Akademik, Presensi, dan Keuangan pada Dashboard Admin Bimbel EduPulse Academy Tebet.
                </div>
            </div>
            <div class="flex items-center gap-1.5 text-emerald-700 font-bold shrink-0 text-[11px]">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span>Node Tebet-01: Online</span>
            </div>
        </div>

    </div>
</main>

{{-- ===================================================================
     6. FOOTER
     =================================================================== --}}
<footer id="footer" class="bg-white border-t border-slate-200 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500 mt-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">

        <!-- Col 1: Brand Info -->
        <div class="space-y-3">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold">
                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                </div>
                <span class="font-heading font-extrabold text-lg text-slate-900">EduPulse Academy</span>
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
                <li><a href="{{ route('bimbel.tryout') }}" class="hover:text-blue-600 transition">Ranking Tryout Nasional SNBT IRT</a></li>
                <li><a href="{{ route('bimbel.program.page') }}" class="hover:text-blue-600 transition">Jadwal Konsultasi Rasionalisasi Jurusan</a></li>
                <li><a href="{{ route('bimbel.pendaftaran') }}" class="hover:text-blue-600 transition">Beasiswa Prestasi &amp; Tahfidz</a></li>
                <li><a href="{{ route('bimbel.portal') }}" class="hover:text-blue-600 transition font-semibold text-blue-700">Unduh Silabus &amp; Modul Bank Soal</a></li>
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
        <p>&copy; {{ date('Y') }} Bimbel EduPulse Academy Cabang Jakarta Selatan. Seluruh Hak Cipta Dilindungi Undang-Undang.</p>
        <div class="flex items-center gap-4">
            <a href="#" class="hover:text-slate-600">Syarat &amp; Ketentuan</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-slate-600">Kebijakan Privasi Data Siswa</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-slate-600">Standar Operasional Belajar</a>
        </div>
    </div>
</footer>

<!-- MODAL MASUK AKUN / LOGIN -->
<div id="modal-login" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative">
        <button type="button" onclick="tutupModalLogin()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
            <i class="fa-solid fa-times"></i>
        </button>

        <div class="text-center space-y-2 mb-6">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto text-xl border border-blue-100">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900 font-heading">Masuk ke Portal Siswa &amp; Ortu</h3>
            <p class="text-xs text-slate-500">Masukkan NISN atau Nomor WhatsApp terdaftar Anda</p>
        </div>

        <form onsubmit="event.preventDefault(); alert('Pemberitahuan: Akun sistem akademik sudah terdaftar di database EduPulse Academy. Silakan gunakan kredensial resmi Anda.');" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">NISN / Nomor Ponsel Siswa</label>
                <div class="relative">
                    <i class="fa-regular fa-id-card absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text"
                           placeholder="Contoh: 0068912345 atau 0812xxxx"
                           class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                           required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kata Sandi (Password)</label>
                <div class="relative">
                    <i class="fa-solid fa-key absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="password"
                           placeholder="Masukkan kata sandi akun"
                           class="w-full pl-9 pr-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                           required>
                </div>
            </div>

            <div class="flex items-center justify-between text-[11px] text-slate-500">
                <label class="flex items-center gap-1.5 cursor-pointer">
                    <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500">
                    <span>Ingat Saya</span>
                </label>
                <a href="https://wa.me/{{ $institution['whatsapp'] ?? '6281299003420' }}?text=Halo+Apex+Edu%2C+saya+lupa+password+portal+siswa." target="_blank" class="text-blue-600 hover:underline font-medium">Lupa Sandi?</a>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md shadow-blue-500/20 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                <span>Masuk Sekarang</span>
            </button>
        </form>

        <div class="mt-4 pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
            Belum punya akun siswa?
            <a href="{{ route('bimbel.pendaftaran') }}" class="font-bold text-blue-600 hover:underline">Daftar Siswa Baru &rarr;</a>
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
    function bukaModalLogin() {
        const m = document.getElementById('modal-login');
        m.classList.remove('hidden');
        m.classList.add('flex');
    }
    function tutupModalLogin() {
        const m = document.getElementById('modal-login');
        m.classList.add('hidden');
        m.classList.remove('flex');
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeBimbelNav();
            tutupModalLogin();
        }
    });
</script>
</body>
</html>
