@extends('admin.layout')

@section('title', 'Manajemen PKL & Magang - Admin Panel')

@section('content')
<div class="space-y-6">
    
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Manajemen PKL & Magang</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola data seluruh peserta PKL, pembimbing mentor, tugas, nilai, dan sertifikat</p>
        </div>

        <a href="{{ route('admin.pkl.create') }}" class="btn-primary px-5 py-2.5 rounded-xl font-bold text-xs inline-flex items-center gap-2 self-start md:self-auto">
            <i class="fas fa-user-plus"></i> Tambah Peserta PKL Baru
        </a>
    </div>

    <!-- Filter Card -->
    <div class="surface-card p-5">
        <form action="{{ route('admin.pkl.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Peserta / Sekolah</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-blue-500 text-slate-800"
                       placeholder="Nama, Email, Sekolah, Jurusan...">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Status Keaktifan</label>
                <select name="status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-blue-500 text-slate-800">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai / Lulus</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Filter Mentor Pembimbing</label>
                <select name="mentor_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs focus:outline-none focus:border-blue-500 text-slate-800">
                    <option value="">Semua Mentor</option>
                    @foreach($mentors as $mentor)
                        <option value="{{ $mentor->id }}" {{ request('mentor_id') == $mentor->id ? 'selected' : '' }}>
                            {{ $mentor->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl transition shadow-sm">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('admin.pkl.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold text-xs rounded-xl transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table Card -->
    <div class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table w-full text-left text-xs">
                <thead>
                    <tr>
                        <th class="py-3.5 px-6">Peserta PKL</th>
                        <th class="py-3.5 px-6">Sekolah / Jurusan</th>
                        <th class="py-3.5 px-6">Periode Magang</th>
                        <th class="py-3.5 px-6">Mentor Pembimbing</th>
                        <th class="py-3.5 px-6">Status</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pklStudents as $profile)
                        <tr>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-sm shadow-sm shrink-0">
                                        {{ strtoupper(substr($profile->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.pkl.show', $profile->id) }}" class="font-bold text-slate-800 hover:text-blue-600 text-sm">
                                            {{ $profile->user->name ?? 'Tanpa Nama' }}
                                        </a>
                                        <p class="text-slate-500 text-[11px]">{{ $profile->user->email ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <p class="font-bold text-slate-800">{{ $profile->institution ?: '-' }}</p>
                                <p class="text-slate-500 text-[11px]">{{ $profile->major ?: '-' }}</p>
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                {{ $profile->start_date ? $profile->start_date->format('d/m/Y') : '-' }} s/d 
                                {{ $profile->end_date ? $profile->end_date->format('d/m/Y') : '-' }}
                            </td>
                            <td class="py-4 px-6">
                                @if($profile->mentor)
                                    <span class="inline-flex items-center gap-1 font-semibold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-lg text-[11px]">
                                        <i class="fas fa-user-tie text-[10px]"></i> {{ $profile->mentor->name }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic">Belum ditentukan</span>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($profile->status === 'completed')
                                    <span class="px-2.5 py-1 bg-emerald-100 text-emerald-700 font-bold rounded-lg text-[11px]">
                                        Selesai / Lulus
                                    </span>
                                @elseif($profile->status === 'active')
                                    <span class="px-2.5 py-1 bg-blue-100 text-blue-700 font-bold rounded-lg text-[11px]">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 bg-slate-100 text-slate-600 font-bold rounded-lg text-[11px]">
                                        {{ ucfirst($profile->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pkl.show', $profile->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition" title="Lihat Detail & Kelola">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.pkl.edit', $profile->id) }}" class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-lg transition" title="Edit Profil">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pkl.destroy', $profile->id) }}" method="POST" onsubmit="return confirm('Hapus seluruh data anak PKL ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition" title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-500">
                                Belum ada data peserta PKL. <a href="{{ route('admin.pkl.create') }}" class="text-blue-600 underline font-bold">Tambah peserta pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $pklStudents->links() }}
        </div>
    </div>
</div>
@endsection
