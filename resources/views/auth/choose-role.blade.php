<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Peran Pendaftaran - elc.my.id</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-900 text-white min-h-screen flex items-center justify-center p-4 md:p-8 relative overflow-x-hidden">
    <!-- Background Decor -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-4xl bg-slate-800/80 backdrop-blur-xl border border-slate-700/60 rounded-3xl p-6 md:p-10 shadow-2xl relative z-10 my-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block mb-4">
                <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-10 mx-auto">
            </a>
            <span class="inline-block px-3 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold rounded-full mb-3">
                <i class="fas fa-user-check mr-1"></i> Langkah 2 dari 2 — Pilih Jalur Pendaftaran
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white">Selamat Datang, {{ $user->name }}!</h1>
            <p class="text-slate-400 text-sm mt-2 max-w-xl mx-auto">
                Akun Anda sudah berhasil dibuat. Silakan pilih jenis kepesertaan yang ingin Anda lanjutkan di platform elcoding.id.
            </p>
        </div>

        <!-- User Badge + Logout -->
        <div class="bg-slate-900/70 border border-slate-700/80 rounded-2xl p-4 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 font-bold text-white flex items-center justify-center shrink-0">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-xs text-slate-400">Masuk sebagai</p>
                    <p class="text-sm font-bold text-white">{{ $user->name }} <span class="text-slate-400 font-normal">({{ $user->email }})</span></p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="px-3.5 py-2 rounded-xl bg-slate-800 hover:bg-red-500/10 text-slate-300 hover:text-red-400 border border-slate-700 text-xs font-semibold transition flex items-center gap-2">
                    <i class="fas fa-power-off"></i> Ganti Akun
                </button>
            </form>
        </div>

        <!-- 2 Role Option Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Option 1: Magang / Training (PKL) -->
            <a href="{{ route('register.pkl') }}"
               class="group relative bg-slate-900/75 hover:bg-slate-900 border border-slate-700 hover:border-blue-500/70 rounded-3xl p-6 md:p-7 transition-all duration-300 flex flex-col justify-between shadow-lg hover:shadow-blue-500/10 hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl bg-blue-500/15 border border-blue-500/30 text-blue-400 flex items-center justify-center text-2xl group-hover:scale-105 transition">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-300 text-[11px] font-bold">
                            Program Reguler
                        </span>
                    </div>

                    <h2 class="text-xl font-extrabold text-white mb-2 group-hover:text-blue-300 transition">
                        Magang / Training (PKL)
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-5">
                        Untuk siswa SMK, mahasiswa, atau peserta training intensif yang akan mengikuti program magang, tugas, modul belajar, dan sertifikasi PKL.
                    </p>

                    <ul class="space-y-2 text-xs text-slate-300 mb-6">
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-blue-400"></i> Akses Portal Magang & Modul Silabus</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-blue-400"></i> Bimbingan Mentor, Tugas & Quiz</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-blue-400"></i> Presensi RFID & Sertifikat Resmi</li>
                    </ul>
                </div>

                <div class="pt-4 border-t border-slate-800 flex items-center justify-between text-sm font-bold text-blue-400 group-hover:text-blue-300">
                    <span>Lanjut Daftar Magang / PKL</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <!-- Option 2: Peserta Seminar -->
            <a href="{{ route('register.seminar') }}"
               class="group relative bg-gradient-to-br from-indigo-950/80 via-slate-900/80 to-slate-900/90 hover:from-indigo-950 hover:to-slate-900 border border-indigo-500/40 hover:border-emerald-400/70 rounded-3xl p-6 md:p-7 transition-all duration-300 flex flex-col justify-between shadow-lg hover:shadow-emerald-500/10 hover:-translate-y-1">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-14 h-14 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-2xl group-hover:scale-105 transition">
                            <i class="fas fa-gift"></i>
                        </div>
                        <span class="px-3 py-1 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-[11px] font-bold">
                            Promo & Benefit
                        </span>
                    </div>

                    <h2 class="text-xl font-extrabold text-white mb-2 group-hover:text-emerald-300 transition">
                        Peserta Seminar
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed mb-5">
                        Khusus peserta seminar, workshop, atau event Elcoding untuk memilih kategori seminar yang diikuti dan mendapatkan promo serta benefit eksklusif.
                    </p>

                    <ul class="space-y-2 text-xs text-slate-300 mb-6">
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-400"></i> Pilih Kategori Seminar yang Diikuti</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-400"></i> Akses Promo, Diskon & Benefit Khusus</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-400"></i> Pendampingan & Info Langsung dari Admin</li>
                    </ul>

                    @if($categories->count() > 0)
                        <div class="mb-5 flex flex-wrap gap-1.5">
                            @foreach($categories->take(3) as $cat)
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-800 border border-slate-700 text-[10px] font-semibold text-slate-300">
                                    {{ $cat->name }}
                                </span>
                            @endforeach
                            @if($categories->count() > 3)
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-800 border border-slate-700 text-[10px] font-semibold text-slate-400">
                                    +{{ $categories->count() - 3 }} lainnya
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="pt-4 border-t border-slate-800 flex items-center justify-between text-sm font-bold text-emerald-400 group-hover:text-emerald-300">
                    <span>Lanjut Daftar Peserta Seminar</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
