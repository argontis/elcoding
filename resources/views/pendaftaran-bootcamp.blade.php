<x-layout title="Pendaftaran Bootcamp - Elcoding Academy">

@push('styles')
<style>
    /* Page Container */
    .pendaftaran-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 80px;
    }

    /* Sub-header Navigation Bar */
    .sub-header-bar {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 16px 0;
        margin-bottom: 40px;
    }

    .sub-header-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .back-link {
        color: #1c6296;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #154b73;
    }

    .user-avatar-btn {
        width: 38px;
        height: 38px;
        background: #1c6296;
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        text-decoration: none;
    }

    /* Page Heading */
    .header-section {
        max-width: 1200px;
        margin: 0 auto 36px;
        padding: 0 20px;
    }

    .page-title {
        font-size: 36px;
        font-weight: 800;
        color: #1c6296;
        margin: 0 0 10px;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        font-size: 16px;
        color: #475569;
        margin: 0;
        line-height: 1.5;
    }

    /* Main 2-Column Grid Layout */
    .checkout-grid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 410px;
        gap: 32px;
        align-items: start;
    }

    /* Form Cards (Left Column) */
    .step-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .step-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
    }

    .step-badge {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #e0f2fe;
        color: #0284c7;
        font-weight: 800;
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .step-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    /* Input Controls */
    .form-group {
        margin-bottom: 20px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 13px 16px;
        background: #f8fafc;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 14px;
        color: #1e293b;
        outline: none;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .form-control:focus {
        background: #ffffff;
        border-color: #1c6296;
        box-shadow: 0 0 0 3px rgba(28, 98, 150, 0.12);
    }

    .input-group-wa {
        display: flex;
        align-items: center;
    }

    .prefix-wa {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        border-right: none;
        border-radius: 10px 0 0 10px;
        padding: 13px 16px;
        font-size: 14px;
        font-weight: 700;
        color: #475569;
    }

    .input-group-wa .form-control {
        border-radius: 0 10px 10px 0;
    }

    .form-hint {
        font-size: 12px;
        color: #64748b;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .grid-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Batch Selection Options */
    .batch-options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .batch-card-option {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 20px;
        cursor: pointer;
        position: relative;
        transition: all 0.25s ease;
    }

    .batch-card-option:hover {
        border-color: #94a3b8;
    }

    .batch-card-option.selected {
        border: 2px solid #1c6296;
        background: #f8fafc;
        box-shadow: 0 4px 16px rgba(28, 98, 150, 0.08);
    }

    .slot-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #ffedd5;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .batch-title {
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 12px;
    }

    .batch-detail {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .batch-detail.highlight {
        color: #334155;
        font-weight: 600;
    }

    /* Payment Methods Grid */
    .payment-methods-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .payment-option-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .payment-option-card:hover {
        border-color: #94a3b8;
    }

    .payment-option-card.selected {
        border: 2px solid #1c6296;
        background: #f8fafc;
        box-shadow: 0 4px 12px rgba(28, 98, 150, 0.08);
    }

    .payment-icon {
        font-size: 22px;
        color: #1c6296;
    }

    .payment-name {
        font-size: 13px;
        font-weight: 800;
        color: #1e293b;
    }

    .promo-section {
        border-top: 1px solid #f1f5f9;
        padding-top: 20px;
    }

    .promo-input-wrapper {
        display: flex;
        gap: 12px;
    }

    .btn-apply-promo {
        background: #e2e8f0;
        color: #475569;
        border: none;
        border-radius: 10px;
        padding: 0 24px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-apply-promo:hover {
        background: #cbd5e1;
        color: #1e293b;
    }

    /* Order Summary Card (Right Column) */
    .summary-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        position: sticky;
        top: 100px;
    }

    .summary-header {
        background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
        padding: 24px;
        border-bottom: 1px solid #f1f5f9;
    }

    .summary-badge {
        background: #e0f2fe;
        color: #0369a1;
        font-size: 11px;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 12px;
        letter-spacing: 0.4px;
    }

    .summary-course-title {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 16px;
        line-height: 1.3;
    }

    .summary-highlights {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .summary-highlight-item {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #475569;
        font-weight: 500;
    }

    .check-icon {
        color: #1c6296;
        font-size: 14px;
    }

    /* Pricing Breakdown */
    .summary-body {
        padding: 24px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        margin-bottom: 12px;
        color: #64748b;
    }

    .price-row.discount {
        color: #ea580c;
        font-weight: 700;
    }

    .price-row.free {
        color: #16a34a;
        font-weight: 700;
    }

    .price-strike {
        text-decoration: line-through;
        color: #94a3b8;
    }

    .divider-line {
        border-top: 1px solid #f1f5f9;
        margin: 18px 0;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 24px;
    }

    .total-label {
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
    }

    .total-amount {
        font-size: 26px;
        font-weight: 800;
        color: #1c6296;
        letter-spacing: -0.5px;
    }

    .btn-submit-pay {
        width: 100%;
        background: #1c6296;
        color: #ffffff !important;
        border: none;
        border-radius: 10px;
        padding: 16px;
        font-size: 16px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(28, 98, 150, 0.2);
    }

    .btn-submit-pay:hover {
        background: #154b73;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(28, 98, 150, 0.3);
    }

    .security-badge {
        font-size: 12px;
        color: #64748b;
        text-align: center;
        margin-top: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    /* Responsive Breakdown */
    @media (max-width: 1024px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .summary-card {
            position: static;
        }
    }

    @media (max-width: 640px) {
        .grid-2col, .batch-options-grid {
            grid-template-columns: 1fr;
        }

        .payment-methods-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .page-title {
            font-size: 28px;
        }
    }
</style>
@endpush

@php
    $programKey = request()->get('program', 'bootcamp-web-dev');

    $programsData = [
        'bootcamp-web-dev' => [
            'badge' => 'Bootcamp Intensif',
            'title' => 'Bootcamp Full Stack Web Dev',
            'normal_price' => 'Rp 5.000.000',
            'discount' => '- Rp 2.500.000',
            'total' => 'Rp 2.500.000',
            'highlights' => [
                '12 Minggu Pembelajaran Intensif',
                'Live Mentoring Mingguan 1-on-1',
                'Review Portofolio Akhir & Persiapan Karir'
            ]
        ],
        'bootcamp-flutter' => [
            'badge' => 'Bootcamp Intensif',
            'title' => 'Mobile App Development - Flutter',
            'normal_price' => 'Rp 4.500.000',
            'discount' => '- Rp 2.250.000',
            'total' => 'Rp 2.250.000',
            'highlights' => [
                '10 Minggu Pembelajaran Intensif',
                'iOS & Android App Mastery',
                'Build Real Project & Mentoring 1-on-1'
            ]
        ],
        'bootcamp-ui-ux' => [
            'badge' => 'Bootcamp Intensif',
            'title' => 'UI/UX Design & Product Strategy',
            'normal_price' => 'Rp 3.800.000',
            'discount' => '- Rp 1.900.000',
            'total' => 'Rp 1.900.000',
            'highlights' => [
                '8 Minggu Pembelajaran Intensif',
                'Figma Mastery & Prototyping',
                'Build Design System & Portfolio'
            ]
        ]
    ];

    $selectedProgram = $programsData[$programKey] ?? $programsData['bootcamp-web-dev'];
@endphp

<div class="pendaftaran-page">

    <!-- Sub-header Navigation -->
    <div class="sub-header-bar">
        <div class="sub-header-container">
            <a href="{{ url('/bootcamp-intensif') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Program Bootcamp
            </a>
            <a href="#" class="user-avatar-btn" title="Akun Saya">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>

    <!-- Page Title -->
    <div class="header-section">
        <h1 class="page-title">Pendaftaran Bootcamp</h1>
        <p class="page-subtitle">
            Lengkapi data diri dan pilih jadwal belajar Anda untuk memulai perjalanan karir di industri teknologi.
        </p>
    </div>

    <!-- Registration Form & Summary Grid -->
    <form action="{{ url('/pendaftaran-bootcamp') }}" method="POST">
        @csrf
        <input type="hidden" name="program" value="{{ $programKey }}">

        <div class="checkout-grid">

            <!-- Left Column: Form Steps -->
            <div class="left-column">

                <!-- Step 1: Data Diri Peserta -->
                <div class="step-card">
                    <div class="step-header">
                        <div class="step-badge">1</div>
                        <h2 class="step-title">Data Diri Peserta</h2>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama sesuai KTP" required>
                    </div>

                    <div class="grid-2col">
                        <div class="form-group">
                            <label class="form-label" for="whatsapp">Nomor WhatsApp Aktif</label>
                            <div class="input-group-wa">
                                <span class="prefix-wa">+62</span>
                                <input type="tel" id="whatsapp" name="whatsapp" class="form-control" placeholder="81234567890" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required>
                            <div class="form-hint">
                                <i class="fas fa-info-circle"></i> Link LMS dan tiket kelas dikirim ke sini.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Pilih Batch Belajar -->
                <div class="step-card">
                    <div class="step-header">
                        <div class="step-badge">2</div>
                        <h2 class="step-title">Pilih Batch Belajar</h2>
                    </div>

                    <div class="batch-options-grid">
                        <!-- Option 1 -->
                        <div class="batch-card-option selected" id="batchOption1" onclick="selectBatch(1)">
                            <span class="slot-badge"><i class="fas fa-fire"></i> Sisa 3 Slot</span>
                            <input type="radio" name="batch" id="batch1" value="September 2026" checked style="display: none;">
                            <h3 class="batch-title">Batch September 2026</h3>
                            <div class="batch-detail"><i class="far fa-calendar-alt"></i> Weekend</div>
                            <div class="batch-detail highlight"><i class="far fa-clock"></i> Sabtu - Minggu, 19.00 WIB</div>
                        </div>

                        <!-- Option 2 -->
                        <div class="batch-card-option" id="batchOption2" onclick="selectBatch(2)">
                            <input type="radio" name="batch" id="batch2" value="Oktober 2026" style="display: none;">
                            <h3 class="batch-title">Batch Oktober 2026</h3>
                            <div class="batch-detail"><i class="far fa-calendar-alt"></i> Weekday</div>
                            <div class="batch-detail highlight"><i class="far fa-clock"></i> Selasa - Kamis, 19.30 WIB</div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Metode Pembayaran -->
                <div class="step-card">
                    <div class="step-header">
                        <div class="step-badge">3</div>
                        <h2 class="step-title">Metode Pembayaran</h2>
                    </div>

                    <div class="payment-methods-grid">
                        <div class="payment-option-card selected" id="payOption1" onclick="selectPayment(1, 'BCA VA')">
                            <input type="radio" name="payment_method" value="BCA VA" checked style="display: none;">
                            <span class="payment-icon"><i class="fas fa-university"></i></span>
                            <span class="payment-name">BCA VA</span>
                        </div>

                        <div class="payment-option-card" id="payOption2" onclick="selectPayment(2, 'Mandiri VA')">
                            <input type="radio" name="payment_method" value="Mandiri VA" style="display: none;">
                            <span class="payment-icon"><i class="fas fa-landmark"></i></span>
                            <span class="payment-name">Mandiri VA</span>
                        </div>

                        <div class="payment-option-card" id="payOption3" onclick="selectPayment(3, 'QRIS')">
                            <input type="radio" name="payment_method" value="QRIS" style="display: none;">
                            <span class="payment-icon"><i class="fas fa-qrcode"></i></span>
                            <span class="payment-name">QRIS</span>
                        </div>

                        <div class="payment-option-card" id="payOption4" onclick="selectPayment(4, 'Kartu Kredit')">
                            <input type="radio" name="payment_method" value="Kartu Kredit" style="display: none;">
                            <span class="payment-icon"><i class="far fa-credit-card"></i></span>
                            <span class="payment-name">Kartu Kredit</span>
                        </div>
                    </div>

                    <div class="promo-section">
                        <label class="form-label" for="promo">Kode Promo / Diskon</label>
                        <div class="promo-input-wrapper">
                            <input type="text" id="promo" name="promo_code" class="form-control" placeholder="MASUKKAN KODE">
                            <button type="button" class="btn-apply-promo" onclick="applyPromo()">Terapkan</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Order Summary -->
            <div class="right-column">
                <div class="summary-card">
                    <div class="summary-header">
                        <span class="summary-badge">{{ $selectedProgram['badge'] }}</span>
                        <h2 class="summary-course-title">{{ $selectedProgram['title'] }}</h2>
                        <ul class="summary-highlights">
                            @foreach($selectedProgram['highlights'] as $highlight)
                            <li class="summary-highlight-item">
                                <span class="check-icon"><i class="fas fa-check-circle"></i></span>
                                <span>{{ $highlight }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="summary-body">
                        <div class="price-row">
                            <span>Harga Normal</span>
                            <span class="price-strike">{{ $selectedProgram['normal_price'] }}</span>
                        </div>

                        <div class="price-row discount">
                            <span>Diskon Launching</span>
                            <span>{{ $selectedProgram['discount'] }}</span>
                        </div>

                        <div class="price-row free">
                            <span>Biaya Layanan</span>
                            <span>Gratis</span>
                        </div>

                        <div class="divider-line"></div>

                        <div class="total-row">
                            <span class="total-label">Total Pembayaran</span>
                            <span class="total-amount">{{ $selectedProgram['total'] }}</span>
                        </div>

                        <button type="submit" class="btn-submit-pay">
                            Bayar & Amankan Slot Kelas <i class="fas fa-arrow-right"></i>
                        </button>

                        <div class="security-badge">
                            <i class="fas fa-lock"></i> Pembayaran aman & terenkripsi. Garansi uang kembali 7 hari.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>

<script>
    function selectBatch(optionNumber) {
        document.getElementById('batchOption1').classList.remove('selected');
        document.getElementById('batchOption2').classList.remove('selected');

        document.getElementById('batchOption' + optionNumber).classList.add('selected');
        document.getElementById('batch' + optionNumber).checked = true;
    }

    function selectPayment(optionNumber, val) {
        for (let i = 1; i <= 4; i++) {
            const card = document.getElementById('payOption' + i);
            if (card) card.classList.remove('selected');
        }

        const selectedCard = document.getElementById('payOption' + optionNumber);
        if (selectedCard) {
            selectedCard.classList.add('selected');
            const radio = selectedCard.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;
        }
    }

    function applyPromo() {
        const input = document.getElementById('promo');
        if (input.value.trim()) {
            alert('Kode promo "' + input.value.trim() + '" berhasil diterapkan!');
        } else {
            alert('Silakan masukkan kode promo.');
        }
    }
</script>

</x-layout>
