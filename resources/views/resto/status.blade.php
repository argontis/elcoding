<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan (Live KDS) — {{ $restaurant['name'] }}</title>
    <meta name="description" content="Pantau progres pesanan secara real-time melalui Kitchen Display System (KDS) L-Coding Bistro Meja #04 Cabang Clean.">

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#faf8f5] text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-amber-100 selection:text-bistro-900">

    <!-- ===================================================================
         1. TOP ANNOUNCEMENT BAR
         =================================================================== -->
    <div class="bg-[#3e1708] text-white text-[11px] sm:text-xs py-2 px-4 border-b border-amber-950/40 font-medium">
        <div class="max-w-7xl mx-auto flex items-center justify-center sm:justify-start gap-2">
            <span class="text-amber-400">🎉</span>
            <span class="tracking-wide">
                <strong>Promo Opening Clean Branch:</strong> Diskon 20% Dine-In &amp; Free Welcome Artisan Brew! &bull; Jam Buka Hari Ini: 09.00 - 22.30 WIB
            </span>
        </div>
    </div>

    <!-- ===================================================================
         2. HEADER & NAVBAR (Status Pesanan Active Pill)
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
                        <div class="text-[9px] font-bold text-amber-900 tracking-wider uppercase mt-0.5">
                            ARTISANAL KITCHEN
                        </div>
                        <div class="flex items-center gap-1.5 mt-0.5">
                            <span class="inline-flex items-center gap-1 text-[9px] font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                {{ $restaurant['active_table']['status'] }}
                            </span>
                            <span class="hidden sm:inline-block text-[10px] text-slate-400">&bull; {{ $restaurant['active_table']['url'] }}</span>
                        </div>
                    </div>
                </a>
                
                <!-- Branch Tag & Dine-In Selector -->
                <div class="hidden xl:flex items-center gap-2 pl-3 border-l border-stone-200 text-xs">
                    <div>
                        <div class="font-bold text-slate-700 text-xs">{{ $restaurant['branch_full'] }}</div>
                        <div class="inline-flex rounded-lg bg-stone-100 p-0.5 mt-0.5 text-[10px] font-semibold border border-stone-200">
                            <span class="px-2 py-0.5 rounded-md bg-white shadow-2xs text-[#b84221] font-bold">Dine-In</span>
                            <span class="px-2 py-0.5 rounded-md text-slate-500">Takeaway</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Nav Links (Status Pesanan Active Solid Terracotta Pill) -->
            <nav class="hidden lg:flex items-center gap-1.5 text-xs xl:text-sm font-semibold text-slate-600">
                <a href="{{ url('/restaurant') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Beranda
                </a>
                <a href="{{ route('resto.menu') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Menu Digital &amp; Order
                </a>
                <a href="{{ route('resto.reservasi') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Reservasi Meja
                </a>
                <a href="{{ route('resto.status') }}" class="bg-[#b84221] text-white px-4 py-2 rounded-xl font-bold shadow-xs flex items-center gap-1.5">
                    <span>Status Pesanan (Live KDS)</span>
                </a>
                <a href="#footer-section" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">
                    Member &amp; Poin
                </a>
            </nav>

            <!-- Right: Keranjang Button & Mobile Menu Toggle -->
            <div class="flex items-center gap-2">
                <button type="button" onclick="openReceiptModal()" 
                        class="bg-[#b84221] hover:bg-[#a33315] text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-xs transition flex items-center gap-2.5 relative">
                    <span class="absolute -top-1.5 -right-1.5 bg-amber-400 text-slate-900 w-4 h-4 rounded-full text-[9px] font-black flex items-center justify-center shadow-xs">
                        {{ $restaurant['cart']['count'] }}
                    </span>
                    <i class="fa-solid fa-basket-shopping text-sm"></i>
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
                <a href="{{ route('resto.menu') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-book-open w-4 text-center text-orange-600"></i>
                    <span>Menu Digital &amp; Order</span>
                </a>
                <a href="{{ route('resto.reservasi') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50">
                    <i class="fa-solid fa-calendar-check w-4 text-center text-amber-600"></i>
                    <span>Reservasi Meja</span>
                </a>
                <a href="{{ route('resto.status') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-[#b84221] text-white font-bold">
                    <i class="fa-solid fa-display w-4 text-center text-white"></i>
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
         3. PEMBERITAHUAN INFORMASI RESMI (Pusat Live KDS & Pemantauan Dapur)
         =================================================================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-5">
        <div class="bg-gradient-to-r from-amber-50 via-stone-50 to-orange-50 border border-amber-200/90 rounded-3xl p-4 sm:p-5 flex items-start gap-4 shadow-2xs">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#9a3412] to-[#c2410c] text-white flex items-center justify-center shrink-0 mt-0.5 text-lg shadow-xs">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="space-y-1">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="font-heading font-extrabold text-sm sm:text-base text-slate-900 tracking-tight">
                        Pemberitahuan Informasi Resmi: Pemantauan Status Pesanan &amp; Live Kitchen Display System (KDS)
                    </span>
                    <span class="text-[9px] font-extrabold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full border border-emerald-300 flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Live Sinkronisasi Terbuka
                    </span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Portal ini menampilkan transparansi operasional dapur secara langsung. Anda dapat memantau antrean pesanan, alokasi wajan chef, estimasi waktu saji, serta memanggil bantuan pramusaji khusus <strong>Meja {{ $restaurant['active_table']['number'] }}</strong> secara instan tanpa perlu melambaikan tangan.
                </p>
            </div>
        </div>
    </div>

    <!-- ===================================================================
         4. SEARCH BAR & ACTION BUTTONS STRIP
         =================================================================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <!-- Search Input Field -->
            <div class="relative flex-1 w-full">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </div>
                <input type="text" id="orderSearchInput" value="{{ $order['code'] }}" 
                       placeholder="Cari Order ID (#ORD-XXXX) atau Nomor Meja..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-stone-200 rounded-2xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-[#b84221] focus:border-[#b84221] shadow-2xs transition">
            </div>

            <!-- Action Buttons: Riwayat Meja & Sinkron KDS -->
            <div class="flex items-center gap-2 w-full sm:w-auto shrink-0">
                <button type="button" onclick="showHistoryToast()" 
                        class="flex-1 sm:flex-initial px-4 py-2.5 bg-white hover:bg-stone-50 border border-stone-200 text-slate-700 font-bold text-xs rounded-2xl shadow-2xs flex items-center justify-center gap-2 transition active:scale-95">
                    <i class="fa-solid fa-clock-rotate-left text-slate-500"></i>
                    <span>Riwayat Meja</span>
                </button>
                <button type="button" onclick="syncKDSData()" id="btnSyncKds"
                        class="flex-1 sm:flex-initial px-4 py-2.5 bg-[#b84221] hover:bg-[#a33315] text-white font-bold text-xs rounded-2xl shadow-xs flex items-center justify-center gap-2 transition active:scale-95">
                    <i class="fa-solid fa-arrows-rotate text-sm" id="iconSync"></i>
                    <span>Sinkron KDS</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ===================================================================
         5. ORDER HEADER CARD (Order #ORD-8821 Sesuai Screenshot)
         =================================================================== -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <div class="bg-white border border-stone-200 rounded-3xl p-4 sm:p-5 shadow-2xs flex flex-col md:flex-row md:items-center justify-between gap-4">
            
            <!-- Left Info with Icon -->
            <div class="flex items-start gap-3.5">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-800 border border-amber-200 flex items-center justify-center shrink-0 text-xl shadow-2xs">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="space-y-1">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h1 class="font-heading font-black text-lg sm:text-xl text-slate-900 leading-tight">
                            Order {{ $order['code'] }}
                        </h1>
                        <span class="text-[10px] font-black bg-amber-100 text-amber-900 px-2 py-0.5 rounded-md border border-amber-200">
                            {{ $order['table_number'] }}
                        </span>
                        <span class="text-[10px] font-black bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-md border border-emerald-200">
                            {{ $order['table_type'] }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 text-xs text-slate-500">
                        <span class="inline-flex items-center gap-1.5 font-medium text-slate-700">
                            <i class="fa-regular fa-user text-slate-400 text-[11px]"></i>
                            {{ $order['customer_name'] }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 font-medium text-slate-500">
                            <i class="fa-regular fa-clock text-slate-400 text-[11px]"></i>
                            {{ $order['order_time'] }}
                        </span>
                    </div>

                    <div class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-600 pt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>{{ $order['server_status'] }}</span>
                    </div>
                </div>
            </div>

            <!-- Right: QRIS LUNAS Badge & Print Action -->
            <div class="flex items-center gap-3 shrink-0 self-end md:self-center">
                <div class="bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-2xl text-right">
                    <div class="inline-flex items-center gap-1.5 text-emerald-700 font-black text-xs">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                        <span>LUNAS</span>
                    </div>
                    <div class="text-[10px] text-emerald-600 font-medium">
                        QRIS BCA (Ref: QR-992104)
                    </div>
                </div>
                <button type="button" onclick="printReceipt()" title="Cetak Nota / Struk"
                        class="w-10 h-10 rounded-2xl bg-stone-100 hover:bg-stone-200 border border-stone-200 text-slate-700 flex items-center justify-center transition active:scale-95 shadow-2xs">
                    <i class="fa-solid fa-print text-sm"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- ===================================================================
         6. MAIN CONTENT: 2-COLUMN LAYOUT
         =================================================================== -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">
            
            <!-- ===============================================================
                 LEFT COLUMN: PROGRES DAPUR & KESIAPAN TIAP ITEM (Col 7 / ~60%)
                 =============================================================== -->
            <div class="lg:col-span-7 space-y-5">
                
                <!-- CARD 1: PROGRES DAPUR & BAR -->
                <div class="bg-white border border-stone-200 rounded-3xl p-5 shadow-2xs">
                    <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-[#b84221] text-base"></i>
                            <h2 class="font-heading font-extrabold text-base text-slate-900">
                                Progres Dapur &amp; Bar
                            </h2>
                        </div>
                        <span class="inline-flex items-center gap-1.5 text-[10px] font-extrabold text-[#b84221] bg-orange-50 px-2.5 py-1 rounded-full border border-orange-200">
                            <span class="w-2 h-2 rounded-full bg-[#b84221] animate-ping"></span>
                            Live Sinkronisasi
                        </span>
                    </div>

                    <!-- Stepper Timeline -->
                    <div class="mt-5 space-y-0 relative">
                        
                        <!-- Step 1 (Done) -->
                        <div class="relative flex items-start gap-4 pb-6">
                            <!-- Vertical Connecting Line -->
                            <div class="absolute left-3.5 top-8 bottom-0 w-0.5 bg-emerald-500"></div>
                            
                            <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 z-10 shadow-xs text-xs">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="flex-1 space-y-1">
                                <div class="flex items-center justify-between flex-wrap gap-1">
                                    <h3 class="font-bold text-xs text-slate-900">
                                        1. Pesanan Diterima di Sistem
                                    </h3>
                                    <span class="text-[10px] font-bold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-md border border-emerald-200">
                                        12:40 WIB
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed">
                                    Struk order tercetak otomatis pada terminal POS &amp; Kitchen Routing.
                                </p>
                            </div>
                        </div>

                        <!-- Step 2 (Done) -->
                        <div class="relative flex items-start gap-4 pb-6">
                            <!-- Vertical Connecting Line -->
                            <div class="absolute left-3.5 top-8 bottom-0 w-0.5 bg-emerald-500"></div>

                            <div class="w-7 h-7 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 z-10 shadow-xs text-xs">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="flex-1 space-y-1">
                                <div class="flex items-center justify-between flex-wrap gap-1">
                                    <h3 class="font-bold text-xs text-slate-900">
                                        2. Dikonfirmasi Kasir &amp; Masuk Antrean KDS
                                    </h3>
                                    <span class="text-[10px] font-bold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-md border border-emerald-200">
                                        12:41 WIB
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed">
                                    Pembayaran QRIS BCA terverifikasi otomatis. Slot wajan &amp; barista dialokasikan.
                                </p>
                            </div>
                        </div>

                        <!-- Step 3 (Active Cooking - In Progress 75%) -->
                        <div class="relative flex items-start gap-4 pb-6">
                            <!-- Vertical Connecting Line -->
                            <div class="absolute left-3.5 top-8 bottom-0 w-0.5 bg-stone-200"></div>

                            <div class="w-7 h-7 rounded-full bg-[#b84221] text-white flex items-center justify-center shrink-0 z-10 shadow-xs text-xs">
                                <i class="fa-solid fa-fire-burner"></i>
                            </div>
                            <div class="flex-1 space-y-2 bg-amber-50/70 border border-amber-200/90 rounded-2xl p-3.5">
                                <div class="flex items-center justify-between flex-wrap gap-2">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-bold text-xs text-slate-900">
                                            3. Sedang Dimasak di Dapur Utama
                                        </h3>
                                        <span class="text-[10px] font-black bg-[#b84221] text-white px-2 py-0.5 rounded-md shadow-2xs">
                                            BERJALAN 75%
                                        </span>
                                    </div>
                                    <span class="text-[11px] font-bold text-amber-900">
                                        Target: 12:55 WIB
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-600 leading-relaxed">
                                    <span class="text-amber-700">👨‍🍳 <strong>Chef Budi</strong></span> sedang memanggang Wagyu Meltique di Griddle &amp; <span class="text-amber-700">👩‍🍳 <strong>Chef Anita</strong></span> sedang menumis Salmon Aglio Olio.
                                </p>
                                <!-- Terracotta Progress Bar -->
                                <div class="w-full bg-stone-200 rounded-full h-2 overflow-hidden">
                                    <div class="bg-gradient-to-r from-[#d7704e] to-[#b84221] h-2 rounded-full w-3/4 transition-all duration-500"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4 (Pending) -->
                        <div class="relative flex items-start gap-4 pb-6">
                            <!-- Vertical Connecting Line -->
                            <div class="absolute left-3.5 top-8 bottom-0 w-0.5 bg-stone-200"></div>

                            <div class="w-7 h-7 rounded-full bg-stone-100 border border-stone-300 text-slate-400 flex items-center justify-center shrink-0 z-10 text-xs">
                                <i class="fa-solid fa-bell-concierge"></i>
                            </div>
                            <div class="flex-1 space-y-1 opacity-70">
                                <div class="flex items-center justify-between flex-wrap gap-1">
                                    <h3 class="font-bold text-xs text-slate-700">
                                        4. Quality Check &amp; Sentuhan Plating
                                    </h3>
                                    <span class="text-[10px] font-medium text-slate-400">
                                        Menunggu antrean
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed">
                                    Pemeriksaan suhu sajian, ketepatan alergen, dan sentuhan microgreens.
                                </p>
                            </div>
                        </div>

                        <!-- Step 5 (Pending Final) -->
                        <div class="relative flex items-start gap-4">
                            <div class="w-7 h-7 rounded-full bg-stone-100 border border-stone-300 text-slate-400 flex items-center justify-center shrink-0 z-10 text-xs">
                                <i class="fa-solid fa-person-walking-arrow-right"></i>
                            </div>
                            <div class="flex-1 space-y-1 opacity-70">
                                <div class="flex items-center justify-between flex-wrap gap-1">
                                    <h3 class="font-bold text-xs text-slate-700">
                                        5. Disajikan Hangat di Meja #04
                                    </h3>
                                    <span class="text-[10px] font-medium text-slate-400">
                                        Tahap akhir
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed">
                                    Runner mengantar nampan pesanan langsung ke meja pemesan.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- CARD 2: KESIAPAN TIAP ITEM HIDANGAN -->
                <div class="bg-white border border-stone-200 rounded-3xl p-5 shadow-2xs">
                    <div class="flex items-center justify-between pb-4 border-b border-stone-100">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-list text-[#b84221] text-base"></i>
                            <h2 class="font-heading font-extrabold text-base text-slate-900">
                                Kesiapan Tiap Item Hidangan
                            </h2>
                        </div>
                        <span class="text-xs font-semibold text-slate-400">
                            Total 3 Menu (4 Porsi)
                        </span>
                    </div>

                    <div class="mt-4 space-y-3">
                        @foreach ($orderItems as $item)
                        <div class="p-3.5 bg-stone-50/70 hover:bg-stone-50 border border-stone-200 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3 transition">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-800 border border-amber-200 flex items-center justify-center shrink-0 text-base shadow-2xs">
                                    <i class="fa-solid {{ $item['icon'] }}"></i>
                                </div>
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h3 class="font-bold text-xs sm:text-sm text-slate-900">
                                            {{ $item['qty_name'] }}
                                        </h3>
                                        <span class="text-[10px] font-medium bg-stone-200 text-slate-700 px-2 py-0.5 rounded-md">
                                            {{ $item['variants'] }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-400 mt-1">
                                        {{ $item['station'] }}
                                    </div>
                                </div>
                            </div>

                            <div class="sm:text-right shrink-0">
                                @if ($item['status_type'] === 'served')
                                    <span class="inline-flex items-center gap-1.5 text-[11px] font-bold bg-emerald-100 text-emerald-800 px-3 py-1 rounded-xl border border-emerald-200">
                                        <i class="fa-solid fa-check text-xs"></i>
                                        {{ $item['status_text'] }}
                                    </span>
                                @else
                                    <div class="inline-flex items-center gap-1.5 text-[11px] font-bold bg-orange-100 text-[#b84221] px-2.5 py-1 rounded-xl border border-orange-200">
                                        <i class="fa-solid fa-fire text-xs"></i>
                                        {{ $item['status_text'] }}
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-medium mt-0.5">
                                        {{ $item['eta'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <!-- ===============================================================
                 RIGHT COLUMN: TELEMETRY, BANTUAN MEJA, & INVOICE (Col 5 / ~40%)
                 =============================================================== -->
            <div class="lg:col-span-5 space-y-5">
                
                <!-- CARD 1: LIVE KITCHEN TELEMETRY -->
                <div class="bg-white border border-stone-200 rounded-3xl p-5 shadow-2xs space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                        <span class="text-[11px] font-black tracking-wider text-slate-400 uppercase">
                            LIVE KITCHEN TELEMETRY
                        </span>
                        <span class="inline-flex items-center gap-1 text-[10px] font-extrabold bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-full border border-emerald-200">
                            <i class="fa-solid fa-shield-halved text-emerald-600 text-[10px]"></i>
                            {{ $telemetry['sla_status'] }}
                        </span>
                    </div>

                    <!-- Donut / Gauge + Estimasi Waktu -->
                    <div class="flex items-center gap-5">
                        <!-- Circular Donut 75% -->
                        <div class="relative w-24 h-24 shrink-0 flex items-center justify-center">
                            <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                <path class="text-stone-100" stroke-width="3.5" stroke="currentColor" fill="none"
                                      d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="text-[#b84221]" stroke-width="3.5" stroke-dasharray="75, 100" stroke-linecap="round" stroke="currentColor" fill="none"
                                      d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                                <span class="font-heading font-black text-xl text-slate-900 leading-none">
                                    {{ $telemetry['percent'] }}%
                                </span>
                                <span class="text-[9px] font-medium text-slate-400 mt-0.5">Selesai</span>
                            </div>
                        </div>

                        <!-- Estimasi Jam & Sisa Waktu -->
                        <div class="space-y-1">
                            <div class="text-[11px] text-slate-400 font-medium">Estimasi Siap di Meja:</div>
                            <div class="font-heading font-black text-2xl text-slate-900 leading-none">
                                {{ $telemetry['eta_clock'] }}
                            </div>
                            <div class="text-xs font-bold text-amber-800 flex items-center gap-1.5 pt-0.5">
                                <i class="fa-solid fa-hourglass-half text-[11px]"></i>
                                <span>Sisa Waktu: {{ $telemetry['remaining_min'] }}</span>
                            </div>
                            <p class="text-[10px] text-slate-400 leading-snug pt-1">
                                {{ $telemetry['note'] }}
                            </p>
                        </div>
                    </div>

                    <!-- CCTV Open Kitchen Preview Card -->
                    <div class="bg-stone-50 border border-stone-200 rounded-2xl p-3 flex items-center gap-3">
                        <div class="relative w-16 h-14 rounded-xl overflow-hidden shrink-0 shadow-2xs">
                            <img src="{{ $telemetry['cam_image'] }}" alt="Live Kitchen Cam" class="w-full h-full object-cover">
                            <div class="absolute top-1 left-1 bg-black/70 text-white font-mono text-[8px] font-bold px-1 rounded">
                                {{ $telemetry['cam_tag'] }}
                            </div>
                        </div>
                        <div class="space-y-0.5 flex-1">
                            <div class="font-bold text-xs text-slate-900 leading-tight">
                                {{ $telemetry['cam_title'] }}
                            </div>
                            <div class="text-[10px] text-slate-500">
                                {{ $telemetry['cam_desc'] }}
                            </div>
                            <div class="flex items-center gap-1 text-[10px] font-bold text-emerald-600">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>{{ $telemetry['cam_status'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: BANTUAN MEJA #04 -->
                <div class="bg-white border border-stone-200 rounded-3xl p-5 shadow-2xs space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                        <h2 class="font-heading font-extrabold text-base text-slate-900">
                            Bantuan Meja #04
                        </h2>
                        <span class="text-[10px] font-bold bg-amber-100 text-amber-900 px-2.5 py-0.5 rounded-full border border-amber-200">
                            Layanan Kilat
                        </span>
                    </div>

                    <div class="text-xs text-slate-600 font-medium">
                        Panggil Waiter untuk Kebutuhan:
                    </div>

                    <!-- 4 Action Buttons Grid (2x2) -->
                    <div class="grid grid-cols-2 gap-2 text-xs font-bold text-slate-700">
                        <button type="button" onclick="callWaiter('Minta Sendok/Garpu')" 
                                class="p-2.5 bg-stone-50 hover:bg-amber-50 hover:border-amber-300 border border-stone-200 rounded-2xl flex items-center gap-2 transition active:scale-95 text-left">
                            <span class="text-amber-800 text-sm">🍴</span>
                            <span>Minta Sendok/Garpu</span>
                        </button>
                        <button type="button" onclick="callWaiter('Minta Tissue')" 
                                class="p-2.5 bg-stone-50 hover:bg-amber-50 hover:border-amber-300 border border-stone-200 rounded-2xl flex items-center gap-2 transition active:scale-95 text-left">
                            <span class="text-amber-800 text-sm">🧻</span>
                            <span>Minta Tissue</span>
                        </button>
                        <button type="button" onclick="callWaiter('Tambah Air Putih')" 
                                class="p-2.5 bg-stone-50 hover:bg-amber-50 hover:border-amber-300 border border-stone-200 rounded-2xl flex items-center gap-2 transition active:scale-95 text-left">
                            <span class="text-amber-800 text-sm">💧</span>
                            <span>Tambah Air Putih</span>
                        </button>
                        <button type="button" onclick="callWaiter('Minta Bill Cetak')" 
                                class="p-2.5 bg-stone-50 hover:bg-amber-50 hover:border-amber-300 border border-stone-200 rounded-2xl flex items-center gap-2 transition active:scale-95 text-left">
                            <span class="text-amber-800 text-sm">🧾</span>
                            <span>Minta Bill Cetak</span>
                        </button>
                    </div>

                    <!-- CTA 1: Tambah Pesanan Baru -->
                    <a href="{{ route('resto.menu') }}" 
                       class="w-full py-3 px-4 bg-gradient-to-r from-[#d7704e] to-[#b84221] hover:from-[#c2410c] hover:to-[#9a3412] text-white font-extrabold text-xs sm:text-sm rounded-2xl shadow-xs flex items-center justify-center gap-2 transition active:scale-95">
                        <i class="fa-solid fa-plus-circle"></i>
                        <span>Tambah Pesanan Baru ke Meja #04</span>
                    </a>

                    <!-- CTA 2: Lihat Rincian Struk & Nota Digital -->
                    <button type="button" onclick="openReceiptModal()" 
                            class="w-full py-2.5 px-4 bg-stone-100 hover:bg-stone-200 text-slate-700 font-bold text-xs rounded-2xl border border-stone-200 flex items-center justify-center gap-2 transition active:scale-95">
                        <i class="fa-solid fa-receipt text-slate-500"></i>
                        <span>Lihat Rincian Struk &amp; Nota Digital</span>
                    </button>
                </div>

                <!-- CARD 3: INFORMASI FAKTUR & PAJAK -->
                <div class="bg-white border border-stone-200 rounded-3xl p-5 shadow-2xs space-y-2.5">
                    <div class="flex items-center justify-between">
                        <span class="font-heading font-extrabold text-xs text-slate-900">
                            Informasi Faktur &amp; Pajak
                        </span>
                        <span class="text-[10px] font-bold text-slate-400">
                            {{ $order['tax_note'] }}
                        </span>
                    </div>

                    <div class="text-xs text-slate-500 space-y-1 pt-1">
                        <div class="flex justify-between">
                            <span>Metode Bayar:</span>
                            <span class="font-bold text-slate-800">{{ $order['payment_method'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Kode Otorisasi:</span>
                            <span class="font-mono text-slate-700 text-[11px]">{{ $order['auth_code'] }}</span>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-stone-100 flex items-center justify-between">
                        <span class="font-heading font-black text-xs text-slate-900">Total Transaksi:</span>
                        <span class="font-heading font-black text-lg text-[#b84221]">{{ $order['total_amount'] }}</span>
                    </div>

                    <div class="pt-2">
                        <button type="button" onclick="downloadInvoicePDF()" 
                                class="text-xs font-bold text-[#b84221] hover:text-[#9a3412] inline-flex items-center gap-1.5 transition">
                            <i class="fa-solid fa-file-arrow-down"></i>
                            <span>Unduh Faktur Elektronik (PDF)</span>
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- ===================================================================
         7. MODAL RINCIAN STRUK & NOTA DIGITAL
         =================================================================== -->
    <div id="receiptModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs hidden">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 shadow-2xl border border-stone-200 space-y-4 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between border-b border-stone-100 pb-3">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-xl bg-[#b84221] text-white flex items-center justify-center text-sm">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div>
                        <div class="font-heading font-black text-sm text-slate-900">Struk Pembayaran Digital</div>
                        <div class="text-[10px] text-slate-400">{{ $order['code'] }} &bull; Meja #04</div>
                    </div>
                </div>
                <button onclick="closeReceiptModal()" class="w-7 h-7 rounded-lg bg-stone-100 hover:bg-stone-200 text-slate-500 flex items-center justify-center">
                    <i class="fa-solid fa-times text-xs"></i>
                </button>
            </div>

            <!-- Struk Body -->
            <div class="space-y-2 text-xs">
                <div class="p-3 bg-stone-50 rounded-xl space-y-1 font-mono text-[11px]">
                    <div class="flex justify-between">
                        <span>2x Signature Aren Latte</span>
                        <span class="font-bold">Rp 76.000</span>
                    </div>
                    <div class="flex justify-between">
                        <span>1x Wagyu Truffle Rice Bowl</span>
                        <span class="font-bold">Rp 88.000</span>
                    </div>
                    <div class="flex justify-between text-emerald-700">
                        <span>Promo Dine-In Clean 20%</span>
                        <span class="font-bold">-Rp 32.800</span>
                    </div>
                    <div class="flex justify-between">
                        <span>1x Spaghetti Aglio Olio Salmon</span>
                        <span class="font-bold">Rp 68.000</span>
                    </div>
                    <div class="border-t border-stone-200 pt-1.5 flex justify-between font-bold text-slate-900 text-xs">
                        <span>Subtotal Akhir</span>
                        <span>Rp 129.091</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>PB1 (Pajak Resto 10%)</span>
                        <span>Rp 12.909</span>
                    </div>
                    <div class="border-t border-stone-300 pt-1 flex justify-between font-black text-[#b84221] text-sm font-heading">
                        <span>Total Bayar (Lunas)</span>
                        <span>Rp 142.000</span>
                    </div>
                </div>
                <div class="text-[10px] text-slate-400 text-center">
                    QRIS BCA Interactive &bull; AUTH-0988472-X &bull; Ref: QR-992104
                </div>
            </div>

            <div class="flex items-center gap-2 pt-2">
                <button type="button" onclick="printReceipt()" class="flex-1 py-2.5 bg-stone-100 hover:bg-stone-200 text-slate-800 font-bold text-xs rounded-xl border border-stone-200 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-print"></i>
                    <span>Cetak Nota</span>
                </button>
                <button type="button" onclick="closeReceiptModal()" class="flex-1 py-2.5 bg-[#b84221] hover:bg-[#a33315] text-white font-bold text-xs rounded-xl">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toastNotification" class="fixed bottom-6 right-6 z-50 bg-slate-900 text-white text-xs font-semibold px-4 py-3 rounded-2xl shadow-xl flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
        <i class="fa-solid fa-circle-check text-emerald-400 text-base" id="toastIcon"></i>
        <span id="toastMessage">Pesan berhasil</span>
    </div>

    <!-- ===================================================================
         8. FOOTER RESMI (Identik Sesuai Standar L-Coding Bistro)
         =================================================================== -->
    <footer id="footer-section" class="bg-[#f5efe9] border-t border-stone-200/80 pt-12 pb-8 mt-12 text-slate-700 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-stone-300/60">
                
                <!-- Col 1: Brand & Filosofi -->
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="font-heading font-black text-base text-[#b84221] tracking-tight">
                            L-Coding Bistro
                        </span>
                        <span class="text-[9px] font-bold bg-orange-100 text-[#b84221] px-2 py-0.5 rounded-full border border-orange-200">
                            Artisanal Cafe
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Sinergi kehangatan cita rasa bistro kontemporer dengan presisi racikan kopi artisanal khas L-Coding. Tempat bertemunya ide, aroma, dan kepuasan kuliner hangat.
                    </p>
                    <div class="text-xs font-bold text-slate-800 flex items-center gap-2 pt-1">
                        <i class="fa-solid fa-wifi text-emerald-600"></i>
                        <span>WiFi: <strong>{{ $restaurant['wifi']['ssid'] }}</strong> / <span class="font-mono text-[#b84221]">{{ $restaurant['wifi']['password'] }}</span></span>
                    </div>
                </div>

                <!-- Col 2: Lokasi & Jam Operasional -->
                <div class="space-y-2.5">
                    <div class="font-heading font-black text-sm text-slate-900">
                        Lokasi &amp; Jam Operasional
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        {{ $restaurant['full_address'] }}
                    </p>
                    <div class="text-xs space-y-1 pt-1">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Senin - Jumat</span>
                            <span class="font-bold text-slate-800">09.00 - 22.30 WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Sabtu - Minggu</span>
                            <span class="font-bold text-slate-800">08.00 - 23.00 WIB</span>
                        </div>
                        <div class="flex justify-between text-[#b84221] font-bold pt-1">
                            <span>Dapur Terakhir (Last Order)</span>
                            <span>21.45 WIB</span>
                        </div>
                    </div>
                </div>

                <!-- Col 3: Layanan & Bantuan Cepat -->
                <div class="space-y-2.5">
                    <div class="font-heading font-black text-sm text-slate-900">
                        Layanan &amp; Bantuan Cepat
                    </div>
                    <ul class="space-y-2 text-xs">
                        <li>
                            <a href="https://wa.me/{{ $restaurant['whatsapp'] }}" target="_blank" class="hover:text-[#b84221] flex items-center gap-2 transition">
                                <i class="fa-brands fa-whatsapp text-emerald-600 text-sm"></i>
                                <span>WhatsApp Hotline: +62 811-9233-889</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('resto.reservasi') }}" class="hover:text-[#b84221] flex items-center gap-2 transition">
                                <i class="fa-solid fa-chair text-amber-700"></i>
                                <span>Bantuan Reservasi Meja VIP &amp; Rapat</span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:halo@lcodingbistro.com" class="hover:text-[#b84221] flex items-center gap-2 transition">
                                <i class="fa-regular fa-envelope text-slate-500"></i>
                                <span>Kritik, Saran &amp; Faktur Elektronik</span>
                            </a>
                        </li>
                        <li class="flex items-center gap-2 text-emerald-700 font-semibold pt-1">
                            <i class="fa-solid fa-circle-check text-emerald-600"></i>
                            <span>Standar Higienitas &amp; Halal Kitchen</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Keanggotaan & Media -->
                <div class="space-y-2.5">
                    <div class="font-heading font-black text-sm text-slate-900">
                        Keanggotaan &amp; Media
                    </div>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kumpulkan L-Beans tiap transaksi, dapatkan hidangan penutup gratis saat ulang tahun Anda.
                    </p>
                    <div class="flex items-center gap-2 pt-1 font-bold text-xs text-[#b84221]">
                        <span>@lcodingbistro</span>
                        <span>&bull;</span>
                        <span>#SedapNikmat</span>
                    </div>
                    <div class="text-[11px] text-slate-400 pt-1">
                        Pembayaran didukung: QRIS, Visa/Mastercard, GoPay, OVO, ShopeePay
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright & Links -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-500">
                <div>
                    &copy; 2025 L-Coding Bistro &amp; Coffee. All rights reserved. Clean Branch Edition.
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-[#b84221] transition">Ketentuan Layanan</a>
                    <a href="#" class="hover:text-[#b84221] transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-[#b84221] transition">Katalog Allergen &amp; Gizi</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ===================================================================
         9. INTERACTIVITY SCRIPTS
         =================================================================== -->
    <script>
        // Drawer Mobile Navigation
        function toggleRestoNav() {
            const drawer = document.getElementById('resto-nav-drawer');
            const overlay = document.getElementById('resto-nav-overlay');
            const isOpen = drawer.style.transform === 'translateX(0%)';
            if (isOpen) {
                closeRestoNav();
            } else {
                openRestoNav();
            }
        }

        function openRestoNav() {
            const drawer = document.getElementById('resto-nav-drawer');
            const overlay = document.getElementById('resto-nav-overlay');
            drawer.style.transform = 'translateX(0%)';
            overlay.style.opacity = '1';
            overlay.style.visibility = 'visible';
            document.body.style.overflow = 'hidden';
        }

        function closeRestoNav() {
            const drawer = document.getElementById('resto-nav-drawer');
            const overlay = document.getElementById('resto-nav-overlay');
            drawer.style.transform = 'translateX(100%)';
            overlay.style.opacity = '0';
            overlay.style.visibility = 'hidden';
            document.body.style.overflow = '';
        }

        // Waiter Call Action
        function callWaiter(kebutuhan) {
            showToast(`🔔 Panggilan pramusaji "${kebutuhan}" terkirim ke smartwatch runner Meja #04!`, 'fa-bell');
        }

        // Sinkron KDS Action
        function syncKDSData() {
            const icon = document.getElementById('iconSync');
            icon.classList.add('fa-spin');
            setTimeout(() => {
                icon.classList.remove('fa-spin');
                showToast('✅ Data KDS & POS Server 02 berhasil disinkronkan secara real-time!', 'fa-arrows-rotate');
            }, 800);
        }

        // History Toast
        function showHistoryToast() {
            showToast('📋 Riwayat Meja #04: 1 Pesanan Aktif (#ORD-8821), 0 Tertunda.', 'fa-clock-rotate-left');
        }

        // Receipt Modal
        function openReceiptModal() {
            document.getElementById('receiptModal').classList.remove('hidden');
        }

        function closeReceiptModal() {
            document.getElementById('receiptModal').classList.add('hidden');
        }

        // Print Action
        function printReceipt() {
            window.print();
        }

        // Download Invoice PDF
        function downloadInvoicePDF() {
            showToast('📄 Mengunduh e-Faktur Pajak PDF untuk Order #ORD-8821...', 'fa-file-pdf');
        }

        // Universal Toast Handler
        function showToast(message, iconClass = 'fa-circle-check') {
            const toast = document.getElementById('toastNotification');
            const msgEl = document.getElementById('toastMessage');
            const iconEl = document.getElementById('toastIcon');

            msgEl.textContent = message;
            iconEl.className = `fa-solid ${iconClass} text-emerald-400 text-base`;

            toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
                toast.classList.remove('translate-y-0', 'opacity-100');
            }, 3500);
        }
    </script>
</body>
</html>
