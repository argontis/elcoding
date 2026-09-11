<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran & Pemilihan Program PKL - elc.my.id</title>
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
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/30 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl"></div>

    <div class="w-full max-w-2xl bg-slate-800/80 backdrop-blur-xl border border-slate-700/60 rounded-3xl p-6 md:p-10 shadow-2xl relative z-10 my-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block mb-4">
                <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-10 mx-auto">
            </a>
            <span class="inline-block px-3 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-semibold rounded-full mb-2">
                <i class="fas fa-graduation-cap mr-1"></i> Portal Pendaftaran PKL & Magang
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white">Pilih Program & Profil PKL</h1>
            <p class="text-slate-400 text-sm mt-1">Lengkapi data instansi dan pilih divisi program magang yang ingin Anda ikuti</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-2xl mb-6 text-sm">
                <div class="font-bold flex items-center gap-2 mb-1">
                    <i class="fas fa-exclamation-circle"></i> Mohon perbaiki kesalahan berikut:
                </div>
                <ul class="list-disc list-inside space-y-1 text-slate-300">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Logged In User Info Banner -->
        <div class="bg-slate-900/80 p-4 rounded-2xl border border-slate-700 mb-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-600 font-bold text-white flex items-center justify-center">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <span class="text-xs text-slate-400 block">Terautentikasi Sebagai:</span>
                    <strong class="text-sm text-white">{{ auth()->user()->name }}</strong> 
                    <span class="text-xs text-slate-400">({{ auth()->user()->email }})</span>
                </div>
            </div>
            <span class="px-2.5 py-1 bg-emerald-500/10 text-emerald-400 font-bold text-xs rounded-full border border-emerald-500/20">
                <i class="fas fa-check-circle mr-1"></i> Terverifikasi
            </span>
        </div>

        <form action="{{ route('register.pkl.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Divisi Program Kursus -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-blue-400 border-b border-slate-700 pb-2">
                    <i class="fas fa-graduation-cap mr-1"></i> 1. Pilih Program / Divisi Magang *
                </h3>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Program / Divisi Magang yang Diikuti *</label>
                    <select name="program_id" required class="w-full bg-slate-900 border border-blue-500/50 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-400 text-white font-semibold shadow-inner">
                        <option value="">-- Pilih Program / Divisi Magang --</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ (old('program_id', $profile?->program_id ?? '') == $program->id) ? 'selected' : '' }}>
                                📌 {{ $program->title ?? $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Section 2: Data Pendidikan -->
            <div class="space-y-4 pt-2">
                <h3 class="text-sm font-bold uppercase tracking-wider text-blue-400 border-b border-slate-700 pb-2">
                    <i class="fas fa-university mr-1"></i> 2. Instansi & Pendidikan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Sekolah / Kampus *</label>
                        <input type="text" name="institution" value="{{ old('institution', $profile?->institution ?? '') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="Contoh: SMK Negeri 1 / Universitas Diponegoro">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Jurusan / Program Studi *</label>
                        <input type="text" name="major" value="{{ old('major', $profile?->major ?? '') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="Contoh: Rekayasa Perangkat Lunak / Teknik Informatika">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Nomor Induk (NIS / NIM)</label>
                        <input type="text" name="student_id_number" value="{{ old('student_id_number', $profile?->student_id_number ?? '') }}"
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="NISN / NIM siswa">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">No. WhatsApp *</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $profile?->phone_number ?? '') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="081234567890">
                    </div>
                </div>
            </div>

            <!-- Section 3: Periode -->
            <div class="space-y-4 pt-2">
                <h3 class="text-sm font-bold uppercase tracking-wider text-blue-400 border-b border-slate-700 pb-2">
                    <i class="fas fa-calendar-alt mr-1"></i> 3. Periode PKL / Magang
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Tanggal Mulai PKL *</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $profile?->start_date ? $profile->start_date->format('Y-m-d') : date('Y-m-d')) }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Tanggal Selesai PKL *</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $profile?->end_date ? $profile->end_date->format('Y-m-d') : '') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Alamat Domisili</label>
                    <textarea name="address" rows="2"
                              class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                              placeholder="Alamat tempat tinggal saat ini">{{ old('address', $profile?->address ?? '') }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="fas fa-check-circle"></i> Konfirmasi & Simpan Program PKL
                </button>
            </div>
        </form>
    </div>
</body>
</html>
