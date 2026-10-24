<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi &amp; Kontak Cabang Cibubur — {{ $institution['branch_name'] ?? 'Azzahra Computer' }}</title>
    <meta name="description" content="Kunjungi Azzahra Computer – ASUS Authorized Service Center Cabang Cibubur. Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi. Konsultasi, servis resmi ASUS, dan informasi layanan tersedia di sini.">

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

        .kontak-card { transition: all 0.2s ease-in-out; }
        .kontak-card:hover { transform: translateY(-2px); box-shadow: 0 12px 24px -6px rgba(15, 23, 42, 0.08); }
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
                    <span class="font-heading font-extrabold text-lg sm:text-xl tracking-tight text-blue-700">Azzahra Computer</span>
                    <span class="text-[10px] font-bold bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full border border-blue-200 whitespace-nowrap">ASUS Service – Cibubur</span>
                </div>
                <p class="text-[9px] text-slate-400 font-mono -mt-0.5">localhost:8000/bimbel/kontak</p>
            </div>
        </a>

        <!-- Desktop Nav Links -->
        <nav class="hidden lg:flex items-center gap-2 xl:gap-3.5 2xl:gap-5 text-xs xl:text-[13px] font-semibold text-slate-600 whitespace-nowrap">
            <a href="{{ route('bimbel.landing') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Beranda</a>
            <a href="{{ route('bimbel.program.page') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Program &amp; Biaya</a>
            <a href="{{ route('bimbel.pendaftaran') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Pendaftaran Baru</a>
            <a href="{{ route('bimbel.tryout') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Cek Nilai Tryout</a>
            <a href="{{ route('bimbel.portal') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Portal Siswa &amp; Ortu</a>
            <a href="{{ route('bimbel.kontak') }}" class="px-3 py-1.5 bg-blue-600 text-white font-bold rounded-xl shadow-sm transition hover:bg-blue-700 whitespace-nowrap">Kontak Cabang</a>
        </nav>

        <!-- Right: Masuk Akun + Hamburger -->
        <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
            <a href="{{ route('bimbel.portal') }}"
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
                <div class="font-heading font-extrabold text-base text-blue-700 leading-none">Azzahra Computer</div>
                <div class="text-[10px] text-slate-400">ASUS Service – Cibubur</div>
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
        <a href="{{ route('bimbel.portal') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
            <i class="fa-solid fa-id-card-clip text-slate-400 w-5"></i> Portal Siswa &amp; Ortu
        </a>
        <a href="{{ route('bimbel.kontak') }}" onclick="closeBimbelNav()" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-blue-600 text-white shadow-sm transition">
            <i class="fa-solid fa-phone w-5"></i> Kontak Cabang
        </a>
        <div class="border-t border-slate-100 my-3"></div>
        <a href="{{ route('bimbel.portal') }}" onclick="closeBimbelNav()" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-bold text-white bg-blue-900 hover:bg-blue-800 transition shadow-sm">
            <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i> Masuk Akun
        </a>
    </nav>
    <div class="px-5 py-4 border-t border-slate-100 bg-slate-50 text-xs text-slate-500">
        <p class="font-bold text-slate-700">Apex Edu Hotline</p>
        <p>{{ $institution['hotline'] ?? '(021) 8370-1920' }}</p>
    </div>
</div>

{{-- ===================================================================
     3. HERO SECTION — HUBUNGI APEX EDU CABANG TEBET (Sesuai Foto Persis)
     =================================================================== --}}
