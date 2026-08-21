@extends('admin.layout')

@section('title', 'Kelola Event & Webinar - Admin Elcoding')
@section('header', 'Event & Webinar')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Event & Webinar</h3>
            <p class="text-sm text-slate-500 mt-1">Kelola Bootcamp, Webinar, dan Workshop.</p>
        </div>
        <a href="{{ url('admin/event/create') }}" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i> Tambah Event
        </a>
    </div>
    
    <form method="GET" action="{{ url('admin/event') }}" class="p-4 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/50 border-b border-slate-100">
        <div class="relative w-full sm:w-72">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50" onchange="this.form.submit()">
        </div>
        <div class="flex items-center gap-2 text-sm text-slate-500 font-medium">
            <i class="fas fa-filter"></i> Filter Tipe: 
            <select name="type" class="bg-transparent font-bold text-slate-700 outline-none cursor-pointer" onchange="this.form.submit()">
                <option value="">Semua Tipe</option>
                <option value="bootcamp" {{ request('type') == 'bootcamp' ? 'selected' : '' }}>Bootcamp Intensif</option>
                <option value="webinar" {{ request('type') == 'webinar' ? 'selected' : '' }}>Webinar Tech</option>
                <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop Online</option>
            </select>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse modern-table">
            <thead>
                <tr>
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4 w-32">Banner</th>
                    <th class="px-6 py-4">Judul Event</th>
                    <th class="px-6 py-4 w-32">Tipe</th>
                    <th class="px-6 py-4 w-40">Harga</th>
                    <th class="px-6 py-4 w-32 text-center">Jadwal/Durasi</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $index => $event)
                <tr>
                    <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $events->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <div class="w-20 h-14 bg-slate-200 rounded-lg overflow-hidden shadow-sm border border-slate-100 flex items-center justify-center">
                            @if($event->image_path)
                                <img src="{{ asset(str_replace(' ', '%20', $event->image_path)) }}" class="w-full h-full object-cover" alt="{{ $event->title }}">
                            @else
                                <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" class="w-full h-full object-cover" alt="{{ $event->title }}">
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $event->title }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-600 capitalize">
                        @if($event->type == 'bootcamp')
                            <span class="text-blue-600 bg-blue-50 px-2 py-1 rounded">Bootcamp</span>
                        @elseif($event->type == 'webinar')
                            <span class="text-amber-600 bg-amber-50 px-2 py-1 rounded">Webinar</span>
                        @elseif($event->type == 'workshop')
                            <span class="text-emerald-600 bg-emerald-50 px-2 py-1 rounded">Workshop</span>
                        @else
                            {{ $event->type }}
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $event->price }}</td>
                    <td class="px-6 py-4 text-center text-sm">
                        {{ $event->duration_or_date }}
                        @if($event->time)
                            <br><span class="text-xs text-slate-400">{{ $event->time }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ url('admin/event/'.$event->id.'/edit') }}" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ url('admin/event/'.$event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');" class="m-0 p-0">
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
                    <td colspan="7" class="px-6 py-8 text-center text-slate-500">Belum ada data event/webinar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($events->hasPages())
    <div class="p-6 border-t border-slate-100">
        {{ $events->links() }}
    </div>
    @endif
</div>
@endsection
