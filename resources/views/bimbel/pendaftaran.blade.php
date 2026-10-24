<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru TA {{ $institution['tahun_ajaran'] ?? '2025/2026' }} — {{ $institution['name'] ?? 'Apex Edu' }}</title>
    <meta name="description" content="Daftar sekarang sebagai siswa baru Bimbel Apex Edu Cabang Tebet. Pilihan program Reguler, UTBK Intensif Garansi, dan Privat 1-on-1 dengan diskon Early Bird s.d 25%.">

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

        ::-webkit-scrollbar { width: 7px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .step-card { transition: all 0.25s ease; }
        .step-card:hover { transform: translateY(-4px); box-shadow: 0 16px 28px -8px rgba(37,99,235,0.12), 0 4px 12px -2px rgba(0,0,0,0.04); }

        .pkg-card { transition: all 0.22s ease; }
        .pkg-card:hover { transform: translateY(-5px); box-shadow: 0 20px 32px -8px rgba(37,99,235,0.14); }

        @keyframes hero-pulse { 0%,100%{ opacity:0.25; transform:scale(1); } 50%{ opacity:0.4; transform:scale(1.05); } }
        .hero-blob { animation: hero-pulse 7s ease-in-out infinite; }
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

        <!-- Desktop Nav -->
        <nav class="hidden lg:flex items-center gap-2 xl:gap-3.5 2xl:gap-5 text-xs xl:text-[13px] font-semibold text-slate-600 whitespace-nowrap">
            <a href="{{ route('bimbel.landing') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Beranda</a>
            <a href="{{ route('bimbel.program.page') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Program &amp; Biaya</a>
            <a href="{{ route('bimbel.pendaftaran') }}" class="px-3 py-1.5 bg-blue-600 text-white font-bold rounded-xl shadow-sm transition hover:bg-blue-700 whitespace-nowrap">Pendaftaran Baru</a>
            <a href="{{ route('bimbel.tryout') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Cek Nilai Tryout</a>
            <a href="{{ route('bimbel.portal') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Portal Siswa &amp; Ortu</a>
            <a href="{{ route('bimbel.kontak') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Kontak Cabang</a>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
            <a href="{{ url('/bimbel-dashboard') }}"
               class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-bold text-white bg-blue-900 hover:bg-blue-800 rounded-xl shadow-sm transition whitespace-nowrap">
                <i class="fa-solid fa-arrow-right-to-bracket text-[11px]"></i>
                <span>Masuk Akun</span>
            </a>
            <!-- Hamburger -->
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

<!-- Mobile Overlay -->
<div id="bimbel-nav-overlay" onclick="closeBimbelNav()"
     class="lg:hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm"
     style="opacity:0;visibility:hidden;transition:opacity 0.25s ease,visibility 0.25s ease;"></div>

<!-- Mobile Drawer -->
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
        <a href="{{ route('bimbel.pendaftaran') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-sm transition">
            <i class="fa-solid fa-user-plus w-5"></i> Pendaftaran Baru
        </a>
        <a href="{{ route('bimbel.tryout') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-chart-simple text-slate-400 w-5"></i> Cek Nilai Tryout
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
     3. HERO SECTION — Full Width Blue Gradient
     =================================================================== --}}