<section class="py-10 px-4 sm:px-8 bg-gradient-to-b from-blue-50/60 via-white to-slate-50 border-b border-slate-200/60">
    <div class="max-w-6xl mx-auto space-y-4">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-[11px] text-slate-400 font-medium">
            <a href="{{ route('bimbel.landing') }}" class="hover:text-blue-600 transition">Beranda</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-slate-600">Kontak Cabang</span>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-blue-700 font-bold">Cabang Cibubur (Kota Bekasi)</span>
        </div>

        <!-- Badge -->
        <div class="inline-flex items-center gap-2 px-3.5 py-1 bg-blue-100/70 border border-blue-200 rounded-full text-xs font-bold text-blue-800">
            <i class="fa-solid fa-location-dot text-blue-600 text-xs"></i>
            <span>ASUS Authorized Service Center – Wilayah Cibubur &amp; Bekasi</span>
        </div>

        <!-- Title & Subtitle + Action Buttons (Sesuai Foto Persis) -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="space-y-2 max-w-2xl">
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 font-heading tracking-tight leading-tight">
                    Hubungi Azzahra Computer Cabang Cibubur &amp; Informasi Layanan Resmi ASUS
                </h1>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Kunjungi service center resmi ASUS kami di Cibubur untuk konsultasi, servis laptop/PC, garansi resmi, atau dapatkan informasi produk terkini. Hubungi tim kami melalui berbagai saluran resmi yang tersedia.
                </p>
            </div>

            <!-- Two Buttons: WA Front Office + Hotline -->
            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <a href="https://wa.me/{{ $institution['whatsapp'] ?? '6281476652656' }}?text=Halo+Azzahra+Computer+Cibubur%2C+saya+ingin+konsultasi+layanan+servis+ASUS."
                   target="_blank"
                   class="inline-flex items-center gap-2 px-5 py-3 bg-[#128C7E] hover:bg-[#075E54] text-white font-bold text-xs rounded-xl shadow-md transition">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    <span>WhatsApp Service Center</span>
                </a>
                <a href="tel:{{ $institution['front_office_phone'] ?? '+62 812-9900-3420' }}"
                   class="inline-flex items-center gap-2 px-5 py-3 bg-white hover:bg-slate-50 text-slate-800 font-bold text-xs rounded-xl transition border border-slate-300 shadow-xs">
                    <i class="fa-solid fa-phone text-xs text-blue-600"></i>
                    <span>{{ $institution['hotline'] ?? '(021) 8370-1920' }}</span>
                </a>
            </div>
        </div>

    </div>
</section>

{{-- ===================================================================
     4. PEMBERITAHUAN BANNER RESMI
     =================================================================== --}}
<section class="py-5 px-4 sm:px-8 bg-white border-b border-slate-100">
    <div class="max-w-6xl mx-auto">
        <div class="bg-blue-50/80 border border-blue-200 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-sm mt-0.5 sm:mt-0">
                    <i class="fa-solid fa-circle-info text-lg"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-sm font-bold text-blue-900 font-heading">Pemberitahuan Layanan Cabang &amp; Konsultasi</h2>
                        <span class="text-[10px] font-extrabold bg-blue-200 text-blue-800 px-2 py-0.5 rounded-full">Informasi Resmi</span>
                    </div>
                    <p class="text-xs text-blue-800/90 mt-1 leading-relaxed">
                        Layanan servis laptop/PC, konsultasi produk ASUS, dan klaim garansi resmi terbuka untuk umum setiap <strong>Senin &ndash; Sabtu pukul 08.00 &ndash; 17.00 WIB</strong>. Bagi pelanggan yang sudah memiliki akun, status servis dan riwayat klaim garansi dapat dilihat melalui portal pelanggan resmi.
                    </p>
                </div>
            </div>
            <a href="{{ route('bimbel.portal') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-sm transition shrink-0 w-full sm:w-auto justify-center">
                <i class="fa-solid fa-id-card-clip text-xs"></i>
                <span>Buka Portal Siswa</span>
            </a>
        </div>
    </div>
</section>

{{-- ===================================================================
     5. TOP INFO STRIP (Sesuai Foto Persis)
     =================================================================== --}}
