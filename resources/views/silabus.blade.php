<x-layout title="Silabus Lengkap: Full Stack Web Development">
    @push('styles')
    <style>
        /* Silabus Custom Styling */
        .silabus-hero {
            background: linear-gradient(135deg, #1d667f 0%, #132252 100%);
            color: #ffffff;
            padding: 60px 20px 90px;
            position: relative;
            overflow: hidden;
        }

        .silabus-hero::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        .silabus-hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* Breadcrumbs */
        .silabus-breadcrumbs {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .silabus-breadcrumbs a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .silabus-breadcrumbs a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .silabus-breadcrumbs span.separator {
            color: rgba(255, 255, 255, 0.4);
        }

        .silabus-breadcrumbs span.active {
            color: #ffffff;
            font-weight: 600;
        }

        /* Hero Pill Badge */
        .silabus-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(139, 92, 246, 0.3);
            border: 1px solid rgba(167, 139, 250, 0.5);
            color: #e9d5ff;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
            backdrop-filter: blur(8px);
        }

        .silabus-hero-title {
            font-size: 38px;
            font-weight: 800;
            color: #ffffff;
            margin: 0 0 16px;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .silabus-hero-subtitle {
            font-size: 17px;
            color: rgba(255, 255, 255, 0.85);
            max-width: 820px;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        /* Stat Pills */
        .silabus-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .silabus-pill-item {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .silabus-pill-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .silabus-pill-item i {
            color: #38bdf8;
            font-size: 16px;
        }

        /* Main Container */
        .silabus-body-container {
            max-width: 1200px;
            margin: -40px auto 90px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .silabus-layout-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 36px;
            align-items: start;
        }

        /* Left Content: Detail Kurikulum */
        .silabus-main-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .silabus-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 2px solid #f1f5f9;
        }

        .silabus-section-heading {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .silabus-badge-count {
            background: #f1f5f9;
            color: #475569;
            font-size: 13px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 30px;
            border: 1px solid #cbd5e1;
        }

        /* Accordion Styling */
        .accordion-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .accordion-item {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .accordion-item.active {
            border-color: #38bdf8;
            box-shadow: 0 8px 25px rgba(14, 165, 233, 0.08);
        }

        .accordion-header {
            width: 100%;
            padding: 22px 24px;
            background: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            text-align: left;
            transition: background-color 0.2s ease;
        }

        .accordion-header:hover {
            background-color: #f8fafc;
        }

        .accordion-header-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .module-avatar {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #e0f2fe;
            color: #0284c7;
            font-size: 16px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .accordion-item.active .module-avatar {
            background: #0284c7;
            color: #ffffff;
        }

        .module-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .module-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            line-height: 1.3;
        }

        .module-meta {
            font-size: 13px;
            color: #64748b;
            margin: 0;
        }

        .accordion-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: transform 0.3s ease, background 0.3s ease, color 0.3s ease;
            flex-shrink: 0;
        }

        .accordion-item.active .accordion-icon {
            transform: rotate(180deg);
            background: #e0f2fe;
            color: #0284c7;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fafafa;
        }

        .accordion-item.active .accordion-content {
            border-top: 1px solid #f1f5f9;
        }

        .sub-topics-list {
            padding: 20px 24px 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .sub-topic-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: #ffffff;
            padding: 16px 20px;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
        }

        .sub-topic-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #dcfce7;
            color: #16a34a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .sub-topic-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 4px;
        }

        .sub-topic-desc {
            font-size: 13px;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }

        /* Right Sidebar Component */
        .silabus-sidebar {
            display: flex;
            flex-direction: flex-start;
            flex-direction: column;
            gap: 24px;
            position: sticky;
            top: 100px;
        }

        /* Testimonial Card */
        .testimonial-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 28px;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .testimonial-profile {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 18px;
        }

        .testimonial-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #0284c7;
        }

        .testimonial-info h4 {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 2px;
        }

        .testimonial-info p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
            line-height: 1.3;
        }

        .testimonial-quote {
            font-size: 14px;
            font-style: italic;
            color: #334155;
            line-height: 1.6;
            margin: 0;
            position: relative;
        }

        .testimonial-quote::before {
            content: "“";
            font-size: 32px;
            color: #0284c7;
            font-family: Georgia, serif;
            line-height: 0;
            position: relative;
            top: 8px;
            margin-right: 4px;
        }

        /* CTA Enrollment Box */
        .silabus-cta-card {
            background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
            border-radius: 20px;
            padding: 28px;
            border: 1px solid #bae6fd;
            box-shadow: 0 10px 25px rgba(2, 132, 199, 0.08);
        }

        .cta-header-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 8px;
        }

        .cta-header-desc {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 20px;
            line-height: 1.5;
        }

        .btn-register-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: #1d667f;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            padding: 14px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(29, 102, 127, 0.3);
            border: none;
            margin-bottom: 12px;
        }

        .btn-register-primary:hover {
            background: #14495c;
            transform: translateY(-2px);
        }

        .btn-whatsapp-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: #ffffff;
            color: #16a34a !important;
            font-weight: 700;
            font-size: 14px;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid #22c55e;
        }

        .btn-whatsapp-secondary:hover {
            background: #f0fdf4;
            transform: translateY(-2px);
        }

        /* Responsive Breakpoints */
        @media (max-width: 1024px) {
            .silabus-layout-grid {
                grid-template-columns: 1fr;
            }
            .silabus-sidebar {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .silabus-hero {
                padding: 40px 16px 70px;
            }
            .silabus-hero-title {
                font-size: 28px;
            }
            .silabus-hero-subtitle {
                font-size: 15px;
            }
            .silabus-main-card {
                padding: 24px 16px;
            }
            .accordion-header {
                padding: 16px;
            }
            .module-title {
                font-size: 16px;
            }
            .sub-topics-list {
                padding: 16px;
            }
        }
    </style>
    @endpush

    <!-- Hero Section -->
    <div class="silabus-hero">
        <div class="silabus-hero-inner">
            <!-- Breadcrumbs -->
            <nav class="silabus-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="separator">></span>
                <a href="{{ url('/program-kursus') }}">Program Kursus</a>
                <span class="separator">></span>
                <a href="{{ url('/program-kursus') }}">Full Stack Web Dev</a>
                <span class="separator">></span>
                <span class="active" aria-current="page">Silabus</span>
            </nav>

            <!-- Hero Badge -->
            <div class="silabus-badge">
                <i class="fas fa-bolt text-yellow-400"></i> Bootcamp Intensif
            </div>

            <!-- Title & Subtitle -->
            <h1 class="silabus-hero-title">Silabus Lengkap: Full Stack Web Development</h1>
            <p class="silabus-hero-subtitle">
                Kurikulum berbasis industri yang dirancang untuk membekali Anda dengan keterampilan end-to-end, dari merancang antarmuka hingga mengelola arsitektur server yang skalabel.
            </p>

            <!-- Stat Pills -->
            <div class="silabus-pills">
                <div class="silabus-pill-item">
                    <i class="far fa-clock"></i> 12 Minggu Pembelajaran
                </div>
                <div class="silabus-pill-item">
                    <i class="fas fa-bullseye"></i> Pemula ke Mahir
                </div>
                <div class="silabus-pill-item">
                    <i class="fas fa-code"></i> 5 Real-world Projects
                </div>
                <div class="silabus-pill-item">
                    <i class="fas fa-award"></i> Sertifikat Resmi
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="silabus-body-container">
        <div class="silabus-layout-grid">

            <!-- Left Main Column: Detail Kurikulum -->
            <div class="silabus-main-card">
                <div class="silabus-header-bar">
                    <h2 class="silabus-section-heading">Detail Kurikulum</h2>
                    <span class="silabus-badge-count">5 Modul Utama</span>
                </div>

                <div class="accordion-list" id="curriculumAccordion">
                    
                    <!-- Modul 1 -->
                    <div class="accordion-item active" id="module-1">
                        <button class="accordion-header" onclick="toggleAccordion('module-1')">
                            <div class="accordion-header-left">
                                <div class="module-avatar">M1</div>
                                <div class="module-info">
                                    <h3 class="module-title">Frontend Foundations</h3>
                                    <p class="module-meta">Minggu 1-2 • Membangun fondasi solid antarmuka web modern.</p>
                                </div>
                            </div>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="sub-topics-list">
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">HTML5 & Semantik Web</h4>
                                        <p class="sub-topic-desc">Struktur dokumen, form, dan aksesibilitas dasar.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">CSS3 & Layout Modern</h4>
                                        <p class="sub-topic-desc">Flexbox, CSS Grid, animasi, dan prinsip desain responsif.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">Pengenalan Version Control</h4>
                                        <p class="sub-topic-desc">Dasar-dasar Git, alur kerja GitHub, dan kolaborasi tim.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modul 2 -->
                    <div class="accordion-item" id="module-2">
                        <button class="accordion-header" onclick="toggleAccordion('module-2')">
                            <div class="accordion-header-left">
                                <div class="module-avatar">M2</div>
                                <div class="module-info">
                                    <h3 class="module-title">JavaScript & React Ecosystem</h3>
                                    <p class="module-meta">Minggu 3-5 • Interaktivitas dinamis dan arsitektur komponen.</p>
                                </div>
                            </div>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="sub-topics-list">
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">JavaScript ES6+ Core</h4>
                                        <p class="sub-topic-desc">Variables, Closure, Promises, Async/Await, dan ES Modules.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">React.js Essentials</h4>
                                        <p class="sub-topic-desc">Component Lifecycle, Custom Hooks, JSX, Virtual DOM, dan SPA Routing.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">State Management & Data Fetching</h4>
                                        <p class="sub-topic-desc">Integration REST API dengan Axios/Fetch, Context API & Redux Toolkit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modul 3 -->
                    <div class="accordion-item" id="module-3">
                        <button class="accordion-header" onclick="toggleAccordion('module-3')">
                            <div class="accordion-header-left">
                                <div class="module-avatar">M3</div>
                                <div class="module-info">
                                    <h3 class="module-title">Backend & Database Architectures</h3>
                                    <p class="module-meta">Minggu 6-8 • Membangun API handal dan manajemen data terstruktur.</p>
                                </div>
                            </div>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="sub-topics-list">
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">RESTful API Development</h4>
                                        <p class="sub-topic-desc">Node.js / Express & Laravel Controllers, Middleware, serta Autentikasi JWT/Sanctum.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">Relational & Non-relational Database</h4>
                                        <p class="sub-topic-desc">Perancangan skema database MySQL/PostgreSQL, Query Optimization & ORM Eloquent.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">Security & Caching</h4>
                                        <p class="sub-topic-desc">Rate limiting, sanitasi input, enkripsi password, dan manajemen cache Redis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modul 4 -->
                    <div class="accordion-item" id="module-4">
                        <button class="accordion-header" onclick="toggleAccordion('module-4')">
                            <div class="accordion-header-left">
                                <div class="module-avatar">M4</div>
                                <div class="module-info">
                                    <h3 class="module-title">Deployment & Cloud Native</h3>
                                    <p class="module-meta">Minggu 9-10 • Membawa aplikasi ke lingkungan produksi.</p>
                                </div>
                            </div>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="sub-topics-list">
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">Containerization dengan Docker</h4>
                                        <p class="sub-topic-desc">Pembuatan Dockerfile, Docker Compose, dan enkapsulasi lingkungan aplikasi.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">CI/CD & Cloud Hosting</h4>
                                        <p class="sub-topic-desc">Otomatisasi deployment via GitHub Actions, VPS / Vercel, SSL, dan Web Server Nginx.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modul 5 -->
                    <div class="accordion-item" id="module-5">
                        <button class="accordion-header" onclick="toggleAccordion('module-5')">
                            <div class="accordion-header-left">
                                <div class="module-avatar">M5</div>
                                <div class="module-info">
                                    <h3 class="module-title">Capstone Project & Karir</h3>
                                    <p class="module-meta">Minggu 11-12 • Pembuktian keahlian dan persiapan industri.</p>
                                </div>
                            </div>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="sub-topics-list">
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">Real-world Capstone Project</h4>
                                        <p class="sub-topic-desc">Membangun proyek Full Stack nyata dari tahap desain, sistem database, hingga live deployment.</p>
                                    </div>
                                </div>
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="fas fa-check"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">Career Preparation & Mentorship</h4>
                                        <p class="sub-topic-desc">Review Resume & Portofolio GitHub, Simulasi Technical Interview, dan rekomendasi kerja.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Sidebar: Testimonial & CTA Card -->
            <div class="silabus-sidebar">
                
                <!-- Testimonial Card -->
                <div class="testimonial-card">
                    <div class="testimonial-profile">
                        <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="Budi Santoso" class="testimonial-avatar">
                        <div class="testimonial-info">
                            <h4>Budi Santoso</h4>
                            <p>Alumni Batch 4 • Kini Frontend Eng. di TechCorp</p>
                        </div>
                    </div>
                    <p class="testimonial-quote">
                        Kurikulumnya sangat up-to-date. Proyek akhir benar-benar simulasi dunia kerja yang membantu saya lolos interview teknis.
                    </p>
                </div>

                <!-- CTA Enrollment Card -->
                <div class="silabus-cta-card">
                    <h3 class="cta-header-title">Siap Memulai Karir Tech Anda?</h3>
                    <p class="cta-header-desc">
                        Dapatkan bimbingan intensif dari mentor praktisi industri dan bangun portfolio nyata Anda sekarang.
                    </p>
                    <a href="{{ url('/program-kursus') }}" class="btn-register-primary">
                        <i class="fas fa-user-plus"></i> Daftar Kelas Sekarang
                    </a>
                    <a href="https://wa.me/6285156553183?text=Halo%20Admin%20Elcoding,%20saya%20ingin%20tanya%20mengenai%20Silabus%20Bootcamp%20Full%20Stack%20Web%20Dev" target="_blank" class="btn-whatsapp-secondary">
                        <i class="fab fa-whatsapp"></i> Konsultasi via WhatsApp
                    </a>
                </div>

            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function toggleAccordion(moduleId) {
            const currentItem = document.getElementById(moduleId);
            const content = currentItem.querySelector('.accordion-content');
            const isActive = currentItem.classList.contains('active');

            if (isActive) {
                currentItem.classList.remove('active');
                content.style.maxHeight = null;
            } else {
                currentItem.classList.add('active');
                content.style.maxHeight = content.scrollHeight + "px";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Set initial maxHeight for pre-active item (Module 1)
            const activeItem = document.querySelector('.accordion-item.active');
            if (activeItem) {
                const content = activeItem.querySelector('.accordion-content');
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    </script>
    @endpush
</x-layout>
