<x-layout title="Detail Program - {{ $program->title }}">
    <style>
        .detail-hero {
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: #fff;
            padding: 80px 20px 100px;
            text-align: center;
            position: relative;
        }
        .detail-hero-title {
            font-size: 38px;
            font-weight: 800;
            margin: 0 0 15px;
            color: #ffffff;
        }
        .detail-hero-subtitle {
            font-size: 18px;
            color: #9ca3af;
            max-width: 700px;
            margin: 0 auto;
        }
        .detail-container {
            max-width: 1200px;
            margin: -60px auto 80px;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 40px;
        }
        .detail-card-main {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border: 1px solid #e5e7eb;
        }
        .detail-img {
            width: 100%;
            height: 380px;
            object-fit: cover;
            border-radius: 16px;
            margin-bottom: 30px;
        }
        .detail-section-title {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 15px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 10px;
        }
        .detail-description {
            color: #4b5563;
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 16px;
        }
        .detail-features {
            margin-bottom: 30px;
        }
        .detail-features ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .detail-features li {
            font-size: 15px;
            color: #374151;
            padding: 10px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px dashed #e5e7eb;
        }
        .detail-features li i {
            color: #10b981;
            font-size: 18px;
        }
        .checkout-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid #e5e7eb;
            height: fit-content;
            position: sticky;
            top: 100px;
        }
        .price-tag {
            font-size: 32px;
            font-weight: 800;
            color: #7c3aed;
            margin-bottom: 5px;
        }
        .price-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }
        .form-input:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.15);
        }
        .btn-pay {
            width: 100%;
            background: #7c3aed;
            color: #ffffff;
            font-weight: 700;
            font-size: 16px;
            padding: 14px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        }
        .btn-pay:hover {
            background: #6d28d9;
            transform: translateY(-2px);
        }
        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid #fecaca;
            margin-bottom: 20px;
            font-size: 14px;
        }
        @media (max-width: 1024px) {
            .detail-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="detail-hero">
        <h1 class="detail-hero-title">{{ $program->title }}</h1>
        <p class="detail-hero-subtitle">
            Durasi Program: <strong>{{ $program->duration }}</strong> 
            @if($program->badge) | <span class="bg-purple-600 px-3 py-1 rounded-full text-xs font-bold uppercase">{{ $program->badge }}</span> @endif
        </p>
    </div>

    <div class="detail-container">
        @if(session('error'))
            <div class="alert-error">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="detail-grid">
            <div class="detail-card-main">
                <img src="{{ $program->image_path ? asset(str_replace(' ', '%20', $program->image_path)) : asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="{{ $program->title }}" class="detail-img">
                
                <h2 class="detail-section-title">Deskripsi Program</h2>
                <div class="detail-description">
                    @if($program->description)
                        {!! nl2br(e($program->description)) !!}
                    @else
                        <p>Program kursus ini dirancang untuk membimbing Anda dari tingkat dasar hingga mahir dengan materi berbasis kurikulum industri terbaru, didampingi oleh mentor profesional.</p>
                    @endif
                </div>

                <h2 class="detail-section-title">Fasilitas & Layanan</h2>
                <div class="detail-features">
                    @if($program->features)
                        {!! $program->features !!}
                    @else
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Materi <strong>Sesuai Kurikulum Industri</strong></li>
                            <li><i class="fas fa-check-circle"></i> Pembelajaran <strong>Project Based</strong></li>
                            <li><i class="fas fa-check-circle"></i> Didampingi <strong>Mentor Expert</strong></li>
                            <li><i class="fas fa-check-circle"></i> Mendapat <strong>Sertifikat Kompetensi</strong></li>
                            <li><i class="fas fa-check-circle"></i> Akses Komunitas & Konsultasi Karir</li>
                        </ul>
                    @endif
                </div>
            </div>

            <div class="checkout-card">
                <div class="price-tag">{{ $program->price }}</div>
                <div class="price-label">Pembayaran Aman via Xendit Payment Gateway</div>

                <form action="{{ url('/program-kursus/' . $program->id . '/checkout') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="user_name">Nama Lengkap</label>
                        <input type="text" name="user_name" id="user_name" class="form-input" placeholder="Masukkan nama Anda" required value="{{ old('user_name', auth()->user()->name ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="user_email">Alamat Email</label>
                        <input type="email" name="user_email" id="user_email" class="form-input" placeholder="contoh@email.com" required value="{{ old('user_email', auth()->user()->email ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="user_phone">Nomor WhatsApp / HP</label>
                        <input type="tel" name="user_phone" id="user_phone" class="form-input" placeholder="08xxxxxxxxxx" required value="{{ old('user_phone') }}">
                    </div>

                    <button type="submit" class="btn-pay">
                        <i class="fas fa-credit-card"></i> Bayar Sekarang
                    </button>
                </form>

                <div class="mt-4 text-center text-xs text-gray-500 flex items-center justify-center gap-2">
                    <i class="fas fa-shield-alt text-green-500"></i> Terenkripsi & Pembayaran Instan via Xendit
                </div>
            </div>
        </div>
    </div>
</x-layout>
