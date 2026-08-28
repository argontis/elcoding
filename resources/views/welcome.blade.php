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
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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

    <!-- Mitra Section -->
    <section class="clients-section">
        <div class="clients-container">
            <div class="clients-slider" id="clientsSlider">
                @php $mitras = \App\Models\Mitra::latest()->get(); @endphp
                @foreach($mitras as $mitra)
                <div class="client-logo">
                    <img src="{{ asset($mitra->logo_path ?? 'assets/wp-content/uploads/2026/02/Icon-Nutrition.webp') }}" alt="{{ $mitra->name }}">
                </div>
                @endforeach
            </div>
            <div class="clients-pagination" id="clientsPagination"></div>
        </div>
    </section>

    <style>
        .clients-section { padding: 60px 0 40px 0; background: #fff; }
        .clients-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; overflow: hidden; position: relative; }
        .clients-slider { display: flex; align-items: center; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none; scroll-behavior: smooth; padding-bottom: 20px; }
        .clients-slider::-webkit-scrollbar { display: none; }
        .client-logo { flex: 0 0 20%; scroll-snap-align: start; display: flex; justify-content: center; align-items: center; padding: 0 15px; height: 120px; }
        .client-logo img { width: 100%; max-width: 160px; height: 80px; object-fit: contain; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s ease; }
        .client-logo img:hover { filter: grayscale(0); opacity: 1; transform: scale(1.1); }
        .clients-pagination { display: flex; justify-content: center; gap: 8px; margin-top: 10px; }
        .clients-dot { width: 10px; height: 10px; border-radius: 50%; background: #e2e8f0; cursor: pointer; transition: 0.3s; }
        .clients-dot.active { background: #4B6BF5; transform: scale(1.2); }
        @media (max-width: 992px) { .client-logo { flex: 0 0 33.333%; } }
        @media (max-width: 768px) { .client-logo { flex: 0 0 50%; height: 100px; } .client-logo img { height: 60px; max-width: 120px; } .client-logo img:hover { transform: scale(1.1); } }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('clientsSlider');
            const pagination = document.getElementById('clientsPagination');
            const items = slider.querySelectorAll('.client-logo');
            if(items.length === 0) return;

            let itemsPerView = 5;
            if (window.innerWidth <= 768) itemsPerView = 2;
            else if (window.innerWidth <= 992) itemsPerView = 3;

            const totalDots = Math.ceil(items.length / itemsPerView);
            
            for(let i=0; i<totalDots; i++) {
                const dot = document.createElement('div');
                dot.className = i === 0 ? 'clients-dot active' : 'clients-dot';
                dot.addEventListener('click', () => {
                    slider.scrollTo({ left: i * slider.clientWidth, behavior: 'smooth' });
                });
                pagination.appendChild(dot);
            }

            slider.addEventListener('scroll', () => {
                const scrollLeft = slider.scrollLeft;
                const activeIndex = Math.round(scrollLeft / slider.clientWidth);
                const dots = pagination.querySelectorAll('.clients-dot');
                dots.forEach((d, idx) => {
                    if (idx === activeIndex) d.classList.add('active');
                    else d.classList.remove('active');
                });
            });
            // Auto scroll logic
            let currentClientSlide = 0;
            let autoScrollInterval = setInterval(() => {
                currentClientSlide = (currentClientSlide + 1) % totalDots;
                slider.scrollTo({ left: currentClientSlide * slider.clientWidth, behavior: 'smooth' });
            }, 3000);

            // Pause on hover
            slider.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
            slider.addEventListener('mouseleave', () => {
                autoScrollInterval = setInterval(() => {
                    currentClientSlide = (currentClientSlide + 1) % totalDots;
                    slider.scrollTo({ left: currentClientSlide * slider.clientWidth, behavior: 'smooth' });
                }, 3000);
            });
        });
    </script>






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

