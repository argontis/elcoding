<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $center['name'] }} — {{ $center['headline'] }}</title>
    <meta name="description" content="Pusat reparasi spesialis laptop, PC desktop & komponen hardware motherboard terpercaya di Cabang Clean Jakarta. Diagnosa transparan, bergaransi resmi, dan pemantauan tiket real-time.">

    <!-- Google Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
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
                            950: '#172554',
                        },
                        tech: {
                            50: '#f0fdf4',
                            500: '#10b981',
                            600: '#059669',
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        /* Custom subtle scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.5; }
        }
        .pulse-live { animation: pulse-dot 2s infinite ease-in-out; }

        .card-hover {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -10px rgba(37, 99, 235, 0.12), 0 8px 16px -6px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col justify-between selection:bg-brand-500 selection:text-white">

    <!-- Toast Container -->
    <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

    <!-- Mobile Drawer Overlay -->
    <div id="mobileDrawerOverlay" onclick="toggleMobileDrawer()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 hidden transition-opacity"></div>

    <!-- Mobile Drawer Menu -->
    <div id="mobileDrawer" class="fixed inset-y-0 right-0 w-72 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 flex flex-col justify-between p-6">
        <div>
            <div class="flex items-center justify-between pb-5 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-brand-600 text-white flex items-center justify-center font-bold shadow-md shadow-brand-500/20">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div>
                        <div class="font-heading font-black text-sm text-slate-900 leading-tight">TechFix Pro</div>
                        <div class="text-[9px] font-extrabold text-brand-600 uppercase tracking-wider">Service Center</div>
                    </div>
                </div>
                <button onclick="toggleMobileDrawer()" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-500 hover:text-slate-800 flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <nav class="mt-6 flex flex-col space-y-1">
                <a href="{{ url('/ServiceCenter') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-brand-600 text-white">
                    <i class="fa-solid fa-house w-4 text-center"></i>
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
                <a href="{{ route('servicecenter.cek-biaya') }}" onclick="toggleMobileDrawer()" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:text-brand-600 transition">
                    <i class="fa-solid fa-tag text-emerald-500 w-4 text-center"></i>
                    <span>Cek Biaya &amp; Estimasi</span>
                </a>
            </nav>
        </div>

        <div class="pt-6 border-t border-slate-100 space-y-2">
            <button onclick="openBookingModal(); toggleMobileDrawer();" class="w-full py-2.5 px-4 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold shadow-md shadow-brand-600/20 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-calendar-plus"></i> Booking Servis Baru
            </button>
            <a href="{{ url('/techfix/dashboard') }}" class="w-full py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-shield-halved"></i> Masuk Tim Teknisi
            </a>
        </div>
    </div>

    <!-- ===================================================================
         1. TOP ANNOUNCEMENT / STATUS BAR (Sesuai Referensi Gambar)
         =================================================================== -->
    <div class="bg-white border-b border-slate-200/80 text-[11px] font-semibold text-slate-600 py-2 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-y-2">
            
            <!-- Left Info -->
            <div class="flex items-center gap-2 sm:gap-4 flex-wrap">
                <div class="flex items-center gap-1.5 text-emerald-600 font-bold bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200/60">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span>
                    <span>{{ $center['status'] }}</span>
                </div>
                <div class="hidden sm:flex items-center gap-1.5 text-slate-500">
                    <i class="fa-regular fa-clock text-slate-400"></i>
                    <span>Jam Operasional: <strong class="text-slate-700">{{ $center['jam_buka'] }}</strong></span>
                </div>
                <div class="hidden md:flex items-center gap-1.5 text-slate-500">
                    <i class="fa-solid fa-star text-amber-400"></i>
                    <span>Rating: <strong class="text-slate-700">{{ $center['rating'] }}</strong></span>
                </div>
            </div>

            <!-- Right Fast Badges -->
            <div class="flex items-center gap-2 sm:gap-3 flex-wrap text-[10px] font-bold text-slate-500">
                <span class="hidden lg:inline-flex items-center gap-1 bg-slate-100 px-2 py-0.5 rounded text-slate-600">
                    <i class="fa-solid fa-microchip text-brand-600"></i> {{ $center['unit_aktif'] }} Unit Sedang Dikerjakan
                </span>
                <span class="hidden md:inline-flex items-center gap-1 bg-slate-100 px-2 py-0.5 rounded text-slate-600">
                    <i class="fa-solid fa-check-double text-emerald-600"></i> 100% Suku Cadang Original
                </span>
                <span class="inline-flex items-center gap-1 bg-brand-50 text-brand-700 px-2 py-0.5 rounded border border-brand-200/60">
                    <i class="fa-solid fa-shield text-brand-600"></i> Garansi Resmi s/d 1 Tahun
                </span>
            </div>
        </div>
    </div>

    <!-- ===================================================================
         2. MAIN NAVBAR
         =================================================================== -->
    <header class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-40 px-4 sm:px-8 py-3.5 transition-all">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="{{ url('/ServiceCenter') }}" class="flex items-center gap-3 group shrink-0">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-brand-700 via-brand-600 to-indigo-600 text-white flex items-center justify-center text-lg shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform shrink-0">
                    <i class="fa-solid fa-microchip"></i>
                </div>
                <div class="whitespace-nowrap">
                    <div class="font-heading font-black text-base lg:text-lg text-slate-900 tracking-tight leading-none group-hover:text-brand-600 transition-colors whitespace-nowrap">
                        TechFix Pro Service Center
                    </div>
                    <div class="text-[9px] font-extrabold tracking-widest text-brand-600 uppercase mt-0.5 whitespace-nowrap">
                        {{ $center['branch'] }}
                    </div>
                </div>
            </a>

            <!-- Desktop Navigation Links (Persis Foto: Beranda Active Pill) -->
            <nav class="hidden lg:flex items-center gap-1 xl:gap-2 text-xs xl:text-sm font-semibold text-slate-600 shrink-0 whitespace-nowrap">
                <a href="{{ url('/ServiceCenter') }}" class="bg-brand-600 text-white px-4 py-2 rounded-xl font-bold shadow-xs flex items-center gap-1 whitespace-nowrap">
                    Beranda
                </a>
                <a href="{{ route('servicecenter.cek-tiket') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">
                    Cek Tiket Servis
                </a>
                <a href="{{ route('servicecenter.booking-servis') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">
                    Booking Servis
                </a>
                <a href="{{ route('servicecenter.katalog') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">
                    Katalog Produk &amp; Sparepart
                </a>
                <a href="{{ route('servicecenter.cek-biaya') }}" class="hover:text-brand-600 px-3 py-2 rounded-xl hover:bg-slate-50 transition whitespace-nowrap">
                    Cek Biaya &amp; Estimasi
                </a>
            </nav>

            <!-- Right Actions -->
            <div class="flex items-center gap-2 shrink-0 whitespace-nowrap">
                <!-- Masuk Tim / Teknisi -->
                <a href="{{ url('/techfix/dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition shadow-sm shrink-0 whitespace-nowrap">
                    <i class="fa-solid fa-shield-halved text-xs text-brand-400"></i>
                    <span class="hidden sm:inline">Masuk Tim</span>
                </a>

                <!-- Mobile Hamburger Toggle -->
                <button type="button" onclick="toggleMobileDrawer()" class="lg:hidden w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 flex flex-col items-center justify-center gap-1 transition shrink-0">
                    <span class="w-4 h-0.5 bg-slate-700 rounded"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded"></span>
                    <span class="w-4 h-0.5 bg-slate-700 rounded"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- ===================================================================
         3. HERO SECTION (Persis Desain Screenshot dengan 2 Kolom)
         =================================================================== -->
    <section class="py-10 lg:py-16 px-4 sm:px-8 bg-gradient-to-b from-white via-slate-50/60 to-slate-50 relative overflow-hidden">
        
        <!-- Ambient Backing Lights -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-brand-400/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 -right-32 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
            
            <!-- LEFT COLUMN: Headline & Features (Col 7) -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Tag Badges -->
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-200/80">
                        <i class="fa-solid fa-certificate text-brand-500"></i>
                        {{ $center['tagline'] }}
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600">
                        UNIT LAYANAN CEPAT &amp; LAB CLEAN
                    </span>
                </div>

                <!-- Main Title -->
                <h1 class="font-heading font-black text-3xl sm:text-4xl lg:text-5xl text-slate-900 tracking-tight leading-[1.15]">
                    Pusat Servis Laptop, PC &amp; Hardware Terpercaya di <span class="text-brand-600 underline decoration-brand-200 decoration-wavy decoration-2">Cabang Clean</span>
                </h1>

                <!-- Subtitle / Description -->
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-2xl">
                    {{ $center['subheadline'] }}
                </p>

                <!-- 4 Highlights Grid Pills (Persis Foto) -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-3 pt-1">
                    <div class="p-3 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-brand-600 flex items-center justify-center text-sm shrink-0 font-bold">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <div class="text-[11px] font-extrabold text-slate-800 leading-tight">Tiket Resmi</div>
                            <div class="text-[9px] text-slate-400 font-medium">Tracking Online</div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm shrink-0 font-bold">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div>
                            <div class="text-[11px] font-extrabold text-slate-800 leading-tight">Biaya Transparan</div>
                            <div class="text-[9px] text-slate-400 font-medium">Approval via WA</div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm shrink-0 font-bold">
                            <i class="fa-solid fa-microchip"></i>
                        </div>
                        <div>
                            <div class="text-[11px] font-extrabold text-slate-800 leading-tight">100% OEM</div>
                            <div class="text-[9px] text-slate-400 font-medium">Sparepart Original</div>
                        </div>
                    </div>

                    <div class="p-3 rounded-xl bg-white border border-slate-200/80 shadow-xs flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-sm shrink-0 font-bold">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div>
                            <div class="text-[11px] font-extrabold text-slate-800 leading-tight">Aman</div>
                            <div class="text-[9px] text-slate-400 font-medium">Garansi Resmi</div>
                        </div>
                    </div>
                </div>

                <!-- CTA Action Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-2">
                    <button onclick="openBookingModal()" class="px-6 py-3.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-heading font-extrabold text-sm shadow-lg shadow-brand-600/25 transition-all flex items-center justify-center gap-2 text-center">
                        <i class="fa-solid fa-calendar-plus"></i>
                        <span>Booking Servis Sekarang</span>
                    </button>
                    
                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo%20TechFix%20Pro%20Service%20Center%20Cabang%20Clean,%20saya%20ingin%20konsultasi%20masalah%20hardware%20laptop/PC." target="_blank" class="px-6 py-3.5 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 font-heading font-bold text-sm text-slate-700 transition flex items-center justify-center gap-2 text-center shadow-xs">
                        <i class="fa-brands fa-whatsapp text-emerald-500 text-base"></i>
                        <span>Konsultasi WhatsApp CS</span>
                    </a>
                </div>

                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 pt-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Teknisi Siaga di Laboratorium Cabang Clean</span>
                </div>
            </div>

            <!-- RIGHT COLUMN: Info Cara Cek Tiket via WhatsApp (Col 5) -->
            <div id="lacak-tiket" class="lg:col-span-5">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-xl shadow-slate-200/50 p-6 relative overflow-hidden">
                    
                    <!-- Header Card -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-extrabold uppercase bg-brand-50 text-brand-700 border border-brand-200">
                                INFORMASI TIKET SERVIS
                            </span>
                        </div>
                        <div class="text-[11px] font-bold text-emerald-600 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span>
                            Status Sistem: Aktif
                        </div>
                    </div>

                    <div class="mt-4">
                        <h2 class="font-heading font-black text-xl text-slate-900 tracking-tight">
                            Cara Cek Status Tiket Servis
                        </h2>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            Setelah unit Anda masuk ke bengkel, nomor tiket akan dikirimkan otomatis via WhatsApp. Pantau progres langsung melalui CS kami.
                        </p>
                    </div>

                    <!-- Step Info Cards -->
                    <div class="mt-5 space-y-3">
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="w-7 h-7 rounded-full bg-brand-100 text-brand-700 font-black text-xs flex items-center justify-center shrink-0 mt-0.5">1</div>
                            <div>
                                <div class="text-xs font-bold text-slate-800">Terima Nomor Tiket</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Nomor tiket format <span class="font-mono font-bold text-brand-700">SRV-YYYY-XXXX</span> dikirim otomatis ke WhatsApp Anda saat unit diterima kasir.</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="w-7 h-7 rounded-full bg-brand-100 text-brand-700 font-black text-xs flex items-center justify-center shrink-0 mt-0.5">2</div>
                            <div>
                                <div class="text-xs font-bold text-slate-800">Hubungi CS via WhatsApp</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Kirim nomor tiket Anda ke CS kami. Tim akan membalas dengan status terkini, nama teknisi, dan estimasi selesai.</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="w-7 h-7 rounded-full bg-brand-100 text-brand-700 font-black text-xs flex items-center justify-center shrink-0 mt-0.5">3</div>
                            <div>
                                <div class="text-xs font-bold text-slate-800">Notifikasi Otomatis</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Anda akan mendapat notifikasi WA otomatis setiap status berubah — dari diagnosa, approval, hingga siap diambil.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Contoh Tiket Statis -->
                    <div class="mt-4 p-4 rounded-xl bg-brand-50 border border-brand-200/80 space-y-2">
                        <div class="text-[10px] font-extrabold uppercase tracking-wider text-brand-600 mb-2">Contoh Tampilan Status Tiket</div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-extrabold text-brand-700 font-mono bg-brand-100/70 px-2 py-0.5 rounded">
                                Tiket: {{ $sampleTicket['kode'] }}
                            </span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-100 text-amber-800 border border-amber-200">
                                {{ $sampleTicket['status'] }}
                            </span>
                        </div>
                        <div class="text-xs font-bold text-slate-800">{{ $sampleTicket['unit'] }}</div>
                        <div class="text-[11px] text-slate-500">{{ $sampleTicket['tindakan'] }}</div>
                        <div class="w-full h-1.5 bg-slate-200 rounded-full overflow-hidden mt-1">
                            <div class="h-full bg-gradient-to-r from-brand-600 to-indigo-600 rounded-full" style="width: {{ $sampleTicket['progress'] }}%"></div>
                        </div>
                        <div class="text-[10px] text-slate-500">Progres: <strong class="text-brand-700">{{ $sampleTicket['progress'] }}%</strong> — Estimasi: <strong class="text-slate-700">{{ $sampleTicket['estimasi_selesai'] }}</strong></div>
                    </div>

                    <!-- WhatsApp Button -->
                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo%20TechFix%20Pro%20Service%20Center,%20saya%20ingin%20cek%20status%20tiket%20servis%20unit%20saya." target="_blank"
                       class="mt-4 w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-heading font-extrabold text-xs shadow-md shadow-emerald-600/20 transition">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>Cek Status Tiket via WhatsApp</span>
                    </a>

                </div>
            </div>

        </div>
    </section>

    <!-- ===================================================================
         4. KATEGORI LAYANAN HARDWARE UNGGULAN
         =================================================================== -->
    <section id="katalog-layanan" class="py-14 px-4 sm:px-8 max-w-7xl mx-auto w-full">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-brand-600 bg-brand-50 border border-brand-200/80 px-2.5 py-1 rounded-md">
                    SPESIALISASI BENGKEL CABANG CLEAN
                </span>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                    Kategori Layanan Hardware Unggulan
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-2xl">
                    Penanganan teknis profesional menggunakan part berkualitas, didokumentasikan melalui digital worksheet &amp; CCTV bench.
                </p>
            </div>
            <div class="hidden sm:flex items-center gap-2 text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-xl border border-emerald-200/80 shrink-0">
                <i class="fa-solid fa-video text-emerald-500"></i>
                <span>Bisa pengerjaan live via CCTV Bench &amp; Log Tiket</span>
            </div>
        </div>

        <!-- 4 Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($categories as $cat)
            <div class="card-hover bg-white rounded-2xl border border-slate-200/80 p-5 flex flex-col justify-between shadow-xs">
                <div>
                    <!-- Icon Box -->
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-tr {{ $cat['color'] }} text-white flex items-center justify-center text-lg shadow-md mb-4">
                        <i class="{{ $cat['icon'] }}"></i>
                    </div>

                    <!-- Title & Desc -->
                    <h3 class="font-heading font-black text-base text-slate-900 tracking-tight leading-snug">
                        {{ $cat['title'] }}
                    </h3>
                    <p class="text-[11px] text-slate-500 leading-relaxed mt-2">
                        {{ $cat['desc'] }}
                    </p>

                    <!-- Feature Bullet Points -->
                    <ul class="mt-4 space-y-2 border-t border-slate-100 pt-3">
                        @foreach($cat['features'] as $f)
                        <li class="flex items-start gap-2 text-[11px] text-slate-700 font-semibold leading-tight">
                            <i class="fa-solid fa-check text-brand-600 text-[10px] mt-0.5 shrink-0"></i>
                            <span>{{ $f }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Card Action Button -->
                <div class="mt-5 pt-3 border-t border-slate-100">
                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo%20TechFix%20Pro%20Service%20Center,%20saya%20ingin%20konsultasi%20layanan%20{{ urlencode($cat['action_tag']) }}." target="_blank"
                       class="w-full py-2 px-3 rounded-xl bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 font-bold text-xs border border-slate-200 hover:border-emerald-200 transition flex items-center justify-between">
                        <span>Konsultasi via WhatsApp</span>
                        <i class="fa-brands fa-whatsapp text-emerald-500"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         5. FOTO LABORATORIUM & WORKSHOP STANDAR PRESISI (Persis Foto)
         =================================================================== -->
    <section class="py-6 px-4 sm:px-8 max-w-7xl mx-auto w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            
            <!-- Photo 1: Microscope Micro-soldering -->
            <div class="rounded-2xl overflow-hidden border border-slate-200 relative group aspect-video sm:aspect-4/3 bg-slate-900">
                <img 
                    src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=800&q=80" 
                    alt="Mikroskop Rework Laboratorium" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent flex items-end p-4">
                    <div>
                        <span class="text-[9px] font-extrabold uppercase tracking-wider text-brand-300 bg-brand-950/80 px-2 py-0.5 rounded">STANDAR INDUSTRI</span>
                        <div class="text-xs font-bold text-white mt-1">Stasiun Stereo Mikroskop BGA Rework</div>
                    </div>
                </div>
            </div>

            <!-- Photo 2: PC Rig & Test Bench -->
            <div class="rounded-2xl overflow-hidden border border-slate-200 relative group aspect-video sm:aspect-4/3 bg-slate-900">
                <img 
                    src="https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&w=800&q=80" 
                    alt="PC Benchmark & Stress Testing Rig" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent flex items-end p-4">
                    <div>
                        <span class="text-[9px] font-extrabold uppercase tracking-wider text-emerald-300 bg-emerald-950/80 px-2 py-0.5 rounded">BENCHMARK LAB</span>
                        <div class="text-xs font-bold text-white mt-1">Stress Testing Voltase &amp; Thermal Runaway</div>
                    </div>
                </div>
            </div>

            <!-- Photo 3: Hardware Technician Cleanroom -->
            <div class="rounded-2xl overflow-hidden border border-slate-200 relative group aspect-video sm:aspect-4/3 bg-slate-900">
                <img 
                    src="https://images.unsplash.com/photo-1581092335397-9583fe92d232?auto=format&fit=crop&w=800&q=80" 
                    alt="Teknisi Hardware Bersertifikasi" 
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-90"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-transparent flex items-end p-4">
                    <div>
                        <span class="text-[9px] font-extrabold uppercase tracking-wider text-indigo-300 bg-indigo-950/80 px-2 py-0.5 rounded">TEKNISI BERSERTIFIKASI</span>
                        <div class="text-xs font-bold text-white mt-1">Penanganan Antistatik ESD Cleanroom</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ===================================================================
         6. ESTIMASI BIAYA SERVIS TERPOPULER (Persis Foto)
         =================================================================== -->
    <section id="biaya-servis" class="py-14 px-4 sm:px-8 max-w-7xl mx-auto w-full">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-brand-600 bg-brand-50 border border-brand-200/80 px-2.5 py-1 rounded-md">
                    PRICE ESTIMATE TRANSPARAN
                </span>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                    Estimasi Biaya Servis Terpopuler
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-2xl">
                    Biaya estimasi transparan, teknisi akan meminta konfirmasi approval Anda sebelum melakukan perbaikan unit.
                </p>
            </div>
            <div class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200 shrink-0">
                <i class="fa-solid fa-hand-holding-dollar text-brand-600"></i> Biaya Diagnosa Servis Rp 0 jika batal diperbaiki
            </div>
        </div>

        <!-- 4 Pricing Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($priceList as $p)
            <div class="card-hover bg-white rounded-2xl border border-slate-200/80 p-5 flex flex-col justify-between shadow-xs">
                <div>
                    <!-- Top Tag -->
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-[9px] font-extrabold uppercase tracking-wider {{ $p['tag_color'] }} px-2 py-0.5 rounded">
                            {{ $p['tag'] }}
                        </span>
                        <span class="text-[10px] font-bold text-slate-400">
                            {{ $p['category'] }}
                        </span>
                    </div>

                    <!-- Title -->
                    <h3 class="font-heading font-black text-base text-slate-900 tracking-tight leading-snug">
                        {{ $p['title'] }}
                    </h3>

                    <!-- Price -->
                    <div class="mt-3 flex items-baseline gap-2">
                        <span class="font-heading font-black text-2xl text-slate-900 tracking-tight">
                            {{ $p['price'] }}
                        </span>
                        <span class="text-xs text-slate-400 line-through">
                            {{ $p['original'] }}
                        </span>
                    </div>

                    <!-- Desc -->
                    <p class="text-[11px] text-slate-500 leading-relaxed mt-2.5">
                        {{ $p['desc'] }}
                    </p>

                    <!-- Features -->
                    <div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5 text-[11px] font-semibold text-slate-600">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-shield-check text-emerald-500 text-xs"></i>
                            <span>{{ $p['warranty'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock text-brand-500 text-xs"></i>
                            <span>{{ $p['duration'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Select Button -->
                <div class="mt-5 pt-3 border-t border-slate-100">
                    <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo%20TechFix%20Pro%20Service%20Center,%20saya%20ingin%20konsultasi%20layanan%20{{ urlencode($p['title']) }}." target="_blank"
                       class="w-full py-2.5 px-4 rounded-xl bg-emerald-50 hover:bg-emerald-600 text-emerald-700 hover:text-white font-bold text-xs transition duration-200 text-center flex items-center justify-center gap-2">
                        <i class="fa-brands fa-whatsapp"></i>
                        Konsultasi via WhatsApp
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         7. ALUR TERHUBUNG LANGSUNG KE BENGKEL & TEKNISI (5 Langkah)
         =================================================================== -->
    <section id="alur-servis" class="py-14 px-4 sm:px-8 bg-slate-100/70 border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto">
            
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-[10px] font-extrabold uppercase tracking-widest text-brand-600 bg-brand-50 border border-brand-200/80 px-2.5 py-1 rounded-md">
                    PROSES CEPAT &amp; TRANSPARAN
                </span>
                <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                    Alur Terhubung Langsung ke Bengkel &amp; Teknisi
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Sistem terintegrasi monitoring tiket digital dari kedatangan unit hingga serah terima di kasir.
                </p>
            </div>

            <!-- 5 Steps Flow -->
            <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($workflow as $w)
                <div class="bg-white rounded-2xl border border-slate-200 p-5 relative shadow-xs">
                    <!-- Step Badge -->
                    <div class="w-8 h-8 rounded-full bg-brand-600 text-white font-heading font-black text-sm flex items-center justify-center shadow-md shadow-brand-600/30 mb-3">
                        {{ $w['step'] }}
                    </div>

                    <h3 class="font-heading font-black text-sm text-slate-900 tracking-tight">
                        {{ $w['title'] }}
                    </h3>

                    <p class="text-[11px] text-slate-500 leading-relaxed mt-1.5">
                        {{ $w['desc'] }}
                    </p>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <!-- ===================================================================
         8. KEPUASAN PENGGUNA DI CABANG CLEAN (Testimoni)
         =================================================================== -->
    <section class="py-14 px-4 sm:px-8 max-w-7xl mx-auto w-full">
        
        <div class="mb-8">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-brand-600 bg-brand-50 border border-brand-200/80 px-2.5 py-1 rounded-md">
                TESTIMONI PELANGGAN REAL
            </span>
            <h2 class="font-heading font-black text-2xl sm:text-3xl text-slate-900 tracking-tight mt-2">
                Kepuasan Pengguna di Cabang Clean
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($testimonials as $t)
            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs flex flex-col justify-between">
                <div>
                    <!-- 5 Stars -->
                    <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                        @for($i=0; $i<$t['rating']; $i++)
                        <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>

                    <!-- Testimonial Content -->
                    <p class="text-xs text-slate-600 leading-relaxed italic">
                        "{{ $t['content'] }}"
                    </p>
                </div>

                <!-- User Meta -->
                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full {{ $t['color'] }} text-white font-bold text-xs flex items-center justify-center">
                        {{ $t['avatar'] }}
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800 leading-tight">{{ $t['name'] }}</div>
                        <div class="text-[10px] text-slate-400 mt-0.5">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         9. INFORMASI PENTING SEBELUM SERVIS (FAQ)
         =================================================================== -->
    <section id="faq-servis" class="py-10 px-4 sm:px-8 max-w-7xl mx-auto w-full">
        
        <div class="mb-6">
            <h2 class="font-heading font-black text-2xl text-slate-900 tracking-tight">
                Informasi Penting Sebelum Servis
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($faqs as $faq)
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-xs">
                <div class="flex items-start gap-3">
                    <div class="w-7 h-7 rounded-lg bg-brand-50 text-brand-600 flex items-center justify-center text-xs shrink-0 mt-0.5">
                        <i class="fa-solid fa-shield"></i>
                    </div>
                    <div>
                        <h3 class="font-heading font-extrabold text-sm text-slate-900">
                            {{ $faq['q'] }}
                        </h3>
                        <p class="text-[11px] text-slate-500 leading-relaxed mt-2">
                            {{ $faq['a'] }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- ===================================================================
         10. BOTTOM BANNER CALL TO ACTION (Persis Foto)
         =================================================================== -->
    <section class="py-10 px-4 sm:px-8 max-w-7xl mx-auto w-full">
        <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-brand-950 rounded-2xl p-6 sm:p-8 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-brand-600/30 border border-brand-500/40 text-brand-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div>
                    <h3 class="font-heading font-black text-lg sm:text-xl text-white tracking-tight">
                        Kunjungi Bengkel Cabang Clean Sekarang
                    </h3>
                    <p class="text-xs text-slate-300 mt-1">
                        {{ $center['alamat'] }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0 flex-wrap">
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo%20Teknisi%20Cabang%20Clean,%20saya%20ingin%20konsultasi%20langsung." target="_blank" class="px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs border border-white/20 transition flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                    <span>Chat Teknisi</span>
                </a>
                <a href="https://wa.me/{{ $center['no_whatsapp'] }}?text=Halo%20TechFix%20Pro%20Service%20Center,%20saya%20ingin%20reservasi%20kedatangan%20untuk%20servis%20unit." target="_blank" class="px-5 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-500 text-white font-heading font-extrabold text-xs shadow-md shadow-brand-600/30 transition flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span>Reservasi via WhatsApp</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ===================================================================
         11. FOOTER LENGKAP
         =================================================================== -->
    <footer class="bg-white border-t border-slate-200 mt-12 pt-12 pb-8 px-4 sm:px-8 text-slate-600 text-xs">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            
            <!-- Col 1: Brand Info -->
            <div class="space-y-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-brand-600 text-white flex items-center justify-center font-bold">
                        <i class="fa-solid fa-microchip"></i>
                    </div>
                    <div>
                        <div class="font-heading font-black text-sm text-slate-900 leading-none">TechFix Pro</div>
                        <div class="text-[9px] font-bold text-brand-600 uppercase">Hardware &amp; IT Lab</div>
                    </div>
                </div>
                <p class="text-[11px] text-slate-500 leading-relaxed">
                    Pusat layanan perbaikan spesialis laptop, PC desktop &amp; server bergaransi resmi di Cabang Cibubur.
                </p>
                <div class="text-[10px] text-slate-400">
                    Sistem Terintegrasi ERP TechFix Pro v2.4
                </div>
            </div>

            <!-- Col 2: Lokasi Cabang Cibubur -->
            <div>
                <h4 class="font-heading font-black text-slate-900 text-xs uppercase tracking-wider mb-3">
                    Lokasi Cabang Cibubur
                </h4>
                <p class="text-[11px] text-slate-500 leading-relaxed mb-2">
                    <strong class="text-slate-800">Azzahra Computer – ASUS Authorized Service Center (Cabang Cibubur)</strong><br>
                    Ruko Kranggan Permai Blok RT 16 No. 27, Jl. Alternatif Cibubur, Jatisampurna, Kota Bekasi, Jawa Barat 17431.
                </p>
                <div class="text-[11px] text-brand-600 font-semibold">
                    Operasional: 08:00 - 21:00 WIB
                </div>
            </div>

            <!-- Col 3: Layanan & Dukungan -->
            <div>
                <h4 class="font-heading font-black text-slate-900 text-xs uppercase tracking-wider mb-3">
                    Layanan &amp; Dukungan
                </h4>
                <ul class="space-y-2 text-[11px] text-slate-500">
                    <li><i class="fa-solid fa-phone text-slate-400 mr-1.5"></i> {{ $center['no_telepon'] }}</li>
                    <li><i class="fa-brands fa-whatsapp text-emerald-500 mr-1.5"></i> +62 811-9234-5555</li>
                    <li><i class="fa-solid fa-envelope text-slate-400 mr-1.5"></i> service@techfixpro.com</li>
                    <li><i class="fa-solid fa-headset text-slate-400 mr-1.5"></i> Customer Helpdesk 24 Jam</li>
                </ul>
            </div>

            <!-- Col 4: Akses Cepat Pengguna -->
            <div>
                <h4 class="font-heading font-black text-slate-900 text-xs uppercase tracking-wider mb-3">
                    Akses Cepat Pengguna
                </h4>
                <ul class="space-y-2 text-[11px] text-slate-500">
                    <li><a href="#lacak-tiket" class="hover:text-brand-600 transition">Cek Status Tiket Real-time</a></li>
                    <li><a href="{{ route('servicecenter.cek-biaya') }}" class="hover:text-brand-600 transition">Katalog Tarif &amp; Sparepart</a></li>
                    <li><a href="javascript:void(0)" onclick="openBookingModal()" class="hover:text-brand-600 transition">Booking Antrean Servis</a></li>
                    <li><a href="{{ url('/techfix/dashboard') }}" class="hover:text-brand-600 transition">Portal Teknisi &amp; Kasir</a></li>
                </ul>
            </div>
        </div>

        <div class="max-w-7xl mx-auto pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-400 gap-2">
            <div>
                &copy; {{ date('Y') }} TechFix Pro Service Center Cabang Clean. Hak cipta dilindungi undang-undang.
            </div>
            <div class="flex items-center gap-4">
                <span>Ketentuan Layanan</span>
                <span>Kebijakan Privasi</span>
                <span>Syarat Garansi</span>
            </div>
        </div>
    </footer>


    <!-- JAVASCRIPT: Drawer Toggle & Info Actions -->
    <script>
        function toggleMobileDrawer() {
            const drawer = document.getElementById('mobileDrawer');
            const overlay = document.getElementById('mobileDrawerOverlay');
            const isOpen = !drawer.classList.contains('translate-x-full');
            if (isOpen) {
                drawer.classList.add('translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
            } else {
                drawer.classList.remove('translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function openBookingModal() {
            const waNumber = '{{ $center['no_whatsapp'] ?? "6281192345555" }}';
            const message = encodeURIComponent('Halo TechFix Pro Service Center, saya ingin informasi konsultasi diagnosa & booking antrean servis.');
            window.open('https://wa.me/' + waNumber + '?text=' + message, '_blank');
        }
    </script>
</body>
</html>
