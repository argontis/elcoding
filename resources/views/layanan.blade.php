<x-layout>
    <x-slot name="title">Produk & Layanan</x-slot>

    <!-- 1. HEADER SECTION -->
    <section class="service-hero">
        <div class="container text-center">
            <span class="badge-title">Layanan Elcoding</span>
            <h1 class="page-title">Solusi Digital & Pelatihan IT</h1>
            <p class="page-desc">
                Kami menyediakan solusi lengkap untuk kebutuhan digitalisasi bisnis Anda melalui Software House profesional, serta program pelatihan IT intensif untuk mencetak talenta masa depan.
            </p>
        </div>
    </section>

    <!-- 2. GRID PRODUK & LAYANAN -->
    <section class="service-content">
        <div class="container">
            <div class="service-grid">
                
                <!-- Card 1 -->
                <div class="service-card">
                    <span class="card-badge">Software House</span>
                    <h3 class="card-title">Jasa Pembuatan Website</h3>
                    <p class="card-desc">Pembuatan website instan, company profile, e-commerce, hingga sistem akademik yang modern, responsif, dan mudah dikelola.</p>
                    <div class="card-price-wrap">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-value">Konsultasi</span>
                    </div>
                    <a href="{{ url('/layanan/detail') }}" class="btn-detail">Lihat Detail</a>
                </div>

                <!-- Card 2 -->
                <div class="service-card">
                    <span class="card-badge">Software House</span>
                    <h3 class="card-title">Pembuatan Aplikasi Mobile</h3>
                    <p class="card-desc">Pengembangan aplikasi mobile berbasis Android & iOS dengan UI/UX yang menarik untuk mendukung operasional dan jangkauan bisnis Anda.</p>
                    <div class="card-price-wrap">
                        <span class="price-label">Mulai dari</span>
                        <span class="price-value">Konsultasi</span>
                    </div>
                    <a href="{{ url('/layanan/detail') }}" class="btn-detail">Lihat Detail</a>
                </div>

                <!-- Card 3 -->
                <div class="service-card">
                    <span class="card-badge bg-purple">IT Training</span>
                    <h3 class="card-title">Bootcamp Web Development</h3>
                    <p class="card-desc">Program kursus intensif belajar membuat website dari nol hingga mahir menggunakan teknologi industri terkini (Laravel, React, dll).</p>
                    <div class="card-price-wrap">
                        <span class="price-label">Biaya Program</span>
                        <span class="price-value">Cek Brosur</span>
                    </div>
                    <a href="{{ url('/program-kursus') }}" class="btn-detail">Lihat Detail</a>
                </div>

                <!-- Card 4 -->
                <div class="service-card">
                    <span class="card-badge bg-purple">IT Training</span>
                    <h3 class="card-title">Kursus UI/UX Design</h3>
                    <p class="card-desc">Pelatihan mendesain antarmuka aplikasi dan riset pengguna menggunakan Figma, dipandu oleh mentor berpengalaman.</p>
                    <div class="card-price-wrap">
                        <span class="price-label">Biaya Program</span>
                        <span class="price-value">Cek Brosur</span>
                    </div>
                    <a href="{{ url('/program-kursus') }}" class="btn-detail">Lihat Detail</a>
                </div>

                <!-- Card 5 -->
                <div class="service-card">
                    <span class="card-badge">Hosting & Cloud</span>
                    <h3 class="card-title">Cloud Server & VPS</h3>
                    <p class="card-desc">Layanan penyewaan server cloud yang cepat, stabil, dan aman untuk kebutuhan sistem informasi dan aplikasi berskala besar.</p>
                    <div class="card-price-wrap">
                        <span class="price-label">Harga</span>
                        <span class="price-value">Hubungi Kami</span>
                    </div>
                    <a href="{{ url('/layanan/detail') }}" class="btn-detail">Lihat Detail</a>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. JAMINAN / KEUNGGULAN -->
    <section class="guarantee-section">
        <div class="container">
            <div class="guarantee-header text-center">
                <h2>Mengapa Memilih Elcoding?</h2>
                <p>Kami berkomitmen memberikan layanan dan pendidikan terbaik dengan standar industri.</p>
            </div>
            
            <div class="guarantee-grid">
                <div class="guarantee-item">
                    <div class="icon-wrap"><i class="fas fa-rocket"></i></div>
                    <h4>Proses Cepat & Tepat</h4>
                    <p>Pengerjaan proyek dilakukan oleh tim profesional dengan estimasi waktu yang transparan dan efisien.</p>
                </div>
                <div class="guarantee-item">
                    <div class="icon-wrap"><i class="fas fa-tags"></i></div>
                    <h4>Harga Terjangkau</h4>
                    <p>Harga kompetitif dengan kualitas layanan premium dan kurikulum berstandar tinggi.</p>
                </div>
                <div class="guarantee-item">
                    <div class="icon-wrap"><i class="fas fa-headset"></i></div>
                    <h4>Support Responsif</h4>
                    <p>Tim support kami siap mendampingi keluhan maintenance aplikasi atau pertanyaan seputar materi kursus.</p>
                </div>
                <div class="guarantee-item">
                    <div class="icon-wrap"><i class="fas fa-certificate"></i></div>
                    <h4>Terpercaya & Bersertifikat</h4>
                    <p>Dipercaya oleh berbagai klien dan ratusan siswa. Lulusan kursus akan mendapatkan sertifikat resmi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. CALL TO ACTION (CTA) -->
    <section class="cta-section">
        <div class="container text-center">
            <h2>Butuh Konsultasi Layanan?</h2>
            <p>Tim kami siap membantu memilih layanan yang paling tepat untuk kebutuhan bisnis atau karir Anda.</p>
            <a href="https://wa.me/6281476652656" class="btn-cta" target="_blank"><i class="fab fa-whatsapp"></i> Chat WhatsApp Sekarang</a>
        </div>
    </section>

    <!-- CSS STYLING MURNI (Mirip Websekolah) -->
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .text-center { text-align: center; }

        /* Hero Section */
        .service-hero {
            padding: 80px 0 50px;
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        }
        .badge-title {
            background-color: #eef6fc;
            color: #20689b;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            display: inline-block;
            margin-bottom: 20px;
        }
        .page-title {
            font-size: 40px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 15px;
            letter-spacing: -1px;
        }
        .page-desc {
            font-size: 18px;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Grid Cards */
        .service-content {
            padding: 40px 0 80px;
        }
        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }
        .service-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 30px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .service-card:hover {
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08);
            border-color: #20689b;
            transform: translateY(-5px);
        }
        .card-badge {
            display: inline-block;
            background: #eef6fc;
            color: #20689b;
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 6px;
            align-self: flex-start;
            margin-bottom: 15px;
        }
        .card-badge.bg-purple {
            background: #f3e8ff;
            color: #7e22ce;
        }
        .card-title {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 10px;
            line-height: 1.4;
        }
        .card-desc {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 20px;
            flex-grow: 1;
        }
        .card-price-wrap {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }
        .price-label {
            font-size: 13px;
            color: #94a3b8;
        }
        .price-value {
            font-size: 18px;
            font-weight: 800;
            color: #1e293b;
        }
        .btn-detail {
            display: block;
            text-align: center;
            background: white;
            color: #20689b;
            border: 1px solid #20689b;
            padding: 10px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: 0.3s;
        }
        .service-card:hover .btn-detail {
            background: #20689b;
            color: white;
        }

        /* Guarantee Section */
        .guarantee-section {
            background: #f8fafc;
            padding: 80px 0;
        }
        .guarantee-header h2 {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 10px;
        }
        .guarantee-header p {
            font-size: 16px;
            color: #64748b;
            margin-bottom: 50px;
        }
        .guarantee-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 30px;
        }
        .guarantee-item {
            text-align: center;
        }
        .icon-wrap {
            width: 60px;
            height: 60px;
            background: #eef6fc;
            color: #20689b;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            margin: 0 auto 20px;
        }
        .guarantee-item h4 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 10px;
        }
        .guarantee-item p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
        }

        /* CTA Section */
        .cta-section {
            padding: 80px 0;
            background: #ffffff;
        }
        .cta-section h2 {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 15px;
        }
        .cta-section p {
            font-size: 18px;
            color: #64748b;
            margin: 0 auto 30px;
            max-width: 600px;
        }
        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #22c55e;
            color: white;
            padding: 14px 28px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(34, 197, 94, 0.2);
        }
        .btn-cta:hover {
            background: #16a34a;
            transform: translateY(-2px);
        }

        /* Responsif Mobile & Tablet */
        @media (max-width: 1024px) {
            .service-grid { grid-template-columns: repeat(2, 1fr); }
            .guarantee-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .page-title { font-size: 32px; }
            .service-grid { grid-template-columns: 1fr; }
            .guarantee-grid { grid-template-columns: 1fr; }
            .service-card { padding: 20px; }
        }
    </style>
</x-layout>