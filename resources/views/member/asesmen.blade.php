@extends('member.layout')

@section('title', 'Asesmen - Member Elcoding')
@section('header', 'Asesmen')

@section('content')

<div class="surface-card overflow-hidden">
    <div class="p-8 text-center">
        <div class="w-20 h-20 rounded-2xl bg-amber-50 flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-clipboard-check text-amber-600 text-3xl"></i>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-800 mb-3">Asesmen</h2>
        <p class="text-slate-500 text-sm max-w-md mx-auto mb-6">
            Fitur asesmen akan segera tersedia. Anda akan dapat mengikuti ujian, kuis, dan evaluasi pembelajaran di sini.
        </p>
        <div class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 px-4 py-2 rounded-xl text-sm font-bold">
            <i class="fas fa-clock"></i>
            <span>Segera Hadir</span>
        </div>
    </div>
</div>

@endsection
