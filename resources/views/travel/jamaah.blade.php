@extends('travel.layout')

@section('title', 'Data Peserta & Manifest')
@section('page_title', 'Manifest Peserta & Jamaah')
@section('page_subtitle', 'Pencatatan data paspor, status visa, dokumen imigrasi, dan integrasi pesan broadcast via WhatsApp.')

@section('top_actions')
    <button type="button" onclick="document.getElementById('modalTambahPeserta').classList.remove('hidden')" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-user-plus"></i>
        <span>Tambah Peserta / Jamaah</span>
    </button>
@endsection

@section('content')
<div class="space-y-6">

    <!-- Modal Registrasi Peserta -->
    <div id="modalTambahPeserta" class="hidden fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="text-base font-extrabold text-slate-900">Registrasi Peserta / Jamaah Baru</h3>
                <button type="button" onclick="document.getElementById('modalTambahPeserta').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <form action="{{ route('travel.jamaah.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Peserta Sesuai Paspor / KTP</label>
                    <input type="text" name="nama" required placeholder="Contoh: Bpk. H. Rahmat Hidayat" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Pilih Paket Wisata</label>
                        <select name="paket_id" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                            @foreach($packages as $pkg)
                            <option value="{{ $pkg['id'] }}">{{ $pkg['nama'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">No. WhatsApp</label>
                        <input type="text" name="no_wa" required placeholder="0812xxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Paspor / KTP</label>
                        <input type="text" name="paspor" placeholder="Contoh: B1234567 (Exp 2029)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Dokumen</label>
                        <select name="status_dokumen" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                            <option value="Berkas Diterima">Berkas Diterima</option>
                            <option value="Proses Visa / Tiket">Proses Visa / Tiket</option>
                            <option value="Siap Berangkat" selected>Siap Berangkat</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Status Pembayaran</label>
                        <select name="status_pembayaran" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                            <option value="Lunas">Lunas</option>
                            <option value="DP 50% Terbayar">DP 50% Terbayar</option>
                            <option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Total Tagihan (Rp)</label>
                        <input type="number" name="total_tagihan" placeholder="31500000" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:outline-none">
                    </div>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="document.getElementById('modalTambahPeserta').classList.add('hidden')" class="px-4 py-2 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs font-bold">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold shadow-md">
                        Simpan Peserta
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Manifest -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Database Manifest Rombongan</h2>
                <p class="text-xs text-slate-500">Kelola dan kirim konfirmasi briefing keberangkatan langsung ke kontak WhatsApp peserta.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">ID Manifest</th>
                        <th class="px-5 py-3.5">Nama Peserta</th>
                        <th class="px-5 py-3.5">Paket Perjalanan</th>
                        <th class="px-5 py-3.5">Dokumen / Paspor</th>
                        <th class="px-5 py-3.5">Status Dokumen</th>
                        <th class="px-5 py-3.5">Status Billing</th>
                        <th class="px-5 py-3.5 text-center">Broadcast WA</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($participants as $pt)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4 font-mono font-bold text-slate-400">
                            {{ $pt['id'] }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-900 text-sm block">{{ $pt['nama'] }}</span>
                            <span class="text-slate-500 text-[11px] block mt-0.5"><i class="fa-solid fa-phone text-[10px] text-sky-600 mr-1"></i> {{ $pt['no_wa'] }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-800">{{ $pt['paket_nama'] }}</span>
                            <span class="text-[10px] text-slate-400 block font-mono">{{ $pt['paket_id'] }}</span>
                        </td>
                        <td class="px-5 py-4 text-slate-700">
                            {{ $pt['paspor'] }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-sky-100 text-sky-800">
                                {{ $pt['status_dokumen'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ str_contains($pt['status_pembayaran'], 'Lunas') ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $pt['status_pembayaran'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pt['no_wa']) }}?text={{ urlencode('Halo ' . $pt['nama'] . ', berikut informasi terkini mengenai paket ' . $pt['paket_nama'] . ' bersama L-Travel. Mohon periksa kembali kelengkapan paspor & perlengkapan Anda.') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white transition font-bold text-xs" title="Kirim Pesan WhatsApp">
                                <i class="fa-brands fa-whatsapp text-sm"></i>
                                <span>Kirim WA</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-400">Belum ada peserta terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

