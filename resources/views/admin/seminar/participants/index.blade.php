@extends('admin.layout')

@section('title', 'Peserta Seminar - Admin Elcoding')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">Peserta Seminar &amp; Follow-Up Promo</h1>
            <p class="text-slate-500 text-sm mt-1">Pantau peserta seminar, cek ketertarikan mereka pada promo &amp; benefit, dan hubungi langsung via WhatsApp atau Email.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <a href="{{ route('admin.seminar.categories.index') }}" class="px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl font-bold text-xs inline-flex items-center gap-2">
                <i class="fas fa-tags text-sky-600"></i> Kategori Seminar
            </a>
            <a href="{{ route('admin.seminar.promos.index') }}" class="btn-primary px-5 py-2.5 rounded-xl font-bold text-xs inline-flex items-center gap-2">
                <i class="fas fa-gift"></i> Kelola Promo &amp; Benefit
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 text-emerald-700 rounded-2xl border border-emerald-200 text-sm font-medium">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="surface-card p-5">
            <p class="text-xs font-semibold text-slate-500">Total Peserta</p>
            <h3 class="text-2xl font-extrabold text-slate-800 mt-1">{{ $summary['total'] }}</h3>
        </div>
        <div class="surface-card p-5">
            <p class="text-xs font-semibold text-slate-500">Tertarik Promo</p>
            <h3 class="text-2xl font-extrabold text-pink-600 mt-1">{{ $summary['interested'] }}</h3>
        </div>
        <div class="surface-card p-5">
            <p class="text-xs font-semibold text-slate-500">Sudah Dihubungi</p>
            <h3 class="text-2xl font-extrabold text-blue-600 mt-1">{{ $summary['contacted'] }}</h3>
        </div>
        <div class="surface-card p-5">
            <p class="text-xs font-semibold text-slate-500">Converted / Klaim</p>
            <h3 class="text-2xl font-extrabold text-emerald-600 mt-1">{{ $summary['converted'] }}</h3>
        </div>
    </div>

    <!-- Filter -->
    <div class="surface-card p-5">
        <form action="{{ route('admin.seminar.participants.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Peserta</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Nama, Email, WA, Instansi..."
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-800 focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Kategori Seminar</label>
                <select name="seminar_category_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-800">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (string) request('seminar_category_id') === (string) $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Ketertarikan Promo</label>
                <select name="interest" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-800">
                    <option value="">Semua</option>
                    <option value="interested" {{ request('interest') === 'interested' ? 'selected' : '' }}>Sudah Tertarik Promo</option>
                    <option value="not_interested" {{ request('interest') === 'not_interested' ? 'selected' : '' }}>Belum Memilih Promo</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Status Follow-Up</label>
                <select name="followup_status" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-xs text-slate-800">
                    <option value="">Semua Status</option>
                    <option value="new" {{ request('followup_status') === 'new' ? 'selected' : '' }}>Baru Daftar</option>
                    <option value="interested" {{ request('followup_status') === 'interested' ? 'selected' : '' }}>Tertarik</option>
                    <option value="contacted" {{ request('followup_status') === 'contacted' ? 'selected' : '' }}>Dihubungi</option>
                    <option value="converted" {{ request('followup_status') === 'converted' ? 'selected' : '' }}>Converted</option>
                    <option value="closed" {{ request('followup_status') === 'closed' ? 'selected' : '' }}>Selesai / Closed</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl transition">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ route('admin.seminar.participants.index') }}" class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold text-xs rounded-xl transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="surface-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="modern-table w-full text-left text-xs">
                <thead>
                    <tr>
                        <th class="py-3.5 px-6">Peserta</th>
                        <th class="py-3.5 px-6">Kategori &amp; Instansi</th>
                        <th class="py-3.5 px-6">Minat Promo &amp; Benefit</th>
                        <th class="py-3.5 px-6">Status Follow-Up</th>
                        <th class="py-3.5 px-6 text-center">Aksi &amp; Kontak</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($participants as $profile)
                        @php
                            $interestedPromos = $profile->promoParticipants->where('is_interested', true);
                            $statusBadge = match($profile->followup_status) {
                                'interested' => 'bg-pink-100 text-pink-700',
                                'contacted' => 'bg-blue-100 text-blue-700',
                                'converted' => 'bg-emerald-100 text-emerald-700',
                                'closed' => 'bg-slate-200 text-slate-700',
                                default => 'bg-amber-100 text-amber-700',
                            };
                            $statusLabel = match($profile->followup_status) {
                                'interested' => 'Tertarik Promo',
                                'contacted' => 'Dihubungi',
                                'converted' => 'Converted',
                                'closed' => 'Closed',
                                default => 'Baru Daftar',
                            };
                        @endphp
                        <tr>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-sm shrink-0">
                                        {{ strtoupper(substr($profile->user->name ?? 'P', 0, 1)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.seminar.participants.show', $profile->id) }}" class="font-bold text-slate-800 hover:text-blue-600 text-sm">
                                            {{ $profile->user->name ?? 'Tanpa Nama' }}
                                        </a>
                                        <p class="text-slate-500 text-[11px]">{{ $profile->user->email ?? '-' }}</p>
                                        <p class="text-emerald-700 font-semibold text-[11px] mt-0.5">
                                            <i class="fab fa-whatsapp mr-1"></i>{{ $profile->phone_number }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="py-4 px-6">
                                <span class="inline-block px-2.5 py-0.5 rounded-md bg-indigo-50 text-indigo-700 font-bold text-[11px] mb-1">
                                    {{ $profile->category->name ?? 'Tanpa Kategori' }}
                                </span>
                                <p class="font-semibold text-slate-700">{{ $profile->institution ?: '-' }}</p>
                                <p class="text-slate-500 text-[11px]">{{ $profile->occupation }} &bull; {{ $profile->city }}</p>
                            </td>

                            <td class="py-4 px-6">
                                @if($interestedPromos->count() > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($interestedPromos->take(2) as $pp)
                                            <span class="px-2 py-0.5 rounded-md bg-pink-50 text-pink-700 border border-pink-200 font-semibold text-[11px]">
                                                <i class="fas fa-heart mr-1 text-[10px]"></i>{{ $pp->promo->title ?? '-' }}
                                            </span>
                                        @endforeach
                                        @if($interestedPromos->count() > 2)
                                            <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-semibold">
                                                +{{ $interestedPromos->count() - 2 }} lainnya
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-slate-400 italic">Belum menandai promo</span>
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                <span class="px-2.5 py-1 rounded-full font-bold text-[11px] {{ $statusBadge }}">
                                    {{ $statusLabel }}
                                </span>
                                @if($profile->last_contacted_at)
                                    <p class="text-[10px] text-slate-400 mt-1">
                                        Kontak terakhir: {{ $profile->last_contacted_at->diffForHumans() }} ({{ $profile->contact_count }}x)
                                    </p>
                                @endif
                            </td>

                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button"
                                            onclick="openContactModal({{ json_encode([
                                                'id' => $profile->id,
                                                'name' => $profile->user->name ?? 'Peserta',
                                                'phone' => $profile->phone_number,
                                                'email' => $profile->user->email ?? '',
                                                'category' => $profile->category->name ?? 'Seminar',
                                            ]) }})"
                                            class="px-3 py-1.5 bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white rounded-lg font-bold transition inline-flex items-center gap-1"
                                            title="Hubungi Peserta">
                                        <i class="fab fa-whatsapp"></i> Hubungi
                                    </button>
                                    <a href="{{ route('admin.seminar.participants.show', $profile->id) }}" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition" title="Detail &amp; Beri Promo">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.seminar.participants.destroy', $profile->id) }}" method="POST" onsubmit="return confirm('Hapus data peserta seminar ini?');" class="inline">
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
                                Belum ada peserta seminar yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $participants->links() }}
        </div>
    </div>
