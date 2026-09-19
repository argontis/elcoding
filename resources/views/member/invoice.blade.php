@extends('member.layout')

@section('title', 'Invoice - Member Elcoding')
@section('header', 'Invoice')

@section('content')

<!-- Header Section -->
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Invoice</h1>
        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-bold rounded-full border border-indigo-100">Billing Hub</span>
    </div>
    <p class="text-slate-500 text-sm w-full max-w-sm leading-relaxed">
        Kelola riwayat tagihan, pembayaran, dan status transaksi pembelajaran.
    </p>
</div>

<!-- 3 Info Cards -->
<div class="flex flex-col lg:flex-row gap-6 mb-8">
    <div class="surface-card p-6 flex items-start gap-4 flex-1">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl shrink-0">
            <i class="fas fa-id-badge"></i>
        </div>
        <div>
            <div class="flex justify-between items-start gap-2 mb-1">
                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nomor Kartu / ID Siswa</p>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600">Aktif</span>
            </div>
            <p class="text-lg font-bold text-slate-800 leading-snug break-all">{{ $member->nomor_kartu ?? $member->rfid_uid ?? 'Belum Diatur' }}</p>
        </div>
    </div>
    <div class="surface-card p-6 flex items-start gap-4 flex-1">
        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl shrink-0">
            <i class="fas fa-user-circle"></i>
        </div>
        <div>
            <div class="flex justify-between items-start gap-2 mb-1">
                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Nama Lengkap</p>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-purple-50 text-purple-600">Terverifikasi</span>
            </div>
            <p class="text-lg font-bold text-slate-800 leading-snug">{{ $member->nama ?? $member->name }}</p>
        </div>
    </div>
    <div class="surface-card p-6 flex items-start gap-4 flex-1">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl shrink-0">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <div>
            <div class="flex justify-between items-start gap-2 mb-1">
                <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Alamat Domisili</p>
                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600">Indonesia</span>
            </div>
            <p class="text-lg font-bold text-slate-800 leading-snug">{{ $member->alamat ?? $member->kota ?? 'Belum Diatur' }}</p>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 mt-6">
    <!-- Tagihan Pending -->
    <div class="surface-card p-6 relative overflow-hidden flex flex-col justify-center">
        <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-indigo-50 to-transparent"></div>
        <p class="text-sm font-semibold text-slate-500 mb-1 relative z-10">Total Tagihan Pending</p>
        <h2 class="text-3xl font-extrabold text-slate-900 mb-4 relative z-10">Rp {{ number_format($totalPending, 0, ',', '.') }}</h2>
        <div class="flex items-center justify-between text-xs font-semibold relative z-10">
            <span class="text-slate-500 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> {{ $profile ? $profile->invoices()->where('status', 'pending')->count() : 0 }} transaksi menunggu pembayaran</span>
            <span class="bg-indigo-100 text-indigo-700 px-2 py-1 rounded-md">Jatuh tempo 7 hari</span>
        </div>
        <div class="absolute right-6 top-6 w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-xl shadow-inner z-10">
            <i class="fas fa-wallet"></i>
        </div>
    </div>

    <!-- Total Lunas -->
    <div class="surface-card p-6 relative overflow-hidden flex flex-col justify-center">
        <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-emerald-50 to-transparent"></div>
        <p class="text-sm font-semibold text-slate-500 mb-1 relative z-10">Total Lunas</p>
        <h2 class="text-3xl font-extrabold text-slate-900 mb-4 relative z-10">Rp {{ number_format($totalLunas, 0, ',', '.') }}</h2>
        <div class="flex items-center justify-between text-xs font-semibold relative z-10">
            <span class="text-slate-500 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> {{ $profile ? $profile->invoices()->where('status', 'paid')->count() : 0 }} transaksi berhasil dibayar</span>
            <span class="bg-emerald-100 text-emerald-700 px-2 py-1 rounded-md flex items-center gap-1"><i class="fas fa-arrow-trend-up"></i> +14.2% bln ini</span>
        </div>
        <div class="absolute right-6 top-6 w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shadow-inner z-10">
            <i class="fas fa-money-bill-wave"></i>
        </div>
    </div>
</div>

<!-- Search & Filter Bar -->
<form method="GET" action="{{ route('member.invoice') }}" class="surface-card p-2 flex flex-col sm:flex-row items-center gap-2 mb-6">
    <div class="relative flex-1 w-full">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. Invoice atau nama paket..." class="w-full pl-11 pr-4 py-2.5 bg-slate-50 hover:bg-slate-100 focus:bg-white border-0 rounded-xl text-sm font-medium text-slate-700 focus:ring-2 focus:ring-blue-500 transition-colors">
    </div>
    
    <div class="w-full sm:w-auto shrink-0 flex items-center gap-2">
        <select name="status" class="py-2.5 px-4 bg-slate-50 border-0 rounded-xl text-sm font-medium text-slate-700 focus:ring-2 focus:ring-blue-500 appearance-none pr-10 relative cursor-pointer" onchange="this.form.submit()">
            <option value="semua">Semua Status</option>
            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Belum Lunas</option>
        </select>
        <div class="relative hidden md:block">
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400"><i class="fas fa-calendar-alt"></i></div>
            <select class="py-2.5 pl-4 pr-10 bg-slate-50 border-0 rounded-xl text-sm font-medium text-slate-700 focus:ring-2 focus:ring-blue-500 appearance-none cursor-pointer">
                <option>Bulan Ini</option>
            </select>
        </div>
        <button type="button" class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm rounded-xl transition flex items-center gap-2">
            <i class="fas fa-download"></i> <span class="hidden sm:inline">Export PDF/Excel</span>
        </button>
    </div>
</form>

<!-- Invoice Table -->
<div class="surface-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50/80 text-xs uppercase font-extrabold text-slate-500 tracking-wider">
                <tr>
                    <th class="px-6 py-4">No. Invoice</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Paket Pembelajaran</th>
                    <th class="px-6 py-4">Jumlah</th>
                    <th class="px-6 py-4">Status Pembayaran</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($invoices as $invoice)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-5 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <span class="font-bold text-slate-800">{{ $invoice->invoice_code }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap text-slate-500 font-medium">
                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}
                    </td>
                    <td class="px-6 py-5">
                        <div class="font-bold text-slate-800 mb-0.5 line-clamp-2 max-w-[250px]">{{ $invoice->description }}</div>
                        <div class="text-[11px] text-slate-400 font-medium">Metode: {{ $invoice->payment_method ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap font-bold text-slate-800">
                        Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap">
                        @if($invoice->status === 'paid')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Belum Lunas
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 whitespace-nowrap text-right">
                        <button type="button" class="inline-flex items-center justify-center px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-[11px] font-bold rounded-lg transition-colors gap-1 shadow-sm shadow-blue-500/20">
                            Detail <i class="fas fa-arrow-right text-[10px]"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-file-invoice text-slate-300 text-2xl"></i>
                        </div>
                        <p class="font-bold text-slate-700">Tidak ada data invoice</p>
                        <p class="text-xs mt-1">Belum ada transaksi pembelajaran yang tercatat.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if(isset($profile) && $invoices->hasPages())
    <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="text-xs font-semibold text-slate-500">
            Menampilkan {{ $invoices->firstItem() ?? 0 }}-{{ $invoices->lastItem() ?? 0 }} dari {{ $invoices->total() ?? 0 }} data
        </div>
        <div>
            {{ $invoices->links('vendor.pagination.tailwind') ?? '' }}
        </div>
    </div>
    @endif
</div>

@endsection
