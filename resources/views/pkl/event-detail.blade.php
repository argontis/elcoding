@extends('pkl.layout')

@section('title', 'Detail Event & Webinar - elc.my.id')

@section('content')
<div class="space-y-8">
    <div class="flex items-center gap-4">
        <a href="{{ route('pkl.modules') }}" class="w-10 h-10 bg-slate-800/60 rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-amber-400 uppercase tracking-wider mb-1">
                <i class="fas fa-calendar-alt"></i> {{ $event->type ?? 'Event & Webinar' }}
            </div>
            <h1 class="text-2xl font-extrabold text-white">{{ $event->title }}</h1>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            @if($event->image_path)
            <div class="rounded-3xl overflow-hidden bg-slate-800 border border-slate-700/50">
                <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}" class="w-full object-cover max-h-[400px]">
            </div>
            @endif

            <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-8 backdrop-blur-xl">
                <h2 class="text-xl font-bold text-white mb-4">Deskripsi Event</h2>
                <div class="prose prose-invert prose-sm max-w-none text-slate-300">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            @if($event->syllabus)
            <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-8 backdrop-blur-xl">
                <h2 class="text-xl font-bold text-white mb-4">Materi / Jadwal</h2>
                <div class="prose prose-invert prose-sm max-w-none text-slate-300">
                    {!! is_array($event->syllabus) ? implode('<br>', $event->syllabus) : nl2br(e($event->syllabus)) !!}
                </div>
            </div>
            @endif
        </div>

        <div>
            <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-xl sticky top-8">
                
                <div class="space-y-4 mb-6 pb-6 border-b border-slate-700/50">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-700/50 flex items-center justify-center text-slate-400 flex-shrink-0">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-semibold mb-0.5">Tanggal Pelaksanaan</div>
                            <div class="text-sm text-white font-bold">{{ $event->duration_or_date ?? 'Segera' }}</div>
                        </div>
                    </div>
                    
                    @if($event->time)
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-700/50 flex items-center justify-center text-slate-400 flex-shrink-0">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 font-semibold mb-0.5">Waktu</div>
                            <div class="text-sm text-white font-bold">{{ $event->time }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="text-slate-400 text-sm mb-2">Harga Tiket:</div>
                <div class="text-3xl font-extrabold text-white mb-2">
                    @if(empty($event->price_amount) || $event->price_amount == 0)
                        GRATIS
                    @else
                        Rp {{ number_format($event->price_amount, 0, ',', '.') }}
                    @endif
                </div>
                
                @if($event->original_price && $event->original_price != '0')
                    <div class="text-sm text-slate-500 line-through mb-6">
                        Rp {{ number_format((int)preg_replace('/[^0-9]/', '', $event->original_price), 0, ',', '.') }}
                    </div>
                @else
                    <div class="mb-6"></div>
                @endif

                @php
                    $checkoutRoute = '/event-webinar'; // Default fallback
                    $lowerType = strtolower($event->type ?? '');
                    if (str_contains($lowerType, 'bootcamp')) {
                        $checkoutRoute = '/pendaftaran-bootcamp';
                    } elseif (str_contains($lowerType, 'workshop')) {
                        $checkoutRoute = '/pendaftaran-workshop';
                    } elseif (str_contains($lowerType, 'webinar')) {
                        $checkoutRoute = '/pendaftaran-webinar';
                    }
                @endphp

                <a href="{{ url($checkoutRoute) }}" target="_blank" class="block w-full py-4 bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold text-center rounded-xl transition shadow-lg shadow-amber-500/30">
                    Daftar Sekarang <i class="fas fa-external-link-alt ml-1 text-xs opacity-70"></i>
                </a>
                <p class="text-center text-xs text-slate-500 mt-4">
                    Anda akan diarahkan ke halaman pendaftaran publik.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