</div>

<!-- Quick Contact Modal -->
<div id="contactModal" class="fixed inset-0 z-[120] hidden bg-slate-900/60 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Hubungi Peserta Seminar</h3>
            <button type="button" onclick="closeContactModal()" class="text-slate-400 hover:text-slate-600"><i class="fas fa-times"></i></button>
        </div>
        <form id="contactModalForm" onsubmit="submitContactLog(event)">
            @csrf
            <div class="p-6 space-y-4">
                <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 text-xs">
                    <p class="font-bold text-slate-800" id="contactParticipantName"></p>
                    <p class="text-slate-500 mt-0.5" id="contactParticipantMeta"></p>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Channel Kontak *</label>
                    <select name="channel" id="contactChannel" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm">
                        <option value="whatsapp">WhatsApp (Buka Chat WA &amp; Catat Log)</option>
                        <option value="email">Email (Buka Aplikasi Email &amp; Catat Log)</option>
                        <option value="phone">Telepon / Catat Log Saja</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Pesan / Catatan Follow-Up</label>
                    <textarea name="message" id="contactMessage" rows="4" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm"></textarea>
                </div>
            </div>
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                <button type="button" onclick="closeContactModal()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200">Batal</button>
                <button type="submit" class="btn-primary px-5 py-2 rounded-xl text-xs font-bold">
                    <i class="fas fa-paper-plane mr-1"></i> Catat &amp; Hubungi
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let activeParticipantId = null;

function openContactModal(p) {
    activeParticipantId = p.id;
    document.getElementById('contactParticipantName').textContent = p.name;
    document.getElementById('contactParticipantMeta').textContent = (p.phone || '-') + ' • ' + (p.email || '-') + ' • ' + (p.category || '');
    document.getElementById('contactMessage').value = 'Halo ' + p.name + ', terima kasih telah mengikuti ' + p.category + ' bersama Elcoding. Kami ingin menginformasikan promo & benefit khusus untuk Anda.';
    document.getElementById('contactModal').classList.remove('hidden');
}

function closeContactModal() {
    document.getElementById('contactModal').classList.add('hidden');
}

async function submitContactLog(e) {
    e.preventDefault();
    if (!activeParticipantId) return;

    const channel = document.getElementById('contactChannel').value;
    const message = document.getElementById('contactMessage').value;

    const res = await fetch("{{ url('admin/seminar/participants') }}/" + activeParticipantId + "/contact", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ channel, message })
    });

    const data = await res.json();
    closeContactModal();
    if (data.launch_url) {
        window.open(data.launch_url, '_blank');
    }
    window.location.reload();
}
</script>
@endsection
