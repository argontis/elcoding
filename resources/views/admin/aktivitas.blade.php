@extends('admin.layout')

@section('title', 'Semua Aktivitas - Admin Elcoding')
@section('header', 'Aktivitas Terbaru')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Aktivitas Sistem</h3>
            <p class="text-sm text-slate-500 mt-1">Lacak semua penambahan dan perubahan data hingga 100 record terakhir.</p>
        </div>
        <a href="{{ url('admin') }}" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="p-0">
        <div class="divide-y divide-slate-100">
            @forelse($activitiesPaginator as $activity)
            <div class="p-4 px-6 flex items-start gap-4 hover:bg-slate-50 transition-colors">
                <div class="w-10 h-10 rounded-full bg-{{ $activity->color }}-100 text-{{ $activity->color }}-600 flex items-center justify-center shrink-0">
                    <i class="fas {{ $activity->icon }}"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-800 font-medium">
                        {{ $activity->type }} <span class="font-bold text-blue-600">"{{ Str::limit($activity->title, 60) }}"</span><br>
                        <span class="text-slate-500 font-normal mt-1 block">{{ $activity->description }}</span>
                    </p>
                    <p class="text-xs text-slate-400 mt-1">{{ $activity->updated_at->format('d M Y, H:i') }} ({{ $activity->updated_at->diffForHumans() }})</p>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-slate-500">
                Belum ada aktivitas yang terekam.
            </div>
            @endforelse
        </div>
    </div>
    
    <div class="p-5 border-t border-slate-100">
        {{ $activitiesPaginator->links() }}
    </div>
</div>
@endsection
