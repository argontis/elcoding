@extends('prosal.layout')

@section('title', 'Tagihan & Keuangan')
@section('page_title', 'Keuangan & Tagihan Sewa')
@section('page_subtitle', 'Pantau penerimaan pembayaran sewa, invoice bulanan, dan status tagihan seluruh properti.')

@section('content')
<div class="space-y-6">

    <!-- KPI Keuangan -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Potensi Sewa / Bln</span>
            <div class="text-2xl font-black text-slate-900 mt-2">
                @php
                    $total = array_reduce($units, fn($acc, $u) => $acc + $u['harga'], 0);
                @endphp
                Rp {{ number_format($total, 0, ',', '.') }}
            </div>
            <p class="text-xs text-slate-500 mt-1">Jika okupansi 100% dari {{ count($units) }} unit</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Penerimaan Terkumpul</span>
            <div class="text-2xl font-black text-emerald-600 mt-2">
                @php
                    $terkumpul = array_reduce(array_filter($tenants, fn($t) => $t['status_pembayaran'] === 'Lunas'), fn($acc, $t) => $acc + $t['nominal_sewa'], 0);
                @endphp
                Rp {{ number_format($terkumpul, 0, ',', '.') }}
            </div>
            <p class="text-xs text-emerald-600 font-semibold mt-1">Status Lunas bulan berjalan</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Menunggu Pembayaran</span>
            <div class="text-2xl font-black text-amber-500 mt-2">
                @php
                    $pending = array_reduce(array_filter($tenants, fn($t) => $t['status_pembayaran'] !== 'Lunas'), fn($acc, $t) => $acc + $t['nominal_sewa'], 0);
                @endphp
                Rp {{ number_format($pending, 0, ',', '.') }}
            </div>
            <p class="text-xs text-amber-600 font-semibold mt-1">Perlu tindak lanjut / reminder</p>
        </div>
    </div>

    <!-- Table Tagihan -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Rincian Invoice & Tagihan Tenant</h2>
                <p class="text-xs text-slate-500">Daftar kewajiban sewa bulanan dan integrasi pengiriman bukti pembayaran digital.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">Invoice #</th>
                        <th class="px-5 py-3.5">Nama Penyewa</th>
                        <th class="px-5 py-3.5">Unit Terkait</th>
                        <th class="px-5 py-3.5">Jumlah Tagihan</th>
                        <th class="px-5 py-3.5">Status Pembayaran</th>
                        <th class="px-5 py-3.5 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($tenants as $idx => $t)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4 font-mono font-bold text-slate-400">
                            INV-2026-{{ str_pad($idx + 101, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-900 block">{{ $t['nama'] }}</span>
                            <span class="text-slate-400 text-[10px]">{{ $t['telepon'] }}</span>
                        </td>
                        <td class="px-5 py-4 text-slate-700">
                            {{ $t['unit_nama'] }}
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-900">
                            Rp {{ number_format($t['nominal_sewa'], 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ $t['status_pembayaran'] === 'Lunas' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $t['status_pembayaran'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t['telepon']) }}?text={{ urlencode('Halo ' . $t['nama'] . ', berikut bukti tanda terima / rincian sewa unit ' . $t['unit_nama'] . ' sebesar Rp ' . number_format($t['nominal_sewa'], 0, ',', '.') . ' via L-Prosal Property.') }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-emerald-600 hover:text-white transition text-slate-700 text-xs font-bold">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>Kirim Bukti</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-400">Belum ada data tagihan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

