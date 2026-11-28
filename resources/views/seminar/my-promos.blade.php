@extends('seminar.layout')

@section('title', 'Promo Diminati - Portal Seminar')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Promo &amp; Benefit yang Anda Minati</h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">Pantau status penawaran yang sudah Anda pilih dan tindak lanjut dari admin.</p>
        </div>
        <a href="{{ route('seminar.dashboard') }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold rounded-xl border border-slate-700 transition self-start sm:self-auto">
            <i class="fas fa-arrow-left mr-1"></i> Lihat Semua Promo
        </a>
    </div>

    @if($interestedItems->count() > 0)
        <div class="space-y-4">
            @foreach($interestedItems as $item)
                @php
                    $statusBadge = match($item->status) {
                        'claimed' => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                        'contacted' => 'bg-blue-500/20 text-blue-300 border-blue-500/30',
                        'declined' => 'bg-red-500/20 text-red-300 border-red-500/30',
                        default => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                    };
                    $statusLabel = match($item->status) {
                        'claimed' => 'Sudah Diklaim',
                        'contacted' => 'Sudah Dihubungi Admin',
                        'declined' => 'Tidak Dilanjutkan',
                        default => 'Menunggu Follow-Up Admin',
                    };
                @endphp

                <div class="bg-slate-800/70 border border-slate-700/70 rounded-3xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-2">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold border {{ $statusBadge }}">
                                {{ $statusLabel }}
                            </span>
                            @if($item->promo?->promo_code)
                                <span class="px-2.5 py-1 rounded-full text-[11px] font-mono font-bold bg-slate-900 text-emerald-300 border border-slate-700">
                                    Kode: {{ $item->promo->promo_code }}
                                </span>
                            @endif
                            <span class="text-[11px] text-slate-400">
                                Ditandai: {{ $item->interested_at ? $item->interested_at->format('d M Y H:i') : $item->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-extrabold text-white">{{ $item->promo->title ?? 'Promo Dihapus' }}</h3>
                        <p class="text-xs text-slate-300">{{ $item->promo->description ?? '' }}</p>

                        @if($item->participant_note)
                            <p class="text-xs text-slate-400 bg-slate-900/60 px-3 py-2 rounded-xl border border-slate-700/60">
                                <strong class="text-slate-300">Catatan Anda:</strong> {{ $item->participant_note }}
                            </p>
                        @endif

                        @if($item->admin_note)
                            <p class="text-xs text-emerald-300 bg-emerald-500/10 px-3 py-2 rounded-xl border border-emerald-500/20">
                                <strong>Catatan Admin:</strong> {{ $item->admin_note }}
                            </p>
                        @endif
                    </div>

                    @if($item->promo && $item->status !== 'claimed')
                        <form action="{{ route('seminar.promos.cancel-interest', $item->promo->id) }}" method="POST" class="m-0 shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-red-500/15 text-slate-300 hover:text-red-400 border border-slate-700 rounded-xl text-xs font-semibold transition">
                                <i class="fas fa-times mr-1"></i> Batalkan Minat
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-10 text-center">
            <i class="fas fa-heart-broken text-slate-500 text-4xl mb-3"></i>
            <h3 class="text-base font-bold text-white">Belum Ada Promo yang Ditandai</h3>
            <p class="text-xs text-slate-400 mt-1 mb-4">Kembali ke halaman Promo &amp; Benefit dan klik tombol "Saya Tertarik" pada promo yang Anda inginkan.</p>
            <a href="{{ route('seminar.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl transition">
                <i class="fas fa-gift"></i> Jelajahi Promo &amp; Benefit
            </a>
        </div>
    @endif
</div>
@endsection
