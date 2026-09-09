@extends('pkl.layout')

@section('title', 'Tagihan & Pembayaran - elc.my.id')

@section('content')
<div class="space-y-6">
    
    <div>
        <h1 class="text-2xl font-extrabold text-white">Invoice & Riwayat Pembayaran</h1>
        <p class="text-slate-400 text-sm mt-1">Daftar tagihan pendaftaran / administrasi magang dan bukti pembayaran</p>
    </div>

    @if($invoices->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($invoices as $invoice)
                <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 backdrop-blur-xl flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs font-bold text-blue-400 bg-blue-500/10 px-3 py-1 rounded-lg border border-blue-500/20">
                                {{ $invoice->invoice_code }}
                            </span>

                            @if($invoice->status === 'paid')
                                <span class="px-3 py-1 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 text-xs font-bold rounded-full flex items-center gap-1">
                                    <i class="fas fa-check-circle"></i> LUNAS
                                </span>
                            @elseif($invoice->proof_file)
                                <span class="px-3 py-1 bg-amber-500/10 text-amber-400 border border-amber-500/20 text-xs font-bold rounded-full flex items-center gap-1">
                                    <i class="fas fa-clock"></i> VERIFIKASI
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-500/10 text-red-400 border border-red-500/20 text-xs font-bold rounded-full flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> BELUM BAYAR
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-white mb-1">{{ $invoice->description ?: 'Administrasi Program Magang' }}</h3>
                        <div class="text-2xl font-black text-emerald-400 mb-4">
                            Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                        </div>

                        @if($invoice->paid_at)
                            <p class="text-xs text-slate-400 mb-3"><i class="fas fa-calendar-check text-emerald-400 mr-1"></i> Dibayar pada: {{ $invoice->paid_at->format('d M Y H:i') }}</p>
                        @endif

                        @if($invoice->proof_file)
                            <div class="bg-slate-900/60 p-3 rounded-2xl border border-slate-700/50 text-xs mb-4">
                                <span class="text-slate-400 block font-semibold mb-1">Bukti Terunggah:</span>
                                <a href="{{ asset('storage/' . $invoice->proof_file) }}" target="_blank" class="text-blue-400 hover:underline flex items-center gap-1">
                                    <i class="fas fa-image"></i> Lihat File Bukti Bayar
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($invoice->status !== 'paid')
                        <button onclick="document.getElementById('modal-inv-{{ $invoice->id }}').classList.remove('hidden')"
                                class="w-full py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-2xl transition shadow-lg flex items-center justify-center gap-2 mt-4">
                            <i class="fas fa-upload"></i> {{ $invoice->proof_file ? 'Upload Ulang Bukti' : 'Konfirmasi & Upload Bukti Bayar' }}
                        </button>
                    @endif
                </div>

                <!-- Modal Upload Bukti Bayar -->
                <div id="modal-inv-{{ $invoice->id }}" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
                    <div class="bg-slate-800 border border-slate-700 rounded-3xl p-6 max-w-lg w-full shadow-2xl relative">
                        <div class="flex items-center justify-between border-b border-slate-700 pb-3 mb-4">
                            <h3 class="text-base font-bold text-white">Upload Bukti Pembayaran</h3>
                            <button onclick="document.getElementById('modal-inv-{{ $invoice->id }}').classList.add('hidden')" class="text-slate-400 hover:text-white">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <form action="{{ route('pkl.invoices.proof', $invoice->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">Metode Pembayaran (Bank / E-Wallet)</label>
                                <input type="text" name="payment_method" value="{{ old('payment_method', $invoice->payment_method ?: 'Transfer Bank BCA') }}" required
                                       class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-2.5 text-xs text-white"
                                       placeholder="Misal: Bank BCA, Mandiri, QRIS, Dana">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-1">File Bukti Transfer (JPG, PNG, PDF max 5MB)</label>
                                <input type="file" name="proof_file" required
                                       class="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-xs text-slate-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white">
                            </div>

                            <div class="pt-3 flex items-center justify-end gap-3 border-t border-slate-700">
                                <button type="button" onclick="document.getElementById('modal-inv-{{ $invoice->id }}').classList.add('hidden')"
                                        class="px-4 py-2 bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl hover:bg-slate-600">
                                    Batal
                                </button>
                                <button type="submit" class="px-5 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl hover:bg-blue-500 shadow-md">
                                    Kirim Bukti Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-slate-800/40 border border-slate-700/50 rounded-3xl p-12 text-center">
            <div class="w-16 h-16 bg-emerald-500/10 text-emerald-400 rounded-3xl flex items-center justify-center mx-auto text-2xl mb-4">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <h3 class="text-lg font-bold text-white">Tidak Ada Tagihan Aktif</h3>
            <p class="text-slate-400 text-sm mt-1 max-w-md mx-auto">
                Anda tidak memiliki tagihan pembayaran yang perlu dilunasi saat ini.
            </p>
        </div>
    @endif
</div>
@endsection
