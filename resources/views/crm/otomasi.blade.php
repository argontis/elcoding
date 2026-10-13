@extends('crm.layout')

@section('title', 'Otomasi Penjualan & Alur Kerja AI')
@section('header_badge', 'SISTEM & OTOMASI > WORKFLOW ENGINE')

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

    /* 3 Top Metrics */
    .automation-kpis {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 900px) {
        .automation-kpis {
            grid-template-columns: 1fr;
        }
    }

    .kpi-auto-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: var(--shadow-sm);
    }

    .kpi-auto-header {
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

    .kpi-auto-val {
        font-family: var(--font-heading);
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .kpi-auto-sub {
        font-size: 11.5px;
        font-weight: 600;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Core Flow Visual Canvas */
    .core-flow-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: var(--shadow-sm);
    }

    .core-flow-top-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 14px;
    }

    .flow-badge-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .flow-nodes-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
        overflow-x: auto;
        padding: 10px 0 20px 0;
    }

    .flow-node-box {
        min-width: 170px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px;
        position: relative;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .flow-node-box:hover {
        transform: translateY(-2px);
        border-color: #4c52f8;
    }

    .node-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .node-header.trigger { color: #4c52f8; }
    .node-header.condition { color: #8b5cf6; }
    .node-header.action { color: #059669; }

    .node-title {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .node-desc {
        font-size: 11px;
        color: #64748b;
        line-height: 1.4;
        margin-bottom: 8px;
    }

    .node-foot {
        font-size: 10.5px;
        font-weight: 700;
        padding-top: 6px;
        border-top: 1px dashed #e2e8f0;
    }

    .flow-arrow-icon {
        color: #94a3b8;
        font-size: 16px;
        flex-shrink: 0;
    }

    /* Workflow Table */
    .workflow-table-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .workflow-tabs-header {
        padding: 14px 20px;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .wf-tabs {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .wf-tab-btn {
        background: transparent;
        border: 1px solid transparent;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
    }

    .wf-tab-btn.active {
        background: #4c52f8;
        color: #ffffff;
    }

    .wf-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .wf-table th {
        background: #f8fafc;
        padding: 12px 18px;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        border-bottom: 1px solid var(--border-color);
    }

    .wf-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
        vertical-align: middle;
    }

    .wf-table tr:hover td {
        background: #faf5ff;
    }
</style>
@endsection

@section('content')

    <!-- Top Header Row -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Otomasi Penjualan & Alur Kerja AI</h1>
            <p class="page-sub">Bangun alur kerja cerdas berbasis trigger, condition, dan aksi otomatis tanpa koding.</p>
        </div>
        <div class="page-actions-group">
            <div style="background:#ecfdf5; border:1px solid #a7f3d0; border-radius:8px; padding:6px 12px; font-size:12px; font-weight:700; color:#065f46; display:flex; align-items:center; gap:6px;">
                <span class="pulse-dot"></span>
                <span>Engine Normal: 8 Berjalan</span>
            </div>
            <button class="btn-outline-crm"><i class="fas fa-list-check"></i> Log Eksekusi</button>
            <button class="btn-primary-crm" onclick="openWorkflowModal()">
                <i class="fas fa-plus"></i> Buat Workflow Baru
            </button>
        </div>
    </div>

    <!-- 3 Metrics Cards - Matches PDF Page 13 -->
    <div class="automation-kpis">
        <!-- Metric 1 -->
        <div class="kpi-auto-card">
            <div class="kpi-auto-header">
                <span>VOLUME OPERASIONAL</span>
                <i class="fas fa-layer-group" style="color:#4c52f8;"></i>
            </div>
            <div class="kpi-auto-val">14.280</div>
            <div class="kpi-auto-sub">
                <span>Aksi Terotomasi Bulan Ini</span>
                <span style="color:#10b981; font-weight:700;">+24.6%</span>
            </div>
        </div>

        <!-- Metric 2 -->
        <div class="kpi-auto-card">
            <div class="kpi-auto-header">
                <span>EFISIENSI TIM PENJUALAN</span>
                <i class="fas fa-business-time" style="color:#7c3aed;"></i>
            </div>
            <div class="kpi-auto-val">320 Jam</div>
            <div class="kpi-auto-sub">
                <span>Pekerjaan Manual Dihemat</span>
                <span style="color:#7c3aed; font-weight:700;">-18 Jam / AE</span>
            </div>
        </div>

        <!-- Metric 3 -->
        <div class="kpi-auto-card">
            <div class="kpi-auto-header">
                <span>STABILITAS & KEANDALAN</span>
                <i class="fas fa-shield-halved" style="color:#10b981;"></i>
            </div>
            <div class="kpi-auto-val" style="color:#059669;">0 Loop Error</div>
            <div class="kpi-auto-sub">
                <span>Tingkat Integritas 99.98% • Sehat</span>
                <span style="color:#10b981; font-weight:700;">Latency: 28ms</span>
            </div>
        </div>
    </div>

    <!-- Core Flow Canvas - Matches PDF Page 13 -->
    <div class="core-flow-card">
        <div class="core-flow-top-row">
            <div>
                <div class="flow-badge-row">
                    <span style="background:#eef2ff; color:#4c52f8; padding:2px 8px; border-radius:4px;">CORE FLOW</span>
                    <span style="color:#10b981;">● Aktif</span>
                    <span style="color:#94a3b8;">ID: WFL-089-INB</span>
                </div>
                <h3 style="font-family:var(--font-heading); font-size:18px; font-weight:800; color:#0f172a;">
                    Kualifikasi Instan Lead Inbound & Distribusi Sales Otomatis
                </h3>
                <div style="font-size:12px; color:#64748b; margin-top:4px;">
                    ▷ 1.482 kali dieksekusi 7 hari terakhir &nbsp;•&nbsp; Tingkat Berhasil: <strong>99.4%</strong> &nbsp;•&nbsp; PIC Terakhir: Dimas Pratama (hari ini, 09:12 WIB)
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                <button class="btn-outline-crm" onclick="simulateWorkflow()"><i class="fas fa-play" style="color:#4c52f8;"></i> Uji Coba Workflow</button>
                <button class="btn-outline-crm"><i class="fas fa-sliders"></i> Edit Logika</button>
            </div>
        </div>

        <!-- Visual Flow Horizontal Nodes -->
        <div class="flow-nodes-wrapper">
            <!-- Node 1: Trigger -->
            <div class="flow-node-box">
                <div class="node-header trigger">
                    <span>TRIGGER #1</span>
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="node-title">Lead Baru Masuk</div>
                <div class="node-desc">Web Form Hubspot & Chat WhatsApp Webhook</div>
                <div class="node-foot" style="color:#4c52f8;"><i class="fas fa-bolt"></i> Instan / Zero Delay</div>
            </div>

            <i class="fas fa-arrow-right flow-arrow-icon"></i>

            <!-- Node 2: Condition -->
            <div class="flow-node-box">
                <div class="node-header condition">
                    <span>CONDITION</span>
                    <i class="fas fa-filter"></i>
                </div>
                <div class="node-title">AI Scoring ≥ 75</div>
                <div class="node-desc">Kategori Enterprise, Cek Duplikasi WhatsApp</div>
                <div class="node-foot" style="color:#7c3aed;"><i class="fas fa-check"></i> Lulus: 78.2%</div>
            </div>

            <i class="fas fa-arrow-right flow-arrow-icon"></i>

            <!-- Node 3: Action 1 -->
            <div class="flow-node-box">
                <div class="node-header action">
                    <span>ACTION #1</span>
                    <i class="fas fa-users-gear"></i>
                </div>
                <div class="node-title">Round-Robin Sales</div>
                <div class="node-desc">Distribusikan ke AE Fintek & Manufaktur</div>
                <div class="node-foot" style="color:#059669;"><i class="fas fa-scale-balanced"></i> Load Balancer (4 AE)</div>
            </div>

            <i class="fas fa-arrow-right flow-arrow-icon"></i>

            <!-- Node 4: Action 2 -->
            <div class="flow-node-box">
                <div class="node-header action">
                    <span>ACTION #2</span>
                    <i class="fab fa-whatsapp"></i>
                </div>
                <div class="node-title">Kirim WA Sambutan</div>
                <div class="node-desc">Template personalisasi + Tautan Kalender AI</div>
                <div class="node-foot" style="color:#059669;"><i class="fab fa-whatsapp"></i> WhatsApp API Official</div>
            </div>

            <i class="fas fa-arrow-right flow-arrow-icon"></i>

            <!-- Node 5: Action 3 -->
            <div class="flow-node-box">
                <div class="node-header action">
                    <span>ACTION #3</span>
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="node-title">Buat Task SLA</div>
                <div class="node-desc">SLA Call 1 Jam untuk Account Executive</div>
                <div class="node-foot" style="color:#059669;"><i class="fas fa-stopwatch"></i> SLA Priority High</div>
            </div>
        </div>
    </div>

    <!-- All Workflows Table - Matches PDF Page 13 -->
    <div class="workflow-table-card">
        <div class="workflow-tabs-header">
            <div class="wf-tabs">
                <button class="wf-tab-btn active">Semua Alur Kerja (12)</button>
                <button class="wf-tab-btn">Aktif (8)</button>
                <button class="wf-tab-btn">Draft / Nonaktif (4)</button>
                <button class="wf-tab-btn">Log & Riwayat Eksekusi</button>
            </div>
            <div style="font-size:12px; color:#64748b;">
                <input type="text" placeholder="Filter nama alur kerja..." style="padding:6px 12px; border:1px solid #cbd5e1; border-radius:6px; font-size:12px; outline:none;">
            </div>
        </div>

        <table class="wf-table">
            <thead>
                <tr>
                    <th style="width: 30px;">STATUS</th>
                    <th>NAMA ALUR KERJA & SPESIFIKASI LOGIKA</th>
                    <th>TIPE TRIGGER</th>
                    <th>FREKUENSI (30 HARI)</th>
                    <th>TINGKAT KEBERHASILAN</th>
                    <th>PEMBUAT / PIC</th>
                    <th style="text-align:right;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workflows as $wf)
                    <tr>
                        <td>
                            <input type="checkbox" checked style="accent-color:#4c52f8;">
                        </td>
                        <td>
                            <div style="font-weight:700; color:#0f172a;">{{ $wf['name'] }}</div>
                            <div style="font-size:11.5px; color:#64748b; margin-top:2px;">{{ $wf['desc'] }}</div>
                        </td>
                        <td>
                            <span style="background:#f1f5f9; color:#334155; font-size:11px; font-weight:700; padding:3px 8px; border-radius:4px;">
                                {{ $wf['type'] }}
                            </span>
                        </td>
                        <td>
                            <strong style="color:#0f172a;">{{ $wf['freq'] }}</strong>
                        </td>
                        <td>
                            <div style="font-size:12px; font-weight:700; color:#059669;">{{ $wf['success_rate'] }}</div>
                            <div style="font-size:10.5px; color:#64748b;">{{ $wf['success_detail'] }}</div>
                        </td>
                        <td>
                            <span style="font-size:12px; font-weight:600; color:#334155;">{{ $wf['pic'] }}</span>
                        </td>
                        <td style="text-align:right;">
                            <div style="display:flex; justify-content:flex-end; gap:8px; color:#94a3b8; font-size:13px;">
                                <i class="fas fa-pen-to-square" style="cursor:pointer;" title="Edit"></i>
                                <i class="fas fa-trash" style="cursor:pointer;" title="Hapus"></i>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:14px 18px; display:flex; align-items:center; justify-content:space-between; font-size:12px; color:#64748b; background:#f8fafc; border-top:1px solid var(--border-color);">
            <div>Menampilkan <strong>4</strong> dari 12 alur kerja sistem terdaftar</div>
            <div style="display:flex; gap:6px;">
                <button class="btn-primary-crm" style="padding:4px 10px; font-size:11px;">1</button>
                <button class="btn-outline-crm" style="padding:4px 10px; font-size:11px;">2</button>
                <button class="btn-outline-crm" style="padding:4px 10px; font-size:11px;">3</button>
            </div>
        </div>
    </div>

    <!-- Modal Buat Workflow Baru -->
    <div class="modal-overlay" id="workflowModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-bolt" style="color:#4c52f8; margin-right:8px;"></i> Buat Alur Kerja Otomasi Baru</h3>
                <button class="modal-close" onclick="closeWorkflowModal()">&times;</button>
            </div>
            <form onsubmit="handleNewWorkflow(event)">
                <div class="modal-body">
                    <div class="form-group-crm">
                        <label>Nama Alur Kerja</label>
                        <input type="text" class="form-input-crm" placeholder="Contoh: Notifikasi WhatsApp Deal Berstatus Hot" required>
                    </div>
                    <div class="form-group-crm">
                        <label>Tipe Trigger Utama</label>
                        <select class="form-input-crm">
                            <option>Lead Baru Masuk (Inbound Webhook)</option>
                            <option>Status Deal Berubah (Stage Aging)</option>
                            <option>Diskon Melebihi Batas (Field Update)</option>
                            <option>Lead Tidak Merespon > 72 Jam (Drip)</option>
                        </select>
                    </div>
                    <div class="form-group-crm">
                        <label>Kondisi & Filter AI</label>
                        <input type="text" class="form-input-crm" placeholder="AI Scoring ≥ 75 & Kategori Enterprise" required>
                    </div>
                    <div class="form-group-crm">
                        <label>Tindakan Otomatis (Action)</label>
                        <select class="form-input-crm">
                            <option>Kirim Pesan WhatsApp Otomatis via API</option>
                            <option>Distribusikan ke Account Executive (Round-Robin)</option>
                            <option>Kirim Notifikasi Push ke Slack Channel</option>
                            <option>Buat Task Prioritas Tinggi di Dashboard AE</option>
                        </select>
                    </div>
                </div>
                <div style="padding:16px 24px; background:#f8fafc; border-top:1px solid #f1f5f9; display:flex; justify-content:flex-end; gap:10px;">
                    <button type="button" class="btn-outline-crm" onclick="closeWorkflowModal()">Batal</button>
                    <button type="submit" class="btn-primary-crm">Aktifkan Alur Kerja</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function openWorkflowModal() {
        document.getElementById('workflowModal').classList.add('open');
    }
    function closeWorkflowModal() {
        document.getElementById('workflowModal').classList.remove('open');
    }
    function simulateWorkflow() {
        alert('Simulator Alur Kerja: Trigger "Lead Baru Masuk" terkirim. Node Condition lulus (AI Score 94), WhatsApp dikirim, task SLA terbuat dalam 12ms!');
    }
    function handleNewWorkflow(e) {
        e.preventDefault();
        closeWorkflowModal();
        alert('Alur kerja baru berhasil disimpan dan aktif di engine sistem!');
    }
</script>
@endsection