<section class="py-5 px-4 sm:px-8 bg-slate-50 border-b border-slate-200/80">
    <div class="max-w-6xl mx-auto bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 shadow-xs space-y-3">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 pb-3 border-b border-slate-100">
            <div class="flex items-start sm:items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm shrink-0 border border-blue-100">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-slate-900 uppercase tracking-wide">CABANG BUKA SENIN s/d SABTU 08.00 &ndash; 17.00 WIB</span>
                        <span class="text-[10px] font-bold bg-amber-50 text-amber-700 px-2 py-0.2 rounded border border-amber-200">ASUS Authorized Service Center</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">
                        {{ $institution['branch_full_address'] ?? 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- 4 Badges/Tags (Sesuai Foto Persis) -->
        <div class="flex flex-wrap items-center gap-2 text-[11px] text-slate-600">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 rounded-lg border border-slate-200">
                <i class="fa-solid fa-circle-check text-blue-600 text-[10px]"></i> Teknisi Siap Melayani
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 rounded-lg border border-slate-200">
                <i class="fa-solid fa-circle-check text-blue-600 text-[10px]"></i> Garansi Resmi ASUS
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 rounded-lg border border-slate-200">
                <i class="fa-solid fa-circle-check text-blue-600 text-[10px]"></i> Spare Part Original
            </span>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 rounded-lg border border-slate-200">
                <i class="fa-solid fa-circle-check text-emerald-600 text-[10px]"></i> Area Parkir Tersedia
            </span>
        </div>
    </div>
</section>

{{-- ===================================================================
     6. MAIN CONTENT: FORMULIR KUNJUNGAN (KIRI) + PETA & SALURAN (KANAN)
     =================================================================== --}}
<main class="py-10 px-4 sm:px-8 flex-1">
    <div class="max-w-6xl mx-auto space-y-10">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <!-- LEFT (7 COLS): FORMULIR KUNJUNGAN TATAP MUKA (Sesuai Foto Persis) -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-7 shadow-sm space-y-5">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">BOOKING ONLINE CEPAT</span>
                            <h2 class="text-lg font-bold text-slate-900 font-heading">Formulir Kunjungan Tatap Muka</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Dapatkan slot konsultasi eksklusif agar tidak perlu antre saat datang langsung ke kantor cabang.</p>
                        </div>
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm shrink-0 border border-blue-100">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                    </div>

                    <!-- Interactive Consultation Form (Submits to WhatsApp Front Office) -->
                    <form id="form-kunjungan" onsubmit="handleBookingKunjungan(event)" class="space-y-4 text-xs">
                        <!-- Row 1: Nama & WhatsApp -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nama Lengkap Orang Tua / Siswa <span class="text-rose-500">*</span></label>
                                <input type="text"
                                       id="k-nama"
                                       placeholder="Contoh: Hendra Wibowo / Kevin Wibowo"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                                       required>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nomor WhatsApp Aktif <span class="text-rose-500">*</span></label>
                                <input type="tel"
                                       id="k-wa"
                                       placeholder="0812-xxxx-xxxx"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                                       required>
                            </div>
                        </div>

                        <!-- Row 2: Asal Sekolah & Jenjang -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Asal Sekolah Siswa <span class="text-rose-500">*</span></label>
                                <input type="text"
                                       id="k-sekolah"
                                       placeholder="Contoh: SMAN 28 Jakarta / SMPN 115"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                                       required>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Jenjang &amp; Target Belajar <span class="text-rose-500">*</span></label>
                                <select id="k-jenjang"
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                                       required>
                                    <option value="" disabled selected>Pilih Jenjang...</option>
                                    <option value="Kelas 12 SMA / Alumni (Target UTBK-SNBT 2025)">Kelas 12 SMA / Alumni (Target UTBK-SNBT 2025)</option>
                                    <option value="Kelas 10 - 11 SMA (Reguler Prestasi)">Kelas 10 - 11 SMA (Reguler Prestasi)</option>
                                    <option value="SMP Kelas 7 - 9 (Target Masuk SMA Unggulan)">SMP Kelas 7 - 9 (Target Masuk SMA Unggulan)</option>
                                    <option value="SD Kelas 4 - 6 (Persiapan US & Asesmen)">SD Kelas 4 - 6 (Persiapan US & Asesmen)</option>
                                    <option value="Kedinasan / Akpol / Akmil">Kedinasan / Akpol / Akmil</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 3: Tujuan Utama Kunjungan (4 Options As in Screenshot) -->
                        <div>
                            <label class="block font-bold text-slate-700 mb-1.5">Tujuan Utama Kunjungan <span class="text-rose-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <label class="flex items-start gap-2.5 p-3 rounded-xl border border-blue-200 bg-blue-50/50 cursor-pointer hover:bg-blue-50 transition">
                                    <input type="radio" name="tujuan" value="Konsultasi Jurusan & Rasionalisasi PTN" checked class="mt-0.5 text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <div class="font-bold text-slate-900">Konsultasi Jurusan &amp; Rasionalisasi PTN</div>
                                        <div class="text-[10px] text-slate-500">Bedah skor tryout awal vs passing grade target prodi</div>
                                    </div>
                                </label>
                                <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 bg-white cursor-pointer hover:bg-slate-50 transition">
                                    <input type="radio" name="tujuan" value="Tes Diagnostic Awal (Gratis)" class="mt-0.5 text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <div class="font-bold text-slate-900">Tes Diagnostic Awal (Gratis)</div>
                                        <div class="text-[10px] text-slate-500">Uji pemetaan 20 menit &amp; rekomendasi kelas pemetaan</div>
                                    </div>
                                </label>
                                <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 bg-white cursor-pointer hover:bg-slate-50 transition">
                                    <input type="radio" name="tujuan" value="Pendaftaran & Pembayaran Kursus" class="mt-0.5 text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <div class="font-bold text-slate-900">Pendaftaran &amp; Pembayaran Kursus</div>
                                        <div class="text-[10px] text-slate-500">Klaim promo diskon 25% &amp; aktivasi kelas tatap muka</div>
                                    </div>
                                </label>
                                <label class="flex items-start gap-2.5 p-3 rounded-xl border border-slate-200 bg-white cursor-pointer hover:bg-slate-50 transition">
                                    <input type="radio" name="tujuan" value="Tur Fasilitas & Free Trial Class" class="mt-0.5 text-blue-600 focus:ring-blue-500">
                                    <div>
                                        <div class="font-bold text-slate-900">Tur Fasilitas &amp; Free Trial Class</div>
                                        <div class="text-[10px] text-slate-500">Lihat lab komputer CBT, ruang diskusi, &amp; study lounge</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Row 4: Rencana Tanggal & Slot Waktu -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Rencana Tanggal Hadir <span class="text-rose-500">*</span></label>
                                <input type="date"
                                       id="k-tanggal"
                                       value="{{ date('Y-m-d') }}"
                                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                                       required>
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Slot Waktu Kunjungan <span class="text-rose-500">*</span></label>
                                <select id="k-slot"
                                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"
                                       required>
                                    <option value="Sesi Siang / Sore (14.00 - 17.00 WIB)">Sesi Siang / Sore (14.00 - 17.00 WIB)</option>
                                    <option value="Sesi Pagi (09.00 - 12.00 WIB)">Sesi Pagi (09.00 - 12.00 WIB)</option>
                                    <option value="Sesi Malam (18.30 - 19.30 WIB)" selected>Sesi Malam (18.30 - 19.30 WIB)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 5: Catatan Khusus (Opsional) -->
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Catatan Khusus / Pertanyaan Awal (Opsional)</label>
                            <textarea id="k-catatan"
                                      rows="2"
                                      placeholder="Tuliskan target jurusan impian, kendala materi pelajaran yang dialami, atau pemintaan jadwal khusus lainnya..."
                                      class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs text-slate-800 focus:outline-none focus:border-blue-600 bg-slate-50 focus:bg-white transition"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full py-3.5 bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs rounded-xl shadow-md shadow-blue-500/20 transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                            <span>Konfirmasi Jadwal Kunjungan (Kirim via WA Front Office)</span>
                        </button>

                        <p class="text-[11px] text-slate-400 text-center leading-relaxed">
                            Bebas biaya konsultasi awal &amp; diagnostic test 45 menit. Jadwal Anda akan dikonfirmasi langsung oleh tim front office melalui WhatsApp selambat-lambatnya 15 menit pasca pengajuan formulir.
                        </p>
                    </form>
                </div>
            </div>

            <!-- RIGHT (5 COLS): PETA LOKASI + PANDUAN AKSES + SALURAN RESMI (Sesuai Foto Persis) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- 1. Peta Lokasi Cabang Tebet -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                        <h3 class="text-sm font-bold text-slate-900 font-heading flex items-center gap-2">
                            <i class="fa-solid fa-map-location-dot text-blue-600"></i>
                            Peta Lokasi Cabang Cibubur
                        </h3>
                        <a href="https://maps.google.com/?q=Ruko+Kranggan+Permai+Jl+Alternatif+Cibubur+Jatisampurna+Bekasi" target="_blank" class="text-blue-600 hover:underline text-xs font-bold">
                            Buka Google Maps &rarr;
                        </a>
                    </div>

                    <!-- Map Preview Frame -->
                    <div class="w-full h-44 rounded-2xl overflow-hidden border border-slate-200 relative bg-slate-100">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0!2d106.9174!3d-6.3728!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c0!2sRuko%20Kranggan%20Permai%20Jl%20Alternatif%20Cibubur%20Jatisampurna%20Bekasi!5e0!3m2!1sid!2sid!4v1700000000001!5m2!1sid!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <!-- 3 Patokan Terdekat -->
                    <div class="grid grid-cols-3 gap-2 text-center text-[10px]">
                        <div class="p-2 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="text-slate-400 font-medium">Patokan Terdekat</div>
                            <div class="font-bold text-slate-800 mt-0.5">Ruko Kranggan Permai</div>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="text-slate-400 font-medium">Area Perbelanjaan</div>
                            <div class="font-bold text-slate-800 mt-0.5">Cibubur Junction</div>
                        </div>
                        <div class="p-2 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="text-slate-400 font-medium">Akses Tol</div>
                            <div class="font-bold text-slate-800 mt-0.5">Exit Tol Cibubur</div>
                        </div>
                    </div>
                </div>

                <!-- 2. Panduan Akses & Transportasi -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-3.5">
                    <h3 class="text-sm font-bold text-slate-900 font-heading flex items-center gap-2">
                        <i class="fa-solid fa-route text-blue-600"></i>
                        Panduan Akses &amp; Transportasi
                    </h3>
                    <div class="space-y-3 text-xs">
                        <!-- KRL -->
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="w-8 h-8 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center shrink-0 text-sm">
                                <i class="fa-solid fa-train"></i>
                            </div>
                            <div>
                                <div class="font-bold text-slate-900">Akses via Jl. Alternatif Cibubur</div>
                                <p class="text-[11px] text-slate-500 mt-0.5">Dari arah Jakarta: masuk Jl. Alternatif Cibubur, lurus hingga Kranggan Permai Blok RT 16. Dari arah Bogor/Depok: lewat Tol Jagorawi lalu keluar Exit Cibubur.</p>
                            </div>
                        </div>
                        <!-- TransJakarta -->
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="w-8 h-8 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center shrink-0 text-sm">
                                <i class="fa-solid fa-bus"></i>
                            </div>
                            <div>
                                <div class="font-bold text-slate-900">Transportasi Umum</div>
                                <p class="text-[11px] text-slate-500 mt-0.5">Naik angkot/Transjabodetabek dari Terminal Cibubur, turun di depan Ruko Kranggan Permai. Jarak dari Cibubur Junction ±2 km via Jl. Alternatif Cibubur.</p>
                            </div>
                        </div>
                        <!-- Parkir -->
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 text-sm">
                                <i class="fa-solid fa-square-parking"></i>
                            </div>
                            <div>
                                <div class="font-bold text-slate-900">Area Parkir Tersedia</div>
                                <p class="text-[11px] text-slate-500 mt-0.5">Area parkir kendaraan tersedia di depan Ruko Kranggan Permai. Kapasitas mobil dan motor memadai dengan akses langsung dari Jl. Alternatif Cibubur.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Saluran Resmi Kontak Cabang -->
                <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm space-y-3.5">
                    <h3 class="text-sm font-bold text-slate-900 font-heading flex items-center gap-2">
                        <i class="fa-solid fa-headset text-blue-600"></i>
                        Saluran Resmi Kontak Cabang
                    </h3>
                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-slate-500 flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-600"></i> WhatsApp Service Center
                            </span>
                            <a href="https://wa.me/{{ $institution['whatsapp'] ?? '6281476652656' }}" target="_blank" class="font-bold text-slate-900 hover:text-blue-600">
                                {{ $institution['front_office_phone'] ?? '+62 812-9900-3420' }}
                            </a>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-slate-500 flex items-center gap-2">
                                <i class="fa-solid fa-phone text-blue-600"></i> Telepon Front Office
                            </span>
                            <span class="font-bold text-slate-900">{{ $institution['hotline'] ?? '(021) 8370-1920' }}</span>
                        </div>
                        <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                            <span class="text-slate-500 flex items-center gap-2">
                                <i class="fa-regular fa-envelope text-indigo-600"></i> Email Akademik
                            </span>
                            <span class="font-bold text-slate-900">{{ $institution['email'] ?? 'cabangtebet@apexedu.id' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-500 flex items-center gap-2">
                                <i class="fa-solid fa-calendar-check text-amber-600"></i> Jam Operasional
                            </span>
                            <span class="font-bold text-slate-900">Senin&ndash;Sabtu 08.00&ndash;17.00</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- ===================================================================
             7. TIM MANAJEMEN & FRONT OFFICE CABANG TEBET (Sesuai Foto Persis)
             =================================================================== --}}
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">TIM KAMI</span>
                    <h3 class="text-lg font-bold text-slate-900 font-heading">Tim Teknisi &amp; Staf Azzahra Computer Cabang Cibubur</h3>
                    <p class="text-xs text-slate-500">Teknisi bersertifikat ASUS dan staf berpengalaman siap membantu kebutuhan servis dan konsultasi produk Anda.</p>
                </div>
                <span class="hidden sm:inline-flex items-center gap-1.5 text-xs text-slate-500 font-semibold">
                    <i class="fa-solid fa-shield-halved text-blue-600"></i> ASUS Authorized Service Center
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Person 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs text-center space-y-3">
                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto border-2 border-blue-600/30">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=160&auto=format&fit=crop&q=80"
                             alt="Ibu Sari" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Ibu Sari Kusumawati</h4>
                        <p class="text-[11px] font-semibold text-blue-700">Branch Manager &amp; Customer Relations</p>
                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                            8+ tahun mengelola operasional service center ASUS dan memastikan setiap pelanggan mendapatkan pengalaman layanan terbaik.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-slate-400">
                        <i class="fa-regular fa-calendar text-[10px]"></i> Senin s/d Sabtu: 08.00 - 17.00 WIB
                    </div>
                </div>

                <!-- Person 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs text-center space-y-3">
                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto border-2 border-indigo-600/30">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=160&auto=format&fit=crop&q=80"
                             alt="Kak Dimas & Kak Sarah" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Kak Dimas &amp; Kak Sarah</h4>
                        <p class="text-[11px] font-semibold text-indigo-700">Front Office &amp; Student Care</p>
                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                            Siap membantu administrasi formulir, simulasi paket bimbingan yang tepat, trial class, serta koordinasi jadwal bimbingan.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-slate-400">
                        <i class="fa-regular fa-clock text-[10px]"></i> Front Office Standby: 08.00 - 20.30 WIB
                    </div>
                </div>

                <!-- Person 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs text-center space-y-3">
                    <div class="w-16 h-16 rounded-full overflow-hidden mx-auto border-2 border-emerald-600/30">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=160&auto=format&fit=crop&q=80"
                             alt="Kak Reza" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Kak Reza Firmansyah</h4>
                        <p class="text-[11px] font-semibold text-emerald-700">Customer Service &amp; Sales Advisor</p>
                        <p class="text-[11px] text-slate-500 mt-2 leading-relaxed">
                            Siap membantu konsultasi produk laptop/PC ASUS terbaru, estimasi biaya servis, serta proses klaim garansi resmi pelanggan.
                        </p>
                    </div>
                    <div class="pt-2 border-t border-slate-100 text-[11px] text-slate-400">
                        <i class="fa-solid fa-headset text-[10px]"></i> CS &amp; Konsultasi Produk ASUS
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================================================================
             8. JARINGAN CABANG APEX EDU DI JABODETABEK (Sesuai Foto Persis)
             =================================================================== --}}
        <div class="bg-slate-50 rounded-3xl border border-slate-200 p-6 sm:p-7 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">AZZAHRA COMPUTER NETWORK</span>
                    <h3 class="text-base font-bold text-slate-900 font-heading">Jaringan Azzahra Computer di Jabodetabek</h3>
                    <p class="text-xs text-slate-500">Kunjungi cabang Azzahra Computer terdekat di wilayah Anda untuk servis dan konsultasi produk ASUS.</p>
                </div>
                <div class="text-xs text-slate-500 font-medium">
                    Cabang Aktif: <strong class="text-blue-700">Cabang Cibubur (Kota Bekasi)</strong>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Cabang 1: Rawamangun -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 space-y-2">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="font-extrabold text-blue-700">KOTA BEKASI</span>
                        <span class="text-[9px] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.2 rounded">Buka</span>
                    </div>
                    <h4 class="text-xs font-bold text-slate-900">Cabang Cibubur (Utama)</h4>
                    <p class="text-[11px] text-slate-500">Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi 17431</p>
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                        <span class="text-slate-600 font-medium">+62 814-7665-2656</span>
                        <a href="https://wa.me/6281476652656" target="_blank" class="text-blue-600 font-bold hover:underline">Kontak Cabang &rarr;</a>
                    </div>
                </div>

                <!-- Cabang 2: Bintaro -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 space-y-2">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="font-extrabold text-indigo-700">KOTA TEGAL</span>
                        <span class="text-[9px] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.2 rounded">Buka</span>
                    </div>
                    <h4 class="text-xs font-bold text-slate-900">Cabang Tegal (Pusat)</h4>
                    <p class="text-[11px] text-slate-500">CitraLand Tegal Blok Belleza Plaza Lt. 2, Kraton, Kota Tegal, Jawa Tengah (Gedung Training Center)</p>
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                        <span class="text-slate-600 font-medium">+62 877-6233-4232</span>
                        <a href="https://wa.me/6287762334232" target="_blank" class="text-blue-600 font-bold hover:underline">Kontak Cabang &rarr;</a>
                    </div>
                </div>

                <!-- Cabang 3: Margonda -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 space-y-2">
                    <div class="flex items-center justify-between text-[11px]">
                        <span class="font-extrabold text-emerald-700">JAKARTA (ONLINE)</span>
                        <span class="text-[9px] font-bold bg-blue-100 text-blue-700 px-2 py-0.2 rounded">Aktif</span>
                    </div>
                    <h4 class="text-xs font-bold text-slate-900">Layanan Online Nasional</h4>
                    <p class="text-[11px] text-slate-500">Konsultasi produk, pengecekan garansi, dan pemesanan spare part ASUS dapat dilakukan secara online melalui WhatsApp &amp; email resmi kami.</p>
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between text-[11px]">
                        <span class="text-slate-600 font-medium">elcoding.id@gmail.com</span>
                        <a href="https://wa.me/6281476652656" target="_blank" class="text-blue-600 font-bold hover:underline">Hubungi &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================================================================
             9. FAQ: PERTANYAAN SEPUTAR KUNJUNGAN & REGISTRASI (Sesuai Foto Persis)
             =================================================================== --}}
        <div class="space-y-4">
            <div class="text-center space-y-1">
                <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">TANYA JAWAB CEPAT</span>
                <h3 class="text-lg font-bold text-slate-900 font-heading">Pertanyaan Seputar Servis &amp; Kunjungan ke Cabang</h3>
                <p class="text-xs text-slate-500">Informasi penting sebelum Anda berkunjung langsung ke Azzahra Computer Cabang Cibubur.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-3">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-xs">
                    <button type="button" onclick="toggleFaq(1)" class="w-full flex items-center justify-between text-left font-bold text-xs text-slate-900">
                        <span>Berapa lama waktu pengerjaan servis laptop ASUS?</span>
                        <i id="faq-icon-1" class="fa-solid fa-chevron-down text-blue-600 text-[10px] transition-transform"></i>
                    </button>
                    <div id="faq-body-1" class="mt-2 text-xs text-slate-500 leading-relaxed border-t border-slate-100 pt-2">
                        Waktu pengerjaan bervariasi tergantung jenis kerusakan. Untuk servis ringan (instalasi OS, cleaning, baterai) biasanya selesai 1-2 hari kerja. Servis berat seperti penggantian motherboard atau LCD dapat memerlukan 3-7 hari kerja tergantung ketersediaan spare part.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-xs">
                    <button type="button" onclick="toggleFaq(2)" class="w-full flex items-center justify-between text-left font-bold text-xs text-slate-900">
                        <span>Apakah laptop saya masih bisa diklaim garansi resmi ASUS?</span>
                        <i id="faq-icon-2" class="fa-solid fa-chevron-down text-blue-600 text-[10px] transition-transform"></i>
                    </button>
                    <div id="faq-body-2" class="mt-2 text-xs text-slate-500 leading-relaxed border-t border-slate-100 pt-2 hidden">
                        Garansi resmi ASUS berlaku selama 2 tahun untuk unit baru yang dibeli dari distributor resmi. Untuk mengecek status garansi, Anda dapat membawa unit beserta struk pembelian dan kartu garansi ke cabang kami. Klaim garansi tidak berlaku untuk kerusakan fisik (terjatuh, terkena air) atau modifikasi oleh pihak ketiga.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-xs">
                    <button type="button" onclick="toggleFaq(3)" class="w-full flex items-center justify-between text-left font-bold text-xs text-slate-900">
                        <span>Metode pembayaran apa saja yang diterima di Azzahra Computer Cibubur?</span>
                        <i id="faq-icon-3" class="fa-solid fa-chevron-down text-blue-600 text-[10px] transition-transform"></i>
                    </button>
                    <div id="faq-body-3" class="mt-2 text-xs text-slate-500 leading-relaxed border-t border-slate-100 pt-2 hidden">
                        Kami menerima pembayaran Tunai, Transfer Bank (BCA, Mandiri, BRI, BNI), QRIS/scan barcode, serta e-wallet seperti GoPay, OVO, dan Dana. Untuk servis dengan nilai tertentu juga tersedia opsi cicilan melalui kartu kredit.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-2xl border border-slate-200 p-4 shadow-xs">
                    <button type="button" onclick="toggleFaq(4)" class="w-full flex items-center justify-between text-left font-bold text-xs text-slate-900">
                        <span>Apakah bisa cek status servis laptop saya dari rumah?</span>
                        <i id="faq-icon-4" class="fa-solid fa-chevron-down text-blue-600 text-[10px] transition-transform"></i>
                    </button>
                    <div id="faq-body-4" class="mt-2 text-xs text-slate-500 leading-relaxed border-t border-slate-100 pt-2 hidden">
                        Tentu bisa! Anda cukup menghubungi WhatsApp Service Center kami (+62 814-7665-2656) untuk menanyakan status perkembangan servis. Tim kami akan memberikan update terkini mengenai estimasi selesai dan kondisi perangkat Anda.
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================================================================
             10. BOTTOM CTA BANNER (Sesuai Foto Persis)
             =================================================================== --}}
        <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 rounded-3xl p-7 sm:p-9 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="space-y-2 max-w-xl">
                <h3 class="text-2xl sm:text-3xl font-extrabold font-heading text-white leading-tight">
                    Butuh Solusi Servis ASUS Cepat Hari Ini?
                </h3>
                <p class="text-xs text-blue-100 leading-relaxed">
                    Kunjungi Azzahra Computer Cabang Cibubur atau terhubung dengan tim teknisi kami dalam hitungan menit melalui WhatsApp. Dapatkan estimasi biaya servis gratis!
                </p>
            </div>
            <a href="https://wa.me/{{ $institution['whatsapp'] ?? '6281476652656' }}?text=Halo+Azzahra+Computer+Cibubur%2C+saya+ingin+konsultasi+servis+ASUS."
               target="_blank"
               class="px-6 py-3.5 bg-white text-blue-800 hover:bg-blue-50 font-extrabold text-xs rounded-xl shadow-md transition shrink-0 flex items-center gap-2">
                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                <span>Chat WhatsApp Sekarang</span>
            </a>
        </div>

    </div>
