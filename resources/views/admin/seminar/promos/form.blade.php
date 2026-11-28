@extends('admin.layout')

@section('title', ($promo ? 'Edit' : 'Buat') . ' Promo & Benefit Seminar - Admin Elcoding')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">{{ $promo ? 'Edit Promo & Benefit' : 'Buat Promo & Benefit Baru' }}</h1>
            <p class="text-slate-500 text-sm mt-1">Atur penawaran promosi, poin benefit, dan sasaran peserta seminar.</p>
        </div>
        <a href="{{ route('admin.seminar.promos.index') }}" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="p-4 bg-red-50 text-red-700 rounded-2xl border border-red-200 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $promo ? route('admin.seminar.promos.update', $promo->id) : route('admin.seminar.promos.store') }}" method="POST" class="surface-card p-6 md:p-8 space-y-6">
        @csrf
        @if($promo)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Judul Promo / Benefit *</label>
                <input type="text" name="title" value="{{ old('title', $promo->title ?? '') }}" required
                       placeholder="Contoh: Diskon 50% Bootcamp Web Dev"
                       class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Tipe Penawaran *</label>
                    @php $selType = old('type', $promo->type ?? 'promo'); @endphp
                    <select name="type" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                        <option value="promo" {{ $selType === 'promo' ? 'selected' : '' }}>Promo</option>
                        <option value="benefit" {{ $selType === 'benefit' ? 'selected' : '' }}>Benefit</option>
                        <option value="discount" {{ $selType === 'discount' ? 'selected' : '' }}>Diskon</option>
                        <option value="voucher" {{ $selType === 'voucher' ? 'selected' : '' }}>Voucher</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Label Badge</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $promo->badge_text ?? '') }}"
                           placeholder="Cth: HEMAT 50%"
                           class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kode Promo (Opsional)</label>
                <input type="text" name="promo_code" value="{{ old('promo_code', $promo->promo_code ?? '') }}"
                       placeholder="Cth: SEMINAR50"
                       class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500/40">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Berlaku Hingga</label>
                <input type="date" name="valid_until" value="{{ old('valid_until', $promo?->valid_until?->format('Y-m-d') ?? '') }}"
                       class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Teks Tombol CTA</label>
                <input type="text" name="cta_label" value="{{ old('cta_label', $promo->cta_label ?? 'Saya Tertarik') }}"
                       placeholder="Saya Tertarik"
                       class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Deskripsi Penawaran *</label>
            <textarea name="description" rows="3" required
                      placeholder="Jelaskan detail promo atau benefit yang akan diterima peserta seminar..."
                      class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">{{ old('description', $promo->description ?? '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Daftar Poin Benefit (1 poin per baris)</label>
            @php
                $benefitsDefault = isset($promo) && is_array($promo->benefits) ? implode("\n", $promo->benefits) : '';
            @endphp
            <textarea name="benefits_text" rows="4"
                      placeholder="Gratis konsultasi IT 1-on-1&#10;Potongan biaya bootcamp Rp 500.000&#10;Akses rekaman &amp; materi seminar"
                      class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">{{ old('benefits_text', $benefitsDefault) }}</textarea>
        </div>

        <!-- Target Scope -->
        <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-4">
            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Target Penerima Promo &amp; Benefit *</label>
            @php $currentScope = old('target_scope', $targetScope ?? 'all'); @endphp
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <label class="cursor-pointer flex items-center gap-2.5 p-3 rounded-xl bg-white border border-slate-200">
                    <input type="radio" name="target_scope" value="all" {{ $currentScope === 'all' ? 'checked' : '' }} onchange="toggleScopeFields()" class="text-blue-600">
                    <div>
                        <span class="block text-xs font-bold text-slate-800">Semua Peserta Seminar</span>
                        <span class="block text-[11px] text-slate-500">Tampil ke seluruh peserta</span>
                    </div>
                </label>
                <label class="cursor-pointer flex items-center gap-2.5 p-3 rounded-xl bg-white border border-slate-200">
                    <input type="radio" name="target_scope" value="category" {{ $currentScope === 'category' ? 'checked' : '' }} onchange="toggleScopeFields()" class="text-blue-600">
                    <div>
                        <span class="block text-xs font-bold text-slate-800">Kategori Tertentu</span>
                        <span class="block text-[11px] text-slate-500">Khusus 1 kategori seminar</span>
                    </div>
                </label>
                <label class="cursor-pointer flex items-center gap-2.5 p-3 rounded-xl bg-white border border-slate-200">
                    <input type="radio" name="target_scope" value="specific" {{ $currentScope === 'specific' ? 'checked' : '' }} onchange="toggleScopeFields()" class="text-blue-600">
                    <div>
                        <span class="block text-xs font-bold text-slate-800">Peserta Tertentu</span>
                        <span class="block text-[11px] text-slate-500">Pilih peserta secara spesifik</span>
                    </div>
                </label>
            </div>

            <div id="scopeCategoryWrapper" class="{{ $currentScope === 'category' ? '' : 'hidden' }}">
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pilih Kategori Seminar *</label>
                <select name="seminar_category_id" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) old('seminar_category_id', $promo->seminar_category_id ?? '') === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="scopeSpecificWrapper" class="{{ $currentScope === 'specific' ? '' : 'hidden' }}">
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pilih Peserta Seminar *</label>
                @php $selectedIds = old('participant_ids', $selectedParticipantIds ?? []); @endphp
                <div class="max-h-52 overflow-y-auto bg-white border border-slate-200 rounded-xl p-3 space-y-2">
                    @forelse($participants as $participant)
                        <label class="flex items-center justify-between gap-2 p-2 rounded-lg hover:bg-slate-50 cursor-pointer text-xs">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="participant_ids[]" value="{{ $participant->id }}"
                                       {{ in_array($participant->id, $selectedIds) ? 'checked' : '' }}
                                       class="rounded border-slate-300 text-blue-600">
                                <span class="font-bold text-slate-800">{{ $participant->user->name ?? '-' }}</span>
                                <span class="text-slate-500">({{ $participant->phone_number }})</span>
                            </div>
                            <span class="text-[11px] text-slate-500">{{ $participant->category->name ?? 'Umum' }}</span>
                        </label>
                    @empty
                        <p class="text-xs text-slate-500 text-center py-2">Belum ada peserta seminar terdaftar.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between pt-2">
            <label class="inline-flex items-center gap-2 text-xs font-bold text-slate-700 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $promo->is_active ?? true) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600">
                Aktifkan Promo &amp; Benefit ini
            </label>

            <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-xs font-bold">
                <i class="fas fa-save mr-1"></i> {{ $promo ? 'Simpan Perubahan' : 'Terbitkan Promo' }}
            </button>
        </div>
    </form>
</div>

<script>
function toggleScopeFields() {
    const selected = document.querySelector('input[name="target_scope"]:checked')?.value || 'all';
    document.getElementById('scopeCategoryWrapper').classList.toggle('hidden', selected !== 'category');
    document.getElementById('scopeSpecificWrapper').classList.toggle('hidden', selected !== 'specific');
}
</script>
@endsection
