@extends('admin.layout')

@section('title', isset($data) ? 'Edit Event & Webinar - Admin Elcoding' : 'Tambah Event & Webinar - Admin Elcoding')
@section('header', 'Event & Webinar')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="text-xl font-bold text-slate-800">{{ isset($data) ? 'Edit Event/Webinar' : 'Tambah Event/Webinar Baru' }}</h3>
            <p class="text-sm text-slate-500 mt-1">Lengkapi informasi detail untuk event atau webinar Anda.</p>
        </div>
        <a href="{{ url('admin/event') }}" class="btn-outline px-4 py-2 rounded-xl text-sm font-semibold flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ isset($data) ? url('admin/event/'.$data->id) : url('admin/event') }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @if(isset($data))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Kiri: Form Utama -->
            <div class="lg:col-span-2 space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Tipe Event <span class="text-red-500">*</span></label>
                        <select name="type" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" required>
                            <option value="bootcamp" {{ (isset($data) && $data->type == 'bootcamp') ? 'selected' : '' }}>Bootcamp Intensif</option>
                            <option value="webinar" {{ (isset($data) && $data->type == 'webinar') ? 'selected' : '' }}>Webinar Tech</option>
                            <option value="workshop" {{ (isset($data) && $data->type == 'workshop') ? 'selected' : '' }}>Workshop Online</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Judul Event <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ $data->title ?? old('title') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" placeholder="Contoh: Bootcamp Full Stack Web Dev" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Slug URL (Opsional)</label>
                    <input type="text" name="slug" value="{{ $data->slug ?? old('slug') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" placeholder="Kosongkan untuk generate otomatis dari judul">
                    <p class="text-xs text-slate-500 mt-1">Digunakan untuk parameter URL Silabus, contoh: bootcamp-web-dev</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Singkat</label>
                    <textarea name="description" rows="3" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" placeholder="Deskripsi singkat yang tampil di halaman...">{{ $data->description ?? old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Jadwal/Durasi <span class="text-red-500">*</span></label>
                        <input type="text" name="duration_or_date" value="{{ $data->duration_or_date ?? old('duration_or_date') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" placeholder="Contoh: 12 Minggu Pembelajaran atau 28 Aug 2026" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Waktu (Opsional)</label>
                        <input type="text" name="time" value="{{ $data->time ?? old('time') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" placeholder="Contoh: 19:30 WIB">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Harga <span class="text-red-500">*</span></label>
                        <input type="text" name="price" value="{{ $data->price ?? old('price') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" placeholder="Contoh: Rp 2.500.000 atau Gratis / Free" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Harga Coret (Opsional)</label>
                        <input type="text" name="original_price" value="{{ $data->original_price ?? old('original_price') }}" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 outline-none transition-all" placeholder="Contoh: Rp 5.600.000">
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Gambar & Badge -->
            <div class="space-y-6">
                
                <!-- Badge -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <h4 class="text-sm font-bold text-slate-800 mb-4 border-b border-slate-200 pb-2">Pengaturan Badge</h4>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Teks Badge (Opsional)</label>
                            <input type="text" name="badge_text" value="{{ $data->badge_text ?? old('badge_text') }}" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm outline-none focus:border-blue-500" placeholder="RECOMMENDED, TERLARIS, dll">
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Ikon Badge (Opsional)</label>
                            <input type="text" name="badge_icon" value="{{ $data->badge_icon ?? old('badge_icon') }}" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm outline-none focus:border-blue-500" placeholder="fa-star, fa-fire, fa-video">
                            <p class="text-[10px] text-slate-500 mt-1">Gunakan class FontAwesome (misal: fa-star)</p>
                        </div>
                        
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Warna Latar (Opsional)</label>
                            <select name="badge_color" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm outline-none focus:border-blue-500">
                                <option value="">Default (Biru)</option>
                                <option value="bg-blue" {{ (isset($data) && $data->badge_color == 'bg-blue') ? 'selected' : '' }}>Biru</option>
                                <option value="bg-red" {{ (isset($data) && $data->badge_color == 'bg-red') ? 'selected' : '' }}>Merah</option>
                                <option value="bg-orange" {{ (isset($data) && $data->badge_color == 'bg-orange') ? 'selected' : '' }}>Oranye</option>
                                <option value="bg-green" {{ (isset($data) && $data->badge_color == 'bg-green') ? 'selected' : '' }}>Hijau</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Gambar -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200">
                    <h4 class="text-sm font-bold text-slate-800 mb-4 border-b border-slate-200 pb-2">Banner Event</h4>
                    
                    @if(isset($data) && $data->image_path)
                        <div class="mb-4 rounded-lg overflow-hidden border border-slate-200 aspect-video">
                            <img src="{{ asset(str_replace(' ', '%20', $data->image_path)) }}" class="w-full h-full object-cover" alt="Current Banner">
                        </div>
                    @endif
                    
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-2">Upload Banner Baru</label>
                        <input type="file" name="image_file" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        <p class="text-[10px] text-slate-500 mt-2">Rasio yang disarankan: 16:9 (misal 1280x720px). Maks 2MB.</p>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
            <a href="{{ url('admin/event') }}" class="px-6 py-2.5 rounded-xl text-sm font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                Batal
            </a>
            <button type="submit" class="btn-primary px-8 py-2.5 rounded-xl text-sm font-semibold flex items-center gap-2">
                <i class="fas fa-save"></i> {{ isset($data) ? 'Simpan Perubahan' : 'Tambah Event' }}
            </button>
        </div>

    </form>
</div>
@endsection