<!-- Mengapa Memilih Kami / Features Section (Finanza Style) -->
<style>
    .fin-feature-section { padding: 100px 20px; font-family: 'Plus Jakarta Sans', sans-serif; background: #ffffff; }
    .fin-container { max-width: 1320px; margin: 0 auto; }
    .fin-row { display: flex; flex-wrap: wrap; margin: -20px; align-items: center; }
    .fin-col-6 { width: 50%; padding: 20px; box-sizing: border-box; }
    
    .fin-badge { display: inline-block; border: 1px solid #dee2e6; border-radius: 5px; color: #4B6BF5; font-weight: 600; padding: 5px 15px; margin-bottom: 20px; font-size: 14px; }
    .fin-heading { font-size: 40px; font-weight: 700; margin-bottom: 24px; color: #000000 !important; line-height: 1.2; }
    .fin-text { color: #6B7280; margin-bottom: 32px; line-height: 1.7; font-size: 16px; }
    .fin-btn { display: inline-block; background: #4B6BF5; color: #ffffff !important; padding: 16px 32px; border-radius: 5px; text-decoration: none; font-weight: 600; transition: background 0.3s, color 0.3s; }
    .fin-btn:hover { background: #3a56d4; color: #ffffff !important; }

    .fin-features-grid { display: flex; gap: 24px; align-items: center; }
    .fin-features-col { display: flex; flex-direction: column; gap: 24px; flex: 1; }

    .fin-feature-box { border: 1px solid #dee2e6; border-radius: 8px; padding: 40px 30px; background: #ffffff; transition: all 0.3s ease; height: auto; }
    .fin-feature-box:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.08); transform: translateY(-5px); border-color: #4B6BF5; }
    .fin-feature-box i.fa-3x { font-size: 48px; color: #4B6BF5; margin-bottom: 24px; display: block; }
    .fin-feature-box h4 { font-size: 22px; font-weight: 700; margin-bottom: 16px; color: #1F2937; }
    .fin-feature-box p { color: #6B7280; margin-bottom: 20px; font-size: 15px; line-height: 1.6; }
    .fin-feature-link { color: #4B6BF5; text-decoration: none; font-weight: 600; font-size: 15px; display: inline-flex; align-items: center; transition: color 0.3s; }
    .fin-feature-link i { margin-left: 8px; font-size: 12px; transition: transform 0.3s; color: inherit; display: inline; margin-bottom: 0; }
    .fin-feature-link:hover { color: #1F2937; }
    .fin-feature-link:hover i { transform: translateX(5px); }

    @media (max-width: 992px) {
        .fin-col-6 { width: 100%; }
        .fin-features-col:nth-child(2) { margin-top: 0; }
        .fin-features-grid { flex-direction: column; }
    }
</style>

<section class="fin-feature-section">
    <div class="fin-container">
        <div class="fin-row">
            <div class="fin-col-6" data-aos="fade-up" data-aos-delay="100">
                <p class="fin-badge">Mengapa Memilih Kami!</p>
                <h1 class="fin-heading">Beberapa Alasan Mengapa Anda Memilih Kami!</h1>
                <p class="fin-text">Lebih dari sekadar tempat kursus, Elcoding adalah Software House profesional yang menjembatani dunia pendidikan dan industri nyata. Kami memastikan setiap klien dan peserta didik mendapatkan kualitas terbaik yang relevan dengan kebutuhan pasar saat ini.</p>
                <a class="fin-btn" href="/tentang">Eksplorasi Lebih Lanjut</a>
            </div>
            <div class="fin-col-6" data-aos="fade-up" data-aos-delay="300">
                <div class="fin-features-grid">
                    <div class="fin-features-col">
                        <div class="fin-feature-box" data-aos="fade" data-aos-delay="100">
                            <i class="fa fa-user-tie fa-3x"></i>
                            <h4>Mentor Praktisi</h4>
                            <p>Belajar langsung dari pakar yang aktif mengerjakan proyek skala enterprise.</p>
                        </div>
                        <div class="fin-feature-box" data-aos="fade" data-aos-delay="300">
                            <i class="fa fa-laptop-code fa-3x"></i>
                            <h4>Fokus Praktik</h4>
                            <p>Kurikulum kami menuntut Anda mengerjakan studi kasus riil (80% praktik).</p>
                        </div>
                    </div>
                    <div class="fin-features-col">
                        <div class="fin-feature-box" data-aos="fade" data-aos-delay="500">
                            <i class="fa fa-building fa-3x"></i>
                            <h4>Standar Enterprise</h4>
                            <p>Rasakan workflow dan toolset yang digunakan software house modern sungguhan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Utama / Services Section (Finanza Style) -->
<style>
    .fin-service-section { padding: 100px 20px; font-family: 'Plus Jakarta Sans', sans-serif; background: #ffffff; }
    .fin-center-header { text-align: center; max-width: 600px; margin: 0 auto 60px; }
    
    .fin-service-layout { display: flex; gap: 40px; }
    .fin-service-nav { flex: 0 0 350px; display: flex; flex-direction: column; gap: 24px; }
    
    .fin-service-tab { background: transparent; border: 1px solid #dee2e6; padding: 24px; border-radius: 5px; cursor: pointer; display: flex; align-items: center; gap: 16px; transition: all 0.5s; text-align: left; width: 100%; color: #555555; }
    .fin-service-tab:hover { color: #355EFC; }
    .fin-service-tab:hover h5 { color: #355EFC; }
    .fin-service-tab.active { background: #355EFC !important; color: #ffffff !important; border-color: #355EFC !important; }
    .fin-service-tab.active h5 { color: #ffffff !important; }
    .fin-service-tab.active i { color: #ffffff !important; }
    .fin-service-tab i { color: #355EFC; font-size: 24px; transition: color 0.5s; width: 30px; text-align: center; }
    .fin-service-tab h5 { margin: 0; font-size: 18px; font-weight: 700; color: #555555; transition: color 0.5s; }

    .fin-service-content-wrapper { flex: 1; }
    .fin-service-pane { display: none; gap: 40px; animation: fadeInPane 0.5s ease forwards; }
    .fin-service-pane.active { display: flex; }
    @keyframes fadeInPane { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }

    .fin-service-img-col { flex: 1; position: relative; min-height: 400px; }
    .fin-service-img-col img { position: absolute; width: 100%; height: 100%; object-fit: cover; border-radius: 10px; box-shadow: 0 15px 30px rgba(0,0,0,0.05); }

    .fin-service-text-col { flex: 1; padding: 10px 0; display: flex; flex-direction: column; justify-content: center; }
    .fin-service-text-col h3 { font-size: 28px; font-weight: 700; margin-bottom: 24px; color: #1F2937; line-height: 1.3; }
    .fin-service-text-col p.desc { color: #6B7280; margin-bottom: 30px; line-height: 1.7; font-size: 16px; }
    .fin-service-check { display: flex; align-items: center; gap: 12px; color: #4B5563; margin-bottom: 16px; font-weight: 600; font-size: 15px; }
    .fin-service-check i { color: #4B6BF5; font-size: 16px; }
    
    .fin-service-readmore { margin-top: 30px; display: inline-block; background: #4B6BF5; color: #ffffff !important; padding: 16px 32px; border-radius: 5px; text-decoration: none; font-weight: 600; transition: background 0.3s, color 0.3s; align-self: flex-start; }
    .fin-service-readmore:hover { background: #3a56d4; color: #ffffff !important; }

    @media (max-width: 992px) {
        .fin-service-layout { flex-direction: column; }
        .fin-service-nav { flex: none; flex-direction: row; overflow-x: auto; padding-bottom: 10px; gap: 15px; }
        .fin-service-tab { flex: 0 0 280px; padding: 20px; }
        .fin-service-pane { flex-direction: column; gap: 30px; }
        .fin-service-img-col { min-height: 300px; position: static; }
        .fin-service-img-col img { position: static; height: 300px; }
    }
</style>

<section class="fin-service-section">
    <div class="fin-container">
        <div class="fin-center-header" data-aos="fade-up" data-aos-delay="100">
            <p class="fin-badge">Layanan Utama</p>
            <h1 class="fin-heading" style="font-size: 40px; margin-bottom: 0;">Solusi Layanan Digital Cerdas Untuk Anda</h1>
        </div>
        
        <div class="fin-service-layout" data-aos="fade-up" data-aos-delay="300">
            <div class="fin-service-nav">
                <button class="fin-service-tab active" data-target="service-tab-1">
                    <i class="fa fa-laptop-code"></i>
                    <h5>Software House</h5>
                </button>
                <button class="fin-service-tab" data-target="service-tab-2">
                    <i class="fa fa-chalkboard-teacher"></i>
                    <h5>Pelatihan & Kursus IT</h5>
                </button>
            </div>
            
            <div class="fin-service-content-wrapper">
                <!-- Tab 1 Content -->
                <div class="fin-service-pane active" id="service-tab-1">
                    <div class="fin-service-img-col">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800&q=80" alt="Software House">
                    </div>
                    <div class="fin-service-text-col">
                        <h3>Pengalaman Membangun Infrastruktur Digital Modern</h3>
                        <p class="desc">Jasa pembuatan aplikasi website, sistem informasi, dan mobile apps secara custom. Solusi IT cerdas yang disesuaikan dengan kebutuhan bisnis Anda, didukung dengan arsitektur modern dan keamanan terjamin.</p>
                        <div class="fin-service-check"><i class="fa fa-check"></i> Custom Web & Mobile Apps</div>
                        <div class="fin-service-check"><i class="fa fa-check"></i> Sistem Informasi Skala Enterprise</div>
                        <div class="fin-service-check"><i class="fa fa-check"></i> UI/UX Design Memukau</div>
                        <a href="/layanan" class="fin-service-readmore">Konsultasi Project</a>
                    </div>
                </div>
                
                <!-- Tab 2 Content -->
                <div class="fin-service-pane" id="service-tab-2">
                    <div class="fin-service-img-col">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80" alt="Pelatihan IT">
                    </div>
                    <div class="fin-service-text-col">
                        <h3>Mencetak Talenta Digital Berkualitas Tinggi</h3>
                        <p class="desc">Program bootcamp intensif bersertifikat. Dirancang khusus untuk membangun fondasi karir Anda di dunia teknologi dengan kurikulum berbasis praktik industri yang mutakhir. Bangun portofolio profesional Anda bersama ahlinya.</p>
                        <div class="fin-service-check"><i class="fa fa-check"></i> Kurikulum Berbasis Praktik Industri</div>
                        <div class="fin-service-check"><i class="fa fa-check"></i> Mentor Praktisi Profesional</div>
                        <div class="fin-service-check"><i class="fa fa-check"></i> Sertifikasi & Penyaluran Kerja</div>
                        <a href="/program-kursus" class="fin-service-readmore">Lihat Program</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.fin-service-tab');
        const panes = document.querySelectorAll('.fin-service-pane');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all
                tabs.forEach(t => t.classList.remove('active'));
                panes.forEach(p => p.classList.remove('active'));
                
                // Add active class to clicked tab
                tab.classList.add('active');
                
                // Show corresponding pane
                const targetId = tab.getAttribute('data-target');
                document.getElementById(targetId).classList.add('active');
            });
        });
    });
</script>


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
                <div class="program-card {{ $bgClass }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
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
        .programs-section { padding: 80px 20px; background-color: #ffffff; font-family: 'Plus Jakarta Sans', sans-serif; }
        .programs-container { max-width: 1200px; margin: 0 auto; }
        .programs-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
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
        <div class="statistics-cta-container" data-aos="fade-up">
            <!-- Top: CTA -->
            <div class="cta-content">
                <h2 class="cta-title">Siap Memulai Proyek atau Karir Anda?</h2>
                <p class="cta-text">Berikan solusi digital terbaik untuk bisnis Anda, atau pelajari skill coding untuk meraih karir impian. Mari bergabung dan bertumbuh bersama Elcoding.</p>
                <div class="elementor-element elementor-element-3205b82 elementor-align-center elementor-widget elementor-widget-button" data-id="3205b82" data-element_type="widget" data-e-type="widget" data-widget_type="button.default">
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
    <section class="presento-portfolio-section" id="Portofolio">
        <div class="presento-portfolio-header">
            <h2>Portofolio</h2>
        </div>
        
        @php
            $portfolioCategories = $portofolios->pluck('category')->unique();
        @endphp
        
        <ul class="presento-portfolio-filter">
            <li class="filter-active" data-filter="all">All</li>
            @foreach($portfolioCategories as $cat)
                @if($cat)
                    <li data-filter="{{ Str::slug($cat) }}">{{ $cat }}</li>
                @endif
            @endforeach
        </ul>

        <div class="presento-portfolio-grid">
            @foreach($portofolios as $portofolio)
            <div class="presento-portfolio-item" data-category="{{ Str::slug($portofolio->category) }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <img src="{{ asset($portofolio->image_path ?? 'assets/wp-content/uploads/2026/02/Garap-Edu.webp') }}" alt="{{ $portofolio->title }}" loading="lazy">
                
                <div class="portfolio-links">
                    <a href="{{ url('/portofolio/' . $portofolio->id) }}" title="More Details"><i class="fas fa-link"></i></a>
                    @if($portofolio->url)
                        <a href="{{ $portofolio->url }}" target="_blank" rel="noopener noreferrer" title="Web"><i class="fas fa-external-link-alt"></i></a>
                    @endif
                </div>
                
                <div class="portfolio-info-overlay">
                    <h4>{{ $portofolio->title }}</h4>
                    <p>{{ $portofolio->category }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <style>
    .presento-portfolio-section { padding: 80px 0; background: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
    .presento-portfolio-header { text-align: center; margin-bottom: 20px; padding: 0 20px; }
    .presento-portfolio-header h2 { font-size: 32px; font-weight: 800; color: #1F2937; line-height: 1.2; margin: 0; }

    .presento-portfolio-filter { list-style: none; padding: 0; margin: 0 auto 40px auto; text-align: center; }
    .presento-portfolio-filter li { cursor: pointer; display: inline-block; padding: 10px 15px; font-size: 15px; font-weight: 600; color: #444; transition: all 0.3s ease; text-transform: capitalize; margin: 0 5px; }
    .presento-portfolio-filter li:hover, .presento-portfolio-filter li.filter-active { color: #4B6BF5; }

    .presento-portfolio-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; padding: 0 20px; }
    .presento-portfolio-item { position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: opacity 0.3s ease; }
    .presento-portfolio-item img { width: 100%; height: 100%; object-fit: cover; aspect-ratio: 4/3; transition: all 0.3s ease; display: block; }

    .presento-portfolio-item .portfolio-info-overlay { opacity: 0; position: absolute; bottom: -20px; left: 0; right: 0; text-align: center; z-index: 3; transition: all 0.3s ease; padding: 15px; background: rgba(255,255,255,0.95); }
    .presento-portfolio-item:hover .portfolio-info-overlay { opacity: 1; bottom: 0; }
    .presento-portfolio-item .portfolio-info-overlay h4 { font-size: 18px; color: #111; font-weight: 700; margin-bottom: 5px; }
    .presento-portfolio-item .portfolio-info-overlay p { color: #4B6BF5; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase; }

    .presento-portfolio-item .portfolio-links { opacity: 0; position: absolute; top: 50%; left: 0; right: 0; text-align: center; z-index: 3; transition: all 0.3s ease; transform: translateY(-50%); }
    .presento-portfolio-item:hover .portfolio-links { opacity: 1; }
    .presento-portfolio-item .portfolio-links a { color: #fff; background: #4B6BF5; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; margin: 0 4px; font-size: 16px; transition: 0.3s; text-decoration: none; }
    .presento-portfolio-item .portfolio-links a:hover { background: #1a202c; }
    
    .presento-portfolio-item:hover img { transform: scale(1.1); }
    .presento-portfolio-item::before { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0.4); opacity: 0; transition: all 0.3s ease; z-index: 2; pointer-events: none; }
    .presento-portfolio-item:hover::before { opacity: 1; }

    @media (max-width: 992px) { .presento-portfolio-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; } }
    @media (max-width: 768px) { .presento-portfolio-grid { grid-template-columns: 1fr; gap: 20px; } }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('.presento-portfolio-filter li');
        const items = document.querySelectorAll('.presento-portfolio-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function() {
                filters.forEach(f => f.classList.remove('filter-active'));
                this.classList.add('filter-active');

                const filterValue = this.getAttribute('data-filter');

                items.forEach(item => {
                    if(filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        setTimeout(() => item.style.opacity = '1', 50);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => item.style.display = 'none', 300);
                    }
                });
            });
        });
    });
    </script>
    @endif

    @if(isset($artikels) && $artikels->count() > 0)
    <!-- Blog Section -->
    <section class="blog-section">
        <div class="blog-container">
            <div class="blog-header">
                <h2 class="blog-title">Blog</h2>
            </div>
            
            <div class="blog-grid" data-aos="fade-up">
                @foreach($artikels as $artikel)
                <div class="ve-insight-card" draggable="false">
                    @php 
                        $images = ['Magang-Online.webp', 'Skill-Lab.webp', 'Magang-Mahasiswa.webp'];
                        $randomImg = $images[$artikel->id % 3];
                        $bgImage = $artikel->image_path ? asset($artikel->image_path) : asset('assets/wp-content/uploads/2026/02/'.$randomImg);
                        $catName = $artikel->category ?: 'Update';
                    @endphp
                    <div class="ve-insight-img" style="background-image:url('{{ $bgImage }}');"></div>
                    <div class="ve-insight-body">
                        <span class="ve-insight-cat">{{ $catName }}</span>
                        <h5><a href="{{ url('/blog/' . $artikel->id) }}">{{ Str::limit($artikel->title, 55) }}</a></h5>
                        <p>{{ Str::limit(strip_tags($artikel->content ?? 'Blog informatif dari Elcoding membahas berbagai topik seputar teknologi, pemrograman, dan dunia digital...'), 90) }}</p>
                        <div class="ve-insight-meta">
                            <span><i class="far fa-calendar-alt"></i> {{ $artikel->published_at ? \Carbon\Carbon::parse($artikel->published_at)->format('F d, Y') : $artikel->created_at->format('F d, Y') }}</span>
                            <a href="{{ url('/blog/' . $artikel->id) }}" style="color:#4B6BF5; font-size:14px; font-weight:600; text-decoration:none;">Baca <i class="fas fa-arrow-right" style="margin-left:5px;"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
    .blog-section { padding: 0 0 40px 0; background: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
    .blog-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .blog-header { text-align: center; margin-bottom: 30px; }
    .blog-subtitle { display: inline-block; color: #4B6BF5; font-size: 14px; font-weight: 700; text-transform: uppercase; background: #EDE9FE; padding: 8px 16px; border-radius: 50px; margin-bottom: 15px; letter-spacing: 1px; }
    .blog-title { font-size: 32px; font-weight: 800; color: #1F2937; line-height: 1.2; margin: 0; }
    .blog-grid { display: flex; gap: 30px; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 20px; scrollbar-width: none; }
    .blog-grid::-webkit-scrollbar { display: none; }
    
    .ve-insight-card {
        flex: 0 0 calc(33.333% - 20px);
        scroll-snap-align: start;
        background-color: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
        transition: all 0.3s;
    }
    .ve-insight-card:hover { box-shadow: 0 5px 20px rgba(0,0,0,0.05); transform: translateY(-5px); }
    
    .ve-insight-img { aspect-ratio: 4/3; width: 100%; background-size: cover; background-position: center; }
    .ve-insight-body { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; text-align: left; }
    .ve-insight-cat { display: inline-block; align-self: flex-start; padding: 5px 12px; background-color: #e5f3f3; color: #4B6BF5; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border-radius: 4px; margin-bottom: 15px; }
    .ve-insight-body h5 { font-size: 20px; font-weight: 700; margin-bottom: 15px; line-height: 1.4; }
    .ve-insight-body h5 a { color: #1a202c; text-decoration: none; transition: 0.3s; }
    .ve-insight-body h5 a:hover { color: #4B6BF5; }
    .ve-insight-body p { color: #64748b; font-size: 14px; line-height: 1.7; margin-bottom: 25px; flex-grow: 1; }
    .ve-insight-meta { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 15px; margin-top: auto; }
    .ve-insight-meta span { color: #94a3b8; font-size: 13px; }
    .ve-insight-meta span i { margin-right: 5px; }
    
    @media (max-width: 992px) { .ve-insight-card { flex: 0 0 calc(50% - 15px); } }
    @media (max-width: 768px) { 
        .ve-insight-card { flex: 0 0 100%; } 
        .blog-title { font-size: 28px; }
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
                    <div class="ts-slide" data-aos="fade-up">
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
                    <div class="ts-slide" data-aos="fade-up">
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
                    <div class="ts-slide" data-aos="fade-up">
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

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
    });
</script>
@endpush

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "LocalBusiness",
  "name": "Elcoding Academy",
  "image": "{{ asset('gambar/aset/logo-elcoding.png') }}",
  "@@id": "{{ url('/') }}",
  "url": "{{ url('/') }}",
  "telephone": "+6281476652656, +6287762334232",
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
