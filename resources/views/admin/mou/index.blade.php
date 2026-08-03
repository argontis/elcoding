@extends('admin.layout')
@section('title', 'Daftar MoU - Admin Elcoding')
@section('header', 'Daftar Mou')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h3 class="text-xl font-bold text-slate-800">Daftar Mou</h3>
    <a href="{{ url('admin/mou/create') }}" class="btn-primary px-4 py-2 rounded-lg font-semibold flex items-center gap-2 shadow-sm bg-blue-600 text-white hover:bg-blue-700">
        Buat Mou
    </a>
</div>

<div class="surface-card p-0 w-full overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-sm">
                    <th class="py-4 px-6 font-semibold w-16">No</th>
                    <th class="py-4 px-6 font-semibold">Nama File</th>
                    <th class="py-4 px-6 font-semibold">Customer</th>
                    <th class="py-4 px-6 font-semibold">Lokasi</th>
                    <th class="py-4 px-6 font-semibold">Tanggal</th>
                    <th class="py-4 px-6 font-semibold">Grand Total</th>
                    <th class="py-4 px-6 font-semibold">Dibuat Oleh</th>
                    <th class="py-4 px-6 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-100">
                @forelse($mous as $mou)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="py-4 px-6 text-slate-500">{{ $loop->iteration }}</td>
                    <td class="py-4 px-6 font-medium text-slate-800">{{ $mou->nama_file }}</td>
                    <td class="py-4 px-6 text-slate-600">{{ $mou->nama_customer }}</td>
                    <td class="py-4 px-6 text-slate-600">{{ $mou->lokasi }}</td>
                    <td class="py-4 px-6 text-slate-600">{{ \Carbon\Carbon::parse($mou->tanggal)->format('d/m/Y') }}</td>
                    <td class="py-4 px-6 text-slate-600">Rp. {{ number_format($mou->grand_total, 0, ',', '.') }},-</td>
                    <td class="py-4 px-6 text-slate-600">{{ $mou->created_by }}</td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ url('admin/mou/'.$mou->id.'/pdf') }}" class="text-xs bg-indigo-600 text-white px-3 py-1.5 rounded-lg font-medium hover:bg-indigo-700 transition flex items-center gap-1">
                                <i class="fas fa-download"></i> Download
                            </a>
                            <a href="{{ url('admin/mou/'.$mou->id.'/edit') }}" class="text-xs bg-blue-500 text-white px-3 py-1.5 rounded-lg font-medium hover:bg-blue-600 transition flex items-center gap-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ url('admin/mou/'.$mou->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus MoU ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-red-500 text-white px-3 py-1.5 rounded-lg font-medium hover:bg-red-600 transition flex items-center gap-1">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-8 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-file-contract text-4xl mb-3 text-slate-300"></i>
                            <p>Belum ada data MoU.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
