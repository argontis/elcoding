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
    </style>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans">
    
    <!-- Top Navigation Bar -->
    <header class="bg-slate-800/90 border-b border-slate-700/80 sticky top-0 z-50 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            <div class="flex items-center gap-3">
                <a href="{{ route('pkl.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-8">
                    <span class="bg-blue-600/20 text-blue-400 text-xs font-bold px-2.5 py-1 rounded-full border border-blue-500/30">
                        Portal Magang
                    </span>
                </a>
            </div>

            <!-- Profile & Actions -->
            <div class="flex items-center gap-4">
                <a href="{{ url('/') }}" class="text-xs font-semibold text-slate-300 hover:text-white bg-slate-700/60 hover:bg-slate-700 px-3 py-1.5 rounded-xl border border-slate-600/50 transition flex items-center gap-1.5" title="Kembali ke Website Utama">
                    <i class="fas fa-globe text-blue-400"></i>
                    <span class="hidden sm:inline">Website Utama</span>
                </a>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold flex items-center justify-center shadow-md">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-bold leading-none text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 leading-tight mt-0.5">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-400 hover:bg-slate-700/50 rounded-xl transition" title="Logout">
                        <i class="fas fa-power-off text-base"></i>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Navigation Tabs -->
    <div class="bg-slate-800/50 border-b border-slate-700/50 overflow-x-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex space-x-1 sm:space-x-4 py-2">
            
            <a href="{{ route('pkl.dashboard') }}" 
               class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-chart-pie"></i> Overview
            </a>

            <a href="{{ route('pkl.tasks') }}" 
               class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.tasks') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-tasks"></i> Tugas Saya
            </a>

            <a href="{{ route('pkl.progress') }}" 
               class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.progress') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-chart-line"></i> Progress & Quiz
            </a>

            <a href="{{ route('pkl.invoices') }}" 
               class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.invoices') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-file-invoice-dollar"></i> Tagihan & Bayar
            </a>

            <a href="{{ route('pkl.portfolio') }}" 
               class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.portfolio') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-laptop-code"></i> Portofolio Project
            </a>

            <a href="{{ route('pkl.certificate') }}" 
               class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.certificate') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-certificate"></i> Sertifikat
            </a>

            <a href="{{ route('pkl.history') }}" 
               class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-xl flex items-center gap-2 transition whitespace-nowrap {{ request()->routeIs('pkl.history') ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'text-slate-400 hover:text-white hover:bg-slate-700/40' }}">
                <i class="fas fa-history"></i> Histori Program
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 p-4 rounded-2xl mb-6 flex items-center justify-between text-sm shadow-lg">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-800/40 border-t border-slate-700/40 py-6 text-center text-xs text-slate-500 mt-auto">
        <p>&copy; {{ date('Y') }} elc.my.id — Platform Pelatihan & Management Magang IT. All rights reserved.</p>
    </footer>

</body>
</html>