<section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-indigo-700 text-white pt-16 pb-20 sm:pt-20 sm:pb-28">
    <!-- Decorative blobs -->
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-white/10 hero-blob"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full bg-indigo-400/20 hero-blob" style="animation-delay:2s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-blue-500/10 hero-blob" style="animation-delay:1s;"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-8">
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-blue-200 text-xs font-medium mb-6">
            <a href="{{ route('bimbel.landing') }}" class="hover:text-white transition">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[9px] text-blue-300"></i>
            <span class="text-white font-bold">Pendaftaran Siswa Baru</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left: Text Content -->
            <div class="space-y-6">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/15 backdrop-blur-sm border border-white/25 rounded-full text-xs font-bold">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Gelombang 2 Dibuka • Sisa {{ $institution['sisa_kuota'] ?? 18 }} Kursi</span>
                </div>

                <!-- Heading -->
                <div>
                    <h1 class="text-3xl sm:text-4xl xl:text-5xl font-extrabold font-heading leading-tight tracking-tight">
                        Pendaftaran Siswa Baru<br>
                        <span class="text-blue-200">Tahun Ajaran {{ $institution['tahun_ajaran'] ?? '2025/2026' }}</span>
                    </h1>
                    <p class="mt-4 text-base text-blue-100 leading-relaxed max-w-lg">
                        Bergabung dengan lebih dari <strong class="text-white">1.200+ alumni</strong> yang telah berhasil masuk PTN dan sekolah unggulan favoritnya bersama Apex Edu Tebet.
                    </p>
                </div>

                <!-- Stats Row -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center">
                        <div class="text-2xl font-extrabold font-heading text-white">94%</div>
                        <div class="text-[11px] text-blue-200 mt-0.5 font-medium">Tingkat Lolos PTN</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center">
                        <div class="text-2xl font-extrabold font-heading text-white">1.200+</div>
                        <div class="text-[11px] text-blue-200 mt-0.5 font-medium">Alumni Aktif</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20 text-center">
                        <div class="text-2xl font-extrabold font-heading text-white">25%</div>
                        <div class="text-[11px] text-blue-200 mt-0.5 font-medium">Diskon Early Bird</div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <a href="{{ url('/bimbel-dashboard') }}"
                       class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 bg-white text-blue-700 hover:bg-blue-50 font-extrabold text-sm rounded-2xl shadow-lg transition">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        <span>Masuk &amp; Mulai Daftar</span>
                    </a>
                    <a href="{{ route('bimbel.program.page') }}"
                       class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 bg-white/15 border border-white/30 hover:bg-white/25 text-white font-bold text-sm rounded-2xl backdrop-blur-sm transition">
                        <i class="fa-solid fa-layer-group text-xs"></i>
                        <span>Lihat Semua Paket</span>
                    </a>
                </div>
            </div>

            <!-- Right: Info Card -->
            <div class="lg:flex justify-end hidden">
                <div class="bg-white/10 backdrop-blur-md border border-white/25 rounded-3xl p-6 w-full max-w-sm space-y-4">
                    <div class="flex items-center gap-3 pb-4 border-b border-white/20">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-clipboard-list text-white"></i>
                        </div>
                        <div>
                            <div class="font-bold text-white text-sm">Cara Mendaftar</div>
                            <div class="text-blue-200 text-[11px]">3 langkah mudah &amp; cepat</div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-white text-blue-700 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">1</div>
                            <div>
                                <div class="text-sm font-bold text-white">Login / Buat Akun</div>
                                <div class="text-[11px] text-blue-200 leading-relaxed">Daftar gratis atau masuk ke Portal Siswa Apex Edu</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-white text-blue-700 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">2</div>
                            <div>
                                <div class="text-sm font-bold text-white">Pilih Program &amp; Sesi</div>
                                <div class="text-[11px] text-blue-200 leading-relaxed">Tentukan paket bimbingan &amp; jadwal kelas tatap muka</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-white text-blue-700 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">3</div>
                            <div>
                                <div class="text-sm font-bold text-white">Upload Berkas &amp; Bayar</div>
                                <div class="text-[11px] text-blue-200 leading-relaxed">Lengkapi data siswa, unggah dokumen, selesaikan pembayaran via QRIS / Transfer</div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 border-t border-white/20">
                        <div class="flex items-center gap-2 text-[11px] text-blue-200">
                            <i class="fa-solid fa-lock text-blue-300"></i>
                            <span>Data tersimpan aman dengan enkripsi SSL 256-bit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- WAVE DIVIDER --}}
