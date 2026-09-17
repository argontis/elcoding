@extends('pkl.layout')

@section('title', 'Data Diri Peserta PKL - elc.my.id')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white">Data Diri & Identitas Magang</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola data profil, instansi sekolah/kampus, dan info kontak Anda</p>
        </div>
    </div>

    <div class="bg-slate-800/60 border border-slate-700/60 rounded-3xl p-6 sm:p-8 backdrop-blur-xl shadow-xl">
        <form action="{{ route('pkl.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                           class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 text-white">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Email Akun (Tidak dapat diubah)</label>
                    <input type="email" value="{{ auth()->user()->email }}" disabled
                           class="w-full bg-slate-900/30 border border-slate-800 rounded-xl px-4 py-3 text-sm text-slate-500 cursor-not-allowed">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Sekolah / Universitas</label>
                    <input type="text" name="institution" value="{{ old('institution', $profile->institution) }}" required
                           class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 text-white"
                           placeholder="Contoh: SMKN 1 / Universitas Indonesia">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Jurusan / Program Studi</label>
                    <input type="text" name="major" value="{{ old('major', $profile->major) }}" required
                           class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 text-white"
                           placeholder="Contoh: Teknik Informatika / Multimedia">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">Nomor Induk (NIS / NIM)</label>
                    <input type="text" name="student_id_number" value="{{ old('student_id_number', $profile->student_id_number) }}"
                           class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 text-white">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-2">No. WhatsApp / HP</label>
                    <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}" required
                           class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 text-white">
                </div>

                <div class="md:col-span-2 border-t border-slate-700/50 pt-4 mt-2">
                    <label class="block text-xs font-semibold text-blue-400 mb-2 font-bold uppercase tracking-wider">
                        <i class="fas fa-graduation-cap mr-1"></i> Program / Divisi Magang (Program Kursus)
                    </label>
                    <select name="program_id" class="w-full bg-slate-900 border border-blue-500/50 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-400 text-white font-semibold shadow-inner">
                        <option value="">-- Pilih Program / Divisi Magang --</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->id }}" {{ (old('program_id', $profile->program_id) == $prog->id) ? 'selected' : '' }}>
                                📌 {{ $prog->title ?? $prog->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-2">Alamat Lengkap</label>
                <textarea name="address" rows="3"
                          class="w-full bg-slate-900/60 border border-slate-700 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 text-white"
                          placeholder="Alamat domisili saat ini">{{ old('address', $profile->address) }}</textarea>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm rounded-xl transition shadow-lg flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
