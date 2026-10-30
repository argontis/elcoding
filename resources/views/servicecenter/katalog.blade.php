<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Hardware &amp; Sparepart OEM Terverifikasi — {{ $center['name'] }}</title>
    <meta name="description" content="Katalog suku cadang original OEM, upgrade kit komponen mikro, dan perlengkapan servis presisi bergaransi di TechFix Pro Service Center Cabang Clean.">

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
                <a href="{{ route('servicecenter.booking-servis') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-calendar-check text-amber-500 w-4 text-center"></i>
                    <span>Booking Servis</span>
                </a>
                <a href="{{ route('servicecenter.katalog') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-brand-600 text-white">
                    <i class="fa-solid fa-laptop-medical w-4 text-center"></i>
                    <span>Katalog Produk &amp; Sparepart</span>
                </a>
                <a href="{{ route('servicecenter.cek-biaya') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-tag text-emerald-500 w-4 text-center"></i>
                    <span>Cek Biaya &amp; Estimasi</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-slate-100">
            <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro,+saya+ingin+cek+ketersediaan+sparepart" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                Tanya Stok via WhatsApp
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
                    <div class="font-heading font-black text-base lg:text-lg text-slate-900 tracking-tight leading-none group-hover:text-brand-600 transition-colors whitespace-nowrap">TechFix Pro Service Center</div>
                    <div class="text-[9px] font-extrabold tracking-widest text-brand-600 uppercase mt-0.5 whitespace-nowrap">{{ $center['branch'] }}</div>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs xl:text-sm font-semibold text-slate-600 shrink-0 whitespace-nowrap">
                <a href="{{ url('/ServiceCenter') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Beranda</a>
                <a href="{{ route('servicecenter.cek-tiket') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Cek Tiket Servis</a>
                <a href="{{ route('servicecenter.booking-servis') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">Booking Servis</a>
                <a href="{{ route('servicecenter.katalog') }}" class="bg-brand-600 text-white px-4 py-2 rounded-xl font-bold shadow-xs whitespace-nowrap">Katalog Produk &amp; Sparepart</a>
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

    {{-- HERO HEADER KATALOG HARDWARE --}}
    <section class="bg-gradient-to-b from-blue-50/70 via-indigo-50/30 to-white pt-8 pb-6 px-4 sm:px-8 border-b border-slate-200/70">
        <div class="max-w-7xl mx-auto space-y-6">

            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                <div class="space-y-2 max-w-3xl">
                    <div class="text-[10px] font-mono font-extrabold uppercase tracking-wider text-brand-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-layer-group text-brand-500"></i>
                        AUTHORIZED COMPONENT REPOSITORY
                    </div>
                    <h1 class="font-heading font-black text-2xl sm:text-3xl lg:text-4xl text-slate-900 tracking-tight leading-tight">
                        Katalog Hardware &amp; Sparepart OEM Terverifikasi
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-2xl">
                        Suku cadang original, upgrade kit komponen mikro, dan perlengkapan servis presisi dengan jaminan kompatibilitas 100% serta garansi pergantian unit di TechFix Pro Cabang Clean.
                    </p>
                </div>

                {{-- Depot Info Card (Persis Foto) --}}
                <div class="shrink-0 bg-white border border-slate-200/90 rounded-2xl p-4 shadow-xs flex items-center gap-3.5 max-w-xs">
                    <div class="w-11 h-11 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center text-lg shrink-0">
                        <i class="fa-solid fa-warehouse"></i>
                    </div>
                    <div>
                        <div class="font-heading font-bold text-xs text-slate-900 leading-tight">{{ $center['depot_nama'] }}</div>
                        <div class="text-[11px] font-semibold text-emerald-600 mt-0.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-check text-[10px]"></i>
                            <span>{{ $center['depot_persen'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3 Feature Badges Bar (Persis Foto) --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                <div class="bg-white border border-slate-200/80 rounded-xl px-4 py-3 flex items-center gap-3 shadow-2xs">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-brand-600 flex items-center justify-center text-sm shrink-0">
                        <i class="fa-solid fa-cash-register"></i>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800">Sinkronisasi POS Kasir</div>
                        <div class="text-[10px] text-slate-500">Update kuota inventaris setiap 60 detik</div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/80 rounded-xl px-4 py-3 flex items-center gap-3 shadow-2xs">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm shrink-0">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800">Garansi Tukar Baru</div>
                        <div class="text-[10px] text-slate-500">Jaminan proteksi 90 hari hingga 5 tahun</div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200/80 rounded-xl px-4 py-3 flex items-center gap-3 shadow-2xs">
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm shrink-0">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800">Instalasi Bench-Test</div>
                        <div class="text-[10px] text-slate-500">Opsi pasang di bengkel 15–30 menit langsung</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- MAIN CONTENT AREA --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        {{-- BANNER VERIFIKASI KOMPATIBILITAS (Persis Foto) --}}
        <div class="bg-gradient-to-r from-blue-50/90 via-indigo-50/80 to-blue-50/90 border border-brand-200/70 rounded-2xl p-5 shadow-xs">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="space-y-1">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-brand-600 text-white font-mono text-[9px] font-black uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                        AUTO-DIAGNOSTIC MATRIX
                    </div>
                    <h2 class="font-heading font-black text-base text-slate-900">Verifikasi Kompatibilitas Perangkat</h2>
                    <p class="text-xs text-slate-600">Masukkan nomor model motherboard, part number, atau SKU laptop untuk validasi pinout tegangan dan form factor secara akurat.</p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 max-w-md w-full">
                    <div class="relative flex-1">
                        <input type="text" id="inputCompat" placeholder="Contoh: Legion 5-15ACH6H, A2338, atau ASUS ROG..." class="w-full text-xs border border-slate-300 rounded-xl px-3 py-2.5 pl-8 bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                        <i class="fa-solid fa-magnifying-glass absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    </div>
                    <button type="button" onclick="checkCompatibility()" class="px-4 py-2.5 bg-brand-700 hover:bg-brand-800 text-white font-bold text-xs rounded-xl shadow-xs transition flex items-center justify-center gap-1.5 shrink-0">
                        <i class="fa-solid fa-chart-simple text-xs"></i>
                        <span>Analisis Kompatibilitas</span>
                    </button>
                </div>
            </div>
            <div id="compatAlert" class="hidden mt-3 p-3 bg-white border border-brand-200 rounded-xl text-xs text-brand-800"></div>
        </div>

        {{-- SEARCH & FILTER BAR --}}
        <div class="space-y-3">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="relative flex-1 max-w-xl">
                    <input type="text" id="searchKatalog" onkeyup="filterProducts()" placeholder="Cari nama sparepart, SKU part, SSD NVMe, RAM DDR4, LCD 144Hz, thermal paste..." class="w-full text-xs sm:text-sm border border-slate-200 rounded-xl px-3.5 py-2.5 pl-9 bg-white focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 shadow-2xs">
                    <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
                <div class="flex items-center gap-2 self-end sm:self-auto text-xs font-semibold text-slate-600">
                    <span class="text-slate-400 text-[11px] font-mono">URUTKAN:</span>
                    <select onchange="sortProducts(this.value)" class="text-xs font-bold border border-slate-200 rounded-xl px-3 py-2 bg-white text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-500">
                        <option value="populer">Terpopuler &amp; Rekomendasi</option>
                        <option value="termurah">Harga: Terendah ke Tertinggi</option>
                        <option value="termahal">Harga: Tertinggi ke Terendah</option>
                        <option value="stok">Stok Terbanyak</option>
                    </select>
                </div>
            </div>

            {{-- Category Filter Pills (Persis Foto) --}}
            <div class="flex flex-wrap items-center gap-1.5 overflow-x-auto pb-1">
                @foreach($categories as $cat)
                <button type="button" onclick="selectCategory('{{ $cat['id'] }}', this)" class="cat-pill px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $cat['id'] === 'all' ? 'bg-brand-600 text-white shadow-xs' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    <span>{{ $cat['name'] }}</span>
                    <span class="text-[10px] opacity-80 font-mono">({{ $cat['count'] }})</span>
                </button>
                @endforeach
            </div>

            {{-- Brand Compatibility Pills & Checkbox --}}
            <div class="flex flex-wrap items-center justify-between gap-2 pt-1 border-t border-slate-200/60 text-xs">
                <div class="flex flex-wrap items-center gap-1.5">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 mr-1">BRAND KOMPATIBEL:</span>
                    @foreach($brands as $brand)
                    <button type="button" onclick="selectBrand('{{ $brand }}', this)" class="brand-pill px-2.5 py-1 rounded-lg text-[11px] font-medium bg-white border border-slate-200 hover:border-brand-400 text-slate-600 transition">
                        {{ $brand }}
                    </button>
                    @endforeach
                </div>
                <div class="flex items-center gap-3 text-[11px] text-slate-600">
                    <label class="flex items-center gap-1.5 cursor-pointer select-none">
                        <input type="checkbox" checked class="rounded text-brand-600 w-3.5 h-3.5">
                        <span class="font-semibold text-slate-700">Hanya Ready di Toko Clean</span>
                    </label>
                    <span class="text-slate-300">|</span>
                    <span class="font-semibold text-slate-500" id="countDisplay">Menampilkan {{ count($products) }} Komponen</span>
                </div>
            </div>
        </div>

        {{-- PRODUCTS 8-GRID (PERSIS FOTO: 4x2 GRID) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="productsGrid">
            @foreach($products as $prod)
            <div class="prod-card card-hover bg-white border border-slate-200/90 rounded-2xl shadow-xs overflow-hidden flex flex-col justify-between"
                 data-category="{{ $prod['category'] }}"
                 data-name="{{ strtolower($prod['name']) }}"
                 data-sku="{{ strtolower($prod['sku']) }}"
                 data-brand="{{ strtolower($prod['brand']) }}">

                <div>
                    {{-- TOP BADGES BAR --}}
                    <div class="p-3 pb-0 flex items-center justify-between text-[10px] font-bold">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200/70">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            {{ $prod['stock'] }}
                        </span>
                        <span class="inline-flex items-center px-2 py-0.5 rounded {{ $prod['warranty_bg'] }} font-extrabold uppercase tracking-wider text-[9px]">
                            {{ $prod['warranty'] }}
                        </span>
                    </div>

                    {{-- IMAGE CONTAINER --}}
                    <div class="p-3">
                        <div class="w-full h-36 rounded-xl bg-slate-100 overflow-hidden relative group">
                            <img src="{{ $prod['img'] }}" alt="{{ $prod['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-2.5">
                                <span class="text-[10px] font-bold text-white bg-slate-900/70 backdrop-blur-xs px-2 py-0.5 rounded">OEM Grade A+</span>
                            </div>
                        </div>
                    </div>

                    {{-- SKU & TAG ROW --}}
                    <div class="px-3 flex items-center justify-between text-[10px] font-mono text-slate-400">
                        <span>{{ $prod['sku'] }}</span>
                        <span class="font-sans font-bold text-teal-600 bg-teal-50 px-1.5 py-0.5 rounded text-[9px]">{{ $prod['tag'] }}</span>
                    </div>

                    {{-- TITLE & DESC --}}
                    <div class="p-3 pt-1 space-y-1.5">
                        <h3 class="font-heading font-black text-xs text-slate-900 leading-snug hover:text-brand-600 transition">
                            {{ $prod['name'] }}
                        </h3>
                        <p class="text-[11px] text-slate-500 leading-relaxed line-clamp-2">
                            {{ $prod['desc'] }}
                        </p>

                        {{-- SPECS DETAIL BOX --}}
                        <div class="bg-slate-50 rounded-xl p-2 border border-slate-100 text-[10px] space-y-0.5 font-mono">
                            @foreach($prod['specs'] as $k => $v)
                            <div class="flex items-center justify-between text-slate-600">
                                <span class="text-slate-400">{{ $k }}:</span>
                                <span class="font-bold text-slate-800 text-right">{{ $v }}</span>
                            </div>
                            @endforeach
                        </div>

                        {{-- ADDON CHECKBOX JASA PASANG --}}
                        <div class="pt-1">
                            <label class="flex items-start gap-1.5 p-1.5 rounded-lg border border-slate-200/80 bg-blue-50/40 hover:bg-blue-50 transition cursor-pointer select-none">
                                <input type="checkbox" class="rounded text-brand-600 w-3 h-3 mt-0.5">
                                <div class="text-[10px] leading-tight">
                                    <div class="font-bold text-slate-800">{{ $prod['addon_label'] }}</div>
                                    <div class="text-[9px] text-brand-700 font-semibold">{{ $prod['addon_price'] }}</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- PRICE & ACTION BUTTONS --}}
                <div class="p-3 pt-0 border-t border-slate-100 mt-2 space-y-2">
                    <div class="pt-2 flex items-baseline justify-between">
                        <span class="text-[10px] text-slate-400 font-semibold">Harga Komponen:</span>
                        <span class="font-heading font-black text-sm text-slate-900">{{ $prod['price'] }}</span>
                    </div>

                    <div class="grid grid-cols-2 gap-1.5">
                        <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro,+saya+ingin+beli+{{ urlencode($prod['name']) }}+({{ urlencode($prod['sku']) }})" target="_blank" class="py-2 px-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-[11px] text-center transition flex items-center justify-center gap-1 shadow-xs">
                            <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                            <span>Ambil / Beli</span>
                        </a>
                        <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo+TechFix+Pro,+apakah+stok+{{ urlencode($prod['name']) }}+ready+hari+ini?" target="_blank" class="py-2 px-2 rounded-xl border border-slate-200 hover:border-emerald-400 hover:bg-emerald-50 text-slate-700 font-bold text-[11px] text-center transition flex items-center justify-center gap-1">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-xs"></i>
                            <span>Tanya WA</span>
                        </a>
                    </div>
                </div>

            </div>
            @endforeach
        </div>

        {{-- PROTOKOL WORKSHOP CABANG CLEAN (Persis Foto) --}}
        <section class="bg-white border border-slate-200/90 rounded-2xl p-6 sm:p-8 shadow-xs space-y-6">
            <div class="text-center max-w-2xl mx-auto space-y-1.5">
                <div class="text-[10px] font-mono font-extrabold uppercase tracking-wider text-brand-600">
                    PROTOKOL WORKSHOP CABANG CLEAN
                </div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight">
                    Pemasangan Langsung di Meja Servis
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Hindari resiko salah pasang atau kerusakan jalur PCB. Beli komponen secara online atau langsung di gerai, lalu saksikan proses perakitan oleh tim teknisi kami secara transparan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($workshop_steps as $ws)
                <div class="bg-slate-50/70 border border-slate-200/80 rounded-2xl p-5 space-y-3 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-9 h-9 rounded-xl bg-brand-600 text-white font-heading font-black text-sm flex items-center justify-center shadow-xs">
                                {{ $ws['step'] }}
                            </div>
                            <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 text-slate-500 flex items-center justify-center text-xs">
                                <i class="{{ $ws['icon'] }}"></i>
                            </div>
                        </div>
                        <h3 class="font-heading font-bold text-sm text-slate-900 mb-1.5">{{ $ws['title'] }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">{{ $ws['desc'] }}</p>
                    </div>
                    <div class="pt-2 border-t border-slate-200/60">
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-brand-700 bg-brand-50 border border-brand-200/60 px-2.5 py-1 rounded-lg">
                            <i class="fa-solid fa-circle-check text-[9px] text-brand-500"></i>
                            {{ $ws['badge'] }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- BOTTOM ACTION BANNER (Persis Foto) --}}
            <div class="bg-gradient-to-r from-blue-50/80 via-indigo-50/70 to-blue-50/80 border border-brand-200 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shrink-0"></div>
                    <div>
                        <div class="font-heading font-black text-sm text-slate-900">Meja Servis Siap Pakai: 3 dari 4 Meja Kosong</div>
                        <div class="text-xs text-slate-500 mt-0.5">Kunjungi bengkel tanpa reservasi antrean untuk pemasangan langsung di depan Anda.</div>
                    </div>
                </div>
                <a href="{{ route('servicecenter.booking-servis') }}" class="shrink-0 px-6 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs shadow-md shadow-brand-600/20 transition flex items-center gap-2">
                    <i class="fa-solid fa-calendar-check text-xs"></i>
                    <span>Reservasi Meja Servis</span>
                </a>
            </div>
        </section>

    </main>

    {{-- FOOTER (PERSIS FOTO) --}}
    <footer class="bg-white border-t border-slate-200 text-slate-600 text-xs mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-brand-600 text-white flex items-center justify-center shadow-xs">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div>
                        <div class="font-heading font-black text-base text-slate-900 leading-tight">TechFix Pro Service Center</div>
                        <div class="text-[9px] text-brand-600 font-extrabold uppercase tracking-wider">Cabang Cibubur</div>
                    </div>
                </div>
                <p class="text-xs leading-relaxed text-slate-500">
                    Pusat reparasi mikro-elektronika, diagnostik motherboard, dan retail sparepart bergaransi resmi untuk wilayah Cibubur &amp; Bekasi.
                </p>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-[10px] font-bold">
                    <i class="fa-solid fa-circle-check text-emerald-500"></i>
                    100% Original Spareparts &amp; PO Real Quota
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
                    <a href="{{ route('servicecenter.cek-tiket') }}" class="block text-slate-600 hover:text-brand-600 transition">Status Klaim Garansi</a>
                    <a href="{{ url('/ServiceCenter') }}" class="block text-slate-600 hover:text-brand-600 transition">API Telemetri Bengkel</a>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200/80 px-4 sm:px-8 py-3.5 flex flex-col sm:flex-row items-center justify-between gap-2 text-[10px] text-slate-500">
            <span>&copy; {{ date('Y') }} TechFix Pro Hardware Service Center Cabang Clean. Hak cipta dilindungi undang-undang.</span>
            <span class="font-mono text-slate-400">Node &amp; Sync ID: JKT-CLN-RO-00 &bull; Kebijakan Privasi &bull; Syarat Layanan</span>
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

        // Filter by Category
        let currentCategory = 'all';
        function selectCategory(catId, btn) {
            currentCategory = catId;
            document.querySelectorAll('.cat-pill').forEach(b => {
                b.className = 'cat-pill px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50';
            });
            btn.className = 'cat-pill px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 bg-brand-600 text-white shadow-xs';
            filterProducts();
        }

        // Filter by Brand
        let currentBrand = '';
        function selectBrand(brand, btn) {
            if (currentBrand === brand) {
                currentBrand = '';
                btn.className = 'brand-pill px-2.5 py-1 rounded-lg text-[11px] font-medium bg-white border border-slate-200 hover:border-brand-400 text-slate-600 transition';
            } else {
                document.querySelectorAll('.brand-pill').forEach(b => {
                    b.className = 'brand-pill px-2.5 py-1 rounded-lg text-[11px] font-medium bg-white border border-slate-200 hover:border-brand-400 text-slate-600 transition';
                });
                currentBrand = brand;
                btn.className = 'brand-pill px-2.5 py-1 rounded-lg text-[11px] font-bold bg-brand-50 border border-brand-400 text-brand-700 transition';
            }
            filterProducts();
        }

        // Search & Filter execution
        function filterProducts() {
            const query = (document.getElementById('searchKatalog').value || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.prod-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const cat = card.getAttribute('data-category');
                const name = card.getAttribute('data-name');
                const sku = card.getAttribute('data-sku');
                const brand = card.getAttribute('data-brand');

                const matchesCat = currentCategory === 'all' || cat === currentCategory;
                const matchesBrand = !currentBrand || brand.includes(currentBrand.toLowerCase());
                const matchesQuery = !query || name.includes(query) || sku.includes(query);

                if (matchesCat && matchesBrand && matchesQuery) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('countDisplay').textContent = 'Menampilkan ' + visibleCount + ' Komponen';
        }

        // Sort products
        function sortProducts(criteria) {
            const grid = document.getElementById('productsGrid');
            const cards = Array.from(grid.querySelectorAll('.prod-card'));

            cards.sort((a, b) => {
                if (criteria === 'termurah' || criteria === 'termahal') {
                    const priceA = parseInt(a.querySelector('.font-black.text-sm').textContent.replace(/[^0-9]/g, '')) || 0;
                    const priceB = parseInt(b.querySelector('.font-black.text-sm').textContent.replace(/[^0-9]/g, '')) || 0;
                    return criteria === 'termurah' ? priceA - priceB : priceB - priceA;
                }
                return 0;
            });

            cards.forEach(card => grid.appendChild(card));
        }

        // Compatibility analysis tester
        function checkCompatibility() {
            const input = document.getElementById('inputCompat').value.trim();
            const alertBox = document.getElementById('compatAlert');
            if (!input) {
                alert('Silakan masukkan nomor model atau tipe laptop Anda.');
                return;
            }
            alertBox.classList.remove('hidden');
            alertBox.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1.5"></i> Menganalisis database suku cadang untuk <strong>' + input + '</strong>...';

            setTimeout(() => {
                alertBox.innerHTML = '<div class="flex items-start gap-2.5"><i class="fa-solid fa-circle-check text-emerald-600 text-sm mt-0.5"></i><div><strong>Hasil Analisis Kompatibilitas (' + input + '):</strong><br><span class="text-slate-600">Model teridentifikasi! Kompatibel dengan slot M.2 NVMe PCIe 4.0, RAM DDR5 SODIMM, dan pasta phase-change Honeywell PTM7950. Stok komponen tersedia siap pasang hari ini di Meja Servis Cabang Clean.</span></div></div>';
            }, 700);
        }
    </script>
</body>
</html>
