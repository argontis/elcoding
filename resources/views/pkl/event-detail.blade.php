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
                    @if($event->description)
                        {!! nl2br(e($event->description)) !!}
                    @else
                        <p>Mari bergabung dalam event dan webinar kami untuk memperluas wawasan, mendapatkan sertifikat keahlian, dan terkoneksi dengan para praktisi profesional di bidangnya.</p>
                    @endif
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

                <a href="{{ route('pkl.event.checkout', $event->id) }}" class="block w-full py-4 bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold text-center rounded-xl transition shadow-lg shadow-amber-500/30">
                    Daftar Sekarang <i class="fas fa-arrow-right ml-1 text-xs opacity-70"></i>
                </a>
                
                @if($isPurchased)
                    @if(isset($modules) && $modules->count() > 0)
                        <div class="mt-6">
                            <h3 class="text-sm font-bold text-slate-300 mb-3 border-b border-slate-700/50 pb-2">Kurikulum / Modul</h3>
                            <div class="space-y-3">
                                @foreach($modules as $module)
                                <div class="p-3 bg-slate-700/30 rounded-xl border border-slate-600/50 flex items-center justify-between group hover:border-blue-500/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 
                                            {{ $module->type === 'materi' ? 'bg-blue-500/20 text-blue-400' : '' }}
                                            {{ $module->type === 'tugas' ? 'bg-emerald-500/20 text-emerald-400' : '' }}
                                            {{ $module->type === 'quiz' ? 'bg-amber-500/20 text-amber-400' : '' }}
                                            {{ $module->type === 'video' ? 'bg-purple-500/20 text-purple-400' : '' }}">
                                            @if($module->type === 'materi' || $module->type === 'video')
                                                <i class="fas fa-book-open text-xs"></i>
                                            @elseif($module->type === 'tugas' || $module->type === 'project')
                                                <i class="fas fa-tasks text-xs"></i>
                                            @elseif($module->type === 'quiz')
                                                <i class="fas fa-question-circle text-xs"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $module->type }}</div>
                                            <div class="text-sm font-semibold text-white line-clamp-1 group-hover:text-blue-400 transition-colors">{{ $module->title }}</div>
                                        </div>
                                    </div>
                                    @if($module->file_path)
                                        <a href="{{ asset($module->file_path) }}" target="_blank" class="w-8 h-8 rounded-full bg-slate-600 hover:bg-blue-500 flex items-center justify-center text-white transition-colors" title="Download Materi">
                                            <i class="fas fa-download text-xs"></i>
                                        </a>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                
                    @if($event->materi_pdf && is_array($event->materi_pdf) && count($event->materi_pdf) > 0)
                        <div class="mt-6 border-t border-slate-700/50 pt-4">
                            <h3 class="text-sm font-bold text-slate-300 mb-3">Materi Tambahan (PDF Lama)</h3>
                            @foreach($event->materi_pdf as $index => $pdf)
                                <a href="{{ asset($pdf) }}" target="_blank" class="mt-2 block w-full py-3 bg-slate-700 hover:bg-slate-600 text-white font-bold text-center rounded-xl transition shadow-lg text-sm border border-slate-600">
                                    <i class="fas fa-file-pdf mr-2"></i> Download Materi {{ count($event->materi_pdf) > 1 ? $index + 1 : 'PDF' }}
                                </a>
                            @endforeach
                        </div>
                    @elseif($event->materi_pdf && !is_array($event->materi_pdf))
                        <div class="mt-6 border-t border-slate-700/50 pt-4">
                            <h3 class="text-sm font-bold text-slate-300 mb-3">Materi Tambahan (PDF Lama)</h3>
                            <a href="{{ asset($event->materi_pdf) }}" target="_blank" class="mt-2 block w-full py-3 bg-slate-700 hover:bg-slate-600 text-white font-bold text-center rounded-xl transition shadow-lg text-sm border border-slate-600">
                                <i class="fas fa-file-pdf mr-2"></i> Download Materi PDF
                            </a>
                        </div>
                    @endif
                @else
                    <div class="mt-4 block w-full py-3 px-4 bg-slate-700/50 text-slate-400 font-semibold text-center rounded-xl text-sm border border-slate-600/50">
                        <i class="fas fa-lock mr-2"></i> Beli event untuk mengunduh materi
                    </div>
                @endif
                
                <p class="text-center text-xs text-slate-500 mt-4">
                    Anda akan diarahkan ke halaman pendaftaran publik.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
