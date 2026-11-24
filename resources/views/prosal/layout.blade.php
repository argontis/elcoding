<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — L-Prosal SaaS Properti</title>

    <!-- Compiled Assets via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#F8FAFC] text-[#0F172A] font-sans antialiased min-h-screen flex flex-col">

    <!-- Mobile Drawer Overlay Backdrop -->
    <div id="sidebarBackdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-40 hidden lg:hidden transition-opacity"></div>

    <div class="flex-1 flex min-h-screen">
        <!-- Sidebar Navigation (Desktop & Mobile Off-canvas Drawer) -->
        <aside id="appSidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white text-slate-600 flex flex-col justify-between border-r border-[#E2E8F0] transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out lg:static lg:z-auto">
            <div class="flex-1 flex flex-col min-h-0">
                <!-- Brand Header -->
                <div class="h-16 flex items-center justify-between px-5 border-b border-[#E2E8F0]">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold text-sm">
                            <i class="fa-solid fa-building"></i>
                        </div>
                        <div>
                            <span class="text-base font-extrabold text-[#0F172A] tracking-tight">L-Prosal</span>
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider">Property Suite</span>
                        </div>
                    </div>
                    <!-- Close Button Mobile -->
                    <button type="button" onclick="toggleMobileSidebar()" class="lg:hidden p-1.5 text-slate-400 hover:text-slate-700 min-h-[44px] min-w-[44px] flex items-center justify-center rounded-lg" aria-label="Tutup Menu">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto text-xs font-semibold">
                    <div class="px-3 pt-1 pb-1.5 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">OPERASIONAL</div>
                    
                    <a href="{{ route('prosal.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg min-h-[44px] transition {{ request()->routeIs('prosal.dashboard') ? 'bg-emerald-50 text-emerald-800 font-bold border-l-2 border-emerald-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i class="fa-solid fa-chart-pie w-4 text-center {{ request()->routeIs('prosal.dashboard') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                        <span>Ringkasan Dashboard</span>
                    </a>

                    <a href="{{ route('prosal.unit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg min-h-[44px] transition {{ request()->routeIs('prosal.unit') ? 'bg-emerald-50 text-emerald-800 font-bold border-l-2 border-emerald-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i class="fa-solid fa-door-open w-4 text-center {{ request()->routeIs('prosal.unit') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                        <span>Unit Properti</span>
                    </a>

                    <a href="{{ route('prosal.penyewa') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg min-h-[44px] transition {{ request()->routeIs('prosal.penyewa') ? 'bg-emerald-50 text-emerald-800 font-bold border-l-2 border-emerald-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i class="fa-solid fa-users w-4 text-center {{ request()->routeIs('prosal.penyewa') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                        <span>Penyewa & Kontrak</span>
                    </a>

                    <a href="{{ route('prosal.keuangan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg min-h-[44px] transition {{ request()->routeIs('prosal.keuangan') ? 'bg-emerald-50 text-emerald-800 font-bold border-l-2 border-emerald-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i class="fa-solid fa-file-invoice-dollar w-4 text-center {{ request()->routeIs('prosal.keuangan') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                        <span>Tagihan & Arus Kas</span>
                    </a>

                    <a href="{{ route('prosal.maintenance') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg min-h-[44px] transition {{ request()->routeIs('prosal.maintenance') ? 'bg-emerald-50 text-emerald-800 font-bold border-l-2 border-emerald-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <i class="fa-solid fa-wrench w-4 text-center {{ request()->routeIs('prosal.maintenance') ? 'text-emerald-600' : 'text-slate-400' }}"></i>
                        <span>Maintenance Unit</span>
                    </a>

                    <div class="px-3 pt-4 pb-1.5 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">INTEGRASI</div>

                    <a href="{{ route('produk.saas.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg min-h-[44px] text-slate-500 hover:bg-slate-50 hover:text-slate-800 transition">
                        <i class="fa-solid fa-grid-2 w-4 text-center"></i>
                        <span>Katalog SaaS Hub</span>
                    </a>
                </nav>
            </div>

            <!-- User Info Footer -->
            <div class="p-3.5 border-t border-[#E2E8F0] bg-slate-50/50">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-xs shrink-0">
                        {{ substr(auth()->user()?->name ?? 'Admin Demo', 0, 1) }}
                    </div>
                    <div class="overflow-hidden min-w-0 flex-1">
                        <p class="text-xs font-bold text-slate-800 truncate">{{ auth()->user()?->name ?? 'Admin Properti' }}</p>
                        <p class="text-[10px] text-slate-500 truncate">Operasional Aktif</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 bg-[#F8FAFC]">
            <!-- Mobile Header Bar -->
            <header class="lg:hidden bg-white border-b border-[#E2E8F0] px-4 py-2.5 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center gap-2.5">
                    <button type="button" onclick="toggleMobileSidebar()" class="min-h-[44px] min-w-[44px] flex items-center justify-center rounded-lg text-slate-600 hover:bg-slate-100" aria-label="Buka Menu">
                        <i class="fa-solid fa-bars text-lg"></i>
                    </button>
                    <span class="font-extrabold text-sm text-[#0F172A]">L-Prosal Property</span>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('produk.saas.index') }}" class="text-xs font-bold text-slate-500 hover:text-emerald-600 px-2 py-1 rounded">
                        Katalog
                    </a>
                </div>
            </header>

            <!-- Page Title Bar Desktop -->
            <div class="bg-white border-b border-[#E2E8F0] px-6 py-4 hidden lg:flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-lg font-extrabold text-[#0F172A] tracking-tight">@yield('page_title', 'Dashboard Overview')</h1>
                    <p class="text-xs text-slate-500 mt-0.5">@yield('page_subtitle', 'Panel operasional dan pemantauan aset properti L-Prosal')</p>
                </div>
                <div class="flex items-center gap-2.5">
                    @yield('top_actions')
                    <a href="{{ route('produk.saas.index') }}" class="min-h-[44px] px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold transition flex items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Katalog SaaS</span>
                    </a>
                </div>
            </div>

            <!-- Notification Messages -->
            @if(session('success'))
            <div class="mx-4 sm:mx-6 mt-4 p-3.5 bg-emerald-50 border border-emerald-200 rounded-lg flex items-center justify-between text-emerald-800 text-xs font-semibold">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 min-h-[32px] min-w-[32px] flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            @endif

            <!-- Content Slot -->
            <div class="p-4 sm:p-6 flex-1">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Mobile Sidebar Toggle Script -->
    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('appSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
                document.body.classList.add('overflow-hidden', 'lg:overflow-auto');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
                document.body.classList.remove('overflow-hidden', 'lg:overflow-auto');
            }
        }
    </script>
</body>
</html>
