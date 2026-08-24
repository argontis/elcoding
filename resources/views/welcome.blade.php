<x-layout title="Elcoding Academy - Belajar Skill Digital untuk Masa Depan">
@push('preload')
<link rel="preload" as="image" href="{{ asset('assets/wp-content/uploads/2023/01/ikon-1.svg') }}">
@endpush

@push('styles')
<style>
    /* Global e-con-inner margin reset */
    .e-con-inner {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }
</style>
@endpush

<div data-elementor-type="wp-page" data-elementor-id="6296" class="elementor elementor-6296" data-elementor-post-type="page">
    
    <!-- Hero Section -->
    <style>
        .kai-hero {
            position: relative;
            width: 100%;
            height: 100vh;
            min-height: 600px;
            margin-top: -80px; /* Adjust based on navbar height to reach the top */
            display: flex;
            align-items: flex-end;
            padding-bottom: 80px;
            color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }

        /* Background Slider Container */
        .kai-hero-bg-slider {
            position: absolute;
            top: 0; left: 0;
            width: 400%; /* 4 slides = 400% */
            height: 100%;
            display: flex;
            z-index: 0;
            transition: transform 0.8s ease-in-out;
        }

        .kai-hero-slide {
            width: 25%; /* 100% / 4 */
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .kai-hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 50%, transparent 100%),
                        linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0) 50%);
            z-index: 1;
        }

        .kai-hero-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .kai-hero-content {
            max-width: 650px;
        }

        .kai-hero-title {
            font-size: 52px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 24px;
            color: #ffffff !important;
            letter-spacing: -0.5px;
        }

        .kai-hero-subtitle {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 40px;
            color: #ffffff !important;
            font-weight: 400;
        }

        .kai-hero-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
            transition: gap 0.3s ease;
        }

        .kai-hero-link:hover {
            gap: 16px;
            color: #cbd5e1;
        }

        /* Slider indicators */
        .kai-slider-indicators {
            display: flex;
            gap: 16px;
            margin-top: 60px;
        }

        .kai-indicator {
            width: 48px;
            height: 3px;
            background-color: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .kai-indicator.active {
            background-color: #ffffff;
        }

        @media (max-width: 768px) {
            .kai-hero-title {
                font-size: 36px;
            }
            .kai-hero-subtitle {
                font-size: 16px;
            }
            .kai-hero {
                padding-bottom: 60px;
            }
        }
    </style>

    <section class="kai-hero">
        <div class="kai-hero-bg-slider" id="kaiBgSlider">
            <!-- Slide 1: Changed to modern tech/coding setup -->
            <div class="kai-hero-slide" style="background-image: url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop');"></div>
            <!-- Slide 2: Modern Bootcamp Coding -->
            <div class="kai-hero-slide" style="background-image: url('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop');"></div>
            <!-- Slide 3: Mentoring/Teaching -->
            <div class="kai-hero-slide" style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2071&auto=format&fit=crop');"></div>
            <!-- Slide 4: Glowing Code/Tech Environment -->
            <div class="kai-hero-slide" style="background-image: url('https://images.unsplash.com/photo-1531482615713-2afd69097998?q=80&w=2070&auto=format&fit=crop');"></div>
        </div>
        
        <div class="kai-hero-overlay"></div>
        
        <div class="kai-hero-container">
            <div class="kai-hero-content">
                <h1 class="kai-hero-title">Bangun Produk Digital,<br>Tingkatkan Skill IT</h1>
                <p class="kai-hero-subtitle">
                    Temukan berbagai layanan pembuatan aplikasi dan program pelatihan IT terbaik yang menjadi bagian dari perjalanan kesuksesan bisnis Anda bersama Elcoding.
                </p>
                <a href="/tentang-kami" class="kai-hero-link">
                    Lebih Lanjut Tentang Kami <i class="fas fa-arrow-right"></i>
                </a>
                
                <div class="kai-slider-indicators" id="kaiSliderIndicators">
                    <div class="kai-indicator active" onclick="goToSlide(0)"></div>
                    <div class="kai-indicator" onclick="goToSlide(1)"></div>
                    <div class="kai-indicator" onclick="goToSlide(2)"></div>
                    <div class="kai-indicator" onclick="goToSlide(3)"></div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let currentSlide = 0;
        const totalSlides = 4;
        const slider = document.getElementById('kaiBgSlider');
        const indicators = document.getElementById('kaiSliderIndicators').children;
        let slideInterval;

        function goToSlide(index) {
            currentSlide = index;
            // Move slider container smoothly
            slider.style.transform = `translateX(-${currentSlide * 25}%)`;
            
            // Update indicator states
            for(let i = 0; i < indicators.length; i++) {
                indicators[i].classList.remove('active');
            }
            indicators[currentSlide].classList.add('active');
            
            // Reset interval so it doesn't auto-slide immediately after manual click
            resetInterval();
        }

        function nextSlide() {
            let next = (currentSlide + 1) % totalSlides;
            goToSlide(next);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, 5000); // Auto-slide every 5 seconds
        }

        // Initialize auto slide
        document.addEventListener('DOMContentLoaded', function() {
            resetInterval();
        });
    </script>

    <!-- Tentang Elcoding Section -->
    <style>
        .tentang-section {
            padding: 100px 20px;
            background-color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .tentang-container {
            max-width: 1300px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
        }
        .tentang-left-col {
            flex: 0 0 200px;
        }
        .tentang-label-text {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        .tentang-right-col {
            flex: 1;
        }
        .tentang-heading {
            font-size: 32px;
            font-weight: 400 !important;
            color: #333333;
            line-height: 1.4;
            margin-bottom: 24px;
            letter-spacing: -0.5px;
            margin-top: -8px;
        }
        .tentang-desc {
            font-size: 15px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 30px;
            max-width: 800px;
        }
        .tentang-links {
            display: flex;
            gap: 30px;
            margin-bottom: 50px;
        }
        .tentang-link {
            font-size: 14px;
            font-weight: 700;
            color: #1e3a8a !important;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .tentang-link .arrow {
            color: #f97316;
            font-weight: normal;
        }
        .tentang-divider {
            height: 1px;
            background-color: #cbd5e1;
            margin-bottom: 50px;
        }
        .tentang-stats {
            display: flex;
            gap: 40px;
            justify-content: flex-start;
        }
        .tentang-stat-item {
            flex: 1;
        }
        .tentang-stat-value {
            font-size: 48px;
            font-weight: 500;
            color: #0f172a;
            margin-bottom: 12px;
            letter-spacing: -1px;
        }
        .tentang-stat-label {
            font-size: 13px;
            color: #64748b;
        }
        
        @media (max-width: 768px) {
            .tentang-container {
                flex-direction: column;
                gap: 20px;
            }
            .tentang-left-col {
                flex: none;
            }
            .tentang-stats {
                flex-direction: column;
                gap: 30px;
            }
            .tentang-heading {
                font-size: 24px;
            }
            .tentang-stat-value {
                font-size: 40px;
            }
        }
    </style>

    <section class="tentang-section">
        <div class="tentang-container">
            <div class="tentang-left-col">
                <div class="tentang-label-text">TENTANG KAMI</div>
            </div>
            <div class="tentang-right-col">
                <h2 class="tentang-heading">Mencetak ribuan developer siap kerja dan mentransformasi puluhan infrastruktur digital enterprise.</h2>
                <p class="tentang-desc">Dari generasi ke generasi, Elcoding terus menghubungkan talenta berbakat dengan industri, menciptakan inovasi dan membangun masa depan digital bagi setiap klien dan peserta didik.</p>
                <div class="tentang-links">
                    <a href="/program-kursus" class="tentang-link">Program Kursus <span class="arrow">&rarr;</span></a>
                    <a href="/layanan" class="tentang-link">Layanan Kami <span class="arrow">&rarr;</span></a>
                </div>
                
                <div class="tentang-divider"></div>
                
                <div class="tentang-stats" id="tentangCounterSection">
                    <div class="tentang-stat-item">
                        <div class="tentang-stat-value counter-value" data-prefix="&gt;" data-suffix="+" data-target="1500">&gt;0+</div>
                        <div class="tentang-stat-label">Alumni Sukses Bekerja</div>
                    </div>
                    <div class="tentang-stat-item">
                        <div class="tentang-stat-value counter-value" data-prefix="" data-suffix="%" data-target="96">0%</div>
                        <div class="tentang-stat-label">Tingkat Kelulusan</div>
                    </div>
                    <div class="tentang-stat-item">
                        <div class="tentang-stat-value counter-value" data-prefix="&gt;" data-suffix="+" data-target="120">&gt;0+</div>
                        <div class="tentang-stat-label">Proyek Enterprise</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter-value');
            const section = document.getElementById('tentangCounterSection');
            let started = false;

            const observer = new IntersectionObserver((entries) => {
                if(entries[0].isIntersecting && !started) {
                    started = true;
                    counters.forEach(counter => {
                        const target = +counter.getAttribute('data-target');
                        const prefix = counter.getAttribute('data-prefix') || '';
                        const suffix = counter.getAttribute('data-suffix') || '';
                        const duration = 2000;
                        const increment = target / (duration / 16); 
                        let current = 0;
                        
                        const updateCounter = () => {
                            current += increment;
                            if (current < target) {
                                let displayVal = Math.ceil(current).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                counter.innerText = prefix + displayVal + suffix;
                                requestAnimationFrame(updateCounter);
                            } else {
                                let displayVal = target.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                counter.innerText = prefix + displayVal + suffix;
                            }
                        };
                        updateCounter();
                    });
                }
            }, { threshold: 0.5 });

            if (section) {
                observer.observe(section);
            }
        });
    </script>

    <!-- Home Video Section -->
    <style>
        .home-video-section {
            padding: 0;
            background-color: transparent;
            position: relative;
            width: 100%;
            height: 250vh; /* Allow enough scroll space for the sticky effect */
        }
        .home-video-container {
            position: sticky;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            z-index: 10;
        }

        .video-wrapper {
            position: relative;
            width: 50%;
            max-width: 800px; /* Starting size */
            border-radius: 30px; /* Starting rounded corners */
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            background: #000;
            aspect-ratio: 16/9;
            will-change: width, max-width, border-radius;
            transition: width 0.3s ease-out, max-width 0.3s ease-out, border-radius 0.3s ease-out;
        }
        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
            z-index: 1;
        }
        
        /* Thumbnail Overlay & Pulse Animation */
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            z-index: 5;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop');
        }
        .video-overlay-bg {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.65); /* Dark tint */
            z-index: 1;
        }
        
        /* KAI.id Pill Play Button */
        .play-btn-pill {
            position: relative;
            z-index: 2;
            padding: 14px 32px;
            background-color: rgba(255, 255, 255, 0.2); /* Pure white glass tint */
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            backdrop-filter: blur(4px);
            transition: all 0.3s ease;
        }
        .play-btn-pill i {
            margin-right: 10px;
            font-size: 14px;
        }
        .play-btn-pill:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }
        
        @media (max-width: 768px) {
            .home-video-title {
                font-size: 26px;
            }
            .home-video-container {
                padding: 60px 20px;
            }
            .video-wrapper {
                border-radius: 12px;
            }
            .play-btn-pill {
                padding: 10px 24px;
                font-size: 14px;
            }
        }
    </style>

    <section class="home-video-section">
        <div class="home-video-container">
            <div class="video-wrapper">
                
                <!-- Overlay Cover yang bisa diklik -->
                <div class="video-overlay" id="videoOverlay" onclick="playVideo()">
                    <div class="video-overlay-bg"></div>
                    <div class="play-btn-pill">
                        <i class="fas fa-play"></i> Putar Video
                    </div>
                </div>

                <!-- Ganti URL embed di bawah dengan ID Video YouTube Anda yang sebenarnya -->
                <iframe id="videoIframe" src="" data-src="https://www.youtube.com/embed/zpOULjyy-n8?autoplay=1&rel=0&showinfo=0" title="Video Profil Elcoding" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <script>
        function playVideo() {
            var overlay = document.getElementById('videoOverlay');
            var iframe = document.getElementById('videoIframe');
            // Hide the pulsing overlay
            overlay.style.display = 'none';
            // Load and auto-play the video
            iframe.src = iframe.getAttribute('data-src');
        }

        // Animasi Scroll-Zoom untuk Video Thumbnail
        document.addEventListener('DOMContentLoaded', () => {
            const videoSection = document.querySelector('.home-video-section');
            const videoWrapper = document.querySelector('.video-wrapper');
            
            if (videoSection && videoWrapper) {
                window.addEventListener('scroll', () => {
                    // Hanya terapkan animasi di layar non-mobile (Desktop/Tablet besar)
                    if (window.innerWidth < 768) return;

                    const rect = videoSection.getBoundingClientRect();
                    const windowHeight = window.innerHeight;
                    
                    // Sticky Scroll Logic:
                    // Animasi dimulai saat ujung atas section menyentuh atas layar (rect.top <= 0)
                    // dan selesai setelah di-scroll sejauh 1.5x tinggi layar (sisa tinggi dari 250vh)
                    let progress = 0;
                    if (rect.top <= 0) {
                        progress = Math.abs(rect.top) / (windowHeight * 1.5);
                    }
                    progress = Math.max(0, Math.min(1, progress));
                    
                    // Hitung nilai dinamis: dari lebar 50% menjadi 100%
                    const currentWidth = 50 + (50 * progress); 
                    const currentBorderRadius = 30 - (30 * progress); 
                    
                    videoWrapper.style.width = `${currentWidth}%`;
                    videoWrapper.style.borderRadius = `${currentBorderRadius}px`;
                    
                    if (progress === 1) {
                        videoWrapper.style.maxWidth = '100%';
                    } else {
                        // Secara mulus tambah max-width dari 800px ke lebar layar penuh
                        const currentMaxWidth = 800 + ((window.innerWidth - 800) * progress);
                        videoWrapper.style.maxWidth = `${currentMaxWidth}px`;
                    }
                });
            }
        });
    </script>

    <x-mitra style="--mitra-margin-top: 40px;" />
