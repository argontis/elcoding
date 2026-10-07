<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Garage — Faktur & Digital Invoice Servis</title>
    <meta name="description" content="Sistem Faktur Kasir & Invoice Digital Bengkel L-Garage.">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        garage: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                            950: '#431407',
                        },
                        darkbase: {
                            800: '#1e232d',
                            900: '#14171f',
                            950: '#0c0e14',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        @keyframes statusPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.15); }
        }
        .pulse-live { animation: statusPulse 2s infinite ease-in-out; }

        /* Print Specific Styles */
        @media print {
            aside, header, footer, #invoice-form-column, #top-controls-bar {
                display: none !important;
            }
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            #invoice-preview-column {
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            #invoice-document-card {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="min-h-screen flex antialiased selection:bg-garage-500 selection:text-white">

    <!-- ============================================================== -->
    <!-- DESKTOP SIDEBAR -->
    <!-- ============================================================== -->
    <aside class="w-64 bg-darkbase-900 border-r border-slate-800 text-slate-300 flex flex-col fixed inset-y-0 left-0 z-30 transition-all duration-300">
        
        <!-- Logo & Brand Header -->
        <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800/80 bg-darkbase-950/60">
            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-600 to-garage-500 flex items-center justify-center text-white shadow-lg shadow-garage-600/30">
                    <i class="fa-solid fa-wrench text-lg"></i>
                </div>
                <div>
                    <div class="font-heading font-black text-xl tracking-tight text-white leading-tight">
                        L-GARAGE<span class="text-garage-500">.</span>
                    </div>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span>
                        <span class="text-[11px] font-semibold text-emerald-400">Workshop Buka</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Workshop Info Plate -->
        <div class="p-4 mx-4 my-4 rounded-xl bg-slate-800/50 border border-slate-700/50 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-garage-500/10 text-garage-400 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Cabang Utama</div>
                    <div class="text-xs font-bold text-white">Bengkel BSE</div>
                </div>
            </div>
            <span class="px-2 py-0.5 text-[10px] font-bold bg-garage-500/20 text-garage-400 rounded-md border border-garage-500/30">
                PRO
            </span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <div class="px-3 pt-2 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Menu Utama
            </div>

            <!-- Dashboard -->
            <a href="{{ route('bengkel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-chart-pie w-5 text-center text-base"></i>
                <span>Dashboard</span>
            </a>

            <!-- Booking Servis -->
            <a href="{{ route('bengkel.booking') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-calendar-check w-5 text-center text-base"></i>
                <span>Booking Servis</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-slate-800 text-slate-400">0</span>
            </a>

            <!-- Antrean & Bay Servis -->
            <a href="{{ route('bengkel.antrean') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-car-side w-5 text-center text-base"></i>
                <span>Antrean PIT Bay</span>
                <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">4 Free</span>
            </a>

            <!-- Estimasi Biaya -->
            <a href="{{ route('bengkel.booking') }}#estimasi-section" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-file-invoice-dollar w-5 text-center text-base"></i>
                <span>Kalkulator Estimasi</span>
            </a>

            <div class="px-3 pt-5 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Operasional
            </div>

            <!-- Pelanggan & Kendaraan -->
            <a href="{{ route('bengkel.pelanggan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-id-card-clip w-5 text-center text-base"></i>
                <span>Pelanggan & Unit</span>
            </a>

            <!-- Work Order & Servis -->
            <a href="{{ route('bengkel.servis') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                <i class="fa-solid fa-screwdriver-wrench w-5 text-center text-base"></i>
                <span>Work Order & Servis</span>
            </a>

            <!-- Active: Kasir & Invoice -->
            <a href="{{ route('bengkel.invoice') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-bold text-sm bg-gradient-to-r from-garage-500 to-garage-600 text-white shadow-md shadow-garage-600/20">
                <i class="fa-solid fa-receipt w-5 text-center text-base"></i>
                <span>Kasir & Invoice</span>
                <span class="ml-auto text-[10px] font-bold px-2 py-0.5 rounded-full bg-white/20 text-white">Aktif</span>
            </a>
        </nav>

        <!-- Bottom Pit Bay Status Widget -->
        <div class="p-4 border-t border-slate-800/80 bg-darkbase-950/40">
            <div class="flex items-center justify-between text-xs mb-1.5">
                <span class="text-slate-400 font-semibold flex items-center gap-1.5">
                    <i class="fa-solid fa-file-invoice text-garage-500"></i> Sistem Kasir
                </span>
                <span class="text-emerald-400 font-bold">Online</span>
            </div>
            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full bg-garage-500 rounded-full" style="width: 100%"></div>
            </div>
            
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 px-3 rounded-lg text-xs font-bold text-rose-400 hover:text-white hover:bg-rose-500/20 border border-rose-500/30 transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- ============================================================== -->
    <!-- MAIN CONTENT AREA (WEBSITE DESKTOP FULL-WIDTH) -->
    <!-- ============================================================== -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        
        <!-- TOPBAR DESKTOP -->
        <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-20 px-8 flex items-center justify-between shadow-xs">
            
            <!-- Breadcrumbs & Quick Search -->
            <div class="flex items-center gap-6">
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400">
                        <a href="{{ route('bengkel.dashboard') }}" class="hover:text-garage-600 transition">L-Garage Workshop</a>
                        <i class="fa-solid fa-chevron-right text-[10px]"></i>
                        <span class="text-slate-700 font-bold">Faktur & Invoice Digital</span>
                    </div>
                    <h1 class="text-lg font-heading font-black text-slate-900 mt-0.5 flex items-center gap-2.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Faktur Pelunasan Servis & Kasir
                    </h1>
                </div>

                <!-- Global Search Input -->
                <div class="hidden lg:flex items-center relative w-80">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 text-slate-400 text-xs"></i>
                    <input 
                        type="text" 
                        placeholder="Cari no invoice, nama, plat..." 
                        class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium text-slate-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20 focus:border-garage-500 transition"
                    >
                </div>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-4">
                <!-- Status Badge -->
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-xs font-bold text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span>
                    <span>Kasir Siap Pakai</span>
                </div>

                <!-- Date Pill -->
                <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-100 border border-slate-200/80 text-xs font-semibold text-slate-600">
                    <i class="fa-regular fa-calendar text-garage-500"></i>
                    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Notification Bell -->
                <button type="button" class="relative w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition">
                    <i class="fa-regular fa-bell text-sm"></i>
                    <span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-garage-500"></span>
                </button>

                <!-- Profile Dropdown Plate -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-garage-500 to-amber-500 text-white font-black font-heading flex items-center justify-center shadow-md shadow-garage-500/20 text-sm">
                        {{ strtoupper(substr($user->name ?? 'L', 0, 1)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <div class="text-xs font-bold text-slate-800 leading-tight">
                            {{ $user->name ?? 'L-Garage Workshop' }}
                        </div>
                        <div class="text-[11px] font-semibold text-garage-600">
                            Role: {{ strtoupper($user->role ?? 'bengkel') }}
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <!-- PAGE CONTENT CONTAINER -->
        <main class="flex-1 p-8 space-y-8 max-w-[1600px] w-full mx-auto">
            
            <!-- 1. TOP HEADER BANNER & ACTION CONTROLS -->
            <div id="top-controls-bar" class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-600 text-white flex items-center justify-center text-xl shadow-md shadow-emerald-500/20">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-3">
                                <h2 class="text-2xl font-heading font-black text-slate-900 tracking-tight">
                                    Faktur & Digital Invoice L-Garage
                                </h2>
                                <span class="px-3 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200 text-xs font-bold flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Data Awal Kosong
                                </span>
                            </div>
                            <p class="text-slate-500 text-xs md:text-sm mt-1">
                                Form kasir pelunasan servis & faktur digital interaktif (silakan isi data di bawah atau muat contoh).
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons: Reset & Preset Demo -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <button 
                        type="button" 
                        onclick="loadDemoPreset()"
                        class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition flex items-center gap-2 border border-slate-200"
                        title="Isi contoh data sesuai tangkapan layar (Pak Budi Santoso)"
                    >
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i>
                        <span>Muat Contoh Seperti Gambar</span>
                    </button>

                    <button 
                        type="button" 
                        onclick="resetInvoiceForm()"
                        class="px-4 py-2.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold text-xs transition flex items-center gap-2 border border-rose-200"
                    >
                        <i class="fa-solid fa-trash-can"></i>
                        <span>Kosongkan Semua</span>
                    </button>
                </div>
            </div>

            <!-- 2. TWO-COLUMNS DESKTOP LAYOUT (FORM BUILDER VS PREVIEW DOKUMEN FAKTUR) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- ====================================================== -->
                <!-- LEFT COLUMN: FORM GENERATOR INVOICE (5 COLUMNS) -->
                <!-- ====================================================== -->
                <div id="invoice-form-column" class="lg:col-span-5 space-y-6">
                    
                    <!-- Card 1: Pengaturan Dokumen & Status -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-sliders text-garage-500"></i>
                                Informasi Dokumen & Kasir
                            </h3>
                            <span class="text-[11px] font-bold text-slate-400">Step 1</span>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1.5">No. Dokumen Invoice</label>
                                <input 
                                    type="text" 
                                    id="input-doc-no" 
                                    value="#INV-{{ date('Y-m') }}-0482" 
                                    oninput="updateInvoicePreview()"
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                >
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1.5">Status Pembayaran</label>
                                <select 
                                    id="input-status" 
                                    onchange="updateInvoicePreview()"
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                >
                                    <option value="LUNAS / PAID" selected>🟢 LUNAS / PAID</option>
                                    <option value="MENUNGGU PEMBAYARAN">🟡 MENUNGGU BAYAR</option>
                                    <option value="DRAFT / ESTIMASI">⚪ DRAFT / ESTIMASI</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1.5">Metode Bayar</label>
                                <select 
                                    id="input-metode" 
                                    onchange="updateInvoicePreview()"
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                >
                                    <option value="QRIS BCA / Transfer" selected>QRIS BCA / Transfer</option>
                                    <option value="Tunai / Cash">Tunai / Cash</option>
                                    <option value="Debit Card Mandiri">Debit Card Mandiri</option>
                                    <option value="Debit Card BCA">Debit Card BCA</option>
                                    <option value="Kartu Kredit (EDC)">Kartu Kredit (EDC)</option>
                                </select>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1.5">Kode Transaksi</label>
                                <input 
                                    type="text" 
                                    id="input-trx" 
                                    value="TRX-8829103" 
                                    oninput="updateInvoicePreview()"
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-bold text-slate-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Identitas Pelanggan & Kendaraan (KOSONG SIAP DIISI) -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-user-car text-garage-500"></i>
                                Data Pelanggan & Mobil
                            </h3>
                            <span class="text-[11px] font-bold text-slate-400">Step 2</span>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1">
                                    Nama Pemilik Kendaraan <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="input-nama" 
                                    placeholder="Contoh: Pak Budi Santoso" 
                                    oninput="updateInvoicePreview()"
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                >
                            </div>

                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1">
                                    Nomor WhatsApp / HP <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="input-wa" 
                                    placeholder="Contoh: 0811-9234-XXXX" 
                                    oninput="updateInvoicePreview()"
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                >
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-1">
                                <div>
                                    <label class="text-xs font-bold text-slate-700 block mb-1">
                                        Merek & Model Unit <span class="text-rose-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="input-model" 
                                        placeholder="Contoh: Toyota Fortuner 2.8 VRZ" 
                                        oninput="updateInvoicePreview()"
                                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                    >
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-700 block mb-1">
                                        Nomor Plat Polisi <span class="text-rose-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="input-plat" 
                                        placeholder="Contoh: B 1849 SSG" 
                                        oninput="this.value = this.value.toUpperCase(); updateInvoicePreview();"
                                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono font-bold uppercase text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 pt-1">
                                <div>
                                    <label class="text-xs font-bold text-slate-700 block mb-1">Odometer Terakhir</label>
                                    <input 
                                        type="text" 
                                        id="input-odo" 
                                        placeholder="Contoh: 42.150 KM" 
                                        oninput="updateInvoicePreview()"
                                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                    >
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-slate-700 block mb-1">Nomor Rangka / VIN</label>
                                    <input 
                                        type="text" 
                                        id="input-vin" 
                                        placeholder="Contoh: MHKF83...921" 
                                        oninput="updateInvoicePreview()"
                                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-mono text-slate-800 placeholder-slate-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Tambah Rincian Jasa Mekanik -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-wrench text-blue-600"></i>
                                Pekerjaan & Jasa Mekanik
                            </h3>
                            <span class="text-[11px] font-bold text-blue-600" id="form-jasa-count">0 Item</span>
                        </div>

                        <!-- Input New Jasa -->
                        <div class="p-3.5 rounded-xl bg-blue-50/50 border border-blue-100 space-y-2.5">
                            <input 
                                type="text" 
                                id="new-jasa-title" 
                                placeholder="Nama Jasa (contoh: Paket Servis Berkala 40.000 KM)" 
                                class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs"
                            >
                            <div class="grid grid-cols-3 gap-2">
                                <input 
                                    type="text" 
                                    id="new-jasa-desc" 
                                    placeholder="Keterangan (contoh: Tune up, cek rem)" 
                                    class="col-span-2 px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs"
                                >
                                <input 
                                    type="number" 
                                    id="new-jasa-price" 
                                    placeholder="Biaya (Rp)" 
                                    class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-bold text-blue-700"
                                >
                            </div>
                            <button 
                                type="button" 
                                onclick="addJasaItem()" 
                                class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-lg transition flex items-center justify-center gap-1.5"
                            >
                                <i class="fa-solid fa-plus text-[10px]"></i> Tambahkan Jasa Ini
                            </button>
                        </div>

                        <!-- Active Jasa List -->
                        <div id="form-jasa-list" class="space-y-2">
                            <div class="text-[11px] text-slate-400 italic text-center py-2">Belum ada item jasa ditambahkan</div>
                        </div>
                    </div>

                    <!-- Card 4: Tambah Suku Cadang & Pelumas Resmi -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-boxes-stacked text-amber-600"></i>
                                Suku Cadang & Pelumas Resmi
                            </h3>
                            <span class="text-[11px] font-bold text-amber-600" id="form-part-count">0 Item</span>
                        </div>

                        <!-- Input New Part -->
                        <div class="p-3.5 rounded-xl bg-amber-50/50 border border-amber-100 space-y-2.5">
                            <input 
                                type="text" 
                                id="new-part-title" 
                                placeholder="Nama Sparepart (contoh: Brake Pad Original Toyota Front)" 
                                class="w-full px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs"
                            >
                            <div class="grid grid-cols-3 gap-2">
                                <input 
                                    type="text" 
                                    id="new-part-desc" 
                                    placeholder="Part No / Qty (contoh: 04465-0K360 • 1 Set)" 
                                    class="col-span-2 px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs"
                                >
                                <input 
                                    type="number" 
                                    id="new-part-price" 
                                    placeholder="Harga (Rp)" 
                                    class="px-3 py-2 bg-white border border-slate-200 rounded-lg text-xs font-bold text-amber-700"
                                >
                            </div>
                            <button 
                                type="button" 
                                onclick="addPartItem()" 
                                class="w-full py-2 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-lg transition flex items-center justify-center gap-1.5"
                            >
                                <i class="fa-solid fa-plus text-[10px]"></i> Tambahkan Sparepart Ini
                            </button>
                        </div>

                        <!-- Active Part List -->
                        <div id="form-part-list" class="space-y-2">
                            <div class="text-[11px] text-slate-400 italic text-center py-2">Belum ada suku cadang ditambahkan</div>
                        </div>
                    </div>

                    <!-- Card 5: Pajak PPN & Potongan Diskon -->
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <h3 class="font-heading font-bold text-slate-900 text-sm flex items-center gap-2">
                                <i class="fa-solid fa-percent text-garage-500"></i>
                                Pajak PPN (11%) & Loyalty Diskon
                            </h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4 items-center">
                            <label class="flex items-center gap-2.5 cursor-pointer p-3 bg-slate-50 rounded-xl border border-slate-200">
                                <input 
                                    type="checkbox" 
                                    id="input-ppn-active" 
                                    checked 
                                    onchange="updateInvoicePreview()"
                                    class="w-4 h-4 rounded text-garage-500 focus:ring-garage-500"
                                >
                                <div>
                                    <div class="text-xs font-bold text-slate-800">Kenakan PPN (11%)</div>
                                    <div class="text-[10px] text-slate-500">Pajak Pertambahan Nilai</div>
                                </div>
                            </label>

                            <div>
                                <label class="text-xs font-bold text-slate-700 block mb-1">Diskon / Loyalty Reward (Rp)</label>
                                <input 
                                    type="number" 
                                    id="input-diskon" 
                                    value="0" 
                                    min="0"
                                    oninput="updateInvoicePreview()"
                                    class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-rose-600 focus:bg-white focus:outline-none focus:ring-2 focus:ring-garage-500/20"
                                >
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ====================================================== -->
                <!-- RIGHT COLUMN: DIGITAL INVOICE PREVIEW (7 COLUMNS) -->
                <!-- ====================================================== -->
                <div id="invoice-preview-column" class="lg:col-span-7">
                    
                    <div class="sticky top-28">
                        
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 flex items-center justify-between">
                            <span>Tampilan Dokumen Faktur Digital</span>
                            <span class="text-emerald-600 font-semibold flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-live"></span> Live Render
                            </span>
                        </div>

                        <!-- INVOICE RECEIPT CARD CONTAINER (MATCHES SCREENSHOT) -->
                        <div id="invoice-document-card" class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden p-6 sm:p-8 space-y-6">
                            
                            <!-- 1. Top Document Header Bar -->
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <div>
                                    <div class="flex items-center gap-2 text-slate-400 text-xs font-bold">
                                        <i class="fa-solid fa-file-invoice text-blue-600"></i>
                                        <span>Nomor Dokumen</span>
                                    </div>
                                    <div id="preview-doc-no" class="text-xl sm:text-2xl font-black font-heading text-slate-900 tracking-tight mt-0.5">
                                        #INV-{{ date('Y-m') }}-0482
                                    </div>
                                    <div class="flex items-center gap-2 text-[11px] text-slate-400 mt-1">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>Pelunasan: <strong id="preview-pelunasan" class="text-slate-700">{{ \Carbon\Carbon::now()->translatedFormat('d M Y, H:i') }} WIB</strong></span>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <span id="preview-status-badge" class="px-3.5 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        LUNAS / PAID
                                    </span>
                                    <button type="button" class="mt-2 text-xs font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 ml-auto">
                                        <span>Rincian</span>
                                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- 2. Workshop Identity Letterhead -->
                            <div class="p-4 rounded-2xl bg-gradient-to-r from-orange-50/60 via-slate-50 to-blue-50/40 border border-slate-200/80 flex items-start justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="font-heading font-black text-lg text-slate-900 flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full bg-garage-500"></span>
                                        L-Garage Auto
                                    </div>
                                    <div class="text-xs text-slate-600 leading-relaxed max-w-sm">
                                        Kawasan Otomotif BSD City Blok A3 No. 12 Tangerang Selatan &bull; Telp: (021) 538-9921
                                    </div>
                                    <div class="text-[10px] text-slate-400 font-mono">
                                        Izin Usaha Bengkel: 9120/IU-BKL/BAP/2021
                                    </div>
                                </div>
                                <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl shadow-xs">
                                    <i class="fa-solid fa-car-tunnel"></i>
                                </div>
                            </div>

                            <!-- 3. Customer & Vehicle Info Boxes (Exact Screenshot Replication) -->
                            <div class="space-y-3">
                                <!-- Pemilik Kendaraan -->
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                    <div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pemilik Kendaraan</div>
                                        <div id="preview-nama" class="font-bold text-sm text-slate-900 mt-0.5">
                                            (Belum diisi)
                                        </div>
                                        <div id="preview-wa" class="text-xs text-slate-500 font-mono">
                                            --- (WA Aktif)
                                        </div>
                                    </div>
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center text-xs">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                </div>

                                <!-- Spesifikasi Unit -->
                                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between">
                                    <div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Spesifikasi Unit</div>
                                        <div id="preview-model" class="font-bold text-sm text-slate-900 mt-0.5">
                                            (Belum diisi)
                                        </div>
                                        <div class="text-xs text-slate-500 mt-0.5">
                                            Odo: <strong id="preview-odo" class="text-slate-700">0 KM</strong> &bull; VIN: <span id="preview-vin" class="font-mono text-[11px]">---</span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span id="preview-plat" class="px-2.5 py-1 rounded-md bg-slate-900 text-white font-mono font-bold text-xs tracking-wider shadow-xs">
                                            ---
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- 4. Rincian Jasa & Suku Cadang -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-heading font-black text-slate-900 text-base">
                                        Rincian Jasa & Suku Cadang
                                    </h4>
                                    <span id="preview-total-items-badge" class="text-xs font-bold text-slate-500">
                                        0 Item Pekerjaan
                                    </span>
                                </div>

                                <!-- Group A: Pekerjaan & Jasa Mekanik -->
                                <div class="space-y-2">
                                    <div class="text-xs font-black uppercase tracking-wider text-blue-700 flex items-center gap-1.5 pb-1 border-b border-blue-100">
                                        <i class="fa-solid fa-user-gear"></i> PEKERJAAN & JASA MEKANIK
                                    </div>
                                    <div id="preview-jasa-list" class="space-y-2 text-xs">
                                        <div class="text-slate-400 text-xs italic py-2 text-center bg-slate-50 rounded-lg">Belum ada item jasa ditambahkan</div>
                                    </div>
                                </div>

                                <!-- Group B: Suku Cadang & Pelumas Resmi -->
                                <div class="space-y-2 pt-2">
                                    <div class="text-xs font-black uppercase tracking-wider text-amber-700 flex items-center gap-1.5 pb-1 border-b border-amber-100">
                                        <i class="fa-solid fa-gears"></i> SUKU CADANG & PELUMAS RESMI
                                    </div>
                                    <div id="preview-part-list" class="space-y-2 text-xs">
                                        <div class="text-slate-400 text-xs italic py-2 text-center bg-slate-50 rounded-lg">Belum ada suku cadang ditambahkan</div>
                                    </div>
                                </div>
                            </div>

                            <!-- 5. Perhitungan Total Tagihan Final (Exact Screenshot Replication) -->
                            <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/90 space-y-2.5">
                                <div class="flex items-center justify-between text-xs text-slate-600">
                                    <span>Subtotal Biaya Jasa</span>
                                    <span id="preview-subtotal-jasa-val" class="font-bold text-slate-900">Rp 0</span>
                                </div>
                                <div class="flex items-center justify-between text-xs text-slate-600">
                                    <span>Subtotal Suku Cadang & Bahan</span>
                                    <span id="preview-subtotal-part-val" class="font-bold text-slate-900">Rp 0</span>
                                </div>
                                <div class="flex items-center justify-between text-xs text-slate-600">
                                    <span>PPN Pertambahan Nilai (11%)</span>
                                    <span id="preview-ppn-val" class="font-bold text-slate-900">Rp 0</span>
                                </div>
                                <div class="flex items-center justify-between text-xs text-emerald-700 font-bold">
                                    <span class="flex items-center gap-1">
                                        <i class="fa-solid fa-award"></i> Loyalty Tier Reward (Diskon)
                                    </span>
                                    <span id="preview-diskon-val">- Rp 0</span>
                                </div>

                                <!-- Grand Total Box -->
                                <div class="pt-3 border-t border-slate-200 flex items-center justify-between">
                                    <div>
                                        <div class="text-[11px] font-black uppercase tracking-wider text-slate-500">
                                            TOTAL TAGIHAN FINAL
                                        </div>
                                        <div class="text-[10px] text-slate-400">
                                            Termasuk Pajak & Biaya Garansi
                                        </div>
                                    </div>
                                    <div id="preview-grand-total-val" class="text-2xl sm:text-3xl font-heading font-black text-blue-700 tracking-tight">
                                        Rp 0
                                    </div>
                                </div>

                                <!-- Metode Pembayaran -->
                                <div class="mt-2 pt-2 border-t border-slate-200/60 flex items-center justify-between text-[11px] text-slate-500">
                                    <span class="flex items-center gap-1.5 font-medium">
                                        <i class="fa-solid fa-wallet text-garage-500"></i>
                                        Metode: <strong id="preview-metode-val" class="text-slate-800">QRIS BCA / Transfer</strong>
                                    </span>
                                    <span id="preview-trx-val" class="font-mono font-bold text-slate-600">TRX-8829103</span>
                                </div>
                            </div>

                            <!-- 6. Audit & Digital Verification Stamp -->
                            <div class="p-3.5 rounded-xl bg-slate-900 text-white flex items-center justify-between text-xs shadow-md">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center text-sm">
                                        <i class="fa-solid fa-shield-halved"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-white">Kepala Bengkel: Haryadi S.</div>
                                        <div class="text-[10px] text-slate-400">Stempel Digital Sah & Terekam</div>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 rounded bg-white/10 text-blue-300 font-mono text-[10px] font-bold tracking-wider border border-white/10">
                                    VERIFIED AUDIT
                                </span>
                            </div>

                            <!-- 7. Garansi Servis & Suku Cadang -->
                            <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-200 text-amber-950 flex items-start gap-3">
                                <div class="w-8 h-8 rounded-xl bg-amber-200/80 text-amber-800 flex items-center justify-center shrink-0 mt-0.5">
                                    <i class="fa-solid fa-shield text-sm"></i>
                                </div>
                                <div class="space-y-0.5 text-xs">
                                    <div class="font-bold text-amber-900">Garansi Servis & Suku Cadang Aktif</div>
                                    <div class="text-[11px] text-amber-800/90 leading-relaxed">
                                        Berlaku selama 1 Bulan atau 1.000 KM (mana yang tercapai lebih dulu). Bebas biaya inspeksi ulang jika ada keluhan rem atau pelumas.
                                    </div>
                                </div>
                            </div>

                            <!-- 8. Jadwal Servis Berkala Berikutnya -->
                            <div class="p-3.5 rounded-xl bg-blue-50/70 border border-blue-200/80 text-slate-800 flex items-center justify-between text-xs">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center">
                                        <i class="fa-regular fa-calendar-check"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-slate-400 uppercase font-semibold">Jadwal Servis Berkala Berikutnya</div>
                                        <div id="preview-next-servis" class="font-bold text-slate-900">
                                            {{ \Carbon\Carbon::now()->addMonths(6)->translatedFormat('d F Y') }} atau 52.000 KM
                                        </div>
                                    </div>
                                </div>
                                <i class="fa-regular fa-bell text-blue-600 text-sm"></i>
                            </div>

                            <!-- 9. ACTION BUTTONS (EXACT SCREENSHOT BUTTONS) -->
                            <div class="space-y-3 pt-2">
                                <!-- Kirim WhatsApp -->
                                <button 
                                    type="button" 
                                    onclick="sendInvoiceWhatsApp()" 
                                    class="w-full py-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 transition flex items-center justify-center gap-2 active:scale-95"
                                >
                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                    <span>Kirim Invoice via WhatsApp</span>
                                </button>

                                <!-- Unduh PDF & Cetak Faktur -->
                                <div class="grid grid-cols-2 gap-3">
                                    <button 
                                        type="button" 
                                        onclick="window.print()" 
                                        class="py-3.5 rounded-2xl bg-blue-900 hover:bg-blue-950 text-white font-bold text-xs sm:text-sm shadow-md transition flex items-center justify-center gap-2"
                                    >
                                        <i class="fa-solid fa-download"></i>
                                        <span>Unduh PDF</span>
                                    </button>

                                    <button 
                                        type="button" 
                                        onclick="window.print()" 
                                        class="py-3.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs sm:text-sm border border-slate-200 transition flex items-center justify-center gap-2"
                                    >
                                        <i class="fa-solid fa-print"></i>
                                        <span>Cetak Faktur</span>
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </main>

        <!-- FOOTER -->
        <footer class="mt-auto px-8 py-5 bg-white border-t border-slate-200 text-slate-400 text-xs flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>L-Garage Workshop System</strong> &bull; Modul Faktur & Invoice Kasir.
            </div>
            <div class="flex items-center gap-4 text-[11px] font-medium">
                <span>Versi 2.4.0 (Desktop Edition)</span>
                <span>&bull;</span>
                <span class="text-emerald-600 font-bold flex items-center gap-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Kasir POS L-Garage Ready
                </span>
            </div>
        </footer>

    </div>

    <!-- ============================================================== -->
    <!-- INTERACTIVE JAVASCRIPT LOGIC -->
    <!-- ============================================================== -->
    <script>
        let jasaItems = [];
        let partItems = [];

        function updateInvoicePreview() {
            const docNo = document.getElementById('input-doc-no').value || '#INV-XXXX';
            const status = document.getElementById('input-status').value;
            const metode = document.getElementById('input-metode').value;
            const trx = document.getElementById('input-trx').value || 'TRX-000000';
            const nama = document.getElementById('input-nama').value.trim();
            const wa = document.getElementById('input-wa').value.trim();
            const model = document.getElementById('input-model').value.trim();
            const plat = document.getElementById('input-plat').value.trim();
            const odo = document.getElementById('input-odo').value.trim();
            const vin = document.getElementById('input-vin').value.trim();
            const diskon = parseInt(document.getElementById('input-diskon').value || 0);
            const isPpnActive = document.getElementById('input-ppn-active').checked;

            // Update Header Values
            document.getElementById('preview-doc-no').innerText = docNo;
            document.getElementById('preview-metode-val').innerText = metode;
            document.getElementById('preview-trx-val').innerText = trx;

            // Status Badge
            const statusBadge = document.getElementById('preview-status-badge');
            if (status.includes('LUNAS')) {
                statusBadge.className = 'px-3.5 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-700 border border-emerald-200 flex items-center gap-1.5 shadow-2xs';
                statusBadge.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-500"></span> LUNAS / PAID';
            } else if (status.includes('MENUNGGU')) {
                statusBadge.className = 'px-3.5 py-1 rounded-full text-xs font-black bg-amber-100 text-amber-700 border border-amber-200 flex items-center gap-1.5 shadow-2xs';
                statusBadge.innerHTML = '<span class="w-2 h-2 rounded-full bg-amber-500"></span> MENUNGGU BAYAR';
            } else {
                statusBadge.className = 'px-3.5 py-1 rounded-full text-xs font-black bg-slate-100 text-slate-700 border border-slate-200 flex items-center gap-1.5 shadow-2xs';
                statusBadge.innerHTML = '<span class="w-2 h-2 rounded-full bg-slate-500"></span> DRAFT';
            }

            // Customer & Vehicle Preview
            document.getElementById('preview-nama').innerText = nama || '(Belum diisi)';
            document.getElementById('preview-wa').innerText = wa ? wa + ' (WA Aktif)' : '--- (WA Aktif)';
            document.getElementById('preview-model').innerText = model || '(Belum diisi)';
            document.getElementById('preview-plat').innerText = plat || '---';
            document.getElementById('preview-odo').innerText = odo || '0 KM';
            document.getElementById('preview-vin').innerText = vin || '---';

            // Calculate Subtotals
            let subtotalJasa = 0;
            jasaItems.forEach(item => subtotalJasa += item.price);

            let subtotalPart = 0;
            partItems.forEach(item => subtotalPart += item.price);

            const totalItemCount = jasaItems.length + partItems.length;
            document.getElementById('preview-total-items-badge').innerText = totalItemCount + ' Item Pekerjaan';
            document.getElementById('form-jasa-count').innerText = jasaItems.length + ' Item';
            document.getElementById('form-part-count').innerText = partItems.length + ' Item';

            // PPN & Grand Total
            const ppnNominal = isPpnActive ? Math.round((subtotalJasa + subtotalPart) * 0.11) : 0;
            const grandTotal = Math.max(0, (subtotalJasa + subtotalPart + ppnNominal) - diskon);

            const formatRupiah = (val) => 'Rp ' + val.toLocaleString('id-ID');

            document.getElementById('preview-subtotal-jasa-val').innerText = formatRupiah(subtotalJasa);
            document.getElementById('preview-subtotal-part-val').innerText = formatRupiah(subtotalPart);
            document.getElementById('preview-ppn-val').innerText = formatRupiah(ppnNominal);
            document.getElementById('preview-diskon-val').innerText = '- ' + formatRupiah(diskon);
            document.getElementById('preview-grand-total-val').innerText = formatRupiah(grandTotal);

            renderItemsList();
        }

        function renderItemsList() {
            // Render Jasa
            const jasaPreviewContainer = document.getElementById('preview-jasa-list');
            const jasaFormContainer = document.getElementById('form-jasa-list');

            if (jasaItems.length === 0) {
                jasaPreviewContainer.innerHTML = '<div class="text-slate-400 text-xs italic py-2 text-center bg-slate-50 rounded-lg">Belum ada item jasa ditambahkan</div>';
                jasaFormContainer.innerHTML = '<div class="text-[11px] text-slate-400 italic text-center py-2">Belum ada item jasa ditambahkan</div>';
            } else {
                jasaPreviewContainer.innerHTML = '';
                jasaFormContainer.innerHTML = '';

                jasaItems.forEach((jasa, idx) => {
                    // Preview item
                    const divPrev = document.createElement('div');
                    divPrev.className = 'flex items-start justify-between py-1.5 border-b border-slate-100 last:border-0';
                    divPrev.innerHTML = `
                        <div class="pr-2">
                            <div class="font-bold text-slate-900">${jasa.title}</div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-snug">${jasa.desc}</div>
                        </div>
                        <div class="font-heading font-black text-slate-900 whitespace-nowrap ml-4">
                            Rp ${jasa.price.toLocaleString('id-ID')}
                        </div>
                    `;
                    jasaPreviewContainer.appendChild(divPrev);

                    // Form item with delete button
                    const divForm = document.createElement('div');
                    divForm.className = 'p-2.5 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-between text-xs';
                    divForm.innerHTML = `
                        <div>
                            <div class="font-bold text-slate-800">${jasa.title}</div>
                            <div class="text-[10px] text-blue-700 font-bold">Rp ${jasa.price.toLocaleString('id-ID')}</div>
                        </div>
                        <button type="button" onclick="removeJasaItem(${idx})" class="w-6 h-6 rounded bg-rose-100 text-rose-600 hover:bg-rose-200 flex items-center justify-center transition">
                            <i class="fa-solid fa-xmark text-xs"></i>
                        </button>
                    `;
                    jasaFormContainer.appendChild(divForm);
                });
            }

            // Render Sparepart
            const partPreviewContainer = document.getElementById('preview-part-list');
            const partFormContainer = document.getElementById('form-part-list');

            if (partItems.length === 0) {
                partPreviewContainer.innerHTML = '<div class="text-slate-400 text-xs italic py-2 text-center bg-slate-50 rounded-lg">Belum ada suku cadang ditambahkan</div>';
                partFormContainer.innerHTML = '<div class="text-[11px] text-slate-400 italic text-center py-2">Belum ada suku cadang ditambahkan</div>';
            } else {
                partPreviewContainer.innerHTML = '';
                partFormContainer.innerHTML = '';

                partItems.forEach((part, idx) => {
                    // Preview item
                    const divPrev = document.createElement('div');
                    divPrev.className = 'flex items-start justify-between py-1.5 border-b border-slate-100 last:border-0';
                    divPrev.innerHTML = `
                        <div class="pr-2">
                            <div class="font-bold text-slate-900">${part.title}</div>
                            <div class="text-[11px] text-slate-500 mt-0.5 leading-snug">${part.desc}</div>
                        </div>
                        <div class="font-heading font-black text-slate-900 whitespace-nowrap ml-4">
                            Rp ${part.price.toLocaleString('id-ID')}
                        </div>
                    `;
                    partPreviewContainer.appendChild(divPrev);

                    // Form item with delete button
                    const divForm = document.createElement('div');
                    divForm.className = 'p-2.5 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-between text-xs';
                    divForm.innerHTML = `
                        <div>
                            <div class="font-bold text-slate-800">${part.title}</div>
                            <div class="text-[10px] text-amber-700 font-bold">Rp ${part.price.toLocaleString('id-ID')}</div>
                        </div>
                        <button type="button" onclick="removePartItem(${idx})" class="w-6 h-6 rounded bg-rose-100 text-rose-600 hover:bg-rose-200 flex items-center justify-center transition">
                            <i class="fa-solid fa-xmark text-xs"></i>
                        </button>
                    `;
                    partFormContainer.appendChild(divForm);
                });
            }
        }

        function addJasaItem() {
            const titleInput = document.getElementById('new-jasa-title');
            const descInput = document.getElementById('new-jasa-desc');
            const priceInput = document.getElementById('new-jasa-price');

            const title = titleInput.value.trim();
            const desc = descInput.value.trim() || 'Servis & Penyetelan Standar';
            const price = parseInt(priceInput.value || 0);

            if (!title || price <= 0) {
                alert('Silakan masukkan nama jasa mekanik dan biaya yang valid.');
                return;
            }

            jasaItems.push({ title, desc, price });
            titleInput.value = '';
            descInput.value = '';
            priceInput.value = '';

            updateInvoicePreview();
        }

        function removeJasaItem(index) {
            jasaItems.splice(index, 1);
            updateInvoicePreview();
        }

        function addPartItem() {
            const titleInput = document.getElementById('new-part-title');
            const descInput = document.getElementById('new-part-desc');
            const priceInput = document.getElementById('new-part-price');

            const title = titleInput.value.trim();
            const desc = descInput.value.trim() || 'Genuine Parts L-Garage OEM';
            const price = parseInt(priceInput.value || 0);

            if (!title || price <= 0) {
                alert('Silakan masukkan nama suku cadang dan harga yang valid.');
                return;
            }

            partItems.push({ title, desc, price });
            titleInput.value = '';
            descInput.value = '';
            priceInput.value = '';

            updateInvoicePreview();
        }

        function removePartItem(index) {
            partItems.splice(index, 1);
            updateInvoicePreview();
        }

        function resetInvoiceForm() {
            document.getElementById('input-nama').value = '';
            document.getElementById('input-wa').value = '';
            document.getElementById('input-model').value = '';
            document.getElementById('input-plat').value = '';
            document.getElementById('input-odo').value = '';
            document.getElementById('input-vin').value = '';
            document.getElementById('input-diskon').value = 0;
            document.getElementById('input-ppn-active').checked = true;

            jasaItems = [];
            partItems = [];

            updateInvoicePreview();
        }

        function loadDemoPreset() {
            document.getElementById('input-doc-no').value = '#INV-2024-10-0482';
            document.getElementById('input-status').value = 'LUNAS / PAID';
            document.getElementById('input-nama').value = 'Pak Budi Santoso';
            document.getElementById('input-wa').value = '0811-9234-XXXX';
            document.getElementById('input-model').value = 'Toyota Fortuner 2.8 VRZ';
            document.getElementById('input-plat').value = 'B 1849 SSG';
            document.getElementById('input-odo').value = '42.150 KM';
            document.getElementById('input-vin').value = 'MHKF83...921';
            document.getElementById('input-diskon').value = 102750;
            document.getElementById('input-ppn-active').checked = true;

            jasaItems = [
                {
                    title: 'Paket Servis Berkala 40.000 KM',
                    desc: 'Tune up, cek 32 titik keamanan & scan ECU',
                    price: 450000
                },
                {
                    title: 'Penggantian Kampas Rem (Depan & Belakang)',
                    desc: 'Bongkar pasang caliper, bleeding & cleaner',
                    price: 150000
                }
            ];

            partItems = [
                {
                    title: 'Brake Pad Original Toyota Front',
                    desc: 'Part No: 04465-0K360 • 1 Set',
                    price: 680000
                },
                {
                    title: 'Minyak Rem DOT 4 Prestone',
                    desc: 'High Boiling Point Formula • 2 Botol (300ml)',
                    price: 110000
                },
                {
                    title: 'Oli Mesin Full Synthetic 5W-40',
                    desc: 'Toyota Motor Oil (TMO) Diesel Low Ash • 7 Liter',
                    price: 1050000
                },
                {
                    title: 'Oil Filter & Gasket Plug Washer',
                    desc: 'Genuine OEM Filtration Set • 1 Unit',
                    price: 85000
                }
            ];

            updateInvoicePreview();
        }

        function sendInvoiceWhatsApp() {
            const docNo = document.getElementById('preview-doc-no').innerText;
            const nama = document.getElementById('input-nama').value.trim() || 'Pelanggan';
            const model = document.getElementById('input-model').value.trim() || 'Kendaraan';
            const plat = document.getElementById('input-plat').value.trim() || '-';
            const wa = document.getElementById('input-wa').value.replace(/[^0-9]/g, '');
            const grandTotal = document.getElementById('preview-grand-total-val').innerText;

            const msg = `*FAKTUR INVOICE RESMI L-GARAGE AUTO*%0A` +
                        `No. Dokumen: ${docNo}%0A` +
                        `Status: *LUNAS / PAID*%0A%0A` +
                        `Yth. ${nama}%0A` +
                        `Kendaraan: ${model} (${plat})%0A` +
                        `*Total Pembayaran: ${grandTotal}*%0A%0A` +
                        `Garansi Servis & Suku Cadang Aktif selama 1 Bulan atau 1.000 KM.%0A` +
                        `Terima kasih telah mempercayakan perawatan kendaraan Anda di L-Garage Auto BSD.`;

            const targetPhone = wa.startsWith('0') ? '62' + wa.substring(1) : (wa || '628119234000');
            window.open(`https://wa.me/${targetPhone}?text=${msg}`, '_blank');
        }

        // Initialize preview on load
        document.addEventListener('DOMContentLoaded', () => {
            updateInvoicePreview();
        });
    </script>

</body>
</html>
