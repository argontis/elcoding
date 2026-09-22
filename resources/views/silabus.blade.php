@php
$type = request('type', 'fullstack');
$syllabuses = [
    'fullstack' => [
        'breadcrumb' => 'Full Stack Web Dev',
        'badge' => 'Bootcamp Intensif',
        'title' => 'Silabus Lengkap: Bootcamp Intensif Full Stack Web Development',
        'subtitle' => 'Kurikulum berbasis industri yang dirancang untuk membekali Anda dengan keterampilan end-to-end, dari merancang antarmuka hingga mengelola arsitektur server yang skalabel.',
        'pills' => ['12 Minggu Pembelajaran', 'Pemula ke Mahir', '5 Real-world Projects', 'Sertifikat Resmi'],
        'register_url' => url('/pendaftaran-bootcamp?program=bootcamp-web-dev'),
        'modules' => [
            ['title' => 'Frontend Foundations', 'meta' => 'Minggu 1-2 • Membangun fondasi solid antarmuka web modern.', 'topics' => [
                ['name' => 'HTML5 & Semantik Web', 'points' => ['Struktur dokumen HTML', 'Elemen form tingkat lanjut', 'Aksesibilitas dasar untuk web']],
                ['name' => 'CSS3 & Layout Modern', 'points' => ['Implementasi Flexbox', 'Sistem CSS Grid', 'Transisi & Animasi CSS', 'Prinsip desain responsif']],
                ['name' => 'Pengenalan Version Control', 'points' => ['Instalasi dan perintah dasar Git', 'Manajemen alur kerja GitHub', 'Kolaborasi tim']],
            ]],
            ['title' => 'JavaScript & React Ecosystem', 'meta' => 'Minggu 3-5 • Interaktivitas dinamis dan arsitektur komponen.', 'topics' => [
                ['name' => 'JavaScript ES6+ Core', 'points' => ['Konsep Variables (let, const)', 'Fungsi Arrow dan Closure', 'Promises & Async/Await', 'ES Modules']],
                ['name' => 'React.js Essentials', 'points' => ['Pengenalan JSX & Virtual DOM', 'Component Lifecycle', 'Penggunaan Custom Hooks', 'SPA Routing dengan React Router']],
                ['name' => 'State Management & Data Fetching', 'points' => ['Integrasi REST API (Axios/Fetch)', 'Penggunaan Context API', 'Global State dengan Redux Toolkit']],
            ]],
            ['title' => 'Backend & Database Architectures', 'meta' => 'Minggu 6-8 • Membangun API handal dan manajemen data terstruktur.', 'topics' => [
                ['name' => 'RESTful API Development', 'points' => ['Node.js / Express & Laravel Controllers', 'Middleware', 'Autentikasi JWT/Sanctum']],
                ['name' => 'Relational & Non-relational Database', 'points' => ['Perancangan skema database MySQL/PostgreSQL', 'Query Optimization', 'ORM Eloquent']],
                ['name' => 'Security & Caching', 'points' => ['Rate limiting', 'Sanitasi input & enkripsi password', 'Manajemen cache Redis']],
            ]],
            ['title' => 'Deployment & Cloud Native', 'meta' => 'Minggu 9-10 • Membawa aplikasi ke lingkungan produksi.', 'topics' => [
                ['name' => 'Containerization dengan Docker', 'points' => ['Pembuatan Dockerfile', 'Docker Compose', 'Enkapsulasi lingkungan aplikasi']],
                ['name' => 'CI/CD & Cloud Hosting', 'points' => ['Otomatisasi deployment via GitHub Actions', 'VPS / Vercel', 'SSL & Web Server Nginx']],
            ]],
            ['title' => 'Capstone Project & Karir', 'meta' => 'Minggu 11-12 • Pembuktian keahlian dan persiapan industri.', 'topics' => [
                ['name' => 'Real-world Capstone Project', 'points' => ['Desain sistem keseluruhan', 'Pembuatan sistem database', 'Live deployment ke production']],
                ['name' => 'Career Preparation & Mentorship', 'points' => ['Review Resume & Portofolio GitHub', 'Simulasi Technical Interview', 'Rekomendasi kerja & networking']],
            ]],
        ]
    ],
    'ui-ux' => [
        'breadcrumb' => 'Mastering UI/UX Design',
        'badge' => 'Terlaris',
        'title' => 'Silabus Lengkap: Mastering UI/UX Design',
        'subtitle' => 'Pelajari cara merancang antarmuka pengguna yang intuitif dan pengalaman digital yang memukau dengan standar industri terkini.',
        'pills' => ['8 Minggu Pembelajaran', 'Figma Mastery', 'Design Portfolio', 'Sertifikat Resmi'],
        'register_url' => url('/pendaftaran-bootcamp?program=bootcamp-ui-ux'),
        'modules' => [
            ['title' => 'Design Fundamentals & UX Research', 'meta' => 'Minggu 1-3 • Dasar desain dan penelitian pengguna.', 'topics' => [
                ['name' => 'Pengenalan UI/UX', 'points' => ['Perbedaan mendasar UI dan UX', 'Proses design thinking', 'Membangun empati pengguna']],
                ['name' => 'User Research & Personas', 'points' => ['Metode riset pengguna kuantitatif & kualitatif', 'Pembuatan user persona', 'Customer journey mapping']],
                ['name' => 'Wireframing & IA', 'points' => ['Merancang Information Architecture (IA)', 'Pembuatan User Flow', 'Wireframe tingkat rendah (Low-Fidelity)']],
            ]],
            ['title' => 'UI Design & Prototyping', 'meta' => 'Minggu 4-6 • Merancang antarmuka visual.', 'topics' => [
                ['name' => 'Figma Essentials', 'points' => ['Penguasaan antarmuka & tools Figma', 'Sistem Auto Layout', 'Components & Variants']],
                ['name' => 'Visual Design Principles', 'points' => ['Sistem tipografi digital', 'Teori warna untuk UI', 'Whitespace & hierarki visual yang baik']],
                ['name' => 'High-Fidelity Prototyping', 'points' => ['Desain visual High-Fidelity', 'Membuat prototype interaktif', 'Micro-interactions & animasi transisi']],
            ]],
            ['title' => 'Design System & Portfolio', 'meta' => 'Minggu 7-8 • Standarisasi dan portofolio akhir.', 'topics' => [
                ['name' => 'Membangun Design System', 'points' => ['Pembuatan dan pengelolaan UI Kit', 'Penggunaan design tokens', 'Penyusunan dokumentasi desain']],
                ['name' => 'Usability Testing', 'points' => ['Metode pengujian prototipe', 'Observasi pengguna nyata', 'Melakukan iterasi desain berdasarkan feedback']],
                ['name' => 'Final Project & Portfolio', 'points' => ['Menyelesaikan studi kasus akhir end-to-end', 'Menyusun dokumentasi studi kasus (Case Study)', 'Mempersiapkan portofolio untuk melamar kerja']],
            ]],
        ]
    ],
    'webinar' => [
        'breadcrumb' => 'Webinar: Modern Web Architecture',
        'badge' => 'Upcoming Event',
        'title' => 'Materi Webinar: Modern Web Architecture 2026',
        'subtitle' => 'Kupas tuntas tren arsitektur web modern, microservices, dan edge computing untuk membangun aplikasi web berkinerja tinggi.',
        'pills' => ['Live Zoom', 'Tanya Jawab', 'E-Certificate', 'Recording Tersedia'],
        'register_url' => url('/daftar-event?webinar=cloud-backend'),
        'modules' => [
            ['title' => 'Sesi 1: Tren Arsitektur 2026', 'meta' => '19:00 - 19:45 WIB • Pengenalan konsep dasar.', 'topics' => [
                ['name' => 'Monolith vs Microservices', 'points' => ['Kelebihan dan kelemahan Monolith', 'Kapan saat yang tepat beralih ke Microservices', 'Tantangan dalam implementasi Microservices']],
                ['name' => 'Serverless & Edge Computing', 'points' => ['Pengenalan konsep Serverless computing', 'Edge functions (Vercel/Cloudflare)', 'Mengurangi latensi dan beban server secara signifikan']],
            ]],
            ['title' => 'Sesi 2: Praktik Terbaik & QnA', 'meta' => '19:45 - 20:30 WIB • Implementasi nyata.', 'topics' => [
                ['name' => 'Studi Kasus Arsitektur Skalabel', 'points' => ['Membedah arsitektur aplikasi skala besar', 'Best practices dan pattern di industri', 'Strategi optimasi database dan caching']],
                ['name' => 'Tanya Jawab (QnA) Interaktif', 'points' => ['Sesi tanya jawab terbuka dengan pemateri', 'Konsultasi masalah teknis yang dihadapi peserta', 'Networking dan diskusi sesama developer']],
            ]],
        ]
    ],
    'workshop' => [
        'breadcrumb' => 'Workshop: Next.js & Prisma',
        'badge' => 'Hands-on Workshop',
        'title' => 'Silabus Workshop: Web App Production-Ready dgn Next.js 15 & Prisma',
        'subtitle' => 'Workshop intensif selama 2 hari untuk membangun aplikasi web berskala produksi menggunakan framework modern Next.js 15 dan Prisma ORM.',
        'pills' => ['2 Hari Intensif', 'Live Coding', 'E-Certificate', 'Source Code & Repo'],
        'register_url' => url('/pendaftaran-workshop?workshop=nextjs'),
        'modules' => [
            ['title' => 'Hari 1: Fundamental Next.js & Database', 'meta' => 'Sabtu, 19:00 WIB • Membangun arsitektur dasar.', 'topics' => [
                ['name' => 'Next.js 15 App Router', 'points' => ['Pengenalan App Router', 'Server Components vs Client Components', 'Data Fetching strategies']],
                ['name' => 'Prisma ORM & PostgreSQL', 'points' => ['Setup Prisma schema', 'Migrations', 'CRUD Operations dalam Next.js API Routes']],
            ]],
            ['title' => 'Hari 2: Authentication & Deployment', 'meta' => 'Minggu, 19:00 WIB • Autentikasi dan rilis ke publik.', 'topics' => [
                ['name' => 'NextAuth.js Integration', 'points' => ['Implementasi Social Login', 'Manajemen Session', 'Proteksi Rute Khusus']],
                ['name' => 'Deployment to Vercel', 'points' => ['Konfigurasi Vercel', 'Environment Variables', 'CI/CD Workflow']],
            ]],
        ]
    ]
];

