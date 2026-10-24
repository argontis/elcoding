<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal PKL & Magang - elc.my.id')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb { background: #475569; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        /* Mobile menu overlay */
        #mobile-nav-overlay {
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }
        #mobile-nav-panel {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #mobile-nav-panel.open {
            transform: translateX(0);
        }

        /* Active tab indicator animation */
        .nav-tab-active {
            position: relative;
        }
        .nav-tab-active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 3px;
            background: #60a5fa;
            border-radius: 2px;
        }

        /* Bottom nav safe area for iOS */
        .bottom-nav-bar {
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }

        /* Smooth page transitions */
        main {
            animation: fadeInUp 0.3s ease forwards;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans">

    <!-- ============================================================ -->
    <!-- TOP NAVIGATION BAR                                           -->
    <!-- ============================================================ -->
    <header class="bg-slate-800/95 border-b border-slate-700/80 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 sm:h-16 flex items-center justify-between gap-3">

            <!-- Logo & Badge -->
            <div class="flex items-center gap-3 min-w-0">
                <a href="{{ route('pkl.dashboard') }}" class="flex items-center gap-2 shrink-0">
                    <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-7 sm:h-8">
                    <span class="hidden xs:inline-flex bg-blue-600/20 text-blue-400 text-xs font-bold px-2.5 py-1 rounded-full border border-blue-500/30 whitespace-nowrap">
                        Portal Magang
                    </span>
                </a>
            </div>

            <!-- Desktop: Profile Info + Logout -->
            <div class="hidden md:flex items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold flex items-center justify-center shadow-md text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-bold leading-none text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 leading-tight mt-0.5 truncate max-w-[160px]">{{ auth()->user()->email }}</p>
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
                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold flex items-center justify-center shadow-md text-xs shrink-0">
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

    <!-- ============================================================ -->
    <!-- DESKTOP: Horizontal Navigation Tabs                          -->
    <!-- ============================================================ -->
    <div class="hidden md:block bg-slate-800/50 border-b border-slate-700/50 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-1 py-2 overflow-x-auto scrollbar-hide">

            <a href="{{ route('pkl.dashboard') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-chart-pie"></i> Overview
            </a>

            <a href="{{ route('pkl.modules') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.modules') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-book-open"></i> Modul & Silabus
            </a>

            <a href="{{ route('pkl.tasks') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.tasks') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-tasks"></i> Tugas Saya
            </a>

            <a href="{{ route('pkl.progress') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.progress') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-chart-line"></i> Progress & Quiz
            </a>

            <a href="{{ route('pkl.invoices') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.invoices') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-file-invoice-dollar"></i> Tagihan & Bayar
            </a>

            <a href="{{ route('pkl.portfolio') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.portfolio') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-laptop-code"></i> Portofolio
            </a>

            <a href="{{ route('pkl.certificate') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.certificate') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-certificate"></i> Sertifikat
            </a>

            <a href="{{ route('pkl.history') }}"
               class="px-4 py-2 text-xs font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.history') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-history"></i> Histori Program
            </a>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- MOBILE: Slide-in Navigation Drawer                           -->
    <!-- ============================================================ -->

    <!-- Overlay -->
    <div id="mobile-nav-overlay"
         onclick="closeMobileNav()"
         class="md:hidden fixed inset-0 z-40 bg-slate-950/70 backdrop-blur-sm opacity-0 invisible">
    </div>

    <!-- Drawer Panel -->
    <div id="mobile-nav-panel"
         class="md:hidden fixed top-0 right-0 h-full w-72 z-50 bg-slate-800 border-l border-slate-700 shadow-2xl -translate-x-full"
         style="transform: translateX(100%);">

        <!-- Panel Header -->
        <div class="flex items-center justify-between p-5 border-b border-slate-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold flex items-center justify-center shadow-md">
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

        <!-- Navigation Links -->
        <nav class="p-4 space-y-1 overflow-y-auto flex-1" style="max-height: calc(100vh - 180px);">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-3 mb-2">Menu Utama</p>

            <a href="{{ route('pkl.dashboard') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.dashboard') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-chart-pie text-xs"></i>
                </div>
                Overview Dashboard
            </a>

            <a href="{{ route('pkl.modules') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.modules') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.modules') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-book-open text-xs"></i>
                </div>
                Modul & Silabus
            </a>

            <a href="{{ route('pkl.tasks') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.tasks') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.tasks') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-tasks text-xs"></i>
                </div>
                Tugas Saya
            </a>

            <a href="{{ route('pkl.progress') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.progress') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.progress') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-chart-line text-xs"></i>
                </div>
                Progress & Quiz
            </a>

            <a href="{{ route('pkl.invoices') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.invoices') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.invoices') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-file-invoice-dollar text-xs"></i>
                </div>
                Tagihan & Bayar
            </a>

            <a href="{{ route('pkl.portfolio') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.portfolio') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.portfolio') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-laptop-code text-xs"></i>
                </div>
                Portofolio Project
            </a>

            <a href="{{ route('pkl.certificate') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.certificate') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.certificate') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-certificate text-xs"></i>
                </div>
                Sertifikat
            </a>

            <a href="{{ route('pkl.history') }}" onclick="closeMobileNav()"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition {{ request()->routeIs('pkl.history') ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                <div class="w-8 h-8 rounded-xl flex items-center justify-center {{ request()->routeIs('pkl.history') ? 'bg-white/20' : 'bg-slate-700' }}">
                    <i class="fas fa-history text-xs"></i>
                </div>
                Histori Program
            </a>
        </nav>

        <!-- Logout at bottom of drawer -->
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-700 bg-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-3 px-4 py-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 font-bold text-sm rounded-2xl border border-red-500/20 transition">
                    <i class="fas fa-power-off"></i>
                    Keluar / Logout
                </button>
            </form>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- MOBILE: Bottom Navigation Bar (Quick Access)                 -->
    <!-- ============================================================ -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-30 bg-slate-800/95 backdrop-blur-md border-t border-slate-700/80 bottom-nav-bar">
        <div class="flex items-center justify-around px-2 py-2">

            <a href="{{ route('pkl.dashboard') }}"
               class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition {{ request()->routeIs('pkl.dashboard') ? 'text-blue-400' : 'text-slate-500' }}">
                <i class="fas fa-chart-pie text-base"></i>
                <span class="text-[10px] font-semibold">Home</span>
            </a>

            <a href="{{ route('pkl.modules') }}"
               class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition {{ request()->routeIs('pkl.modules') ? 'text-blue-400' : 'text-slate-500' }}">
                <i class="fas fa-book-open text-base"></i>
                <span class="text-[10px] font-semibold">Modul</span>
            </a>

            <a href="{{ route('pkl.tasks') }}"
               class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition {{ request()->routeIs('pkl.tasks') ? 'text-blue-400' : 'text-slate-500' }}">
                <i class="fas fa-tasks text-base"></i>
                <span class="text-[10px] font-semibold">Tugas</span>
            </a>

            <a href="{{ route('pkl.progress') }}"
               class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition {{ request()->routeIs('pkl.progress') ? 'text-blue-400' : 'text-slate-500' }}">
                <i class="fas fa-chart-line text-base"></i>
                <span class="text-[10px] font-semibold">Progress</span>
            </a>

            <!-- More button that opens drawer -->
            <button onclick="toggleMobileNav()"
                    class="flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl transition text-slate-500 hover:text-slate-300">
                <i class="fas fa-ellipsis-h text-base"></i>
                <span class="text-[10px] font-semibold">Lainnya</span>
            </button>
        </div>
    </nav>

    <!-- ============================================================ -->
    <!-- MAIN CONTENT AREA                                            -->
    <!-- ============================================================ -->
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

    <!-- ============================================================ -->
    <!-- FOOTER (hidden on mobile to save space, shown on md+)        -->
    <!-- ============================================================ -->
    <footer class="hidden md:block bg-slate-800/40 border-t border-slate-700/40 py-5 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} elc.my.id — Platform Pelatihan & Management Magang IT. All rights reserved.</p>
    </footer>

    <script>
        // ============================================================
        // Mobile Navigation Drawer
        // ============================================================
        const panel   = document.getElementById('mobile-nav-panel');
        const overlay = document.getElementById('mobile-nav-overlay');
        const hamIcon = document.getElementById('hamburger-icon');
        let isOpen    = false;

        function openMobileNav() {
            panel.style.transform   = 'translateX(0)';
            overlay.style.opacity   = '1';
            overlay.style.visibility = 'visible';
            document.body.style.overflow = 'hidden';
            hamIcon.classList.replace('fa-bars', 'fa-times');
            isOpen = true;
        }

        function closeMobileNav() {
            panel.style.transform   = 'translateX(100%)';
            overlay.style.opacity   = '0';
            overlay.style.visibility = 'hidden';
            document.body.style.overflow = '';
            hamIcon.classList.replace('fa-times', 'fa-bars');
            isOpen = false;
        }

        function toggleMobileNav() {
            isOpen ? closeMobileNav() : openMobileNav();
        }

        // Close on ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) closeMobileNav();
        });

        // Swipe-to-close support
        let touchStartX = null;
        panel.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
        panel.addEventListener('touchmove', e => {
            if (touchStartX === null) return;
            const diff = e.touches[0].clientX - touchStartX;
            if (diff > 50) closeMobileNav();
        }, { passive: true });
    </script>

</body>
</html>
