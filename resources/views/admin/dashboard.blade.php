@extends('admin.layout')

@section('title', 'Dashboard - Admin Elcoding')
@section('header', 'Overview')

@section('content')

<!-- Dashboard Sales Grid -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    
    <!-- LEFT COLUMN -->
    <div class="space-y-6">
        <!-- 6 Metrics FlatCard (Row-Table style) -->
        <div class="surface-card overflow-hidden shadow-sm border border-slate-100">
            <div class="grid grid-cols-2 md:grid-cols-3 divide-y divide-x divide-slate-100">
                
                <!-- Card 1: Total Pengunjung -->
                <div class="p-6 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <i class="fas fa-users text-blue-600 text-[32px] opacity-90"></i>
                    <div>
                        <h5 class="text-[22px] font-extrabold text-slate-800 m-0">{{ number_format($stats['visitors'], 0, ',', '.') }}</h5>
                        <span class="text-[12px] text-slate-500 font-semibold tracking-wide">Total Pengunjung</span>
                    </div>
                </div>

                <!-- Card 2: Transaksi -->
                <div class="p-6 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <i class="fas fa-shopping-cart text-blue-600 text-[32px] opacity-90"></i>
                    <div>
                        <h5 class="text-[22px] font-extrabold text-slate-800 m-0">{{ number_format($stats['orders_paid'], 0, ',', '.') }}</h5>
                        <span class="text-[12px] text-slate-500 font-semibold tracking-wide">Transaksi</span>
                    </div>
                </div>

                <!-- Card 3: Program Kursus -->
                <div class="p-6 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <i class="fas fa-graduation-cap text-blue-600 text-[32px] opacity-90"></i>
                    <div>
                        <h5 class="text-[22px] font-extrabold text-slate-800 m-0">{{ $stats['program'] }}</h5>
                        <span class="text-[12px] text-slate-500 font-semibold tracking-wide">Program Kursus</span>
                    </div>
                </div>

                <!-- Card 4: Blog -->
                <div class="p-6 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <i class="fas fa-newspaper text-blue-600 text-[32px] opacity-90"></i>
                    <div>
                        <h5 class="text-[22px] font-extrabold text-slate-800 m-0">{{ $stats['artikel'] }}</h5>
                        <span class="text-[12px] text-slate-500 font-semibold tracking-wide">Blog</span>
                    </div>
                </div>

                <!-- Card 5: Layanan -->
                <div class="p-6 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <i class="fas fa-server text-blue-600 text-[32px] opacity-90"></i>
                    <div>
                        <h5 class="text-[22px] font-extrabold text-slate-800 m-0">{{ $stats['layanan'] }}</h5>
                        <span class="text-[12px] text-slate-500 font-semibold tracking-wide">Layanan</span>
                    </div>
                </div>

                <!-- Card 6: Event & Webinar -->
                <div class="p-6 flex items-center gap-4 hover:bg-slate-50 transition-colors">
                    <i class="fas fa-calendar-alt text-blue-600 text-[32px] opacity-90"></i>
                    <div>
                        <h5 class="text-[22px] font-extrabold text-slate-800 m-0">{{ $stats['event'] }}</h5>
                        <span class="text-[12px] text-slate-500 font-semibold tracking-wide">Event & Webinar</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Log Aktivitas Terbaru (Support-bar Style) -->
            <div class="surface-card overflow-hidden flex flex-col h-[320px] shadow-sm border border-slate-100">
                <div class="p-5 pb-0 flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-extrabold text-slate-800 m-0">{{ count($activities) }}</h2>
                        <span class="text-blue-600 font-bold text-[13px]">Log Aktivitas Terbaru</span>
                        <p class="text-[12px] text-slate-500 mt-2 mb-4">Aktivitas admin terbaru di sistem.</p>
                    </div>
                </div>
                <div class="px-5 flex-1 overflow-y-auto custom-scrollbar">
                    <div class="relative border-l-2 border-slate-100 ml-2 space-y-5 pb-4">
                        @forelse($activities as $activity)
                        <div class="relative pl-5 group">
                            <div class="absolute -left-[9px] top-1 w-4 h-4 rounded-full bg-white border-[3px] border-{{ $activity->color }}-400 z-10"></div>
                            <div>
                                <h6 class="font-bold text-slate-700 text-[13px] mb-0.5">{{ $activity->type }}</h6>
                                <p class="text-[11px] text-slate-500 line-clamp-2 leading-relaxed mb-1">{{ $activity->description }}</p>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $activity->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @empty
                        <div class="pl-5 text-xs text-slate-500">Belum ada aktivitas.</div>
                        @endforelse
                    </div>
                </div>
                <div class="bg-blue-600 p-3 text-center cursor-pointer hover:bg-blue-700 transition-colors">
                    <a href="{{ url('admin/aktivitas') }}" class="text-white text-xs font-bold uppercase tracking-widest block w-full">Lihat Semua Log</a>
                </div>
            </div>

            <!-- Customer Satisfaction (Pie Chart Style) -->
            <div class="surface-card overflow-hidden h-[320px] shadow-sm border border-slate-100 flex flex-col">
                <div class="p-5 pb-2">
                    <h5 class="font-bold text-slate-800 m-0 text-[15px]">Customer Satisfaction</h5>
                    <p class="text-[12px] text-slate-500 mt-1">Metrik kepuasan berdasarkan rasio segmen pelanggan dari analisis RFM.</p>
                </div>
                <div class="flex-1 p-5 flex items-center justify-center relative min-h-0">
                    <canvas id="satisfactionChart" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="space-y-6">
        <!-- Statistik Pengunjung (Dept wise monthly style) -->
        <div class="surface-card overflow-hidden h-full flex flex-col shadow-sm border border-slate-100">
            <div class="p-5 border-b border-slate-100">
                <h5 class="font-bold text-slate-800 text-[15px] m-0">Statistik Pengunjung (Minggu Ini)</h5>
            </div>
            <div class="p-6 pb-0 flex items-center gap-8">
                <div>
                    <h3 class="text-2xl font-extrabold text-slate-800 mb-0.5">{{ number_format(array_sum($visitorData ?? []), 0, ',', '.') }}</h3>
                    <span class="text-[12px] font-semibold text-slate-500">Total Pengunjung</span>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-slate-800 mb-0.5">{{ number_format(array_sum($visitorData ?? []) / 7, 0, ',', '.') }}</h3>
                    <span class="text-[12px] font-semibold text-slate-500">Rata-rata Harian</span>
                </div>
            </div>
            <div class="flex-1 p-5 min-h-[300px]">
                <canvas id="visitorChart" style="width: 100%; height: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- BOTTOM AREA: RFM Table (Product Table Style) -->
