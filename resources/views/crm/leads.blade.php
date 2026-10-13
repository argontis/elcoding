@extends('crm.layout')

@section('title', 'Pengelolaan Calon Pelanggan (Leads)')
@section('header_badge', 'PIPELINE CRM > DIREKTORI LEADS')

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

    /* AI Smart Triage Banner */
    .smart-triage-box {
        background: #f8faff;
        border: 1px solid #c7d2fe;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .smart-triage-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .triage-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #e0e7ff;
        color: #4c52f8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .triage-title {
        font-size: 14px;
        font-weight: 800;
        color: #1e1b4b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .triage-desc {
        font-size: 12.5px;
        color: #475569;
        margin-top: 2px;
    }

    .duplicate-shield-card {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 10px 14px;
        display: flex;
        align-items: center;
        gap: 10px;
        white-space: nowrap;
    }

    /* Filter Toolbar */
    .filter-toolbar {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 14px 18px;
        margin-bottom: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .filter-controls-row {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .search-input-wrap {
        flex: 1;
        min-width: 260px;
        position: relative;
    }

    .search-input-wrap i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .search-input-wrap input {
        width: 100%;
        padding: 8px 14px 8px 38px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        font-size: 12.5px;
        outline: none;
    }

    .search-input-wrap input:focus {
        border-color: #4c52f8;
    }

    .active-filter-tags {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11.5px;
    }

    .filter-tag {
        background: #f1f5f9;
        color: #334155;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Mass Selection Action Bar - Matches PDF */
    .bulk-action-bar {
        background: #1e1b4b;
        color: #ffffff;
        border-radius: 12px;
        padding: 12px 18px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        flex-wrap: wrap;
    }

    .bulk-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .bulk-count-badge {
        background: #4c52f8;
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .bulk-btns {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .btn-bulk {
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #ffffff;
        font-size: 11.5px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-bulk:hover {
        background: rgba(255, 255, 255, 0.25);
    }

    /* Leads Table */
    .table-container {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 24px;
    }

    .leads-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .leads-table th {
        background: #f8fafc;
        padding: 14px 16px;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        border-bottom: 1px solid var(--border-color);
    }

    .leads-table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13px;
        vertical-align: middle;
    }

    .leads-table tr:hover td {
        background-color: #faf5ff;
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        color: #ffffff;
        font-size: 12px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .ai-score-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 700;
    }

    .ai-score-badge.high {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .ai-score-badge.medium {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

    .ai-score-badge.low {
        background: #f8fafc;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    .source-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 600;
        background: #f1f5f9;
        color: #334155;
    }

    /* 3 Bottom Summary Cards */
    .bottom-metrics-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    @media (max-width: 900px) {
        .bottom-metrics-3 {
            grid-template-columns: 1fr;
        }
    }

    .bottom-metric-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .bottom-metric-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
</style>
@endsection

@section('content')

    <!-- Header & Action Buttons -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Pengelolaan Calon Pelanggan (Leads)</h1>
            <p class="page-sub">Total 1,482 Leads • <span style="color:#ef4444; font-weight:700;">38 Belum Ditugaskan</span></p>
        </div>
        <div class="page-actions-group">
            <button class="btn-outline-crm">
                <i class="fas fa-sliders"></i> Filter Kolom
            </button>
            <button class="btn-outline-crm">
                <i class="fas fa-download"></i> Ekspor Data
            </button>
            <button class="btn-outline-crm">
                <i class="fas fa-file-csv"></i> Import CSV / XLSX
            </button>
            <button class="btn-primary-crm" onclick="openLeadModal()">
                <i class="fas fa-plus"></i> Tambah Lead Baru
            </button>
        </div>
    </div>

    <!-- AI Smart Triage Banner - Matches PDF Page 10 -->
    <div class="smart-triage-box">
        <div class="smart-triage-left">
            <div class="triage-icon">
                <i class="fas fa-sparkles"></i>
            </div>
            <div>
                <div class="triage-title">
                    <span>AI Smart Triage & Prioritization Aktif</span>
                    <span style="background:#e0e7ff; color:#4c52f8; font-size:10px; font-weight:800; padding:2px 6px; border-radius:4px;">Versi 4.2</span>
                </div>
                <div class="triage-desc">
                    94 leads baru memiliki sinyal pembelian tinggi (>80) berdasarkan analisis interaksi WhatsApp dan kecocokan ICP Enterprise.
                </div>
            </div>
        </div>
        <div style="display:flex; align-items:center; gap:12px;">
            <a href="{{ route('crm.leads') }}" class="btn-primary-crm" style="background:#4c52f8; white-space:nowrap;">
                <i class="fas fa-wand-magic-sparkles"></i> Prioritaskan Leads AI
            </a>
            <div class="duplicate-shield-card">
                <i class="fas fa-circle-check" style="color:#10b981; font-size:16px;"></i>
                <div>
                    <div style="font-size:12px; font-weight:800; color:#065f46;">0 Duplikasi</div>
                    <div style="font-size:10.5px; color:#047857;">Batch CSV Terakhir Aman</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar - Matches PDF -->
    <div class="filter-toolbar">
        <div class="filter-controls-row">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari berdasarkan nama, perusahaan, email, atau no. telepon...">
            </div>
            <select class="dropdown-select-crm">
                <option>Qualified</option>
                <option>Unqualified</option>
                <option>Semua Status</option>
            </select>
            <select class="dropdown-select-crm">
                <option>Semua Sumber</option>
                <option>Form Website</option>
                <option>LinkedIn Campaign</option>
                <option>Event B2B Summit</option>
                <option>Google Ads B2B</option>
            </select>
            <select class="dropdown-select-crm">
                <option>Semua Sales PIC</option>
                <option>Dimas Pratama</option>
                <option>Budi Santoso</option>
                <option>Siti Rahma</option>
            </select>
            <select class="dropdown-select-crm">
                <option>High (>80)</option>
                <option>Medium (60-80)</option>
                <option>Low (<60)</option>
            </select>
        </div>
        <div class="active-filter-tags">
            <span style="color:#64748b; font-weight:700;">FILTER AKTIF:</span>
            <span class="filter-tag">Status: Qualified <i class="fas fa-times" style="cursor:pointer;"></i></span>
            <span class="filter-tag">✨ AI Score: High (>80) <i class="fas fa-times" style="cursor:pointer;"></i></span>
            <a href="{{ route('crm.leads') }}" style="color:#4c52f8; font-weight:700; text-decoration:none; margin-left:8px;">Reset Semua Filter</a>
        </div>
    </div>

    <!-- Mass Action Bar (3 Lead Terpilih) - Matches PDF Page 10 -->
    <div class="bulk-action-bar">
        <div class="bulk-left">
            <span class="bulk-count-badge">3 Lead Terpilih</span>
            <span style="font-size:12px; color:#cbd5e1;">Tindakan massal untuk mempercepat alur penugasan dan outreach.</span>
        </div>
        <div class="bulk-btns">
            <button class="btn-bulk"><i class="fas fa-user-check"></i> Tugaskan Owner</button>
            <button class="btn-bulk"><i class="fas fa-arrows-rotate"></i> Ubah Status</button>
            <button class="btn-bulk"><i class="fas fa-tags"></i> Tambah Tag</button>
            <button class="btn-bulk" style="background:#4c52f8;"><i class="fas fa-paper-plane"></i> Kirim Pesan AI Draft</button>
            <button class="btn-bulk" style="background:rgba(239,68,68,0.25); border-color:rgba(239,68,68,0.4);"><i class="fas fa-trash"></i> Hapus/Arsipkan</button>
        </div>
    </div>

    <!-- Table of Leads - Matches PDF Page 10 -->
    <div class="table-container">
        <table class="leads-table">
            <thead>
                <tr>
                    <th style="width: 40px;"><input type="checkbox" checked></th>
                    <th>NAMA & CALON PELANGGAN</th>
                    <th>PERUSAHAAN & INDUSTRI</th>
                    <th>KONTAK RESMI</th>
                    <th>SUMBER</th>
                    <th>AI SCORE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr>
                        <td>
                            <input type="checkbox" {{ $lead['selected'] ? 'checked' : '' }}>
                        </td>
                        <td>
                            <div class="user-cell">
                                <div class="user-avatar-circle" style="background-color: {{ $lead['color'] }};">
                                    {{ $lead['initials'] }}
                                </div>
                                <div>
                                    <div style="font-weight:700; color:#0f172a;">{{ $lead['name'] }}</div>
                                    <div style="font-size:11.5px; color:#64748b;">{{ $lead['title'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:700; color:#0f172a;">{{ $lead['company'] }}</div>
                            <div style="font-size:11.5px; color:#64748b;">{{ $lead['industry'] }}</div>
                        </td>
                        <td>
                            <div style="font-size:12px; color:#475569;">{{ $lead['email'] }}</div>
                            <div style="font-size:11.5px; color:#64748b; display:flex; align-items:center; gap:4px; margin-top:2px;">
                                <i class="fab fa-whatsapp" style="color:#10b981;"></i>
                                {{ $lead['phone'] }}
                            </div>
                        </td>
                        <td>
                            <span class="source-badge">{{ $lead['source'] }}</span>
                        </td>
                        <td>
                            <div class="ai-score-badge {{ $lead['level_type'] }}">
                                <i class="fas fa-sparkles"></i>
                                <span>{{ $lead['score'] }} • {{ $lead['level'] }}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Table Footer / Pagination -->
        <div style="padding:14px 18px; display:flex; align-items:center; justify-content:space-between; font-size:12px; color:#64748b; background:#f8fafc; border-top:1px solid var(--border-color);">
            <div>Menampilkan <strong>1-10</strong> dari <strong>1,482</strong> data &nbsp;•&nbsp; Baris: <strong>10</strong></div>
            <div style="display:flex; align-items:center; gap:6px;">
                <button class="btn-outline-crm" style="padding:4px 8px; font-size:11px;" disabled><i class="fas fa-chevron-left"></i></button>
                <button class="btn-primary-crm" style="padding:4px 10px; font-size:11px;">1</button>
                <button class="btn-outline-crm" style="padding:4px 10px; font-size:11px;">2</button>
                <button class="btn-outline-crm" style="padding:4px 10px; font-size:11px;">3</button>
                <span>...</span>
                <button class="btn-outline-crm" style="padding:4px 10px; font-size:11px;">149</button>
                <button class="btn-outline-crm" style="padding:4px 8px; font-size:11px;"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <!-- 3 Bottom Metric Cards - Matches PDF Page 10 -->
    <div class="bottom-metrics-3">
        <!-- Metric 1 -->
        <div class="bottom-metric-card">
            <div class="bottom-metric-icon" style="background:#ecfdf5; color:#10b981;">
                <i class="fab fa-whatsapp"></i>
            </div>
            <div>
                <div style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">TINGKAT VALIDITAS WHATSAPP</div>
                <div style="font-family:var(--font-heading); font-size:20px; font-weight:800; color:#0f172a; margin:4px 0;">
                    99.4% <span style="font-size:11px; font-weight:700; color:#10b981;">+1.2% mo/mo</span>
                </div>
                <div style="font-size:11.5px; color:#64748b;">Terverifikasi via WhatsApp Cloud API Indonesia.</div>
            </div>
        </div>

        <!-- Metric 2 -->
        <div class="bottom-metric-card">
            <div class="bottom-metric-icon" style="background:#eef2ff; color:#4c52f8;">
                <i class="fas fa-stopwatch"></i>
            </div>
            <div>
                <div style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">RATA-RATA LEAD RESPONSE TIME</div>
                <div style="font-family:var(--font-heading); font-size:20px; font-weight:800; color:#0f172a; margin:4px 0;">
                    4.2 Menit <span style="font-size:11px; font-weight:700; color:#4c52f8;">Memenuhi SLA</span>
                </div>
                <div style="font-size:11.5px; color:#64748b;">AI Auto-qualify memangkas waktu 82%.</div>
            </div>
        </div>

        <!-- Metric 3 -->
        <div class="bottom-metric-card">
            <div class="bottom-metric-icon" style="background:#f5f3ff; color:#7c3aed;">
                <i class="fas fa-chart-line"></i>
            </div>
            <div>
                <div style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">POTENSI PIPELINE BARU (HIGH AI)</div>
                <div style="font-family:var(--font-heading); font-size:20px; font-weight:800; color:#0f172a; margin:4px 0;">
                    Rp 18.4M <span style="font-size:11px; font-weight:700; color:#7c3aed;">Est. Q2 Closing</span>
                </div>
                <div style="font-size:11.5px; color:#64748b;">Dari 94 calon pelanggan skor tinggi.</div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Lead Baru -->
    <div class="modal-overlay" id="leadModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title"><i class="fas fa-user-plus" style="color:#4c52f8; margin-right:8px;"></i> Tambah Calon Pelanggan Baru</h3>
                <button class="modal-close" onclick="closeLeadModal()">&times;</button>
            </div>
            <form action="{{ route('crm.leads.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group-crm">
                        <label>Nama Lengkap PIC</label>
                        <input type="text" name="name" class="form-input-crm" placeholder="Contoh: Hendra Wijaya" required>
                    </div>
                    <div class="form-group-crm">
                        <label>Jabatan / Posisi</label>
                        <input type="text" name="title" class="form-input-crm" placeholder="Contoh: Chief Operating Officer" required>
                    </div>
                    <div class="form-group-crm">
                        <label>Nama Perusahaan & Industri</label>
                        <input type="text" name="company" class="form-input-crm" placeholder="Contoh: PT Surya Logistik Mandiri (Supply Chain)" required>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group-crm">
                            <label>Email Resmi</label>
                            <input type="email" name="email" class="form-input-crm" placeholder="hendra@suryalog.id" required>
                        </div>
                        <div class="form-group-crm">
                            <label>No. WhatsApp</label>
                            <input type="text" name="phone" class="form-input-crm" placeholder="+62 812-xxxx-xxxx" required>
                        </div>
                    </div>
                    <div class="form-group-crm">
                        <label>Sumber Lead</label>
                        <select name="source" class="form-input-crm">
                            <option>Form Website</option>
                            <option>LinkedIn Campaign</option>
                            <option>Event B2B Summit</option>
                            <option>Google Ads B2B</option>
                            <option>Referral Client</option>
                        </select>
                    </div>
                </div>
                <div style="padding:16px 24px; background:#f8fafc; border-top:1px solid #f1f5f9; display:flex; justify-content:flex-end; gap:10px;">
                    <button type="button" class="btn-outline-crm" onclick="closeLeadModal()">Batal</button>
                    <button type="submit" class="btn-primary-crm">Simpan & Hitung AI Score</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function openLeadModal() {
        document.getElementById('leadModal').classList.add('open');
    }
    function closeLeadModal() {
        document.getElementById('leadModal').classList.remove('open');
    }
</script>
@endsection
