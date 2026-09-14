<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Member Panel - Elcoding')</title>
    <link rel="icon" href="{{ asset('gambar/aset/icon.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --accent: #3b82f6;
            --bg-main: #f8fafc;
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-main); 
            color: #334155;
            -webkit-font-smoothing: antialiased;
        }
        
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

        .sidebar { background: var(--sidebar-bg); }
        .sidebar-item {
            transition: all 0.2s ease-in-out;
            position: relative;
            color: #94A3B8;
            margin: 2px 16px;
            padding: 12px 16px !important;
            border-radius: 8px !important;
            width: auto;
        }
        .sidebar-item:hover {
            color: #FFFFFF;
            background: rgba(255, 255, 255, 0.08);
        }
        .sidebar-item.active {
            color: #FFFFFF;
            background: #2563eb;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        .sidebar-item i { transition: color 0.2s ease; }
        .sidebar-item.active i, .sidebar-item:hover i { color: #fff; }

        body.sidebar-collapsed #member-sidebar { width: 80px !important; }
        body.sidebar-collapsed #main-content { margin-left: 80px !important; }
        body.sidebar-collapsed .sidebar-text,
        body.sidebar-collapsed .sidebar-header,
        body.sidebar-collapsed .sidebar-logo-text { opacity: 0; display: none; }
        body.sidebar-collapsed .sidebar-item { justify-content: center; padding: 12px !important; margin: 2px 8px; }
        body.sidebar-collapsed .sidebar-item i { font-size: 1.25rem; margin-right: 0; }
        body.sidebar-collapsed .sidebar-logo-icon { display: block !important; }

        .surface-card {
            background: #FFFFFF;
            border-radius: 20px;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.04), 0 1px 3px rgba(0,0,0,0.02);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(241, 245, 249, 0.8);
        }
        .surface-card:hover {
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08), 0 1px 3px rgba(0,0,0,0.02);
            transform: translateY(-4px);
        }

        .fade-in-up { animation: fadeInUp 0.5s ease-out forwards; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased overflow-hidden">
    
    <div class="flex h-screen overflow-hidden w-full">
        
        <!-- Sidebar -->
        <aside id="member-sidebar" class="sidebar fixed inset-y-0 left-0 w-[260px] flex flex-col h-screen shrink-0 z-[100] shadow-xl shadow-slate-900/10 border-r border-slate-800 transition-all duration-300">
            <!-- Logo Area -->
            <div class="h-[70px] flex items-center justify-between px-6 border-b border-white/5 bg-slate-900 shrink-0">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-7 object-contain opacity-90 hover:opacity-100 transition-opacity sidebar-logo-text">
                    <img src="{{ asset('gambar/aset/icon.png') }}" alt="E" class="hidden sidebar-logo-icon h-8 w-8 object-contain drop-shadow-sm">
                </a>
                <button id="sidebar-toggle-btn" class="text-slate-500 hover:text-white focus:outline-none transition-colors w-8 h-8 flex items-center justify-center rounded-md hover:bg-white/10">
                    <i id="sidebar-toggle-icon" class="fas fa-chevron-left text-sm"></i>
                </button>
            </div>

            <!-- Navigation -->
            <div class="flex-1 overflow-y-auto overflow-x-hidden">
                <nav class="py-4 space-y-1">
                    <p class="px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-3 mt-2 sidebar-header">Menu</p>
                    
                    <a href="/member/dashboard" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('member/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Dashboard</span>
                    </a>

                    <a href="/member/learning-modul" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('member/learning-modul*') ? 'active' : '' }}">
                        <i class="fas fa-book-open w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Learning Modul</span>
                    </a>

                    <a href="/member/asesmen" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('member/asesmen*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-check w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Asesmen</span>
                    </a>

                    <a href="/member/invoice" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('member/invoice*') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice-dollar w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Invoice</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Actions -->
            <div class="p-4 border-t border-white/5 shrink-0">
                <form action="{{ route('member.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="sidebar-item w-full flex items-center gap-3 font-medium text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-colors text-left">
                        <i class="fas fa-power-off w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Wrapper -->
        <div class="flex-1 flex flex-col h-screen w-full ml-[260px] transition-all duration-300" id="main-content">
            
            <!-- Topbar -->
            <header class="h-[70px] bg-white border-b border-slate-200 flex items-center justify-between px-6 shrink-0 z-[90]">
                <div>
                    <h1 class="text-lg font-bold text-slate-800">@yield('header', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-2 md:gap-4">
                    <div class="flex items-center gap-3 border-l border-slate-200 pl-4 ml-1 md:ml-2">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm shadow-sm">
                            {{ substr(auth('member')->user()->nama ?? 'M', 0, 1) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-bold text-slate-700 leading-none mb-1">{{ auth('member')->user()->nama ?? 'Member' }}</p>
                            <p class="text-[11px] font-semibold text-emerald-600 uppercase tracking-wider leading-none">Member</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto overflow-x-hidden p-6 md:p-8 bg-[#f4f7fa]">
                <div class="max-w-[1600px] mx-auto fade-in-up pb-12">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleBtn = document.getElementById('sidebar-toggle-btn');
            const toggleIcon = document.getElementById('sidebar-toggle-icon');
            const body = document.body;

            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    body.classList.toggle('sidebar-collapsed');
                    if (body.classList.contains('sidebar-collapsed')) {
                        toggleIcon.classList.remove('fa-chevron-left');
                        toggleIcon.classList.add('fa-chevron-right');
                    } else {
                        toggleIcon.classList.remove('fa-chevron-right');
                        toggleIcon.classList.add('fa-chevron-left');
                    }
                });
            }
        });
    </script>
</body>
</html>
