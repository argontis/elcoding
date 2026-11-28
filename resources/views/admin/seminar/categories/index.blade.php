@extends('admin.layout')

@section('title', 'Kategori Seminar - Admin Elcoding')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Kategori Seminar</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola kategori seminar yang muncul sebagai pilihan setelah registrasi peserta seminar.</p>
        </div>
        <button type="button" onclick="document.getElementById('addCategoryModal').classList.remove('hidden')" class="btn-primary px-5 py-2.5 rounded-xl font-bold text-xs inline-flex items-center gap-2 self-start md:self-auto">
            <i class="fas fa-plus"></i> Tambah Kategori Seminar
        </button>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-200 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 bg-red-50 text-red-700 rounded-2xl border border-red-200 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table w-full text-left text-xs">
                <thead>
                    <tr>
                        <th class="py-3.5 px-6">Nama Kategori</th>
                        <th class="py-3.5 px-6">Jadwal &amp; Lokasi</th>
                        <th class="py-3.5 px-6 text-center">Peserta</th>
                        <th class="py-3.5 px-6 text-center">Status</th>
                        <th class="py-3.5 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php
                        $colorMap = [
                            'blue' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                            'purple' => 'bg-purple-50 text-purple-700 border-purple-200',
                            'amber' => 'bg-amber-50 text-amber-700 border-amber-200',
                            'rose' => 'bg-rose-50 text-rose-700 border-rose-200',
                            'indigo' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                            'cyan' => 'bg-cyan-50 text-cyan-700 border-cyan-200',
                        ];
                    @endphp
                    @forelse($categories as $category)
                        @php $badgeClass = $colorMap[$category->badge_color] ?? $colorMap['blue']; @endphp
                        <tr>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg border text-xs font-bold {{ $badgeClass }} mb-1">
                                    {{ $category->name }}
                                </span>
                                @if($category->description)
                                    <p class="text-slate-500 text-[11px] line-clamp-2 max-w-md">{{ $category->description }}</p>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-slate-600">
                                <div><i class="fas fa-calendar-day text-slate-400 mr-1"></i> {{ $category->event_date ? $category->event_date->format('d M Y') : 'Fleksibel' }}</div>
                                <div class="text-[11px] text-slate-500 mt-0.5"><i class="fas fa-map-marker-alt text-slate-400 mr-1"></i> {{ $category->location ?: 'Online / Offline' }}</div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-bold">{{ $category->profiles_count }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('admin.seminar.categories.toggle', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-3 py-1 rounded-full text-[11px] font-bold transition {{ $category->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-slate-200 text-slate-600 hover:bg-slate-300' }}">
                                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                            onclick="openEditCategory({{ json_encode([
                                                'id' => $category->id,
                                                'name' => $category->name,
                                                'description' => $category->description,
                                                'event_date' => $category->event_date?->format('Y-m-d'),
                                                'location' => $category->location,
                                                'badge_color' => $category->badge_color,
                                                'is_active' => $category->is_active,
                                            ]) }})"
                                            class="p-2 bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white rounded-lg transition" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.seminar.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori seminar ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-500">
                                Belum ada kategori seminar. Klik <strong>Tambah Kategori Seminar</strong> untuk membuat kategori baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $categories->links() }}
        </div>
    </div>
</div>

<!-- Add Modal -->
<div id="addCategoryModal" class="fixed inset-0 z-[120] hidden bg-slate-900/60 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Tambah Kategori Seminar</h3>
            <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('admin.seminar.categories.store') }}" method="POST">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kategori Seminar *</label>
                    <input type="text" name="name" required placeholder="Contoh: Seminar AI & Career 2026" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" placeholder="Topik atau keterangan singkat seminar..." class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Seminar (Opsional)</label>
                        <input type="date" name="event_date" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi / Platform</label>
                        <input type="text" name="location" placeholder="Contoh: Zoom / Aula Kampus" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Warna Badge</label>
                        <select name="badge_color" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                            <option value="blue">Biru</option>
                            <option value="emerald">Hijau Emerald</option>
                            <option value="purple">Ungu</option>
                            <option value="amber">Amber</option>
                            <option value="rose">Rose</option>
                            <option value="indigo">Indigo</option>
                            <option value="cyan">Cyan</option>
                        </select>
                    </div>
                    <div class="pt-4">
                        <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-blue-600">
                            Aktif (Tampil saat pendaftaran)
                        </label>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200">Batal</button>
                <button type="submit" class="btn-primary px-5 py-2 rounded-xl text-xs font-bold">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editCategoryModal" class="fixed inset-0 z-[120] hidden bg-slate-900/60 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Edit Kategori Seminar</h3>
            <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </div>
        <form id="editCategoryForm" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kategori Seminar *</label>
                    <input type="text" name="name" id="editCatName" required class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" id="editCatDesc" rows="2" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40"></textarea>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Tanggal Seminar</label>
                        <input type="date" name="event_date" id="editCatDate" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi / Platform</label>
                        <input type="text" name="location" id="editCatLocation" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Warna Badge</label>
                        <select name="badge_color" id="editCatColor" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                            <option value="blue">Biru</option>
                            <option value="emerald">Hijau Emerald</option>
                            <option value="purple">Ungu</option>
                            <option value="amber">Amber</option>
                            <option value="rose">Rose</option>
                            <option value="indigo">Indigo</option>
                            <option value="cyan">Cyan</option>
                        </select>
                    </div>
                    <div class="pt-4">
                        <input type="hidden" name="is_active" value="0">
                        <label class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer">
                            <input type="checkbox" name="is_active" id="editCatActive" value="1" class="rounded border-slate-300 text-blue-600">
                            Aktif (Tampil saat pendaftaran)
                        </label>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200">Batal</button>
                <button type="submit" class="btn-primary px-5 py-2 rounded-xl text-xs font-bold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditCategory(cat) {
    document.getElementById('editCategoryForm').action = "{{ url('admin/seminar/categories') }}/" + cat.id;
    document.getElementById('editCatName').value = cat.name || '';
    document.getElementById('editCatDesc').value = cat.description || '';
    document.getElementById('editCatDate').value = cat.event_date || '';
    document.getElementById('editCatLocation').value = cat.location || '';
    document.getElementById('editCatColor').value = cat.badge_color || 'blue';
    document.getElementById('editCatActive').checked = !!cat.is_active;
    document.getElementById('editCategoryModal').classList.remove('hidden');
}
</script>
@endsection
