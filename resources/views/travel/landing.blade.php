<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L-Travel — Solusi SaaS Manajemen Biro Tour, Travel & Umroh</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        travel: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <!-- Top Announcement Bar -->
    <div class="bg-slate-900 text-slate-200 text-xs sm:text-sm py-2.5 px-4">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="flex items-center gap-2">
                <span class="bg-sky-500 text-slate-950 font-bold px-2 py-0.5 rounded text-xs uppercase tracking-wider">Update v2.5</span>
                <span>L-Travel kini terintegrasi dengan Manifest Paspor & WhatsApp Broadcast Gateway!</span>
            </div>
            <div class="flex items-center gap-4 text-xs">
                <a href="{{ route('travel.dashboard') }}" class="text-sky-400 hover:text-sky-300 font-medium underline flex items-center gap-1">
                    <i class="fa-solid fa-play text-[10px]"></i> Coba Dashboard Demo
                </a>
                <span class="text-slate-600">|</span>
                <a href="{{ $whatsappUrl }}" target="_blank" class="text-slate-300 hover:text-white flex items-center gap-1">
                    <i class="fa-brands fa-whatsapp text-emerald-400"></i> Konsultasi WA
                </a>
            </div>
        </div>
    </div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-tr from-sky-600 to-blue-600 flex items-center justify-center text-white shadow-lg shadow-sky-500/20">
                    <i class="fa-solid fa-plane-departure text-xl"></i>
                </div>
                <div>
                    <span class="text-2xl font-black tracking-tight text-slate-900">L-Travel<span class="text-sky-600">.</span></span>
                    <span class="hidden sm:inline-block text-[11px] font-semibold text-slate-500 ml-2 px-2 py-0.5 bg-slate-100 rounded-md uppercase tracking-wider">Travel SaaS</span>
                </div>
            </div>

            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#fitur" class="hover:text-sky-600 transition">Fitur Unggulan</a>
                <a href="#katalog" class="hover:text-sky-600 transition">Destinasi Wisata</a>
                <a href="#paket" class="hover:text-sky-600 transition">Paket Berlangganan</a>
                <a href="#faq" class="hover:text-sky-600 transition">Pusat Informasi</a>
            </nav>

            <div class="flex items-center gap-3">
                <!-- Dual Access: Mode Demo & Login Akun -->
                <a href="{{ route('travel.dashboard') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 text-sm font-semibold transition flex items-center gap-2">
                    <i class="fa-solid fa-desktop text-sky-600"></i>
                    <span>Demo Admin</span>
                </a>
                <a href="{{ url('/login') }}" class="hidden sm:flex px-4 py-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm font-semibold transition items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                    <span>Login Langganan</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 overflow-hidden bg-gradient-to-b from-white via-sky-50/25 to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-sky-100/80 border border-sky-200 text-sky-800 text-xs font-bold uppercase tracking-wider">
                        <i class="fa-solid fa-compass text-sky-600"></i>
                        Sistem Operasional Tour & Travel Terpadu
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                        Kelola Paket Wisata, Manifest & Jamaah Dalam <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-600 to-blue-600">Satu Platform Digital</span>.
                    </h1>
                    <p class="text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Otomatisasi reservasi paket trip, pengingat paspor & visa, monitoring armada bus/kapal, serta pelunasan invoice digital langsung via WhatsApp.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="pt-4 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('travel.dashboard') }}" class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-base shadow-lg shadow-sky-600/30 transition flex items-center justify-center gap-3">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span>Buka Dashboard Admin (Mode Demo)</span>
                        </a>
                        <a href="{{ $whatsappUrl }}" target="_blank" class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-white border border-slate-300 text-slate-800 hover:bg-slate-50 font-bold text-base shadow-sm transition flex items-center justify-center gap-3">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-xl"></i>
                            <span>Konsultasi Agensi WA</span>
                        </a>
                    </div>

                    <!-- Trust Points -->
                    <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-slate-500 font-semibold">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle text-sky-600 text-sm"></i>
                            <span>Akses langsung tanpa perlu login</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle text-sky-600 text-sm"></i>
                            <span>Akun login khusus langganan</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle text-sky-600 text-sm"></i>
                            <span>Integrasi WhatsApp Gateway</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Mockup Card -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div class="absolute -top-6 -left-6 w-72 h-72 bg-sky-400/20 rounded-full blur-3xl -z-10"></div>
                        <div class="absolute -bottom-6 -right-6 w-72 h-72 bg-blue-400/20 rounded-full blur-3xl -z-10"></div>

                        <div class="bg-white rounded-2xl shadow-2xl border border-slate-200/80 p-6 space-y-5">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-sky-100 flex items-center justify-center text-sky-700">
                                        <i class="fa-solid fa-kaaba text-lg"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-sm font-bold text-slate-900">Keberangkatan Terdekat</h2>
                                        <p class="text-xs text-slate-500">Umroh Khazanah Barokah 9H</p>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-bold">
                                    42 / 45 Seat Terisi
                                </span>
                            </div>

                            <!-- Progress Bar -->
                            <div class="space-y-2">
                                <div class="flex justify-between text-xs font-semibold text-slate-600">
                                    <span>Keterisian Kuota Rombongan</span>
                                    <span class="text-sky-600">93.3% Terisi</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                    <div class="bg-sky-500 h-3 rounded-full" style="width: 93.3%"></div>
                                </div>
                            </div>

                            <!-- Mini Stat Grid -->
                            <div class="grid grid-cols-2 gap-3 pt-2">
                                <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                                    <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Manifest Peserta</div>
                                    <div class="text-base font-extrabold text-slate-900 mt-1">42 Paspor</div>
                                    <div class="text-[10px] text-emerald-600 font-semibold mt-0.5"><i class="fa-solid fa-check"></i> Visa selesai 100%</div>
                                </div>
                                <div class="p-3.5 bg-slate-50 rounded-xl border border-slate-100">
                                    <div class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Armada Bus</div>
                                    <div class="text-base font-extrabold text-slate-900 mt-1">Jetbus 5 Ready</div>
                                    <div class="text-[10px] text-slate-500 font-semibold mt-0.5">PO Nusantara Trans</div>
                                </div>
                            </div>

                            <!-- Quick Action inside Mockup -->
                            <div class="p-4 rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 text-white flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-medium text-slate-300">Coba Fitur Lengkap?</p>
                                    <p class="text-sm font-bold text-white">Live Dashboard Admin L-Travel</p>
                                </div>
                                <a href="{{ route('travel.dashboard') }}" class="px-3.5 py-1.5 bg-sky-500 hover:bg-sky-400 text-slate-950 text-xs font-bold rounded-lg transition">
                                    Akses Demo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Statistics -->
    <section class="py-12 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">
                @foreach($stats as $st)
                <div class="p-6 rounded-2xl bg-slate-50/60 border border-slate-100">
                    <p class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">{{ $st['value'] }}</p>
                    <p class="text-sm font-bold text-slate-700 mt-1">{{ $st['label'] }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $st['sub'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Fitur Unggulan -->
    <section id="fitur" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full border border-sky-200">Fitur & Arsitektur SaaS</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 tracking-tight">Kelola Seluruh Operasional Tour & Travel Dalam Satu Kendali</h2>
                <p class="text-slate-600 mt-3 text-base">Tinggalkan spreadsheet manual yang berantakan. Pantau seluruh proses dari pendaftaran jamaah hingga kepulangan rombongan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($fiturUtama as $f)
                <div class="p-8 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl mb-6 border border-sky-100">
                        <i class="fa-solid {{ $f['icon'] }}"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $f['title'] }}</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Katalog Paket Populer -->
    <section id="katalog" class="py-20 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full border border-sky-200">Destinasi Unggulan</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-2 tracking-tight">Contoh Paket Perjalanan Terkelola di L-Travel</h2>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('travel.dashboard') }}" class="text-sm font-bold text-sky-600 hover:text-sky-700 flex items-center gap-1">
                        Lihat Data di Admin Dashboard <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($katalogPaket as $kp)
                <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden shadow-sm hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <div class="relative h-48 overflow-hidden bg-slate-100">
                            <img src="{{ $kp['gambar'] }}" alt="{{ $kp['nama'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-3 left-3">
                                <span class="text-[11px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider {{ $kp['status_class'] }}">
                                    {{ $kp['status'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-3 right-3">
                                <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-900/80 text-white backdrop-blur-sm">
                                    {{ $kp['kategori'] }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-xs font-semibold text-slate-500 flex items-center gap-1 mb-1">
                                <i class="fa-solid fa-clock text-sky-600"></i> {{ $kp['durasi'] }} • {{ $kp['maskapai'] }}
                            </p>
                            <h3 class="text-base font-bold text-slate-900 leading-snug mb-2">{{ $kp['nama'] }}</h3>
                            <p class="text-xs text-slate-600 mb-3"><i class="fa-solid fa-hotel text-slate-400 mr-1"></i>{{ $kp['hotel'] }}</p>
                        </div>
                    </div>
                    <div class="p-5 pt-0 border-t border-slate-100 mt-2">
                        <div class="pt-3 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 font-semibold block uppercase">Biaya Paket</span>
                                <span class="text-sm font-extrabold text-sky-700">{{ $kp['harga'] }}</span>
                            </div>
                            <a href="{{ $whatsappUrl }}" target="_blank" class="w-8 h-8 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-600 hover:text-white transition flex items-center justify-center text-xs" title="Tanya ketersediaan seat via WA">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Skema Berlangganan SaaS -->
    <section id="paket" class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full border border-sky-200">Skema Berlangganan</span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 tracking-tight">Pilih Paket Sesuai Kebutuhan Agensi Travel Anda</h2>
                <p class="text-slate-600 mt-3 text-base">Tanpa biaya tersembunyi. Dapatkan akun pengelola aktif untuk menyimpan seluruh data paket dan jamaah secara aman.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($paketLangganan as $pkt)
                <div class="rounded-2xl bg-white border {{ $pkt['populer'] ? 'border-sky-500 shadow-xl ring-2 ring-sky-500/20 relative' : 'border-slate-200 shadow-sm' }} p-8 flex flex-col justify-between">
                    @if($pkt['populer'])
                    <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                        <span class="bg-sky-600 text-white text-xs font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow">Paling Diminati</span>
                    </div>
                    @endif
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $pkt['nama'] }}</h3>
                        <p class="text-xs text-slate-500 mt-1 min-h-[32px]">{{ $pkt['target'] }}</p>
                        
                        <div class="mt-6 mb-8 flex items-baseline">
                            <span class="text-4xl font-black text-slate-900 tracking-tight">{{ $pkt['harga'] }}</span>
                            <span class="text-sm font-semibold text-slate-500 ml-1">{{ $pkt['periode'] }}</span>
                        </div>

                        <div class="space-y-3.5 text-sm">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Fitur Termasuk:</p>
                            @foreach($pkt['fitur'] as $fit)
                            <div class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-sky-600 text-sm mt-0.5"></i>
                                <span class="text-slate-700 text-xs sm:text-sm">{{ $fit }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-8 mt-8 border-t border-slate-100">
                        <a href="{{ $whatsappUrl }}" target="_blank" class="w-full py-3 rounded-xl font-bold text-sm text-center transition flex items-center justify-center gap-2 {{ $pkt['populer'] ? 'bg-sky-600 hover:bg-sky-700 text-white shadow-lg shadow-sky-600/30' : 'bg-slate-900 hover:bg-slate-800 text-white' }}">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            <span>Pilih Paket & Berlangganan</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Notice on Demo & Account -->
            <div class="mt-12 text-center p-6 rounded-2xl bg-sky-50/60 border border-sky-200 max-w-3xl mx-auto">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-left">
                    <div>
                        <h4 class="text-sm font-bold text-slate-900">Ingin Menguji Dashboard Travel Terlebih Dahulu?</h4>
                        <p class="text-xs text-slate-600 mt-0.5">Anda dapat langsung menjelajahi antarmuka admin L-Travel tanpa perlu login terlebih dahulu.</p>
                    </div>
                    <a href="{{ route('travel.dashboard') }}" class="px-5 py-2.5 bg-sky-600 text-white text-xs font-bold rounded-xl hover:bg-sky-700 transition whitespace-nowrap">
                        Masuk Mode Demo Admin
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action WhatsApp Consultation -->
    <section class="py-20 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,rgba(14,165,233,0.15),transparent_70%)]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <span class="inline-block px-3 py-1 rounded-full bg-sky-500/20 text-sky-400 text-xs font-bold uppercase tracking-wider mb-4 border border-sky-500/30">
                Pusat Informasi & Layanan Klien
            </span>
            <h2 class="text-3xl sm:text-5xl font-black tracking-tight max-w-3xl mx-auto leading-tight">
                Modernisasi Manajemen Biro Perjalanan Anda Bersama L-Travel!
            </h2>
            <p class="text-slate-400 text-base max-w-2xl mx-auto mt-4 leading-relaxed">
                Tim konsultan kami siap mendemonstrasikan sistem, migrasi data manifest jamaah, serta pengaturan template invoice WhatsApp resmi agensi Anda.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ $whatsappUrl }}" target="_blank" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-extrabold text-base shadow-xl shadow-sky-500/25 transition flex items-center justify-center gap-3">
                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                    <span>Hubungi Tim Konsultasi WhatsApp</span>
                </a>
                <a href="{{ route('travel.dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-base border border-slate-700 transition flex items-center justify-center gap-3">
                    <i class="fa-solid fa-eye"></i>
                    <span>Eksplorasi Demo Admin</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-12 border-t border-slate-800 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-sky-600 flex items-center justify-center text-white font-bold">
                        <i class="fa-solid fa-plane-departure"></i>
                    </div>
                    <span class="text-xl font-black text-white">L-Travel<span class="text-sky-500">.</span></span>
                    <span class="text-xs text-slate-500">SaaS Tour, Travel & Umroh Management Platform</span>
                </div>
                <div class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} L-Travel SaaS. Seluruh hak cipta dilindungi undang-undang.
                </div>
            </div>
        </div>
    </footer>

</body>
</html>

