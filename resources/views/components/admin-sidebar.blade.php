<aside id="app-sidebar" class="sidebar fixed inset-y-0 left-0 w-[260px] flex flex-col h-screen shrink-0 z-[100] shadow-xl shadow-slate-900/10 border-r border-slate-800 transition-all duration-300">
    <!-- Logo Area -->
    <div class="h-[70px] flex items-center justify-between px-6 border-b border-white/5 bg-slate-900 shrink-0">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img src="{{ asset('gambar/aset/logo.png') }}" alt="Elcoding" class="h-7 object-contain opacity-90 hover:opacity-100 transition-opacity sidebar-logo-text">
            <!-- Mini Logo (Hidden by default, shown when collapsed) -->
            <div class="hidden sidebar-logo-icon text-white font-black text-2xl tracking-tighter w-8 h-8 flex items-center justify-center bg-blue-600 rounded-lg shadow-lg">E</div>
        </a>
        <button id="sidebar-toggle-btn" class="text-slate-500 hover:text-white focus:outline-none transition-colors w-8 h-8 flex items-center justify-center rounded-md hover:bg-white/10">
            <i id="sidebar-toggle-icon" class="fas fa-chevron-left text-sm"></i>
        </button>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto overflow-x-hidden sidebar-scroll">
        <nav class="py-4 space-y-1">
            <p class="px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-3 mt-2 sidebar-header">Menu Utama</p>
            
            <a href="/dashboard" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Dashboard</span>
            </a>
            
            <p class="px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-3 mt-6 sidebar-header">Manajemen Konten</p>
            
            <a href="/admin/layanan" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/layanan*') ? 'active' : '' }}">
                <i class="fas fa-server w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Layanan Utama</span>
            </a>

            <a href="/admin/mitra" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/mitra*') ? 'active' : '' }}">
                <i class="fas fa-handshake w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Klien & Mitra</span>
            </a>
            
            <a href="/admin/program-kursus" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/program-kursus*') ? 'active' : '' }}">
                <i class="fas fa-graduation-cap w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Program Kursus</span>
            </a>

            <a href="/admin/event" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/event*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Event & Webinar</span>
            </a>

            <a href="/admin/kategori-portofolio" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/kategori-portofolio*') ? 'active' : '' }}">
                <i class="fas fa-tags w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Kategori Portofolio</span>
            </a>
            
            <a href="/admin/portofolio" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/portofolio*') ? 'active' : '' }}">
                <i class="fas fa-briefcase w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Portofolio</span>
            </a>
            
            <a href="/admin/artikel" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/artikel*') ? 'active' : '' }}">
                <i class="fas fa-newspaper w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Blog</span>
            </a>
            
            <p class="px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-3 mt-6 sidebar-header">Sistem</p>

            <a href="/admin/settings" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/settings*') ? 'active' : '' }}">
                <i class="fas fa-cog w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Pengaturan Situs</span>
            </a>
            
            <p class="px-6 text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-3 mt-6 sidebar-header">Operasional</p>

            @php
                $pendingOrdersCount = \App\Models\Order::where('status', 'pending')->count();
            @endphp
            <a href="/admin/orders" class="sidebar-item flex items-center justify-between font-medium {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <div class="flex items-center gap-3">
                    <i class="fas fa-shopping-cart w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Transaksi & Bayar</span>
                </div>
                @if($pendingOrdersCount > 0)
                    <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm sidebar-text">{{ $pendingOrdersCount }}</span>
                @endif
            </a>

            <a href="/admin/mou" class="sidebar-item flex items-center gap-3 font-medium {{ request()->is('admin/mou*') ? 'active' : '' }}">
                <i class="fas fa-file-signature w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">MoU & Penawaran</span>
            </a>
        </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="p-4 border-t border-white/5 shrink-0">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="sidebar-item w-full flex items-center gap-3 font-medium text-slate-400 hover:text-red-400 hover:bg-red-500/10 transition-colors text-left">
                <i class="fas fa-power-off w-6 text-center text-[15px]"></i> <span class="text-[14px] sidebar-text">Logout</span>
            </button>
        </form>
    </div>
</aside>
