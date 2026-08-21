<x-layout title="Webinar Tech - Elcoding Academy">

@push('styles')
<style>
    /* Global Page Styling */
    .webinar-tech-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 80px;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #1c6296 0%, #154b73 100%);
        position: relative;
        padding: 60px 20px 100px;
        text-align: center;
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
        max-width: 900px;
        margin: 0 auto;
    }

    /* Breadcrumbs */
    .hero-breadcrumbs {
        font-size: 13px;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.85);
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .hero-breadcrumbs a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .hero-breadcrumbs a:hover {
        opacity: 1;
        text-decoration: underline;
    }

    .hero-title {
        font-size: 44px;
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 16px;
        letter-spacing: -0.5px;
    }

    .hero-subtitle {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.9);
        max-width: 680px;
        margin: 0 auto;
        line-height: 1.6;
        font-weight: 400;
    }

    /* Navigation Filter Tabs */
    .filter-tabs-wrapper {
        position: relative;
        z-index: 10;
        margin-top: -35px;
        margin-bottom: 50px;
        display: flex;
        justify-content: center;
        padding: 0 20px;
    }

    .filter-tabs {
        background: #ffffff;
        padding: 8px 12px;
        border-radius: 50px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .tab-pill {
        padding: 10px 24px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 600;
        color: #4B5563;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
        white-space: nowrap;
    }

    .tab-pill:hover {
        color: #1c6296;
        background: #f1f5f9;
    }

    .tab-pill.active-red {
        background: #c22525;
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(194, 37, 37, 0.3);
    }

    /* Cards Grid Container */
    .webinar-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .webinar-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    /* Card Styling */
    .webinar-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .webinar-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 35px rgba(0, 0, 0, 0.08);
    }

    /* Top Graphic Banner Image Container */
    .card-banner-img-wrapper {
        position: relative;
        height: 200px;
        overflow: hidden;
        background-color: #f1f5f9;
    }

    .card-banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .webinar-card:hover .card-banner-img {
        transform: scale(1.04);
    }

    /* Floating Badges Over Image */
    .badges-overlay {
        position: absolute;
        bottom: 14px;
        left: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        z-index: 2;
    }

    .badge-pill {
        font-size: 11px;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 50px;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .badge-live {
        background: #dc2626;
        color: #ffffff;
    }

    .badge-upcoming {
        background: #9333ea;
        color: #ffffff;
    }

    .badge-special {
        background: #ea580c;
        color: #ffffff;
    }

    .badge-gratis {
        background: #0284c7;
        color: #ffffff;
    }

    /* Card Body */
    .card-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .webinar-card-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 16px;
        line-height: 1.35;
        min-height: 54px;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 24px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        color: #475569;
        font-weight: 500;
    }

    .info-icon {
        color: #1c6296;
        font-size: 15px;
        width: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    /* Action Link */
    .action-link-row {
        margin-top: auto;
        padding-top: 16px;
    }

    .btn-action-text {
        color: #1c6296;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: color 0.2s;
    }

    .btn-action-text:hover {
        color: #154b73;
    }

    .btn-action-text i {
        font-size: 14px;
        transition: transform 0.2s;
    }

    .btn-action-text:hover i {
        transform: translateX(4px);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .webinar-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .webinar-grid {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: 32px;
        }
    }
</style>
@endpush

<div class="webinar-tech-page">

    <!-- Hero Section -->
    <section class="hero-section">
        <svg class="hero-bg-overlay" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="none" stroke="#ffffff" stroke-width="2" stroke-dasharray="6,6" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,117.3C960,107,1056,149,1152,154.7C1248,160,1344,128,1392,112L1440,96"></path>
            <path fill="none" stroke="#ffffff" stroke-width="1.5" stroke-dasharray="4,4" d="M0,192L48,176C96,160,192,128,288,138.7C384,149,480,203,576,208C672,213,768,171,864,144C960,117,1056,107,1152,122.7C1248,139,1344,181,1392,202.7L1440,224"></path>
        </svg>

        <div class="hero-container">
            <div class="hero-breadcrumbs">
                <a href="{{ url('/') }}">HOME</a> &nbsp;&raquo;&nbsp; <a href="{{ url('/event-webinar') }}">EVENT & WEBINAR</a> &nbsp;&raquo;&nbsp; <span>WEBINAR TECH</span>
            </div>
            <h1 class="hero-title">Webinar Tech</h1>
            <p class="hero-subtitle">
                Tingkatkan skill digital dan pemrograman Anda melalui sesi interaktif bersama pakar industri.
            </p>
        </div>
    </section>

    <!-- Navigation Filter Tabs -->
    <div class="filter-tabs-wrapper">
        <div class="filter-tabs">
            <a href="{{ url('/program-kursus') }}" class="tab-pill">Semua Program</a>
            <a href="{{ url('/bootcamp-intensif') }}" class="tab-pill">Bootcamp Intensif</a>
            <a href="{{ url('/webinar-tech') }}" class="tab-pill active-red">Webinar Tech</a>
            <a href="{{ url('/workshop-online') }}" class="tab-pill">Workshop Online</a>
        </div>
    </div>

    <!-- Main Webinar Cards Container -->
    <main class="webinar-content">
        <div class="webinar-grid">

            <!-- Card 1 -->
            <div class="webinar-card">
                <div class="card-banner-img-wrapper">
                    <img src="{{ asset('gambar/webinar/webinar-ai.jpg') }}" alt="AI & Machine Learning Essentials" class="card-banner-img">
                    <div class="badges-overlay">
                        <span class="badge-pill badge-live">LIVE WEBINAR</span>
                        <span class="badge-pill badge-gratis">GRATIS</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="webinar-card-title">AI & Machine Learning Essentials</h2>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-icon"><i class="far fa-user"></i></span>
                            <span>Budi Pratama</span>
                        </div>
                        <div class="info-item">
                            <span class="info-icon"><i class="far fa-calendar-alt"></i></span>
                            <span>28 Aug 2026, 19.30 WIB</span>
                        </div>
                    </div>
                    <div class="action-link-row">
                        <a href="{{ url('/daftar-event?webinar=ai-engineer') }}" class="btn-action-text">
                            <span>Daftar Webinar Gratis</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="webinar-card">
                <div class="card-banner-img-wrapper">
                    <img src="{{ asset('gambar/webinar/webinar-cloud.jpg') }}" alt="Modern Cloud & Microservices" class="card-banner-img">
                    <div class="badges-overlay">
                        <span class="badge-pill badge-upcoming">UPCOMING</span>
                        <span class="badge-pill badge-gratis">GRATIS</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="webinar-card-title">Modern Cloud & Microservices</h2>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-icon"><i class="far fa-user"></i></span>
                            <span>Sarah Amelia</span>
                        </div>
                        <div class="info-item">
                            <span class="info-icon"><i class="far fa-calendar-alt"></i></span>
                            <span>05 Sep 2026, 19.30 WIB</span>
                        </div>
                    </div>
                    <div class="action-link-row">
                        <a href="{{ url('/daftar-event?webinar=cloud-backend') }}" class="btn-action-text">
                            <span>Daftar Webinar Gratis</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="webinar-card">
                <div class="card-banner-img-wrapper">
                    <img src="{{ asset('gambar/webinar/webinar-security.jpg') }}" alt="Cybersecurity Fundamentals" class="card-banner-img">
                    <div class="badges-overlay">
                        <span class="badge-pill badge-special">SPECIAL SESSION</span>
                        <span class="badge-pill badge-gratis">GRATIS</span>
                    </div>
                </div>
                <div class="card-body">
                    <h2 class="webinar-card-title">Cybersecurity Fundamentals</h2>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-icon"><i class="far fa-user"></i></span>
                            <span>Rizky Fauzi</span>
                        </div>
                        <div class="info-item">
                            <span class="info-icon"><i class="far fa-calendar-alt"></i></span>
                            <span>12 Sep 2026, 19.30 WIB</span>
                        </div>
                    </div>
                    <div class="action-link-row">
                        <a href="{{ url('/daftar-event?webinar=web-security') }}" class="btn-action-text">
                            <span>Daftar Webinar Gratis</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>

</div>

</x-layout>
