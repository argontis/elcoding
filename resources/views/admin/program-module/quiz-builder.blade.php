@extends('admin.layout')

@section('title', 'Kelola Soal Kuis - ' . $module->title)
@section('header', 'Quiz Builder')

@section('content')
<div class="space-y-6">
    <div class="surface-card p-6">
        <div class="flex items-center gap-4 mb-2">
            <a href="{{ route('admin.program.modules.index', $program->id) }}" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h3 class="text-xl font-bold text-slate-800">Quiz: {{ $module->title }}</h3>
                <p class="text-sm text-slate-500">Program: {{ $program->title }}</p>
            </div>
        </div>
        @if($module->description)
            <p class="text-slate-600 ml-14">{{ $module->description }}</p>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Add Question Form -->
        <div class="lg:col-span-1">
            <div class="surface-card p-6 sticky top-24">
                <h4 class="font-bold text-slate-800 mb-4 border-b border-slate-100 pb-2">Tambah Soal Baru</h4>
                
                <form action="{{ route('admin.program.modules.quiz.store', [$program->id, $module->id]) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Soal</label>
                        <select name="type" id="questionType" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required onchange="toggleQuestionFields()">
                            <option value="multiple_choice">Pilihan Ganda</option>
                            <option value="essay">Essay</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Pertanyaan</label>
                        <textarea name="question_text" rows="4" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required placeholder="Tuliskan pertanyaan di sini..."></textarea>
                    </div>

                    <div id="multipleChoiceFields" class="space-y-3 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <label class="block text-sm font-bold text-slate-700">Opsi Jawaban</label>
                        
                        @foreach(['A', 'B', 'C', 'D', 'E'] as $opt)
                        <div class="flex items-center gap-2">
                            <span class="w-8 h-8 rounded shrink-0 bg-white border border-slate-200 flex items-center justify-center font-bold text-slate-500">{{ $opt }}</span>
                            <input type="text" name="option_{{ $opt }}" class="w-full px-3 py-1.5 border border-slate-200 rounded focus:outline-none focus:ring-2 focus:ring-blue-500/50" placeholder="Pilihan {{ $opt }}">
                        </div>
                        @endforeach

                        <div class="pt-3 border-t border-slate-200 mt-2">
                            <label class="block text-sm font-bold text-slate-700 mb-1">Jawaban Benar</label>
                            <select name="correct_answer" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/50 text-emerald-700 font-bold bg-emerald-50">
                                <option value="A">Opsi A</option>
                                <option value="B">Opsi B</option>
                                <option value="C">Opsi C</option>
                                <option value="D">Opsi D</option>
                                <option value="E">Opsi E</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Bobot Nilai (Score)</label>
                        <input type="number" name="score_weight" value="10" min="1" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
                    </div>

                    <button type="submit" class="w-full btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md">
                        <i class="fas fa-save"></i> Simpan Soal
                    </button>
                </form>
            </div>
        </div>

        <!-- Question List -->
        <div class="lg:col-span-2">
            <div class="surface-card p-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-4">
                    <h4 class="font-bold text-slate-800">Daftar Pertanyaan ({{ $module->questions->count() }})</h4>
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-sm font-bold">
                        Total Poin: {{ $module->questions->sum('score_weight') }}
                    </span>
                </div>

                @if($module->questions->isEmpty())
                    <div class="text-center py-10">
                        <i class="fas fa-question text-4xl text-slate-300 mb-3"></i>
                        <p class="text-slate-500">Belum ada pertanyaan pada kuis ini.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($module->questions as $index => $q)
                        <div class="bg-white border border-slate-200 rounded-xl p-5 hover:border-blue-300 transition-colors shadow-sm relative group">
                            
                            <form action="{{ route('admin.program.modules.quiz.destroy', [$program->id, $module->id, $q->id]) }}" method="POST" class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus soal ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>

                            <div class="flex gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider {{ $q->type === 'multiple_choice' ? 'bg-indigo-50 text-indigo-600' : 'bg-fuchsia-50 text-fuchsia-600' }}">
                                            {{ str_replace('_', ' ', $q->type) }}
                                        </span>
                                        <span class="text-xs font-bold text-slate-400">{{ $q->score_weight }} Poin</span>
                                    </div>
                                    <p class="text-slate-800 font-medium whitespace-pre-wrap">{{ $q->question_text }}</p>
                                    
                                    @if($q->type === 'multiple_choice' && is_array($q->options))
                                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach($q->options as $key => $val)
                                                <div class="flex items-start gap-2 p-2 rounded-lg border {{ $q->correct_answer === $key ? 'border-emerald-500 bg-emerald-50' : 'border-slate-100 bg-slate-50' }}">
                                                    <span class="w-5 h-5 shrink-0 rounded-full flex items-center justify-center text-[10px] font-bold {{ $q->correct_answer === $key ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-600' }}">{{ $key }}</span>
                                                    <span class="text-sm text-slate-700">{{ $val }}</span>
                                                    @if($q->correct_answer === $key)
                                                        <i class="fas fa-check-circle text-emerald-500 ml-auto mt-0.5"></i>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function toggleQuestionFields() {
        const type = document.getElementById('questionType').value;
        const mcFields = document.getElementById('multipleChoiceFields');
        
        if (type === 'multiple_choice') {
            mcFields.style.display = 'block';
        } else {
            mcFields.style.display = 'none';
        }
    }
</script>
@endsection
