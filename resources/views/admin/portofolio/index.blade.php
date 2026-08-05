@extends('admin.layout')

@section('title', 'Kelola Portofolio - Admin Elcoding')
@section('header', 'Portofolio Project')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Portofolio Project</h3>
            <p class="text-sm text-slate-500 mt-1">Showcase karya terbaik dari agensi Elcoding.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ url('admin/kategori-portofolio') }}" class="px-4 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors flex items-center gap-2">
                <i class="fas fa-tags"></i> Kategori
            </a>
            <a href="{{ url('admin/portofolio/create') }}" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Project
            </a>
        </div>
    </div>
    
    <form method="GET" action="{{ url('admin/portofolio') }}" class="p-4 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50 border-b border-slate-100">
        <div class="relative w-full sm:w-72">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari portofolio..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50" onchange="this.form.submit()">
        </div>
        <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
            <i class="fas fa-filter"></i> Urutkan: <select class="bg-transparent font-bold text-slate-700 outline-none cursor-pointer"><option>Terbaru</option><option>Kategori</option></select>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse modern-table">
            <thead>
                <tr>
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4 w-32">Thumbnail</th>
                    <th class="px-6 py-4">Judul Portofolio</th>
                    <th class="px-6 py-4 w-48">Kategori</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                    <th class="px-6 py-4 text-center w-32">Detail</th>
                </tr>
            </thead>
            <tbody>
                @forelse($portofolios as $index => $portofolio)
                <tr>
                    <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $portofolios->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="w-20 h-14 bg-slate-200 rounded-lg overflow-hidden shadow-sm border border-slate-100 flex items-center justify-center">
                            @if($portofolio->image_path)
                                <img src="{{ asset(str_replace(' ', '%20', $portofolio->image_path)) }}" class="w-full h-full object-cover" alt="{{ $portofolio->title }}">
                            @else
                                <i class="fas fa-image text-slate-400"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $portofolio->title }}</td>
                    <td class="px-6 py-4">
                        @php
                            $cat = \App\Models\KategoriPortofolio::where('name', $portofolio->category)->first();
                            $color = $cat ? $cat->color : 'slate';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 bg-{{ $color }}-50 text-{{ $color }}-600 rounded text-xs font-bold border border-{{ $color }}-100">
                            {{ $portofolio->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ url('admin/portofolio/'.$portofolio->id.'/edit') }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ url('admin/portofolio/'.$portofolio->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus portofolio ini?');" class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-colors" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ url('portofolio/' . $portofolio->id) }}" class="text-blue-600 hover:underline" target="_blank">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data portofolio.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-5 border-t border-slate-100">
        {{ $portofolios->links() }}
    </div>
</div>
@endsection
