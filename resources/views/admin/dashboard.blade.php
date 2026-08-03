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
        <div class="surface-card p-10 bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 border-none relative overflow-hidden shadow-2xl">
            <!-- Animated Mesh Background -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500 rounded-full mix-blend-screen filter blur-[100px] opacity-40 animate-pulse"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-purple-500 rounded-full mix-blend-screen filter blur-[100px] opacity-40 animate-pulse" style="animation-delay: 2s;"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="text-white">
                    @php
                        $hour = \Carbon\Carbon::now('Asia/Jakarta')->format('H');
                        $greeting = 'Selamat Malam';
                        if ($hour >= 5 && $hour < 11) $greeting = 'Selamat Pagi';
                        elseif ($hour >= 11 && $hour < 15) $greeting = 'Selamat Siang';
                        elseif ($hour >= 15 && $hour < 18) $greeting = 'Selamat Sore';
                    @endphp
                    <h3 class="text-3xl font-extrabold mb-3 tracking-tight">{{ $greeting }}, Admin! 👋</h3>
                    <p class="text-blue-100/80 text-base max-w-xl leading-relaxed">
                        Selamat datang di Command Center. Kelola seluruh aset digital Elcoding dari satu tempat dengan mudah dan cepat.
                    </p>
                </div>
                <div class="flex gap-4 shrink-0">
                    <a href="/admin/artikel/create" class="px-6 py-3 bg-white/10 text-white font-bold rounded-xl border border-white/20 hover:bg-white/20 hover:scale-105 transition-all backdrop-blur-md shadow-lg flex items-center gap-2">
                        <i class="fas fa-pen-nib"></i> Tulis Artikel
                    </a>
                </div>
            </div>
        </div>

        <!-- Bottom Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Chart Section -->
            <div class="lg:col-span-2">
                <div class="surface-card p-0 h-full flex flex-col">
                    <div class="p-6 px-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 rounded-t-[20px]">
                        <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                            <i class="fas fa-chart-area text-blue-500"></i> Statistik Pengunjung (Minggu Ini)
                        </h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-center">
                        <canvas id="visitorChart" style="width: 100%; max-height: 350px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent Activities Timeline -->
            <div class="surface-card p-0 lg:col-span-1 h-fit">
            <div class="p-6 px-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50 rounded-t-20">
                <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                    <i class="fas fa-history text-blue-500"></i> Log Aktivitas Terbaru
                </h3>
                <a href="{{ url('admin/aktivitas') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700 hover:underline">Lihat Semua</a>
            </div>
            <div class="p-8">
                <div class="relative border-l-2 border-slate-100 ml-4 space-y-8">
                    @forelse($activities as $activity)
                    <!-- Timeline item -->
                    <div class="relative pl-8 group">
                        <!-- Connector Dot -->
                        <div class="absolute -left-[17px] top-1 w-8 h-8 rounded-full bg-white border-2 border-slate-100 flex items-center justify-center group-hover:border-{{ $activity->color }}-400 transition-colors shadow-sm">
                            <div class="w-2.5 h-2.5 rounded-full bg-{{ $activity->color }}-500 group-hover:scale-125 transition-transform"></div>
                        </div>
                        
                        <div class="bg-white border border-slate-100 p-5 rounded-2xl shadow-sm group-hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between gap-4 mb-2">
                                <h4 class="font-bold text-slate-800 text-base">
                                    {{ $activity->type }} <span class="text-blue-600">"{{ Str::limit($activity->title, 50) }}"</span>
                                </h4>
                                <span class="text-xs font-semibold text-slate-400 bg-slate-50 px-2.5 py-1 rounded-md shrink-0 border border-slate-100">
                                    {{ $activity->updated_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-500">
                                {{ $activity->description }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="pl-8 text-slate-500 text-sm">
                        Belum ada log aktivitas.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Initialization Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('visitorChart');
    if (ctx) {
        // Gradient for chart area
        const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.2)'); // blue-500
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($visitorLabels ?? []) !!},
                datasets: [{
                    label: 'Pengunjung Aktif',
                    data: {!! json_encode($visitorData ?? []) !!},
                    borderColor: '#3b82f6', // blue-500
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4 // Smooth curves
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { size: 13, family: "'Plus Jakarta Sans', sans-serif" },
                        bodyFont: { size: 14, weight: 'bold', family: "'Plus Jakarta Sans', sans-serif" },
                        displayColors: false,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9',
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#64748b',
                            font: { family: "'Plus Jakarta Sans', sans-serif" }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            color: '#64748b',
                            font: { family: "'Plus Jakarta Sans', sans-serif" }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    }
});
</script>
@endsection