<div class="relative -mt-1 bg-[#f8fafc]">
    <svg viewBox="0 0 1440 80" class="w-full" preserveAspectRatio="none" height="80" xmlns="http://www.w3.org/2000/svg">
        <path fill="#2563eb" fill-opacity="0.08" d="M0,64 C360,0 1080,96 1440,48 L1440,0 L0,0 Z"/>
        <path fill="#1d4ed8" fill-opacity="0.06" d="M0,48 C480,96 960,0 1440,64 L1440,0 L0,0 Z"/>
    </svg>
</div>

{{-- ===================================================================
     4. NOTICE BANNER — Pendaftaran Lewat Akun
     =================================================================== --}}
<section class="py-8 px-4 sm:px-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-start sm:items-center gap-4 bg-amber-50 border border-amber-200 rounded-2xl p-5 sm:p-6 shadow-xs">
            <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 mt-0.5 sm:mt-0">
                <i class="fa-solid fa-circle-info text-lg"></i>
            </div>
            <div class="flex-1 min-w-0">
                <div class="font-bold text-amber-900 text-sm mb-1">Pendaftaran Dilakukan Melalui Portal Akun Siswa</div>
                <p class="text-[13px] text-amber-800 leading-relaxed">
                    Proses pendaftaran resmi Apex Edu Tebet dilakukan melalui <strong>Portal Akun Siswa</strong> agar data Anda tersimpan dengan aman dan terhubung langsung ke sistem akademik. Silakan login atau buat akun baru terlebih dahulu.
                </p>
            </div>
            <a href="{{ url('/bimbel-dashboard') }}"
               class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-xl transition shrink-0 shadow-sm">
                <i class="fa-solid fa-arrow-right-to-bracket text-[11px]"></i>
                <span>Masuk Sekarang</span>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================================
     5. PAKET PROGRAM — 3 CARDS
     =================================================================== --}}
<section class="py-14 px-4 sm:px-8 bg-white">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="text-center mb-10 space-y-3">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-50 border border-blue-200 rounded-full text-xs font-bold text-blue-700">
                <i class="fa-solid fa-layer-group text-[11px]"></i>
                <span>Pilihan Program Bimbingan</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading">Pilih Paket yang Sesuai Target Kamu</h2>
            <p class="text-sm text-slate-500 max-w-xl mx-auto">Dari bimbingan reguler hingga paket intensif garansi UTBK &amp; privat 1-on-1 — semua tersedia di Apex Edu Tebet.</p>
        </div>

        <!-- 3 Paket Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($programOptions as $pkg)
            <div class="pkg-card relative rounded-3xl border {{ $pkg['is_popular'] ? 'border-blue-600 shadow-xl shadow-blue-500/10' : 'border-slate-200 shadow-sm' }} bg-white p-7 flex flex-col">
                @if($pkg['is_popular'])
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 flex items-center gap-1.5 bg-blue-900 text-white text-[10px] font-extrabold px-4 py-1 rounded-full uppercase tracking-wider shadow">
                        <i class="fa-solid fa-star text-amber-300 text-[9px]"></i>
                        <span>Paling Diminati</span>
                    </div>
                @endif

                <!-- Badge -->
                <span class="inline-block mb-4 text-[11px] font-bold px-2.5 py-0.5 rounded-lg w-fit {{ $pkg['is_popular'] ? 'bg-blue-100 text-blue-800' : 'bg-slate-100 text-slate-600' }}">
                    {{ $pkg['badge'] }}
                </span>

                <!-- Title & Subtitle -->
                <h3 class="text-xl font-extrabold text-slate-900 font-heading leading-tight">{{ $pkg['title'] }}</h3>
                <p class="text-xs text-slate-500 mt-1 mb-5">{{ $pkg['subtitle'] }}</p>

                <!-- Price -->
                <div class="flex items-baseline gap-1.5 pb-5 border-b border-slate-100 mb-5">
                    <span class="text-2xl font-extrabold text-slate-900 font-heading">{{ $pkg['price_label'] }}</span>
                    <span class="text-xs text-slate-400 font-medium">{{ $pkg['period'] }}</span>
                </div>

                <!-- Features -->
                <ul class="space-y-2.5 text-xs text-slate-600 flex-1">
                    @foreach($pkg['features'] as $feat)
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-circle-check text-blue-600 text-xs mt-0.5 shrink-0"></i>
                        <span class="leading-snug">{{ $feat }}</span>
                    </li>
                    @endforeach
                </ul>

                <!-- CTA -->
                <div class="mt-6 pt-2">
                    <a href="{{ url('/bimbel-dashboard') }}"
                       class="block w-full py-3 rounded-xl text-xs font-bold text-center transition
                              {{ $pkg['is_popular'] ? 'bg-blue-600 text-white hover:bg-blue-700 shadow-md shadow-blue-500/20' : 'border border-blue-600 text-blue-700 hover:bg-blue-50' }}">
                        Pilih Paket Ini &rarr;
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Compare Link -->
        <div class="text-center mt-8">
            <a href="{{ route('bimbel.program.page') }}"
               class="inline-flex items-center gap-2 text-xs text-blue-600 hover:text-blue-800 font-bold transition border-b border-blue-200 hover:border-blue-600 pb-0.5">
                <i class="fa-solid fa-table text-[11px]"></i>
                <span>Lihat perbandingan lengkap semua paket →</span>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================================
     6. ALUR PENDAFTARAN — STEPS SECTION
     =================================================================== --}}
