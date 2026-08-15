@extends('admin.layout')
@section('title', isset($mou) ? 'Edit MoU - Admin Elcoding' : 'Buat MoU - Admin Elcoding')
@section('header', isset($mou) ? 'Edit Mou' : 'Form Mou')

@section('content')
<div class="surface-card p-6 w-full">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h3 class="text-xl font-bold text-slate-800">{{ isset($mou) ? 'Edit MoU' : 'Form MoU' }}</h3>
        <p class="text-sm text-slate-500 mt-1">Harap isi detail proposal / MoU Elcoding</p>
    </div>

    <form action="{{ isset($mou) ? url('admin/mou/'.$mou->id) : url('admin/mou') }}" method="POST" id="mouFormPage">
        @csrf
        @if(isset($mou))
            @method('PUT')
        @endif
        <input type="hidden" name="items" id="itemsHidden">

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
                <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Pengantar Surat</label>
                <div class="flex items-center mb-2">
                    <input type="radio" id="custom_intro" name="pengantar_surat_type" value="custom" {{ (old('pengantar_surat_type', $mou->pengantar_surat_type ?? 'custom') == 'custom') ? 'checked' : '' }} class="mr-2">
                    <label for="custom_intro" class="text-sm text-slate-600">Custom</label>
                </div>
                <div class="flex items-center mb-2">
                    <input type="radio" id="template_intro" name="pengantar_surat_type" value="template" {{ (old('pengantar_surat_type', $mou->pengantar_surat_type ?? '') == 'template') ? 'checked' : '' }} class="mr-2">
                    <label for="template_intro" class="text-sm text-slate-600">Gunakan Template</label>
                </div>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 mb-2">Pengantar Surat</label>
                <textarea name="pengantar_surat" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" placeholder="Masukkan pengantar surat">{{ old('pengantar_surat', $mou->pengantar_surat ?? '') }}</textarea>
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

        <div class="mt-8 border-t border-slate-100 pt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-800">Surat Penawaran</h3>
                <button type="button" id="btnTambahItemPage" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tambah Item
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="itemsTablePage">
                    <thead>
                        <tr class="bg-slate-50 border-y border-slate-200 text-slate-600 text-sm">
                            <th class="p-3 font-semibold">No</th>
                            <th class="p-3 font-semibold">Spesifikasi</th>
                            <th class="p-3 font-semibold">Qty</th>
                            <th class="p-3 font-semibold">Harga (IDR)</th>
                            <th class="p-3 font-semibold">Total (IDR)</th>
                            <th class="p-3 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="itemsTableBodyPage" class="text-sm">
                        @if(isset($mou) && $mou->items)
                            @foreach($mou->items as $index => $item)
                            <tr id="itemRowPage{{ $index + 1 }}" class="border-b border-slate-100">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3"><input type="text" class="w-full px-3 py-1.5 border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" name="spesifikasi[]" value="{{ htmlspecialchars($item->spesifikasi) }}" required></td>
                                <td class="p-3"><input type="number" class="w-full px-3 py-1.5 border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 qty-input" step="0.01" min="0" name="qty[]" value="{{ rtrim(rtrim(number_format($item->qty, 2, '.', ''), '0'), '.') }}" required onchange="calculateTotalPage({{ $index + 1 }})"></td>
                                <td class="p-3"><input type="text" class="w-full px-3 py-1.5 border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 harga-input" name="harga[]" value="{{ number_format($item->harga, 0, ',', '.') }}" required onchange="calculateTotalPage({{ $index + 1 }})" onkeyup="formatCurrencyPage(this)"></td>
                                <td class="p-3 font-medium text-slate-700 total-cell" id="totalPage{{ $index + 1 }}">Rp. {{ number_format($item->total, 0, ',', '.') }},-</td>
                                <td class="p-3 text-center"><button type="button" class="text-red-500 hover:text-red-700 p-1" onclick="removeItemPage({{ $index + 1 }})"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr class="bg-slate-50">
                            <td colspan="4" class="p-4 text-right font-bold text-slate-800">Grand Total:</td>
                            <td class="p-4 font-bold text-slate-800" id="grandTotalPage">Rp. {{ isset($mou) ? number_format($mou->grand_total, 0, ',', '.') : '0' }},-</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
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
    </form>
</div>

<script>
const DEFAULT_DATE = '{{ date('Y-m-d') }}';
const $p = (id) => document.getElementById(id);

