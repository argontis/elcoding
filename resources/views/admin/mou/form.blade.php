@extends('admin.layout')
@section('title', isset($mou) ? 'Edit MoU - Admin Elcoding' : 'Buat MoU - Admin Elcoding')
@section('header', isset($mou) ? 'Edit Mou' : 'Form Mou')

@section('content')
<div class="surface-card p-6 w-full">
    <div class="mb-6 border-b border-slate-100 pb-4">
        <h3 class="text-xl font-bold text-slate-800">{{ isset($mou) ? 'Edit Mou' : 'Form Mou' }}</h3>
        <p class="text-sm text-slate-500 mt-1">Harap isi dengan teliti dan berhati hati</p>
    </div>

    <form action="{{ isset($mou) ? url('admin/mou/'.$mou->id) : url('admin/mou') }}" method="POST" id="mouForm">
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
                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $mou->tanggal ?? date('Y-m-d')) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi *</label>
                <select name="lokasi" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Pilih Lokasi</option>
                    @foreach(['Tegal', 'Cibubur', 'Purbalingga', 'Purwokerto'] as $loc)
                        <option value="{{ $loc }}" {{ (old('lokasi', $mou->lokasi ?? '') == $loc) ? 'selected' : '' }}>{{ $loc }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Customer *</label>
                <input type="text" name="nama_customer" value="{{ old('nama_customer', $mou->nama_customer ?? '') }}" placeholder="Masukkan nama customer" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Pengantar Surat</label>
            <div class="flex gap-4 mb-3">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="pengantar_surat_type" value="custom" class="w-4 h-4 text-blue-600" {{ (old('pengantar_surat_type', $mou->pengantar_surat_type ?? 'custom') == 'custom') ? 'checked' : '' }} onchange="toggleTextarea('pengantar', true)">
                    <span class="text-sm">Custom</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="pengantar_surat_type" value="template" class="w-4 h-4 text-blue-600" {{ (old('pengantar_surat_type', $mou->pengantar_surat_type ?? 'custom') == 'template') ? 'checked' : '' }} onchange="toggleTextarea('pengantar', false)">
                    <span class="text-sm">Gunakan Template</span>
                </label>
            </div>
            
            <div id="pengantar_container" style="{{ (old('pengantar_surat_type', $mou->pengantar_surat_type ?? 'custom') == 'template') ? 'display: none;' : '' }}">
                <label class="block text-sm font-bold text-slate-700 mb-2 mt-4">Pengantar Surat</label>
                <textarea name="pengantar_surat" rows="4" placeholder="Masukkan pengantar surat" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-y">{{ old('pengantar_surat', $mou->pengantar_surat ?? '') }}</textarea>
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-slate-700 mb-2">Pilih Ketentuan</label>
            <div class="flex gap-4 mb-3">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="ketentuan_type" value="custom" class="w-4 h-4 text-blue-600" {{ (old('ketentuan_type', $mou->ketentuan_type ?? 'custom') == 'custom') ? 'checked' : '' }} onchange="toggleTextarea('ketentuan', true)">
                    <span class="text-sm">Custom</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="ketentuan_type" value="template" class="w-4 h-4 text-blue-600" {{ (old('ketentuan_type', $mou->ketentuan_type ?? 'custom') == 'template') ? 'checked' : '' }} onchange="toggleTextarea('ketentuan', false)">
                    <span class="text-sm">Gunakan Template</span>
                </label>
            </div>
            
            <div id="ketentuan_container" style="{{ (old('ketentuan_type', $mou->ketentuan_type ?? 'custom') == 'template') ? 'display: none;' : '' }}">
                <label class="block text-sm font-bold text-slate-700 mb-2 mt-4">Ketentuan</label>
                <textarea name="ketentuan" rows="5" placeholder="Masukkan ketentuan satu per baris" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-y">{{ old('ketentuan', $mou->ketentuan ?? '') }}</textarea>
                <p class="text-xs text-slate-400 mt-1">Kosongkan untuk menggunakan ketentuan default</p>
            </div>
        </div>

        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-md font-bold text-slate-800">Surat Penawaran</h4>
                <button type="button" onclick="addItem()" class="bg-blue-800 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-900 transition flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Item
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left" id="itemsTable">
                    <thead>
                        <tr class="text-sm text-slate-700 border-b border-slate-200">
                            <th class="py-3 px-4 font-bold w-12 text-center">No</th>
                            <th class="py-3 px-4 font-bold">Spesifikasi</th>
                            <th class="py-3 px-4 font-bold w-24">Qty</th>
                            <th class="py-3 px-4 font-bold w-48">Harga (IDR)</th>
                            <th class="py-3 px-4 font-bold w-48">Total (IDR)</th>
                            <th class="py-3 px-4 font-bold w-16 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="itemsBody" class="text-sm divide-y divide-slate-100">
                        <!-- Items will be injected here -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="py-4 px-4 text-right font-bold text-slate-800">Grand Total:</td>
                            <td class="py-4 px-4 font-bold text-slate-800" id="grandTotalDisplay">Rp. 0,-</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <input type="hidden" name="grand_total" id="inputGrandTotal" value="{{ $mou->grand_total ?? 0 }}">
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
    function toggleTextarea(type, show) {
        document.getElementById(type + '_container').style.display = show ? 'block' : 'none';
    }

    let items = @json(isset($mou) ? $mou->items : []);
    
    // Add one empty item by default if empty
    if (items.length === 0) {
        items.push({ id: null, spesifikasi: '', qty: 1, harga: 0, total: 0 });
    }

    function renderItems() {
        const tbody = document.getElementById('itemsBody');
        tbody.innerHTML = '';
        let grandTotal = 0;

        items.forEach((item, index) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="py-3 px-4 text-center">${index + 1}</td>
                <td class="py-3 px-4">
                    <input type="text" name="items[${index}][spesifikasi]" value="${item.spesifikasi}" class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </td>
                <td class="py-3 px-4">
                    <input type="number" name="items[${index}][qty]" value="${item.qty}" min="1" oninput="updateItem(${index}, 'qty', this.value)" class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </td>
                <td class="py-3 px-4">
                    <input type="number" name="items[${index}][harga]" value="${item.harga}" min="0" oninput="updateItem(${index}, 'harga', this.value)" class="w-full px-3 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </td>
                <td class="py-3 px-4">
                    <span class="block px-3 py-2 text-slate-700 bg-slate-50 rounded-lg border border-slate-100">Rp. ${new Intl.NumberFormat('id-ID').format(item.total)},-</span>
                    <input type="hidden" name="items[${index}][total]" value="${item.total}">
                </td>
                <td class="py-3 px-4 text-center">
                    <button type="button" onclick="removeItem(${index})" class="text-red-500 hover:text-red-700 border border-red-100 bg-red-50 hover:bg-red-100 rounded-md px-2 py-1 transition">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
            grandTotal += parseInt(item.total) || 0;
        });

        document.getElementById('grandTotalDisplay').innerText = `Rp. ${new Intl.NumberFormat('id-ID').format(grandTotal)},-`;
        document.getElementById('inputGrandTotal').value = grandTotal;
    }

    function addItem() {
        items.push({ id: null, spesifikasi: '', qty: 1, harga: 0, total: 0 });
        renderItems();
    }

    function updateItem(index, field, value) {
        items[index][field] = value;
        
        // Recalculate total for this item
        const qty = parseInt(items[index].qty) || 0;
        const harga = parseInt(items[index].harga) || 0;
        items[index].total = qty * harga;
        
        renderItems();
        
        // Re-focus the input that was being typed into (hacky workaround for complete re-render)
        // A better approach would be updating DOM directly, but for simplicity we'll focus the last edited input.
        setTimeout(() => {
            const inputs = document.getElementsByName(`items[${index}][${field}]`);
            if(inputs.length > 0) {
                inputs[0].focus();
                // move cursor to end
                const val = inputs[0].value;
                inputs[0].value = '';
                inputs[0].value = val;
            }
        }, 10);
    }

    function removeItem(index) {
        if(items.length <= 1) {
            alert('Minimal harus ada 1 item penawaran.');
            return;
        }
        items.splice(index, 1);
        renderItems();
    }

    // Initial render
    document.addEventListener('DOMContentLoaded', () => {
        renderItems();
    });
</script>
@endsection
