<aside class="sidebar w-72 flex flex-col h-full shrink-0 z-20 shadow-xl shadow-slate-900/10 border-r border-slate-800">
    <!-- Logo Area -->
    <div class="h-24 flex flex-col justify-center px-8 border-b border-white/5 bg-slate-900/50">
        <div class="flex items-center gap-3">
            <img src="{{ asset('gambar/aset/logo-elcoding.svg') }}" alt="Elcoding" class="h-8 object-contain brightness-0 invert opacity-90 hover:opacity-100 transition-opacity">
            <span class="text-[10px] font-extrabold text-white bg-blue-600/80 px-2 py-1 rounded-md uppercase tracking-widest border border-blue-500/50 shadow-lg shadow-blue-500/20">ADMIN</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 space-y-1">
        <p class="px-8 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-2">Menu Utama</p>
        
        <a href="/admin" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin') ? 'active' : '' }}">
            <i class="fas fa-chart-pie w-6 text-center text-lg"></i> <span>Dashboard</span>
        </a>
        
        <p class="px-8 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-8">Manajemen Konten</p>
        
        <a href="/admin/mitra" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin/mitra*') ? 'active' : '' }}">
            <i class="fas fa-handshake w-6 text-center text-lg"></i> <span>Klien & Mitra</span>
        </a>
        
        <a href="/admin/program-kursus" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin/program-kursus*') ? 'active' : '' }}">
            <i class="fas fa-graduation-cap w-6 text-center text-lg"></i> <span>Program Kursus</span>
        </a>

        <a href="/admin/kategori-portofolio" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin/kategori-portofolio*') ? 'active' : '' }}">
            <i class="fas fa-tags w-6 text-center text-lg"></i> <span>Kategori Portofolio</span>
        </a>
        
        <a href="/admin/portofolio" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin/portofolio*') ? 'active' : '' }}">
            <i class="fas fa-briefcase w-6 text-center text-lg"></i> <span>Portofolio</span>
        </a>
        
        <a href="/admin/artikel" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin/artikel*') ? 'active' : '' }}">
            <i class="fas fa-newspaper w-6 text-center text-lg"></i> <span>Blog & Artikel</span>
        </a>
        
        <p class="px-8 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-8">Sistem</p>

        <a href="/admin/settings" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <i class="fas fa-cog w-6 text-center text-lg"></i> <span>Pengaturan Situs</span>
        </a>
        
        <p class="px-8 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-4 mt-8">Operasional</p>

        <a href="/admin/mou" class="sidebar-item flex items-center gap-4 font-medium {{ request()->is('admin/mou*') ? 'active' : '' }}">
            <i class="fas fa-file-signature w-6 text-center text-lg"></i> <span>MoU & Penawaran</span>
        </a>
    </nav>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-white/5 space-y-2">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="sidebar-item w-full flex items-center gap-4 font-medium text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-colors text-left">
                <i class="fas fa-sign-out-alt w-6 text-center text-lg"></i> <span>Keluar</span>
            </button>
        </form>
    </div>
</aside>
