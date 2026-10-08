<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AI Tutor Assistant & Smart Learning Studio — EduPulse Academy</title>
    <meta name="description" content="AI Tutor cerdas untuk drilling soal HOTS UTBK SNBT, visualisasi kurva integral, dan konsultasi interaktif langkah demi langkah.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Outfit:wght@400;600;700;800;900&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                        heading: ['Outfit', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #1e293b; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }
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
        .modal-card { background: #fff; border-radius: 24px; max-width: 520px; width: 100%; padding: 28px; box-shadow: 0 24px 64px rgba(0,0,0,.18); border: 1px solid #f1f5f9; max-height: 90vh; overflow-y: auto; animation: ti .25s ease; }
        .toggle-checkbox:checked { right: 0; border-color: #3b49df; }
        .toggle-checkbox:checked + .toggle-label { background-color: #3b49df; }
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
            <a href="{{ route('bimbel.materi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-book-open text-slate-400 text-sm w-4 text-center"></i><span>Materi & Kurikulum</span>
            </a>
            <a href="{{ route('bimbel.progress') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-chart-line text-slate-400 text-sm w-4 text-center"></i><span>Progress & Rapor</span>
            </a>
            {{-- ACTIVE: AI TUTOR ASSISTANT --}}
            <a href="{{ route('bimbel.ai_tutor') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-md shadow-indigo-200">
                <i class="fas fa-robot text-sm w-4 text-center"></i><span>AI Tutor Assistant</span>
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
            <a href="javascript:void(0)" onclick="showToast('Dokumentasi AI Studio siap diakses.','info')" class="text-[10px] font-bold text-indigo-600 hover:underline mt-1 inline-block">Akses Dokumen &rarr;</a>
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
                <button onclick="showToast('0 Notifikasi studio AI.','info')" class="relative w-9 h-9 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500 hover:bg-indigo-50 transition">
                    <i class="fas fa-bell text-sm"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-[#3b49df] text-white text-[9px] font-bold flex items-center justify-center">{{ count($sesiList) }}</span>
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

        {{-- SCROLLABLE STUDIO AREA --}}
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

            {{-- BREADCRUMB & STUDIO HEADER (SESUAI GAMBAR) --}}
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Akademik & AI Studio &gt; AI Tutor Assistant</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>{{ $aiParams['model'] }}
                        </span>
                    </div>
                    <h1 class="font-heading font-black text-2xl text-slate-900 leading-tight">AI Tutor Assistant & Smart Learning Studio</h1>
                    <p class="text-xs text-slate-500 mt-0.5">Kurikulum Merdeka & TKA/TPS SNBT Terintegrasi</p>
                </div>

                {{-- RIGHT STUDIO CONTROLS --}}
                <div class="flex flex-wrap items-center gap-2.5">
                    {{-- Student Badge Box --}}
                    <div class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white shadow-sm">
                        <div class="w-7 h-7 rounded-lg bg-indigo-600 text-white font-black text-[10px] flex items-center justify-center">
                            {{ $activeStudent['initial'] }}
                        </div>
                        <div class="text-left text-xs">
                            <div class="font-bold text-slate-800 leading-tight">{{ $activeStudent['nama'] }}</div>
                            <div class="text-[10px] text-slate-400">{{ $activeStudent['kelas'] }}</div>
                        </div>
                        <i class="fas fa-chevron-down text-[9px] text-slate-400"></i>
                    </div>

                    <div class="flex items-center gap-1 bg-white border border-slate-200 rounded-xl p-1 shadow-sm">
                        <button class="px-3 py-1.5 rounded-lg bg-indigo-50 text-[#3b49df] font-bold text-xs flex items-center gap-1.5">
                            <i class="fas fa-comments text-[11px]"></i><span>Chat & Diskusi Soal</span>
                        </button>
                        <button onclick="showToast('Generator kuis aktif.','info')" class="px-3 py-1.5 rounded-lg hover:bg-slate-50 text-slate-600 font-semibold text-xs flex items-center gap-1.5">
                            <i class="fas fa-brain text-[11px]"></i><span>Generator Kuis</span>
                        </button>
                        <button onclick="showToast('Riwayat sesi tersimpan.','info')" class="px-3 py-1.5 rounded-lg hover:bg-slate-50 text-slate-600 font-semibold text-xs flex items-center gap-1.5">
                            <i class="fas fa-clock-rotate-left text-[11px]"></i><span>Riwayat Sesi</span>
                        </button>
                        <button onclick="showToast('Ringkasan sesi berhasil diekspor.','success')" class="px-3 py-1.5 rounded-lg hover:bg-slate-50 text-slate-600 font-semibold text-xs flex items-center gap-1.5">
                            <i class="fas fa-file-export text-[11px]"></i><span>Ekspor Ringkasan</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- 3-COLUMN STUDIO LAYOUT --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 items-start">

                {{-- ==================== LEFT COLUMN (3 COLS): SESI & PARAMETER ==================== --}}
                <div class="lg:col-span-3 space-y-4">
                    
                    {{-- CARD 1: DAFTAR SESI DISKUSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-message text-[#3b49df] text-xs"></i>
                                <h3 class="font-heading font-black text-xs text-slate-900">Daftar Sesi Diskusi</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700">{{ count($sesiList) }} Topik</span>
                        </div>

                        {{-- Search input --}}
                        <div class="relative">
                            <i class="fas fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[10px]"></i>
                            <input type="text" placeholder="Cari materi atau rumus..." class="w-full pl-8 pr-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-600 focus:outline-none focus:border-indigo-500 placeholder-slate-400">
                        </div>

                        <button onclick="openModalSesiAi()" class="w-full py-2 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95 flex items-center justify-center gap-1.5">
                            <i class="fas fa-plus text-[10px]"></i><span>+ Mulai Topik / Sesi Baru</span>
                        </button>

                        {{-- Sesi list --}}
                        <div class="space-y-2 pt-1 max-h-[340px] overflow-y-auto ss">
                            @if(count($filteredSesi) > 0)
                                <div class="text-[9px] font-extrabold text-slate-400 uppercase tracking-wider px-1">Sesi Diskusi</div>
                                @foreach($filteredSesi as $s)
                                @php
                                    $isSel = ($activeSesi && $activeSesi['id'] == $s['id']);
                                @endphp
                                <a href="{{ route('bimbel.ai_tutor', ['sesi' => $s['id']]) }}" class="block p-3 rounded-xl border transition {{ $isSel ? 'bg-indigo-50/60 border-indigo-300 ring-1 ring-indigo-200' : 'bg-slate-50/70 border-slate-200/80 hover:bg-slate-100' }}">
                                    <div class="flex items-center justify-between text-[10px] font-bold mb-1">
                                        <span class="truncate text-slate-900 font-extrabold">{{ $s['judul'] }}</span>
                                        <span class="px-1.5 py-0.2 rounded text-[9px] bg-indigo-100 text-indigo-700 shrink-0">{{ $s['badge_status'] }}</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 truncate">{{ $s['kategori'] }} &bull; {{ $s['pesan_count'] }}</div>
                                    <div class="flex items-center justify-between text-[9px] text-slate-400 mt-2 pt-1.5 border-t border-slate-200/60">
                                        <span>{{ $s['waktu'] }}</span>
                                        <span class="text-emerald-600 font-bold flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>{{ $s['durasi'] }}
                                        </span>
                                    </div>
                                </a>
                                @endforeach
                            @else
                                {{-- EMPTY STATE SESUAI REQUEST USER --}}
                                <div class="p-6 text-center text-xs text-slate-400 flex flex-col items-center justify-center">
                                    <i class="fas fa-comments text-2xl text-slate-300 mb-2"></i>
                                    <div class="font-bold text-slate-700 text-xs">Belum Ada Sesi Diskusi</div>
                                    <p class="text-[10px] text-slate-400 mt-1 leading-relaxed">
                                        Klik tombol di atas untuk membuka ruang konsultasi AI Tutor pertama Anda.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- CARD 2: PARAMETER TUTOR AI --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-sliders text-[#3b49df] text-xs"></i>
                                <h3 class="font-heading font-black text-xs text-slate-900">Parameter Tutor AI</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-indigo-50 text-indigo-700">Preset UTBK</span>
                        </div>

                        <div class="space-y-2.5 text-xs">
                            <div>
                                <span class="text-[10px] font-bold text-slate-500 block mb-1">Tingkat Penjelasan:</span>
                                <select class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none">
                                    <option value="Detail Langkah Demi Langkah">Detail Langkah Demi Langkah</option>
                                    <option value="Ringkas To The Point">Ringkas To The Point</option>
                                    <option value="Bedah Formula & Pembuktian">Bedah Formula & Pembuktian</option>
                                </select>
                            </div>

                            <div>
                                <span class="text-[10px] font-bold text-slate-500 block mb-1">Gaya Interaksi Tutor:</span>
                                <select class="w-full px-2.5 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none">
                                    <option value="Ramah & Pembimbing Sokratik">Ramah & Pembimbing Sokratik</option>
                                    <option value="Fokus Trik Eliminasi Cepat">Fokus Trik Eliminasi Cepat</option>
                                    <option value="Formal Simulasi Ujian">Formal Simulasi Ujian</option>
                                </select>
                            </div>

                            {{-- Toggles --}}
                            <div class="pt-2 border-t border-slate-100 space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-[11px] font-bold text-slate-800">Metode Sokratik</div>
                                        <div class="text-[9px] text-slate-400">Tutor memancing nalar sebelum beri kunci</div>
                                    </div>
                                    <input type="checkbox" checked class="w-4 h-4 text-indigo-600 rounded">
                                </div>

                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-[11px] font-bold text-slate-800">Analisis Bobot Soal (IRT)</div>
                                        <div class="text-[9px] text-slate-400">Tampilkan estimasi poin UTBK SNBT</div>
                                    </div>
                                    <input type="checkbox" checked class="w-4 h-4 text-indigo-600 rounded">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ==================== MIDDLE COLUMN (6 COLS): CHAT STUDIO INTERAKTIF ==================== --}}
                <div class="lg:col-span-6 space-y-4">
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm flex flex-col h-[740px] overflow-hidden">
                        
                        {{-- Top Topic Header --}}
                        <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between bg-gradient-to-r from-indigo-50/40 to-white">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-100 text-[#3b49df] flex items-center justify-center font-black text-sm">
                                    &Sigma;
                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-heading font-black text-sm text-slate-900 leading-snug">
                                            {{ $activeSesi['judul'] ?? 'Studio Interaktif AI Tutor' }}
                                        </h3>
                                        <span class="px-2 py-0.5 rounded text-[9px] font-extrabold bg-rose-50 text-rose-600 border border-rose-200 uppercase">HOTS UTBK</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 flex items-center gap-1.5 mt-0.5">
                                        <i class="fas fa-clock text-[9px]"></i>
                                        <span>Durasi Sesi: {{ $activeSesi['durasi'] ?? 'Baru' }}</span>
                                        <span>&bull;</span>
                                        <span>Bimbel Reguler SNBT Batch 1</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <button onclick="showToast('Papan tulis digital (Whiteboard) dibuka.','info')" class="px-2.5 py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-[11px] font-bold text-slate-600 transition flex items-center gap-1.5">
                                    <i class="fas fa-pen-ruler text-[10px]"></i><span>Whiteboard</span>
                                </button>
                                <button onclick="showToast('Tautan sesi disalin.','success')" class="w-7 h-7 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-400 hover:text-slate-600 flex items-center justify-center transition">
                                    <i class="fas fa-share-nodes text-[10px]"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Chat Message Stream --}}
                        <div id="chatStream" class="flex-1 overflow-y-auto p-5 space-y-4 ss bg-slate-50/30">
                            
                            {{-- Sesi info tag --}}
                            <div class="text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-400 border border-slate-200/60 inline-block">
                                    Sesi dimulai hari ini &bull; Tutor Model EduPulse AI
                                </span>
                            </div>

                            @if(count($chatMessages) > 0)
                                @foreach($chatMessages as $msg)
                                    @if($msg['sender'] === 'user')
                                        {{-- USER BUBBLE (PURPLE RIGHT) --}}
                                        <div class="flex items-start justify-end gap-2.5">
                                            <div class="max-w-[85%] text-right">
                                                <div class="p-4 rounded-2xl rounded-tr-none bg-[#3b49df] text-white text-xs leading-relaxed text-left shadow-sm">
                                                    {{ $msg['text'] }}
                                                </div>
                                                <div class="text-[10px] text-slate-400 mt-1">
                                                    {{ $msg['sender_name'] }} &bull; {{ $msg['time'] }} <i class="fas fa-check-double text-indigo-400 text-[9px] ml-0.5"></i>
                                                </div>
                                            </div>
                                            <div class="w-7 h-7 rounded-full bg-indigo-600 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                                                {{ $msg['avatar'] ?? 'DA' }}
                                            </div>
                                        </div>
                                    @else
                                        {{-- AI BUBBLE (WHITE LEFT) --}}
                                        <div class="flex items-start gap-2.5">
                                            <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#3b49df] to-indigo-500 text-white flex items-center justify-center text-xs shrink-0 shadow-sm shadow-indigo-200">
                                                <i class="fas fa-robot"></i>
                                            </div>
                                            <div class="max-w-[90%] space-y-2">
                                                <div class="p-4 rounded-2xl rounded-tl-none bg-white border border-slate-200 shadow-sm text-xs leading-relaxed text-slate-800 space-y-3">
                                                    <div class="flex items-center justify-between text-[11px] font-bold text-[#3b49df] border-b border-slate-100 pb-2">
                                                        <span>{{ $msg['sender_name'] }}</span>
                                                        <span class="text-[10px] text-slate-400">{{ $msg['time'] }}</span>
                                                    </div>

                                                    <div class="whitespace-pre-line text-xs text-slate-700 leading-relaxed">
                                                        {{ $msg['text'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                {{-- EMPTY STATE CHAT (SESUAI REQUEST USER) --}}
                                <div id="emptyChatPlaceholder" class="py-16 px-4 text-center flex flex-col items-center justify-center max-w-sm mx-auto">
                                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-[#3b49df] flex items-center justify-center text-2xl mb-3 shadow-sm border border-indigo-100">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                    <h4 class="font-heading font-black text-sm text-slate-900">Mulai Konsultasi & Bedah Soal dengan AI Tutor</h4>
                                    <p class="text-[11px] text-slate-400 mt-1 leading-relaxed">
                                        Ketik pertanyaan matematika, fisika, penalaran umum, atau paste rumus LaTeX di bawah. AI Tutor siap membantu membedah konsep dan trik eliminasi cepat.
                                    </p>

                                    {{-- Prompt starter suggestions --}}
                                    <div class="mt-4 space-y-1.5 w-full text-left">
                                        <div class="text-[10px] font-bold text-slate-400 uppercase">Coba Contoh Pertanyaan:</div>
                                        <button onclick="usePromptText('Kak AI, tolong jelaskan cara menyelesaikan integral ini dengan cara cepat dan runtut: ∫ (sin³ x • cos x) dx. Bagaimana trik eliminasi pilihannya?')" class="w-full text-left p-2.5 rounded-xl bg-white border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50/40 text-[11px] font-semibold text-slate-700 transition">
                                            &bull; Hitung Integral Substitusi: &int; (sin&sup3; x &bull; cos x) dx
                                        </button>
                                        <button onclick="usePromptText('Bagaimana konsep turunan implisit dan trik mencari titik stasioner fungsi polinomial UTBK?')" class="w-full text-left p-2.5 rounded-xl bg-white border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50/40 text-[11px] font-semibold text-slate-700 transition">
                                            &bull; Konsep Turunan Implisit & Titik Stasioner
                                        </button>
                                    </div>
                                </div>
                            @endif

                        </div>

                        {{-- Bottom Input Studio Bar --}}
                        <div class="p-3.5 border-t border-slate-200 bg-white space-y-2">
                            {{-- Quick Tools --}}
                            <div class="flex items-center gap-1.5 overflow-x-auto ss">
                                <button onclick="insertLatexTemplate()" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-slate-600 transition flex items-center gap-1">
                                    <i class="fas fa-square-root-variable text-[9px] text-indigo-500"></i><span>Sisipkan LaTeX</span>
                                </button>
                                <button onclick="showToast('Fitur OCR Scan foto dibuka. Siap upload gambar soal.','info')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-slate-600 transition flex items-center gap-1">
                                    <i class="fas fa-camera text-[9px] text-emerald-500"></i><span>OCR Scan Foto</span>
                                </button>
                                <button onclick="showToast('Perekam suara aktif. Bicara sekarang...','info')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-slate-600 transition flex items-center gap-1">
                                    <i class="fas fa-microphone text-[9px] text-amber-500"></i><span>Tanya Suara</span>
                                </button>
                                <button onclick="usePromptText('Minta 1 contoh soal HOTS TPS Penalaran Matematika setipe SNBT 2025 beserta opsi jawaban.')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-[10px] font-bold text-slate-600 transition flex items-center gap-1">
                                    <i class="fas fa-lightbulb text-[9px] text-indigo-500"></i><span>Minta Contoh Soal</span>
                                </button>
                            </div>

                            {{-- Form input --}}
                            <div class="relative flex items-end gap-2 bg-slate-50 border border-slate-200 rounded-2xl p-2 focus-within:border-indigo-500 focus-within:bg-white transition">
                                <textarea id="chatInput" rows="2" placeholder="Ketik pertanyaan matematika, paste rumus LaTeX, atau instruksi soal bimbel di sini (Enter untuk kirim)..." class="flex-1 bg-transparent border-0 text-xs text-slate-800 placeholder-slate-400 focus:outline-none resize-none p-1.5"></textarea>
                                
                                <div class="flex items-center gap-1 shrink-0 pb-1">
                                    <button onclick="showToast('Lampirkan berkas soal PDF/gambar.','info')" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-slate-600 flex items-center justify-center transition">
                                        <i class="fas fa-paperclip text-xs"></i>
                                    </button>
                                    <button onclick="sendChatMessage()" class="w-8 h-8 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white flex items-center justify-center shadow-md shadow-indigo-200 transition active:scale-95">
                                        <i class="fas fa-paper-plane text-xs"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between text-[9px] text-slate-400 px-1">
                                <span>EduPulse AI dapat membuat kekeliruan perhitungan numerik rumit. Verifikasi selalu kunci dengan modul bimbel.</span>
                                <span class="font-mono text-indigo-500 font-bold">$$...$$ didukung</span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ==================== RIGHT COLUMN (3 COLS): SMART WIDGETS ==================== --}}
                <div class="lg:col-span-3 space-y-4">

                    {{-- WIDGET 1: VISUALISASI KURVA INTEGRAL (SESUAI GAMBAR) --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-chart-line text-[#3b49df] text-xs"></i>
                                <h3 class="font-heading font-black text-xs text-slate-900">Visualisasi Kurva Integral</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-indigo-50 text-indigo-700">2D Graph</span>
                        </div>

                        <div class="text-[10px] text-slate-600">
                            Daerah kurva <strong class="text-indigo-600 font-mono">y = sin&sup3;(x) cos(x)</strong> pada interval <span class="font-mono">[0, &pi;/2]</span>:
                        </div>

                        {{-- Graph Canvas / SVG Simulation matching screenshot --}}
                        <div class="p-3 bg-slate-50 border border-slate-200 rounded-xl relative overflow-hidden">
                            <svg viewBox="0 0 240 120" class="w-full h-28">
                                {{-- Axes --}}
                                <line x1="20" y1="100" x2="220" y2="100" stroke="#cbd5e1" stroke-width="1.5" />
                                <line x1="20" y1="10" x2="20" y2="100" stroke="#cbd5e1" stroke-width="1.5" />
                                
                                {{-- Shaded area under curve --}}
                                <path d="M 20 100 Q 80 10, 140 30 Q 180 50, 200 100 Z" fill="rgba(99, 102, 241, 0.18)" />
                                
                                {{-- Curve line --}}
                                <path d="M 20 100 Q 80 10, 140 30 Q 180 50, 200 100" fill="none" stroke="#3b49df" stroke-width="2.5" />
                                
                                {{-- Peak point marker --}}
                                <circle cx="110" cy="24" r="3.5" fill="#3b49df" />
                                <text x="115" y="20" font-size="8" fill="#3b49df" font-weight="bold">Puncak (x = 1.05 rad)</text>
                                
                                {{-- Area annotation --}}
                                <rect x="90" y="55" width="55" height="18" rx="4" fill="#ffffff" stroke="#e2e8f0" />
                                <text x="96" y="67" font-size="8" fill="#1e293b" font-weight="bold">Luas = 0.25</text>
                            </svg>

                            <div class="flex items-center justify-between text-[9px] text-slate-400 font-mono mt-1">
                                <span>0</span>
                                <span>&pi;/4</span>
                                <span>&pi;/2</span>
                            </div>
                        </div>

                        <div class="text-[10px] text-slate-500 pt-1 border-t border-slate-100 flex items-center justify-between font-semibold">
                            <span>Nilai Maksimum: y = 0.3248</span>
                            <span class="text-emerald-600 font-bold">Tercapai di x = 60&deg;</span>
                        </div>
                    </div>

                    {{-- WIDGET 2: DRILLING CEPAT ADAPTIF (SESUAI GAMBAR) --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-bolt text-amber-500 text-xs"></i>
                                <h3 class="font-heading font-black text-xs text-slate-900">Drilling Cepat Adaptif</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200">1 Soal &bull; 60 Dtk</span>
                        </div>

                        <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/80 text-[11px] text-slate-800 leading-snug">
                            <span class="text-[9px] font-bold uppercase text-amber-600 block mb-0.5">Tantangan Kilat:</span>
                            Berapakah nilai dari: <strong class="font-mono text-indigo-600">&int;₀^(&pi;/2) (sin&sup3; x &bull; cos x) dx</strong> ?
                        </div>

                        {{-- Options A-D --}}
                        <div class="space-y-1.5 text-xs">
                            <label class="flex items-center justify-between p-2 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="drill_ans" value="A" class="text-indigo-600">
                                    <span class="font-semibold text-slate-700">A. 1/2</span>
                                </div>
                                <span class="text-[10px] text-slate-400 font-mono">0.50</span>
                            </label>
                            
                            <label class="flex items-center justify-between p-2 rounded-xl border border-indigo-300 bg-indigo-50/50 cursor-pointer transition">
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="drill_ans" value="B" checked class="text-indigo-600">
                                    <span class="font-bold text-indigo-900">B. 1/4</span>
                                </div>
                                <span class="px-1.5 py-0.2 rounded text-[9px] font-bold bg-indigo-600 text-white">Pilihan Anda</span>
                            </label>

                            <label class="flex items-center justify-between p-2 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="drill_ans" value="C" class="text-indigo-600">
                                    <span class="font-semibold text-slate-700">C. 1/8</span>
                                </div>
                                <span class="text-[10px] text-slate-400 font-mono">0.125</span>
                            </label>

                            <label class="flex items-center justify-between p-2 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                                <div class="flex items-center gap-2">
                                    <input type="radio" name="drill_ans" value="D" class="text-indigo-600">
                                    <span class="font-semibold text-slate-700">D. 1/16</span>
                                </div>
                                <span class="text-[10px] text-slate-400 font-mono">0.0625</span>
                            </label>
                        </div>

                        <button onclick="checkDrillAnswer()" class="w-full py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-sm shadow-emerald-200 transition active:scale-95 flex items-center justify-center gap-1.5">
                            <i class="fas fa-circle-check text-xs"></i><span>Periksa Jawaban Sekarang</span>
                        </button>

                        <div id="drillResult" class="p-2.5 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 leading-snug">
                            <strong class="font-bold">Tepat Sekali!</strong> Jawaban B bernilai 0.25 (1/4). Skor IRT <strong>+14 Poin</strong>.
                        </div>
                    </div>

                    {{-- WIDGET 3: STATISTIK SESI & REKOMENDASI --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-chart-simple text-[#3b49df] text-xs"></i>
                                <h3 class="font-heading font-black text-xs text-slate-900">Statistik Sesi & Rekomendasi</h3>
                            </div>
                            <i class="fas fa-circle-info text-slate-300 text-xs"></i>
                        </div>

                        <div class="space-y-2 text-xs">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500 text-[11px]">Penguasaan Konsep Substitusi</span>
                                <span class="font-bold text-emerald-600">88% (Sangat Baik)</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 88%"></div>
                            </div>

                            <div class="flex items-center justify-between pt-1">
                                <span class="text-slate-500 text-[11px]">Kecepatan Pengerjaan</span>
                                <span class="font-bold text-indigo-600">42 dtk / soal</span>
                            </div>
                            <div class="text-[9px] text-slate-400">Rata-rata Nasional Tryout SNBT: 65 detik</div>
                        </div>

                        <div class="p-3 rounded-xl bg-indigo-50/70 border border-indigo-100 text-xs space-y-1">
                            <div class="font-bold text-indigo-800 flex items-center gap-1.5 text-[11px]">
                                <i class="fas fa-arrow-trend-up text-indigo-600"></i><span>Rekomendasi AI:</span>
                            </div>
                            <p class="text-[10px] text-indigo-600 leading-relaxed">
                                Dimas telah menguasai integral substitusi. Disarankan melanjutkan ke materi <strong>Integral Parsial Berulang (Metode Tanzalin)</strong>.
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>
</div>

{{-- ========================= MODAL SESI BARU ========================= --}}
<div id="modalSesiAi" class="modal-bd" onclick="if(event.target===this)closeModalSesiAi()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#3b49df] text-white flex items-center justify-center text-sm shadow-md shadow-indigo-200">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Mulai Topik / Sesi Baru</h2>
                    <p class="text-xs text-slate-400">Buka ruang konsultasi AI Tutor untuk bab baru</p>
                </div>
            </div>
            <button onclick="closeModalSesiAi()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('bimbel.ai_tutor.sesi.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Sesi Pembahasan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" placeholder="cth: Integral Substitusi & Trigonometri" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Domain / Kategori Mapel <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
                    <option value="Penalaran Matematika">Penalaran Matematika</option>
                    <option value="Kalkulus Lanjut">Kalkulus Lanjut</option>
                    <option value="Pengetahuan Kuantitatif">Pengetahuan Kuantitatif</option>
                    <option value="Fisika Mekanika">Fisika Mekanika</option>
                    <option value="Penalaran Umum">Penalaran Umum</option>
                </select>
            </div>

            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalSesiAi()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95">Mulai Sesi Sekarang</button>
            </div>
        </form>
    </div>
</div>

<div class="toast-wrap" id="tw"></div>

<script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;
    const activeSesiId = '{{ $activeSesi["id"] ?? "default" }}';

    function showToast(msg, type = 'info') {
        const w = document.getElementById('tw');
        const icons = { success: 'fa-circle-check', error: 'fa-circle-xmark', info: 'fa-circle-info' };
        const t = document.createElement('div');
        t.className = `toast-item ${type}`;
        t.innerHTML = `<i class="fas ${icons[type] || 'fa-circle-info'}"></i><span>${msg}</span>`;
        w.appendChild(t);
        setTimeout(() => t.remove(), 3500);
    }

    function openModalSesiAi() { document.getElementById('modalSesiAi').classList.add('open'); }
    function closeModalSesiAi() { document.getElementById('modalSesiAi').classList.remove('open'); }

    function usePromptText(txt) {
        const inp = document.getElementById('chatInput');
        inp.value = txt;
        inp.focus();
    }

    function insertLatexTemplate() {
        const inp = document.getElementById('chatInput');
        inp.value += ' \\int_{0}^{\\pi/2} (\\sin^3(x) \\cdot \\cos(x)) dx ';
        inp.focus();
        showToast('Template LaTeX disisipkan ke pesan!', 'info');
    }

    function checkDrillAnswer() {
        const res = document.getElementById('drillResult');
        res.classList.remove('hidden');
        showToast('Jawaban Benar! +14 Poin IRT ditambahkan.', 'success');
    }

    function sendChatMessage() {
        const inp = document.getElementById('chatInput');
        const txt = inp.value.trim();
        if (!txt) return;

        inp.value = '';
        const stream = document.getElementById('chatStream');
        const emptyPl = document.getElementById('emptyChatPlaceholder');
        if (emptyPl) emptyPl.remove();

        // 1. Append user message bubble immediately
        const userHtml = `
            <div class="flex items-start justify-end gap-2.5">
                <div class="max-w-[85%] text-right">
                    <div class="p-4 rounded-2xl rounded-tr-none bg-[#3b49df] text-white text-xs leading-relaxed text-left shadow-sm">
                        ${escapeHtml(txt)}
                    </div>
                    <div class="text-[10px] text-slate-400 mt-1">
                        Dimas Arya Putra &bull; Baru saja <i class="fas fa-check-double text-indigo-400 text-[9px] ml-0.5"></i>
                    </div>
                </div>
                <div class="w-7 h-7 rounded-full bg-indigo-600 text-white font-bold text-[10px] flex items-center justify-center shrink-0">
                    DA
                </div>
            </div>
        `;
        stream.insertAdjacentHTML('beforeend', userHtml);
        stream.scrollTop = stream.scrollHeight;

        showToast('EduPulse LLM sedang membedah soal...', 'info');

        // 2. Fetch server response
        fetch('{{ route("bimbel.ai_tutor.chat") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ message: txt, sesi_id: activeSesiId })
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                const latestAi = d.messages[d.messages.length - 1];
                const aiHtml = `
                    <div class="flex items-start gap-2.5">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#3b49df] to-indigo-500 text-white flex items-center justify-center text-xs shrink-0 shadow-sm shadow-indigo-200">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="max-w-[90%] space-y-2">
                            <div class="p-4 rounded-2xl rounded-tl-none bg-white border border-slate-200 shadow-sm text-xs leading-relaxed text-slate-800 space-y-3">
                                <div class="flex items-center justify-between text-[11px] font-bold text-[#3b49df] border-b border-slate-100 pb-2">
                                    <span>${latestAi.sender_name}</span>
                                    <span class="text-[10px] text-slate-400">${latestAi.time}</span>
                                </div>
                                <div class="whitespace-pre-line text-xs text-slate-700 leading-relaxed">
                                    ${escapeHtml(latestAi.text)}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                stream.insertAdjacentHTML('beforeend', aiHtml);
                stream.scrollTop = stream.scrollHeight;
                showToast('Jawaban AI Tutor siap!', 'success');
            }
        })
        .catch(() => showToast('Gagal memproses pesan AI.', 'error'));
    }

    function escapeHtml(text) {
        const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // Submit on Enter (without Shift)
    document.getElementById('chatInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendChatMessage();
        }
    });
</script>
</body>
</html>