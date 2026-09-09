@extends('pkl.layout')

@section('title', 'Progress Belajar & Nilai Quiz - elc.my.id')

@section('content')
<div class="space-y-8">
    
    <div>
        <h1 class="text-2xl font-extrabold text-white">Progress Belajar & Nilai Quiz</h1>
        <p class="text-slate-400 text-sm mt-1">Pantau pencapaian belajar dan rekapitulasi nilai ujian evaluasi Anda</p>
    </div>

    <!-- Progress Meter Banner -->
    <div class="bg-gradient-to-r from-blue-900/60 to-slate-800/80 border border-blue-500/30 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <span class="text-xs font-semibold text-blue-400 uppercase tracking-wider">Metrik Capaian Pembelajaran</span>
                <h2 class="text-3xl font-black text-white mt-1">{{ $profile->progress_percentage }}% <span class="text-sm font-normal text-slate-400">Tuntas</span></h2>
                <p class="text-xs text-slate-300 mt-1">Diukur dari rasio penyelesaian tugas dan modul magang.</p>
            </div>
            
            <div class="w-full sm:w-64 bg-slate-900/80 p-4 rounded-2xl border border-slate-700/60 text-center">
                <div class="text-xs text-slate-400 mb-1">Rata-Rata Nilai Evaluasi</div>
                <div class="text-3xl font-black text-amber-400">
                    {{ $quizzes->count() > 0 ? round($quizzes->avg('score'), 1) : 0 }} <span class="text-xs text-slate-400 font-normal">/ 100</span>
                </div>
                <div class="text-[11px] text-slate-500 mt-1">{{ $quizzes->count() }} Quiz Diikuti</div>
            </div>
        </div>

        <div class="w-full bg-slate-700 h-3 rounded-full overflow-hidden mt-6">
            <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-emerald-400 h-full rounded-full transition-all duration-700" style="width: {{ $profile->progress_percentage }}%"></div>
        </div>
    </div>

    <!-- Quiz & Evaluasi Table -->
    <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-xl">
        <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
            <i class="fas fa-award text-amber-400"></i> Rekapitulasi Nilai Quiz & Evaluasi
        </h3>

        @if($quizzes->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-700 text-slate-400 font-semibold uppercase tracking-wider">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Materi / Modul Quiz</th>
                            <th class="py-3 px-4">Tanggal Ujian</th>
                            <th class="py-3 px-4 text-center">Nilai / Skor</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Catatan Mentor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50 text-slate-200">
                        @foreach($quizzes as $index => $quiz)
                            <tr class="hover:bg-slate-700/30 transition">
                                <td class="py-3.5 px-4 font-bold">{{ $index + 1 }}</td>
                                <td class="py-3.5 px-4 font-semibold text-white">{{ $quiz->title }}</td>
                                <td class="py-3.5 px-4 text-slate-400">{{ $quiz->quiz_date ? $quiz->quiz_date->format('d M Y') : '-' }}</td>
                                <td class="py-3.5 px-4 text-center">
                                    <span class="text-sm font-black text-amber-400 bg-amber-500/10 px-3 py-1 rounded-xl border border-amber-500/20">
                                        {{ $quiz->score }} / {{ $quiz->max_score }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    @if($quiz->score >= 70)
                                        <span class="px-2.5 py-0.5 bg-emerald-500/10 text-emerald-400 font-bold rounded-md border border-emerald-500/20">
                                            LULUS
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 bg-red-500/10 text-red-400 font-bold rounded-md border border-red-500/20">
                                            REMIDIAL
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-slate-400 italic">{{ $quiz->notes ?: '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-slate-900/40 p-8 text-center rounded-2xl border border-slate-700/50">
                <i class="fas fa-clipboard-list text-slate-500 text-3xl mb-2"></i>
                <p class="text-sm font-semibold text-white">Belum Ada Catatan Nilai Quiz</p>
                <p class="text-xs text-slate-400 mt-1">Nilai quiz yang telah diikuti akan dicatat oleh mentor di sini.</p>
            </div>
        @endif
    </div>
</div>
@endsection
