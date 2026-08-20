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
        .hero-section {
            position: relative;
            padding: 140px 20px 100px;
            text-align: center;
            background-color: #0f172a;
            background-image: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.95)), url('{{ asset("gambar/aset/ilustrasi-belajar.jpg") }}');
            background-size: cover;
            background-position: center;
            color: white;
            margin-top: -80px; /* Adjust based on navbar height to reach the top */
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 8px 18px;
            border-radius: 50px;
            margin-bottom: 30px;
            font-size: 14px;
            font-weight: 600;
            color: #f97316; /* Orange color */
            backdrop-filter: blur(4px);
        }
        .hero-badge i {
            color: #d1d5db;
        }
        .hero-title-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
            max-width: 1000px;
            margin-left: auto;
            margin-right: auto;
        }
        .hero-title-brace {
            font-size: 100px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.15);
            line-height: 1;
            margin: 0 15px;
            font-family: monospace;
            user-select: none;
        }
        .hero-title {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.25;
            color: #ffffff;
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .hero-subtitle {
            max-width: 650px;
            margin: 0 auto 40px;
            font-size: 16px;
            line-height: 1.6;
            color: #9ca3af;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .btn-hero-primary {
            background-color: #a5b4fc; /* light blue */
            color: #1e3a8a;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }
        .btn-hero-primary:hover {
            background-color: #c7d2fe;
            transform: translateY(-2px);
            color: #1e3a8a;
            box-shadow: 0 10px 25px rgba(165, 180, 252, 0.2);
        }
        .btn-hero-secondary {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            font-weight: 600;
            font-family: 'Plus Jakarta Sans', sans-serif;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }
        .btn-hero-secondary:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            color: #ffffff;
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 32px;
            }
            .hero-title-brace {
                font-size: 60px;
                margin: 0 8px;
            }
            .hero-subtitle {
                font-size: 15px;
                padding: 0 15px;
            }
            .hero-section {
                padding: 120px 15px 60px;
            }
            .btn-hero-primary, .btn-hero-secondary {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>

    <section class="hero-section">
        <div class="hero-badge">
            <i class="fas fa-laptop-code"></i> Akademi Coding & Transformasi Digital #1
        </div>
        
        <div class="hero-title-container">
            <span class="hero-title-brace">{</span>
            <h1 class="hero-title">Software House Profesional &<br>Pusat Pelatihan IT Terbaik</h1>
            <span class="hero-title-brace">}</span>
        </div>
        
        <p class="hero-subtitle">
            Elcoding adalah mitra terpercaya anda, menyediakan jasa pembuatan websit&aplikasi(Software House) untuk digitalisasi bisnis.
        </p>
        
        <div class="hero-buttons">
            <a href="https://wa.me/6281476652656?text=Halo%20Admin%20Elcoding,%20saya%20tertarik%20dengan%20jasa%20pembuatan%20aplikasi/website%20dan%20ingin%20berkonsultasi." target="_blank" class="btn-hero-primary">
                Buat Aplikasi
            </a>
            <a href="/program-kursus" class="btn-hero-secondary">
                Daftar Kursus <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- Tentang Elcoding Section -->
    <style>
        .tentang-section {
            padding: 80px 20px;
            background-color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .tentang-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 60px;
        }
        .tentang-left {
            flex: 1;
            max-width: 500px;
        }
        .tentang-subtitle {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #3b82f6; /* blue-500 */
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .tentang-subtitle::before {
            content: "";
            display: block;
            width: 40px;
            height: 1px;
            background-color: #93c5fd; /* blue-300 */
        }
        .tentang-title {
            font-size: 32px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 30px;
        }
        .tentang-code-block {
            background-color: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            padding: 24px;
            font-family: 'Fira Code', 'Courier New', Courier, monospace;
            font-size: 14px;
            color: #475569;
            line-height: 1.6;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }
        .tentang-right {
            flex: 1.2;
            display: flex;
            gap: 20px;
            justify-content: flex-end;
        }
        .tentang-card {
            background-color: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            padding: 30px 20px;
            width: 190px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        .tentang-card:hover {
            transform: translateY(-5px);
        }
        .tentang-card.glow-card {
            background: radial-gradient(circle at bottom right, #ffedd5 0%, #ffffff 70%);
            border: 1px solid #ffedd5;
        }
        .tentang-card-icon {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .icon-blue { color: #3b82f6; }
        .icon-orange { color: #f97316; }
        .tentang-card-value {
            font-size: 36px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
            margin-bottom: 12px;
            word-break: break-word;
        }
        .tentang-card-label {
            font-size: 14px;
            color: #64748b;
            line-height: 1.4;
            font-weight: 500;
        }
        
        @media (max-width: 1024px) {
            .tentang-container {
                flex-direction: column;
                gap: 40px;
            }
            .tentang-left, .tentang-right {
                flex: none;
                width: 100%;
                max-width: 100%;
                justify-content: center;
            }
        }
        @media (max-width: 768px) {
            .tentang-title { font-size: 26px; }
            .tentang-right {
                flex-wrap: wrap;
            }
            .tentang-card {
                width: calc(50% - 10px);
                padding: 24px 16px;
            }
            .tentang-card-value { font-size: 28px; }
        }
        @media (max-width: 480px) {
            .tentang-card {
                width: 100%;
            }
        }
    </style>

    <section class="tentang-section">
        <div class="tentang-container">
            <div class="tentang-left">
                <div class="tentang-subtitle">TENTANG ELCODING</div>
                <h2 class="tentang-title">Mencetak ribuan developer siap kerja dan mentransformasi puluhan infrastruktur digital enterprise.</h2>
                <div class="tentang-code-block">
                    &gt; sys.initialize({<br>
                    &nbsp;&nbsp;mode: 'production',<br>
                    &nbsp;&nbsp;target: 'excellence'<br>
                    });
                </div>
            </div>
            <div class="tentang-right">
                <div class="tentang-card">
                    <div class="tentang-card-icon icon-blue"><i class="fas fa-graduation-cap"></i></div>
                    <div class="tentang-card-value">&gt;1.500+</div>
                    <div class="tentang-card-label">Alumni Sukses Bekerja</div>
                </div>
                <div class="tentang-card">
                    <div class="tentang-card-icon icon-blue"><i class="fas fa-check-circle"></i></div>
                    <div class="tentang-card-value">&gt;96%</div>
                    <div class="tentang-card-label">Tingkat Kelulusan</div>
                </div>
                <div class="tentang-card glow-card">
                    <div class="tentang-card-icon icon-orange"><i class="fas fa-rocket"></i></div>
                    <div class="tentang-card-value">&gt;120+</div>
                    <div class="tentang-card-label">Proyek Enterprise</div>
                </div>
            </div>
        </div>
    </section>

    <x-mitra />
<!-- Layanan Utama Section -->
<style>
    .services-section {
        padding: 0 20px 60px;
        background-color: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .services-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    .section-title {
        font-size: 36px;
        font-weight: 800;
        color: #222222;
        margin-bottom: 16px;
    }
    .section-subtitle {
        font-size: 16px;
        color: #666666;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }
    .services-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }
    @media (min-width: 768px) {
        .services-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 767px) {
        .services-section { padding: 0 16px 48px; }
        .section-title { font-size: 28px; }
        .section-header { margin-bottom: 40px; }
        .service-card { padding: 24px; }
    }
    
    .service-card {
        background: #ffffff;
        border: 1px solid transparent;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.06);
        border-color: rgba(109, 40, 217, 0.1);
    }
    
    .service-icon {
        font-size: 40px;
        color: #000000;
        margin-bottom: 24px;
    }
    .service-card h3 {
        font-size: 22px;
        font-weight: 700;
        color: #222222;
        margin-bottom: 16px;
    }
    .service-card p {
        font-size: 15px;
        color: #666666;
        line-height: 1.6;
        margin-bottom: 24px;
    }
    .service-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #20689b;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        transition: gap 0.3s ease;
    }
    .service-link:hover {
        gap: 12px;
        text-decoration: none;
    }
</style>

<section class="services-section">
    <div class="services-container">
        <div class="section-header">
            <h2 class="section-title">Layanan Utama Kami</h2>
            <p class="section-subtitle">Solusi digital komprehensif mulai dari pelatihan SDM hingga pengembangan sistem skala enterprise.</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-code-branch service-icon"></i>
                <h3>Software House</h3>
                <p>Jasa pembuatan aplikasi website, sistem informasi, dan mobile apps secara custom untuk kebutuhan digitalisasi bisnis instansi Anda.</p>
                <a href="/kontak" class="service-link">Konsultasi Project <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card">
                <i class="fas fa-graduation-cap service-icon"></i>
                <h3>Pelatihan & Kursus IT</h3>
                <p>Program bootcamp intensif bersertifikat. Dirancang untuk membangun fondasi karir di industri teknologi digital dengan kurikulum terstruktur.</p>
                <a href="/program-kursus" class="service-link">Lihat Program <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Mengapa Memilih Kami Section -->
<style>
    .why-us-section {
        padding: 60px 20px 80px;
        background-color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .why-us-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    .why-us-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }
    @media (min-width: 768px) {
        .why-us-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (min-width: 1024px) {
        .why-us-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 767px) {
        .why-us-section { padding: 48px 16px 64px; }
        .why-us-card { padding: 24px 20px; }
    }
    
    .why-us-card {
        background: #ffffff;
        border: 1px solid #f0f0f0;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .why-us-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.06);
        border-color: rgba(32, 104, 155, 0.1);
    }
    
    .why-us-icon {
        width: 70px;
        height: 70px;
        background: #eef6fc;
        color: #20689b;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 24px auto;
        transition: all 0.3s ease;
    }
    .why-us-card:hover .why-us-icon {
        background: #20689b;
        color: #ffffff;
    }
    
    .why-us-card h3 {
        font-size: 18px;
        font-weight: 700;
        color: #222222;
        margin-bottom: 12px;
    }
    .why-us-card p {
        font-size: 14px;
        color: #666666;
        line-height: 1.6;
        margin: 0;
    }
</style>

<section class="why-us-section">
    <div class="why-us-container">
        <div class="section-header">
            <h2 class="section-title">Mengapa Memilih Kami?</h2>
            <p class="section-subtitle">Lebih dari sekadar tempat kursus, Elcoding adalah Software House profesional yang menjembatani dunia pendidikan dan industri nyata. Temukan alasan mengapa ratusan siswa dan mitra bisnis mempercayakan solusi IT mereka kepada kami.</p>
        </div>
        
        <div class="why-us-grid">
            <div class="why-us-card">
                <div class="why-us-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                <h3>Mentor Praktisi</h3>
                <p>Belajar langsung dari praktisi profesional yang aktif di industri teknologi.</p>
            </div>
            <div class="why-us-card">
                <div class="why-us-icon"><i class="fas fa-laptop-code"></i></div>
                <h3>Fokus Praktik & Proyek</h3>
                <p>Kurikulum berbasis 80% praktik nyata untuk membangun portofolio aplikasi dan insting problem-solving.</p>
            </div>
            <div class="why-us-card">
                <div class="why-us-icon"><i class="fas fa-building"></i></div>
                <h3>Standar Software House</h3>
                <p>Rasakan pengalaman bekerja dengan standar industri melalui ekosistem pengembangan perangkat lunak kami yang sesungguhnya.</p>
            </div>
            <div class="why-us-card">
                <div class="why-us-icon"><i class="fas fa-briefcase"></i></div>
                <h3>Penyaluran Kerja</h3>
                <p>Akses ke jaringan mitra perusahaan kami untuk peluang karir nyata setelah Anda lulus.</p>
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
            background: linear-gradient(to bottom, rgba(37, 99, 235, 0.85), rgba(37, 99, 235, 0.95)) !important;
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
        .programs-container { max-width: 1200px; margin: 0 auto; }
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

    <!-- Testimonial Section -->
    <section class="testimonial-section">
        <div class="testimonial-container">
            <div class="testimonial-header">
                <h2 class="testimonial-title">Testimoni</h2>
            </div>
            
            <div class="testimonial-grid">
                <div class="testimonial-card" style="padding: 0; border: none; background: transparent; box-shadow: none;">
                    <img src="{{ asset('assets/wp-content/uploads/2026/02/testimoni-1.jpg') }}" alt="Testimoni Afif" loading="lazy" style="width: 100%; aspect-ratio: 3/4; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                </div>
                <div class="testimonial-card" style="padding: 0; border: none; background: transparent; box-shadow: none;">
                    <img src="{{ asset('assets/wp-content/uploads/2026/02/testimoni-2.jpg') }}" alt="Testimoni Risqi" loading="lazy" style="width: 100%; aspect-ratio: 3/4; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                </div>
                <div class="testimonial-card" style="padding: 0; border: none; background: transparent; box-shadow: none;">
                    <img src="{{ asset('assets/wp-content/uploads/2026/02/testimoni-3.jpg') }}" alt="Testimoni Josias" loading="lazy" style="width: 100%; aspect-ratio: 3/4; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                </div>
            </div>
        </div>
    </section>

    <style>
    .testimonial-section { padding: 0 0 80px 0; background: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
    .testimonial-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .testimonial-header { text-align: center; margin-bottom: 50px; }
    .testimonial-subtitle { display: inline-block; color: #20689b; font-size: 14px; font-weight: 700; text-transform: uppercase; background: #EDE9FE; padding: 8px 16px; border-radius: 50px; margin-bottom: 15px; letter-spacing: 1px; }
    .testimonial-title { font-size: 38px; font-weight: 800; color: #1F2937; line-height: 1.2; margin: 0; }
    .testimonial-grid { display: flex; gap: 30px; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 20px; scrollbar-width: none; }
    .testimonial-grid::-webkit-scrollbar { display: none; }
    .testimonial-card { flex: 0 0 calc(33.333% - 20px); scroll-snap-align: start; display: flex; flex-direction: column; background: #fff; border: 1px solid #f0f0f0; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); user-select: none; }
    .testimonial-text { font-size: 14px; color: #444; line-height: 1.6; margin-bottom: 15px; flex-grow: 1; }
    .testimonial-rating { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
    .testimonial-rating .stars { color: #FFC107; font-size: 16px; letter-spacing: 2px; }
    .testimonial-rating .rating-text { font-size: 13px; color: #666; font-weight: bold; }
    .testimonial-author { display: flex; align-items: center; gap: 15px; }
    .testimonial-author img { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 1px solid #eee; }
    .testimonial-author h4 { font-size: 15px; font-weight: 700; color: #1F2937; margin: 0 0 4px 0; }
    .testimonial-author p { font-size: 13px; color: #666; margin: 0; }
    @media (max-width: 992px) { .testimonial-card { flex: 0 0 calc(50% - 15px); } }
    @media (max-width: 768px) { 
        .testimonial-card { flex: 0 0 100%; padding: 20px; } 
        .testimonial-title { font-size: 28px; } 
        .testimonial-section { padding: 0 0 48px 0; }
    }
    </style>

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
        background-color: #20689b; 
        background-image: linear-gradient(to bottom, rgba(37, 99, 235, 0.85), rgba(37, 99, 235, 0.95)), url('{{ asset("gambar/aset/ilustrasi-belajar.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        margin-bottom: 50px; 
    }
    .statistics-cta-container { max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; }
    
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
                        @php $catColor = $kategoriColors[$portofolio->category] ?? '#20689b'; @endphp
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
    .portfolio-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
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
    .porto-btn-detail { background: #20689b; color: #fff !important; }
    .porto-btn-detail:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37,99,235,0.35); }
    .porto-btn-url { background: transparent; color: #20689b !important; border: 1.5px solid #20689b; }
    .porto-btn-url:hover { background: #20689b; color: #fff !important; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37,99,235,0.25); }
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
                <h2 class="blog-title">Artikel</h2>
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
                        <p>{{ Str::limit(strip_tags($artikel->content ?? 'Artikel informatif dari Elcoding membahas berbagai topik seputar teknologi, pemrograman, dan dunia digital...'), 120) }}</p>
                        <a href="{{ url('/artikel/' . $artikel->id) }}" class="blog-btn">BACA ARTIKEL</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
    .blog-section { padding: 0 0 40px 0; background: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
    .blog-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
    .blog-header { text-align: center; margin-bottom: 50px; }
    .blog-subtitle { display: inline-block; color: #20689b; font-size: 14px; font-weight: 700; text-transform: uppercase; background: #EDE9FE; padding: 8px 16px; border-radius: 50px; margin-bottom: 15px; letter-spacing: 1px; }
    .blog-title { font-size: 38px; font-weight: 800; color: #1F2937; line-height: 1.2; margin: 0; }
    .blog-grid { display: flex; gap: 30px; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 20px; scrollbar-width: none; }
    .blog-grid::-webkit-scrollbar { display: none; }
    .blog-card { flex: 0 0 calc(33.333% - 20px); scroll-snap-align: start; display: flex; flex-direction: column; background: #fff; border: 1px solid #f0f0f0; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .blog-img { width: 100%; aspect-ratio: 16/9; object-fit: cover; border-bottom: 1px solid #f0f0f0; display: block; }
    .blog-content { padding: 30px; display: flex; flex-direction: column; flex-grow: 1; }
    .blog-content h4 { font-size: 20px; font-weight: 700; line-height: 1.4; margin: 0 0 15px 0; }
    .blog-content h4 a { color: #1F2937; text-decoration: none; transition: color 0.3s ease; }
    .blog-content h4 a:hover { color: #20689b; }
    .blog-meta { font-size: 13px; color: #000000; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; font-weight: 500; }
    .blog-content p { font-size: 14px; color: #666; line-height: 1.6; margin: 0 0 25px 0; flex-grow: 1; }
    .blog-btn { display: inline-block; align-self: flex-start; background: #20689b; color: #fff !important; font-size: 13px; font-weight: 600; text-transform: uppercase; text-decoration: none; padding: 12px 25px; border-radius: 50px; transition: all 0.3s ease; }
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
