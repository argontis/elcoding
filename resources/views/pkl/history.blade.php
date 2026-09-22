@extends('pkl.layout')

@section('title', 'Histori Program PKL - elc.my.id')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Histori & Timeline Program</h1>
            <p class="text-slate-400 text-sm mt-1">Catatan riwayat aktivitas dengan tampilan terminal</p>
        </div>
        <form action="{{ route('pkl.history') }}" method="GET" class="flex flex-wrap items-center gap-2">
            <input type="date" name="date" value="{{ request('date') }}" class="bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-sm text-emerald-400 focus:outline-none focus:border-emerald-500 font-mono">
            <button type="submit" class="bg-slate-700 hover:bg-slate-600 border border-slate-600 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition flex items-center gap-2 font-mono">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if(request('date'))
                <a href="{{ route('pkl.history') }}" class="bg-red-500/20 hover:bg-red-500/30 text-red-400 border border-red-500/30 px-3 py-1.5 rounded-lg text-sm transition font-mono">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <div class="bg-[#0d1117] border border-slate-700 rounded-xl shadow-2xl font-mono text-sm overflow-hidden relative">
        <!-- Terminal Header -->
        <div class="bg-slate-800/80 px-4 py-3 flex items-center gap-2 border-b border-slate-700">
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <div class="w-3 h-3 rounded-full bg-amber-500"></div>
            <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
            <span class="ml-2 text-slate-400 text-xs font-bold">student@elcoding:~/timeline$</span>
        </div>

        <div class="p-4 sm:p-6">
            @if($histories->count() > 0)
                @php $currentDate = null; @endphp
                <div class="space-y-2">
                    @foreach($histories as $history)
                        @php
                            $historyDate = $history->logged_at ? $history->logged_at->format('Y-m-d') : '';
                            $displayDate = $history->logged_at ? $history->logged_at->format('D, d M Y') : 'Unknown Date';
                        @endphp

                        @if($currentDate !== $historyDate)
                            @if($currentDate !== null)
                                </div> <!-- close previous date group -->
                            @endif
                            <div class="mt-6 mb-3 pt-2">
                                <span class="text-emerald-400 font-bold bg-emerald-500/10 px-2 py-1 rounded">[{{ $displayDate }}]</span>
                            </div>
                            <div class="space-y-4 pl-3 border-l border-slate-700/50 ml-2">
                            @php $currentDate = $historyDate; @endphp
                        @endif

                        <div class="flex items-start gap-4 group hover:bg-slate-800/30 p-2 -ml-2 rounded transition">
                            <div class="text-slate-500 w-12 flex-shrink-0 pt-0.5 text-xs">
                                {{ $history->logged_at ? $history->logged_at->format('H:i') : '' }}
                            </div>
                            <div class="text-blue-400 flex-shrink-0 pt-0.5">
                                <i class="fas {{ $history->icon ?: 'fa-angle-right' }} w-5 text-center"></i>
                            </div>
                            <div>
                                <span class="text-amber-300 font-semibold">{{ $history->title }}</span>
                                <p class="text-slate-400 mt-1 text-xs leading-relaxed">{{ $history->description }}</p>
                            </div>
                        </div>
                    @endforeach
                    @if($currentDate !== null)
                        </div> <!-- close last date group -->
                    @endif
                </div>

                <div class="mt-8 pt-6 border-t border-slate-800/50 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <span class="text-slate-500 text-xs animate-pulse">student@elcoding:~/timeline$ _</span>
                    <div class="terminal-pagination">
                        {{ $histories->links() }}
                    </div>
                </div>
            @else
                <div class="text-slate-500 py-6">
                    <span class="text-emerald-400">student@elcoding:~/timeline$</span> grep -r "activity" .<br>
                    <span class="text-red-400">> No history found matching criteria.</span><br><br>
                    <span class="text-emerald-400 animate-pulse">student@elcoding:~/timeline$ _</span>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Customizing pagination for terminal look */
.terminal-pagination nav {
    background: transparent !important;
}
.terminal-pagination p {
    color: #94a3b8 !important;
    font-size: 0.75rem !important;
}
.terminal-pagination span, .terminal-pagination a {
    background-color: transparent !important;
    border-color: #334155 !important;
    color: #cbd5e1 !important;
}
.terminal-pagination .bg-white {
    background-color: #1e293b !important;
}
.terminal-pagination [aria-current="page"] span {
    background-color: #10b981 !important;
    color: #022c22 !important;
    border-color: #10b981 !important;
}
</style>
@endsection
