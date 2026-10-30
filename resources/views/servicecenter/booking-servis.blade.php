<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi Booking Servis — {{ $center['name'] }}</title>
    <meta name="description" content="Pusat informasi booking servis laptop, PC & hardware di TechFix Pro Service Center Cabang Clean. Panduan reservasi antrean, pilihan jalur express/reguler, shift teknisi, dan checklist penyerahan unit.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',300:'#93c5fd',
                            400:'#60a5fa',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',
                            800:'#1e40af',900:'#1e3a8a',950:'#172554',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #0f172a; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        .card-hover { transition: all 0.25s cubic-bezier(0.16,1,0.3,1); }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 16px 32px -8px rgba(37,99,235,0.12); }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] .faq-chevron { transform: rotate(180deg); }
        .faq-chevron { transition: transform 0.2s ease; }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col">

    {{-- MOBILE DRAWER --}}
    <div id="mobileDrawerOverlay" onclick="toggleMobileDrawer()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden"></div>
    <div id="mobileDrawer" class="fixed inset-y-0 right-0 w-[280px] bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-brand-600 text-white flex items-center justify-center">
                        <i class="fa-solid fa-microchip text-sm"></i>
                    </div>
                    <div>
                        <div class="font-heading font-extrabold text-sm text-slate-900 leading-tight">TechFix Pro</div>`r`n                        <div class="text-[9px] font-extrabold text-brand-600 uppercase tracking-wider">Service Center</div>
                    </div>
                </div>
                <button onclick="toggleMobileDrawer()" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <nav class="mt-2 flex flex-col space-y-1 p-3">
                <a href="{{ url('/ServiceCenter') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-house text-slate-400 w-4 text-center"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('servicecenter.cek-tiket') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-magnifying-glass text-brand-500 w-4 text-center"></i>
                    <span>Cek Tiket Servis</span>
                </a>
                <a href="{{ route('servicecenter.booking-servis') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-brand-600 text-white">
                    <i class="fa-solid fa-calendar-check w-4 text-center"></i>
                    <span>Booking Servis</span>
                </a>
                <a href="{{ route('servicecenter.katalog') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-laptop-medical text-brand-500 w-4 text-center"></i>
                    <span>Katalog Produk &amp; Sparepart</span>
                </a>
                <a href="{{ route('servicecenter.cek-biaya') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-tag text-emerald-500 w-4 text-center"></i>
                    <span>Cek Biaya &amp; Estimasi</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-slate-100">
            <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro+Service+Center,+saya+ingin+konsultasi+jadwal+booking+servis" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                Reservasi via WhatsApp
            </a>
        </div>
    </div>

    {{-- TOP STATUS BAR --}}
    <div class="bg-white border-b border-slate-200/80 text-[11px] font-semibold text-slate-600 py-2 px-4">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-y-1">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1.5 text-emerald-600 font-bold bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200/60">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>{{ $center['status'] }}</span>
                </div>
                <span class="hidden sm:inline text-slate-400">|</span>
                <span class="hidden sm:inline text-slate-500">Jam Operasional: <strong class="text-slate-700">{{ $center['jam_buka'] }}</strong></span>
                <span class="hidden md:inline text-slate-400">|</span>
                <span class="hidden md:inline text-slate-500">Rating: <strong class="text-slate-700">{{ $center['rating'] }}</strong> ({{ $center['total_review'] }} Review)</span>
            </div>
            <div class="flex items-center gap-2 text-[10px] font-bold">
                <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 border border-amber-200 px-2.5 py-0.5 rounded">
                    <i class="fa-solid fa-users text-amber-500"></i> Antrean Aktif: {{ $center['antrian'] }} Unit
                </span>
                <span class="hidden sm:inline-flex items-center gap-1 bg-brand-50 text-brand-700 px-2 py-0.5 rounded border border-brand-200/60">
                    <i class="fa-solid fa-shield text-brand-600"></i> Garansi {{ $center['garansi'] }}
                </span>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-40 px-4 sm:px-8 py-3.5">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <a href="{{ url('/ServiceCenter') }}" class="flex items-center gap-3 group shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-700 via-brand-600 to-indigo-600 text-white flex items-center justify-center text-lg shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform shrink-0">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <div class="whitespace-nowrap">
                    <div class="font-heading font-black text-base lg:text-lg text-slate-900 tracking-tight leading-none group-hover:text-brand-600 transition-colors whitespace-nowrap">TechFix Pro Service Center</div>
                    <div class="text-[9px] font-extrabold tracking-widest text-brand-600 uppercase mt-0.5 whitespace-nowrap">{{ $center['branch'] }}</div>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs xl:text-sm font-semibold text-slate-600 shrink-0 whitespace-nowrap">
                <a href="{{ url('/ServiceCenter') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Beranda</a>
                <a href="{{ route('servicecenter.cek-tiket') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Cek Tiket Servis</a>
                <a href="{{ route('servicecenter.booking-servis') }}" class="bg-brand-600 text-white px-3.5 py-2 rounded-xl font-bold shadow-xs whitespace-nowrap">Booking Servis</a>
                <a href="{{ route('servicecenter.katalog') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Katalog Produk &amp; Sparepart</a>
                <a href="{{ route('servicecenter.cek-biaya') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Cek Biaya &amp; Estimasi</a>
            </nav>

            <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
                <a href="{{ url('/techfix/dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition shadow-sm shrink-0 whitespace-nowrap">
                    <i class="fa-solid fa-shield-halved text-xs text-brand-400"></i>
                    <span class="hidden sm:inline">Masuk Tim</span>
                </a>
                <button type="button" onclick="toggleMobileDrawer()" class="lg:hidden w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 flex flex-col items-center justify-center gap-1 transition shrink-0">
                    <span class="w-4 h-0.5 bg-slate-700 rounded"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded"></span>
                </button>
            </div>
        </div>
    </header>

    {{-- HERO BANNER INFORMASI --}}
    <section class="bg-gradient-to-br from-brand-700 via-brand-600 to-indigo-700 text-white py-10 sm:py-14 px-4 sm:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-indigo-200 rounded-full blur-3xl"></div>
        </div>
        <div class="absolute inset-0 pointer-events-none opacity-[0.04]" style="background-image:radial-gradient(circle,white 1px,transparent 1px);background-size:28px 28px;"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex items-center gap-2 text-xs font-semibold text-blue-200 mb-5">
                <a href="{{ url('/ServiceCenter') }}" class="hover:text-white transition">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[9px] text-blue-300"></i>
                <span class="text-white">Booking Servis</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs font-bold uppercase tracking-wider text-blue-100">
                        <i class="fa-solid fa-calendar-check text-blue-200"></i>
                        Pusat Informasi Booking &amp; Reservasi Servis
                    </div>
                    <h1 class="font-heading font-black text-3xl sm:text-4xl lg:text-5xl leading-[1.15] tracking-tight">
                        Panduan Lengkap<br><span class="text-blue-200">Booking &amp; Jadwal Servis</span>
                    </h1>
                    <p class="text-blue-100 text-sm sm:text-base leading-relaxed max-w-lg">
                        Pelajari alur pendaftaran servis, pilihan jalur express 1–3 jam, rekomendasi shift kunjungan teknisi, dan dokumen kelengkapan sebelum membawa unit ke Cabang Clean.
                    </p>
                    <div class="flex flex-wrap gap-3 pt-2">
                        <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro+Service+Center,+saya+ingin+booking+jadwal+servis+laptop/PC." target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white text-sm font-bold shadow-lg transition">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            Booking via WhatsApp CS
                        </a>
                        <a href="{{ route('servicecenter.cek-tiket') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 border border-white/25 text-white text-sm font-bold hover:bg-white/20 transition">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Info Cek Tiket Servis
                        </a>
                    </div>
                </div>

                {{-- STATS HIGHLIGHT --}}
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">{{ $center['antrian'] }} <span class="text-sm font-semibold">Unit</span></div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Antrean Sedang Berjalan</div>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">~15 <span class="text-sm font-semibold">Menit</span></div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Estimasi Diagnosa Awal</div>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">100%</div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Gratis Biaya Booking</div>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">360 <span class="text-sm font-semibold">Hari</span></div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Maksimum Garansi Resmi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MAIN INFORMATIVE CONTENT --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10 space-y-14">

        {{-- SECTION 1: 4 TAHAP ALUR & PROSEDUR BOOKING --}}
        <section id="alur-servis">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-100 text-xs font-bold uppercase tracking-wider text-brand-700 mb-3">
                    <i class="fa-solid fa-network-wired text-brand-500"></i> Prosedur Resmi
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">4 Langkah Alur Booking &amp; Penanganan Servis</h2>
                <p class="text-slate-500 text-sm mt-2 max-w-xl mx-auto">Standar Operasional Prosedur (SOP) transparan dari penyerahan unit hingga serah terima bergaransi di Cabang Clean.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($alur_booking as $alur)
                <div class="card-hover bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs relative flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl {{ $alur['color'] }} border flex items-center justify-center text-lg shadow-xs">
                                <i class="{{ $alur['icon'] }}"></i>
                            </div>
                            <span class="font-heading font-black text-3xl text-slate-200 select-none">{{ $alur['step'] }}</span>
                        </div>
                        <div class="text-[10px] font-extrabold uppercase tracking-wider text-brand-600 mb-1">Tahap {{ $alur['step'] }}</div>
                        <h3 class="font-heading font-bold text-sm text-slate-900 mb-2 leading-snug">{{ $alur['title'] }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $alur['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 p-4 bg-emerald-50 border border-emerald-200/80 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-emerald-900">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-lock text-xs"></i>
                    </div>
                    <span><strong>Jaminan Transparansi 100%:</strong> Tidak ada tindakan pergantian suku cadang yang dilakukan tanpa konfirmasi dan persetujuan tertulis dari Anda terlebih dahulu.</span>
                </div>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro,+saya+ingin+konsultasi+servis" target="_blank" class="shrink-0 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition">
                    Mulai Konsultasi
                </a>
            </div>
        </section>

        {{-- SECTION 2: 3 PILIHAN TIER LAYANAN --}}
        <section id="tier-layanan">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-xs font-bold uppercase tracking-wider text-indigo-700 mb-3">
                    <i class="fa-solid fa-layer-group text-indigo-500"></i> Opsi Kebutuhan
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">Pilihan Jalur Layanan Servis</h2>
                <p class="text-slate-500 text-sm mt-2 max-w-xl mx-auto">Kami menyediakan 3 kategori pengerjaan yang disesuaikan dengan tingkat urgensi dan kerumitan kerusakan hardware Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($tipe_layanan as $tier)
                <div class="card-hover bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="p-5 bg-gradient-to-r {{ $tier['color'] }} text-white">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-lg">
                                    <i class="{{ $tier['icon'] }}"></i>
                                </div>
                                <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full {{ $tier['badge_bg'] }} shadow-xs">{{ $tier['badge'] }}</span>
                            </div>
                            <div class="font-heading font-black text-lg">{{ $tier['name'] }}</div>
                            <div class="text-xs text-white/80 mt-1 flex items-center gap-1.5">
                                <i class="fa-regular fa-clock text-[11px]"></i>
                                <span>Estimasi: <strong>{{ $tier['estimasi'] }}</strong></span>
                            </div>
                        </div>

                        <div class="p-5 space-y-4">
                            <div>
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">Cocok Untuk Kerusakan:</div>
                                <p class="text-xs text-slate-600 leading-relaxed">{{ $tier['cocok'] }}</p>
                            </div>

                            <div class="border-t border-slate-100 pt-3">
                                <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-2">Benefit Layanan:</div>
                                <div class="space-y-1.5">
                                    @foreach($tier['benefit'] as $bnf)
                                    <div class="flex items-center gap-2 text-xs text-slate-700">
                                        <i class="fa-solid fa-check text-emerald-500 text-[11px] shrink-0"></i>
                                        <span>{{ $bnf }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pt-0">
                        <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro,+saya+ingin+tanya+layanan+{{ urlencode($tier['name']) }}" target="_blank" class="w-full py-2.5 px-4 rounded-xl border border-slate-200 hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700 text-slate-700 font-bold text-xs transition flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-emerald-600"></i>
                            Pilih Jalur {{ $tier['name'] }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- SECTION 3: JADWAL OPERASIONAL & SHIFT TEKNISI --}}
        <section id="jadwal-shift">
            <div class="bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-7 h-7 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                                <i class="fa-solid fa-calendar-days text-xs"></i>
                            </div>
                            <h2 class="font-heading font-bold text-base text-slate-900">Jadwal Shift &amp; Rekomendasi Waktu Kunjungan</h2>
                        </div>
                        <p class="text-xs text-slate-500">Ketahui jam operasional shift teknisi laboratorium agar Anda mendapat waktu pelayanan paling optimal.</p>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-50 border border-blue-200 text-xs font-bold text-brand-700">
                        <i class="fa-regular fa-clock"></i>
                        Buka Setiap Hari: {{ $center['jam_buka'] }}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 divide-y md:divide-y-0 md:divide-x divide-slate-100">
                    @foreach($jadwal_shift as $shift)
                    <div class="p-6 space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-slate-900">{{ $shift['label'] }}</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $shift['kondisi_badge'] }}">{{ $shift['kondisi'] }}</span>
                        </div>
                        <div class="text-xs font-heading font-extrabold text-brand-600 flex items-center gap-1.5">
                            <i class="fa-regular fa-hourglass-half text-[11px]"></i>
                            <span>{{ $shift['waktu'] }}</span>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $shift['rekomendasi'] }}</p>
                    </div>
                    @endforeach
                </div>

                <div class="p-4 bg-slate-50 border-t border-slate-100 flex items-start gap-2 text-xs text-slate-600">
                    <i class="fa-solid fa-lightbulb text-amber-500 mt-0.5 shrink-0"></i>
                    <span><strong>Tips Praktis:</strong> Jika Anda ingin pengetesan cepat di tempat (misal ganti baterai / SSD), waktu paling ideal adalah shift <strong>Pagi (08:00 – 11:00 WIB)</strong> saat antrean lab belum menumpuk.</span>
                </div>
            </div>
        </section>

        {{-- SECTION 4: CHECKLIST SEBELUM DATANG --}}
        <section id="checklist">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 border border-amber-100 text-xs font-bold uppercase tracking-wider text-amber-700 mb-3">
                    <i class="fa-solid fa-clipboard-check text-amber-500"></i> Persiapan Servis
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">Checklist Sebelum Membawa Unit ke Service Center</h2>
                <p class="text-slate-500 text-sm mt-2 max-w-xl mx-auto">Pastikan 4 hal berikut telah siap agar proses serah terima dan diagnosa berjalan cepat tanpa kendala.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($checklist_syarat as $chk)
                <div class="card-hover bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 border border-amber-200 flex items-center justify-center text-lg mb-3 shadow-xs">
                        <i class="{{ $chk['icon'] }}"></i>
                    </div>
                    <h3 class="font-heading font-bold text-sm text-slate-900 mb-1.5">{{ $chk['title'] }}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">{{ $chk['desc'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="mt-6 bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-6 text-white flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-600 text-white flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <div class="font-heading font-bold text-base">Jaminan Keamanan &amp; Kerahasiaan Data Pribadi</div>
                        <div class="text-xs text-slate-400 mt-0.5">Teknisi kami menandatangani pakta integritas privasi data. Dokumen, foto, dan akun Anda terisolasi aman selama perbaikan.</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro,+saya+ingin+konfirmasi+jadwal+servis" target="_blank" class="shrink-0 px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs transition flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                    Hubungi CS Sekarang
                </a>
            </div>
        </section>

        {{-- SECTION 5: LOKASI & KONTAK RESERVASI --}}
        <section id="kontak-reservasi">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-6 shadow-xs">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h2 class="font-heading font-bold text-base text-slate-900">Lokasi Penyerahan Unit &amp; Drop-Off</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Alamat Lab Clean</div>
                                    <div class="text-xs text-slate-700 leading-relaxed">{{ $center['alamat'] }}</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Jam Operasional Servis</div>
                                    <div class="text-xs text-slate-700 font-semibold">{{ $center['jam_buka'] }}</div>
                                    <div class="text-[10px] text-slate-400">Senin – Minggu (Setiap Hari Buka)</div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">WhatsApp Reservasi</div>
                                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}" target="_blank" class="text-xs font-bold text-emerald-600 hover:underline">+62 811-9234-5555</a>
                                    <div class="text-[10px] text-slate-400">Respon reservasi &lt; 5 menit</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Hotline Toko</div>
                                    <div class="text-xs font-bold text-slate-700">{{ $center['no_telepon'] }}</div>
                                    <div class="text-[10px] text-slate-400">Konsultasi teknisi langsung</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Email Support</div>
                                    <div class="text-xs font-bold text-slate-700">{{ $center['email'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AKSI CEPAT / CALL TO ACTION --}}
                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>
                            <h2 class="font-heading font-bold text-base text-slate-900">Format Reservasi Cepat</h2>
                        </div>
                        <p class="text-xs text-slate-500 mb-3">Kirimkan format berikut ke WhatsApp kami untuk penjadwalan antrean:</p>
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-[11px] font-mono text-slate-700 space-y-1">
                            <div><strong>Nama:</strong> [Nama Anda]</div>
                            <div><strong>Tipe Unit:</strong> [Laptop / PC / Merk]</div>
                            <div><strong>Keluhan:</strong> [Gejala Kerusakan]</div>
                            <div><strong>Rencana Datang:</strong> [Hari &amp; Jam]</div>
                        </div>
                    </div>

                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro+Service+Center,%0ANama:+%0ATipe+Unit:+%0AKeluhan:+%0ARencana+Datang:+" target="_blank" class="w-full py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition flex items-center justify-center gap-2 shadow-sm">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        Kirim Format via WhatsApp
                    </a>
                </div>
            </div>
        </section>

        {{-- SECTION 6: FAQ SEPUTAR BOOKING SERVIS --}}
        <section id="faq-booking">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-50 border border-violet-100 text-xs font-bold uppercase tracking-wider text-violet-700 mb-3">
                    <i class="fa-solid fa-circle-question text-violet-500"></i> FAQ Booking
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">Pertanyaan Seputar Booking Servis</h2>
                <p class="text-slate-500 text-sm mt-2 max-w-xl mx-auto">Semua yang perlu Anda ketahui tentang sistem antrean, biaya reservasi, dan pembatalan servis.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-3">
                @foreach($faqs_booking as $i => $faq)
                <details class="group bg-white border border-slate-200/80 rounded-xl shadow-xs" {{ $i === 0 ? 'open' : '' }}>
                    <summary class="flex items-center justify-between px-5 py-4 cursor-pointer select-none">
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-lg bg-brand-50 text-brand-600 text-xs flex items-center justify-center font-bold shrink-0">{{ $i + 1 }}</div>
                            <span class="text-sm font-semibold text-slate-800">{{ $faq['q'] }}</span>
                        </div>
                        <i class="fa-solid fa-chevron-down faq-chevron text-slate-400 text-xs ml-3 shrink-0"></i>
                    </summary>
                    <div class="px-5 pb-4 pt-1">
                        <div class="pl-10 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">{{ $faq['a'] }}</div>
                    </div>
                </details>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <p class="text-sm text-slate-500 mb-3">Ingin menanyakan kendala spesifik perangkat Anda?</p>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro,+saya+ingin+konsultasi+kerusakan+laptop" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-sm font-bold shadow-md shadow-brand-600/20 transition">
                    <i class="fa-brands fa-whatsapp text-base"></i>
                    Konsultasi Gratis dengan Teknisi CS
                </a>
            </div>
        </section>

    </main>

    {{-- FOOTER --}}
    <footer class="bg-slate-900 text-slate-400 text-xs mt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-600 text-white flex items-center justify-center">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div>
                        <div class="font-heading font-black text-sm text-white">TechFix Pro Service Center</div>
                        <div class="text-[9px] text-brand-400 font-bold uppercase tracking-wider">{{ $center['branch'] }}</div>
                    </div>
                </div>
                <p class="text-xs leading-relaxed text-slate-500 max-w-xs">Spesialis reparasi laptop, PC desktop &amp; hardware motherboard terpercaya. Diagnosa transparan, bergaransi resmi.</p>
            </div>
            <div>
                <div class="font-bold text-white text-xs mb-3 uppercase tracking-wider">Halaman</div>
                <div class="space-y-2">
                    <a href="{{ url('/ServiceCenter') }}" class="block hover:text-white transition">Beranda</a>
                    <a href="{{ route('servicecenter.cek-tiket') }}" class="block hover:text-white transition">Cek Tiket Servis</a>
                    <a href="{{ route('servicecenter.booking-servis') }}" class="block hover:text-white transition">Booking Servis</a>
                    <a href="{{ route('servicecenter.katalog') }}" class="block hover:text-white transition">Katalog Produk &amp; Sparepart</a>
                    <a href="{{ route('servicecenter.cek-biaya') }}" class="block hover:text-white transition">Estimasi Biaya</a>
                </div>
            </div>
            <div>
                <div class="font-bold text-white text-xs mb-3 uppercase tracking-wider">Kontak Kami</div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-500 w-4"></i> +62 811-9234-5555</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-brand-400 w-4"></i> {{ $center['no_telepon'] }}</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-envelope text-indigo-400 w-4"></i> {{ $center['email'] }}</div>
                    <div class="flex items-start gap-2"><i class="fa-solid fa-location-dot text-red-400 w-4 mt-0.5 shrink-0"></i> <span><strong class="text-white">Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)</strong><br><span class="text-slate-400 text-[11px]">Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.</span></span></div>
                </div>
            </div>
        </div>
        <div class="border-t border-slate-800 px-4 sm:px-8 py-3 flex flex-col sm:flex-row items-center justify-between gap-2 text-[10px] text-slate-600">
            <span>&copy; {{ date('Y') }} TechFix Pro Service Center. All rights reserved.</span>
            <span class="flex items-center gap-1">Node: SC-CLEAN-HQ &bull; <span class="text-emerald-500 font-bold">● Live</span></span>
        </div>
    </footer>

    <script>
        const mobileDrawer = document.getElementById('mobileDrawer');
        const mobileDrawerOverlay = document.getElementById('mobileDrawerOverlay');
        let drawerOpen = false;

        function toggleMobileDrawer() {
            drawerOpen = !drawerOpen;
            if (drawerOpen) {
                mobileDrawer.style.transform = 'translateX(0)';
                mobileDrawerOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                mobileDrawer.style.transform = 'translateX(100%)';
                mobileDrawerOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }
    </script>
</body>
</html>
