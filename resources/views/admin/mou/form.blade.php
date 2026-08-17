@extends('admin.layout')
@section('title', isset($mou) ? 'Edit MoU - Admin Elcoding' : 'Buat MoU - Admin Elcoding')
@section('header', isset($mou) ? 'Edit Mou' : 'Form Mou')

@section('content')
<div class="surface-card p-6 w-full">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h3 class="text-xl font-bold text-slate-800">{{ isset($mou) ? 'Edit MoU' : 'Form MoU' }}</h3>
        <p class="text-sm text-slate-500 mt-1">Harap isi detail proposal / MoU Elcoding</p>
    </div>

    <form action="{{ isset($mou) ? url('admin/mou/'.$mou->id) : url('admin/mou') }}" method="POST" id="mouFormPage" enctype="multipart/form-data">
        @csrf
        @if(isset($mou))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama File / Transaksi *</label>
                <input type="text" name="nama_file" value="{{ old('nama_file', $mou->nama_file ?? '') }}" placeholder="Contoh: Servis Laptop Asus 12-12-2025" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Surat *</label>
                <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $mou->nomor_surat ?? '') }}" placeholder="Contoh: 001/SP-ELC/VII/2026" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Perihal *</label>
                <input type="text" name="perihal" value="{{ old('perihal', $mou->perihal ?? '') }}" placeholder="Contoh: Penawaran Jasa Pembuatan Website" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Lampiran *</label>
                <input type="text" name="lampiran" value="{{ old('lampiran', $mou->lampiran ?? '') }}" placeholder="Contoh: 1 Berkas Proposal Terpadu" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal *</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $mou->tanggal ?? date('Y-m-d')) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi *</label>
                <select name="lokasi" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Lokasi</option>
                    <option value="Tegal" {{ old('lokasi', $mou->lokasi ?? '') == 'Tegal' ? 'selected' : '' }}>Tegal</option>
                    <option value="Cibubur" {{ old('lokasi', $mou->lokasi ?? '') == 'Cibubur' ? 'selected' : '' }}>Cibubur</option>
                    <option value="Kampus Saintek" {{ old('lokasi', $mou->lokasi ?? '') == 'Kampus Saintek' ? 'selected' : '' }}>Kampus Saintek</option>
                    <option value="Kampus PKTJ" {{ old('lokasi', $mou->lokasi ?? '') == 'Kampus PKTJ' ? 'selected' : '' }}>Kampus PKTJ</option>
                    <option value="Jakarta, Indonesia" {{ old('lokasi', $mou->lokasi ?? '') == 'Jakarta, Indonesia' ? 'selected' : '' }}>Jakarta, Indonesia</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Customer *</label>
                <input type="text" name="nama_customer" value="{{ old('nama_customer', $mou->nama_customer ?? '') }}" placeholder="Contoh: Direksi PT Berkah Aqiqah" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Penandatangan (Diajukan Oleh) *</label>
                <input type="text" name="created_by" value="{{ old('created_by', $mou->created_by ?? '') }}" placeholder="Contoh: Zaky Afrizal" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>



            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Ketentuan</label>
                <div class="flex items-center mb-2">
                    <input type="radio" id="custom_terms" name="ketentuan_type" value="custom" {{ (old('ketentuan_type', $mou->ketentuan_type ?? 'custom') == 'custom') ? 'checked' : '' }} class="mr-2">
                    <label for="custom_terms" class="text-sm text-slate-600">Custom</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="radio" id="template_terms" name="ketentuan_type" value="template" {{ (old('ketentuan_type', $mou->ketentuan_type ?? '') == 'template') ? 'checked' : '' }} class="mr-2">
                    <label for="template_terms" class="text-sm text-slate-600">Gunakan Template</label>
                </div>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Ketentuan</label>
                <textarea name="ketentuan" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6" placeholder="Masukkan ketentuan satu per baris">{{ old('ketentuan', $mou->ketentuan ?? '') }}</textarea>
                <small class="text-slate-500">Kosongkan untuk menggunakan ketentuan default</small>
            </div>
        </div>

        <!-- Dynamic Sections Area -->
        <div class="mt-8 border-t border-slate-100 pt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800">Bagian / Section (Opsional)</h3>
                <button type="button" id="btnTambahSection" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Bagian
                </button>
            </div>
            
            <div id="sectionsContainer" class="space-y-6">
                @if(isset($mou) && $mou->sections && $mou->sections->count() > 0)
                    @foreach($mou->sections as $sIdx => $section)
                        @php
                            $blocks = [];
                            $isLegacy = true;
                            $decoded = json_decode($section->content, true);
                            if (is_array($decoded) && isset($decoded[0]['type'])) {
                                $blocks = $decoded;
                                $isLegacy = false;
                            }
                            if ($isLegacy) {
                                if (($section->type ?? '') === 'point_left' || ($section->type ?? '') === 'point_top') {
                                    $blocks = [['type' => $section->type, 'points' => $decoded ?? []]];
                                } else {
                                    $blocks = [['type' => 'text', 'content' => $section->content]];
                                }
                            }
                        @endphp
                        <div class="section-card border border-slate-200 rounded-lg bg-white relative shadow-sm mb-6" data-index="{{ $sIdx }}">
                            <div class="section-header flex justify-between items-center p-4 cursor-pointer bg-slate-50 border-b border-slate-200 rounded-t-lg hover:bg-slate-100 transition" onclick="toggleSectionCollapse(this)">
                                <h4 class="font-bold text-slate-700 flex items-center gap-3">
                                    <i class="fas fa-chevron-up transition-transform duration-200 chevron-icon"></i>
                                    <span>Bagian <span class="section-number">{{ $sIdx + 1 }}</span></span>
                                </h4>
                                <button type="button" class="text-red-500 hover:text-red-700 px-2 py-1" onclick="removeSectionBtn(this, event)" title="Hapus Bagian">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div class="section-body p-5 grid grid-cols-1 gap-4 transition-all">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-1">Judul Bagian *</label>
                                    <input type="text" name="sections[{{ $sIdx }}][title]" value="{{ $section->title }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required placeholder="Contoh: BAGIAN 1: SURAT PENAWARAN RESMI">
                                </div>
                                <div id="blocks-container-{{ $sIdx }}" class="blocks-container space-y-4 border border-dashed border-slate-300 rounded p-4 bg-slate-50 min-h-[100px]">
                                    @foreach($blocks as $bIdx => $block)
                                        <div class="block-card bg-white border border-slate-200 rounded-lg p-4 relative shadow-sm" data-block-type="{{ $block['type'] }}" data-bidx="{{ $bIdx }}">
                                            <button type="button" class="absolute top-2 right-2 text-slate-400 hover:text-red-500" onclick="this.closest('.block-card').remove()"><i class="fas fa-times"></i></button>
                                            <input type="hidden" name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][type]" value="{{ $block['type'] }}">
                                            
                                            @if($block['type'] === 'text')
                                                <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-align-left mr-2"></i>Teks Bebas</div>
                                                <textarea name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][content]" class="rich-text-section w-full px-4 py-2 border border-slate-200 rounded-lg">{!! $block['content'] ?? '' !!}</textarea>
                                            
                                            @elseif($block['type'] === 'point_left' || $block['type'] === 'point_top')
                                                <div class="font-bold text-sm text-slate-700 mb-2">
                                                    <i class="fas {{ $block['type'] == 'point_left' ? 'fa-list-ul' : 'fa-list' }} mr-2"></i>Template Poin ({{ $block['type'] == 'point_left' ? 'Kiri' : 'Atas' }})
                                                </div>
                                                <div class="points-wrapper space-y-2">
                                                    @foreach($block['points'] ?? [] as $pIdx => $point)
                                                    <div class="point-item flex gap-2">
                                                        <div class="flex-1 space-y-2">
                                                            <input type="text" name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][points][{{ $pIdx }}][title]" value="{{ htmlspecialchars($point['title'] ?? '') }}" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500" placeholder="Judul Poin">
                                                            <textarea name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][points][{{ $pIdx }}][desc]" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500" placeholder="Deskripsi Poin" rows="2">{{ htmlspecialchars($point['desc'] ?? '') }}</textarea>
                                                        </div>
                                                        <button type="button" class="text-red-500 hover:text-red-700 p-2" onclick="this.closest('.point-item').remove()"><i class="fas fa-times"></i></button>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="mt-2 text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded" onclick="addPointToBlock(this, {{ $sIdx }}, {{ $bIdx }})"><i class="fas fa-plus"></i> Tambah Poin</button>
                                            
                                                                                                                                    @elseif($block['type'] === 'note')
                                                <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-sticky-note mr-2"></i>Template Catatan</div>
                                                <div class="space-y-2">
                                                    <input type="text" name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][title]" value="{{ htmlspecialchars($block['title'] ?? '') }}" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500 font-bold" placeholder="Judul Catatan (Opsional)">
                                                    <textarea name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][content]" class="rich-text-section w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Isi Catatan">{!! $block['content'] ?? '' !!}</textarea>
                                                </div>
                                            @elseif($block['type'] === 'dynamic_table')
                                                <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-table mr-2"></i>Template Tabel Dinamis</div>
                                                
                                                <div class="mb-2 flex gap-2">
                                                    <button type="button" class="text-xs bg-indigo-50 text-indigo-600 px-2 py-1 rounded" onclick="addDynamicTableColumn(this, {{ $sIdx }}, {{ $bIdx }})"><i class="fas fa-plus"></i> Tambah Kolom</button>
                                                    <button type="button" class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded" onclick="removeDynamicTableColumn(this)"><i class="fas fa-minus"></i> Hapus Kolom Akhir</button>
                                                </div>

                                                <div class="flex gap-2 mb-2 dynamic-headers-wrapper w-full pr-10">
                                                    @foreach($block['headers'] ?? ['No', 'Spesifikasi'] as $hIdx => $header)
                                                    <input type="text" name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][headers][]" value="{{ $header }}" class="flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                                                    @endforeach
                                                </div>
                                                <div class="dynamic-rows-wrapper space-y-2">
                                                    @foreach($block['rows'] ?? [] as $rIdx => $row)
                                                    <div class="dynamic-row-item flex gap-2" data-ridx="{{ $rIdx }}">
                                                        <div class="dynamic-cells flex flex-1 gap-2">
                                                            @foreach($row as $cell)
                                                            <input type="text" list="table-options" name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][rows][{{ $rIdx }}][]" value="{{ htmlspecialchars($cell) }}" class="flex-1 px-3 py-1.5 border border-slate-200 rounded text-sm">
                                                            @endforeach
                                                        </div>
                                                        <button type="button" class="text-red-500 hover:text-red-700 p-2 w-8" onclick="this.closest('.dynamic-row-item').remove()"><i class="fas fa-times"></i></button>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="mt-2 text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded" onclick="addDynamicTableRow(this, {{ $sIdx }}, {{ $bIdx }})"><i class="fas fa-plus"></i> Tambah Baris</button>
                                            @elseif($block['type'] === 'table')
                                                <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-table mr-2"></i>Template Tabel (2 Kolom)</div>
                                                <div class="flex gap-2 mb-2">
                                                    <input type="text" name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][headers][0]" value="{{ $block['headers'][0] ?? 'Header Kiri' }}" class="w-1/2 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                                                    <input type="text" name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][headers][1]" value="{{ $block['headers'][1] ?? 'Header Kanan' }}" class="w-1/2 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                                                    <div class="w-8"></div>
                                                </div>
                                                <div class="table-rows-wrapper space-y-2">
                                                    @foreach($block['rows'] ?? [] as $rIdx => $row)
                                                    <div class="table-row-item flex gap-2">
                                                        <textarea name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][rows][{{ $rIdx }}][col1]" class="w-1/2 px-3 py-1.5 border border-slate-200 rounded text-sm" rows="1">{{ $row['col1'] ?? '' }}</textarea>
                                                        <textarea name="sections[{{ $sIdx }}][blocks][{{ $bIdx }}][rows][{{ $rIdx }}][col2]" class="w-1/2 px-3 py-1.5 border border-slate-200 rounded text-sm" rows="1">{{ $row['col2'] ?? '' }}</textarea>
                                                        <button type="button" class="text-red-500 hover:text-red-700 p-2" onclick="this.closest('.table-row-item').remove()"><i class="fas fa-times"></i></button>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="mt-2 text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded" onclick="addRowToBlock(this, {{ $sIdx }}, {{ $bIdx }})"><i class="fas fa-plus"></i> Tambah Baris</button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-2 text-center">
                                    <div class="dropdown inline-block relative group/dropdown">
                                        <button type="button" class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 hover:bg-indigo-100 transition">
                                            <i class="fas fa-plus-circle"></i> Tambah Input Baru ke Bagian Ini
                                        </button>
                                        <ul class="dropdown-menu absolute hidden group-hover/dropdown:block text-gray-700 pt-1 z-10 w-56 shadow-xl border border-slate-200 rounded-lg bg-white left-1/2 -translate-x-1/2 text-left">
                                            <li><a class="rounded-t hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock({{ $sIdx }}, 'text')"><i class="fas fa-align-left w-5 text-slate-400"></i> Teks Bebas</a></li>
                                            <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock({{ $sIdx }}, 'point_left')"><i class="fas fa-list-ul w-5 text-slate-400"></i> Template Poin (Kiri)</a></li>
                                            <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock({{ $sIdx }}, 'point_top')"><i class="fas fa-list w-5 text-slate-400"></i> Template Poin (Atas)</a></li>
                                            <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock({{ $sIdx }}, 'note')"><i class="fas fa-sticky-note w-5 text-slate-400"></i> Template Catatan</a></li>
                                            <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock({{ $sIdx }}, 'dynamic_table')"><i class="fas fa-table w-5 text-slate-400"></i> Template Tabel Dinamis</a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-slate-100">
            <a href="{{ url('admin/mou') }}" class="px-6 py-2.5 rounded-lg border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">
                Kembali
            </a>
            <button type="submit" class="bg-blue-800 text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-900 transition shadow-md">
                Simpan & Download PDF
            </button>
        </div>
        <datalist id="table-options">
        <option value="✔️">Ceklis / Tersedia</option>
        <option value="❌">Silang / Tidak Tersedia</option>
    </datalist>
