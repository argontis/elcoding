<x-layout title="Pembayaran Berhasil - Elcoding Academy">
    @push('styles')
    <style>
        .paid-page-bg {
            background-color: #f8fafc;
            min-height: 100vh;
            padding: 40px 20px 80px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            justify-content: center;
        }

        .paid-container {
            width: 100%;
            max-width: 680px;
        }

        /* Breadcrumbs */
        .paid-breadcrumbs {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .paid-breadcrumbs a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .paid-breadcrumbs a:hover {
            color: #1d667f;
        }

        .paid-breadcrumbs span.active {
            color: #1d667f;
            font-weight: 700;
        }

        /* Main Card */
        .paid-main-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .paid-card-top-accent {
            height: 6px;
            background: linear-gradient(90deg, #1d667f 0%, #10b981 100%);
            width: 100%;
        }

        /* Header Area */
        .paid-header-area {
            padding: 40px 32px 32px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .paid-success-icon {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: #dcfce7;
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 18px;
        }

        .paid-title {
            font-size: 24px;
            font-weight: 800;
            color: #1d667f;
            margin: 0 0 10px;
            letter-spacing: -0.01em;
        }

        .paid-subtitle {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            max-width: 520px;
            margin: 0 auto;
        }

        /* Section Headings */
        .paid-section-heading {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.06em;
            color: #64748b;
            text-transform: uppercase;
            margin: 28px 32px 14px;
        }

        /* Invoice Summary Card */
        .invoice-summary-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            margin: 0 32px 28px;
            padding: 22px 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .invoice-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .invoice-label-sm {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .invoice-no-val {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
            font-family: monospace;
        }

        .badge-paid-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #dcfce7;
            color: #15803d;
            font-size: 12px;
            font-weight: 800;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .invoice-divider {
            border-top: 1px solid #f1f5f9;
            margin: 16px 0;
        }

        .invoice-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .invoice-detail-title {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .total-cost-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .total-cost-amount {
            font-size: 18px;
            font-weight: 800;
            color: #1d667f;
        }

        /* Next Steps Box */
        .next-steps-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            margin: 0 32px 32px;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .next-step-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .step-icon-square {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .icon-blue { background: #e0f2fe; color: #0284c7; }
        .icon-purple { background: #f3e8ff; color: #9333ea; }
        .icon-teal { background: #ccfbf1; color: #0d9488; }

        .step-content-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 4px;
        }

        .step-content-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
            margin: 0;
        }

        /* Buttons & Footer */
        .paid-cta-container {
            text-align: center;
            padding: 0 32px 32px;
        }

        .btn-whatsapp-group {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #10b981;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 32px;
            border-radius: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
            border: none;
        }

        .btn-whatsapp-group:hover {
            background: #059669;
            transform: translateY(-2px);
        }

        .paid-pdf-footer {
            background: #f8fafc;
            padding: 18px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
        }

        .link-download-pdf {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1d667f;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .link-download-pdf:hover {
            color: #14495c;
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .paid-header-area, .invoice-summary-card, .next-steps-card, .paid-cta-container {
                padding-left: 20px;
                padding-right: 20px;
            }
            .paid-section-heading {
                margin-left: 20px;
                margin-right: 20px;
            }
            .invoice-details-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @endpush

    <div class="paid-page-bg">
        <div class="paid-container">
            
            <!-- Breadcrumb -->
            <nav class="paid-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ url('/') }}">Home</a>
                <span>></span>
                <a href="{{ url('/data-diri') }}">Checkout</a>
                <span>></span>
                <a href="{{ url('/pembayaran') }}">Status Pembayaran</a>
                <span>></span>
                <span class="active">Berhasil</span>
            </nav>

            <!-- Main Card -->
            <div class="paid-main-card">
                <div class="paid-card-top-accent"></div>

                <!-- Header Area -->
                <div class="paid-header-area">
                    <div class="paid-success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                    <h1 class="paid-title">Pembayaran Berhasil Diverifikasi!</h1>
                    <p class="paid-subtitle">
                        Selamat, Anda resmi terdaftar di <strong>Bootcamp Intensif Full Stack Web Dev</strong> (Batch September 2026).
                    </p>
                </div>

                <!-- Section: RINCIAN TRANSAKSI -->
                <h2 class="paid-section-heading">Rincian Transaksi</h2>

                <div class="invoice-summary-card">
                    <div class="invoice-header-row">
                        <div>
                            <div class="invoice-label-sm">No. Invoice</div>
                            <div class="invoice-no-val">#INV-ELC-20260818-8821</div>
                        </div>
                        <span class="badge-paid-status">
                            <i class="fas fa-check-circle"></i> PAID
                        </span>
                    </div>

                    <div class="invoice-divider"></div>

                    <div class="invoice-details-grid">
                        <div>
                            <div class="invoice-label-sm">Metode Pembayaran</div>
                            <div class="invoice-detail-title">
                                <i class="fas fa-university text-slate-400"></i> BCA Virtual Account
                            </div>
                        </div>
                        <div>
                            <div class="invoice-label-sm">Waktu Transaksi</div>
                            <div class="invoice-detail-title">
                                <i class="far fa-clock text-slate-400"></i> 18 Agustus 2026, 15:00 WIB
                            </div>
                        </div>
                    </div>

                    <div class="invoice-divider"></div>

                    <div class="total-cost-row">
                        <span class="text-sm font-semibold text-slate-600">Total Biaya</span>
                        <span class="total-cost-amount">Rp 2.500.000</span>
                    </div>
                </div>

                <!-- Section: LANGKAH SELANJUTNYA -->
                <h2 class="paid-section-heading">Langkah Selanjutnya</h2>

                <div class="next-steps-card">
                    
                    <!-- Step 1 -->
                    <div class="next-step-item">
                        <div class="step-icon-square icon-blue">
                            <i class="far fa-envelope"></i>
                        </div>
                        <div>
                            <h3 class="step-content-title">Cek Email Anda</h3>
                            <p class="step-content-desc">Kami telah mengirimkan akses materi, panduan awal, dan kuitansi resmi ke email terdaftar.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="next-step-item">
                        <div class="step-icon-square icon-purple">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h3 class="step-content-title">Koordinasi Kelas</h3>
                            <p class="step-content-desc">Silakan bergabung dengan grup komunikasi angkatan Anda untuk informasi jadwal live session.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="next-step-item">
                        <div class="step-icon-square icon-teal">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div>
                            <h3 class="step-content-title">Mulai Belajar</h3>
                            <p class="step-content-desc">Anda sudah bisa mengakses Modul 01 Pre-class di Ruang Belajar.</p>
                        </div>
                    </div>

                </div>

                <!-- WhatsApp Button -->
                <div class="paid-cta-container">
                    <a href="https://chat.whatsapp.com/elcoding-bootcamp-2026" target="_blank" class="btn-whatsapp-group">
                        <i class="fab fa-whatsapp text-xl"></i> Gabung Grup WhatsApp
                    </a>
                </div>

                <!-- PDF Footer Link -->
                <div class="paid-pdf-footer">
                    <a href="#" onclick="alert('Mengunduh kuitansi resmi PDF...'); return false;" class="link-download-pdf">
                        <i class="fas fa-download"></i> Unduh Kuitansi Pembayaran (PDF)
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-layout>
