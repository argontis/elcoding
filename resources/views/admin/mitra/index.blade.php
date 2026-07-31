@extends('admin.layout')

@section('title', 'Kelola Mitra - Admin Elcoding')
@section('header', 'Klien & Mitra')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Klien & Mitra</h3>
            <p class="text-sm text-slate-500 mt-1">Kelola logo perusahaan yang telah bekerjasama dengan Elcoding.</p>
        </div>
        <a href="{{ url('admin/mitra/create') }}" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i> Tambah Mitra
        </a>
    </div>
    
    <form method="GET" action="{{ url('admin/mitra') }}" class="p-4 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50 border-b border-slate-100">
        <div class="relative w-full sm:w-72">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama mitra..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50" onchange="this.form.submit()">
        </div>
        <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
            <i class="fas fa-filter"></i> Urutkan: <select class="bg-transparent font-bold text-slate-700 outline-none cursor-pointer"><option>Terbaru</option><option>A-Z</option></select>
        </div>
    </form>

    <div class="p-8 bg-[#F5F3FF] rounded-2xl mx-4 mb-4">
        <h2 class="text-3xl font-extrabold text-slate-800 text-center mb-10">Mitra</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6 max-w-[1200px] mx-auto">
            @forelse($mitras as $mitra)
            <div class="relative group bg-white p-2 rounded-xl shadow-sm border border-slate-100 flex items-center justify-center aspect-[4/3] overflow-hidden">
                <img src="{{ asset($mitra->logo_path) }}" alt="{{ $mitra->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                
                <!-- Action Buttons Overlay -->
                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl flex items-center justify-center gap-3 backdrop-blur-[2px]">
                    <a href="{{ url('admin/mitra/'.$mitra->id.'/edit') }}" class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-blue-600 hover:scale-110 transition-transform shadow-lg" title="Edit">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form action="{{ url('admin/mitra/'.$mitra->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mitra ini?');" class="m-0 p-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-red-500 hover:scale-110 transition-transform shadow-lg" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-500">Belum ada data mitra.</div>
            @endforelse
        </div>
    </div>
    
    <div class="p-5 border-t border-slate-100">
        {{ $mitras->links() }}
    </div>
</div>
@endsection
