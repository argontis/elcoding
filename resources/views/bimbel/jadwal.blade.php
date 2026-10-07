<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jadwal Kelas & Absensi — EduPulse Academy</title>
    <meta name="description" content="Kelola jadwal kelas dan absensi real-time EduPulse Academy Bimbel SaaS.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans','sans-serif'],
                        heading: ['Outfit','sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .ss::-webkit-scrollbar { width: 4px; }
        .ss::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .toast-wrap { position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
        .toast-item { display: flex; align-items: center; gap: 12px; background: #1e293b; color: #fff; padding: 12px 18px; border-radius: 14px; font-size: 13px; font-weight: 600; box-shadow: 0 8px 32px rgba(0,0,0,.25); animation: ti .28s ease; min-width: 260px; }
        .toast-item.success { background: #14532d; border-left: 4px solid #22c55e; }
        .toast-item.error { background: #7f1d1d; border-left: 4px solid #ef4444; }
        .toast-item.info { background: #1e3a5f; border-left: 4px solid #3b82f6; }
        @keyframes ti { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: translateY(0); } }
        .modal-bd { position: fixed; inset: 0; z-index: 50; background: rgba(0,0,0,.45); backdrop-filter: blur(4px); display: none; align-items: center; justify-content: center; padding: 1rem; }
        .modal-bd.open { display: flex; }
        .modal-card { background: #fff; border-radius: 24px; max-width: 520px; width: 100%; padding: 28px; box-shadow: 0 24px 64px rgba(0,0,0,.18); border: 1px solid #f1f5f9; max-height: 90vh; overflow-y: auto; animation: ti .25s ease; }
        .btn-ab { padding: 4px 10px; border-radius: 8px; font-size: 11px; font-weight: 700; cursor: pointer; transition: all .15s; border: 1px solid transparent; }
        .btn-h { background: #dcfce7; color: #166534; border-color: #86efac; }
        .btn-i { background: #fef9c3; color: #a16207; border-color: #fde047; }
        .btn-s { background: #fee2e2; color: #b91c1c; border-color: #fca5a5; }
        .btn-a { background: #f1f5f9; color: #475569; border-color: #cbd5e1; }
        .btn-ab.ah { background: #166534; color: #fff; border-color: #166534; }
        .btn-ab.ai { background: #a16207; color: #fff; border-color: #a16207; }
        .btn-ab.as2 { background: #b91c1c; color: #fff; border-color: #b91c1c; }
        .btn-ab.aa { background: #475569; color: #fff; border-color: #475569; }
        @keyframes pr { 0% { transform: scale(.9); opacity: .5; } 70% { transform: scale(1.1); opacity: .15; } 100% { transform: scale(.9); opacity: .5; } }
        .live-dot { position: relative; display: inline-block; }
        .live-dot::after { content: ''; position: absolute; top: -3px; left: -3px; right: -3px; bottom: -3px; border-radius: 50%; border: 2px solid #ef4444; animation: pr 1.5s ease-out infinite; }
        .dist-bar-track { width: 32px; height: 50px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: flex-end; overflow: hidden; }
        .dist-bar-fill { width: 100%; background: linear-gradient(to top,#3b49df,#818cf8); border-radius: 6px; min-height: 2px; transition: height .6s ease; }
    </style>
</head>
<body class="antialiased">
<div class="flex h-screen overflow-hidden bg-slate-50">

    {{-- SIDEBAR --}}
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
                <i class="fas fa-building text-[10px] text-indigo-500 shrink-0"></i>
            </div>
        </div>

        <nav class="flex-1 px-3 py-3 space-y-1.5 overflow-y-auto ss">
            <a href="{{ route('bimbel.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-grid-2 text-slate-400 text-sm w-4 text-center"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('bimbel.siswa') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <div class="flex items-center gap-3"><i class="fas fa-user-group text-slate-400 text-sm w-4 text-center"></i><span>Siswa & Pendaftaran</span></div>
                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-indigo-50 text-indigo-600">PPDB</span>
            </a>
            <a href="{{ route('bimbel.jadwal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-md shadow-indigo-200">
                <i class="fas fa-calendar-days text-sm w-4 text-center"></i><span>Jadwal & Absensi</span>
            </a>
            <a href="{{ route('bimbel.tagihan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-file-invoice-dollar text-slate-400 text-sm w-4 text-center"></i><span>Tagihan & SPP</span>
            </a>
            <a href="{{ route('bimbel.materi') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-book-open text-slate-400 text-sm w-4 text-center"></i><span>Materi & Kurikulum</span>
            </a>
            <a href="{{ route('bimbel.progress') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-chart-line text-slate-400 text-sm w-4 text-center"></i><span>Progress & Rapor</span>
            </a>
            <a href="{{ route('bimbel.ai_tutor') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-robot text-slate-400 text-sm w-4 text-center"></i><span>AI Tutor Assistant</span>
            </a>
            <a href="{{ route('bimbel.pengaturan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-gear text-slate-400 text-sm w-4 text-center"></i><span>Pengaturan</span>
            </a>
        </nav>

        <div class="p-3 m-3 rounded-xl bg-slate-50 border border-slate-200/70 text-center">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-500 mb-1"></span>
            <div class="text-[11px] font-bold text-slate-700">EduPulse SaaS v2.4</div>
            <div class="text-[10px] text-slate-400">Status Sistem Aktif</div>
        </div>
    </aside>

    {{-- MAIN CONTAINER --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- TOP NAVBAR --}}
        <header class="bg-white border-b border-slate-200/80 px-6 py-3.5 flex items-center justify-between shrink-0 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="fas fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Cari sesi, mapel, atau tutor..." class="pl-8 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 focus:outline-none focus:border-indigo-500 w-64 placeholder-slate-400">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-indigo-50 border border-indigo-100 text-xs font-semibold text-indigo-700">
                    <i class="fas fa-calendar-check text-[11px]"></i>
                    <span>{{ $academicYear }}</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-semibold text-emerald-700">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 live-dot"></span>
                    <span>WA Gateway Siap</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50">
                    <div class="w-7 h-7 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold text-xs">
                        {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-bold text-slate-800 leading-tight">{{ $user->name ?? 'EduPulse Admin' }}</div>
                        <div class="text-[10px] text-slate-400">Bimbel Admin</div>
                    </div>
                </div>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto p-6 space-y-6">

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

            {{-- HEADER & BUTTONS --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-0.5">Modul Akademik & Presensi</div>
                    <h1 class="font-heading font-black text-2xl text-slate-900 leading-tight">Jadwal Kelas & Absensi <span class="text-[#3b49df]">Real-Time</span></h1>
                    <p class="text-xs text-slate-500 mt-1">Kelola sesi pengajaran bimbel, monitoring presensi per kelas, dan otomasi log WhatsApp wali.</p>
                </div>
                <div class="flex items-center gap-2.5">
                    <button onclick="showToast('Export rekap presensi PDF siap.','info')" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 transition shadow-sm">
                        <i class="fas fa-print text-slate-400"></i><span>Cetak Rekap</span>
                    </button>
                    <button onclick="openModalSesi()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 transition active:scale-95">
                        <i class="fas fa-plus"></i><span>+ Buat Sesi Kelas Baru</span>
                    </button>
                </div>
            </div>

            {{-- 4 STAT CARDS --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Sesi Hari Ini</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                <span>{{ $stats['sesi_hari_ini']['val'] }}</span>
                                <span class="text-xs font-semibold text-slate-400">Sesi</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm"><i class="fas fa-chalkboard-user"></i></div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-[11px] text-slate-400 flex items-center justify-between font-semibold">
                        <span>{{ $stats['sesi_hari_ini']['sub'] }}</span>
                        <span class="text-indigo-600">{{ $stats['sesi_hari_ini']['pct_slot'] }}</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Tingkat Kehadiran</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2">
                                <span>{{ $stats['kehadiran']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm"><i class="fas fa-user-check"></i></div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-[11px] text-slate-400 flex items-center justify-between font-semibold">
                        <span>{{ $stats['kehadiran']['sub'] }}</span>
                        <span class="text-emerald-600">{{ $stats['kehadiran']['growth'] }}</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Siswa Izin / Sakit</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                <span>{{ $stats['izin_sakit']['val'] }}</span>
                                <span class="text-xs font-semibold text-slate-400">Siswa</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm"><i class="fas fa-file-medical"></i></div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-[11px] text-slate-400 flex items-center justify-between font-semibold">
                        <span>{{ $stats['izin_sakit']['sub1'] }}</span>
                        <span class="text-amber-600">{{ $stats['izin_sakit']['sub2'] }}</span>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Pengajar Bertugas</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                <span>{{ $stats['pengajar']['val'] }}</span>
                                <span class="text-xs font-semibold text-slate-400">Tutor</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-sm"><i class="fas fa-person-chalkboard"></i></div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 text-[11px] text-slate-400 flex items-center justify-between font-semibold">
                        <span>{{ $stats['pengajar']['sub1'] }}</span>
                        <span class="text-violet-600">{{ $stats['pengajar']['sub2'] }}</span>
                    </div>
                </div>
            </div>

            {{-- WEEK FILTER / BAR --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 px-5 py-3.5 shadow-sm flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-slate-800"><i class="fas fa-calendar-day mr-1.5 text-indigo-600"></i>Pekan Aktif</span>
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-bold">Senin - Sabtu</span>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="showToast('Filter semua jadwal aktif.','info')" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-xs font-semibold text-slate-700 transition">Semua Tingkat</button>
                    <button onclick="showToast('Filter ruangan bimbel.','info')" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-xs font-semibold text-slate-700 transition">Semua Ruang</button>
                </div>
            </div>

            {{-- SPLIT VIEW --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                {{-- LEFT: SESI JADWAL (7 COLS) --}}
                <div class="lg:col-span-7 space-y-4">
                    @if(count($sesiList) > 0)
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                            <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-800">Daftar Sesi Terjadwal</span>
                                <span class="text-[11px] text-slate-400 font-medium">{{ count($sesiList) }} Sesi Kelas</span>
                            </div>
                            <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach($sesiList as $s)
                                <div onclick="selectSesi({{ $s['id'] }})" class="p-4 rounded-xl border border-slate-200 hover:border-indigo-300 bg-slate-50/50 hover:bg-indigo-50/30 cursor-pointer transition">
                                    <div class="flex items-center justify-between text-[10px] font-bold text-indigo-600 mb-1">
                                        <span>{{ $s['hari'] }} &bull; {{ $s['jam_mulai'] }} - {{ $s['jam_selesai'] }}</span>
                                        <span class="px-2 py-0.5 rounded bg-indigo-50 text-indigo-700">{{ $s['tipe'] ?? 'Online' }}</span>
                                    </div>
                                    <div class="font-bold text-sm text-slate-900">{{ $s['mata_pelajaran'] }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $s['nama_kelas'] }}</div>
                                    <div class="mt-3 pt-2.5 border-t border-slate-200/80 flex items-center justify-between text-[11px] text-slate-400 font-medium">
                                        <span><i class="fas fa-user-tie mr-1 text-[10px]"></i>{{ $s['tutor'] }}</span>
                                        <span><i class="fas fa-location-dot mr-1 text-[10px]"></i>{{ $s['ruangan'] }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        {{-- EMPTY STATE SESI --}}
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-10 text-center flex flex-col items-center justify-center">
                            <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-2xl mb-4 shadow-sm">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <h3 class="font-heading font-black text-base text-slate-900">Belum Ada Sesi Kelas Terjadwal</h3>
                            <p class="text-xs text-slate-500 mt-1 max-w-sm leading-relaxed">Jadwal saat ini masih kosong. Klik tombol di bawah untuk membuat sesi kelas pertama Anda.</p>
                            <button onclick="openModalSesi()" class="mt-5 px-5 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 transition active:scale-95 flex items-center gap-2">
                                <i class="fas fa-plus"></i><span>+ Buat Sesi Kelas Baru</span>
                            </button>
                        </div>
                    @endif

                    {{-- DISTRIBUSI BEBAN HARIAN --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Distribusi Sesi Mingguan</span>
                            <span class="text-xs font-semibold text-slate-500">Total: {{ count($sesiList) }} Sesi</span>
                        </div>
                        <div class="flex items-end justify-between gap-3 pt-2">
                            @foreach($distribusiHari as $hari => $jml)
                            @php
                                $pct = count($sesiList) > 0 ? min(100, round(($jml / max(count($sesiList), 1)) * 100)) : 0;
                            @endphp
                            <div class="flex flex-col items-center gap-1.5 flex-1">
                                <span class="text-[11px] font-bold text-slate-600">{{ $jml }}</span>
                                <div class="dist-bar-track">
                                    <div class="dist-bar-fill" style="height: {{ max($pct, 6) }}%"></div>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400">{{ $hari }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- RIGHT: LIVE ROSTER & ABSENSI (5 COLS) --}}
                <div class="lg:col-span-5 space-y-4">
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                        {{-- Header Roster --}}
                        <div class="px-5 py-4 border-b border-slate-100 bg-gradient-to-r from-indigo-50/50 to-white flex items-start justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="w-2 h-2 rounded-full bg-red-500 live-dot"></span>
                                    <span class="text-[10px] font-black uppercase tracking-wider text-red-600">Live Roster Aktif</span>
                                </div>
                                @if($selectedSesi)
                                    <h2 class="font-heading font-black text-base text-slate-900 leading-snug">{{ $selectedSesi['nama_kelas'] }}</h2>
                                    <p class="text-[11px] text-slate-500 mt-0.5">{{ $selectedSesi['mata_pelajaran'] }} &bull; {{ $selectedSesi['ruangan'] }}</p>
                                @else
                                    <h2 class="font-heading font-black text-base text-slate-400 leading-snug">Pilih Sesi Kelas</h2>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Pilih sesi dari sebelah kiri untuk melihat absensi</p>
                                @endif
                            </div>
                            @if($selectedSesi)
                            <div class="text-right">
                                <span class="text-xs font-bold text-indigo-600">{{ $selectedSesi['jam_mulai'] }} - {{ $selectedSesi['jam_selesai'] }}</span>
                                <div class="text-[10px] text-slate-400 mt-0.5">Tutor: {{ $selectedSesi['tutor'] }}</div>
                            </div>
                            @endif
                        </div>

                        {{-- Action Buttons --}}
                        <div class="px-5 py-3 border-b border-slate-100 flex items-center gap-2">
                            <button onclick="hadirSemuaAction()" class="flex-1 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-700 font-bold text-xs transition flex items-center justify-center gap-1.5">
                                <i class="fas fa-check-double text-[11px]"></i><span>Hadir Semua</span>
                            </button>
                            <button onclick="openModalRoster()" class="flex-1 py-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 border border-indigo-200 text-indigo-700 font-bold text-xs transition flex items-center justify-center gap-1.5">
                                <i class="fas fa-user-plus text-[11px]"></i><span>+ Siswa</span>
                            </button>
                        </div>

                        {{-- Roster List --}}
                        <div class="divide-y divide-slate-100 max-h-[380px] overflow-y-auto ss">
                            @if(count($rosterList) > 0)
                                @foreach($rosterList as $r)
                                <div class="px-5 py-3 flex items-center justify-between gap-3 hover:bg-slate-50 transition">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ $r['initial'] ?? 'S' }}
                                        </div>
                                        <div class="truncate">
                                            <div class="font-bold text-xs text-slate-900 truncate">{{ $r['nama'] }}</div>
                                            <div class="text-[10px] text-slate-400">NIS: {{ $r['nis'] }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-1 shrink-0" data-id="{{ $r['id'] }}">
                                        <button onclick="setAb({{ $r['id'] }},'Hadir',this)" class="btn-ab btn-h {{ ($r['status']??'') === 'Hadir' ? 'ah' : '' }}">H</button>
                                        <button onclick="setAb({{ $r['id'] }},'Izin',this)" class="btn-ab btn-i {{ ($r['status']??'') === 'Izin' ? 'ai' : '' }}">I</button>
                                        <button onclick="setAb({{ $r['id'] }},'Sakit',this)" class="btn-ab btn-s {{ ($r['status']??'') === 'Sakit' ? 'as2' : '' }}">S</button>
                                        <button onclick="setAb({{ $r['id'] }},'Alpa',this)" class="btn-ab btn-a {{ !in_array($r['status']??'',['Hadir','Izin','Sakit']) ? 'aa' : '' }}">A</button>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="p-8 text-center flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center text-lg mb-2">
                                        <i class="fas fa-users-slash"></i>
                                    </div>
                                    <div class="font-bold text-xs text-slate-700">Roster Masih Kosong</div>
                                    <p class="text-[11px] text-slate-400 mt-0.5">Tambahkan siswa ke daftar hadir sesi ini.</p>
                                    <button onclick="openModalRoster()" class="mt-3 px-3.5 py-1.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs transition">
                                        + Tambah Siswa
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- WHATSAPP NOTIFIKASI OTOMASI --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Otomasi WhatsApp Wali</span>
                            <span class="px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-bold border border-emerald-200">Auto-Sync</span>
                        </div>
                        <p class="text-xs text-slate-500 mb-3 leading-relaxed">Kirim ringkasan presensi harian otomatis ke WhatsApp wali murid dengan satu klik.</p>
                        <button onclick="showToast('Notifikasi WhatsApp absensi terkirim ke wali murid!','success')" class="w-full py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-200 transition flex items-center justify-center gap-2 active:scale-95">
                            <i class="fab fa-whatsapp text-sm"></i><span>Kirim Notifikasi Absensi ke Wali Murid</span>
                        </button>
                    </div>

                    {{-- JURNAL MENGAJAR --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Jurnal Mengajar Tutor</span>
                            <span class="text-[10px] font-bold text-indigo-600">Hari Ini</span>
                        </div>
                        @if(count($jurnalList) > 0)
                            @foreach($jurnalList as $j)
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70 mb-2">
                                <div class="font-bold text-xs text-slate-800">{{ $j['tutor'] ?? 'Tutor' }}</div>
                                <p class="text-[11px] text-slate-600 mt-1">{{ $j['materi'] ?? '' }}</p>
                            </div>
                            @endforeach
                        @else
                            <div class="p-5 rounded-xl bg-slate-50 border border-dashed border-slate-200 text-center">
                                <div class="text-xs text-slate-400">Belum ada catatan jurnal sesi hari ini.</div>
                                <button onclick="showToast('Formulir jurnal mengajar dibuka.','info')" class="text-xs font-bold text-indigo-600 hover:underline mt-1.5 inline-block">+ Tambah Catatan Sesi</button>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

{{-- MODAL BUAT SESI --}}
<div id="modalSesi" class="modal-bd" onclick="if(event.target===this)closeModalSesi()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#3b49df] text-white flex items-center justify-center text-sm shadow-md shadow-indigo-200">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Buat Sesi Kelas Baru</h2>
                    <p class="text-xs text-slate-400">Tambahkan jadwal kelas bimbel baru</p>
                </div>
            </div>
            <button onclick="closeModalSesi()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition"><i class="fas fa-times"></i></button>
        </div>

        <form action="{{ route('bimbel.jadwal.sesi.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Kelas / Rombel <span class="text-red-500">*</span></label>
                <input type="text" name="nama_kelas" placeholder="cth: Kelas 12 IPA Intensif UTBK" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Mata Pelajaran <span class="text-red-500">*</span></label>
                <input type="text" name="mata_pelajaran" placeholder="cth: TPS Penalaran Matematika" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Tutor / Pengajar <span class="text-red-500">*</span></label>
                    <input type="text" name="tutor" placeholder="cth: Kak Rendy M.Sc." required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Ruangan</label>
                    <input type="text" name="ruangan" placeholder="cth: Ruang Einstein (Lantai 2)" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Jam Mulai <span class="text-red-500">*</span></label>
                    <input type="time" name="jam_mulai" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Jam Selesai <span class="text-red-500">*</span></label>
                    <input type="time" name="jam_selesai" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Hari <span class="text-red-500">*</span></label>
                    <select name="hari" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Tipe Sesi</label>
                    <select name="tipe" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
                        <option value="Offline">Offline / Tatap Muka</option>
                        <option value="Online">Online / Zoom</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalSesi()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95">Simpan Jadwal</button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL TAMBAH SISWA ROSTER --}}
<div id="modalRoster" class="modal-bd" onclick="if(event.target===this)closeModalRoster()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-sm shadow-md shadow-emerald-200">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Tambah Siswa ke Roster</h2>
                    <p class="text-xs text-slate-400">Catat nama siswa untuk sesi absensi</p>
                </div>
            </div>
            <button onclick="closeModalRoster()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition"><i class="fas fa-times"></i></button>
        </div>

        <form action="{{ route('bimbel.jadwal.roster.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap Siswa <span class="text-red-500">*</span></label>
                <input type="text" name="nama" placeholder="cth: Muhammad Fathan" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">NIS (Nomor Induk Siswa)</label>
                <input type="text" name="nis" placeholder="Kosongkan untuk otomatis" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>
            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalRoster()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md shadow-emerald-200 transition active:scale-95">Tambahkan ke Roster</button>
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

    function openModalSesi() { document.getElementById('modalSesi').classList.add('open'); }
    function closeModalSesi() { document.getElementById('modalSesi').classList.remove('open'); }
    function openModalRoster() { document.getElementById('modalRoster').classList.add('open'); }
    function closeModalRoster() { document.getElementById('modalRoster').classList.remove('open'); }

    function selectSesi(id) {
        const u = new URL(location.href);
        u.searchParams.set('sesi', id);
        location.href = u.toString();
    }

    function setAb(id, status, btn) {
        fetch(`/bimbel/jadwal/absensi/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF
            },
            body: JSON.stringify({ status })
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                const row = btn.closest('[data-id]');
                row.querySelectorAll('.btn-ab').forEach(b => b.classList.remove('ah','ai','as2','aa'));
                const map = { Hadir: 'ah', Izin: 'ai', Sakit: 'as2', Alpa: 'aa' };
                btn.classList.add(map[status] || 'aa');
                showToast(`Presensi diubah: ${status}`, 'success');
                setTimeout(() => location.reload(), 1000);
            }
        })
        .catch(() => showToast('Gagal update presensi.', 'error'));
    }

    function hadirSemuaAction() {
        fetch('/bimbel/jadwal/hadir-semua', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF
            },
            body: JSON.stringify({})
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                showToast(d.message, 'success');
                setTimeout(() => location.reload(), 1000);
            }
        })
        .catch(() => showToast('Gagal memproses hadir semua.', 'error'));
    }
</script>
</body>
</html>