<section class="py-14 px-4 sm:px-8 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="text-center mb-10 space-y-3">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 border border-indigo-200 rounded-full text-xs font-bold text-indigo-700">
                <i class="fa-solid fa-route text-[11px]"></i>
                <span>Alur Pendaftaran Resmi</span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-heading">Proses Daftar Semudah 4 Langkah</h2>
            <p class="text-sm text-slate-500 max-w-lg mx-auto">Pendaftaran sepenuhnya online melalui portal akun siswa Anda. Tidak perlu antri di kantor cabang.</p>
        </div>

        <!-- Steps Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 relative">
            <!-- Connector Line (desktop) -->
            <div class="hidden lg:block absolute top-10 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-blue-200 via-blue-400 to-indigo-300 z-0"></div>

            @php
            $steps = [
                ['num'=>'1','icon'=>'fa-user-circle','color'=>'bg-blue-100 text-blue-600','title'=>'Login / Buat Akun','desc'=>'Buka portal.apexedu.id, masuk dengan akun yang sudah ada atau daftar akun siswa baru secara gratis.'],
                ['num'=>'2','icon'=>'fa-graduation-cap','color'=>'bg-indigo-100 text-indigo-600','title'=>'Pilih Program & Jadwal','desc'=>'Pilih jenjang pendidikan, paket bimbingan, dan sesi tatap muka (Siang / Sore) yang paling sesuai.'],
                ['num'=>'3','icon'=>'fa-file-arrow-up','color'=>'bg-violet-100 text-violet-600','title'=>'Upload Berkas Siswa','desc'=>'Unggah pas foto 3x4, scan rapor terakhir, dan sertifikat prestasi (opsional untuk diskon 25%).'],
                ['num'=>'4','icon'=>'fa-circle-check','color'=>'bg-emerald-100 text-emerald-600','title'=>'Bayar & Aktivasi Kelas','desc'=>'Selesaikan pembayaran via QRIS / VA. Kartu siswa & jadwal kelas aktif otomatis dalam 5 menit.'],
            ];
            @endphp

            @foreach($steps as $step)
            <div class="step-card relative z-10 bg-white rounded-2xl border border-slate-200 p-6 shadow-xs text-center flex flex-col items-center gap-4">
                <div class="w-12 h-12 rounded-2xl {{ $step['color'] }} flex items-center justify-center text-xl shadow-sm">
                    <i class="fa-solid {{ $step['icon'] }}"></i>
                </div>
                <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-6 h-6 rounded-full bg-blue-600 text-white text-xs font-extrabold flex items-center justify-center shadow-sm font-heading">{{ $step['num'] }}</div>
                <div>
                    <h3 class="text-sm font-bold text-slate-900 mb-1.5 font-heading">{{ $step['title'] }}</h3>
                    <p class="text-[12px] text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================================
     7. KEUNGGULAN / FASILITAS ICONS ROW
     =================================================================== --}}