</form>
</div>

<script>
const DEFAULT_DATE = '{{ date('Y-m-d') }}';
const $p = (id) => document.getElementById(id);

function initQuillForSection(element) {
    const container = document.createElement('div');
    element.parentNode.insertBefore(container, element);
    element.style.display = 'none';

    const customColors = ['#000000', '#1f497d', '#e60000', '#ff9900', '#ffff00', '#008a00', '#0066cc', '#9933ff', '#ffffff', '#facccc', '#ffebcc', '#ffffcc', '#cce8cc', '#cce0f5', '#ebd6ff', '#bbbbbb', '#f06666', '#ffc266', '#ffff66', '#66b966', '#66a3e0', '#c285ff', '#888888', '#a10000', '#b26b00', '#b2b200', '#006100', '#0047b2', '#6b24b2', '#444444', '#5c0000', '#663d00', '#666600', '#003700', '#002966', '#3d1466'];
    
    const quill = new Quill(container, {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'align': [] }, { 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'color': customColors }, { 'background': customColors }],
                ['link', 'image', 'clean']
            ]
        }
    });
    quill.root.innerHTML = element.value;
    quill.on('text-change', function() {
        element.value = quill.root.innerHTML;
    });
}

window.toggleSectionCollapse = function(headerEl) {
    const body = headerEl.nextElementSibling;
    const icon = headerEl.querySelector('.chevron-icon');
    if (body.style.display === 'none') {
        body.style.display = 'grid';
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    } else {
        body.style.display = 'none';
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    }
};

window.removeSectionBtn = function(btn, event) {
    event.stopPropagation();
    if (confirm('Yakin ingin menghapus bagian ini?')) {
        btn.closest('.section-card').remove();
        updateSectionNumbers();
    }
};

function updateSectionNumbers() {
    document.querySelectorAll('.section-card').forEach((card, index) => {
        const numSpan = card.querySelector('.section-number');
        if (numSpan) numSpan.textContent = index + 1;
    });
}

window.addPointToBlock = function(btn, sIdx, bIdx) {
    const wrapper = btn.previousElementSibling;
    const pIdx = wrapper.children.length + Math.floor(Math.random() * 1000);
    const html = `
        <div class="point-item flex gap-2">
            <div class="flex-1 space-y-2">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][points][${pIdx}][title]" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500" placeholder="Judul Poin">
                <textarea name="sections[${sIdx}][blocks][${bIdx}][points][${pIdx}][desc]" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500" placeholder="Deskripsi Poin" rows="2"></textarea>
            </div>
            <button type="button" class="text-red-500 hover:text-red-700 p-2" onclick="this.closest('.point-item').remove()"><i class="fas fa-times"></i></button>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
};

window.addRowToBlock = function(btn, sIdx, bIdx) {
    const wrapper = btn.previousElementSibling;
    const rIdx = wrapper.children.length + Math.floor(Math.random() * 1000);
    const html = `
        <div class="table-row-item flex gap-2">
            <textarea name="sections[${sIdx}][blocks][${bIdx}][rows][${rIdx}][col1]" class="w-1/2 px-3 py-1.5 border border-slate-200 rounded text-sm" rows="1"></textarea>
            <textarea name="sections[${sIdx}][blocks][${bIdx}][rows][${rIdx}][col2]" class="w-1/2 px-3 py-1.5 border border-slate-200 rounded text-sm" rows="1"></textarea>
            <button type="button" class="text-red-500 hover:text-red-700 p-2" onclick="this.closest('.table-row-item').remove()"><i class="fas fa-times"></i></button>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
};

