@extends('crm.layout')

@section('title', 'Dashboard Penjualan')
@section('header_badge', 'EXECUTIVE COCKPIT • KUARTAL IV 2026')

@section('styles')
<style>
    .page-header-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
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

    /* AI Synthesis Banner */
    .ai-banner {
        background: linear-gradient(135deg, #f5f3ff 0%, #eef2ff 100%);
        border: 1px solid #ddd6fe;
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 18px;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.06);
    }

    .ai-banner-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #7c3aed, #4c52f8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 22px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }

    .ai-banner-content {
        flex: 1;
    }

    .ai-banner-title-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 6px;
    }

    .ai-banner-title {
        font-family: var(--font-heading);
        font-size: 16px;
        font-weight: 800;
        color: #1e1b4b;
    }

    .ai-synthesis-badge {
        background: #7c3aed;
        color: #ffffff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .ai-banner-desc {
        font-size: 13.5px;
        color: #334155;
        line-height: 1.5;
        margin-bottom: 14px;
    }

    .ai-banner-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-ai-action {
        background: #ffffff;
        border: 1px solid #c4b5fd;
        color: #6d28d9;
        font-size: 12.5px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-ai-action:hover {
        background: #6d28d9;
        color: #ffffff;
        border-color: #6d28d9;
    }

    .btn-ai-action.primary {
        background: #4c52f8;
        color: #ffffff;
        border-color: #4c52f8;
    }

    .btn-ai-action.primary:hover {
        background: #3b40e3;
    }

    /* 6 Metrics Grid */
    .metrics-grid-6 {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 1280px) {
        .metrics-grid-6 {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 768px) {
        .metrics-grid-6 {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .metric-card-sm {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .metric-card-sm:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .metric-header {
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

    .metric-val {
        font-family: var(--font-heading);
        font-size: 22px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .metric-sub {
        font-size: 11px;
        font-weight: 600;
        color: #10b981;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .metric-sub.neutral {
        color: #64748b;
    }

    /* 2 Column Main Grid */
    .dashboard-main-grid {
        display: grid;
        grid-template-columns: 1.6fr 1.2fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1100px) {
        .dashboard-main-grid {
            grid-template-columns: 1fr;
        }
    }

    .panel-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 22px;
        box-shadow: var(--shadow-sm);
    }

    .panel-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 18px;
    }

    .panel-title {
        font-family: var(--font-heading);
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
    }

    .panel-legend {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 11.5px;
        color: #64748b;
        font-weight: 600;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .legend-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
    }

    /* Chart Simulation (CSS-based high precision bar chart) */
    .bar-chart-container {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        height: 190px;
        padding: 10px 10px 0 10px;
        border-bottom: 1px dashed #e2e8f0;
        margin-bottom: 16px;
        gap: 14px;
    }

    .bar-col {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100%;
        justify-content: flex-end;
    }

    .bar-val-label {
        font-size: 11px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 6px;
    }

    .bar-pillar {
        width: 100%;
        max-width: 48px;
        border-radius: 8px 8px 0 0;
        background: #4c52f8;
        transition: height 0.5s ease;
        position: relative;
    }

    .bar-pillar.active {
        background: linear-gradient(180deg, #8b5cf6 0%, #4c52f8 100%);
        box-shadow: 0 0 12px rgba(76, 82, 248, 0.4);
    }

    .bar-col-label {
        margin-top: 8px;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-align: center;
    }

    .confidence-score-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12.5px;
    }

    /* Prioritas Tindakan Cards */
    .action-card {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 12px;
        background: #ffffff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .action-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .action-card.urgent {
        border-left: 4px solid #ef4444;
        background: #fffbfa;
    }

    .action-card.scheduled {
        border-left: 4px solid #4c52f8;
    }

    .action-card.smart {
        border-left: 4px solid #8b5cf6;
        background: #faf5ff;
    }

    .action-top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
    }

    .badge-urgent {
        background: #fee2e2;
        color: #dc2626;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .badge-scheduled {
        background: #eef2ff;
        color: #4c52f8;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .badge-smart {
        background: #f3e8ff;
        color: #7c3aed;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 6px;
    }

    .action-title {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .action-deal-meta {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 10px;
    }

    .action-btn-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Pipeline Progress Bar */
    .pipeline-summary-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 12px;
        margin-top: 14px;
    }

    @media (max-width: 1024px) {
        .pipeline-summary-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .pipe-step-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px;
    }

    .pipe-step-title {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 4px;
    }

    .pipe-step-val {
        font-family: var(--font-heading);
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 2px;
    }

    .pipe-step-sub {
        font-size: 10.5px;
        color: #10b981;
        font-weight: 600;
    }

    /* Leaderboard list */
    .rep-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .rep-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #1e1b4b;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .activity-feed-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
</style>
@endsection

@section('content')

    <!-- Page Header & Global Controls -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Dashboard Penjualan</h1>
            <p class="page-sub">Ringkasan performa penjualan, pipeline aktif, dan prioritas tindakan berbasis AI.</p>
        </div>
        <div class="page-actions-group">
            <select class="dropdown-select-crm">
                <option>Bulan Ini: Oktober 2026</option>
                <option>Kuartal IV 2026</option>
                <option>Tahun Berjalan 2026</option>
            </select>
            <select class="dropdown-select-crm">
                <option>Semua Tim Sales (18 PIC)</option>
                <option>Enterprise West</option>
                <option>Gov Tech & BUMN</option>
                <option>SMB & Commercial</option>
            </select>
            <button class="btn-outline-crm" onclick="window.print()">
                <i class="fas fa-file-export"></i>
                <span>Ekspor PDF/XLSX</span>
            </button>
            <a href="{{ route('crm.dashboard') }}" class="btn-primary-crm">
                <i class="fas fa-rotate"></i>
                <span>Refresh AI Insights</span>
            </a>
        </div>
    </div>

    <!-- AI Ringkasan Cerdas Pagi Banner (Real-Time Synthesis) - Matches PDF -->
    <div class="ai-banner">
        <div class="ai-banner-icon">
            <i class="fas fa-wand-magic-sparkles"></i>
        </div>
        <div class="ai-banner-content">
            <div class="ai-banner-title-row">
                <h2 class="ai-banner-title">Ringkasan Cerdas Pagi</h2>
                <span class="ai-synthesis-badge">REAL-TIME SYNTHESIS</span>
            </div>
            <p class="ai-banner-desc">
                3 deal bernilai tinggi (total Rp 1,45 Miliar) membutuhkan sentuhan follow-up hari ini. Probabilitas closing deal PT Telko Sinergi naik +18% pasca negosiasi teknis kemarin. 4 lead masuk berstatus High Priority belum dialokasikan ke Account Executive.
            </p>
            <div class="ai-banner-actions">
                <a href="{{ route('crm.copilot') }}" class="btn-ai-action primary">
                    <i class="fas fa-wand-magic-sparkles"></i>
                    Buka AI Copilot
                </a>
                <a href="{{ route('crm.pipeline') }}" class="btn-ai-action">
                    <i class="fas fa-triangle-exclamation" style="color: #ef4444;"></i>
                    Tinjau Deal Berisiko (2)
                </a>
                <a href="{{ route('crm.leads') }}" class="btn-ai-action">
                    <i class="fas fa-user-plus"></i>
                    Tugaskan 4 Lead
                </a>
            </div>
        </div>
    </div>

    <!-- 6 Executive KPI Metrics - Matches PDF Page 16 -->
    <div class="metrics-grid-6">
        <!-- Metric 1 -->
        <div class="metric-card-sm">
            <div class="metric-header">
                <span>TOTAL LEADS</span>
                <i class="fas fa-users" style="color:#6366f1;"></i>
            </div>
            <div class="metric-val">{{ $metrics['total_leads'] }}</div>
            <div class="metric-sub">
                <i class="fas fa-arrow-trend-up"></i>
                <span>{{ $metrics['total_leads_trend'] }}</span>
            </div>
        </div>

        <!-- Metric 2 -->
        <div class="metric-card-sm">
            <div class="metric-header">
                <span>LEAD BARU (OKT)</span>
                <i class="fas fa-sparkles" style="color:#8b5cf6;"></i>
            </div>
            <div class="metric-val">{{ $metrics['lead_baru'] }}</div>
            <div class="metric-sub">
                <i class="fas fa-arrow-trend-up"></i>
                <span>{{ $metrics['lead_baru_trend'] }}</span>
                <span style="color:#64748b; font-size:10px; margin-left:auto;">{{ $metrics['lead_baru_target'] }}</span>
            </div>
        </div>

        <!-- Metric 3 -->
        <div class="metric-card-sm">
            <div class="metric-header">
                <span>QUALIFIED LEADS</span>
                <i class="fas fa-bullseye" style="color:#06b6d4;"></i>
            </div>
            <div class="metric-val">{{ $metrics['qualified_leads'] }}</div>
            <div class="metric-sub neutral">
                <span>{{ $metrics['qualified_ratio'] }}</span>
            </div>
        </div>

        <!-- Metric 4 -->
        <div class="metric-card-sm">
            <div class="metric-header">
                <span>PIPELINE TERBUKA</span>
                <i class="fas fa-wallet" style="color:#f59e0b;"></i>
            </div>
            <div class="metric-val">{{ $metrics['pipeline_terbuka'] }}</div>
            <div class="metric-sub neutral">
                <span>{{ $metrics['pipeline_deals'] }} • {{ $metrics['avg_deal'] }}</span>
            </div>
        </div>

        <!-- Metric 5 -->
        <div class="metric-card-sm">
            <div class="metric-header">
                <span>REVENUE WON (OKT)</span>
                <i class="fas fa-circle-check" style="color:#10b981;"></i>
            </div>
            <div class="metric-val" style="color:#059669;">{{ $metrics['revenue_won'] }}</div>
            <div class="metric-sub">
                <span>{{ $metrics['revenue_target_pct'] }}</span>
                <span style="color:#64748b; font-size:10px; margin-left:auto;">{{ $metrics['revenue_target'] }}</span>
            </div>
        </div>

        <!-- Metric 6 -->
        <div class="metric-card-sm">
            <div class="metric-header">
                <span>OVERALL WIN RATE</span>
                <i class="fas fa-chart-pie" style="color:#ec4899;"></i>
            </div>
            <div class="metric-val">{{ $metrics['win_rate'] }}</div>
            <div class="metric-sub">
                <i class="fas fa-arrow-trend-up"></i>
                <span>{{ $metrics['win_rate_trend'] }}</span>
                <span style="color:#64748b; font-size:10px; margin-left:auto;">{{ $metrics['benchmark'] }}</span>
            </div>
        </div>
    </div>

    <!-- Main Grid: Forecasting Chart + Prioritas Tindakan -->
    <div class="dashboard-main-grid">
        <!-- Left: Tren Pendapatan & Prediksi Forecasting -->
        <div class="panel-card">
            <div class="panel-header-row">
                <div>
                    <h3 class="panel-title">Tren Pendapatan & Prediksi Forecasting</h3>
                    <div style="font-size:11.5px; color:#64748b; margin-top:2px;">
                        Realisasi pendapatan aktual vs kuota target (Mei – Oktober 2026, dalam Miliar Rupiah) • <span style="color:#4c52f8; font-weight:700;">Model AI Prophet v4</span>
                    </div>
                </div>
                <div class="panel-legend">
                    <div class="legend-item"><span class="legend-dot" style="background:#4c52f8;"></span> Aktual</div>
                    <div class="legend-item"><span class="legend-dot" style="background:#cbd5e1;"></span> Target Kuota</div>
                    <div class="legend-item"><span class="legend-dot" style="background:#8b5cf6;"></span> AI Forecast Proyeksi</div>
                </div>
            </div>

            <!-- CSS Bar Chart Matches PDF visual -->
            <div class="bar-chart-container">
                @foreach($forecastChart as $bar)
                    <div class="bar-col">
                        <span class="bar-val-label">{{ $bar['pct'] }}</span>
                        <div class="bar-pillar {{ $bar['is_active'] ? 'active' : '' }}" style="height: {{ ($bar['value'] / 4.5) * 100 }}%;"></div>
                        <span class="bar-col-label">{{ $bar['month'] }}</span>
                    </div>
                @endforeach
            </div>

            <!-- AI Confidence Footnote -->
            <div class="confidence-score-box">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-sparkles" style="color:#4c52f8;"></i>
                    <span><strong>Confidence Score 91%:</strong> Pipeline penutupan deal di sisa 9 hari kerja cukup untuk melampaui kuota Rp 4,00 Miliar.</span>
                </div>
                <a href="{{ route('crm.laporan') }}" style="color:#4c52f8; font-weight:700; text-decoration:none;">Detail Proyeksi →</a>
            </div>
        </div>

        <!-- Right: Prioritas Tindakan (Urgent Action & Smart Nudge) -->
        <div class="panel-card">
            <div class="panel-header-row">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-bell" style="color:#ef4444;"></i>
                    <h3 class="panel-title">Prioritas Tindakan</h3>
                </div>
                <span class="badge-urgent">1 Overdue</span>
            </div>

            @foreach($prioritasTindakan as $act)
                <div class="action-card {{ $act['badge_type'] === 'danger' ? 'urgent' : ($act['badge_type'] === 'primary' ? 'scheduled' : 'smart') }}">
                    <div class="action-top-row">
                        <span class="{{ $act['badge_type'] === 'danger' ? 'badge-urgent' : ($act['badge_type'] === 'primary' ? 'badge-scheduled' : 'badge-smart') }}">
                            {{ $act['badge'] }}
                        </span>
                        <span style="font-size:11px; font-weight:700; color:#64748b;">{{ $act['tag'] }}</span>
                    </div>
                    <div class="action-title">{{ $act['title'] }}</div>
                    <div class="action-deal-meta">
                        Deal: <strong>{{ $act['deal'] }}</strong> • PIC: {{ $act['pic'] }}
                    </div>
                    @if(isset($act['insight']))
                        <div style="font-size:11.5px; color:#6d28d9; background:#f5f3ff; padding:6px 10px; border-radius:6px; margin-bottom:10px;">
                            <i class="fas fa-lightbulb"></i> {{ $act['insight'] }}
                        </div>
                    @endif
                    <div class="action-btn-row">
                        <span style="font-size:11px; color:#94a3b8;">PIC: {{ $act['pic'] }}</span>
                        @if($act['action_type'] === 'danger')
                            <a href="{{ route('crm.tasks') }}" class="btn-primary-crm" style="background:#ef4444; font-size:11.5px; padding:5px 12px;">
                                {{ $act['action_label'] }}
                            </a>
                        @elseif($act['action_type'] === 'primary')
                            <a href="{{ route('crm.tasks') }}" class="btn-primary-crm" style="font-size:11.5px; padding:5px 12px;">
                                {{ $act['action_label'] }}
                            </a>
                        @else
                            <a href="{{ route('crm.copilot') }}" class="btn-primary-crm" style="background:#10b981; font-size:11.5px; padding:5px 12px;">
                                {{ $act['action_label'] }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Ringkasan Pipeline Penjualan - Matches PDF -->
    <div class="panel-card" style="margin-bottom: 24px;">
        <div class="panel-header-row">
            <div>
                <h3 class="panel-title">Ringkasan Pipeline Penjualan</h3>
                <div style="font-size:12px; color:#64748b;">Sebaran nilai deal aktif di setiap fase siklus negosiasi</div>
            </div>
            <div style="font-size:13.5px; font-weight:800; color:#4c52f8;">
                Total Aktif: Rp 8,75 Miliar
            </div>
        </div>

        <div class="pipeline-summary-grid">
            @foreach($pipelineStages as $stage)
                <div class="pipe-step-card" style="border-top: 3px solid {{ $stage['color'] }};">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
                        <span class="pipe-step-title">{{ $stage['step'] }}</span>
                        <span style="font-size:10px; font-weight:700; color:#64748b;">{{ $stage['deals'] }}</span>
                    </div>
                    <div class="pipe-step-val">{{ $stage['val'] }}</div>
                    <div class="pipe-step-sub">{{ $stage['sub'] }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bottom Row: Aktivitas Tim Terkini & Leaderboard -->
    <div class="dashboard-main-grid">
        <!-- Aktivitas Tim Terkini -->
        <div class="panel-card">
            <div class="panel-header-row">
                <div>
                    <h3 class="panel-title">Aktivitas Tim Terkini</h3>
                    <div style="font-size:11.5px; color:#64748b;">Log interaksi langsung sales representative dengan klien (Zona WIB)</div>
                </div>
                <a href="{{ route('crm.tasks') }}" style="color:#4c52f8; font-size:12px; font-weight:700; text-decoration:none;">Lihat Log Lengkap →</a>
            </div>

            <div class="activity-feed">
                @foreach($aktivitas as $act)
                    <div class="activity-feed-item">
                        <div style="width:36px; height:36px; border-radius:10px; background:#eef2ff; color:#4c52f8; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            @if($act['badge'] === 'call') <i class="fas fa-phone"></i>
                            @elseif($act['badge'] === 'demo') <i class="fas fa-laptop-code"></i>
                            @elseif($act['badge'] === 'doc') <i class="fas fa-file-signature"></i>
                            @else <i class="fas fa-handshake"></i>
                            @endif
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex; justify-content:space-between; align-items:center;">
                                <strong style="font-size:13px; color:#0f172a;">{{ $act['type'] }}: {{ $act['title'] }}</strong>
                                <span style="font-size:11px; color:#94a3b8;">{{ $act['time'] }}</span>
                            </div>
                            <div style="font-size:12px; color:#475569; margin:2px 0;">
                                Klien: <strong>{{ $act['client'] }}</strong> • PIC: {{ $act['pic'] }}
                            </div>
                            <div style="font-size:11px; color:#10b981; font-weight:600;">
                                {{ $act['detail'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Top Sales Leaderboard & AI Opportunity Radar -->
        <div class="panel-card">
            <div class="panel-header-row">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-trophy" style="color:#f59e0b;"></i>
                    <h3 class="panel-title">Top Sales Leaderboard</h3>
                </div>
                <span style="font-size:11.5px; font-weight:700; color:#64748b;">Oktober 2026</span>
            </div>

            <div class="rep-list">
                @foreach($leaderboard as $rep)
                    <div class="rep-row">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div class="rep-avatar" style="border: 2px solid {{ $rep['badge_color'] }};">
                                {{ $rep['avatar'] }}
                            </div>
                            <div>
                                <div style="font-size:13px; font-weight:700; color:#0f172a;">{{ $rep['name'] }}</div>
                                <div style="font-size:11px; color:#64748b;">{{ $rep['role'] }} • {{ $rep['deals'] }}</div>
                            </div>
                        </div>
                        <div style="text-align:right;">
                            <div style="font-size:13px; font-weight:800; color:#0f172a;">{{ $rep['val'] }}</div>
                            <div style="font-size:11px; font-weight:700; color:{{ $rep['badge_color'] }};">{{ $rep['pct'] }} Target</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- AI Win Opportunity Radar -->
            <div style="margin-top:18px; padding:12px 14px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:10px; display:flex; align-items:center; justify-content:space-between;">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-radar" style="color:#10b981;"></i>
                    <div>
                        <div style="font-size:12px; font-weight:700; color:#065f46;">AI Win Opportunity Radar</div>
                        <div style="font-size:11px; color:#047857;">Update probabilistik otomatis tiap 15 mnt</div>
                    </div>
                </div>
                <span style="background:#10b981; color:#fff; font-size:10px; font-weight:800; padding:3px 8px; border-radius:100px;">AKTIF</span>
            </div>
        </div>
    </div>

@endsection
