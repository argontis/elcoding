<x-layout title="Workshop Online - Elcoding Academy">

@push('styles')
<style>
    /* Global Page Styling */
    .workshop-page {
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

    .hero-breadcrumbs {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 20px;
        font-weight: 500;
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
    .workshop-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .workshop-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    /* Card Styling */
    .workshop-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .workshop-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 35px rgba(0, 0, 0, 0.08);
    }

    /* Card Top Banner Image Container */
    .banner-wrapper {
        position: relative;
        height: 210px;
        overflow: hidden;
        background-color: #f1f5f9;
    }

    .banner-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .workshop-card:hover .banner-img {
        transform: scale(1.05);
    }

    /* Badges Overlay */
    .badges-overlay {
        position: absolute;
        top: 16px;
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
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        backdrop-filter: blur(4px);
    }

    .badge-workshop {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
    }

    .badge-slot {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .badge-sprint {
        background: #f3e8ff;
        color: #7e22ce;
        border: 1px solid #e9d5ff;
    }

    .badge-popular {
        background: #ffedd5;
        color: #c2410c;
        border: 1px solid #fed7aa;
    }

    .badge-devops {
        background: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }

    /* Floating Mentor Pill */
    .mentor-pill-floating {
        position: absolute;
        bottom: 16px;
        left: 16px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(6px);
        padding: 6px 14px;
        border-radius: 50px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        z-index: 2;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .mentor-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        object-fit: cover;
    }

    .mentor-name {
        font-size: 13px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        line-height: 1.2;
    }

    .mentor-role {
        font-size: 11px;
        color: #64748b;
        margin: 0;
    }

    /* Card Body */
    .card-body {
        padding: 24px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .sub-category {
        font-size: 12px;
        font-weight: 800;
        color: #1c6296;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .workshop-title {
        font-size: 18px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 16px;
        line-height: 1.4;
        min-height: 52px;
    }

    .features-list {
        list-style: none;
        padding: 0;
        margin: 0 0 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .feature-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #475569;
        font-weight: 500;
    }

    .feature-icon {
        color: #1c6296;
        font-size: 14px;
        width: 18px;
        text-align: center;
        flex-shrink: 0;
    }

    /* Price Section */
    .price-container {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        margin-bottom: 20px;
        display: flex;
        align-items: baseline;
    }

    .price-main {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.5px;
    }

    .price-strike {
        font-size: 13px;
        color: #94a3b8;
        text-decoration: line-through;
        margin-left: 10px;
        font-weight: 600;
    }

    /* Action Button */
    .btn-daftar-workshop {
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

    .btn-daftar-workshop:hover {
        background: #154b73;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(28, 98, 150, 0.25);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .workshop-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 640px) {
        .workshop-grid {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: 32px;
        }
    }
</style>
@endpush

<div class="workshop-page">

    <!-- Hero Section -->
    <section class="hero-section">
        <svg class="hero-bg-overlay" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="none" stroke="#ffffff" stroke-width="2" stroke-dasharray="6,6" d="M0,96L48,112C96,128,192,160,288,186.7C384,213,480,235,576,213.3C672,192,768,128,864,117.3C960,107,1056,149,1152,154.7C1248,160,1344,128,1392,112L1440,96"></path>
            <path fill="none" stroke="#ffffff" stroke-width="1.5" stroke-dasharray="4,4" d="M0,192L48,176C96,160,192,128,288,138.7C384,149,480,203,576,208C672,213,768,171,864,144C960,117,1056,107,1152,122.7C1248,139,1344,181,1392,202.7L1440,224"></path>
        </svg>

        <div class="hero-container">
            <div class="hero-breadcrumbs">
                <a href="{{ url('/') }}">Home</a> &nbsp;&rsaquo;&nbsp; <a href="{{ url('/event-webinar') }}">Event & Webinar</a> &nbsp;&rsaquo;&nbsp; <span>Workshop Online</span>
            </div>
            <h1 class="hero-title">Workshop Online</h1>
            <p class="hero-subtitle">
                Tingkatkan skill teknis Anda melalui sesi workshop interaktif dan hands-on bersama mentor ahli.
            </p>
        </div>
    </section>

    <!-- Navigation Filter Tabs -->
    <div class="filter-tabs-wrapper">
        <div class="filter-tabs">
            <a href="{{ url('/program-kursus') }}" class="tab-pill">Semua Program</a>
            <a href="{{ url('/bootcamp-intensif') }}" class="tab-pill">Bootcamp Intensif</a>
            <a href="{{ url('/webinar-tech') }}" class="tab-pill">Webinar Tech</a>
            <a href="{{ url('/workshop-online') }}" class="tab-pill active-red">Workshop Online</a>
        </div>
    </div>

    <!-- Main Workshop Cards Grid Container -->
    <main class="workshop-content">
        <div class="workshop-grid">

            <!-- Card 1 -->
            <div class="workshop-card">
                <div class="banner-wrapper">
                    <img src="{{ asset('gambar/workshop/workshop-nextjs.jpg') }}" alt="Next.js Workshop" class="banner-img">
                    
                    <div class="badges-overlay">
                        <span class="badge-pill badge-workshop">🛠️ HANDS-ON WORKSHOP</span>
                        <span class="badge-pill badge-slot">⚡ SISA 8 SLOT</span>
                    </div>

                    <div class="mentor-pill-floating">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=120" alt="Rian Kurniawan" class="mentor-avatar">
                        <div>
                            <h3 class="mentor-name">Rian Kurniawan</h3>
                            <p class="mentor-role">Lead Frontend Engineer</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="sub-category">Full Stack Next.js 15 & Tailwind CSS</div>
                    <h2 class="workshop-title">Membangun Web App Production-Ready dengan Next.js 15 & Prisma</h2>

                    <ul class="features-list">
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-calendar-alt"></i></span>
                            <span>2 Hari Intensif (Sabtu-Minggu)</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-code"></i></span>
                            <span>Interactive Live Coding</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-folder-open"></i></span>
                            <span>Source Code & Asset Included</span>
                        </li>
                    </ul>

                    <div class="price-container">
                        <span class="price-main">Rp 199.000</span>
                        <span class="price-strike">Rp 500.000</span>
                    </div>

                    <a href="{{ url('/pendaftaran-workshop?workshop=nextjs') }}" class="btn-daftar-workshop">Daftar Workshop</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="workshop-card">
                <div class="banner-wrapper">
                    <img src="{{ asset('gambar/workshop/workshop-figma.jpg') }}" alt="Figma Workshop" class="banner-img">
                    
                    <div class="badges-overlay">
                        <span class="badge-pill badge-sprint">🎨 DESIGN SPRINT</span>
                        <span class="badge-pill badge-popular">🔥 POPULAR</span>
                    </div>

                    <div class="mentor-pill-floating">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&q=80&w=120" alt="Nadia Safira" class="mentor-avatar">
                        <div>
                            <h3 class="mentor-name">Nadia Safira</h3>
                            <p class="mentor-role">Senior Product Designer</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="sub-category">UI/UX Design System Mastery with Figma</div>
                    <h2 class="workshop-title">Membuat Scalable Design System & Interactive Prototype di Figma</h2>

                    <ul class="features-list">
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-clock"></i></span>
                            <span>1 Hari Full (Sabtu, 09.00 - 16.00 WIB)</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-drafting-compass"></i></span>
                            <span>Portfolio Asset Kit</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-comments"></i></span>
                            <span>Review Design Langsung</span>
                        </li>
                    </ul>

                    <div class="price-container">
                        <span class="price-main">Rp 149.000</span>
                        <span class="price-strike">Rp 450.000</span>
                    </div>

                    <a href="{{ url('/pendaftaran-workshop?workshop=figma') }}" class="btn-daftar-workshop">Daftar Workshop</a>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="workshop-card">
                <div class="banner-wrapper">
                    <img src="{{ asset('gambar/workshop/workshop-devops.jpg') }}" alt="DevOps Workshop" class="banner-img">
                    
                    <div class="badges-overlay">
                        <span class="badge-pill badge-devops">🚀 DEVOPS CRASH COURSE</span>
                    </div>

                    <div class="mentor-pill-floating">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=120" alt="Dimas Anggara" class="mentor-avatar">
                        <div>
                            <h3 class="mentor-name">Dimas Anggara</h3>
                            <p class="mentor-role">DevOps Engineer</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="sub-category">Docker & CI/CD Pipeline for Beginners</div>
                    <h2 class="workshop-title">Automasi Deployment App Menggunakan Docker & GitHub Actions</h2>

                    <ul class="features-list">
                        <li class="feature-item">
                            <span class="feature-icon"><i class="far fa-calendar-alt"></i></span>
                            <span>2 Hari (Sabtu-Minggu, 19.00 WIB)</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-cloud"></i></span>
                            <span>Cloud Sandbox Gratis</span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-icon"><i class="fas fa-certificate"></i></span>
                            <span>Sertifikat Resmi</span>
                        </li>
                    </ul>

                    <div class="price-container">
                        <span class="price-main">Rp 249.000</span>
                        <span class="price-strike">Rp 550.000</span>
                    </div>

                    <a href="{{ url('/pendaftaran-workshop?workshop=devops') }}" class="btn-daftar-workshop">Daftar Workshop</a>
                </div>
            </div>

        </div>
    </main>

</div>

</x-layout>
