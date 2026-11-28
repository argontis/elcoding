<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta Seminar - elc.my.id</title>
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
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-2xl bg-slate-800/80 backdrop-blur-xl border border-slate-700/60 rounded-3xl p-6 md:p-10 shadow-2xl relative z-10 my-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-block mb-4">
                <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-10 mx-auto">
            </a>
            <span class="inline-block px-3 py-1 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold rounded-full mb-2">
                <i class="fas fa-microphone-alt mr-1"></i> Portal Pendaftaran Peserta Seminar
            </span>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white">Lengkapi Data Peserta Seminar</h1>
            <p class="text-slate-400 text-sm mt-1">Pilih kategori seminar yang Anda ikuti untuk membuka akses promo &amp; benefit khusus</p>
        </div>

        @if(auth()->user()->isPendingRole())
            <div class="mb-4">
                <a href="{{ route('register.choose-role') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-emerald-400 transition">
                    <i class="fas fa-arrow-left"></i> Kembali ke Pilih Peran
                </a>
            </div>
        @endif

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
                <div class="w-10 h-10 rounded-full bg-emerald-600 font-bold text-white flex items-center justify-center">
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

        <form action="{{ route('register.seminar.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Section 1: Kategori Seminar -->
            <div class="space-y-4">
                <h3 class="text-sm font-bold uppercase tracking-wider text-emerald-400 border-b border-slate-700 pb-2">
                    <i class="fas fa-tags mr-1"></i> 1. Pilih Kategori Seminar *
                </h3>

                @if($categories->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($categories as $category)
                            <label class="cursor-pointer">
                                <input type="radio"
                                       name="seminar_category_id"
                                       value="{{ $category->id }}"
                                       class="peer sr-only"
                                       {{ (string) old('seminar_category_id', $profile?->seminar_category_id) === (string) $category->id ? 'checked' : ($loop->first && !old('seminar_category_id', $profile?->seminar_category_id) ? 'checked' : '') }}
                                       required>
                                <div class="h-full p-4 rounded-2xl bg-slate-900/70 border border-slate-700 peer-checked:border-emerald-400 peer-checked:bg-emerald-500/10 transition flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center justify-between gap-2 mb-1">
                                            <span class="font-bold text-sm text-white">{{ $category->name }}</span>
                                            <i class="fas fa-check-circle text-emerald-400 opacity-0 peer-checked:opacity-100"></i>
                                        </div>
                                        @if($category->description)
                                            <p class="text-xs text-slate-400 line-clamp-2">{{ $category->description }}</p>
                                        @endif
                                    </div>
                                    @if($category->event_date || $category->location)
                                        <div class="mt-3 pt-2 border-t border-slate-800 flex flex-wrap gap-2 text-[11px] text-slate-400">
                                            @if($category->event_date)
                                                <span><i class="fas fa-calendar-day text-emerald-400 mr-1"></i>{{ $category->event_date->format('d M Y') }}</span>
                                            @endif
                                            @if($category->location)
                                                <span><i class="fas fa-map-marker-alt text-blue-400 mr-1"></i>{{ $category->location }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                @else
                    <div class="bg-amber-500/10 border border-amber-500/30 text-amber-300 p-4 rounded-2xl text-xs">
                        <i class="fas fa-info-circle mr-1"></i> Kategori seminar belum tersedia saat ini. Anda tetap dapat melanjutkan pendaftaran dan melengkapi data diri.
                    </div>
                @endif
            </div>

            <!-- Section 2: Data Peserta -->
            <div class="space-y-4 pt-2">
                <h3 class="text-sm font-bold uppercase tracking-wider text-emerald-400 border-b border-slate-700 pb-2">
                    <i class="fas fa-id-card mr-1"></i> 2. Data Diri &amp; Kontak
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">No. WhatsApp Aktif *</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $profile?->phone_number ?? '') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 transition text-white placeholder-slate-500"
                               placeholder="Contoh: 081234567890">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Profesi / Status *</label>
                        <select name="occupation" required
                                class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 transition text-white">
                            @php $selectedOccupation = old('occupation', $profile?->occupation ?? ''); @endphp
                            <option value="" disabled {{ $selectedOccupation === '' ? 'selected' : '' }}>Pilih Profesi / Status</option>
                            @foreach(['Pelajar / Mahasiswa', 'Karyawan / Profesional', 'Wirausaha / UMKM', 'Guru / Dosen', 'Umum'] as $occ)
                                <option value="{{ $occ }}" {{ $selectedOccupation === $occ ? 'selected' : '' }}>{{ $occ }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Instansi / Perusahaan / Kampus *</label>
                        <input type="text" name="institution" value="{{ old('institution', $profile?->institution ?? '') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 transition text-white placeholder-slate-500"
                               placeholder="Contoh: Universitas Indonesia / PT Maju Jaya">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Kota / Domisili *</label>
                        <input type="text" name="city" value="{{ old('city', $profile?->city ?? '') }}" required
                               class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 transition text-white placeholder-slate-500"
                               placeholder="Contoh: Bekasi / Jakarta / Tegal">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Kebutuhan / Topik yang Diminati (Opsional)</label>
                    <textarea name="notes" rows="2"
                              class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-emerald-500 transition text-white placeholder-slate-500"
                              placeholder="Ceritakan singkat minat belajar, bisnis, atau layanan yang sedang Anda cari...">{{ old('notes', $profile?->notes ?? '') }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold rounded-2xl shadow-lg shadow-emerald-500/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="fas fa-gift"></i> Simpan Data &amp; Lihat Promo Benefit Seminar
                </button>
            </div>
        </form>
    </div>
</body>
</html>
