@extends('travel.layout')

@section('title', 'Armada & Transportasi')
@section('page_title', 'Manajemen Armada & Transport')
@section('page_subtitle', 'Pantau kesiapan bus pariwisata, kapal charter/phinisi, driver, dan rute perjalanan.')

@section('top_actions')
    <button type="button" onclick="document.getElementById('modalTambahArmada').classList.remove('hidden')" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Armada</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Modal Tambah Armada -->
    <div id="modalTambahArmada" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-base font-extrabold text-slate-900">Tambah Armada Kendaraan Baru</h3>
                <button type="button" onclick="document.getElementById('modalTambahArmada').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('travel.armada.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kendaraan / Kapal</label>
                    <input type="text" name="nama_kendaraan" required placeholder="Contoh: Bus Pariwisata Jetbus 5 Shd" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Kapasitas Kursi / Kabin</label>
                        <input type="text" name="kapasitas" required placeholder="Contoh: 45 Seat (2-2)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Plat Nomor / Nama Kapal</label>
                        <input type="text" name="plat_nomor" required placeholder="Contoh: B 7890 TGA" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Vendor / PO Penyedia</label>
                        <input type="text" name="vendor" placeholder="Contoh: PO Nusantara Trans" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Driver / Kapten Ditugaskan</label>
                        <input type="text" name="driver" placeholder="Nama Driver / Pemandu" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Rute / Alokasi Penugasan</label>
                    <input type="text" name="rute_tujuan" placeholder="Contoh: Antar Jemput Bandara Soekarno Hatta" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalTambahArmada').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs font-bold">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold shadow-md">
                        Simpan Armada
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Armada -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Daftar Armada Transportasi</h2>
                <p class="text-xs text-slate-500">Status kesiapan operasional seluruh armada darat dan laut biro perjalanan.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">ID Armada</th>
                        <th class="px-5 py-3.5">Kendaraan & Kapasitas</th>
                        <th class="px-5 py-3.5">Plat / Identitas</th>
                        <th class="px-5 py-3.5">Vendor Penyedia</th>
                        <th class="px-5 py-3.5">Driver / Kapten</th>
                        <th class="px-5 py-3.5">Rute Penugasan</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($armada as $arm)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4 font-mono font-bold text-slate-400">
                            {{ $arm['id'] }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-900 block">{{ $arm['nama_kendaraan'] }}</span>
                            <span class="text-slate-500 text-[11px] block mt-0.5">{{ $arm['kapasitas'] }}</span>
                        </td>
                        <td class="px-5 py-4 font-mono font-bold text-sky-700">
                            {{ $arm['plat_nomor'] }}
                        </td>
                        <td class="px-5 py-4 text-slate-700">
                            {{ $arm['vendor'] }}
                        </td>
                        <td class="px-5 py-4 text-slate-800 font-semibold">
                            {{ $arm['driver'] }}
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ $arm['rute_tujuan'] }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-sky-100 text-sky-800">
                                {{ $arm['status'] }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-400">Belum ada armada terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

