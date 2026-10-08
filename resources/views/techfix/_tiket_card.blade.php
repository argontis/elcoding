<div class="kanban-card bg-white rounded-xl border border-slate-200 p-3.5 cursor-pointer hover:border-slate-300 shadow-sm"
    onclick="window.location='{{ route('techfix.dashboard') }}?tiket={{ $tiket['id'] }}'">

    <!-- Header: kode tiket + badge prioritas -->
    <div class="flex items-start justify-between mb-2">
        <div class="flex items-center gap-1.5">
            <span class="text-[11px] font-bold text-techfix-700">{{ $tiket['kode'] ?? $tiket['id'] }}</span>
            @if(!empty($tiket['priority']))
            <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-full
                {{ $tiket['priority'] === 'VIP' ? 'badge-vip' : ($tiket['priority'] === 'Priority' ? 'badge-prio' : 'badge-reg') }}">
                {{ $tiket['priority'] }}
            </span>
            @endif
        </div>
        <span class="text-[9px] font-semibold px-1.5 py-0.5 rounded-full {{ $colClass }}">
            {{ $tiket['status'] }}
        </span>
    </div>

    <!-- Device name -->
    <div class="font-semibold text-sm text-slate-800 leading-tight mb-1">{{ $tiket['device'] }}</div>

    <!-- Pelanggan & Teknisi -->
    <div class="text-[11px] text-slate-500 mb-2 space-y-0.5">
        <div><span class="text-slate-400">Pelanggan:</span> {{ $tiket['nama_pelanggan'] }}</div>
        @if(!empty($tiket['teknisi']) && $tiket['teknisi'] !== 'Belum Assign')
        <div><span class="text-slate-400">Teknisi:</span> {{ $tiket['teknisi'] }}</div>
        @endif
    </div>

    <!-- Keluhan snippet -->
    @if(!empty($tiket['keluhan']))
    <div class="bg-slate-50 rounded-lg px-2.5 py-2 text-[11px] text-slate-600 leading-relaxed mb-2 line-clamp-2">
        {{ Str::limit($tiket['keluhan'], 80) }}
    </div>
    @endif

    <!-- Progress bar jika ada -->
    @if(!empty($tiket['progress']) && $tiket['progress'] > 0)
    <div class="mb-2">
        <div class="flex items-center justify-between text-[10px] text-slate-500 mb-1">
            <span>Progress Servis</span>
            <span class="font-bold text-techfix-600">{{ $tiket['progress'] }}%</span>
        </div>
        <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-gradient-to-r from-techfix-500 to-techfix-400 rounded-full transition-all"
                style="width:{{ $tiket['progress'] }}%"></div>
        </div>
    </div>
    @endif

    <!-- Footer: timestamp + estimasi -->
    <div class="flex items-center justify-between text-[10px] text-slate-400 mt-2 pt-2 border-t border-slate-100">
        <span>{{ $tiket['created_at'] ?? 'Baru saja' }}</span>
        @if(!empty($tiket['estimasi_biaya']) && $tiket['estimasi_biaya'] !== 'Rp 0')
        <span class="font-semibold text-slate-600">{{ $tiket['estimasi_biaya'] }}</span>
        @endif
    </div>
</div>
