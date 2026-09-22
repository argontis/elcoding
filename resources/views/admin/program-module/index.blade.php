@extends('admin.layout')

@section('title', 'Kelola Modul - ' . $program->title)
@section('header', 'Kurikulum Program Kursus')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Kurikulum: {{ $program->title }}</h3>
            <p class="text-sm text-slate-500 mt-1">Kelola urutan materi, tugas, dan kuis untuk program kursus ini.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ url('admin/program-kursus') }}" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.program.modules.create', $program->id) }}" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Modul
            </a>
        </div>
    </div>
    
    <div class="p-6">
        @if($modules->isEmpty())
            <div class="text-center py-10">
                <i class="fas fa-book-open text-5xl text-slate-300 mb-4"></i>
                <h4 class="text-lg font-bold text-slate-600">Belum Ada Modul</h4>
                <p class="text-slate-400 text-sm mt-1">Silakan tambahkan modul pertama untuk menyusun kurikulum.</p>
            </div>
        @else
            <div class="space-y-4 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-200 before:to-transparent">
                @foreach($modules as $module)
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <!-- Timeline Dot -->
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-blue-500 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 text-white">
                        @if($module->type === 'materi' || $module->type === 'video')
                            <i class="fas fa-book text-sm"></i>
                        @elseif($module->type === 'tugas' || $module->type === 'project')
                            <i class="fas fa-tasks text-sm"></i>
                        @elseif($module->type === 'quiz')
                            <i class="fas fa-question-circle text-sm"></i>
                        @endif
                    </div>
                    
                    <!-- Content Card -->
                    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] bg-white p-5 rounded-2xl shadow-sm border border-slate-200 hover:border-blue-400 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold px-2 py-1 rounded-lg uppercase tracking-wider 
                                {{ $module->type === 'materi' ? 'bg-blue-50 text-blue-600' : '' }}
                                {{ $module->type === 'quiz' ? 'bg-amber-50 text-amber-600' : '' }}
                                {{ $module->type === 'tugas' ? 'bg-emerald-50 text-emerald-600' : '' }}
                                {{ $module->type === 'video' ? 'bg-purple-50 text-purple-600' : '' }}
                                {{ $module->type === 'project' ? 'bg-rose-50 text-rose-600' : '' }}">
                                {{ $module->type }}
                            </span>
                            <span class="text-xs text-slate-400 font-medium">Urutan: {{ $module->order_index }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 mb-1">{{ $module->title }}</h4>
                        @if($module->description)
                            <p class="text-sm text-slate-500 line-clamp-2 mb-3">{{ $module->description }}</p>
                        @endif
                        
                        <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-100">
                            <a href="{{ route('admin.program.modules.edit', [$program->id, $module->id]) }}" class="px-3 py-1.5 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            
                            @if($module->type === 'quiz')
                            <a href="{{ route('admin.program.modules.quiz', [$program->id, $module->id]) }}" class="px-3 py-1.5 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 rounded-lg transition-colors">
                                <i class="fas fa-list-ul mr-1"></i> Kelola Soal
                            </a>
                            @endif
                            
                            <form action="{{ route('admin.program.modules.destroy', [$program->id, $module->id]) }}" method="POST" class="ml-auto" onsubmit="return confirm('Yakin ingin menghapus modul ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
