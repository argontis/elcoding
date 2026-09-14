@extends('member.layout')

@section('title', 'Dashboard - Member Elcoding')
@section('header', 'Dashboard')

@section('content')

<!-- Welcome Banner -->
<div class="surface-card overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-8 text-white">
        <h2 class="text-2xl font-extrabold mb-2">Selamat Datang, {{ $member->nama }}! 👋</h2>
        <p class="text-blue-100 text-sm">Akses modul pembelajaran, asesmen, dan invoice Anda di sini.</p>
    </div>
</div>

<!-- Member Info Card -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="surface-card p-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                <i class="fas fa-id-card text-blue-600 text-xl"></i>
            </div>
            <div>
                <p class="text-[12px] text-slate-500 font-semibold tracking-wide">Nomor Kartu</p>
                <h5 class="text-lg font-extrabold text-slate-800 tracking-wider font-mono">{{ $member->nomor_kartu }}</h5>
            </div>
        </div>
    </div>

    <div class="surface-card p-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center">
                <i class="fas fa-user text-emerald-600 text-xl"></i>
            </div>
            <div>
                <p class="text-[12px] text-slate-500 font-semibold tracking-wide">Nama</p>
                <h5 class="text-lg font-extrabold text-slate-800">{{ $member->nama }}</h5>
            </div>
        </div>
    </div>

    <div class="surface-card p-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
            </div>
            <div>
                <p class="text-[12px] text-slate-500 font-semibold tracking-wide">Alamat</p>
                <h5 class="text-lg font-extrabold text-slate-800">{{ $member->alamat ?? '-' }}</h5>
            </div>
        </div>
    </div>
</div>

<!-- Quick Navigation -->
<h3 class="text-lg font-bold text-slate-800 mb-4">Akses Cepat</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <a href="/member/learning-modul" class="surface-card p-6 group cursor-pointer">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 group-hover:bg-blue-600 flex items-center justify-center transition-colors">
                <i class="fas fa-book-open text-blue-600 group-hover:text-white text-xl transition-colors"></i>
            </div>
            <div>
                <h4 class="font-bold text-slate-800">Learning Modul</h4>
                <p class="text-xs text-slate-500">Akses materi pembelajaran</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-blue-600 text-sm font-bold group-hover:underline">Buka →</span>
        </div>
    </a>

    <a href="/member/asesmen" class="surface-card p-6 group cursor-pointer">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 group-hover:bg-amber-500 flex items-center justify-center transition-colors">
                <i class="fas fa-clipboard-check text-amber-600 group-hover:text-white text-xl transition-colors"></i>
            </div>
            <div>
                <h4 class="font-bold text-slate-800">Asesmen</h4>
                <p class="text-xs text-slate-500">Ikuti ujian dan evaluasi</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-amber-600 text-sm font-bold group-hover:underline">Buka →</span>
        </div>
    </a>

    <a href="/member/invoice" class="surface-card p-6 group cursor-pointer">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 group-hover:bg-emerald-600 flex items-center justify-center transition-colors">
                <i class="fas fa-file-invoice-dollar text-emerald-600 group-hover:text-white text-xl transition-colors"></i>
            </div>
            <div>
                <h4 class="font-bold text-slate-800">Invoice</h4>
                <p class="text-xs text-slate-500">Lihat riwayat pembayaran</p>
            </div>
        </div>
        <div class="text-right">
            <span class="text-emerald-600 text-sm font-bold group-hover:underline">Buka →</span>
        </div>
    </a>
</div>

@endsection
