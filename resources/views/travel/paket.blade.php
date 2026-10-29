@extends('travel.layout')

@section('title', 'Manajemen Paket Perjalanan')
@section('page_title', 'Daftar Paket Tour & Umroh')
@section('page_subtitle', 'Kelola destinasi wisata, jadwal keberangkatan, alokasi kuota seat, dan biaya per pax.')

@section('top_actions')
    <button type="button" onclick="document.getElementById('modalTambahPaket').classList.remove('hidden')" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Paket Baru</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Modal Tambah Paket -->
    <div id="modalTambahPaket" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-base font-extrabold text-slate-900">Tambah Paket Perjalanan Baru</h3>
                <button type="button" onclick="document.getElementById('modalTambahPaket').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('travel.paket.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Paket Wisata / Rute</label>
                    <input type="text" name="nama" required placeholder="Contoh: Umroh Reguler Syawal 9 Hari" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kategori</label>
                        <select name="kategori" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                            <option value="Umroh & Religi">Umroh & Religi</option>
                            <option value="Domestik">Wisata Domestik</option>
                            <option value="Internasional">Wisata Internasional</option>
                            <option value="Open Trip">Open Trip</option>
                            <option value="Family Gathering">Family / Corporate</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Durasi</label>
                        <input type="text" name="durasi" placeholder="Contoh: 9H 8M atau 3D2N" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Keberangkatan</label>
                        <input type="text" name="tanggal_berangkat" required placeholder="Contoh: 15 Des 2026" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Total Kuota Seat</label>
                        <input type="number" name="kuota_total" required placeholder="45" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Harga Paket (Rp / Pax)</label>
                        <input type="number" name="harga" required placeholder="15000000" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tour Leader / Ustadz</label>
                        <input type="text" name="tour_leader" placeholder="Nama Pemandu / TL" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalTambahPaket').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs font-bold">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold shadow-md">
                        Simpan Paket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grid Paket -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($packages as $p)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between">
            <div class="p-5">
                <div class="flex items-start justify-between gap-2 mb-3">
                    <div>
                        <span class="text-[10px] font-mono font-bold text-slate-400 block">{{ $p['id'] }}</span>
                        <h3 class="text-base font-extrabold text-slate-900 leading-snug">{{ $p['nama'] }}</h3>
                    </div>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md {{ $p['status'] === 'Penuh' ? 'bg-rose-100 text-rose-800' : 'bg-emerald-100 text-emerald-800' }}">
                        {{ $p['status'] }}
                    </span>
                </div>

                <div class="space-y-2 text-xs text-slate-600">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-layer-group text-slate-400 w-4"></i>
                        <span>{{ $p['kategori'] }} ({{ $p['durasi'] }})</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-calendar-check text-slate-400 w-4"></i>
                        <span>Keberangkatan: <strong>{{ $p['tanggal_berangkat'] }}</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-user-tie text-slate-400 w-4"></i>
                        <span>Pemandu: {{ $p['tour_leader'] }}</span>
                    </div>
                </div>

                <!-- Seat Progress -->
                <div class="mt-4 pt-3 border-t border-slate-100">
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1">
                        <span>Keterisian Kuota</span>
                        <span class="font-bold text-slate-900">{{ $p['kuota_terisi'] }} / {{ $p['kuota_total'] }} Pax</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                        <div class="bg-sky-500 h-2 rounded-full" style="width: {{ round(($p['kuota_terisi'] / $p['kuota_total']) * 100) }}%"></div>
                    </div>
                </div>
            </div>

            <div class="px-5 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-semibold block">Harga per Pax</span>
                    <span class="font-bold text-slate-900">Rp {{ number_format($p['harga'], 0, ',', '.') }}</span>
                </div>
                <span class="text-[11px] font-bold text-sky-600">
                    Sisa {{ $p['kuota_total'] - $p['kuota_terisi'] }} Seat
                </span>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection

