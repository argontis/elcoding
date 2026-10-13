<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nusantara Enterprise CRM') - AI Enterprise Engine</title>
    <meta name="description" content="AI CRM & Lead Management System - Nusantara Enterprise CRM">

    <!-- Fonts: Plus Jakarta Sans & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #4c52f8;
            --primary-hover: #3b40e3;
            --primary-light: #eef2ff;
            --primary-border: #c7d2fe;
            --primary-dark: #1e1b4b;
            
            --success: #10b981;
            --success-light: #ecfdf5;
            --warning: #f59e0b;
            --warning-light: #fffbeb;
            --danger: #ef4444;
            --danger-light: #fef2f2;
            --purple: #8b5cf6;
            --purple-light: #f5f3ff;
            --cyan: #06b6d4;

            --bg-body: #f8fafc;
            --bg-sidebar: #ffffff;
            --bg-card: #ffffff;
            --border-color: #e2e8f0;
            --border-light: #f1f5f9;

            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-sub: #94a3b8;

            --font-main: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-heading: 'Outfit', sans-serif;

            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
            --shadow-glow: 0 0 20px rgba(76, 82, 248, 0.25);
        }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 280px;
            min-width: 280px;
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 50;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 24px 20px 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border-light);
        }

        .brand-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, #4c52f8 0%, #6366f1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(76, 82, 248, 0.35);
            flex-shrink: 0;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
        }

        .brand-title {
            font-family: var(--font-heading);
            font-size: 15px;
            font-weight: 800;
            color: #1e1b4b;
            line-height: 1.2;
            letter-spacing: -0.3px;
        }

        .brand-sub {
            font-size: 8.5px;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: #64748b;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .brand-tag {
            font-size: 9px;
            font-weight: 700;
            color: #4c52f8;
            letter-spacing: 0.04em;
        }

        .sidebar-body {
            flex: 1;
            padding: 20px 16px;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
            padding-left: 12px;
        }

        .nav-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-item {
            width: 100%;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            color: #334155;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            color: #64748b;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .nav-link:hover i {
            color: #4c52f8;
        }

        /* Active Nav Item - Matches PDF */
        .nav-link.active {
            background: #4c52f8;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(76, 82, 248, 0.3);
        }

        .nav-link.active i {
            color: #ffffff;
        }

        .badge-pro {
            margin-left: auto;
            background: #ffffff;
            color: #4c52f8;
            font-size: 9.5px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 100px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .nav-link:not(.active) .badge-pro {
            background: #f3e8ff;
            color: #7c3aed;
        }

        /* Bottom Server Status - Matches PDF */
        .sidebar-footer {
            padding: 16px;
        }

        .server-status-card {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
        }

        .server-status-header {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .server-status-header i {
            color: #10b981;
            font-size: 13px;
        }

        .server-status-desc {
            font-size: 11px;
            color: #64748b;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .server-status-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 600;
            color: #334155;
            padding-top: 6px;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #10b981;
            display: inline-block;
            box-shadow: 0 0 0 rgba(16, 185, 129, 0.7);
            animation: pulse-green 1.8s infinite ease-in-out;
        }

        @keyframes pulse-green {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6); }
            70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        /* ================= MAIN CONTENT WRAPPER ================= */
        .main-wrapper {
            margin-left: 280px;
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            width: calc(100% - 280px);
        }

        /* Top Navbar */
        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-toggle-btn {
            display: none;
            background: none;
            border: none;
            font-size: 18px;
            color: var(--text-muted);
            cursor: pointer;
        }

        .header-title-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eef2ff;
            color: #4c52f8;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 100px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .ai-engine-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(76, 82, 248, 0.08);
            border: 1px solid rgba(76, 82, 248, 0.2);
            padding: 5px 12px;
            border-radius: 100px;
            font-size: 11.5px;
            font-weight: 600;
            color: #4c52f8;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 8px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4c52f8, #7c3aed);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .user-meta {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.2;
        }

        .user-role-label {
            font-size: 11px;
            color: #64748b;
        }

        .btn-logout {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: #fecaca;
        }

        /* Page Content */
        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* Generic UI Utilities */
        .btn-primary-crm {
            background: #4c52f8;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(76, 82, 248, 0.3);
            transition: all 0.2s ease;
        }

        .btn-primary-crm:hover {
            background: #3b40e3;
            transform: translateY(-1px);
        }

        .btn-outline-crm {
            background: #ffffff;
            color: #334155;
            border: 1px solid var(--border-color);
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-outline-crm:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .dropdown-select-crm {
            background: #ffffff;
            color: #334155;
            border: 1px solid var(--border-color);
            padding: 7px 12px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            outline: none;
            cursor: pointer;
        }

        /* Modal styling */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-card {
            background: #ffffff;
            border-radius: 16px;
            width: 100%;
            max-width: 540px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: modalIn 0.2s ease-out;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            padding: 18px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 18px;
            color: #94a3b8;
            cursor: pointer;
        }

        .modal-body {
            padding: 24px;
        }

        .form-group-crm {
            margin-bottom: 16px;
        }

        .form-group-crm label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-input-crm {
            width: 100%;
            padding: 9px 13px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 13px;
            color: #0f172a;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .form-input-crm:focus {
            border-color: #4c52f8;
            box-shadow: 0 0 0 3px rgba(76, 82, 248, 0.15);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-wrapper {
                margin-left: 0;
                width: 100%;
            }
            .nav-toggle-btn {
                display: block;
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- ================= SIDEBAR (Matches PDF 1-8) ================= -->
    <aside class="sidebar" id="sidebar">
        <div>
            <!-- Header Branding -->
            <div class="sidebar-header">
                <div class="brand-icon-box">
                    <i class="fas fa-sparkles"></i>
                </div>
                <div class="brand-text">
                    <div class="brand-title">NusantaraCRI</div>
                    <div class="brand-sub">AI ENTERPRISE ENGINE</div>
                    <div class="brand-tag">Nusantara ENTERPRISE CRM</div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="sidebar-body">
                <div class="nav-label">NAVIGASI UTAMA</div>
                <ul class="nav-list">
                    <!-- 1. Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('crm.dashboard') }}" class="nav-link {{ request()->routeIs('crm.dashboard') || request()->is('crm') ? 'active' : '' }}">
                            <i class="fas fa-th-large"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- 2. Leads -->
                    <li class="nav-item">
                        <a href="{{ route('crm.leads') }}" class="nav-link {{ request()->routeIs('crm.leads') ? 'active' : '' }}">
                            <i class="fas fa-user-group"></i>
                            <span>Leads</span>
                        </a>
                    </li>

                    <!-- 3. Sales Pipeline -->
                    <li class="nav-item">
                        <a href="{{ route('crm.pipeline') }}" class="nav-link {{ request()->routeIs('crm.pipeline') ? 'active' : '' }}">
                            <i class="fas fa-columns"></i>
                            <span>Sales Pipeline</span>
                        </a>
                    </li>

                    <!-- 4. Tasks & Aktivitas -->
                    <li class="nav-item">
                        <a href="{{ route('crm.tasks') }}" class="nav-link {{ request()->routeIs('crm.tasks') ? 'active' : '' }}">
                            <i class="fas fa-circle-check"></i>
                            <span>Tasks & Aktivitas</span>
                        </a>
                    </li>

                    <!-- 5. AI Copilot (PRO) -->
                    <li class="nav-item">
                        <a href="{{ route('crm.copilot') }}" class="nav-link {{ request()->routeIs('crm.copilot') ? 'active' : '' }}">
                            <i class="fas fa-wand-magic-sparkles"></i>
                            <span>AI Copilot</span>
                            <span class="badge-pro">PRO</span>
                        </a>
                    </li>

                    <!-- 6. Otomasi -->
                    <li class="nav-item">
                        <a href="{{ route('crm.otomasi') }}" class="nav-link {{ request()->routeIs('crm.otomasi') ? 'active' : '' }}">
                            <i class="fas fa-bolt"></i>
                            <span>Otomasi</span>
                        </a>
                    </li>

                    <!-- 7. Laporan & Analitik -->
                    <li class="nav-item">
                        <a href="{{ route('crm.laporan') }}" class="nav-link {{ request()->routeIs('crm.laporan') ? 'active' : '' }}">
                            <i class="fas fa-chart-line"></i>
                            <span>Laporan & Analitik</span>
                        </a>
                    </li>

                    <!-- 8. Pengaturan -->
                    <li class="nav-item">
                        <a href="{{ route('crm.pengaturan') }}" class="nav-link {{ request()->routeIs('crm.pengaturan') ? 'active' : '' }}">
                            <i class="fas fa-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Sidebar Footer Status - Matches PDF -->
        <div class="sidebar-footer">
            <div class="server-status-card">
                <div class="server-status-header">
                    <i class="fas fa-circle-check"></i>
                    <span>Server Status: JKT-1</span>
                </div>
                <div class="server-status-desc">
                    AI Sync & WhatsApp Gateway aktif tanpa kendala.
                </div>
                <div class="server-status-meta">
                    <span>Latensi: 14ms</span>
                    <span class="pulse-dot"></span>
                </div>
            </div>
        </div>
    </aside>

    <!-- ================= MAIN WRAPPER ================= -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="top-navbar">
            <div class="top-left">
                <button class="nav-toggle-btn" id="navToggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-title-badge">
                    <i class="fas fa-shield-halved"></i>
                    <span>@yield('header_badge', 'EXECUTIVE COCKPIT • KUARTAL IV 2026')</span>
                </div>
            </div>

            <div class="top-right">
                <div class="ai-engine-pill">
                    <i class="fas fa-microchip"></i>
                    <span>v4.8 Enterprise • 99.4% Akurasi</span>
                </div>

                <div class="user-dropdown">
                    <div class="user-avatar">
                        {{ $currentUser['avatar_initials'] ?? 'DP' }}
                    </div>
                    <div class="user-meta">
                        <span class="user-name">{{ $currentUser['name'] ?? 'Dimas Pratama' }}</span>
                        <span class="user-role-label">{{ $currentUser['username'] ?? 'crmlead' }} (Super Admin)</span>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn-logout" title="Keluar dari akun">
                        <i class="fas fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="page-content">
            @if(session('success'))
                <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 13.5px; font-weight: 600;">
                    <i class="fas fa-circle-check" style="color: #10b981; font-size: 16px;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sb = document.getElementById('sidebar');
            sb.classList.toggle('mobile-open');
        }
    </script>
    @yield('scripts')
</body>
</html>
