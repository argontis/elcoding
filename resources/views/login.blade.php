<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Elcoding Academy & L-Garage</title>
    <meta name="description" content="Login portal untuk Admin Elcoding Academy, Portal Bengkel L-Garage, dan Member.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --font-main: 'Plus Jakarta Sans', sans-serif;
            --font-heading: 'Outfit', sans-serif;

            /* Admin (Blue) theme */
            --accent: #4B6BF5;
            --accent-light: #dbeafe;
            --accent-glow: rgba(75,107,245,0.25);
            --bg-page: #f0f4ff;
            --bg-blob1: rgba(99,102,241,0.18);
            --bg-blob2: rgba(168,85,247,0.15);
            --bg-blob3: rgba(236,72,153,0.12);
            --card-bg: rgba(255,255,255,0.85);
            --card-border: rgba(255,255,255,0.9);
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --input-bg: #f8faff;
            --input-border: #e2e8f0;
            --badge-bg: rgba(255,255,255,0.7);
            --badge-text: #3b50c9;
            --badge-dot: #4B6BF5;
            --btn-grad: linear-gradient(135deg, #4B6BF5 0%, #7c3aed 100%);
            --btn-shadow: rgba(75,107,245,0.4);
            --label-text: #374151;
        }

        body.theme-bengkel {
            --accent: #f97316;
            --accent-light: #fff7ed;
            --accent-glow: rgba(249,115,22,0.25);
            --bg-page: #0f0f0f;
            --bg-blob1: rgba(249,115,22,0.12);
            --bg-blob2: rgba(234,88,12,0.1);
            --bg-blob3: rgba(161,161,170,0.06);
            --card-bg: rgba(24,24,27,0.95);
            --card-border: rgba(63,63,70,0.8);
            --text-primary: #f4f4f5;
            --text-secondary: #a1a1aa;
            --input-bg: rgba(39,39,42,0.8);
            --input-border: rgba(63,63,70,0.9);
            --badge-bg: rgba(249,115,22,0.15);
            --badge-text: #fb923c;
            --badge-dot: #f97316;
            --btn-grad: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            --btn-shadow: rgba(249,115,22,0.45);
            --label-text: #d4d4d8;
        }

        body.theme-edupulse {
            --accent: #4f46e5;
            --accent-light: #eef2ff;
            --accent-glow: rgba(79,70,229,0.25);
            --bg-page: #f8fafc;
            --bg-blob1: rgba(79,70,229,0.18);
            --bg-blob2: rgba(147,51,234,0.15);
            --bg-blob3: rgba(59,130,246,0.12);
            --card-bg: rgba(255,255,255,0.95);
            --card-border: rgba(226,232,240,0.9);
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --input-bg: #f8faff;
            --input-border: #e2e8f0;
            --badge-bg: rgba(79,70,229,0.1);
            --badge-text: #4338ca;
            --badge-dot: #4f46e5;
            --btn-grad: linear-gradient(135deg, #3b49df 0%, #6366f1 100%);
            --btn-shadow: rgba(79,70,229,0.4);
            --label-text: #334155;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-page);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            transition: background-color 0.5s ease;
            padding: 2rem 1rem;
        }

        /* ---- Background Blobs ---- */
        .bg-blobs { position: fixed; inset: 0; pointer-events: none; z-index: 0; }
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            animation: blob-anim 8s infinite ease-in-out;
            transition: background 0.5s ease;
        }
        .blob-1 { width: 500px; height: 500px; top: -10%; left: -8%; background: var(--bg-blob1); animation-delay: 0s; }
        .blob-2 { width: 450px; height: 450px; top: 20%; right: -10%; background: var(--bg-blob2); animation-delay: 2.5s; }
        .blob-3 { width: 400px; height: 400px; bottom: -15%; left: 15%; background: var(--bg-blob3); animation-delay: 5s; }
        @keyframes blob-anim {
            0%, 100% { transform: translate(0,0) scale(1); }
            33% { transform: translate(25px,-40px) scale(1.08); }
            66% { transform: translate(-18px,18px) scale(0.94); }
        }

        /* ---- Grid Overlay (Bengkel theme) ---- */
        .grid-overlay {
            position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background-image: linear-gradient(rgba(249,115,22,0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(249,115,22,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        body.theme-bengkel .grid-overlay { opacity: 1; }

        /* ---- Container ---- */
        .container { position: relative; z-index: 10; width: 100%; max-width: 440px; }

        /* ---- Portal Selector ---- */
        .portal-selector {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 16px;
            padding: 6px;
            transition: all 0.4s ease;
        }
        body.theme-bengkel .portal-selector {
            background: rgba(24,24,27,0.8);
            border-color: rgba(63,63,70,0.8);
        }
        .portal-btn {
            flex: 1;
            padding: 10px 8px;
            border: none;
            border-radius: 10px;
            font-family: var(--font-main);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            transition: all 0.3s ease;
            background: transparent;
            color: var(--text-secondary);
        }
        .portal-btn i { font-size: 16px; }
        .portal-btn.active {
            background: var(--btn-grad);
            color: #fff;
            box-shadow: 0 4px 15px var(--btn-shadow);
            transform: translateY(-1px);
        }
        .portal-btn:not(.active):hover {
            background: rgba(255,255,255,0.15);
            color: var(--text-primary);
        }
        body.theme-bengkel .portal-btn:not(.active):hover {
            background: rgba(249,115,22,0.1);
        }

        /* ---- Card ---- */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 28px;
            padding: 40px 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
        }
        body.theme-bengkel .card {
            box-shadow: 0 20px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(249,115,22,0.08), inset 0 1px 0 rgba(255,255,255,0.05);
        }

        /* ---- Logo area ---- */
        .logo-area { text-align: center; margin-bottom: 28px; }
        .logo-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--badge-bg);
            border: 1px solid rgba(255,255,255,0.3);
            padding: 5px 14px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--badge-text);
            margin-top: 14px;
            transition: all 0.4s ease;
        }
        body.theme-bengkel .logo-badge {
            border-color: rgba(249,115,22,0.3);
        }
        .logo-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--badge-dot);
            animation: pulse-dot 1.8s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(0.85); }
        }

        /* ---- Header ---- */
        .card-title {
            font-family: var(--font-heading);
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            transition: color 0.4s ease;
        }
        .card-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
            margin-top: 6px;
            transition: color 0.4s ease;
        }

        /* ---- Bengkel logo block ---- */
        .bengkel-header { text-align: center; margin-bottom: 24px; }
        .bengkel-icon-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px; height: 72px;
            border-radius: 20px;
            background: linear-gradient(135deg, #f97316, #ea580c);
            box-shadow: 0 8px 30px rgba(249,115,22,0.4);
            font-size: 30px;
            color: #fff;
            margin-bottom: 12px;
        }
        .bengkel-brand { font-family: var(--font-heading); font-size: 28px; font-weight: 900; color: #f4f4f5; letter-spacing: -0.5px; }
        .bengkel-brand span { color: #f97316; }
        .bengkel-tagline { color: #71717a; font-size: 12px; margin-top: 4px; }

        /* ---- Form ---- */
        .form-group { margin-bottom: 18px; }
        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--label-text);
            margin-bottom: 7px;
            transition: color 0.4s ease;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 14px;
            pointer-events: none;
            transition: color 0.3s ease;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 13px 16px 13px 42px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 14px;
            font-family: var(--font-main);
            font-size: 14px;
            color: var(--text-primary);
            outline: none;
            transition: all 0.3s ease;
        }
        input[type="text"]:focus, input[type="password"]:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-glow);
            background: var(--card-bg);
        }
        input::placeholder { color: var(--text-secondary); opacity: 0.6; }

        /* ---- Error ---- */
        .field-error {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #ef4444;
            font-size: 12px;
            font-weight: 500;
            margin-top: 6px;
        }

        /* ---- Buttons ---- */
        .btn-primary {
            width: 100%;
            padding: 14px;
            background: var(--btn-grad);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: var(--font-main);
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 20px var(--btn-shadow);
            transition: all 0.3s ease;
            letter-spacing: 0.01em;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 30px var(--btn-shadow); }
        .btn-primary:active { transform: translateY(0); }

        .btn-secondary {
            width: 100%;
            padding: 12px;
            background: transparent;
            color: var(--text-secondary);
            border: 1.5px solid var(--input-border);
            border-radius: 14px;
            font-family: var(--font-main);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            border-color: var(--accent);
            color: var(--text-primary);
            background: var(--accent-light);
        }
        body.theme-bengkel .btn-secondary:hover { background: rgba(249,115,22,0.08); color: #f97316; }

        /* ---- Divider ---- */
        .divider { display: flex; align-items: center; gap: 12px; margin: 20px 0; }
        .divider-line { flex: 1; height: 1px; background: var(--input-border); }
        .divider-text { font-size: 12px; color: var(--text-secondary); font-weight: 500; }

        /* ---- RFID link ---- */
        .rfid-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(20,184,166,0.08));
            border: 1px solid rgba(16,185,129,0.2);
            border-radius: 14px;
            text-decoration: none;
            margin-top: 16px;
            transition: all 0.3s ease;
        }
        .rfid-link:hover { background: rgba(16,185,129,0.12); transform: translateY(-1px); }
        .rfid-icon-box {
            width: 34px; height: 34px;
            background: #059669;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 14px;
        }
        .rfid-texts { margin-left: 10px; }
        .rfid-title { font-size: 12px; font-weight: 700; color: var(--text-primary); }
        .rfid-sub { font-size: 11px; color: var(--text-secondary); margin-top: 1px; }
        .rfid-arrow { font-size: 11px; color: #059669; font-weight: 700; display: flex; align-items: center; gap: 3px; }

        /* ---- Back link ---- */
        .back-link { text-align: center; margin-top: 16px; }
        .back-link a {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 600;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .back-link a:hover { color: var(--accent); }

        /* ---- Footer ---- */
        .page-footer { text-align: center; margin-top: 28px; font-size: 12px; color: var(--text-secondary); opacity: 0.7; }

        /* ---- Credential plates (Bengkel) ---- */
        .cred-plate {
            background: rgba(39,39,42,0.9);
            border: 1px solid rgba(63,63,70,0.9);
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 20px;
        }
        .cred-plate-title { font-size: 10px; font-weight: 700; color: #52525b; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 10px; }
        .cred-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; }
        .cred-label { font-size: 12px; color: #71717a; }
        .cred-value { font-size: 13px; font-weight: 700; color: #f4f4f5; font-family: 'Courier New', monospace; letter-spacing: 0.05em; }
        .cred-badge { display: inline-flex; align-items: center; gap: 4px; background: rgba(249,115,22,0.15); color: #f97316; border: 1px solid rgba(249,115,22,0.3); border-radius: 100px; padding: 2px 10px; font-size: 11px; font-weight: 700; }

        /* ---- Form slide animation ---- */
        .form-view { transition: opacity 0.3s ease, transform 0.3s ease; }
        .form-view.hidden {
            opacity: 0; transform: translateY(8px);
            pointer-events: none; position: absolute; width: 100%; left: 0;
        }
        .form-view.visible {
            opacity: 1; transform: translateY(0);
            pointer-events: auto; position: relative;
        }

        /* ---- Theme transition ---- */
        * { transition: background-color 0.4s ease, border-color 0.4s ease, color 0.3s ease; }
        input, button { transition: all 0.3s ease !important; }
    </style>
</head>
<body id="pageBody">

    <!-- Background -->
    <div class="bg-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>
    <div class="grid-overlay"></div>

    <div class="container">

        <!-- Portal Selector -->
        <div class="portal-selector">
            <button class="portal-btn active" id="btnPortalAdmin" onclick="setPortal('admin')" type="button">
                <i class="fas fa-shield-halved"></i>
                Admin
            </button>
            <button class="portal-btn" id="btnPortalEdupulse" onclick="setPortal('edupulse')" type="button">
                <i class="fas fa-graduation-cap"></i>
                EduPulse
            </button>
            <button class="portal-btn" id="btnPortalBengkel" onclick="setPortal('bengkel')" type="button">
                <i class="fas fa-wrench"></i>
                Bengkel
            </button>
            <button class="portal-btn" id="btnPortalMember" onclick="setPortal('member')" type="button">
                <i class="fas fa-id-card"></i>
                Member
            </button>
        </div>

        <!-- Card -->
        <div class="card">

            <!-- ======== ADMIN / MEMBER PORTAL ======== -->
            <div id="viewAdmin" class="form-view visible">

                <!-- Logo -->
                <div class="logo-area">
                    <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding Academy" style="height:38px; display:block; margin:0 auto;">
                    <div class="logo-badge" id="adminBadgeLabel">
                        <span class="logo-dot"></span>
                        <span id="badgeText">Portal Admin</span>
                    </div>
                </div>

                <div style="margin-bottom: 28px;">
                    <h1 class="card-title" id="adminTitle">Selamat Datang</h1>
                    <p class="card-subtitle" id="adminSubtitle">Silakan masuk menggunakan kredensial Anda.</p>
                </div>

                <div class="relative">
                    <!-- ===== USERNAME + PASSWORD LOGIN ===== -->
                    <div id="viewCredential" class="form-view visible">
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login_method" value="credential">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-wrap">
                                    <span class="input-icon"><i class="far fa-user"></i></span>
                                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                                        placeholder="Masukkan username" required autofocus>
                                </div>
                                @error('username')
                                    <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-wrap">
                                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" id="password" name="password"
                                        placeholder="••••••••" required>
                                </div>
                            </div>

                            <button type="button" class="btn-secondary" onclick="showKartu()" style="margin-bottom: 16px;">
                                <i class="fas fa-id-card"></i> Login dengan No Kartu
                            </button>

                            <div class="divider">
                                <div class="divider-line"></div>
                                <span class="divider-text">atau</span>
                                <div class="divider-line"></div>
                            </div>

                            <button type="submit" class="btn-primary">
                                Masuk ke Dasbor <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>

                    <!-- ===== NOMOR KARTU LOGIN ===== -->
                    <div id="viewKartu" class="form-view hidden">
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login_method" value="kartu">

                            <div class="form-group">
                                <label for="nomor_kartu">Nomor Kartu</label>
                                <div class="input-wrap">
                                    <span class="input-icon"><i class="fas fa-id-card"></i></span>
                                    <input type="text" id="nomor_kartu" name="nomor_kartu" value="{{ old('nomor_kartu') }}"
                                        placeholder="Contoh: 0002215562" inputmode="numeric" required
                                        style="font-family: 'Courier New', monospace; letter-spacing: 0.1em;">
                                </div>
                                @error('nomor_kartu')
                                    <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <button type="button" class="btn-secondary" onclick="showCredential()" style="margin-bottom: 16px;">
                                <i class="fas fa-arrow-left"></i> Login dengan Username
                            </button>

                            <div class="divider">
                                <div class="divider-line"></div>
                                <span class="divider-text">atau</span>
                                <div class="divider-line"></div>
                            </div>

                            <button type="submit" class="btn-primary">
                                Masuk dengan Kartu <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <a href="{{ route('presensi.rfid') }}" class="rfid-link">
                    <div style="display:flex; align-items:center;">
                        <div class="rfid-icon-box"><i class="fas fa-id-card"></i></div>
                        <div class="rfid-texts">
                            <div class="rfid-title">Terminal Presensi RFID</div>
                            <div class="rfid-sub">Buka Kiosk Scan Kartu RFID</div>
                        </div>
                    </div>
                    <span class="rfid-arrow">Buka <i class="fas fa-chevron-right"></i></span>
                </a>

            </div>

            <!-- ======== BENGKEL PORTAL ======== -->
            <div id="viewBengkel" class="form-view hidden">

                <!-- Bengkel Header -->
                <div class="bengkel-header">
                    <div class="bengkel-icon-wrap">
                        <i class="fas fa-garage"></i>
                    </div>
                    <div class="bengkel-brand">L-<span>Garage</span></div>
                    <div class="bengkel-tagline">Sistem Manajemen Bengkel Profesional</div>
                </div>

                <!-- Credential Plate (info akun bengkel) -->
                <div class="cred-plate">
                    <div class="cred-plate-title"><i class="fas fa-key" style="margin-right:4px;"></i> Akun Demo Bengkel</div>
                    <div class="cred-row">
                        <span class="cred-label">Username</span>
                        <span class="cred-value">bengkel</span>
                    </div>
                    <div class="cred-row">
                        <span class="cred-label">Password</span>
                        <span class="cred-value">bengkel123</span>
                    </div>
                    <div class="cred-row" style="margin-bottom:0;">
                        <span class="cred-label">Role</span>
                        <span class="cred-badge"><i class="fas fa-wrench"></i> Bengkel</span>
                    </div>
                </div>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="login_method" value="credential">

                    <div class="form-group">
                        <label for="bengkel_username">Username Bengkel</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i class="fas fa-user-gear"></i></span>
                            <input type="text" id="bengkel_username" name="username"
                                value="{{ old('username', 'bengkel') }}"
                                placeholder="Username bengkel" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bengkel_password">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="bengkel_password" name="password"
                                placeholder="••••••••" required>
                        </div>
                        @error('username')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary" style="margin-top: 4px;">
                        <i class="fas fa-garage"></i> Masuk ke Portal Bengkel <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <!-- Status dot -->
                <div style="display:flex; align-items:center; gap:8px; margin-top:18px; padding:10px 14px; background:rgba(249,115,22,0.06); border-radius:10px; border:1px solid rgba(249,115,22,0.15);">
                    <span style="width:8px;height:8px;background:#22c55e;border-radius:50%;display:inline-block;box-shadow:0 0 6px #22c55e;animation:pulse-dot 1.8s infinite;"></span>
                    <span style="font-size:12px;color:#71717a;">Sistem Online · Data Kosong · Siap Digunakan</span>
                </div>

            </div>

            <!-- ======== EDUPULSE BIMBEL PORTAL ======== -->
            <div id="viewEdupulse" class="form-view hidden">

                <!-- EduPulse Header -->
                <div style="text-align: center; margin-bottom: 24px;">
                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 68px; height: 68px; border-radius: 20px; background: linear-gradient(135deg, #3b49df, #6366f1); box-shadow: 0 8px 25px rgba(99,102,241,0.35); font-size: 28px; color: #fff; margin-bottom: 12px;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div style="font-family: var(--font-heading); font-size: 26px; font-weight: 900; color: #0f172a; letter-spacing: -0.5px;">EduPulse <span style="color: #6366f1;">SaaS</span></div>
                    <div style="color: #64748b; font-size: 12px; margin-top: 4px;">Sistem Operasional Bimbel & AI Tutor Akademik</div>
                </div>

                <!-- Credential Plate (info akun bimbel) -->
                <div class="cred-plate" style="background: rgba(238,242,255,0.7); border: 1px solid rgba(199,210,254,0.8); border-radius: 14px; padding: 16px; margin-bottom: 20px;">
                    <div class="cred-plate-title" style="color: #4338ca; font-size: 10px; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 10px;">
                        <i class="fas fa-key" style="margin-right: 4px;"></i> Akun Demo EduPulse Bimbel
                    </div>
                    <div class="cred-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span class="cred-label" style="color: #475569; font-size: 12px;">Username</span>
                        <span class="cred-value" style="color: #1e1b4b; font-size: 13px; font-weight: 700; font-family: monospace;">edupulse</span>
                    </div>
                    <div class="cred-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <span class="cred-label" style="color: #475569; font-size: 12px;">Password</span>
                        <span class="cred-value" style="color: #1e1b4b; font-size: 13px; font-weight: 700; font-family: monospace;">edupulse123</span>
                    </div>
                    <div class="cred-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0;">
                        <span class="cred-label" style="color: #475569; font-size: 12px;">Role Khusus</span>
                        <span class="cred-badge" style="background: rgba(99,102,241,0.15); color: #4338ca; border: 1px solid rgba(99,102,241,0.3); border-radius: 100px; padding: 2px 10px; font-size: 11px; font-weight: 700;">
                            <i class="fas fa-user-graduate"></i> Bimbel (Admin Akademik)
                        </span>
                    </div>
                </div>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <input type="hidden" name="login_method" value="credential">

                    <div class="form-group">
                        <label for="edupulse_username">Username Bimbel</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i class="fas fa-user-gear"></i></span>
                            <input type="text" id="edupulse_username" name="username"
                                value="{{ old('username', 'edupulse') }}"
                                placeholder="Username bimbel" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edupulse_password">Password</label>
                        <div class="input-wrap">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" id="edupulse_password" name="password"
                                value="edupulse123"
                                placeholder="••••••••" required>
                        </div>
                        @error('username')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-primary" style="margin-top: 4px; background: linear-gradient(135deg, #3b49df 0%, #6366f1 100%);">
                        <i class="fas fa-graduation-cap"></i> Masuk ke EduPulse Academy <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <!-- Status dot -->
                <div style="display:flex; align-items:center; gap:8px; margin-top:18px; padding:10px 14px; background:rgba(99,102,241,0.06); border-radius:10px; border:1px solid rgba(99,102,241,0.15);">
                    <span style="width:8px;height:8px;background:#22c55e;border-radius:50%;display:inline-block;box-shadow:0 0 6px #22c55e;animation:pulse-dot 1.8s infinite;"></span>
                    <span style="font-size:12px;color:#475569;">EduPulse Online · Monitoring Live & AI Tutor Aktif</span>
                </div>

            </div>

            <!-- Back link (common) -->
            <div class="back-link" style="margin-top: 20px; padding-top: 16px; border-top: 1px solid var(--input-border);">
                <a href="{{ url('/') }}">
                    <i class="fas fa-home"></i> Kembali ke Beranda
                </a>
            </div>

        </div><!-- /.card -->

        <p class="page-footer">&copy; {{ date('Y') }} Elcoding Academy. All rights reserved.</p>

    </div><!-- /.container -->

    <script>
        let currentPortal = 'admin';

        function setPortal(portal) {
            currentPortal = portal;

            // Reset all portal buttons
            document.querySelectorAll('.portal-btn').forEach(b => b.classList.remove('active'));

            const viewAdmin    = document.getElementById('viewAdmin');
            const viewBengkel  = document.getElementById('viewBengkel');
            const viewEdupulse = document.getElementById('viewEdupulse');
            const pageBody     = document.getElementById('pageBody');

            pageBody.classList.remove('theme-bengkel');
            pageBody.classList.remove('theme-edupulse');

            hideEl(viewAdmin);
            hideEl(viewBengkel);
            hideEl(viewEdupulse);

            if (portal === 'admin') {
                document.getElementById('btnPortalAdmin').classList.add('active');
                showEl(viewAdmin);
                document.getElementById('adminTitle').textContent = 'Selamat Datang';
                document.getElementById('adminSubtitle').textContent = 'Silakan masuk menggunakan kredensial Anda.';
                document.getElementById('badgeText').textContent = 'Portal Admin';
                document.title = 'Admin Login - Elcoding Academy';
            } else if (portal === 'edupulse') {
                document.getElementById('btnPortalEdupulse').classList.add('active');
                pageBody.classList.add('theme-edupulse');
                showEl(viewEdupulse);
                document.title = 'EduPulse Academy SaaS - Login';
            } else if (portal === 'bengkel') {
                document.getElementById('btnPortalBengkel').classList.add('active');
                pageBody.classList.add('theme-bengkel');
                showEl(viewBengkel);
                document.title = 'Portal Bengkel - L-Garage';
            } else if (portal === 'member') {
                document.getElementById('btnPortalMember').classList.add('active');
                showEl(viewAdmin);
                document.getElementById('adminTitle').textContent = 'Portal Member';
                document.getElementById('adminSubtitle').textContent = 'Masukkan nomor kartu atau username member Anda.';
                document.getElementById('badgeText').textContent = 'Portal Member';
                document.title = 'Member Login - Elcoding Academy';
            }
        }

        function showEl(el) {
            el.classList.remove('hidden');
            el.classList.add('visible');
        }
        function hideEl(el) {
            el.classList.remove('visible');
            el.classList.add('hidden');
        }

        function showKartu() {
            hideEl(document.getElementById('viewCredential'));
            showEl(document.getElementById('viewKartu'));
            setTimeout(() => document.getElementById('nomor_kartu').focus(), 320);
        }

        function showCredential() {
            hideEl(document.getElementById('viewKartu'));
            showEl(document.getElementById('viewCredential'));
            setTimeout(() => document.getElementById('username').focus(), 320);
        }

        // Auto-show kartu if server returned nomor_kartu error
        @if($errors->has('nomor_kartu'))
            showKartu();
        @endif
    </script>

</body>
</html>
