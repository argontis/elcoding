<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Transparansi Biaya &amp; Estimasi Perbaikan — {{ $center['name'] }}</title>
    <meta name="description" content="Kalkulator transparansi biaya dan estimasi servis laptop, PC & motherboard di L-Coding Service Center Cabang Clean. Prinsip No Fix No Fee, diagnosa gratis, garansi resmi.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Outfit:wght@500;600;700;800;900&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
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
                        <div class="font-heading font-extrabold text-sm text-slate-900 leading-tight">L-Coding</div>
                        <div class="text-[9px] font-extrabold text-brand-600 uppercase tracking-wider">Service Center</div>
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
                <a href="{{ route('servicecenter.booking-servis') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-calendar-check text-amber-500 w-4 text-center"></i>
                    <span>Booking Servis</span>
                </a>
                <a href="{{ route('servicecenter.katalog') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-laptop-medical text-brand-500 w-4 text-center"></i>
                    <span>Katalog Produk &amp; Sparepart</span>
                </a>
                <a href="{{ route('servicecenter.cek-biaya') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-brand-600 text-white">
                    <i class="fa-solid fa-calculator w-4 text-center"></i>
                    <span>Cek Biaya &amp; Estimasi</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-slate-100">
            <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+L-Coding,+saya+ingin+konsultasi+biaya+servis" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                Konsultasi Biaya via WA
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
                <span class="hidden sm:inline text-slate-500">Jam: <strong class="text-slate-700">{{ $center['jam_buka'] }}</strong></span>
                <span class="hidden md:inline text-slate-400">|</span>
                <span class="hidden md:inline text-slate-500">Rating: <strong class="text-slate-700">{{ $center['rating'] }}</strong> ({{ $center['total_review'] }} Review)</span>
            </div>
            <div class="flex items-center gap-2 text-[10px] font-bold">
                <span class="hidden lg:inline-flex items-center gap-1 bg-slate-100 px-2 py-0.5 rounded text-slate-600">
                    <i class="fa-solid fa-microchip text-brand-600"></i> {{ $center['unit_aktif'] }} Unit Sedang Dikerjakan
                </span>
                <span class="inline-flex items-center gap-1 bg-brand-50 text-brand-700 px-2 py-0.5 rounded border border-brand-200/60">
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
                    <div class="font-heading font-black text-base lg:text-lg text-slate-900 tracking-tight leading-none group-hover:text-brand-600 transition-colors whitespace-nowrap">L-Coding Service Center</div>
                    <div class="text-[9px] font-extrabold tracking-widest text-brand-600 uppercase mt-0.5 whitespace-nowrap">{{ $center['branch'] }}</div>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs xl:text-sm font-semibold text-slate-600 shrink-0 whitespace-nowrap">
                <a href="{{ url('/ServiceCenter') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Beranda</a>
                <a href="{{ route('servicecenter.cek-tiket') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Cek Tiket Servis</a>
                <a href="{{ route('servicecenter.booking-servis') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Booking Servis</a>
                <a href="{{ route('servicecenter.katalog') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Katalog Produk &amp; Sparepart</a>
                <a href="{{ route('servicecenter.cek-biaya') }}" class="bg-brand-600 text-white px-4 py-2 rounded-xl font-bold shadow-xs whitespace-nowrap">Cek Biaya &amp; Estimasi</a>
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

    {{-- HERO HEADER (PERSIS FOTO) --}}
    <section class="bg-gradient-to-b from-blue-50/70 via-indigo-50/30 to-white pt-8 pb-6 px-4 sm:px-8 border-b border-slate-200/70">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="flex items-center justify-between text-[11px] font-mono text-slate-400 border-b border-slate-200/60 pb-2">
                <span class="font-bold text-slate-600">AZZAHRA-CIBUBUR / BILLING / COST_ESTIMATOR</span>
                <span class="text-emerald-700 font-bold flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    STANDAR TARIF RESMI CABANG CIBUBUR 2026
                </span>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div class="space-y-3 max-w-3xl">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-brand-50 border border-brand-200/80 text-[10px] font-extrabold uppercase tracking-wider text-brand-700">
                        <i class="fa-solid fa-shield-halved text-brand-500"></i>
                        TRANSPARANSI PENETAPAN BIAYA SERVIS
                    </div>
                    <h1 class="font-heading font-black text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
                        Kalkulator Transparansi Biaya &amp; Estimasi Perbaikan
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-2xl">
                        Simulasikan perkiraan biaya sebelum Anda datang ke bengkel. Seluruh tarif pengerjaan dan harga sparepart tertera secara terbuka dengan prinsip <strong class="text-slate-800">No Fix, No Fee</strong>.
                    </p>

                    <div class="flex flex-wrap items-center gap-3 pt-1 text-xs font-semibold text-slate-600">
                        <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-500"></i> Diagnosa Awal Gratis</span>
                        <span class="text-slate-300">&bull;</span>
                        <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-500"></i> Suku Cadang Original Grade A+</span>
                        <span class="text-slate-300">&bull;</span>
                        <span class="flex items-center gap-1.5"><i class="fa-solid fa-check text-emerald-500"></i> Garansi Pengerjaan 90–360 Hari</span>
                    </div>
                </div>

                {{-- Metric Card Right (Persis Foto) --}}
                <div class="shrink-0 bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs space-y-3 min-w-[260px]">
                    <div>
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Tingkat Transparansi Biaya</span>
                            <span class="font-heading font-black text-brand-700 text-sm">{{ $center['transparency'] }}</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-brand-600 h-2 rounded-full" style="width: 98.4%"></div>
                        </div>
                    </div>

                    <div class="border-t border-slate-100 pt-2 flex items-baseline justify-between">
                        <div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase">Biaya Pembatalan</div>
                            <div class="font-heading font-black text-lg text-emerald-600">Rp 0,-</div>
                        </div>
                        <span class="text-[9px] font-semibold text-slate-500 text-right max-w-[120px] leading-tight">Bebas biaya jika tidak setuju penawaran</span>
                    </div>

                    <div class="text-[10px] text-slate-400 font-mono text-center pt-1 border-t border-slate-100">
                        Update: Maret 2026 &bull; Realtime Sync
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- MAIN CONTENT AREA --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8 space-y-12">

        {{-- SECTION 1: PANDUAN CEK BIAYA — INFORMASI STATIS --}}
        <section id="kalkulator" class="space-y-4">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-8 h-8 rounded-lg bg-brand-600 text-white flex items-center justify-center text-sm shadow-xs">
                    <i class="fa-solid fa-info-circle"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-lg sm:text-xl text-slate-900">Cara Mendapatkan Estimasi Biaya</h2>
                    <p class="text-xs text-slate-500">Biaya perbaikan bersifat transparan dan dikonfirmasi langsung setelah diagnosa unit di laboratorium kami.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                {{-- LEFT COLUMN: 4 Langkah Info --}}
                <div class="lg:col-span-7 space-y-4">

                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs space-y-4">
                        <div class="text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100 pb-2">Alur Pengecekan & Konfirmasi Biaya</div>

                        @php
                        $steps = [
                            ['num'=>'1','icon'=>'fa-solid fa-store','color'=>'bg-blue-50 text-blue-600','title'=>'Kunjungi atau Hubungi Bengkel','desc'=>'Datang langsung ke Cabang Cibubur atau hubungi kami via WhatsApp untuk menyampaikan keluhan kerusakan unit Anda secara singkat.'],
                            ['num'=>'2','icon'=>'fa-solid fa-microscope','color'=>'bg-indigo-50 text-indigo-600','title'=>'Diagnosa di Lab (Gratis)','desc'=>'Teknisi memeriksa unit menggunakan alat diagnostik lab. Biaya diagnosa awal adalah Rp 0,- tanpa syarat apapun. Anda bisa menunggu atau meninggalkan unit.'],
                            ['num'=>'3','icon'=>'fa-solid fa-file-signature','color'=>'bg-amber-50 text-amber-700','title'=>'Rincian Biaya Dikirim via WA','desc'=>'Setelah diagnosa, teknisi akan mengirimkan rincian biaya part dan jasa via WhatsApp Anda. Pengerjaan HANYA dimulai setelah Anda menyetujui.'],
                            ['num'=>'4','icon'=>'fa-solid fa-shield-halved','color'=>'bg-emerald-50 text-emerald-600','title'=>'Bayar Sesuai Nota — No Hidden Fee','desc'=>'Pembayaran sesuai angka yang telah disetujui. Tidak ada biaya tambahan. Unit siap diambil lengkap dengan segel garansi resmi dan faktur digital.'],
                        ];
                        @endphp

                        <div class="space-y-4">
                            @foreach($steps as $step)
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200/80">
                                <div class="w-9 h-9 rounded-full bg-brand-600 text-white font-heading font-black text-sm flex items-center justify-center shrink-0 shadow-md shadow-brand-600/20">
                                    {{ $step['num'] }}
                                </div>
                                <div class="flex items-start gap-3 flex-1">
                                    <div class="w-8 h-8 rounded-lg {{ $step['color'] }} flex items-center justify-center text-sm shrink-0 mt-0.5">
                                        <i class="{{ $step['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-800">{{ $step['title'] }}</div>
                                        <p class="text-[11px] text-slate-500 leading-relaxed mt-0.5">{{ $step['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Referensi Estimasi Berdasarkan Jenis Kerusakan --}}
                    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs space-y-3">
                        <div class="text-xs font-bold text-slate-700 uppercase tracking-wider border-b border-slate-100 pb-2">Referensi Kisaran Biaya Per Jenis Kerusakan</div>
                        <div class="space-y-2">
                            @foreach($calc_damages as $dmg)
                            <div class="flex items-center justify-between p-3 rounded-xl border border-slate-200 bg-slate-50">
                                <div>
                                    <div class="text-xs font-bold text-slate-800 flex items-center gap-2">
                                        {{ $dmg['name'] }}
                                        <span class="text-[9px] font-bold px-1.5 rounded bg-slate-200 text-slate-600 uppercase">{{ $dmg['badge'] }}</span>
                                    </div>
                                    <p class="text-[11px] text-slate-500 mt-0.5 leading-snug">{{ $dmg['desc'] }}</p>
                                </div>
                                <div class="text-right shrink-0 ml-3">
                                    <div class="font-heading font-black text-xs text-brand-700">{{ $dmg['price_str'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <p class="text-[10px] text-slate-400 pt-1">* Biaya final dikonfirmasi setelah diagnosa unit di lab. Semua angka di atas hanya estimasi referensi awal.</p>
                    </div>

                </div>

                {{-- RIGHT COLUMN: Konsultasi via WhatsApp --}}
                <div class="lg:col-span-5 sticky top-20">
                    <div class="bg-gradient-to-b from-brand-900 via-brand-800 to-slate-900 rounded-2xl shadow-xl text-white p-6 space-y-5">
                        
                        <div>
                            <div class="text-[10px] font-mono font-bold uppercase tracking-wider text-brand-300 flex items-center gap-1.5">
                                <i class="fa-brands fa-whatsapp"></i>
                                KONSULTASI BIAYA GRATIS
                            </div>
                            <h3 class="font-heading font-black text-lg text-white mt-1">Tanya Estimasi via WhatsApp</h3>
                            <p class="text-xs text-brand-200/80 mt-0.5">Sampaikan jenis perangkat dan keluhan Anda. Tim teknisi kami akan membalas dengan estimasi awal secepat mungkin.</p>
                        </div>

                        <div class="bg-white/10 rounded-xl p-4 border border-white/10 space-y-2.5 text-xs">
                            <div class="flex items-center gap-2 text-brand-200">
                                <i class="fa-solid fa-check-circle text-emerald-400 text-sm"></i>
                                <span>Diagnosa awal di bengkel <strong class="text-white">100% Gratis</strong></span>
                            </div>
                            <div class="flex items-center gap-2 text-brand-200">
                                <i class="fa-solid fa-check-circle text-emerald-400 text-sm"></i>
                                <span>Biaya dikonfirmasi sebelum dikerjakan</span>
                            </div>
                            <div class="flex items-center gap-2 text-brand-200">
                                <i class="fa-solid fa-check-circle text-emerald-400 text-sm"></i>
                                <span>Batal servis? <strong class="text-white">Tidak ada biaya</strong></span>
                            </div>
                            <div class="flex items-center gap-2 text-brand-200">
                                <i class="fa-solid fa-check-circle text-emerald-400 text-sm"></i>
                                <span>Garansi resmi <strong class="text-white">30–360 hari</strong></span>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl p-4 text-slate-900 shadow-md space-y-1">
                            <div class="text-[10px] font-mono font-bold text-slate-500 uppercase">Jam Konsultasi</div>
                            <div class="font-heading font-black text-lg text-brand-700">08:00 – 21:00 WIB</div>
                            <div class="text-[11px] text-slate-500">Senin – Minggu (Termasuk Hari Libur)</div>
                        </div>

                        <div class="space-y-2 pt-1">
                            <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+L-Coding+Service+Center,+saya+ingin+konsultasi+estimasi+biaya+servis+perangkat+saya." target="_blank"
                               class="w-full py-3 px-4 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white font-bold text-xs text-center transition flex items-center justify-center gap-2 shadow-lg">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Konsultasi Estimasi via WhatsApp</span>
                            </a>
                            <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+L-Coding+Service+Center,+saya+ingin+datang+langsung+untuk+diagnosa+gratis." target="_blank"
                               class="w-full py-2.5 px-4 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-xs text-center transition flex items-center justify-center gap-2">
                                <i class="fa-solid fa-store text-brand-300"></i>
                                <span>Rencanakan Kunjungan Langsung</span>
                            </a>
                        </div>

                        <p class="text-[10px] text-brand-300/80 text-center leading-relaxed">
                            *Biaya final dipastikan setelah unit diperiksa di lab di depan Anda tanpa ada paksaan pengerjaan.
                        </p>

                    </div>
                </div>

            </div>
        </section>

        {{-- SECTION 2: DAFTAR BIAYA SERVIS TERBUKA & STANDAR TARIF LAB (PERSIS FOTO) --}}
        <section id="tarif-lab" class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-slate-200/80 pb-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm shadow-xs">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h2 class="font-heading font-black text-lg sm:text-xl text-slate-900">Daftar Biaya Servis Terbuka &amp; Standar Tarif Lab</h2>
                        <p class="text-xs text-slate-500">Daftar harga transparan jasa lab Cibubur, berlaku untuk perbaikan tahun 2026. Tidak ada biaya tersembunyi.</p>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-slate-700 text-xs font-mono font-bold self-start sm:self-auto">
                    <i class="fa-solid fa-certificate text-brand-600"></i>
                    Tarif Resmi Lab 2026
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($price_categories as $pcat)
                <div class="card-hover bg-white border border-slate-200/90 rounded-2xl p-5 shadow-xs flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex items-center gap-2.5 pb-2 border-b border-slate-100">
                            <div class="w-8 h-8 rounded-lg {{ $pcat['color'] }} flex items-center justify-center text-sm">
                                <i class="{{ $pcat['icon'] }}"></i>
                            </div>
                            <h3 class="font-heading font-bold text-sm text-slate-900">{{ $pcat['title'] }}</h3>
                        </div>

                        <div class="space-y-3">
                            @foreach($pcat['items'] as $it)
                            <div class="space-y-0.5 border-b border-slate-50 pb-2 last:border-0 last:pb-0">
                                <div class="text-xs font-bold text-slate-800 flex items-start justify-between gap-2">
                                    <span>{{ $it['name'] }}</span>
                                    <span class="font-heading font-extrabold text-brand-700 shrink-0 text-right">{{ $it['price'] }}</span>
                                </div>
                                <div class="text-[10px] text-slate-400">{{ $it['sub'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-3 mt-3 border-t border-slate-100 flex items-center justify-between text-[10px]">
                        <span class="font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">{{ $pcat['garansi'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- SECTION 3: KOMITMEN TRANSPARANSI & NO FIX NO FEE (PERSIS FOTO) --}}
        <section class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-xs space-y-6">
            <div class="text-center max-w-2xl mx-auto space-y-1.5">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 text-[10px] font-mono font-black uppercase tracking-wider">
                    KEBIJAKAN MUTLAK LAYANAN SERVIS
                </span>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                    Komitmen Transparansi Biaya &amp; 'No Fix, No Fee'
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Kepercayaan Anda adalah prioritas kami. Kami menjunjung tinggi integritas penetapan harga dengan 4 pilar standar industri profesional.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($trust_pillars as $tp)
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-5 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 border border-brand-200 flex items-center justify-center text-lg mb-3 shadow-xs">
                            <i class="{{ $tp['icon'] }}"></i>
                        </div>
                        <div class="text-[10px] font-mono font-extrabold text-slate-400 uppercase">Pilar {{ $tp['step'] }}</div>
                        <h3 class="font-heading font-bold text-sm text-slate-900 mt-0.5 mb-1.5">{{ $tp['title'] }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $tp['desc'] }}</p>
                    </div>
                    <div class="pt-2 border-t border-slate-200/60">
                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded">
                            <i class="fa-solid fa-circle-check text-[9px] text-emerald-500"></i>
                            {{ $tp['badge'] }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- SECTION 4: SIKLUS TRANSAKSI DIAGNOSA (PERSIS FOTO) --}}
        <section class="bg-gradient-to-r from-blue-50/70 via-indigo-50/40 to-blue-50/70 border border-brand-200/80 rounded-2xl p-6 shadow-xs space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b border-brand-100 pb-3">
                <div>
                    <h3 class="font-heading font-black text-base text-slate-900">Siklus Transaksi Diagnosa &amp; Penetapan Tarif</h3>
                    <p class="text-xs text-slate-500">Alur pembayaran transparan tanpa kekhawatiran biaya melonjak di tengah jalan.</p>
                </div>
                <span class="text-[10px] font-mono text-brand-700 font-bold bg-white px-2.5 py-1 rounded-lg border border-brand-200">
                    SOP STANDAR ISO-9001
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs space-y-1">
                    <div class="text-[10px] font-mono font-bold text-brand-600">STEP 01</div>
                    <div class="font-heading font-bold text-xs text-slate-900">Check-in Lab &amp; Foto</div>
                    <p class="text-[11px] text-slate-500">Pencatatan keluhan, foto kondisi fisik unit, dan terbit tiket servis digital.</p>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs space-y-1">
                    <div class="text-[10px] font-mono font-bold text-brand-600">STEP 02</div>
                    <div class="font-heading font-bold text-xs text-slate-900">Pemeriksaan Komponen</div>
                    <p class="text-[11px] text-slate-500">Pengetesan motherboard di lab ESD menggunakan skema boardview &amp; thermal camera.</p>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs space-y-1">
                    <div class="text-[10px] font-mono font-bold text-brand-600">STEP 03</div>
                    <div class="font-heading font-bold text-xs text-slate-900">Client Approval</div>
                    <p class="text-[11px] text-slate-500">Penawaran rincian biaya dikirim via WA. Pengerjaan baru dimulai setelah Anda setuju.</p>
                </div>

                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs space-y-1">
                    <div class="text-[10px] font-mono font-bold text-brand-600">STEP 04</div>
                    <div class="font-heading font-bold text-xs text-slate-900">Pelunasan &amp; e-Garansi</div>
                    <p class="text-[11px] text-slate-500">Pembayaran sesuai nota estimasi tanpa tambahan apapun, invoice resmi &amp; garansi aktif.</p>
                </div>
            </div>
        </section>

        {{-- SECTION 5: FAQ SEPUTAR BIAYA SERVIS (PERSIS FOTO) --}}
        <section id="faq-biaya" class="space-y-4">
            <div class="text-center max-w-xl mx-auto space-y-1">
                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm mx-auto shadow-xs">
                    <i class="fa-solid fa-circle-question"></i>
                </div>
                <h2 class="font-heading font-black text-xl text-slate-900 tracking-tight">Pertanyaan Umum Seputar Biaya Servis</h2>
                <p class="text-xs text-slate-500">Semua jawaban terkait transparansi tarif, biaya pembatalan, dan negosiasi biaya perusahaan.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-2.5 pt-2">
                @foreach($faqs_biaya as $i => $faq)
                <details class="group bg-white border border-slate-200/80 rounded-xl shadow-xs" {{ $i === 0 ? 'open' : '' }}>
                    <summary class="flex items-center justify-between px-5 py-4 cursor-pointer select-none">
                        <div class="flex items-center gap-2.5">
                            <i class="fa-solid fa-circle-check text-emerald-500 text-xs shrink-0"></i>
                            <span class="text-xs sm:text-sm font-semibold text-slate-800">{{ $faq['q'] }}</span>
                        </div>
                        <i class="fa-solid fa-chevron-down faq-chevron text-slate-400 text-xs ml-3 shrink-0"></i>
                    </summary>
                    <div class="px-5 pb-4 pt-1">
                        <div class="pl-6 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">{{ $faq['a'] }}</div>
                    </div>
                </details>
                @endforeach
            </div>
        </section>

        {{-- SECTION 6: CTA BANNER (PERSIS FOTO) --}}
        <section class="bg-gradient-to-r from-brand-700 via-brand-600 to-indigo-700 rounded-2xl p-6 sm:p-8 text-white flex flex-col sm:flex-row items-center justify-between gap-6 shadow-xl">
            <div class="space-y-2 text-center sm:text-left">
                <span class="text-[10px] font-mono font-bold uppercase tracking-wider text-blue-200 bg-white/10 px-2.5 py-1 rounded-full">
                    KONSULTASI AWAL GRATIS
                </span>
                <h3 class="font-heading font-black text-xl sm:text-2xl text-white">
                    Siap Mengembalikan Performa Komputer Anda?
                </h3>
                <p class="text-xs sm:text-sm text-blue-100 max-w-xl">
                    Kunjungi gerai Cabang Cibubur hari ini atau konsultasikan keluhan perangkat Anda secara online bersama kepala teknisi kami.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full sm:w-auto">
                <a href="{{ route('servicecenter.booking-servis') }}" class="w-full sm:w-auto px-5 py-3 rounded-xl bg-white text-brand-700 font-bold text-xs shadow-md hover:bg-blue-50 transition text-center">
                    Booking Servis Sekarang
                </a>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+L-Coding,+saya+ingin+konsultasi+biaya+servis" target="_blank" class="w-full sm:w-auto px-5 py-3 rounded-xl bg-white/15 hover:bg-white/20 border border-white/25 text-white font-bold text-xs transition text-center flex items-center justify-center gap-2">
                    <i class="fa-brands fa-whatsapp text-emerald-300 text-sm"></i>
                    <span>Konsultasi Biaya via WA</span>
                </a>
            </div>
        </section>

    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-slate-200 text-slate-600 text-xs mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-600 text-white flex items-center justify-center shadow-xs">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div>
                        <div class="font-heading font-black text-base text-slate-900 leading-tight">L-Coding Service Center</div>
                        <div class="text-[9px] text-brand-600 font-extrabold uppercase tracking-wider">Cabang Cibubur</div>
                    </div>
                </div>
                <p class="text-xs leading-relaxed text-slate-500">
                    Pusat reparasi mikro-elektronika, diagnostik motherboard, dan retail sparepart bergaransi resmi untuk wilayah Cibubur &amp; Bekasi.
                </p>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[10px] font-bold">
                    <i class="fa-solid fa-circle-check text-emerald-500"></i>
                    100% Original Spareparts &amp; No Fix No Fee
                </div>
            </div>

            <div>
                <div class="font-heading font-bold text-slate-900 text-xs mb-3 uppercase tracking-wider">Lokasi Toko &amp; Service Center</div>
                <div class="space-y-1 text-xs text-slate-600 leading-relaxed">
                    <div class="font-bold text-slate-800">Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)</div>
                    <div>Ruko Kranggan Permai Blok RT 16 No. 27</div>
                    <div>Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.</div>
                </div>
            </div>

            <div>
                <div class="font-heading font-bold text-slate-900 text-xs mb-3 uppercase tracking-wider">Layanan &amp; Dukungan</div>
                <div class="space-y-2 text-xs text-slate-600">
                    <div class="flex items-center gap-2"><i class="fa-solid fa-phone text-brand-600 w-4"></i> Hotline: +62 812-5544-5566</div>
                    <div class="flex items-center gap-2"><i class="fa-regular fa-clock text-slate-400 w-4"></i> Senin - Minggu: 08.00 - 21.00 WIB</div>
                    <div class="flex items-center gap-2"><i class="fa-solid fa-signal text-emerald-600 w-4"></i> Sistem Sinkron: Clean-HQ Realtime</div>
                </div>
            </div>

            <div>
                <div class="font-heading font-bold text-slate-900 text-xs mb-3 uppercase tracking-wider">Akses Cepat Pengguna</div>
                <div class="space-y-2 text-xs">
                    <a href="{{ route('servicecenter.cek-tiket') }}" class="block text-slate-600 hover:text-brand-600 transition">Perangkat &amp; Garansi Saya</a>
                    <a href="{{ route('servicecenter.booking-servis') }}" class="block text-slate-600 hover:text-brand-600 transition">Kalibrasi Thermal &amp; Repaste</a>
                    <a href="{{ route('servicecenter.katalog') }}" class="block text-slate-600 hover:text-brand-600 transition">Katalog Produk &amp; Sparepart</a>
                    <a href="{{ route('servicecenter.cek-biaya') }}" class="block text-slate-600 hover:text-brand-600 transition">Cek Biaya &amp; Estimasi</a>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200/80 px-4 sm:px-8 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-2 text-[10px] text-slate-500">
            <span>&copy; {{ date('Y') }} L-Coding Hardware Service Center Cabang Cibubur. Hak cipta dilindungi undang-undang.</span>
            <span class="font-mono text-slate-400">Node &amp; Sync ID: JKT-CLN-RO-00 &bull; Kebijakan Privasi &bull; Syarat Layanan</span>
        </div>
    </footer>

    <script>
        // Drawer Toggle
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
