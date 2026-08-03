@extends('admin.layout')
@section('title', isset($data) ? 'Edit Mitra' : 'Tambah Mitra')
@section('header', 'Mitra')
@section('content')
<div class="surface-card p-6 w-full">
    <h3 class="text-xl font-bold text-slate-800 mb-6">{{ isset($data) ? 'Edit Mitra' : 'Tambah Mitra Baru' }}</h3>
    <form action="{{ isset($data) ? url('admin/mitra/'.$data->id) : url('admin/mitra') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($data)) @method('PUT') @endif
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Mitra/Perusahaan</label>
                <input type="text" name="name" value="{{ $data->name ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload Logo</label>
                @if(isset($data) && $data->logo_path)
                    <div class="mb-3">
                        <img src="{{ asset($data->logo_path) }}" alt="Current Logo" class="h-20 object-contain bg-slate-100 p-2 rounded border border-slate-200">
                    </div>
                @endif
                <input type="file" name="logo_file" accept="image/*" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah logo. Format: JPG, PNG, WEBP.</p>
            </div>
        </div>
        <div class="mt-8 flex gap-3 border-t border-slate-100 pt-5">
            <a href="{{ url('admin/mitra') }}" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</a>
            <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
