@extends('pkl.layout')

@section('title', 'Dashboard Portal Magang - elc.my.id')

@section('content')
<div class="space-y-8">
    
    <!-- Welcome Header Card -->
    <div class="relative bg-gradient-to-r from-blue-900/60 via-indigo-900/60 to-slate-800/80 border border-blue-500/20 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-xl overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-blue-500/10 rounded-full blur-2xl pointer-events-none"></div>
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-500/20 text-blue-300 text-xs font-semibold rounded-full border border-blue-500/30 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Status: {{ strtoupper($profile->status) }}
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-slate-300 text-sm mt-1">
                    Peserta PKL dari <strong class="text-white">{{ $profile->institution ?? 'Instansi Belum Diisi' }}</strong> 
                    ({{ $profile->major ?? 'Jurusan' }})
                </p>
                <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400 mt-4">
                    <div class="flex items-center gap-1.5 bg-slate-900/60 px-3 py-1.5 rounded-lg border border-slate-700/50">
                        <i class="fas fa-calendar-alt text-blue-400"></i>
                        <span>Periode: {{ $profile->start_date ? $profile->start_date->format('d M Y') : '-' }} s/d {{ $profile->end_date ? $profile->end_date->format('d M Y') : '-' }}</span>
                    </div>
                    @if($profile->program)
                        <div class="flex items-center gap-1.5 bg-slate-900/60 px-3 py-1.5 rounded-lg border border-slate-700/50">
                            <i class="fas fa-graduation-cap text-indigo-400"></i>
                            <span>Divisi: {{ $profile->program->title ?? $profile->program->name }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Profile Edit Link -->
            <a href="{{ route('pkl.profile') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-slate-800/80 hover:bg-slate-700/80 text-white text-xs font-semibold rounded-2xl border border-slate-700 transition shadow-md self-start md:self-auto">
                <i class="fas fa-user-edit text-blue-400"></i> Edit Data Diri
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        <!-- Card 1: Progress Belajar -->
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-5 sm:p-6 backdrop-blur-md hover:border-blue-500/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400">Progress Belajar</span>
                <div class="w-9 h-9 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center font-bold text-sm">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $profile->progress_percentage }}%</div>
            <div class="w-full bg-slate-700 h-2 rounded-full overflow-hidden mt-3">
                <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full rounded-full transition-all duration-500" style="width: {{ $profile->progress_percentage }}%"></div>
            </div>
        </div>

        <!-- Card 2: Tugas Selesai -->
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-5 sm:p-6 backdrop-blur-md hover:border-emerald-500/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400">Tugas Selesai</span>
                <div class="w-9 h-9 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center font-bold text-sm">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $completedTasks }} / {{ $totalTasks }}</div>
            <p class="text-xs text-slate-400 mt-2">Tugas terverifikasi mentor</p>
        </div>

        <!-- Card 3: Rata-Rata Quiz -->
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-5 sm:p-6 backdrop-blur-md hover:border-amber-500/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400">Rata-Rata Quiz</span>
                <div class="w-9 h-9 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold text-sm">
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $avgQuizScore }} <span class="text-xs font-normal text-slate-400">/ 100</span></div>
            <p class="text-xs text-slate-400 mt-2">Nilai ujian & evaluasi</p>
        </div>

        <!-- Card 4: Project Portofolio -->
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-5 sm:p-6 backdrop-blur-md hover:border-purple-500/40 transition">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold text-slate-400">Project Dikerjakan</span>
                <div class="w-9 h-9 rounded-2xl bg-purple-500/10 text-purple-400 flex items-center justify-center font-bold text-sm">
                    <i class="fas fa-laptop-code"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $portfoliosCount }}</div>
            <p class="text-xs text-slate-400 mt-2">Karya portofolio disetujui</p>
        </div>
    </div>

    <!-- Main Grid: Mentor & Pending Tasks & History -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left 2 Cols: Mentor & Pending Tasks -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Mentor Card -->
            <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-md">
                <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fas fa-user-tie text-blue-400"></i> Mentor Pembimbing
                </h3>

                @if($profile->mentor)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-900/60 p-4 rounded-2xl border border-slate-700/50">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black flex items-center justify-center text-lg shadow-lg">
                                {{ strtoupper(substr($profile->mentor->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-base">{{ $profile->mentor->name }}</h4>
                                <p class="text-xs text-slate-400">{{ $profile->mentor->email }}</p>
                                <span class="inline-block text-[11px] font-semibold text-blue-400 bg-blue-500/10 px-2 py-0.5 rounded-full mt-1">
                                    Pembimbing Lapangan PKL
                                </span>
                            </div>
                        </div>

                        <a href="https://wa.me/?text=Halo%20Mentor%20{{ urlencode($profile->mentor->name) }}" target="_blank"
                           class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600/20 text-emerald-400 hover:bg-emerald-600/30 text-xs font-bold rounded-xl border border-emerald-500/30 transition">
                            <i class="fab fa-whatsapp text-sm"></i> Diskusi via WhatsApp
                        </a>
                    </div>
                @else
                    <div class="bg-slate-900/40 p-5 rounded-2xl text-center border border-dashed border-slate-700">
                        <i class="fas fa-user-clock text-slate-500 text-3xl mb-2"></i>
                        <p class="text-sm text-slate-400 font-medium">Pembimbing PKL Belum Ditugaskan</p>
                        <p class="text-xs text-slate-500 mt-1">Admin elc.my.id sedang menetapkan mentor pembimbing untuk Anda.</p>
                    </div>
                @endif
            </div>

            <!-- Pending Tasks List -->
            <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-md">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-clock text-amber-400"></i> Tugas Perlu Dikerjakan
                    </h3>
                    <a href="{{ route('pkl.tasks') }}" class="text-xs text-blue-400 hover:underline font-semibold">
                        Lihat Semua Tugas &rarr;
                    </a>
                </div>

                @if($pendingTasks->count() > 0)
                    <div class="space-y-4">
                        @foreach($pendingTasks as $task)
                            <div class="bg-slate-900/60 p-4 rounded-2xl border border-slate-700/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs font-bold px-2 py-0.5 bg-amber-500/10 text-amber-400 rounded-md border border-amber-500/20">
                                            Pending
                                        </span>
                                        <h4 class="font-bold text-white text-sm">{{ $task->title }}</h4>
                                    </div>
                                    <p class="text-xs text-slate-400 line-clamp-1">{{ $task->description ?: 'Tidak ada deskripsi tambahan' }}</p>
                                    <p class="text-[11px] text-slate-500">
                                        <i class="fas fa-calendar-day mr-1"></i> Tenggat: {{ $task->due_date ? $task->due_date->format('d M Y') : 'Tanpa Tenggat' }}
                                    </p>
                                </div>
                                <a href="{{ route('pkl.tasks') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold rounded-xl transition text-center shrink-0">
                                    Kumpul Tugas
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-slate-900/40 p-6 rounded-2xl text-center border border-slate-700/40">
                        <i class="fas fa-check-double text-emerald-400 text-3xl mb-2"></i>
                        <p class="text-sm font-semibold text-white">Tidak ada tugas pending saat ini!</p>
                        <p class="text-xs text-slate-400 mt-1">Seluruh tugas telah diselesaikan atau dikirim untuk ditinjau mentor.</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- Right Col: Certificate Status & Recent Timeline -->
        <div class="space-y-8">
            
            <!-- Certificate Card Status -->
            <div class="bg-gradient-to-b from-indigo-950/60 to-slate-800/80 border border-indigo-500/30 rounded-3xl p-6 backdrop-blur-md">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-2xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-lg">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Sertifikat Kelulusan PKL</h3>
                        <p class="text-xs text-slate-400">Resmi dari elc.my.id</p>
                    </div>
                </div>

                @if($profile->certificate)
                    <div class="bg-slate-900/80 p-4 rounded-2xl border border-emerald-500/30 text-center mb-4">
                        <span class="inline-block px-3 py-1 bg-emerald-500/20 text-emerald-300 text-xs font-bold rounded-full mb-2">
                            <i class="fas fa-check-circle mr-1"></i> SERTIFIKAT TERBIT
                        </span>
                        <p class="text-xs text-slate-400">No: <strong class="text-white font-mono">{{ $profile->certificate->certificate_number }}</strong></p>
                        <p class="text-xs text-slate-400 mt-1">Predikat: <strong class="text-amber-400">{{ $profile->certificate->predicate }}</strong></p>
                    </div>
                    <a href="{{ route('pkl.certificate') }}" class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-2 transition shadow-lg">
                        <i class="fas fa-download"></i> Lihat & Unduh Sertifikat
                    </a>
                @else
                    <p class="text-xs text-slate-400 mb-4 leading-relaxed">
                        Sertifikat digital akan diterbitkan otomatis setelah Anda menyelesaikan seluruh tugas, quiz, dan periode program magang.
                    </p>
                    <a href="{{ route('pkl.certificate') }}" class="w-full py-3 bg-slate-700/60 text-slate-400 text-xs font-semibold rounded-xl flex items-center justify-center gap-2 border border-slate-600/50">
                        <i class="fas fa-clock"></i> Belum Diterbitkan
                    </a>
                @endif
            </div>

            <!-- Recent Timeline History -->
            <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-md">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-300 uppercase tracking-wider flex items-center gap-2">
                        <i class="fas fa-history text-indigo-400"></i> Histori Terbaru
                    </h3>
                    <a href="{{ route('pkl.history') }}" class="text-xs text-blue-400 hover:underline">Semua</a>
                </div>

                @if($histories->count() > 0)
                    <div class="space-y-4 relative before:absolute before:left-3 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-700">
                        @foreach($histories as $history)
                            <div class="relative pl-7 space-y-1">
                                <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-slate-900 border border-blue-500/50 text-blue-400 text-[10px] flex items-center justify-center">
                                    <i class="fas {{ $history->icon ?: 'fa-history' }}"></i>
                                </div>
                                <h4 class="text-xs font-bold text-white">{{ $history->title }}</h4>
                                <p class="text-[11px] text-slate-400 leading-tight">{{ $history->description }}</p>
                                <span class="text-[10px] text-slate-500 block">{{ $history->logged_at ? $history->logged_at->diffForHumans() : '' }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-slate-500 text-center py-4">Belum ada riwayat aktivitas.</p>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
