<x-layout title="Daftar Event & Program - Elcoding Academy">
    @push('styles')
    <style>
        .event-modal-backdrop {
            min-height: calc(100vh - 120px);
            background: linear-gradient(135deg, rgba(248, 250, 252, 0.85) 0%, rgba(241, 245, 249, 0.95) 100%);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            position: relative;
        }

        .event-modal-card {
            background: #ffffff;
            width: 100%;
            max-width: 560px;
            border-radius: 28px;
            box-shadow: 0 25px 60px -15px rgba(15, 23, 42, 0.12), 0 0 1px rgba(15, 23, 42, 0.08);
            padding: 44px 40px;
            position: relative;
            border: 1px solid #f1f5f9;
            animation: modalFadeIn 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(10px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Close button */
        .event-modal-close {
            position: absolute;
            top: 24px;
            right: 24px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .event-modal-close:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        /* Top Icon */
        .event-modal-icon-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .event-modal-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #e0f2fe;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        /* Title & Subtitle */
        .event-modal-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .event-modal-title {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 10px;
            letter-spacing: -0.02em;
        }

        .event-modal-subtitle {
            font-size: 14px;
            color: #64748b;
            line-height: 1.6;
            max-width: 420px;
            margin: 0 auto;
        }

        /* Form Group */
        .event-form-group {
            margin-bottom: 20px;
        }

        .event-form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 8px;
        }

        .event-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .event-input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
            pointer-events: none;
            z-index: 10;
            transition: color 0.2s ease;
        }

        .event-form-input {
            width: 100%;
            height: 48px !important;
            padding-top: 12px !important;
            padding-bottom: 12px !important;
            padding-right: 18px !important;
            padding-left: 52px !important;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box !important;
        }

        .event-form-input::placeholder {
            color: #cbd5e1;
            opacity: 1;
        }

        .event-form-input:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 4px rgba(2, 132, 199, 0.1);
        }

        .event-input-wrapper:focus-within .event-input-icon {
            color: #0284c7;
        }

        /* Footer Section inside modal */
        .event-modal-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 32px;
            padding-top: 24px;
            position: relative;
        }

        .event-footer-info {
            font-size: 12px;
            color: #64748b;
            line-height: 1.5;
            max-width: 220px;
        }

        .btn-submit-event {
            background: #1d667f;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 14px;
            padding: 14px 24px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 18px rgba(29, 102, 127, 0.25);
            white-space: nowrap;
        }

        .btn-submit-event:hover {
            background: #14495c;
            transform: translateY(-2px);
            box-shadow: 0 6px 22px rgba(29, 102, 127, 0.35);
        }

        /* Bottom right decorative illustration pattern */
        .event-modal-decorative {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            opacity: 0.15;
            pointer-events: none;
            background-image: radial-gradient(#0284c7 2px, transparent 2px);
            background-size: 12px 12px;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            padding: 14px 18px;
            border-radius: 14px;
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        @media (max-width: 640px) {
            .event-modal-card {
                padding: 32px 24px;
                border-radius: 20px;
            }
            .event-modal-footer {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            .event-footer-info {
                max-width: 100%;
            }
            .btn-submit-event {
                justify-content: center;
            }
        }
    </style>
    @endpush

    <div class="event-modal-backdrop">
        <div class="event-modal-card">
            <!-- Close Button -->
            <a href="{{ url('/event-webinar') }}" class="event-modal-close" title="Tutup">
                <i class="fas fa-times"></i>
            </a>

            <!-- Top Icon -->
            <div class="event-modal-icon-wrapper">
                <div class="event-modal-icon">
                    <i class="fas fa-user-check"></i>
                </div>
            </div>

            <!-- Title & Subtitle -->
            <div class="event-modal-header">
                <h1 class="event-modal-title">Daftar Event & Program</h1>
                <p class="event-modal-subtitle">
                    Bergabunglah dengan komunitas elcoding.id dan tingkatkan skill programming Anda hari ini.
                </p>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle text-lg"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ url('/daftar-event') }}" method="POST">
                @csrf
                
                <!-- Nama Lengkap -->
                <div class="event-form-group">
                    <label class="event-form-label" for="nama">Nama Lengkap</label>
                    <div class="event-input-wrapper">
                        <i class="far fa-user event-input-icon"></i>
                        <input type="text" name="nama" id="nama" class="event-form-input" placeholder="eg: John Doe" required value="{{ old('nama', auth()->user()->name ?? '') }}">
                    </div>
                </div>

                <!-- Email Aktif -->
                <div class="event-form-group">
                    <label class="event-form-label" for="email">Email Aktif</label>
                    <div class="event-input-wrapper">
                        <i class="far fa-envelope event-input-icon"></i>
                        <input type="email" name="email" id="email" class="event-form-input" placeholder="eg: yourname@email.com" required value="{{ old('email', auth()->user()->email ?? '') }}">
                    </div>
                </div>

                <!-- Nomor WhatsApp -->
                <div class="event-form-group">
                    <label class="event-form-label" for="whatsapp">Nomor WhatsApp</label>
                    <div class="event-input-wrapper">
                        <i class="far fa-comment-alt event-input-icon"></i>
                        <input type="tel" name="whatsapp" id="whatsapp" class="event-form-input" placeholder="eg: +62 812..." required value="{{ old('whatsapp') }}">
                    </div>
                </div>

                <!-- Footer area -->
                <div class="event-modal-footer">
                    <p class="event-footer-info">
                        Anda akan diarahkan ke halaman pembayaran aman (Xendit). Harga tiket Event: <strong>Rp 50.000</strong>.
                    </p>
                    <button type="submit" class="btn-submit-event">
                        Lanjut ke Pembayaran <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>

            <div class="event-modal-decorative"></div>
        </div>
    </div>
</x-layout>
