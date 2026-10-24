<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi Menu Digital &amp; Harga — {{ $restaurant['name'] }}</title>
    <meta name="description" content="Pusat informasi resmi menu hidangan artisanal, komposisi bahan baku, nilai gizi, dan panduan harga L-Coding Bistro Cabang Clean.">

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bistro: {
                            50: '#fdf6f3',
                            100: '#fbece5',
                            200: '#f6d8cb',
                            300: '#efbba6',
                            400: '#e59577',
                            500: '#d7704e',
                            600: '#c2410c',
                            700: '#b84221',
                            800: '#9a3412',
                            900: '#7c2d12',
                            950: '#431407',
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['"Outfit"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#faf8f5] text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-amber-100 selection:text-bistro-900">

    <!-- ===================================================================
         1. TOP ANNOUNCEMENT BAR (Sesuai Gaya Restoran)
         =================================================================== -->
    <div class="bg-[#3e1708] text-white text-[11px] sm:text-xs py-2 px-4 border-b border-amber-950/40 font-medium">
        <div class="max-w-7xl mx-auto flex items-center justify-center sm:justify-start gap-2">
            <span class="text-amber-400">🎉</span>
            <span class="tracking-wide">
                <strong>Promo Opening Clean Branch:</strong> Diskon 20% Dine-In &amp; Free Welcome Artisanal Brew! &bull; Jam Buka Hari Ini: 09.00 - 22.30 WIB
            </span>
        </div>
    </div>

    <!-- ===================================================================
         2. HEADER & NAVBAR (Menu Digital & Order Active Pill)
         =================================================================== -->
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-40 border-b border-stone-200 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4">
            
            <!-- Logo & Branch Status -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/restaurant') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-[#b84221] text-white flex items-center justify-center shadow-xs group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-utensils text-sm"></i>
                    </div>
                    <div>
                        <div class="font-heading font-extrabold text-base text-slate-900 leading-none">
                            L-Coding Bistro
                        </div>
                        <div class="flex items-center gap-1.5 mt-1">
                            <span class="inline-flex items-center gap-1 text-[9px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                {{ $restaurant['active_table']['status'] }}
                            </span>
                            <span class="hidden sm:inline-block text-[10px] text-slate-400">&bull; Local Node : BISTRO-CLEAN</span>
                        </div>
                    </div>
                </a>
                
                <div class="hidden xl:flex items-center gap-1.5 pl-3 border-l border-stone-200 text-xs">
                    <span class="font-bold text-slate-700">{{ $restaurant['branch'] }}</span>
                    <span class="text-[10px] bg-stone-100 text-slate-600 px-1.5 py-0.5 rounded border border-stone-200 font-semibold">Dine-in</span>
                    <span class="text-[10px] bg-amber-50 text-amber-800 px-1.5 py-0.5 rounded border border-amber-200 font-bold">{{ $restaurant['active_table']['number'] }}</span>
                </div>
            </div>

            <!-- Desktop Nav Links (Menu Digital & Order: Active Solid Terracotta Pill) -->
            <nav class="hidden lg:flex items-center gap-1.5 text-xs xl:text-sm font-semibold text-slate-600">
                <a href="{{ url('/restaurant') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Beranda
                </a>
                <a href="{{ route('resto.menu') }}" class="bg-[#b84221] text-white px-4 py-2 rounded-xl font-bold shadow-xs flex items-center gap-1">
                    Menu Digital &amp; Order
                </a>
                <a href="{{ route('resto.reservasi') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Reservasi Meja
                </a>
                <a href="{{ route('resto.status') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Status Pesanan (Live KDS)
                </a>
                <a href="#footer-section" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Member &amp; Poin
                </a>
            </nav>

            <!-- Right: Keranjang Button & Mobile Menu Toggle -->
            <div class="flex items-center gap-2">
                <button type="button" onclick="alert('Keranjang Meja #04: {{ $restaurant['cart']['count'] }} Item ({{ $restaurant['cart']['total'] }}). Siap untuk dikonfirmasi.')" 
                        class="bg-[#b84221] hover:bg-[#a33315] text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-xs transition flex items-center gap-2.5">
                    <div class="relative">
                        <i class="fa-solid fa-basket-shopping text-sm"></i>
                        <span class="absolute -top-2 -right-2 bg-amber-400 text-slate-900 w-4 h-4 rounded-full text-[9px] font-black flex items-center justify-center">
                            {{ $restaurant['cart']['count'] }}
                        </span>
                    </div>
                    <div class="text-left leading-tight hidden sm:block">
                        <div class="text-[10px] font-medium text-amber-100">Keranjang</div>
                        <div class="text-xs font-black">{{ $restaurant['cart']['count'] }} Item &bull; {{ $restaurant['cart']['total'] }}</div>
                    </div>
                </button>

                <!-- Mobile Hamburger Button -->
                <button id="resto-hamburger" onclick="toggleRestoNav()" class="lg:hidden w-9 h-9 rounded-xl bg-stone-100 hover:bg-stone-200 border border-stone-200 flex flex-col items-center justify-center gap-1 transition">
                    <span class="w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bar1"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bar2"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bar3"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer Panel (Slide from Right) -->
    <div id="resto-nav-overlay" onclick="closeRestoNav()" class="lg:hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm" style="opacity:0; visibility:hidden; transition: opacity 0.25s ease, visibility 0.25s ease;"></div>
    <div id="resto-nav-drawer" class="lg:hidden fixed top-0 right-0 h-full w-[280px] z-50 bg-white shadow-2xl border-l border-stone-200 flex flex-col justify-between" style="transform: translateX(100%); transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);">
        <div>
            <div class="flex items-center justify-between px-5 py-4 border-b border-stone-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-[#b84221] text-white flex items-center justify-center">
                        <i class="fa-solid fa-utensils text-sm"></i>
                    </div>
                    <span class="font-heading font-extrabold text-base text-slate-900">L-Coding Bistro</span>
                </div>
                <button onclick="closeRestoNav()" class="w-8 h-8 rounded-lg bg-stone-100 text-slate-600 flex items-center justify-center">
                    <i class="fa-solid fa-times text-sm"></i>
                </button>
            </div>
            <nav class="p-4 space-y-1 text-sm font-semibold">
                <a href="{{ url('/restaurant') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-house w-4 text-center"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('resto.menu') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-[#b84221] text-white font-bold">
                    <i class="fa-solid fa-book-open w-4 text-center text-white"></i>
                    <span>Menu Digital &amp; Order</span>
                </a>
                <a href="{{ route('resto.reservasi') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-calendar-check w-4 text-center text-amber-600"></i>
                    <span>Reservasi Meja</span>
                </a>
                <a href="{{ route('resto.status') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-display w-4 text-center text-emerald-600"></i>
                    <span>Status Pesanan (Live KDS)</span>
                </a>
                <a href="#footer-section" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-crown w-4 text-center text-purple-600"></i>
                    <span>Member &amp; Poin</span>
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-stone-100 bg-stone-50">
            <a href="https://wa.me/{{ $restaurant['whatsapp'] }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                <i class="fa-brands fa-whatsapp text-sm"></i>
                <span>Hotline Concierge</span>
            </a>
        </div>
    </div>

    <!-- ===================================================================
         3. PEMBERITAHUAN PUSAT INFORMASI RESMI (Sesuai Permintaan)
         =================================================================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="bg-gradient-to-r from-amber-50 via-stone-50 to-orange-50 border border-amber-200/90 rounded-3xl p-4 sm:p-5 flex items-start gap-4 shadow-2xs">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#9a3412] to-[#c2410c] text-white flex items-center justify-center shrink-0 mt-0.5 text-lg shadow-xs">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="space-y-1">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="font-heading font-extrabold text-sm sm:text-base text-slate-900 tracking-tight">
                        Pusat Informasi Resmi Menu Digital &amp; Ketentuan Pemesanan
                    </span>
                    <span class="text-[9px] font-extrabold bg-amber-200/80 text-amber-900 px-2 py-0.5 rounded-full border border-amber-300">
                        Informasi Publik Bersih
                    </span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Halaman ini berfungsi sebagai <strong>Pusat Informasi Terbuka</strong> katalog hidangan, komposisi bahan baku, transparansi harga nett (bebas biaya tersembunyi), serta alur pesan mandiri langsung dari meja Anda di <strong>L-Coding Bistro Cabang Clean</strong>.
                </p>
            </div>
        </div>
    </div>

    <!-- ===================================================================
         4. HERO SECTION PUSAT INFORMASI MENU
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-6 space-y-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="space-y-1.5 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-orange-100/70 border border-orange-200 rounded-full text-[11px] font-extrabold text-[#b84221] tracking-wider uppercase">
                    <i class="fa-solid fa-utensils"></i> KATALOG DIGITAL RESMI • 48 PILIHAN MENU
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 font-heading tracking-tight">
                    Katalog Menu &amp; Transparansi Dapur Koki
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Setiap hidangan dimasak segar saat pesanan diterima (made-to-order) oleh koki berpengalaman menggunakan bahan organik dan daging bersertifikat resmi.
                </p>
            </div>

            <!-- Quick Table Pill -->
            <div class="bg-white border border-stone-200 rounded-2xl p-3 flex items-center gap-3 shadow-2xs shrink-0">
                <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-xs">
                    <i class="fa-solid fa-chair"></i>
                </div>
                <div class="text-xs">
                    <div class="font-bold text-slate-800">Meja Anda: {{ $restaurant['active_table']['number'] }}</div>
                    <div class="text-[10px] text-slate-400">{{ $restaurant['active_table']['area'] }} &bull; Aktif</div>
                </div>
            </div>
        </div>

        <!-- 4 Badges Transparansi Mutu -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs">
                <span class="text-xl">🥩</span>
                <div>
                    <div class="font-bold text-slate-800 text-[11px]">Daging Wagyu MB5</div>
                    <div class="text-[10px] text-slate-400">100% Halal Australia</div>
                </div>
            </div>
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs">
                <span class="text-xl">☕</span>
                <div>
                    <div class="font-bold text-slate-800 text-[11px]">Single Origin Kopi</div>
                    <div class="text-[10px] text-slate-400">Aceh Gayo &amp; Bajawa</div>
                </div>
            </div>
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs">
                <span class="text-xl">⏱️</span>
                <div>
                    <div class="font-bold text-slate-800 text-[11px]">SLA Waktu Saji</div>
                    <div class="text-[10px] text-slate-400">Rata-rata 10–15 Menit</div>
                </div>
            </div>
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs">
                <span class="text-xl">🛡️</span>
                <div>
                    <div class="font-bold text-slate-800 text-[11px]">Standar Higienitas</div>
                    <div class="text-[10px] text-slate-400">Dapur Terbuka Grade A</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         5. FEATURED MASTERPIECE SHOWCASE (Informasi Menu Unggulan)
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-6 lg:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left: Featured Photo -->
            <div class="lg:col-span-5 relative rounded-2xl overflow-hidden h-64 lg:h-80 bg-stone-100 group shadow-xs">
                <img src="{{ $featuredItem['image'] }}" alt="{{ $featuredItem['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                <div class="absolute top-3 left-3 bg-amber-500 text-white text-[10px] font-black px-3 py-1 rounded-full shadow-xs">
                    {{ $featuredItem['badge'] }}
                </div>
                <div class="absolute bottom-3 right-3 bg-slate-900/80 backdrop-blur-xs text-white text-[10px] font-bold px-2.5 py-1 rounded-lg">
                    Estimasi Saji: {{ $featuredItem['time'] }}
                </div>
            </div>

            <!-- Right: Detailed Spec & Nutrition Info -->
            <div class="lg:col-span-7 space-y-4">
                <div class="space-y-1">
                    <span class="text-[10px] font-extrabold tracking-widest text-[#b84221] uppercase">
                        {{ $featuredItem['category'] }}
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 font-heading">
                        {{ $featuredItem['name'] }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        {{ $featuredItem['desc'] }}
                    </p>
                </div>

                <!-- Transparency Tags -->
                <div class="flex flex-wrap gap-1.5 pt-1">
                    @foreach($featuredItem['tags'] as $tag)
                    <span class="text-[10px] font-semibold bg-stone-100 text-slate-700 px-2.5 py-1 rounded-lg border border-stone-200">
                        ✓ {{ $tag }}
                    </span>
                    @endforeach
                </div>

                <!-- Price & Action -->
                <div class="flex items-center justify-between pt-3 border-t border-stone-100">
                    <div>
                        <div class="text-[10px] text-slate-400 font-medium">Harga Bersih (Nett)</div>
                        <div class="text-xl sm:text-2xl font-black text-slate-900">{{ $featuredItem['price'] }}</div>
                    </div>
                    <button type="button" onclick="alert('Berhasil menambahkan {{ $featuredItem['name'] }} ke Meja #04.')" class="px-5 py-2.5 bg-[#b84221] hover:bg-[#a33315] text-white rounded-xl text-xs sm:text-sm font-bold shadow-xs transition flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        <span>Pesan Menu Ini</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         6. KATALOG MAKANAN & MINUMAN LENGKAP DENGAN FILTER
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Controls: Search & Category Filter -->
        <div class="space-y-3">
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
                <h3 class="font-heading font-extrabold text-xl text-slate-900">
                    Daftar Menu Hidangan &amp; Minuman
                </h3>
                
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <input type="text" id="menuSearchInput" onkeyup="filterMenuCards()" placeholder="Cari nama menu, kopi, pasta..." 
                           class="w-full bg-white border border-stone-200 rounded-xl py-2 pl-9 pr-3 text-xs font-semibold placeholder-slate-400 focus:outline-none focus:border-[#b84221] shadow-2xs">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
            </div>

            <!-- Category Pills -->
            <div class="flex items-center gap-2 overflow-x-auto pb-1 text-xs font-bold scrollbar-none">
                <button type="button" onclick="filterMenuCategory('all')" id="cat-all" class="cat-filter-btn px-4 py-2 rounded-xl bg-[#b84221] text-white shadow-2xs transition whitespace-nowrap">
                    Semua Kategori (10)
                </button>
                <button type="button" onclick="filterMenuCategory('makanan')" id="cat-makanan" class="cat-filter-btn px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 hover:bg-stone-50 transition whitespace-nowrap">
                    Makanan Utama &amp; Pasta (6)
                </button>
                <button type="button" onclick="filterMenuCategory('minuman')" id="cat-minuman" class="cat-filter-btn px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 hover:bg-stone-50 transition whitespace-nowrap">
                    Kopi &amp; Minuman Artisanal (4)
                </button>
            </div>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="menuGridContainer">
            
            <!-- Makanan Utama Items -->
            @foreach($makananUtama as $m)
            <div class="menu-item-box bg-white rounded-3xl border border-stone-200 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group" data-cat="{{ $m['category'] }}" data-name="{{ strtolower($m['name']) }}">
                <div>
                    <div class="relative h-48 w-full overflow-hidden bg-stone-100">
                        <img src="{{ $m['image'] }}" alt="{{ $m['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-2.5 right-2.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs {{ $m['badge_color'] }}">
                            {{ $m['badge'] }}
                        </span>
                        <div class="absolute bottom-2.5 left-2.5 bg-slate-900/80 backdrop-blur-xs text-white text-[9px] font-bold px-2 py-0.5 rounded-md flex items-center gap-1">
                            <i class="fa-regular fa-clock text-[8px]"></i>
                            <span>{{ $m['time'] }}</span>
                        </div>
                    </div>
                    <div class="p-4 space-y-2">
                        <div class="flex items-center justify-between text-[9px] font-extrabold text-[#b84221] uppercase tracking-wider">
                            <span>{{ $m['spec'] }}</span>
                            <span class="text-emerald-700 bg-emerald-50 px-1.5 py-0.2 rounded border border-emerald-200">Siap Saji</span>
                        </div>
                        <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#b84221] transition-colors leading-snug">
                            {{ $m['name'] }}
                        </h4>
                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                            {{ $m['desc'] }}
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1">
                            @foreach($m['tags'] as $tag)
                            <span class="text-[9px] bg-stone-50 border border-stone-200 text-slate-600 px-2 py-0.5 rounded">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-4 pt-0 flex items-center justify-between border-t border-stone-100 mt-2">
                    <div>
                        <div class="text-[9px] text-slate-400 font-medium">Harga Bersih</div>
                        <div class="text-sm font-black text-slate-900">{{ $m['price'] }}</div>
                    </div>
                    <button type="button" onclick="alert('Pesanan {{ $m['name'] }} dimasukkan ke daftar Meja #04.')" class="px-3 py-1.5 bg-[#b84221] hover:bg-[#a33315] text-white rounded-xl text-xs font-bold shadow-2xs transition flex items-center gap-1">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Pesan</span>
                    </button>
                </div>
            </div>
            @endforeach

            <!-- Minuman Items -->
            @foreach($minumanKopi as $m)
            <div class="menu-item-box bg-white rounded-3xl border border-stone-200 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group" data-cat="{{ $m['category'] }}" data-name="{{ strtolower($m['name']) }}">
                <div>
                    <div class="relative h-48 w-full overflow-hidden bg-stone-100">
                        <img src="{{ $m['image'] }}" alt="{{ $m['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-2.5 right-2.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs {{ $m['badge_color'] }}">
                            {{ $m['badge'] }}
                        </span>
                        <div class="absolute bottom-2.5 left-2.5 bg-slate-900/80 backdrop-blur-xs text-white text-[9px] font-bold px-2 py-0.5 rounded-md flex items-center gap-1">
                            <i class="fa-regular fa-clock text-[8px]"></i>
                            <span>{{ $m['time'] }}</span>
                        </div>
                    </div>
                    <div class="p-4 space-y-2">
                        <div class="flex items-center justify-between text-[9px] font-extrabold text-[#b84221] uppercase tracking-wider">
                            <span>{{ $m['spec'] }}</span>
                            <span class="text-emerald-700 bg-emerald-50 px-1.5 py-0.2 rounded border border-emerald-200">Siap Saji</span>
                        </div>
                        <h4 class="text-sm sm:text-base font-bold text-slate-900 group-hover:text-[#b84221] transition-colors leading-snug">
                            {{ $m['name'] }}
                        </h4>
                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                            {{ $m['desc'] }}
                        </p>
                        <div class="flex flex-wrap gap-1 pt-1">
                            @foreach($m['tags'] as $tag)
                            <span class="text-[9px] bg-stone-50 border border-stone-200 text-slate-600 px-2 py-0.5 rounded">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-4 pt-0 flex items-center justify-between border-t border-stone-100 mt-2">
                    <div>
                        <div class="text-[9px] text-slate-400 font-medium">Harga Bersih</div>
                        <div class="text-sm font-black text-slate-900">{{ $m['price'] }}</div>
                    </div>
                    <button type="button" onclick="alert('Pesanan {{ $m['name'] }} dimasukkan ke daftar Meja #04.')" class="px-3 py-1.5 bg-[#b84221] hover:bg-[#a33315] text-white rounded-xl text-xs font-bold shadow-2xs transition flex items-center gap-1">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Pesan</span>
                    </button>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    <!-- ===================================================================
         7. PANDUAN CARA PESAN & KETENTUAN ALERGEN (Format Informasi)
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 pb-3 border-b border-stone-100">
                <div class="w-9 h-9 rounded-xl bg-orange-100 text-[#b84221] flex items-center justify-center font-bold text-base">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-base sm:text-lg text-slate-900">
                        Ketentuan Pemesanan, Modifikasi Rasa &amp; Alergen
                    </h3>
                    <p class="text-xs text-slate-500">
                        Harap perhatikan catatan pelayanan berikut demi kenyamanan santap Anda bersama kami.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-slate-600">
                <div class="space-y-1.5">
                    <div class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-pepper-hot text-red-600"></i>
                        <span>Tingkat Kematangan &amp; Kepedasan</span>
                    </div>
                    <p class="text-[11px] leading-relaxed text-slate-500">
                        Tingkat kematangan steak (Rare, Medium, Well-Done) dan level kepedasan pasta/nasi goreng (Level 1–5) dapat dicantumkan pada kolom catatan pesanan saat konfirmasi.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <div class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-wheat-awn text-amber-600"></i>
                        <span>Informasi Alergen Makanan</span>
                    </div>
                    <p class="text-[11px] leading-relaxed text-slate-500">
                        Bagi tamu dengan intoleransi laktosa, gluten, atau alergi kacang/seafood, silakan beri tahu barista kami agar disiapkan susu oat dan pemisahan peralatan masak.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <div class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-credit-card text-emerald-600"></i>
                        <span>Metode Pembayaran Resmi</span>
                    </div>
                    <p class="text-[11px] leading-relaxed text-slate-500">
                        Pembayaran dapat dilakukan langsung di meja menggunakan QRIS (GoPay, OVO, ShopeePay, BCA) atau kartu debit/kredit tanpa biaya tambahan (bebas surcharge).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         8. FOOTER RESMI (Identik Homepage)
         =================================================================== -->
    <footer id="footer-section" class="bg-white border-t border-stone-200/90 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500 mt-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            
            <!-- Col 1: Brand Info & WiFi -->
            <div class="space-y-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-[#b84221] text-white flex items-center justify-center font-bold">
                        <i class="fa-solid fa-utensils text-sm"></i>
                    </div>
                    <span class="font-heading font-extrabold text-base text-slate-900">L-Coding Bistro</span>
                    <span class="text-[10px] font-bold bg-amber-50 text-[#b84221] px-2 py-0.5 rounded-full border border-amber-200">Artisanal Cafe</span>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Sinergikan kehangatan cita rasa bistro kontemporer dengan presisi racikan kopi artisanal khas L-Coding. Tempat bertemunya ide, aroma, dan kepuasan kuliner hangat.
                </p>
                <div class="p-3 bg-stone-50 rounded-xl border border-stone-200 text-[11px] font-mono text-slate-600 flex items-center gap-2">
                    <i class="fa-solid fa-wifi text-amber-600"></i>
                    <span>WiFi: <strong>{{ $restaurant['wifi']['ssid'] }}</strong> / <span class="text-slate-800 font-bold">{{ $restaurant['wifi']['password'] }}</span></span>
                </div>
            </div>

            <!-- Col 2: Lokasi & Jam Operasional -->
            <div class="space-y-2.5">
                <h4 class="font-heading font-bold text-slate-900 text-sm">Lokasi &amp; Jam Operasional</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ $restaurant['full_address'] }}
                </p>
                <div class="space-y-1 text-xs pt-1">
                    <div class="flex justify-between">
                        <span>Senin - Jumat</span>
                        <span class="font-bold text-slate-700">09.00 - 22.30 WIB</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Sabtu - Minggu</span>
                        <span class="font-bold text-slate-700">08.00 - 23.00 WIB</span>
                    </div>
                    <div class="pt-1 text-[11px] text-amber-800 font-bold">
                        {{ $restaurant['hours']['last_order'] }}
                    </div>
                </div>
            </div>

            <!-- Col 3: Layanan & Bantuan Cepat -->
            <div class="space-y-2.5">
                <h4 class="font-heading font-bold text-slate-900 text-sm">Layanan &amp; Bantuan Cepat</h4>
                <ul class="space-y-2 text-xs">
                    <li>
                        <a href="https://wa.me/{{ $restaurant['whatsapp'] }}" target="_blank" class="flex items-center gap-2 text-emerald-700 font-bold hover:underline">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>WhatsApp Hotline: {{ $restaurant['phone'] }}</span>
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-calendar-check text-slate-400"></i>
                        <span>Bantuan Reservasi Meja VIP &amp; Rapat</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-slate-400"></i>
                        <span>Kritik, Saran &amp; Faktur Elektronik</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved text-slate-400"></i>
                        <span>Standar Higienitas &amp; Halal Kitchen</span>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Keanggotaan & Media -->
            <div class="space-y-3">
                <h4 class="font-heading font-bold text-slate-900 text-sm">Keanggotaan &amp; Media</h4>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Kumpulkan L-Beans tiap transaksi, dapatkan hidangan penutup gratis saat ulang tahun Anda.
                </p>
                <div class="flex items-center gap-2 text-xs font-bold text-[#b84221]">
                    <span>@lcodingbistro</span>
                    <span>&bull;</span>
                    <span>#SedapNikmat</span>
                </div>
                <div class="pt-2 border-t border-stone-100 text-[10px] text-slate-400">
                    <span>Pembayaran didukung: QRIS, Visa/Mastercard, GoPay, OVO, ShopeePay</span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-6 border-t border-stone-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-400">
            <div>
                &copy; {{ date('Y') }} L-Coding Bistro &amp; Coffee. All rights reserved. Clean Branch Edition.
            </div>
            <div class="flex items-center gap-4">
                <a href="javascript:void(0)" class="hover:text-slate-600">Ketentuan Layanan</a>
                <a href="javascript:void(0)" class="hover:text-slate-600">Kebijakan Privasi</a>
                <a href="javascript:void(0)" class="hover:text-slate-600">Katalog Allergen &amp; Gizi</a>
            </div>
        </div>
    </footer>

    <!-- Filter & Drawer Scripts -->
    <script>
        const restoDrawer = document.getElementById('resto-nav-drawer');
        const restoOverlay = document.getElementById('resto-nav-overlay');
        const bar1 = document.getElementById('bar1');
        const bar2 = document.getElementById('bar2');
        const bar3 = document.getElementById('bar3');
        let navOpen = false;

        function openRestoNav() {
            restoDrawer.style.transform = 'translateX(0)';
            restoOverlay.style.opacity = '1';
            restoOverlay.style.visibility = 'visible';
            document.body.style.overflow = 'hidden';
            bar1.style.transform = 'translateY(5px) rotate(45deg)';
            bar2.style.opacity = '0';
            bar3.style.transform = 'translateY(-5px) rotate(-45deg)';
            navOpen = true;
        }

        function closeRestoNav() {
            restoDrawer.style.transform = 'translateX(100%)';
            restoOverlay.style.opacity = '0';
            restoOverlay.style.visibility = 'hidden';
            document.body.style.overflow = '';
            bar1.style.transform = '';
            bar2.style.opacity = '1';
            bar3.style.transform = '';
            navOpen = false;
        }

        function toggleRestoNav() {
            navOpen ? closeRestoNav() : openRestoNav();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && navOpen) closeRestoNav();
        });

        // Filter Menu Categories
        function filterMenuCategory(category) {
            document.querySelectorAll('.cat-filter-btn').forEach(btn => {
                btn.className = 'cat-filter-btn px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 hover:bg-stone-50 transition whitespace-nowrap font-bold';
            });
            const activeBtn = document.getElementById('cat-' + category);
            if (activeBtn) {
                activeBtn.className = 'cat-filter-btn px-4 py-2 rounded-xl bg-[#b84221] text-white shadow-2xs transition whitespace-nowrap font-bold';
            }

            const cards = document.querySelectorAll('.menu-item-box');
            cards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-cat') === category) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Live Search Filter
        function filterMenuCards() {
            const query = document.getElementById('menuSearchInput').value.toLowerCase().trim();
            const cards = document.querySelectorAll('.menu-item-box');
            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (!query || name.includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