window.addDynamicTableColumn = function(btn, sIdx, bIdx) {
    const blockCard = btn.closest('.block-card');
    const headerWrapper = blockCard.querySelector('.dynamic-headers-wrapper');
    const rowsWrapper = blockCard.querySelector('.dynamic-rows-wrapper');
    const colCount = headerWrapper.children.length;
    
    const hInput = document.createElement('input');
    hInput.type = 'text';
    hInput.name = `sections[${sIdx}][blocks][${bIdx}][headers][]`;
    hInput.value = `Kolom ${colCount + 1}`;
    hInput.className = 'flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center';
    headerWrapper.appendChild(hInput);
    
    const rows = rowsWrapper.querySelectorAll('.dynamic-row-item');
    rows.forEach((row) => {
        const cInput = document.createElement('input');
        cInput.type = 'text';
        cInput.setAttribute('list', 'table-options');
        cInput.name = `sections[${sIdx}][blocks][${bIdx}][rows][${row.dataset.ridx}][]`;
        cInput.className = 'flex-1 px-3 py-1.5 border border-slate-200 rounded text-sm';
        row.querySelector('.dynamic-cells').appendChild(cInput);
    });
};

window.removeDynamicTableColumn = function(btn) {
    const blockCard = btn.closest('.block-card');
    const headerWrapper = blockCard.querySelector('.dynamic-headers-wrapper');
    if(headerWrapper.children.length <= 1) return;
    
    headerWrapper.lastElementChild.remove();
    
    const rowsWrapper = blockCard.querySelector('.dynamic-rows-wrapper');
    const rows = rowsWrapper.querySelectorAll('.dynamic-row-item');
    rows.forEach((row) => {
        const cells = row.querySelector('.dynamic-cells');
        if(cells.lastElementChild) cells.lastElementChild.remove();
    });
};