<div class="surface-card overflow-hidden mt-6 shadow-sm border border-slate-100 mb-8">
    <div class="p-5 border-b border-slate-100 bg-white">
        <h5 class="font-bold text-slate-800 text-[15px] m-0">Detail Pelanggan (Skoring RFM)</h5>
        <p class="text-[12px] text-slate-500 mt-1">Sistem RFM Customer Intelligence</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap modern-table">
            <thead class="bg-slate-50/50 text-slate-500 font-semibold border-b border-slate-200">
                <tr>
                    <th class="py-4 px-6 text-[11px] uppercase tracking-wider font-bold">Pelanggan</th>
                    <th class="py-4 px-6 text-center text-[11px] uppercase tracking-wider font-bold">Recency (Hari)</th>
                    <th class="py-4 px-6 text-center text-[11px] uppercase tracking-wider font-bold">Frequency (Trx)</th>
                    <th class="py-4 px-6 text-center text-[11px] uppercase tracking-wider font-bold">Monetary (Rp)</th>
                    <th class="py-4 px-6 text-center text-[11px] uppercase tracking-wider font-bold">Skor (R-F-M)</th>
                    <th class="py-4 px-6 text-center text-[11px] uppercase tracking-wider font-bold">Segmen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse($rfmData as $customer)
                    @php
                        $segmentColor = match($customer['segment']) {
                            'Customer Baru' => 'bg-blue-50 text-blue-600',
                            'Loyal' => 'bg-emerald-50 text-emerald-600',
                            'Berisiko' => 'bg-amber-50 text-amber-600',
                            'Pasif / Lama' => 'bg-red-50 text-red-600',
                            default => 'bg-slate-50 text-slate-600'
                        };
                    @endphp
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-md bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-sm">
                                    {{ substr($customer['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-700 text-[14px]">{{ $customer['name'] }}</div>
                                    <div class="text-[12px] text-slate-400">{{ $customer['email'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="font-semibold text-slate-700">{{ $customer['recency_days'] }}</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="font-semibold text-slate-700">{{ $customer['frequency'] }}</span>
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-slate-700">
                            {{ number_format($customer['monetary'], 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-6 text-center font-bold text-[14px] tracking-widest">
                            <span class="text-slate-700">{{ $customer['r_score'] }}{{ $customer['f_score'] }}{{ $customer['m_score'] }}</span>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="px-3 py-1.5 rounded-md text-[11px] font-bold {{ $segmentColor }}">
                                {{ $customer['segment'] }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-500">Belum ada data pelanggan yang menyelesaikan pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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

    const pieCtx = document.getElementById('satisfactionChart');
    if (pieCtx) {
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($segmentCounts)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($segmentCounts)) !!},
                    backgroundColor: [
                        '#6366f1', // indigo-500
                        '#8b5cf6', // violet-500
                        '#a855f7', // purple-500
                        '#d946ef', // fuchsia-500
                        '#94a3b8'  // slate-400
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                            color: '#64748b'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif" },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif" },
                        cornerRadius: 8,
                    }
                }
            }
        });
    }
});
</script>
@endsection
