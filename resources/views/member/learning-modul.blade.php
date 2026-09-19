@extends('member.layout')

@section('title', 'Learning Modul - Member Elcoding')
@section('header', 'Learning Modul')

@section('content')

@if(!$profile)
<div class="surface-card overflow-hidden">
    <div class="p-8 text-center">
        <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-book-open text-blue-600 text-3xl"></i>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-800 mb-3">Learning Modul</h2>
        <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
            Fitur modul pembelajaran saat ini dikhususkan untuk peserta Program PKL/Magang.
        </p>
    </div>
</div>
@else

@php
    $totalModules = $studentProgressList->count();
    $completedModules = $studentProgressList->where('status', 'completed')->count();
    $progressPercentage = $totalModules > 0 ? round(($completedModules / $totalModules) * 100) : 0;
@endphp

<!-- Header Banner -->
<div class="bg-slate-900 rounded-3xl p-8 mb-8 relative overflow-hidden shadow-2xl">
    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-800 to-blue-900/80"></div>
    <!-- Decorative abstract circles -->
    <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full border border-white/5 bg-white/5 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 rounded-full border border-blue-500/10 bg-blue-500/10 blur-3xl"></div>
    
    <div class="relative z-10 flex flex-col lg:flex-row justify-between items-center gap-8">
        <div class="lg:w-7/12">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/10 backdrop-blur-md border border-white/10 rounded-full mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-[10px] font-bold text-white uppercase tracking-widest">Modul Aktif - Semester Ini</span>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight leading-tight">
                Modul Pembelajaran
            </h1>
            <p class="text-slate-300 text-sm leading-relaxed max-w-xl">
                Akses seluruh silabus materi coding, video tutorial eksklusif, source code latihan, dan tugas praktikal terpadu untuk mengasah keahlian software engineering Anda.
            </p>
        </div>
        
        <div class="lg:w-5/12 w-full flex flex-col gap-3">
            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-4 flex items-center gap-4 transition hover:bg-white/15">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-white leading-none">{{ $totalModules }}</h4>
                    <p class="text-[11px] text-slate-300 mt-1">Modul Aktif Semester Ini</p>
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-4 flex items-center gap-4 transition hover:bg-white/15">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-white shrink-0">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div>
                    <h4 class="text-xl font-bold text-white leading-none">{{ $progressPercentage }}%</h4>
                    <p class="text-[11px] text-slate-300 mt-1">Rata-rata Progres Belajar</p>
                </div>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-2xl p-4 flex items-center gap-4 transition hover:bg-white/15">
                <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center text-amber-400 shrink-0">
                    <i class="fas fa-award"></i>
                </div>
                <div>
                    <h4 class="text-base font-bold text-white leading-none">Sertifikasi</h4>
                    <p class="text-[11px] text-slate-300 mt-1">Sertifikat Menanti Penyelesaian</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search & Filter Row -->
<div class="flex flex-col xl:flex-row items-start xl:items-center justify-between gap-4 mb-8">
    <div class="flex items-center gap-2 overflow-x-auto w-full xl:w-auto pb-2 xl:pb-0 hide-scroll">
        <div class="relative shrink-0">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <i class="fas fa-search"></i>
            </div>
            <input type="text" placeholder="Cari modul..." class="pl-9 pr-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 w-48 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
        </div>
        
        <div class="flex items-center bg-white p-1 rounded-xl border border-slate-200 shrink-0">
            <button class="px-4 py-1.5 bg-slate-800 text-white text-xs font-bold rounded-lg shadow-sm">Semua Kategori</button>
            <button class="px-4 py-1.5 text-slate-500 hover:text-slate-800 text-xs font-bold rounded-lg transition-colors">Frontend</button>
            <button class="px-4 py-1.5 text-slate-500 hover:text-slate-800 text-xs font-bold rounded-lg transition-colors">Backend</button>
            <button class="px-4 py-1.5 text-slate-500 hover:text-slate-800 text-xs font-bold rounded-lg transition-colors hidden sm:block">DevOps & DB</button>
        </div>
    </div>
    
    <div class="flex items-center gap-2 shrink-0">
        <div class="relative">
            <select class="pl-4 pr-10 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 appearance-none cursor-pointer focus:ring-2 focus:ring-blue-500">
                <option>Urutkan: Progres</option>
                <option>Urutkan: Terbaru</option>
                <option>Urutkan: A-Z</option>
            </select>
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400"><i class="fas fa-chevron-down text-[10px]"></i></div>
        </div>
        
        <div class="relative">
            <select class="pl-4 pr-10 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-700 appearance-none cursor-pointer focus:ring-2 focus:ring-blue-500">
                <option>Status: Semua</option>
                <option>Status: Selesai</option>
                <option>Status: Belum</option>
            </select>
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400"><i class="fas fa-chevron-down text-[10px]"></i></div>
        </div>
    </div>
