@extends('admin.layout')

@section('title', 'Kelola Artikel - Admin Elcoding')
@section('header', 'Blog & Artikel')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Artikel</h3>
            <p class="text-sm text-slate-500 mt-1">Tulis dan kelola artikel blog untuk kebutuhan SEO dan Edukasi.</p>
        </div>
        <a href="{{ url('admin/artikel/create') }}" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
            <i class="fas fa-pen-nib"></i> Tulis Artikel Baru
        </a>
    </div>
    
    <form method="GET" action="{{ url('admin/artikel') }}" class="p-4 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50 border-b border-slate-100">
        <div class="relative w-full sm:w-72">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50" onchange="this.form.submit()">
        </div>
        <div class="flex items-center gap-4 text-sm text-slate-500 font-medium">
            <div>
                Status: <select name="status" class="bg-transparent font-bold text-slate-700 outline-none cursor-pointer ml-1" onchange="this.form.submit()">
                    <option value="Semua" {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua</option>
                    <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>Published</option>
                    <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse modern-table">
            <thead>
                <tr>
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4 w-32">Thumbnail</th>
                    <th class="px-6 py-4">Judul Artikel</th>
                    <th class="px-6 py-4 w-40">Tanggal</th>
                    <th class="px-6 py-4 w-32">Status</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($artikels as $index => $artikel)
                <tr>
                    <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $artikels->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="w-20 h-14 bg-slate-200 rounded-lg overflow-hidden shadow-sm border border-slate-100 flex items-center justify-center">
                            @if($artikel->image_path)
                                <img src="{{ asset($artikel->image_path) }}" class="w-full h-full object-cover" alt="{{ $artikel->title }}">
                            @else
                                @php 
                                    $images = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
                                    $randomImg = $images[$artikel->id % 3];
                                @endphp
                                <img src="{{ asset('assets/wp-content/uploads/2026/02/'.$randomImg) }}" class="w-full h-full object-cover" alt="{{ $artikel->title }}">
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="font-bold text-slate-800">{{ $artikel->title }}</p>
                        <p class="text-xs text-slate-400 mt-0.5">Penulis: {{ $artikel->author }} • Kategori: {{ $artikel->category }}</p>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-600">{{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->format('d M Y') : '-' }}</td>
                    <td class="px-6 py-4">
                        @if($artikel->status == 'Published')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-bold border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Published
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-xs font-bold border border-amber-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Draft
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ url('admin/artikel/'.$artikel->id.'/edit') }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ url('admin/artikel/'.$artikel->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');" class="m-0 p-0">
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
                    <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data artikel.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-5 border-t border-slate-100">
        {{ $artikels->links() }}
    </div>
</div>
@endsection
