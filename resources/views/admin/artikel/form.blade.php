@extends('admin.layout')
@section('title', isset($data) ? 'Edit Blog' : 'Tulis Blog')
@section('header', 'Konten Blog')
@section('content')
<div class="surface-card p-6 w-full">
    <h3 class="text-xl font-bold text-slate-800 mb-6">{{ isset($data) ? 'Edit Blog' : 'Tulis Blog Baru' }}</h3>
    <form action="{{ isset($data) ? url('admin/artikel/'.$data->id) : url('admin/artikel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($data)) @method('PUT') @endif
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul Blog</label>
                <input type="text" name="title" value="{{ $data->title ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Penulis</label>
                    <input type="text" name="author" value="{{ $data->author ?? 'Admin Elcoding' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                    <input type="text" name="category" value="{{ $data->category ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required placeholder="Cth: Edukasi, Teknologi">
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status Publikasi</label>
                    <select name="status" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                        <option value="Published" {{ (isset($data) && $data->status == 'Published') ? 'selected' : '' }}>Published (Terbit)</option>
                        <option value="Draft" {{ (isset($data) && $data->status == 'Draft') ? 'selected' : '' }}>Draft (Konsep)</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar Thumbnail</label>
                @if(isset($data) && $data->image_path)
                    <div class="mb-3">
                        <img src="{{ asset($data->image_path) }}" alt="Current Image" class="h-32 object-cover bg-slate-100 p-1 rounded border border-slate-200">
                    </div>
                @endif
                <input type="file" name="image_file" accept="image/*" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konten Blog</label>
                <textarea name="content" rows="10" class="rich-text w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required placeholder="Tulis konten blog di sini...">{{ $data->content ?? '' }}</textarea>
            </div>
        </div>
        <div class="mt-8 flex gap-3 border-t border-slate-100 pt-5">
            <a href="{{ url('admin/artikel') }}" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</a>
            <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md">Simpan Blog</button>
        </div>
    </form>
</div>
@endsection
