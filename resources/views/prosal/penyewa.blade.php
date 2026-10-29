@extends('prosal.layout')

@section('title', 'Data Penyewa & Tenant')
@section('page_title', 'Manajemen Penyewa (Tenants)')
@section('page_subtitle', 'Pencatatan data kontak penyewa, masa sewa aktif, serta integrasi reminder tagihan via WhatsApp.')

@section('top_actions')
    <button type="button" onclick="document.getElementById('modalTambahPenyewa').classList.remove('hidden')" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-user-plus"></i>
        <span>Registrasi Penyewa</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Modal Registrasi Penyewa -->
    <div id="modalTambahPenyewa" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-base font-extrabold text-slate-900">Registrasi Penyewa Baru</h3>
                <button type="button" onclick="document.getElementById('modalTambahPenyewa').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('prosal.penyewa.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Penyewa / Perusahaan</label>
                    <input type="text" name="nama" required placeholder="Contoh: Bpk. Budi Santoso" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Unit Properti</label>
                        <select name="unit_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                            @foreach($units as $u)
                            <option value="{{ $u['id'] }}">{{ $u['nama'] }} ({{ $u['status'] }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp</label>
                        <input type="text" name="telepon" required placeholder="0812xxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Email Penyewa (Opsional)</label>
                    <input type="email" name="email" placeholder="budi@example.com" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nominal Sewa (Rp / Bulan)</label>
                        <input type="number" name="nominal_sewa" required placeholder="5000000" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Jatuh Tempo Pembayaran</label>
                        <input type="text" name="jatuh_tempo" placeholder="Tgl 15 tiap bulan" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalTambahPenyewa').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs font-bold">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-md">
                        Simpan Data Penyewa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Penyewa -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Database Tenant Aktif</h2>
                <p class="text-xs text-slate-500">Kelola dan kirim pesan konfirmasi sewa secara instan ke kontak tenant.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">ID Tenant</th>
                        <th class="px-5 py-3.5">Nama & Kontak</th>
                        <th class="px-5 py-3.5">Unit Sewa</th>
                        <th class="px-5 py-3.5">Masa Kontrak</th>
                        <th class="px-5 py-3.5">Nominal Sewa</th>
                        <th class="px-5 py-3.5">Status Billing</th>
                        <th class="px-5 py-3.5 text-center">Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($tenants as $t)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4 font-mono font-bold text-slate-400">
                            {{ $t['id'] }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-900 text-sm block">{{ $t['nama'] }}</span>
                            <span class="text-slate-500 text-[11px] block mt-0.5"><i class="fa-solid fa-phone text-[10px] text-emerald-600 mr-1"></i> {{ $t['telepon'] }}</span>
                            <span class="text-slate-400 text-[10px] block">{{ $t['email'] }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-800">{{ $t['unit_nama'] }}</span>
                            <span class="text-[10px] text-slate-400 block font-mono">{{ $t['unit_id'] }}</span>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ $t['mulai_sewa'] }} — {{ $t['akhir_sewa'] }}
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-900">
                            Rp {{ number_format($t['nominal_sewa'], 0, ',', '.') }}<span class="text-[10px] text-slate-400 font-normal">/bln</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ $t['status_pembayaran'] === 'Lunas' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $t['status_pembayaran'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t['telepon']) }}?text={{ urlencode('Halo ' . $t['nama'] . ', ini pengingat tagihan sewa unit ' . $t['unit_nama'] . ' sebesar Rp ' . number_format($t['nominal_sewa'], 0, ',', '.') . '. Terima kasih.') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white transition font-bold text-xs" title="Kirim Pengingat WhatsApp">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Kirim WA</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-400">Belum ada tenant terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

