@extends('admin.layout')

@section('title', 'Promo & Benefit Seminar - Admin Elcoding')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Promo &amp; Benefit Seminar</h1>
            <p class="text-slate-500 text-sm mt-1">Buat penawaran promo, diskon, atau benefit khusus yang tampil di dashboard peserta seminar.</p>
        </div>
        <a href="{{ route('admin.seminar.promos.create') }}" class="btn-primary px-5 py-2.5 rounded-xl font-bold text-xs inline-flex items-center gap-2 self-start md:self-auto">
            <i class="fas fa-plus"></i> Buat Promo &amp; Benefit
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-200 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table w-full text-left text-xs">
                <thead>
                    <tr>
                        <th class="py-3.5 px-6">Promo / Benefit</th>
                        <th class="py-3.5 px-6">Target Sasaran</th>
                        <th class="py-3.5 px-6">Kode &amp; Masa Berlaku</th>
                        <th class="py-3.5 px-6 text-center">Tertarik</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($promos as $promo)
                        <tr>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold uppercase text-[10px]">
                                        {{ $promo->badge_text ?: $promo->type }}
                                    </span>
                                    <span class="font-bold text-slate-800 text-sm">{{ $promo->title }}</span>
                                </div>
                                <p class="text-slate-500 text-[11px] line-clamp-2 max-w-md">{{ $promo->description }}</p>
                            </td>
                            <td class="py-4 px-6">
                                @if($promo->category)
                                    <span class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 font-semibold text-[11px]">
                                        Kategori: {{ $promo->category->name }}
                                    </span>
                                @elseif($promo->is_global)
                                    <span class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 font-semibold text-[11px]">
                                        Semua Peserta Seminar
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 font-semibold text-[11px]">
                                        Peserta Tertentu ({{ $promo->assigned_count }})
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($promo->promo_code)
                                    <span class="font-mono font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded">{{ $promo->promo_code }}</span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                                <div class="text-[11px] text-slate-500 mt-1">
                                    {{ $promo->valid_until ? 's/d ' . $promo->valid_until->format('d M Y') : 'Tanpa batas waktu' }}
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 rounded-full bg-pink-50 text-pink-700 font-bold">
                                    <i class="fas fa-heart mr-1"></i>{{ $promo->interested_count }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('admin.seminar.promos.toggle', $promo->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-3 py-1 rounded-full text-[11px] font-bold transition {{ $promo->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-slate-200 text-slate-600 hover:bg-slate-300' }}">
                                        {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.seminar.promos.edit', $promo->id) }}" class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-lg transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.seminar.promos.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Hapus promo ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-500">
                                Belum ada promo &amp; benefit seminar. <a href="{{ route('admin.seminar.promos.create') }}" class="text-blue-600 underline font-bold">Buat sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $promos->links() }}
        </div>
    </div>
</div>
@endsection
