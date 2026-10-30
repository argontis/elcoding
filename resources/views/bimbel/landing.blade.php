<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $institution['name'] }} — {{ $institution['subname'] }}</title>
    <meta name="description" content="{{ $institution['subheadline'] }}">

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
                        <span class="text-[9px] font-bold bg-blue-50 text-blue-700 px-1.5 py-0.5 rounded-full border border-blue-200 whitespace-nowrap">Pusat Informasi</span>
                    </div>
                    <p class="text-[9px] text-slate-400 font-mono -mt-0.5">localhost:8000/clean</p>
                </div>
            </a>

            <!-- Navigation Links (Selalu Kesamping / No-Wrap) -->
            <nav class="hidden lg:flex items-center gap-2 xl:gap-3.5 2xl:gap-5 text-xs xl:text-[13px] font-semibold text-slate-600 whitespace-nowrap shrink-0">
                <a href="{{ route('bimbel.landing') }}" class="px-3 py-1.5 bg-blue-600 text-white font-bold rounded-xl shadow-sm transition whitespace-nowrap">Beranda</a>
                <a href="{{ route('bimbel.program.page') }}" class="px-2 py-1 hover:text-blue-600 transition whitespace-nowrap">Program &amp; Biaya</a>
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

                <!-- ====================================== -->
                <!-- HAMBURGER BUTTON (Mobile & Tablet)    -->
                <!-- ====================================== -->
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

    <!-- Overlay / Backdrop -->
    <div id="bimbel-nav-overlay"
         onclick="closeBimbelNav()"
         class="lg:hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm"
         style="opacity:0; visibility:hidden; transition: opacity 0.25s ease, visibility 0.25s ease;"></div>

    <!-- Drawer Panel (slides from right) -->
    <div id="bimbel-nav-drawer"
         class="lg:hidden fixed top-0 right-0 h-full w-[290px] z-50 bg-white shadow-2xl border-l border-slate-200"
         style="transform: translateX(100%); transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);">

        <!-- Drawer Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap text-sm"></i>
                </div>
                <div>
                    <div class="font-heading font-extrabold text-base text-slate-900 leading-none">{{ $institution['name'] }}</div>
                    <div class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider">Edu Bimbel</div>
                </div>
            </div>
            <button onclick="closeBimbelNav()"
                    class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 hover:text-slate-900 flex items-center justify-center transition">
                <i class="fa-solid fa-times text-sm"></i>
            </button>
        </div>

        <!-- Drawer Navigation Links -->
        <nav class="p-4 space-y-1">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-2">Navigasi Utama</p>

            <a href="{{ route('bimbel.landing') }}" onclick="closeBimbelNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold bg-blue-50 text-blue-700 transition">
                <i class="fa-solid fa-house text-blue-600 w-5"></i>
                Beranda
            </a>

            <a href="{{ route('bimbel.program.page') }}" onclick="closeBimbelNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="fa-solid fa-book-open text-slate-400 w-5"></i>
                Program &amp; Biaya
            </a>

            <a href="{{ url('/bimbel#fasilitas') }}" onclick="closeBimbelNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="fa-solid fa-laptop-file text-slate-400 w-5"></i>
                Fasilitas &amp; Keunggulan
            </a>

            <a href="{{ url('/bimbel#tutor') }}" onclick="closeBimbelNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="fa-solid fa-chalkboard-user text-slate-400 w-5"></i>
                Master Tutor
            </a>

            <a href="{{ url('/bimbel#alur') }}" onclick="closeBimbelNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="fa-solid fa-route text-slate-400 w-5"></i>
                Alur Kelulusan
            </a>

            <a href="{{ url('/bimbel#testimoni') }}" onclick="closeBimbelNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-700 transition">
                <i class="fa-solid fa-award text-slate-400 w-5"></i>
                Hasil Kelulusan Siswa
            </a>

            <!-- Divider -->
            <div class="border-t border-slate-100 my-3"></div>

            <!-- CTA Buttons inside Mobile Drawer -->
            <button type="button" onclick="closeBimbelNav(); openRegistrationModal()"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                <i class="fa-solid fa-user-plus text-xs"></i>
                Daftar Siswa Baru
            </button>

            <a href="{{ url('/bimbel-dashboard') }}" onclick="closeBimbelNav()"
               class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition mt-2">
                <i class="fa-solid fa-arrow-right-to-bracket text-xs text-slate-500"></i>
                Portal Siswa &amp; Tutor
            </a>

            <!-- Toggle Demo in Drawer -->
            <div class="pt-4">
                @if($isDemo)
                    <a href="{{ route('bimbel.landing') }}" class="block text-center text-xs text-amber-700 font-semibold bg-amber-50 p-2.5 rounded-lg border border-amber-200">
                        <i class="fa-solid fa-database mr-1"></i> Beralih ke Data Kosong
                    </a>
                @else
                    <a href="{{ route('bimbel.landing', ['demo' => 1]) }}" class="block text-center text-xs text-blue-700 font-semibold bg-blue-50 p-2.5 rounded-lg border border-blue-200">
                        <i class="fa-solid fa-eye mr-1"></i> Pratinjau Tampilan Demo
                    </a>
                @endif
            </div>
        </nav>

        <!-- Drawer Footer Info -->
        <div class="absolute bottom-0 left-0 right-0 px-5 py-4 border-t border-slate-100 bg-slate-50 text-xs text-slate-500">
            <p class="font-bold text-slate-700">EduPulse Academy Hotline</p>
            <p>{{ $institution['hotline'] }} &bull; {{ $institution['jam_layanan'] }}</p>
        </div>
    </div>

    <!-- Alert Success Notification -->
    @if(session('success_daftar'))
        <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4">
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex flex-wrap items-center justify-between gap-3 text-emerald-800 text-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                    <div>
                        <strong class="font-bold">Form Terkirim!</strong> {{ session('success_daftar') }}
                    </div>
                </div>
                @if(session('wa_redirect'))
                    <a href="{{ session('wa_redirect') }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 text-white px-3.5 py-1.5 rounded-lg text-xs font-bold hover:bg-emerald-700 transition">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Konfirmasi via WhatsApp</span>
                    </a>
                @endif
            </div>
        </div>
    @endif

    <!-- Clean / Empty State Info Banner -->
    @if(!$isDemo)
        <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4">
            <div class="bg-blue-50/70 border border-blue-200/80 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 text-xs text-blue-900">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-600 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-circle-info text-xs"></i>
                    </div>
                    <div>
                        <strong class="font-bold">Status Data: Mode Data Kosong (Clean Database State)</strong>
                        <p class="text-blue-700 mt-0.5">Sesuai permintaan Anda, seluruh program, tutor, testimoni, dan nilai dalam keadaan kosong &amp; siap diisi. Anda dapat mengaktifkan data contoh sewaktu-waktu.</p>
                    </div>
                </div>
                <a href="{{ route('bimbel.landing', ['demo' => 1]) }}" class="shrink-0 bg-white hover:bg-blue-100 text-blue-700 border border-blue-300 font-bold px-3.5 py-1.5 rounded-lg transition shadow-2xs">
                    <i class="fa-solid fa-wand-magic-sparkles mr-1"></i> Tampilkan Data Demo
                </a>
            </div>
        </div>
    @endif

    <!-- ========================================================= -->
    <!-- 3. HERO SECTION (Split: Headline + Quick Student Card)    -->
    <!-- ========================================================= -->
    <section id="beranda" class="py-8 sm:py-14 px-4 sm:px-8 bg-gradient-to-b from-blue-50/50 via-white to-[#f8fafc]">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- LEFT COLUMN: Headline & Value Proposition -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <!-- Accreditation Tag -->
                <div class="inline-flex items-center gap-2 bg-blue-100/80 border border-blue-200 text-blue-800 text-xs font-bold px-3.5 py-1 rounded-full w-fit mb-4">
                    <i class="fa-solid fa-star text-amber-500 text-xs"></i>
                    <span>{{ $institution['tagline'] }}</span>
                </div>

                <!-- Main Heading -->
                <h1 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight leading-[1.18] mb-4">
                    {{ $institution['headline'] }} <span class="text-blue-600 underline decoration-blue-200 decoration-wavy decoration-2">{{ $institution['headline_accent'] }}</span>
                </h1>

                <!-- Subheadline -->
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6 max-w-2xl">
                    {{ $institution['subheadline'] }}
                </p>

                <!-- Key Metrics & Counter Strip (Empty or Demo) -->
                <div class="grid grid-cols-3 gap-3 sm:gap-4 p-4 bg-white border border-slate-200 rounded-2xl shadow-xs mb-6">
                    <div>
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">{{ $metrics['lolos_ptn'] }}</div>
                        <div class="text-[11px] sm:text-xs text-slate-500 font-medium mt-0.5">{{ $metrics['lolos_label'] }}</div>
                    </div>
                    <div class="border-l border-slate-200 pl-3 sm:pl-4">
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">{{ $metrics['siswa_aktif'] }}</div>
                        <div class="text-[11px] sm:text-xs text-slate-500 font-medium mt-0.5">{{ $metrics['siswa_label'] }}</div>
                    </div>
                    <div class="border-l border-slate-200 pl-3 sm:pl-4">
                        <div class="font-heading font-extrabold text-2xl sm:text-3xl text-slate-900 tracking-tight">{{ $metrics['kepuasan'] }}</div>
                        <div class="text-[11px] sm:text-xs text-slate-500 font-medium mt-0.5">{{ $metrics['kepuasan_label'] }}</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-3 mb-6">
                    <button type="button" onclick="openRegistrationModal()" class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md shadow-blue-500/20 transition flex items-center gap-2">
                        <span>Informasi &amp; Pendaftaran Bimbel</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>
                    <a href="https://wa.me/{{ $institution['whatsapp'] }}?text={{ urlencode('Halo EduPulse Academy, saya ingin konsultasi program bimbel & biaya.') }}" target="_blank"
                       class="px-5 py-3.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 font-bold text-sm rounded-xl transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i>
                        <span>Konsultasi Gratis via WhatsApp</span>
                    </a>
                </div>

                <!-- Social Proof / Student Avatars Strip -->
                <div class="flex items-center gap-3 pt-2 text-xs text-slate-500">
                    <div class="flex -space-x-2">
                        <div class="w-7 h-7 rounded-full bg-blue-600 text-white flex items-center justify-center text-[10px] font-bold border-2 border-white">AP</div>
                        <div class="w-7 h-7 rounded-full bg-indigo-600 text-white flex items-center justify-center text-[10px] font-bold border-2 border-white">SR</div>
                        <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center text-[10px] font-bold border-2 border-white">IH</div>
                    </div>
                    <span>
                        @if($isDemo)
                            Dipercaya lebih dari <strong>1.200+ siswa &amp; orang tua</strong> di wilayah Jabodetabek.
                        @else
                            Program bimbingan siap menerima pendaftaran angkatan baru (Tahun Ajaran Aktif).
                        @endif
                    </span>
                </div>
            </div>

            <!-- RIGHT COLUMN: Fast Student Portal & Registration Box -->
            <div class="lg:col-span-5">
                <div class="bg-white border-2 border-blue-200/90 rounded-3xl p-6 sm:p-7 shadow-xl shadow-blue-500/5 relative overflow-hidden">
                    
                    <!-- Decorative Top Glow -->
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>

                    <!-- Header Inside Card -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-200">PUSAT INFORMASI AKADEMIK</span>
                            <h3 class="font-heading font-extrabold text-lg text-slate-900 mt-1">Pusat Informasi &amp; Layanan Siswa</h3>
                        </div>
                        <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-id-card text-sm"></i>
                        </div>
                    </div>

                    <!-- Tabs: Cek Kelulusan vs Status Pendaftaran -->
                    <div class="flex gap-2 p-1 bg-slate-100 rounded-xl my-4 text-xs font-bold text-slate-600">
                        <button type="button" id="tab-cek-btn" onclick="switchQuickTab('cek')" class="flex-1 py-2 rounded-lg bg-white text-blue-600 shadow-2xs transition">
                            Cek Kelulusan
                        </button>
                        <button type="button" id="tab-daftar-btn" onclick="switchQuickTab('daftar')" class="flex-1 py-2 rounded-lg text-slate-600 hover:text-slate-900 transition">
                            Status Pendaftaran
                        </button>
                    </div>

                    <!-- Tab Content 1: Cek Kelulusan / Rapor -->
                    <div id="tab-cek-content" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Registrasi / NISN Siswa</label>
                            <div class="relative">
                                <input type="text" id="quick-nisn" placeholder="Contoh: 0072819281 atau REG-..."
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 text-sm font-mono font-semibold py-2.5 pl-10 pr-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none transition">
                                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            </div>
                            <p class="text-[11px] text-slate-500 mt-1">Masukkan nomor registrasi tryout atau NISN yang terdaftar.</p>
                        </div>

                        <button type="button" onclick="checkStudentStatus()" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                            <i class="fa-solid fa-circle-check text-xs"></i>
                            <span>Lihat Hasil &amp; Rapor Belajar</span>
                        </button>

                        <div id="quick-result" class="hidden p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600">
                            <!-- Dynamic Result filled via JS -->
                        </div>
                    </div>

                    <!-- Tab Content 2: Konsultasi / Form Siswa Baru -->
                    <div id="tab-daftar-content" class="space-y-3.5 hidden">
                        <form action="{{ route('bimbel.daftar') }}" method="POST">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap Siswa</label>
                                <input type="text" name="nama_siswa" required placeholder="Nama lengkap..."
                                       class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm py-2 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                            </div>

                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Jenjang</label>
                                    <select name="jenjang" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-xs py-2 px-2.5 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                                        <option value="SMA/UTBK">SMA / UTBK</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SD">SD</option>
                                        <option value="Kedinasan">Kedinasan</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">WhatsApp</label>
                                    <input type="text" name="no_whatsapp" required placeholder="08..."
                                           class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm py-2 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                                </div>
                            </div>

                            <button type="submit" class="w-full mt-3 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl transition shadow-sm flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-paper-plane text-xs"></i>
                                <span>Kirim Permintaan Konsultasi</span>
                            </button>
                        </form>
                    </div>

                    <!-- Card Footer Note -->
                    <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-solid fa-shield-halved text-blue-500 text-xs"></i>
                            <span>Pusat Bantuan Akademik</span>
                        </div>
                        <a href="https://wa.me/{{ $institution['whatsapp'] }}" target="_blank" class="text-blue-600 font-bold hover:underline">Chat CS &rarr;</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 4. SECTION: PROGRAM BIMBINGAN BELAJAR                     -->
    <!-- ========================================================= -->
    <section id="program" class="py-12 sm:py-16 px-4 sm:px-8 border-t border-slate-200/80 bg-white">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">PAKET &amp; BIAYA TERJANGKAU</span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight mt-2">
                        Program Bimbingan Belajar Bergaransi Mutu &amp; Prestasi
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-1.5 max-w-2xl">
                        Pilih jenjang bimbingan belajar sesuai kebutuhan. Semua paket bimbingan dirancang dengan metode adaptif &amp; modul resmi.
                    </p>
                </div>

                <!-- Program Category Filter (Tabs) -->
                <div class="flex items-center gap-1.5 bg-slate-100 p-1 rounded-xl text-xs font-bold text-slate-600 overflow-x-auto shrink-0">
                    <button class="px-3 py-1.5 rounded-lg bg-white text-blue-600 shadow-2xs whitespace-nowrap">Semua Program</button>
                    <button class="px-3 py-1.5 rounded-lg hover:text-slate-900 whitespace-nowrap">SD</button>
                    <button class="px-3 py-1.5 rounded-lg hover:text-slate-900 whitespace-nowrap">SMP</button>
                    <button class="px-3 py-1.5 rounded-lg hover:text-slate-900 whitespace-nowrap">SMA &amp; UTBK</button>
                    <button class="px-3 py-1.5 rounded-lg hover:text-slate-900 whitespace-nowrap">Kedinasan</button>
                </div>
            </div>

            <!-- PROGRAMS GRID -->
            @if(count($programs) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($programs as $prog)
                        <div class="bg-white rounded-3xl p-6 border {{ $prog['is_popular'] ? 'border-2 border-blue-600 shadow-lg shadow-blue-500/10' : 'border-slate-200' }} bimbel-card flex flex-col justify-between relative">
                            
                            @if($prog['is_popular'])
                                <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-wider px-3 py-0.5 rounded-full shadow-sm">
                                    PALING DIMINATI
                                </div>
                            @endif

                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-lg border {{ $prog['badge_color'] }}">
                                        {{ $prog['badge'] }}
                                    </span>
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                                        <i class="{{ $prog['icon'] }} text-xs"></i>
                                    </div>
                                </div>

                                <h3 class="font-heading font-extrabold text-xl text-slate-900 mb-1.5">{{ $prog['title'] }}</h3>
                                <p class="text-xs text-slate-500 leading-relaxed mb-4">{{ $prog['desc'] }}</p>

                                <div class="mb-5 pb-5 border-b border-slate-100">
                                    <span class="text-xs text-slate-400 font-semibold">Mulai dari</span>
                                    <div class="flex items-baseline gap-1 mt-0.5">
                                        <span class="text-xs font-bold text-slate-500">Rp</span>
                                        <span class="font-heading font-extrabold text-2xl text-slate-900">{{ $prog['price'] }}</span>
                                        <span class="text-xs text-slate-500 font-medium">{{ $prog['period'] }}</span>
                                    </div>
                                </div>

                                <ul class="space-y-2.5 text-xs text-slate-600 mb-6">
                                    @foreach($prog['features'] as $f)
                                        <li class="flex items-center gap-2">
                                            <i class="fa-solid fa-circle-check text-blue-600 text-xs shrink-0"></i>
                                            <span>{{ $f }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <button type="button" onclick="openRegistrationModal('{{ $prog['title'] }}')"
                                    class="w-full py-2.5 rounded-xl text-xs font-bold transition flex items-center justify-center gap-2 {{ $prog['is_popular'] ? 'bg-blue-600 hover:bg-blue-700 text-white shadow-sm' : 'bg-slate-100 hover:bg-blue-50 text-slate-700 hover:text-blue-700 border border-slate-200' }}">
                                <span>Pilih Paket Ini</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- EMPTY DATA STATE: Sesuai Instruksi User -->
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-10 sm:p-14 text-center max-w-2xl mx-auto">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mx-auto text-2xl mb-4">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h3 class="font-heading font-extrabold text-xl text-slate-900 mb-1">Data Paket Bimbingan Belajar Kosong</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
                        Belum ada paket bimbel yang ditambahkan untuk periode akademik ini. Silakan input program baru melalui panel pengelola atau aktifkan data demo untuk simulasi visual.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <a href="{{ route('bimbel.landing', ['demo' => 1]) }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-xs flex items-center gap-2">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                            <span>Tampilkan 4 Contoh Paket Demo</span>
                        </a>
                        <button type="button" onclick="openRegistrationModal()" class="px-5 py-2.5 bg-white hover:bg-slate-100 text-slate-700 border border-slate-300 text-xs font-bold rounded-xl transition">
                            Konsultasi Paket Kustom
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 5. SECTION: FASILITAS & KEUNGGULAN BELAJAR                -->
    <!-- ========================================================= -->
    <section id="fasilitas" class="py-12 sm:py-16 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">METODE &amp; FASILITAS TERBAIK</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight mt-2">
                    Dirancang Khusus untuk Mengikis Titik Lemah Siswa
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2">
                    Kombinasi pendampingan personal, fasilitas modern, dan bank soal digital untuk mencapai hasil ujian maksimal.
                </p>
            </div>

            <!-- 4 Feature Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                @foreach($facilities as $fac)
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-2xs bimbel-card">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl mb-4">
                            <i class="{{ $fac['icon'] }}"></i>
                        </div>
                        <h3 class="font-heading font-bold text-base text-slate-900 mb-1.5">{{ $fac['title'] }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $fac['desc'] }}</p>
                    </div>
                @endforeach
            </div>

            <!-- 3 Photo Gallery Cards (As seen in the screenshot) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Photo 1: Ruang Kelas -->
                <div class="group relative rounded-2xl overflow-hidden border border-slate-200 shadow-xs h-64 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=700&q=80"
                         alt="Ruang Kelas Tatap Muka"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-300 bg-blue-900/80 px-2 py-0.5 rounded border border-blue-400/30">KELAS MAKS 10 SISWA</span>
                        <h4 class="font-heading font-bold text-base mt-1">Ruang Kelas Ber-AC &amp; Ergonomis</h4>
                        <p class="text-xs text-slate-300 mt-0.5 line-clamp-1">Suasana interaktif fokus tanpa distraksi bising.</p>
                    </div>
                </div>

                <!-- Photo 2: Lab Komputer CBT -->
                <div class="group relative rounded-2xl overflow-hidden border border-slate-200 shadow-xs h-64 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=700&q=80"
                         alt="Laboratorium CBT"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300 bg-emerald-900/80 px-2 py-0.5 rounded border border-emerald-400/30">STANDAR UJIAN SNBT</span>
                        <h4 class="font-heading font-bold text-base mt-1">Laboratorium Komputer CBT</h4>
                        <p class="text-xs text-slate-300 mt-0.5 line-clamp-1">Simulasi ujian berkala pembobotan item response IRT.</p>
                    </div>
                </div>

                <!-- Photo 3: Study Lounge -->
                <div class="group relative rounded-2xl overflow-hidden border border-slate-200 shadow-xs h-64 bg-slate-900">
                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=700&q=80"
                         alt="Study Lounge"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-90">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-white">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-amber-300 bg-amber-900/80 px-2 py-0.5 rounded border border-amber-400/30">BEBAS TANYA PR 1 ON 1</span>
                        <h4 class="font-heading font-bold text-base mt-1">Study Lounge &amp; Diskusi Privat</h4>
                        <p class="text-xs text-slate-300 mt-0.5 line-clamp-1">Area nyaman konsultasi PR dan bimbingan psikolog.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 6. SECTION: MASTER TUTOR LULUSAN KAMPUS TOP               -->
    <!-- ========================================================= -->
    <section id="tutor" class="py-12 sm:py-16 px-4 sm:px-8 border-t border-slate-200/80 bg-white">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">TENAGA PENGAJAR TERBAIK</span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight mt-2">
                        Belajar Langsung dari Master Tutor Lulusan Kampus Top
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-1.5 max-w-2xl">
                        Tutor berpengalaman yang tidak hanya menguasai materi, namun juga menguasai psikologi belajar remaja &amp; trik cepat bedah soal.
                    </p>
                </div>

                <a href="https://wa.me/{{ $institution['whatsapp'] }}" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1.5">
                    <span>Lihat Profil Lengkap 30+ Tutor Cabang</span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>

            @if(count($tutors) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($tutors as $tut)
                        <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-xs bimbel-card flex flex-col justify-between">
                            <div class="h-60 bg-slate-100 relative overflow-hidden">
                                <img src="{{ $tut['image'] }}" alt="{{ $tut['name'] }}" class="w-full h-full object-cover">
                                <span class="absolute top-3 right-3 text-[10px] font-bold uppercase tracking-wider bg-white/95 text-blue-700 px-2.5 py-1 rounded-full shadow-sm">
                                    {{ $tut['tag'] }}
                                </span>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between text-xs text-slate-400 mb-1">
                                    <span>{{ $tut['experience'] }}</span>
                                    <span class="text-amber-500 font-bold"><i class="fa-solid fa-star text-[10px] mr-1"></i>{{ $tut['rating'] }}</span>
                                </div>
                                <h3 class="font-heading font-extrabold text-lg text-slate-900">{{ $tut['name'] }}</h3>
                                <p class="text-xs font-semibold text-blue-600 mt-0.5">{{ $tut['role'] }}</p>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">{{ $tut['campus'] }}</p>
                                <p class="text-xs text-slate-600 mt-3 pt-3 border-t border-slate-100 leading-relaxed">{{ $tut['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- EMPTY TUTOR STATE -->
                <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl p-10 text-center max-w-xl mx-auto">
                    <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mx-auto text-xl mb-3">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900 mb-1">Data Tutor Kosong</h3>
                    <p class="text-slate-500 text-xs max-w-md mx-auto mb-4">
                        Daftar master tutor sedang dalam tahap sinkronisasi jadwal semester baru. Klik tombol demo untuk melihat simulasi profil tutor.
                    </p>
                    <a href="{{ route('bimbel.landing', ['demo' => 1]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-2xs">
                        <i class="fa-solid fa-wand-magic-sparkles text-[10px]"></i>
                        <span>Tampilkan Contoh Profil Tutor</span>
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 7. SECTION: TESTIMONI SISWA & HASIL KELULUSAN             -->
    <!-- ========================================================= -->
    <section id="testimoni" class="py-12 sm:py-16 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">BUKTI NYATA ALUMNI</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight mt-2">
                    Mereka Membuktikannya, Kini Giliran Anda
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2">
                    Cerita nyata dari siswa dan orang tua yang telah berhasil menembus PTN dan sekolah favorit impian mereka.
                </p>
            </div>

            @if(count($testimonials) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($testimonials as $testi)
                        <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-2xs bimbel-card flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                                    @for($i = 0; $i < $testi['rating']; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                </div>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed italic mb-6">
                                    "{{ $testi['quote'] }}"
                                </p>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs">
                                    {{ strtoupper(substr($testi['name'], 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="font-heading font-bold text-sm text-slate-900 leading-tight">{{ $testi['name'] }}</h4>
                                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $testi['school'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- EMPTY TESTIMONIAL STATE -->
                <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-10 text-center max-w-xl mx-auto shadow-2xs">
                    <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mx-auto text-xl mb-3">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900 mb-1">Belum Ada Testimoni</h3>
                    <p class="text-slate-500 text-xs max-w-md mx-auto mb-4">
                        Testimoni kelulusan dan ulasan siswa untuk periode ini masih kosong.
                    </p>
                    <a href="{{ route('bimbel.landing', ['demo' => 1]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-xl transition shadow-2xs">
                        <i class="fa-solid fa-wand-magic-sparkles text-[10px]"></i>
                        <span>Tampilkan Testimoni Demo</span>
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 8. SECTION: ALUR TERPADU KELULUSAN                        -->
    <!-- ========================================================= -->
    <section id="alur" class="py-12 sm:py-16 px-4 sm:px-8 border-t border-slate-200/80 bg-white">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md border border-blue-200">SISTEM BELAJAR TERUJI</span>
                <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight mt-2">
                    Alur Terpadu dari Tamu Hingga Kelulusan Ujian
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2">
                    Setiap langkah dipantau secara terukur demi memastikan peningkatan nilai dan kesiapan mental siswa.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($steps as $s)
                    <div class="relative bg-slate-50 rounded-2xl p-6 border border-slate-200 bimbel-card">
                        <div class="w-10 h-10 rounded-xl bg-blue-600 text-white font-heading font-black text-lg flex items-center justify-center mb-4 shadow-sm shadow-blue-500/20">
                            {{ $s['step'] }}
                        </div>
                        <h3 class="font-heading font-bold text-base text-slate-900 mb-1.5">{{ $s['title'] }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $s['desc'] }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 9. CTA BANNER (Blue Gradient Box)                         -->
    <!-- ========================================================= -->
    <section class="py-8 sm:py-12 px-4 sm:px-8 bg-[#f8fafc]">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-700 rounded-3xl p-8 sm:p-12 text-white shadow-xl shadow-blue-600/10 flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="max-w-xl">
                    <span class="text-xs font-bold uppercase tracking-wider bg-white/20 text-white px-2.5 py-0.5 rounded-md">FREE ASSESSMENT &amp; TRIAL CLASS</span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl mt-2 leading-tight">
                        Ingin Konsultasi Gratis Program &amp; Biaya?
                    </h2>
                    <p class="text-xs sm:text-sm text-blue-100 mt-2 leading-relaxed">
                        Hubungi tim konselor akademik kami untuk jadwalkan tes diagnostik gratis dan konsultasi peluang prodi kampus impian Anda.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3 shrink-0">
                    <button type="button" onclick="openRegistrationModal()" class="px-6 py-3.5 bg-white hover:bg-slate-100 text-blue-700 font-bold text-xs sm:text-sm rounded-xl transition shadow-sm">
                        Daftar Trial Gratis
                    </button>
                    <a href="https://wa.me/{{ $institution['whatsapp'] }}" target="_blank"
                       class="px-6 py-3.5 bg-blue-800/80 hover:bg-blue-800 text-white border border-blue-400/40 font-bold text-xs sm:text-sm rounded-xl transition flex items-center gap-2">
                        <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                        <span>WhatsApp Konselor</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================================= -->
    <!-- 10. FOOTER                                                -->
    <!-- ========================================================= -->
    <footer class="bg-white border-t border-slate-200 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            <!-- Brand Column -->
            <div class="md:col-span-1">
                <div class="flex items-center gap-2.5 mb-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold">
                        <i class="fa-solid fa-graduation-cap text-sm"></i>
                    </div>
                    <span class="font-heading font-extrabold text-lg text-slate-900">{{ $institution['name'] }}</span>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed mb-4">
                    Lembaga bimbingan belajar dan persiapan masuk PTN, kedinasan, dan sekolah unggulan terkemuka di Indonesia.
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
                <p class="leading-relaxed">{{ $institution['alamat'] }}</p>
                <p class="mt-2"><strong class="text-slate-700">Telepon:</strong> {{ $institution['hotline'] }}</p>
                <p class="mt-1"><strong class="text-slate-700">Layanan:</strong> {{ $institution['jam_layanan'] }}</p>
            </div>

            <!-- Akses Cepat Siswa -->
            <div>
                <h4 class="font-heading font-bold text-slate-900 text-sm mb-3">Akses Cepat Siswa</h4>
                <ul class="space-y-2">
                    <li><a href="{{ url('/bimbel#beranda') }}" class="hover:text-blue-600 transition">Beranda Utama</a></li>
                    <li><a href="{{ url('/bimbel#program') }}" class="hover:text-blue-600 transition">Biaya &amp; Paket Program</a></li>
                    <li><a href="{{ url('/bimbel-dashboard') }}" class="hover:text-blue-600 transition">Portal Nilai Siswa (Login)</a></li>
                    <li><a href="{{ url('/verifikasi-sertifikat') }}" class="hover:text-blue-600 transition">Verifikasi Sertifikat</a></li>
                </ul>
            </div>

            <!-- Layanan & Komunitas -->
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
            <p>&copy; {{ date('Y') }} {{ $institution['name'] }} &bull; elc.my.id. Seluruh hak cipta dilindungi.</p>
            <div class="flex items-center gap-4">
                <a href="#" class="hover:text-slate-600">Kebijakan Privasi</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-slate-600">Syarat &amp; Ketentuan</a>
            </div>
        </div>
    </footer>

    <!-- ========================================================= -->
    <!-- MODAL PENDAFTARAN SISWA BARU                              -->
    <!-- ========================================================= -->
    <div id="modal-registrasi" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl border border-slate-200 relative">
            <button type="button" onclick="closeRegistrationModal()" class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                <i class="fa-solid fa-times"></i>
            </button>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-lg text-slate-900 leading-tight">Pusat Informasi &amp; Pendaftaran</h3>
                    <p class="text-xs text-slate-500">Konsultasi program belajar, jadwal &amp; tes diagnostik gratis</p>
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
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp (Aktif)</label>
                    <input type="text" name="no_whatsapp" required placeholder="08123456789..."
                           class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm py-2 px-3 rounded-xl focus:bg-white focus:border-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Pilihan Paket / Jenjang</label>
                    <input type="text" id="modal-paket-input" name="jenjang" value="UTBK Mandiri Lolos"
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
                        <span>Kirim Permintaan Konsultasi &amp; Pendaftaran</span>
                    </button>
                </div>
            </form>
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
            }
        });

        // Quick Tabs Switcher
        function switchQuickTab(tab) {
            const btnCek = document.getElementById('tab-cek-btn');
            const btnDaftar = document.getElementById('tab-daftar-btn');
            const contentCek = document.getElementById('tab-cek-content');
            const contentDaftar = document.getElementById('tab-daftar-content');

            if (tab === 'cek') {
                btnCek.className = 'flex-1 py-2 rounded-lg bg-white text-blue-600 shadow-2xs transition';
                btnDaftar.className = 'flex-1 py-2 rounded-lg text-slate-600 hover:text-slate-900 transition';
                contentCek.classList.remove('hidden');
                contentDaftar.classList.add('hidden');
            } else {
                btnDaftar.className = 'flex-1 py-2 rounded-lg bg-white text-blue-600 shadow-2xs transition';
                btnCek.className = 'flex-1 py-2 rounded-lg text-slate-600 hover:text-slate-900 transition';
                contentDaftar.classList.remove('hidden');
                contentCek.classList.add('hidden');
            }
        }

        // Check Student Status (Empty State Handler)
        function checkStudentStatus() {
            const input = document.getElementById('quick-nisn').value.trim();
            const resBox = document.getElementById('quick-result');
            resBox.classList.remove('hidden');

            if (!input) {
                resBox.innerHTML = `
                    <div class="text-amber-700 bg-amber-50 p-2.5 rounded-lg border border-amber-200">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i> Mohon masukkan nomor registrasi atau NISN siswa.
                    </div>`;
                return;
            }

            // Clean data state response
            resBox.innerHTML = `
                <div class="text-slate-700 bg-slate-100 p-2.5 rounded-lg border border-slate-200">
                    <div class="font-bold text-slate-900 flex items-center gap-1.5 mb-1">
                        <i class="fa-solid fa-database text-blue-600"></i> Status Data Kosong
                    </div>
                    <p class="text-[11px] leading-relaxed text-slate-600">
                        Tidak ditemukan catatan rapor untuk ID: <strong>${input}</strong>. Data siswa saat ini masih kosong & belum ada nilai tryout yang diinputkan.
                    </p>
                </div>`;
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
    </script>
</body>
</html>
