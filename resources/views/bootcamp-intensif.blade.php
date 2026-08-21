<x-layout title="Bootcamp Intensif - Elcoding Academy">

@push('styles')
<style>
    /* Global Page Styling */
    .bootcamp-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
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

    /* Decorative background curved lines overlay */
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

    .breadcrumbs {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 20px;
        font-weight: 500;
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
        font-size: 42px;
        font-weight: 800;
        color: #ffffff;
        margin: 0 0 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 17px;
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

    .tab-pill.active {
        background: #1c6296;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(28, 98, 150, 0.25);
    }

    /* Cards Grid Section */
    .bootcamp-content {
        max-width: 1200px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }

    .bootcamp-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    /* Card Styling */
    .bootcamp-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .bootcamp-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 35px rgba(0, 0, 0, 0.09);
    }

    /* Graphic Header Box */
    .card-banner {
        height: 210px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow: hidden;
    }

    .banner-blue {
        background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
    }

    .banner-purple {
        background: linear-gradient(135deg, #f3e8ff 0%, #fae8ff 100%);
    }

    .banner-sky {
        background: linear-gradient(135deg, #dcfce7 0%, #dbeafe 100%);
    }

    .card-badge {
        position: absolute;
        top: 18px;
        left: 18px;
        font-size: 11px;
        font-weight: 800;
        padding: 6px 14px;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        z-index: 2;
    }

    .badge-recommended {
        background: #ede9fe;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
    }

    .badge-terlaris {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .badge-upcoming {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .graphic-illustration {
        width: 100%;
        max-width: 220px;
        height: auto;
        max-height: 140px;
        filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.06));
        transition: transform 0.3s ease;
    }

    .bootcamp-card:hover .graphic-illustration {
        transform: scale(1.05);
    }

    /* Card Body */
    .card-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .course-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 10px;
        line-height: 1.35;
        min-height: 54px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .star-icon {
        color: #f59e0b;
    }

    .dot-separator {
        color: #cbd5e1;
    }

    /* Features List */
    .features-list {
        list-style: none;
        padding: 0;
        margin: 0 0 24px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        color: #475569;
        font-weight: 500;
    }

    .feature-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1c6296;
        font-size: 15px;
        flex-shrink: 0;
    }

    /* Price Section */
    .price-container {
        margin-top: auto;
        padding-top: 18px;
        border-top: 1px solid #f1f5f9;
        margin-bottom: 20px;
    }

    .strike-price {
        font-size: 13px;
        color: #94a3b8;
        text-decoration: line-through;
        font-weight: 600;
        display: block;
        margin-bottom: 2px;
    }

    .current-price {
        font-size: 24px;
        font-weight: 800;
        color: #1c6296;
        letter-spacing: -0.5px;
    }

    /* Action Button */
    .btn-daftar {
        background: #1c6296;
        color: #ffffff !important;
        text-decoration: none;
        text-align: center;
        padding: 13px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        display: block;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(28, 98, 150, 0.15);
    }

    .btn-daftar:hover {
        background: #154b73;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(28, 98, 150, 0.25);
    }

    /* Responsive Breakpoints */
    @media (max-width: 1024px) {
        .bootcamp-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .hero-title {
            font-size: 32px;
        }

        .hero-subtitle {
            font-size: 15px;
        }

        .bootcamp-grid {
            grid-template-columns: 1fr;
        }

        .filter-tabs {
            border-radius: 16px;
            width: 100%;
        }

        .tab-pill {
            flex: 1 1 auto;
            text-align: center;
            padding: 8px 16px;
            font-size: 13px;
        }
    }
</style>
@endpush

<div class="bootcamp-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <!-- SVG Decorative Overlay -->
        <svg class="hero-bg-overlay" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="none" stroke="#ffffff" stroke-width="2" stroke-dasharray="6,6" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,117.3C960,107,1056,149,1152,154.7C1248,160,1344,128,1392,112L1440,96"></path>
            <path fill="none" stroke="#ffffff" stroke-width="1.5" stroke-dasharray="4,4" d="M0,192L48,176C96,160,192,128,288,138.7C384,149,480,203,576,208C672,213,768,171,864,144C960,117,1056,107,1152,122.7C1248,139,1344,181,1392,202.7L1440,224"></path>
        </svg>

        <div class="hero-container">
            <div class="breadcrumbs">
                <a href="{{ url('/') }}">Home</a> &nbsp;&rsaquo;&nbsp; <span>Bootcamp Intensif</span>
            </div>
            <h1 class="hero-title">Bootcamp Intensif</h1>
            <p class="hero-subtitle">
                Akselerasi karir tech-mu dengan kurikulum industri, live mentoring 1-on-1, dan real-world portofolio.
            </p>
        </div>
    </section>

    <!-- Filter Tabs -->
    <div class="filter-tabs-wrapper">
        <div class="filter-tabs">
            <a href="{{ url('/program-kursus') }}" class="tab-pill">Semua Program</a>
            <a href="{{ url('/bootcamp-intensif') }}" class="tab-pill active">Bootcamp Intensif</a>
            <a href="{{ url('/event-webinar') }}" class="tab-pill">Webinar Tech</a>
            <a href="{{ url('/workshop-online') }}" class="tab-pill">Workshop Online</a>
        </div>
    </div>

    <!-- Main Content Cards Grid -->
    <main class="bootcamp-content">
        <div class="bootcamp-grid">

            <!-- Card 1: Full Stack Web Dev -->
            <div class="bootcamp-card">
                <div class="card-banner banner-blue">
                    <span class="card-badge badge-recommended">RECOMMENDED</span>
                    <svg class="graphic-illustration" viewBox="0 0 240 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="20" y="15" width="200" height="110" rx="12" fill="#FFFFFF"/>
                        <rect x="20" y="15" width="200" height="28" rx="12" fill="#E2E8F0"/>
                        <circle cx="36" cy="29" r="4" fill="#EF4444"/>
                        <circle cx="48" cy="29" r="4" fill="#F59E0B"/>
                        <circle cx="60" cy="29" r="4" fill="#10B981"/>
                        <path d="M40 60L55 72L40 84" stroke="#1C6296" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="68" y="78" width="35" height="4" rx="2" fill="#1C6296"/>
                        <rect x="120" y="55" width="80" height="8" rx="4" fill="#93C5FD"/>
                        <rect x="120" y="70" width="60" height="8" rx="4" fill="#CBD5E1"/>
                        <rect x="120" y="85" width="70" height="8" rx="4" fill="#93C5FD"/>
                    </svg>
                </div>
                <div class="card-body">
                    <h2 class="course-title">Bootcamp Intensif Full Stack Web Dev</h2>
                    <div class="rating-row">
                        <span class="star-icon"><i class="fas fa-star"></i></span>
                        <strong>4.9</strong>
                        <span class="dot-separator">&bull;</span>
                        <span>420 Alumni</span>
                    </div>
                    <ul class="features-list">
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-clock"></i></span>
                            <span>12 Minggu Pembelajaran</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-user-friends"></i></span>
                            <span>Live Mentoring 1-on-1</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-file-code"></i></span>
                            <span>Review Portofolio Final</span>
                        </li>
                    </ul>
                    <div class="price-container">
                        <span class="strike-price">Rp 5.600.000</span>
                        <div class="current-price">Rp 2.500.000</div>
                    </div>
                    <a href="{{ url('/pendaftaran-bootcamp?program=bootcamp-web-dev') }}" class="btn-daftar">Daftar</a>
                </div>
            </div>

            <!-- Card 2: Flutter Mobile App -->
            <div class="bootcamp-card">
                <div class="card-banner banner-purple">
                    <span class="card-badge badge-terlaris">TERLARIS</span>
                    <svg class="graphic-illustration" viewBox="0 0 240 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="75" y="10" width="90" height="120" rx="16" fill="#FFFFFF"/>
                        <rect x="75" y="10" width="90" height="120" rx="16" stroke="#E9D5FF" stroke-width="3"/>
                        <rect x="105" y="16" width="30" height="4" rx="2" fill="#E9D5FF"/>
                        <rect x="85" y="30" width="70" height="75" rx="8" fill="#F3E8FF"/>
                        <circle cx="120" cy="55" r="14" fill="#C084FC"/>
                        <rect x="97" y="76" width="46" height="6" rx="3" fill="#A855F7"/>
                        <rect x="105" y="86" width="30" height="6" rx="3" fill="#DDD6FE"/>
                    </svg>
                </div>
                <div class="card-body">
                    <h2 class="course-title">Mobile App Development - Flutter</h2>
                    <div class="rating-row">
                        <span class="star-icon"><i class="fas fa-star"></i></span>
                        <strong>4.8</strong>
                        <span class="dot-separator">&bull;</span>
                        <span>350 Alumni</span>
                    </div>
                    <ul class="features-list">
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-clock"></i></span>
                            <span>10 Minggu Pembelajaran</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-mobile-alt"></i></span>
                            <span>iOS & Android App</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-layer-group"></i></span>
                            <span>Build Real Project</span>
                        </li>
                    </ul>
                    <div class="price-container">
                        <span class="strike-price">Rp 4.500.000</span>
                        <div class="current-price">Rp 2.250.000</div>
                    </div>
                    <a href="{{ url('/pendaftaran-bootcamp?program=bootcamp-flutter') }}" class="btn-daftar">Daftar</a>
                </div>
            </div>

            <!-- Card 3: UI/UX Design -->
            <div class="bootcamp-card">
                <div class="card-banner banner-sky">
                    <span class="card-badge badge-upcoming">UPCOMING BATCH</span>
                    <svg class="graphic-illustration" viewBox="0 0 240 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M40 25C40 20 60 15 120 15C180 15 200 20 200 25V115C200 120 180 125 120 125C60 125 40 120 40 115V25Z" fill="#FFFFFF"/>
                        <path d="M60 40C60 30 180 30 180 50C180 70 120 70 120 70C120 70 60 70 60 90C60 110 180 110 180 100" stroke="#38BDF8" stroke-width="5" stroke-linecap="round"/>
                        <circle cx="180" cy="100" r="8" fill="#0284C7"/>
                    </svg>
                </div>
                <div class="card-body">
                    <h2 class="course-title">UI/UX Design & Product Strategy</h2>
                    <div class="rating-row">
                        <span class="star-icon"><i class="fas fa-star"></i></span>
                        <strong>4.9</strong>
                        <span class="dot-separator">&bull;</span>
                        <span>280 Alumni</span>
                    </div>
                    <ul class="features-list">
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-clock"></i></span>
                            <span>8 Minggu Pembelajaran</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-drafting-compass"></i></span>
                            <span>Figma Mastery</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-cubes"></i></span>
                            <span>Build Design System</span>
                        </li>
                    </ul>
                    <div class="price-container">
                        <span class="strike-price">Rp 3.800.000</span>
                        <div class="current-price">Rp 1.900.000</div>
                    </div>
                    <a href="{{ url('/pendaftaran-bootcamp?program=bootcamp-ui-ux') }}" class="btn-daftar">Daftar</a>
                </div>
            </div>

        </div>
    </main>
</div>

</x-layout>
