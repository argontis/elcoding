<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RestoHub OS — Laporan Penjualan & Pengaturan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        terracotta: {
                            50: '#fdf6f3', 100: '#fbece5', 200: '#f6d8cb',
                            500: '#b84221', 600: '#a33315', 700: '#8c280e',
                            800: '#6f210c', 900: '#551a0b',
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
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .modal-backdrop { backdrop-filter: blur(4px); background: rgba(15,23,42,0.55); }
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.10); }
        .tab-btn.active { background: #b84221; color: #fff; }
        .badge-paid { background: #d1fae5; color: #065f46; }
        .badge-qris { background: #ede9fe; color: #5b21b6; }
        .badge-cash { background: #fef3c7; color: #92400e; }
        .badge-edc  { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-800 antialiased min-h-screen flex flex-col selection:bg-orange-500 selection:text-white">

    <!-- Toast Notifications -->
    <div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-2 pointer-events-none">
        @if(session('success'))
            <div class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-600 text-white shadow-xl text-xs font-semibold animate-bounce">
                <i class="fas fa-check-circle text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('info'))
            <div class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-900 text-white shadow-xl text-xs font-semibold">
                <i class="fas fa-info-circle text-base text-amber-400"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif
    </div>

    <!-- MAIN APP WRAPPER -->
    <div class="flex h-screen overflow-hidden w-full">

        <!-- ============================================================== -->
        <!-- 1. LEFT SIDEBAR                                                 -->
        <!-- ============================================================== -->
        <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col shrink-0 select-none z-30">
            <!-- Logo -->
            <div class="p-5 border-b border-slate-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-terracotta-500 to-terracotta-700 flex items-center justify-center shadow-md">
                    <i class="fas fa-utensils text-white text-sm"></i>
                </div>
                <div>
                    <p class="font-heading font-bold text-slate-800 text-sm leading-tight">RestoHub OS</p>
                    <p class="text-[10px] text-slate-400 font-medium">Culinary Operations</p>
                </div>
            </div>

            <!-- Branch Info -->
            <div class="px-4 py-3 border-b border-slate-100 bg-slate-50">
                <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-1">Cabang Aktif</p>
                <p class="text-xs font-semibold text-slate-700 truncate">{{ $currentBranch ?? 'Belum dipilih' }}</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto p-3 space-y-0.5">
                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest px-2 pt-2 pb-1">Operasional</p>
                <a href="{{ route('resto.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 text-xs font-medium transition-colors">
                    <i class="fas fa-cash-register w-4 text-center text-slate-400"></i> POS & Kasir Utama
                </a>
                <a href="{{ route('resto.kds') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 text-xs font-medium transition-colors">
                    <i class="fas fa-tv w-4 text-center text-slate-400"></i> Kitchen Display (KDS)
                </a>
                <a href="{{ route('resto.inventaris') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 text-xs font-medium transition-colors">
                    <i class="fas fa-boxes-stacked w-4 text-center text-slate-400"></i> Inventaris & Resep
                </a>

                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest px-2 pt-4 pb-1">CRM & Marketing</p>
                <a href="{{ route('resto.member') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 text-xs font-medium transition-colors">
                    <i class="fas fa-users w-4 text-center text-slate-400"></i> Loyalty & Reservasi
                </a>
                <a href="{{ route('resto.marketing') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-slate-600 hover:bg-slate-100 hover:text-slate-900 text-xs font-medium transition-colors">
                    <i class="fab fa-whatsapp w-4 text-center text-slate-400"></i> WhatsApp Marketing
                </a>

                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest px-2 pt-4 pb-1">Analitik</p>
                <a href="{{ route('resto.laporan') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg bg-terracotta-50 text-terracotta-700 text-xs font-semibold transition-colors">
                    <i class="fas fa-chart-bar w-4 text-center text-terracotta-500"></i> Laporan & Pengaturan
                </a>
            </nav>

            <!-- Reset Button -->
            <div class="p-4 border-t border-slate-100">
                <a href="{{ route('resto.reset') }}" onclick="return confirm('Reset semua data RestoHub ke kondisi kosong?')"
                   class="w-full flex items-center justify-center gap-2 py-2 rounded-lg border border-slate-200 text-slate-500 hover:bg-red-50 hover:border-red-200 hover:text-red-600 text-xs font-medium transition-colors">
                    <i class="fas fa-rotate-left text-xs"></i> Reset Data
                </a>
            </div>
        </aside>

        <!-- ============================================================== -->
        <!-- 2. MAIN CONTENT                                                 -->
        <!-- ============================================================== -->
        <main class="flex-1 overflow-y-auto bg-[#f8fafc]">

            <!-- Top Header -->
            <header class="sticky top-0 z-20 bg-white/80 backdrop-blur-md border-b border-slate-200/80 px-6 py-3.5 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-terracotta-500 to-terracotta-700 flex items-center justify-center">
                        <i class="fas fa-chart-bar text-white text-xs"></i>
                    </div>
                    <div>
                        <h1 class="font-heading font-bold text-slate-800 text-base leading-tight">Laporan & Pengaturan</h1>
                        <p class="text-[10px] text-slate-400">Sales Report, Analytics & Operational Config</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="openModal('modalTransaksi')"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg bg-terracotta-600 hover:bg-terracotta-700 text-white text-xs font-semibold transition-colors shadow-sm">
                        <i class="fas fa-plus"></i> Input Transaksi
                    </button>
                    <button onclick="openModal('modalTutupBuku')"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold transition-colors shadow-sm">
                        <i class="fas fa-lock"></i> Tutup Buku
                    </button>
                    <div class="text-right ml-2">
                        <p class="text-xs font-semibold text-slate-700">{{ $user->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-slate-400">{{ $shiftInfo['shift_kode'] ?? 'SHIFT 01' }}</p>
                    </div>
                </div>
            </header>

            <div class="p-6 space-y-6">

                <!-- KPI Summary Cards -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Total Transaksi -->
                    <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                                <i class="fas fa-receipt text-blue-600 text-sm"></i>
                            </div>
                            <span class="text-[10px] font-semibold text-slate-400 bg-slate-50 px-2 py-0.5 rounded-full">Hari Ini</span>
                        </div>
                        <p class="text-2xl font-heading font-bold text-slate-800">{{ $totalTransaksi }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">Total Transaksi</p>
                    </div>

                    <!-- Total Penjualan -->
                    <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                                <i class="fas fa-coins text-emerald-600 text-sm"></i>
                            </div>
                            <span class="text-[10px] font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Revenue</span>
                        </div>
                        <p class="text-2xl font-heading font-bold text-slate-800">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">Total Penjualan</p>
                    </div>

                    <!-- Avg Keranjang -->
                    <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center">
                                <i class="fas fa-shopping-basket text-purple-600 text-sm"></i>
                            </div>
                            <span class="text-[10px] font-semibold text-slate-400 bg-slate-50 px-2 py-0.5 rounded-full">Avg/Trx</span>
                        </div>
                        <p class="text-2xl font-heading font-bold text-slate-800">Rp {{ number_format($avgKeranjang, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">Avg Nilai Keranjang</p>
                    </div>

                    <!-- Laba Kotor -->
                    <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center">
                                <i class="fas fa-chart-line text-amber-600 text-sm"></i>
                            </div>
                            <span class="text-[10px] font-semibold {{ $labaPercent >= 30 ? 'text-emerald-600 bg-emerald-50' : 'text-amber-600 bg-amber-50' }} px-2 py-0.5 rounded-full">
                                {{ $labaPercent }}%
                            </span>
                        </div>
                        <p class="text-2xl font-heading font-bold text-slate-800">Rp {{ number_format($labaKotor, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-500 mt-0.5">Estimasi Laba Kotor</p>
                    </div>
                </div>

                <!-- Tab Navigation -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="flex border-b border-slate-100 px-2 pt-2 gap-1">
                        <button id="tabBtnTransaksi" onclick="switchTab('transaksi')" class="tab-btn active text-xs font-semibold px-4 py-2 rounded-t-lg transition-all">
                            <i class="fas fa-list-ul mr-1.5"></i> Log Transaksi
                        </button>
                        <button id="tabBtnAnalitik" onclick="switchTab('analitik')" class="tab-btn text-xs font-semibold px-4 py-2 rounded-t-lg text-slate-500 hover:text-slate-800 transition-all">
                            <i class="fas fa-chart-pie mr-1.5"></i> Analitik Menu
                        </button>
                        <button id="tabBtnVoid" onclick="switchTab('void')" class="tab-btn text-xs font-semibold px-4 py-2 rounded-t-lg text-slate-500 hover:text-slate-800 transition-all">
                            <i class="fas fa-ban mr-1.5"></i> Void & Retur
                        </button>
                        <button id="tabBtnPengaturan" onclick="switchTab('pengaturan')" class="tab-btn text-xs font-semibold px-4 py-2 rounded-t-lg text-slate-500 hover:text-slate-800 transition-all">
                            <i class="fas fa-sliders mr-1.5"></i> Pengaturan
                        </button>
                    </div>

                    <!-- TAB: Log Transaksi -->
                    <div id="tabTransaksi" class="p-5">
                        @if(count($transactions) === 0)
                            <div class="text-center py-16">
                                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-receipt text-slate-300 text-2xl"></i>
                                </div>
                                <h3 class="font-semibold text-slate-700 mb-1">Belum Ada Transaksi</h3>
                                <p class="text-sm text-slate-400 mb-5">Log transaksi penjualan akan muncul di sini setelah ada pembayaran atau input manual.</p>
                                <button onclick="openModal('modalTransaksi')"
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-terracotta-600 text-white text-xs font-semibold hover:bg-terracotta-700 transition-colors">
                                    <i class="fas fa-plus"></i> Input Transaksi Manual
                                </button>
                            </div>
                        @else
                            <!-- Filter Bar -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <select class="text-xs border border-slate-200 rounded-lg px-3 py-1.5 text-slate-600 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                                        <option>Semua Metode</option>
                                        <option>QRIS</option>
                                        <option>Cash</option>
                                        <option>EDC</option>
                                    </select>
                                    <input type="date" class="text-xs border border-slate-200 rounded-lg px-3 py-1.5 text-slate-600 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                                </div>
                                <button class="text-xs text-slate-500 hover:text-terracotta-600 font-medium flex items-center gap-1">
                                    <i class="fas fa-file-csv"></i> Export CSV
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="text-[10px] uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                            <th class="text-left pb-3 font-semibold">Order No</th>
                                            <th class="text-left pb-3 font-semibold">Meja / Area</th>
                                            <th class="text-left pb-3 font-semibold">Jam</th>
                                            <th class="text-left pb-3 font-semibold">Item</th>
                                            <th class="text-left pb-3 font-semibold">Metode</th>
                                            <th class="text-right pb-3 font-semibold">Total</th>
                                            <th class="text-right pb-3 font-semibold">Kasir</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @foreach($transactions as $trx)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-3 font-mono font-semibold text-slate-700">{{ $trx['order_no'] }}</td>
                                            <td class="py-3 text-slate-600">{{ $trx['meja'] }}</td>
                                            <td class="py-3 text-slate-500">{{ $trx['jam'] }}</td>
                                            <td class="py-3 text-slate-600">{{ $trx['items'] }} item</td>
                                            <td class="py-3">
                                                @php $m = strtolower($trx['metode'] ?? ''); @endphp
                                                @if($m === 'qris')
                                                    <span class="badge-qris text-[10px] font-semibold px-2 py-0.5 rounded-full">QRIS</span>
                                                @elseif($m === 'cash')
                                                    <span class="badge-cash text-[10px] font-semibold px-2 py-0.5 rounded-full">Cash</span>
                                                @elseif($m === 'edc')
                                                    <span class="badge-edc text-[10px] font-semibold px-2 py-0.5 rounded-full">EDC</span>
                                                @else
                                                    <span class="badge-paid text-[10px] font-semibold px-2 py-0.5 rounded-full">{{ $trx['metode'] }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3 text-right font-semibold text-slate-800">Rp {{ number_format($trx['total'], 0, ',', '.') }}</td>
                                            <td class="py-3 text-right text-slate-500">{{ $trx['kasir'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- TAB: Analitik Menu -->
                    <div id="tabAnalitik" class="p-5 hidden">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Chart: Metode Pembayaran -->
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <h3 class="font-semibold text-slate-700 text-sm mb-4 flex items-center gap-2">
                                    <i class="fas fa-credit-card text-terracotta-500"></i> Metode Pembayaran
                                </h3>
                                @if($totalTransaksi === 0)
                                    <div class="text-center py-10">
                                        <i class="fas fa-chart-pie text-slate-200 text-4xl mb-3"></i>
                                        <p class="text-xs text-slate-400">Belum ada data transaksi</p>
                                    </div>
                                @else
                                    <canvas id="chartMetode" height="200"></canvas>
                                @endif
                            </div>

                            <!-- Chart: Menu Engineering -->
                            <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <h3 class="font-semibold text-slate-700 text-sm mb-4 flex items-center gap-2">
                                    <i class="fas fa-star text-amber-500"></i> Menu Engineering
                                </h3>
                                @if(count($menuEngineering) === 0)
                                    <div class="text-center py-10">
                                        <i class="fas fa-utensils text-slate-200 text-4xl mb-3"></i>
                                        <p class="text-xs text-slate-400">Belum ada data menu. Lakukan transaksi terlebih dahulu untuk melihat analitik menu.</p>
                                    </div>
                                @else
                                    <div class="space-y-2">
                                        @foreach($menuEngineering as $menu)
                                        <div class="flex items-center gap-3">
                                            <div class="flex-1">
                                                <div class="flex justify-between text-xs mb-1">
                                                    <span class="font-medium text-slate-700">{{ $menu['nama'] }}</span>
                                                    <span class="text-slate-500">{{ $menu['qty'] }} porsi</span>
                                                </div>
                                                <div class="h-2 bg-slate-200 rounded-full overflow-hidden">
                                                    <div class="h-full bg-terracotta-500 rounded-full" style="width: {{ min(100, ($menu['qty'] / max(1, collect($menuEngineering)->max('qty'))) * 100) }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- COGS Breakdown -->
                            <div class="lg:col-span-2 bg-slate-50 rounded-xl p-5 border border-slate-100">
                                <h3 class="font-semibold text-slate-700 text-sm mb-4 flex items-center gap-2">
                                    <i class="fas fa-balance-scale text-blue-500"></i> Breakdown P&L (Estimasi)
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    <div class="text-center">
                                        <p class="text-2xl font-heading font-bold text-slate-800">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                                        <p class="text-xs text-slate-500 mt-1">Revenue Bruto</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-heading font-bold text-rose-600">{{ $cogsPercent }}%</p>
                                        <p class="text-xs text-slate-500 mt-1">COGS (Est. HPP)</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-heading font-bold text-emerald-600">Rp {{ number_format($labaKotor, 0, ',', '.') }}</p>
                                        <p class="text-xs text-slate-500 mt-1">Laba Kotor</p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-heading font-bold {{ $labaPercent >= 30 ? 'text-emerald-600' : 'text-amber-600' }}">{{ $labaPercent }}%</p>
                                        <p class="text-xs text-slate-500 mt-1">Gross Margin</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB: Void & Retur -->
                    <div id="tabVoid" class="p-5 hidden">
                        @if(count($voidRecords) === 0)
                            <div class="text-center py-16">
                                <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-ban text-slate-300 text-2xl"></i>
                                </div>
                                <h3 class="font-semibold text-slate-700 mb-1">Belum Ada Void / Retur</h3>
                                <p class="text-sm text-slate-400">Catatan pembatalan dan retur pesanan akan tampil di sini.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="text-[10px] uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                            <th class="text-left pb-3 font-semibold">Order No</th>
                                            <th class="text-left pb-3 font-semibold">Alasan</th>
                                            <th class="text-left pb-3 font-semibold">Kasir</th>
                                            <th class="text-left pb-3 font-semibold">Jam</th>
                                            <th class="text-right pb-3 font-semibold">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-50">
                                        @foreach($voidRecords as $v)
                                        <tr class="hover:bg-slate-50">
                                            <td class="py-3 font-mono text-slate-700">{{ $v['order_no'] }}</td>
                                            <td class="py-3 text-slate-600">{{ $v['alasan'] }}</td>
                                            <td class="py-3 text-slate-500">{{ $v['kasir'] }}</td>
                                            <td class="py-3 text-slate-500">{{ $v['jam'] }}</td>
                                            <td class="py-3 text-right font-semibold text-rose-600">-Rp {{ number_format($v['total'], 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <!-- TAB: Pengaturan -->
                    <div id="tabPengaturan" class="p-5 hidden">
                        <form method="POST" action="{{ route('resto.laporan.config') }}" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <!-- Pajak & Service -->
                                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                    <h3 class="font-semibold text-slate-700 text-sm mb-4 flex items-center gap-2">
                                        <i class="fas fa-percent text-terracotta-500"></i> Pajak & Service Charge
                                    </h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-xs font-semibold text-slate-600 block mb-1.5">PB1 / Tax (%)</label>
                                            <input type="number" name="pb1" value="{{ $config['pb1'] ?? 10 }}" min="0" max="100"
                                                class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                                        </div>
                                        <div>
                                            <label class="text-xs font-semibold text-slate-600 block mb-1.5">Service Charge (%)</label>
                                            <input type="number" name="service" value="{{ $config['service'] ?? 5 }}" min="0" max="100"
                                                class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                                        </div>
                                        <div>
                                            <label class="text-xs font-semibold text-slate-600 block mb-1.5">Pembulatan (Rp)</label>
                                            <select name="pembulatan" class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                                                <option value="100" {{ ($config['pembulatan'] ?? 100) == 100 ? 'selected' : '' }}>Rp 100</option>
                                                <option value="500" {{ ($config['pembulatan'] ?? 100) == 500 ? 'selected' : '' }}>Rp 500</option>
                                                <option value="1000" {{ ($config['pembulatan'] ?? 100) == 1000 ? 'selected' : '' }}>Rp 1.000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kasir & Shift -->
                                <div class="bg-slate-50 rounded-xl p-5 border border-slate-100">
                                    <h3 class="font-semibold text-slate-700 text-sm mb-4 flex items-center gap-2">
                                        <i class="fas fa-cash-register text-blue-500"></i> Kasir & Shift
                                    </h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="text-xs font-semibold text-slate-600 block mb-1.5">Modal Awal / Petty Cash (Rp)</label>
                                            <input type="number" name="petty_cash" value="{{ $config['petty_cash'] ?? 500000 }}"
                                                class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                                        </div>
                                        <div>
                                            <label class="text-xs font-semibold text-slate-600 block mb-1.5">Toleransi Selisih Kasir (Rp)</label>
                                            <input type="number" name="toleransi_selisih" value="{{ $config['toleransi_selisih'] ?? 10000 }}"
                                                class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                                        </div>
                                        <div class="flex items-center gap-3 mt-1">
                                            <input type="checkbox" id="pin_manager" name="pin_manager" {{ !empty($config['pin_manager']) ? 'checked' : '' }}
                                                class="w-4 h-4 accent-terracotta-600">
                                            <label for="pin_manager" class="text-xs font-medium text-slate-600">Wajib PIN Manager untuk Void</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Struk & Printer -->
                                <div class="lg:col-span-2 bg-slate-50 rounded-xl p-5 border border-slate-100">
                                    <h3 class="font-semibold text-slate-700 text-sm mb-4 flex items-center gap-2">
                                        <i class="fas fa-print text-purple-500"></i> Struk & Printer
                                    </h3>
                                    <div>
                                        <label class="text-xs font-semibold text-slate-600 block mb-1.5">Footer Struk</label>
                                        <textarea name="footer_struk" rows="3"
                                            class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400 resize-none"
                                            placeholder="Mis: Terima kasih atas kunjungan Anda! Follow IG @RestohubBistro">{{ $config['footer_struk'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit"
                                    class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-terracotta-600 hover:bg-terracotta-700 text-white text-sm font-semibold transition-colors shadow-sm">
                                    <i class="fas fa-save"></i> Simpan Konfigurasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: Input Transaksi Manual                                    -->
    <!-- ============================================================== -->
    <div id="modalTransaksi" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h2 class="font-heading font-bold text-slate-800 text-base flex items-center gap-2">
                    <i class="fas fa-plus-circle text-terracotta-500"></i> Input Transaksi Manual
                </h2>
                <button onclick="closeModal('modalTransaksi')" class="text-slate-400 hover:text-slate-700 text-xl leading-none">&times;</button>
            </div>
            <form method="POST" action="{{ route('resto.laporan.transaksi.create') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="text-xs font-semibold text-slate-600 block mb-1.5">Meja / Area</label>
                    <input type="text" name="meja" placeholder="Mis: Meja 05, Takeaway, Online"
                        class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-semibold text-slate-600 block mb-1.5">Total (Rp)</label>
                        <input type="number" name="total" placeholder="150000"
                            class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-600 block mb-1.5">Jumlah Item</label>
                        <input type="number" name="item_count" placeholder="3" min="1"
                            class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 block mb-1.5">Metode Pembayaran</label>
                    <select name="metode" class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                        <option value="QRIS">QRIS</option>
                        <option value="Cash">Cash</option>
                        <option value="EDC">EDC / Debit</option>
                        <option value="Transfer">Transfer Bank</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModal('modalTransaksi')"
                        class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 rounded-xl bg-terracotta-600 hover:bg-terracotta-700 text-white text-sm font-semibold transition-colors">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: Tutup Buku (End of Day / Z-Report)                       -->
    <!-- ============================================================== -->
    <div id="modalTutupBuku" class="fixed inset-0 z-50 hidden items-center justify-center modal-backdrop">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h2 class="font-heading font-bold text-slate-800 text-base flex items-center gap-2">
                    <i class="fas fa-lock text-slate-700"></i> Tutup Buku — End of Day
                </h2>
                <button onclick="closeModal('modalTutupBuku')" class="text-slate-400 hover:text-slate-700 text-xl leading-none">&times;</button>
            </div>
            <form method="POST" action="{{ route('resto.laporan.tutup_buku') }}" class="p-6 space-y-4">
                @csrf
                <!-- Z-Report Summary -->
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 space-y-2 text-xs">
                    <div class="flex justify-between"><span class="text-slate-500">Total Transaksi</span><span class="font-semibold text-slate-700">{{ $totalTransaksi }} transaksi</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Total Penjualan</span><span class="font-semibold text-slate-700">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Metode QRIS</span><span class="font-semibold text-purple-700">{{ $qrisPct }}%</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Metode EDC</span><span class="font-semibold text-blue-700">{{ $edcPct }}%</span></div>
                    <div class="flex justify-between"><span class="text-slate-500">Metode Cash</span><span class="font-semibold text-amber-700">{{ $cashPct }}%</span></div>
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 block mb-1.5">Uang Fisik Cash di Laci (Rp)</label>
                    <input type="number" name="fisik_cash" placeholder="500000"
                        class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400">
                </div>
                <div>
                    <label class="text-xs font-semibold text-slate-600 block mb-1.5">Catatan Shift</label>
                    <textarea name="catatan" rows="2" placeholder="Mis: Semua berjalan lancar. Tidak ada void."
                        class="w-full text-sm border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-terracotta-400 resize-none"></textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModal('modalTutupBuku')"
                        class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-sm font-semibold transition-colors">
                        <i class="fas fa-lock mr-1"></i> Tutup Buku & Cetak Z-Report
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Tab switching
    function switchTab(tab) {
        ['transaksi','analitik','void','pengaturan'].forEach(t => {
            document.getElementById('tab' + capitalize(t)).classList.add('hidden');
            document.getElementById('tabBtn' + capitalize(t)).classList.remove('active');
        });
        document.getElementById('tab' + capitalize(tab)).classList.remove('hidden');
        document.getElementById('tabBtn' + capitalize(tab)).classList.add('active');
    }
    function capitalize(s) { return s.charAt(0).toUpperCase() + s.slice(1); }

    // Modal helpers
    function openModal(id) {
        const el = document.getElementById(id);
        el.classList.remove('hidden');
        el.classList.add('flex');
    }
    function closeModal(id) {
        const el = document.getElementById(id);
        el.classList.add('hidden');
        el.classList.remove('flex');
    }
    document.querySelectorAll('.modal-backdrop').forEach(m => {
        m.addEventListener('click', e => { if(e.target === m) closeModal(m.id); });
    });

    // Chart.js — Metode Pembayaran
    @if($totalTransaksi > 0)
    const ctx = document.getElementById('chartMetode');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['QRIS', 'EDC', 'Cash'],
                datasets: [{
                    data: [{{ $qrisPct }}, {{ $edcPct }}, {{ $cashPct }}],
                    backgroundColor: ['#8b5cf6','#3b82f6','#f59e0b'],
                    borderWidth: 0,
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { size: 11 }, boxWidth: 12 } }
                },
                cutout: '65%'
            }
        });
    }
    @endif

    // Auto-hide toast
    setTimeout(() => {
        document.querySelectorAll('#toastContainer > div').forEach(t => {
            t.style.transition = 'opacity 0.5s'; t.style.opacity = '0';
            setTimeout(() => t.remove(), 500);
        });
    }, 3500);
    </script>
</body>
</html>