<x-layout title="Menunggu Pembayaran - Elcoding Academy">
    @push('styles')
    <style>
        .payment-page-bg {
            background-color: #f8fafc;
            min-height: 100vh;
            padding: 40px 20px 80px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            justify-content: center;
        }

        .payment-container {
            width: 100%;
            max-width: 640px;
            text-align: center;
        }

        /* Countdown Pill */
        .timer-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fef3c7;
            border: 1px solid #fde68a;
            color: #92400e;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .payment-main-title {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 6px;
            letter-spacing: -0.02em;
        }

        .payment-order-id {
            font-size: 14px;
            color: #64748b;
            margin: 0 0 32px;
        }

        /* Card Component */
        .payment-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            text-align: left;
            margin-bottom: 24px;
            position: relative;
        }

        .card-top-accent {
            height: 6px;
            background: #1d667f;
            width: 100%;
        }

        .card-body-padding {
            padding: 28px 32px;
        }

        /* Purchased Item Box */
        .purchased-item-box {
            background: #f1f5f9;
            border-radius: 14px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .purchased-icon-sq {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #1d667f;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .purchased-label {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.05em;
            margin: 0 0 2px;
        }

        .purchased-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            line-height: 1.3;
        }

        /* Bank Header Row */
        .bank-badge-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding-bottom: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .bank-tag-bca {
            background: #e0f2fe;
            color: #0369a1;
            font-size: 13px;
            font-weight: 800;
            padding: 6px 14px;
            border-radius: 8px;
        }

        .bank-name-label {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }

        /* Value Display Boxes */
        .value-group {
            margin-bottom: 18px;
        }

        .value-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 6px;
            display: block;
        }

        .value-copy-box {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .va-number-text {
            font-family: monospace;
            font-size: 20px;
            font-weight: 800;
            color: #1d667f;
            letter-spacing: 2px;
        }

        .amount-number-text {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
        }

        .btn-copy-action {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #1d667f;
            font-size: 13px;
            font-weight: 700;
            padding: 7px 16px;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-copy-action:hover {
            background: #f8fafc;
            border-color: #1d667f;
        }

        .nominal-alert-note {
            font-size: 12px;
            color: #dc2626;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
        }

        /* Instruction Tabs */
        .instruction-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 18px;
        }

        .instruction-tabs {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 20px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            padding: 8px 4px 12px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            position: relative;
            transition: color 0.2s ease;
        }

        .tab-btn.active {
            color: #1d667f;
            font-weight: 700;
        }

        .tab-btn.active::after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: #1d667f;
        }

        /* Step List */
        .steps-instruction-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .step-instruction-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            font-size: 13.5px;
            color: #334155;
            line-height: 1.5;
        }

        .step-num-badge {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #e0f2fe;
            color: #0284c7;
            font-size: 12px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .inline-code-box {
            background: #e2e8f0;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: monospace;
            font-weight: 700;
            color: #0f172a;
            font-size: 12px;
        }

        /* Bottom Action Button */
        .btn-check-status {
            background: #1d667f;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 32px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 18px rgba(29, 102, 127, 0.25);
            text-decoration: none;
            margin-top: 12px;
        }

        .btn-check-status:hover {
            background: #14495c;
            transform: translateY(-2px);
        }

        .verification-note {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 10px;
        }

        .whatsapp-help-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1d667f;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            margin-top: 24px;
            transition: color 0.2s ease;
        }

        .whatsapp-help-link:hover {
            color: #14495c;
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .card-body-padding {
                padding: 20px 18px;
            }
            .va-number-text, .amount-number-text {
                font-size: 16px;
            }
        }
    </style>
    @endpush

    <div class="payment-page-bg">
        <div class="payment-container">
            
            <!-- Timer Badge Pill -->
            <div class="timer-badge-pill">
                <i class="far fa-clock"></i> Selesaikan pembayaran dalam <span id="countdownTimer">23:59:45</span>
            </div>

            <!-- Title & Subtitle -->
            <h1 class="payment-main-title">Menunggu Pembayaran</h1>
            <p class="payment-order-id">Order ID: #ELC-89210</p>

            <!-- Card 1: Invoice & VA Details -->
            <div class="payment-card">
                <div class="card-top-accent"></div>
                <div class="card-body-padding">
                    
                    <!-- Purchased Item -->
                    <div class="purchased-item-box">
                        <div class="purchased-icon-sq">
                            <i class="fas fa-code"></i>
                        </div>
                        <div>
                            <p class="purchased-label">ITEM YANG DIBELI</p>
                            <h3 class="purchased-title">Bootcamp Intensif Full Stack Web Dev (12 Minggu)</h3>
                        </div>
                    </div>

                    <!-- Bank Tag -->
                    <div class="bank-badge-row">
                        <span class="bank-tag-bca">BCA</span>
                        <span class="bank-name-label">BCA Virtual Account</span>
                    </div>

                    <!-- Virtual Account Box -->
                    <div class="value-group">
                        <span class="value-label">Nomor Virtual Account</span>
                        <div class="value-copy-box">
                            <span class="va-number-text" id="vaNumber">8801 2345 6789 0012</span>
                            <button type="button" class="btn-copy-action" onclick="copyText('vaNumber', this)">
                                <i class="far fa-copy"></i> Salin
                            </button>
                        </div>
                    </div>

                    <!-- Total Amount Box -->
                    <div class="value-group">
                        <span class="value-label">Total Pembayaran</span>
                        <div class="value-copy-box">
                            <span class="amount-number-text" id="totalAmount">Rp 2.500.000</span>
                            <button type="button" class="btn-copy-action" onclick="copyText('totalAmount', this)">
                                <i class="far fa-copy"></i> Salin
                            </button>
                        </div>
                    </div>

                    <div class="nominal-alert-note">
                        <i class="fas fa-info-circle"></i> Pastikan nominal transfer sesuai hingga 3 digit terakhir.
                    </div>

                </div>
            </div>

            <!-- Card 2: Cara Pembayaran -->
            <div class="payment-card">
                <div class="card-body-padding">
                    <h2 class="instruction-title">Cara Pembayaran</h2>

                    <div class="instruction-tabs">
                        <button class="tab-btn active" onclick="switchTab(this, 'mbca')">m-BCA</button>
                        <button class="tab-btn" onclick="switchTab(this, 'atmbca')">ATM BCA</button>
                        <button class="tab-btn" onclick="switchTab(this, 'klikbca')">KlikBCA</button>
                    </div>

                    <!-- Tab Content: m-BCA -->
                    <div class="steps-instruction-list" id="tab-mbca">
                        <div class="step-instruction-item">
                            <div class="step-num-badge">1</div>
                            <div>Buka aplikasi BCA mobile dan login.</div>
                        </div>
                        <div class="step-instruction-item">
                            <div class="step-num-badge">2</div>
                            <div>Pilih menu m-Transfer > BCA Virtual Account.</div>
                        </div>
                        <div class="step-instruction-item">
                            <div class="step-num-badge">3</div>
                            <div>Masukkan nomor Virtual Account <span class="inline-code-box">8801 2345 6789 0012</span> dan pilih Send.</div>
                        </div>
                        <div class="step-instruction-item">
                            <div class="step-num-badge">4</div>
                            <div>Cek detail transaksi dan masukkan PIN m-BCA Anda. Pembayaran selesai.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Actions -->
            <div class="mt-4">
                <button type="button" class="btn-check-status" onclick="checkStatus(this)">
                    <i class="fas fa-sync-alt"></i> Cek Status Pembayaran
                </button>
                <p class="verification-note">
                    Status pembayaran akan terverifikasi otomatis dalam 1-3 menit setelah transfer.
                </p>

                <div>
                    <a href="https://wa.me/{{ \App\Models\Setting::getValue('contact_whatsapp_chat', '6281476652656') }}?text=Halo%20Admin%20Elcoding,%20saya%20butuh%20bantuan%20pembayaran%20Order%20%23ELC-89210" target="_blank" class="whatsapp-help-link">
                        <i class="fab fa-whatsapp text-lg"></i> Butuh bantuan? Hubungi Admin via WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        function copyText(elementId, btnElement) {
            const textToCopy = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(textToCopy).then(() => {
                const originalHtml = btnElement.innerHTML;
                btnElement.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                btnElement.style.color = '#16a34a';
                setTimeout(() => {
                    btnElement.innerHTML = originalHtml;
                    btnElement.style.color = '#1d667f';
                }, 2000);
            });
        }

        function switchTab(btn, tabId) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        }

        function checkStatus(btn) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memeriksa Status...';
            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check-circle"></i> Pembayaran Belum Terdeteksi';
                setTimeout(() => { btn.innerHTML = originalText; }, 3000);
            }, 1500);
        }

        // Live Countdown Timer
        let seconds = 23 * 3600 + 59 * 60 + 45;
        setInterval(() => {
            if (seconds > 0) {
                seconds--;
                const h = String(Math.floor(seconds / 3600)).padStart(2, '0');
                const m = String(Math.floor((seconds % 3600) / 60)).padStart(2, '0');
                const s = String(seconds % 60).padStart(2, '0');
                document.getElementById('countdownTimer').innerText = `${h}:${m}:${s}`;
            }
        }, 1000);
    </script>
    @endpush
</x-layout>
