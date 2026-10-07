<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Progres Belajar & Rapor Akademik Terpadu — EduPulse Academy</title>
    <meta name="description" content="Pantau grafik skor tryout IRT, analisis kekuatan subtes UTBK, presensi kelas, dan distribusi rapor otomatis terverifikasi ke wali murid.">

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
        .modal-card { background: #fff; border-radius: 24px; max-width: 520px; width: 100%; padding: 28px; box-shadow: 0 24px 64px rgba(0,0,0,.18); border: 1px solid #f1f5f9; max-height: 90vh; overflow-y: auto; animation: ti .25s ease; }
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
            {{-- ACTIVE: PROGRES & RAPOR --}}
            <a href="{{ route('bimbel.progress') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-md shadow-indigo-200">
                <i class="fas fa-chart-line text-sm w-4 text-center"></i><span>Progress & Rapor</span>
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
            <a href="javascript:void(0)" onclick="showToast('Dokumentasi evaluasi rapor siap diakses.','info')" class="text-[10px] font-bold text-indigo-600 hover:underline mt-1 inline-block">Akses Dokumen &rarr;</a>
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
                <button onclick="showToast('0 Notifikasi evaluasi rapor.','info')" class="relative w-9 h-9 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center text-slate-500 hover:bg-indigo-50 transition">
                    <i class="fas fa-bell text-sm"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-[#3b49df] text-white text-[9px] font-bold flex items-center justify-center">{{ $totalTryout }}</span>
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

        {{-- SCROLLABLE DASHBOARD AREA --}}
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

            {{-- BREADCRUMB & HEADER (SESUAI GAMBAR) --}}
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">
                        Akademik & Evaluasi &gt; Evaluasi Belajar &gt; Progres Siswa & Rapor Digital
                    </div>
                    <h1 class="font-heading font-black text-2xl text-slate-900 leading-tight">Progres Belajar & Rapor Akademik Terpadu</h1>
                    <p class="text-xs text-slate-500 mt-1">
                        Pantau grafik skor tryout IRT, analisis kekuatan subtes UTBK, presensi kelas, dan distribusi rapor otomatis terverifikasi ke wali murid.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-end sm:items-center gap-2.5">
                    <div class="flex items-center gap-2 text-[10px] font-semibold text-slate-400 mb-1 sm:mb-0">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-emerald-700 font-bold">Sinkronisasi IRT Real-time Aktif</span>
                        <span>&bull; Pembaruan data: Hari Ini, 09:42 WIB</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <button onclick="openModalEvaluasi()" class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-bold text-slate-700 transition shadow-sm">
                            <i class="fas fa-plus text-xs"></i><span>+ Buat Evaluasi Khusus</span>
                        </button>
                        <button onclick="showToast('Mengunduh Rapor PDF resmi...','info')" class="flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-xs font-bold text-slate-700 transition shadow-sm">
                            <i class="fas fa-download text-xs text-slate-400"></i><span>Unduh Rapor PDF</span>
                        </button>
                        <button onclick="kirimRaporWaAction()" class="flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold shadow-md shadow-emerald-200 transition active:scale-95">
                            <i class="fab fa-whatsapp text-sm"></i><span>Kirim Rapor ke WhatsApp</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- FILTER BAR SELECTOR --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-3.5 shadow-sm flex flex-wrap items-center justify-between gap-3">
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs">
                        <span class="text-slate-400 text-[11px] font-semibold">Rombel / Kelas Aktif:</span>
                        <select class="bg-transparent text-xs font-bold text-slate-800 focus:outline-none">
                            <option value="12 SMA - Super Intensif SNBT 2025">12 SMA - Super Intensif SNBT 2025</option>
                            <option value="11 SMA - Reguler">11 SMA - Reguler</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs">
                        <span class="text-slate-400 text-[11px] font-semibold">Pilih Siswa (NIS):</span>
                        <select class="bg-transparent text-xs font-bold text-slate-800 focus:outline-none">
                            <option value="Dimas Arya Putra">Dimas Arya Putra (NIS: 20240912)</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-1.5 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs">
                        <span class="text-slate-400 text-[11px] font-semibold">Rentang Evaluasi & Tryout:</span>
                        <select class="bg-transparent text-xs font-bold text-slate-800 focus:outline-none">
                            <option value="Semester Genap">Semester Genap (Tryout 01 - 08)</option>
                            <option value="Semester Ganjil">Semester Ganjil (Tryout Mid)</option>
                        </select>
                    </div>
                </div>

                <button onclick="showToast('Grafik skor dan matriks evaluasi disegarkan.','info')" class="w-9 h-9 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white flex items-center justify-center text-xs shadow-md shadow-indigo-200 transition">
                    <i class="fas fa-arrows-rotate"></i>
                </button>
            </div>

            {{-- 4 STAT CARDS (SESUAI GAMBAR) --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                {{-- 1. RATA-RATA SKOR IRT SNBT --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Rata-Rata Skor IRT SNBT</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2 flex items-baseline gap-1">
                                <span>{{ $stats['skor_irt']['val'] }}</span>
                                <span class="text-xs font-medium text-slate-400">/ 1000 Poin</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base"><i class="fas fa-calculator"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                        <span class="text-indigo-600 text-[11px]"><i class="fas fa-arrow-trend-up mr-1 text-[10px]"></i>{{ $stats['skor_irt']['sub'] }}</span>
                        <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold">{{ $stats['skor_irt']['peluang'] }}</span>
                    </div>
                </div>

                {{-- 2. SILABUS & BANK SOAL --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Silabus & Bank Soal</span>
                            <div class="font-heading font-black text-2xl text-slate-900 mt-2">
                                <span>{{ $stats['silabus_soal']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-base"><i class="fas fa-list-check"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-400 text-[11px]">{{ $stats['silabus_soal']['sub'] }}</span>
                        <div class="flex items-center gap-1.5 text-[10px] font-bold">
                            <span class="px-1.5 py-0.5 rounded bg-amber-50 text-amber-700">{{ $stats['silabus_soal']['sisa'] }}</span>
                            <span class="px-1.5 py-0.5 rounded bg-indigo-50 text-indigo-700">{{ $stats['silabus_soal']['target'] }}</span>
                        </div>
                    </div>
                </div>

                {{-- 3. TINGKAT KEHADIRAN KELAS --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Tingkat Kehadiran Kelas</span>
                            <div class="font-heading font-black text-2xl text-emerald-600 mt-2">
                                <span>{{ $stats['kehadiran']['val'] }}</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base"><i class="fas fa-calendar-check"></i></div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                        <span class="text-slate-400 text-[11px]">{{ $stats['kehadiran']['sub'] }}</span>
                        <div class="flex items-center gap-1.5 text-[10px]">
                            <span class="px-1.5 py-0.5 rounded bg-amber-50 text-amber-700 font-bold">{{ $stats['kehadiran']['sakit'] }}</span>
                            <span class="px-1.5 py-0.5 rounded bg-slate-100 text-slate-600 font-bold">{{ $stats['kehadiran']['alpa'] }}</span>
                        </div>
                    </div>
                </div>

                {{-- 4. TARGET KAMPUS IMPIAN --}}
                <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider block">Target Kampus Impian</span>
                            <div class="font-heading font-black text-lg text-slate-900 mt-1 leading-snug">
                                {{ $stats['target_kampus']['prodi'] }}
                            </div>
                            <div class="text-[10px] text-indigo-600 font-bold">{{ $stats['target_kampus']['kampus'] }}</div>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-[#3b49df] flex items-center justify-center text-base"><i class="fas fa-graduation-cap"></i></div>
                    </div>
                    <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold">
                        <span class="text-slate-400 text-[11px]">{{ $stats['target_kampus']['passing_grade'] }}</span>
                        <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 text-[10px] font-bold">{{ $stats['target_kampus']['selisih'] }}</span>
                    </div>
                </div>
            </div>

            {{-- SPLIT VIEW (LEFT: TREN SKOR & MATRIKS 7 COLS | RIGHT: RAPOR DIGITAL & AI PLAN 5 COLS) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                {{-- ==================== LEFT COLUMN (7 COLS) ==================== --}}
                <div class="lg:col-span-7 space-y-5">
                    
                    {{-- 1. TREN SKOR TRYOUT IRT BERKALA --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-chart-line text-[#3b49df]"></i>
                                    <h3 class="font-heading font-black text-sm text-slate-900">Tren Skor Tryout IRT Berkala (TO-01 s/d TO-08)</h3>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-0.5">Komparasi nilai riil siswa terhadap ambang batas kelulusan PTN dan rata-rata angkatan.</p>
                            </div>

                            <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl text-xs font-bold">
                                <button class="px-2.5 py-1 rounded-lg bg-indigo-600 text-white text-[10px]">Semua Subtes</button>
                                <button onclick="showToast('Filter Penalaran Mat aktif.','info')" class="px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 text-[10px]">Penalaran Mat</button>
                                <button onclick="showToast('Filter Kuantitatif aktif.','info')" class="px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 text-[10px]">Kuantitatif</button>
                                <button onclick="showToast('Filter Lit. Inggris aktif.','info')" class="px-2.5 py-1 rounded-lg text-slate-600 hover:text-slate-900 text-[10px]">Lit. Inggris</button>
                            </div>
                        </div>

                        {{-- Legend --}}
                        <div class="flex items-center justify-end gap-4 text-[10px] font-bold text-slate-500">
                            <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>Skor Siswa (Aktual)</span>
                            <span class="flex items-center gap-1.5"><span class="w-3 h-0.5 border-t-2 border-dashed border-rose-500"></span>Target UI (695.0)</span>
                            <span class="flex items-center gap-1.5"><span class="w-3 h-0.5 border-t-2 border-dotted border-slate-400"></span>Rata-rata Angkatan (641.0)</span>
                        </div>

                        {{-- Chart SVG (Simulasi grafik presisi seperti mockup) --}}
                        <div class="p-3 bg-slate-50/50 border border-slate-200/70 rounded-2xl">
                            <svg viewBox="0 0 560 180" class="w-full h-44">
                                {{-- Horizontal Grid Lines --}}
                                <line x1="40" y1="20" x2="540" y2="20" stroke="#f1f5f9" stroke-width="1" />
                                <text x="15" y="24" font-size="9" fill="#94a3b8">750</text>
                                <line x1="40" y1="55" x2="540" y2="55" stroke="#f1f5f9" stroke-width="1" />
                                <text x="15" y="59" font-size="9" fill="#94a3b8">700</text>
                                <line x1="40" y1="90" x2="540" y2="90" stroke="#f1f5f9" stroke-width="1" />
                                <text x="15" y="94" font-size="9" fill="#94a3b8">650</text>
                                <line x1="40" y1="125" x2="540" y2="125" stroke="#f1f5f9" stroke-width="1" />
                                <text x="15" y="129" font-size="9" fill="#94a3b8">600</text>
                                <line x1="40" y1="160" x2="540" y2="160" stroke="#e2e8f0" stroke-width="1.5" />
                                <text x="15" y="164" font-size="9" fill="#94a3b8">550</text>

                                {{-- Target UI red dashed line at 695 --}}
                                <line x1="40" y1="58" x2="540" y2="58" stroke="#ef4444" stroke-width="1.5" stroke-dasharray="4" />

                                {{-- Shaded fill area under curve --}}
                                <path d="M 60 118 L 125 101 L 190 85 L 255 75 L 320 62 L 385 52 L 450 47 L 515 42 L 515 160 L 60 160 Z" fill="rgba(99, 102, 241, 0.12)" />

                                {{-- Student Score Line --}}
                                <path d="M 60 118 L 125 101 L 190 85 L 255 75 L 320 62 L 385 52 L 450 47 L 515 42" fill="none" stroke="#3b49df" stroke-width="3" stroke-linecap="round" />

                                {{-- Points on curve --}}
                                <circle cx="60" cy="118" r="4" fill="#3b49df" />
                                <circle cx="125" cy="101" r="4" fill="#3b49df" />
                                <circle cx="190" cy="85" r="4" fill="#3b49df" />
                                <circle cx="255" cy="75" r="4" fill="#3b49df" />
                                <circle cx="320" cy="62" r="4" fill="#3b49df" />
                                <circle cx="385" cy="52" r="4" fill="#3b49df" />
                                <circle cx="450" cy="47" r="4" fill="#3b49df" />
                                <circle cx="515" cy="42" r="5" fill="#1e1b4b" stroke="#ffffff" stroke-width="2" />

                                {{-- Tooltip Box on latest point --}}
                                <rect x="495" y="18" width="40" height="18" rx="4" fill="#0f172a" />
                                <text x="502" y="30" font-size="9" fill="#ffffff" font-weight="bold">718.5</text>
                            </svg>

                            {{-- X Axis Labels --}}
                            <div class="grid grid-cols-8 text-center text-[10px] text-slate-400 font-semibold pt-1">
                                <div>TO-01<div class="text-[9px] text-slate-500">610</div></div>
                                <div>TO-02<div class="text-[9px] text-slate-500">635</div></div>
                                <div>TO-03<div class="text-[9px] text-slate-500">658</div></div>
                                <div>TO-04<div class="text-[9px] text-slate-500">672</div></div>
                                <div>TO-05<div class="text-[9px] text-slate-500">690</div></div>
                                <div>TO-06<div class="text-[9px] text-slate-500">705</div></div>
                                <div>TO-07<div class="text-[9px] text-slate-500">712</div></div>
                                <div class="text-indigo-600 font-bold">TO-08<div class="text-[9px] text-indigo-700">718.5</div></div>
                            </div>
                        </div>

                        {{-- 3 Indicators bawah chart --}}
                        <div class="grid grid-cols-3 gap-3 pt-1">
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center gap-2.5">
                                <i class="fas fa-chart-line-up text-emerald-600 text-sm"></i>
                                <div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase">Laju Peningkatan Skor</div>
                                    <div class="font-bold text-xs text-slate-800">+15.4 Poin / 2 Minggu</div>
                                </div>
                            </div>

                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center gap-2.5">
                                <i class="fas fa-bullseye text-indigo-600 text-sm"></i>
                                <div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase">Konsistensi Kuantil</div>
                                    <div class="font-bold text-xs text-slate-800">Top 5% Siswa Nasional</div>
                                </div>
                            </div>

                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center gap-2.5">
                                <i class="fas fa-flag-checkered text-amber-600 text-sm"></i>
                                <div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase">Jarak ke Ambang Batas</div>
                                    <div class="font-bold text-xs text-emerald-600">+23.5 Poin Di Atas Target</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. MATRIKS EVALUASI SUBTES UTBK & STANDAR KOMPETENSI --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-table-cells text-[#3b49df]"></i>
                                    <h3 class="font-heading font-black text-sm text-slate-900">Matriks Evaluasi Subtes UTBK & Standar Kompetensi</h3>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-0.5">Rincian parameter penguasaan kognitif, akurasi pengerjaan, dan kecepatan per nomor soal.</p>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">6 Subtes Teruji</span>
                        </div>

                        {{-- Table Subtes --}}
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-xs">
                                <thead>
                                    <tr class="border-b border-slate-100 text-[10px] font-extrabold uppercase text-slate-400 bg-slate-50/60">
                                        <th class="py-2.5 px-3">Subtes SNBT</th>
                                        <th class="py-2.5 px-3">Skor IRT</th>
                                        <th class="py-2.5 px-3">Penguasaan Silabus</th>
                                        <th class="py-2.5 px-3">Akurasi %</th>
                                        <th class="py-2.5 px-3">Kecepatan</th>
                                        <th class="py-2.5 px-3 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 font-semibold">
                                    <tr>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-1.5 font-bold text-slate-900">
                                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>Penalaran Matematika
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 font-heading font-black text-slate-900">745.0</td>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-20 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 91%"></div>
                                                </div>
                                                <span class="text-[10px] text-emerald-700 bg-emerald-50 px-1.5 py-0.2 rounded font-bold">91% Sangat Baik</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-slate-600">88%</td>
                                        <td class="py-3 px-3 text-slate-600">44 dtk/soal</td>
                                        <td class="py-3 px-3 text-right">
                                            <button onclick="showToast('Analisis butir soal Penalaran Matematika dimuat.','info')" class="text-indigo-600 hover:underline text-[11px] font-bold">Detail</button>
                                        </td>
                                    </tr>

                                    <tr class="bg-rose-50/20">
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-1.5 font-bold text-slate-900">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Pengetahuan Kuantitatif
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 font-heading font-black text-amber-600">690.0</td>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-20 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-amber-500 h-1.5 rounded-full" style="width: 79%"></div>
                                                </div>
                                                <span class="text-[10px] text-amber-700 bg-amber-50 px-1.5 py-0.2 rounded font-bold">79% Perlu Drill</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-rose-600 font-bold">74%</td>
                                        <td class="py-3 px-3 text-rose-600 font-bold">62 dtk/soal</td>
                                        <td class="py-3 px-3 text-right">
                                            <button onclick="showToast('Drill khusus kuantitatif siap dijalankan di AI Tutor.','info')" class="text-rose-600 hover:underline text-[11px] font-bold">Drill AI</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-1.5 font-bold text-slate-900">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Literasi Bahasa Indonesia
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 font-heading font-black text-slate-900">730.0</td>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-20 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 89%"></div>
                                                </div>
                                                <span class="text-[10px] text-emerald-700 bg-emerald-50 px-1.5 py-0.2 rounded font-bold">89% Sangat Baik</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-slate-600">85%</td>
                                        <td class="py-3 px-3 text-slate-600">40 dtk/soal</td>
                                        <td class="py-3 px-3 text-right">
                                            <button onclick="showToast('Detail literasi bahasa dibuka.','info')" class="text-indigo-600 hover:underline text-[11px] font-bold">Detail</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-1.5 font-bold text-slate-900">
                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>Literasi Bahasa Inggris
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 font-heading font-black text-slate-900">715.0</td>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-20 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 87%"></div>
                                                </div>
                                                <span class="text-[10px] text-indigo-700 bg-indigo-50 px-1.5 py-0.2 rounded font-bold">87% Baik</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-slate-600">82%</td>
                                        <td class="py-3 px-3 text-slate-600">45 dtk/soal</td>
                                        <td class="py-3 px-3 text-right">
                                            <button onclick="showToast('Detail literasi bahasa inggris dibuka.','info')" class="text-indigo-600 hover:underline text-[11px] font-bold">Detail</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-1.5 font-bold text-slate-900">
                                                <span class="w-1.5 h-1.5 rounded-full bg-violet-500"></span>Penalaran Umum (Induktif & Deduktif)
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 font-heading font-black text-slate-900">712.0</td>
                                        <td class="py-3 px-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-20 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 85%"></div>
                                                </div>
                                                <span class="text-[10px] text-indigo-700 bg-indigo-50 px-1.5 py-0.2 rounded font-bold">85% Baik</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 text-slate-600">80%</td>
                                        <td class="py-3 px-3 text-slate-600">50 dtk/soal</td>
                                        <td class="py-3 px-3 text-right">
                                            <button onclick="showToast('Detail penalaran umum dibuka.','info')" class="text-indigo-600 hover:underline text-[11px] font-bold">Detail</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- 3. CATATAN PEDAGOGIS KONSELOR & MASTER TUTOR --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clipboard-user text-[#3b49df]"></i>
                                <h3 class="font-heading font-black text-sm text-slate-900">Catatan Pedagogis Konselor & Master Tutor</h3>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Verifikasi Tim Kurikulum Bimbel</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Card 1: Master Tutor --}}
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center">RP</div>
                                    <div>
                                        <div class="font-bold text-xs text-slate-900 leading-tight">Dr. Rendy Pratama, M.Sc</div>
                                        <div class="text-[10px] text-slate-400">Master Tutor Matematika & Kuantitatif</div>
                                    </div>
                                </div>
                                <p class="text-[11px] text-slate-600 leading-relaxed italic">
                                    "Dimas menunjukkan lompatan pemahaman kalkulus diferensial yang sangat signifikan setelah 4 sesi drill mandiri dengan AI Tutor. Rekomendasi: 2 pekan ke depan difokuskan pada manajemen waktu subtes Pengetahuan Kuantitatif, khususnya eliminasi pilihan jawaban cepat tanpa menghitung bulat."
                                </p>
                                <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-[10px] font-bold text-slate-400">
                                    <span>Catatan Sesi: Tatap Muka #14</span>
                                    <span class="text-emerald-600">Status: Diterapkan di Silabus</span>
                                </div>
                            </div>

                            {{-- Card 2: Konselor Karir --}}
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-purple-600 text-white font-bold text-xs flex items-center justify-center">SM</div>
                                    <div>
                                        <div class="font-bold text-xs text-slate-900 leading-tight">Siti Maryam, S.Psi, M.Pd</div>
                                        <div class="text-[10px] text-slate-400">Konselor Karir & Peminatan Kampus</div>
                                    </div>
                                </div>
                                <div class="text-[11px] text-slate-600 leading-relaxed space-y-1">
                                    <div><strong class="text-slate-800">Ketahanan Ujian:</strong> Fokus stabil hingga menit ke-150 tryout tanpa penurunan akurasi drastis.</div>
                                    <div><strong class="text-slate-800">Keaktifan Kelas:</strong> Sangat responsif dalam sesi pembahasan bedah soal sulit.</div>
                                    <div><strong class="text-slate-800">Target Pilihan 2:</strong> Teknik Telekomunikasi ITB &bull; Peluang Masuk: <span class="text-emerald-600 font-bold">82.1%</span>.</div>
                                </div>
                                <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-[10px] font-bold text-slate-400">
                                    <span>Konsultasi Terakhir: 12 Mar 2025</span>
                                    <button onclick="openModalCatatan()" class="text-indigo-600 hover:underline">+ Tambah Catatan Konselor</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ==================== RIGHT COLUMN (5 COLS) ==================== --}}
                <div class="lg:col-span-5 space-y-5">

                    {{-- 1. PRATINJAU E-RAPOR DIGITAL (SESUAI GAMBAR) --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-4">
                        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-file-invoice text-[#3b49df]"></i>
                                <h3 class="font-heading font-black text-sm text-slate-900">Pratinjau E-Rapor Digital</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Terverifikasi</span>
                        </div>

                        {{-- Official Digital Rapor Paper Certificate Layout --}}
                        <div class="p-4 rounded-2xl border border-slate-200 bg-slate-50/50 space-y-3">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-lg bg-[#3b49df] text-white font-black text-xs flex items-center justify-center">E</div>
                                    <div>
                                        <div class="font-bold text-xs text-slate-900">EduPulse Academy</div>
                                        <div class="text-[9px] text-slate-400">Cabang Jakarta Selatan &bull; SK Diknas No. 441/BIM/2023</div>
                                    </div>
                                </div>
                                <div class="w-8 h-8 rounded-full border border-emerald-500 text-emerald-600 flex items-center justify-center text-[10px]">
                                    <i class="fas fa-certificate"></i>
                                </div>
                            </div>

                            {{-- Student Tag in Rapor --}}
                            <div class="p-2.5 rounded-xl bg-white border border-slate-200 flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-lg bg-indigo-600 text-white font-black text-xs flex items-center justify-center">
                                    {{ $activeStudent['nama'][0] ?? 'D' }}A
                                </div>
                                <div class="text-xs">
                                    <div class="font-black text-slate-900">{{ $activeStudent['nama'] }}</div>
                                    <div class="text-[10px] text-slate-400">NIS: {{ $activeStudent['nis'] }} &bull; {{ $activeStudent['sekolah'] }}</div>
                                    <div class="text-[9px] text-indigo-600 font-bold">Program: {{ $activeStudent['program'] }}</div>
                                </div>
                            </div>

                            {{-- Mini Grades Table --}}
                            <table class="w-full text-left text-[11px]">
                                <thead>
                                    <tr class="border-y border-slate-200 text-[9px] font-extrabold uppercase text-slate-400">
                                        <th class="py-1.5">Subtes Pokok</th>
                                        <th class="py-1.5 text-center">Skor</th>
                                        <th class="py-1.5 text-right">Predikat</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 font-semibold">
                                    <tr>
                                        <td class="py-1.5 text-slate-700">Penalaran Mat</td>
                                        <td class="py-1.5 text-center font-bold text-slate-900">745.0</td>
                                        <td class="py-1.5 text-right text-emerald-600">Amat Baik</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1.5 text-slate-700">Kuantitatif</td>
                                        <td class="py-1.5 text-center font-bold text-slate-900">690.0</td>
                                        <td class="py-1.5 text-right text-amber-600">Cukup</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1.5 text-slate-700">Lit. Indonesia</td>
                                        <td class="py-1.5 text-center font-bold text-slate-900">730.0</td>
                                        <td class="py-1.5 text-right text-emerald-600">Amat Baik</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1.5 text-slate-700">Lit. Inggris</td>
                                        <td class="py-1.5 text-center font-bold text-slate-900">715.0</td>
                                        <td class="py-1.5 text-right text-indigo-600">Baik</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="border-t border-slate-200 font-black">
                                        <td class="py-2 text-slate-900">Skor Rata-Rata IRT:</td>
                                        <td colspan="2" class="py-2 text-right text-sm text-[#3b49df]">{{ $avgSkor > 0 ? number_format($avgSkor, 1) : '718.5' }} / 1000</td>
                                    </tr>
                                </tfoot>
                            </table>

                            {{-- Sign & QR Validation --}}
                            <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-[10px]">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-qrcode text-2xl text-slate-800"></i>
                                    <div>
                                        <div class="font-bold text-slate-800">Validitas Dokumen</div>
                                        <div class="text-[9px] text-slate-400">Otentikasi SNBT Digital Kemdikbud</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-slate-900">Sarah Maharani, M.Pd</div>
                                    <div class="text-[9px] text-slate-400">Kepala Akademik Bimbel</div>
                                </div>
                            </div>
                        </div>

                        {{-- Action buttons --}}
                        <div class="flex gap-2 pt-1">
                            <button onclick="window.print()" class="flex-1 py-2.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 font-bold text-xs text-slate-700 transition flex items-center justify-center gap-1.5">
                                <i class="fas fa-print text-xs"></i><span>Cetak Rapor</span>
                            </button>
                            <button onclick="showToast('Rapor digital resmi diunduh dalam format PDF.','success')" class="flex-1 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 font-bold text-xs text-white transition flex items-center justify-center gap-1.5 shadow-sm">
                                <i class="fas fa-download text-xs"></i><span>Unduh PDF</span>
                            </button>
                        </div>
                    </div>

                    {{-- 2. RENCANA BELAJAR AI ADAPTIF --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-3.5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-graduation-cap text-[#3b49df]"></i>
                                <h3 class="font-heading font-black text-xs text-slate-900">Rencana Belajar AI Adaptif</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-indigo-50 text-indigo-700">Algoritma v4.2</span>
                        </div>

                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Tindakan personalisasi terukur untuk menutup gap <strong>-21.5 poin</strong> pada subtes Pengetahuan Kuantitatif:
                        </p>

                        {{-- 3 Plan items --}}
                        <div class="space-y-2">
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70 hover:border-indigo-300 transition flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
                                        <span>5x Drill Matriks & Transformasi</span>
                                        <span class="text-emerald-600 text-[10px] font-extrabold">+15 Pts</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">15 soal berwaktu dengan pembahasan instan step-by-step</div>
                                    <div class="text-[9px] text-indigo-600 font-semibold mt-1">Deadline: 20 Mar 2025</div>
                                </div>
                                <button onclick="window.location='{{ route('bimbel.ai_tutor') }}'" class="text-xs font-bold text-indigo-600 hover:underline shrink-0">Mulai Drill &rarr;</button>
                            </div>

                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70 hover:border-indigo-300 transition flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
                                        <span>Video 'The King Formula' Trigonometri</span>
                                        <span class="text-emerald-600 text-[10px] font-extrabold">+8 Pts</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Trik eliminasi sudut istimewa dalam waktu &lt;20 detik</div>
                                    <div class="text-[9px] text-indigo-600 font-semibold mt-1">Durasi: 14 Menit</div>
                                </div>
                                <button onclick="window.location='{{ route('bimbel.materi') }}'" class="text-xs font-bold text-indigo-600 hover:underline shrink-0">Tonton &rarr;</button>
                            </div>

                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200/70 hover:border-indigo-300 transition flex items-center justify-between">
                                <div>
                                    <div class="font-bold text-xs text-slate-800 flex items-center gap-1.5">
                                        <span>Simulasi Tryout Kilat 20 Menit</span>
                                        <span class="text-indigo-600 text-[10px] font-extrabold">Akurasi</span>
                                    </div>
                                    <div class="text-[10px] text-slate-400 mt-0.5">Kalibrasi mental pengerjaan cepat di bawah tekanan countdown</div>
                                    <div class="text-[9px] text-indigo-600 font-semibold mt-1">Jadwal: Sabtu, 16.00</div>
                                </div>
                                <button onclick="showToast('Pendaftaran simulasi tryout kilat dikonfirmasi.','success')" class="text-xs font-bold text-indigo-600 hover:underline shrink-0">Daftar Slot &rarr;</button>
                            </div>
                        </div>

                        <button onclick="showToast('Rencana belajar disinkronkan ke kalender siswa & notifikasi Google Calendar.','success')" class="w-full py-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold text-xs transition flex items-center justify-center gap-1.5">
                            <i class="fas fa-calendar-plus text-xs"></i><span>Sinkronisasi Rencana ke Kalender Siswa</span>
                        </button>
                    </div>

                    {{-- 3. KIRIM RAPOR KE ORANG TUA (WHATSAPP) --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-3.5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <i class="fab fa-whatsapp text-emerald-600 text-sm"></i>
                                <h3 class="font-heading font-black text-xs text-slate-900">Kirim Rapor ke Orang Tua</h3>
                            </div>
                            <span class="px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">WA Online</span>
                        </div>

                        {{-- Parent contact box --}}
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold text-xs flex items-center justify-center">RW</div>
                                <div>
                                    <div class="font-bold text-xs text-slate-900">{{ $activeStudent['wali_nama'] }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $activeStudent['wali_phone'] }} (Ibu Kandung)</div>
                                </div>
                            </div>
                            <i class="fab fa-whatsapp text-emerald-500 text-lg"></i>
                        </div>

                        {{-- WA Text Preview --}}
                        <div class="p-3 rounded-xl bg-emerald-50/60 border border-emerald-100 text-xs text-slate-700 leading-relaxed font-sans">
                            <span class="text-[9px] font-bold text-emerald-700 uppercase block mb-1">Pesan Pengantar WhatsApp:</span>
                            "Yth. Ibu Rina, berikut terlampir progres belajar Tryout 08 ananda Dimas Arya. Skor IRT mencapai <strong>{{ $avgSkor > 0 ? number_format($avgSkor, 1) : '718.5' }}</strong> (sudah melampaui passing grade UI). Salam hangat, Tim EduPulse."
                        </div>

                        <button onclick="kirimRaporWaAction()" class="w-full py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-md shadow-emerald-200 transition active:scale-95 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-sm"></i>
                            <span>Kirimkan E-Rapor via WhatsApp Sekarang</span>
                        </button>

                        {{-- Riwayat Pengiriman Otomatis --}}
                        <div class="pt-2 border-t border-slate-100 space-y-1.5">
                            <div class="text-[9px] font-bold text-slate-400 uppercase">Riwayat Pengiriman Otomatis:</div>
                            <div class="flex items-center justify-between text-[10px] text-slate-500">
                                <span class="flex items-center gap-1.5"><i class="fas fa-check text-emerald-500"></i>Rapor TO-07 & Hasil Evaluasi</span>
                                <span>Dibaca &bull; 02 Mar, 10:14</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-slate-500">
                                <span class="flex items-center gap-1.5"><i class="fas fa-check text-emerald-500"></i>Rekap Presensi Bulan Februari</span>
                                <span>Dibaca &bull; 28 Feb, 19:30</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-slate-500">
                                <span class="flex items-center gap-1.5"><i class="fas fa-check text-emerald-500"></i>Rapor TO-06 Mid-Semester</span>
                                <span>Dibaca &bull; 15 Feb, 14:02</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>
</div>

{{-- ========================= MODAL EVALUASI BARU ========================= --}}
<div id="modalEvaluasi" class="modal-bd" onclick="if(event.target===this)closeModalEvaluasi()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#3b49df] text-white flex items-center justify-center text-sm shadow-md shadow-indigo-200">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Buat Evaluasi Khusus</h2>
                    <p class="text-xs text-slate-400">Input skor penilaian atau tryout baru siswa</p>
                </div>
            </div>
            <button onclick="closeModalEvaluasi()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('bimbel.progress.evaluasi.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Event / Tryout <span class="text-red-500">*</span></label>
                <input type="text" name="nama_tryout" placeholder="cth: Tryout Akbar 09 Nasional" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Skor IRT Rata-rata <span class="text-red-500">*</span></label>
                    <input type="number" step="0.1" name="skor" placeholder="cth: 725.0" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Target Passing Grade</label>
                    <input type="number" step="0.1" name="target_pg" value="695.0" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>
            </div>

            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalEvaluasi()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] hover:bg-indigo-700 text-white font-bold text-xs shadow-md shadow-indigo-200 transition active:scale-95">Simpan Evaluasi</button>
            </div>
        </form>
    </div>
</div>

{{-- ========================= MODAL CATATAN PEDAGOGIS ========================= --}}
<div id="modalCatatan" class="modal-bd" onclick="if(event.target===this)closeModalCatatan()">
    <div class="modal-card">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center text-sm shadow-md shadow-purple-200">
                    <i class="fas fa-pen-fancy"></i>
                </div>
                <div>
                    <h2 class="font-heading font-black text-base text-slate-900">Tambah Catatan Konselor / Tutor</h2>
                    <p class="text-xs text-slate-400">Tuliskan evaluasi perkembangan belajar dan strategi kampus</p>
                </div>
            </div>
            <button onclick="closeModalCatatan()" class="w-8 h-8 rounded-xl bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 flex items-center justify-center transition">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('bimbel.progress.catatan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Konselor / Master Tutor <span class="text-red-500">*</span></label>
                <input type="text" name="tutor_nama" value="Siti Maryam, S.Psi, M.Pd" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Catatan Pedagogis & Rekomendasi <span class="text-red-500">*</span></label>
                <textarea name="catatan" rows="4" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition placeholder-slate-400" placeholder="Tulis catatan analisis perkembangan siswa..."></textarea>
            </div>

            <div class="flex gap-3 pt-3">
                <button type="button" onclick="closeModalCatatan()" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-bold text-xs hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs shadow-md shadow-purple-200 transition active:scale-95">Simpan Catatan</button>
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

    function openModalEvaluasi() { document.getElementById('modalEvaluasi').classList.add('open'); }
    function closeModalEvaluasi() { document.getElementById('modalEvaluasi').classList.remove('open'); }
    function openModalCatatan() { document.getElementById('modalCatatan').classList.add('open'); }
    function closeModalCatatan() { document.getElementById('modalCatatan').classList.remove('open'); }

    function kirimRaporWaAction() {
        showToast('Mengirimkan E-Rapor Digital via WhatsApp...', 'info');
        fetch('{{ route("bimbel.progress.kirim_rapor") }}', {
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
        .catch(() => showToast('Gagal mengirim rapor via WhatsApp.', 'error'));
    }
</script>
</body>
</html>