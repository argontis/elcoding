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

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse modern-table">
            <thead>
                <tr>
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4 w-40">Logo Perusahaan</th>
                    <th class="px-6 py-4">Nama Mitra</th>
                    <th class="px-6 py-4 w-48">Ditambahkan Pada</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mitras as $index => $mitra)
                <tr>
                    <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $mitras->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="w-20 h-12 bg-white rounded-lg flex items-center justify-center p-2 border border-slate-200 shadow-sm">
                            <img src="{{ asset($mitra->logo_path) }}" class="max-h-full max-w-full object-contain" alt="{{ $mitra->name }}">
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $mitra->name }}</td>
                    <td class="px-6 py-4 text-sm text-slate-500">{{ $mitra->created_at ? $mitra->created_at->format('d M Y') : '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ url('admin/mitra/'.$mitra->id.'/edit') }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ url('admin/mitra/'.$mitra->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mitra ini?');" class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-colors" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data mitra.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-5 border-t border-slate-100">
        {{ $mitras->links() }}
    </div>
</div>
@endsection
