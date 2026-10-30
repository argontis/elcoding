<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi Reservasi Meja &amp; Denah — {{ $restaurant['name'] }}</title>
    <meta name="description" content="Pusat informasi resmi reservasi meja, ketersediaan slot, tata letak area, dan panduan booking santap di RestoHub Bistro Cabang Clean.">

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
         2. HEADER & NAVBAR (Reservasi Meja Active Pill)
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
                
                <div class="hidden xl:flex items-center gap-1.5 pl-3 border-l border-stone-200 text-xs">
                    <span class="font-bold text-slate-700">{{ $restaurant['branch'] }}</span>
                    <span class="text-[10px] bg-stone-100 text-slate-600 px-1.5 py-0.5 rounded border border-stone-200 font-semibold">Dine-in</span>
                    <span class="text-[10px] bg-amber-50 text-amber-800 px-1.5 py-0.5 rounded border border-amber-200 font-bold">{{ $restaurant['active_table']['number'] }}</span>
                </div>
            </div>

            <!-- Desktop Nav Links (Selalu Kesamping / No-Wrap) -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs xl:text-sm font-semibold text-slate-600 whitespace-nowrap shrink-0">
                <a href="{{ url('/restaurant') }}" class="hover:text-[#b84221] px-2.5 xl:px-3 py-2 rounded-xl hover:bg-stone-50 transition whitespace-nowrap">
                    Beranda
                </a>
                <a href="{{ route('resto.menu') }}" class="hover:text-[#b84221] px-2.5 xl:px-3 py-2 rounded-xl hover:bg-stone-50 transition whitespace-nowrap">
                    Menu Digital &amp; Order
                </a>
                <a href="{{ route('resto.reservasi') }}" class="bg-[#b84221] text-white px-3.5 xl:px-4 py-2 rounded-xl font-bold shadow-xs flex items-center gap-1 whitespace-nowrap">
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
                    <span class="font-heading font-extrabold text-base text-slate-900">RestoHub Bistro</span>
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
                <a href="{{ route('resto.reservasi') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-[#b84221] text-white font-bold">
                    <i class="fa-solid fa-calendar-check w-4 text-center text-white"></i>
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
                        Pusat Informasi Resmi Reservasi Meja &amp; Tata Tertib Kunjungan
                    </span>
                    <span class="text-[9px] font-extrabold bg-amber-200/80 text-amber-900 px-2 py-0.5 rounded-full border border-amber-300">
                        Informasi Publik Bersih
                    </span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Halaman ini berfungsi sebagai <strong>Pusat Informasi Terbuka</strong> untuk memeriksa ketersediaan meja, melihat denah area tempat duduk (Indoor AC, Semi-Outdoor, Private VIP Room), serta merencanakan jadwal santap keluarga atau rapat kerja tanpa pungutan biaya pemesanan (Bebas DP).
                </p>
            </div>
        </div>
    </div>

    <!-- ===================================================================
         4. METRIK KAPASITAS & STATUS REAL-TIME MEJA
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
            <div class="bg-white border border-stone-200 rounded-3xl p-4 shadow-2xs space-y-1">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Kapasitas Total</div>
                <div class="font-heading font-black text-xl text-slate-900">{{ $tableStats['total_meja'] }} Meja</div>
                <div class="text-[10px] text-slate-500">{{ $tableStats['total_kursi'] }} Kursi Tersedia</div>
            </div>
            <div class="bg-white border border-stone-200 rounded-3xl p-4 shadow-2xs space-y-1">
                <div class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Meja Siap Pakai
                </div>
                <div class="font-heading font-black text-xl text-emerald-700">{{ $tableStats['meja_siap'] }} Meja</div>
                <div class="text-[10px] text-slate-500">Walk-in Langsung Ready</div>
            </div>
            <div class="bg-white border border-stone-200 rounded-3xl p-4 shadow-2xs space-y-1">
                <div class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">Meja Terisi</div>
                <div class="font-heading font-black text-xl text-slate-900">{{ $tableStats['meja_terisi'] }} Meja</div>
                <div class="text-[10px] text-slate-500">Sedang Bersantap Aktif</div>
            </div>
            <div class="bg-white border border-stone-200 rounded-3xl p-4 shadow-2xs space-y-1">
                <div class="text-[10px] font-bold text-[#b84221] uppercase tracking-wider">Konfirmasi Booking</div>
                <div class="font-heading font-black text-xl text-slate-900">{{ $tableStats['booking_sla'] }}</div>
                <div class="text-[10px] text-slate-500">Via WhatsApp Concierge</div>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         5. PUSAT INFORMASI PILIHAN AREA & FASILITAS MEJA (3 Area)
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <div class="space-y-1">
            <span class="text-[10px] font-extrabold tracking-widest text-[#b84221] uppercase">
                DENAH &amp; SUASANA TEMPAT DUDUK
            </span>
            <h2 class="text-2xl sm:text-3xl font-black text-slate-900 font-heading tracking-tight">
                Pilihan Area Sesuai Kebutuhan Anda
            </h2>
            <p class="text-xs sm:text-sm text-slate-500 max-w-xl leading-relaxed">
                Setiap zona meja dirancang dengan karakteristik kenyamanan yang spesifik untuk menjamin momen bersantap Anda berlangsung optimal.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($areas as $area)
            <div class="bg-white rounded-3xl border border-stone-200 overflow-hidden shadow-xs hover:shadow-md transition-all flex flex-col justify-between group">
                <div>
                    <!-- Photo Header -->
                    <div class="relative h-48 w-full overflow-hidden bg-stone-100">
                        <img src="{{ $area['image'] }}" alt="{{ $area['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 text-[10px] font-extrabold px-3 py-1 rounded-full shadow-xs {{ $area['badge_color'] }}">
                            {{ $area['badge'] }}
                        </span>
                    </div>

                    <!-- Details -->
                    <div class="p-5 space-y-3">
                        <h3 class="font-heading font-extrabold text-base text-slate-900 group-hover:text-[#b84221] transition-colors">
                            {{ $area['name'] }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            {{ $area['desc'] }}
                        </p>

                        <div class="pt-2 border-t border-stone-100 space-y-1.5 text-xs text-slate-700">
                            @foreach($area['features'] as $feat)
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-[11px]"></i>
                                <span class="text-[11px] font-medium">{{ $feat }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="p-5 pt-0">
                    <button type="button" onclick="selectAreaOption('{{ $area['name'] }}')" class="w-full py-2.5 bg-stone-100 hover:bg-[#b84221] hover:text-white text-slate-700 font-bold text-xs rounded-xl border border-stone-200 transition flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-check text-[10px]"></i>
                        <span>Pilih Area Ini untuk Booking</span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         6. FORMULIR PENGAJUAN RESERVASI MEJA MANDIRI
         =================================================================== -->
    <section id="form-reservasi" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 border-b border-stone-100">
                <div class="space-y-1">
                    <span class="text-[10px] font-extrabold tracking-widest text-[#b84221] uppercase">
                        FORMULIR PENGAJUAN
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">
                        Rencanakan Kunjungan &amp; Reservasi Meja Anda
                    </h3>
                    <p class="text-xs text-slate-500">
                        Isi data kunjungan Anda. Sistem akan menyiapkan draf pesan terformat untuk dikirimkan langsung ke WhatsApp Concierge kami.
                    </p>
                </div>
                <div class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200 flex items-center gap-2 shrink-0">
                    <i class="fa-solid fa-shield-check"></i>
                    <span>Bebas Biaya DP (100% Gratis)</span>
                </div>
            </div>

            <form onsubmit="handleReservationSubmit(event)" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                    
                    <!-- Nama Lengkap -->
                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-700 block text-[11px]">Nama Lengkap Tamu *</label>
                        <input type="text" id="res_nama" required placeholder="Contoh: Dimas Wicaksono" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-[#b84221]">
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-700 block text-[11px]">Nomor WhatsApp Aktif *</label>
                        <input type="tel" id="res_wa" required placeholder="Contoh: 081234567890" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-[#b84221]">
                    </div>

                    <!-- Tanggal Kunjungan -->
                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-700 block text-[11px]">Tanggal Kunjungan *</label>
                        <input type="date" id="res_tanggal" required value="{{ date('Y-m-d') }}" class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:border-[#b84221]">
                    </div>

                    <!-- Waktu / Sesi -->
                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-700 block text-[11px]">Pilihan Sesi Jam *</label>
                        <select id="res_sesi" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:border-[#b84221]">
                            @foreach($timeSlots as $slot)
                            <option value="{{ $slot }}">{{ $slot }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah Tamu -->
                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-700 block text-[11px]">Jumlah Tamu (Pax) *</label>
                        <select id="res_tamu" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:border-[#b84221]">
                            <option value="1-2 Orang (Meja Couple)">1–2 Orang (Meja Pasangan / Santai)</option>
                            <option value="3-4 Orang (Meja Standar)" selected>3–4 Orang (Meja Standar Keluarga)</option>
                            <option value="5-8 Orang (Meja Panjang)">5–8 Orang (Meja Panjang Rombongan)</option>
                            <option value="10-20 Orang (VIP Room)">10–20 Orang (Private VIP Room)</option>
                            <option value="20-30 Orang (Full VIP Event)">20–30 Orang (Full VIP Meeting &amp; Event)</option>
                        </select>
                    </div>

                    <!-- Pilihan Area -->
                    <div class="space-y-1.5">
                        <label class="font-bold text-slate-700 block text-[11px]">Pilihan Zona Duduk *</label>
                        <select id="res_area" required class="w-full bg-stone-50 border border-stone-200 rounded-xl px-3.5 py-2.5 text-xs font-medium text-slate-800 focus:bg-white focus:outline-none focus:border-[#b84221]">
                            <option value="Indoor AC Dining Room">Indoor Dining Room (Full AC &amp; No Smoking)</option>
                            <option value="Semi-Outdoor Greenery">Semi-Outdoor Greenery (Taman &amp; Smoking Allowed)</option>
                            <option value="Private VIP Room">Private VIP Room (Ruang Rapat Akustik)</option>
                        </select>
                    </div>
                </div>

                <!-- Catatan Tambahan -->
                <div class="space-y-1.5 text-xs">
                    <label class="font-bold text-slate-700 block text-[11px]">Catatan Khusus / Permintaan Tambahan (Opsional)</label>
                    <textarea id="res_catatan" rows="2" placeholder="Contoh: Butuh 1 baby chair, meja dekat jendela taman, dan hidangan pembuka siap saji jam 19.00." class="w-full bg-stone-50 border border-stone-200 rounded-xl p-3 text-xs font-medium text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:border-[#b84221]"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4 pt-2 border-t border-stone-100">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i class="fa-solid fa-clock-rotate-left text-amber-600"></i>
                        <span>Toleransi kedatangan 15 menit dari jam reservasi tertera.</span>
                    </div>

                    <button type="submit" class="px-7 py-3 bg-[#b84221] hover:bg-[#a33315] text-white font-extrabold text-xs sm:text-sm rounded-xl shadow-xs transition flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>Kirim Reservasi ke WhatsApp Concierge</span>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- ===================================================================
         7. PUSAT INFORMASI KETENTUAN LAYANAN & TATA TERTIB
         =================================================================== -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 pb-3 border-b border-stone-100">
                <div class="w-9 h-9 rounded-xl bg-orange-100 text-[#b84221] flex items-center justify-center font-bold text-base">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div>
                    <h3 class="font-heading font-extrabold text-base sm:text-lg text-slate-900">
                        Informasi Kebijakan &amp; Fasilitas Reservasi Meja
                    </h3>
                    <p class="text-xs text-slate-500">
                        Pedoman resmi pelayanan reservasi demi kenyamanan bersama di RestoHub Bistro Cabang Clean.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-slate-600">
                <div class="space-y-1.5">
                    <div class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-user-clock text-amber-600"></i>
                        <span>Ketentuan Waktu Toleransi</span>
                    </div>
                    <p class="text-[11px] leading-relaxed text-slate-500">
                        Meja yang di-booking akan ditahan hingga 15 menit dari waktu sesi yang dipilih. Apabila terjadi keterlambatan tanpa konfirmasi, slot meja akan dialihkan ke daftar antrean walk-in berikutnya.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <div class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-people-group text-blue-600"></i>
                        <span>Reservasi Acara &amp; Rombongan</span>
                    </div>
                    <p class="text-[11px] leading-relaxed text-slate-500">
                        Untuk reservasi di atas 10 orang (Private VIP Room atau Meeting Korporasi), disarankan mengajukan reservasi minimal H-1 agar tim kami dapat mengatur set up meja dan alur hidangan pembuka secara eksklusif.
                    </p>
                </div>

                <div class="space-y-1.5">
                    <div class="font-bold text-slate-800 flex items-center gap-2">
                        <i class="fa-solid fa-baby text-emerald-600"></i>
                        <span>Fasilitas Anak &amp; Ibadah</span>
                    </div>
                    <p class="text-[11px] leading-relaxed text-slate-500">
                        Kami menyediakan kursi khusus balita (Baby Chair), musholla ber-AC yang bersih di lantai 1, stopkontak laptop di setiap meja, dan area parkir mobil/motor yang luas dengan petugas keamanan.
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

    <!-- Scripts -->
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

        function selectAreaOption(areaName) {
            const selectEl = document.getElementById('res_area');
            if (selectEl) {
                for (let i = 0; i < selectEl.options.length; i++) {
                    if (areaName.includes(selectEl.options[i].value)) {
                        selectEl.selectedIndex = i;
                        break;
                    }
                }
            }
            document.getElementById('form-reservasi').scrollIntoView({ behavior: 'smooth' });
        }

        function handleReservationSubmit(e) {
            e.preventDefault();
            const nama = document.getElementById('res_nama').value;
            const wa = document.getElementById('res_wa').value;
            const tanggal = document.getElementById('res_tanggal').value;
            const sesi = document.getElementById('res_sesi').value;
            const tamu = document.getElementById('res_tamu').value;
            const area = document.getElementById('res_area').value;
            const catatan = document.getElementById('res_catatan').value;

            const text = `Halo Concierge RestoHub Bistro Cabang Clean, saya ingin melakukan reservasi meja:%0A` +
                         `- Nama: ${nama}%0A` +
                         `- No. WhatsApp: ${wa}%0A` +
                         `- Tanggal: ${tanggal}%0A` +
                         `- Sesi Kunjungan: ${sesi}%0A` +
                         `- Jumlah Tamu: ${tamu}%0A` +
                         `- Pilihan Zona Duduk: ${area}%0A` +
                         `- Catatan: ${catatan || '-' }%0A%0A` +
                         `Mohon konfirmasi ketersediaan slot meja kami. Terima kasih!`;

            window.open(`https://wa.me/{{ $restaurant['whatsapp'] }}?text=${text}`, '_blank');
        }
    </script>
</body>
</html>
