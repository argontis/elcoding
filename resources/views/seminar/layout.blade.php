<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Peserta Seminar - elc.my.id')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb { background: #475569; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }
        #mobile-nav-overlay { transition: opacity 0.25s ease, visibility 0.25s ease; }
        #mobile-nav-panel { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .bottom-nav-bar { padding-bottom: env(safe-area-inset-bottom, 0px); }
        main { animation: fadeInUp 0.3s ease forwards; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans">

    <!-- Top Navbar -->
    <header class="bg-slate-800/95 border-b border-slate-700/80 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 sm:h-16 flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <a href="{{ route('seminar.dashboard') }}" class="flex items-center gap-2 shrink-0">
                    <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-7 sm:h-8">
                    <span class="hidden xs:inline-flex bg-emerald-600/20 text-emerald-400 text-xs font-bold px-2.5 py-1 rounded-full border border-emerald-500/30 whitespace-nowrap">
                        Portal Seminar
                    </span>
                </a>
            </div>

            <!-- Desktop Profile + Logout -->
            <div class="hidden md:flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-bold flex items-center justify-center shadow-md text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-bold leading-none text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 leading-tight mt-0.5 truncate max-w-[180px]">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-3 py-2 text-slate-400 hover:text-red-400 hover:bg-slate-700/50 rounded-xl transition text-xs font-semibold" title="Logout">
                        <i class="fas fa-power-off"></i>
                        <span class="hidden lg:inline">Keluar</span>
                    </button>
                </form>
            </div>

            <!-- Mobile: Avatar + Hamburger -->
            <div class="flex md:hidden items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-bold flex items-center justify-center shadow-md text-xs shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <button id="mobile-nav-toggle" onclick="toggleMobileNav()"
                        class="p-2 rounded-xl text-slate-300 hover:bg-slate-700 transition"
                        aria-label="Menu navigasi">
                    <i class="fas fa-bars text-base" id="hamburger-icon"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Desktop Tabs -->
    <div class="hidden md:block bg-slate-800/50 border-b border-slate-700/50 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-1 py-2 overflow-x-auto">
            <a href="{{ route('seminar.dashboard') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('seminar.dashboard') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-gift"></i> Promo &amp; Benefit
            </a>

            <a href="{{ route('seminar.my-promos') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('seminar.my-promos') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-heart"></i> Promo Diminati
            </a>

            <a href="{{ route('seminar.profile') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('seminar.profile') ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-user-cog"></i> Profil Saya
            </a>
        </div>
    </div>

    <!-- Mobile Overlay & Drawer -->
    <div id="mobile-nav-overlay" onclick="closeMobileNav()" class="md:hidden fixed inset-0 z-40 bg-slate-950/70 backdrop-blur-sm opacity-0 invisible"></div>
    <div id="mobile-nav-panel" class="md:hidden fixed top-0 right-0 h-full w-72 z-50 bg-slate-800 border-l border-slate-700 shadow-2xl" style="transform: translateX(100%);">
        <div class="flex items-center justify-between p-5 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-600 text-white font-bold flex items-center justify-center shadow-md">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-bold text-white leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-slate-400 mt-0.5 truncate max-w-[150px]">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <button onclick="closeMobileNav()" class="p-2 text-slate-400 hover:text-white hover:bg-slate-700 rounded-xl transition">
                <i class="fas fa-times text-base"></i>
            </button>
        </div>

        <nav class="p-4 space-y-1">
            <a href="{{ route('seminar.dashboard') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('seminar.dashboard') ? 'bg-emerald-600 text-white' : 'text-slate-300 hover:bg-slate-700/60' }}">
                <i class="fas fa-gift w-5 text-center"></i> Promo &amp; Benefit
            </a>
            <a href="{{ route('seminar.my-promos') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('seminar.my-promos') ? 'bg-emerald-600 text-white' : 'text-slate-300 hover:bg-slate-700/60' }}">
                <i class="fas fa-heart w-5 text-center"></i> Promo Diminati
            </a>
            <a href="{{ route('seminar.profile') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('seminar.profile') ? 'bg-emerald-600 text-white' : 'text-slate-300 hover:bg-slate-700/60' }}">
                <i class="fas fa-user-cog w-5 text-center"></i> Profil Saya
            </a>
        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-700 bg-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 font-bold text-sm rounded-2xl border border-red-500/20 transition">
                    <i class="fas fa-power-off"></i> Keluar / Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Bottom Bar -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-30 bg-slate-800/95 backdrop-blur-md border-t border-slate-700/80 bottom-nav-bar">
        <div class="flex items-center justify-around px-2 py-2">
            <a href="{{ route('seminar.dashboard') }}" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition {{ request()->routeIs('seminar.dashboard') ? 'text-emerald-400' : 'text-slate-500' }}">
                <i class="fas fa-gift text-base"></i>
                <span class="text-[10px] font-semibold">Promo</span>
            </a>
            <a href="{{ route('seminar.my-promos') }}" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition {{ request()->routeIs('seminar.my-promos') ? 'text-emerald-400' : 'text-slate-500' }}">
                <i class="fas fa-heart text-base"></i>
                <span class="text-[10px] font-semibold">Diminati</span>
            </a>
            <a href="{{ route('seminar.profile') }}" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition {{ request()->routeIs('seminar.profile') ? 'text-emerald-400' : 'text-slate-500' }}">
                <i class="fas fa-user-cog text-base"></i>
                <span class="text-[10px] font-semibold">Profil</span>
            </a>
            <button onclick="toggleMobileNav()" class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition text-slate-500 hover:text-slate-300">
                <i class="fas fa-ellipsis-h text-base"></i>
                <span class="text-[10px] font-semibold">Menu</span>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 pb-24 md:pb-8">
        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-4 rounded-2xl mb-6 flex items-center justify-between text-sm shadow-lg">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-lg shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200 shrink-0 ml-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-2xl mb-6 flex items-center justify-between text-sm shadow-lg">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-lg shrink-0"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-200 shrink-0 ml-3">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="hidden md:block bg-slate-800/40 border-t border-slate-700/40 py-5 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} elc.my.id — Portal Peserta Seminar &amp; Benefit Eksklusif.</p>
    </footer>

    <script>
        const panel = document.getElementById('mobile-nav-panel');
        const overlay = document.getElementById('mobile-nav-overlay');
        const hamIcon = document.getElementById('hamburger-icon');
        let isOpen = false;

        function openMobileNav() {
            panel.style.transform = 'translateX(0)';
            overlay.style.opacity = '1';
            overlay.style.visibility = 'visible';
            document.body.style.overflow = 'hidden';
            hamIcon.classList.replace('fa-bars', 'fa-times');
            isOpen = true;
        }

        function closeMobileNav() {
            panel.style.transform = 'translateX(100%)';
            overlay.style.opacity = '0';
            overlay.style.visibility = 'hidden';
            document.body.style.overflow = '';
            hamIcon.classList.replace('fa-times', 'fa-bars');
            isOpen = false;
        }

        function toggleMobileNav() {
            isOpen ? closeMobileNav() : openMobileNav();
        }
    </script>
</body>
</html>
