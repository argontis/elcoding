@extends('travel.layout')

@section('title', 'Overview Dashboard')
@section('page_title', 'Dashboard Biro Tour & Travel')
@section('page_subtitle', 'Pantau jadwal keberangkatan rombongan, keterisian kuota paket, manifest paspor, dan omzet pemesanan.')

@section('top_actions')
    <a href="{{ route('travel.paket') }}" class="px-3.5 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-plus"></i>
        <span>Kelola Paket</span>
    </a>
    <a href="{{ route('travel.jamaah') }}" class="px-3.5 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-sm">
        <i class="fa-solid fa-user-plus"></i>
        <span>Tambah Peserta</span>
    </a>
@endsection

@section('content')
<div class="space-y-6">

    <!-- 4 KPI Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Stat 1: Total Peserta / Jamaah -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Manifest</span>
                <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $totalParticipants }} Peserta</div>
                <div class="text-xs text-slate-500 mt-1 flex items-center gap-2">
                    <span class="text-emerald-600 font-bold">Semua Dokumen Lengkap</span>
                </div>
            </div>
        </div>

        <!-- Stat 2: Paket Wisata Aktif -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Paket Wisata</span>
                <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-route"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $totalPackages }} Rute</div>
                <div class="text-xs text-slate-500 mt-1">
                    Umroh, Domestik & Internasional
                </div>
            </div>
        </div>

        <!-- Stat 3: Okupansi Kursi Rombongan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Okupansi Kuota</span>
                <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-chair"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-black text-slate-900 tracking-tight">{{ $okupansiPersen }}%</div>
                <div class="w-full bg-slate-100 rounded-full h-2 mt-2 overflow-hidden">
                    <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $okupansiPersen }}%"></div>
                </div>
                <div class="text-[11px] text-slate-500 mt-1">
                    {{ $totalSeatTerisi }} dari {{ $totalSeatKapasitas }} seat terisi
                </div>
            </div>
        </div>

        <!-- Stat 4: Omzet Terkontrak -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Omzet Booking</span>
                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm font-bold">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-2xl font-black text-slate-900 tracking-tight truncate">Rp {{ number_format($omzetTerkontrak, 0, ',', '.') }}</div>
                <div class="text-xs text-emerald-600 font-semibold mt-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> Terverifikasi terbayar
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Banner -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-slate-900 via-sky-950 to-slate-900 text-white flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-md bg-sky-500/20 text-sky-400 text-xs font-bold mb-2">
                <i class="fa-solid fa-bolt"></i>
                Operasional L-Travel
            </div>
            <h2 class="text-lg font-bold text-white">Kelola Manifest Jamaah & Keberangkatan Wisata Tanpa Hambatan</h2>
            <p class="text-xs text-slate-300 mt-1">Kirimkan broadcast jadwal keberangkatan, rincian visa, dan briefing perlengkapan via WhatsApp hanya dalam satu klik.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('travel.paket') }}" class="px-4 py-2.5 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-xs transition">
                + Tambah Paket Trip
            </a>
            <a href="{{ route('travel.jamaah') }}" class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs transition border border-slate-700">
                Manifest Jamaah
            </a>
        </div>
    </div>

    <!-- Table Section 1: Daftar Paket & Keterisian Seat -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-base font-extrabold text-slate-900">Jadwal Keberangkatan & Keterisian Kuota</h2>
                <p class="text-xs text-slate-500">Daftar paket wisata dan perjalanan religi yang siap diberangkatkan.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('travel.paket') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700">
                    Buka Manajemen Paket <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">ID & Nama Paket</th>
                        <th class="px-5 py-3.5">Kategori & Durasi</th>
                        <th class="px-5 py-3.5">Jadwal Berangkat</th>
                        <th class="px-5 py-3.5">Biaya Paket</th>
                        <th class="px-5 py-3.5">Keterisian Kuota</th>
                        <th class="px-5 py-3.5">Tour Leader</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @forelse($packages as $p)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-5 py-4">
                            <span class="font-mono text-[11px] font-bold text-slate-400 block">{{ $p['id'] }}</span>
                            <span class="font-bold text-slate-900 text-sm">{{ $p['nama'] }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-700 text-[11px] font-bold">{{ $p['kategori'] }}</span>
                            <span class="text-slate-500 block text-[11px] mt-1">{{ $p['durasi'] }}</span>
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-700">
                            <i class="fa-regular fa-calendar text-sky-600 mr-1"></i> {{ $p['tanggal_berangkat'] }}
                        </td>
                        <td class="px-5 py-4 font-bold text-slate-900">
                            Rp {{ number_format($p['harga'], 0, ',', '.') }}<span class="text-[10px] text-slate-400 font-normal">/pax</span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-slate-800">{{ $p['kuota_terisi'] }} / {{ $p['kuota_total'] }}</span>
                                <div class="w-16 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-sky-500 h-1.5 rounded-full" style="width: {{ round(($p['kuota_terisi'] / $p['kuota_total']) * 100) }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700 font-semibold">
                            {{ $p['tour_leader'] }}
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($p['status'] === 'Penuh')
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-rose-100 text-rose-800">Penuh</span>
                            @else
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-emerald-100 text-emerald-800">Tersedia</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-400">Belum ada paket wisata aktif.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Grid 2 Columns: Manifest Peserta Terkini & Armada Siap -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Manifest Peserta -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">Manifest Jamaah & Notifikasi WA</h3>
                    <p class="text-xs text-slate-500">Kirim broadcast pengingat atau konfirmasi berkas</p>
                </div>
                <a href="{{ route('travel.jamaah') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @foreach($participants as $pt)
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-bold text-xs text-slate-900 truncate">{{ $pt['nama'] }}</span>
                            <span class="text-[10px] px-1.5 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold">
                                {{ $pt['status_pembayaran'] }}
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ $pt['paket_nama'] }}</p>
                        <p class="text-[10px] text-slate-400">Dokumen: {{ $pt['status_dokumen'] }}</p>
                    </div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pt['no_wa']) }}?text={{ urlencode('Halo ' . $pt['nama'] . ', kami dari L-Travel menginformasikan status keberangkatan paket ' . $pt['paket_nama']) }}" target="_blank" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white rounded-lg text-xs font-bold transition flex items-center gap-1.5 whitespace-nowrap">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                        <span>WA</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Armada & Transportasi -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">Kesiapan Armada & Transport</h3>
                    <p class="text-xs text-slate-500">Status kesiapan bus, kapal phinisi, & van transfer</p>
                </div>
                <a href="{{ route('travel.armada') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @foreach($armada as $arm)
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slate-800 truncate">{{ $arm['nama_kendaraan'] }}</span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full font-bold bg-sky-100 text-sky-800">
                            {{ $arm['status'] }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-600 leading-snug">Rute: {{ $arm['rute_tujuan'] }} ({{ $arm['plat_nomor'] }})</p>
                    <div class="flex items-center justify-between text-[10px] text-slate-400 pt-1 border-t border-slate-200/50">
                        <span>Driver/Pemandu: <strong class="text-slate-600">{{ $arm['driver'] }}</strong></span>
                        <span>{{ $arm['kapasitas'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection

