@extends('pkl.layout')

@section('title', 'Portofolio Project Magang - elc.my.id')

@section('content')
<div class="space-y-6">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Project & Portofolio Karya Magang</h1>
            <p class="text-slate-400 text-sm mt-1">Dokumentasikan seluruh hasil karya dan project yang Anda buat selama magang</p>
        </div>

        <button onclick="document.getElementById('modal-add-portfolio').classList.remove('hidden')"
                class="px-5 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-2xl transition shadow-lg flex items-center justify-center gap-2 self-start sm:self-auto">
            <i class="fas fa-plus-circle"></i> Tambah Project Baru
        </button>
    </div>

    @if($portfolios->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($portfolios as $item)
                <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl overflow-hidden backdrop-blur-xl flex flex-col justify-between hover:border-blue-500/30 transition">
                    <div>
                        @if($item->thumbnail)
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="w-full h-44 object-cover">
                        @else
                            <div class="w-full h-44 bg-slate-900 flex items-center justify-center text-slate-600">
                                <i class="fas fa-laptop-code text-4xl"></i>
                            </div>
                        @endif

                        <div class="p-5 space-y-2">
                            <h3 class="text-base font-bold text-white">{{ $item->title }}</h3>
                            <p class="text-xs text-slate-300 line-clamp-3 leading-relaxed">{{ $item->description ?: 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>

                    <div class="p-5 pt-0 space-y-3">
                        <div class="flex items-center gap-3 text-xs">
                            @if($item->project_url)
                                <a href="{{ $item->project_url }}" target="_blank" class="px-3 py-1.5 bg-blue-600/20 text-blue-400 hover:bg-blue-600/30 font-semibold rounded-xl border border-blue-500/30 flex items-center gap-1">
                                    <i class="fas fa-external-link-alt"></i> Demo Web
                                </a>
                            @endif

                            @if($item->github_url)
                                <a href="{{ $item->github_url }}" target="_blank" class="px-3 py-1.5 bg-slate-700 text-slate-300 hover:bg-slate-600 font-semibold rounded-xl flex items-center gap-1">
                                    <i class="fab fa-github"></i> Repository
                                </a>
                            @endif
                        </div>

                        <div class="flex items-center justify-between border-t border-slate-700/50 pt-3">
                            <span class="text-[11px] text-emerald-400 font-semibold flex items-center gap-1">
                                <i class="fas fa-check-circle"></i> Disetujui
                            </span>

                            <form action="{{ route('pkl.portfolio.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus project ini dari portofolio?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-slate-500 hover:text-red-400 transition" title="Hapus Project">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-slate-800/40 border border-slate-700/50 rounded-3xl p-12 text-center">
            <div class="w-16 h-16 bg-purple-500/10 text-purple-400 rounded-3xl flex items-center justify-center mx-auto text-2xl mb-4">
                <i class="fas fa-laptop-code"></i>
            </div>
            <h3 class="text-lg font-bold text-white">Belum Ada Project Portofolio</h3>
            <p class="text-slate-400 text-sm mt-1 max-w-md mx-auto mb-6">
                Tampilkan hasil karya dan tugas project terbaik yang Anda kerjakan selama magang di sini.
            </p>
            <button onclick="document.getElementById('modal-add-portfolio').classList.remove('hidden')"
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-2xl transition shadow-lg inline-flex items-center gap-2">
                <i class="fas fa-plus-circle"></i> Tambah Project Pertama
            </button>
        </div>
    @endif

    <!-- Modal Tambah Portfolio -->
    <div id="modal-add-portfolio" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-slate-800 border border-slate-700 rounded-3xl p-6 max-w-lg w-full shadow-2xl relative">
            <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-4">
                <h3 class="text-base font-bold text-white">Tambah Project Portofolio</h3>
                <button onclick="document.getElementById('modal-add-portfolio').classList.add('hidden')" class="text-slate-400 hover:text-white">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('pkl.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Judul Project *</label>
                    <input type="text" name="title" required
                           class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                           placeholder="Misal: Aplikasi POS Kasir Berbasis Laravel">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Deskripsi Singkat Project</label>
                    <textarea name="description" rows="3"
                              class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                              placeholder="Jelaskan fitur utama dan teknologi yang Anda gunakan..."></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Link Demo Website</label>
                        <input type="url" name="project_url"
                               class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                               placeholder="https://myproject.com">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">Link Repository GitHub</label>
                        <input type="url" name="github_url"
                               class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-blue-500"
                               placeholder="https://github.com/username/repo">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">Upload Tangkapan Layar / Screenshot (JPG/PNG max 5MB)</label>
                    <input type="file" name="thumbnail" accept="image/*"
                           class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-xs text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white">
                </div>

                <div class="pt-3 flex items-center justify-end gap-3 border-t border-slate-700">
                    <button type="button" onclick="document.getElementById('modal-add-portfolio').classList.add('hidden')"
                            class="px-4 py-2 bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl hover:bg-slate-600">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl hover:bg-blue-500 shadow-md">
                        Simpan Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
