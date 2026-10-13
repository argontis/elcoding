@extends('crm.layout')

@section('title', 'Tasks & Aktivitas Penjualan')
@section('header_badge', 'WORKSPACE > OPERASIONAL PENJUALAN')

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
    .tasks-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) {
        .tasks-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .task-kpi-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 16px;
        box-shadow: var(--shadow-sm);
    }

    .task-kpi-header {
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

    .task-kpi-val {
        font-family: var(--font-heading);
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .task-kpi-sub {
        font-size: 11.5px;
        font-weight: 600;
        color: #64748b;
    }

    /* Main 2 Column Layout */
    .tasks-layout-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr;
        gap: 24px;
    }

    @media (max-width: 1100px) {
        .tasks-layout-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Tabs Filter Bar */
    .task-tabs-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .task-tab-btn {
        background: #ffffff;
        border: 1px solid var(--border-color);
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .task-tab-btn.active {
        background: #4c52f8;
        color: #ffffff;
        border-color: #4c52f8;
    }

    /* Task Item Card */
    .task-item-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 14px;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s ease;
    }

    .task-item-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .task-item-card.overdue {
        border-left: 4px solid #ef4444;
        background: #fffafa;
    }

    .task-item-card.priority {
        border-left: 4px solid #4c52f8;
    }

    .task-item-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 8px;
    }

    .task-item-title-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .task-type-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 4px;
        background: #f1f5f9;
        color: #475569;
    }

    .task-item-title {
        font-size: 14.5px;
        font-weight: 700;
        color: #0f172a;
    }

    .task-item-meta {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 10px;
    }

    .task-ai-hint-box {
        background: #f5f3ff;
        border: 1px solid #ddd6fe;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 12px;
        color: #6d28d9;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .task-item-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 10px;
        border-top: 1px solid #f1f5f9;
    }

    /* Right Column Widgets */
    .calendar-widget-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
    }

    .calendar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 800;
        font-size: 14px;
        color: #0f172a;
        margin-bottom: 14px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
        text-align: center;
        font-size: 11px;
    }

    .cal-day-name {
        color: #94a3b8;
        font-weight: 700;
        padding-bottom: 6px;
    }

    .cal-cell {
        padding: 6px;
        border-radius: 6px;
        font-weight: 600;
        color: #334155;
    }

    .cal-cell.today {
        background: #4c52f8;
        color: #ffffff;
        font-weight: 800;
    }

    .cal-cell.has-demo {
        position: relative;
    }

    .cal-cell.has-demo::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: #ef4444;
    }

    .ai-nudge-widget {
        background: linear-gradient(135deg, #f5f3ff, #ede9fe);
        border: 1px solid #c4b5fd;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')

    <!-- Header & Action Buttons -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Tasks & Aktivitas Penjualan</h1>
            <p class="page-sub">Penyelesaian tugas harian tim sales, automasi tindak lanjut WhatsApp enterprise, dan pemantauan SLA kesepakatan bernilai tinggi.</p>
        </div>
        <div class="page-actions-group">
            <div style="background:#ffffff; border:1px solid var(--border-color); border-radius:8px; padding:3px; display:flex;">
                <button class="btn-primary-crm" style="padding:6px 12px; font-size:12px; box-shadow:none;"><i class="fas fa-list"></i> List View</button>
                <button class="btn-outline-crm" style="border:none; padding:6px 12px; font-size:12px;"><i class="fas fa-calendar"></i> Kalender</button>
            </div>
            <select class="dropdown-select-crm">
                <option>Dimas Pratama (VP)</option>
                <option>Budi Santoso (AE)</option>
                <option>Siti Rahma (AE)</option>
            </select>
            <select class="dropdown-select-crm">
                <option>Semua Prioritas</option>
                <option>Tinggi (SLA < 2 Jam)</option>
                <option>Normal</option>
            </select>
            <button class="btn-outline-crm" onclick="openTaskModal('catat')">
                <i class="fas fa-clipboard-check"></i> Catat Aktivitas
            </button>
            <button class="btn-primary-crm" onclick="openTaskModal('tugas')">
                <i class="fas fa-plus"></i> Buat Tugas Baru
            </button>
        </div>
    </div>

    <!-- 4 Tasks Metrics - Matches PDF Page 11 -->
    <div class="tasks-kpi-grid">
        <!-- KPI 1 -->
        <div class="task-kpi-card">
            <div class="task-kpi-header">
                <span>TUGAS HARI INI</span>
                <i class="fas fa-calendar-check" style="color:#4c52f8;"></i>
            </div>
            <div class="task-kpi-val">14 <span style="font-size:14px; font-weight:600; color:#64748b;">Tugas Terjadwal</span></div>
            <div class="task-kpi-sub">
                <span style="color:#10b981; font-weight:700;">8 Selesai</span> &nbsp;•&nbsp; 6 Berjalan
            </div>
        </div>

        <!-- KPI 2 -->
        <div class="task-kpi-card">
            <div class="task-kpi-header">
                <span>OVERDUE / TERLAMBAT</span>
                <i class="fas fa-triangle-exclamation" style="color:#ef4444;"></i>
            </div>
            <div class="task-kpi-val" style="color:#dc2626;">3 <span style="font-size:14px; font-weight:600; color:#dc2626;">Tindakan Kritis</span></div>
            <div class="task-kpi-sub" style="color:#ef4444;">
                <i class="fas fa-sparkles"></i> AI: Potensi churn deal Rp 1.85M
            </div>
        </div>

        <!-- KPI 3 -->
        <div class="task-kpi-card">
            <div class="task-kpi-header">
                <span>JADWAL DEMO & MEETING</span>
                <i class="fas fa-video" style="color:#0284c7;"></i>
            </div>
            <div class="task-kpi-val">5 <span style="font-size:14px; font-weight:600; color:#64748b;">Sesi Hari Ini</span></div>
            <div class="task-kpi-sub">
                <span style="color:#4c52f8; font-weight:700;">3 Google Meet</span> &nbsp;•&nbsp; 2 Kunjungan Klien
            </div>
        </div>

        <!-- KPI 4 -->
        <div class="task-kpi-card">
            <div class="task-kpi-header">
                <span>SLA FOLLOW-UP RATA-RATA</span>
                <i class="fas fa-stopwatch" style="color:#10b981;"></i>
            </div>
            <div class="task-kpi-val" style="color:#059669;">1.8 Jam</div>
            <div class="task-kpi-sub" style="color:#059669;">
                Melampaui Target (Target SLA: 4.0 Jam)
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="tasks-layout-grid">
        <!-- Left Column: Tasks Feed -->
        <div>
            <!-- Tabs Bar -->
            <div class="task-tabs-row">
                <button class="task-tab-btn">Semua Tugas (24)</button>
                <button class="task-tab-btn active">Hari Ini (6)</button>
                <button class="task-tab-btn" style="color:#dc2626;">Terlambat (3) •</button>
                <button class="task-tab-btn">Minggu Ini (11)</button>
                <button class="task-tab-btn">Selesai (8)</button>
            </div>

            <!-- Overdue & Eskalasi Kritis Section - Matches PDF Page 11 -->
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-fire" style="color:#ef4444;"></i>
                    <h3 style="font-size:15px; font-weight:800; color:#0f172a;">Overdue & Eskalasi Kritis</h3>
                </div>
                <span style="font-size:11.5px; color:#dc2626; font-weight:700; background:#fee2e2; padding:3px 10px; border-radius:100px;">
                    Tindakan Cepat
                </span>
            </div>
            <p style="font-size:12px; color:#64748b; margin-bottom:14px;">3 deal bernilai tinggi mengalami keterlambatan interaksi di luar batas SLA.</p>

            @foreach($overdueTasks as $task)
                <div class="task-item-card overdue">
                    <div class="task-item-top">
                        <div class="task-item-title-group">
                            <span class="task-type-badge" style="background:#fee2e2; color:#dc2626;">{{ $task['category'] }}</span>
                            <span class="task-item-title">{{ $task['title'] }}</span>
                        </div>
                        <span style="font-size:11px; font-weight:800; color:#dc2626;">{{ $task['delay'] }}</span>
                    </div>

                    <div class="task-item-meta">
                        {{ $task['company'] }} &nbsp;•&nbsp; Nilai: <strong>{{ $task['value'] }}</strong> &nbsp;•&nbsp; PIC: {{ $task['pic'] }}
                    </div>

                    @if(isset($task['ai_hint']))
                        <div class="task-ai-hint-box">
                            <i class="fas fa-sparkles"></i>
                            <span>{{ $task['ai_hint'] }}</span>
                        </div>
                    @endif

                    <div class="task-item-footer">
                        <span style="font-size:11.5px; color:#94a3b8;"><i class="fas fa-user"></i> {{ $task['pic'] }}</span>
                        <a href="{{ route('crm.copilot') }}" class="btn-primary-crm" style="background:#4c52f8; font-size:11.5px; padding:6px 14px;">
                            <i class="fas {{ $task['action_icon'] }}"></i> {{ $task['action'] }}
                        </a>
                    </div>
                </div>
            @endforeach

            <!-- Tugas Hari Ini (Urutan Prioritas) Section - Matches PDF Page 11 -->
            <div style="display:flex; align-items:center; justify-content:space-between; margin-top:24px; margin-bottom:8px;">
                <h3 style="font-size:15px; font-weight:800; color:#0f172a;">Tugas Hari Ini (Urutan Prioritas)</h3>
                <span style="font-size:11.5px; color:#4c52f8; font-weight:700;">Auto-sorted by AI Urgency</span>
            </div>
            <p style="font-size:12px; color:#64748b; margin-bottom:14px;">6 tugas tersisa untuk diselesaikan sebelum 18:00 WIB</p>

            @foreach($todayTasks as $task)
                <div class="task-item-card priority">
                    <div class="task-item-top">
                        <div class="task-item-title-group">
                            <span class="task-type-badge" style="background:#eef2ff; color:#4c52f8;">{{ $task['category'] }}</span>
                            <span class="task-item-title">{{ $task['title'] }}</span>
                        </div>
                        <span style="font-size:11px; font-weight:800; color:#4c52f8;"><i class="far fa-clock"></i> {{ $task['time'] }}</span>
                    </div>

                    <div class="task-item-meta">
                        {{ $task['company'] }}
                        @if(isset($task['link_info']))
                            &nbsp;•&nbsp; <span style="color:#0284c7; font-weight:600;"><i class="fas fa-video"></i> {{ $task['link_info'] }}</span>
                        @endif
                    </div>

                    <div class="task-item-footer">
                        <span style="font-size:11.5px; color:#94a3b8;"><i class="fas fa-user"></i> PIC: {{ $task['pic'] }}</span>
                        <button class="btn-primary-crm" style="font-size:11.5px; padding:6px 14px;">
                            <i class="fas {{ $task['action_icon'] }}"></i> {{ $task['action'] }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Right Column: Calendar & AI Nudge & Log Feed -->
        <div>
            <!-- Mini Calendar Widget: Oktober 2026 - Matches PDF Page 11 -->
            <div class="calendar-widget-card">
                <div class="calendar-header">
                    <span><i class="far fa-calendar-alt" style="color:#4c52f8; margin-right:6px;"></i> Oktober 2026</span>
                    <div style="display:flex; gap:8px; font-size:12px; color:#64748b;">
                        <i class="fas fa-chevron-left" style="cursor:pointer;"></i>
                        <i class="fas fa-chevron-right" style="cursor:pointer;"></i>
                    </div>
                </div>

                <div class="calendar-grid">
                    <div class="cal-day-name">Min</div>
                    <div class="cal-day-name">Sen</div>
                    <div class="cal-day-name">Sel</div>
                    <div class="cal-day-name">Rab</div>
                    <div class="cal-day-name">Kam</div>
                    <div class="cal-day-name">Jum</div>
                    <div class="cal-day-name">Sab</div>

                    <div class="cal-cell" style="opacity:0.3;">28</div>
                    <div class="cal-cell" style="opacity:0.3;">29</div>
                    <div class="cal-cell" style="opacity:0.3;">30</div>
                    <div class="cal-cell">1</div>
                    <div class="cal-cell">2</div>
                    <div class="cal-cell">3</div>
                    <div class="cal-cell">4</div>

                    <div class="cal-cell">5</div>
                    <div class="cal-cell">6</div>
                    <div class="cal-cell">7</div>
                    <div class="cal-cell">8</div>
                    <div class="cal-cell">9</div>
                    <div class="cal-cell">10</div>
                    <div class="cal-cell">11</div>

                    <div class="cal-cell">12</div>
                    <div class="cal-cell today">13</div>
                    <div class="cal-cell has-demo">14</div>
                    <div class="cal-cell has-demo">15</div>
                    <div class="cal-cell">16</div>
                    <div class="cal-cell">17</div>
                    <div class="cal-cell">18</div>

                    <div class="cal-cell">19</div>
                    <div class="cal-cell">20</div>
                    <div class="cal-cell">21</div>
                    <div class="cal-cell">22</div>
                    <div class="cal-cell">23</div>
                    <div class="cal-cell">24</div>
                    <div class="cal-cell">25</div>
                </div>

                <div style="display:flex; align-items:center; justify-content:space-around; margin-top:14px; font-size:10.5px; color:#64748b;">
                    <span><span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#4c52f8;"></span> Hari Ini</span>
                    <span><span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#ef4444;"></span> Demo Deal</span>
                    <span><span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#10b981;"></span> Closing Target</span>
                </div>
            </div>

            <!-- AI Next-Best Action Widget - Matches PDF Page 11 -->
            <div class="ai-nudge-widget">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px;">
                    <div style="display:flex; align-items:center; gap:6px;">
                        <i class="fas fa-sparkles" style="color:#7c3aed;"></i>
                        <span style="font-size:13.5px; font-weight:800; color:#1e1b4b;">AI Next-Best Action</span>
                    </div>
                    <span style="background:#7c3aed; color:#fff; font-size:9.5px; font-weight:800; padding:2px 6px; border-radius:4px;">SMART</span>
                </div>
                <p style="font-size:12px; color:#475569; line-height:1.4; margin-bottom:10px;">
                    3 lead enterprise di tahap Presentasi Demo belum ada catatan follow-up selama <strong>> 4 hari kalender</strong>.
                </p>
                <div style="font-size:11.5px; font-weight:700; color:#059669; margin-bottom:8px;">
                    Rekomendasi Aksi: <span style="background:#dcfce7; padding:2px 6px; border-radius:4px;">Win Prob +18%</span>
                </div>
                <ul style="list-style:none; font-size:11.5px; color:#334155; line-height:1.6; margin-bottom:14px;">
                    <li>• PT Bio Nusantara Tbk (Kirim Case Study)</li>
                    <li>• PT Surya Energi Persada (Follow-up CIO)</li>
                    <li>• PT Gudang Distribusi Prima (Jadwal Ulang)</li>
                </ul>
                <button class="btn-primary-crm" style="width:100%; justify-content:center; background:#7c3aed;">
                    <i class="fas fa-wand-magic-sparkles"></i> Buat Task Massal via AI
                </button>
            </div>

            <!-- Log Aktivitas Terbaru - Matches PDF Page 11 -->
            <div class="panel-card" style="padding:16px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <h4 style="font-size:13.5px; font-weight:800; color:#0f172a;">Log Aktivitas Terbaru</h4>
                    <span style="font-size:10px; color:#10b981; font-weight:800; background:#ecfdf5; padding:2px 6px; border-radius:4px;">Real-time</span>
                </div>

                <div style="display:flex; flex-direction:column; gap:12px;">
                    <div style="font-size:12px; border-bottom:1px solid #f1f5f9; padding-bottom:8px;">
                        <div style="display:flex; justify-content:space-between;">
                            <strong style="color:#0f172a;">Transkrip Meeting Tersedia</strong>
                            <span style="color:#94a3b8;">11:42 WIB</span>
                        </div>
                        <div style="color:#64748b; font-size:11.5px; margin-top:2px;">
                            Google Meet dengan PT Pertamina Retail (32 menit). AI menghasilkan 4 poin rekomendasi & diskon multi-year.
                        </div>
                    </div>

                    <div style="font-size:12px; border-bottom:1px solid #f1f5f9; padding-bottom:8px;">
                        <div style="display:flex; justify-content:space-between;">
                            <strong style="color:#0f172a;">Panggilan Keluar Selesai</strong>
                            <span style="color:#94a3b8;">10:15 WIB</span>
                        </div>
                        <div style="color:#64748b; font-size:11.5px; margin-top:2px;">
                            Budi Santoso menelepon Ibu Ratna (Procurement Head PT Kalbe). Respon positif.
                        </div>
                    </div>

                    <div style="font-size:12px;">
                        <div style="display:flex; justify-content:space-between;">
                            <strong style="color:#0f172a;">Email Quotation Terbuka</strong>
                            <span style="color:#94a3b8;">09:05 WIB</span>
                        </div>
                        <div style="color:#64748b; font-size:11.5px; margin-top:2px;">
                            Quotation #QT-2026-889 dibuka 3x oleh stakeholder IT Bank Mandiri Ekosistem.
                        </div>
                    </div>
                </div>

                <div style="text-align:center; margin-top:14px; padding-top:10px; border-top:1px solid #f1f5f9;">
                    <a href="#" style="font-size:11.5px; font-weight:700; color:#4c52f8; text-decoration:none;">Lihat Riwayat Audit Lengkap (128 Aktivitas)</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buat / Catat Tugas -->
    <div class="modal-overlay" id="taskModal">
        <div class="modal-card">
            <div class="modal-header">
                <h3 class="modal-title" id="taskModalTitle"><i class="fas fa-calendar-plus" style="color:#4c52f8; margin-right:8px;"></i> Buat Tugas Baru</h3>
                <button class="modal-close" onclick="closeTaskModal()">&times;</button>
            </div>
            <form action="{{ route('crm.tasks.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group-crm">
                        <label>Nama Aktivitas / Tugas</label>
                        <input type="text" name="title" class="form-input-crm" placeholder="Contoh: Demo Solusi WhatsApp AI Enterprise" required>
                    </div>
                    <div class="form-group-crm">
                        <label>Tipe Aktivitas</label>
                        <select name="type" class="form-input-crm">
                            <option>Demo Solusi AI</option>
                            <option>WhatsApp Follow-up</option>
                            <option>Telepon Direksi</option>
                            <option>Email Proposal</option>
                            <option>Negosiasi Kontrak Legal</option>
                        </select>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-group-crm">
                            <label>Nama Perusahaan Klien</label>
                            <input type="text" name="company" class="form-input-crm" placeholder="PT Astra Industri Tbk" required>
                        </div>
                        <div class="form-group-crm">
                            <label>Jadwal Waktu</label>
                            <input type="text" name="time" class="form-input-crm" placeholder="Hari ini, 15:00 WIB" required>
                        </div>
                    </div>
                </div>
                <div style="padding:16px 24px; background:#f8fafc; border-top:1px solid #f1f5f9; display:flex; justify-content:flex-end; gap:10px;">
                    <button type="button" class="btn-outline-crm" onclick="closeTaskModal()">Batal</button>
                    <button type="submit" class="btn-primary-crm">Jadwalkan Tugas</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function openTaskModal(mode) {
        document.getElementById('taskModalTitle').innerHTML = mode === 'catat'
            ? '<i class="fas fa-clipboard-check" style="color:#4c52f8; margin-right:8px;"></i> Catat Aktivitas Penjualan'
            : '<i class="fas fa-calendar-plus" style="color:#4c52f8; margin-right:8px;"></i> Buat Tugas Baru';
        document.getElementById('taskModal').classList.add('open');
    }
    function closeTaskModal() {
        document.getElementById('taskModal').classList.remove('open');
    }
</script>
@endsection
