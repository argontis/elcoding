<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Informasi Member &amp; Poin Loyalty — {{ $restaurant['name'] }}</title>
    <meta name="description" content="Pusat informasi resmi program keanggotaan, poin loyalty, tingkatan member, dan panduan penukaran reward di L-Coding Bistro Cabang Clean.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&family=Playfair+Display:ital,wght@1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bistro: {
                            50: '#fdf6f3', 100: '#fbece5', 200: '#f6d8cb',
                            300: '#efbba6', 400: '#e59577', 500: '#d7704e',
                            600: '#c2410c', 700: '#b84221', 800: '#9a3412',
                            900: '#7c2d12', 950: '#431407',
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
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #faf8f5; }
        ::-webkit-scrollbar-thumb { background: #d6d3d1; border-radius: 4px; }
        .shimmer-empty {
            background: linear-gradient(90deg, rgba(255,255,255,0.15) 25%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0.15) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.8s infinite;
        }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
        .reward-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .reward-card:hover { transform: translateY(-2px); box-shadow: 0 12px 28px -6px rgba(0,0,0,0.12); }
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
        .faq-item.open .faq-answer { max-height: 220px; }
        .faq-item.open .faq-icon { transform: rotate(180deg); }
        .faq-icon { transition: transform 0.3s ease; }
        .empty-pulse { animation: emptyPulse 3s ease-in-out infinite; }
        @keyframes emptyPulse { 0%,100% { opacity: 1; } 50% { opacity: 0.55; } }
        .gold-tier-card { background: linear-gradient(135deg, #fef3c7 0%, #fde68a 40%, #fbbf24 100%); box-shadow: 0 8px 32px -4px rgba(251,191,36,0.30); }
        .silver-tier-card { background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%); }
        .platinum-tier-card { background: linear-gradient(135deg, #faf5ff 0%, #ede9fe 50%, #ddd6fe 100%); }
    </style>
</head>
<body class="bg-[#faf8f5] text-slate-800 antialiased min-h-screen flex flex-col justify-between selection:bg-amber-100 selection:text-bistro-900">

    {{-- =====================================================================
         1. TOP ANNOUNCEMENT BAR
         ===================================================================== --}}
    <div class="bg-[#3e1708] text-white text-[11px] sm:text-xs py-2 px-4 border-b border-amber-950/40 font-medium">
        <div class="max-w-7xl mx-auto flex items-center justify-center sm:justify-start gap-2">
            <span class="text-amber-400">🎉</span>
            <span class="tracking-wide">
                <strong>Promo Opening Clean Branch:</strong> Diskon 20% Dine-In &amp; Free Welcome Artisan Brew! &bull; Jam Buka Hari Ini: 09.00 - 22.30 WIB
            </span>
        </div>
    </div>

    {{-- =====================================================================
         2. HEADER & NAVBAR — Member & Poin ACTIVE
         ===================================================================== --}}
    <header class="bg-white/95 backdrop-blur-md sticky top-0 z-40 border-b border-stone-200 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between gap-4">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <a href="{{ url('/restaurant') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-[#b84221] text-white flex items-center justify-center shadow-xs group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-utensils text-sm"></i>
                    </div>
                    <div>
                        <div class="font-heading font-extrabold text-base text-slate-900 leading-none">L-Coding Bistro</div>
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

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-1.5 text-xs xl:text-sm font-semibold text-slate-600">
                <a href="{{ url('/restaurant') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">Beranda</a>
                <a href="{{ route('resto.menu') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">Menu Digital &amp; Order</a>
                <a href="{{ route('resto.reservasi') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">Reservasi Meja</a>
                <a href="{{ route('resto.status') }}" class="hover:text-[#b84221] px-3 py-2 rounded-xl hover:bg-stone-50 transition">Status Pesanan (Live KDS)</a>
                <a href="{{ route('resto.member.info') }}" class="bg-[#b84221] text-white px-4 py-2 rounded-xl font-bold shadow-xs flex items-center gap-1.5">
                    <i class="fa-solid fa-crown text-amber-300 text-xs"></i>
                    Member &amp; Poin
                </a>
            </nav>

            {{-- Right action --}}
            <div class="flex items-center gap-2">
                <button type="button" onclick="alert('Hubungi kasir atau barista untuk mendaftarkan nomor Anda sebagai member L-Coding Gourmet Club. Gratis!')"
                        class="bg-[#b84221] hover:bg-[#a33315] text-white px-3.5 py-2 rounded-xl text-xs font-bold shadow-xs transition flex items-center gap-2">
                    <i class="fa-solid fa-crown text-amber-300"></i>
                    <div class="text-left leading-tight hidden sm:block">
                        <div class="text-[10px] font-medium text-amber-100">L-Coding Club</div>
                        <div class="text-xs font-black">Daftar Gratis</div>
                    </div>
                </button>
                <button id="resto-hamburger" onclick="toggleRestoNav()" class="lg:hidden w-9 h-9 rounded-xl bg-stone-100 hover:bg-stone-200 border border-stone-200 flex flex-col items-center justify-center gap-1 transition">
                    <span class="w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bar1"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bar2"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded transition-all duration-300" id="bar3"></span>
                </button>
            </div>
        </div>
    </header>

    {{-- Mobile Drawer --}}
    <div id="resto-nav-overlay" onclick="closeRestoNav()" class="lg:hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm" style="opacity:0;visibility:hidden;transition:opacity .25s ease,visibility .25s ease;"></div>
    <div id="resto-nav-drawer" class="lg:hidden fixed top-0 right-0 h-full w-[280px] z-50 bg-white shadow-2xl border-l border-stone-200 flex flex-col justify-between" style="transform:translateX(100%);transition:transform .3s cubic-bezier(.4,0,.2,1);">
        <div>
            <div class="flex items-center justify-between px-5 py-4 border-b border-stone-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-[#b84221] text-white flex items-center justify-center"><i class="fa-solid fa-utensils text-sm"></i></div>
                    <span class="font-heading font-extrabold text-base text-slate-900">L-Coding Bistro</span>
                </div>
                <button onclick="closeRestoNav()" class="w-8 h-8 rounded-lg bg-stone-100 text-slate-600 flex items-center justify-center"><i class="fa-solid fa-times text-sm"></i></button>
            </div>
            <nav class="p-4 space-y-1 text-sm font-semibold">
                <a href="{{ url('/restaurant') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50"><i class="fa-solid fa-house w-4 text-center"></i><span>Beranda</span></a>
                <a href="{{ route('resto.menu') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50"><i class="fa-solid fa-book-open w-4 text-center text-orange-600"></i><span>Menu Digital &amp; Order</span></a>
                <a href="{{ route('resto.reservasi') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50"><i class="fa-solid fa-calendar-check w-4 text-center text-amber-600"></i><span>Reservasi Meja</span></a>
                <a href="{{ route('resto.status') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-stone-50"><i class="fa-solid fa-display w-4 text-center text-emerald-600"></i><span>Status Pesanan (Live KDS)</span></a>
                <a href="{{ route('resto.member.info') }}" onclick="closeRestoNav()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-[#b84221] text-white font-bold"><i class="fa-solid fa-crown w-4 text-center text-amber-300"></i><span>Member &amp; Poin</span></a>
            </nav>
        </div>
        <div class="p-4 border-t border-stone-100 bg-stone-50">
            <a href="https://wa.me/{{ $restaurant['whatsapp'] }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-xs">
                <i class="fa-brands fa-whatsapp text-sm"></i><span>Hotline Concierge</span>
            </a>
        </div>
    </div>

    {{-- =====================================================================
         3. PUSAT INFORMASI RESMI BANNER
         ===================================================================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <div class="bg-gradient-to-r from-amber-50 via-stone-50 to-orange-50 border border-amber-200/90 rounded-3xl p-4 sm:p-5 flex items-start gap-4 shadow-2xs">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-[#9a3412] to-[#c2410c] text-white flex items-center justify-center shrink-0 mt-0.5 text-lg shadow-xs">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div class="space-y-1">
                <div class="flex items-center gap-2 flex-wrap">
                    <span class="font-heading font-extrabold text-sm sm:text-base text-slate-900 tracking-tight">
                        Pusat Informasi Resmi Program Member &amp; Poin Loyalty L-Coding Gourmet Club
                    </span>
                    <span class="text-[9px] font-extrabold bg-amber-200/80 text-amber-900 px-2 py-0.5 rounded-full border border-amber-300">Informasi Publik Bersih</span>
                </div>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Halaman ini berfungsi sebagai <strong>Pusat Informasi Terbuka</strong> program keanggotaan, mekanisme pengumpulan poin loyalty, tingkatan member, katalog penukaran reward, dan FAQ resmi di <strong>L-Coding Bistro Cabang Clean</strong>. Data poin pribadi Anda hanya bisa dilihat saat login atau melalui kasir.
                </p>
            </div>
        </div>
    </div>

    {{-- =====================================================================
         4. HERO SECTION
         ===================================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-5">
            <div class="space-y-1.5 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-100/70 border border-amber-200 rounded-full text-[11px] font-extrabold text-[#b84221] tracking-wider uppercase">
                    <i class="fa-solid fa-crown text-amber-500"></i> L-CODING GOURMET CLUB &bull; 3 TINGKATAN MEMBER
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 font-heading tracking-tight">
                    Program Member &amp; Poin Loyalty
                </h1>
                <p class="text-xs sm:text-sm text-slate-500 leading-relaxed">
                    Kumpulkan poin di setiap transaksi, naiki tingkatan eksklusif, dan tukar poin dengan reward menarik. Bergabung gratis — tanpa biaya pendaftaran apapun.
                </p>
            </div>
            <div class="bg-white border border-stone-200 rounded-2xl p-3 flex items-center gap-3 shadow-2xs shrink-0">
                <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-xs"><i class="fa-solid fa-star"></i></div>
                <div class="text-xs">
                    <div class="font-bold text-slate-800">1 Poin = Rp 10.000</div>
                    <div class="text-[10px] text-slate-400">Dikumpulkan otomatis tiap transaksi</div>
                </div>
            </div>
        </div>

        {{-- 4 Badges --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs"><span class="text-xl">🎁</span><div><div class="font-bold text-slate-800 text-[11px]">Pendaftaran Gratis</div><div class="text-[10px] text-slate-400">Tanpa biaya apapun</div></div></div>
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs"><span class="text-xl">⚡</span><div><div class="font-bold text-slate-800 text-[11px]">Poin Real-time</div><div class="text-[10px] text-slate-400">Update otomatis tiap bayar</div></div></div>
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs"><span class="text-xl">👑</span><div><div class="font-bold text-slate-800 text-[11px]">3 Tier Eksklusif</div><div class="text-[10px] text-slate-400">Silver, Gold, Platinum</div></div></div>
            <div class="bg-white border border-stone-200 rounded-2xl p-3.5 flex items-center gap-3 shadow-2xs"><span class="text-xl">🔄</span><div><div class="font-bold text-slate-800 text-[11px]">Tukar Kapan Saja</div><div class="text-[10px] text-slate-400">Reward beragam pilihan</div></div></div>
        </div>
    </section>

    {{-- =====================================================================
         5. KARTU MEMBER (EMPTY STATE)
         ===================================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6">
        <div class="rounded-3xl border border-amber-200/60 overflow-hidden shadow-md" style="background: linear-gradient(135deg, #3e1708 0%, #7c2d12 40%, #b84221 100%);">
            <div class="h-1 w-full bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500"></div>
            <div class="p-5 sm:p-7 text-white">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                    {{-- Avatar --}}
                    <div class="w-16 h-16 rounded-2xl bg-white/10 border-2 border-white/20 flex items-center justify-center shrink-0 empty-pulse">
                        <i class="fa-solid fa-user text-2xl text-white/40"></i>
                    </div>
                    {{-- Info Empty --}}
                    <div class="flex-1 space-y-2.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <div class="h-5 w-44 rounded-lg shimmer-empty"></div>
                            <span class="text-[10px] bg-amber-400/20 border border-amber-400/30 text-amber-200 px-2 py-0.5 rounded-full font-bold">— Belum Masuk —</span>
                        </div>
                        <div class="flex items-center gap-3 flex-wrap">
                            <div class="h-3 w-32 rounded shimmer-empty"></div>
                            <div class="h-3 w-24 rounded shimmer-empty"></div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="h-5 w-24 rounded-lg bg-amber-400/20 flex items-center justify-center"><span class="text-[10px] text-amber-200/60 font-semibold">Tier: —</span></div>
                            <span class="text-white/30 text-[10px]">→</span>
                            <div class="h-5 w-32 rounded-lg bg-white/10 flex items-center justify-center"><span class="text-[10px] text-white/40 font-semibold">Menuju: —</span></div>
                        </div>
                    </div>
                    {{-- CTA --}}
                    <div class="shrink-0">
                        <button onclick="alert('Hubungi kasir atau barista untuk mendaftarkan nomor Anda sebagai member L-Coding Gourmet Club. Gratis!')"
                                class="bg-amber-400 hover:bg-amber-300 text-amber-950 px-5 py-2.5 rounded-xl text-xs font-black shadow-lg transition flex items-center gap-2">
                            <i class="fa-solid fa-crown"></i> Daftar Member Gratis
                        </button>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="border-t border-white/10 mt-5 pt-5">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center">
                            <div class="text-[10px] text-white/50 uppercase tracking-wider mb-1 font-semibold">Poin Loyalty</div>
                            <div class="font-heading font-black text-3xl text-white/20">—</div>
                            <div class="text-[10px] text-white/40 mt-0.5">Belum terdaftar</div>
                        </div>
                        <div class="text-center border-x border-white/10">
                            <div class="text-[10px] text-white/50 uppercase tracking-wider mb-1 font-semibold">Voucher</div>
                            <div class="font-heading font-black text-3xl text-white/20">—</div>
                            <div class="text-[10px] text-white/40 mt-0.5">Belum terdaftar</div>
                        </div>
                        <div class="text-center">
                            <div class="text-[10px] text-white/50 uppercase tracking-wider mb-1 font-semibold">Kunjungan</div>
                            <div class="font-heading font-black text-3xl text-white/20">—</div>
                            <div class="text-[10px] text-white/40 mt-0.5">Belum terdaftar</div>
                        </div>
                    </div>
                </div>

                {{-- POS Note --}}
                <div class="mt-4 bg-white/5 border border-white/10 rounded-2xl px-4 py-3 flex items-center gap-3 text-[11px]">
                    <i class="fa-solid fa-circle text-emerald-400 text-[8px] animate-pulse"></i>
                    <span class="text-white/70">
                        <strong class="text-white/90">Koneksi Kasir POS Real-time:</strong> Daftarkan nomor telepon Anda ke kasir. Poin langsung terakumulasi di setiap transaksi berikutnya secara otomatis dalam 1 menit ke dompet ini.
                    </span>
                    <span class="ml-auto text-white/40 text-[10px] shrink-0 hidden sm:block">Sync ID: POS-CLR-MEMBER</span>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         6. REWARDS — TUKAR POIN
         ===================================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3">
            <div>
                <div class="text-[10px] font-extrabold text-[#b84221] uppercase tracking-widest mb-1">REWARDS EKSKLUSIF MEMBER</div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">Tukar Poin Loyalty Anda</h2>
                <p class="text-xs text-slate-500 mt-1">Poin dapat ditukarkan langsung ke kasir atau barista dengan menyebutkan nomor member Anda.</p>
            </div>
            <div class="flex items-center gap-2 bg-amber-50 border border-amber-200 rounded-2xl px-3 py-2 text-xs shrink-0">
                <i class="fa-solid fa-star text-amber-500 text-sm"></i>
                <div>
                    <div class="font-bold text-amber-900">Sisa Poin Anda</div>
                    <div class="text-amber-700 font-black text-base leading-none">— Poin</div>
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-1">
            <button onclick="filterRewards('all')" id="rf-all" class="reward-filter px-4 py-2 rounded-xl bg-[#b84221] text-white font-bold text-xs whitespace-nowrap shadow-xs">Semua Reward</button>
            <button onclick="filterRewards('diskon')" id="rf-diskon" class="reward-filter px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 font-bold text-xs whitespace-nowrap hover:bg-stone-50 transition">💸 Diskon</button>
            <button onclick="filterRewards('minuman')" id="rf-minuman" class="reward-filter px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 font-bold text-xs whitespace-nowrap hover:bg-stone-50 transition">☕ Minuman</button>
            <button onclick="filterRewards('dessert')" id="rf-dessert" class="reward-filter px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 font-bold text-xs whitespace-nowrap hover:bg-stone-50 transition">🍰 Dessert</button>
            <button onclick="filterRewards('merchandise')" id="rf-merchandise" class="reward-filter px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 font-bold text-xs whitespace-nowrap hover:bg-stone-50 transition">🛍️ Merchandise</button>
        </div>

        {{-- Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($rewardItems as $reward)
            <div class="reward-card bg-white border border-stone-200 rounded-3xl overflow-hidden shadow-2xs" data-cat="{{ $reward['category'] }}">
                <div class="h-1.5 w-full
                    @if($reward['category']==='diskon') bg-gradient-to-r from-amber-400 to-yellow-500
                    @elseif($reward['category']==='minuman') bg-gradient-to-r from-orange-400 to-amber-500
                    @elseif($reward['category']==='dessert') bg-gradient-to-r from-rose-400 to-pink-500
                    @else bg-gradient-to-r from-emerald-400 to-teal-500
                    @endif"></div>
                <div class="p-4 sm:p-5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-12 h-12 rounded-2xl bg-stone-50 border border-stone-100 flex items-center justify-center text-2xl">{{ $reward['icon'] }}</div>
                        <span class="text-[10px] font-bold px-2 py-1 rounded-xl {{ $reward['badge_color'] }}">{{ $reward['badge'] }}</span>
                    </div>
                    <h3 class="font-bold text-slate-900 text-sm leading-tight mb-1.5">{{ $reward['title'] }}</h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed mb-3">{{ $reward['desc'] }}</p>
                    <div class="flex items-center gap-1.5 text-[10px] text-slate-400 mb-4">
                        <i class="fa-solid fa-clock text-[9px]"></i>
                        <span>{{ $reward['note'] }}</span>
                    </div>
                    <div class="flex items-center justify-between border-t border-stone-100 pt-3">
                        <div>
                            <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wide">Tukar dengan</div>
                            <div class="font-heading font-black text-xl text-[#b84221]">{{ number_format($reward['poin']) }} <span class="text-sm font-bold text-slate-500">Poin</span></div>
                        </div>
                        <button onclick="alert('Tunjukkan halaman ini ke kasir dan sebutkan nomor member Anda untuk menukar poin dengan reward ini.')"
                                class="bg-[#b84221] hover:bg-[#a33315] text-white px-4 py-2 rounded-xl text-[11px] font-bold transition flex items-center gap-1.5 shadow-xs">
                            <i class="fa-solid fa-exchange-alt text-[10px]"></i>
                            Tukar {{ number_format($reward['poin']) }} Poin
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- =====================================================================
         7. TINGKATAN KEANGGOTAAN
         ===================================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 space-y-5">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
            <div>
                <div class="text-[10px] font-extrabold text-[#b84221] uppercase tracking-widest mb-1">PRIVILESE KEANGGOTAAN</div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">Tingkatan Level L-Coding Gourmet Club</h2>
            </div>
            <p class="text-xs text-slate-500 max-w-xs">Kumpulkan poin di setiap cangkir kopi dan hidangan santap hangat untuk membuka benefit eksklusif.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($memberTiers as $tier)
            <div class="relative rounded-3xl border overflow-hidden shadow-sm
                @if($tier['id']==='silver') silver-tier-card border-slate-200
                @elseif($tier['id']==='gold') gold-tier-card border-amber-300
                @else platinum-tier-card border-purple-200
                @endif">
                @if($tier['is_current'])
                <div class="absolute top-3 right-3 bg-[#b84221] text-white text-[9px] font-black px-2 py-1 rounded-full uppercase tracking-wider shadow-sm">{{ $tier['level_badge'] }}</div>
                @endif
                @if(isset($tier['locked']) && $tier['locked'])
                <div class="absolute top-3 right-3 w-7 h-7 rounded-full bg-white/60 border border-purple-200 flex items-center justify-center">
                    <i class="fa-solid fa-lock text-purple-400 text-[10px]"></i>
                </div>
                @endif
                <div class="p-5">
                    <div class="w-11 h-11 rounded-2xl flex items-center justify-center text-white text-lg mb-3 shadow-sm"
                         style="background: linear-gradient(135deg, {{ $tier['color_from'] }}, {{ $tier['color_to'] }})">
                        <i class="fa-solid {{ $tier['icon'] }}"></i>
                    </div>
                    <div class="font-heading font-black text-lg text-slate-900">{{ $tier['name'] }}</div>
                    <div class="text-[11px] text-slate-500 mb-3">{{ $tier['subtitle'] }}</div>
                    <ul class="space-y-1.5 mb-4">
                        @foreach($tier['benefits'] as $benefit)
                        <li class="flex items-center gap-2 text-xs text-slate-700">
                            <span class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 text-[9px]
                                @if($tier['id']==='silver') bg-slate-200 text-slate-600
                                @elseif($tier['id']==='gold') bg-amber-200 text-amber-800
                                @else bg-purple-200 text-purple-800
                                @endif">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            {{ $benefit }}
                        </li>
                        @endforeach
                    </ul>
                    <div class="border-t @if($tier['id']==='silver') border-slate-200/80 @elseif($tier['id']==='gold') border-amber-300/60 @else border-purple-200/60 @endif pt-3">
                        @if($tier['is_current'])
                        <div class="flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-[11px] font-bold text-emerald-700">Sedang Aktif (14 Kunjungan)</span>
                        </div>
                        @elseif(isset($tier['locked']))
                        <span class="text-[11px] text-purple-600 font-semibold">🔒 {{ $tier['status'] }}</span>
                        @else
                        <span class="text-[11px] text-slate-500 font-semibold">Status: {{ $tier['status'] }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- =====================================================================
         8. CARA KERJA SISTEM POIN
         ===================================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="bg-white border border-stone-200 rounded-3xl p-5 sm:p-7 shadow-2xs">
            <div class="text-center mb-6">
                <div class="text-[10px] font-extrabold text-[#b84221] uppercase tracking-widest mb-1">HOW IT WORKS</div>
                <h2 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">Cara Kerja Sistem Poin Loyalty</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div class="flex flex-col items-center text-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl font-black font-heading shadow-xs">01</div>
                    <div>
                        <div class="font-bold text-slate-900 text-sm mb-1">Daftar &amp; Transaksi</div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">Daftarkan nomor telepon ke kasir secara gratis. Setiap Rp 10.000 transaksi menghasilkan 1 Poin Loyalty otomatis.</p>
                    </div>
                </div>
                <div class="flex flex-col items-center text-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-700 flex items-center justify-center text-2xl font-black font-heading shadow-xs">02</div>
                    <div>
                        <div class="font-bold text-slate-900 text-sm mb-1">Kumpulkan Poin</div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">Poin terakumulasi setiap transaksi dine-in maupun takeaway. Cek saldo poin kapan saja di kasir atau tanya barista.</p>
                    </div>
                </div>
                <div class="flex flex-col items-center text-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-rose-100 text-rose-700 flex items-center justify-center text-2xl font-black font-heading shadow-xs">03</div>
                    <div>
                        <div class="font-bold text-slate-900 text-sm mb-1">Tukar Reward</div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">Pilih reward di katalog ini, sebutkan nomor member ke kasir, dan nikmati reward pilihan Anda langsung hari itu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         9. FAQ
         ===================================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 space-y-4">
        <div>
            <div class="text-[10px] font-extrabold text-[#b84221] uppercase tracking-widest mb-1">FAQ RESMI</div>
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 font-heading">Pertanyaan Umum Seputar Keanggotaan</h2>
        </div>
        <div class="space-y-3">
            @foreach($faqs as $i => $faq)
            <div class="faq-item bg-white border border-stone-200 rounded-2xl overflow-hidden shadow-2xs" id="faq-{{ $i }}">
                <button onclick="toggleFaq({{ $i }})" class="w-full flex items-center justify-between px-5 py-4 text-left gap-4">
                    <span class="font-semibold text-slate-900 text-sm">{{ $faq['q'] }}</span>
                    <i class="fa-solid fa-chevron-down faq-icon text-slate-400 text-xs shrink-0"></i>
                </button>
                <div class="faq-answer px-5">
                    <div class="text-xs text-slate-600 leading-relaxed pb-4 border-t border-stone-100 pt-3">{{ $faq['a'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- =====================================================================
         10. CTA
         ===================================================================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="rounded-3xl overflow-hidden text-white text-center" style="background: linear-gradient(135deg, #3e1708 0%, #7c2d12 55%, #b84221 100%);">
            <div class="px-6 py-10 sm:py-12 space-y-4">
                <div class="text-4xl mb-2">👑</div>
                <h2 class="font-heading font-black text-2xl sm:text-3xl">Bergabung ke L-Coding Gourmet Club</h2>
                <p class="text-sm text-white/70 max-w-md mx-auto leading-relaxed">
                    Daftar gratis dan mulai kumpulkan poin dari pesanan pertama Anda. Nikmati benefit eksklusif member dan reward yang terus bertambah.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                    <button onclick="alert('Pendaftaran member gratis! Silakan hubungi kasir atau barista di lokasi kami.')"
                            class="bg-amber-400 hover:bg-amber-300 text-amber-950 px-8 py-3 rounded-2xl font-black text-sm shadow-lg transition">
                        <i class="fa-solid fa-crown mr-2"></i> Daftar Member Gratis Sekarang
                    </button>
                    <a href="https://wa.me/{{ $restaurant['whatsapp'] }}" target="_blank"
                       class="bg-white/10 hover:bg-white/20 border border-white/20 text-white px-8 py-3 rounded-2xl font-bold text-sm transition">
                        <i class="fa-brands fa-whatsapp mr-2 text-emerald-400"></i> Tanya via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- =====================================================================
         11. FOOTER
         ===================================================================== --}}
    <footer id="footer-section" class="bg-stone-50 border-t border-stone-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">
                <div class="md:col-span-1 space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-xl bg-[#b84221] text-white flex items-center justify-center"><i class="fa-solid fa-utensils text-sm"></i></div>
                        <div><div class="font-heading font-black text-base text-slate-900">L-Coding Bistro</div><div class="text-[10px] text-slate-400">Artisanal Cafe</div></div>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">Sinergi kehangatan cita rasa bistro kontemporer dengan presisi racikan kopi artisanal khas L-Coding. Tempat bertemunya ide, aroma, dan keapuan kuliner hangat.</p>
                    <div class="text-xs text-slate-500"><i class="fa-solid fa-wifi text-[#b84221] mr-1"></i> <span class="font-semibold">WiFi:</span> L-Coding_Guest &bull; sedapnikmat2025</div>
                </div>
                <div class="space-y-2">
                    <div class="font-bold text-slate-900 text-sm mb-3">Lokasi &amp; Jam Operasional</div>
                    <p class="text-xs text-slate-500 leading-relaxed">{{ $restaurant['full_address'] }}</p>
                    <div class="space-y-1 text-xs text-slate-600">
                        <div><span class="font-semibold">Senin - Jumat</span> &nbsp; 09.00 - 22.30 WIB</div>
                        <div><span class="font-semibold">Sabtu - Minggu</span> &nbsp; 08.00 - 23.00 WIB</div>
                        <div class="text-[11px] text-slate-400">Dapur Terakhir (Last Order): 21.45 WIB</div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="font-bold text-slate-900 text-sm mb-3">Layanan &amp; Bantuan Cepat</div>
                    <div class="space-y-2 text-xs text-slate-600">
                        <div class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-600"></i><span>WhatsApp Hotline: +62 811-9233-889</span></div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-envelope text-[#b84221]"></i><span>Bantuan Reservasi Meja VIP &amp; Rapat</span></div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-receipt text-slate-500"></i><span>Kuitik, Saran &amp; Faktur Elektronik</span></div>
                        <div class="flex items-center gap-2"><i class="fa-solid fa-shield-halved text-emerald-600"></i><span>Standar Higienitas &amp; Halal Kitchen</span></div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="font-bold text-slate-900 text-sm mb-3">Keanggotaan &amp; Media</div>
                    <p class="text-xs text-slate-500 leading-relaxed">Kumpulkan L-Beans tiap transaksi, dapatkan hidangan penutup gratis di awal tahun Anda.</p>
                    <div class="flex items-center gap-2 text-xs text-slate-600"><i class="fa-brands fa-instagram text-pink-600"></i><span>@lcodingbistro</span><span class="text-slate-300">|</span><span class="font-bold text-[#b84221]">#SedapNikmat</span></div>
                    <div class="text-xs text-slate-500">Pembayaran didukung: QRIS, Visa/Mastercard, GoPay, OVO, ShopeePay</div>
                </div>
            </div>
            <div class="pt-6 border-t border-stone-200 flex flex-col sm:flex-row items-center justify-between gap-3 text-[11px] text-slate-400">
                <div>&copy; {{ date('Y') }} L-Coding Bistro &amp; Coffee. All rights reserved. Clean Branch Edition.</div>
                <div class="flex items-center gap-4">
                    <a href="javascript:void(0)" class="hover:text-slate-600">Ketentuan Layanan</a>
                    <a href="javascript:void(0)" class="hover:text-slate-600">Kebijakan Privasi</a>
                    <a href="javascript:void(0)" class="hover:text-slate-600">Katalog Allergen &amp; Gizi</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Nav
        const restoDrawer = document.getElementById('resto-nav-drawer');
        const restoOverlay = document.getElementById('resto-nav-overlay');
        const bar1 = document.getElementById('bar1'), bar2 = document.getElementById('bar2'), bar3 = document.getElementById('bar3');
        let navOpen = false;
        function openRestoNav() { restoDrawer.style.transform='translateX(0)'; restoOverlay.style.opacity='1'; restoOverlay.style.visibility='visible'; document.body.style.overflow='hidden'; bar1.style.transform='translateY(5px) rotate(45deg)'; bar2.style.opacity='0'; bar3.style.transform='translateY(-5px) rotate(-45deg)'; navOpen=true; }
        function closeRestoNav() { restoDrawer.style.transform='translateX(100%)'; restoOverlay.style.opacity='0'; restoOverlay.style.visibility='hidden'; document.body.style.overflow=''; bar1.style.transform=''; bar2.style.opacity='1'; bar3.style.transform=''; navOpen=false; }
        function toggleRestoNav() { navOpen ? closeRestoNav() : openRestoNav(); }
        document.addEventListener('keydown', e => { if (e.key==='Escape' && navOpen) closeRestoNav(); });

        // FAQ Accordion
        function toggleFaq(index) {
            const item = document.getElementById('faq-'+index);
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item.open').forEach(el => el.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }

        // Reward Filter
        function filterRewards(cat) {
            document.querySelectorAll('.reward-filter').forEach(btn => {
                btn.className = 'reward-filter px-4 py-2 rounded-xl bg-white border border-stone-200 text-slate-600 font-bold text-xs whitespace-nowrap hover:bg-stone-50 transition';
            });
            const active = document.getElementById('rf-'+cat);
            if (active) active.className = 'reward-filter px-4 py-2 rounded-xl bg-[#b84221] text-white font-bold text-xs whitespace-nowrap shadow-xs';
            document.querySelectorAll('[data-cat]').forEach(card => {
                card.style.display = (cat === 'all' || card.dataset.cat === cat) ? 'block' : 'none';
            });
        }
    </script>
</body>
</html>
