<x-layout>
    <x-slot name="title">Detail Layanan - {{ $layanan->title }}</x-slot>

    <!-- 1. HERO SECTION (Judul Layanan) -->
    <section class="detail-hero">
        <div class="container">
            @if(session('error'))
                <div style="background: #fef2f2; color: #991b1b; padding: 12px 16px; border-radius: 10px; border: 1px solid #fecaca; margin-bottom: 20px; font-size: 14px; text-align: center;">
                    <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                </div>
            @endif
            <div class="breadcrumb">
                <a href="{{ url('/') }}">Beranda</a> <i class="fas fa-chevron-right"></i> 
                <a href="{{ url('/layanan') }}">Layanan</a> <i class="fas fa-chevron-right"></i> 
                <span>{{ $layanan->title }}</span>
            </div>
            <h1 class="detail-title">{{ $layanan->title }}</h1>
            <p class="detail-subtitle">{{ $layanan->short_description }}</p>
        </div>
    </section>

    <!-- 2. MAIN CONTENT (Penjelasan & Fitur) -->
    <section class="detail-content">
        <div class="container detail-grid">
            
            <!-- Bagian Kiri: Deskripsi & Fitur -->
            <div class="content-left">
                @if($layanan->image_path)
                <img src="{{ asset($layanan->image_path) }}" alt="{{ $layanan->title }}" class="content-image">
                @else
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Ilustrasi Layanan" class="content-image">
                @endif
                
                <h2>Deskripsi Layanan</h2>
                <div class="rich-text-content">
                    {!! $layanan->description !!}
                </div>

                @if(!empty($layanan->features_main))
                <h2 style="margin-top: 40px;">Fitur Utama yang Anda Dapatkan</h2>
                <div class="features-list">
                    @foreach($layanan->features_main as $fm)
                    <div class="feature-item">
                        <i class="{{ $fm['icon'] ?? 'fas fa-check-circle' }}"></i>
                        <div>
                            <h4>{{ $fm['title'] ?? '' }}</h4>
                            <p>{{ $fm['desc'] ?? '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Bagian Kanan: Kartu Harga & CTA (Sticky) -->
            <div class="content-right">
                <div class="pricing-card">
                    <span class="card-badge">{{ $layanan->badge ?? 'Layanan' }}</span>
                    <h3 class="price-title">{{ $layanan->price_label ?? 'Mulai dari' }}</h3>
                    <div class="price-amount">{{ $layanan->price }} <span>{{ $layanan->price_period }}</span></div>
                    
                    @if(!empty($layanan->pricing_includes))
                    <ul class="pricing-includes">
                        @foreach($layanan->pricing_includes as $pi)
                        <li><i class="fas fa-check"></i> {{ $pi }}</li>
                        @endforeach
                    </ul>
                    @endif

                    @php
                        $waMsg = $layanan->whatsapp_message ?: 'Halo Admin Elcoding, saya ingin pesan layanan '.$layanan->title.'.';
                        $waLink = 'https://wa.me/6281476652656?text=' . urlencode($waMsg);
                    @endphp

                    @if($layanan->price_amount > 0)
                    <form action="{{ url('/layanan/' . $layanan->id . '/checkout') }}" method="POST">
                        @csrf
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label" for="user_name">Nama Lengkap</label>
                            <input type="text" name="user_name" id="user_name" class="form-input" placeholder="Masukkan nama Anda" required value="{{ old('user_name') }}">
                        </div>

                        <div class="form-group" style="text-align: left;">
                            <label class="form-label" for="user_email">Alamat Email</label>
                            <input type="email" name="user_email" id="user_email" class="form-input" placeholder="contoh@email.com" required value="{{ old('user_email') }}">
                        </div>

                        <div class="form-group" style="text-align: left;">
                            <label class="form-label" for="user_phone">Nomor WhatsApp / HP</label>
                            <input type="tel" name="user_phone" id="user_phone" class="form-input" placeholder="08xxxxxxxxxx" required value="{{ old('user_phone') }}">
                        </div>

                        <button type="submit" class="btn-order">
                            <i class="fas fa-credit-card"></i> Bayar Sekarang
                        </button>
                    </form>
                    
                    <div class="mt-3 text-center text-xs text-gray-500 mb-4" style="font-size: 11px;">
                        <i class="fas fa-shield-alt text-green-500"></i> Terenkripsi & Pembayaran Instan via Xendit
                    </div>
                    @else
                    <a href="{{ $waLink }}" class="btn-order" target="_blank">
                        Konsultasi via WhatsApp
                    </a>
                    @endif
                    
                    <a href="#" class="btn-download"><i class="fas fa-file-pdf"></i> Unduh Proposal Penawaran</a>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. FITUR LENGKAP -->
    @if(!empty($layanan->features_full))
    <section class="full-features-section">
        <div class="container">
            <div class="features-header text-center">
                <span class="badge-title"><i class="fas fa-check" style="color: #20689b; margin-right: 5px;"></i> Yang Anda Dapatkan</span>
                <h2>Fitur Lengkap di Setiap Paket</h2>
                <p>Semua yang dibutuhkan sekolah sudah termasuk — tanpa biaya tersembunyi.</p>
            </div>
            
            <div class="full-features-grid">
                @foreach($layanan->features_full as $ff)
                <div class="ff-card">
                    <div class="ff-icon {{ $ff['color_class'] ?? 'icon-blue' }}"><i class="{{ $ff['icon'] ?? 'fas fa-bolt' }}"></i></div>
                    <h4>{{ $ff['title'] ?? '' }}</h4>
                    <p>{{ $ff['desc'] ?? '' }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

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
            color: #ffffff !important;
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
            color: #ffffff !important;
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

        /* Form Checkout CSS */
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
        }
        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 13px;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }
        .form-input:focus {
            border-color: #20689b;
            box-shadow: 0 0 0 3px rgba(32, 104, 155, 0.15);
        }

        /* Full Features Section */
        .full-features-section {
            padding: 80px 0;
            background: #ffffff;
        }
        .text-center { text-align: center; }
        .features-header {
            margin-bottom: 50px;
        }
        .features-header h2 {
            font-size: 32px;
            font-weight: 800;
            color: #1e293b;
            margin: 15px 0 10px;
        }
        .features-header p {
            font-size: 16px;
            color: #64748b;
        }
        .full-features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        .ff-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 25px;
            transition: all 0.3s ease;
        }
        .ff-card:hover {
            border-color: #20689b;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transform: translateY(-3px);
        }
        .ff-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .ff-icon.icon-blue { background: #eef6fc; color: #20689b; }
        .ff-icon.icon-cyan { background: #e0f2fe; color: #0284c7; }
        .ff-icon.icon-purple { background: #f3e8ff; color: #9333ea; }
        .ff-icon.icon-green { background: #dcfce7; color: #16a34a; }
        
        .ff-card h4 {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 10px;
            line-height: 1.4;
        }
        .ff-card p {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }
        .badge-title {
            background-color: #eef6fc;
            color: #20689b;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            display: inline-block;
        }

        /* Responsif Mobile & Tablet */
        @media (max-width: 1024px) {
            .full-features-grid { grid-template-columns: repeat(2, 1fr); }
            .detail-grid { grid-template-columns: 1fr; }
            .content-right { position: static; }
        }
        @media (max-width: 768px) {
            .detail-title { font-size: 28px; }
            .content-left { padding: 20px; }
            .features-list { grid-template-columns: 1fr; }
            .content-image { height: 250px; }
            .full-features-grid { grid-template-columns: 1fr; }
        }
    </style>
</x-layout>