@extends('member.layout')

@section('title', 'Invoice - Member Elcoding')
@section('header', 'Invoice')

@section('content')

<div class="surface-card overflow-hidden">
    <div class="p-8 text-center">
        <div class="w-20 h-20 rounded-2xl bg-emerald-50 flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-file-invoice-dollar text-emerald-600 text-3xl"></i>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-800 mb-3">Invoice</h2>
        <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
            Fitur invoice akan segera tersedia. Anda akan dapat melihat riwayat pembayaran, mengunduh invoice, dan melacak status transaksi di sini.
        </p>
        <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-700 px-4 py-2 rounded-xl text-sm font-bold">
            <i class="fas fa-clock"></i>
            <span>Segera Hadir</span>
        </div>
    </div>
</div>

@endsection
