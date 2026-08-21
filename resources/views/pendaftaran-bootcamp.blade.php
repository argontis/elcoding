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



    <!-- Page Title -->
    <div class="header-section">
        <h1 class="page-title">Pendaftaran Bootcamp</h1>
        <p class="page-subtitle">
            Lengkapi data diri dan pilih jadwal belajar Anda untuk memulai perjalanan karir di industri teknologi.
        </p>
    </div>

    <!-- Registration Form & Summary Grid -->
    <div class="checkout-grid">
        <!-- Left Column: Course Details -->
        <div class="left-column">
            <div class="step-card">
                <h2 class="step-title" style="margin-bottom: 20px;">Deskripsi Bootcamp</h2>
                <p style="color: #4b5563; line-height: 1.8; font-size: 16px;">
                    Bootcamp intensif ini dirancang untuk membimbing Anda dari tingkat dasar hingga mahir. Anda akan belajar materi berbasis kurikulum industri terbaru dan didampingi oleh mentor profesional secara langsung.
                </p>
                
                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 30px 0 15px;">Fasilitas & Layanan</h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach($selectedProgram['highlights'] as $highlight)
                    <li style="font-size: 15px; color: #374151; padding: 10px 0; border-bottom: 1px dashed #e5e7eb; display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-check-circle" style="color: #10b981; font-size: 18px;"></i>
                        <span>{{ $highlight }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Right Column: Checkout Form -->
        <div class="right-column">
            <div class="summary-card" style="padding: 30px;">
                <span class="summary-badge">{{ $selectedProgram['badge'] }}</span>
                <h2 class="summary-course-title" style="margin-bottom: 10px;">{{ $selectedProgram['title'] }}</h2>
                
                <div style="font-size: 32px; font-weight: 800; color: #1c6296; margin-bottom: 5px;">{{ $selectedProgram['total'] }}</div>
                <div style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">Pembayaran Aman via Xendit Payment Gateway</div>

                <form action="{{ url('/pendaftaran-bootcamp') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_name" value="{{ $selectedProgram['title'] }}">
                    <input type="hidden" name="amount" value="{{ str_replace(['Rp ', '.'], '', $selectedProgram['total']) }}">

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;" for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama Anda" required value="{{ old('nama', auth()->user()->name ?? '') }}">
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;" for="email">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="contoh@email.com" required value="{{ old('email', auth()->user()->email ?? '') }}">
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label class="form-label" style="display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 6px;" for="whatsapp">Nomor WhatsApp / HP</label>
                        <input type="tel" name="whatsapp" id="whatsapp" class="form-control" placeholder="08xxxxxxxxxx" required value="{{ old('whatsapp') }}">
                    </div>

                    <button type="submit" class="btn-submit-pay" style="width: 100%; margin-top: 10px;">
                        <i class="fas fa-credit-card"></i> Bayar Sekarang
                    </button>
                </form>

                <div class="security-badge" style="margin-top: 20px;">
                    <i class="fas fa-shield-alt text-green-500"></i> Terenkripsi & Pembayaran Instan via Xendit
                </div>
            </div>
        </div>
    </div>



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
