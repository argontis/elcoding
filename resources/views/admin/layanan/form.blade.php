@extends('admin.layout')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <a href="/admin/layanan" class="text-blue-600 hover:text-blue-700 flex items-center gap-2 mb-2 font-medium">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h1 class="text-3xl font-bold text-slate-900">{{ isset($data) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h1>
    </div>
</div>

<form action="{{ isset($data) ? '/admin/layanan/'.$data->id : '/admin/layanan' }}" method="POST" enctype="multipart/form-data" class="space-y-8 pb-20">
    @csrf
    @if(isset($data)) @method('PUT') @endif

    <!-- Card Info Dasar -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        <div class="flex justify-between items-center p-6 bg-slate-50 border-b border-slate-200 cursor-pointer hover:bg-slate-100 transition" onclick="toggleSectionCollapse(this)">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                <i class="fas fa-chevron-up transition-transform duration-200 chevron-icon"></i> Info Dasar (Card Halaman Utama)
            </h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 transition-all">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Layanan <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $data->title ?? '') }}" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Badge Layanan</label>
                <input type="text" name="badge" value="{{ old('badge', $data->badge ?? '') }}" placeholder="Contoh: Website, Server" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Icon FontAwesome</label>
                <input type="text" name="icon" value="{{ old('icon', $data->icon ?? '') }}" placeholder="Contoh: fas fa-globe" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Singkat (Card)</label>
                <textarea name="short_description" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">{{ old('short_description', $data->short_description ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Harga -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        <div class="flex justify-between items-center p-6 bg-slate-50 border-b border-slate-200 cursor-pointer hover:bg-slate-100 transition" onclick="toggleSectionCollapse(this)">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                <i class="fas fa-chevron-down transition-transform duration-200 chevron-icon"></i> Pengaturan Harga
            </h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6 transition-all" style="display: none;">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Label Harga</label>
                <input type="text" name="price_label" value="{{ old('price_label', $data->price_label ?? 'Mulai dari') }}" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Harga</label>
                <input type="text" name="price" value="{{ old('price', $data->price ?? '') }}" placeholder="Rp 375.000" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Periode</label>
                <input type="text" name="price_period" value="{{ old('price_period', $data->price_period ?? '/ tahun') }}" placeholder="/ tahun, / bulan" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
            <div class="md:col-span-3">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Pesan Template WhatsApp</label>
                <input type="text" name="whatsapp_message" value="{{ old('whatsapp_message', $data->whatsapp_message ?? '') }}" placeholder="Halo Admin Elcoding, saya ingin pesan layanan..." class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
        </div>
    </div>

    <!-- Halaman Detail: Konten Kiri -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        <div class="flex justify-between items-center p-6 bg-slate-50 border-b border-slate-200 cursor-pointer hover:bg-slate-100 transition" onclick="toggleSectionCollapse(this)">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                <i class="fas fa-chevron-down transition-transform duration-200 chevron-icon"></i> Halaman Detail (Konten Kiri)
            </h2>
        </div>
        <div class="p-6 transition-all" style="display: none;">
        
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Gambar Ilustrasi</label>
            @if(isset($data) && $data->image_path)
                <div class="mb-3">
                    <img src="{{ asset($data->image_path) }}" alt="Gambar" class="h-32 object-cover rounded-xl border border-slate-200">
                </div>
            @endif
            <input type="file" name="image_file" accept="image/*" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            <p class="text-xs text-slate-500 mt-2">Rekomendasi ukuran: 800x400px. Kosongkan jika tidak ingin mengubah.</p>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Layanan (Rich Text)</label>
            <textarea name="description" class="rich-text w-full hidden">{!! old('description', $data->description ?? '') !!}</textarea>
        </div>

        <!-- Dynamic Features Main -->
        <div class="mt-8 border border-slate-200 rounded-xl p-6 bg-slate-50/50">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-800 text-lg">Fitur Utama (4 Poin di bawah Deskripsi)</h3>
                <button type="button" onclick="addFeatureMain()" class="text-sm bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg font-medium hover:bg-blue-200 transition-colors">
                    <i class="fas fa-plus"></i> Tambah Poin
                </button>
            </div>
            <div id="features_main_container" class="space-y-4">
                @php 
                    $fMains = isset($data) ? $data->features_main : [['icon'=>'', 'title'=>'', 'desc'=>'']]; 
                    if(empty($fMains)) $fMains = [['icon'=>'', 'title'=>'', 'desc'=>'']];
                @endphp
                @foreach($fMains as $index => $fm)
                <div class="flex gap-4 items-start feature-row bg-white p-4 rounded-xl border border-slate-200">
                    <div class="w-12 pt-2 text-slate-400 text-center cursor-move"><i class="fas fa-grip-vertical"></i></div>
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <input type="text" name="features_main[{{$index}}][icon]" value="{{ $fm['icon'] ?? 'fas fa-check-circle' }}" placeholder="Icon (fas fa-check)" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 mb-2">
                            <input type="text" name="features_main[{{$index}}][title]" value="{{ $fm['title'] ?? '' }}" placeholder="Judul Fitur" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">
                        </div>
                        <div>
                            <textarea name="features_main[{{$index}}][desc]" rows="3" placeholder="Deskripsi pendek" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">{{ $fm['desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                    <button type="button" onclick="this.closest('.feature-row').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg mt-1"><i class="fas fa-trash"></i></button>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>


    <!-- Halaman Detail: Pricing Includes -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        <div class="flex justify-between items-center p-6 bg-slate-50 border-b border-slate-200 cursor-pointer hover:bg-slate-100 transition" onclick="toggleSectionCollapse(this)">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                <i class="fas fa-chevron-down transition-transform duration-200 chevron-icon"></i> Daftar Poin Harga (Pricing Includes)
            </h2>
        </div>
        <div class="p-6 transition-all" style="display: none;">
        <div class="flex justify-between items-center mb-6 pb-4">
            <button type="button" onclick="addPricingInclude()" class="text-sm bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg font-medium hover:bg-blue-200 transition-colors">
                <i class="fas fa-plus"></i> Tambah Poin
            </button>
        </div>
        <div id="pricing_includes_container" class="space-y-3">
            @php 
                $pIncludes = isset($data) ? $data->pricing_includes : ['']; 
                if(empty($pIncludes)) $pIncludes = [''];
            @endphp
            @foreach($pIncludes as $index => $pi)
            <div class="flex gap-3 items-center feature-row">
                <div class="text-emerald-500"><i class="fas fa-check"></i></div>
                <input type="text" name="pricing_includes[]" value="{{ $pi }}" placeholder="Contoh: Gratis Hosting & SSL (1 thn)" class="flex-1 px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                <button type="button" onclick="this.closest('.feature-row').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg"><i class="fas fa-trash"></i></button>
            </div>
            @endforeach
        </div>
        </div>
    </div>


    <!-- Halaman Detail: Fitur Lengkap Grid (12 Kotak) -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        <div class="flex justify-between items-center p-6 bg-slate-50 border-b border-slate-200 cursor-pointer hover:bg-slate-100 transition" onclick="toggleSectionCollapse(this)">
            <h2 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                <i class="fas fa-chevron-down transition-transform duration-200 chevron-icon"></i> Fitur Lengkap Grid (Bagian Bawah)
            </h2>
        </div>
        <div class="p-6 transition-all" style="display: none;">
        <div class="flex justify-between items-center mb-6 pb-4">
            <button type="button" onclick="addFeatureFull()" class="text-sm bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg font-medium hover:bg-blue-200 transition-colors">
                <i class="fas fa-plus"></i> Tambah Kotak Fitur
            </button>
        </div>
        <div id="features_full_container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @php 
                $fFull = isset($data) ? $data->features_full : [['icon'=>'', 'color_class'=>'icon-blue', 'title'=>'', 'desc'=>'']]; 
                if(empty($fFull)) $fFull = [['icon'=>'', 'color_class'=>'icon-blue', 'title'=>'', 'desc'=>'']];
            @endphp
            @foreach($fFull as $index => $ff)
            <div class="feature-row bg-slate-50 border border-slate-200 rounded-xl p-4 relative">
                <button type="button" onclick="this.closest('.feature-row').remove()" class="absolute top-2 right-2 text-red-500 hover:bg-red-100 p-1.5 rounded-lg text-xs"><i class="fas fa-times"></i></button>
                <div class="grid grid-cols-2 gap-2 mb-2">
                    <input type="text" name="features_full[{{$index}}][icon]" value="{{ $ff['icon'] ?? 'fas fa-bolt' }}" placeholder="Icon" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">
                    <select name="features_full[{{$index}}][color_class]" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">
                        <option value="icon-blue" {{ ($ff['color_class'] ?? '') == 'icon-blue' ? 'selected' : '' }}>Biru</option>
                        <option value="icon-cyan" {{ ($ff['color_class'] ?? '') == 'icon-cyan' ? 'selected' : '' }}>Cyan</option>
                        <option value="icon-green" {{ ($ff['color_class'] ?? '') == 'icon-green' ? 'selected' : '' }}>Hijau</option>
                        <option value="icon-purple" {{ ($ff['color_class'] ?? '') == 'icon-purple' ? 'selected' : '' }}>Ungu</option>
                    </select>
                </div>
                <input type="text" name="features_full[{{$index}}][title]" value="{{ $ff['title'] ?? '' }}" placeholder="Judul Kotak" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 mb-2">
                <textarea name="features_full[{{$index}}][desc]" rows="2" placeholder="Deskripsi" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">{{ $ff['desc'] ?? '' }}</textarea>
            </div>
            @endforeach
        </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="fixed bottom-0 right-0 left-72 bg-white border-t border-slate-200 p-4 px-8 flex justify-end z-10">
        <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-blue-700 transition-colors shadow-lg shadow-blue-500/30 flex items-center gap-2">
            <i class="fas fa-save"></i> Simpan Layanan
        </button>
    </div>
</form>

<script>
    window.toggleSectionCollapse = function(headerEl) {
        const body = headerEl.nextElementSibling;
        const icon = headerEl.querySelector('.chevron-icon');
        if (body.style.display === 'none') {
            body.style.display = '';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            body.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }

    let fmIndex = {{ count($fMains) }};
    function addFeatureMain() {
        const tpl = `
        <div class="flex gap-4 items-start feature-row bg-white p-4 rounded-xl border border-slate-200">
            <div class="w-12 pt-2 text-slate-400 text-center cursor-move"><i class="fas fa-grip-vertical"></i></div>
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <input type="text" name="features_main[${fmIndex}][icon]" value="fas fa-check-circle" placeholder="Icon (fas fa-check)" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 mb-2">
                    <input type="text" name="features_main[${fmIndex}][title]" placeholder="Judul Fitur" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">
                </div>
                <div>
                    <textarea name="features_main[${fmIndex}][desc]" rows="3" placeholder="Deskripsi pendek" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300"></textarea>
                </div>
            </div>
            <button type="button" onclick="this.closest('.feature-row').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg mt-1"><i class="fas fa-trash"></i></button>
        </div>`;
        document.getElementById('features_main_container').insertAdjacentHTML('beforeend', tpl);
        fmIndex++;
    }

    function addPricingInclude() {
        const tpl = `
        <div class="flex gap-3 items-center feature-row">
            <div class="text-emerald-500"><i class="fas fa-check"></i></div>
            <input type="text" name="pricing_includes[]" placeholder="Contoh: Gratis Hosting & SSL (1 thn)" class="flex-1 px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            <button type="button" onclick="this.closest('.feature-row').remove()" class="text-red-500 hover:bg-red-50 p-2 rounded-lg"><i class="fas fa-trash"></i></button>
        </div>`;
        document.getElementById('pricing_includes_container').insertAdjacentHTML('beforeend', tpl);
    }

    let ffIndex = {{ count($fFull) }};
    function addFeatureFull() {
        const tpl = `
        <div class="feature-row bg-slate-50 border border-slate-200 rounded-xl p-4 relative">
            <button type="button" onclick="this.closest('.feature-row').remove()" class="absolute top-2 right-2 text-red-500 hover:bg-red-100 p-1.5 rounded-lg text-xs"><i class="fas fa-times"></i></button>
            <div class="grid grid-cols-2 gap-2 mb-2">
                <input type="text" name="features_full[${ffIndex}][icon]" value="fas fa-bolt" placeholder="Icon" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">
                <select name="features_full[${ffIndex}][color_class]" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300">
                    <option value="icon-blue">Biru</option>
                    <option value="icon-cyan">Cyan</option>
                    <option value="icon-green">Hijau</option>
                    <option value="icon-purple">Ungu</option>
                </select>
            </div>
            <input type="text" name="features_full[${ffIndex}][title]" placeholder="Judul Kotak" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300 mb-2">
            <textarea name="features_full[${ffIndex}][desc]" rows="2" placeholder="Deskripsi" class="w-full px-3 py-2 text-sm rounded-lg border border-slate-300"></textarea>
        </div>`;
        document.getElementById('features_full_container').insertAdjacentHTML('beforeend', tpl);
        ffIndex++;
    }

    // Capture quill data before submit
    document.querySelector('form').addEventListener('submit', function() {
        // Find quill editors in admin/layout.blade.php handler
        // The global script in layout handles input value syncing if class="rich-text hidden" is present
    });
</script>
@endsection