<!-- Layanan Utama Section -->
<style>
    .services-section {
        padding: 40px 20px 60px;
        background-color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .services-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .top-badge {
        display: inline-block;
        background-color: #fff7ed;
        color: #f97316;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.5px;
        padding: 6px 16px;
        border-radius: 50px;
        margin-bottom: 16px;
    }
    .section-title {
        font-size: 20px;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 12px;
    }
    .section-subtitle {
        font-size: 15px;
        color: #4b5563;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    .services-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }
    @media (min-width: 768px) {
        .services-grid { grid-template-columns: repeat(2, 1fr); }
    }
    
    .service-card {
        background: #ffffff;
        border: 1px solid #f3f4f6;
        border-radius: 12px;
        padding: 32px;
        display: flex;
        flex-direction: column;
        transition: all 0.2s ease;
    }
    .service-card:hover {
        border-color: #e5e7eb;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
    }
    
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
    }
    .icon-box.blue {
        background-color: #eef2ff;
        color: #1e3a8a;
    }
    .icon-box.orange {
        background-color: #fff7ed;
        color: #9a3412;
    }
    .icon-box i {
        font-size: 20px;
    }

    .service-card h3 {
        font-size: 17px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 16px;
    }
    .service-card p {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.6;
        margin-bottom: 24px;
        flex-grow: 1;
    }
    
    .tech-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 32px;
    }
    .tech-badges span {
        background-color: #f3f4f6;
        color: #4b5563;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 4px;
    }

    .btn-solid-blue {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: #002e94;
        color: white;
        font-size: 13px;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        align-self: flex-start;
        transition: background-color 0.2s;
    }
    .btn-solid-blue:hover {
        background-color: #002277;
        color: white;
    }

    .btn-outline-blue {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: transparent;
        color: #1e3a8a;
        border: 1px solid #d1d5db;
        font-size: 13px;
        font-weight: 500;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        align-self: flex-start;
        transition: all 0.2s;
    }
    .btn-outline-blue:hover {
        border-color: #1e3a8a;
        background-color: #f8fafc;
        color: #1e3a8a;
    }