function addItemPage() {
    const tbody = $p('itemsTableBodyPage');
    if (!tbody) return;
    const n = tbody.querySelectorAll('tr').length + 1;
    const row = document.createElement('tr');
    row.id = 'itemRowPage' + n;
    row.className = 'border-b border-slate-100';
    row.innerHTML = `
        <td class="p-3">${n}</td>
        <td class="p-3"><input type="text" class="w-full px-3 py-1.5 border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500" name="spesifikasi[]" required></td>
        <td class="p-3"><input type="number" class="w-full px-3 py-1.5 border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 qty-input" step="0.01" min="0" name="qty[]" required onchange="calculateTotalPage(${n})"></td>
        <td class="p-3"><input type="text" class="w-full px-3 py-1.5 border border-slate-200 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 harga-input" name="harga[]" placeholder="0" required onchange="calculateTotalPage(${n})" onkeyup="formatCurrencyPage(this)"></td>
        <td class="p-3 font-medium text-slate-700 total-cell" id="totalPage${n}">Rp. 0,-</td>
        <td class="p-3 text-center"><button type="button" class="text-red-500 hover:text-red-700 p-1" onclick="removeItemPage(${n})"><i class="fas fa-trash-alt"></i></button></td>
    `;
    tbody.appendChild(row);
    updateItemNumbersPage();
}

function removeItemPage(id) {
    const row = $p('itemRowPage' + id);
    if (row) row.remove();
    updateItemNumbersPage();
    calculateGrandTotalPage();
}

function updateItemNumbersPage() {
    const rows = $p('itemsTableBodyPage')?.querySelectorAll('tr') || [];
    rows.forEach((row, idx) => {
        const n = idx + 1;
        row.id = 'itemRowPage' + n;
        const first = row.querySelector('td:first-child'); if (first) first.textContent = n;
        const qty = row.querySelector('.qty-input'); if (qty) qty.setAttribute('onchange', `calculateTotalPage(${n})`);
        const harga = row.querySelector('.harga-input'); if (harga) harga.setAttribute('onchange', `calculateTotalPage(${n})`);
        const total = row.querySelector('.total-cell'); if (total) total.id = 'totalPage' + n;
    });
}

function formatCurrencyPage(input) {
    let value = input.value.replace(/[^\d]/g, '');
    if (value) input.value = parseInt(value, 10).toLocaleString('id-ID');
}

function calculateTotalPage(id) {
    const row = $p('itemRowPage' + id);
    if (!row) return;
    const qty = parseFloat(row.querySelector('.qty-input')?.value || '0') || 0;
    const hargaStr = (row.querySelector('.harga-input')?.value || '').replace(/[^\d]/g, '');
    const harga = parseFloat(hargaStr || '0') || 0;
    const total = qty * harga;
    const cell = row.querySelector('.total-cell');
    if (cell) cell.textContent = 'Rp. ' + total.toLocaleString('id-ID') + ',-';
    calculateGrandTotalPage();
}

function calculateGrandTotalPage() {
    const rows = $p('itemsTableBodyPage')?.querySelectorAll('tr') || [];
    let grand = 0;
    rows.forEach(row => {
        const cell = row.querySelector('.total-cell');
        if (cell) {
            const v = parseFloat(cell.textContent.replace(/[^\d]/g, '')) || 0;
            grand += v;
        }
    });
    const el = $p('grandTotalPage'); if (el) el.textContent = 'Rp. ' + grand.toLocaleString('id-ID') + ',-';
}

document.addEventListener('DOMContentLoaded', () => {
    // init
    const existingRows = $p('itemsTableBodyPage')?.querySelectorAll('tr').length || 0;
    if (existingRows === 0) addItemPage();

    // button add
    const btnAdd = $p('btnTambahItemPage');
    if (btnAdd) btnAdd.onclick = () => { addItemPage(); return false; };

    // intro type radio buttons
    const customIntro = $p('custom_intro');
    const templateIntro = $p('template_intro');
    const introTextarea = document.querySelector('textarea[name="pengantar_surat"]');
    const templateText = "Dengan hormat,\nKami dari Elcoding, mengajukan penawaran harga untuk jasa pembuatan aplikasi/website sebagai berikut:";

    function handleIntroTypeChange() {
        if (templateIntro.checked) {
            introTextarea.value = templateText;
        } else if (customIntro.checked) {
            // Do not clear on edit
            if (!introTextarea.value.includes(templateText)) {
                // custom logic
            } else {
                introTextarea.value = '';
            }
        }
    }

    if (customIntro) customIntro.addEventListener('change', handleIntroTypeChange);
    if (templateIntro) templateIntro.addEventListener('change', handleIntroTypeChange);

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

    // form submit: build items JSON lalu submit normal
    const form = $p('mouFormPage');
    if (form) {
        form.addEventListener('submit', function(e) {
            const items = [];
            const rows = $p('itemsTableBodyPage')?.querySelectorAll('tr') || [];
            rows.forEach(row => {
                const spesifikasi = row.querySelector('input[name="spesifikasi[]"]')?.value;
                const qty = row.querySelector('input[name="qty[]"]')?.value;
                const harga = row.querySelector('input[name="harga[]"]')?.value;
                if (spesifikasi && qty && harga) items.push({ spesifikasi, qty, harga });
            });
            if (!items.length) { e.preventDefault(); alert('Minimal harus ada 1 item'); return; }
            const hidden = $p('itemsHidden');
            if (hidden) hidden.value = JSON.stringify(items);
        });
    }
});
</script>
@endsection