<section class="py-12 px-4 sm:px-8 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @php
            $features = [
                ['icon'=>'fa-snowflake','color'=>'text-blue-500','title'=>'Kelas Full AC','desc'=>'Maks 10 siswa'],
                ['icon'=>'fa-desktop','color'=>'text-indigo-500','title'=>'Lab CBT Modern','desc'=>'Simulasi UTBK nyata'],
                ['icon'=>'fa-mug-saucer','color'=>'text-amber-500','title'=>'Study Lounge','desc'=>'Free WiFi & minuman'],
                ['icon'=>'fa-comments','color'=>'text-emerald-500','title'=>'Tanya PR','desc'=>'Bebas di luar jam'],
                ['icon'=>'fa-mobile-screen','color'=>'text-violet-500','title'=>'Aplikasi Siswa','desc'=>'Rapor & jadwal online'],
                ['icon'=>'fa-shield-halved','color'=>'text-rose-500','title'=>'Garansi Belajar','desc'=>'Re-enroll 50% diskon'],
            ];
            @endphp
            @foreach($features as $f)
            <div class="text-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50 border border-slate-100 hover:border-blue-200 transition group">
                <div class="w-10 h-10 rounded-xl bg-white shadow-xs border border-slate-100 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition">
                    <i class="fa-solid {{ $f['icon'] }} {{ $f['color'] }} text-base"></i>
                </div>
                <div class="text-xs font-bold text-slate-900">{{ $f['title'] }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5">{{ $f['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================================================================
     8. INFO CABANG + KONTAK
     =================================================================== --}}
