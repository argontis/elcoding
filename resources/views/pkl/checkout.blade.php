@extends('pkl.layout')

@section('title', 'Pendaftaran ' . ucfirst($itemType) . ' - elc.my.id')

@section('content')
<div class="space-y-8 max-w-4xl mx-auto">
    <div class="flex items-center gap-4">
        <a href="{{ $itemType === 'program' ? route('pkl.program.detail', $item->id) : route('pkl.event.detail', $item->id) }}" class="w-10 h-10 bg-slate-800/60 rounded-xl flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-blue-400 uppercase tracking-wider mb-1">
                <i class="fas fa-shopping-cart"></i> Pendaftaran {{ ucfirst($itemType) }}
            </div>
            <h1 class="text-2xl font-extrabold text-white">Konfirmasi Pendaftaran</h1>
        </div>
    </div>

    @if(session('error'))
    <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-6 py-4 rounded-2xl flex items-center gap-4">
        <i class="fas fa-exclamation-circle text-2xl"></i>
        <div>
            <div class="font-bold">Gagal memproses pendaftaran</div>
            <div class="text-sm opacity-80">{{ session('error') }}</div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
        <!-- Informasi Item -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-xl">
                <div class="aspect-video bg-slate-700 rounded-xl mb-6 overflow-hidden border border-slate-600/50">
                    @if($item->image_path)
                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @elseif(isset($item->image) && $item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-500">
                            <i class="fas fa-image text-4xl"></i>
                        </div>
                    @endif
                </div>
                
                <div class="text-xs text-slate-400 uppercase tracking-wider font-bold mb-2">
                    {{ $itemType === 'program' ? 'Program Kursus' : 'Event / Webinar' }}
                </div>
                <h2 class="text-xl font-bold text-white mb-6">{{ $item->title }}</h2>

                <div class="flex justify-between items-center pb-4 border-b border-slate-700/50">
                    <div class="text-slate-400 text-sm">Harga</div>
                    <div class="text-xl font-extrabold text-white">
                        @if(empty($item->price_amount) || $item->price_amount == 0)
                            <span class="text-emerald-400">GRATIS</span>
                        @else
                            Rp {{ number_format($item->price_amount, 0, ',', '.') }}
                        @endif
                    </div>
                </div>
                <div class="flex justify-between items-center pt-4">
                    <div class="text-slate-400 font-bold">Total Tagihan</div>
                    <div class="text-2xl font-extrabold text-blue-400">
                        @if(empty($item->price_amount) || $item->price_amount == 0)
                            <span class="text-emerald-400">Rp 0</span>
                        @else
                            Rp {{ number_format($item->price_amount, 0, ',', '.') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pemesanan -->
        <div class="md:col-span-3">
            <form action="{{ $itemType === 'program' ? route('pkl.program.checkout.process', $item->id) : route('pkl.event.checkout.process', $item->id) }}" method="POST" class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-8 backdrop-blur-xl">
                @csrf
                <h3 class="text-lg font-bold text-white mb-6">Informasi Pendaftar</h3>
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Nama Lengkap</label>
                        <input type="text" name="user_name" value="{{ $user->name }}" readonly class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-slate-300 cursor-not-allowed focus:outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Email</label>
                        <input type="email" name="user_email" value="{{ $user->email }}" readonly class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-3 text-slate-300 cursor-not-allowed focus:outline-none">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-slate-300 mb-2">Nomor WhatsApp Aktif</label>
                        <input type="text" name="user_phone" value="{{ $profile->whatsapp ?? '' }}" required placeholder="Contoh: 081234567890" class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white font-bold text-center rounded-xl transition shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2">
                        @if(empty($item->price_amount) || $item->price_amount == 0)
                            <i class="fas fa-check-circle"></i> Daftar Sekarang (Gratis)
                        @else
                            <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                        @endif
                    </button>
                    @if(!empty($item->price_amount) && $item->price_amount > 0)
                        <p class="text-center text-xs text-slate-500 mt-4">
                            Anda akan diarahkan ke halaman pembayaran aman oleh Xendit.
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
