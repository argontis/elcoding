<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant['name'] }} — {{ $restaurant['tagline'] }}</title>
    <meta name="description" content="Sajian Kuliner Artisanal & Specialty Coffee dalam Sentuhan Hangat. Pesan langsung dari meja tanpa antre di RestoHub Bistro Cabang Clean.">

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
         1. TOP ANNOUNCEMENT BAR (Sesuai Foto Persis)
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
         2. HEADER & NAVBAR (Sesuai Foto Persis)
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
                            RestoHub Bistro
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
                
                <div class="hidden 2xl:flex items-center gap-1.5 pl-3 border-l border-stone-200 text-xs">
                    <span class="font-bold text-slate-700">{{ $restaurant['branch'] }}</span>
                    <span id="topNavOrderType" class="text-[10px] bg-stone-100 text-slate-600 px-1.5 py-0.5 rounded border border-stone-200 font-semibold">Dine-in</span>
                    <span id="topNavTableNumber" class="text-[10px] bg-amber-50 text-amber-800 px-1.5 py-0.5 rounded border border-amber-200 font-bold">{{ $restaurant['active_table']['number'] }}</span>
                </div>
            </div>

            <!-- Desktop Nav Links (Selalu Kesamping / No-Wrap) -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs xl:text-sm font-semibold text-slate-600 whitespace-nowrap shrink-0">
                <a href="{{ url('/restaurant') }}" class="bg-[#b84221] text-white px-3.5 xl:px-4 py-2 rounded-xl font-bold shadow-xs flex items-center gap-1 whitespace-nowrap">
                    Beranda
                </a>
                <a href="{{ route('resto.menu') }}" class="hover:text-[#b84221] px-2.5 xl:px-3 py-2 rounded-xl hover:bg-stone-50 transition whitespace-nowrap">
                    Menu Digital &amp; Order
                </a>
                <a href="{{ route('resto.reservasi') }}" class="hover:text-[#b84221] px-2.5 xl:px-3 py-2 rounded-xl hover:bg-stone-50 transition whitespace-nowrap">
                    Reservasi Meja
                </a>
                <a href="{{ route('resto.status') }}" class="hover:text-[#b84221] px-2.5 xl:px-3 py-2 rounded-xl hover:bg-stone-50 transition whitespace-nowrap">
                    Status Pesanan (Live KDS)
                </a>
                <a href="{{ route('resto.member.info') }}" class="hover:text-[#b84221] px-2.5 xl:px-3 py-2 rounded-xl hover:bg-stone-50 transition flex items-center gap-1 whitespace-nowrap">
                    <i class="fa-solid fa-crown text-amber-500 text-[10px]"></i>
                    Member &amp; Poin
                </a>
            </nav>

            <!-- Right: Pusat Layanan / Hotline & Mobile Menu Toggle -->
            <div class="flex items-center gap-2">
                <a href="https://wa.me/{{ $restaurant['whatsapp'] }}?text=Halo%20RestoHub%20Bistro,%20saya%20ingin%20informasi%20layanan%20dan%20pemesanan" target="_blank"
                   class="bg-[#b84221] hover:bg-[#a33315] text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-xs transition flex items-center gap-2.5">
                    <div class="relative">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span class="absolute -top-1 -right-1 bg-emerald-400 w-2 h-2 rounded-full animate-ping"></span>
                    </div>
                    <div class="text-left leading-tight hidden sm:block">
                        <div class="text-[10px] font-medium text-amber-100">Pusat Layanan</div>
                        <div class="text-xs font-black">Hotline &bull; {{ $restaurant['phone'] }}</div>
                    </div>
                </a>

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
                    <span class="font-heading font-extrabold text-base text-slate-900">RestoHub Bistro</span>
                </div>
                <button onclick="closeRestoNav()" class="w-8 h-8 rounded-lg bg-stone-100 text-slate-600 flex items-center justify-center">
                    <i class="fa-solid fa-times text-sm"></i>
                </button>
            </div>
            <nav class="p-4 space-y-1 text-sm font-semibold">
                <a href="{{ url('/restaurant') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-[#b84221] text-white font-bold">
                    <i class="fa-solid fa-house w-4 text-center"></i>
                    <span>Beranda</span>
                </a>
                <a href="{{ route('resto.menu') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-book-open w-4 text-center text-orange-600"></i>
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
                <a href="{{ route('resto.member.info') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-crown w-4 text-center text-amber-500"></i>
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
         3. HERO SECTION (Sesuai Foto Persis)
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Copywriting & Value Badges -->
            <div class="lg:col-span-7 space-y-5 pt-1">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-orange-100/70 border border-orange-200 rounded-full text-[11px] font-extrabold text-[#b84221] tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-[#b84221]"></span>
                    CABANG CLEAN &bull; LIVE KITCHEN ACTIVE
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-[46px] font-black text-slate-900 font-heading tracking-tight leading-[1.15]">
                    Sajian Kuliner <span class="text-[#b84221] italic font-serif">Artisanal</span> &amp; Specialty Coffee dalam Sentuhan Hangat.
                </h1>

                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-xl">
                    Nikmati sensasi gastro-bistro modern berpadu aroma biji kopi pilihan nusantara. Pesan langsung dari meja Anda tanpa antre, lacak proses kreasi koki secara real-time, dan rasakan kebulusan hidangan segar setiap hari.
                </p>

                <!-- 4 Badges Row -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 pt-1 text-xs">
                    <div class="bg-stone-100/70 border border-stone-200 rounded-xl p-2.5 flex items-center gap-2">
                        <span class="text-emerald-600 text-base">🌿</span>
                        <div>
                            <div class="font-extrabold text-slate-800 text-[11px] leading-tight">Organik</div>
                            <div class="text-[10px] text-slate-500">Bahan Segar</div>
                        </div>
                    </div>
                    <div class="bg-stone-100/70 border border-stone-200 rounded-xl p-2.5 flex items-center gap-2">
                        <span class="text-blue-600 text-base">🛡️</span>
                        <div>
                            <div class="font-extrabold text-slate-800 text-[11px] leading-tight">100% Halal</div>
                            <div class="text-[10px] text-slate-500">Terverifikasi</div>
                        </div>
                    </div>
                    <div class="bg-stone-100/70 border border-stone-200 rounded-xl p-2.5 flex items-center gap-2">
                        <span class="text-amber-500 text-base">⭐</span>
                        <div>
                            <div class="font-extrabold text-slate-800 text-[11px] leading-tight">Koki Handal</div>
                            <div class="text-[10px] text-slate-500">Standar Bintang 5</div>
                        </div>
                    </div>
                    <div class="bg-stone-100/70 border border-stone-200 rounded-xl p-2.5 flex items-center gap-2">
                        <span class="text-orange-500 text-base">⏱️</span>
                        <div>
                            <div class="font-extrabold text-slate-800 text-[11px] leading-tight">15-20 Mnt</div>
                            <div class="text-[10px] text-slate-500">Siap Saji</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Pusat Informasi Pemesanan Card -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-6 space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="font-bold text-xs text-slate-800">Pusat Informasi Pemesanan</span>
                        </div>
                        <span id="guestPortalBadge" class="text-[10px] font-bold text-amber-900 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                            Pusat Informasi Meja {{ $restaurant['active_table']['number'] }}
                        </span>
                    </div>

                    <!-- Lokasi Duduk Anda Box -->
                    <div class="bg-stone-50 border border-stone-200/90 rounded-2xl p-4 flex items-center justify-between">
                        <div>
                            <div id="orderLocationLabel" class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Informasi Layanan Meja:</div>
                            <div id="orderLocationValue" class="font-extrabold text-sm sm:text-base text-slate-900 mt-0.5 flex items-center gap-2">
                                <span>🪑 Meja {{ $restaurant['active_table']['number'] }} &bull; {{ $restaurant['active_table']['area'] }} (Pesan di Meja / Kasir)</span>
                            </div>
                        </div>
                        <button type="button" onclick="openLocationModal()" class="text-xs font-bold text-[#b84221] hover:underline cursor-pointer">
                            Info Meja
                        </button>
                    </div>

                    <!-- Tipe Pemesanan Tabs -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Pilih Informasi Layanan:</label>
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" id="btnTypeDineIn" onclick="setOrderType('dinein')" class="py-2 px-3 rounded-xl bg-orange-50 border-2 border-[#b84221] text-[#b84221] font-bold text-xs flex items-center justify-center gap-1.5 shadow-2xs transition cursor-pointer">
                                <i class="fa-solid fa-utensils text-[11px]"></i>
                                <span>Dine-In</span>
                            </button>
                            <button type="button" id="btnTypeTakeaway" onclick="setOrderType('takeaway')" class="py-2 px-3 rounded-xl bg-stone-50 border border-stone-200 text-slate-600 font-semibold text-xs flex items-center justify-center gap-1.5 hover:bg-stone-100 transition cursor-pointer">
                                <i class="fa-solid fa-bag-shopping text-[11px]"></i>
                                <span>Takeaway</span>
                            </button>
                            <button type="button" id="btnTypeDelivery" onclick="setOrderType('delivery')" class="py-2 px-3 rounded-xl bg-stone-50 border border-stone-200 text-slate-600 font-semibold text-xs flex items-center justify-center gap-1.5 hover:bg-stone-100 transition cursor-pointer">
                                <i class="fa-solid fa-motorcycle text-[11px]"></i>
                                <span>Antar</span>
                            </button>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-2 pt-1">
                        <a href="{{ route('resto.menu') }}" id="btnActionOrder" class="w-full py-3.5 px-4 bg-[#b84221] hover:bg-[#a33315] text-white font-extrabold text-xs sm:text-sm rounded-2xl shadow-sm shadow-orange-950/20 flex items-center justify-center gap-2 transition">
                            <i class="fa-solid fa-book-open"></i>
                            <span id="btnActionOrderText">Lihat Buku Menu &amp; Pesan di Meja</span>
                        </a>
                        <a href="#status-dapur-section" class="w-full py-2.5 px-4 bg-stone-100 hover:bg-stone-200 text-slate-700 font-bold text-xs rounded-2xl border border-stone-200 flex items-center justify-center gap-2 transition">
                            <i class="fa-solid fa-clock-rotate-left text-amber-700"></i>
                            <span>Informasi Status Operasional Dapur</span>
                        </a>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-stone-100 text-[10px] text-slate-400">
                        <div class="flex items-center gap-1">
                            <i class="fa-solid fa-circle-info text-emerald-600"></i>
                            <span>Pusat Informasi Resmi Terhubung</span>
                        </div>
                        <span class="font-mono">{{ $restaurant['status']['node'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         4. STATUS DAPUR UTAMA STRIP (LIVE KDS) (Sesuai Foto Persis)
         =================================================================== -->
    <section id="status-dapur-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="bg-white rounded-3xl border border-stone-200 shadow-2xs p-4 sm:p-5 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4">
            
            <!-- Left: Kitchen Info -->
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-lg shrink-0 shadow-xs">
                    <i class="fa-solid fa-kitchen-set"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h3 class="font-heading font-extrabold text-sm sm:text-base text-slate-900">
                            Status Dapur Utama (Live KDS)
                        </h3>
                        <span class="text-[9px] font-extrabold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                            {{ $restaurant['status']['kitchen'] }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Kapasitas koki prima. Seluruh panggangan &amp; espresso bar beroperasi optimal.
                    </p>
                </div>
            </div>

            <!-- Right: Metrics -->
            <div class="flex items-center justify-between md:justify-end gap-6 pt-3 md:pt-0 border-t md:border-t-0 border-stone-100 text-xs">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full border-2 border-orange-500 flex items-center justify-center text-orange-600 font-bold text-xs">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div>
                        <div class="font-heading font-black text-sm text-slate-900 leading-none">{{ $restaurant['status']['avg_time'] }}</div>
                        <div class="text-[10px] text-slate-400 mt-0.5">Rata-rata Masak</div>
                    </div>
                </div>

                <div class="h-8 w-px bg-stone-200 hidden sm:block"></div>

                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-stone-100 flex items-center justify-center font-bold text-slate-700 text-xs">
                        8
                    </div>
                    <div>
                        <div class="font-heading font-black text-sm text-slate-900 leading-none">{{ $restaurant['status']['queue'] }}</div>
                        <div class="text-[10px] text-slate-400 mt-0.5">Diproses Sekarang</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         5. CHEF'S SIGNATURE & PILIHAN TERLARIS (Sesuai Foto Persis)
         =================================================================== -->
    <section id="menu-signature" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div class="space-y-1">
                <span class="text-[10px] font-extrabold tracking-widest text-[#b84221] uppercase flex items-center gap-1.5">
                    <i class="fa-solid fa-wand-magic-sparkles"></i> REKOMENDASI EKSEKUTIF KOKI
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 font-heading tracking-tight">
                    Chef's Signature &amp; Pilihan Terlaris Hari Ini
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 max-w-xl">
                    Racikan bahan premium segar dengan teknik olah slow-cooked dan sentuhan rempah bistro kontemporer.
                </p>
            </div>
            <a href="{{ route('resto.menu') }}" class="text-xs font-bold text-[#b84221] hover:text-[#9a3412] flex items-center gap-1 group whitespace-nowrap">
                <span>Jelajahi Semua 48 Menu</span>
                <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Grid 4 Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($signatureMenus as $m)
            <div class="bg-white rounded-3xl border border-stone-200 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <!-- Image Box with Badge & Tag -->
                    <div class="relative h-44 w-full overflow-hidden bg-stone-100">
                        <img src="{{ $m['image'] }}" alt="{{ $m['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-2.5 right-2.5 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full shadow-xs {{ $m['badge_color'] }}">
                            {{ $m['badge'] }}
                        </span>
                        <div class="absolute bottom-2.5 left-2.5 bg-slate-900/80 backdrop-blur-xs text-white text-[9px] font-bold px-2 py-0.5 rounded-md flex items-center gap-1">
                            <span>{{ $m['tag'] }}</span>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="p-4 space-y-1.5">
                        <div class="text-[9px] font-extrabold text-[#b84221] uppercase tracking-wider">
                            {{ $m['category'] }}
                        </div>
                        <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#b84221] transition-colors line-clamp-2 leading-snug">
                            {{ $m['name'] }}
                        </h3>
                        <p class="text-[11px] text-slate-500 line-clamp-3 leading-relaxed">
                            {{ $m['desc'] }}
                        </p>
                    </div>
                </div>

                <!-- Price & Add Button -->
                <div class="p-4 pt-0 flex items-center justify-between border-t border-stone-100 mt-2">
                    <div>
                        <div class="text-[9px] text-slate-400 font-medium">Harga Meja</div>
                        <div class="text-sm font-black text-slate-900">{{ $m['price'] }}</div>
                    </div>
                    <button type="button" onclick="alert('Berhasil menambahkan {{ $m['name'] }} ke keranjang Meja #04.')" class="px-3 py-1.5 bg-[#b84221] hover:bg-[#a33315] text-white rounded-xl text-xs font-bold shadow-2xs transition flex items-center gap-1">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         6. 3 LANGKAH SANTAP PRAKTIS (Sesuai Foto Persis)
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="text-center max-w-2xl mx-auto space-y-2 mb-8">
            <span class="text-[10px] font-extrabold tracking-widest text-[#b84221] uppercase">
                TANPA ANTRI &bull; TANPA RIBET
            </span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 font-heading tracking-tight">
                3 Langkah Santap Praktis Tanpa Menunggu Waiter
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                Sistem pemesanan cerdas terhubung langsung dengan Kitchen Display System (KDS) koki di dapur.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($steps as $s)
            <div class="bg-white rounded-3xl border border-stone-200 p-6 shadow-xs space-y-4 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="w-10 h-10 rounded-2xl bg-orange-100 text-[#b84221] font-heading font-black text-sm flex items-center justify-center">
                        {{ $s['step'] }}
                    </span>
                    <i class="{{ $s['icon'] }} text-lg text-slate-400"></i>
                </div>
                <div class="space-y-1.5">
                    <h3 class="font-heading font-bold text-base text-slate-900">
                        {{ $s['title'] }}
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        {{ $s['desc'] }}
                    </p>
                </div>
                <div class="pt-2 border-t border-stone-100 flex items-center gap-2 text-[11px] font-semibold text-emerald-700">
                    <i class="fa-solid fa-check text-[10px]"></i>
                    <span>{{ $s['check'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         7. RENCANAKAN MAKAN MALAM SPESIAL & RAPAT KOLEKTIF (Sesuai Foto Persis)
         =================================================================== -->
    <section id="reservasi-section" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-12">
            
            <!-- Left: Atmosphere Photo with Overlay Badge -->
            <div class="lg:col-span-5 relative min-h-[260px] lg:min-h-[380px] bg-stone-900 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&auto=format&fit=crop&q=80" 
                     alt="Private Event &amp; Meeting" 
                     class="w-full h-full object-cover opacity-85 hover:scale-105 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent"></div>
                <div class="absolute bottom-5 left-5 right-5">
                    <span class="text-[10px] font-extrabold tracking-wider text-amber-400 uppercase block mb-1">
                        PRIVATE EVENT &amp; MEETING
                    </span>
                    <h4 class="font-heading font-bold text-base text-white">
                        Kapasitas 10–60 Orang Tersedia
                    </h4>
                </div>
            </div>

            <!-- Right: Reservation Form -->
            <div class="lg:col-span-7 p-6 sm:p-8 space-y-5 flex flex-col justify-between">
                <div class="space-y-1.5">
                    <span class="text-[10px] font-extrabold tracking-widest text-[#b84221] uppercase">
                        JAMINAN MEJA TERBAIK
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 font-heading tracking-tight">
                        Rencanakan Makan Malam Spesial &amp; Rapat Kolektif
                    </h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Hindari kehabisan tempat saat akhir pekan. Tim kami menyiapkan penataan meja privat, sajian pembuka spesial, dan koneksi Wi-Fi cepat berdedikasi.
                    </p>
                </div>

                <form onsubmit="event.preventDefault(); alert('Permintaan reservasi meja telah diteruskan ke WhatsApp Concierge RestoHub Bistro.');" class="space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                        <div class="space-y-1">
                            <label class="font-bold text-slate-600 block text-[11px]">Tanggal Kunjungan</label>
                            <input type="date" value="{{ date('Y-m-d') }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:border-[#b84221]">
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-slate-600 block text-[11px]">Waktu / Sesi</label>
                            <select class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:border-[#b84221]">
                                <option>18.30 WIB (Dinner Utama)</option>
                                <option>12.00 WIB (Lunch Meeting)</option>
                                <option>15.30 WIB (Afternoon Coffee)</option>
                                <option>20.00 WIB (Late Dinner)</option>
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="font-bold text-slate-600 block text-[11px]">Jumlah Tamu</label>
                            <select class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3 py-2.5 text-xs font-semibold text-slate-700 focus:bg-white focus:outline-none focus:border-[#b84221]">
                                <option>4–6 Orang (Meja Booth)</option>
                                <option>1–2 Orang (Meja Pasangan)</option>
                                <option>7–12 Orang (Meja Panjang)</option>
                                <option>15+ Orang (Private Room)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-1">
                        <button type="submit" class="px-6 py-3 bg-[#b84221] hover:bg-[#a33315] text-white font-extrabold text-xs sm:text-sm rounded-xl shadow-xs transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-calendar-check"></i>
                            <span>Pesan Meja Sekarang</span>
                        </button>
                        <div class="flex items-center gap-1.5 text-[11px] text-slate-500 justify-center sm:justify-start">
                            <i class="fa-solid fa-bolt text-amber-500"></i>
                            <span>Konfirmasi instan WhatsApp dalam 5 menit</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         8. DIPERCAYA RATUSAN PENIKMAT KOPI & GASTRONOMI (Sesuai Foto Persis)
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
        <div class="text-center max-w-xl mx-auto space-y-1.5">
            <span class="text-[10px] font-extrabold tracking-widest text-[#b84221] uppercase">
                SUARA PELANGGAN KAMI
            </span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 font-heading tracking-tight">
                Dipercaya Ratusan Penikmat Kopi &amp; Gastronomi
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                Pengalaman bersantap nyata dari pelanggan setia RestoHub Bistro Cabang Clean.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($testimonials as $t)
            <div class="bg-white rounded-3xl border border-stone-200 p-6 shadow-xs flex flex-col justify-between space-y-4 hover:shadow-md transition">
                <div class="space-y-3">
                    <div class="text-amber-400 text-xs flex gap-1">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed italic">
                        {{ $t['comment'] }}
                    </p>
                </div>
                <div class="flex items-center gap-3 pt-3 border-t border-stone-100">
                    <img src="{{ $t['avatar'] }}" alt="{{ $t['name'] }}" class="w-9 h-9 rounded-full object-cover border border-stone-200">
                    <div>
                        <div class="font-bold text-xs text-slate-900">{{ $t['name'] }}</div>
                        <div class="text-[10px] text-slate-400">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         9. FOOTER RESMI (Sesuai Foto Persis)
         =================================================================== -->
    <footer id="footer-section" class="bg-white border-t border-stone-200/90 pt-12 pb-8 px-4 sm:px-8 text-xs text-slate-500 mt-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
            
            <!-- Col 1: Brand Info & WiFi -->
            <div class="space-y-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-[#b84221] text-white flex items-center justify-center font-bold">
                        <i class="fa-solid fa-utensils text-sm"></i>
                    </div>
                    <span class="font-heading font-extrabold text-base text-slate-900">RestoHub Bistro</span>
                    <span class="text-[10px] font-bold bg-amber-50 text-[#b84221] px-2 py-0.5 rounded-full border border-amber-200">Artisanal Cafe</span>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Sinergikan kehangatan cita rasa bistro kontemporer dengan presisi racikan kopi artisanal khas RestoHub. Tempat bertemunya ide, aroma, dan kepuasan kuliner hangat.
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
                    <span>@restohub_bistro</span>
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
                &copy; {{ date('Y') }} RestoHub Bistro &amp; Cafe. All rights reserved. Clean Branch Edition.
            </div>
            <div class="flex items-center gap-4">
                <a href="javascript:void(0)" class="hover:text-slate-600">Ketentuan Layanan</a>
                <a href="javascript:void(0)" class="hover:text-slate-600">Kebijakan Privasi</a>
                <a href="javascript:void(0)" class="hover:text-slate-600">Katalog Allergen &amp; Gizi</a>
            </div>
        </div>
    </footer>

    <!-- Scripts for Mobile Drawer -->
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

        // ============================================================
        // Order Type & Information Switcher (Pusat Informasi)
        // ============================================================
        const INACTIVE_BTN = 'py-2 px-3 rounded-xl bg-stone-50 border border-stone-200 text-slate-600 font-semibold text-xs flex items-center justify-center gap-1.5 hover:bg-stone-100 transition cursor-pointer';
        const ACTIVE_BTN   = 'py-2 px-3 rounded-xl bg-orange-50 border-2 border-[#b84221] text-[#b84221] font-bold text-xs flex items-center justify-center gap-1.5 shadow-2xs transition cursor-pointer';

        function setOrderType(type) {
            // Reset all buttons to inactive
            document.getElementById('btnTypeDineIn').className    = INACTIVE_BTN;
            document.getElementById('btnTypeTakeaway').className  = INACTIVE_BTN;
            document.getElementById('btnTypeDelivery').className  = INACTIVE_BTN;

            const label    = document.getElementById('orderLocationLabel');
            const value    = document.getElementById('orderLocationValue');
            const action   = document.getElementById('btnActionOrderText');
            const actionBtn = document.getElementById('btnActionOrder');
            const badge    = document.getElementById('guestPortalBadge');
            const navType  = document.getElementById('topNavOrderType');
            const waNumber = '{{ $restaurant["whatsapp"] ?? "628119233889" }}';

            if (type === 'dinein') {
                document.getElementById('btnTypeDineIn').className = ACTIVE_BTN;
                label.textContent      = 'Informasi Layanan Meja:';
                value.innerHTML        = '<span>🪑 Meja #04 • Pesan di Meja / Kasir</span>';
                action.textContent     = 'Lihat Buku Menu & Pesan di Meja';
                badge.textContent      = 'Pusat Informasi Meja #04';
                navType.textContent    = 'Dine-in';
                actionBtn.href         = '{{ route("resto.menu") }}';
                actionBtn.target       = '_self';
            } else if (type === 'takeaway') {
                document.getElementById('btnTypeTakeaway').className = ACTIVE_BTN;
                label.textContent      = 'Informasi Ambil Sendiri (Takeaway):';
                value.innerHTML        = '<span>🛍️ Ambil di Kasir • Pesan via WhatsApp / Kasir</span>';
                action.textContent     = 'Pesan Takeaway via WhatsApp Kasir';
                badge.textContent      = 'Pusat Informasi Takeaway';
                navType.textContent    = 'Takeaway';
                actionBtn.href         = 'https://wa.me/' + waNumber + '?text=' + encodeURIComponent('Halo RestoHub Bistro, saya ingin pesan takeaway.');
                actionBtn.target       = '_blank';
            } else if (type === 'delivery') {
                document.getElementById('btnTypeDelivery').className = ACTIVE_BTN;
                label.textContent      = 'Informasi Pesan Antar (Delivery):';
                value.innerHTML        = '<span>🛵 Pesan Antar • Hubungi Hotline / WhatsApp</span>';
                action.textContent     = 'Hubungi WhatsApp Pesan Antar';
                badge.textContent      = 'Pusat Informasi Pesan Antar';
                navType.textContent    = 'Delivery';
                actionBtn.href         = 'https://wa.me/' + waNumber + '?text=' + encodeURIComponent('Halo RestoHub Bistro, saya ingin pesan antar (delivery).');
                actionBtn.target       = '_blank';
            }
        }

        function openLocationModal() {
            alert('Pusat Informasi RestoHub Bistro: Untuk pindah meja atau cek ketersediaan ruangan, silakan sampaikan ke pramusaji terdekat atau hubungi kasir.');
        }
    </script>
</body>
</html>
