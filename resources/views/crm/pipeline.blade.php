@extends('crm.layout')

@section('title', 'Sales Pipeline Penjualan')
@section('header_badge', 'PIPELINE B2B ENTERPRISE • Sinkronisasi Realtime')

@section('styles')
<style>
    .page-header-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .page-title {
        font-family: var(--font-heading);
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.5px;
    }

    .page-sub {
        font-size: 13px;
        color: #64748b;
        margin-top: 4px;
    }

    .page-actions-group {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    /* Top 4 Metrics Cards - Matches PDF Page 15 */
    .pipeline-kpis {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) {
        .pipeline-kpis {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .kpi-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 18px;
        box-shadow: var(--shadow-sm);
    }

    .kpi-title-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .kpi-value {
        font-family: var(--font-heading);
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .kpi-sub {
        font-size: 11.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Kanban Board Layout */
    .kanban-board-container {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        padding-bottom: 24px;
        min-height: 600px;
    }

    .kanban-col {
        min-width: 290px;
        width: 290px;
        background: #f1f5f9;
        border-radius: 14px;
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        border: 1px solid #e2e8f0;
    }

    .kanban-col-header {
        padding: 14px 16px;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .kanban-col-title-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .kanban-col-name {
        font-size: 13.5px;
        font-weight: 800;
        color: #1e1b4b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .kanban-col-count {
        background: #e2e8f0;
        color: #475569;
        font-size: 11px;
        font-weight: 800;
        padding: 2px 7px;
        border-radius: 100px;
    }

    .kanban-col-total {
        font-size: 11.5px;
        font-weight: 700;
        color: #4c52f8;
    }

    .kanban-cards-body {
        padding: 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex: 1;
        overflow-y: auto;
    }

    /* Deal Card in Kanban - Matches PDF Page 15 */
    .deal-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        cursor: grab;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .deal-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
        border-color: #c7d2fe;
    }

    .deal-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .deal-industry-tag {
        font-size: 10.5px;
        font-weight: 700;
        color: #475569;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 4px;
    }

    .deal-prob-badge {
        font-size: 11px;
        font-weight: 800;
        color: #4c52f8;
    }

    .deal-title {
        font-size: 13.5px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.3;
        margin-bottom: 4px;
    }

    .deal-company {
        font-size: 11.5px;
        color: #64748b;
        margin-bottom: 10px;
    }

    .deal-value {
        font-family: var(--font-heading);
        font-size: 15px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .deal-status-flag {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
        margin-bottom: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .deal-status-flag.info {
        background: #eef2ff;
        color: #4c52f8;
    }

    .deal-status-flag.danger {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .deal-status-flag.success {
        background: #ecfdf5;
        color: #059669;
    }

    .deal-status-flag.purple {
        background: #f5f3ff;
        color: #7c3aed;
    }

    .deal-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 8px;
        border-top: 1px solid #f1f5f9;
    }

    .deal-pic-pill {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        color: #334155;
    }

    .pic-badge-circle {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #4c52f8;
        color: #ffffff;
        font-size: 9px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .deal-action-icons {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #94a3b8;
        font-size: 12px;
    }
</style>
@endsection

@section('content')

    <!-- Top Header Row -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Sales Pipeline Penjualan</h1>
            <p class="page-sub">Visualisasi progres kesepakatan, weighted revenue forecasting, serta mitigasi risiko berbasis AI.</p>
        </div>
        <div class="page-actions-group">
            <div style="background:#ffffff; border:1px solid var(--border-color); border-radius:8px; padding:3px; display:flex;">
                <button class="btn-primary-crm" style="padding:6px 12px; font-size:12px; box-shadow:none;"><i class="fas fa-columns"></i> Kanban View</button>
                <button class="btn-outline-crm" style="border:none; padding:6px 12px; font-size:12px;"><i class="fas fa-table"></i> Table View</button>
            </div>
            <select class="dropdown-select-crm">
                <option>Sales Enterprise</option>
                <option>Enterprise West</option>
                <option>Gov Tech & BUMN</option>
            </select>
            <select class="dropdown-select-crm">
                <option>Q4 2026</option>
                <option>Q3 2026</option>
                <option>Q2 2026</option>
            </select>
            <button class="btn-primary-crm" onclick="openDealModal()">
                <i class="fas fa-plus"></i> Buat Peluang Baru
            </button>
        </div>
    </div>

    <!-- 4 Pipeline KPIs - Matches PDF Page 15 -->
    <div class="pipeline-kpis">
        <!-- KPI 1 -->
        <div class="kpi-card">
            <div class="kpi-title-row">
                <span>TOTAL PIPELINE TERBUKA</span>
                <i class="fas fa-folder-open" style="color:#4c52f8;"></i>
            </div>
            <div class="kpi-value">Rp 8,75 Miliar</div>
            <div class="kpi-sub" style="color:#10b981;">
                <i class="fas fa-arrow-trend-up"></i>
                <span>+18.4% 58 Peluang Aktif</span>
            </div>
        </div>

        <!-- KPI 2 -->
        <div class="kpi-card">
            <div class="kpi-title-row">
                <span>WEIGHTED PIPELINE (AI FORECAST)</span>
                <i class="fas fa-wand-magic-sparkles" style="color:#7c3aed;"></i>
            </div>
            <div class="kpi-value" style="color:#7c3aed;">Rp 4,82 Miliar</div>
            <div class="kpi-sub" style="color:#64748b;">
                <span>Konversi diproyeksi 55.1%</span>
            </div>
        </div>

        <!-- KPI 3 -->
        <div class="kpi-card">
            <div class="kpi-title-row">
                <span>RATA-RATA SIKLUS PENJUALAN</span>
                <i class="fas fa-clock" style="color:#0284c7;"></i>
            </div>
            <div class="kpi-value">24 Hari</div>
            <div class="kpi-sub" style="color:#0284c7;">
                <span style="background:#e0f2fe; padding:2px 6px; border-radius:4px;">4 Hari Lebih Cepat</span> vs Q3 2026
            </div>
        </div>

        <!-- KPI 4 -->
        <div class="kpi-card">
            <div class="kpi-title-row">
                <span>AI DEAL VELOCITY</span>
                <i class="fas fa-bolt" style="color:#10b981;"></i>
            </div>
            <div class="kpi-value" style="color:#059669;">SLA 98%</div>
            <div class="kpi-sub" style="color:#475569; font-size:11px;">
                <span>3 deal di tahap Proposal berpeluang closed sebelum 15 Nov</span>
            </div>
        </div>
    </div>

    <!-- Kanban Board Columns - Matches PDF Page 15 -->
    <div class="kanban-board-container">
        @foreach($columns as $col)
            <div class="kanban-col">
                <div class="kanban-col-header">
                    <div class="kanban-col-title-row">
                        <div class="kanban-col-name">
                            <span style="width:8px; height:8px; border-radius:50%; background:#4c52f8;"></span>
                            <span>{{ $col['title'] }}</span>
                        </div>
                        <span class="kanban-col-count">{{ $col['count'] }}</span>
                    </div>
                    <div class="kanban-col-total">{{ $col['total'] }}</div>
                </div>

                <div class="kanban-cards-body">
                    @foreach($col['deals'] as $deal)
                        <div class="deal-card">
                            <div class="deal-card-top">
                                <span class="deal-industry-tag">{{ $deal['tag'] }}</span>
                                <span class="deal-prob-badge">{{ $deal['prob'] }}</span>
                            </div>
                            <div class="deal-title">{{ $deal['title'] }}</div>
                            <div class="deal-company">{{ $deal['company'] }}</div>
                            <div class="deal-value">{{ $deal['value'] }}</div>
                            
                            @if(isset($deal['badge']))
                                <div class="deal-status-flag {{ $deal['badge_type'] }}">
                                    @if($deal['badge_type'] === 'danger')
                                        <i class="fas fa-triangle-exclamation"></i>
                                    @elseif($deal['badge_type'] === 'success')
                                        <i class="fas fa-circle-check"></i>
                                    @else
                                        <i class="fas fa-circle-dot"></i>
                                    @endif
                                    <span>{{ $deal['badge'] }}</span>
                                </div>
                            @endif

                            <div class="deal-card-footer">
                                <div class="deal-pic-pill">
                                    <div class="pic-badge-circle">{{ $deal['pic'] }}</div>
                                    <span>{{ $deal['pic_name'] }}</span>
                                </div>
                                <div class="deal-action-icons">
                                    <i class="far fa-comment-dots" title="Chat" style="cursor:pointer;"></i>
                                    <i class="fas fa-phone" title="Call" style="cursor:pointer;"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Tambah Peluang Baru -->
    <div class="modal-overlay" id="dealModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-folder-plus" style="color:#4c52f8; margin-right:8px;"></i> Buat Peluang Baru (Deal)</h3>
                <button class="modal-close" onclick="closeDealModal()">&times;</button>
            </div>
            <form action="{{ route('crm.pipeline.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group-crm">
                        <label>Judul Peluang / Proyek</label>
                        <input type="text" name="title" class="form-input-crm" placeholder="Contoh: Implementasi Cloud ERP & WhatsApp Engine" required>
                    </div>
                    <div class="form-group-crm">
                        <label>Nama Perusahaan / Akun B2B</label>
                        <input type="text" name="company" class="form-input-crm" placeholder="Contoh: PT Bank Mandiri Sinergi Tbk" required>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group-crm">
                            <label>Estimasi Nilai Kontrak (IDR)</label>
                            <input type="text" name="value" class="form-input-crm" placeholder="Rp 500.000.000" required>
                        </div>
                        <div class="form-group-crm">
                            <label>Tahap Awal Pipeline</label>
                            <select name="stage" class="form-input-crm">
                                <option>1. Lead Baru</option>
                                <option>2. Kontak Pertama</option>
                                <option>3. Kualifikasi Kebutuhan</option>
                                <option>4. Proposal & RFP</option>
                                <option>5. Negosiasi Legal</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-crm">
                        <label>Account Executive (PIC)</label>
                        <select name="pic" class="form-input-crm">
                            <option>Dimas Pratama (Super Admin)</option>
                            <option>Budi Santoso (Enterprise Lead)</option>
                            <option>Siti Rahma (Senior AE)</option>
                            <option>Rian Kusuma (Commercial)</option>
                        </select>
                    </div>
                </div>
                <div style="padding:16px 24px; background:#f8fafc; border-top:1px solid #f1f5f9; display:flex; justify-content:flex-end; gap:10px;">
                    <button type="button" class="btn-outline-crm" onclick="closeDealModal()">Batal</button>
                    <button type="submit" class="btn-primary-crm">Simpan ke Pipeline</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function openDealModal() {
        document.getElementById('dealModal').classList.add('open');
    }
    function closeDealModal() {
        document.getElementById('dealModal').classList.remove('open');
    }
</script>
@endsection
