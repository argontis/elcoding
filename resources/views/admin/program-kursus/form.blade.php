@extends('admin.layout')
@section('title', isset($data) ? 'Edit Program Kursus' : 'Tambah Program')
@section('header', 'Program Kursus')
@section('content')
<div class="surface-card p-6 w-full">
    <h3 class="text-xl font-bold text-slate-800 mb-6">{{ isset($data) ? 'Edit Program' : 'Tambah Program Baru' }}</h3>
    <form action="{{ isset($data) ? url('admin/program-kursus/'.$data->id) : url('admin/program-kursus') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($data)) @method('PUT') @endif
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Program</label>
                <input type="text" name="title" value="{{ $data->title ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Durasi</label>
                    <input type="text" name="duration" value="{{ $data->duration ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required placeholder="Cth: 3 Bulan">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Harga</label>
                    <input type="text" name="price" value="{{ $data->price ?? '' }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required placeholder="Cth: Rp2.500.000">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Label (Opsional)</label>
                <select name="badge" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    <option value="" {{ (isset($data) && $data->badge == '') ? 'selected' : '' }}>Reguler (Tanpa Label)</option>
                    <option value="Recommended" {{ (isset($data) && $data->badge == 'Recommended') ? 'selected' : '' }}>Recommended</option>
                    <option value="Terlaris" {{ (isset($data) && $data->badge == 'Terlaris') ? 'selected' : '' }}>Terlaris</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Upload Gambar Header Program</label>
                @if(isset($data) && $data->image_path)
                    <div class="mb-3">
                        <img src="{{ asset(str_replace(' ', '%20', $data->image_path)) }}" alt="Current Image" class="h-32 object-cover bg-slate-100 p-1 rounded border border-slate-200">
                    </div>
                @endif
                <input type="file" name="image_file" accept="image/*" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Poin-poin Fitur Program</label>
                <textarea name="features" rows="5" class="rich-text w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" placeholder="Materi Sesuai Kurikulum Industri... (Gunakan format list)">{{ $data->features ?? '' }}</textarea>
                <p class="text-xs text-slate-400 mt-1">Gunakan format Bullet List untuk fitur program. Bagian durasi tidak perlu ditulis lagi.</p>
            </div>
        </div>
        <div class="mt-8 flex gap-3 border-t border-slate-100 pt-5">
            <a href="{{ url('admin/program-kursus') }}" class="px-5 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">Batal</a>
            <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-md">Simpan Data</button>
        </div>
    </form>
</div>
@endsection
