<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — L-Prosal SaaS Properti</title>
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
                        prosal: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    <!-- Top Banner for Guest / Demo Mode vs Subscriber Mode -->
    @if(!auth()->check())
    <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950 px-4 py-2 text-xs font-bold shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
            <div class="flex items-center gap-2">
                <span class="bg-slate-950 text-amber-300 px-2 py-0.5 rounded text-[10px] uppercase tracking-wider">Mode Pratinjau Demo</span>
                <span>Anda sedang mengakses Dashboard Admin tanpa login. Data dapat diubah dan disimpan sementara di browser Anda.</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('prosal.reset') }}" class="underline hover:text-white transition">Reset Data Demo</a>
                <span>•</span>
                <a href="{{ url('/login') }}" class="bg-slate-950 text-white px-3 py-1 rounded-md hover:bg-slate-800 transition">Login Akun Langganan</a>
            </div>
        </div>
    </div>
    @else
    <div class="bg-slate-900 text-slate-300 px-4 py-2 text-xs font-semibold">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Akun Langganan Aktif: <strong class="text-white">{{ auth()->user()->name ?? 'Administrator' }}</strong> (Paket Pro Management)</span>
            </div>
            <a href="{{ route('prosal.landing') }}" class="text-emerald-400 hover:text-emerald-300 underline">Lihat Halaman Publik</a>
        </div>
    </div>
    @endif

    <div class="flex-1 flex overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-slate-900 text-slate-300 flex-shrink-0 hidden md:flex flex-col justify-between border-r border-slate-800">
            <div>
                <!-- Brand Logo -->
                <div class="h-20 flex items-center px-6 border-b border-slate-800 gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center text-slate-950 font-black text-lg shadow-md shadow-emerald-500/20">
                        <i class="fa-solid fa-city"></i>
                    </div>
                    <div>
                        <span class="text-xl font-black text-white tracking-tight">L-Prosal<span class="text-emerald-400">.</span></span>
                        <span class="block text-[10px] uppercase font-bold tracking-wider text-slate-500">Property Admin</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1.5 text-sm font-semibold">
                    <p class="px-3 pt-3 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-500">Menu Manajemen</p>
                    
                    <a href="{{ route('prosal.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('prosal.dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                        <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                        <span>Dashboard Overview</span>
                    </a>

                    <a href="{{ route('prosal.unit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('prosal.unit') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                        <i class="fa-solid fa-building-user w-5 text-center"></i>
                        <span>Unit Properti</span>
                    </a>

                    <a href="{{ route('prosal.penyewa') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('prosal.penyewa') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                        <i class="fa-solid fa-users w-5 text-center"></i>
                        <span>Penyewa & Tenant</span>
                    </a>

                    <a href="{{ route('prosal.keuangan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('prosal.keuangan') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                        <i class="fa-solid fa-file-invoice-dollar w-5 text-center"></i>
                        <span>Tagihan & Keuangan</span>
                    </a>

                    <a href="{{ route('prosal.maintenance') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('prosal.maintenance') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-600/30 font-bold' : 'hover:bg-slate-800 text-slate-300' }}">
                        <i class="fa-solid fa-screwdriver-wrench w-5 text-center"></i>
                        <span>Maintenance & Keluhan</span>
                    </a>

                    <p class="px-3 pt-6 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-500">Akses Cepat</p>

                    <a href="{{ route('prosal.landing') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-white transition">
                        <i class="fa-solid fa-globe w-5 text-center text-emerald-400"></i>
                        <span>Halaman Publik (/Prosal)</span>
                    </a>

                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20L-Prosal%20Support" target="_blank" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-800 text-slate-400 hover:text-emerald-400 transition">
                        <i class="fa-brands fa-whatsapp w-5 text-center"></i>
                        <span>Bantuan Teknis WA</span>
                    </a>
                </nav>
            </div>

            <!-- User Panel / Session Info -->
            <div class="p-4 border-t border-slate-800">
                <div class="p-3 bg-slate-800/60 rounded-xl flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold text-xs">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-white truncate">{{ auth()->check() ? auth()->user()->name : 'Guest User (Demo)' }}</p>
                            <p class="text-[10px] text-slate-400">{{ auth()->check() ? 'Member Langganan' : 'Tanpa Akun' }}</p>
                        </div>
                    </div>
                    @if(auth()->check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-rose-400 text-xs" title="Keluar">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                    @else
                    <a href="{{ url('/login') }}" class="text-xs text-emerald-400 hover:text-white font-bold" title="Login">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                    @endif
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            <!-- Mobile Top Navbar -->
            <div class="md:hidden bg-slate-900 text-white px-4 py-3 flex items-center justify-between border-b border-slate-800">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500 flex items-center justify-center text-slate-950 font-bold">
                        <i class="fa-solid fa-city"></i>
                    </div>
                    <span class="font-bold text-base">L-Prosal Admin</span>
                </div>
                <div class="flex items-center gap-3 text-xs">
                    <a href="{{ route('prosal.landing') }}" class="text-slate-300 hover:text-white">Landing</a>
                    <a href="{{ route('prosal.dashboard') }}" class="text-emerald-400 font-bold">Dashboard</a>
                </div>
            </div>

            <!-- Page Header / Top Action Bar -->
            <div class="bg-white border-b border-slate-200 px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">@yield('page_title', 'Dashboard Overview')</h1>
                    <p class="text-xs text-slate-500 mt-0.5">@yield('page_subtitle', 'Panel operasional dan pemantauan aset properti L-Prosal')</p>
                </div>
                <div class="flex items-center gap-3">
                    @yield('top_actions')
                    <a href="{{ route('prosal.landing') }}" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Ke Halaman Publik</span>
                    </a>
                </div>
            </div>

            <!-- Notification Messages -->
            @if(session('success'))
            <div class="m-6 mb-0 p-4 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between text-emerald-800 text-sm font-semibold">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endif

            <!-- Content Slot -->
            <div class="p-6">
                @yield('content')
            </div>
        </main>
    </div>

</body>
</html>