</div>

<!-- Modules Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
    @forelse($studentProgressList as $index => $item)
        @php
            $mod = $item->module;
            $isCompleted = ($item->status === 'completed');
            
            // Generate distinct category styling based on type
            $categoryMap = [
                'materi' => ['name' => 'Fundamental', 'bg' => 'bg-indigo-50 text-indigo-600', 'icon' => 'fa-book'],
                'video' => ['name' => 'Visual', 'bg' => 'bg-purple-50 text-purple-600', 'icon' => 'fa-play-circle'],
                'quiz' => ['name' => 'Evaluasi', 'bg' => 'bg-amber-50 text-amber-600', 'icon' => 'fa-question-circle'],
                'tugas' => ['name' => 'Praktikum', 'bg' => 'bg-blue-50 text-blue-600', 'icon' => 'fa-laptop-code'],
                'project' => ['name' => 'Final', 'bg' => 'bg-emerald-50 text-emerald-600', 'icon' => 'fa-rocket'],
            ];
            
            // Just for UI variety, assign dummy categories based on index if type is all 'materi'
            $mockCategories = [
                ['name' => 'Frontend', 'bg' => 'bg-blue-50 text-blue-600', 'icon' => 'HTML'],
                ['name' => 'Backend', 'bg' => 'bg-purple-50 text-purple-600', 'icon' => '{}'],
                ['name' => 'DevOps', 'bg' => 'bg-emerald-50 text-emerald-600', 'icon' => 'fa-server'],
                ['name' => 'Database', 'bg' => 'bg-amber-50 text-amber-600', 'icon' => 'fa-database'],
            ];
            $cat = $mockCategories[$index % 4];
            
            $progressVal = $isCompleted ? 100 : rand(0, 85); // Dummy progress for UI if not completed
            if($progressVal == 0) $statusLabel = "Belum Dimulai";
            elseif($progressVal == 100) $statusLabel = "Selesai";
            else $statusLabel = "Sedang Dipelajari";
        @endphp
        
        <div class="surface-card rounded-3xl p-6 flex flex-col border border-slate-100 hover:border-slate-300 transition-all hover:shadow-lg hover:-translate-y-1">
            <!-- Top Tags -->
            <div class="flex justify-between items-center mb-6">
                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold tracking-wider {{ $cat['bg'] }} uppercase">{{ $cat['name'] }}</span>
                <div class="flex items-center gap-1.5">
                    @if($isCompleted)
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-[10px] font-bold text-slate-500">Selesai</span>
                    @elseif($progressVal > 0)
                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                        <span class="text-[10px] font-bold text-slate-500">Sedang Dipelajari</span>
                    @else
                        <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                        <span class="text-[10px] font-bold text-slate-500">Belum Dimulai</span>
                    @endif
                </div>
            </div>
            
            <!-- Title & Icon -->
            <div class="flex justify-between items-start gap-4 mb-4">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Modul {{ sprintf('%02d', $index + 1) }}</p>
                    <h3 class="text-xl font-extrabold text-slate-900 leading-snug line-clamp-2" title="{{ $mod->title }}">{{ $mod->title }}</h3>
                </div>
                <div class="w-12 h-12 shrink-0 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center text-slate-400 font-bold shadow-sm">
                    @if(strpos($cat['icon'], 'fa-') === 0)
                        <i class="fas {{ $cat['icon'] }} text-lg"></i>
                    @else
                        <span class="text-[11px]">{{ $cat['icon'] }}</span>
                    @endif
                </div>
            </div>
            
            <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-6 flex-1">
                {{ $mod->description ?? 'Materi ini dirancang untuk memberikan pemahaman esensial mengenai konsep dasar hingga lanjutan dalam pengembangan aplikasi yang terstruktur.' }}
            </p>
            
            <!-- Stats -->
            <div class="flex items-center gap-3 text-[11px] font-semibold text-slate-400 mb-6">
                <span class="flex items-center gap-1"><i class="far fa-play-circle text-slate-300"></i> {{ rand(5, 25) }} Video</span>
                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                <span class="flex items-center gap-1"><i class="far fa-question-circle text-slate-300"></i> {{ rand(2, 8) }} Kuis</span>
                <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                <span class="flex items-center gap-1"><i class="fas fa-laptop-code text-slate-300"></i> {{ rand(1, 3) }} Proyek</span>
            </div>
            
            <!-- Progress Bar -->
            <div class="mb-6">
                <div class="flex justify-between items-end mb-2">
                    <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Progres Belajar</span>
                    <span class="text-[10px] font-bold text-slate-700">{{ $progressVal }}% Selesai</span>
                </div>
                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000 {{ $isCompleted ? 'bg-emerald-500' : 'bg-slate-800' }}" style="width: {{ $progressVal }}%"></div>
                </div>
            </div>
            
            <!-- Footer Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">
                        {{ strtoupper(substr($profile->mentor->name ?? 'Admin', 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-800 leading-none mb-0.5">{{ $profile->mentor->name ?? 'Instruktur Utama' }}</p>
                        <p class="text-[9px] font-semibold text-slate-400">Instruktur</p>
                    </div>
                </div>
                
                @if($isCompleted)
                    <form action="{{ route('pkl.modules.complete', $item->id) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" disabled class="text-xs font-bold text-emerald-600 flex items-center gap-1.5 transition-colors">
                            <i class="fas fa-check-circle"></i> Tuntas
                        </button>
                    </form>
                @else
                    <form action="{{ route('pkl.modules.complete', $item->id) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1.5 transition-colors">
                            {{ $progressVal == 0 ? 'Mulai Belajar' : 'Lanjutkan' }} <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full surface-card p-12 text-center rounded-3xl border border-slate-200">
            <i class="fas fa-book-open text-slate-300 text-5xl mb-4"></i>
            <p class="text-lg font-bold text-slate-700">Belum Ada Modul Belajar</p>
            <p class="text-sm text-slate-500 mt-2 max-w-md mx-auto">Silakan tentukan program magang pada menu profil atau hubungi admin untuk mendapatkan akses modul materi Anda.</p>
        </div>
    @endforelse
</div>

<!-- Footer Help Banner -->
<div class="bg-slate-50 border border-slate-200 rounded-3xl p-6 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
    <div class="flex items-start gap-4">
        <div class="w-12 h-12 rounded-2xl bg-white border border-slate-200 text-slate-600 flex items-center justify-center text-xl shrink-0 shadow-sm">
            <i class="fas fa-headset"></i>
        </div>
        <div>
            <h4 class="text-base font-bold text-slate-900 mb-1">Butuh Bantuan Materi atau Diskusi Kode?</h4>
            <p class="text-xs text-slate-500">Konsultasi langsung dengan tim mentor elcoding.id atau download panduan kurikulum lengkap.</p>
        </div>
    </div>
    
    <div class="flex flex-col sm:flex-row items-center gap-3 shrink-0 w-full md:w-auto">
        <a href="#" class="w-full sm:w-auto px-5 py-2.5 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-colors flex items-center justify-center gap-2">
            <i class="fas fa-download text-slate-400"></i> Unduh Silabus PDF
        </a>
        <a href="#" class="w-full sm:w-auto px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl transition-colors flex items-center justify-center gap-2 shadow-md">
            <i class="far fa-comments"></i> Forum Diskusi Mentor
        </a>
    </div>
</div>

<style>
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }
    .hide-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endif

@endsection