<section class="py-14 px-4 sm:px-8 bg-[#f8fafc]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

        <!-- Left: Cabang Info Card -->
        <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-900 font-heading">Apex Edu Cabang Tebet</h3>
                    <p class="text-[11px] text-slate-500">{{ $institution['branch_name'] ?? 'Tebet Barat (Jakarta Selatan)' }}</p>
                </div>
            </div>

            <div class="space-y-3.5 text-sm">
                <div class="flex items-start gap-3.5">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-100 text-slate-500 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="fa-solid fa-location-dot text-xs text-blue-600"></i>
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Alamat Cabang</div>
                        <p class="text-slate-700 leading-relaxed text-xs">{{ $institution['branch_full_address'] ?? 'Jl. Tebet Barat Dalam Raya No. 42B, RT.06/RW.02, Tebet Barat, Jakarta Selatan 12810' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-3.5">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-phone text-xs text-blue-600"></i>
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Hotline / Front Office</div>
                        <a href="tel:{{ $institution['front_office_phone'] ?? '+62 812-9900-3420' }}"
                           class="text-xs font-bold text-slate-900 hover:text-blue-600 transition">{{ $institution['front_office_phone'] ?? '+62 812-9900-3420' }}</a>
                    </div>
                </div>
                <div class="flex items-start gap-3.5">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-clock text-xs text-blue-600"></i>
                    </div>
                    <div>
                        <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-0.5">Jam Operasional</div>
                        <p class="text-xs text-slate-700">{{ $institution['jam_buka'] ?? 'Senin – Sabtu: 08.00 – 20.30 WIB' }}</p>
                    </div>
                </div>
            </div>

            <!-- Map Embed Placeholder -->
            <div class="rounded-2xl overflow-hidden border border-slate-200 h-40 bg-slate-100 flex items-center justify-center">
                <a href="https://maps.google.com/?q=Tebet+Barat+Jakarta+Selatan" target="_blank"
                   class="flex flex-col items-center gap-2 text-slate-500 hover:text-blue-600 transition text-xs font-medium">
                    <i class="fa-solid fa-map-location-dot text-2xl"></i>
                    <span>Buka di Google Maps →</span>
                </a>
            </div>
        </div>

        <!-- Right: Promo + WhatsApp Quick Contact -->
        <div class="space-y-5">
            <!-- Diskon Early Bird Card -->
            <div class="bg-gradient-to-br from-amber-500 to-orange-500 rounded-3xl p-7 text-white shadow-lg shadow-amber-500/20 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-36 h-36 rounded-full bg-white/10"></div>
                <div class="relative">
                    <div class="inline-flex items-center gap-2 bg-white/20 border border-white/30 rounded-full px-3 py-1 text-[11px] font-bold mb-3">
                        <i class="fa-solid fa-tag text-[10px]"></i> Promo Gelombang 2
                    </div>
                    <h3 class="text-xl font-extrabold font-heading mb-2">Diskon Early Bird <span class="text-white/90">s.d 25%</span></h3>
                    <p class="text-sm text-amber-100 leading-relaxed mb-4">Hemat hingga <strong class="text-white">Rp 875.000</strong> untuk pendaftaran bulan ini. Berlaku untuk pembayaran di muka (DP Full).</p>
                    <div class="flex items-center gap-2 text-xs text-amber-100">
                        <i class="fa-regular fa-calendar text-amber-200"></i>
                        <span>Berlaku hingga akhir bulan Oktober 2025</span>
                    </div>
                </div>
            </div>

            <!-- Biaya Registrasi Gratis Card -->
            <div class="bg-white rounded-3xl border border-emerald-200 p-6 shadow-xs flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0 shadow-xs">
                    <i class="fa-solid fa-gift"></i>
                </div>
                <div>
                    <div class="text-sm font-bold text-slate-900 mb-1">Biaya Registrasi Awal <span class="text-emerald-600 font-extrabold">GRATIS!</span></div>
                    <p class="text-[12px] text-slate-500 leading-relaxed">Biaya administrasi pendaftaran senilai <s>Rp 250.000</s> dibebaskan untuk gelombang 2. Cukup bayar biaya program bulan pertama.</p>
                </div>
            </div>

            <!-- WhatsApp CTA Card -->
            <div class="bg-[#25D366]/10 border border-[#25D366]/30 rounded-3xl p-6 flex items-center justify-between gap-4">
                <div class="flex items-start gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-[#25D366] text-white flex items-center justify-center text-xl shrink-0 shadow-sm">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-slate-900 mb-0.5">Tanya Langsung via WhatsApp</div>
                        <p class="text-xs text-slate-500">CS kami siap membantu pemilihan program dan konsultasi jadwal bimbingan.</p>
                    </div>
                </div>
                <a href="https://wa.me/6281299003420?text=Halo+Apex+Edu+Tebet%2C+saya+ingin+konsultasi+pendaftaran+siswa+baru."
                   target="_blank"
                   class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 bg-[#25D366] hover:bg-[#1da851] text-white font-bold text-xs rounded-xl shadow-sm transition">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>Chat CS</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===================================================================
     9. BOTTOM CTA SECTION — Full Width
     =================================================================== --}}
<section class="py-16 px-4 sm:px-8 bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_rgba(255,255,255,0.1)_0%,_transparent_60%)]"></div>
    <div class="relative max-w-4xl mx-auto text-center space-y-6">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/15 border border-white/25 rounded-full text-xs font-bold text-white">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>Portal Pendaftaran Online — Buka 24 Jam</span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-extrabold font-heading text-white leading-tight">
            Siap Mulai Bimbingan?<br>
            <span class="text-blue-200">Daftar Sekarang Lewat Portal Akun</span>
        </h2>
        <p class="text-base text-blue-100 max-w-xl mx-auto leading-relaxed">
            Masuk ke akun Apex Edu Anda dan selesaikan proses pendaftaran siswa baru dalam waktu kurang dari 10 menit.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ url('/bimbel-dashboard') }}"
               class="inline-flex items-center gap-2.5 px-8 py-4 bg-white text-blue-700 hover:bg-blue-50 font-extrabold text-sm rounded-2xl shadow-xl transition">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                <span>Masuk &amp; Mulai Daftar</span>
            </a>
            <a href="{{ route('bimbel.landing') }}"
               class="inline-flex items-center gap-2.5 px-7 py-4 border border-white/30 bg-white/10 hover:bg-white/20 text-white font-bold text-sm rounded-2xl backdrop-blur-sm transition">
                <i class="fa-solid fa-house text-xs"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================================
     10. FOOTER
     =================================================================== --}}
