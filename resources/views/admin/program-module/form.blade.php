@extends('admin.layout')

@section('title', isset($module) ? 'Edit Modul' : 'Tambah Modul')
@section('header', 'Modul Kurikulum')

@section('content')
<div class="surface-card p-6 w-full max-w-4xl mx-auto">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.program.modules.index', $program->id) }}" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-colors">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <h3 class="text-xl font-bold text-slate-800">{{ isset($module) ? 'Edit Modul' : 'Tambah Modul Baru' }}</h3>
            <p class="text-sm text-slate-500">Program: {{ $program->title }}</p>
        </div>
    </div>

    <form action="{{ isset($module) ? route('admin.program.modules.update', [$program->id, $module->id]) : route('admin.program.modules.store', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($module)) @method('PUT') @endif
        
        <div class="space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Judul Modul *</label>
                    <input type="text" name="title" value="{{ old('title', $module->title ?? '') }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required placeholder="Contoh: Materi 1: Pendahuluan">
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Modul *</label>
                        <select name="type" id="moduleType" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required onchange="toggleFields()">
                            <option value="materi" {{ (old('type', $module->type ?? '') == 'materi') ? 'selected' : '' }}>Materi Teks/PDF</option>
                            <option value="video" {{ (old('type', $module->type ?? '') == 'video') ? 'selected' : '' }}>Video</option>
                            <option value="tugas" {{ (old('type', $module->type ?? '') == 'tugas') ? 'selected' : '' }}>Tugas</option>
                            <option value="quiz" {{ (old('type', $module->type ?? '') == 'quiz') ? 'selected' : '' }}>Kuis</option>
                            <option value="project" {{ (old('type', $module->type ?? '') == 'project') ? 'selected' : '' }}>Final Project</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Urutan *</label>
                        <input type="number" name="order_index" value="{{ old('order_index', $module->order_index ?? '') }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" placeholder="Otomatis" min="1">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" rows="2" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" placeholder="Deskripsi atau instruksi singkat mengenai modul ini...">{{ old('description', $module->description ?? '') }}</textarea>
            </div>

            <div id="fieldContent">
                <label class="block text-sm font-medium text-slate-700 mb-1">Konten Lengkap / Instruksi Tugas</label>
                <textarea name="content" rows="6" class="rich-text w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">{{ old('content', $module->content ?? '') }}</textarea>
            </div>

            <div id="fieldVideo" style="display: none;">
                <label class="block text-sm font-medium text-slate-700 mb-1">URL Video (Youtube / Lainnya)</label>
                <input type="url" name="video_url" value="{{ old('video_url', $module->video_url ?? '') }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" placeholder="https://www.youtube.com/watch?v=...">
            </div>

            <div id="fieldFile">
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload File (PDF / Gambar / Zip)</label>
                @if(isset($module) && $module->file_path)
                    <div class="mb-2 text-sm text-blue-600">
                        <i class="fas fa-file-alt mr-1"></i> <a href="{{ asset($module->file_path) }}" target="_blank" class="hover:underline">Lihat File Tersimpan</a>
                    </div>
                @endif
                <input type="file" name="file_path" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                <p class="text-xs text-slate-400 mt-1">Kosongkan jika tidak ingin upload file atau tidak ingin mengubah file lama.</p>
            </div>
            
            <div id="quizNotice" style="display: none;" class="p-4 bg-amber-50 rounded-xl border border-amber-200 text-amber-800 text-sm">
                <i class="fas fa-info-circle mr-1"></i>
                Untuk Modul Kuis, Anda dapat menambahkan daftar pertanyaan (Pilihan Ganda / Essay) setelah menyimpan informasi dasar kuis ini.
            </div>

        </div>

        <div class="mt-8 pt-5 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ route('admin.program.modules.index', $program->id) }}" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</a>
            <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md">Simpan Modul</button>
        </div>
    </form>
</div>

<script>
    function toggleFields() {
        const type = document.getElementById('moduleType').value;
        const fieldContent = document.getElementById('fieldContent');
        const fieldVideo = document.getElementById('fieldVideo');
        const fieldFile = document.getElementById('fieldFile');
        const quizNotice = document.getElementById('quizNotice');

        // Reset display
        fieldContent.style.display = 'block';
        fieldVideo.style.display = 'none';
        fieldFile.style.display = 'block';
        quizNotice.style.display = 'none';

        if (type === 'video') {
            fieldVideo.style.display = 'block';
        } else if (type === 'quiz') {
            quizNotice.style.display = 'block';
            fieldFile.style.display = 'none';
        }
    }

    // Run on load
    document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection
