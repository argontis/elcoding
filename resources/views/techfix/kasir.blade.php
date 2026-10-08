<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir POS & Garansi — TechFix Pro</title>
    <meta name="description" content="Modul Kasir POS & Klaim Garansi Service Center TechFix Pro">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                        display: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        brand: { 50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',500:'#3b82f6',600:'#2563eb',700:'#1d4ed8',800:'#1e40af',900:'#1e3a8a',950:'#0f172a' }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #0f172a; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
        @keyframes pulse-ring { 0%{transform:scale(0.95);opacity:0.8;}50%{transform:scale(1.2);opacity:0.4;}100%{transform:scale(0.95);opacity:0.8;} }
        .pulse-beacon { animation: pulse-ring 2s infinite ease-in-out; }
        .nav-item-active { background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%); color: #fff; font-weight: 600; }
        .warranty-card { transition: all 0.2s ease; }
        .warranty-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px -4px rgba(15,23,42,0.08); }
        .tab-active { background: #1d4ed8; color: #fff; }
    </style>
</head>
<body class="min-h-screen flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed top-0 left-0 h-full z-40 shadow-sm">
        <div class="h-16 px-4 flex items-center border-b border-slate-200 gap-3">
            <div class="w-9 h-9 rounded-xl bg-brand-700 flex items-center justify-center shadow-sm flex-shrink-0">
                <i class="fa-solid fa-microchip text-white text-sm"></i>
            </div>
            <div>
                <div class="font-display font-bold text-slate-900 text-sm leading-tight">TechFix Pro</div>
                <div class="text-[10px] font-mono-code text-slate-400">Service Center OS v2.4</div>
            </div>
        </div>

        <div class="px-4 pt-4 pb-1">
            <div class="text-[9.5px] font-mono-code font-bold text-slate-400 uppercase tracking-widest">MODUL UTAMA</div>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 space-y-0.5">
            <a href="{{ route('techfix.dashboard') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-ticket-simple text-sm text-slate-400"></i>
                    <span>Tiket & Workbench</span>
                </div>
            </a>

            <a href="{{ route('techfix.tracking') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-regular fa-comment-dots text-sm text-slate-400"></i>
                    <span>Tracking & Approval WA</span>
                </div>
            </a>

            <!-- ACTIVE: Kasir POS & Garansi -->
            <a href="{{ route('techfix.kasir') }}" class="nav-item-active flex items-center justify-between px-3 py-2.5 rounded-lg text-xs transition-all shadow-sm">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-cash-register text-sm"></i>
                    <span>Kasir POS & Garansi</span>
                </div>
            </a>

                        <a href="{{ route('techfix.stok') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-boxes-stacked text-sm text-slate-400"></i>
                    <span>Stok Sparepart & Inv</span>
                </div>
            </a>

            <a href="{{ route('techfix.crm') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-user-gear text-sm text-slate-400"></i>
                    <span>CRM & Riwayat Unit</span>
                </div>
            </a>

            <a href="{{ route('techfix.laporan') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-chart-line text-sm text-slate-400"></i>
                    <span>Laporan & Keuangan</span>
                </div>
            </a>

            <a href="{{ route('techfix.pengaturan') }}" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition-colors">
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-gear text-sm text-slate-400"></i>
                    <span>Pengaturan Sistem</span>
                </div>
            </a>
        </nav>

        <!-- Sidebar Bottom -->
        <div class="p-3.5 border-t border-slate-200 bg-slate-50/60 font-mono-code">
            <div class="flex items-center justify-between text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                <span>HARDWARE DIAGNOSTICS</span>
                <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
            </div>
            <div class="space-y-1.5 text-[11px] text-slate-600">
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">LAN Workshop</span>
                    <span class="font-bold text-emerald-600">192.168.1.10</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Barcode Scanner</span>
                    <span class="font-bold text-sky-600">Siap (COM3)</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-400">Thermal Printer</span>
                    <span class="font-bold text-slate-700">Ready 80mm</span>
                </div>
            </div>
            <div class="mt-3 pt-2.5 border-t border-slate-200 flex items-center justify-between text-[11px]">
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span class="font-semibold text-slate-700">{{ $shiftStatus }}</span>
                </div>
                <form action="{{ route('techfix.shift.toggle') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sky-600 hover:underline font-semibold text-[11px]">Ganti</button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="pl-64 flex-1 flex flex-col min-w-0">

        <!-- TOP NAVBAR -->
        <header class="h-16 bg-white border-b border-slate-200 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100">
                    <i class="fa-solid fa-cash-register text-xs"></i>
                </div>
                <div>
                    <div class="text-xs font-bold text-slate-800 leading-tight">Kasir POS & Garansi</div>
                    <div class="text-[10px] font-mono-code text-slate-400 flex items-center gap-1">
                        <span class="text-emerald-500 font-bold">● Live</span>
                        <span>|</span>
                        <span>{{ $currentBranch }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden lg:flex items-center gap-1.5 px-2.5 py-1.5 bg-emerald-50 border border-emerald-200 rounded-lg text-[11px] font-mono-code text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 pulse-beacon"></span>
                    <span>Printer: <strong>Terhubung</strong></span>
                </div>

                <button onclick="openPosModal()" class="flex items-center gap-2 bg-brand-700 hover:bg-brand-800 text-white px-3.5 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all hover:shadow active:scale-[0.98]">
                    <i class="fa-solid fa-plus text-[11px]"></i>
                    <span>Transaksi Baru</span>
                </button>

                <div class="flex items-center gap-2.5 pl-2 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-brand-700 text-white flex items-center justify-center text-xs font-bold">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="hidden sm:block text-left">
                        <div class="text-xs font-bold text-slate-800 leading-tight">{{ $user->name ?? 'Admin Kasir' }}</div>
                        <div class="text-[10px] font-medium text-slate-400">Kasir & Admin</div>
                    </div>
                    <div class="relative group">
                        <button class="p-1 text-slate-400 hover:text-slate-600">
                            <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-1 w-48 bg-white border border-slate-200 rounded-xl shadow-lg py-1.5 hidden group-hover:block z-50 text-xs">
                            <a href="{{ route('techfix.kasir.reset') }}" class="flex items-center gap-2 px-3 py-1.5 text-slate-700 hover:bg-slate-50">
                                <i class="fa-solid fa-eraser text-slate-400"></i> Kosongkan Data
                            </a>
                            <div class="border-t border-slate-100 my-1"></div>
                            <form action="{{ url('/logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-3 py-1.5 text-rose-600 hover:bg-rose-50 text-left">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 space-y-5 overflow-y-auto">

            @if(session('success'))
            <div id="flashAlert" class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-xl text-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('flashAlert').remove()" class="text-emerald-500 hover:text-emerald-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endif

            <!-- STAT CARDS -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-widest">Transaksi Hari Ini</div>
                        <div class="w-8 h-8 rounded-lg bg-brand-50 flex items-center justify-center">
                            <i class="fa-solid fa-receipt text-brand-600 text-xs"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-display font-bold text-slate-900">{{ $stats['total_transaksi']['val'] }}</div>
                    <div class="text-[10px] text-slate-400 mt-1">{{ $stats['total_transaksi']['sub'] }}</div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-widest">Omzet Kasir</div>
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                            <i class="fa-solid fa-money-bill-wave text-emerald-600 text-xs"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-display font-bold text-slate-900">{{ $stats['omzet']['val'] }}</div>
                    <div class="text-[10px] text-slate-400 mt-1">{{ $stats['omzet']['sub'] }}</div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-widest">Klaim Garansi</div>
                        <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fa-solid fa-shield-halved text-amber-600 text-xs"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-display font-bold text-slate-900">{{ $stats['klaim_garansi']['val'] }}</div>
                    <div class="text-[10px] text-slate-400 mt-1">{{ $stats['klaim_garansi']['sub'] }}</div>
                </div>

                <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-xs">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-widest">Siap Diambil</div>
                        <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center">
                            <i class="fa-solid fa-box-open text-sky-600 text-xs"></i>
                        </div>
                    </div>
                    <div class="text-2xl font-display font-bold text-slate-900">{{ $stats['siap_diambil']['val'] }}</div>
                    <div class="text-[10px] text-slate-400 mt-1">{{ $stats['siap_diambil']['sub'] }}</div>
                </div>
            </div>

            <!-- DUAL PANEL -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                <!-- LEFT: Transaksi POS -->
                <div class="xl:col-span-2 bg-white rounded-xl border border-slate-200 shadow-xs">
                    <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <div class="text-sm font-bold text-slate-800">Riwayat Transaksi POS</div>
                            <div class="text-[10px] font-mono-code text-slate-400">Cashier Point-of-Sale — Data siap diisi</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex bg-slate-100 rounded-lg p-0.5 text-[11px] font-semibold">
                                <button id="tabAll" onclick="filterTab('all')" class="px-3 py-1 rounded-md tab-active transition-all">Semua</button>
                                <button id="tabLunas" onclick="filterTab('lunas')" class="px-3 py-1 rounded-md text-slate-500 hover:text-slate-800 transition-all">Lunas</button>
                                <button id="tabTunggak" onclick="filterTab('tunggak')" class="px-3 py-1 rounded-md text-slate-500 hover:text-slate-800 transition-all">Belum Bayar</button>
                            </div>
                            <button onclick="openPosModal()" class="flex items-center gap-1.5 px-3 py-1.5 bg-brand-700 text-white rounded-lg text-xs font-semibold">
                                <i class="fa-solid fa-plus text-[10px]"></i> Tambah
                            </button>
                        </div>
                    </div>

                    <!-- Table Header -->
                    <div class="px-5 py-2 bg-slate-50 border-b border-slate-100 grid grid-cols-6 text-[10px] font-mono-code font-bold text-slate-500 uppercase tracking-wider">
                        <div class="col-span-2">Pelanggan / Tiket</div>
                        <div>Jenis</div>
                        <div>Total</div>
                        <div>Metode</div>
                        <div>Status</div>
                    </div>

                    <!-- Transaksi List -->
                    <div id="transaksiList" class="divide-y divide-slate-50">
                        @forelse($transaksiList as $trx)
                        <div class="px-5 py-3 grid grid-cols-6 text-xs items-center hover:bg-slate-50/60 transition-colors trx-row" data-status="{{ $trx['status_bayar'] ?? 'lunas' }}">
                            <div class="col-span-2">
                                <div class="font-semibold text-slate-800">{{ $trx['nama_pelanggan'] ?? '-' }}</div>
                                <div class="text-[10px] font-mono-code text-slate-400">#{{ $trx['tiket_id'] ?? '-' }}</div>
                            </div>
                            <div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ ($trx['jenis'] ?? '') === 'Garansi' ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }}">
                                    {{ $trx['jenis'] ?? 'Servis' }}
                                </span>
                            </div>
                            <div class="font-mono-code font-bold text-slate-700">{{ $trx['total'] ?? 'Rp 0' }}</div>
                            <div class="text-slate-500">{{ $trx['metode_bayar'] ?? '-' }}</div>
                            <div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ ($trx['status_bayar'] ?? '') === 'lunas' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ ($trx['status_bayar'] ?? '') === 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                                </span>
                            </div>
                        </div>
                        @empty
                        <div class="py-16 text-center" id="emptyTransaksi">
                            <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-receipt text-slate-300 text-2xl"></i>
                            </div>
                            <div class="text-sm font-semibold text-slate-400">Belum ada transaksi kasir</div>
                            <div class="text-xs text-slate-300 mt-1">Klik <strong>"Transaksi Baru"</strong> untuk menambah data pertama Anda</div>
                            <button onclick="openPosModal()" class="mt-4 px-4 py-2 bg-brand-700 text-white rounded-lg text-xs font-semibold hover:bg-brand-800 transition-colors">
                                <i class="fa-solid fa-plus mr-1.5"></i> Buat Transaksi Pertama
                            </button>
                        </div>
                        @endforelse
                    </div>

                    <div class="px-5 py-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400">
                        <span>Menampilkan <strong class="text-slate-600">{{ count($transaksiList) }}</strong> transaksi hari ini</span>
                        <span class="font-mono-code">Total: <strong class="text-slate-700">{{ $totalOmzet }}</strong></span>
                    </div>
                </div>

                <!-- RIGHT: Klaim Garansi + Quick Search -->
                <div class="flex flex-col gap-4">
                    <!-- Garansi Panel -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-xs">
                        <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <div class="text-sm font-bold text-slate-800">Klaim Garansi</div>
                                <div class="text-[10px] font-mono-code text-slate-400">Riwayat & Proses Klaim</div>
                            </div>
                            <button onclick="openGaransiModal()" class="flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-semibold transition-colors">
                                <i class="fa-solid fa-plus text-[10px]"></i> Klaim
                            </button>
                        </div>

                        <div class="divide-y divide-slate-50">
                            @forelse($garansiList as $garansi)
                            <div class="px-4 py-3 warranty-card">
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-bold text-slate-800">{{ $garansi['nama_pelanggan'] ?? '-' }}</span>
                                    <span class="text-[10px] font-mono-code text-slate-400">{{ $garansi['tiket_id'] ?? '' }}</span>
                                </div>
                                <div class="text-[11px] text-slate-500">{{ $garansi['device'] ?? '-' }}</div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-[10px] text-slate-400">s/d: <strong class="text-slate-600">{{ $garansi['expired'] ?? '-' }}</strong></span>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold {{ ($garansi['status'] ?? '') === 'Aktif' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                        {{ $garansi['status'] ?? 'Aktif' }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="py-10 text-center px-4">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center mx-auto mb-3">
                                    <i class="fa-solid fa-shield-halved text-amber-300 text-lg"></i>
                                </div>
                                <div class="text-xs font-semibold text-slate-400">Belum ada data garansi</div>
                                <div class="text-[11px] text-slate-300 mt-0.5">Tambah klaim garansi baru</div>
                                <button onclick="openGaransiModal()" class="mt-3 px-3 py-1.5 bg-amber-500 text-white rounded-lg text-xs font-semibold hover:bg-amber-600 transition-colors">
                                    <i class="fa-solid fa-shield-halved mr-1"></i> Tambah Garansi
                                </button>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick Search -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-xs overflow-hidden">
                        <div class="px-4 py-3 border-b border-slate-100">
                            <div class="text-xs font-bold text-slate-700">Quick Cari Tiket</div>
                            <div class="text-[10px] font-mono-code text-slate-400">Scan / ketik kode tiket</div>
                        </div>
                        <div class="p-4">
                            <div class="relative mb-3">
                                <i class="fa-solid fa-barcode absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                                <input type="text" id="quickSearchTicket" placeholder="TK-9901 atau scan barcode..."
                                    class="w-full pl-8 pr-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder:text-slate-300 font-mono-code">
                            </div>
                            <button onclick="searchTicket()" class="w-full py-2 bg-brand-700 text-white rounded-lg text-xs font-semibold hover:bg-brand-800 transition-colors">
                                <i class="fa-solid fa-magnifying-glass mr-1.5"></i> Cari & Proses
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL: TRANSAKSI POS BARU -->
    <div id="posModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white rounded-t-2xl z-10">
                <div>
                    <div class="text-base font-bold text-slate-800">Transaksi Kasir Baru</div>
                    <div class="text-[11px] font-mono-code text-slate-400">Isi data pembayaran servis</div>
                </div>
                <button onclick="closePosModal()" class="text-slate-400 hover:text-slate-600 w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-100">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('techfix.kasir.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kode Tiket Servis <span class="text-rose-500">*</span></label>
                    <input type="text" name="tiket_id" placeholder="Contoh: TK-9901"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Pelanggan <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_pelanggan" placeholder="Nama lengkap pelanggan"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Jenis Transaksi</label>
                        <select name="jenis" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50">
                            <option value="Servis">Servis</option>
                            <option value="Garansi">Klaim Garansi</option>
                            <option value="Jual Sparepart">Jual Sparepart</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Perangkat</label>
                        <input type="text" name="device" placeholder="MacBook Pro 14, dll"
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Total Biaya (Rp) <span class="text-rose-500">*</span></label>
                    <input type="number" name="total_biaya" placeholder="0" min="0"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Metode Pembayaran</label>
                    <div class="grid grid-cols-3 gap-2">
                        <label class="flex items-center gap-2 p-2.5 border border-slate-200 rounded-lg cursor-pointer hover:border-brand-400 transition-colors text-xs">
                            <input type="radio" name="metode_bayar" value="Tunai" checked> <i class="fa-solid fa-money-bill text-emerald-500"></i> Tunai
                        </label>
                        <label class="flex items-center gap-2 p-2.5 border border-slate-200 rounded-lg cursor-pointer hover:border-brand-400 transition-colors text-xs">
                            <input type="radio" name="metode_bayar" value="Transfer"> <i class="fa-solid fa-building-columns text-sky-500"></i> Transfer
                        </label>
                        <label class="flex items-center gap-2 p-2.5 border border-slate-200 rounded-lg cursor-pointer hover:border-brand-400 transition-colors text-xs">
                            <input type="radio" name="metode_bayar" value="QRIS"> <i class="fa-solid fa-qrcode text-violet-500"></i> QRIS
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Catatan (opsional)</label>
                    <textarea name="catatan" rows="2" placeholder="Catatan tambahan..."
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 resize-none"></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closePosModal()" class="px-4 py-2 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-50">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-brand-700 text-white rounded-lg text-xs font-semibold hover:bg-brand-800 transition-colors">
                        <i class="fa-solid fa-check mr-1.5"></i> Simpan & Cetak Struk
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL: KLAIM GARANSI -->
    <div id="garansiModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white rounded-t-2xl z-10">
                <div>
                    <div class="text-base font-bold text-slate-800">Daftarkan Klaim Garansi</div>
                    <div class="text-[11px] font-mono-code text-slate-400">Garansi unit yang telah selesai servis</div>
                </div>
                <button onclick="closeGaransiModal()" class="text-slate-400 hover:text-slate-600 w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-100">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('techfix.kasir.garansi.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kode Tiket <span class="text-rose-500">*</span></label>
                        <input type="text" name="tiket_id" placeholder="TK-9901"
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 font-mono-code" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Pelanggan <span class="text-rose-500">*</span></label>
                        <input type="text" name="nama_pelanggan" placeholder="Nama pelanggan"
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Perangkat <span class="text-rose-500">*</span></label>
                    <input type="text" name="device" placeholder="MacBook Pro 14 / iPhone 15 Pro, dll"
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai"
                            class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Durasi Garansi</label>
                        <select name="durasi_garansi" class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50">
                            <option value="30 Hari">30 Hari</option>
                            <option value="60 Hari">60 Hari</option>
                            <option value="90 Hari" selected>90 Hari</option>
                            <option value="6 Bulan">6 Bulan</option>
                            <option value="1 Tahun">1 Tahun</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Cakupan Garansi</label>
                    <textarea name="cakupan" rows="2" placeholder="Garansi jasa perbaikan dan sparepart IC Power..."
                        class="w-full px-3 py-2 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-brand-500 bg-slate-50 resize-none"></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeGaransiModal()" class="px-4 py-2 border border-slate-200 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-50">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 text-white rounded-lg text-xs font-semibold hover:bg-amber-600 transition-colors">
                        <i class="fa-solid fa-shield-halved mr-1.5"></i> Daftarkan Garansi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- TOAST -->
    <div id="toastContainer" class="fixed bottom-5 right-5 z-[999] space-y-2 pointer-events-none"></div>

    <script>
        function toastMsg(msg, type = 'info') {
            const colors = { info: 'bg-slate-800 text-white', success: 'bg-emerald-600 text-white', warning: 'bg-amber-500 text-white', error: 'bg-rose-600 text-white' };
            const toast = document.createElement('div');
            toast.className = `pointer-events-auto px-4 py-3 rounded-xl shadow-xl text-xs font-semibold flex items-center gap-2.5 transition-all ${colors[type] || colors.info}`;
            toast.innerHTML = `<i class="fa-solid fa-circle-info"></i> ${msg}`;
            document.getElementById('toastContainer').appendChild(toast);
            setTimeout(() => toast.remove(), 3500);
        }

        function openPosModal() { document.getElementById('posModal').classList.remove('hidden'); }
        function closePosModal() { document.getElementById('posModal').classList.add('hidden'); }
        function openGaransiModal() { document.getElementById('garansiModal').classList.remove('hidden'); }
        function closeGaransiModal() { document.getElementById('garansiModal').classList.add('hidden'); }

        function filterTab(status) {
            ['All','Lunas','Tunggak'].forEach(t => {
                const el = document.getElementById('tab' + t);
                if (el) { el.classList.remove('tab-active'); el.classList.add('text-slate-500'); }
            });
            const activeId = 'tab' + status.charAt(0).toUpperCase() + status.slice(1);
            const activeEl = document.getElementById(activeId);
            if (activeEl) { activeEl.classList.add('tab-active'); activeEl.classList.remove('text-slate-500'); }
            document.querySelectorAll('.trx-row').forEach(row => {
                row.style.display = (status === 'all' || row.dataset.status === status) ? '' : 'none';
            });
        }

        function searchTicket() {
            const q = document.getElementById('quickSearchTicket').value.trim();
            if (!q) { toastMsg('Masukkan kode tiket terlebih dahulu.', 'warning'); return; }
            toastMsg('Mencari tiket: ' + q + '...', 'info');
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') { closePosModal(); closeGaransiModal(); }
        });

        setTimeout(() => {
            const el = document.getElementById('flashAlert');
            if (el) el.remove();
        }, 4000);
    </script>
</body>
</html>
