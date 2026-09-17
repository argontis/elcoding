@extends('pkl.layout')

@section('title', 'Histori Program PKL - elc.my.id')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div>
        <h1 class="text-2xl font-extrabold text-white">Histori & Timeline Program</h1>
        <p class="text-slate-400 text-sm mt-1">Catatan riwayat lengkap seluruh milestone dan aktivitas Anda selama magang</p>
    </div>

    <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 sm:p-8 backdrop-blur-xl">
        @if($histories->count() > 0)
            <div class="space-y-6 relative before:absolute before:left-4 before:top-3 before:bottom-3 before:w-0.5 before:bg-slate-700">
                @foreach($histories as $history)
                    <div class="relative pl-10 space-y-1">
                        <div class="absolute left-0 top-0.5 w-8 h-8 rounded-full bg-slate-900 border-2 border-blue-500 text-blue-400 text-xs flex items-center justify-center shadow-md">
                            <i class="fas {{ $history->icon ?: 'fa-history' }}"></i>
                        </div>
                        <div class="bg-slate-900/60 p-4 rounded-2xl border border-slate-700/50">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1 mb-1">
                                <h3 class="text-sm font-bold text-white">{{ $history->title }}</h3>
                                <span class="text-[11px] text-slate-400">{{ $history->logged_at ? $history->logged_at->format('d M Y H:i') : '' }}</span>
                            </div>
                            <p class="text-xs text-slate-300 leading-relaxed">{{ $history->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $histories->links() }}
            </div>
        @else
            <div class="text-center py-8 text-slate-400 text-sm">
                Belum ada histori aktivitas.
            </div>
        @endif
    </div>
</div>
@endsection
