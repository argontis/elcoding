<x-layout>
    <x-slot name="title">Detail Layanan - Jasa Pembuatan Website</x-slot>

    <!-- 1. HERO SECTION (Judul Layanan) -->
    <section class="detail-hero">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Beranda</a> <i class="fas fa-chevron-right"></i> 
                <a href="{{ url('/layanan') }}">Layanan</a> <i class="fas fa-chevron-right"></i> 
                <span>Jasa Pembuatan Website</span>
            </div>
            <h1 class="detail-title">Jasa Pembuatan Website Profesional</h1>
            <p class="detail-subtitle">Bangun kredibilitas digital bisnis Anda dengan website modern, responsif, dan SEO-friendly yang dirancang khusus sesuai kebutuhan Anda.</p>
        </div>
    </section>

    <!-- 2. MAIN CONTENT (Penjelasan & Fitur) -->
    <section class="detail-content">
        <div class="container detail-grid">
            
            <!-- Bagian Kiri: Deskripsi & Fitur -->
            <div class="content-left">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ilustrasi Website" class="content-image">
                
                <h2>Deskripsi Layanan</h2>
                <p>Di era digital saat ini, memiliki website bukan lagi sebuah pilihan, melainkan keharusan. Elcoding hadir membantu Anda merancang dan mendevelop website dari nol, mulai dari Company Profile, E-Commerce, Portal Berita, hingga Sistem Informasi Akademik yang kompleks.</p>
                <p>Kami menggunakan teknologi terbaru yang menjamin website Anda cepat diakses, aman dari serangan siber, dan tampil sempurna di segala ukuran layar (HP, Tablet, Desktop).</p>

                <h2 style="margin-top: 40px;">Fitur Utama yang Anda Dapatkan</h2>
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>Desain Premium & Responsif</h4>
                            <p>Tampilan elegan dan menyesuaikan dengan layar perangkat pengunjung secara otomatis.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>SEO Friendly</h4>
                            <p>Struktur kode yang dioptimasi agar mudah ditemukan di halaman pertama Google.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>Panel Admin (CMS)</h4>
                            <p>Dashboard yang mudah digunakan untuk mengubah teks, gambar, atau artikel secara mandiri.</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <div>
                            <h4>Gratis Domain & Hosting 1 Tahun</h4>
                            <p>Terima beres! Paket sudah termasuk nama domain pilihan Anda dan hosting yang cepat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Kanan: Kartu Harga & CTA (Sticky) -->
            <div class="content-right">
                <div class="pricing-card">
                    <span class="card-badge">Paket Bisnis</span>
                    <h3 class="price-title">Mulai dari</h3>
                    <div class="price-amount">Rp 2.500.000 <span>/ web</span></div>
                    
                    <ul class="pricing-includes">
                        <li><i class="fas fa-check"></i> Desain Custom (Bukan Template)</li>
                        <li><i class="fas fa-check"></i> Maksimal 10 Halaman</li>
                        <li><i class="fas fa-check"></i> Bandwidth Unlimited</li>
                        <li><i class="fas fa-check"></i> SSL Certificate (HTTPS)</li>
                        <li><i class="fas fa-check"></i> Support & Garansi Bug 3 Bulan</li>
                    </ul>

                    <a href="https://wa.me/6281476652656?text=Halo%20Admin%20Elcoding,%20saya%20ingin%20pesan%20layanan%20Pembuatan%20Website." class="btn-order" target="_blank">
                        Pesan Sekarang
                    </a>
                    
                    <a href="#" class="btn-download"><i class="fas fa-file-pdf"></i> Unduh Proposal Layanan</a>
                </div>
            </div>

        </div>
    </section>

    <!-- CSS STYLING MURNI -->
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section */
        .detail-hero {
            background-color: #005a96;
            color: #ffffff;
            padding: 60px 0;
        }
        .breadcrumb {
            font-size: 14px;
            margin-bottom: 20px;
            color: #93c5fd;
        }
        .breadcrumb a {
            color: #93c5fd;
            text-decoration: none;
            transition: color 0.3s;
        }
        .breadcrumb a:hover {
            color: #ffffff;
        }
        .breadcrumb i {
            margin: 0 8px;
            font-size: 12px;
        }
        .detail-title {
            font-size: 36px;
            font-weight: 800;
            margin: 0 0 15px;
            color: #ffffff;
        }
        .detail-subtitle {
            font-size: 18px;
            line-height: 1.6;
            max-width: 800px;
            margin: 0;
            color: #e2e8f0;
        }

        /* Content Grid */
        .detail-content {
            padding: 60px 0;
            background-color: #f8fafc;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            align-items: start; /* Penting untuk efek sticky */
        }

        /* Kiri: Deskripsi & Fitur */
        .content-left {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
        }
        .content-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 30px;
        }
        .content-left h2 {
            font-size: 24px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f5f9;
        }
        .content-left p {
            font-size: 16px;
            color: #475569;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        
        .features-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }
        .feature-item {
            display: flex;
            gap: 15px;
        }
        .feature-item i {
            font-size: 24px;
            color: #20689b;
            margin-top: 3px;
        }
        .feature-item h4 {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 5px;
        }
        .feature-item p {
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
            margin: 0;
        }

        /* Kanan: Pricing Card Sticky */
        .content-right {
            position: sticky;
            top: 100px; /* Jarak dari atas layar saat di-scroll */
        }
        .pricing-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            text-align: center;
        }
        .card-badge {
            display: inline-block;
            background: #eef6fc;
            color: #20689b;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 50px;
            margin-bottom: 15px;
        }
        .price-title {
            font-size: 14px;
            color: #64748b;
            margin: 0 0 5px;
            font-weight: 600;
        }
        .price-amount {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 25px;
        }
        .price-amount span {
            font-size: 14px;
            font-weight: 500;
            color: #94a3b8;
        }
        
        .pricing-includes {
            list-style: none;
            padding: 0;
            margin: 0 0 25px;
            text-align: left;
        }
        .pricing-includes li {
            font-size: 14px;
            color: #475569;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .pricing-includes li i {
            color: #22c55e;
            font-size: 14px;
        }

        .btn-order {
            display: block;
            background: #005a96;
            color: #ffffff;
            padding: 14px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 15px;
        }
        .btn-order:hover {
            background: #004a7a;
            transform: translateY(-2px);
        }
        .btn-download {
            display: block;
            background: #f8fafc;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-download:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        /* Responsif Mobile & Tablet */
        @media (max-width: 1024px) {
            .detail-grid { grid-template-columns: 1fr; }
            .content-right { position: static; }
        }
        @media (max-width: 768px) {
            .detail-title { font-size: 28px; }
            .content-left { padding: 20px; }
            .features-list { grid-template-columns: 1fr; }
            .content-image { height: 250px; }
        }
    </style>
</x-layout>