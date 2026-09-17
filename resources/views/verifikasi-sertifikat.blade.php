<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Keaslian Sertifikat - elc.my.id</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-950 text-white min-h-screen flex flex-col justify-between p-4 sm:p-8 relative overflow-x-hidden">
    <!-- Background Decor -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl"></div>

    <!-- Header -->
    <header class="max-w-4xl mx-auto w-full flex items-center justify-between py-4 relative z-10">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-8">
        </a>
        <a href="{{ route('login') }}" class="text-xs font-bold text-blue-400 hover:underline">
            Portal Admin & PKL &rarr;
        </a>
    </header>

    <main class="max-w-2xl mx-auto w-full my-auto relative z-10 py-8">
        <div class="text-center mb-8">
            <span class="inline-block px-3 py-1 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold rounded-full mb-3">
                <i class="fas fa-shield-alt mr-1"></i> Sistem Validasi Dokumen Digital
            </span>
            <h1 class="text-3xl font-black text-white">Verifikasi Keaslian Sertifikat</h1>
            <p class="text-slate-400 text-sm mt-2">Cek validitas sertifikat resmi kelulusan magang / PKL elc.my.id</p>
        </div>

        <!-- Search Form -->
        <form action="{{ route('verifikasi.sertifikat') }}" method="GET" class="mb-8">
            <div class="flex flex-col sm:flex-row gap-3 bg-slate-900/80 p-2 border border-slate-800 rounded-2xl shadow-xl backdrop-blur-xl">
                <input type="text" name="code" value="{{ $searchCode }}" required
                       class="flex-1 bg-transparent px-4 py-3 text-sm focus:outline-none text-white placeholder-slate-500 font-mono"
                       placeholder="Masukkan Nomor Sertifikat (misal: CERT/ELC/PKL/2026/0001)">
                <button type="submit" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm rounded-xl transition shadow-lg flex items-center justify-center gap-2">
                    <i class="fas fa-search"></i> Verifikasi Kode
                </button>
            </div>
        </form>

        @if($searched)
            @if($certificate)
                <div class="bg-slate-900/90 border-2 border-emerald-500/40 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-2xl space-y-6">
                    <div class="flex items-center gap-3 border-b border-slate-800 pb-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl shrink-0">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <span class="inline-block px-2.5 py-0.5 bg-emerald-500/20 text-emerald-300 font-bold text-[11px] rounded-md">
                                SERTIFIKAT VALID & TERVERIFIKASI
                            </span>
                            <h2 class="text-lg font-bold text-white mt-1">Dokumen Asli elc.my.id</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div class="bg-slate-950/60 p-3.5 rounded-xl border border-slate-800 space-y-1">
                            <span class="text-slate-500 block">Nomor Sertifikat</span>
                            <strong class="text-white font-mono text-sm">{{ $certificate->certificate_number }}</strong>
                        </div>

                        <div class="bg-slate-950/60 p-3.5 rounded-xl border border-slate-800 space-y-1">
                            <span class="text-slate-500 block">Nama Peserta Magang</span>
                            <strong class="text-white text-sm">{{ $certificate->profile->user->name ?? '-' }}</strong>
                        </div>

                        <div class="bg-slate-950/60 p-3.5 rounded-xl border border-slate-800 space-y-1">
                            <span class="text-slate-500 block">Instansi Sekolah / Kampus</span>
                            <strong class="text-slate-200">{{ $certificate->profile->institution ?? '-' }} ({{ $certificate->profile->major ?? '-' }})</strong>
                        </div>

                        <div class="bg-slate-950/60 p-3.5 rounded-xl border border-slate-800 space-y-1">
                            <span class="text-slate-500 block">Program / Divisi Magang</span>
                            <strong class="text-blue-400">{{ $certificate->profile->program->title ?? $certificate->profile->program->name ?? 'IT & Development' }}</strong>
                        </div>

                        <div class="bg-slate-950/60 p-3.5 rounded-xl border border-slate-800 space-y-1">
                            <span class="text-slate-500 block">Predikat Kelulusan</span>
                            <strong class="text-amber-400 font-bold text-sm">{{ strtoupper($certificate->predicate) }}</strong>
                        </div>

                        <div class="bg-slate-950/60 p-3.5 rounded-xl border border-slate-800 space-y-1">
                            <span class="text-slate-500 block">Tanggal Terbit</span>
                            <strong class="text-slate-200">{{ $certificate->issue_date ? $certificate->issue_date->format('d M Y') : '-' }}</strong>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-slate-900/90 border-2 border-red-500/40 rounded-3xl p-8 backdrop-blur-xl text-center space-y-4 shadow-2xl">
                    <div class="w-14 h-14 bg-red-500/20 text-red-400 rounded-3xl flex items-center justify-center mx-auto text-2xl">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Sertifikat Tidak Ditemukan</h2>
                        <p class="text-slate-400 text-xs mt-1">Nomor sertifikat "<span class="font-mono text-white">{{ $searchCode }}</span>" tidak terdaftar di database elc.my.id.</p>
                    </div>
                </div>
            @endif
        @endif
    </main>

    <footer class="max-w-4xl mx-auto w-full text-center text-xs text-slate-600 py-4 relative z-10">
        <p>&copy; {{ date('Y') }} elc.my.id — All rights reserved.</p>
    </footer>
</body>
</html>
