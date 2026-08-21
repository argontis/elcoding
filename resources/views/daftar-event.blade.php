<x-layout title="Formulir Pendaftaran Webinar - Elcoding Academy">

@push('styles')
<style>
    /* Page Layout */
    .pendaftaran-webinar-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 60px;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1c6296 0%, #154b73 100%);
        position: relative;
        padding: 50px 20px 90px;
        color: #ffffff;
        overflow: hidden;
    }

    .hero-bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        opacity: 0.15;
        z-index: 1;
    }

    .hero-container {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
    }

    .breadcrumbs {
        font-size: 12px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.85);
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }

    .breadcrumbs a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .breadcrumbs a:hover {
        opacity: 1;
        text-decoration: underline;
    }

    .hero-title {
        font-size: 40px;
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 12px;
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        max-width: 650px;
        margin: 0;
        line-height: 1.6;
        font-weight: 400;
    }

    /* Main Content 2-Column Grid */
    .content-container {
        max-width: 1200px;
        margin: -50px auto 40px;
        padding: 0 20px;
        position: relative;
        z-index: 10;
        display: grid;
        grid-template-columns: 420px 1fr;
        gap: 32px;
        align-items: start;
    }

    /* Left Column: Event Summary Card */
    .summary-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    }

    .summary-banner-wrapper {
        position: relative;
        height: 210px;
        overflow: hidden;
    }

    .summary-banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badges-overlay {
        position: absolute;
        top: 16px;
        left: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 2;
    }

    .badge-item {
        font-size: 11px;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 50px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .badge-live {
        background: #dc2626;
        color: #ffffff;
    }

    .badge-gratis {
        background: #0284c7;
        color: #ffffff;
    }

    .summary-body {
        padding: 24px;
    }

    .event-title-summary {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 10px;
        line-height: 1.35;
    }

    .event-desc-summary {
        font-size: 14px;
        color: #64748b;
        margin: 0 0 20px;
        line-height: 1.5;
    }

    /* Speaker Profile Box */
    .speaker-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .speaker-avatar-circle {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #cbd5e1;
        object-fit: cover;
        flex-shrink: 0;
    }

    .speaker-name {
        font-size: 14px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 2px;
    }

    .speaker-role {
        font-size: 12px;
        color: #64748b;
        margin: 0;
    }

    /* Event Time & Location Details */
    .details-list {
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .detail-icon-box {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #e0f2fe;
        color: #0284c7;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .detail-text-main {
        font-size: 14px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 2px;
    }

    .detail-text-sub {
        font-size: 12px;
        color: #64748b;
        margin: 0;
    }

    /* Benefits List */
    .benefits-section {
        border-top: 1px solid #f1f5f9;
        padding-top: 20px;
    }

    .benefits-heading {
        font-size: 12px;
        font-weight: 800;
        color: #94a3b8;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    .benefits-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .benefit-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #334155;
        font-weight: 600;
    }

    .benefit-check-icon {
        color: #1c6296;
        font-size: 15px;
    }

    /* Right Column: Form Card */
    .form-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
    }

    .accent-bar {
        width: 4px;
        height: 24px;
        background: #1c6296;
        border-radius: 4px;
    }

    .form-card-title {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    /* Form Fields */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-label span.req {
        color: #dc2626;
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        color: #94a3b8;
        font-size: 15px;
        pointer-events: none;
    }

    .form-control {
        width: 100%;
        padding: 13px 16px 13px 44px;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 14px;
        color: #1e293b;
        outline: none;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    select.form-control {
        appearance: none;
        cursor: pointer;
    }

    .select-arrow {
        position: absolute;
        right: 16px;
        color: #94a3b8;
        font-size: 12px;
        pointer-events: none;
    }

    .form-control:focus {
        background: #ffffff;
        border-color: #1c6296;
        box-shadow: 0 0 0 3px rgba(28, 98, 150, 0.12);
    }

    .grid-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Radio Group */
    .radio-group-title {
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 12px;
    }

    .radio-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 12px;
        margin-bottom: 24px;
    }

    .radio-label-box {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #475569;
        font-weight: 600;
        cursor: pointer;
    }

    .radio-label-box input[type="radio"] {
        accent-color: #1c6296;
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    /* Agreement Checkbox Box */
    .agreement-box {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 10px;
        padding: 14px 16px;
        margin-bottom: 24px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .agreement-box input[type="checkbox"] {
        accent-color: #1c6296;
        width: 18px;
        height: 18px;
        margin-top: 2px;
        cursor: pointer;
    }

    .agreement-text {
        font-size: 12px;
        color: #475569;
        line-height: 1.5;
    }

    .agreement-text a {
        color: #1c6296;
        font-weight: 700;
        text-decoration: none;
    }

    .agreement-text a:hover {
        text-decoration: underline;
    }

    /* Submit Button */
    .btn-submit-form {
        width: 100%;
        background: #1c6296;
        color: #ffffff !important;
        border: none;
        border-radius: 10px;
        padding: 16px;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(28, 98, 150, 0.2);
    }

    .btn-submit-form:hover {
        background: #154b73;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(28, 98, 150, 0.3);
    }

    /* Statistics Banner Below Main Section */
    .stats-container {
        max-width: 1200px;
        margin: 0 auto 40px;
        padding: 0 20px;
    }

    .stats-card-wrapper {
        background: #f1f5f9;
        border-radius: 16px;
        padding: 24px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        align-items: center;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 16px;
        justify-content: center;
    }

    .stat-icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .icon-blue { background: #e0f2fe; color: #0284c7; }
    .icon-gold { background: #fef3c7; color: #d97706; }
    .icon-purple { background: #f3e8ff; color: #7e22ce; }

    .stat-value {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 2px;
    }

    .stat-label {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    /* Simple Footer Bar */
    .simple-footer-bar {
        border-top: 1px solid #e2e8f0;
        padding: 24px 20px;
        background: #ffffff;
        margin-top: 40px;
    }

    .simple-footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        color: #64748b;
    }

    .footer-links-inline {
        display: flex;
        gap: 20px;
    }

    .footer-links-inline a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.2s;
    }

    .footer-links-inline a:hover {
        color: #1c6296;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .content-container {
            grid-template-columns: 1fr;
        }

        .radio-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .grid-2col, .stats-card-wrapper {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: 30px;
        }

        .simple-footer-container {
            flex-direction: column;
            gap: 12px;
            text-align: center;
        }
    }
</style>
@endpush

@php
    $webinarKey = request()->get('webinar', 'ai-engineer');

    $webinarsData = [
        'ai-engineer' => [
            'title' => 'AI & Machine Learning Essentials',
            'desc' => 'Pelajari fundamental kecerdasan buatan dan bagaimana menerapkannya dalam proyek nyata dari nol.',
            'speaker' => 'Budi Pratama',
            'role' => 'Lead AI Engineer at TechCorp',
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=150',
            'banner' => asset('gambar/webinar/webinar-ai.jpg'),
            'date' => 'Sabtu, 24 Agustus 2026',
            'time' => '10:00 - 12:00 WIB',
            'location' => 'Zoom Meeting',
            'loc_sub' => 'Link dikirim H-1 acara'
        ],
        'cloud-backend' => [
            'title' => 'Modern Cloud & Microservices',
            'desc' => 'Membangun Scalable Backend dengan Node.js & Docker secara profesional.',
            'speaker' => 'Sarah Amelia',
            'role' => 'Cloud Architect',
            'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=150',
            'banner' => asset('gambar/webinar/webinar-cloud.jpg'),
            'date' => 'Jumat, 05 September 2026',
            'time' => '19:30 - 21:30 WIB',
            'location' => 'Zoom Meeting',
            'loc_sub' => 'Link dikirim H-1 acara'
        ],
        'web-security' => [
            'title' => 'Cybersecurity Fundamentals',
            'desc' => 'Fundamental Web Security: Mencegah SQL Injection & XSS pada aplikasi web.',
            'speaker' => 'Rizky Fauzi',
            'role' => 'Certified Security Specialist',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150',
            'banner' => asset('gambar/webinar/webinar-security.jpg'),
            'date' => 'Sabtu, 12 September 2026',
            'time' => '19:30 - 21:30 WIB',
            'location' => 'Zoom Meeting',
            'loc_sub' => 'Link dikirim H-1 acara'
        ]
    ];

    $selectedWebinar = $webinarsData[$webinarKey] ?? $webinarsData['ai-engineer'];
@endphp

<div class="pendaftaran-webinar-page">

    <!-- Hero Section -->
    <section class="hero-section">
        <svg class="hero-bg-overlay" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="none" stroke="#ffffff" stroke-width="2" stroke-dasharray="6,6" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,117.3C960,107,1056,149,1152,154.7C1248,160,1344,128,1392,112L1440,96"></path>
            <path fill="none" stroke="#ffffff" stroke-width="1.5" stroke-dasharray="4,4" d="M0,192L48,176C96,160,192,128,288,138.7C384,149,480,203,576,208C672,213,768,171,864,144C960,117,1056,107,1152,122.7C1248,139,1344,181,1392,202.7L1440,224"></path>
        </svg>

        <div class="hero-container">
            <div class="breadcrumbs">
                <a href="{{ url('/') }}">HOME</a> &nbsp;&rsaquo;&nbsp; <a href="{{ url('/event-webinar') }}">EVENT & WEBINAR</a> &nbsp;&rsaquo;&nbsp; <span>PENDAFTARAN WEBINAR</span>
            </div>
            <h1 class="hero-title">Formulir Pendaftaran Webinar</h1>
            <p class="hero-subtitle">
                Daftarkan diri Anda sekarang untuk mengamankan slot sesi interaktif bersama para praktisi industri teknologi terkemuka.
            </p>
        </div>
    </section>

    <!-- Main Grid Content -->
    <div class="content-container">

        <!-- Left Column: Webinar Summary -->
        <div class="left-column">
            <div class="section-card" style="background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);">
                <div class="summary-banner-wrapper" style="border-radius: 12px; margin-bottom: 24px; overflow: hidden; position: relative;">
                    <img src="{{ $selectedWebinar['banner'] }}" alt="{{ $selectedWebinar['title'] }}" class="summary-banner-img" style="width: 100%; height: auto;">
                    <div class="badges-overlay">
                        <span class="badge-item badge-live">LIVE WEBINAR</span>
                        <span class="badge-item badge-gratis">GRATIS</span>
                    </div>
                </div>

            <div class="summary-body">
                <h2 class="event-title-summary">{{ $selectedWebinar['title'] }}</h2>
                <p class="event-desc-summary">{{ $selectedWebinar['desc'] }}</p>

                <!-- Speaker Profile -->
                <div class="speaker-box">
                    <img src="{{ $selectedWebinar['avatar'] }}" alt="{{ $selectedWebinar['speaker'] }}" class="speaker-avatar-circle">
                    <div>
                        <h3 class="speaker-name">{{ $selectedWebinar['speaker'] }}</h3>
                        <p class="speaker-role">{{ $selectedWebinar['role'] }}</p>
                    </div>
                </div>

                <!-- Date & Location -->
                <div class="details-list">
                    <div class="detail-item">
                        <div class="detail-icon-box">
                            <i class="far fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h4 class="detail-text-main">{{ $selectedWebinar['date'] }}</h4>
                            <p class="detail-text-sub">{{ $selectedWebinar['time'] }}</p>
                        </div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-icon-box">
                            <i class="fas fa-video"></i>
                        </div>
                        <div>
                            <h4 class="detail-text-main">{{ $selectedWebinar['location'] }}</h4>
                            <p class="detail-text-sub">{{ $selectedWebinar['loc_sub'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Benefits -->
                <div class="benefits-section">
                    <div class="benefits-heading">YANG ANDA DAPATKAN</div>
                    <ul class="benefits-list">
                        <li class="benefit-item">
                            <span class="benefit-check-icon"><i class="fas fa-check-circle"></i></span>
                            <span>E-Certificate Kehadiran</span>
                        </li>
                        <li class="benefit-item">
                            <span class="benefit-check-icon"><i class="fas fa-check-circle"></i></span>
                            <span>Materi PDF Slides & Source Code</span>
                        </li>
                        <li class="benefit-item">
                            <span class="benefit-check-icon"><i class="fas fa-check-circle"></i></span>
                            <span>Akses Rekaman Selamanya</span>
                        </li>
                        <li class="benefit-item">
                            <span class="benefit-check-icon"><i class="fas fa-check-circle"></i></span>
                            <span>Akses Grup Discord Eksklusif</span>
                        </li>
                    </ul>
                </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Registration Form -->
        <div class="right-column">
            <div class="summary-card" style="padding: 30px; background: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; position: sticky; top: 100px;">
                <span class="summary-badge-tag" style="background: #e0f2fe; color: #0284c7; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; display: inline-block; margin-bottom: 12px;">WEBINAR</span>
                <h2 class="summary-workshop-title" style="margin-bottom: 10px; font-size: 20px; font-weight: 800; color: #1e293b;">{{ $selectedWebinar['title'] }}</h2>
                
                <div style="font-size: 32px; font-weight: 800; color: #1c6296; margin-bottom: 5px;">GRATIS</div>
                <div style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">Daftar sekarang untuk mengamankan slot Anda</div>

                <form action="{{ url('/daftar-event') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_name" value="{{ $selectedWebinar['title'] }}">
                    <input type="hidden" name="amount" value="0">

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;" for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama Anda" required value="{{ old('nama') }}">
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;" for="email">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="contoh@email.com" required value="{{ old('email') }}">
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;" for="whatsapp">Nomor WhatsApp / HP</label>
                        <input type="tel" name="whatsapp" id="whatsapp" class="form-control" placeholder="08xxxxxxxxxx" required value="{{ old('whatsapp') }}">
                    </div>

                    <button type="submit" class="btn-submit-pay" style="width: 100%; margin-top: 10px; background: #1c6296; color: white; padding: 14px; border-radius: 10px; font-weight: bold; border: none; cursor: pointer;">
                        Proses Pendaftaran <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <div class="security-badge" style="margin-top: 20px; font-size: 12px; color: #64748b; text-align: center;">
                    <i class="fas fa-shield-alt text-green-500"></i> Pendaftaran otomatis & E-tiket langsung dikirim
                </div>
            </div>
        </div>

    </div>

    <!-- Statistics Banner Section -->
    <div class="stats-container">
        <div class="stats-card-wrapper">
            <div class="stat-item">
                <div class="stat-icon-circle icon-blue">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <h3 class="stat-value">5,000+</h3>
                    <p class="stat-label">Alumni Webinar</p>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon-circle icon-gold">
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h3 class="stat-value">4.9/5</h3>
                    <p class="stat-label">Rata-rata Rating</p>
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-icon-circle icon-purple">
                    <i class="fas fa-rocket"></i>
                </div>
                <div>
                    <h3 class="stat-value">50+</h3>
                    <p class="stat-label">Topik Berbeda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Footer Bar -->
    <footer class="simple-footer-bar">
        <div class="simple-footer-container">
            <div>&copy; 2024 elcoding.id. All rights reserved.</div>
            <div class="footer-links-inline">
                <a href="#" onclick="openFooterModal('tncModal', event)">Syarat & Ketentuan</a>
                <a href="#" onclick="openFooterModal('privacyModal', event)">Kebijakan Privasi</a>
            </div>
        </div>
    </footer>

</div>

</x-layout>
