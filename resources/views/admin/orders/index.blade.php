@extends('admin.layout')

@section('title', 'Manajemen Transaksi - Admin Elcoding')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 flex items-center gap-3">
                <i class="fas fa-shopping-cart text-blue-600"></i> Transaksi & Pembayaran Kursus
            </h1>
            <p class="text-sm text-slate-500 mt-1">Kelola data pembeli, konfirmasi pembayaran, dan pantau histori transaksi Xendit.</p>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-800 text-sm flex items-center gap-3">
            <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm flex items-center gap-3">
            <i class="fas fa-exclamation-circle text-rose-500 text-lg"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="surface-card p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-receipt"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Transaksi</p>
                <h3 class="text-2xl font-extrabold text-slate-800">{{ number_format($stats['total']) }}</h3>
            </div>
        </div>

        <div class="surface-card p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Lunas (Paid)</p>
                <h3 class="text-2xl font-extrabold text-slate-800">{{ number_format($stats['paid']) }}</h3>
            </div>
        </div>

        <div class="surface-card p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Menunggu</p>
                <h3 class="text-2xl font-extrabold text-slate-800">{{ number_format($stats['pending']) }}</h3>
            </div>
        </div>

        <div class="surface-card p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-wallet"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
                <h3 class="text-xl font-extrabold text-slate-800">Rp{{ number_format($stats['revenue'], 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="surface-card p-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
            <!-- Filter Status Buttons -->
            <div class="flex flex-wrap gap-2">
                <a href="{{ url('admin/orders') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ !request('status') || request('status') === 'all' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semua
                </a>
                <a href="{{ url('admin/orders?status=paid') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'paid' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Lunas
                </a>
                <a href="{{ url('admin/orders?status=pending') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'pending' ? 'bg-amber-500 text-white shadow-md shadow-amber-500/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Menunggu
                </a>
                <a href="{{ url('admin/orders?status=failed') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'failed' ? 'bg-rose-600 text-white shadow-md shadow-rose-500/20' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Gagal / Expired
                </a>
            </div>

            <!-- Search Form -->
            <form action="{{ url('admin/orders') }}" method="GET" class="w-full md:w-auto">
                @if(request('status')) <input type="hidden" name="status" value="{{ request('status') }}"> @endif
                <div class="relative w-full md:w-72">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, ID..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm outline-none focus:border-blue-500 focus:bg-white transition-all">
                    <i class="fas fa-search absolute left-3.5 top-3 text-slate-400 text-sm"></i>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full modern-table text-left border-collapse">
                <thead>
                    <tr>
                        <th class="p-4 rounded-l-xl">ID Transaksi</th>
                        <th class="p-4">Data Pembeli</th>
                        <th class="p-4">Program Kursus</th>
                        <th class="p-4">Nominal</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Tanggal</th>
                        <th class="p-4 rounded-r-xl text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <!-- ID Transaksi -->
                            <td class="p-4">
                                <span class="font-mono font-bold text-slate-800 text-xs bg-slate-100 px-2.5 py-1 rounded-md border border-slate-200">
                                    {{ $order->external_id }}
                                </span>
                            </td>

                            <!-- Data Pembeli -->
                            <td class="p-4">
                                <div class="font-bold text-slate-800">{{ $order->user_name }}</div>
                                <div class="text-xs text-slate-500 flex items-center gap-1.5 mt-0.5">
                                    <i class="fas fa-envelope text-slate-400"></i> {{ $order->user_email }}
                                </div>
                                @if($order->user_phone)
                                <div class="text-xs text-emerald-600 flex items-center gap-1.5 mt-0.5 font-medium">
                                    <i class="fab fa-whatsapp text-emerald-500"></i> 
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->user_phone) }}" target="_blank" class="hover:underline">
                                        {{ $order->user_phone }}
                                    </a>
                                </div>
                                @endif
                            </td>

                            <!-- Program Kursus -->
                            <td class="p-4">
                                <span class="font-semibold text-slate-700">
                                    {{ $order->programKursus->title ?? 'Program telah dihapus' }}
                                </span>
                            </td>

                            <!-- Nominal -->
                            <td class="p-4 font-bold text-slate-800">
                                Rp{{ number_format($order->amount, 0, ',', '.') }}
                            </td>

                            <!-- Status -->
                            <td class="p-4">
                                @if(in_array($order->status, ['paid', 'PAID', 'SETTLED']))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">
                                        <i class="fas fa-check-circle"></i> LUNAS
                                    </span>
                                @elseif($order->status === 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">
                                        <i class="fas fa-clock"></i> MENUNGGU
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-100 text-rose-700 text-xs font-bold rounded-full uppercase">
                                        <i class="fas fa-times-circle"></i> {{ $order->status }}
                                    </span>
                                @endif
                            </td>

                            <!-- Tanggal -->
                            <td class="p-4 text-xs text-slate-500">
                                <div>{{ $order->created_at->translatedFormat('d M Y, H:i') }}</div>
                                @if($order->paid_at)
                                    <div class="text-emerald-600 font-medium text-[11px] mt-0.5">
                                        Lunas: {{ $order->paid_at->translatedFormat('d M Y, H:i') }}
                                    </div>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Konfirmasi Lunas Quick Button -->
                                    @if($order->status !== 'paid')
                                    <form action="{{ url('admin/orders/' . $order->id . '/status') }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="paid">
                                        <button type="submit" onclick="return confirm('Konfirmasi bahwa transaksi {{ $order->external_id }} telah lunas?')" title="Konfirmasi Lunas Manual" class="px-2.5 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition-all flex items-center gap-1 shadow-sm">
                                            <i class="fas fa-check"></i> Lunas
                                        </button>
                                    </form>
                                    @endif

                                    <!-- Link Xendit Invoice -->
                                    @if($order->xendit_invoice_url)
                                    <a href="{{ $order->xendit_invoice_url }}" target="_blank" title="Buka Invoice Xendit" class="px-2.5 py-1.5 bg-blue-50 text-blue-600 border border-blue-200 rounded-lg text-xs font-semibold hover:bg-blue-100 transition-all flex items-center gap-1">
                                        <i class="fas fa-external-link-alt"></i> Xendit
                                    </a>
                                    @endif

                                    <!-- Delete Button -->
                                    <form action="{{ url('admin/orders/' . $order->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus Transaksi">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400">
                                <i class="fas fa-inbox text-4xl mb-3 block text-slate-300"></i>
                                Belum ada data transaksi yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="mt-6">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
