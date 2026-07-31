@extends('admin.layout')

@section('title', 'Dashboard - Admin Elcoding')
@section('header', 'Overview')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="surface-card p-6 flex flex-col relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full scale-150 z-0"></div>
        <div class="relative z-10 flex justify-between items-start mb-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Mitra</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $stats['mitra'] }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fas fa-handshake"></i>
            </div>
        </div>
        <div class="relative z-10 flex items-center gap-2 text-sm">
            <span class="text-green-500 font-semibold flex items-center gap-1"><i class="fas fa-arrow-up text-xs"></i> 12%</span>
            <span class="text-slate-500">dari bulan lalu</span>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="surface-card p-6 flex flex-col relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full scale-150 z-0"></div>
        <div class="relative z-10 flex justify-between items-start mb-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Program Kursus</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $stats['program'] }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fas fa-graduation-cap"></i>
            </div>
        </div>
        <div class="relative z-10 flex items-center gap-2 text-sm">
            <span class="text-slate-500">2 program terlaris</span>
        </div>
    </div>



    <!-- Stat Card 4 -->
    <div class="surface-card p-6 flex flex-col relative overflow-hidden group">
        <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full scale-150 z-0"></div>
        <div class="relative z-10 flex justify-between items-start mb-4">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Artikel</p>
                <h3 class="text-3xl font-extrabold text-slate-800">{{ $stats['artikel'] }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl shadow-inner">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        <div class="relative z-10 flex items-center gap-2 text-sm">
            <span class="text-slate-500">Diperbarui 2 hari lalu</span>
        </div>
    </div>
</div>

<!-- Charts & Main Area -->
<div class="space-y-8">
    <!-- Left Col (Main content) -->
    <div class="space-y-8">
        <!-- Quick Actions Banner -->
        <div class="surface-card p-8 bg-gradient-to-br from-indigo-900 via-blue-900 to-slate-900 border-none relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-white">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang di Command Center! 🚀</h3>
                    <p class="text-blue-100 text-sm max-w-lg leading-relaxed">
                        Kelola seluruh aset digital Elcoding dari satu tempat. Anda dapat menambahkan portofolio baru, menyesuaikan program kursus, dan memperbarui berita terbaru dengan cepat.
                    </p>
                </div>
                <div class="flex gap-3 shrink-0">
                    <a href="/admin/artikel" class="px-5 py-2.5 bg-indigo-800/50 text-white font-bold rounded-lg border border-indigo-400/30 hover:bg-indigo-800 transition-colors backdrop-blur-sm">
                        Tulis Artikel
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="surface-card">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-slate-800">Aktivitas Terbaru</h3>
                <a href="{{ url('admin/aktivitas') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Lihat Semua</a>
            </div>
            <div class="p-0">
                <div class="divide-y divide-slate-100">
                    @forelse($activities as $activity)
                    <!-- Activity item -->
                    <div class="p-4 px-6 flex items-start gap-4 hover:bg-slate-50 transition-colors">
                        <div class="w-10 h-10 rounded-full bg-{{ $activity->color }}-100 text-{{ $activity->color }}-600 flex items-center justify-center shrink-0">
                            <i class="fas {{ $activity->icon }}"></i>
                        </div>
                        <div>
                            <p class="text-sm text-slate-800 font-medium">
                                {{ $activity->type }} <span class="font-bold text-blue-600">"{{ Str::limit($activity->title, 40) }}"</span>
                                @if($activity->created_at->diffInSeconds($activity->updated_at) < 5)
                                    berhasil ditambahkan.
                                @else
                                    berhasil diperbarui.
                                @endif
                            </p>
                            <p class="text-xs text-slate-400 mt-1">{{ $activity->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-slate-500 text-sm">
                        Belum ada aktivitas terbaru.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
