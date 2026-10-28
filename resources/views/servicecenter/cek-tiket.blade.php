<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Tiket Servis — {{ $center['name'] }}</title>
    <meta name="description" content="Pusat informasi tiket servis L-Coding Service Center Cabang Clean. Pelajari cara lacak tiket, status pengerjaan, produk tersedia, dan FAQ layanan.">

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
                        <div class="font-heading font-extrabold text-sm text-slate-900 leading-tight">L-Coding</div>
                        <div class="text-[9px] font-extrabold text-brand-600 uppercase tracking-wider">Service Center</div>
                    </div>
                </div>
                <button onclick="toggleMobileDrawer()" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>
            <nav class="mt-2 flex flex-col space-y-1 p-3">
                <a href="{{ url('/ServiceCenter') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50">
                    <i class="fa-solid fa-house text-slate-400 w-4 text-center"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('servicecenter.cek-tiket') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-brand-600 text-white">
                    <i class="fa-solid fa-magnifying-glass w-4 text-center"></i>
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
                <a href="{{ route('servicecenter.cek-biaya') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50">
                    <i class="fa-solid fa-tag text-emerald-500 w-4 text-center"></i>
                    <span>Cek Biaya &amp; Estimasi</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-slate-100">
            <a href="https://wa.me/{{ $center['no_whatsapp'] }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                Hubungi via WhatsApp
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
                <a href="{{ route('servicecenter.cek-tiket') }}" class="bg-brand-600 text-white px-3.5 py-2 rounded-xl font-bold shadow-xs whitespace-nowrap">Cek Tiket Servis</a>
                <a href="{{ route('servicecenter.booking-servis') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Booking Servis</a>
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

    {{-- HERO --}}
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
                <span class="text-white">Cek Tiket Servis</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs font-bold uppercase tracking-wider text-blue-100">
                        <i class="fa-solid fa-circle-info text-blue-200"></i>
                        Pusat Informasi Tiket &amp; Toko Komputer
                    </div>
                    <h1 class="font-heading font-black text-3xl sm:text-4xl lg:text-5xl leading-[1.15] tracking-tight">
                        Info Lengkap<br><span class="text-blue-200">Cek Tiket Servis</span>
                    </h1>
                    <p class="text-blue-100 text-sm sm:text-base leading-relaxed max-w-lg">
                        Panduan lengkap cara memantau tiket servis, legenda status, katalog produk &amp; sparepart toko, serta kontak dan FAQ layanan L-Coding Service Center Cabang Clean.
                    </p>
                    <div class="flex flex-wrap gap-3 pt-2">
                        <a href="{{ url('/ServiceCenter') }}#lacak-tiket" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-brand-700 text-sm font-bold shadow-lg hover:bg-blue-50 transition">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Lacak Tiket Sekarang
                        </a>
                        <a href="https://wa.me/{{ $center['no_whatsapp'] }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 border border-white/25 text-white text-sm font-bold hover:bg-white/20 transition">
                            <i class="fa-brands fa-whatsapp text-emerald-300"></i>
                            Tanya via WA
                        </a>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">{{ $center['unit_aktif'] }}+</div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Unit Sedang Dikerjakan</div>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">{{ $center['total_review'] }}</div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Review Puas Pelanggan</div>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">{{ $center['rating'] }}</div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Rating Layanan</div>
                    </div>
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-4 backdrop-blur-sm">
                        <div class="text-2xl font-heading font-black text-white">360<span class="text-lg">h</span></div>
                        <div class="text-xs text-blue-200 font-semibold mt-0.5">Garansi Resmi Tertinggi</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10 space-y-14">

        {{-- SECTION 1: CARA CEK TIKET --}}
        <section id="cara-cek">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-100 text-xs font-bold uppercase tracking-wider text-brand-700 mb-3">
                    <i class="fa-solid fa-list-ol text-brand-500"></i> Panduan Penggunaan
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">Cara Cek Tiket Servis</h2>
                <p class="text-slate-500 text-sm mt-2 max-w-xl mx-auto">Ikuti 4 langkah mudah berikut untuk memantau status pengerjaan unit Anda dari mana saja.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($cara_cek as $step)
                <div class="card-hover bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs relative">
                    <div class="w-10 h-10 rounded-xl {{ $step['color'] }} border flex items-center justify-center text-lg mb-4 shadow-xs">
                        <i class="{{ $step['icon'] }}"></i>
                    </div>
                    <div class="absolute top-4 right-4 font-heading font-black text-3xl text-slate-100 select-none">{{ $step['step'] }}</div>
                    <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">Langkah {{ $step['step'] }}</div>
                    <h3 class="font-heading font-bold text-sm text-slate-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ url('/ServiceCenter') }}#lacak-tiket" class="inline-flex items-center gap-2.5 px-6 py-3 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-sm font-bold shadow-md shadow-brand-600/20 transition">
                    <i class="fa-solid fa-magnifying-glass"></i> Buka Pelacak Tiket Servis
                </a>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+L-Coding,+saya+ingin+cek+status+servis+unit+saya" target="_blank" class="inline-flex items-center gap-2.5 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold transition">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Langsung via WhatsApp
                </a>
            </div>
        </section>

        {{-- SECTION 2: LEGENDA STATUS TIKET --}}
        <section id="status-tiket">
            <div class="bg-white border border-slate-200/60 rounded-2xl shadow-xs overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-7 h-7 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center">
                                <i class="fa-solid fa-traffic-light text-xs"></i>
                            </div>
                            <h2 class="font-heading font-bold text-base text-slate-900">Legenda Status Tiket Servis</h2>
                        </div>
                        <p class="text-xs text-slate-500">Setiap tiket memiliki status yang diperbarui otomatis oleh teknisi saat progres berubah.</p>
                    </div>
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-xs font-bold text-emerald-700">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Diperbarui Real-Time
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($status_list as $status)
                    <div class="px-5 py-4 flex items-start gap-3 border-b border-slate-100 last:border-b-0 lg:border-r lg:last:border-r-0 even:lg:border-r-0">
                        <div class="w-9 h-9 rounded-xl {{ $status['color'] }} flex items-center justify-center text-sm shrink-0 mt-0.5">
                            <i class="{{ $status['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800 mb-0.5">{{ $status['label'] }}</div>
                            <div class="text-[11px] text-slate-500 leading-relaxed">{{ $status['desc'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="px-6 py-3 bg-blue-50 border-t border-blue-100 flex items-start gap-2">
                    <i class="fa-solid fa-circle-info text-brand-500 text-xs mt-0.5"></i>
                    <p class="text-[11px] text-slate-600">Anda akan menerima notifikasi otomatis via <strong>WhatsApp</strong> setiap kali status tiket berubah. Tidak perlu terus-menerus memantau halaman ini.</p>
                </div>
            </div>
        </section>

        {{-- SECTION 3: KATALOG PRODUK TOKO --}}
        <section id="katalog-produk">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-xs font-bold uppercase tracking-wider text-indigo-700 mb-3">
                    <i class="fa-solid fa-store text-indigo-500"></i> Toko Komputer &amp; Sparepart
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">Produk Unggulan Toko Kami</h2>
                <p class="text-slate-500 text-sm mt-2 max-w-xl mx-auto">L-Coding Service Center juga merupakan toko komputer &amp; sparepart terlengkap di Cabang Clean. Semua produk original &amp; bergaransi resmi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($produk_toko as $produk)
                <div class="card-hover bg-white border border-slate-200/80 rounded-2xl shadow-xs overflow-hidden">
                    <div class="p-4 bg-gradient-to-r {{ $produk['color'] }} text-white">
                        <div class="w-9 h-9 rounded-xl bg-white/15 flex items-center justify-center mb-3">
                            <i class="{{ $produk['icon'] }} text-base"></i>
                        </div>
                        <div class="font-heading font-bold text-sm leading-tight">{{ $produk['kategori'] }}</div>
                    </div>
                    <div class="p-4 space-y-2">
                        @foreach($produk['items'] as $item)
                        <div class="flex items-center gap-2 text-xs text-slate-700">
                            <i class="fa-solid fa-check text-emerald-500 text-[10px] shrink-0"></i>
                            <span>{{ $item }}</span>
                        </div>
                        @endforeach
                        <div class="pt-2">
                            <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo,+saya+ingin+cek+stok+{{ urlencode($produk['kategori']) }}" target="_blank" class="inline-flex items-center gap-1.5 text-[11px] font-bold text-brand-600 hover:underline">
                                <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                                Tanya Ketersediaan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-6 bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-brand-600 text-white flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div>
                        <div class="font-heading font-bold text-base text-white">Butuh Suku Cadang atau Komponen Khusus?</div>
                        <div class="text-xs text-slate-400 mt-0.5">Kami dapat membantu pengadaan spesifik. Hubungi tim kami untuk pengecekan stok dan harga terbaik.</div>
                    </div>
                </div>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+L-Coding,+saya+butuh+suku+cadang+khusus" target="_blank" class="shrink-0 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-white text-sm font-bold transition">
                    <i class="fa-brands fa-whatsapp"></i> Tanya Stok Sekarang
                </a>
            </div>
        </section>

        {{-- SECTION 4: INFO TOKO & KONTAK --}}
        <section id="info-toko">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

                <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-5 sm:p-6 shadow-xs">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <h2 class="font-heading font-bold text-base text-slate-900">Informasi Toko &amp; Kontak</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Alamat Toko</div>
                                    <div class="text-xs text-slate-700 leading-relaxed">{{ $center['alamat'] }}</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Jam Operasional</div>
                                    <div class="text-xs text-slate-700 font-semibold">{{ $center['jam_buka'] }}</div>
                                    <div class="text-[10px] text-slate-400">Senin – Sabtu (Minggu: 10:00 – 17:00 WIB)</div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">WhatsApp CS</div>
                                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}" target="_blank" class="text-xs font-bold text-emerald-600 hover:underline">+62 811-9234-5555</a>
                                    <div class="text-[10px] text-slate-400">Respon cepat &lt; 5 menit</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Telepon Toko</div>
                                    <div class="text-xs font-bold text-slate-700">{{ $center['no_telepon'] }}</div>
                                    <div class="text-[10px] text-slate-400">Jam kerja operasional</div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-0.5">Email</div>
                                    <div class="text-xs font-bold text-slate-700">{{ $center['email'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-xs space-y-3">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <h2 class="font-heading font-bold text-base text-slate-900">Akses Cepat</h2>
                    </div>

                    <a href="{{ url('/ServiceCenter') }}#lacak-tiket" class="flex items-center gap-3 p-3 rounded-xl bg-brand-50 border border-brand-100 hover:border-brand-300 transition group">
                        <div class="w-9 h-9 rounded-lg bg-brand-600 text-white flex items-center justify-center text-sm shrink-0">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-800">Lacak Tiket Sekarang</div>
                            <div class="text-[10px] text-slate-500">Pantau status real-time</div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>

                    <a href="{{ route('servicecenter.booking-servis') }}" class="flex items-center gap-3 p-3 rounded-xl bg-amber-50 border border-amber-100 hover:border-amber-300 transition group">
                        <div class="w-9 h-9 rounded-lg bg-amber-500 text-white flex items-center justify-center text-sm shrink-0">
                            <i class="fa-solid fa-calendar-plus"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-800">Booking Servis Baru</div>
                            <div class="text-[10px] text-slate-500">Daftar antrian online</div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>

                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-emerald-50 border border-emerald-100 hover:border-emerald-300 transition group">
                        <div class="w-9 h-9 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-sm shrink-0">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-800">Konsultasi via WhatsApp</div>
                            <div class="text-[10px] text-slate-500">Respon &lt; 5 menit</div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>

                    <a href="{{ url('/techfix/dashboard') }}" class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200 hover:border-slate-300 transition group">
                        <div class="w-9 h-9 rounded-lg bg-slate-800 text-white flex items-center justify-center text-sm shrink-0">
                            <i class="fa-solid fa-shield-halved text-brand-400"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-bold text-slate-800">Portal Tim Teknisi</div>
                            <div class="text-[10px] text-slate-500">Masuk dashboard internal</div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                </div>
            </div>
        </section>

        {{-- SECTION 5: FAQ --}}
        <section id="faq">
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-violet-50 border border-violet-100 text-xs font-bold uppercase tracking-wider text-violet-700 mb-3">
                    <i class="fa-solid fa-circle-question text-violet-500"></i> FAQ
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">Pertanyaan yang Sering Ditanyakan</h2>
                <p class="text-slate-500 text-sm mt-2 max-w-xl mx-auto">Tentang sistem tiket, keamanan data, notifikasi, dan cara kerja layanan servis kami.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-3">
                @foreach($faqs as $i => $faq)
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
                <p class="text-sm text-slate-500 mb-3">Masih punya pertanyaan lain?</p>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+L-Coding,+saya+ingin+bertanya" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-md shadow-emerald-600/20 transition">
                    <i class="fa-brands fa-whatsapp text-base"></i>
                    Hubungi Tim CS via WhatsApp
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
                        <div class="font-heading font-black text-sm text-white">L-Coding Service Center</div>
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
            <span>&copy; {{ date('Y') }} L-Coding Service Center. All rights reserved.</span>
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
