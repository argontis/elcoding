@extends('prosal.layout')

@section('title', 'Overview Dashboard')
@section('page_title', 'Dashboard Real Estate & Properti')
@section('page_subtitle', 'Pantau performa okupansi, data penyewa aktif, serta status arus kas sewa properti.')

@section('top_actions')
    <a href="{{ route('prosal.unit') }}" class="px-3.5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-plus"></i>
        <span>Kelola Unit</span>
    </a>
    <a href="{{ route('prosal.penyewa') }}" class="px-3.5 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-user-plus"></i>
        <span>Penyewa Baru</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">

    <!-- 4 KPI Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Stat 1: Total Units -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Portofolio</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-building"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $totalUnits }} Unit</div>
                <div class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                    <span class="text-emerald-600 font-bold">{{ $terisiUnits }} Terisi</span> • 
                    <span class="text-slate-400">{{ $kosongUnits }} Kosong</span> • 
                    <span class="text-amber-500">{{ $perbaikanUnits }} Perbaikan</span>
                </div>
            </div>
        </div>

        <!-- Stat 2: Okupansi -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Tingkat Okupansi</span>
                <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $okupansiPersen }}%</div>
                <div class="w-full bg-slate-100 rounded-full h-2 mt-2 overflow-hidden">
                    <div class="bg-teal-500 h-2 rounded-full" style="width: {{ $okupansiPersen }}%"></div>
                </div>
            </div>
        </div>

        <!-- Stat 3: Pendapatan Sewa Bulanan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Pendapatan Terkontrak</span>
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-2xl font-black text-slate-900 tracking-tight truncate">Rp {{ number_format($totalPendapatanBulanan, 0, ',', '.') }}</div>
                <div class="text-xs text-slate-500 mt-1">
                    Estimasi omzet sewa aktif / bulan
                </div>
            </div>
        </div>

        <!-- Stat 4: Tiket Keluhan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Keluhan Fasilitas</span>
                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-wrench"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $pendingMaintenance }} Tiket</div>
                <div class="text-xs text-amber-600 font-bold mt-1">
                    Membutuhkan tindak lanjut teknisi
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Banner -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md bg-emerald-500/20 text-emerald-400 text-xs font-bold mb-2">
                <i class="fa-solid fa-bolt"></i>
                Fitur Unggulan L-Prosal
            </div>
            <h2 class="text-lg font-bold text-white">Kelola Properti Lebih Cepat Tanpa Kerumitan Pembukuan Manual</h2>
            <p class="text-xs text-slate-300 mt-1">Kirimkan nota tagihan sewa digital langsung via WhatsApp kepada tenant Anda hanya dengan satu klik.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('prosal.unit') }}" class="px-4 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs transition">
                + Tambah Unit Properti
            </a>
            <a href="{{ route('prosal.penyewa') }}" class="px-4 py-2.5 rounded-xl bg-slate-700 hover:bg-slate-600 text-white font-bold text-xs transition">
                Lihat Semua Penyewa
            </a>
        </div>
    </div>

    <!-- Table Section 1: Ringkasan Unit Terkelola -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Daftar Unit & Status Ketersediaan</h2>
                <p class="text-xs text-slate-500">Menampilkan seluruh unit properti yang terdaftar di portofolio Anda.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('prosal.unit') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">
                    Buka Manajemen Unit <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">ID & Nama Properti</th>
                        <th class="px-5 py-3.5">Kategori & Lokasi</th>
                        <th class="px-5 py-3.5">Spesifikasi</th>
                        <th class="px-5 py-3.5">Tarif Sewa</th>
                        <th class="px-5 py-3.5">Status</th>
                        <th class="px-5 py-3.5">Penyewa Aktif</th>
                        <th class="px-5 py-3.5 text-center">Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($units as $u)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4">
                            <span class="font-mono text-[11px] font-bold text-slate-400 block">{{ $u['id'] }}</span>
                            <span class="font-bold text-slate-900 text-sm">{{ $u['nama'] }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[11px] font-bold">{{ $u['kategori'] }}</span>
                            <span class="text-slate-500 block text-[11px] mt-1">{{ $u['lokasi'] }}</span>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            {{ $u['tipe'] }}
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-900">
                            Rp {{ number_format($u['harga'], 0, ',', '.') }}<span class="text-[10px] text-slate-400 font-normal">/bln</span>
                        </td>
                        <td class="px-5 py-4">
                            @if($u['status'] === 'Tersewa')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                                <i class="fa-solid fa-circle text-[6px] mr-1"></i> Tersewa
                            </span>
                            @elseif($u['status'] === 'Tersedia')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-blue-100 text-blue-800">
                                <i class="fa-solid fa-circle text-[6px] mr-1"></i> Tersedia
                            </span>
                            @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-amber-100 text-amber-800">
                                <i class="fa-solid fa-circle text-[6px] mr-1"></i> Perbaikan
                            </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-700 font-semibold">
                            {{ $u['penyewa'] }}
                        </td>
                        <td class="px-5 py-4 text-center text-slate-500">
                            {{ $u['jatuh_tempo'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-400">Belum ada unit terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grid 2 Columns: Penyewa Terkini & Tiket Maintenance -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Penyewa Aktif -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">Penyewa & Kontak WhatsApp</h3>
                    <p class="text-xs text-slate-500">Kirim reminder atau sapa penyewa langsung</p>
                </div>
                <a href="{{ route('prosal.penyewa') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @foreach(array_slice($tenants, 0, 3) as $t)
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-xs text-slate-900 truncate">{{ $t['nama'] }}</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded {{ $t['status_pembayaran'] === 'Lunas' ? 'bg-emerald-100 text-emerald-800 font-bold' : 'bg-amber-100 text-amber-800 font-bold' }}">
                                {{ $t['status_pembayaran'] }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ $t['unit_nama'] }}</p>
                        <p class="text-[10px] text-slate-400">Kontrak: {{ $t['mulai_sewa'] }} s/d {{ $t['akhir_sewa'] }}</p>
                    </div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t['telepon']) }}?text={{ urlencode('Halo ' . $t['nama'] . ', kami dari pengelola L-Prosal menginformasikan terkait unit ' . $t['unit_nama']) }}" target="_blank" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white rounded-lg text-xs font-bold transition flex items-center gap-1.5 whitespace-nowrap">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>WA</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Tiket Maintenance Aktif -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">Keluhan & Perbaikan Fasilitas</h3>
                    <p class="text-xs text-slate-500">Monitoring laporan kerusakan unit dari tenant</p>
                </div>
                <a href="{{ route('prosal.maintenance') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @foreach($maintenance as $m)
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slate-800 truncate">{{ $m['unit'] }}</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ $m['status'] === 'Selesai' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                            {{ $m['status'] }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 leading-snug">{{ $m['keluhan'] }}</p>
                    <div class="flex items-center justify-between text-[10px] text-slate-400 pt-1 border-t border-slate-200/50">
                        <span>Teknisi: <strong class="text-slate-600">{{ $m['teknisi'] }}</strong></span>
                        <span>{{ $m['tanggal'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

