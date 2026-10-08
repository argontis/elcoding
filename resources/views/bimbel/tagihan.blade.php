<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Tagihan & Pembayaran SPP — EduPulse Academy</title>
    <meta name="description" content="Otomasi rekonsiliasi perbankan, penerbitan invoice kolektif, dan notifikasi WhatsApp Gateway terintegrasi.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        edupulse: {
                            brand: '#3b49df',
                            primary: '#2e38b8',
                            dark: '#1e293b'
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #1e293b; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .ss::-webkit-scrollbar { width: 4px; height: 4px; }
        .ss::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .toast-wrap { position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
        .toast-item { display: flex; align-items: center; gap: 12px; background: #1e293b; color: #fff; padding: 12px 18px; border-radius: 14px; font-size: 13px; font-weight: 600; box-shadow: 0 8px 32px rgba(0,0,0,.25); animation: ti .28s ease; min-width: 260px; }
        .toast-item.success { background: #14532d; border-left: 4px solid #22c55e; }
        .toast-item.error { background: #7f1d1d; border-left: 4px solid #ef4444; }
        .toast-item.info { background: #1e3a5f; border-left: 4px solid #3b82f6; }
        @keyframes ti { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
        .modal-bd { position: fixed; inset: 0; z-index: 50; background: rgba(0,0,0,.45); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; padding: 1rem; }
        .modal-bd.open { display: flex; }
        .modal-card { background: #fff; border-radius: 24px; max-width: 540px; width: 100%; padding: 28px; box-shadow: 0 24px 64px rgba(0,0,0,.18); border: 1px solid #f1f5f9; max-height: 90vh; overflow-y: auto; animation: ti .25s ease; }
        .receipt-stamp { border: 2px dashed #3b49df; border-radius: 50%; width: 68px; height: 68px; display: flex; align-items: center; justify-content: center; font-size: 9px; font-weight: 900; color: #3b49df; text-transform: uppercase; transform: rotate(-12deg); }
    </style>
</head>
<body class="antialiased">
<div class="flex h-screen overflow-hidden bg-slate-50">

    {{-- ========================= SIDEBAR ========================= --}}
    <aside class="w-[220px] bg-white border-r border-slate-200/80 flex flex-col shrink-0 shadow-sm z-30">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#3b49df] to-indigo-500 flex items-center justify-center text-white text-sm font-black shadow-md shadow-indigo-200">E</div>
            <div>
                <div class="font-heading font-black text-sm text-slate-900 leading-none">EduPulse</div>
                <div class="text-[10px] font-bold text-indigo-600 tracking-wider uppercase mt-0.5">Academy SaaS</div>
            </div>
        </div>

        <div class="px-4 py-3 border-b border-slate-100">
            <div class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mb-1">Cabang Aktif</div>
            <div class="flex items-center justify-between px-2.5 py-1.5 rounded-lg bg-slate-50 text-xs font-semibold text-slate-700">
                <span class="truncate">{{ $currentBranch }}</span>
                <i class="fas fa-chevron-down text-[10px] text-slate-400 shrink-0"></i>
            </div>
        </div>

        <nav class="flex-1 px-3 py-3 space-y-1.5 overflow-y-auto ss">
            <a href="{{ route('bimbel.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-grid-2 text-slate-400 text-sm w-4 text-center"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('bimbel.siswa') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <div class="flex items-center gap-3"><i class="fas fa-user-group text-slate-400 text-sm w-4 text-center"></i><span>Siswa & Pendaftaran</span></div>
                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-indigo-50 text-indigo-600">PPDB</span>
            </a>
            <a href="{{ route('bimbel.jadwal') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-calendar-days text-slate-400 text-sm w-4 text-center"></i><span>Jadwal & Kelas</span>
            </a>
            {{-- ACTIVE: TAGIHAN & SPP --}}
            <a href="{{ route('bimbel.tagihan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-md shadow-indigo-200">
                <i class="fas fa-file-invoice-dollar text-sm w-4 text-center"></i><span>Tagihan & SPP</span>
            </a>
            <a href="{{ route('bimbel.materi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-book-open text-slate-400 text-sm w-4 text-center"></i><span>Materi & Kurikulum</span>
            </a>
            <a href="{{ route('bimbel.progress') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-chart-line text-slate-400 text-sm w-4 text-center"></i><span>Progress & Rapor</span>
            </a>
            <a href="{{ route('bimbel.ai_tutor') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-robot text-slate-400 text-sm w-4 text-center"></i><span>AI Tutor Assistant</span>
            </a>
            <a href="{{ route('bimbel.pengaturan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-gear text-slate-400 text-sm w-4 text-center"></i><span>Pengaturan</span>
            </a>

            <!-- Keluar (Logout) -->
            <div class="pt-2 mt-2 border-t border-slate-100">
                <form action="{{ route('bimbel.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-rose-600 hover:text-rose-700 hover:bg-rose-50 transition-all group text-left">
                        <i class="fas fa-arrow-right-from-bracket text-rose-400 group-hover:text-rose-600 text-sm w-4 text-center"></i>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </nav>

        <div class="m-3 p-3 rounded-xl bg-indigo-50 border border-indigo-100">
            <div class="text-xs font-bold text-indigo-700 mb-1">Bantuan Bimbel</div>
            <p class="text-[10px] text-indigo-500 leading-relaxed">Pusat panduan dan tiket bantuan teknis operasional.</p>
            <a href="javascript:void(0)" onclick="showToast('Dokumentasi panduan SPP siap diakses.','info')" class="text-[10px] font-bold text-indigo-600 hover:underline mt-1 inline-block">Akses Dokumen &rarr;</a>
        </div>
    </aside>

    {{-- ========================= MAIN CONTENT ========================= --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- TOP NAVBAR --}}
        <header class="bg-white border-b border-slate-200/80 px-6 py-3.5 flex items-center justify-between shrink-0 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="fas fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Cari siswa, kelas, guru, dll [Ctrl K]" class="pl-8 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 focus:outline-none focus:border-indigo-500 w-72 placeholder-slate-400">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-indigo-50 border border-indigo-100 text-xs font-semibold text-indigo-700">
                    <i class="fas fa-calendar-days text-[11px]"></i>
                    <span>{{ $academicYear }}</span>
                    <i class="fas fa-chevron-down text-[9px] text-indigo-400"></i>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-semibold text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>WA Gateway Terhubung</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button onclick="showToast('0 Notifikasi baru.','info')" class="relative w-9 h-9 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500 hover:bg-indigo-50 transition">
                    <i class="fas fa-bell text-sm"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-[#3b49df] text-white text-[9px] font-bold flex items-center justify-center">{{ $totalFaktur }}</span>
                </button>
                <div class="relative group">
                    <button type="button" class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            S
                        </div>
                        <div class="text-right hidden sm:block">
                            <div class="text-xs font-bold text-slate-800 leading-tight">Sarah Maharani, M.Pd</div>
                            <div class="text-[10px] text-slate-400 font-medium">Admin Akademik</div>
                        </div>
                        <i class="fas fa-chevron-down text-slate-400 text-[10px]"></i>
                    </button>
                    <div class="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-xl border border-slate-200 py-1.5 hidden group-hover:block z-50 text-xs">
                        <div class="px-3 py-1.5 border-b border-slate-100">
                            <div class="font-bold text-slate-800">Sarah Maharani, M.Pd</div>
                            <div class="text-[10px] text-slate-400">Role: Bimbel Akademik</div>
                        </div>
                        <form action="{{ route('bimbel.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-rose-600 hover:bg-rose-50 text-left font-semibold">
                                <i class="fas fa-arrow-right-from-bracket w-4"></i> Keluar (Logout)
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- SCROLLABLE MAIN BODY --}}
        <main class="flex-1 overflow-y-auto p-6 space-y-5">

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-5 py-3 flex items-center gap-3 text-xs text-emerald-800 font-semibold shadow-sm">
                    <i class="fas fa-circle-check text-emerald-500 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('info'))
                <div class="bg-indigo-50 border border-indigo-200 rounded-2xl px-5 py-3 flex items-center gap-3 text-xs text-indigo-800 font-semibold shadow-sm">
                    <i class="fas fa-circle-info text-indigo-500 text-sm"></i>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            {{-- BREADCRUMB & PAGE HEADER --}}
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Keuangan & Administrasi &gt; Faktur & SPP Siswa</div>
                    <h1 class="font-heading font-black text-2xl text-slate-900 leading-tight">Manajemen Tagihan & Pembayaran SPP</h1>
                    <p class="text-xs text-slate-500 mt-1">Otomasi rekonsiliasi perbankan, penerbitan invoice kolektif, dan notifikasi WhatsApp Gateway terintegrasi.</p>
                </div>
                <div class="flex flex-wrap items-center gap-2.5">
                    <button onclick="showToast('Filter bulan aktif: Maret 2025','info')" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 transition shadow-sm">
                        <i class="fas fa-calendar-day text-indigo-600 text-xs"></i><span>Bulan Ini - Maret 2025</span><i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                    </button>
                    <button onclick="showToast('Gateway perbankan & QRIS tersinkronisasi 100%.','success')" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 transition shadow-sm">
                        <i class="fas fa-arrows-rotate text-emerald-600 text-xs"></i><span>Sinkronisasi Gateway</span>
                    </button>
                    <button onclick="openModalTagihan()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 transition active:scale-95">
                        <i class="fas fa-plus"></i><span>+ Buat Tagihan Baru / Kolektif</span>
                    </button>
                </div>
            </div>

            {{-- 4 STAT CARDS (SESUAI GAMBAR) --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- 1. PENERIMAAN SPP --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Penerimaan SPP Bulan Ini</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2">
                                <span>{{ $stats['penerimaan_bulan_ini']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base"><i class="fas fa-wallet"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-[11px] font-semibold text-slate-400">{{ $stats['penerimaan_bulan_ini']['target'] }}</span>
                        <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-bold text-[10px]">{{ $stats['penerimaan_bulan_ini']['pct'] }}</span>
                    </div>
                </div>

                {{-- 2. TAGIHAN BELUM LUNAS (PENDING) --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Tagihan Belum Lunas (Pending)</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2">
                                <span>{{ $stats['tagihan_pending']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-base"><i class="fas fa-hourglass-half"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                        <span class="text-[11px] text-amber-600"><i class="fas fa-user-clock mr-1 text-[10px]"></i>{{ $stats['tagihan_pending']['sub1'] }}</span>
                        <span class="text-[11px] text-slate-400">{{ $stats['tagihan_pending']['sub2'] }}</span>
                    </div>
                </div>

                {{-- 3. JATUH TEMPO MINGGU INI --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Jatuh Tempo Minggu Ini</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 text-rose-600">
                                <span>{{ $stats['jatuh_tempo_minggu']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-base"><i class="fas fa-calendar-xmark"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                        <span class="text-[11px] text-rose-600"><i class="fas fa-triangle-exclamation mr-1 text-[10px]"></i>{{ $stats['jatuh_tempo_minggu']['sub1'] }}</span>
                        <span class="text-[11px] text-slate-400">{{ $stats['jatuh_tempo_minggu']['sub2'] }}</span>
                    </div>
                </div>

                {{-- 4. OTOMATIS VIA QRIS / VA --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Otomatis via QRIS / VA</span>
                            <div class="font-heading font-black text-2xl text-[#3b49df] mt-2">
                                <span>{{ $stats['otomatis_gateway']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base"><i class="fas fa-qrcode"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                        <span class="text-[11px] text-emerald-600"><i class="fas fa-arrow-trend-up mr-1 text-[10px]"></i>{{ $stats['otomatis_gateway']['sub'] }}</span>
                        <span class="text-[11px] text-slate-400">Payment Gateway</span>
                    </div>
                </div>
            </div>

            {{-- BANNER SISTEM REMINDER OTOMATIS (SESUAI GAMBAR) --}}
            <div class="rounded-2xl bg-emerald-50/90 border border-emerald-200 p-4.5 flex flex-col md:flex-row md:items-center justify-between gap-4 shadow-sm">
                <div class="flex items-center gap-3.5">
                    <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-lg shrink-0 shadow-sm shadow-emerald-200">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-heading font-black text-sm text-slate-900">Sistem Reminder Tagihan Otomatis Aktif</h2>
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-extrabold bg-emerald-600 text-white tracking-wider uppercase">Auto-Pilot</span>
                        </div>
                        <p class="text-xs text-slate-600 mt-0.5 leading-relaxed">
                            Jadwal pengiriman: H-3 sebelum jatuh tempo, H-Day hari ini, dan H+2 bagi yang terlambat. 
                            Terdapat <strong class="text-emerald-800">{{ $countPending + $countTerlambat }} notifikasi WhatsApp</strong> siap dikirim saat ini.
                        </p>
                    </div>
                </div>
                <div class="shrink-0">
                    <button onclick="blastReminderAction()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold shadow-md shadow-emerald-200 transition active:scale-95">
                        <i class="fas fa-paper-plane text-xs"></i>
                        <span>Kirim Blast Reminder WhatsApp Sekaligus ({{ $countPending + $countTerlambat }} Wali)</span>
                    </button>
                </div>
            </div>

            {{-- SPLIT VIEW (LEFT: TABEL DAFTAR TAGIHAN 7 COLS | RIGHT: PRATINJAU KUITANSI 5 COLS) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                {{-- LEFT COLUMN: DAFTAR TAGIHAN SPP --}}
                <div class="lg:col-span-7 space-y-4">
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        {{-- Header Tabel & Tabs --}}
                        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-2.5">
                                <h3 class="font-heading font-black text-base text-slate-900">Daftar Tagihan SPP</h3>
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">{{ $totalFaktur }} Faktur</span>
                            </div>

                            <div class="flex items-center gap-1.5 flex-wrap">
                                <a href="{{ route('bimbel.tagihan', ['tab' => 'semua']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ $tab === 'semua' ? 'bg-[#3b49df] text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">Semua</a>
                                <a href="{{ route('bimbel.tagihan', ['tab' => 'pending']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ $tab === 'pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">Pending ({{ $countPending }})</a>
                                <a href="{{ route('bimbel.tagihan', ['tab' => 'lunas']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ $tab === 'lunas' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">Lunas ({{ $countLunas }})</a>
                                <a href="{{ route('bimbel.tagihan', ['tab' => 'terlambat']) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition {{ $tab === 'terlambat' ? 'bg-rose-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">Terlambat ({{ $countTerlambat }})</a>
                                <button onclick="showToast('Filter lanjutan aktif.','info')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center text-slate-500 text-xs transition">
                                    <i class="fas fa-sliders"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Table --}}
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="bg-slate-50/80 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider border-b border-slate-100">
                                        <th class="py-3 px-4">No. Invoice & Siswa</th>
                                        <th class="py-3 px-3">Komponen Biaya</th>
                                        <th class="py-3 px-3">Jumlah</th>
                                        <th class="py-3 px-3">Jatuh Tempo</th>
                                        <th class="py-3 px-3">Metode</th>
                                        <th class="py-3 px-4 text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @if(count($filteredList) > 0)
                                        @foreach($filteredList as $item)
                                        @php
                                            $isSelected = ($selectedFaktur && $selectedFaktur['id'] == $item['id']);
                                            $statusCls = match(strtolower($item['status'])) {
                                                'lunas' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                'terlambat' => 'bg-rose-50 text-rose-700 border-rose-200',
                                                default => 'bg-amber-50 text-amber-700 border-amber-200'
                                            };
                                        @endphp
                                        <tr onclick="selectFaktur({{ $item['id'] }})" class="cursor-pointer transition hover:bg-indigo-50/30 {{ $isSelected ? 'bg-indigo-50/60 font-medium' : '' }}">
                                            <td class="py-3.5 px-4">
                                                <div class="font-mono text-[10px] font-bold text-indigo-600">{{ $item['no_invoice'] }}</div>
                                                <div class="font-bold text-xs text-slate-900 mt-0.5">{{ $item['nama_siswa'] }}</div>
                                                <div class="text-[10px] text-slate-400">{{ $item['kelas_program'] }}</div>
                                            </td>
                                            <td class="py-3.5 px-3">
                                                <div class="font-semibold text-slate-700">{{ $item['komponen_biaya'] }}</div>
                                                <div class="text-[10px] text-slate-400">{{ $item['komponen_sub'] ?? 'SPP Reguler' }}</div>
                                            </td>
                                            <td class="py-3.5 px-3">
                                                <div class="font-heading font-black text-xs text-slate-900">{{ $item['nominal_formatted'] }}</div>
                                            </td>
                                            <td class="py-3.5 px-3">
                                                <div class="font-semibold text-slate-700">{{ $item['jatuh_tempo'] }}</div>
                                                <div class="text-[10px] font-bold {{ strtolower($item['status']) === 'lunas' ? 'text-emerald-600' : (strtolower($item['status']) === 'terlambat' ? 'text-rose-600' : 'text-amber-600') }}">
                                                    {{ $item['jatuh_tempo_badge'] }}
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-3">
                                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                                    {{ $item['metode'] }}
                                                </span>
                                            </td>
                                            <td class="py-3.5 px-4 text-center">
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border {{ $statusCls }}">
                                                    <span class="w-1.5 h-1.5 rounded-full {{ strtolower($item['status']) === 'lunas' ? 'bg-emerald-500' : (strtolower($item['status']) === 'terlambat' ? 'bg-rose-500' : 'bg-amber-500') }}"></span>
                                                    {{ strtoupper($item['status']) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        {{-- EMPTY STATE SESUAI PERMINTAAN USER --}}
                                        <tr>
                                            <td colspan="6" class="py-16 px-6 text-center">
                                                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                                                    <div class="w-16 h-16 rounded-3xl bg-indigo-50 border border-indigo-100 text-[#3b49df] flex items-center justify-center text-2xl mb-4 shadow-sm">
                                                        <i class="fas fa-file-invoice-dollar"></i>
                                                    </div>
                                                    <h4 class="font-heading font-black text-base text-slate-900">Belum Ada Tagihan SPP Diterbitkan</h4>
                                                    <p class="text-xs text-slate-400 mt-1 leading-relaxed">
                                                        Daftar invoice dan pembayaran SPP masih kosong. Klik tombol di bawah untuk menerbitkan tagihan pertama Anda.
                                                    </p>
                                                    <button onclick="openModalTagihan()" class="mt-5 px-5 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95 flex items-center gap-2">
                                                        <i class="fas fa-plus"></i><span>+ Buat Tagihan Baru / Kolektif</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination footer dummy matching screenshot --}}
                        <div class="p-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-400">
                            <div>Menampilkan {{ count($filteredList) }} dari {{ $totalFaktur }} data siswa</div>
                            <div class="flex items-center gap-1">
                                <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 text-[10px]"><i class="fas fa-chevron-left"></i></button>
                                <button class="w-7 h-7 rounded-lg bg-[#3b49df] text-white font-bold text-xs flex items-center justify-center">1</button>
                                <button class="w-7 h-7 rounded-lg border border-slate-200 flex items-center justify-center hover:bg-slate-50 text-[10px]"><i class="fas fa-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- 3 MINI STATS DI BAWAH TABEL (SESUAI GAMBAR) --}}
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-3.5 shadow-sm flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-indigo-50 text-[#3b49df] flex items-center justify-center text-sm shrink-0">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">VA Terbit Aktif</div>
                                <div class="font-heading font-black text-sm text-slate-900 leading-tight">{{ $metaStats['va_terbit'] }} Akun</div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-slate-200/80 p-3.5 shadow-sm flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm shrink-0">
                                <i class="fas fa-circle-check"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Auto Reconciled</div>
                                <div class="font-heading font-black text-sm text-slate-900 leading-tight">100% Real-Time</div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-slate-200/80 p-3.5 shadow-sm flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm shrink-0">
                                <i class="fas fa-cash-register"></i>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase">Konfirmasi Manual</div>
                                <div class="font-heading font-black text-sm text-slate-900 leading-tight">{{ $metaStats['konfirmasi_manual'] }} Permintaan</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: PRATINJAU LEMBAR KUITANSI RESMI (SESUAI GAMBAR) --}}
                <div class="lg:col-span-5 space-y-4">
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">
                        
                        {{-- Top header kuitansi --}}
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-eye text-[#3b49df] text-sm"></i>
                                <h3 class="font-heading font-black text-sm text-slate-900">Pratinjau Lembar Kuitansi Resmi</h3>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <button onclick="window.print()" class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 text-[11px] font-bold text-slate-600 transition flex items-center gap-1.5">
                                    <i class="fas fa-print text-[10px]"></i><span>Cetak Faktur</span>
                                </button>
                                <button onclick="showToast('Faktur PDF siap diunduh.','info')" class="px-2.5 py-1 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 text-[11px] font-bold text-slate-600 transition flex items-center gap-1.5">
                                    <i class="fas fa-file-pdf text-[10px]"></i><span>PDF</span>
                                </button>
                            </div>
                        </div>

                        @if($selectedFaktur)
                            {{-- LEMBAR FAKTUR RESMI --}}
                            <div class="p-5 rounded-2xl border border-slate-200/90 bg-slate-50/40 space-y-4">
                                
                                {{-- Brand Header --}}
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-start gap-2.5">
                                        <div class="w-8 h-8 rounded-xl bg-[#3b49df] text-white flex items-center justify-center font-black text-xs shrink-0 shadow-sm shadow-indigo-200">
                                            E
                                        </div>
                                        <div>
                                            <h4 class="font-heading font-black text-sm text-slate-900 leading-tight">EduPulse Academy</h4>
                                            <p class="text-[10px] text-slate-500 font-medium">Bimbingan Belajar & Persiapan PTN Unggulan</p>
                                            <p class="text-[9px] text-slate-400">Cabang Jakarta Selatan &bull; Izin Diknas: 421.9/204/BIMBEL/2023</p>
                                        </div>
                                    </div>
                                    <div class="text-right bg-indigo-50/80 border border-indigo-100 px-3 py-2 rounded-xl shrink-0">
                                        <div class="text-[9px] font-extrabold uppercase text-indigo-700">Faktur Tagihan</div>
                                        <div class="font-mono font-bold text-xs text-slate-900 mt-0.5">{{ $selectedFaktur['no_invoice'] }}</div>
                                        <div class="text-[9px] font-extrabold text-amber-600 mt-0.5">{{ strtoupper($selectedFaktur['status']) }}</div>
                                    </div>
                                </div>

                                {{-- Info Ditagihkan & Waktu --}}
                                <div class="grid grid-cols-2 gap-3 pt-3 border-t border-slate-200/80 text-[11px]">
                                    <div>
                                        <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">Ditagihkan Kepada:</div>
                                        <div class="font-black text-xs text-slate-900">{{ $selectedFaktur['nama_siswa'] }}</div>
                                        <div class="text-[10px] text-slate-500">{{ $selectedFaktur['kelas_program'] }} &bull; {{ $selectedFaktur['target_kampus'] }}</div>
                                        <div class="text-[10px] text-slate-400 mt-0.5">Wali: {{ $selectedFaktur['nama_wali'] }} ({{ $selectedFaktur['no_wa_wali'] }})</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[9px] font-extrabold uppercase tracking-wider text-slate-400 mb-1">Detail Waktu & VA:</div>
                                        <div class="text-[10px] text-slate-500">Diterbitkan: <strong class="text-slate-700">{{ $selectedFaktur['tgl_terbit'] }}</strong></div>
                                        <div class="text-[10px] text-rose-600 font-bold">Jatuh Tempo: {{ $selectedFaktur['jatuh_tempo'] }}</div>
                                        <div class="mt-1.5 inline-block px-2 py-1 rounded bg-indigo-50 border border-indigo-100 font-mono text-[10px] font-black text-[#3b49df]">
                                            {{ $selectedFaktur['va_number'] }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Rincian Tabel Komponen Biaya --}}
                                <div class="pt-2">
                                    <table class="w-full text-[11px]">
                                        <thead>
                                            <tr class="border-y border-slate-200 text-[9px] font-extrabold uppercase text-slate-400">
                                                <th class="py-2 text-left">Uraian Akademik</th>
                                                <th class="py-2 text-center">Bulan/Vol</th>
                                                <th class="py-2 text-right">Nominal</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            @foreach($selectedFaktur['items'] as $it)
                                            <tr>
                                                <td class="py-2 text-left">
                                                    <div class="font-bold text-slate-900">{{ $it['uraian'] }}</div>
                                                    <div class="text-[9px] text-slate-400 leading-snug">{{ $it['keterangan'] }}</div>
                                                </td>
                                                <td class="py-2 text-center text-[10px] text-slate-500">{{ $it['periode'] }}</td>
                                                <td class="py-2 text-right font-bold text-slate-900">{{ $it['nominal'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Total Calculation --}}
                                <div class="pt-3 border-t border-slate-200/80 space-y-1.5 text-xs">
                                    <div class="flex justify-between text-slate-500 text-[11px]">
                                        <span>Subtotal Biaya</span>
                                        <span class="font-bold text-slate-800">{{ $selectedFaktur['subtotal'] }}</span>
                                    </div>
                                    <div class="flex justify-between text-slate-500 text-[11px]">
                                        <span>Biaya Layanan Payment Gateway</span>
                                        <span class="font-bold text-emerald-600">{{ $selectedFaktur['biaya_gateway'] }}</span>
                                    </div>
                                    <div class="flex justify-between pt-2 border-t border-slate-200 items-baseline">
                                        <span class="font-heading font-black text-sm text-slate-900">Total Tagihan</span>
                                        <span class="font-heading font-black text-lg text-[#3b49df]">{{ $selectedFaktur['total'] }}</span>
                                    </div>
                                </div>

                                {{-- Footer Validasi & Stempel --}}
                                <div class="pt-4 border-t border-slate-200/80 flex items-center justify-between">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-12 h-12 bg-white border border-slate-200 rounded-lg p-1 flex items-center justify-center">
                                            <i class="fas fa-qrcode text-2xl text-slate-800"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-[10px] text-slate-800">Validasi QR Resmi</div>
                                            <p class="text-[9px] text-slate-400 max-w-[120px] leading-tight">Pindai kamera untuk bukti bayar sah & riwayat belajar siswa.</p>
                                        </div>
                                    </div>

                                    <div class="text-right flex items-center gap-3">
                                        <div class="receipt-stamp">
                                            <span>EduPulse<br>Sah & Valid</span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-[11px] text-slate-900">Sarah Maharani, M.Pd</div>
                                            <div class="text-[9px] text-slate-400">Kepala Administrasi & Kasir</div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- ACTION BUTTONS FAKTUR --}}
                            <div class="space-y-2 pt-2">
                                <button onclick="kirimWaFakturAction({{ $selectedFaktur['id'] }})" class="w-full py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md shadow-emerald-200 transition active:scale-95 flex items-center justify-center gap-2">
                                    <i class="fab fa-whatsapp text-sm"></i>
                                    <span>Kirim Faktur Digital ke WA Orang Tua</span>
                                </button>
                                
                                @if(strtolower($selectedFaktur['status']) !== 'lunas')
                                    <form action="{{ route('bimbel.tagihan.bayar', $selectedFaktur['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-sm shadow-indigo-200 transition active:scale-95 flex items-center justify-center gap-2">
                                            <i class="fas fa-check-double text-xs"></i>
                                            <span>Konfirmasi Bayar / Tandai LUNAS</span>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        @else
                            {{-- EMPTY STATE PREVIEW --}}
                            <div class="py-16 text-center flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-2xl bg-indigo-50 border border-indigo-100 text-[#3b49df] flex items-center justify-center text-2xl mb-4">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <h4 class="font-heading font-black text-sm text-slate-800">Pilih Faktur untuk Melihat Pratinjau</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-xs leading-relaxed">
                                    Kuitansi resmi lengkap dengan rincian biaya, nomor VA, dan QR validasi akan tampil di sini setelah faktur dipilih atau dibuat.
                                </p>
                                <button onclick="openModalTagihan()" class="mt-4 px-4 py-2 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs transition">
                                    + Terbitkan Tagihan Pertama
                                </button>
                            </div>
                        @endif

                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

{{-- ========================= MODAL BUAT TAGIHAN ========================= --}}
<div id="modalTagihan" class="modal-bd" onclick="if(event.target===this)closeModalTagihan()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#3b49df] text-white flex items-center justify-center text-sm shadow-md shadow-indigo-200">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Buat Tagihan SPP Baru</h2>
                    <p class="text-xs text-slate-400">Terbitkan faktur bimbel & generate nomor Virtual Account</p>
                </div>
            </div>
            <button onclick="closeModalTagihan()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('bimbel.tagihan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Siswa <span class="text-red-500">*</span></label>
                <input type="text" name="nama_siswa" placeholder="cth: Ahmad Farhan Rafif" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Kelas / Program <span class="text-red-500">*</span></label>
                    <input type="text" name="kelas_program" placeholder="cth: 12 IPA &bull; Target FK UI" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Target Kampus / Jurusan</label>
                    <input type="text" name="target_kampus" placeholder="cth: FK Universitas Indonesia" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Wali Murid</label>
                    <input type="text" name="nama_wali" placeholder="cth: Ir. Hendrawan" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">No WhatsApp Wali</label>
                    <input type="text" name="no_wa_wali" placeholder="cth: 0812-8899-2311" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Komponen Biaya</label>
                <input type="text" name="komponen_biaya" placeholder="cth: SPP Mar + Modul SNBT + Try Out Akbar #3" value="SPP Mar + Modul SNBT + Try Out Akbar" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Total Nominal (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="nominal" placeholder="cth: 1450000" value="1450000" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Jatuh Tempo</label>
                    <input type="date" name="jatuh_tempo" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Metode Pembayaran</label>
                    <select name="metode" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
                        <option value="BCA VA">BCA Virtual Account</option>
                        <option value="QRIS Auto">QRIS Auto-Sync</option>
                        <option value="BNI VA">BNI Virtual Account</option>
                        <option value="Mandiri VA">Mandiri Virtual Account</option>
                        <option value="Tunai">Kasir Tunai / Manual</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Status Awal</label>
                    <select name="status" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
                        <option value="Pending">Pending (Menunggu Bayar)</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Terlambat">Terlambat</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalTagihan()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95">Terbitkan Faktur</button>
            </div>
        </form>
    </div>
</div>

<div class="toast-wrap" id="tw"></div>

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    function showToast(msg, type = 'info') {
        const w = document.getElementById('tw');
        const icons = { success: 'fa-circle-check', error: 'fa-circle-xmark', info: 'fa-circle-info' };
        const t = document.createElement('div');
        t.className = `toast-item ${type}`;
        t.innerHTML = `<i class="fas ${icons[type] || 'fa-circle-info'}"></i><span>${msg}</span>`;
        w.appendChild(t);
        setTimeout(() => t.remove(), 3500);
    }

    function openModalTagihan() { document.getElementById('modalTagihan').classList.add('open'); }
    function closeModalTagihan() { document.getElementById('modalTagihan').classList.remove('open'); }

    function selectFaktur(id) {
        const u = new URL(location.href);
        u.searchParams.set('id', id);
        location.href = u.toString();
    }

    function blastReminderAction() {
        fetch('{{ route("bimbel.tagihan.blast") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({})
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                showToast(d.message, 'success');
            }
        })
        .catch(() => showToast('Gagal mengirim blast WhatsApp.', 'error'));
    }

    function kirimWaFakturAction(id) {
        fetch(`/bimbel/tagihan/${id}/reminder`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({})
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                showToast(d.message, 'success');
            }
        })
        .catch(() => showToast('Gagal mengirim reminder WhatsApp.', 'error'));
    }
</script>
</body>
</html>