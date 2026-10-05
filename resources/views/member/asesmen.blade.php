@extends('member.layout')

@section('title', 'Asesmen - Member Elcoding')
@section('header', 'Asesmen')

@section('content')

@if(!$profile)
<div class="surface-card overflow-hidden">
    <div class="p-8 text-center">
        <div class="w-20 h-20 rounded-2xl bg-amber-50 flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-clipboard-check text-amber-600 text-3xl"></i>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-800 mb-3">Asesmen</h2>
        <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
            Fitur asesmen saat ini dikhususkan untuk peserta Program PKL/Magang.
        </p>
    </div>
</div>
@else
<!-- Header -->
<div class="mb-6">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Asesmen Saya</h1>
        <span class="px-3 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full border border-blue-100">Semester Aktif</span>
    </div>
</div>

<!-- Summary Cards -->
<div class="surface-card p-6 mb-8 relative">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-chart-line text-blue-500"></i> Ringkasan Kemajuan Asesmen
        </h3>
        <div class="text-xs font-semibold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100 flex items-center gap-2">
            <i class="far fa-calendar-alt"></i> Pembaruan Terakhir: Hari ini, {{ now()->format('H:i') }} WIB
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Aktif -->
        <div class="bg-blue-50/50 rounded-2xl p-5 border border-blue-100/50 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-blue-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-blue-500/30 shrink-0">
                <i class="far fa-clock"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-blue-600 uppercase tracking-wider mb-0.5">Asesmen Aktif</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-slate-800">{{ $totalAktif }}</span>
                </div>
                <p class="text-[11px] font-medium text-slate-500 mt-1 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> {{ $totalAktif }} tugas perlu diselesaikan
                </p>
            </div>
        </div>
        
        <!-- Selesai -->
        <div class="bg-emerald-50/50 rounded-2xl p-5 border border-emerald-100/50 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-emerald-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-emerald-500/30 shrink-0">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider mb-0.5">Asesmen Selesai</p>
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl font-extrabold text-slate-800">{{ $totalSelesai }}</span>
                </div>
                <p class="text-[11px] font-medium text-slate-500 mt-1 flex items-center gap-1.5">
                    <i class="fas fa-check-circle text-emerald-500"></i> Telah dinilai instruktur
                </p>
            </div>
        </div>
        
        <!-- Rata-rata -->
        <div class="bg-amber-50/50 rounded-2xl p-5 border border-amber-100/50 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl shadow-lg shadow-amber-500/30 shrink-0">
                <i class="fas fa-star"></i>
            </div>
            <div>
                <p class="text-[11px] font-bold text-amber-600 uppercase tracking-wider mb-0.5">Rata-Rata Nilai</p>
                <div class="flex items-baseline gap-1">
                    <span class="text-3xl font-extrabold text-slate-800">{{ $rataRata }}</span>
                    <span class="text-sm font-bold text-slate-400">/100</span>
                </div>
                <p class="text-[11px] font-medium text-slate-600 mt-1">
                    Predikat: <span class="font-bold text-amber-600">{{ $rataRata >= 85 ? 'A Sangat Memuaskan' : ($rataRata >= 70 ? 'B Memuaskan' : ($rataRata >= 60 ? 'C Cukup' : 'Kurang')) }}</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- List Header & Filters -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <div>
        <h3 class="text-xl font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-layer-group text-blue-500"></i> Daftar Asesmen
        </h3>
        <p class="text-xs text-slate-500 mt-1">Daftar evaluasi kompetensi, ujian praktikal coding, dan kuis portofolio.</p>
    </div>
    
    <div class="flex items-center bg-white rounded-xl p-1 border border-slate-200 shadow-sm shrink-0">
        <a href="?status=semua" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-colors {{ $statusFilter == 'semua' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50' }}">Semua ({{ $totalAktif + $totalSelesai }})</a>
        <a href="?status=aktif" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-colors {{ $statusFilter == 'aktif' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50' }}">Aktif ({{ $totalAktif }})</a>
        <a href="?status=selesai" class="px-4 py-1.5 text-xs font-bold rounded-lg transition-colors {{ $statusFilter == 'selesai' ? 'bg-blue-600 text-white shadow-sm' : 'text-slate-500 hover:bg-slate-50' }}">Selesai ({{ $totalSelesai }})</a>
    </div>
</div>

<!-- Assessment Cards -->
<div class="space-y-4">
    @forelse($asesmens as $asesmen)
        @php
            $isAktif = in_array($asesmen->status, ['pending', 'submitted']);
            $isSelesai = in_array($asesmen->status, ['reviewed', 'completed']);
            
            $bgLeft = 'bg-slate-400';
            $iconBg = 'bg-slate-100 text-slate-500';
            $icon = 'fa-file-alt';
            
            if ($asesmen->type == 'task') {
                $icon = 'fa-code';
                if ($isAktif) {
                    $bgLeft = 'bg-blue-500';
                    $iconBg = 'bg-blue-50 text-blue-600';
                } else {
                    $bgLeft = 'bg-emerald-500';
                    $iconBg = 'bg-emerald-50 text-emerald-600';
                }
            } else {
                $icon = 'fa-pen';
                if ($isAktif) {
                    $bgLeft = 'bg-amber-400';
                    $iconBg = 'bg-amber-50 text-amber-600';
                } else {
                    $bgLeft = 'bg-emerald-500';
                    $iconBg = 'bg-emerald-50 text-emerald-600';
                }
            }
        @endphp
        
        <div class="surface-card overflow-hidden flex relative group hover:border-slate-300 transition-colors">
            <div class="w-1.5 absolute inset-y-0 left-0 {{ $bgLeft }}"></div>
            
            <div class="p-5 pl-7 flex flex-col lg:flex-row gap-6 w-full items-start lg:items-center">
                <!-- Left info -->
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-12 h-12 rounded-xl {{ $iconBg }} flex items-center justify-center text-xl shrink-0 mt-1">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                            <h4 class="text-base font-bold text-slate-900">{{ $asesmen->title }}</h4>
                            @if($asesmen->score && $asesmen->score >= 90)
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-200 shadow-sm"><i class="fas fa-star mr-1"></i> Top Score</span>
                            @endif
                        </div>
                        
                        <div class="mb-2 flex items-center gap-2 flex-wrap">
                            @if($asesmen->type == 'quiz')
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500">Kuis</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500">Tugas</span>
                            @endif

                            @if($isSelesai)
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                    <i class="fas fa-check-circle"></i> Selesai
                                </span>
                            @elseif($asesmen->status == 'submitted')
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-50 text-purple-600 border border-purple-100">
                                    <i class="fas fa-paper-plane"></i> Menunggu Review
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> {{ $asesmen->type == 'quiz' ? 'Belum Dimulai' : 'Sedang Berlangsung' }}
                                </span>
                            @endif
                        </div>
                        
                        <p class="text-xs text-slate-500 leading-relaxed mb-3">{{ \Illuminate\Support\Str::limit($asesmen->description, 100) }}</p>
                        
                        <div class="flex flex-wrap items-center gap-4 text-[11px] font-medium text-slate-400">
                            <span class="flex items-center gap-1.5"><i class="far fa-calendar-alt"></i> {{ $asesmen->type == 'quiz' ? 'Jadwal Pelaksanaan' : 'Batas Waktu' }}: {{ \Carbon\Carbon::parse($asesmen->date)->format('d M Y') }}</span>
                            @if($asesmen->mentor)
                                <span class="flex items-center gap-1.5"><i class="far fa-user"></i> Reviewer: {{ $asesmen->mentor }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Right action/score -->
                <div class="flex items-center lg:justify-end gap-6 w-full lg:w-auto shrink-0 border-t lg:border-t-0 lg:border-l border-slate-100 pt-4 lg:pt-0 lg:pl-6">
                    @if($isSelesai)
                        <div class="text-center lg:text-right">
                            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider mb-1">Hasil Evaluasi</p>
                            <div class="flex items-baseline justify-center lg:justify-end gap-1">
                                <span class="text-2xl font-extrabold text-slate-800">{{ $asesmen->score ?? 0 }}</span>
                                <span class="text-xs font-bold text-slate-400">/100</span>
                            </div>
                            <p class="text-[10px] font-medium text-emerald-600 mt-0.5 flex items-center justify-center lg:justify-end gap-1"><i class="fas fa-check-circle"></i> Nilai Akhir</p>
                        </div>
                        <a href="{{ $asesmen->route }}" class="px-4 py-2 bg-white border-2 border-slate-200 hover:border-slate-800 text-slate-800 font-bold text-xs rounded-xl transition flex items-center justify-center gap-2">
                            Lihat Hasil <i class="fas fa-arrow-right"></i>
                        </a>
                    @else
                        <div class="text-center lg:text-right hidden sm:block">
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Jadwal Pelaksanaan</p>
                            <p class="text-sm font-bold text-slate-800">{{ \Carbon\Carbon::parse($asesmen->date)->format('d M Y') }}</p>
                        </div>
                        <a href="{{ $asesmen->route }}" class="px-4 py-2 bg-white border-2 border-slate-800 hover:bg-slate-800 hover:text-white text-slate-800 font-bold text-xs rounded-xl transition flex items-center justify-center gap-2">
                            {{ $asesmen->type == 'quiz' ? 'Mulai' : 'Lanjutkan' }} <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="surface-card p-10 text-center rounded-3xl border border-slate-200">
            <i class="fas fa-clipboard-check text-slate-300 text-4xl mb-3"></i>
            <p class="text-base font-bold text-slate-700">Tidak ada asesmen</p>
            <p class="text-xs text-slate-500 mt-1">Belum ada tugas atau ujian yang sesuai dengan filter Anda.</p>
        </div>
    @endforelse
</div>

<!-- Help Banner -->
<div class="bg-slate-900 rounded-2xl p-6 mt-8 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl relative overflow-hidden">
    <div class="absolute right-0 top-0 bottom-0 w-64 bg-gradient-to-l from-blue-900/40 to-transparent"></div>
    <div class="flex items-start gap-4 relative z-10">
        <div class="w-12 h-12 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center text-xl shrink-0 border border-blue-500/30">
            <i class="fas fa-question"></i>
        </div>
        <div>
            <h4 class="text-base font-bold text-white mb-1">Butuh Bantuan Mengenai Penilaian Asesmen?</h4>
            <p class="text-xs text-slate-400">Konsultasikan kendala teknis kode atau kuis Anda bersama tim mentor instruktur elcoding.id.</p>
        </div>
    </div>
    <div class="flex items-center gap-3 relative z-10 shrink-0 w-full md:w-auto">
        <a href="#" class="flex-1 md:flex-none px-4 py-2 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white font-bold text-xs rounded-xl transition text-center">
            Panduan Asesmen
        </a>
        <a href="#" class="flex-1 md:flex-none px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-bold text-xs rounded-xl transition flex items-center justify-center gap-2 shadow-lg shadow-blue-500/30 text-center">
            <i class="far fa-comment-dots"></i> Tanya Mentor
        </a>
    </div>
</div>
@endif

@endsection
