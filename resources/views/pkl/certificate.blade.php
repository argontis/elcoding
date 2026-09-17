@extends('pkl.layout')

@section('title', 'Sertifikat Kelulusan PKL - elc.my.id')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    
    <div>
        <h1 class="text-2xl font-extrabold text-white">Sertifikat Digital PKL & Magang</h1>
        <p class="text-slate-400 text-sm mt-1">Sertifikat keahlian dan kelulusan resmi terdaftar di elc.my.id</p>
    </div>

    @if($certificate)
        <!-- Certificate Card Visual -->
        <div class="relative bg-gradient-to-tr from-slate-900 via-indigo-950 to-slate-900 border-2 border-amber-500/40 rounded-3xl p-8 sm:p-12 shadow-2xl overflow-hidden text-center">
            <!-- Background Ornaments -->
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative z-10 space-y-6">
                
                <div class="flex items-center justify-center gap-3">
                    <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding" class="h-10 mx-auto">
                </div>

                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-widest text-amber-400 font-bold">SERTIFIKAT KELULUSAN MAGANG / PKL</p>
                    <p class="text-xs text-slate-400 font-mono">No. Reg: {{ $certificate->certificate_number }}</p>
                </div>

                <div class="py-4 border-y border-slate-700/60 max-w-xl mx-auto space-y-3">
                    <p class="text-xs text-slate-400">Diberikan secara resmi kepada:</p>
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-wide">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-slate-300">
                        {{ $profile->institution }} — {{ $profile->major }}
                    </p>
                    <p class="text-xs text-slate-400 pt-2 leading-relaxed">
                        Telah menyelesaikan seluruh rangkaian Praktik Kerja Lapangan (PKL) / Magang di elc.my.id 
                        pada divisi <strong class="text-blue-400">{{ $profile->program ? ($profile->program->title ?? $profile->program->name) : 'IT & Development' }}</strong>
                        dengan hasil akhir predikat:
                    </p>
                    <div class="inline-block px-5 py-2 bg-gradient-to-r from-amber-500 to-yellow-500 text-slate-950 font-black text-lg rounded-2xl shadow-lg shadow-amber-500/20">
                        🏆 PREDIKAT: {{ strtoupper($certificate->predicate) }}
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-4 text-xs text-slate-400 max-w-xl mx-auto pt-2">
                    <div>
                        <span class="block text-slate-500">Tanggal Diterbitkan</span>
                        <strong class="text-white">{{ $certificate->issue_date ? $certificate->issue_date->format('d M Y') : date('d M Y') }}</strong>
                    </div>
                    <div>
                        <span class="block text-slate-500">Verifikasi Keaslian</span>
                        <a href="{{ url('/verifikasi-sertifikat?code=' . urlencode($certificate->certificate_number)) }}" target="_blank" class="text-blue-400 underline font-semibold">
                            Cek Validitas Publik &rarr;
                        </a>
                    </div>
                </div>

                <div class="pt-6 flex flex-wrap items-center justify-center gap-4">
                    <a href="{{ url('/verifikasi-sertifikat?code=' . urlencode($certificate->certificate_number)) }}" target="_blank"
                       class="px-6 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-2xl shadow-lg transition flex items-center gap-2">
                        <i class="fas fa-external-link-alt"></i> Buka Halaman Verifikasi Sertifikat
                    </a>
                </div>

            </div>
        </div>
    @else
        <div class="bg-slate-800/40 border border-slate-700/50 rounded-3xl p-12 text-center">
            <div class="w-16 h-16 bg-amber-500/10 text-amber-400 rounded-3xl flex items-center justify-center mx-auto text-2xl mb-4">
                <i class="fas fa-certificate"></i>
            </div>
            <h3 class="text-lg font-bold text-white">Sertifikat Belum Diterbitkan</h3>
            <p class="text-slate-400 text-sm mt-1 max-w-md mx-auto">
                Sertifikat kelulusan magang akan diterbitkan oleh tim elc.my.id setelah Anda menyelesaikan seluruh tugas, penilaian quiz, dan periode masa PKL.
            </p>
        </div>
    @endif
</div>
@endsection
