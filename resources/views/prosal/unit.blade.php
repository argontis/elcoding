@extends('prosal.layout')

@section('title', 'Manajemen Unit Properti')
@section('page_title', 'Daftar Unit & Properti')
@section('page_subtitle', 'Kelola ketersediaan kamar, apartemen, ruko, serta tarif sewa bulanan.')

@section('top_actions')
    <button type="button" onclick="document.getElementById('modalTambahUnit').classList.remove('hidden')" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Unit Baru</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Modal Tambah Unit -->
    <div id="modalTambahUnit" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-base font-extrabold text-slate-900">Tambah Unit Properti Baru</h3>
                <button type="button" onclick="document.getElementById('modalTambahUnit').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('prosal.unit.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama / Nomor Unit Properti</label>
                    <input type="text" name="nama" required placeholder="Contoh: Apartemen Sudirman Lt. 21 A" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kategori</label>
                        <select name="kategori" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <option value="Apartemen">Apartemen</option>
                            <option value="Ruko">Ruko Komersial</option>
                            <option value="Kost Eksklusif">Kost Eksklusif</option>
                            <option value="Kantor">Ruang Kantor</option>
                            <option value="Rumah Sewa">Rumah Sewa</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Awal</label>
                        <select name="status" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <option value="Tersedia">Tersedia (Kosong)</option>
                            <option value="Tersewa">Tersewa</option>
                            <option value="Perbaikan">Dalam Perbaikan</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi Gedung / Alamat</label>
                    <input type="text" name="lokasi" required placeholder="Contoh: Tower B, Jakarta Selatan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Spesifikasi Unit</label>
                        <input type="text" name="tipe" placeholder="Contoh: 2 BR • 48 m²" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tarif Sewa (Rp / Bulan)</label>
                        <input type="number" name="harga" required placeholder="5000000" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalTambahUnit').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs font-bold">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md">
                        Simpan Unit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Card Grid Unit -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($units as $u)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between">
            <div class="p-5">
                <div class="flex items-start justify-between gap-2 mb-3">
                    <div>
                        <span class="text-[10px] font-mono font-bold text-slate-400 block">{{ $u['id'] }}</span>
                        <h3 class="text-base font-extrabold text-slate-900 leading-snug">{{ $u['nama'] }}</h3>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md {{ $u['status'] === 'Tersewa' ? 'bg-emerald-100 text-emerald-800' : ($u['status'] === 'Tersedia' ? 'bg-blue-100 text-blue-800' : 'bg-amber-100 text-amber-800') }}">
                        {{ $u['status'] }}
                    </span>
                </div>

                <div class="space-y-2 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-slate-400 w-4"></i>
                        <span>{{ $u['kategori'] }} ({{ $u['tipe'] }})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-location-dot text-slate-400 w-4"></i>
                        <span>{{ $u['lokasi'] }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-user text-slate-400 w-4"></i>
                        <span>Penyewa: <strong>{{ $u['penyewa'] }}</strong></span>
                    </div>
                </div>
            </div>

            <div class="px-5 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-semibold block">Tarif Sewa</span>
                    <span class="font-bold text-slate-900">Rp {{ number_format($u['harga'], 0, ',', '.') }}/bln</span>
                </div>
                <span class="text-[11px] text-slate-500">
                    @if($u['status'] === 'Tersewa')
                    Jatuh Tempo: <strong>{{ $u['jatuh_tempo'] }}</strong>
                    @else
                    Siap Dihuni
                    @endif
                </span>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection

