@extends('seminar.layout')

@section('title', 'Profil Peserta Seminar - elc.my.id')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-white">Profil Peserta Seminar</h1>
        <p class="text-xs sm:text-sm text-slate-400 mt-1">Perbarui informasi kontak dan kategori seminar Anda agar tim kami dapat mengirimkan benefit yang tepat.</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 text-red-400 p-4 rounded-2xl text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('seminar.profile.update') }}" method="POST" class="bg-slate-800/70 border border-slate-700/70 rounded-3xl p-6 sm:p-8 space-y-5 shadow-xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       class="w-full bg-slate-900/70 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Email</label>
                <input type="email" value="{{ auth()->user()->email }}" disabled
                       class="w-full bg-slate-900/40 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-400 cursor-not-allowed">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Kategori Seminar {{ $categories->count() > 0 ? '*' : '' }}</label>
                <select name="seminar_category_id" {{ $categories->count() > 0 ? 'required' : '' }}
                        class="w-full bg-slate-900/70 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
                    <option value="">-- Pilih Kategori Seminar --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) old('seminar_category_id', $profile->seminar_category_id) === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">No. WhatsApp *</label>
                <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}" required
                       class="w-full bg-slate-900/70 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Instansi / Perusahaan / Kampus *</label>
                <input type="text" name="institution" value="{{ old('institution', $profile->institution) }}" required
                       class="w-full bg-slate-900/70 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">Profesi / Status *</label>
                <input type="text" name="occupation" value="{{ old('occupation', $profile->occupation) }}" required
                       class="w-full bg-slate-900/70 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 mb-1.5">Kota / Domisili *</label>
            <input type="text" name="city" value="{{ old('city', $profile->city) }}" required
                   class="w-full bg-slate-900/70 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-300 mb-1.5">Kebutuhan / Catatan Minat</label>
            <textarea name="notes" rows="3"
                      class="w-full bg-slate-900/70 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500">{{ old('notes', $profile->notes) }}</textarea>
        </div>

        <div class="pt-2 flex justify-end">
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-bold text-xs rounded-xl shadow-lg transition">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
