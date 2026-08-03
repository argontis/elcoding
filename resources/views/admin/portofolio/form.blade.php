@extends('admin.layout')
@section('title', isset($data) ? 'Edit Portofolio' : 'Tambah Portofolio')
@section('header', 'Portofolio Project')
@section('content')
<div class="surface-card p-6 max-w-2xl">
    <h3 class="text-xl font-bold text-slate-800 mb-6">{{ isset($data) ? 'Edit Project' : 'Tambah Project Baru' }}</h3>
    <form action="{{ isset($data) ? url('admin/portofolio/'.$data->id) : url('admin/portofolio') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($data)) @method('PUT') @endif
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Judul Project</label>
                <input type="text" name="title" value="{{ $data->title ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
                    @php
                        $categories = \App\Models\KategoriPortofolio::orderBy('name')->get();
                    @endphp
                    @foreach($categories as $cat)
                        <option value="{{ $cat->name }}" {{ (isset($data) && $data->category == $cat->name) ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar Cover</label>
                @if(isset($data) && $data->image_path)
                    <div class="mb-3">
                        <img src="{{ asset(str_replace(' ', '%20', $data->image_path)) }}" alt="Current Image" class="h-32 object-cover bg-slate-100 p-1 rounded border border-slate-200">
                    </div>
                @endif
                <input type="file" name="image_file" accept="image/*" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar. Rekomendasi rasio 16:9.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Klien (Opsional)</label>
                    <input type="text" name="client" value="{{ $data->client ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" placeholder="Nama perusahaan/klien">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Project (Opsional)</label>
                    <input type="date" name="date" value="{{ isset($data) && $data->date ? \Carbon\Carbon::parse($data->date)->format('Y-m-d') : '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi Project (Opsional)</label>
                <textarea name="content" rows="6" class="rich-text w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" placeholder="Jelaskan detail dari project ini...">{{ $data->content ?? '' }}</textarea>
            </div>
        </div>
        <div class="mt-8 flex gap-3 border-t border-slate-100 pt-5">
            <a href="{{ url('admin/portofolio') }}" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</a>
            <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
