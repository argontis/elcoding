@extends('seminar.layout')

@section('title', 'Dashboard Peserta Seminar - elc.my.id')

@section('content')
<div class="space-y-8">
    <!-- Welcome Banner -->
    <div class="relative bg-gradient-to-r from-emerald-900/60 via-teal-900/50 to-slate-800/80 border border-emerald-500/20 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-xl overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-500/20 text-emerald-300 text-xs font-semibold rounded-full border border-emerald-500/30 mb-3">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Peserta Seminar Aktif
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-white">Halo, {{ auth()->user()->name }}! 🎉</h1>
                <p class="text-slate-300 text-xs sm:text-sm mt-2 max-w-2xl">
                    Nikmati berbagai promo, diskon khusus, dan benefit eksklusif dari tim Elcoding. Klik <strong>Saya Tertarik</strong> pada promo pilihan Anda agar tim kami segera menghubungi Anda.
                </p>

                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-300 mt-4">
                    <div class="flex items-center gap-1.5 bg-slate-900/60 px-3 py-1.5 rounded-lg border border-slate-700/50">
                        <i class="fas fa-tags text-emerald-400"></i>
                        <span>Kategori: <strong>{{ $profile->category->name ?? 'Umum' }}</strong></span>
                    </div>
                    <div class="flex items-center gap-1.5 bg-slate-900/60 px-3 py-1.5 rounded-lg border border-slate-700/50">
                        <i class="fas fa-building text-blue-400"></i>
                        <span>{{ $profile->institution ?: '-' }}</span>
                    </div>
                    <div class="flex items-center gap-1.5 bg-slate-900/60 px-3 py-1.5 rounded-lg border border-slate-700/50">
                        <i class="fas fa-map-marker-alt text-amber-400"></i>
                        <span>{{ $profile->city ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 self-start md:self-auto">
                @if(!empty($adminWhatsapp))
                    <a href="https://wa.me/{{ $adminWhatsapp }}?text={{ urlencode('Halo Admin Elcoding, saya ' . auth()->user()->name . ' peserta seminar (' . ($profile->category->name ?? 'Umum') . ') ingin bertanya mengenai promo & benefit.') }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-2xl transition shadow-lg shadow-emerald-500/20">
                        <i class="fab fa-whatsapp text-sm"></i> Hubungi Admin
                    </a>
                @endif
                <a href="{{ route('seminar.profile') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-slate-800/80 hover:bg-slate-700/80 text-white text-xs font-semibold rounded-2xl border border-slate-700 transition shadow-md">
                    <i class="fas fa-user-edit text-emerald-400"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-5 sm:p-6 backdrop-blur-md">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold text-slate-400">Promo &amp; Benefit Tersedia</span>
                <div class="w-9 h-9 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                    <i class="fas fa-gift"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $allAvailableCount }}</div>
            <p class="text-xs text-slate-400 mt-1">Penawaran aktif khusus untuk Anda</p>
        </div>

        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-5 sm:p-6 backdrop-blur-md">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold text-slate-400">Promo Anda Minati</span>
                <div class="w-9 h-9 rounded-2xl bg-pink-500/10 text-pink-400 flex items-center justify-center">
                    <i class="fas fa-heart"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $interestedPromosCount }}</div>
            <p class="text-xs text-slate-400 mt-1">Ditandai tertarik oleh Anda</p>
        </div>

        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-5 sm:p-6 backdrop-blur-md">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold text-slate-400">Diproses / Diklaim</span>
                <div class="w-9 h-9 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center">
                    <i class="fas fa-check-double"></i>
                </div>
            </div>
            <div class="text-2xl font-black text-white">{{ $claimedPromosCount }}</div>
            <p class="text-xs text-slate-400 mt-1">Sudah ditindaklanjuti admin</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg sm:text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-sparkles text-amber-400"></i> Promo &amp; Benefit Khusus Peserta
            </h2>
            <p class="text-xs text-slate-400 mt-0.5">Pilih penawaran yang sesuai kebutuhan Anda dan klik tombol konfirmasi minat.</p>
        </div>

        <div class="flex flex-wrap gap-2">
            @php $currentType = request('type', ''); @endphp
            <a href="{{ route('seminar.dashboard') }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition {{ $currentType === '' ? 'bg-emerald-600 border-emerald-500 text-white' : 'bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700' }}">Semua</a>
            <a href="{{ route('seminar.dashboard', ['type' => 'promo']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition {{ $currentType === 'promo' ? 'bg-emerald-600 border-emerald-500 text-white' : 'bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700' }}">Promo</a>
            <a href="{{ route('seminar.dashboard', ['type' => 'benefit']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition {{ $currentType === 'benefit' ? 'bg-emerald-600 border-emerald-500 text-white' : 'bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700' }}">Benefit</a>
            <a href="{{ route('seminar.dashboard', ['type' => 'discount']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition {{ $currentType === 'discount' ? 'bg-emerald-600 border-emerald-500 text-white' : 'bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700' }}">Diskon</a>
            <a href="{{ route('seminar.dashboard', ['type' => 'voucher']) }}" class="px-3.5 py-1.5 rounded-xl text-xs font-semibold border transition {{ $currentType === 'voucher' ? 'bg-emerald-600 border-emerald-500 text-white' : 'bg-slate-800 border-slate-700 text-slate-300 hover:bg-slate-700' }}">Voucher</a>
        </div>
    </div>

    <!-- Promo Cards Grid -->
    @if($promos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($promos as $promo)
                @php
                    $pivotRecord = $participantPromoMap->get($promo->id);
                    $isInterested = $pivotRecord && $pivotRecord->is_interested;
                    $pivotStatus = $pivotRecord->status ?? 'available';
                    $typeBadge = match($promo->type) {
                        'benefit' => 'bg-indigo-500/20 text-indigo-300 border-indigo-500/30',
                        'discount' => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                        'voucher' => 'bg-purple-500/20 text-purple-300 border-purple-500/30',
                        default => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                    };
                @endphp

                <div class="bg-slate-800/70 border {{ $isInterested ? 'border-emerald-500/50 shadow-emerald-500/10' : 'border-slate-700/70' }} rounded-3xl p-6 flex flex-col justify-between shadow-xl hover:border-emerald-500/40 transition">
                    <div>
                        <div class="flex items-start justify-between gap-2 mb-4">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold uppercase border {{ $typeBadge }}">
                                {{ $promo->badge_text ?: ucfirst($promo->type) }}
                            </span>

                            @if($pivotRecord && $pivotRecord->assigned_by_admin)
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-500/20 text-blue-300 border border-blue-500/30">
                                    <i class="fas fa-star mr-1"></i> Khusus Anda
                                </span>
                            @elseif($promo->category)
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-slate-900/80 text-slate-300 border border-slate-700">
                                    {{ $promo->category->name }}
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold bg-slate-900/80 text-slate-400 border border-slate-700">
                                    Semua Peserta
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-extrabold text-white mb-2">{{ $promo->title }}</h3>
                        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed mb-4">{{ $promo->description }}</p>

                        @if(is_array($promo->benefits) && count($promo->benefits) > 0)
                            <div class="bg-slate-900/60 border border-slate-700/60 rounded-2xl p-3.5 mb-4">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-400 mb-2">Yang Anda Dapatkan:</p>
                                <ul class="space-y-1.5 text-xs text-slate-300">
                                    @foreach($promo->benefits as $benefit)
                                        <li class="flex items-start gap-2">
                                            <i class="fas fa-check text-emerald-400 mt-0.5 shrink-0"></i>
                                            <span>{{ $benefit }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($promo->promo_code)
                            <div class="flex items-center justify-between bg-slate-900/90 border border-dashed border-emerald-500/40 rounded-xl px-3.5 py-2.5 mb-4">
                                <div>
                                    <span class="block text-[10px] text-slate-400 uppercase font-semibold">Kode Promo</span>
                                    <span class="font-mono font-extrabold text-sm text-emerald-300 tracking-wider">{{ $promo->promo_code }}</span>
                                </div>
                                <button type="button" onclick="copyPromoCode('{{ $promo->promo_code }}')" class="px-2.5 py-1 bg-slate-800 hover:bg-slate-700 text-xs font-semibold text-slate-200 rounded-lg border border-slate-700 transition">
                                    <i class="fas fa-copy mr-1"></i> Salin
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="pt-4 border-t border-slate-700/60 space-y-3">
                        <div class="flex items-center justify-between text-[11px] text-slate-400">
                            <span>
                                <i class="fas fa-clock mr-1 text-amber-400"></i>
                                {{ $promo->valid_until ? 'Berlaku s/d ' . $promo->valid_until->format('d M Y') : 'Berlaku selama periode seminar' }}
                            </span>
                            @if($isInterested)
                                <span class="font-bold text-emerald-400">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    {{ $pivotStatus === 'claimed' ? 'Diklaim' : ($pivotStatus === 'contacted' ? 'Dihubungi Admin' : 'Tertarik') }}
                                </span>
                            @endif
                        </div>

                        @if($isInterested)
                            <div class="flex items-center gap-2">
                                <span class="flex-1 py-2.5 px-3 bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 rounded-xl text-xs font-bold text-center">
                                    <i class="fas fa-heart mr-1"></i> Minat Tercatat
                                </span>
                                @if($pivotStatus !== 'claimed')
                                    <form action="{{ route('seminar.promos.cancel-interest', $promo->id) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="py-2.5 px-3 bg-slate-900 hover:bg-red-500/15 text-slate-400 hover:text-red-400 border border-slate-700 rounded-xl text-xs font-semibold transition" title="Batalkan Minat">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <button type="button"
                                    onclick="openInterestModal({{ $promo->id }}, '{{ addslashes($promo->title) }}', '{{ addslashes($promo->cta_label ?: 'Saya Tertarik') }}')"
                                    class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-emerald-500/20 transition flex items-center justify-center gap-2">
                                <i class="fas fa-hand-pointer"></i> {{ $promo->cta_label ?: 'Saya Tertarik' }}
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-10 text-center">
            <i class="fas fa-gift text-slate-500 text-4xl mb-3"></i>
            <h3 class="text-base font-bold text-white">Belum Ada Promo &amp; Benefit Aktif</h3>
            <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto">Tim admin kami sedang menyiapkan promo dan benefit terbaik untuk kategori seminar Anda. Silakan cek kembali secara berkala.</p>
        </div>
    @endif
</div>

<!-- Express Interest Modal -->
<div id="interestModal" class="fixed inset-0 z-50 hidden bg-slate-950/75 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-slate-800 border border-slate-700 rounded-3xl shadow-2xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-700 flex items-center justify-between">
            <h3 class="font-bold text-white text-base" id="interestModalTitle">Konfirmasi Ketertarikan</h3>
            <button type="button" onclick="closeInterestModal()" class="text-slate-400 hover:text-white"><i class="fas fa-times"></i></button>
        </div>
        <form id="interestForm" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <p class="text-xs text-slate-300 leading-relaxed">
                    Anda menyatakan tertarik pada promo/benefit <strong class="text-emerald-300" id="interestPromoName"></strong>. Tim admin kami dapat menghubungi Anda melalui WhatsApp (<strong class="text-white">{{ $profile->phone_number }}</strong>) atau email.
                </p>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">Catatan / Pertanyaan Tambahan (Opsional)</label>
                    <textarea name="participant_note" rows="3" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-emerald-500" placeholder="Contoh: Saya tertarik konsultasi paket untuk tim saya..."></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-900/60 border-t border-slate-700 flex justify-end gap-2">
                <button type="button" onclick="closeInterestModal()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:bg-slate-700 transition">Batal</button>
                <button type="submit" id="interestSubmitBtn" class="px-5 py-2 rounded-xl text-xs font-bold bg-emerald-600 hover:bg-emerald-500 text-white transition shadow-lg">Kirim Minat</button>
            </div>
        </form>
    </div>
</div>

<script>
function openInterestModal(promoId, title, ctaLabel) {
    document.getElementById('interestForm').action = "{{ url('seminar/promos') }}/" + promoId + "/interest";
    document.getElementById('interestPromoName').textContent = title;
    document.getElementById('interestSubmitBtn').textContent = ctaLabel || 'Konfirmasi Tertarik';
    document.getElementById('interestModal').classList.remove('hidden');
}

function closeInterestModal() {
    document.getElementById('interestModal').classList.add('hidden');
}

function copyPromoCode(code) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(code);
    }
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'Kode ' + code + ' disalin!',
        showConfirmButton: false,
        timer: 2000,
        background: '#1e293b',
        color: '#f8fafc'
    });
}
</script>
@endsection
