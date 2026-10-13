@extends('crm.layout')

@section('title', 'Laporan & Analitik Penjualan')
@section('header_badge', 'ANALITIK & INTELLIGENCE > LAPORAN KINERJA REVENUE')

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

    /* 4 Top KPI Cards */
    .report-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) {
        .report-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .report-kpi-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 16px;
        box-shadow: var(--shadow-sm);
    }

    .report-kpi-title {
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

    .report-kpi-val {
        font-family: var(--font-heading);
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .report-kpi-sub {
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* 2 Column Charts */
    .report-charts-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1100px) {
        .report-charts-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Funnel Bars - Matches PDF Page 12 */
    .funnel-step-item {
        margin-bottom: 14px;
    }

    .funnel-step-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .funnel-bar-track {
        height: 28px;
        background: #f1f5f9;
        border-radius: 6px;
        overflow: hidden;
        display: flex;
    }

    .funnel-bar-fill {
        height: 100%;
        background: #4c52f8;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 12px;
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        transition: width 0.6s ease;
    }

    .funnel-bar-fill.won {
        background: #10b981;
    }

    /* Lead Sources List */
    .channel-card {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 12px;
        background: #ffffff;
    }

    /* Representative Table */
    .rep-table-wrap {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .rep-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .rep-table th {
        background: #f8fafc;
        padding: 12px 18px;
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        border-bottom: 1px solid var(--border-color);
    }

    .rep-table td {
        padding: 16px 18px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 12.5px;
        vertical-align: middle;
    }
</style>
@endsection

@section('content')

    <!-- Header Row -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Laporan & Analitik Penjualan</h1>
            <p class="page-sub">Analisis komprehensif performa konversi, efisiensi pipeline velocity, dan akurasi forecasting enterprise berbasis telemetri real-time Q4.</p>
        </div>
        <div class="page-actions-group">
            <select class="dropdown-select-crm">
                <option>Q4 2026 (1 Okt - 31 Des 2026)</option>
                <option>Q3 2026</option>
                <option>Tahun Penuh 2026</option>
            </select>
            <select class="dropdown-select-crm">
                <option>Semua Tim Enterprise</option>
                <option>Fintech & Banking</option>
                <option>Supply & Logistics</option>
            </select>
            <button class="btn-outline-crm"><i class="fas fa-arrows-split-up-and-left"></i> Bandingkan Periode (vs Q3)</button>
            <button class="btn-primary-crm" onclick="window.print()"><i class="fas fa-download"></i> Ekspor PDF / Excel</button>
        </div>
    </div>

    <!-- 4 KPIs - Matches PDF Page 12 -->
    <div class="report-kpi-grid">
        <!-- KPI 1 -->
        <div class="report-kpi-card">
            <div class="report-kpi-title">
                <span>TOTAL PENDAPATAN CLOSING (WON)</span>
                <i class="fas fa-coins" style="color:#4c52f8;"></i>
            </div>
            <div class="report-kpi-val">{{ $metrics['revenue_closing'] }}</div>
            <div class="report-kpi-sub" style="color:#10b981;">
                <i class="fas fa-arrow-trend-up"></i>
                <span>{{ $metrics['revenue_trend'] }}</span>
            </div>
        </div>

        <!-- KPI 2 -->
        <div class="report-kpi-card">
            <div class="report-kpi-title">
                <span>WIN RATE KESELURUHAN</span>
                <i class="fas fa-bullseye" style="color:#10b981;"></i>
            </div>
            <div class="report-kpi-val">{{ $metrics['win_rate'] }}</div>
            <div class="report-kpi-sub" style="color:#059669;">
                <i class="fas fa-arrow-trend-up"></i>
                <span>{{ $metrics['win_rate_trend'] }}</span>
            </div>
        </div>

        <!-- KPI 3 -->
        <div class="report-kpi-card">
            <div class="report-kpi-title">
                <span>RATA-RATA SIKLUS PENJUALAN</span>
                <i class="fas fa-hourglass-half" style="color:#0284c7;"></i>
            </div>
            <div class="report-kpi-val">{{ $metrics['siklus_penjualan'] }}</div>
            <div class="report-kpi-sub" style="color:#0284c7;">
                <span>{{ $metrics['siklus_trend'] }}</span>
            </div>
        </div>

        <!-- KPI 4 -->
        <div class="report-kpi-card">
            <div class="report-kpi-title">
                <span>KEPATUHAN SLA FOLLOW-UP</span>
                <i class="fas fa-stopwatch" style="color:#ec4899;"></i>
            </div>
            <div class="report-kpi-val">{{ $metrics['sla_kepatuhan'] }}</div>
            <div class="report-kpi-sub" style="color:#ec4899;">
                <span>{{ $metrics['sla_trend'] }}</span>
            </div>
        </div>
    </div>

    <!-- Charts Grid: Funnel + Lead Sources ROI -->
    <div class="report-charts-grid">
        <!-- Corong Konversi Penjualan (Conversion Funnel) - Matches PDF Page 12 -->
        <div class="panel-card">
            <div class="panel-header-row">
                <div>
                    <h3 class="panel-title">Corong Konversi Penjualan (Conversion Funnel)</h3>
                    <div style="font-size:12px; color:#64748b;">Efisiensi transisi prospek dari tahap lead masuk hingga Closed Won deal</div>
                </div>
                <div style="text-align:right;">
                    <div style="font-size:10.5px; color:#64748b;">Net Conversion:</div>
                    <div style="font-size:14px; font-weight:800; color:#10b981;">4.45% (66 / 1.482)</div>
                </div>
            </div>

            <!-- Funnel Stages -->
            <div style="margin-top:14px;">
                @foreach($funnel as $st)
                    <div class="funnel-step-item">
                        <div class="funnel-step-header">
                            <span style="font-weight:700; color:#0f172a;">{{ $st['stage'] }}</span>
                            <span style="font-weight:800; color:#4c52f8;">{{ $st['count'] }} &nbsp;•&nbsp; <span style="color:#64748b; font-weight:600;">{{ $st['pct'] }}</span></span>
                        </div>
                        <div class="funnel-bar-track">
                            <div class="funnel-bar-fill {{ str_contains($st['stage'], 'Closed Won') ? 'won' : '' }}" style="width: {{ $st['bar_pct'] }}%;">
                                {{ $st['count'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- AI Funnel Diagnostics Box -->
            <div style="background:#f5f3ff; border:1px solid #c4b5fd; border-radius:12px; padding:14px; margin-top:20px;">
                <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px; font-weight:800; color:#6d28d9; font-size:13px;">
                    <i class="fas fa-sparkles"></i> AI FUNNEL DIAGNOSTICS &nbsp;•&nbsp; <span style="font-size:11px; color:#475569;">Kategori: Pipeline Friction</span>
                </div>
                <p style="font-size:12px; color:#334155; line-height:1.5;">
                    Hambatan terbesar terdeteksi pada transisi Kualifikasi ke Demo (drop 59.6%). Banyak prospek MQL belum memenuhi kriteria ICP teknis. <strong>Rekomendasi AI:</strong> Terapkan form kualifikasi WhatsApp otomatis berbasis AI sebelum penjadwalan demo eksekutif.
                </p>
            </div>
        </div>

        <!-- Kinerja Sumber Lead & ROI - Matches PDF Page 12 -->
        <div class="panel-card">
            <div class="panel-header-row">
                <div>
                    <h3 class="panel-title">Kinerja Sumber Lead & ROI</h3>
                    <div style="font-size:12px; color:#64748b;">Kontribusi revenue & efisiensi biaya per kanal</div>
                </div>
                <span style="font-size:11.5px; font-weight:800; color:#4c52f8;">Q4 Total: Rp 12,45M</span>
            </div>

            <div style="display:flex; flex-direction:column; gap:12px; margin-top:10px;">
                @foreach($leadSources as $src)
                    <div class="channel-card" style="border-left: 4px solid {{ $src['color'] }};">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
                            <strong style="font-size:13.5px; color:#0f172a;">{{ $src['name'] }}</strong>
                            <span style="font-family:var(--font-heading); font-size:15px; font-weight:800; color:#0f172a;">{{ $src['revenue'] }}</span>
                        </div>
                        <div style="font-size:11.5px; color:#64748b; margin-bottom:8px;">
                            {{ $src['leads'] }} &nbsp;•&nbsp; Win Rate: <strong>{{ $src['win_rate'] }}</strong> &nbsp;•&nbsp; {{ $src['deals'] }}
                        </div>
                        <div style="display:flex; align-items:center; justify-content:space-between; font-size:11px; color:#475569; padding-top:6px; border-top:1px dashed #e2e8f0;">
                            <span>CPL: <strong>{{ $src['cpl'] }}</strong></span>
                            <span>CAC: <strong>{{ $src['cac'] }}</strong></span>
                            <span style="color:#059669; font-weight:800; background:#ecfdf5; padding:2px 6px; border-radius:4px;">ROI: {{ $src['roi'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Papan Kinerja Sales Representative & Pencapaian Kuota - Matches PDF Page 12 -->
    <div class="rep-table-wrap">
        <div style="padding:16px 20px; border-bottom:1px solid var(--border-color); display:flex; align-items:center; justify-content:space-between;">
            <div>
                <h3 style="font-family:var(--font-heading); font-size:16px; font-weight:800; color:#0f172a;">Papan Kinerja Sales Representative & Pencapaian Kuota</h3>
                <div style="font-size:12px; color:#64748b;">Evaluasi individual Account Executive terhadap target kuota revenue Q4 2026</div>
            </div>
            <div style="font-size:12px; color:#4c52f8; font-weight:700;">
                Urutkan berdasarkan: <strong style="text-decoration:underline;">Pencapaian Kuota (%)</strong>
            </div>
        </div>

        <table class="rep-table">
            <thead>
                <tr>
                    <th>AKUN EXECUTIVE & TIM</th>
                    <th>DEALS WON</th>
                    <th>REVENUE TERKUMPUL</th>
                    <th>CAPAIAN KUOTA</th>
                    <th>WIN RATE</th>
                    <th>RATA SLA RESPON</th>
                    <th>AKTIVITAS SALES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reps as $rep)
                    <tr>
                        <td>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:34px; height:34px; border-radius:50%; background:#4c52f8; color:#fff; font-weight:800; font-size:11px; display:flex; align-items:center; justify-content:center;">
                                    {{ $rep['avatar'] }}
                                </div>
                                <div>
                                    <div style="font-weight:700; color:#0f172a;">{{ $rep['name'] }}</div>
                                    <div style="font-size:11px; color:#64748b;">{{ $rep['team'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong style="color:#0f172a;">{{ $rep['deals'] }}</strong>
                        </td>
                        <td>
                            <div style="font-weight:800; color:#0f172a;">{{ $rep['revenue'] }}</div>
                            <div style="font-size:10.5px; color:#64748b;">{{ $rep['target'] }}</div>
                        </td>
                        <td>
                            <span style="font-weight:800; color:#059669; background:#ecfdf5; padding:3px 8px; border-radius:6px; font-size:12px;">
                                {{ $rep['achievement'] }}
                            </span>
                        </td>
                        <td>
                            <strong style="color:#0f172a;">{{ $rep['win_rate'] }}</strong>
                        </td>
                        <td>
                            <div style="color:#0f172a; font-weight:600;">{{ $rep['sla'] }}</div>
                        </td>
                        <td>
                            <div style="font-size:11.5px; color:#64748b;">{{ $rep['activities'] }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:14px 20px; background:#f8fafc; border-top:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center; font-size:12px; color:#64748b;">
            <span>Menampilkan 4 dari 14 Account Executive • Total Kuota Tim Tercapai: 104% (Rp 12,45M / Rp 11,97M)</span>
            <a href="#" style="color:#4c52f8; font-weight:700; text-decoration:none;">Lihat Semua Representatif (14) <i class="fas fa-arrow-down"></i></a>
        </div>
    </div>

@endsection
