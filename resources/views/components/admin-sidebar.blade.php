<aside class="sidebar w-72 flex flex-col h-full shrink-0 z-20 shadow-[4px_0_24px_rgba(0,0,0,0.05)]">
    <!-- Logo Area -->
    <div class="h-20 flex items-center px-6 border-b border-white/5">
        <div class="bg-white rounded-xl px-3 py-2.5 w-full flex items-center justify-center shadow-lg">
            <img src="{{ asset('gambar/aset/logo-elcoding.svg') }}" alt="Elcoding" class="h-6 object-contain">
            <span class="text-[9px] font-bold text-blue-600 uppercase tracking-wider ml-2 bg-blue-50 px-1.5 py-0.5 rounded border border-blue-100">ADMIN</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
        <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-2">Menu Utama</p>
        
        <a href="/admin" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin') ? 'active' : '' }}">
            <i class="fas fa-chart-pie w-5 text-center text-lg"></i> Dashboard
        </a>
        
        <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-8">Manajemen Konten</p>
        
        <a href="/admin/mitra" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/mitra*') ? 'active' : '' }}">
            <i class="fas fa-handshake w-5 text-center text-lg"></i> Klien & Mitra
        </a>
        
        <a href="/admin/program-kursus" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/program-kursus*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap w-5 text-center text-lg"></i> Program Kursus
        </a>
        
        <a href="/admin/portofolio" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/portofolio*') ? 'active' : '' }}">
            <i class="fas fa-briefcase w-5 text-center text-lg"></i> Portofolio Project
        </a>
        
        <a href="/admin/artikel" class="sidebar-item flex items-center gap-4 px-4 py-3 rounded-xl font-medium {{ request()->is('admin/artikel*') ? 'active' : '' }}">
            <i class="fas fa-newspaper w-5 text-center text-lg"></i> Blog & Artikel
        </a>
    </nav>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-white/5 space-y-2">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 rounded-xl font-medium text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-colors text-left">
                <i class="fas fa-sign-out-alt w-5 text-center text-lg"></i> Keluar
            </button>
        </form>
    </div>
</aside>