$data = $syllabuses[$type] ?? $syllabuses['fullstack'];
@endphp

<x-layout title="Silabus - Elcoding Academy">
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

        .silabus-hero-badge {
            display: inline-block;
            padding: 8px 16px;
            background: rgba(2, 132, 199, 0.2);
            color: #7dd3fc;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 24px;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1px solid rgba(2, 132, 199, 0.3);
        }

        .silabus-hero-title {
            font-size: 42px;
            font-weight: 800;
            color: #ffffff;
            margin: 0 0 20px;
            line-height: 1.2;
            letter-spacing: -0.5px;
        }

        .silabus-hero-subtitle {
            font-size: 18px;
            color: #e2e8f0;
            margin: 0 0 32px;
            line-height: 1.6;
            max-width: 600px;
            opacity: 0.9;
        }

        .silabus-features {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .feature-pill {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 14px;
            color: #f8fafc;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
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

        /* Accordion Styling */
        .silabus-main {
            background: #ffffff;
            border-radius: 24px;
            padding: 36px;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .silabus-header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            padding-bottom: 18px;
            border-bottom: 2px solid #f1f5f9;
        }

        .silabus-main-title {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .module-count-badge {
            background-color: #f1f5f9;
            color: #334155;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            border: none;
        }

        .accordion-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .accordion-item {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .accordion-item.active {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
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
            background: #f1f5f9;
            color: #475569;
            font-size: 16px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
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
            background: transparent;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: transform 0.3s ease, color 0.3s ease;
            flex-shrink: 0;
        }

        .accordion-item.active .accordion-icon {
            transform: rotate(180deg);
            color: #0f172a;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sub-topics-list {
            padding: 10px 24px 24px 90px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .sub-topic-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            position: relative;
        }

        .sub-topic-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 11px;
            top: 26px;
            bottom: -20px;
            width: 2px;
            background: #e2e8f0;
        }

        .sub-topic-icon {
            width: 24px;
            height: 24px;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sub-topic-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 6px;
        }

        .sub-topic-points {
            list-style-type: disc;
            list-style-position: outside;
            margin: 4px 0 0 0;
            padding-left: 20px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }
        
        .sub-topic-points li {
            margin-bottom: 4px;
            padding-left: 4px;
        }

        /* Sidebar */
        .silabus-sidebar {
            display: flex;
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
            .silabus-main {
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
            <nav class="silabus-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span class="separator">></span>
                @if(isset($program))
                    <a href="{{ url('/program-kursus') }}">Program Kursus</a>
                    <span class="separator">></span>
                    <a href="{{ url('/program-kursus/' . $program->id) }}">{{ $program->title }}</a>
                @else
                    <a href="{{ url('/event-webinar') }}">Event & Webinar</a>
                    <span class="separator">></span>
                    <a href="{{ url('/event-webinar') }}">{{ $data['breadcrumb'] }}</a>
                @endif
                <span class="separator">></span>
                <span class="active" aria-current="page">Silabus</span>
            </nav>

            <div class="silabus-hero-badge">{{ $data['badge'] }}</div>
            <h1 class="silabus-hero-title">
                @if(isset($program) && !empty($program->title))
                    {{ \Illuminate\Support\Str::startsWith($program->title, 'Silabus') ? $program->title : 'Silabus Lengkap: ' . $program->title }}
                @else
                    {{ $data['title'] }}
                @endif
            </h1>
            <p class="silabus-hero-subtitle">
                @if(isset($program) && !empty($program->short_description))
                    {{ $program->short_description }}
                @else
                    {{ $data['subtitle'] }}
                @endif
            </p>
            
            <div class="silabus-features">
                @foreach($data['pills'] as $pill)
                <div class="feature-pill">
                    <i class="fas fa-check-circle" style="color: #38bdf8;"></i> {{ $pill }}
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="silabus-body-container">
        <div class="silabus-layout-grid">
            
            <!-- Main Content: Accordion Modules -->
            <div class="silabus-main">
                <div class="silabus-header-section">
                    <h2 class="silabus-main-title">Detail Kurikulum</h2>
                    <div class="flex items-center gap-3">
                        <span class="bg-slate-100 text-slate-700 text-xs font-medium px-3 py-1 rounded-full module-count-badge">
                            {{ count($data['modules']) }} Modul Utama
                        </span>
                        <button onclick="downloadSyllabusPdf('{{ $data['breadcrumb'] }}')" class="border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-semibold px-3 py-1.5 rounded-lg flex items-center gap-1.5 transition cursor-pointer">
                            📥 Unduh Silabus (PDF)
                        </button>
                    </div>
                </div>

                <div class="accordion-container">
                    @foreach($data['modules'] as $index => $module)
                    <div class="accordion-item {{ $index === 0 ? 'active' : '' }}" id="module-{{ $index + 1 }}">
                        <button class="accordion-header" onclick="toggleAccordion('module-{{ $index + 1 }}')">
                            <div class="accordion-header-left">
                                <div class="module-avatar">M{{ $index + 1 }}</div>
                                <div class="module-info">
                                    <h3 class="module-title">{{ $module['title'] }}</h3>
                                    <p class="module-meta">{{ $module['meta'] }}</p>
                                </div>
                            </div>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </button>
                        <div class="accordion-content">
                            <div class="sub-topics-list">
                                @foreach($module['topics'] as $topic)
                                <div class="sub-topic-item">
                                    <div class="sub-topic-icon"><i class="far fa-check-circle"></i></div>
                                    <div>
                                        <h4 class="sub-topic-title">{{ $topic['name'] }}</h4>
                                        <ul class="sub-topic-points" style="list-style-type: disc !important; list-style-position: inside !important; margin-top: 4px; padding-left: 8px; color: #64748b; font-size: 13px; line-height: 1.6;">
                                            @foreach($topic['points'] as $point)
                                            <li style="margin-bottom: 6px; display: list-item;">{{ $point }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
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
                    <a href="{!! $data['register_url'] ?? url('/daftar-event') !!}" class="btn-register-primary">
                        <i class="fas fa-user-plus"></i> Daftar Sekarang
                    </a>
                    <a href="https://wa.me/{{ \App\Models\Setting::getValue('contact_whatsapp_chat', '6281476652656') }}?text=Halo%20Admin%20Elcoding,%20saya%20ingin%20tanya%20mengenai%20Silabus" target="_blank" class="btn-whatsapp-secondary">
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

        function downloadSyllabusPdf(programTitle) {
            alert('Mengunduh Silabus PDF lengkap untuk: ' + programTitle + '\nDokumen silabus akan tersimpan secara otomatis.');
            window.print();
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