<footer id="footer" class="bg-white border-t border-slate-200 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">

        <!-- Brand Column -->
        <div class="md:col-span-1">
            <div class="flex items-center gap-2.5 mb-3">
                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold">
                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                </div>
                <span class="font-heading font-extrabold text-lg text-slate-900">Apex Edu</span>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Lembaga bimbingan belajar dan persiapan masuk PTN, kedinasan, dan sekolah unggulan terkemuka di Jakarta Selatan.
            </p>
            <div class="flex items-center gap-2 text-slate-400">
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-blue-600 flex items-center justify-center transition"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>

        <!-- Cabang & Kontak -->
        <div>
            <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Cabang &amp; Kontak</h4>
            <p class="leading-relaxed">{{ $institution['branch_full_address'] ?? 'Jl. Tebet Barat Dalam Raya No. 42B, Jakarta Selatan 12810' }}</p>
            <p class="mt-2"><strong class="text-slate-700">Hotline CS:</strong> {{ $institution['hotline'] ?? '(021) 8370-1920' }}</p>
            <p class="mt-1"><strong class="text-slate-700">Jam Buka:</strong> {{ $institution['jam_buka'] ?? 'Senin – Sabtu: 08.00 – 20.30' }}</p>
        </div>

        <!-- Akses Cepat -->
        <div>
            <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Akses Cepat Siswa</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('bimbel.landing') }}" class="hover:text-blue-600 transition">Beranda Utama</a></li>
                <li><a href="{{ route('bimbel.program.page') }}" class="hover:text-blue-600 transition">Paket &amp; Biaya Program</a></li>
                <li><a href="{{ route('bimbel.pendaftaran') }}" class="hover:text-blue-600 transition">Info Pendaftaran</a></li>
                <li><a href="{{ url('/bimbel-dashboard') }}" class="hover:text-blue-600 transition">Portal Nilai Siswa (Login)</a></li>
            </ul>
        </div>

        <!-- Layanan & Mitra -->
        <div>
            <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Layanan &amp; Mitra</h4>
            <ul class="space-y-2">
                <li><a href="{{ url('/') }}" class="hover:text-blue-600 transition">Portal Kursus IT &amp; Coding</a></li>
                <li><a href="{{ url('/magang') }}" class="hover:text-blue-600 transition">Program Magang &amp; PKL</a></li>
                <li><a href="{{ url('/bengkel') }}" class="hover:text-blue-600 transition">MotoPro Workshop</a></li>
                <li><a href="{{ url('/clean') }}" class="hover:text-blue-600 transition">Clean Wash Care</a></li>
            </ul>
        </div>
    </div>

    <div class="max-w-7xl mx-auto pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-slate-400 text-[11px]">
        <p>&copy; {{ date('Y') }} Bimbel Apex Edu Cabang Jakarta Selatan &bull; elc.my.id. Seluruh hak cipta dilindungi.</p>
        <div class="flex items-center gap-4">
            <a href="#" class="hover:text-slate-600">Kebijakan Privasi</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-slate-600">Syarat &amp; Ketentuan</a>
            <span>&bull;</span>
            <a href="#" class="hover:text-slate-600">Standar Belajar</a>
        </div>
    </div>
</footer>

{{-- ===================================================================
     JAVASCRIPT
     =================================================================== --}}
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
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeBimbelNav(); });
</script>
</body>
</html>