window.addDynamicTableRow = function(btn, sIdx, bIdx) {
    const blockCard = btn.closest('.block-card');
    const headerWrapper = blockCard.querySelector('.dynamic-headers-wrapper');
    const colCount = headerWrapper.children.length;
    const wrapper = blockCard.querySelector('.dynamic-rows-wrapper');
    const rIdx = wrapper.children.length + Math.floor(Math.random() * 1000);
    
    let cellsHtml = '';
    for(let i=0; i<colCount; i++) {
        cellsHtml += `<input type="text" list="table-options" name="sections[${sIdx}][blocks][${bIdx}][rows][${rIdx}][]" class="flex-1 px-3 py-1.5 border border-slate-200 rounded text-sm">`;
    }
    
    const html = `
        <div class="dynamic-row-item flex gap-2" data-ridx="${rIdx}">
            <div class="dynamic-cells flex flex-1 gap-2">
                ${cellsHtml}
            </div>
            <button type="button" class="text-red-500 hover:text-red-700 p-2 w-8" onclick="this.closest('.dynamic-row-item').remove()"><i class="fas fa-times"></i></button>
        </div>
    `;
    wrapper.insertAdjacentHTML('beforeend', html);
};

window.addBlock = function(sIdx, type) {
    const container = document.getElementById(`blocks-container-${sIdx}`);
    const bIdx = container.children.length + Math.floor(Math.random() * 1000);
    
    let contentHtml = '';
    
    if (type === 'text') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-align-left mr-2"></i>Teks Bebas</div>
            <textarea name="sections[${sIdx}][blocks][${bIdx}][content]" class="new-rich-text w-full px-4 py-2 border border-slate-200 rounded-lg"></textarea>
        `;
    } else if (type === 'point_left' || type === 'point_top') {
        const title = type === 'point_left' ? 'Template Poin (Kiri)' : 'Template Poin (Atas)';
        const icon = type === 'point_left' ? 'fa-list-ul' : 'fa-list';
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas ${icon} mr-2"></i>${title}</div>
            <div class="points-wrapper space-y-2"></div>
            <button type="button" class="mt-2 text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded" onclick="addPointToBlock(this, ${sIdx}, ${bIdx})"><i class="fas fa-plus"></i> Tambah Poin</button>
        `;
            } else if (type === 'note') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-sticky-note mr-2"></i>Template Catatan</div>
            <div class="space-y-2">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][title]" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500 font-bold" placeholder="Judul Catatan (Opsional)">
                <textarea name="sections[${sIdx}][blocks][${bIdx}][content]" class="new-rich-text w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Isi Catatan"></textarea>
            </div>
        `;
    } else if (type === 'dynamic_table') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-table mr-2"></i>Template Tabel Dinamis</div>
            <div class="mb-2 flex gap-2">
                <button type="button" class="text-xs bg-indigo-50 text-indigo-600 px-2 py-1 rounded" onclick="addDynamicTableColumn(this, ${sIdx}, ${bIdx})"><i class="fas fa-plus"></i> Tambah Kolom</button>
                <button type="button" class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded" onclick="removeDynamicTableColumn(this)"><i class="fas fa-minus"></i> Hapus Kolom Akhir</button>
            </div>
            <div class="flex gap-2 mb-2 dynamic-headers-wrapper w-full pr-10">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][]" value="No" class="flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][]" value="Spesifikasi & Fitur" class="flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][]" value="Paket Lite" class="flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
            </div>
            <div class="dynamic-rows-wrapper space-y-2"></div>
            <button type="button" class="mt-2 text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded" onclick="addDynamicTableRow(this, ${sIdx}, ${bIdx})"><i class="fas fa-plus"></i> Tambah Baris</button>
        `;
        } else if (type === 'note') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-sticky-note mr-2"></i>Template Catatan</div>
            <div class="space-y-2">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][title]" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500 font-bold" placeholder="Judul Catatan (Opsional)">
                <textarea name="sections[${sIdx}][blocks][${bIdx}][content]" class="new-rich-text w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Isi Catatan"></textarea>
            </div>
        `;
    } else if (type === 'dynamic_table') {
        const btn = container.lastElementChild.querySelector('button[onclick^="addDynamicTableRow"]');
        if(btn) addDynamicTableRow(btn, sIdx, bIdx);
    } else if (type === 'table') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-table mr-2"></i>Template Tabel (2 Kolom)</div>
            <div class="flex gap-2 mb-2">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][0]" value="Header Kiri" class="w-1/2 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][1]" value="Header Kanan" class="w-1/2 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                <div class="w-8"></div>
            </div>
            <div class="table-rows-wrapper space-y-2"></div>
            <button type="button" class="mt-2 text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded" onclick="addRowToBlock(this, ${sIdx}, ${bIdx})"><i class="fas fa-plus"></i> Tambah Baris</button>
        `;
    }

    const blockHtml = `
        <div class="block-card bg-white border border-slate-200 rounded-lg p-4 relative shadow-sm" data-block-type="${type}" data-bidx="${bIdx}">
            <button type="button" class="absolute top-2 right-2 text-slate-400 hover:text-red-500" onclick="this.closest('.block-card').remove()"><i class="fas fa-times"></i></button>
            <input type="hidden" name="sections[${sIdx}][blocks][${bIdx}][type]" value="${type}">
            ${contentHtml}
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', blockHtml);
    
    if (type === 'text' || type === 'note') {
        const newTextareas = container.querySelectorAll('.new-rich-text');
        newTextareas.forEach(el => {
            el.classList.remove('new-rich-text');
            initQuillForSection(el);
        });
    } else if (type === 'point_left' || type === 'point_top') {
        // Auto add 1 point
        const btn = container.lastElementChild.querySelector('button[onclick^="addPointToBlock"]');
        if(btn) addPointToBlock(btn, sIdx, bIdx);
            } else if (type === 'note') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-sticky-note mr-2"></i>Template Catatan</div>
            <div class="space-y-2">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][title]" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500 font-bold" placeholder="Judul Catatan (Opsional)">
                <textarea name="sections[${sIdx}][blocks][${bIdx}][content]" class="new-rich-text w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Isi Catatan"></textarea>
            </div>
        `;
    } else if (type === 'dynamic_table') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-table mr-2"></i>Template Tabel Dinamis</div>
            <div class="mb-2 flex gap-2">
                <button type="button" class="text-xs bg-indigo-50 text-indigo-600 px-2 py-1 rounded" onclick="addDynamicTableColumn(this, ${sIdx}, ${bIdx})"><i class="fas fa-plus"></i> Tambah Kolom</button>
                <button type="button" class="text-xs bg-red-50 text-red-600 px-2 py-1 rounded" onclick="removeDynamicTableColumn(this)"><i class="fas fa-minus"></i> Hapus Kolom Akhir</button>
            </div>
            <div class="flex gap-2 mb-2 dynamic-headers-wrapper w-full pr-10">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][]" value="No" class="flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][]" value="Spesifikasi & Fitur" class="flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][headers][]" value="Paket Lite" class="flex-1 px-3 py-1.5 bg-slate-100 border border-slate-200 rounded text-sm font-bold text-center">
            </div>
            <div class="dynamic-rows-wrapper space-y-2"></div>
            <button type="button" class="mt-2 text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded" onclick="addDynamicTableRow(this, ${sIdx}, ${bIdx})"><i class="fas fa-plus"></i> Tambah Baris</button>
        `;
        } else if (type === 'note') {
        contentHtml = `
            <div class="font-bold text-sm text-slate-700 mb-2"><i class="fas fa-sticky-note mr-2"></i>Template Catatan</div>
            <div class="space-y-2">
                <input type="text" name="sections[${sIdx}][blocks][${bIdx}][title]" class="w-full px-3 py-1.5 border border-slate-200 rounded text-sm focus:ring-1 focus:ring-teal-500 font-bold" placeholder="Judul Catatan (Opsional)">
                <textarea name="sections[${sIdx}][blocks][${bIdx}][content]" class="new-rich-text w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Isi Catatan"></textarea>
            </div>
        `;
    } else if (type === 'dynamic_table') {
        const btn = container.lastElementChild.querySelector('button[onclick^="addDynamicTableRow"]');
        if(btn) addDynamicTableRow(btn, sIdx, bIdx);
    } else if (type === 'table') {
        // Auto add 1 row
        const btn = container.lastElementChild.querySelector('button[onclick^="addRowToBlock"]');
        if(btn) addRowToBlock(btn, sIdx, bIdx);
    }
};

document.addEventListener('DOMContentLoaded', () => {
    const btnTambahSection = $p('btnTambahSection');
    const sectionsContainer = $p('sectionsContainer');
    let sectionIndex = document.querySelectorAll('.section-card').length;

        document.querySelectorAll('.rich-text-section').forEach(field => {
        initQuillForSection(field);
    });

    // Collapse all existing sections by default to save space
    document.querySelectorAll('.section-card').forEach((card, index) => {
        // Let's keep the first section expanded so it's not totally empty, or collapse all
        const header = card.querySelector('.section-header');
        if (header) {
            // We simulate a click to collapse
            const body = header.nextElementSibling;
            if (body && body.style.display !== 'none') {
                toggleSectionCollapse(header);
            }
        }
    });

    if (btnTambahSection) {
        btnTambahSection.addEventListener('click', () => {
            const sIdx = sectionIndex++;
            // close other sections
            document.querySelectorAll('.section-card').forEach(card => {
                const b = card.querySelector('.section-body');
                const i = card.querySelector('.chevron-icon');
                if(b && i) {
                    b.style.display = 'none';
                    i.classList.remove('fa-chevron-up');
                    i.classList.add('fa-chevron-down');
                }
            });
            const sectionHtml = `
                <div class="section-card border border-slate-200 rounded-lg bg-white relative shadow-sm mb-6" data-index="${sIdx}">
                    <div class="section-header flex justify-between items-center p-4 cursor-pointer bg-slate-50 border-b border-slate-200 rounded-t-lg hover:bg-slate-100 transition" onclick="toggleSectionCollapse(this)">
                        <h4 class="font-bold text-slate-700 flex items-center gap-3">
                            <i class="fas fa-chevron-up transition-transform duration-200 chevron-icon"></i>
                            <span>Bagian <span class="section-number">${sIdx + 1}</span></span>
                        </h4>
                        <button type="button" class="text-red-500 hover:text-red-700 px-2 py-1" onclick="removeSectionBtn(this, event)" title="Hapus Bagian">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    <div class="section-body p-5 grid grid-cols-1 gap-4 transition-all">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Judul Bagian *</label>
                            <input type="text" name="sections[${sIdx}][title]" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" required placeholder="Contoh: BAGIAN 1: SURAT PENAWARAN RESMI">
                        </div>
                        <div id="blocks-container-${sIdx}" class="blocks-container space-y-4 border border-dashed border-slate-300 rounded p-4 bg-slate-50 min-h-[100px]">
                            <!-- Blocks will go here -->
                        </div>
                        <div class="mt-2 text-center">
                            <div class="dropdown inline-block relative group/dropdown">
                                <button type="button" class="bg-indigo-50 text-indigo-700 px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 hover:bg-indigo-100 transition">
                                    <i class="fas fa-plus-circle"></i> Tambah Input Baru ke Bagian Ini
                                </button>
                                <ul class="dropdown-menu absolute hidden group-hover/dropdown:block text-gray-700 pt-1 z-10 w-56 shadow-xl border border-slate-200 rounded-lg bg-white left-1/2 -translate-x-1/2 text-left">
                                    <li><a class="rounded-t hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock(${sIdx}, 'text')"><i class="fas fa-align-left w-5 text-slate-400"></i> Teks Bebas</a></li>
                                    <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock(${sIdx}, 'point_left')"><i class="fas fa-list-ul w-5 text-slate-400"></i> Template Poin (Kiri)</a></li>
                                    <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock(${sIdx}, 'point_top')"><i class="fas fa-list w-5 text-slate-400"></i> Template Poin (Atas)</a></li>
                                    <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock(${sIdx}, 'note')"><i class="fas fa-sticky-note w-5 text-slate-400"></i> Template Catatan</a></li>
                                    <li><a class="hover:bg-slate-50 py-3 px-4 block whitespace-no-wrap cursor-pointer" onclick="addBlock(${sIdx}, 'dynamic_table')"><i class="fas fa-table w-5 text-slate-400"></i> Template Tabel Dinamis</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            sectionsContainer.insertAdjacentHTML('beforeend', sectionHtml);
            
            // Auto-add first text block
            addBlock(sIdx, 'text');
        });
    }

    // intro type radio buttons

    // terms type radio buttons
    const customTerms = $p('custom_terms');
    const templateTerms = $p('template_terms');
    const termsTextarea = document.querySelector('textarea[name="ketentuan"]');
    const templateTermsText = "Waktu pengerjaan sesuai dengan kesepakatan\nHarga diatas sudah termasuk biaya instalasi dan deployment\nGaransi pemeliharaan selama 3 bulan\nPembayaran DP 50% dari total biaya\nPembayaran dapat ditransfer ke Rekening Elcoding";

    function handleTermsTypeChange() {
        if (templateTerms.checked) {
            termsTextarea.value = templateTermsText;
        } else if (customTerms.checked) {
            if (termsTextarea.value === templateTermsText) {
                termsTextarea.value = '';
            }
        }
    }

    if (customTerms) customTerms.addEventListener('change', handleTermsTypeChange);
    if (templateTerms) templateTerms.addEventListener('change', handleTermsTypeChange);
});
</script>
@endsection
