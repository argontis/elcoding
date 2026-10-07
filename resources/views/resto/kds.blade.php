<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>RestoHub OS — Kitchen Display System (KDS)</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        terracotta: { 50:'#fdf6f3',100:'#fbece5',200:'#f6d8cb',500:'#b84221',600:'#a33315',700:'#8c280e',800:'#6f210c',900:'#551a0b' }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"','sans-serif'],
                        heading: ['"Outfit"','sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body{font-family:'Plus Jakarta Sans',sans-serif;background-color:#f1f5f9}
        .font-heading{font-family:'Outfit',sans-serif}
        ::-webkit-scrollbar{width:6px;height:6px}
        ::-webkit-scrollbar-track{background:#f1f5f9}
        ::-webkit-scrollbar-thumb{background:#cbd5e1;border-radius:4px}
        ::-webkit-scrollbar-thumb:hover{background:#94a3b8}
        .pulse-subtle{animation:pulseSubtle 2s cubic-bezier(.4,0,.6,1) infinite}
        @keyframes pulseSubtle{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.75;transform:scale(1.05)}}
        .ticket-card{transition:all .2s ease}
        .ticket-card:hover{transform:translateY(-2px);box-shadow:0 12px 32px rgba(0,0,0,.12)}
        .kds-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px;align-items:start}
        @keyframes slideInUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        .slide-in{animation:slideInUp .35s ease forwards}
        .timer-urgent{color:#dc2626;font-weight:800}
        .timer-warn{color:#d97706;font-weight:700}
        .timer-ok{color:#16a34a;font-weight:700}
        .station-tab.active{background:#8c280e;color:white;box-shadow:0 2px 8px rgba(140,40,14,.35)}
        .empty-kds{display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:420px;gap:16px}
    </style>
</head>
<body class="bg-[#f1f5f9] text-slate-800 antialiased min-h-screen flex flex-col selection:bg-orange-500 selection:text-white">

<!-- Toast -->
<div id="toastContainer" class="fixed top-5 right-5 z-50 flex flex-col gap-2 pointer-events-none">
    @if(session('success'))
    <div class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-600 text-white shadow-xl text-xs font-semibold animate-bounce">
        <i class="fas fa-check-circle text-base"></i><span>{{ session('success') }}</span>
    </div>
    @endif
    @if(session('info'))
    <div class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-900 text-white shadow-xl text-xs font-semibold">
        <i class="fas fa-info-circle text-base text-amber-400"></i><span>{{ session('info') }}</span>
    </div>
    @endif
</div>

<div class="flex h-screen overflow-hidden w-full">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-slate-200/80 flex flex-col shrink-0 select-none z-30">
        <div class="p-5 border-b border-slate-100 flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#a33315] to-[#c2410c] text-white flex items-center justify-center text-lg font-black shadow-md shadow-orange-950/20">
                <i class="fas fa-utensils"></i>
            </div>
            <div>
                <div class="font-heading font-black text-xl tracking-tight text-slate-900 leading-none">RestoHub</div>
                <div class="text-[9px] font-extrabold tracking-widest text-[#a33315] uppercase mt-0.5">CULINARY OPERATIONS</div>
            </div>
        </div>
        <div class="px-4 py-3.5 border-b border-slate-100 bg-slate-50/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 pulse-subtle"></span>
                    <span class="text-xs font-bold text-slate-800">{{ $shiftInfo['shift_name'] }}</span>
                </div>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-700">Aktif</span>
            </div>
        </div>
        <nav class="flex-1 px-3 py-3 space-y-1 overflow-y-auto">
            <a href="{{ route('resto.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                <i class="fas fa-cash-register text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                <span>Kasir &amp; Order Meja</span>
            </a>
            <a href="{{ route('resto.kds') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#8c280e] text-white shadow-sm shadow-orange-900/20 transition-all">
                <i class="fas fa-fire-burner text-sm w-4 text-center"></i>
                <span>Kitchen Display</span>
            </a>
            <a href="{{ route('resto.inventaris') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                <i class="fas fa-boxes-stacked text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                <span>Inventaris &amp; Resep</span>
            </a>
            <a href="{{ route('resto.member') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                <i class="fas fa-address-book text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                <span>Reservasi &amp; Member</span>
            </a>
            <a href="{{ route('resto.marketing') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                <i class="fab fa-whatsapp text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                <span>WhatsApp Marketing</span>
            </a>
            <a href="{{ route('resto.laporan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-[#8c280e] hover:bg-slate-50 transition-all group">
                <i class="fas fa-chart-pie text-slate-400 group-hover:text-[#8c280e] text-sm w-4 text-center"></i>
                <span>Laporan &amp; Pengaturan</span>
            </a>
        </nav>
        <div class="p-3 border-t border-slate-100 bg-slate-50/70">
            <div class="flex items-center justify-between text-xs font-semibold text-slate-600">
                <div class="flex items-center gap-2">
                    <i class="fas fa-cloud text-slate-400 text-xs"></i>
                    <span class="text-[11px] font-bold text-slate-700">Live Cloud Sync</span>
                </div>
                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700">100% OK</span>
            </div>
            <div class="text-[10px] text-slate-400 mt-1">Latensi 24ms &bull; Auto Backup</div>
        </div>
        <div class="p-3 border-t border-slate-100 flex items-center justify-between">
            <a href="{{ route('resto.reset') }}" onclick="return confirm('Kosongkan kembali semua data RestoHub?')" class="text-[11px] font-bold text-slate-500 hover:text-[#8c280e] flex items-center gap-1.5">
                <i class="fas fa-rotate-left text-xs"></i><span>Reset Data</span>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[11px] font-bold text-rose-600 hover:text-rose-700 flex items-center gap-1">
                    <i class="fas fa-arrow-right-from-bracket text-xs"></i><span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- HEADER -->
        <header class="bg-white border-b border-slate-200/80 px-5 py-3 flex items-center justify-between shrink-0 z-20">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 text-xs">
                    <i class="fas fa-store text-[#a33315] text-xs"></i>
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Cabang Aktif</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 text-xs font-bold text-slate-800">
                    <i class="fas fa-location-dot text-[#a33315] text-xs"></i>
                    <span>{{ $currentBranch }}</span>
                    <i class="fas fa-chevron-down text-slate-400 text-[10px]"></i>
                </div>
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-[11px] font-bold text-emerald-700">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 pulse-subtle"></span>
                    Live Sync Kitchen &amp; POS
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button id="chimeBtn" onclick="toggleChime()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-600 hover:border-[#a33315] hover:text-[#a33315] transition-all">
                    <i class="fas fa-bell text-amber-500 text-xs"></i><span>Chime Aktif</span>
                </button>
                <button onclick="showToast('Filter Waktu Masuk: Semua tiket aktif ditampilkan.','info')" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-slate-200 text-xs font-bold text-slate-600 hover:border-[#a33315] hover:text-[#a33315] transition-all">
                    <i class="fas fa-clock text-slate-400 text-xs"></i><span>Waktu Masuk</span>
                </button>
                <button id="contrastBtn" onclick="toggleContrast()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-slate-900 text-white text-xs font-bold hover:bg-slate-700 transition-all">
                    <i class="fas fa-circle-half-stroke text-xs"></i><span>Mode Kontras</span>
                </button>
                <button class="relative w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-500 hover:border-[#a33315] hover:text-[#a33315] transition-all">
                    <i class="fas fa-bell text-xs"></i>
                </button>
                <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-[#a33315] to-[#c2410c] text-white flex items-center justify-center text-xs font-black">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</div>
                        <div class="text-[10px] text-slate-400 leading-none mt-0.5">Store Manager</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- STATION TABS + STATS -->
        <div class="bg-white border-b border-slate-200/60 px-5 py-2.5 shrink-0">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1.5 flex-1">
                    <button onclick="filterStation('semua',this)" class="station-tab active flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-bold transition-all border border-transparent">
                        <i class="fas fa-fire-burner text-xs"></i>
                        <span>Semua Station</span>
                        <span class="ml-1 px-1.5 py-0.5 rounded-full text-[10px] font-black bg-white/20">{{ $totalTickets }}</span>
                    </button>
                    <button onclick="filterStation('main',this)" class="station-tab flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 border border-transparent transition-all">
                        <i class="fas fa-fire text-orange-500 text-xs"></i>
                        <span>Main Kitchen / Hot Food</span>
                        <span class="ml-1 px-1.5 py-0.5 rounded-full text-[10px] font-black bg-slate-100 text-slate-600">{{ $mainCount }}</span>
                    </button>
                    <button onclick="filterStation('pastry',this)" class="station-tab flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-600 hover:bg-slate-100 border border-transparent transition-all">
                        <i class="fas fa-cake-candles text-pink-500 text-xs"></i>
                        <span>Pastry &amp; Dessert</span>
                        <span class="ml-1 px-1.5 py-0.5 rounded-full text-[10px] font-black bg-slate-100 text-slate-600">{{ $pastryCount }}</span>
                    </button>
                </div>
                <div class="flex items-center gap-4 border-l border-slate-200 pl-4">
                    <div class="text-center">
                        <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Rata-rata</div>
                        <div class="flex items-baseline gap-1 justify-center">
                            <span class="text-xl font-black text-slate-800 font-heading leading-none">{{ $avgTime }}</span>
                            <span class="text-[10px] font-bold text-slate-500">Menit</span>
                        </div>
                        <div class="text-[10px] text-emerald-600 font-bold">Target &lt; 15m</div>
                    </div>
                    <div class="text-center">
                        <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Tiket Terlambat</div>
                        <div class="flex items-baseline gap-1 justify-center">
                            <span class="text-xl font-black {{ $lateCount > 0 ? 'text-rose-600' : 'text-slate-400' }} font-heading leading-none">{{ $lateCount }}</span>
                            <span class="text-[10px] font-bold text-slate-500">Tiket</span>
                        </div>
                        @if($lateCount > 0)
                        <div class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-rose-100 text-rose-700 text-[9px] font-black mt-0.5">
                            <i class="fas fa-triangle-exclamation text-[8px]"></i> &gt;15 Menit
                        </div>
                        @else
                        <div class="text-[10px] text-slate-400 font-semibold">On Time</div>
                        @endif
                    </div>
                    <div class="text-center">
                        <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Selesai Hari Ini</div>
                        <div class="flex items-baseline gap-1 justify-center">
                            <span class="text-xl font-black text-slate-800 font-heading leading-none">{{ $doneCount }}</span>
                            <span class="text-[10px] font-bold text-slate-500">Porsi/Tiket</span>
                        </div>
                        <div class="text-[10px] text-slate-500 font-semibold">
                            Efisiensi: <span class="text-emerald-600 font-bold">{{ $doneCount > 0 ? '98.4%' : '—' }}</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Beban Line</div>
                        <div class="text-base font-black font-heading leading-none {{ $totalTickets === 0 ? 'text-slate-400' : ($totalTickets <= 3 ? 'text-emerald-600' : ($totalTickets <= 6 ? 'text-amber-600' : 'text-rose-600')) }}">
                            {{ $totalTickets === 0 ? 'Idle' : ($totalTickets <= 3 ? 'Ringan' : ($totalTickets <= 6 ? 'Moderat' : 'Padat')) }}
                        </div>
                        <svg width="56" height="18" class="mt-0.5"><polyline points="0,14 10,10 20,12 30,6 40,9 56,{{ $totalTickets > 0 ? '4' : '14' }}" fill="none" stroke="{{ $totalTickets > 0 ? '#f97316' : '#94a3b8' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- KDS MAIN -->
        <main class="flex-1 overflow-y-auto p-4">

            @if($totalTickets === 0)
            <!-- EMPTY STATE -->
            <div class="empty-kds">
                <div class="w-24 h-24 rounded-3xl bg-white border border-slate-200 flex items-center justify-center text-4xl text-slate-300 shadow-sm">
                    <i class="fas fa-fire-burner"></i>
                </div>
                <div class="text-center">
                    <h2 class="font-heading font-black text-xl text-slate-700 mb-1">Kitchen Display Siap</h2>
                    <p class="text-sm text-slate-400 font-medium max-w-sm">Belum ada tiket pesanan yang masuk ke dapur.<br>Pesanan dari Kasir &amp; POS akan muncul di sini secara real-time.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('resto.dashboard') }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-[#8c280e] text-white text-xs font-bold hover:bg-[#7a200a] transition-all shadow-md shadow-orange-900/20">
                        <i class="fas fa-cash-register text-xs"></i>
                        <span>Buka Kasir &amp; Input Pesanan</span>
                    </a>
                </div>
                <div class="flex items-center gap-6 mt-2">
                    <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 pulse-subtle"></span>
                        KDS Online &amp; Siap
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                        <i class="fas fa-wifi text-slate-300"></i>
                        Latensi 24ms
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                        <i class="fas fa-clock text-slate-300"></i>
                        <span id="liveTime">--:--</span>
                    </div>
                </div>
            </div>

            @else
            <!-- TICKET GRID -->
            <div class="kds-grid" id="kdsGrid">
                @foreach($kdsTickets as $i => $ticket)
                <div class="ticket-card slide-in bg-white rounded-2xl shadow-sm overflow-hidden border-l-4"
                     style="animation-delay: {{ $i * 60 }}ms; border-color: {{ $ticket['accent_color'] ?? '#8c280e' }}"
                     data-station="{{ $ticket['station'] ?? 'main' }}">

                    <!-- Header -->
                    <div class="px-4 pt-3.5 pb-3 flex items-start justify-between" style="background: {{ $ticket['header_bg'] ?? '#fff7f5' }}">
                        <div>
                            <div class="flex items-center gap-2 mb-0.5">
                                @php $urg = $ticket['urgent'] ?? false; $onl = $ticket['online'] ?? false; $hold = $ticket['on_hold'] ?? false; @endphp
                                @if($urg)
                                <span class="flex items-center gap-1 text-[9px] font-black text-rose-700 bg-rose-100 px-1.5 py-0.5 rounded uppercase">
                                    <i class="fas fa-triangle-exclamation text-[8px]"></i> {{ $ticket['status_label'] ?? 'RUSH EXCEEDED' }}
                                </span>
                                @elseif($onl)
                                <span class="flex items-center gap-1 text-[9px] font-black text-emerald-700 bg-emerald-100 px-1.5 py-0.5 rounded uppercase">
                                    <i class="fas fa-wifi text-[8px]"></i> {{ $ticket['status_label'] ?? 'ONLINE ORDER' }}
                                </span>
                                @elseif($hold)
                                <span class="flex items-center gap-1 text-[9px] font-black text-amber-700 bg-amber-100 px-1.5 py-0.5 rounded uppercase">
                                    <i class="fas fa-pause text-[8px]"></i> {{ $ticket['status_label'] ?? 'ON HOLD' }}
                                </span>
                                @else
                                <span class="text-[9px] font-black text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded uppercase">
                                    {{ $ticket['status_label'] ?? 'SEDANG DIMASAK' }}
                                </span>
                                @endif
                                <span class="text-[10px] font-black {{ $urg ? 'timer-urgent' : ($hold ? 'timer-warn' : 'timer-ok') }}">
                                    <i class="fas fa-stopwatch text-[9px]"></i> {{ $ticket['elapsed'] ?? '00:00' }}
                                </span>
                            </div>
                            <div class="font-heading font-black text-2xl leading-none text-slate-900">{{ $ticket['meja_label'] ?? 'Meja' }}</div>
                            <div class="font-heading font-black text-lg text-slate-500 leading-none">{{ $ticket['meja_id'] ?? '' }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-[10px] font-semibold text-slate-400">{{ $ticket['type'] ?? 'Dine-In' }}</div>
                            <div class="text-[11px] font-black text-[#8c280e]">{{ $ticket['tiket_no'] ?? '' }}</div>
                        </div>
                    </div>

                    <!-- Server & Station -->
                    <div class="px-4 py-1.5 border-b border-slate-100 flex items-center justify-between text-[10px] font-semibold text-slate-500">
                        <span>Server: <span class="text-slate-700 font-bold">{{ $ticket['server'] ?? '—' }}</span></span>
                        <span>Pos: <span class="text-slate-700 font-bold">{{ $ticket['station_label'] ?? 'Main Grill' }}</span></span>
                    </div>

                    <!-- Items -->
                    <div class="px-4 py-3 space-y-2.5">
                        @forelse($ticket['items'] ?? [] as $item)
                        <div class="flex items-start gap-2.5">
                            <div class="mt-0.5 w-4 h-4 rounded border-2 {{ ($item['done'] ?? false) ? 'bg-emerald-500 border-emerald-500' : 'border-slate-300' }} flex items-center justify-center shrink-0 cursor-pointer hover:border-[#8c280e] transition-all">
                                @if($item['done'] ?? false)<i class="fas fa-check text-white text-[8px]"></i>@endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold text-slate-800 leading-snug">
                                    <span class="text-[#8c280e]">{{ $item['qty'] ?? 1 }}×</span> {{ $item['nama'] ?? '' }}
                                </div>
                                @if(!empty($item['catatan']))
                                <div class="text-[10px] text-amber-600 font-semibold leading-snug mt-0.5">{{ $item['catatan'] }}</div>
                                @endif
                                @if(!empty($item['label']))
                                <div class="text-[10px] text-emerald-600 font-bold mt-0.5">{{ $item['label'] }}</div>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-xs text-slate-400 italic">Tidak ada item</div>
                        @endforelse
                    </div>

                    @if(!empty($ticket['note']))
                    <div class="mx-4 mb-3 px-3 py-2 rounded-lg bg-amber-50 border border-amber-200 flex items-center gap-2 text-[10px] font-semibold text-amber-700">
                        <i class="fas fa-circle-info text-amber-500 text-xs"></i> {{ $ticket['note'] }}
                    </div>
                    @endif

                    <!-- Actions -->
                    <div class="px-4 pb-4 flex items-center gap-2">
                        @if($ticket['online'] ?? false)
                        <button onclick="showToast('Pesanan siap dipacking!','success')" class="flex-1 py-2.5 rounded-xl bg-emerald-600 text-white text-xs font-black flex items-center justify-center gap-2 hover:bg-emerald-700 transition-all shadow-md shadow-emerald-900/20">
                            <i class="fas fa-box text-xs"></i> Siap Packing (Ready)
                        </button>
                        @elseif($ticket['on_hold'] ?? false)
                        <button onclick="showToast('Tiket difire!','info')" class="flex items-center gap-1.5 px-3 py-2 rounded-xl bg-rose-100 text-rose-700 text-xs font-black border border-rose-200 hover:bg-rose-200 transition-all">
                            <i class="fas fa-fire text-xs"></i> Fire (Mulai)
                        </button>
                        <button onclick="bumpTicket(this,'{{ $ticket['meja_id'] ?? '' }}')" class="flex-1 py-2 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-black border border-emerald-200 hover:bg-emerald-100 transition-all flex items-center justify-center gap-1.5">
                            <i class="fas fa-check text-xs"></i> Selesai
                        </button>
                        @else
                        <button onclick="showToast('Runner dipanggil!','info')" class="flex items-center gap-1.5 px-3 py-2.5 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200 hover:bg-slate-200 transition-all">
                            <i class="fas fa-person-walking text-xs"></i> Panggil Runner
                        </button>
                        <button onclick="bumpTicket(this,'{{ $ticket['meja_id'] ?? '' }}')" class="flex-1 py-2.5 rounded-xl bg-[#8c280e] text-white text-xs font-black flex items-center justify-center gap-2 hover:bg-[#7a200a] transition-all shadow-md shadow-orange-900/20">
                            <i class="fas fa-check-circle text-xs"></i> Selesai Masak
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </main>

        <!-- BOTTOM RECALL BAR -->
        <div class="bg-slate-900 border-t border-slate-700 px-5 py-2.5 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
                <i class="fas fa-clock-rotate-left text-slate-500 text-xs"></i>
                <span class="text-amber-400 font-black">TIKET BARU SELESAI:</span>
                @forelse($recentDone as $d)
                <span class="text-white">{{ $d['label'] ?? '' }}</span>
                <span class="text-slate-500">{{ $d['ago'] ?? '' }}</span>
                <button onclick="showToast('Recall berhasil!','info')" class="px-2 py-0.5 rounded bg-amber-600/30 text-amber-400 text-[10px] font-black hover:bg-amber-600/50 transition-all">↩ Recall</button>
                @empty
                <span class="text-slate-500 font-normal">Belum ada tiket selesai hari ini</span>
                @endforelse
            </div>
            <button onclick="showToast('Checkpass Master diaktifkan.','info')" class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-800 border border-slate-700 text-xs font-bold text-slate-300 hover:bg-slate-700 transition-all">
                <i class="fas fa-shield-check text-amber-400 text-xs"></i> Checkpass Master
            </button>
        </div>

    </div>
</div>

<script>
    function updateTime(){const e=document.getElementById('liveTime');if(e){const n=new Date();e.textContent=n.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'});}}
    setInterval(updateTime,1000);updateTime();

    function filterStation(s,btn){
        document.querySelectorAll('.station-tab').forEach(t=>t.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.ticket-card').forEach(c=>{
            c.style.display=(s==='semua'||c.dataset.station===s)?'':'none';
        });
    }

    function bumpTicket(btn,mejaId){
        const card=btn.closest('.ticket-card');
        card.style.transition='all .4s ease';
        card.style.opacity='0';
        card.style.transform='scale(0.9)';
        setTimeout(()=>{card.remove();showToast('✅ Tiket '+mejaId+' selesai & di-Bump!','success');},400);
    }

    let chimeOn=true;
    function toggleChime(){
        chimeOn=!chimeOn;
        const btn=document.getElementById('chimeBtn');
        btn.innerHTML=chimeOn
            ?'<i class="fas fa-bell text-amber-500 text-xs"></i><span>Chime Aktif</span>'
            :'<i class="fas fa-bell-slash text-slate-400 text-xs"></i><span>Chime Mati</span>';
        showToast(chimeOn?'Suara dapur aktif.':'Suara dapur mati.','info');
    }

    let contrastOn=false;
    function toggleContrast(){
        contrastOn=!contrastOn;
        document.body.style.backgroundColor=contrastOn?'#0a0a0a':'';
        document.body.style.color=contrastOn?'#f8fafc':'';
        showToast(contrastOn?'Mode kontras tinggi aktif.':'Mode normal aktif.','info');
    }

    function showToast(msg,type='info'){
        const c=document.getElementById('toastContainer');
        const colors={success:'bg-emerald-600',info:'bg-slate-900',error:'bg-rose-600'};
        const icons={success:'fa-check-circle',info:'fa-info-circle',error:'fa-circle-exclamation'};
        const t=document.createElement('div');
        t.className=`pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl ${colors[type]} text-white shadow-xl text-xs font-semibold transition-all`;
        t.innerHTML=`<i class="fas ${icons[type]} text-base ${type==='info'?'text-amber-400':''}"></i><span>${msg}</span>`;
        c.appendChild(t);
        setTimeout(()=>{t.style.opacity='0';t.style.transform='translateX(20px)';setTimeout(()=>t.remove(),300);},3500);
    }
</script>
</body>
</html>