</main>

{{-- ===================================================================
     11. FOOTER (Sesuai Foto Persis)
     =================================================================== --}}
<footer id="footer" class="bg-white border-t border-slate-200 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500 mt-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">

        <!-- Col 1: Brand Info -->
        <div class="space-y-3">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold">
                    <i class="fa-solid fa-laptop text-sm"></i>
                </div>
                <span class="font-heading font-extrabold text-lg text-slate-900">Azzahra Computer</span>
            </div>
            <p class="text-xs text-slate-500 leading-relaxed">
                Azzahra Computer – ASUS Authorized Service Center, melayani servis resmi, konsultasi produk, dan klaim garansi ASUS di wilayah Cibubur, Bekasi, dan Tegal.
            </p>
            <div class="pt-2 flex items-center gap-2">
                <span class="inline-block px-2.5 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-lg border border-blue-200">
                    ASUS Authorized Service
                </span>
                <span class="inline-block px-2.5 py-1 bg-slate-100 text-slate-600 text-[10px] font-medium rounded-lg">
                    Cibubur &amp; Tegal
                </span>
            </div>
        </div>

        <!-- Col 2: Cabang Jakarta Selatan -->
        <div class="space-y-2.5">
            <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Cabang Cibubur (Bekasi)</h4>
            <div class="flex items-start gap-2 text-xs">
                <i class="fa-solid fa-location-dot text-blue-600 mt-0.5 shrink-0"></i>
                <p class="leading-relaxed">{{ $institution['branch_full_address'] ?? 'Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431' }}</p>
            </div>
            <div class="flex items-center gap-2 text-xs pt-1">
                <i class="fa-solid fa-phone text-blue-600 shrink-0"></i>
                <span>WhatsApp / Telp: <strong class="text-slate-800">{{ $institution['front_office_phone'] ?? '+62 814-7665-2656' }}</strong></span>
            </div>
            <div class="flex items-center gap-2 text-xs">
                <i class="fa-regular fa-clock text-blue-600 shrink-0"></i>
                <span>{{ $institution['jam_buka'] ?? 'Senin - Sabtu: 08.00 - 17.00 WIB' }}</span>
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
                <li><a href="{{ route('bimbel.portal') }}" class="hover:text-blue-600 transition">Unduh Silabus &amp; Modul Bank Soal</a></li>
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
    function toggleFaq(id) {
        const body = document.getElementById('faq-body-' + id);
        const icon = document.getElementById('faq-icon-' + id);
        if (body.classList.contains('hidden')) {
            body.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            body.classList.add('hidden');
            icon.style.transform = 'none';
        }
    }
    function handleBookingKunjungan(e) {
        e.preventDefault();
        const nama = document.getElementById('k-nama').value;
        const wa = document.getElementById('k-wa').value;
        const sekolah = document.getElementById('k-sekolah').value;
        const jenjang = document.getElementById('k-jenjang').value;
        const tujuanEl = document.querySelector('input[name="tujuan"]:checked');
        const tujuan = tujuanEl ? tujuanEl.value : '-';
        const tanggal = document.getElementById('k-tanggal').value;
        const slot = document.getElementById('k-slot').value;
        const catatan = document.getElementById('k-catatan').value;

        const pesan = `Halo Front Office Apex Edu Tebet, saya ingin konfirmasi jadwal kunjungan tatap muka:
- Nama: ${nama}
- WhatsApp: ${wa}
- Asal Sekolah: ${sekolah}
- Jenjang: ${jenjang}
- Tujuan: ${tujuan}
- Rencana Tanggal: ${tanggal}
- Slot Waktu: ${slot}
- Catatan: ${catatan || '-'}`;

        const waUrl = `https://wa.me/{{ $institution['whatsapp'] ?? '6281299003420' }}?text=${encodeURIComponent(pesan)}`;
        window.open(waUrl, '_blank');
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeBimbelNav();
    });
</script>
</body>
</html>
