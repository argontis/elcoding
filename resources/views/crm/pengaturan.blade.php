@extends('crm.layout')

@section('title', 'Pengaturan & Konfigurasi Workspace')
@section('header_badge', 'ADMINISTRASI SISTEM > PENGATURAN ENTERPRISE')

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

    /* Tabs Bar */
    .settings-nav-tabs {
        display: flex;
        align-items: center;
        gap: 8px;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 24px;
        overflow-x: auto;
    }

    .settings-tab-link {
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .settings-tab-link.active {
        color: #4c52f8;
        border-bottom-color: #4c52f8;
        font-weight: 700;
    }

    /* 4 KPIs */
    .settings-kpi-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    @media (max-width: 1024px) {
        .settings-kpi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .setting-kpi-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 16px;
        box-shadow: var(--shadow-sm);
    }

    .setting-kpi-title {
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

    .setting-kpi-val {
        font-family: var(--font-heading);
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .setting-kpi-sub {
        font-size: 11.5px;
        color: #64748b;
    }

    /* 2 Column Settings Grid */
    .settings-main-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    @media (max-width: 1100px) {
        .settings-main-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Toggle Switch */
    .switch-wrap {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 24px;
    }

    .switch-wrap input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider-round {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #cbd5e1;
        transition: .3s;
        border-radius: 24px;
    }

    .slider-round:before {
        position: absolute;
        content: "";
        height: 18px; width: 18px;
        left: 3px; bottom: 3px;
        background-color: white;
        transition: .3s;
        border-radius: 50%;
    }

    input:checked + .slider-round {
        background-color: #4c52f8;
    }

    input:checked + .slider-round:before {
        transform: translateX(20px);
    }

    /* Integration Item */
    .integ-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')

    <!-- Header Row -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">Pengaturan & Konfigurasi Workspace</h1>
            <p class="page-sub">Kelola anggota tim, perizinan hak akses, konfigurasi model AI, integrasi API, dan kepatuhan data organisasi.</p>
        </div>
        <div class="page-actions-group">
            <div style="font-size:12px; color:#10b981; font-weight:700; display:flex; align-items:center; gap:6px;">
                <span class="pulse-dot"></span>
                <span>Sinkronisasi Terverifikasi • 14:02 WIB</span>
            </div>
            <button class="btn-outline-crm">Batal</button>
            <form action="{{ route('crm.pengaturan.save') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn-primary-crm">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <!-- Navigation Tabs - Matches PDF Page 14 -->
    <div class="settings-nav-tabs">
        <span class="settings-tab-link active"><i class="fas fa-users-gear" style="margin-right:6px;"></i> Manajemen Tim & Pengguna (18)</span>
        <span class="settings-tab-link"><i class="fas fa-key" style="margin-right:6px;"></i> Peran & Hak Akses (RBAC)</span>
        <span class="settings-tab-link"><i class="fas fa-microchip" style="margin-right:6px;"></i> Konfigurasi AI & Scoring LLM v4.8</span>
        <span class="settings-tab-link"><i class="fas fa-network-wired" style="margin-right:6px;"></i> Integrasi & API Gateway</span>
        <span class="settings-tab-link"><i class="fas fa-shield-halved" style="margin-right:6px;"></i> Keamanan & Audit Log</span>
    </div>

    <!-- 4 Workspace KPIs - Matches PDF Page 14 -->
    <div class="settings-kpi-grid">
        <!-- KPI 1 -->
        <div class="setting-kpi-card">
            <div class="setting-kpi-title">
                <span>TOTAL KURSI PENGGUNA</span>
                <i class="fas fa-user-check" style="color:#4c52f8;"></i>
            </div>
            <div class="setting-kpi-val">{{ $metrics['seats'] }}</div>
            <div class="setting-kpi-sub">{{ $metrics['seats_sub'] }}</div>
        </div>

        <!-- KPI 2 -->
        <div class="setting-kpi-card">
            <div class="setting-kpi-title">
                <span>TARGET KUOTA Q4 (TEAM)</span>
                <i class="fas fa-bullseye" style="color:#7c3aed;"></i>
            </div>
            <div class="setting-kpi-val">{{ $metrics['target_kuota'] }}</div>
            <div class="setting-kpi-sub" style="color:#059669; font-weight:700;">{{ $metrics['target_realisasi'] }}</div>
        </div>

        <!-- KPI 3 -->
        <div class="setting-kpi-card">
            <div class="setting-kpi-title">
                <span>TOKEN AI TERPAKAI</span>
                <i class="fas fa-sparkles" style="color:#f59e0b;"></i>
            </div>
            <div class="setting-kpi-val">{{ $metrics['token_ai'] }}</div>
            <div class="setting-kpi-sub">{{ $metrics['token_ai_sub'] }}</div>
        </div>

        <!-- KPI 4 -->
        <div class="setting-kpi-card">
            <div class="setting-kpi-title">
                <span>HEALTH SCORE INTEGRASI</span>
                <i class="fas fa-heart-pulse" style="color:#10b981;"></i>
            </div>
            <div class="setting-kpi-val" style="color:#059669;">{{ $metrics['health_score'] }}</div>
            <div class="setting-kpi-sub">{{ $metrics['health_score_sub'] }}</div>
        </div>
    </div>

    <!-- Main Grid: Team Management & AI Config -->
    <div class="settings-main-grid">
        <!-- Left: Anggota Tim Aktif - Matches PDF Page 14 -->
        <div class="panel-card">
            <div class="panel-header-row">
                <div>
                    <h3 class="panel-title">Anggota Tim Aktif</h3>
                    <div style="font-size:12px; color:#64748b;">Kelola lisensi akun, struktur pembagian region, dan target pipeline penjualan.</div>
                </div>
                <button class="btn-primary-crm" style="font-size:12px;"><i class="fas fa-user-plus"></i> + Undang Anggota Tim</button>
            </div>

            <!-- Filters -->
            <div style="display:flex; gap:10px; margin-bottom:14px;">
                <input type="text" placeholder="Cari nama, email perusahaan..." style="flex:1; padding:7px 12px; border:1px solid var(--border-color); border-radius:8px; font-size:12px; outline:none;">
                <select class="dropdown-select-crm" style="font-size:12px;">
                    <option>Semua Peran (Roles)</option>
                    <option>Super Admin</option>
                    <option>Sales Manager</option>
                    <option>Account Exec</option>
                </select>
                <select class="dropdown-select-crm" style="font-size:12px;">
                    <option>Semua Tim Penjualan</option>
                    <option>Enterprise West</option>
                    <option>Gov Tech & BUMN</option>
                </select>
            </div>

            <table style="width:100%; border-collapse:collapse; font-size:12.5px;">
                <thead>
                    <tr style="border-bottom:1px solid var(--border-color); text-align:left; color:#64748b; font-size:11px; text-transform:uppercase;">
                        <th style="padding:10px 0;">NAMA LENGKAP & EMAIL</th>
                        <th style="padding:10px 0;">ROLE</th>
                        <th style="padding:10px 0;">TIM</th>
                        <th style="padding:10px 0;">STATUS</th>
                        <th style="padding:10px 0; text-align:right;">KUOTA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($team as $m)
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <td style="padding:12px 0;">
                                <div style="font-weight:700; color:#0f172a;">{{ $m['name'] }}</div>
                                <div style="font-size:11px; color:#64748b;">{{ $m['email'] }}</div>
                            </td>
                            <td style="padding:12px 0;">
                                <span style="background:#eef2ff; color:#4c52f8; font-weight:700; font-size:11px; padding:2px 8px; border-radius:4px;">
                                    {{ $m['role'] }}
                                </span>
                            </td>
                            <td style="padding:12px 0; color:#475569;">{{ $m['team'] }}</td>
                            <td style="padding:12px 0;">
                                @if($m['status'] === 'Aktif')
                                    <span style="color:#059669; font-weight:700; font-size:11.5px;">● Aktif</span>
                                @else
                                    <span style="color:#d97706; font-weight:700; font-size:11.5px;">● {{ $m['status'] }}</span>
                                @endif
                            </td>
                            <td style="padding:12px 0; text-align:right; font-weight:700; color:#0f172a;">
                                {{ $m['quota'] }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="padding:12px 0 0 0; display:flex; justify-content:space-between; align-items:center; font-size:11.5px; color:#64748b; border-top:1px solid #f1f5f9; margin-top:8px;">
                <span>Menampilkan 5 dari 18 pengguna terdaftar</span>
                <div style="display:flex; gap:6px;">
                    <button class="btn-primary-crm" style="padding:3px 8px; font-size:11px;">1</button>
                    <button class="btn-outline-crm" style="padding:3px 8px; font-size:11px;">2</button>
                    <button class="btn-outline-crm" style="padding:3px 8px; font-size:11px;">3</button>
                </div>
            </div>
        </div>

        <!-- Right: AI Copilot & Scoring Configuration - Matches PDF Page 14 -->
        <div>
            <div class="panel-card" style="margin-bottom:20px;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-brain" style="color:#7c3aed;"></i>
                        <h3 class="panel-title">AI Copilot & Scoring</h3>
                    </div>
                    <span style="background:#f5f3ff; color:#7c3aed; font-size:10px; font-weight:800; padding:2px 8px; border-radius:4px;">AKTIF • v4.8 Nusantara LLM</span>
                </div>
                <p style="font-size:11.5px; color:#64748b; margin-bottom:16px;">
                    Kalibrasi bobot penilaian prospek B2B dan asistensi komunikasi otomatis berbasis kecerdasan buatan.
                </p>

                <!-- Slider Ambang Batas -->
                <div style="margin-bottom:16px;">
                    <div style="display:flex; justify-content:space-between; font-size:12px; font-weight:700; color:#0f172a; margin-bottom:6px;">
                        <span>Ambang Batas Auto-Qualify</span>
                        <span style="color:#4c52f8; font-size:13px;" id="thresholdVal">75 / 100</span>
                    </div>
                    <input type="range" min="50" max="95" value="75" style="width:100%; accent-color:#4c52f8;" oninput="document.getElementById('thresholdVal').innerText = this.value + ' / 100'">
                    <div style="font-size:11px; color:#64748b; margin-top:4px;">
                        Lead dengan skor di atas batas ini otomatis dipromosikan ke tahap Pipeline Prioritas Tinggi.
                    </div>
                </div>

                <!-- Toggles -->
                <div style="display:flex; flex-direction:column; gap:14px;">
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <div>
                            <div style="font-size:12.5px; font-weight:700; color:#0f172a;">Auto-Draft Email & WhatsApp</div>
                            <div style="font-size:11px; color:#64748b;">Buat draf pesan follow-up otomatis sesuai ringkasan rapat terakhir.</div>
                        </div>
                        <label class="switch-wrap">
                            <input type="checkbox" checked>
                            <span class="slider-round"></span>
                        </label>
                    </div>

                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <div>
                            <div style="font-size:12.5px; font-weight:700; color:#0f172a;">Deteksi Sentimen Real-Time</div>
                            <div style="font-size:11px; color:#64748b;">Analisis mood prospek dari pesan WhatsApp masuk & transkrip call.</div>
                        </div>
                        <label class="switch-wrap">
                            <input type="checkbox" checked>
                            <span class="slider-round"></span>
                        </label>
                    </div>
                </div>

                <div style="margin-top:16px; padding-top:12px; border-top:1px solid #f1f5f9; text-align:center;">
                    <a href="{{ route('crm.copilot') }}" style="color:#4c52f8; font-size:12px; font-weight:700; text-decoration:none;">
                        Buka Parameter Lengkap Prompt AI →
                    </a>
                </div>
            </div>

            <!-- Status Integrasi Resmi - Matches PDF Page 14 -->
            <div class="panel-card">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <h3 class="panel-title"><i class="fas fa-plug" style="color:#10b981; margin-right:6px;"></i> Status Integrasi Resmi</h3>
                    <span style="font-size:10.5px; color:#10b981; font-weight:800; background:#ecfdf5; padding:2px 8px; border-radius:4px;">4 Terkoneksi</span>
                </div>

                @foreach($integrations as $integ)
                    <div class="integ-item">
                        <div style="display:flex; align-items:center; gap:10px;">
                            @if($integ['type'] === 'wa') <i class="fab fa-whatsapp" style="color:#10b981; font-size:18px;"></i>
                            @elseif($integ['type'] === 'google') <i class="fab fa-google" style="color:#ea4335; font-size:18px;"></i>
                            @elseif($integ['type'] === 'slack') <i class="fab fa-slack" style="color:#4a154b; font-size:18px;"></i>
                            @else <i class="fas fa-database" style="color:#0284c7; font-size:18px;"></i>
                            @endif
                            <div>
                                <div style="font-size:12px; font-weight:700; color:#0f172a;">{{ $integ['name'] }}</div>
                                <div style="font-size:10.5px; color:#64748b;">{{ $integ['desc'] }}</div>
                            </div>
                        </div>
                        <span style="font-size:11px; font-weight:800; color:#059669; background:#ecfdf5; padding:2px 8px; border-radius:4px;">
                            {{ $integ['status'] }}
                        </span>
                    </div>
                @endforeach

                <div style="text-align:center; margin-top:10px;">
                    <a href="#" style="font-size:11.5px; font-weight:700; color:#4c52f8; text-decoration:none;">+ Hubungkan Integrasi Tambahan (Zapier / SAP / Accurate)</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Kebijakan Distribusi Lead & Audit Log -->
    <div class="settings-main-grid">
        <!-- Kebijakan Distribusi Lead Otomatis -->
        <div class="panel-card">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                <h3 class="panel-title"><i class="fas fa-route" style="color:#4c52f8; margin-right:6px;"></i> Kebijakan Distribusi Lead Otomatis</h3>
                <span style="font-size:10.5px; color:#10b981; font-weight:800; background:#ecfdf5; padding:2px 8px; border-radius:4px;">Otomasi Aktif</span>
            </div>
            <p style="font-size:12px; color:#64748b; margin-bottom:14px;">
                Aturan pembagian leads masuk ke tim sales berbasis beban kerja dan wilayah.
            </p>

            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px; font-size:12px;">
                <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:12px;">
                    <div style="color:#64748b; font-size:11px; margin-bottom:4px;">METODE ALGORITMA</div>
                    <div style="font-weight:700; color:#0f172a;">Round-Robin Berimbang</div>
                </div>
                <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:12px;">
                    <div style="color:#64748b; font-size:11px; margin-bottom:4px;">BATAS MAKSIMAL (CAP)</div>
                    <div style="font-weight:700; color:#0f172a;">25 Lead / AE</div>
                </div>
                <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:12px;">
                    <div style="color:#64748b; font-size:11px; margin-bottom:4px;">STATUS CUTI / AWAY</div>
                    <div style="font-weight:700; color:#059669;">Proteksi Skip Aktif</div>
                </div>
            </div>
        </div>

        <!-- Audit Log Terkini -->
        <div class="panel-card">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                <h3 class="panel-title"><i class="fas fa-clock-rotate-left" style="color:#64748b; margin-right:6px;"></i> Audit Log Terkini</h3>
                <a href="#" style="font-size:11.5px; font-weight:700; color:#4c52f8; text-decoration:none;">Lihat Semua</a>
            </div>

            <div style="display:flex; flex-direction:column; gap:10px; font-size:12px;">
                @foreach($auditLogs as $log)
                    <div style="border-bottom:1px solid #f1f5f9; padding-bottom:8px;">
                        <div style="font-weight:700; color:#0f172a;">{{ $log['text'] }}</div>
                        <div style="font-size:11px; color:#94a3b8; margin-top:2px;">{{ $log['time'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
