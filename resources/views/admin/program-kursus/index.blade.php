@extends('admin.layout')

@section('title', 'Kelola Program Kursus - Admin Elcoding')
@section('header', 'Program Kursus')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Program Kursus</h3>
            <p class="text-sm text-slate-500 mt-1">Kelola kelas, harga, dan ketersediaan program.</p>
        </div>
        <a href="{{ url('admin/program-kursus/create') }}" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i> Tambah Program
        </a>
    </div>
    
    <form method="GET" action="{{ url('admin/program-kursus') }}" class="p-4 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50 border-b border-slate-100">
        <div class="relative w-full sm:w-72">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari program..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50" onchange="this.form.submit()">
        </div>
        <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
            <i class="fas fa-filter"></i> Urutkan: 
            <select name="sort" class="bg-transparent font-bold text-slate-700 outline-none cursor-pointer" onchange="this.form.submit()">
                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>A-Z (Judul)</option>
                <option value="label" {{ request('sort') == 'label' ? 'selected' : '' }}>Berdasarkan Label</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
            </select>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse modern-table">
            <thead>
                <tr>
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4 w-32">Thumbnail</th>
                    <th class="px-6 py-4">Nama Program</th>
                    <th class="px-6 py-4 w-32">Durasi</th>
                    <th class="px-6 py-4 w-40">Harga</th>
                    <th class="px-6 py-4 w-32 text-center">Label</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($programs as $index => $program)
                <tr>
                    <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $programs->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="w-20 h-14 bg-slate-200 rounded-lg overflow-hidden shadow-sm border border-slate-100 flex items-center justify-center">
                            @if($program->image_path)
                                <img src="{{ asset(str_replace(' ', '%20', $program->image_path)) }}" class="w-full h-full object-cover" alt="{{ $program->title }}">
                            @else
                                <i class="fas fa-graduation-cap text-slate-400"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $program->title }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-600">{{ $program->duration }}</td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $program->price }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($program->badge == 'Recommended')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-bold border border-amber-200">
                            <i class="fas fa-star text-[10px]"></i> Recommended
                        </span>
                        @elseif($program->badge == 'Terlaris')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold border border-red-200">
                            <i class="fas fa-fire text-[10px]"></i> Terlaris
                        </span>
                        @else
                        <span class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-500 rounded-full text-xs font-bold">
                            {{ $program->badge ?? 'Reguler' }}
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ url('admin/program-kursus/'.$program->id.'/edit') }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ url('admin/program-kursus/'.$program->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus program ini?');" class="m-0 p-0">
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
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">Belum ada data program kursus.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-5 border-t border-slate-100">
        {{ $programs->links() }}
    </div>
</div>
@endsection
