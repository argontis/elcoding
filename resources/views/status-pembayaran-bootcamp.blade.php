<x-layout title="Status Pembayaran Bootcamp - Elcoding Academy">

@push('styles')
<style>
    /* Page Layout */
    .status-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-bottom: 80px;
    }

    /* Top Sub-Header Bar */
    .status-top-bar {
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        padding: 16px 0;
        margin-bottom: 40px;
    }

    .top-bar-container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .top-bar-links {
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .top-bar-link {
        font-size: 14px;
        font-weight: 700;
        color: #1c6296;
        text-decoration: none;
        transition: color 0.2s;
    }

    .top-bar-link:hover {
        color: #154b73;
    }

    .user-avatar-icon {
        width: 38px;
        height: 38px;
        background: #1c6296;
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    /* Step Progress Indicator Bar */
    .progress-bar-wrapper {
        max-width: 600px;
        margin: 0 auto 40px;
        padding: 0 20px;
    }

    .progress-steps {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
    }

    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        z-index: 2;
        position: relative;
    }

    .step-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
        transition: all 0.3s;
    }

    .step-circle.completed {
        background: #1c6296;
        color: #ffffff;
    }

    .step-circle.active {
        background: #1c6296;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(28, 98, 150, 0.15);
    }

    .step-circle.pending {
        background: #e2e8f0;
        color: #64748b;
    }

    .step-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
    }

    .step-label.active {
        color: #1c6296;
    }

    /* Connecting Lines */
    .step-line-container {
        position: absolute;
        top: 18px;
        left: 40px;
        right: 40px;
        height: 2px;
        background: #e2e8f0;
        z-index: 1;
    }

    .step-line-active {
        height: 100%;
        width: 50%;
        background: #1c6296;
        transition: width 0.3s ease;
    }

    /* Center Section: Countdown & Heading */
    .status-header {
        text-align: center;
        max-width: 600px;
        margin: 0 auto 36px;
        padding: 0 20px;
    }

    .timer-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #334155;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 18px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .timer-pill i {
        color: #64748b;
    }

    .main-status-title {
        font-size: 32px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 8px;
        letter-spacing: -0.5px;
    }

    .order-id-code {
        font-size: 14px;
        color: #64748b;
        font-family: monospace;
        margin: 0;
    }

    /* Content Cards Container */
    .status-container {
        max-width: 720px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Card 1: Virtual Account Details */
    .va-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
    }

    .bank-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
    }

    .bank-logo-icon {
        width: 52px;
        height: 38px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #1c6296;
    }

    .bank-title-name {
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 2px;
    }

    .bank-subtext {
        font-size: 13px;
        color: #64748b;
        margin: 0;
    }

    .va-details-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }

    .info-box {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        padding: 16px;
        position: relative;
    }

    .info-label {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 8px;
        display: block;
    }

    .info-value {
        font-size: 22px;
        font-weight: 800;
        color: #1c6296;
        letter-spacing: 0.5px;
    }

    .va-number {
        font-family: monospace;
        letter-spacing: 1.5px;
    }

    .btn-copy {
        position: absolute;
        top: 16px;
        right: 16px;
        background: transparent;
        border: none;
        color: #1c6296;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 6px;
        transition: background 0.2s;
    }

    .btn-copy:hover {
        background: #e0f2fe;
    }

    .warning-notice {
        background: #fafafa;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 13px;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 10px;
        line-height: 1.4;
    }

    .warning-notice i {
        color: #1e293b;
        font-size: 16px;
    }

    /* Card 2: Payment Instruction Tabs */
    .instruction-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        margin-bottom: 32px;
    }

    .tab-header {
        display: flex;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
    }

    .instruction-tab {
        flex: 1;
        text-align: center;
        padding: 14px 20px;
        font-size: 14px;
        font-weight: 700;
        color: #64748b;
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.25s ease;
    }

    .instruction-tab.active {
        color: #1c6296;
        background: #ffffff;
        border-bottom-color: #1c6296;
    }

    .tab-content-panel {
        padding: 24px 28px;
        display: none;
    }

    .tab-content-panel.active {
        display: block;
    }

    .instruction-steps {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .step-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        font-size: 14px;
        color: #334155;
        line-height: 1.5;
    }

    .step-num-badge {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #e0f2fe;
        color: #0284c7;
        font-weight: 800;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .code-inline {
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 6px;
        font-family: monospace;
        font-weight: 700;
        color: #1e293b;
    }

    /* Bottom Action & Help Section */
    .action-center {
        text-align: center;
        margin-bottom: 40px;
    }

    .btn-check-status {
        background: #1c6296;
        color: #ffffff !important;
        border: none;
        padding: 14px 36px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(28, 98, 150, 0.2);
    }

    .btn-check-status:hover {
        background: #154b73;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(28, 98, 150, 0.3);
    }

    .auto-verify-note {
        font-size: 13px;
        color: #64748b;
        margin-top: 14px;
    }

    .whatsapp-help-link {
        color: #1c6296;
        text-decoration: none;
        font-weight: 700;
        font-size: 13px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
        transition: color 0.2s;
    }

    .whatsapp-help-link:hover {
        color: #154b73;
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .va-details-grid {
            grid-template-columns: 1fr;
        }

        .main-status-title {
            font-size: 24px;
        }

        .info-value {
            font-size: 18px;
        }
    }
</style>
@endpush

<div class="status-page">

    <!-- Top Navigation Bar -->
    <div class="status-top-bar">
        <div class="top-bar-container">
            <a href="{{ url('/') }}" style="display: flex; align-items: center; text-decoration: none;">
                <img src="{{ asset('gambar/aset/logo-elcoding.svg?v=2') }}" alt="Elcoding" style="height: 38px; width: auto;">
            </a>
            <div class="top-bar-links">
                <a href="{{ url('/') }}" class="top-bar-link">Dashboard</a>
                <a href="#" class="top-bar-link">Akun</a>
                <a href="#" class="user-avatar-icon" title="Profil">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Step Progress Wizard -->
    <div class="progress-bar-wrapper">
        <div class="progress-steps">
            <div class="step-line-container">
                <div class="step-line-active"></div>
            </div>

            <!-- Step 1: Pendaftaran (Completed) -->
            <div class="step-item">
                <div class="step-circle completed">
                    <i class="fas fa-check"></i>
                </div>
                <span class="step-label active">Pendaftaran</span>
            </div>

            <!-- Step 2: Pembayaran (Active) -->
            <div class="step-item">
                <div class="step-circle active">2</div>
                <span class="step-label active">Pembayaran</span>
            </div>

            <!-- Step 3: Akses Kelas (Pending) -->
            <div class="step-item">
                <div class="step-circle pending">3</div>
                <span class="step-label">Akses Kelas</span>
            </div>
        </div>
    </div>

    <!-- Header Status & Countdown -->
    <div class="status-header">
        <div class="timer-pill">
            <i class="far fa-clock"></i> Selesaikan Pembayaran dalam <span id="countdown">23:59:45</span>
        </div>
        <h1 class="main-status-title">Menunggu Pembayaran</h1>
        <p class="order-id-code">Order ID: #ELC-202608-8821</p>
    </div>

    <!-- Main Container Cards -->
    <div class="status-container">

        <!-- Card 1: Virtual Account Details -->
        <div class="va-card">
            <div class="bank-header">
                <div class="bank-logo-icon">
                    <i class="fas fa-university"></i>
                </div>
                <div>
                    <h2 class="bank-title-name">BCA VIRTUAL ACCOUNT</h2>
                    <p class="bank-subtext">a.n Elcoding Indonesia</p>
                </div>
            </div>

            <div class="va-details-grid">
                <!-- VA Number Box -->
                <div class="info-box">
                    <span class="info-label">Nomor Virtual Account</span>
                    <div class="info-value va-number" id="vaNum">8801 2345 6789 0012</div>
                    <button type="button" class="btn-copy" onclick="copyText('8801234567890012', 'Nomor Virtual Account')">
                        <i class="far fa-copy"></i> Salin
                    </button>
                </div>

                <!-- Total Amount Box -->
                <div class="info-box">
                    <span class="info-label">Total Tagihan</span>
                    <div class="info-value" id="totalAmount">Rp 2.500.000</div>
                    <button type="button" class="btn-copy" onclick="copyText('2500000', 'Total Tagihan')">
                        <i class="far fa-copy"></i> Salin
                    </button>
                </div>
            </div>

            <div class="warning-notice">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Pastikan nominal transfer sesuai hingga 3 digit terakhir untuk mempercepat proses verifikasi otomatis.</span>
            </div>
        </div>

        <!-- Card 2: Payment Instruction Tabs -->
        <div class="instruction-card">
            <div class="tab-header">
                <div class="instruction-tab active" onclick="switchInstructionTab('mbca', this)">m-BCA</div>
                <div class="instruction-tab" onclick="switchInstructionTab('atmbca', this)">ATM BCA</div>
                <div class="instruction-tab" onclick="switchInstructionTab('klikbca', this)">KlikBCA</div>
            </div>

            <!-- Panel 1: m-BCA -->
            <div class="tab-content-panel active" id="tab-mbca">
                <ul class="instruction-steps">
                    <li class="step-row">
                        <span class="step-num-badge">1</span>
                        <span>Buka aplikasi BCA mobile dan login ke m-BCA.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">2</span>
                        <span>Pilih menu <strong>m-Transfer &gt; BCA Virtual Account</strong>.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">3</span>
                        <span>Masukkan nomor Virtual Account <span class="code-inline">8801 2345 6789 0012</span> lalu pilih Send.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">4</span>
                        <span>Periksa kembali rincian pembayaran, lalu masukkan PIN m-BCA Anda.</span>
                    </li>
                </ul>
            </div>

            <!-- Panel 2: ATM BCA -->
            <div class="tab-content-panel" id="tab-atmbca">
                <ul class="instruction-steps">
                    <li class="step-row">
                        <span class="step-num-badge">1</span>
                        <span>Masukkan Kartu ATM BCA & PIN Anda di mesin ATM.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">2</span>
                        <span>Pilih menu <strong>Transaksi Lainnya &gt; Transfer &gt; Ke Rek BCA Virtual Account</strong>.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">3</span>
                        <span>Masukkan nomor Virtual Account <span class="code-inline">8801 2345 6789 0012</span> lalu tekan Benar.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">4</span>
                        <span>Konfirmasi rincian pembayaran dan selesaikan transaksi Anda.</span>
                    </li>
                </ul>
            </div>

            <!-- Panel 3: KlikBCA -->
            <div class="tab-content-panel" id="tab-klikbca">
                <ul class="instruction-steps">
                    <li class="step-row">
                        <span class="step-num-badge">1</span>
                        <span>Login ke akun KlikBCA Individu Anda di browser.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">2</span>
                        <span>Pilih menu <strong>Transfer Dana &gt; Transfer ke BCA Virtual Account</strong>.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">3</span>
                        <span>Masukkan nomor Virtual Account <span class="code-inline">8801 2345 6789 0012</span>.</span>
                    </li>
                    <li class="step-row">
                        <span class="step-num-badge">4</span>
                        <span>Validasi pembayaran menggunakan KeyBCA Appliance Anda.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Action Button & Help -->
        <div class="action-center">
            <button type="button" class="btn-check-status" onclick="checkStatus(this)">
                <i class="fas fa-sync-alt" id="refreshIcon"></i> Cek Status Pembayaran
            </button>

            <div class="auto-verify-note">
                Status pembayaran akan terverifikasi otomatis dalam 1-3 menit setelah transfer.
            </div>

            <div>
                <a href="https://wa.me/{{ \App\Models\Setting::getValue('contact_whatsapp_chat', '6281476652656') }}?text=Halo%20Admin%20Elcoding,%20saya%20butuh%20bantuan%20pembayaran%20bootcamp%20Order%20%23ELC-202608-8821" target="_blank" class="whatsapp-help-link">
                    <i class="fab fa-whatsapp"></i> Butuh bantuan? Hubungi Admin via WhatsApp
                </a>
            </div>
        </div>

    </div>

</div>

<script>
    // Instruction Tabs Switcher
    function switchInstructionTab(tabName, element) {
        const tabs = document.querySelectorAll('.instruction-tab');
        const panels = document.querySelectorAll('.tab-content-panel');

        tabs.forEach(t => t.classList.remove('active'));
        panels.forEach(p => p.classList.remove('active'));

        element.classList.add('active');
        document.getElementById('tab-' + tabName).classList.add('active');
    }

    // Copy to Clipboard helper
    function copyText(text, label) {
        navigator.clipboard.writeText(text).then(() => {
            alert(label + ' berhasil disalin ke clipboard!');
        }).catch(err => {
            alert('Gagal menyalin teks.');
        });
    }

    // Check status animation simulation
    function checkStatus(btn) {
        const icon = document.getElementById('refreshIcon');
        icon.classList.add('fa-spin');
        btn.disabled = true;
        btn.style.opacity = '0.8';

        setTimeout(() => {
            icon.classList.remove('fa-spin');
            btn.disabled = false;
            btn.style.opacity = '1';
            alert('Sistem sedang mengecek pembayaran... Jika sudah melakukan transfer, status akan otomatis terverifikasi.');
        }, 1500);
    }

    // Simple countdown timer script
    let totalSeconds = 23 * 3600 + 59 * 60 + 45;
    setInterval(() => {
        if (totalSeconds > 0) {
            totalSeconds--;
            let hours = Math.floor(totalSeconds / 3600);
            let minutes = Math.floor((totalSeconds % 3600) / 60);
            let seconds = totalSeconds % 60;

            document.getElementById('countdown').innerText = 
                (hours < 10 ? '0' + hours : hours) + ':' + 
                (minutes < 10 ? '0' + minutes : minutes) + ':' + 
                (seconds < 10 ? '0' + seconds : seconds);
        }
    }, 1000);
</script>

</x-layout>
