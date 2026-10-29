@extends('travel.layout')

@section('title', 'Tagihan & Invoice')
@section('page_title', 'Keuangan & Tagihan Pemesanan')
@section('page_subtitle', 'Pantau penerimaan pembayaran DP, pelunasan paket tour, dan invoice digital jamaah.')

@section('content')
<div class="space-y-6">

    <!-- KPI Keuangan -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Nilai Pemesanan</span>
            <div class="text-2xl font-black text-slate-900 mt-2">
                @php
                    $total = array_reduce($participants, fn($acc, $pt) => $acc + $pt['total_tagihan'], 0);
                @endphp
                Rp {{ number_format($total, 0, ',', '.') }}
            </div>
            <p class="text-xs text-slate-500 mt-1">Dari {{ count($participants) }} pemesanan aktif</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Dana Terkumpul (Lunas)</span>
            <div class="text-2xl font-black text-emerald-600 mt-2">
                @php
                    $lunas = array_reduce(array_filter($participants, fn($pt) => str_contains($pt['status_pembayaran'], 'Lunas')), fn($acc, $pt) => $acc + $pt['total_tagihan'], 0);
                @endphp
                Rp {{ number_format($lunas, 0, ',', '.') }}
            </div>
            <p class="text-xs text-emerald-600 font-semibold mt-1">Pembayaran terverifikasi masuk</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Sisa Tagihan / DP</span>
            <div class="text-2xl font-black text-amber-500 mt-2">
                @php
                    $pending = array_reduce(array_filter($participants, fn($pt) => !str_contains($pt['status_pembayaran'], 'Lunas')), fn($acc, $pt) => $acc + ($pt['total_tagihan'] * 0.5), 0);
                @endphp
                Rp {{ number_format($pending, 0, ',', '.') }}
            </div>
            <p class="text-xs text-amber-600 font-semibold mt-1">Menunggu pelunasan jelang trip</p>
        </div>
    </div>

    <!-- Table Invoice -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Rincian Invoice & Pelunasan</h2>
                <p class="text-xs text-slate-500">Daftar invoice resmi dan tombol kirim nota pelunasan via WhatsApp.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">Invoice #</th>
                        <th class="px-5 py-3.5">Nama Pemesan</th>
                        <th class="px-5 py-3.5">Paket Perjalanan</th>
                        <th class="px-5 py-3.5">Total Biaya</th>
                        <th class="px-5 py-3.5">Status Pembayaran</th>
                        <th class="px-5 py-3.5 text-center">Nota Digital</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($participants as $idx => $pt)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4 font-mono font-bold text-slate-400">
                            INV-TRV-{{ str_pad($idx + 101, 4, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-bold text-slate-900 block">{{ $pt['nama'] }}</span>
                            <span class="text-slate-400 text-[10px]">{{ $pt['no_wa'] }}</span>
                        </td>
                        <td class="px-5 py-4 text-slate-700">
                            {{ $pt['paket_nama'] }}
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-900">
                            Rp {{ number_format($pt['total_tagihan'], 0, ',', '.') }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider {{ str_contains($pt['status_pembayaran'], 'Lunas') ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $pt['status_pembayaran'] }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pt['no_wa']) }}?text={{ urlencode('Halo ' . $pt['nama'] . ', berikut bukti invoice pemesanan tiket paket ' . $pt['paket_nama'] . ' sebesar Rp ' . number_format($pt['total_tagihan'], 0, ',', '.') . ' dari biro L-Travel. Terima kasih.') }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-sky-600 hover:text-white transition text-slate-700 text-xs font-bold">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>Kirim Nota</span>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-400">Belum ada transaksi invoice.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

