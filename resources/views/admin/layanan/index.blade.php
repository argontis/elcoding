@extends('admin.layout')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-slate-900">Layanan Utama</h1>
        <p class="text-slate-500 mt-2">Kelola kartu layanan dan halaman detail layanannya.</p>
    </div>
    <a href="/admin/layanan/create" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/30 flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Layanan
    </a>
</div>

@if(session('success'))
    <div class="bg-emerald-50 text-emerald-600 border border-emerald-200 p-4 rounded-xl mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle text-xl"></i>
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="p-4 font-semibold text-slate-600">Layanan</th>
                    <th class="p-4 font-semibold text-slate-600">Harga</th>
                    <th class="p-4 font-semibold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($layanans as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="p-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                                <i class="{{ $item->icon }}"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800">{{ $item->title }}</h3>
                                <p class="text-sm text-slate-500 truncate max-w-xs">{{ $item->short_description }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-slate-700 font-medium">
                        {{ $item->price }} <span class="text-slate-400 font-normal text-sm">{{ $item->price_period }}</span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="/layanan/detail/{{ $item->slug }}" target="_blank" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center hover:bg-slate-200 transition-colors" title="Lihat Halaman">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <a href="/admin/layanan/{{ $item->id }}/edit" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/admin/layanan/{{ $item->id }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-100 transition-colors" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-8 text-center text-slate-500">
                        Belum ada data layanan. Silakan tambahkan layanan baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($layanans->hasPages())
    <div class="p-4 border-t border-slate-200">
        {{ $layanans->links() }}
    </div>
    @endif
</div>
@endsection
