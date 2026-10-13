@extends('crm.layout')

@section('title', 'AI Sales Copilot & Asisten Percakapan')
@section('header_badge', 'AI COPILOT v4.8 • NUSANTARA ENTERPRISE LLM')

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
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .copilot-version-badge {
        background: #e0e7ff;
        color: #4c52f8;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
    }

    .page-sub {
        font-size: 13px;
        color: #64748b;
        margin-top: 4px;
    }

    /* Copilot 2 Column Layout */
    .copilot-grid {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 24px;
    }

    @media (max-width: 1150px) {
        .copilot-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Left Chat Container */
    .chat-panel {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 16px;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }

    .chat-context-bar {
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 12.5px;
    }

    .chat-body-stream {
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-height: 700px;
        overflow-y: auto;
    }

    /* Message Bubbles */
    .msg-row-user {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .msg-bubble-user {
        background: #4c52f8;
        color: #ffffff;
        border-radius: 14px 14px 2px 14px;
        padding: 14px 18px;
        max-width: 80%;
        font-size: 13.5px;
        line-height: 1.5;
        box-shadow: 0 4px 12px rgba(76, 82, 248, 0.25);
    }

    .msg-row-ai {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .ai-sender-tag {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 700;
        color: #4c52f8;
        margin-bottom: 8px;
    }

    .msg-bubble-ai {
        background: #f8faff;
        border: 1px solid #c7d2fe;
        border-radius: 14px 14px 14px 2px;
        padding: 18px 20px;
        max-width: 95%;
        font-size: 13.5px;
        line-height: 1.6;
        color: #1e1b4b;
    }

    /* Tone Selector Buttons */
    .tone-selector-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 14px 0;
        flex-wrap: wrap;
    }

    .tone-btn {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 11.5px;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .tone-btn.active {
        background: #4c52f8;
        color: #ffffff;
        border-color: #4c52f8;
    }

    /* Draft Box Container */
    .generated-draft-box {
        background: #ffffff;
        border: 1px solid #c4b5fd;
        border-radius: 12px;
        padding: 16px;
        margin-top: 12px;
        box-shadow: 0 4px 10px rgba(124, 58, 237, 0.05);
    }

    .draft-box-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 11.5px;
        font-weight: 700;
        color: #6d28d9;
        padding-bottom: 8px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 12px;
    }

    .draft-subject-line {
        font-size: 12.5px;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .draft-textarea-mock {
        font-family: inherit;
        font-size: 13px;
        line-height: 1.6;
        color: #334155;
        white-space: pre-line;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px;
        width: 100%;
        margin-bottom: 14px;
        outline: none;
    }

    /* Suggested Prompts */
    .suggested-prompts-row {
        padding: 12px 20px;
        background: #f8fafc;
        border-top: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
    }

    .prompt-chip {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        padding: 6px 12px;
        border-radius: 100px;
        font-size: 11.5px;
        font-weight: 600;
        color: #334155;
        white-space: nowrap;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .prompt-chip:hover {
        background: #eef2ff;
        border-color: #4c52f8;
        color: #4c52f8;
    }

    /* Chat Input Form */
    .chat-input-bar {
        padding: 16px 20px;
        border-top: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-input-field {
        flex: 1;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 13px;
        outline: none;
    }

    .chat-input-field:focus {
        border-color: #4c52f8;
        box-shadow: 0 0 0 3px rgba(76, 82, 248, 0.15);
    }

    /* Right Intelligence Cards */
    .intel-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
    }

    .score-circle-display {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #ecfdf5;
        border: 3px solid #10b981;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-family: var(--font-heading);
        color: #065f46;
        flex-shrink: 0;
    }
</style>
@endsection

@section('content')

    <!-- Page Header & Metrics - Matches PDF Page 9 -->
    <div class="page-header-row">
        <div>
            <h1 class="page-title">
                <i class="fas fa-wand-magic-sparkles" style="color:#4c52f8;"></i>
                AI Sales Copilot & Asisten Percakapan
                <span class="copilot-version-badge">v4.8 Enterprise</span>
            </h1>
            <p class="page-sub">
                Model: <strong>Nusantara Enterprise LLM</strong> &nbsp;•&nbsp; <i class="fas fa-circle-check" style="color:#10b981;"></i> Terhubung ke Data CRM &nbsp;•&nbsp; Konteks Real-Time Aktif
            </p>
        </div>
        <div class="page-actions-group">
            <span style="font-size:12px; font-weight:700; color:#0f172a;">Akurasi Konteks: <strong style="color:#10b981;">99.4%</strong></span>
            <span style="font-size:12px; font-weight:700; color:#64748b;">Token Sesi: 1.420 / 32k</span>
            <button class="btn-outline-crm"><i class="fas fa-clock-rotate-left"></i> Riwayat Chat</button>
            <button class="btn-outline-crm"><i class="fas fa-sliders"></i> Preferensi AI</button>
        </div>
    </div>

    <!-- Main Grid: Left Conversation Stream + Right Lead Profile Intel -->
    <div class="copilot-grid">
        <!-- Left Column: Interactive Chat Stream -->
        <div class="chat-panel">
            <!-- Active Deal Context Bar -->
            <div class="chat-context-bar">
                <div style="display:flex; align-items:center; gap:8px;">
                    <i class="fas fa-building" style="color:#4c52f8;"></i>
                    <span style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">KONTEKS LEAD/DEAL AKTIF</span>
                    <strong style="color:#0f172a;">{{ $activeLead['company'] }}</strong>
                    <span style="background:#eef2ff; color:#4c52f8; font-weight:700; padding:2px 8px; border-radius:4px; font-size:11.5px;">{{ $activeLead['deal_value'] }}</span>
                </div>
                <div style="font-size:11.5px; color:#64748b;">
                    PIC Deal: <strong>{{ $activeLead['pic'] }}</strong>
                </div>
            </div>

            <!-- Chat Stream Body -->
            <div class="chat-body-stream" id="chatStream">
                <!-- User Message -->
                <div class="msg-row-user">
                    <div style="font-size:11px; color:#94a3b8; margin-bottom:4px;">
                        Dimas Pratama (Anda) &nbsp;•&nbsp; 10:42 WIB
                    </div>
                    <div class="msg-bubble-user">
                        Buatkan draft email follow-up untuk Pak Hermawan (CTO PT Finansial Prima) setelah demo kemarin. Soroti fitur integrasi API WhatsApp dan jaminan keamanan SOC 2 kita.
                    </div>
                </div>

                <!-- AI Copilot Response (Matches PDF Page 9) -->
                <div class="msg-row-ai">
                    <div class="ai-sender-tag">
                        <i class="fas fa-sparkles"></i>
                        <span>Nusantara AI Copilot &nbsp;•&nbsp; Baru saja &nbsp;•&nbsp; Confidence 98%</span>
                    </div>

                    <div class="msg-bubble-ai">
                        <div style="font-size:12px; color:#6d28d9; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                            <i class="fas fa-bullseye"></i>
                            <strong>Dasar Rekomendasi:</strong> Demo Meeting 12 Okt, Catatan Kebutuhan Keamanan
                        </div>

                        <p>
                            Tentu, Dimas! Saya telah menganalisis transkrip ringkas demo kemarin dengan Pak Hermawan dan kebutuhan integrasi multi-cabang mereka. Berikut draf email terstruktur dengan penekanan pada modul WhatsApp Cloud API dan kepatuhan audit SOC 2 Type II:
                        </p>

                        <!-- Tone Selectors -->
                        <div class="tone-selector-row">
                            <span style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">NADA SUARA:</span>
                            <button class="tone-btn active" onclick="setTone('Profesional')">Profesional (Aktif)</button>
                            <button class="tone-btn" onclick="setTone('Persuasif')">Persuasif</button>
                            <button class="tone-btn" onclick="setTone('Ringkas')">Ringkas</button>
                            <button class="tone-btn" onclick="setTone('Santai')">Santai / Kasual</button>
                        </div>

                        <!-- Generated Email Draft Box -->
                        <div class="generated-draft-box">
                            <div class="draft-box-header">
                                <span><i class="far fa-envelope" style="margin-right:6px;"></i> Draft Email Follow-up (Dapat Diedit Langsung)</span>
                                <span style="color:#059669;"><i class="fas fa-shield-check"></i> Auto-Grounding Aktif</span>
                            </div>

                            <div class="draft-subject-line">
                                <strong>SUBJEK EMAIL:</strong> <span id="draftSubject">Tindak Lanjut Demo Nusantara CRM: Arsitektur Keamanan & Integrasi WhatsApp</span>
                            </div>

                            <textarea class="draft-textarea-mock" id="draftContent" rows="8">Yth. Bapak Hermawan,
CTO PT Solusi Finansial Prima,

Terima kasih banyak atas waktu dan diskusi konstruktif dalam sesi demonstrasi Nusantara Enterprise CRM kemarin siang.

Menindaklanjuti fokus diskusi Anda mengenai kesiapan infrastruktur serta kepatuhan perbankan mikro yang sedang diperluas oleh PT Solusi Finansial Prima, kami merangkum 2 poin utama yang menjadi prioritas tim Anda:

1. Kesiapan modul WhatsApp Cloud API Resmi Meta (Latency < 20ms, High-throughput blast aman tanpa risiko blokir nomor).
2. Kepatuhan Audit SOC 2 Type II & Regulasi OJK dengan enkripsi end-to-end data customer secara enterprise-grade.

Kami telah menyiapkan draf addendum teknis dan PoC environment yang siap diuji coba bersama tim engineer Anda.</textarea>

                            <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                <button class="btn-outline-crm" style="font-size:11.5px;" onclick="copyDraft()">
                                    <i class="far fa-copy"></i> Salin Pesan
                                </button>
                                <button class="btn-outline-crm" style="font-size:11.5px;">
                                    <i class="fas fa-timeline"></i> Kirim Draft ke Lead Timeline
                                </button>
                                <a href="https://web.whatsapp.com" target="_blank" class="btn-primary-crm" style="background:#10b981; font-size:11.5px;">
                                    <i class="fab fa-whatsapp"></i> Buka di WhatsApp Web
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Saran Perintah Cepat (Suggested Prompts) -->
            <div class="suggested-prompts-row">
                <span style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">SARAN:</span>
                <span class="prompt-chip" onclick="fillPrompt('Analisis risiko deal Bank Mandiri Nusa')">
                    <i class="fas fa-magnifying-glass"></i> Analisis risiko deal Bank Mandiri Nusa
                </span>
                <span class="prompt-chip" onclick="fillPrompt('Rangkum catatan meeting PT Indologistik kemarin')">
                    <i class="fas fa-file-lines"></i> Rangkum catatan meeting PT Indologistik kemarin
                </span>
                <span class="prompt-chip" onclick="fillPrompt('Buat 3 pertanyaan kualifikasi untuk lead B2B e-commerce')">
                    <i class="fas fa-lightbulb"></i> Buat 3 pertanyaan kualifikasi untuk lead B2B e-commerce
                </span>
            </div>

            <!-- Bottom Interactive Prompt Form -->
            <form action="{{ route('crm.copilot.ask') }}" method="POST" id="copilotForm" onsubmit="handleCopilotSubmit(event)">
                @csrf
                <div class="chat-input-bar">
                    <button type="button" class="btn-outline-crm" style="padding:8px 10px;" title="Unggah Dokumen Pendukung">
                        <i class="fas fa-paperclip"></i>
                    </button>
                    <button type="button" class="btn-outline-crm" style="padding:8px 10px;" title="Audio Transcribe">
                        <i class="fas fa-microphone"></i>
                    </button>
                    <input type="text" name="prompt" id="promptInput" class="chat-input-field" placeholder="Tanya analisis deal, instruksikan penulisan penawaran, atau perintahkan update CRM..." required>
                    <button type="submit" class="btn-primary-crm">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </form>
            <div style="padding:0 20px 10px 20px; font-size:10.5px; color:#94a3b8; display:flex; justify-content:space-between;">
                <span>Gunakan @lead atau #deal untuk menyebut konteks secara spesifik.</span>
                <span style="color:#10b981;"><i class="fas fa-sparkles"></i> Perintah Otomatis Aktif</span>
            </div>
        </div>

        <!-- Right Column: Lead Profile Aktif & AI Scoring Breakdown - Matches PDF Page 9 -->
        <div>
            <!-- Card 1: Lead Profile Aktif -->
            <div class="intel-card">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:14px;">
                    <div>
                        <div style="font-size:11px; font-weight:700; color:#64748b; text-transform:uppercase;">LEAD PROFILE AKTIF</div>
                        <h3 style="font-family:var(--font-heading); font-size:18px; font-weight:800; color:#0f172a; margin-top:2px;">{{ $activeLead['name'] }}</h3>
                        <div style="font-size:12px; color:#64748b;">{{ $activeLead['title'] }}</div>
                    </div>
                    <span style="background:#fee2e2; color:#dc2626; font-size:10.5px; font-weight:800; padding:3px 8px; border-radius:6px;">{{ $activeLead['status'] }}</span>
                </div>

                <div style="font-size:12.5px; display:flex; flex-direction:column; gap:8px; margin-bottom:14px;">
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:#64748b;">Perusahaan</span>
                        <strong style="color:#0f172a;">{{ $activeLead['company'] }}</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:#64748b;">Industri</span>
                        <span style="color:#0f172a;">{{ $activeLead['industry'] }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:#64748b;">Email PIC</span>
                        <span style="color:#4c52f8;">{{ $activeLead['email'] }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between;">
                        <span style="color:#64748b;">WhatsApp PIC</span>
                        <span style="color:#10b981; font-weight:600;">{{ $activeLead['phone'] }}</span>
                    </div>
                    <div style="display:flex; justify-content:space-between; padding-top:6px; border-top:1px dashed #e2e8f0;">
                        <span style="color:#64748b;">Estimasi Nilai Pipeline</span>
                        <strong style="font-family:var(--font-heading); font-size:15px; color:#0f172a;">{{ $activeLead['deal_value'] }}</strong>
                    </div>
                </div>

                <a href="{{ route('crm.leads') }}" class="btn-outline-crm" style="width:100%; justify-content:center; font-size:12px;">
                    Buka Detail CRM <i class="fas fa-arrow-up-right-from-square"></i>
                </a>
            </div>

            <!-- Card 2: AI Lead Scoring Breakdown -->
            <div class="intel-card">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:14px;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-chart-line" style="color:#10b981;"></i>
                        <h4 style="font-size:14px; font-weight:800; color:#0f172a;">AI Lead Scoring Breakdown</h4>
                    </div>
                    <span style="background:#ecfdf5; color:#059669; font-size:10.5px; font-weight:800; padding:3px 8px; border-radius:6px;">{{ $activeLead['grade'] }}</span>
                </div>

                <div style="display:flex; align-items:center; gap:16px; margin-bottom:16px;">
                    <div class="score-circle-display">
                        <span style="font-size:18px; font-weight:900;">94</span>
                        <span style="font-size:9px; color:#047857;">/100</span>
                    </div>
                    <div>
                        <div style="font-size:13px; font-weight:800; color:#0f172a;">Peluang Menang (Win Probability): {{ $activeLead['win_prob'] }}</div>
                        <div style="font-size:11px; color:#64748b; margin-top:2px;">
                            Dihitung otomatis berdasarkan interaksi 7 hari terakhir, profil teknis, dan verifikasi anggaran.
                        </div>
                    </div>
                </div>

                <div style="display:flex; flex-direction:column; gap:10px; font-size:12px; margin-bottom:14px;">
                    @foreach($activeLead['breakdown'] as $b)
                        <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:10px;">
                            <div style="display:flex; justify-content:space-between; margin-bottom:2px;">
                                <strong style="color:#0f172a;">{{ $b['name'] }}</strong>
                                <span style="color:#059669; font-weight:800;">{{ $b['points'] }}</span>
                            </div>
                            <div style="font-size:11px; color:#64748b;">{{ $b['desc'] }}</div>
                        </div>
                    @endforeach
                </div>

                <!-- Missing Data Alert Box -->
                <div style="background:#fff7ed; border:1px solid #fed7aa; border-radius:8px; padding:10px 12px; font-size:11.5px; color:#9a3412;">
                    <div style="font-weight:800; display:flex; justify-content:space-between; margin-bottom:3px;">
                        <span><i class="fas fa-triangle-exclamation"></i> Data Belum Lengkap (Missing Data Alert)</span>
                        <span style="font-size:9.5px; background:#ea580c; color:#fff; padding:1px 5px; border-radius:3px;">TINDAKAN DIPERLUKAN</span>
                    </div>
                    <div>{{ $activeLead['warning'] }}</div>
                </div>
            </div>

            <!-- Card 3: Next Best Action yang Direkomendasikan -->
            <div class="intel-card" style="background:#fdf4ff; border-color:#f0abfc;">
                <div style="font-size:13px; font-weight:800; color:#86198f; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                    <i class="fas fa-wand-magic-sparkles"></i> Next Best Action yang Direkomendasikan
                </div>
                <p style="font-size:12px; color:#4a044e; line-height:1.5; margin-bottom:12px;">
                    "{{ $activeLead['next_action'] }}"
                </p>
                <div style="display:flex; align-items:center; justify-content:space-between;">
                    <span style="font-size:11.5px; color:#701a75;">Saran Jadwal: <strong>{{ $activeLead['next_action_schedule'] }}</strong></span>
                    <button class="btn-primary-crm" style="background:#a21caf; font-size:11px; padding:5px 12px;">
                        <i class="far fa-calendar-plus"></i> Buat Undangan Kalender
                    </button>
                </div>
            </div>

            <!-- Card 4: Dokumen & Penawaran Terkait -->
            <div class="intel-card">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:12px;">
                    <h4 style="font-size:13.5px; font-weight:800; color:#0f172a;">Dokumen & Penawaran Terkait</h4>
                    <a href="#" style="font-size:11px; font-weight:700; color:#4c52f8; text-decoration:none;">+ Unggah Baru</a>
                </div>

                <div style="display:flex; flex-direction:column; gap:10px;">
                    @foreach($documents as $doc)
                        <div style="display:flex; align-items:center; justify-content:space-between; padding:8px 10px; border:1px solid #f1f5f9; border-radius:8px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <i class="far fa-file-pdf" style="color:#ef4444; font-size:18px;"></i>
                                <div>
                                    <div style="font-size:12px; font-weight:700; color:#0f172a;">{{ $doc['name'] }}</div>
                                    <div style="font-size:10.5px; color:#94a3b8;">{{ $doc['type'] }} • {{ $doc['size'] }} • {{ $doc['date'] }}</div>
                                </div>
                            </div>
                            <div style="display:flex; gap:6px; color:#94a3b8; font-size:12px;">
                                <i class="far fa-eye" style="cursor:pointer;" title="Lihat"></i>
                                <i class="fas fa-download" style="cursor:pointer;" title="Unduh"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function setTone(tone) {
        document.querySelectorAll('.tone-btn').forEach(b => b.classList.remove('active'));
        event.target.classList.add('active');

        const draft = document.getElementById('draftContent');
        if (tone === 'Persuasif') {
            draft.value = "Yth. Bapak Hermawan,\n\nTerima kasih banyak atas waktu berharga Anda kemarin. Berdasarkan paparan arsitektur sistem PT Finansial Prima, kami sangat yakin integrasi WhatsApp Cloud API dan enkripsi SOC 2 kami adalah game-changer untuk mengakselerasi kepatuhan perbankan mikro Anda sebelum audit OJK semester depan!\n\nMari kita kunci jadwal uji coba teknis hari Kamis ini jam 14:00 WIB.";
        } else if (tone === 'Ringkas') {
            draft.value = "Yth. Pak Hermawan,\n\nMenindaklanjuti demo kemarin, berikut 2 poin solusi Nusantara CRM untuk PT Finansial Prima:\n1. WhatsApp Cloud API resmi (latensi 14ms).\n2. Jaminan SOC 2 Type II & audit OJK.\n\nApakah Kamis jam 14:00 WIB cocok untuk klarifikasi teknis PoC?";
        } else if (tone === 'Santai') {
            draft.value = "Halo Pak Hermawan,\n\nSalam kenal kembali dan terima kasih atas diskusinya kemarin! Menarik sekali rencana ekspansi multi-cabang Finansial Prima. Modul WhatsApp API dan sertifikasi SOC 2 kami sudah siap banget untuk diuji coba tim Bapak.\n\nKira-kira Kamis jam 2 siang ini kita bisa ngobrol santai sebentar via Meet?";
        } else {
            draft.value = "Yth. Bapak Hermawan,\nCTO PT Solusi Finansial Prima,\n\nTerima kasih banyak atas waktu dan diskusi konstruktif dalam sesi demonstrasi Nusantara Enterprise CRM kemarin siang.\n\nMenindaklanjuti fokus diskusi Anda mengenai kesiapan infrastruktur serta kepatuhan perbankan mikro yang sedang diperluas oleh PT Solusi Finansial Prima, kami merangkum 2 poin utama yang menjadi prioritas tim Anda:\n\n1. Kesiapan modul WhatsApp Cloud API Resmi Meta (Latency < 20ms, High-throughput blast aman tanpa risiko blokir nomor).\n2. Kepatuhan Audit SOC 2 Type II & Regulasi OJK dengan enkripsi end-to-end data customer secara enterprise-grade.\n\nKami telah menyiapkan draf addendum teknis dan PoC environment yang siap diuji coba bersama tim engineer Anda.";
        }
    }

    function fillPrompt(text) {
        document.getElementById('promptInput').value = text;
        document.getElementById('promptInput').focus();
    }

    function copyDraft() {
        const text = document.getElementById('draftContent').value;
        navigator.clipboard.writeText(text);
        alert('Draf pesan berhasil disalin ke clipboard!');
    }

    function handleCopilotSubmit(e) {
        e.preventDefault();
        const input = document.getElementById('promptInput');
        const query = input.value.trim();
        if (!query) return;

        const stream = document.getElementById('chatStream');

        // Add user bubble
        const userDiv = document.createElement('div');
        userDiv.className = 'msg-row-user';
        userDiv.innerHTML = `
            <div style="font-size:11px; color:#94a3b8; margin-bottom:4px;">Dimas Pratama &nbsp;•&nbsp; Baru saja</div>
            <div class="msg-bubble-user">${query}</div>
        `;
        stream.appendChild(userDiv);

        input.value = '';

        // Add simulated AI response
        setTimeout(() => {
            const aiDiv = document.createElement('div');
            aiDiv.className = 'msg-row-ai';
            aiDiv.innerHTML = `
                <div class="ai-sender-tag">
                    <i class="fas fa-sparkles"></i>
                    <span>Nusantara AI Copilot &nbsp;•&nbsp; Baru saja &nbsp;•&nbsp; Real-time AI Analysis</span>
                </div>
                <div class="msg-bubble-ai">
                    <p>Analisis AI atas permintaan <strong>"${query}"</strong>:</p>
                    <p style="margin-top:6px; color:#334155;">Data pipeline CRM telah disinkronkan. Berdasarkan telemetri Q4, probabilitas konversi saat ini berada di level 88%. Tim presales menyarankan penjadwalan presentasi PoC 1-on-1 sebelum penutupan kuartal ini.</p>
                </div>
            `;
            stream.appendChild(aiDiv);
            stream.scrollTop = stream.scrollHeight;
        }, 600);
    }
</script>
@endsection
