@extends('admin.layout')

@section('title', 'Edit Data Peserta PKL - Admin Panel')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Edit Data Peserta PKL</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui data profil, instansi, dan periode magang {{ $profile->user->name ?? '' }}</p>
        </div>
        <a href="{{ route('admin.pkl.show', $profile->id) }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 text-xs font-bold rounded-xl transition">
            &larr; Kembali ke Detail
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs space-y-1">
            <strong>Mohon perbaiki kesalahan berikut:</strong>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="surface-card p-6 md:p-8">
        <form action="{{ route('admin.pkl.update', $profile->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Akun & Identitas -->
            <div class="space-y-4">
                <h3 class="text-xs font-bold uppercase tracking-wider text-blue-600 border-b border-slate-100 pb-2">
                    1. Akun Login & Data Diri
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', $profile->user->name ?? '') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $profile->user->email ?? '') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Password Baru (Kosongkan bila tidak diubah)</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500" placeholder="Minimal 8 karakter">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">No. WhatsApp / HP *</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $profile->phone_number) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Section 2: Instansi & Akademik -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-blue-600 border-b border-slate-100 pb-2">
                    2. Instansi Sekolah / Kampus
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Sekolah / Kampus *</label>
                        <input type="text" name="institution" value="{{ old('institution', $profile->institution) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Jurusan / Program Studi *</label>
                        <input type="text" name="major" value="{{ old('major', $profile->major) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Induk Siswa/Mahasiswa (NIS/NIM)</label>
                    <input type="text" name="student_id_number" value="{{ old('student_id_number', $profile->student_id_number) }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <!-- Section 3: Program & Mentor -->
            <div class="space-y-4 pt-2">
                <h3 class="text-xs font-bold uppercase tracking-wider text-blue-600 border-b border-slate-100 pb-2">
                    3. Periode & Penugasan Mentor
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Mulai PKL *</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $profile->start_date ? $profile->start_date->format('Y-m-d') : '') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Selesai PKL *</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $profile->end_date ? $profile->end_date->format('Y-m-d') : '') }}" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Status PKL *</label>
                        <select name="status" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                            <option value="active" {{ old('status', $profile->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="completed" {{ old('status', $profile->status) === 'completed' ? 'selected' : '' }}>Selesai / Lulus</option>
                            <option value="inactive" {{ old('status', $profile->status) === 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Assign Mentor Pembimbing</label>
                        <select name="mentor_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                            <option value="">-- Tanpa Mentor --</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}" {{ old('mentor_id', $profile->mentor_id) == $mentor->id ? 'selected' : '' }}>
                                    {{ $mentor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Program / Divisi Magang</label>
                        <select name="program_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
                            <option value="">-- Pilih Program --</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id', $profile->program_id) == $program->id ? 'selected' : '' }}>
                                    {{ $program->title ?? $program->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-blue-500">{{ old('address', $profile->address) }}</textarea>
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="btn-primary px-6 py-3 rounded-xl text-xs font-bold flex items-center gap-2">
                    <i class="fas fa-save"></i> Perbarui Data Peserta
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
