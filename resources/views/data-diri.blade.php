<x-layout title="Informasi & Pembayaran - Elcoding Academy">
    @push('styles')
    <style>
        .checkout-page-container {
            background-color: #f8fafc;
            padding: 40px 20px 80px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
        }

        .checkout-wrapper {
            max-width: 1140px;
            margin: 0 auto;
        }

        /* Wizard Step Progress */
        .checkout-steps-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 700px;
            margin: 0 auto 40px;
            position: relative;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            z-index: 2;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #64748b;
            font-size: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .step-completed .step-circle {
            background: #1d667f;
            color: #ffffff;
        }

        .step-active .step-circle {
            background: #1d667f;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(29, 102, 127, 0.15);
        }

        .step-label {
            font-size: 13px;
            font-weight: 600;
            color: #94a3b8;
        }

        .step-completed .step-label,
        .step-active .step-label {
            color: #1d667f;
        }

        .step-line {
            flex-grow: 1;
            height: 2px;
            background: #e2e8f0;
            margin: 0 16px;
            position: relative;
            top: -12px;
        }

        .step-line.step-line-active {
            background: #1d667f;
        }

        /* 2-Column Grid Layout */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 32px;
            align-items: start;
        }

        /* Left Column Cards */
        .form-section-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 32px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-icon-badge {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        /* Input Controls */
        .input-group-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 8px;
        }

        .custom-form-input {
            width: 100%;
            padding: 14px 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box !important;
        }

        .custom-form-input::placeholder {
            color: #cbd5e1;
        }

        .custom-form-input:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1);
        }

        .form-row-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 18px;
        }

        /* Batch Selection Cards */
        .batch-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .batch-card {
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.25s ease;
            position: relative;
        }

        .batch-card.selected {
            border-color: #1d667f;
            background: #f0f7ff;
        }

        .batch-card-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 6px;
        }

        .batch-card-dates {
            font-size: 13px;
            color: #64748b;
            margin: 0 0 14px;
        }

        .batch-slot-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .badge-red {
            background: #fef2f2;
            color: #ef4444;
            border: 1px solid #fecaca;
        }

        .badge-gray {
            background: #e2e8f0;
            color: #475569;
        }

        /* Payment Radio Items */
        .payment-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 24px;
        }

        .payment-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 20px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .payment-item.selected {
            border-color: #1d667f;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(29, 102, 127, 0.06);
        }

        .payment-item-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .payment-radio-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .payment-item.selected .payment-radio-circle {
            border-color: #1d667f;
            background: #1d667f;
        }

        .payment-item.selected .payment-radio-circle::after {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ffffff;
        }

        .payment-name {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .payment-icon {
            font-size: 18px;
            color: #64748b;
        }

        /* Promo Sub-box */
        .promo-box {
            background: #f0f7ff;
            border-radius: 16px;
            padding: 18px;
            border: 1px solid #bae6fd;
            display: flex;
            gap: 12px;
        }

        .btn-apply-promo {
            background: #1d667f;
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .btn-apply-promo:hover {
            background: #14495c;
        }

        /* Right Column: Order Summary Sidebar */
        .order-summary-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            position: sticky;
            top: 100px;
        }

        .summary-banner {
            height: 140px;
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .summary-banner-shapes {
            font-size: 70px;
            color: rgba(2, 132, 199, 0.15);
        }

        .summary-content {
            padding: 24px 28px 28px;
        }

        .summary-pill-tag {
            display: inline-block;
            background: #f3e8ff;
            color: #9333ea;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
        }

        .summary-program-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 10px;
            line-height: 1.3;
        }

        .summary-duration {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .summary-features-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .summary-feature-item {
            font-size: 13px;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-feature-item i {
            color: #0284c7;
            font-size: 14px;
        }

        /* Price Breakdown */
        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13.5px;
            color: #64748b;
            margin-bottom: 10px;
        }

        .price-row.discount-row {
            color: #0284c7;
            font-weight: 600;
        }

        .badge-free {
            background: #e0f2fe;
            color: #0369a1;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 6px;
        }

        .price-divider {
            border-top: 1px dashed #e2e8f0;
            margin: 16px 0;
        }

        .total-price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .total-label {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
        }

        .total-amount {
            font-size: 22px;
            font-weight: 800;
            color: #1d667f;
        }

        /* Submit Button */
        .btn-checkout-submit {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: #1d667f;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            padding: 16px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 18px rgba(29, 102, 127, 0.25);
            text-decoration: none;
        }

        .btn-checkout-submit:hover {
            background: #14495c;
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(29, 102, 127, 0.35);
        }

        .security-footer-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 18px;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.4;
        }

        .security-footer-note i {
            color: #64748b;
            font-size: 14px;
            margin-top: 2px;
        }

        @media (max-width: 1024px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
            .order-summary-card {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .form-row-2col, .batch-grid {
                grid-template-columns: 1fr;
            }
            .form-section-card {
                padding: 24px 18px;
            }
        }
    </style>
    @endpush

    <div class="checkout-page-container">
        <div class="checkout-wrapper">

            <!-- Step Wizard Progress Bar -->
            <div class="checkout-steps-bar">
                <div class="step-item step-completed">
                    <div class="step-circle"><i class="fas fa-check"></i></div>
                    <span class="step-label">Pilih Kelas</span>
                </div>
                <div class="step-line step-line-active"></div>
                <div class="step-item step-active">
                    <div class="step-circle">2</div>
                    <span class="step-label">Informasi & Pembayaran</span>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">3</div>
                    <span class="step-label">Akses Kelas</span>
                </div>
            </div>

            <!-- Form & Summary Grid -->
            <form action="{{ url('/daftar-event') }}" method="POST">
                @csrf
                <div class="checkout-grid">

                    <!-- Left Column: Sections -->
                    <div>
                        
                        <!-- Section 1: Data Diri Peserta -->
                        <div class="form-section-card">
                            <div class="section-header">
                                <div class="section-icon-badge">
                                    <i class="far fa-user"></i>
                                </div>
                                <h2 class="section-title">Data Diri Peserta</h2>
                            </div>

                            <div class="form-group mb-4">
                                <label class="input-group-label" for="nama">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="custom-form-input" placeholder="Masukkan nama sesuai KTP/Ijazah" required value="{{ old('nama', auth()->user()->name ?? '') }}">
                            </div>

                            <div class="form-row-2col">
                                <div>
                                    <label class="input-group-label" for="email">Alamat Email</label>
                                    <input type="email" name="email" id="email" class="custom-form-input" placeholder="email@contoh.com" required value="{{ old('email', auth()->user()->email ?? '') }}">
                                </div>
                                <div>
                                    <label class="input-group-label" for="whatsapp">Nomor WhatsApp</label>
                                    <input type="tel" name="whatsapp" id="whatsapp" class="custom-form-input" placeholder="+62 81234567890" required value="{{ old('whatsapp') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Pilih Jadwal Batch -->
                        <div class="form-section-card">
                            <div class="section-header">
                                <div class="section-icon-badge">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <h2 class="section-title">Pilih Jadwal Batch</h2>
                            </div>

                            <div class="batch-grid">
                                <!-- Batch Option 1 -->
                                <div class="batch-card selected" onclick="selectBatch(this, 'sep')">
                                    <h3 class="batch-card-title">Batch September</h3>
                                    <p class="batch-card-dates">15 Sep - 15 Des 2024</p>
                                    <span class="batch-slot-badge badge-red">
                                        <i class="fas fa-circle text-[8px]"></i> Sisa 4 Slot
                                    </span>
                                </div>

                                <!-- Batch Option 2 -->
                                <div class="batch-card" onclick="selectBatch(this, 'okt')">
                                    <h3 class="batch-card-title">Batch Oktober</h3>
                                    <p class="batch-card-dates">15 Okt - 15 Jan 2025</p>
                                    <span class="batch-slot-badge badge-gray">
                                        Pendaftaran Dibuka
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Metode Pembayaran -->
                        <div class="form-section-card">
                            <div class="section-header">
                                <div class="section-icon-badge">
                                    <i class="far fa-credit-card"></i>
                                </div>
                                <h2 class="section-title">Metode Pembayaran</h2>
                            </div>

                            <div class="payment-list">
                                <!-- Option 1: QRIS -->
                                <div class="payment-item selected" onclick="selectPayment(this)">
                                    <div class="payment-item-left">
                                        <div class="payment-radio-circle"></div>
                                        <span class="payment-name">QRIS</span>
                                    </div>
                                    <i class="fas fa-qrcode payment-icon"></i>
                                </div>

                                <!-- Option 2: Virtual Account -->
                                <div class="payment-item" onclick="selectPayment(this)">
                                    <div class="payment-item-left">
                                        <div class="payment-radio-circle"></div>
                                        <span class="payment-name">Virtual Account</span>
                                    </div>
                                    <i class="fas fa-university payment-icon"></i>
                                </div>

                                <!-- Option 3: Credit / Debit Card -->
                                <div class="payment-item" onclick="selectPayment(this)">
                                    <div class="payment-item-left">
                                        <div class="payment-radio-circle"></div>
                                        <span class="payment-name">Kartu Kredit / Debit</span>
                                    </div>
                                    <i class="far fa-credit-card payment-icon"></i>
                                </div>
                            </div>

                            <!-- Promo Code Box -->
                            <div class="promo-box">
                                <input type="text" class="custom-form-input" style="background:#ffffff" placeholder="Masukkan kode promo">
                                <button type="button" class="btn-apply-promo">Terapkan</button>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column: Sidebar Order Summary -->
                    <div>
                        <div class="order-summary-card">
                            <!-- Banner -->
                            <div class="summary-banner">
                                <div class="summary-banner-shapes">
                                    <i class="fas fa-cubes"></i>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="summary-content">
                                <span class="summary-pill-tag">Bootcamp</span>
                                <h3 class="summary-program-title">Bootcamp Intensif Full Stack Web Dev</h3>
                                <p class="summary-duration">
                                    <i class="far fa-clock"></i> 12 Minggu Pembelajaran
                                </p>

                                <div class="summary-features-list">
                                    <div class="summary-feature-item">
                                        <i class="far fa-check-circle"></i> Akses selamanya ke materi kelas
                                    </div>
                                    <div class="summary-feature-item">
                                        <i class="far fa-check-circle"></i> Sesi Live Mentoring Mingguan
                                    </div>
                                    <div class="summary-feature-item">
                                        <i class="far fa-check-circle"></i> Review Portfolio & Bantuan Penyaluran Kerja
                                    </div>
                                </div>

                                <!-- Price Calculations -->
                                <div class="price-row">
                                    <span>Harga Normal</span>
                                    <span class="line-through text-slate-400">Rp 5.000.000</span>
                                </div>
                                <div class="price-row discount-row">
                                    <span>Diskon (Promo Launch)</span>
                                    <span>- Rp 2.500.000</span>
                                </div>
                                <div class="price-row">
                                    <span>Biaya Layanan</span>
                                    <span class="badge-free">Gratis</span>
                                </div>

                                <div class="price-divider"></div>

                                <div class="total-price-row">
                                    <span class="total-label">Total Pembayaran</span>
                                    <span class="total-amount">Rp 2.500.000</span>
                                </div>

                                <button type="submit" class="btn-checkout-submit">
                                    Bayar & Amankan Slot Kelas <i class="fas fa-arrow-right"></i>
                                </button>

                                <div class="security-footer-note">
                                    <i class="fas fa-lock"></i>
                                    <span>Pembayaran aman & terenkripsi. Garansi uang kembali 7 hari.</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    @push('scripts')
    <script>
        function selectBatch(element, batchKey) {
            document.querySelectorAll('.batch-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');
        }

        function selectPayment(element) {
            document.querySelectorAll('.payment-item').forEach(item => item.classList.remove('selected'));
            element.classList.add('selected');
        }
    </script>
    @endpush
</x-layout>
