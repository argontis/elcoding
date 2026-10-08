<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengaturan & Konfigurasi Sistem — EduPulse Academy</title>
    <meta name="description" content="Kelola profil lembaga, konfigurasi WhatsApp otomasi, payment gateway SPP, kebijakan AI Tutor, dan hak akses staf EduPulse Academy.">

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
        .toast-item.error   { background: #7f1d1d; border-left: 4px solid #ef4444; }
        .toast-item.info    { background: #1e3a5f; border-left: 4px solid #3b82f6; }
        @keyframes ti { from { opacity:0; transform:translateY(14px);} to {opacity:1; transform:translateY(0);} }
        .modal-bd  { position:fixed;inset:0;z-index:50;background:rgba(0,0,0,.45);backdrop-filter:blur(4px);display:none;align-items:center;justify-content:center;padding:1rem; }
        .modal-bd.open { display:flex; }
        .modal-card { background:#fff;border-radius:24px;max-width:520px;width:100%;padding:28px;box-shadow:0 24px 64px rgba(0,0,0,.18);border:1px solid #f1f5f9;max-height:90vh;overflow-y:auto;animation:ti .25s ease; }
        /* Toggle switch */
        .toggle-switch { position:relative;width:44px;height:24px;cursor:pointer; }
        .toggle-switch input { opacity:0;width:0;height:0; }
        .toggle-track { position:absolute;top:0;left:0;right:0;bottom:0;background:#cbd5e1;border-radius:12px;transition:.25s; }
        .toggle-track:before { content:'';position:absolute;width:18px;height:18px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:.25s; }
        .toggle-switch input:checked + .toggle-track { background:#3b49df; }
        .toggle-switch input:checked + .toggle-track:before { transform:translateX(20px); }
        /* Tab active */
        .tab-btn.active { background:#3b49df;color:#fff;box-shadow:0 4px 12px rgba(59,73,223,.25); }
        .section-card { background:#fff;border-radius:20px;border:1px solid #f1f5f9;padding:24px;box-shadow:0 1px 4px rgba(0,0,0,.04);margin-bottom:20px; }
        .form-label  { display:block;font-size:11px;font-weight:700;color:#64748b;margin-bottom:5px;text-transform:uppercase;letter-spacing:.04em; }
        .form-input  { width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:9px 13px;font-size:13px;font-weight:500;color:#1e293b;transition:.2s;background:#fff;outline:none; }
        .form-input:focus { border-color:#3b49df;box-shadow:0 0 0 3px rgba(59,73,223,.12); }
        .form-input::placeholder { color:#94a3b8; }
        .btn-save { display:inline-flex;align-items:center;gap:8px;background:#3b49df;color:#fff;border:none;border-radius:12px;padding:10px 20px;font-size:12px;font-weight:700;cursor:pointer;transition:.2s; }
        .btn-save:hover { background:#2e38b8;transform:translateY(-1px); }
        .badge-status { display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:10px;font-weight:700; }
        .badge-status.connected    { background:#dcfce7;color:#166534; }
        .badge-status.disconnected { background:#fee2e2;color:#991b1b; }
        .payment-card { border:1.5px solid #e2e8f0;border-radius:14px;padding:16px;transition:.2s; }
        .payment-card.active { border-color:#3b49df;background:#f0f1fe; }
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
                <div class="flex items-center gap-3"><i class="fas fa-user-group text-slate-400 text-sm w-4 text-center"></i><span>Siswa &amp; Pendaftaran</span></div>
                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-indigo-50 text-indigo-600">PPDB</span>
            </a>
            <a href="{{ route('bimbel.jadwal') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-calendar-days text-slate-400 text-sm w-4 text-center"></i><span>Jadwal &amp; Kelas</span>
            </a>
            <a href="{{ route('bimbel.tagihan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-file-invoice-dollar text-slate-400 text-sm w-4 text-center"></i><span>Tagihan &amp; SPP</span>
            </a>
            <a href="{{ route('bimbel.materi') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-book-open text-slate-400 text-sm w-4 text-center"></i><span>Materi &amp; Kurikulum</span>
            </a>
            <a href="{{ route('bimbel.progress') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-chart-line text-slate-400 text-sm w-4 text-center"></i><span>Progress &amp; Rapor</span>
            </a>
            <a href="{{ route('bimbel.ai_tutor') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-slate-50 transition-all">
                <i class="fas fa-robot text-slate-400 text-sm w-4 text-center"></i><span>AI Tutor Assistant</span>
            </a>
            {{-- ACTIVE: PENGATURAN --}}
            <a href="{{ route('bimbel.pengaturan') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-bold bg-[#3b49df] text-white shadow-md shadow-indigo-200">
                <i class="fas fa-gear text-sm w-4 text-center"></i><span>Pengaturan</span>
            </a>

            <div class="pt-2 mt-2 border-t border-slate-100">
                <form action="{{ route('bimbel.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-red-600 hover:bg-red-50 transition-all text-left">
                        <i class="fas fa-right-from-bracket text-red-500 text-sm w-4 text-center"></i><span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </nav>

        <div class="m-3 p-3 rounded-xl bg-indigo-50 border border-indigo-100">
            <div class="text-xs font-bold text-indigo-700 mb-1">Bantuan Sistem</div>
            <p class="text-[10px] text-indigo-500 leading-relaxed">Panduan konfigurasi & troubleshooting sistem bimbel.</p>
            <a href="javascript:void(0)" onclick="showToast('Dokumentasi sistem siap diakses.','info')" class="text-[10px] font-bold text-indigo-600 hover:underline mt-1 inline-block">Akses Dokumen &rarr;</a>
        </div>
    </aside>

    {{-- ========================= MAIN CONTENT ========================= --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- TOP NAVBAR --}}
        <header class="bg-white border-b border-slate-200/80 px-6 py-3 flex items-center justify-between shrink-0 shadow-sm z-20">
            <div class="flex items-center gap-3">
                <div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Akademik &amp; Produksi / Pengaturan Sistem</div>
                    <div class="flex items-center gap-2 mt-0.5">
                        <h1 class="font-heading font-black text-base text-slate-900">Pengaturan &amp; Konfigurasi Sistem</h1>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-200">
                            <i class="fas fa-circle text-[6px] text-amber-500 mr-1"></i>Status: Operasional Normal
                        </span>
                    </div>
                    <div class="text-[11px] text-slate-400 mt-0.5">Kelola identitas lembaga, konfigurasi otomasi WA, model AI Tutor, serta hak akses staf.</div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('bimbel.pengaturan.reset') }}"
                   onclick="return confirm('Reset semua pengaturan ke kondisi kosong?')"
                   class="flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:border-red-300 hover:text-red-600 transition-all">
                    <i class="fas fa-rotate-left"></i> Reset Pengaturan
                </a>
                <button onclick="showToast('Semua perubahan aktif tersimpan di sesi.','success')" class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#3b49df] text-white text-xs font-bold shadow-md shadow-indigo-200 hover:bg-[#2e38b8] transition-all">
                    <i class="fas fa-floppy-disk"></i> Simpan Semua Perubahan
                </button>
                <div class="relative group">
                    <button class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 hover:bg-slate-50 cursor-pointer transition">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            S
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-bold text-slate-800 leading-tight">Sarah Maharani, M.Pd</div>
                            <div class="text-[10px] text-slate-400 font-medium">Admin Akademik</div>
                        </div>
                        <i class="fas fa-chevron-down text-slate-400 text-[10px]"></i>
                    </button>
                    <div class="absolute right-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-1 hidden group-hover:block hover:block z-50">
                        <div class="px-3 py-2 border-b border-slate-100">
                            <p class="text-xs font-bold text-slate-800">Sarah Maharani</p>
                            <p class="text-[10px] text-slate-500 truncate">bimbel@elcoding.com</p>
                        </div>
                        <form action="{{ route('bimbel.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-xs text-red-600 hover:bg-red-50 font-semibold flex items-center">
                                <i class="fas fa-right-from-bracket mr-2 text-red-500"></i>Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
        <div class="mx-6 mt-4 px-4 py-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold flex items-center gap-2">
            <i class="fas fa-circle-check text-emerald-500"></i> {{ session('success') }}
        </div>
        @endif
        @if(session('info'))
        <div class="mx-6 mt-4 px-4 py-3 rounded-xl bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold flex items-center gap-2">
            <i class="fas fa-circle-info text-blue-500"></i> {{ session('info') }}
        </div>
        @endif

        {{-- TAB NAVIGATION --}}
        <div class="px-6 pt-4 shrink-0">
            <div class="flex items-center gap-2 overflow-x-auto ss pb-1">
                <button onclick="switchTab('semua')" id="tab-semua" class="tab-btn active flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap text-slate-600 hover:bg-slate-100">
                    <i class="fas fa-sliders"></i> Semua Konfigurasi
                </button>
                <button onclick="switchTab('profil')" id="tab-profil" class="tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap text-slate-600 hover:bg-slate-100">
                    <i class="fas fa-building"></i> Profil &amp; Cabang Bimbel
                </button>
                <button onclick="switchTab('whatsapp')" id="tab-whatsapp" class="tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap text-slate-600 hover:bg-slate-100">
                    <i class="fab fa-whatsapp"></i> WhatsApp &amp; Notifikasi Otomatis
                </button>
                <button onclick="switchTab('payment')" id="tab-payment" class="tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap text-slate-600 hover:bg-slate-100">
                    <i class="fas fa-credit-card"></i> Payment Gateway &amp; SPP
                </button>
                <button onclick="switchTab('ai')" id="tab-ai" class="tab-btn flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold transition-all whitespace-nowrap text-slate-600 hover:bg-slate-100">
                    <i class="fas fa-brain"></i> Model &amp; Kebijakan AI
                </button>
            </div>
        </div>

        {{-- MAIN SCROLL AREA --}}
        <main class="flex-1 overflow-y-auto ss px-6 pt-4 pb-8">
            <div class="grid grid-cols-3 gap-5">

                {{-- LEFT COLUMN (2/3) --}}
                <div class="col-span-2 space-y-5">

                    {{-- ============================================
                         SECTION: PROFIL LEMBAGA & CABANG
                    ============================================ --}}
                    <div id="sec-profil" class="section-card" data-tab="profil semua">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                                    <i class="fas fa-building text-blue-500 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-heading font-bold text-sm text-slate-900">Profil Lembaga &amp; Cabang Operasional</div>
                                    <div class="text-[11px] text-slate-400">Identitas resmi, legalitas, dan data kontak lembaga bimbingan belajar.</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                @if(!empty($profil['nama_lembaga']))
                                    <span class="px-2 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-bold border border-emerald-200">
                                        <i class="fas fa-circle-check mr-1"></i>Cabang ID: #{{ count($cabangList) + 1 }}
                                    </span>
                                @else
                                    <span class="px-2 py-1 rounded-lg bg-slate-50 text-slate-400 text-[10px] font-bold border border-slate-200">
                                        <i class="fas fa-circle-minus mr-1"></i>Belum dikonfigurasi
                                    </span>
                                @endif
                                <button onclick="showToast('Pilih file logo PNG/SVG maks. 2MB.','info')" class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-600 text-[10px] font-bold border border-indigo-200 hover:bg-indigo-100 transition-all">
                                    <i class="fas fa-upload mr-1"></i>Upload Logo
                                </button>
                            </div>
                        </div>

                        {{-- Logo Placeholder --}}
                        <div class="flex items-center gap-4 mb-5 p-4 rounded-xl bg-slate-50 border border-dashed border-slate-300">
                            <div class="w-16 h-16 rounded-2xl bg-white border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-300 text-2xl shrink-0">
                                @if(!empty($profil['logo_url']))
                                    <img src="{{ $profil['logo_url'] }}" class="w-full h-full object-contain rounded-xl" alt="Logo">
                                @else
                                    <i class="fas fa-image"></i>
                                @endif
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-700">{{ $profil['nama_lembaga'] ?: 'Nama Lembaga Belum Diisi' }}</div>
                                <div class="text-[11px] text-slate-400 mt-0.5">Logo &amp; Stempel Digital</div>
                                <div class="text-[10px] text-amber-600 font-bold mt-1 flex items-center gap-1">
                                    <i class="fas fa-circle text-[6px]"></i>
                                    {{ empty($profil['nama_lembaga']) ? 'Isi profil untuk menampilkan branding lembaga' : 'Aktif — Tampil di dokumen & WhatsApp' }}
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('bimbel.pengaturan.profil.save') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="form-label">Nama Resmi Lembaga</label>
                                    <input type="text" name="nama_lembaga" value="{{ $profil['nama_lembaga'] }}" placeholder="Contoh: EduPulse Academy" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">NPWP / NPSN / Nomor SK Dinas</label>
                                    <input type="text" name="sk_dinas" value="{{ $profil['sk_dinas'] }}" placeholder="SK Dinas No. ..." class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">NPWP</label>
                                    <input type="text" name="npwp" value="{{ $profil['npwp'] }}" placeholder="00.000.000.0-000.000" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Tanggal SK / Akreditasi</label>
                                    <input type="date" name="tanggal_sk" value="{{ $profil['tanggal_sk'] }}" class="form-input">
                                </div>
                                <div class="col-span-2">
                                    <label class="form-label">Cabang / Alamat Operasional Utama</label>
                                    <input type="text" name="alamat" value="{{ $profil['alamat'] }}" placeholder="Jl. ... Kota, Provinsi" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Nomor Operasional (Resmi &amp; WhatsApp Suara)</label>
                                    <input type="text" name="telepon" value="{{ $profil['telepon'] }}" placeholder="+62 8xx-xxxx-xxxx" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Email Operasional / Korespondensi Dinas</label>
                                    <input type="email" name="email_ops" value="{{ $profil['email_ops'] }}" placeholder="ops@namalembaga.id" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Jam Operasional</label>
                                    <input type="text" name="jam_operasi" value="{{ $profil['jam_operasi'] }}" placeholder="Senin-Sabtu, 08.00-21.00 WIB" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Mata Pelajaran Unggulan (Ctrl+Klik)</label>
                                    <select name="mata_pelajaran[]" multiple class="form-input" style="height:70px;">
                                        @foreach(['Matematika','Fisika','Kimia','Biologi','Bahasa Indonesia','Bahasa Inggris','Penalaran Umum','TPS UTBK','Literasi Bahasa'] as $mp)
                                            <option value="{{ $mp }}" {{ in_array($mp, $profil['mata_pelajaran'] ?? []) ? 'selected' : '' }}>{{ $mp }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-5 pt-4 border-t border-slate-100">
                                <div>
                                    <div class="text-[11px] font-bold text-slate-500">Daftar Cabang ({{ count($cabangList) }} Cabang)</div>
                                    @if(count($cabangList) === 0)
                                        <div class="text-[10px] text-slate-400 mt-0.5">Belum ada cabang terdaftar. Tambahkan via tombol <span class="font-bold text-indigo-600">+ Cabang Baru</span></div>
                                    @else
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach($cabangList as $cb)
                                                <span class="px-2 py-0.5 rounded bg-indigo-50 text-indigo-700 text-[10px] font-bold">{{ $cb['nama'] ?? '-' }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="flex gap-2">
                                    <button type="button" onclick="openModal('modal-cabang')" class="px-3 py-1.5 rounded-xl border border-indigo-200 text-indigo-600 text-[11px] font-bold hover:bg-indigo-50 transition-all">
                                        <i class="fas fa-plus mr-1"></i>Cabang Baru
                                    </button>
                                    <button type="submit" class="btn-save">
                                        <i class="fas fa-floppy-disk"></i> Simpan Profil
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- ============================================
                         SECTION: WHATSAPP & OTOMASI NOTIFIKASI
                    ============================================ --}}
                    <div id="sec-whatsapp" class="section-card" data-tab="whatsapp semua">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-green-50 flex items-center justify-center">
                                    <i class="fab fa-whatsapp text-green-500 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-heading font-bold text-sm text-slate-900">WhatsApp &amp; Otomasi Notifikasi</div>
                                    <div class="text-[11px] text-slate-400">Hubungkan nomor WA Official lembaga untuk blast otomatis ke siswa/orang tua.</div>
                                </div>
                            </div>
                            @php $waStatus = $waConfig['status'] ?? 'disconnected'; @endphp
                            <span class="badge-status {{ $waStatus === 'connected' ? 'connected' : 'disconnected' }}">
                                <i class="fas fa-circle text-[7px]"></i>
                                {{ $waStatus === 'connected' ? 'Terhubung' : 'Belum Terhubung' }}
                            </span>
                        </div>

                        <form action="{{ route('bimbel.pengaturan.whatsapp.save') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="form-label">Nomor Gateway WhatsApp</label>
                                    <input type="text" name="nomor" value="{{ $waConfig['nomor'] }}" placeholder="+62811-xxxx-xxxx (WA Official)" class="form-input">
                                </div>
                                <div>
                                    <label class="form-label">Nama Pengirim (Tampil di WA Penerima)</label>
                                    <input type="text" name="nama_pengirim" value="{{ $waConfig['nama_pengirim'] }}" placeholder="EduPulse Official" class="form-input">
                                </div>
                            </div>

                            {{-- Toggle Notifikasi --}}
                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-4 space-y-3 mb-4">
                                <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Otomasi Notifikasi Aktif</div>

                                @php
                                    $toggles = [
                                        ['key'=>'notif_tagihan',    'icon'=>'fas fa-file-invoice-dollar', 'label'=>'Pengingat Tagihan SPP &amp; Pembayaran Otomatis',   'desc'=>'Kirim H-7, H-3, H-0 sebelum jatuh tempo secara otomatis setiap siswa.'],
                                        ['key'=>'notif_laporan',    'icon'=>'fas fa-chart-bar',           'label'=>'Laporan Akademik &amp; Presensi Real-time Siswa',   'desc'=>'Kirim laporan kehadiran dan perkembangan belajar siswa tiap minggu ke WA.'],
                                        ['key'=>'notif_distribusi', 'icon'=>'fas fa-book-open',           'label'=>'Distribusi Rapor Tryout &amp; Analisis Skor (IRT)', 'desc'=>'Otomatis kirim e-rapor tryout IRT ke orang tua siswa setelah sesi evaluasi.'],
                                        ['key'=>'notif_broadcast',  'icon'=>'fas fa-bullhorn',            'label'=>'Broadcast Pengumuman Kelas &amp; Jadwal Akbar',     'desc'=>'Pengiriman pengumuman massal jadwal kelas, libur sekolah &amp; event khusus.'],
                                    ];
                                @endphp

                                @foreach($toggles as $t)
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center shrink-0 mt-0.5">
                                            <i class="{{ $t['icon'] }} text-slate-500 text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-[12px] font-bold text-slate-700">{!! $t['label'] !!}</div>
                                            <div class="text-[10px] text-slate-400">{{ $t['desc'] }}</div>
                                        </div>
                                    </div>
                                    <label class="toggle-switch shrink-0 mt-1">
                                        <input type="checkbox" name="{{ $t['key'] }}" value="1" {{ !empty($waConfig[$t['key']]) ? 'checked' : '' }}>
                                        <span class="toggle-track"></span>
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            {{-- Template WA --}}
                            <div class="mb-4">
                                <label class="form-label">Pratinjau Template Notifikasi Tagihan (Edit Template WA)</label>
                                <textarea name="template_wa" rows="4" class="form-input" style="resize:vertical;" placeholder="Contoh: Yth. Bapak/Ibu {nama_ortu}, tagihan SPP {bulan} sebesar {nominal} belum terbayar. Mohon segera lakukan pembayaran sebelum {jatuh_tempo}. Detail: {link_va}">{{ $waConfig['template_wa'] }}</textarea>
                                <div class="text-[10px] text-slate-400 mt-1">Gunakan variabel: <code class="bg-slate-100 rounded px-1">{nama_siswa}</code> <code class="bg-slate-100 rounded px-1">{nama_ortu}</code> <code class="bg-slate-100 rounded px-1">{nominal}</code> <code class="bg-slate-100 rounded px-1">{jatuh_tempo}</code> <code class="bg-slate-100 rounded px-1">{link_va}</code></div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-save">
                                    <i class="fab fa-whatsapp"></i> Simpan &amp; Hubungkan WA
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- ============================================
                         SECTION: MESIN AI TUTOR & KEBIJAKAN PEDAGOGIS
                    ============================================ --}}
                    <div id="sec-ai" class="section-card" data-tab="ai semua">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center">
                                    <i class="fas fa-brain text-purple-500 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-heading font-bold text-sm text-slate-900">Mesin AI Tutor &amp; Kebijakan Pedagogis</div>
                                    <div class="text-[11px] text-slate-400">Atur model AI, kuota token, dan kebijakan interaksi siswa dengan tutor AI adaptif.</div>
                                </div>
                            </div>
                            <span class="px-2 py-1 rounded-lg bg-purple-50 text-purple-600 text-[10px] font-bold border border-purple-200">
                                Model: {{ $aiConfig['model'] ?? 'EduPulse AI v2.4' }}
                            </span>
                        </div>

                        {{-- Token Usage Bar --}}
                        @php
                            $tokenPct = $aiConfig['token_total'] > 0
                                ? round(($aiConfig['token_digunakan'] / $aiConfig['token_total']) * 100)
                                : 0;
                        @endphp
                        <div class="p-4 rounded-xl bg-purple-50 border border-purple-200 mb-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-xs font-bold text-purple-700">Konsumsi Token AI Akademik</div>
                                <div class="text-xs font-bold text-purple-900">
                                    {{ number_format($aiConfig['token_digunakan']) }} / {{ number_format($aiConfig['token_total']) }}
                                    <span class="text-[10px] text-purple-500 font-semibold ml-1">Token ({{ $tokenPct }}% terpakai)</span>
                                </div>
                            </div>
                            <div class="h-2 bg-purple-200 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full transition-all" style="width:{{ $tokenPct }}%"></div>
                            </div>
                            <div class="flex justify-between text-[10px] text-purple-500 mt-1.5">
                                <span>Expired: {{ $aiConfig['expired_at'] ?: 'Belum diatur' }}</span>
                                <span>Sisa: {{ number_format($aiConfig['token_total'] - $aiConfig['token_digunakan']) }} token</span>
                            </div>
                        </div>

                        <form action="{{ route('bimbel.pengaturan.ai.save') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="form-label">Model AI Backbone</label>
                                    <select name="model" class="form-input">
                                        @foreach(['EduPulse AI v2.4','EduPulse AI v2.3','GPT-4o (Bridged)','Gemini 1.5 Pro (Bridged)'] as $m)
                                            <option value="{{ $m }}" {{ ($aiConfig['model'] ?? '') === $m ? 'selected' : '' }}>{{ $m }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Mode Bisnis Lisensi</label>
                                    <select name="mode_bisnis" class="form-input">
                                        @foreach(['EduPulse.LLC.LLP','EduPulse.SME.Solo','EduPulse.Enterprise'] as $mb)
                                            <option value="{{ $mb }}" {{ ($aiConfig['mode_bisnis'] ?? '') === $mb ? 'selected' : '' }}>{{ $mb }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Konteks Akademis (Jumlah Pesan Diingat AI)</label>
                                    <input type="number" name="konteks_akademis" value="{{ $aiConfig['konteks_akademis'] }}" min="5" max="100" placeholder="30" class="form-input">
                                    <div class="text-[10px] text-slate-400 mt-1">Rekomendasi: 20-50 pesan. Lebih tinggi = lebih cerdas tapi lebih boros token.</div>
                                </div>
                                <div>
                                    <label class="form-label">Batas Soal / Hari / Siswa</label>
                                    <input type="number" name="batas_soal" value="{{ $aiConfig['batas_soal'] }}" placeholder="Tidak dibatasi (kosong)" class="form-input">
                                    <div class="text-[10px] text-slate-400 mt-1">Kosongkan untuk tidak membatasi. Isi angka untuk hemat token.</div>
                                </div>
                            </div>

                            {{-- Kebijakan Toggle --}}
                            <div class="rounded-xl bg-slate-50 border border-slate-200 p-4 space-y-3 mb-4">
                                <div class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Kebijakan Interaksi Pedagogis</div>

                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <div class="text-[12px] font-bold text-slate-700">Kebijakan Pedagogis (Metode Sokrasi)</div>
                                        <div class="text-[10px] text-slate-400">AI tidak memberikan jawaban langsung - siswa diajak berpikir melalui pertanyaan terpadu.</div>
                                    </div>
                                    <label class="toggle-switch shrink-0">
                                        <input type="checkbox" name="kebijakan_sokrasi" value="1" {{ !empty($aiConfig['kebijakan_sokrasi']) ? 'checked' : '' }}>
                                        <span class="toggle-track"></span>
                                    </label>
                                </div>

                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <div class="text-[12px] font-bold text-slate-700">Protokol Anti-Kecurangan Tryout Bergantung</div>
                                        <div class="text-[10px] text-slate-400">AI mendeteksi pola kecurangan soal dan mem-block respons jika terindikasi copy-paste jawaban.</div>
                                    </div>
                                    <label class="toggle-switch shrink-0">
                                        <input type="checkbox" name="protokol_aktif" value="1" {{ !empty($aiConfig['protokol_aktif']) ? 'checked' : '' }}>
                                        <span class="toggle-track"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-robot"></i> Simpan Kebijakan AI
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- ============================================
                         SECTION: PAYMENT GATEWAY & REKENING VIRTUAL SPP
                    ============================================ --}}
                    <div id="sec-payment" class="section-card" data-tab="payment semua">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center">
                                    <i class="fas fa-credit-card text-amber-500 text-sm"></i>
                                </div>
                                <div>
                                    <div class="font-heading font-bold text-sm text-slate-900">Payment Gateway &amp; Rekening Virtual SPP</div>
                                    <div class="text-[11px] text-slate-400">Konfigurasi metode pembayaran digital untuk tagihan SPP otomatis.</div>
                                </div>
                            </div>
                            <button onclick="showToast('Panduan integrasi payment gateway tersedia.','info')" class="text-[10px] font-bold text-indigo-600 hover:underline">
                                <i class="fas fa-question-circle mr-1"></i>Panduan Integrasi
                            </button>
                        </div>

                        <form action="{{ route('bimbel.pengaturan.payment.save') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-3 gap-4 mb-5">
                                {{-- OVO --}}
                                <div class="payment-card {{ !empty($paymentConfig['ovo_aktif']) ? 'active' : '' }}">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-xl bg-purple-100 flex items-center justify-center">
                                                <i class="fas fa-wallet text-purple-500 text-xs"></i>
                                            </div>
                                            <div class="text-xs font-bold text-slate-800">OVO</div>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="ovo_aktif" value="1" {{ !empty($paymentConfig['ovo_aktif']) ? 'checked' : '' }}>
                                            <span class="toggle-track"></span>
                                        </label>
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-500 uppercase mb-1">Merchant ID</div>
                                    <input type="text" name="ovo_merchant_id" value="{{ $paymentConfig['ovo_merchant_id'] ?? '' }}" placeholder="OVO Merchant ID" class="form-input text-[11px]">
                                    <div class="mt-1.5 text-[9px] text-slate-400">Diperoleh dari OVO Business Dashboard</div>
                                </div>

                                {{-- BRI Virtual Account --}}
                                <div class="payment-card {{ !empty($paymentConfig['bri_aktif']) ? 'active' : '' }}">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-university text-blue-500 text-xs"></i>
                                            </div>
                                            <div class="text-xs font-bold text-slate-800">Virtual Account BRI</div>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="bri_aktif" value="1" {{ !empty($paymentConfig['bri_aktif']) ? 'checked' : '' }}>
                                            <span class="toggle-track"></span>
                                        </label>
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-500 uppercase mb-1">VA Prefix</div>
                                    <input type="text" name="bri_va_prefix" value="{{ $paymentConfig['bri_va_prefix'] ?? '' }}" placeholder="Prefix VA BRI" class="form-input text-[11px] mb-2">
                                    <div class="text-[10px] font-bold text-slate-500 uppercase mb-1">No. Rekening</div>
                                    <input type="text" name="bri_rekening" value="{{ $paymentConfig['bri_rekening'] ?? '' }}" placeholder="No. Rekening BRI" class="form-input text-[11px]">
                                </div>

                                {{-- GoPay --}}
                                <div class="payment-card {{ !empty($paymentConfig['gopay_aktif']) ? 'active' : '' }}">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center">
                                                <i class="fas fa-qrcode text-green-500 text-xs"></i>
                                            </div>
                                            <div class="text-xs font-bold text-slate-800">GoPay / QRIS Digital</div>
                                        </div>
                                        <label class="toggle-switch">
                                            <input type="checkbox" name="gopay_aktif" value="1" {{ !empty($paymentConfig['gopay_aktif']) ? 'checked' : '' }}>
                                            <span class="toggle-track"></span>
                                        </label>
                                    </div>
                                    <div class="text-[10px] font-bold text-slate-500 uppercase mb-1">Merchant / QRIS ID</div>
                                    <input type="text" name="gopay_merchant" value="{{ $paymentConfig['gopay_merchant'] ?? '' }}" placeholder="GoPay Merchant QRIS ID" class="form-input text-[11px]">
                                    <div class="mt-1.5 text-[9px] text-slate-400">GoPay, OVO, ShopeePay, Dana via QRIS</div>
                                </div>
                            </div>

                            {{-- Toleransi Hari --}}
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 border border-slate-200 mb-4">
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-700 mb-0.5">Toleransi Keterlambatan SPP (Grace Period)</div>
                                    <div class="text-[11px] text-slate-400">Jumlah hari toleransi sebelum sistem memblokir akses siswa ke platform / materi kelas.</div>
                                </div>
                                <div class="flex items-center gap-2 shrink-0">
                                    <input type="number" name="toleransi_hari" value="{{ $paymentConfig['toleransi_hari'] ?? '' }}" placeholder="3" min="0" max="30" class="form-input w-20 text-center font-bold">
                                    <span class="text-xs font-bold text-slate-500">Hari Kerja</span>
                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-credit-card"></i> Simpan Payment Gateway
                                </button>
                            </div>
                        </form>
                    </div>

                </div>{{-- END LEFT COLUMN --}}

                {{-- RIGHT COLUMN (1/3) --}}
                <div class="col-span-1 space-y-4">

                    {{-- Pengguna & Hak Akses Staf --}}
                    <div class="section-card">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-xl bg-indigo-50 flex items-center justify-center">
                                    <i class="fas fa-users-gear text-indigo-500 text-xs"></i>
                                </div>
                                <div class="font-heading font-bold text-xs text-slate-900">Pengguna &amp; Hak Akses Staf</div>
                            </div>
                            <button onclick="openModal('modal-staff')" class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 hover:bg-indigo-100 transition-all">
                                <i class="fas fa-plus text-[10px]"></i>
                            </button>
                        </div>

                        @if(count($staffList) === 0)
                            <div class="py-8 flex flex-col items-center justify-center text-center">
                                <div class="w-12 h-12 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-300 flex items-center justify-center mb-3">
                                    <i class="fas fa-user-plus text-slate-300 text-lg"></i>
                                </div>
                                <div class="text-xs font-bold text-slate-400">Belum Ada Staf Terdaftar</div>
                                <div class="text-[10px] text-slate-300 mt-1">Tambahkan pengajar, konselor, atau admin.</div>
                                <button onclick="openModal('modal-staff')" class="mt-3 px-3 py-1.5 rounded-xl bg-indigo-600 text-white text-[10px] font-bold hover:bg-indigo-700 transition-all">
                                    + Tambah Pengguna Baru
                                </button>
                            </div>
                        @else
                            <div class="space-y-2">
                                @foreach($staffList as $st)
                                <div class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-slate-50 transition-all">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white text-xs font-black shrink-0">
                                        {{ strtoupper(substr($st['nama'] ?? 'S', 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-[11px] font-bold text-slate-800 truncate">{{ $st['nama'] }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $st['role'] ?? '-' }}</div>
                                    </div>
                                    <span class="px-1.5 py-0.5 rounded text-[9px] font-bold {{ ($st['role'] ?? '') === 'Super Admin' ? 'bg-red-50 text-red-600' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $st['role'] ?? 'Staf' }}
                                    </span>
                                </div>
                                @endforeach
                                <button onclick="openModal('modal-staff')" class="w-full py-2 rounded-xl border-2 border-dashed border-slate-200 text-slate-400 text-[10px] font-bold hover:border-indigo-300 hover:text-indigo-500 transition-all">
                                    + Tambah Pengguna Baru
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- Log Audit & Keamanan --}}
                    <div class="section-card">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-xl bg-red-50 flex items-center justify-center">
                                    <i class="fas fa-shield-halved text-red-500 text-xs"></i>
                                </div>
                                <div class="font-heading font-bold text-xs text-slate-900">Log Audit &amp; Keamanan</div>
                            </div>
                            <button onclick="showToast('Mengunduh log audit sistem...','info')" class="text-[10px] font-bold text-indigo-600 hover:underline">
                                <i class="fas fa-download mr-1"></i>Unduh CSV
                            </button>
                        </div>

                        @if(count($auditLog) === 0)
                            <div class="py-6 text-center">
                                <div class="w-10 h-10 rounded-2xl bg-slate-50 border-2 border-dashed border-slate-300 flex items-center justify-center mx-auto mb-2">
                                    <i class="fas fa-shield-halved text-slate-200 text-lg"></i>
                                </div>
                                <div class="text-[10px] font-bold text-slate-400">Belum Ada Aktivitas Tercatat</div>
                                <div class="text-[9px] text-slate-300 mt-1">Log akan muncul setelah Anda menyimpan pengaturan.</div>
                            </div>
                        @else
                            <div class="space-y-2 max-h-60 overflow-y-auto ss">
                                @foreach(array_reverse($auditLog) as $log)
                                <div class="flex items-start gap-2 py-2 border-b border-slate-100 last:border-0">
                                    <div class="w-1.5 h-1.5 rounded-full bg-indigo-500 mt-1.5 shrink-0"></div>
                                    <div class="flex-1">
                                        <div class="text-[11px] font-bold text-slate-700">{{ $log['aksi'] }}</div>
                                        <div class="text-[10px] text-slate-400">{{ $log['detail'] }}</div>
                                        <div class="text-[9px] text-slate-300 mt-0.5">{{ $log['waktu'] }} &mdash; {{ $log['user'] }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Info & Status Sistem --}}
                    <div class="section-card bg-gradient-to-br from-indigo-600 to-blue-700 text-white border-0">
                        <div class="font-heading font-bold text-sm mb-3">Info &amp; Status Sistem</div>
                        <div class="space-y-2 text-[11px]">
                            <div class="flex justify-between">
                                <span class="text-indigo-200">Versi EduPulse</span>
                                <span class="font-bold">v3.2.1 Stable</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-indigo-200">Lisensi</span>
                                <span class="font-bold">{{ $aiConfig['mode_bisnis'] ?? 'EduPulse.LLC.LLP' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-indigo-200">Status Server</span>
                                <span class="font-bold text-emerald-300"><i class="fas fa-circle text-[8px] mr-1"></i>Operational</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-indigo-200">WhatsApp API</span>
                                <span class="font-bold {{ ($waConfig['status'] ?? 'disconnected') === 'connected' ? 'text-emerald-300' : 'text-red-300' }}">
                                    {{ ($waConfig['status'] ?? 'disconnected') === 'connected' ? 'Connected' : 'Disconnected' }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-indigo-200">AI Engine</span>
                                <span class="font-bold text-purple-300">{{ $aiConfig['model'] ?? 'EduPulse AI v2.4' }}</span>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-indigo-500">
                            <button onclick="showToast('Memeriksa pembaruan sistem...','info')" class="w-full py-2 rounded-xl bg-white/20 hover:bg-white/30 text-white text-[11px] font-bold transition-all">
                                <i class="fas fa-rotate mr-1"></i>Periksa Pembaruan Sistem
                            </button>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="section-card">
                        <div class="font-heading font-bold text-xs text-slate-700 mb-3">Aksi Cepat Admin</div>
                        <div class="space-y-2">
                            <button onclick="showToast('Mengekspor backup konfigurasi JSON...','info')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-700 text-xs font-semibold transition-all text-left">
                                <i class="fas fa-download text-slate-400 w-4 text-center"></i>Backup Konfigurasi JSON
                            </button>
                            <button onclick="showToast('Mode pemeliharaan diaktifkan (simulasi).','info')" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl bg-slate-50 hover:bg-amber-50 text-slate-700 hover:text-amber-700 text-xs font-semibold transition-all text-left">
                                <i class="fas fa-wrench text-slate-400 w-4 text-center"></i>Aktifkan Mode Pemeliharaan
                            </button>
                            <a href="{{ route('bimbel.pengaturan.reset') }}"
                               onclick="return confirm('Reset SEMUA pengaturan? Tindakan ini tidak dapat dibatalkan.')"
                               class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl bg-red-50 hover:bg-red-100 text-red-600 text-xs font-semibold transition-all">
                                <i class="fas fa-triangle-exclamation w-4 text-center"></i>Factory Reset Pengaturan
                            </a>
                        </div>
                    </div>

                </div>{{-- END RIGHT COLUMN --}}
            </div>
        </main>
    </div>
</div>

{{-- ========================= MODALS ========================= --}}

{{-- Modal: Tambah Cabang --}}
<div id="modal-cabang" class="modal-bd">
    <div class="modal-card">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="font-heading font-black text-lg text-slate-900">Tambah Cabang Baru</h2>
                <p class="text-xs text-slate-400 mt-0.5">Isi detail cabang operasional lembaga Anda.</p>
            </div>
            <button onclick="closeModal('modal-cabang')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-all">
                <i class="fas fa-xmark text-slate-500 text-sm"></i>
            </button>
        </div>
        <form onsubmit="handleAddCabang(event)" class="space-y-4">
            <div>
                <label class="form-label">Nama Cabang</label>
                <input type="text" id="cabang-nama" placeholder="Contoh: Cabang Depok Timur" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Alamat Lengkap Cabang</label>
                <input type="text" id="cabang-alamat" placeholder="Jl. ... RT/RW, Kelurahan, Kecamatan, Kota" class="form-input">
            </div>
            <div>
                <label class="form-label">No. Telepon Cabang</label>
                <input type="text" id="cabang-telp" placeholder="+62 8xx-xxxx-xxxx" class="form-input">
            </div>
            <div>
                <label class="form-label">Kepala Cabang</label>
                <input type="text" id="cabang-kepala" placeholder="Nama Kepala Cabang" class="form-input">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modal-cabang')" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] text-white text-xs font-bold hover:bg-[#2e38b8] transition-all">Simpan Cabang</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal: Tambah Staf --}}
<div id="modal-staff" class="modal-bd">
    <div class="modal-card">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="font-heading font-black text-lg text-slate-900">Tambah Pengguna Staf</h2>
                <p class="text-xs text-slate-400 mt-0.5">Daftarkan pengajar, konselor, atau admin sistem.</p>
            </div>
            <button onclick="closeModal('modal-staff')" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 flex items-center justify-center transition-all">
                <i class="fas fa-xmark text-slate-500 text-sm"></i>
            </button>
        </div>
        <form onsubmit="handleAddStaff(event)" class="space-y-4">
            <div>
                <label class="form-label">Nama Lengkap Staf</label>
                <input type="text" id="staff-nama" placeholder="Nama lengkap staf" class="form-input" required>
            </div>
            <div>
                <label class="form-label">Email (Login ID)</label>
                <input type="email" id="staff-email" placeholder="email@lembaga.id" class="form-input">
            </div>
            <div>
                <label class="form-label">Role / Jabatan</label>
                <select id="staff-role" class="form-input">
                    <option value="">-- Pilih Role --</option>
                    <option value="Super Admin">Super Admin</option>
                    <option value="Pengajar / Tutor">Pengajar / Tutor</option>
                    <option value="Konselor Akademik">Konselor Akademik</option>
                    <option value="Front Office">Front Office</option>
                    <option value="Keuangan SPP">Keuangan SPP</option>
                </select>
            </div>
            <div>
                <label class="form-label">Cabang Ditugaskan</label>
                <input type="text" id="staff-cabang" placeholder="Nama cabang atau 'Semua Cabang'" class="form-input">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeModal('modal-staff')" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all">Batal</button>
                <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#3b49df] text-white text-xs font-bold hover:bg-[#2e38b8] transition-all">Daftarkan Staf</button>
            </div>
        </form>
    </div>
</div>

{{-- TOAST --}}
<div class="toast-wrap" id="toast-wrap"></div>

<script>
// ========== UTILS ==========
function showToast(msg, type = 'success') {
    const wrap = document.getElementById('toast-wrap');
    const t = document.createElement('div');
    t.className = `toast-item ${type}`;
    const icons = { success: 'circle-check', error: 'circle-xmark', info: 'circle-info' };
    t.innerHTML = `<i class="fas fa-${icons[type] || 'circle-check'}"></i><span>${msg}</span>`;
    wrap.appendChild(t);
    setTimeout(() => t.remove(), 4000);
}

function openModal(id)  { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

// Close modal on backdrop click
document.querySelectorAll('.modal-bd').forEach(m => {
    m.addEventListener('click', e => { if (e.target === m) closeModal(m.id); });
});

// ========== TAB SWITCHING ==========
function switchTab(tab) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('text-slate-600', 'hover:bg-slate-100');
    });
    const activeBtn = document.getElementById('tab-' + tab);
    if (activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.classList.remove('text-slate-600', 'hover:bg-slate-100');
    }
    document.querySelectorAll('[data-tab]').forEach(sec => {
        const tabs = sec.dataset.tab.split(' ');
        sec.style.display = (tab === 'semua' || tabs.includes(tab)) ? '' : 'none';
    });
}

// ========== ADD CABANG (client-side simulation) ==========
function handleAddCabang(e) {
    e.preventDefault();
    const nama = document.getElementById('cabang-nama').value.trim();
    if (!nama) { showToast('Nama cabang wajib diisi.', 'error'); return; }
    showToast(`Cabang "${nama}" berhasil ditambahkan. Simpan profil untuk menyimpan.`, 'success');
    closeModal('modal-cabang');
    ['cabang-nama','cabang-alamat','cabang-telp','cabang-kepala'].forEach(id => document.getElementById(id).value = '');
}

// ========== ADD STAFF (client-side simulation) ==========
function handleAddStaff(e) {
    e.preventDefault();
    const nama = document.getElementById('staff-nama').value.trim();
    const role = document.getElementById('staff-role').value;
    if (!nama) { showToast('Nama staf wajib diisi.', 'error'); return; }
    if (!role) { showToast('Pilih role staf terlebih dahulu.', 'error'); return; }
    showToast(`Staf "${nama}" (${role}) berhasil didaftarkan.`, 'success');
    closeModal('modal-staff');
    ['staff-nama','staff-email','staff-cabang'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('staff-role').value = '';
}

// ========== FLASH FROM SESSION ==========
@if(session('success'))
    document.addEventListener('DOMContentLoaded', () => showToast(@json(session('success')), 'success'));
@endif
@if(session('info'))
    document.addEventListener('DOMContentLoaded', () => showToast(@json(session('info')), 'info'));
@endif
</script>
</body>
</html>