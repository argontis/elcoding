<x-layout title="Pendaftaran Berhasil - Elcoding Academy">
    @push('styles')
    <style>
        .success-modal-backdrop {
            min-height: calc(100vh - 120px);
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
        }

        .success-modal-card {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            border-radius: 24px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.2);
            padding: 36px 32px 32px;
            position: relative;
            text-align: center;
            animation: successModalIn 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid #f1f5f9;
        }

        @keyframes successModalIn {
            from {
                opacity: 0;
                transform: scale(0.92) translateY(12px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Close icon */
        .success-modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .success-modal-close:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        /* Top Success Icon Badge */
        .success-icon-badge {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #dcfce7;
            color: #10b981;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            margin: 8px auto 20px;
        }

        .success-title {
            font-size: 22px;
            font-weight: 800;
            color: #1d667f;
            margin: 0 0 10px;
            letter-spacing: -0.01em;
        }

        .success-subtitle {
            font-size: 14px;
            color: #64748b;
            line-height: 1.5;
            margin: 0 0 24px;
        }

        /* Summary Info Box */
        .success-summary-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px 22px;
            text-align: left;
            border: 1px solid #f1f5f9;
            margin-bottom: 24px;
        }

        .summary-event-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 14px;
        }

        .summary-info-row {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13.5px;
            color: #475569;
            margin-bottom: 10px;
        }

        .summary-info-row:last-child {
            margin-bottom: 0;
        }

        .summary-info-row i {
            color: #1d667f;
            font-size: 15px;
            width: 18px;
            text-align: center;
        }

        /* WhatsApp Button */
        .btn-whatsapp-join {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            background: #22c55e;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 20px;
            border-radius: 14px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(34, 197, 94, 0.3);
            border: none;
        }

        .btn-whatsapp-join:hover {
            background: #16a34a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(34, 197, 94, 0.4);
        }

        .btn-whatsapp-join i {
            font-size: 20px;
        }

        /* Bottom Close Link */
        .link-back-close {
            display: inline-block;
            margin-top: 18px;
            font-size: 13px;
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .link-back-close:hover {
            color: #0f172a;
            text-decoration: underline;
        }

        @media (max-width: 520px) {
            .success-modal-card {
                padding: 28px 20px 24px;
            }
        }
    </style>
    @endpush

    <div class="success-modal-backdrop">
        <div class="success-modal-card">
            <!-- Close Button -->
            <a href="{{ url('/event-webinar') }}" class="success-modal-close" title="Tutup">
                <i class="fas fa-times"></i>
            </a>

            <!-- Success Icon Badge -->
            <div class="success-icon-badge">
                <i class="fas fa-check"></i>
            </div>

            <!-- Title & Subtitle -->
            <h1 class="success-title">Pendaftaran Berhasil!</h1>
            <p class="success-subtitle">
                Tiket dan link akses webinar telah dikirim ke email Anda.
            </p>

            <!-- Event Summary Box -->
            <div class="success-summary-box">
                <h2 class="summary-event-title">Webinar Modern Web 2026</h2>
                
                <div class="summary-info-row">
                    <i class="far fa-calendar-alt"></i>
                    <span>25 Agustus 2026 • 19.00 WIB</span>
                </div>
                
                <div class="summary-info-row">
                    <i class="fas fa-video"></i>
                    <span>Zoom Meeting (Link ada di email)</span>
                </div>
            </div>

            <!-- WhatsApp Group Button -->
            <a href="https://chat.whatsapp.com/elcoding-webinar-2026" target="_blank" class="btn-whatsapp-join">
                <i class="fab fa-whatsapp"></i> Gabung Grup WhatsApp Peserta
            </a>

            <!-- Bottom Link -->
            <a href="{{ url('/event-webinar') }}" class="link-back-close">
                Tutup / Kembali
            </a>
        </div>
    </div>
</x-layout>
