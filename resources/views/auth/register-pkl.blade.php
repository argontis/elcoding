<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anak PKL / Magang - elc.my.id</title>
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
            <h1 class="text-2xl md:text-3xl font-extrabold text-white">Registrasi Peserta Magang</h1>
            <p class="text-slate-400 text-sm mt-1">Lengkapi data diri dan instansi Anda untuk mendapatkan akun portal PKL elc.my.id</p>
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

        <form action="{{ route('register.pkl.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Data Akun -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-blue-400 border-b border-slate-700 pb-2">
                    <i class="fas fa-user-circle mr-1"></i> 1. Informasi Akun
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="Nama lengkap sesuai identitas">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="email@domain.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Password *</label>
                        <input type="password" name="password" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="Minimal 8 karakter">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Konfirmasi Password *</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="Ulangi password">
                    </div>
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
                        <input type="text" name="institution" value="{{ old('institution') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="Contoh: SMK Negeri 1 / Universitas Diponegoro">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Jurusan / Program Studi *</label>
                        <input type="text" name="major" value="{{ old('major') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="Contoh: Rekayasa Perangkat Lunak / Teknik Informatika">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Nomor Induk (NIS / NIM)</label>
                        <input type="text" name="student_id_number" value="{{ old('student_id_number') }}"
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="NISN / NIM siswa">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">No. WhatsApp *</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                               placeholder="081234567890">
                    </div>
                </div>
            </div>

            <!-- Section 3: Periode & Program -->
            <div class="space-y-4 pt-2">
                <h3 class="text-sm font-bold uppercase tracking-wider text-blue-400 border-b border-slate-700 pb-2">
                    <i class="fas fa-calendar-alt mr-1"></i> 3. Periode & Divisi Program
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Tanggal Mulai PKL *</label>
                        <input type="date" name="start_date" value="{{ old('start_date', date('Y-m-d')) }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Tanggal Selesai PKL *</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Divisi / Program Kelas PKL</label>
                    <select name="program_id" class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white">
                        <option value="">-- Pilih Program / Divisi (Opsional) --</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                {{ $program->title ?? $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Alamat Domisili</label>
                    <textarea name="address" rows="2"
                              class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition text-white placeholder-slate-500"
                              placeholder="Alamat tempat tinggal saat ini">{{ old('address') }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="fas fa-paper-plane"></i> Daftar Akun PKL Sekarang
                </button>
            </div>

            <div class="text-center pt-2 text-sm text-slate-400">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-400 hover:underline font-semibold">Login di sini</a>
            </div>
        </form>
    </div>
</body>
</html>
