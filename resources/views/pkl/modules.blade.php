@extends('pkl.layout')

@section('title', 'Modul Pembelajaran & Silabus - elc.my.id')

@section('content')
<div class="space-y-8">
    
    <div>
        <div class="flex items-center gap-2 text-xs font-semibold text-blue-400 uppercase tracking-wider mb-1">
            <i class="fas fa-graduation-cap"></i> Program: {{ $profile->program->title ?? $profile->program->name ?? 'PKL & Magang' }}
        </div>
        <h1 class="text-2xl font-extrabold text-white">Modul Pembelajaran & Silabus Kelas</h1>
        <p class="text-slate-400 text-sm mt-1">Akses materi pelatihan, video instruksi, quiz evaluasi, dan instruksi tugas project Anda</p>
    </div>

    <!-- Access Restriction Warning if Unpaid -->
    @php
        $latestInvoice = $profile->invoices()->first();
        $isLocked = ($latestInvoice && $latestInvoice->status === 'pending');
    @endphp

    @if($isLocked)
        <div class="bg-amber-500/10 border border-amber-500/30 rounded-3xl p-6 text-amber-300 flex items-start gap-4 shadow-xl">
            <i class="fas fa-lock text-3xl text-amber-400 mt-1"></i>
            <div>
                <h3 class="font-extrabold text-base text-white">Akses Modul Belum Terbuka (Menunggu Pembayaran)</h3>
                <p class="text-xs text-amber-200/80 mt-1">
                    Tagihan pendaftaran Anda (<strong>{{ $latestInvoice->invoice_code }}</strong>) sebesar 
                    <strong>Rp {{ number_format($latestInvoice->amount, 0, ',', '.') }}</strong> masih menunggu verifikasi.
                </p>
                <a href="{{ route('pkl.invoices') }}" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl transition">
                    <i class="fas fa-file-invoice-dollar"></i> Upload Bukti Bayar Sekarang
                </a>
            </div>
        </div>
    @endif

    <!-- Modules List -->
    <div class="space-y-4">
        @forelse($studentProgressList as $index => $item)
            @php
                $mod = $item->module;
                $isCompleted = ($item->status === 'completed');
                
                $typeBadges = [
                    'materi' => ['bg' => 'bg-blue-500/10 text-blue-400 border-blue-500/20', 'icon' => 'fa-book-open', 'label' => 'Materi Belajar'],
                    'video' => ['bg' => 'bg-purple-500/10 text-purple-400 border-purple-500/20', 'icon' => 'fa-play-circle', 'label' => 'Video Tutorial'],
                    'quiz' => ['bg' => 'bg-amber-500/10 text-amber-400 border-amber-500/20', 'icon' => 'fa-question-circle', 'label' => 'Quiz Evaluasi'],
                    'tugas' => ['bg' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20', 'icon' => 'fa-tasks', 'label' => 'Tugas Praktikum'],
                    'project' => ['bg' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20', 'icon' => 'fa-laptop-code', 'label' => 'Final Project'],
                ];
                $badge = $typeBadges[$mod->type ?? 'materi'] ?? $typeBadges['materi'];
            @endphp

            <div class="bg-slate-800/60 border {{ $isCompleted ? 'border-emerald-500/30' : 'border-slate-700/60' }} rounded-3xl p-6 backdrop-blur-xl transition hover:border-slate-600">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-2xl flex-shrink-0 flex items-center justify-center font-bold text-sm {{ $isCompleted ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-slate-700/60 text-slate-300' }}">
                            @if($isCompleted)
                                <i class="fas fa-check"></i>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold border {{ $badge['bg'] }}">
                                    <i class="fas {{ $badge['icon'] }} mr-1"></i> {{ $badge['label'] }}
                                </span>
                                @if($isCompleted)
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai ({{ $item->completed_at ? $item->completed_at->format('d M Y') : '-' }})
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-700 text-slate-400 border border-slate-600">
                                        <i class="fas fa-clock mr-1"></i> Belum Dikerjakan
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-base font-bold text-white">{{ $mod->title }}</h3>
                            <p class="text-xs text-slate-400">{{ $mod->description }}</p>

                            @if(!$isLocked && $mod->content)
                                <div class="mt-3 p-4 bg-slate-900/60 rounded-2xl border border-slate-700/50 text-xs text-slate-300 leading-relaxed">
                                    {!! nl2br(e($mod->content)) !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="flex-shrink-0 flex items-center gap-2 md:self-center">
                        @if($isLocked)
                            <button disabled class="px-4 py-2 bg-slate-700 text-slate-500 font-bold text-xs rounded-xl cursor-not-allowed">
                                <i class="fas fa-lock"></i> Terkunci
                            </button>
                        @elseif($isCompleted)
                            <span class="px-4 py-2 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-bold text-xs rounded-xl flex items-center gap-1.5">
                                <i class="fas fa-check-circle"></i> Tuntas
                            </span>
                        @else
                            @if($mod->type === 'tugas' || $mod->type === 'project')
                                <a href="{{ route('pkl.tasks') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl transition flex items-center gap-1.5 shadow-md shadow-blue-500/20">
                                    <i class="fas fa-upload"></i> Kirim Tugas/Project
                                </a>
                            @elseif($mod->type === 'quiz')
                                <a href="{{ route('pkl.progress') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl transition flex items-center gap-1.5 shadow-md shadow-amber-500/20">
                                    <i class="fas fa-pen font-bold"></i> Ikuti Quiz
                                </a>
                            @else
                                <form action="{{ route('pkl.modules.complete', $item->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl transition flex items-center gap-1.5 shadow-md shadow-emerald-500/20">
                                        <i class="fas fa-check-circle"></i> Tandai Selesai
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <div class="bg-slate-900/40 p-8 text-center rounded-3xl border border-slate-700/50">
                <i class="fas fa-book-open text-slate-500 text-3xl mb-2"></i>
                <p class="text-sm font-semibold text-white">Belum Ada Modul Belajar</p>
                <p class="text-xs text-slate-400 mt-1">Silakan tentukan program magang pada menu profil atau hubungi admin.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