</style>

    <style>
        .services-section {
            padding: 100px 20px;
            background: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .services-container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .bento-services-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-top: 50px;
        }
        
        .bento-service-card {
            border-radius: 32px;
            padding: 60px 50px;
            position: relative;
            overflow: hidden;
            color: #ffffff;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 450px;
        }
        
        .bento-service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.15);
        }
        
        .bento-blue {
            background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);
        }
        
        .bento-orange {
            background: linear-gradient(135deg, #EA580C 0%, #F97316 100%);
        }
        
        /* Decorative massive icons */
        .bento-bg-icon {
            position: absolute;
            right: -20px;
            bottom: -30px;
            font-size: 280px;
            color: rgba(255,255,255,0.1);
            z-index: 0;
            transform: rotate(-15deg);
            transition: transform 0.6s ease;
        }
        
        .bento-service-card:hover .bento-bg-icon {
            transform: rotate(0deg) scale(1.1);
        }
        
        .bento-content {
            position: relative;
            z-index: 2;
        }
        
        .bento-icon-small {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin-bottom: 30px;
        }
        
        .bento-service-card h3 {
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }
        
        .bento-service-card p {
            font-size: 16px;
            line-height: 1.7;
            opacity: 0.9;
            margin-bottom: 40px;
            max-width: 90%;
        }
        
        .bento-btn {
            display: inline-flex;
            align-items: center;
            background: #ffffff;
            color: #1F2937;
            font-weight: 700;
            padding: 16px 32px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            align-self: flex-start;
        }
        
        .bento-blue .bento-btn { color: #1E40AF; }
        .bento-orange .bento-btn { color: #EA580C; }
        
        .bento-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .bento-btn i {
            margin-left: 10px;
        }
        
        @media (max-width: 992px) {
            .bento-services-grid { grid-template-columns: 1fr; }
            .bento-service-card { padding: 40px; min-height: auto; }
            .bento-bg-icon { font-size: 200px; right: -10px; bottom: -10px; }
            .bento-service-card h3 { font-size: 28px; }
        }
    </style>

    <section class="services-section">
        <div class="services-container">
            <div class="section-header" style="text-align: center; margin-bottom: 60px;">
                <span class="top-badge" style="background: #eef2ff; color: #4B6BF5; padding: 8px 20px; border-radius: 50px; font-weight: 700; font-size: 14px; margin-bottom: 20px; display: inline-block;">SOLUSI DIGITAL TERINTEGRASI</span>
                <h2 class="section-title" style="font-size: 42px; font-weight: 800; color: #1F2937; margin-bottom: 20px;">Layanan Utama Kami</h2>
                <p class="section-subtitle" style="font-size: 18px; color: #6B7280; max-width: 700px; margin: 0 auto; line-height: 1.6;">Mewujudkan ide Anda menjadi produk digital unggulan dan mencetak talenta IT berkualitas untuk masa depan.</p>
            </div>
            
            <div class="bento-services-grid">
                <!-- Software House -->
                <div class="bento-service-card bento-blue">
                    <i class="fas fa-network-wired bento-bg-icon"></i>
                    <div class="bento-content">
                        <div class="bento-icon-small"><i class="fas fa-laptop-code"></i></div>
                        <h3>Software House</h3>
                        <p>Jasa pembuatan aplikasi website, sistem informasi, dan mobile apps secara custom. Solusi IT cerdas yang disesuaikan dengan kebutuhan bisnis Anda, didukung dengan arsitektur modern, UI/UX memukau, dan keamanan terjamin.</p>
                    </div>
                    <a href="{{ url('/kontak') }}" class="bento-btn">Konsultasi Project <i class="fas fa-arrow-right"></i></a>
                </div>
                
                <!-- Pelatihan & Kursus IT -->
                <div class="bento-service-card bento-orange">
                    <i class="fas fa-graduation-cap bento-bg-icon"></i>
                    <div class="bento-content">
                        <div class="bento-icon-small"><i class="fas fa-chalkboard-teacher"></i></div>
                        <h3>Pelatihan & Kursus IT</h3>
                        <p>Program bootcamp intensif bersertifikat. Dirancang khusus untuk membangun fondasi karir Anda di dunia teknologi dengan kurikulum berbasis praktik industri yang mutakhir. Bangun portofolio profesional Anda bersama ahlinya.</p>
                    </div>
                    <a href="{{ url('/program-kursus') }}" class="bento-btn">Lihat Program <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

<!-- Mengapa Memilih Kami Section -->
<!-- Mengapa Memilih Kami Section -->
<!-- Mengapa Memilih Kami Section -->
    <style>
        .elc-features-section {
            padding: 100px 20px 120px;
            background-color: #ffffff;
            /* Subtle dotted pattern to fill empty space without being noisy */
            background-image: radial-gradient(#e5e7eb 2px, transparent 2px);
            background-size: 30px 30px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative;
        }

        .elc-features-container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        
        .elc-features-header {
            text-align: center;
            margin-bottom: 70px;
        }
        
        .elc-features-header h2 {
            font-size: 42px;
            font-weight: 800;
            color: #1F2937; /* Dark Gray */
            margin-bottom: 15px;
        }
        
        .elc-features-header p {
            font-size: 18px;
            color: #6B7280;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .elc-features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }
        
        .elc-feature-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 50px 40px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04); /* Very soft shadow */
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border-top: 6px solid #4B6BF5; /* Elcoding Brand Blue */
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 280px;
            z-index: 1;
        }
        
        .elc-feature-card::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(75, 107, 245, 0.0), rgba(75, 107, 245, 0.04));
            z-index: -1;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        
        .elc-feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(75, 107, 245, 0.12);
        }
        
        .elc-feature-card:hover::after {
            opacity: 1;
        }

        .elc-icon-wrapper {
            position: relative;
            width: 70px;
            height: 70px;
            border-radius: 20px;
            background: rgba(75, 107, 245, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #4B6BF5;
            margin-bottom: 30px;
            transition: all 0.4s ease;
        }
        
        .elc-feature-card:hover .elc-icon-wrapper {
            background: #4B6BF5;
            color: #ffffff;
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 30px rgba(75, 107, 245, 0.3);
        }
        
        .elc-feature-card h3 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #1F2937;
        }
        
        .elc-feature-card p {
            font-size: 16px;
            line-height: 1.7;
            color: #4B5563;
            margin: 0;
        }
        
        /* Giant watermark icon inside card */
        .elc-watermark {
            position: absolute;
            right: -20px;
            bottom: -30px;
            font-size: 200px;
            color: rgba(75, 107, 245, 0.03);
            z-index: -1;
            transition: all 0.6s ease;
        }
        
        .elc-feature-card:hover .elc-watermark {
            color: rgba(75, 107, 245, 0.06);
            transform: scale(1.1) rotate(-10deg) translateX(-10px);
        }
        
        /* Orange Variant */
        .elc-feature-card.orange-card { border-top-color: #F59E0B; }
        .elc-feature-card.orange-card .elc-icon-wrapper { color: #F59E0B; background: rgba(245, 158, 11, 0.1); }
        .elc-feature-card.orange-card .elc-watermark { color: rgba(245, 158, 11, 0.03); }
        
        .elc-feature-card.orange-card:hover .elc-icon-wrapper {
            background: #F59E0B;
            color: #ffffff;
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.3);
        }
        .elc-feature-card.orange-card:hover .elc-watermark { color: rgba(245, 158, 11, 0.06); }
        .elc-feature-card.orange-card:hover { box-shadow: 0 25px 50px rgba(245, 158, 11, 0.12); }
        .elc-feature-card.orange-card::after { background: linear-gradient(135deg, rgba(245, 158, 11, 0.0), rgba(245, 158, 11, 0.04)); }

        @media (max-width: 1024px) {
            .elc-features-header h2 { font-size: 36px; }
            .elc-feature-card { padding: 40px 30px; }
        }
        
        @media (max-width: 768px) {
            .elc-features-grid { grid-template-columns: 1fr; }
            .elc-features-section { padding: 80px 20px; }
            .elc-features-header h2 { font-size: 30px; }
        }
    </style>

    <section class="elc-features-section">
        <div class="elc-features-container">
            <div class="elc-features-header">
                <h2>Mengapa Memilih Kami?</h2>
                <p>Lebih dari sekadar tempat kursus, Elcoding adalah Software House profesional yang menjembatani dunia pendidikan dan industri nyata.</p>
            </div>
            
            <div class="elc-features-grid">
                <!-- Card 1 (Blue) -->
                <div class="elc-feature-card">
                    <i class="fas fa-chalkboard-teacher elc-watermark"></i>
                    <div class="elc-icon-wrapper">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h3>Mentor Praktisi Industri</h3>
                    <p>Belajar langsung dari pakar yang aktif mengerjakan proyek skala enterprise. Dapatkan insight nyata yang tidak ada di buku teks.</p>
                </div>
                
                <!-- Card 2 (Orange) -->
                <div class="elc-feature-card orange-card">
                    <i class="fas fa-laptop-code elc-watermark"></i>
                    <div class="elc-icon-wrapper">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h3>Fokus Praktik & Proyek</h3>
                    <p>Tinggalkan teori membosankan. Kurikulum kami menuntut Anda mengerjakan studi kasus riil (80% praktik) untuk membangun portofolio solid.</p>
                </div>
                
                <!-- Card 3 (Blue) -->
                <div class="elc-feature-card">
                    <i class="fas fa-building elc-watermark"></i>
                    <div class="elc-icon-wrapper">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>Standar Enterprise</h3>
                    <p>Rasakan workflow dan toolset yang digunakan software house modern sungguhan, dari version control hingga agile methodology.</p>
                </div>
                
                <!-- Card 4 (Orange) -->
                <div class="elc-feature-card orange-card">
                    <i class="fas fa-rocket elc-watermark"></i>
                    <div class="elc-icon-wrapper">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3>Penyaluran Kerja</h3>
                    <p>Akses prioritas ke jaringan mitra strategis kami. Kesempatan emas untuk percepatan karir Anda setelah lulus dari program inkubasi.</p>
                </div>
            </div>
        </div>
    </section>


    <style>
        .elementor-element-35b5f33 {
            position: relative;
            background-image: url('{{ asset("gambar/aset/ilustrasi-belajar.jpg") }}') !important;
            background-size: cover !important;
            background-position: center !important;
            background-attachment: fixed !important;
            padding: 60px 20px !important;
        }
        .elementor-element-35b5f33::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to bottom, rgba(75, 107, 245, 0.85), rgba(75, 107, 245, 0.95)) !important;
            z-index: 0;
        }
        .elementor-element-35b5f33 > .e-con-inner {
            position: relative;
            z-index: 1;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
        .elementor-element-35b5f33 .elementor-heading-title, 
        .elementor-element-35b5f33 .elementor-widget-text-editor p {
            color: #ffffff !important;
        }
    </style>
    <div class="elementor-element elementor-element-35b5f33 e-flex e-con-boxed e-con e-parent" data-id="35b5f33" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="e-con-inner">
            <div class="elementor-element elementor-element-d555ae3 elementor-widget elementor-widget-heading" data-id="d555ae3" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
                <h2 class="elementor-heading-title elementor-size-default">BANGUN PRODUK DIGITAL DAN SKILLMU BERSAMA ELCODING</h2>
            </div>
            <div class="elementor-element elementor-element-f7191fb elementor-widget elementor-widget-text-editor" data-id="f7191fb" data-element_type="widget" data-e-type="widget" data-widget_type="text-editor.default">
                <p>Konsultasikan kebutuhan pembuatan aplikasi bisnis Anda atau daftar program kursus terbaik yang sesuai passion Anda dengan tim kami hari ini.</p>
            </div>
            <div class="elementor-element elementor-element-3205b82 elementor-align-justify elementor-widget elementor-widget-button" data-id="3205b82" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
                <a class="elementor-button elementor-button-link elementor-size-md" href="https://wa.me/6281476652656?text=Halo%20Admin%20Elcoding,%20saya%20tertarik%20dengan%20layanan%20yang%20ada%20dan%20ingin%20berkonsultasi%20lebih%20lanjut." target="_blank">
                    <span class="elementor-button-content-wrapper">
                        <span class="elementor-button-icon">
                            <i aria-hidden="true" class="fas fa-angle-double-right"></i>
                        </span>
                        <span class="elementor-button-text">Konsultasi Sekarang</span>
                    </span>
                </a>
            </div>
        </div>
    </div>


    @if(isset($programs) && $programs->count() > 0)
    <!-- Program Kursus Section -->
    <section class="programs-section" id="Program">
        <div class="programs-container">
            <div class="section-header" style="text-align: center; margin-bottom: 50px;">
                <h2 class="section-title">Program Kursus Pilihan</h2>
                <p class="section-subtitle">Pelajari skill paling dibutuhkan di industri IT dari mentor expert kami.</p>
            </div>
            
            <div class="programs-grid">
                @foreach($programs as $program)
                @php
                    $theme = $program->theme_color ?? 'theme-1';
                    $bgClass = 'card-' . $theme;
                    $btnClass = 'btn-' . $theme;
                    $textClass = 'text-' . $theme;
                @endphp
                <div class="program-card {{ $bgClass }}">
                    <div class="program-card-header" style="background-image: url('{{ $program->image_path ? asset(str_replace(' ', '%20', $program->image_path)) : asset('gambar/aset/ilustrasi-belajar.jpg') }}');">
                        @if($program->badge && $program->badge != 'Reguler')
                        <div class="program-badge {{ strtolower($program->badge) == 'terlaris' ? 'terlaris' : '' }}"><i class="fas {{ strtolower($program->badge) == 'terlaris' ? 'fa-fire' : 'fa-star' }}"></i> {{ $program->badge }}</div>
                        @endif
                    </div>
                    <div class="program-card-body">
                        <div class="program-header-info">
                            <h2 class="program-title">{!! nl2br(e($program->title)) !!}</h2>
                            <span class="start-from {{ $textClass }}">Start From</span>
                            <div class="price-value">{{ $program->price }}</div>
                        </div>
                        <div class="program-features-content">
                            @if($program->features)
                                {!! $program->features !!}
                            @else
                                <ul>
                                    <li>Materi <strong>Sesuai Kurikulum Industri</strong></li>
                                    <li>Pembelajaran <strong>Project Based</strong></li>
                                    <li>Didampingi <strong>Mentor Expert</strong></li>
                                    <li>Mendapat <strong>Sertifikat Kompetensi</strong></li>
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="program-card-footer">
                        <a href="/program-kursus" class="program-btn {{ $btnClass }}">Lihat Detail Program</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div style="text-align: center; margin-top: 30px;">
                <a href="/program-kursus" class="elementor-button elementor-button-link elementor-size-sm btn-software-house btn-outline">Lihat Semua Program</a>
            </div>
        </div>
    </section>

    <style>
        .programs-section { padding: 80px 20px; background-color: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; }
        .programs-container { max-width: 1400px; margin: 0 auto; }
        .programs-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; }
        .program-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            position: relative;
        }
        .program-card.card-theme-1 { background-color: #FAF6F0; }
        .program-card.card-theme-2 { background-color: #F4F7FE; }
        .program-card.card-theme-3 { background-color: #F0FAFA; }
        .program-card:hover { transform: translateY(-5px); }
        .program-card-header { background-size: cover; background-position: center; height: 180px; position: relative; }
        .program-badge { position: absolute; top: 15px; left: 0; background: #8B5CF6; color: #fff; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 0 16px 16px 0; display: flex; align-items: center; gap: 6px; box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4); z-index: 2; text-transform: uppercase; }
        .program-badge.terlaris { background: #EF4444; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4); }
        
        .program-header-info { text-align: center; margin-bottom: 30px; }
        .program-title { font-size: 18px !important; font-weight: 700; color: #4B5563; margin: 0 0 8px 0; line-height: 1.4; }
        .start-from { font-size: 16px; font-weight: 600; display: block; margin-bottom: 5px; }
        .start-from.text-theme-1 { color: #D2A882; }
        .start-from.text-theme-2 { color: #132252; }
        .start-from.text-theme-3 { color: #1D667F; }
        
        .price-value { font-size: 32px !important; font-weight: 800; color: #1F2937; line-height: 1; }

        .program-card-body { flex-grow: 1; padding: 30px 20px 0 20px; }
        
        .program-features-content { word-wrap: break-word; overflow-wrap: break-word; word-break: break-word; }
        .program-features-content ul, .program-features-content ol { list-style: none; padding: 0; margin: 0; }
        .program-features-content p, .program-features-content ul li { 
            font-size: 14px; 
            color: #4B5563; 
            padding: 12px 0; 
            margin: 0;
            display: flex; 
            align-items: center; 
            gap: 12px; 
            line-height: 1.4;
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .program-features-content ul li:last-child { border-bottom: none; }
        .program-features-content p::before, .program-features-content ul li::before { 
            content: "\f058"; 
            font-family: "Font Awesome 6 Free"; 
            font-weight: 400; 
            color: #4B5563; 
            font-size: 18px; 
            min-width: 18px;
        }
        .program-features-content p br { display: none; }
        .program-features-content strong { color: #1F2937; font-weight: 600; }
        
        .program-card-footer { padding: 30px 10px 0 10px; display: flex; justify-content: center; }
        .program-btn {
            display: inline-block;
            text-align: center;
            font-weight: 600;
            font-size: 15px;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }
        .program-btn.btn-theme-1 { background: #D2A882; color: #ffffff !important; }
        .program-btn.btn-theme-1:hover { background: #b89270; transform: translateY(-2px); }
        .program-btn.btn-theme-2 { background: #132252; color: #ffffff !important; }
        .program-btn.btn-theme-2:hover { background: #0c1638; transform: translateY(-2px); }
        .program-btn.btn-theme-3 { background: #1D667F; color: #ffffff !important; }
        .program-btn.btn-theme-3:hover { background: #14495c; transform: translateY(-2px); }

        @media (max-width: 1024px) { .programs-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { 
            .programs-grid { grid-template-columns: 1fr; } 
            .programs-section { padding: 48px 16px; }
        }
    </style>
    @endif

    <!-- Combined Statistics & CTA Section -->
    <section class="statistics-cta-section">
        <div class="statistics-cta-container">
            <!-- Top: CTA -->
            <div class="cta-content">
                <h2 class="cta-title">Siap Memulai Proyek atau Karir Anda?</h2>
                <p class="cta-text">Berikan solusi digital terbaik untuk bisnis Anda, atau pelajari skill coding untuk meraih karir impian. Mari bergabung dan bertumbuh bersama Elcoding.</p>
                <div class="elementor-element elementor-element-3205b82 elementor-align-center elementor-widget elementor-widget-button" data-id="3205b82" data-element_type="widget" data-widget_type="button.default">
                    <a class="elementor-button elementor-button-link elementor-size-md" href="/program-kursus">
                        <span class="elementor-button-content-wrapper">
                            <span class="elementor-button-icon">
                                <i aria-hidden="true" class="fas fa-angle-double-right"></i>
                            </span>
                            <span class="elementor-button-text">Daftar Sekarang</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <style>
    .statistics-cta-section { 
        padding: 40px 20px; 
        background-color: #4B6BF5; 
        background-image: linear-gradient(to bottom, rgba(75, 107, 245, 0.85), rgba(75, 107, 245, 0.95)), url('{{ asset("gambar/aset/ilustrasi-belajar.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        margin-bottom: 50px; 
    }
    .statistics-cta-container { max-width: 1400px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; }
    
    .cta-content { text-align: center; max-width: 800px; margin-bottom: 30px; }
    .cta-title { font-size: 32px; font-weight: 800; margin-bottom: 15px; line-height: 1.3; }
    .cta-text { font-size: 16px; margin-bottom: 25px; opacity: 0.9; line-height: 1.6; }
    
    @media (max-width: 768px) {
        .cta-title { font-size: 24px; }
        .cta-text { font-size: 15px; margin-bottom: 20px; }
        .statistics-cta-section { padding: 30px 20px; margin-bottom: 40px; }
    }
    </style>
    @if(isset($portofolios) && $portofolios->count() > 0)
    <!-- Gallery Section -->
    <section class="portfolio-section" id="Portofolio">
        <div class="portfolio-container">
            <div class="portfolio-header">
                <h2 class="portfolio-title">Portofolio</h2>
            </div>
            
            <div class="portfolio-grid">
                @php $kategoriColors = \App\Models\KategoriPortofolio::pluck('color', 'name')->toArray(); @endphp
                @foreach($portofolios as $portofolio)
                <div class="portfolio-card" draggable="false">
                    <img src="{{ asset($portofolio->image_path ?? 'assets/wp-content/uploads/2026/02/Garap-Edu.webp') }}" class="portfolio-img" alt="{{ $portofolio->title }}" loading="lazy">
                    <div class="portfolio-info">
                        <h4>{{ $portofolio->title }}</h4>
                        @php $catColor = $kategoriColors[$portofolio->category] ?? '#4B6BF5'; @endphp
                        <div style="margin-bottom: 15px;"><span class="portfolio-category-badge" style="background-color: {{ $catColor }}; color: #ffffff; box-shadow: 0 4px 10px {{ $catColor }}40;">{{ $portofolio->category }}</span></div>
                        <div class="porto-card-actions">
                            <a href="{{ url('/portofolio/' . $portofolio->id) }}" class="porto-btn porto-btn-detail"><i class="fas fa-info-circle"></i> Detail</a>
                            @if($portofolio->url)
                                <a href="{{ $portofolio->url }}" target="_blank" rel="noopener noreferrer" class="porto-btn porto-btn-url"><i class="fas fa-external-link-alt"></i> Web</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
    .portfolio-section { padding: 80px 0 40px 0; background: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
    .portfolio-container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
    .portfolio-header { text-align: center; margin-bottom: 50px; }
    .portfolio-title { font-size: 38px; font-weight: 800; color: #1F2937; line-height: 1.2; margin: 0; }
    .portfolio-grid { display: flex; gap: 30px; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 20px; scrollbar-width: none; }
    .portfolio-grid::-webkit-scrollbar { display: none; }
    .portfolio-card { flex: 0 0 calc(33.333% - 20px); scroll-snap-align: start; display: flex; flex-direction: column; background: #fff; border: 1px solid #f0f0f0; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .portfolio-card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.05); }
    .portfolio-img { width: 100%; aspect-ratio: 16/9; object-fit: cover; border-bottom: 1px solid #f0f0f0; display: block; }
    .portfolio-info { padding: 25px; text-align: center; flex-grow: 1; display: flex; flex-direction: column; }
    .portfolio-info h4 { font-size: 20px; font-weight: 700; color: #000000; margin: 0 0 8px 0; }
    .portfolio-category-badge { display: inline-block; font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 50px; text-transform: uppercase; letter-spacing: 0.5px; }
    .porto-card-actions { display: flex; gap: 8px; margin-top: auto; justify-content: center; flex-wrap: wrap; }
    .porto-btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 50px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.25s ease; cursor: pointer; }
    .porto-btn-detail { background: #4B6BF5; color: #fff !important; }
    .porto-btn-detail:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37,99,235,0.35); }
    .porto-btn-url { background: transparent; color: #4B6BF5 !important; border: 1.5px solid #4B6BF5; }
    .porto-btn-url:hover { background: #4B6BF5; color: #fff !important; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37,99,235,0.25); }
    .porto-btn-url-disabled { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 50px; font-size: 13px; font-weight: 600; border: 1.5px solid #cbd5e1; color: #94a3b8 !important; background: transparent; cursor: not-allowed; opacity: 0.6; }
    @media (max-width: 992px) { .portfolio-card { flex: 0 0 calc(50% - 15px); } }
    @media (max-width: 768px) { .portfolio-card { flex: 0 0 100%; } }
    </style>
    @endif

    @if(isset($artikels) && $artikels->count() > 0)
    <!-- Blog Section -->
    <section class="blog-section">
        <div class="blog-container">
            <div class="blog-header">
                <h2 class="blog-title">Blog</h2>
            </div>
            
            <div class="blog-grid">
                @foreach($artikels as $artikel)
                <div class="blog-card" draggable="false">
                    <!-- For dummy we use static image based on iteration, for real you can add image_path to article model -->
                    @php 
                        $images = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
                        $randomImg = $images[$artikel->id % 3];
                        $bgImage = $artikel->image_path ? asset($artikel->image_path) : asset('assets/wp-content/uploads/2026/02/'.$randomImg);
                    @endphp
                    <img src="{{ $bgImage }}" class="blog-img" alt="{{ $artikel->title }}" loading="lazy">
                    <div class="blog-content">
                        <h4><a href="#">{{ $artikel->title }}</a></h4>
                        <div class="blog-meta"><i class="fas fa-clock"></i> {{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->format('d M Y') : $artikel->created_at->format('d M Y') }}</div>
                        <p>{{ Str::limit(strip_tags($artikel->content ?? 'Blog informatif dari Elcoding membahas berbagai topik seputar teknologi, pemrograman, dan dunia digital...'), 120) }}</p>
                        <a href="{{ url('/artikel/' . $artikel->id) }}" class="blog-btn">BACA BLOG</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
    .blog-section { padding: 0 0 40px 0; background: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
    .blog-container { max-width: 1400px; margin: 0 auto; padding: 0 20px; }
    .blog-header { text-align: center; margin-bottom: 50px; }
    .blog-subtitle { display: inline-block; color: #4B6BF5; font-size: 14px; font-weight: 700; text-transform: uppercase; background: #EDE9FE; padding: 8px 16px; border-radius: 50px; margin-bottom: 15px; letter-spacing: 1px; }
    .blog-title { font-size: 38px; font-weight: 800; color: #1F2937; line-height: 1.2; margin: 0; }
    .blog-grid { display: flex; gap: 30px; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 20px; scrollbar-width: none; }
    .blog-grid::-webkit-scrollbar { display: none; }
    .blog-card { flex: 0 0 calc(33.333% - 20px); scroll-snap-align: start; display: flex; flex-direction: column; background: #fff; border: 1px solid #f0f0f0; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .blog-img { width: 100%; aspect-ratio: 16/9; object-fit: cover; border-bottom: 1px solid #f0f0f0; display: block; }
    .blog-content { padding: 30px; display: flex; flex-direction: column; flex-grow: 1; }
    .blog-content h4 { font-size: 20px; font-weight: 700; line-height: 1.4; margin: 0 0 15px 0; }
    .blog-content h4 a { color: #1F2937; text-decoration: none; transition: color 0.3s ease; }
    .blog-content h4 a:hover { color: #4B6BF5; }
    .blog-meta { font-size: 13px; color: #000000; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; font-weight: 500; }
    .blog-content p { font-size: 14px; color: #666; line-height: 1.6; margin: 0 0 25px 0; flex-grow: 1; }
    .blog-btn { display: inline-block; align-self: flex-start; background: #4B6BF5; color: #fff !important; font-size: 13px; font-weight: 600; text-transform: uppercase; text-decoration: none; padding: 12px 25px; border-radius: 50px; transition: all 0.3s ease; }
    .blog-btn:hover { background: #1E40AF; transform: translateY(-2px); }
    @media (max-width: 992px) { .blog-card { flex: 0 0 calc(50% - 15px); } }
    @media (max-width: 768px) { 
        .blog-card { flex: 0 0 100%; } 
        .blog-title { font-size: 28px; }
        .blog-content { padding: 20px; }
        .blog-section { padding: 0 0 32px 0; }
    }
    </style>
    @endif

    <!-- Testimonial Section -->
    <section class="testimonial-section">
        <div class="testimonial-container">
            <div class="ts-wrapper">
                <div class="ts-track" id="tsTrack">
                    <!-- Slide 1 -->
                    <div class="ts-slide">
                        <div class="ts-image-box">
                            <img src="{{ asset('assets/wp-content/uploads/2026/02/testimoni-1.jpg') }}" alt="Testimoni" class="ts-img">
                        </div>
                        <div class="ts-content-box">
                            <h3 class="ts-quote">"Pengajar, waktu, dan fasilitas beda dari tempat kursus lain. Tempatnya sangat recommended."</h3>
                            <p class="ts-desc">Karena pengajar, waktu, dan fasilitas beda dari tempat kursus lain. Perkembangan anak sangat positif saat kegiatan liburan putra sangat related dengan menambah ilmu design khususnya di Canva. Tempatnya sangat recommended.</p>
                            <div class="ts-footer">
                                <div class="ts-author">
                                    <span class="ts-name">AFIF PUTRA</span>
                                    <span class="ts-role">(SMA IT-MAGELANG) DESAIN & AI</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="ts-slide">
                        <div class="ts-image-box">
                            <img src="{{ asset('assets/wp-content/uploads/2026/02/testimoni-2.jpg') }}" alt="Testimoni" class="ts-img">
                        </div>
                        <div class="ts-content-box">
                            <h3 class="ts-quote">"Peningkatan nilai anak di sekolah menjadi naik serta anak bisa mengikuti pelajaran."</h3>
                            <p class="ts-desc">Kami mempercayakan ELC ini sebagai kursus komputer supaya anak tidak tertinggal komputer, dan peningkatan nilai anak di sekolah menjadi naik serta anak bisa mengikuti pelajaran khususnya di skill Artificial Intellegent (AI) & Coding.</p>
                            <div class="ts-footer">
                                <div class="ts-author">
                                    <span class="ts-name">Risqi Akbar</span>
                                    <span class="ts-role">(SMK SLAWI) CODING FOR KIDS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="ts-slide">
                        <div class="ts-image-box">
                            <img src="{{ asset('assets/wp-content/uploads/2026/02/testimoni-3.jpg') }}" alt="Testimoni" class="ts-img">
                        </div>
                        <div class="ts-content-box">
                            <h3 class="ts-quote">"Pengajarnya baik dan pembelajarannya asyik, bisa belajar buat website dengan cepat dan seru."</h3>
                            <p class="ts-desc">Pengajar nya baik dan pembelajarannya asyik, sehingga josias bisa belajar Coding for Kids "Fun With Code & Web" sehingga bisa belajar buat website dengan cepat dan seru apalagi buat pemula.</p>
                            <div class="ts-footer">
                                <div class="ts-author">
                                    <span class="ts-name">JOSIAS</span>
                                    <span class="ts-role">(SMP PIUS TEGAL) CODING FOR KIDS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="ts-controls-overlay">
                    <button class="ts-btn" onclick="prevTsSlide()"><i class="fas fa-arrow-left"></i></button>
                    <button class="ts-btn" onclick="nextTsSlide()"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </section>

    <style>
        .testimonial-section {
            padding: 60px 20px 100px;
            background-color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .testimonial-container {
            max-width: 1300px;
            margin: 0 auto;
        }
        .ts-wrapper {
            background-color: #2b2e59;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            display: flex;
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.1);
        }
        .ts-track {
            display: flex;
            width: 100%;
            transition: transform 0.5s ease;
        }
        .ts-slide {
            flex: 0 0 100%;
            display: flex;
            padding: 40px;
            gap: 50px;
            box-sizing: border-box;
        }
        .ts-image-box {
            flex: 0 0 280px;
            aspect-ratio: 3 / 4;
            border-radius: 12px;
            overflow: hidden;
        }
        .ts-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .ts-content-box {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px 0;
            position: relative;
        }
        .ts-quote {
            font-size: 32px;
            font-weight: 600;
            color: #ffffff;
            line-height: 1.3;
            margin-bottom: 24px;
            margin-top: 0;
        }
        .ts-desc {
            font-size: 16px;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 40px;
            max-width: 90%;
        }
        .ts-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .ts-author {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .ts-name {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
        }
        .ts-role {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
        }
        .ts-controls-overlay {
            position: absolute;
            bottom: 40px;
            right: 40px;
            display: flex;
            gap: 16px;
        }
        .ts-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: transparent;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .ts-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
        }
        
        @media (max-width: 992px) {
            .ts-slide {
                padding: 30px;
                gap: 30px;
            }
            .ts-image-box {
                flex: 0 0 240px;
                height: auto;
                aspect-ratio: 3 / 4;
            }
            .ts-quote {
                font-size: 26px;
            }
        }
        @media (max-width: 768px) {
            .ts-slide {
                flex-direction: column;
                padding: 24px;
                gap: 24px;
            }
            .ts-image-box {
                flex: none;
                width: 100%;
                max-width: 280px;
                margin: 0 auto;
                height: auto;
                aspect-ratio: 3 / 4;
            }
            .ts-content-box {
                padding: 0;
                padding-bottom: 60px;
            }
            .ts-quote {
                font-size: 22px;
            }
            .ts-desc {
                max-width: 100%;
            }
            .ts-controls-overlay {
                bottom: 24px;
                right: 24px;
            }
        }
    </style>

    <script>
        let currentTsIndex = 0;
        const tsTrack = document.getElementById('tsTrack');
        // Will evaluate at DOM load
        document.addEventListener('DOMContentLoaded', () => {
            const totalTsSlides = document.querySelectorAll('.ts-slide').length;
            
            window.updateTsSlider = function() {
                tsTrack.style.transform = `translateX(-${currentTsIndex * 100}%)`;
            }

            window.nextTsSlide = function() {
                currentTsIndex = (currentTsIndex + 1) % totalTsSlides;
                updateTsSlider();
            }

            window.prevTsSlide = function() {
                currentTsIndex = (currentTsIndex - 1 + totalTsSlides) % totalTsSlides;
                updateTsSlider();
            }
        });
    </script>




    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const sliders = document.querySelectorAll('.testimonial-grid, .portfolio-grid, .blog-grid');
    sliders.forEach(slider => {
        let isDown = false;
        let startX;
        let scrollLeft;
        let autoScrollInterval;

        const startAutoScroll = () => {
            stopAutoScroll();
            autoScrollInterval = setInterval(() => {
                if (!isDown) {
                    const firstCard = slider.children[0];
                    if(firstCard) {
                        const cardWidth = firstCard.offsetWidth + 30; // + gap
                        if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                            slider.scrollTo({ left: 0, behavior: 'smooth' });
                        } else {
                            slider.scrollBy({ left: cardWidth, behavior: 'smooth' });
                        }
                    }
                }
            }, 5000);
        };

        const stopAutoScroll = () => {
            if (autoScrollInterval) clearInterval(autoScrollInterval);
        };

        startAutoScroll();

        slider.addEventListener('mousedown', (e) => {
            if(e.target.tagName.toLowerCase() === 'a' || e.target.closest('a')) return;
            isDown = true;
            stopAutoScroll();
            slider.style.cursor = 'grabbing';
            slider.style.scrollSnapType = 'none';
            slider.style.scrollBehavior = 'auto';
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        
        const stopDrag = () => {
            if (!isDown) return;
            isDown = false;
            slider.style.cursor = 'grab';
            slider.style.scrollSnapType = 'x mandatory';
            slider.style.scrollBehavior = 'smooth';
            slider.scrollLeft = slider.scrollLeft + 1;
            slider.scrollLeft = slider.scrollLeft - 1;
            startAutoScroll();
        };

        slider.addEventListener('mouseleave', stopDrag);
        slider.addEventListener('mouseup', stopDrag);
        slider.addEventListener('mouseenter', stopAutoScroll);
        slider.addEventListener('mouseleave', () => { if (!isDown) startAutoScroll(); });
        slider.addEventListener('touchstart', stopAutoScroll, {passive: true});
        slider.addEventListener('touchend', startAutoScroll, {passive: true});

        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 1.5;
            slider.scrollLeft = scrollLeft - walk;
        });
        
        slider.style.cursor = 'grab';
    });
});
</script>

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "LocalBusiness",
  "name": "Elcoding Academy",
  "image": "{{ asset('gambar/aset/logo-elcoding.png') }}",
  "@@id": "{{ url('/') }}",
  "url": "{{ url('/') }}",
  "telephone": "+6281476652656",
  "address": {
    "@@type": "PostalAddress",
    "streetAddress": "CitraLand Tegal blok Belleza Plaza Lt.2",
    "addressLocality": "Tegal",
    "addressRegion": "Jawa Tengah",
    "addressCountry": "ID"
  }
}
</script>
@endpush
</x-layout>
