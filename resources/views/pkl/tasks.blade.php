@extends('pkl.layout')

@section('title', 'Tugas Magang Saya - elc.my.id')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Daftar Tugas Magang</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola dan kumpulkan seluruh tugas yang diberikan oleh mentor pembimbing Anda</p>
        </div>
    </div>

    @if($tasks->count() > 0)
        <div class="space-y-4">
            @foreach($tasks as $task)
                <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-xl transition hover:border-blue-500/30">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        <div class="space-y-2 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                @if($task->status === 'completed' || $task->status === 'reviewed')
                                    <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full">
                                        <i class="fas fa-check-circle mr-1"></i> Dinilai
                                    </span>
                                @elseif($task->status === 'submitted')
                                    <span class="px-3 py-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs font-bold rounded-full">
                                        <i class="fas fa-paper-plane mr-1"></i> Terkirim (Menunggu Review)
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full">
                                        <i class="fas fa-clock mr-1"></i> Belum Dikerjakan
                                    </span>
                                @endif

                                @if($task->grade !== null)
                                    <span class="px-3 py-1 bg-purple-500/10 text-purple-300 border border-purple-500/20 text-xs font-extrabold rounded-full">
                                        Nilai: {{ $task->grade }} / 100
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-white">{{ $task->title }}</h3>
                            <p class="text-slate-300 text-sm leading-relaxed">{{ $task->description ?: 'Tidak ada instruksi khusus.' }}</p>

                            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-400 pt-2">
                                <span><i class="fas fa-calendar-alt text-blue-400 mr-1"></i> Tenggat: {{ $task->due_date ? $task->due_date->format('d M Y') : 'Tanpa Tenggat' }}</span>
                                @if($task->submitted_at)
                                    <span><i class="fas fa-history text-indigo-400 mr-1"></i> Dikirim: {{ $task->submitted_at->format('d M Y H:i') }}</span>
                                @endif
                            </div>

                            @if($task->feedback)
                                <div class="mt-3 bg-purple-950/40 p-3.5 rounded-2xl border border-purple-500/30 text-xs text-purple-200">
                                    <strong class="block font-bold text-purple-300 mb-1"><i class="fas fa-comment-dots mr-1"></i> Catatan/Feedback Mentor:</strong>
                                    {{ $task->feedback }}
                                </div>
                            @endif

                            @if($task->submission_url || $task->submission_notes || $task->submission_file)
                                <div class="mt-3 bg-slate-900/60 p-3.5 rounded-2xl border border-slate-700/50 text-xs space-y-1">
                                    <strong class="block text-slate-400 font-semibold mb-1">Pengumpulan Anda:</strong>
                                    @if($task->submission_url)
                                        <p><i class="fas fa-link text-blue-400 mr-1"></i> URL: <a href="{{ $task->submission_url }}" target="_blank" class="text-blue-400 underline">{{ $task->submission_url }}</a></p>
                                    @endif
                                    @if($task->submission_file)
                                        <p><i class="fas fa-file-alt text-indigo-400 mr-1"></i> File: <a href="{{ asset('storage/' . $task->submission_file) }}" target="_blank" class="text-indigo-400 underline">Unduh/Lihat File Pengumpulan</a></p>
                                    @endif
                                    @if($task->submission_notes)
                                        <p class="text-slate-300 italic"><i class="fas fa-sticky-note text-amber-400 mr-1"></i> "{{ $task->submission_notes }}"</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Submission Action Form / Modal Toggle -->
                        <div class="shrink-0 w-full md:w-auto">
                            <button onclick="document.getElementById('modal-task-{{ $task->id }}').classList.remove('hidden')"
                                    class="w-full md:w-auto px-5 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-2xl transition shadow-lg flex items-center justify-center gap-2">
                                <i class="fas fa-paper-plane"></i> {{ $task->submitted_at ? 'Kumpul Ulang / Update' : 'Kumpulkan Tugas' }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal Submit Task -->
                <div id="modal-task-{{ $task->id }}" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
                    <div class="bg-slate-800 border border-slate-700 rounded-3xl p-6 max-w-lg w-full shadow-2xl relative">
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-4">
                            <h3 class="text-base font-bold text-white">Form Pengumpulan Tugas</h3>
                            <button onclick="document.getElementById('modal-task-{{ $task->id }}').classList.add('hidden')" class="text-slate-400 hover:text-white">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form action="{{ route('pkl.tasks.submit', $task->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Judul Tugas</label>
                                <input type="text" value="{{ $task->title }}" disabled class="w-full bg-slate-900/40 border border-slate-800 rounded-xl px-3 py-2 text-xs text-slate-400">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Link Tugas (GitHub / Google Drive / Figma / Demo)</label>
                                <input type="url" name="submission_url" value="{{ old('submission_url', $task->submission_url) }}"
                                       class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                                       placeholder="https://github.com/..." >
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Upload File Dokumen / Lampiran (PDF, ZIP, DOC, PNG)</label>
                                <input type="file" name="submission_file"
                                       class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-xs text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-500">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Catatan / Pesan Pengumpulan</label>
                                <textarea name="submission_notes" rows="3"
                                          class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                                          placeholder="Tuliskan catatan pengerjaan tugas bila ada...">{{ old('submission_notes', $task->submission_notes) }}</textarea>
                            </div>

                            <div class="pt-3 flex items-center justify-end gap-3 border-t border-slate-700">
                                <button type="button" onclick="document.getElementById('modal-task-{{ $task->id }}').classList.add('hidden')"
                                        class="px-4 py-2 bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl hover:bg-slate-600">
                                    Batal
                                </button>
                                <button type="submit" class="px-5 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl hover:bg-blue-500 shadow-md">
                                    Kirim Tugas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-slate-800/40 border border-slate-700/50 rounded-3xl p-12 text-center">
            <div class="w-16 h-16 bg-blue-500/10 text-blue-400 rounded-3xl flex items-center justify-center mx-auto text-2xl mb-4">
                <i class="fas fa-tasks"></i>
            </div>
            <h3 class="text-lg font-bold text-white">Belum Ada Tugas Diberikan</h3>
            <p class="text-slate-400 text-sm mt-1 max-w-md mx-auto">
                Tugas yang ditugaskan oleh mentor pembimbing Anda akan muncul di halaman ini.
            </p>
        </div>
    @endif
</div>
@endsection
