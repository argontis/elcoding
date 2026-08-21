<x-layout title="Pendaftaran Workshop Online - Elcoding Academy">

@push('styles')
<style>
    /* Global Page Layout */
    .pendaftaran-workshop-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 80px;
    }

    /* Sub-header Navigation Back Bar */
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
    }

    .back-link {
        color: #475569;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #1c6296;
    }

    /* Main 2-Column Grid Layout */
    .checkout-grid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 32px;
        align-items: start;
    }

    /* Form Card Container (Left Column) */
    .section-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 24px;
    }

    .section-icon {
        font-size: 20px;
        color: #1c6296;
    }

    .section-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    /* Form Fields */
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

    /* Options Boxes (Section 2) */
    .options-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .option-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .option-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .option-checkbox-indicator {
        width: 18px;
        height: 18px;
        background: #1c6296;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 11px;
    }

    .option-title-text {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
    }

    .option-badge-free {
        background: #e0f2fe;
        color: #0284c7;
        font-size: 11px;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: 0.4px;
    }

    /* Payment Cards (Section 3) */
    .payment-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 24px;
    }

    .payment-card-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px;
        cursor: pointer;
        position: relative;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .payment-card-box:hover {
        border-color: #94a3b8;
    }

    .payment-card-box.selected {
        border: 2px solid #1c6296;
        background: #f8fafc;
        box-shadow: 0 4px 16px rgba(28, 98, 150, 0.08);
    }

    .payment-top-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 6px;
    }

    .payment-badge-tag {
        font-size: 11px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #334155;
    }

    .payment-recommend-tag {
        background: #ffedd5;
        color: #c2410c;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 8px;
        border-radius: 20px;
    }

    .radio-circle-custom {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-card-box.selected .radio-circle-custom {
        border-color: #1c6296;
    }

    .payment-card-box.selected .radio-circle-custom::after {
        content: '';
        width: 10px;
        height: 10px;
        background: #1c6296;
        border-radius: 50%;
    }

    .payment-title {
        font-size: 15px;
        font-weight: 800;
        color: #1e293b;
    }

    .payment-subtext {
        font-size: 12px;
        color: #64748b;
    }

    /* Promo Section */
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
        padding: 24px;
        border-bottom: 1px solid #f1f5f9;
    }

    .summary-badge-tag {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fde68a;
        font-size: 11px;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 20px;
        display: inline-block;
        margin-bottom: 12px;
    }

    .summary-workshop-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 12px;
        line-height: 1.35;
    }

    .summary-schedule-info {
        font-size: 13px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
    }

    .summary-img-banner {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 18px;
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
        font-weight: 600;
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
        .payment-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@php
    $workshopKey = request()->get('workshop', 'nextjs');

    $workshopsData = [
        'nextjs' => [
            'tag' => '🛠️ Hands-on Workshop',
            'title' => 'Membangun Web App Production-Ready dengan Next.js 15 & Prisma',
            'schedule' => '2 Hari Intensif (Sabtu & Minggu, 19.00 WIB)',
            'banner' => asset('gambar/workshop/workshop-nextjs.jpg'),
            'normal_price' => 'Rp 500.000',
            'discount' => '- Rp 301.000',
            'total' => 'Rp 199.000',
            'highlights' => [
                'Sesi Live Coding & Tanya Jawab',
                'Akses Source Code & Repository',
                'E-Sertifikat Resmi'
            ]
        ],
        'figma' => [
            'tag' => '🎨 Design Sprint',
            'title' => 'Membuat Scalable Design System & Interactive Prototype di Figma',
            'schedule' => '1 Hari Full (Sabtu, 09.00 - 16.00 WIB)',
            'banner' => asset('gambar/workshop/workshop-figma.jpg'),
            'normal_price' => 'Rp 450.000',
            'discount' => '- Rp 301.000',
            'total' => 'Rp 149.000',
            'highlights' => [
                'Hands-on Design System & Component Library',
                'Portfolio Asset Kit Included',
                'E-Sertifikat Resmi & Review Langsung'
            ]
        ],
        'devops' => [
            'tag' => '🚀 DevOps Crash Course',
            'title' => 'Automasi Deployment App Menggunakan Docker & GitHub Actions',
            'schedule' => '2 Hari (Sabtu-Minggu, 19.00 WIB)',
            'banner' => asset('gambar/workshop/workshop-devops.jpg'),
            'normal_price' => 'Rp 550.000',
            'discount' => '- Rp 301.000',
            'total' => 'Rp 249.000',
            'highlights' => [
                'Live Docker & CI/CD Hands-on Practice',
                'Cloud Sandbox Access Included',
                'E-Sertifikat Resmi'
            ]
        ]
    ];

    $selectedWorkshop = $workshopsData[$workshopKey] ?? $workshopsData['nextjs'];
@endphp

<div class="pendaftaran-workshop-page">



    <!-- Registration Form & Summary Grid -->
    <div class="checkout-grid">
        <!-- Left Column: Workshop Details -->
        <div class="left-column">
            <div class="section-card">
                <h2 class="section-title" style="margin-bottom: 20px;">Deskripsi Workshop</h2>
                <p style="color: #4b5563; line-height: 1.8; font-size: 16px;">
                    Ikuti sesi workshop praktis dan interaktif ini untuk meningkatkan skill Anda dalam waktu singkat. Anda akan mendapatkan hands-on experience langsung dari praktisi industri dengan panduan langkah demi langkah.
                </p>
                
                <h3 style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 30px 0 15px;">Materi & Fasilitas</h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach($selectedWorkshop['highlights'] as $highlight)
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
                <span class="summary-badge-tag" style="background: #fef3c7; color: #d97706; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; display: inline-block; margin-bottom: 12px;">{{ $selectedWorkshop['tag'] }}</span>
                <h2 class="summary-workshop-title" style="margin-bottom: 10px;">{{ $selectedWorkshop['title'] }}</h2>
                <div class="summary-schedule-info" style="font-size: 13px; color: #64748b; margin-bottom: 18px;">
                    <i class="far fa-calendar-alt"></i> {{ $selectedWorkshop['schedule'] }}
                </div>
                
                <div style="font-size: 32px; font-weight: 800; color: #1c6296; margin-bottom: 5px;">{{ $selectedWorkshop['total'] }}</div>
                <div style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">Pembayaran Aman via Xendit Payment Gateway</div>

                <form action="{{ url('/pendaftaran-workshop') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_name" value="{{ $selectedWorkshop['title'] }}">
                    <input type="hidden" name="amount" value="{{ str_replace(['Rp ', '.'], '', $selectedWorkshop['total']) }}">

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
    function selectWorkshopPayment(boxNum, val) {
        document.getElementById('payBox1').classList.remove('selected');
        document.getElementById('payBox2').classList.remove('selected');

        const selectedBox = document.getElementById('payBox' + boxNum);
        if (selectedBox) {
            selectedBox.classList.add('selected');
            const radio = selectedBox.querySelector('input[type="radio"]');
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
