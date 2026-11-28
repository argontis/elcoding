@extends('admin.layout')

@section('title', 'Detail Peserta Seminar - Admin Elcoding')

@section('content')
<div class="space-y-6">
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.seminar.participants.index') }}" class="p-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 rounded-xl transition">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-slate-800">{{ $profile->user->name ?? 'Peserta Seminar' }}</h1>
                <p class="text-slate-500 text-xs mt-0.5">
                    {{ $profile->user->email ?? '-' }} &bull; {{ $profile->phone_number }} &bull; Kategori: <strong>{{ $profile->category->name ?? 'Umum' }}</strong>
                </p>
            </div>
        </div>

        @if($profile->whatsapp_number)
            <a href="https://wa.me/{{ $profile->whatsapp_number }}?text={{ urlencode('Halo ' . ($profile->user->name ?? 'Peserta') . ', kami dari tim Elcoding ingin menindaklanjuti promo & benefit seminar Anda.') }}"
               target="_blank"
               class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold text-xs inline-flex items-center gap-2 shadow-sm self-start md:self-auto">
                <i class="fab fa-whatsapp text-sm"></i> Chat WhatsApp Langsung
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-200 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left 2 Cols: Promos & Contact -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Promo & Benefit Status / Interest -->
            <div class="surface-card p-6 space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Promo &amp; Benefit Peserta</h3>
                        <p class="text-xs text-slate-500">Daftar promo yang diminati peserta atau diberikan khusus oleh admin.</p>
                    </div>
                </div>

                <!-- Assign Promo Form -->
                <form action="{{ route('admin.seminar.participants.assignPromo', $profile->id) }}" method="POST" class="bg-slate-50 p-4 rounded-2xl border border-slate-200 grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                    @csrf
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Berikan Promo / Benefit Khusus</label>
                        <select name="seminar_promo_id" required class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
                            <option value="">-- Pilih Promo / Benefit --</option>
                            @foreach($availablePromos as $promo)
                                <option value="{{ $promo->id }}">{{ $promo->title }} ({{ ucfirst($promo->type) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-600 mb-1">Catatan Admin (Opsional)</label>
                        <input type="text" name="admin_note" placeholder="Cth: Penawaran khusus alumni seminar" class="w-full px-3 py-2 bg-white border border-slate-200 rounded-xl text-xs">
                    </div>
                    <button type="submit" class="btn-primary px-4 py-2 rounded-xl text-xs font-bold">
                        <i class="fas fa-gift mr-1"></i> Berikan ke Peserta
                    </button>
                </form>

                <!-- Promo Participant Items -->
                <div class="space-y-3">
                    @forelse($profile->promoParticipants as $item)
                        <div class="p-4 rounded-2xl border {{ $item->is_interested ? 'border-pink-200 bg-pink-50/40' : 'border-slate-200 bg-white' }} space-y-3">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h4 class="font-bold text-slate-800 text-sm">{{ $item->promo->title ?? 'Promo Dihapus' }}</h4>
                                        @if($item->is_interested)
                                            <span class="px-2 py-0.5 rounded-full bg-pink-100 text-pink-700 text-[10px] font-bold">
                                                <i class="fas fa-heart mr-1"></i> Peserta Tertarik
                                            </span>
                                        @endif
                                        @if($item->assigned_by_admin)
                                            <span class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-bold">
                                                Diberikan Admin
                                            </span>
                                        @endif
                                    </div>
                                    @if($item->participant_note)
                                        <p class="text-xs text-slate-600 mt-1"><strong>Catatan Peserta:</strong> {{ $item->participant_note }}</p>
                                    @endif
                                </div>

                                @if($item->assigned_by_admin)
                                    <form action="{{ route('admin.seminar.participants.removePromo', [$profile->id, $item->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs text-red-600 hover:underline font-semibold">Cabut Penugasan</button>
                                    </form>
                                @endif
                            </div>

                            <form action="{{ route('admin.seminar.participants.updatePromoStatus', [$profile->id, $item->id]) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-3 gap-2 items-center pt-2 border-t border-slate-100">
                                @csrf
                                @method('PUT')
                                <select name="status" class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs">
                                    <option value="available" {{ $item->status === 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="interested" {{ $item->status === 'interested' ? 'selected' : '' }}>Interested</option>
                                    <option value="contacted" {{ $item->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="claimed" {{ $item->status === 'claimed' ? 'selected' : '' }}>Claimed / Diklaim</option>
                                    <option value="declined" {{ $item->status === 'declined' ? 'selected' : '' }}>Declined</option>
                                </select>
                                <input type="text" name="admin_note" value="{{ $item->admin_note }}" placeholder="Catatan admin untuk promo ini" class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-xs">
                                <button type="submit" class="px-3 py-1.5 bg-slate-800 hover:bg-slate-900 text-white rounded-lg text-xs font-bold transition">
                                    Update Status Promo
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-xs text-slate-500 text-center py-4">Peserta belum menandai minat promo dan belum ada promo khusus yang ditugaskan.</p>
                    @endforelse
                </div>

                @if($matchingPromos->count() > 0)
                    <div class="pt-3 border-t border-slate-100">
                        <p class="text-[11px] font-bold text-slate-500 uppercase mb-2">Promo Otomatis yang Tampil di Dashboard Peserta ({{ $matchingPromos->count() }})</p>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($matchingPromos as $mp)
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-[11px] font-semibold">{{ $mp->title }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Contact Log & Composer -->
            <div class="surface-card p-6 space-y-5">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-3">Hubungi &amp; Catat Riwayat Kontak</h3>

                <form action="{{ route('admin.seminar.participants.contact', $profile->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Channel</label>
                            <select name="channel" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs">
                                <option value="whatsapp">WhatsApp</option>
                                <option value="email">Email</option>
                                <option value="phone">Telepon</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 mb-1">Isi Pesan / Ringkasan Pembicaraan</label>
                            <input type="text" name="message" placeholder="Contoh: Menawarkan promo diskon bootcamp 50% via WhatsApp..." class="w-full px-3 py-2 border border-slate-200 rounded-xl text-xs">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn-primary px-5 py-2 rounded-xl text-xs font-bold">
                            <i class="fas fa-plus-circle mr-1"></i> Simpan Log Kontak
                        </button>
                    </div>
                </form>

                <div class="space-y-3 pt-2">
                    @forelse($profile->contactLogs as $log)
                        <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs flex items-start justify-between gap-3">
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-700 font-bold uppercase text-[10px]">{{ $log->channel }}</span>
                                    <span class="font-semibold text-slate-700">oleh {{ $log->admin->name ?? 'Admin' }}</span>
                                </div>
                                <p class="text-slate-600">{{ $log->message ?: 'Kontak dicatat tanpa pesan detail.' }}</p>
                            </div>
                            <span class="text-[11px] text-slate-400 shrink-0">{{ $log->created_at->format('d M Y H:i') }}</span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-2">Belum ada riwayat kontak untuk peserta ini.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right Col: Participant Info & Follow-Up Status -->
        <div class="space-y-6">
            <div class="surface-card p-6 space-y-4">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-3">Profil Peserta</h3>
                <div class="space-y-2.5 text-xs">
                    <div class="flex justify-between gap-2"><span class="text-slate-500">Kategori:</span> <strong class="text-slate-800 text-right">{{ $profile->category->name ?? '-' }}</strong></div>
                    <div class="flex justify-between gap-2"><span class="text-slate-500">WhatsApp:</span> <strong class="text-emerald-700 text-right">{{ $profile->phone_number }}</strong></div>
                    <div class="flex justify-between gap-2"><span class="text-slate-500">Instansi:</span> <strong class="text-slate-800 text-right">{{ $profile->institution ?: '-' }}</strong></div>
                    <div class="flex justify-between gap-2"><span class="text-slate-500">Profesi:</span> <strong class="text-slate-800 text-right">{{ $profile->occupation ?: '-' }}</strong></div>
                    <div class="flex justify-between gap-2"><span class="text-slate-500">Kota:</span> <strong class="text-slate-800 text-right">{{ $profile->city ?: '-' }}</strong></div>
                    <div class="flex justify-between gap-2"><span class="text-slate-500">Terdaftar:</span> <strong class="text-slate-800 text-right">{{ $profile->created_at->format('d M Y') }}</strong></div>
                </div>
                @if($profile->notes)
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs">
                        <span class="block font-bold text-slate-600 mb-1">Minat / Catatan Peserta:</span>
                        <p class="text-slate-700">{{ $profile->notes }}</p>
                    </div>
                @endif
            </div>

            <div class="surface-card p-6 space-y-4">
                <h3 class="text-base font-bold text-slate-800 border-b border-slate-100 pb-3">Status Follow-Up Admin</h3>
                <form action="{{ route('admin.seminar.participants.updateStatus', $profile->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Status Saat Ini</label>
                        <select name="followup_status" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-xs">
                            <option value="new" {{ $profile->followup_status === 'new' ? 'selected' : '' }}>Baru Daftar</option>
                            <option value="interested" {{ $profile->followup_status === 'interested' ? 'selected' : '' }}>Tertarik Promo</option>
                            <option value="contacted" {{ $profile->followup_status === 'contacted' ? 'selected' : '' }}>Sudah Dihubungi</option>
                            <option value="converted" {{ $profile->followup_status === 'converted' ? 'selected' : '' }}>Converted / Klaim</option>
                            <option value="closed" {{ $profile->followup_status === 'closed' ? 'selected' : '' }}>Selesai / Closed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1.5">Catatan Internal Admin</label>
                        <textarea name="admin_notes" rows="4" class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-xs" placeholder="Catatan hasil komunikasi dengan peserta...">{{ $profile->admin_notes }}</textarea>
                    </div>
                    <button type="submit" class="w-full btn-primary py-2.5 rounded-xl text-xs font-bold">
                        <i class="fas fa-save mr-1"></i> Simpan Status Follow-Up
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
