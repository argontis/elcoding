@extends('admin.layout')

@section('title', 'Kelola Kategori Portofolio - Admin Elcoding')
@section('header', 'Kategori Portofolio')

@section('content')
<div class="surface-card">
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Kategori Portofolio</h3>
            <p class="text-sm text-slate-500 mt-1">Kelola kategori untuk portofolio project.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ url('admin/portofolio') }}" class="px-4 py-2.5 rounded-xl font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="btn-primary px-5 py-2.5 rounded-xl font-semibold flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>
    </div>
    
    @if(session('success'))
    <div class="m-6 p-4 bg-emerald-50 text-emerald-600 rounded-lg border border-emerald-100">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse modern-table">
            <thead>
                <tr>
                    <th class="px-6 py-4 w-16 text-center">No</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4 w-32">Warna Badge</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $index => $kat)
                <tr>
                    <td class="px-6 py-4 text-center text-slate-500 font-medium">{{ $kategori->firstItem() + $index }}</td>
                    <td class="px-6 py-4 font-bold text-slate-800">{{ $kat->name }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 bg-{{ $kat->color }}-50 text-{{ $kat->color }}-600 rounded text-xs font-bold border border-{{ $kat->color }}-100">
                            {{ $kat->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <button type="button" onclick="editCategory({{ $kat->id }}, '{{ addslashes($kat->name) }}', '{{ $kat->color }}')" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors" title="Edit">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form action="{{ url('admin/kategori-portofolio/'.$kat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Portofolio terkait akan berubah menjadi kategori Lainnya.');" class="m-0 p-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-colors" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada data kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-5 border-t border-slate-100">
        {{ $kategori->links() }}
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Tambah Kategori</h3>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ url('admin/kategori-portofolio') }}" method="POST">
            @csrf
            <div class="p-6">
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kategori</label>
                <input type="text" name="name" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required placeholder="Cth: Web Development">
                <p class="text-xs text-slate-500 mt-2">Warna akan dibuat secara otomatis agar unik.</p>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-4 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-200 transition-colors">Batal</button>
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg font-semibold shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden bg-slate-900/50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Edit Kategori</h3>
            <button onclick="document.getElementById('editModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kategori</label>
                    <input type="text" name="name" id="editName" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Warna Badge (Opsional)</label>
                    <select name="color" id="editColor" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                        <option value="blue">Biru (Blue)</option>
                        <option value="purple">Ungu (Purple)</option>
                        <option value="emerald">Hijau Zamrud (Emerald)</option>
                        <option value="amber">Kuning (Amber)</option>
                        <option value="rose">Merah Muda (Rose)</option>
                        <option value="indigo">Nila (Indigo)</option>
                        <option value="cyan">Biru Muda (Cyan)</option>
                        <option value="fuchsia">Magenta (Fuchsia)</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 rounded-lg font-medium text-slate-600 hover:bg-slate-200 transition-colors">Batal</button>
                <button type="submit" class="btn-primary px-4 py-2 rounded-lg font-semibold shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function editCategory(id, name, color) {
    document.getElementById('editForm').action = "{{ url('admin/kategori-portofolio') }}/" + id;
    document.getElementById('editName').value = name;
    document.getElementById('editColor').value = color;
    document.getElementById('editModal').classList.remove('hidden');
}
</script>
@endsection
