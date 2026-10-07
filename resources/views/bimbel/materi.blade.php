<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Repositori Materi & Kurikulum — EduPulse Academy</title>
    <meta name="description" content="Manajemen e-book silabus, bank soal berbasis IRT UTBK, rekaman video kelas, dan AI Soal Generator EduPulse Academy.">

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
            <a href="{{ route('bimbel.tagihan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-file-invoice-dollar text-slate-400 text-sm w-4 text-center"></i><span>Tagihan & SPP</span>
            </a>
            {{-- ACTIVE: MATERI & KURIKULUM --}}
            <a href="{{ route('bimbel.materi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-md shadow-indigo-200">
                <i class="fas fa-book-open text-sm w-4 text-center"></i><span>Materi & Kurikulum</span>
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
        </nav>

        <div class="m-3 p-3 rounded-xl bg-indigo-50 border border-indigo-100">
            <div class="text-xs font-bold text-indigo-700 mb-1">Bantuan Bimbel</div>
            <p class="text-[10px] text-indigo-500 leading-relaxed">Pusat panduan dan tiket bantuan teknis operasional.</p>
            <a href="javascript:void(0)" onclick="showToast('Dokumentasi kurikulum siap diakses.','info')" class="text-[10px] font-bold text-indigo-600 hover:underline mt-1 inline-block">Akses Dokumen &rarr;</a>
        </div>
    </aside>

    {{-- ========================= MAIN CONTENT ========================= --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- TOP NAVBAR --}}
        <header class="bg-white border-b border-slate-200/80 px-6 py-3.5 flex items-center justify-between shrink-0 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="fas fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="Cari siswa, materi, modul [Ctrl K]" class="pl-8 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 focus:outline-none focus:border-indigo-500 w-72 placeholder-slate-400">
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
                <button onclick="showToast('0 Notifikasi kurikulum baru.','info')" class="relative w-9 h-9 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500 hover:bg-indigo-50 transition">
                    <i class="fas fa-bell text-sm"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-[#3b49df] text-white text-[9px] font-bold flex items-center justify-center">{{ $totalModul }}</span>
                </button>
                <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-xs shrink-0">
                        S
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-bold text-slate-800 leading-tight">Sarah Maharani, M.Pd</div>
                        <div class="text-[10px] text-slate-400 font-medium">Admin Akademik</div>
                    </div>
                    <i class="fas fa-chevron-down text-slate-400 text-[10px]"></i>
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

            {{-- BREADCRUMB & HEADER --}}
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Akademik & Kurikulum &gt; Materi Pembelajaran & Bank Soal</div>
                    <h1 class="font-heading font-black text-2xl text-slate-900 leading-tight">Repositori Materi & Kurikulum</h1>
                    <div class="flex items-center gap-2 mt-1.5">
                        <button onclick="showToast('Pilihan jenjang: 12 SMA Super Intensif SNBT 2025','info')" class="flex items-center gap-2 px-3 py-1 rounded-xl bg-white border border-slate-200 text-xs font-bold text-slate-700 shadow-sm">
                            <span>12 SMA - Super Intensif SNBT 2025</span>
                            <i class="fas fa-chevron-down text-[10px] text-slate-400"></i>
                        </button>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Kurikulum Nasional 2024/2025
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2.5">
                    <button onclick="showToast('Kurikulum silabus berhasil diekspor.','info')" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-semibold text-slate-700 transition shadow-sm">
                        <i class="fas fa-download text-slate-400 text-xs"></i><span>Export Kurikulum</span>
                    </button>
                    <button onclick="openModalPaketSoal()" class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-indigo-200 bg-indigo-50 hover:bg-indigo-100 text-xs font-bold text-[#3b49df] transition shadow-sm">
                        <i class="fas fa-plus text-xs"></i><span>+ Buat Paket Soal Baru</span>
                    </button>
                    <button onclick="openModalMateri()" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold shadow-md shadow-indigo-200 transition active:scale-95">
                        <i class="fas fa-arrow-up-from-bracket"></i><span>+ Upload Modul / E-Book</span>
                    </button>
                </div>
            </div>

            {{-- 4 STAT CARDS (SESUAI GAMBAR) --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- 1. TOTAL MODUL & BAHAN AJAR --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Total Modul & Bahan Ajar</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                <span>{{ $stats['total_modul']['val'] }}</span>
                                <span class="text-xs font-medium text-slate-400">Dokumen</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base"><i class="fas fa-book"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold text-[10px]">+0 pekan ini</span>
                        <span class="text-[11px] text-slate-400">PDF, PPT & Rumus</span>
                    </div>
                </div>

                {{-- 2. BANK SOAL AKTIF --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Bank Soal Aktif</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                <span>{{ $stats['bank_soal']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base"><i class="fas fa-file-circle-check"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold text-[10px]">Bobot IRT UTBK</span>
                        <span class="text-[11px] text-slate-400">100% Pembahasan</span>
                    </div>
                </div>

                {{-- 3. VIDEO REKAMAN SESI --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Video Rekaman Sesi</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                <span>{{ $stats['video_rekaman']['val'] }}</span>
                                <span class="text-xs font-medium text-slate-400">Video HD</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-base"><i class="fas fa-video"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center gap-1.5 text-xs">
                        <i class="fas fa-arrows-rotate text-[10px] text-indigo-500"></i>
                        <span class="text-[11px] text-slate-400">{{ $stats['video_rekaman']['sub'] }}</span>
                    </div>
                </div>

                {{-- 4. RATA-RATA AKSES SISWA --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Rata-Rata Akses Siswa</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1.5">
                                <span>{{ $stats['rata_akses']['val'] }}</span>
                                <span class="text-xs font-bold text-indigo-600">{{ $stats['rata_akses']['label'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-base"><i class="fas fa-chart-pie"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <div class="w-full bg-slate-100 rounded-full h-1.5">
                            <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $totalModul > 0 ? '84.6%' : '0%' }}"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEARCH & FILTER BAR --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-4 shadow-sm space-y-3">
                <form action="{{ route('bimbel.materi') }}" method="GET" class="flex flex-col md:flex-row items-center gap-3">
                    <div class="relative flex-1 w-full">
                        <i class="fas fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Cari modul, bab pelajaran, rumus, atau kode soal... (contoh: Kalkulus, PK-09)" class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                    </div>

                    <div class="flex items-center gap-2 w-full md:w-auto">
                        <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs">
                            <span class="text-slate-400 text-[11px]">Tipe:</span>
                            <select name="tipe" onchange="this.form.submit()" class="bg-transparent text-xs font-semibold text-slate-700 focus:outline-none">
                                <option value="semua" {{ $tipeFilter === 'semua' ? 'selected' : '' }}>Semua Tipe Konten</option>
                                <option value="Modul Teori" {{ $tipeFilter === 'Modul Teori' ? 'selected' : '' }}>Modul Teori PDF</option>
                                <option value="Drilling Soal" {{ $tipeFilter === 'Drilling Soal' ? 'selected' : '' }}>Drilling Soal HOTS</option>
                                <option value="Video Sesi" {{ $tipeFilter === 'Video Sesi' ? 'selected' : '' }}>Video Sesi Tutor</option>
                                <option value="Tryout" {{ $tipeFilter === 'Tryout' ? 'selected' : '' }}>Tryout SNBT</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs">
                            <span class="text-slate-400 text-[11px]">Status:</span>
                            <select name="status" onchange="this.form.submit()" class="bg-transparent text-xs font-semibold text-slate-700 focus:outline-none">
                                <option value="semua" {{ $statusFilter === 'semua' ? 'selected' : '' }}>Semua</option>
                                <option value="terbit" {{ $statusFilter === 'terbit' ? 'selected' : '' }}>Terbit</option>
                                <option value="draf" {{ $statusFilter === 'draf' ? 'selected' : '' }}>Draf</option>
                            </select>
                        </div>
                    </div>
                </form>

                {{-- CHIP TABS MAPEL --}}
                <div class="flex items-center gap-2 overflow-x-auto ss pt-1">
                    @foreach($mapelTabs as $key => $label)
                    <a href="{{ route('bimbel.materi', array_merge(request()->query(), ['mapel' => $key])) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-bold shrink-0 transition {{ $mapelFilter === $key ? 'bg-[#3b49df] text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- SPLIT VIEW (LEFT: DAFTAR MODUL 7 COLS | RIGHT: PRATINJAU & AI TOOLS 5 COLS) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                {{-- LEFT COLUMN: DAFTAR MODUL PEMBELAJARAN (7 COLS) --}}
                <div class="lg:col-span-7 space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <h3 class="font-heading font-black text-sm text-slate-900">Daftar Modul Pembelajaran & Drilling Soal</h3>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">{{ count($filteredList) }} Item Aktif</span>
                        </div>
                        <button onclick="showToast('Urutan sesuai silabus SNBT 2025 aktif.','info')" class="text-xs font-semibold text-slate-500 hover:text-indigo-600 flex items-center gap-1">
                            <span>Urutkan: Sesuai Silabus SNBT</span>
                            <i class="fas fa-chevron-down text-[10px]"></i>
                        </button>
                    </div>

                    @if(count($filteredList) > 0)
                        <div class="space-y-4">
                            @foreach($filteredList as $item)
                            @php
                                $isSelected = ($selectedMateri && $selectedMateri['id'] == $item['id']);
                            @endphp
                            <div onclick="selectMateri({{ $item['id'] }})" class="bg-white rounded-2xl border {{ $isSelected ? 'border-indigo-400 ring-2 ring-indigo-50' : 'border-slate-200/80' }} p-5 shadow-sm hover:shadow-md transition cursor-pointer">
                                
                                {{-- Card Badges --}}
                                <div class="flex items-center justify-between mb-2.5">
                                    <div class="flex items-center gap-2">
                                        <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase tracking-wider">
                                            {{ $item['badge_bab'] }}
                                        </span>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Terbit
                                        </span>
                                        <span class="text-xs font-semibold text-slate-500">{{ $item['mapel'] }}</span>
                                    </div>
                                    <span class="text-xs font-bold text-emerald-600 flex items-center gap-1">
                                        <i class="fas fa-circle-check text-[11px]"></i>{{ $item['persen_selesai'] }}
                                    </span>
                                </div>

                                {{-- Title --}}
                                <h4 class="font-heading font-black text-base text-slate-900 leading-snug mb-3">
                                    {{ $item['judul'] }}
                                </h4>

                                {{-- 3 Pill Sub Items (PDF Teori, Drilling Soal, Video) --}}
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mb-4">
                                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/70 flex items-center gap-2.5">
                                        <i class="fas fa-file-pdf text-rose-500 text-sm"></i>
                                        <div class="min-w-0">
                                            <div class="font-bold text-[11px] text-slate-800 truncate">Modul Teori PDF</div>
                                            <div class="text-[9px] text-slate-400 truncate">{{ $item['sub_teori'] }}</div>
                                        </div>
                                    </div>
                                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/70 flex items-center gap-2.5">
                                        <i class="fas fa-list-check text-amber-500 text-sm"></i>
                                        <div class="min-w-0">
                                            <div class="font-bold text-[11px] text-slate-800 truncate">Drilling Soal</div>
                                            <div class="text-[9px] text-slate-400 truncate">{{ $item['sub_soal'] }}</div>
                                        </div>
                                    </div>
                                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/70 flex items-center gap-2.5">
                                        <i class="fas fa-circle-play text-indigo-500 text-sm"></i>
                                        <div class="min-w-0">
                                            <div class="font-bold text-[11px] text-slate-800 truncate">Video Sesi Tutor</div>
                                            <div class="text-[9px] text-slate-400 truncate">{{ $item['sub_video'] }}</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card Footer & Actions --}}
                                <div class="pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-xs">
                                    <div class="flex items-center gap-2 text-slate-400 text-[11px]">
                                        <span><i class="fas fa-eye mr-1"></i>Diakses {{ $item['diakses_count'] }}</span>
                                        <span>&bull;</span>
                                        <span>Update {{ $item['update_time'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button onclick="event.stopPropagation(); selectMateri({{ $item['id'] }})" class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 text-xs font-bold text-slate-700 transition flex items-center gap-1.5">
                                            <i class="fas fa-eye text-[10px]"></i><span>Pratinjau</span>
                                        </button>
                                        <button onclick="event.stopPropagation(); showToast('Materi siap diunduh oleh siswa.','info')" class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-slate-50 hover:bg-slate-100 text-xs font-bold text-slate-700 transition flex items-center gap-1.5">
                                            <i class="fas fa-download text-[10px]"></i><span>Download Siswa</span>
                                        </button>
                                        <button onclick="event.stopPropagation(); window.location='{{ route('bimbel.ai_tutor') }}'" class="px-3 py-1.5 rounded-lg bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
                                            <i class="fas fa-robot text-[10px]"></i><span>Buka di AI Tutor</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                    @else
                        {{-- EMPTY STATE SESUAI PERMINTAAN USER --}}
                        <div class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center shadow-sm flex flex-col items-center justify-center">
                            <div class="w-16 h-16 rounded-3xl bg-indigo-50 border border-indigo-100 text-[#3b49df] flex items-center justify-center text-2xl mb-4 shadow-sm">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h4 class="font-heading font-black text-base text-slate-900">Belum Ada Modul atau Paket Soal</h4>
                            <p class="text-xs text-slate-400 mt-1 max-w-sm leading-relaxed">
                                Repositori materi pembelajaran masih kosong. Unggah e-book materi silabus atau buat paket soal pertama Anda.
                            </p>
                            <div class="flex items-center gap-3 mt-5">
                                <button onclick="openModalMateri()" class="px-4 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95 flex items-center gap-2">
                                    <i class="fas fa-arrow-up-from-bracket"></i><span>+ Upload Modul / E-Book</span>
                                </button>
                                <button onclick="openModalPaketSoal()" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs transition flex items-center gap-2">
                                    <i class="fas fa-plus"></i><span>+ Buat Paket Soal Baru</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- RIGHT COLUMN: PRATINJAU MATERI & AI SOAL GENERATOR (5 COLS) --}}
                <div class="lg:col-span-5 space-y-4">

                    {{-- 1. PRATINJAU MATERI TERPILIH --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Pratinjau Materi Terpilih</div>
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Status: Terbit</span>
                        </div>

                        @if($selectedMateri)
                            <div>
                                <h3 class="font-heading font-black text-base text-slate-900 leading-snug">
                                    {{ $selectedMateri['judul'] }}
                                </h3>

                                <div class="grid grid-cols-2 gap-2 text-[11px] text-slate-500 mt-2.5">
                                    <div>Tipe Berkas: <strong class="text-slate-800">PDF Modul ({{ $selectedMateri['ukuran'] ?? '18.4 MB' }})</strong></div>
                                    <div>Halaman: <strong class="text-slate-800">{{ $selectedMateri['halaman'] ?? 52 }} Hal (QR Code)</strong></div>
                                    <div class="col-span-2">Pembaruan: <strong class="text-slate-800">{{ $selectedMateri['update_time'] ?? 'Kemarin' }} oleh {{ $selectedMateri['tutor'] ?? 'Dr. Rendy' }}</strong></div>
                                </div>

                                {{-- Document Preview Box --}}
                                <div class="mt-3.5 p-4 rounded-xl bg-slate-50 border border-indigo-100 space-y-2">
                                    <div class="flex items-center justify-between text-[10px] font-bold text-indigo-600 border-b border-indigo-100/60 pb-2">
                                        <span>Hal 14 dari {{ $selectedMateri['halaman'] ?? 52 }} — Bagian Teori Stasioner</span>
                                        <i class="fas fa-expand text-[10px]"></i>
                                    </div>
                                    <div class="text-xs text-slate-700 font-mono leading-relaxed whitespace-pre-line bg-white p-3 rounded-lg border border-slate-200/80">
{{ $selectedMateri['preview_snippet'] }}
                                    </div>
                                </div>

                                <div class="flex gap-2.5 pt-3">
                                    <button onclick="showToast('Membuka penampil dokumen layar penuh...','info')" class="flex-1 py-2.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 text-xs font-bold text-slate-700 transition flex items-center justify-center gap-1.5">
                                        <i class="fas fa-book-open-reader text-xs"></i><span>Buka Pembaca Penuh</span>
                                    </button>
                                    <button onclick="showToast('Unduhan paket materi lengkap dimulai...','success')" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white text-xs font-bold transition flex items-center justify-center gap-1.5 shadow-sm">
                                        <i class="fas fa-download text-xs"></i><span>Unduh Materi Lengkap</span>
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="py-8 text-center text-xs text-slate-400">
                                <i class="fas fa-file-circle-question text-3xl text-slate-300 mb-2 block"></i>
                                Pilih modul pada daftar di samping untuk melihat pratinjau dokumen & rumus.
                            </div>
                        @endif
                    </div>

                    {{-- 2. AI SOAL GENERATOR & SMART BANK (EDUPULSE LLM v3.4) --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-3.5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-xl bg-indigo-50 text-[#3b49df] flex items-center justify-center text-sm font-bold">
                                    <i class="fas fa-wand-magic-sparkles"></i>
                                </div>
                                <div>
                                    <h4 class="font-heading font-black text-xs text-slate-900 leading-tight">AI Soal Generator & Smart Bank</h4>
                                    <p class="text-[10px] text-indigo-600 font-semibold">Model: EduPulse LLM v3.4</p>
                                </div>
                            </div>
                            <span class="px-2 py-0.5 rounded-md text-[10px] font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <i class="fas fa-sparkles mr-1"></i>Cerdas
                            </span>
                        </div>

                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Generate variasi soal setipe secara otomatis dengan tingkat kesulitan dinamis dan pembahasan langkah demi langkah untuk siswa yang belum tuntas nilai KKM.
                        </p>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-[11px] font-bold text-slate-700">
                                <span>Prompt Instruksi AI</span>
                                <button type="button" onclick="fillTemplateAi()" class="text-indigo-600 hover:underline text-[10px]">Gunakan Template SNBT</button>
                            </div>
                            <textarea id="aiPrompt" rows="3" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400" placeholder="Buat 5 variasi soal setipe untuk drilling siswa yang belum tuntas materi Titik Stasioner & Turunan Aljabar. Sertakan opsi A-E, kunci jawaban, dan trik eliminasi cepat..."></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-xs">
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 block mb-1">Tingkat Kesulitan:</span>
                                <select id="aiKesulitan" class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 focus:outline-none">
                                    <option value="HOTS Sedang">HOTS Sedang</option>
                                    <option value="HOTS Tinggi">HOTS Tinggi / Lanjut</option>
                                    <option value="Konseptual">Konseptual Dasar</option>
                                </select>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-slate-400 block mb-1">Format:</span>
                                <select class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-lg text-xs font-semibold text-slate-700 focus:outline-none">
                                    <option value="Pilihan Ganda">Pilihan Ganda (A-E)</option>
                                    <option value="Esai IRT">Isian Angka UTBK</option>
                                </select>
                            </div>
                        </div>

                        <button onclick="generateSoalAction()" class="w-full py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95 flex items-center justify-center gap-2">
                            <i class="fas fa-sparkles text-xs"></i>
                            <span>Generate Soal Cerdas Sekarang</span>
                        </button>
                    </div>

                    {{-- 3. DISTRIBUSI MATERI KE KELAS --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">
                                    <i class="fas fa-share-nodes"></i>
                                </div>
                                <div>
                                    <h4 class="font-heading font-black text-xs text-slate-900 leading-tight">Distribusi Materi ke Kelas</h4>
                                    <p class="text-[10px] text-slate-400">Notifikasi Otomatis Multi-Channel</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pilih Batch Kelas Penerima:</div>
                        <div class="flex flex-wrap gap-2">
                            <label class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 border border-indigo-200 text-xs font-bold text-indigo-700 cursor-pointer">
                                <input type="checkbox" checked class="rounded text-indigo-600">
                                <span>12 IPA 1</span>
                            </label>
                            <label class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 border border-indigo-200 text-xs font-bold text-indigo-700 cursor-pointer">
                                <input type="checkbox" checked class="rounded text-indigo-600">
                                <span>12 IPA 2</span>
                            </label>
                            <label class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-indigo-50 border border-indigo-200 text-xs font-bold text-indigo-700 cursor-pointer">
                                <input type="checkbox" checked class="rounded text-indigo-600">
                                <span>SNBT Ambis</span>
                            </label>
                        </div>

                        <div class="p-3 rounded-xl bg-emerald-50/80 border border-emerald-200 text-xs text-emerald-800 font-semibold flex items-center gap-2">
                            <i class="fas fa-circle-check text-emerald-600"></i>
                            <span>Total 108 Siswa & 108 Nomor WhatsApp Wali Kelas siap menerima pesan materi.</span>
                        </div>

                        <button onclick="distribusiMateriAction()" class="w-full py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md shadow-emerald-200 transition active:scale-95 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-sm"></i>
                            <span>Kirim Notifikasi Modul ke WhatsApp Siswa & Wali</span>
                        </button>
                    </div>

                </div>

            </div>

        </main>
    </div>
</div>

{{-- ========================= MODAL UPLOAD MODUL ========================= --}}
<div id="modalMateri" class="modal-bd" onclick="if(event.target===this)closeModalMateri()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#3b49df] text-white flex items-center justify-center text-sm shadow-md shadow-indigo-200">
                    <i class="fas fa-arrow-up-from-bracket"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Upload Modul / E-Book Baru</h2>
                    <p class="text-xs text-slate-400">Tambahkan materi silabus, bab teori, dan modul PDF</p>
                </div>
            </div>
            <button onclick="closeModalMateri()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('bimbel.materi.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Modul / Bab Pelajaran <span class="text-red-500">*</span></label>
                <input type="text" name="judul" placeholder="cth: Aljabar Lanjut & Kalkulus Diferensial" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Mata Pelajaran <span class="text-red-500">*</span></label>
                    <select name="mapel" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
                        <option value="Penalaran Matematika">Penalaran Matematika</option>
                        <option value="Literasi Bhs. Indonesia">Literasi Bhs. Indonesia</option>
                        <option value="Literasi Bhs. Inggris">Literasi Bhs. Inggris</option>
                        <option value="Penalaran Umum">Penalaran Umum</option>
                        <option value="Pengetahuan Kuantitatif">Pengetahuan Kuantitatif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Kode Bab / Label</label>
                    <input type="text" name="badge_bab" placeholder="cth: MODUL BAB 04" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Jumlah Butir Soal Latihan</label>
                    <input type="number" name="jumlah_soal" value="45" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Tutor Pengampu</label>
                    <input type="text" name="tutor" value="Dr. Rendy" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Ringkasan Konsep / Formula Pokok</label>
                <textarea name="preview_snippet" rows="3" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition" placeholder="1. Definisi Turunan Implisit & Titik Balik..."></textarea>
            </div>

            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalMateri()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95">Simpan & Terbitkan Modul</button>
            </div>
        </form>
    </div>
</div>

{{-- ========================= MODAL PAKET SOAL BARU ========================= --}}
<div id="modalPaketSoal" class="modal-bd" onclick="if(event.target===this)closeModalPaketSoal()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-sm shadow-md shadow-indigo-200">
                    <i class="fas fa-file-circle-check"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Buat Paket Soal / Tryout Baru</h2>
                    <p class="text-xs text-slate-400">Rakit bank soal simulasi UTBK SNBT dengan penilaian IRT</p>
                </div>
            </div>
            <button onclick="closeModalPaketSoal()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('bimbel.materi.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="tipe_konten" value="Tryout SNBT">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Paket Soal / Event Tryout <span class="text-red-500">*</span></label>
                <input type="text" name="judul" placeholder="cth: Tryout Akbar SNBT Nasional 2025 - Paket 08" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Mata Uji / Domain</label>
                    <select name="mapel" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
                        <option value="Simulasi UTBK Real-Time">Simulasi UTBK Real-Time</option>
                        <option value="Penalaran Matematika">Penalaran Matematika</option>
                        <option value="Pengetahuan Kuantitatif">Pengetahuan Kuantitatif</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Jumlah Butir Soal (IRT)</label>
                    <input type="number" name="jumlah_soal" value="155" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
            </div>

            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalPaketSoal()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95">Simpan Paket Soal</button>
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

    function openModalMateri() { document.getElementById('modalMateri').classList.add('open'); }
    function closeModalMateri() { document.getElementById('modalMateri').classList.remove('open'); }
    function openModalPaketSoal() { document.getElementById('modalPaketSoal').classList.add('open'); }
    function closeModalPaketSoal() { document.getElementById('modalPaketSoal').classList.remove('open'); }

    function selectMateri(id) {
        const u = new URL(location.href);
        u.searchParams.set('id', id);
        location.href = u.toString();
    }

    function fillTemplateAi() {
        document.getElementById('aiPrompt').value = "Buat 5 variasi soal setipe untuk drilling siswa yang belum tuntas materi Titik Stasioner & Turunan Aljabar. Sertakan opsi A-E, kunci jawaban, dan trik eliminasi cepat.";
        showToast('Template instruksi AI SNBT dimuat!', 'info');
    }

    function generateSoalAction() {
        const prompt = document.getElementById('aiPrompt').value;
        const kesulitan = document.getElementById('aiKesulitan').value;
        showToast('EduPulse LLM v3.4 sedang memproses soal...', 'info');

        fetch('{{ route("bimbel.materi.generate_soal") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ prompt, kesulitan })
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                showToast(d.message, 'success');
            }
        })
        .catch(() => showToast('Gagal generate soal AI.', 'error'));
    }

    function distribusiMateriAction() {
        fetch('{{ route("bimbel.materi.distribusi") }}', {
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
        .catch(() => showToast('Gagal menyiarkan materi ke WhatsApp.', 'error'));
    }
</script>
</body>
</html>