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
            @if((isset($purchasedPrograms) && $purchasedPrograms->count() > 0) || (isset($purchasedEvents) && $purchasedEvents->count() > 0))
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if(isset($purchasedPrograms))
                        @foreach($purchasedPrograms as $program)
                        <a href="{{ route('pkl.program.detail', $program->id) }}" class="block bg-slate-800/60 border border-slate-700/50 rounded-3xl overflow-hidden hover:border-emerald-500/50 transition group shadow-lg">
                            <div class="h-36 bg-slate-700/50 relative">
                                @if($program->image_path)
                                <img src="{{ asset($program->image_path) }}" alt="{{ $program->title }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-slate-500">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                                @endif
                                <div class="absolute top-3 left-3 px-3 py-1.5 bg-emerald-600/90 backdrop-blur text-white text-[11px] font-bold rounded-xl flex items-center gap-1.5 shadow-md">
                                    <i class="fas fa-check-circle"></i> TELAH DIBELI
                                </div>
                            </div>
                            <div class="p-5">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20 mb-2 inline-block">
                                    <i class="fas fa-laptop-code mr-1"></i> Program Kursus
                                </span>
                                <h4 class="text-base font-bold text-white leading-tight group-hover:text-emerald-400 transition">{{ $program->title }}</h4>
                            </div>
                        </a>
                        @endforeach
                    @endif

                    @if(isset($purchasedEvents))
                        @foreach($purchasedEvents as $event)
                        <a href="{{ route('pkl.event.detail', $event->id) }}" class="block bg-slate-800/60 border border-slate-700/50 rounded-3xl overflow-hidden hover:border-emerald-500/50 transition group shadow-lg">
                            <div class="h-36 bg-slate-700/50 relative">
                                @if($event->image_path)
                                <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-slate-500">
                                    <i class="fas fa-calendar text-4xl"></i>
                                </div>
                                @endif
                                <div class="absolute top-3 left-3 px-3 py-1.5 bg-emerald-600/90 backdrop-blur text-white text-[11px] font-bold rounded-xl flex items-center gap-1.5 shadow-md">
                                    <i class="fas fa-check-circle"></i> TELAH DIBELI
                                </div>
                            </div>
                            <div class="p-5">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20 mb-2 inline-block">
                                    <i class="fas fa-calendar-alt mr-1"></i> Event / Webinar
                                </span>
                                <h4 class="text-base font-bold text-white leading-tight group-hover:text-emerald-400 transition">{{ $event->title }}</h4>
                            </div>
                        </a>
                        @endforeach
                    @endif
                </div>
            @else
                <div class="bg-slate-900/40 p-8 text-center rounded-3xl border border-slate-700/50">
                    <i class="fas fa-book-open text-slate-500 text-3xl mb-2"></i>
                    <p class="text-sm font-semibold text-white">Belum Ada Modul Belajar</p>
                    <p class="text-xs text-slate-400 mt-1">Silakan beli program kursus di bawah atau tentukan program magang pada menu profil.</p>
                </div>
            @endif
        @endforelse
    </div>

    <!-- Eksplorasi Program Kursus & Event -->
    <div class="mt-16 pt-8 border-t border-slate-800">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-bold text-white">Eksplorasi Program & Event</h2>
                <p class="text-xs text-slate-400 mt-1">Tingkatkan skill Anda dengan mengikuti program kursus atau webinar</p>
            </div>
            
            <!-- Search & Filter Form -->
            <form action="{{ route('pkl.modules') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full max-w-lg">
                <!-- Search -->
                <div class="relative flex-grow">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari program atau event..." class="w-full bg-slate-800/60 border border-slate-700/60 rounded-xl px-4 py-2.5 pl-10 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 transition">
                    <i class="fas fa-search absolute left-3.5 top-3.5 text-slate-500"></i>
                    @if(!empty($search))
                        <a href="{{ route('pkl.modules', ['filter' => $filter ?? 'all']) }}" class="absolute right-3 top-3 text-slate-400 hover:text-white"><i class="fas fa-times"></i></a>
                    @endif
                </div>
                
                <!-- Filter -->
                <select name="filter" onchange="this.form.submit()" class="bg-slate-800/60 border border-slate-700/60 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 transition cursor-pointer w-full sm:w-auto">
                    <option value="all" {{ ($filter ?? 'all') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                    <option value="course" {{ ($filter ?? 'all') == 'course' ? 'selected' : '' }}>Program Kursus</option>
                    <option value="event" {{ ($filter ?? 'all') == 'event' ? 'selected' : '' }}>Event & Webinar</option>
                </select>
            </form>
        </div>

        <div class="space-y-8">
            <!-- Program Kursus -->
            @if(($filter ?? 'all') == 'all' || ($filter ?? 'all') == 'course')
            <div>
                <h3 class="text-sm font-semibold text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-laptop-code text-blue-400"></i> Program Kursus</h3>
                @if(isset($coursePrograms) && $coursePrograms->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($coursePrograms as $program)
                    <a href="{{ route('pkl.program.detail', $program->id) }}" class="block bg-slate-800/40 border border-slate-700/50 rounded-2xl overflow-hidden hover:border-blue-500/30 transition group">
                        <div class="h-32 bg-slate-700/50 relative">
                            @if($program->image_path)
                            <img src="{{ asset($program->image_path) }}" alt="{{ $program->title }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-slate-500">
                                <i class="fas fa-image text-3xl"></i>
                            </div>
                            @endif
                            @if(isset($purchasedPrograms) && $purchasedPrograms->contains('id', $program->id))
                            <div class="absolute top-2 left-2 px-2 py-1 bg-emerald-600/90 backdrop-blur text-white text-[10px] font-bold rounded-lg flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> TELAH DIBELI
                            </div>
                            @else
                            <div class="absolute top-2 left-2 px-2 py-1 bg-blue-600/90 backdrop-blur text-white text-[10px] font-bold rounded-lg">
                                Rp {{ number_format((int)preg_replace('/[^0-9]/', '', $program->price), 0, ',', '.') }}
                            </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="text-sm font-bold text-white leading-tight group-hover:text-blue-400 transition">{{ $program->title }}</h4>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="text-center py-6 bg-slate-800/20 border border-slate-700/30 rounded-2xl">
                    <p class="text-xs text-slate-500">Tidak ada program kursus yang ditemukan.</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Event & Webinar -->
            @if(($filter ?? 'all') == 'all' || ($filter ?? 'all') == 'event')
            <div>
                <h3 class="text-sm font-semibold text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-calendar-alt text-amber-400"></i> Event & Webinar</h3>
                @if(isset($events) && $events->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($events as $event)
                    <a href="{{ route('pkl.event.detail', $event->id) }}" class="block bg-slate-800/40 border border-slate-700/50 rounded-2xl overflow-hidden hover:border-amber-500/30 transition group">
                        <div class="h-32 bg-slate-700/50 relative">
                            @if($event->image_path)
                            <img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-slate-500">
                                <i class="fas fa-calendar text-3xl"></i>
                            </div>
                            @endif
                            @if(isset($purchasedEvents) && $purchasedEvents->contains('id', $event->id))
                            <div class="absolute top-2 left-2 px-2 py-1 bg-emerald-600/90 backdrop-blur text-white text-[10px] font-bold rounded-lg flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> TELAH DIBELI
                            </div>
                            @else
                            <div class="absolute top-2 left-2 px-2 py-1 bg-amber-600/90 backdrop-blur text-white text-[10px] font-bold rounded-lg">
                                {{ $event->duration_or_date ?? 'Segera' }}
                            </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="text-sm font-bold text-white leading-tight group-hover:text-amber-400 transition">{{ $event->title }}</h4>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="text-center py-6 bg-slate-800/20 border border-slate-700/30 rounded-2xl">
                    <p class="text-xs text-slate-500">Tidak ada event/webinar yang ditemukan.</p>
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
