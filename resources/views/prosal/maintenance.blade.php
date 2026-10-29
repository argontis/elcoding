@extends('prosal.layout')

@section('title', 'Maintenance & Keluhan')
@section('page_title', 'Keluhan & Pemeliharaan Fasilitas')
@section('page_subtitle', 'Pantau keluhan fasilitas, penugasan teknisi, dan status penyelesaian perbaikan unit.')

@section('top_actions')
    <button type="button" onclick="document.getElementById('modalTambahTiket').classList.remove('hidden')" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-plus"></i>
        <span>Buat Tiket Perbaikan</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Modal Tambah Tiket -->
    <div id="modalTambahTiket" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-base font-extrabold text-slate-900">Buat Tiket Keluhan / Perbaikan</h3>
                <button type="button" onclick="document.getElementById('modalTambahTiket').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('prosal.maintenance.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Unit Properti</label>
                    <select name="unit" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        @foreach($units as $u)
                        <option value="{{ $u['nama'] }}">{{ $u['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Rincian Keluhan / Kerusakan</label>
                    <textarea name="keluhan" required rows="3" placeholder="Contoh: Lampu koridor mati, stop kontak kamar mandi korslet..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tingkat Prioritas</label>
                        <select name="prioritas" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            <option value="Rendah">Rendah (Fasilitas Ringan)</option>
                            <option value="Sedang" selected>Sedang (Perlu Penanganan)</option>
                            <option value="Tinggi">Tinggi (Darurat / Kebocoran / Listrik)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Teknisi / PIC Ditugaskan</label>
                        <input type="text" name="teknisi" placeholder="Contoh: Pak Joko (Teknisi Listrik)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Pelapor</label>
                    <input type="text" name="pelapor" placeholder="Contoh: Tenant Kamar / Pengelola" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalTambahTiket').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs font-bold">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md">
                        Simpan Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Tiket Maintenance -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Daftar Tiket Perbaikan Fasilitas</h2>
                <p class="text-xs text-slate-500">Seluruh laporan pemeliharaan unit yang sedang aktif maupun yang telah diselesaikan.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">ID Tiket</th>
                        <th class="px-5 py-3.5">Unit Properti</th>
                        <th class="px-5 py-3.5">Rincian Masalah</th>
                        <th class="px-5 py-3.5">Pelapor</th>
                        <th class="px-5 py-3.5">Prioritas</th>
                        <th class="px-5 py-3.5">Teknisi Ditugaskan</th>
                        <th class="px-5 py-3.5">Status Tiket</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($maintenance as $m)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4 font-mono font-bold text-slate-400">
                            {{ $m['id'] }}
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-900">
                            {{ $m['unit'] }}
                        </td>
                        <td class="px-5 py-4 text-slate-700 max-w-xs">
                            {{ $m['keluhan'] }}
                            <span class="text-[10px] text-slate-400 block mt-1"><i class="fa-regular fa-clock mr-1"></i>Dilaporkan: {{ $m['tanggal'] }}</span>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ $m['pelapor'] }}
                        </td>
                        <td class="px-5 py-4">
                            @if($m['prioritas'] === 'Tinggi')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-rose-100 text-rose-800">Tinggi</span>
                            @elseif($m['prioritas'] === 'Sedang')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-amber-100 text-amber-800">Sedang</span>
                            @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-slate-100 text-slate-700">Rendah</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-700 font-semibold">
                            {{ $m['teknisi'] }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ $m['status'] === 'Selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $m['status'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-400">Belum ada tiket maintenance.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

