<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Mencegah Browser Caching (Mengatasi isu CSS tidak terupdate) -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="theme-color" content="#ffffff">
    <script>
        if(!localStorage.getItem('elc_cache_bust_v2')) {
            localStorage.setItem('elc_cache_bust_v2', 'true');
            window.location.reload(true);
        }
    </script>

    <!-- CSRF Token wajib ada agar script bisa POST ke Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('gambar/aset/icon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('gambar/aset/icon.png') }}">

    <!-- LCP Preload Stack -->
    @stack('preload')

    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}" media="print"
        onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    </noscript>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap">
    </noscript>

    <link rel='stylesheet' id='parent-style-css'
        href='{{ asset('assets/wp-content/themes/hello-elementor/style.css') }}' media='all' />
    <link rel='stylesheet' id='child-style-css'
        href='{{ asset('assets/wp-content/themes/hello-elementor-child/style.css') }}' media='all' />
    <link rel='stylesheet' id='fonts-override-css'
        href='{{ asset('assets/wp-content/themes/hello-elementor-child/fonts-override.css') }}' media='all' />
    <link rel='stylesheet' id='hello-elementor-css'
        href='{{ asset('assets/wp-content/themes/hello-elementor/assets/css/reset.css') }}' media='all' />
    <link rel='stylesheet' id='hello-elementor-theme-style-css'
        href='{{ asset('assets/wp-content/themes/hello-elementor/assets/css/theme.css') }}' media='all' />
    <link rel='stylesheet' id='hello-elementor-header-footer-css'
        href='{{ asset('assets/wp-content/themes/hello-elementor/assets/css/header-footer.css') }}' media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/frontend.min.css') }}' media='all' />

    <!-- Widget CSS -->
    <link rel='stylesheet' id='widget-nav-menu-css'
        href='{{ asset('assets/wp-content/plugins/pro-elements/assets/css/widget-nav-menu.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='widget-image-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-image.min.css') }}' media="all" />
    <link rel='stylesheet' id='e-sticky-css'
        href='{{ asset('assets/wp-content/plugins/pro-elements/assets/css/modules/sticky.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='widget-heading-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-heading.min.css') }}' media="all" />
    <link rel='stylesheet' id='widget-breadcrumbs-css'
        href='{{ asset('assets/wp-content/plugins/pro-elements/assets/css/widget-breadcrumbs.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='widget-divider-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-divider.min.css') }}' media="all" />
    <link rel='stylesheet' id='widget-spacer-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-spacer.min.css') }}' media="all" />
    <link rel='stylesheet' id='widget-icon-list-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-icon-list.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='e-animation-shrink-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/lib/animations/styles/e-animation-shrink.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='widget-social-icons-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-social-icons.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='elementor-icons-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='elementor-post-7138-css'
        href='{{ asset('assets/wp-content/uploads/elementor/css/post-7138.css?v=3') }}' media="all" />
    <link rel='stylesheet' id='swiper-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='widget-image-carousel-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-image-carousel.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='widget-icon-box-css'
        href='{{ asset('assets/wp-content/plugins/elementor/assets/css/widget-icon-box.min.css') }}'
        media="all" />
    <link rel='stylesheet' id='elementor-post-6296-css'
        href='{{ asset('assets/wp-content/uploads/elementor/css/post-6296.css?v=3') }}' media="all" />
    <link rel='stylesheet' id='elementor-post-11887-css'
        href='{{ asset('assets/wp-content/uploads/elementor/css/post-11887.css?v=3') }}' media="all" />
    <link rel='stylesheet' id='elementor-post-8310-css'
        href='{{ asset('assets/wp-content/uploads/elementor/css/post-8310.css?v=3') }}' media="all" />

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: clip;
            background-color: #ffffff !important;
        }

        html {
            overflow-x: clip;
            scroll-behavior: smooth;
        }

        .skip-to-content {
            position: absolute;
            top: -100px;
            left: 0;
            background: #4B6BF5;
            color: white;
            padding: 10px 15px;
            z-index: 100000;
            transition: top 0.3s;
            text-decoration: none;
            border-bottom-right-radius: 8px;
            font-weight: bold;
        }

        .skip-to-content:focus {
            top: 0;
        }
    </style>
    @stack('styles')
    <style>
        /* Global Active and Hover colors for Navigation & Footer */
        .elementor-nav-menu .menu-item a.elementor-item {
            transition: color 0.2s ease !important;
            transform: none !important;
            background: transparent !important;
        }

        /* Disable any underline/pointer animations from Elementor */
        .elementor-nav-menu .menu-item a.elementor-item::before,
        .elementor-nav-menu .menu-item a.elementor-item::after {
            display: none !important;
        }

        .elementor-nav-menu .menu-item a.elementor-item-active,
        .elementor-nav-menu .menu-item a.elementor-item:hover {
            color: #4B6BF5 !important;
            /* purple */
            transform: none !important;
        }

        /* Footer Social Icons and Icon List Hover */
        .elementor-location-footer a:hover,
        .elementor-location-footer .elementor-icon-list-item a:hover .elementor-icon-list-icon i,
        .elementor-location-footer .elementor-icon-list-item a:hover .elementor-icon-list-text {
            color: #4B6BF5 !important;
            /* purple */
        }

        .elementor-location-footer .elementor-social-icon:hover {
            background-color: #4B6BF5 !important;
            color: #ffffff !important;
        }

        /* Global Button Hover Animation */
        .elementor-button,
        .program-btn,
        .program-preview-btn {
            transition: all 0.3s ease !important;
        }

        .elementor-button:hover,
        .program-btn:hover,
        .program-preview-btn:hover {
            transform: translateY(-2px) !important;
        }

        /* Header Konsultasi Button */
        .elementor-element-5ebed42 .elementor-button {
            background-color: #4B6BF5 !important;
            transition: all 0.3s ease !important;
            color: #ffffff !important;
            font-size: 13px !important;
            font-weight: 600 !important;
        }

        /* Universal Filter Tabs Component Styling */
        .filter-tabs-wrapper {
            position: relative;
            z-index: 10;
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
            padding: 0 20px;
        }

        .filter-tabs {
            background: #ffffff;
            padding: 8px 12px;
            border-radius: 50px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
            justify-content: center;
            border: 1px solid #f1f5f9;
        }

        .tab-pill {
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            color: #4B5563;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            white-space: nowrap;
        }

        .tab-pill:hover {
            color: #4B6BF5;
            background: #f1f5f9;
        }

        .tab-pill.active,
        .tab-pill.active-red {
            background: #4B6BF5;
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(75, 107, 245, 0.25);
        }

        /* ============================================================
           PAGE HERO (VaultEdge Style)
           ============================================================ */
        .ve-page-hero {
            min-height: 380px;
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: flex-end;
            padding-bottom: 60px;
            margin-top: 0; /* Changed from VaultEdge default to fit Elcoding */
        }
        .ve-page-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(13,27,42,0.92) 0%, rgba(13,27,42,0.6) 100%);
        }
        .ve-page-hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .ve-section-tag {
            display: inline-block;
            background: rgba(75, 107, 245, 0.1);
            color: #4B6BF5;
            border: 1px solid rgba(75, 107, 245, 0.25);
            border-radius: 50px;
            padding: 5px 16px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 14px;
        }
        .ve-page-hero-content h1 {
            font-size: 46px;
            font-weight: 900;
            color: #fff;
            margin: 10px 0 18px;
            line-height: 1.15;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .ve-page-hero-content h1 span {
            color: #4B6BF5;
        }
        .ve-breadcrumb {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 10px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .ve-breadcrumb li {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.6);
        }
        .ve-breadcrumb li a {
            color: #4B6BF5;
            text-decoration: none;
            font-weight: 600;
        }
        .ve-breadcrumb li a:hover {
            color: #fff;
        }
        .ve-breadcrumb li.active {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
        }
        .ve-breadcrumb li:not(:last-child)::after {
            content: '/';
            margin-left: 10px;
            color: rgba(255, 255, 255, 0.3);
        }
        @media (max-width: 767px) {
            .ve-page-hero-content h1 {
                font-size: 36px;
            }
        }

        .elementor-element-5ebed42 .elementor-button:hover {
            background-color: #1E40AF !important;
            /* dark blue */
        }

        @media (max-width: 480px) {
            .elementor-element-5ebed42 .elementor-button {
                padding: 10px 16px !important;
                font-size: 11px !important;
            }
        }

        /* Mobile Header CSS */
        .elementor-element-178d229>.e-con-inner {
            max-width: 1400px !important;
            margin: 0 auto !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            flex-wrap: wrap !important;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #1F2937;
            cursor: pointer;
            padding: 5px;
            order: 2;
            /* To position next to the logo on mobile */
            outline: none !important;
            -webkit-tap-highlight-color: transparent !important;
        }

        .mobile-menu-btn:focus,
        .mobile-menu-btn:active,
        .mobile-menu-btn:hover {
            outline: none !important;
            color: #4B6BF5 !important;
            background: transparent !important;
            background-color: transparent !important;
        }

        #main-nav {
            order: 3;
        }

        @media (max-width: 1200px) {
            .elementor-element-178d229 .e-con-inner {
                padding-left: 20px !important;
                padding-right: 20px !important;
                position: relative !important;
            }

            .mobile-menu-btn {
                display: flex !important;
                align-items: center;
                justify-content: center;
                order: 3 !important;
                margin: 0 !important;
                height: 40px;
            }

            #header-btn,
            .elementor-element-e02dfdc {
                width: auto !important;
                margin-bottom: 0 !important;
            }

            #header-btn .elementor-widget-container,
            .elementor-element-e02dfdc .elementor-widget-container {
                margin: 0 !important;
            }

            #header-btn {
                display: flex !important;
                align-items: center;
                order: 2 !important;
                margin: 0 15px 0 auto !important;
            }

            #main-nav {
                display: none;
                position: absolute !important;
                top: 100% !important;
                left: auto !important;
                right: 20px !important;
                width: 220px !important;
                order: 4 !important;
                margin-top: 5px !important;
                background: #ffffff;
                padding: 10px 0;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                z-index: 9999 !important;
            }

            #main-nav.active {
                display: block !important;
                animation: slideDownNav 0.3s ease;
            }

            @keyframes slideDownNav {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .elementor-nav-menu--main .elementor-nav-menu {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0 !important;
                width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
                list-style: none !important;
            }

            .elementor-nav-menu--main .elementor-nav-menu .menu-item {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .elementor-nav-menu--main .elementor-nav-menu .elementor-item {
                padding: 15px 10px !important;
                border-bottom: 1px solid #e5e7eb;
                width: 100% !important;
                display: flex !important;
                justify-content: space-between !important;
                align-items: center !important;
                box-sizing: border-box !important;
            }

            .elementor-nav-menu--main .elementor-nav-menu .elementor-item:not(.elementor-item-active) {
                color: #4B5563 !important;
            }

            .elementor-nav-menu--main .elementor-nav-menu .menu-item:last-child .elementor-item {
                border-bottom: none !important;
            }

            .mobile-caret {
                display: none !important;
            }

            .elementor-nav-menu--main .elementor-nav-menu .sub-menu {
                display: none !important;
            }

            .elementor-nav-menu--main .elementor-nav-menu .menu-item-has-children.active .sub-menu {
                display: none !important;
            }

            .elementor-nav-menu--main .elementor-nav-menu .elementor-sub-item {
                padding: 8px 0 !important;
            }
        }
    </style>

    <!-- JSON-LD Schema Stack -->
    @stack('schema')

    <!-- Preloader CSS -->
    <style>
        .preloader {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 99999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease, visibility 0.4s ease;
        }
        .preloader.show {
            opacity: 1;
            visibility: visible;
        }
        .preloader.preloader-hidden {
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none;
        }
        .preloader .lds-ellipsis {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 64px;
        }
        .preloader .lds-ellipsis div {
            position: absolute;
            top: 27px;
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: #4B6BF5; /* Elcoding Blue */
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }
        .preloader .lds-ellipsis div:nth-child(1) {
            left: 6px;
            -webkit-animation: lds-ellipsis1 0.6s infinite;
            animation: lds-ellipsis1 0.6s infinite;
        }
        .preloader .lds-ellipsis div:nth-child(2) {
            left: 6px;
            -webkit-animation: lds-ellipsis2 0.6s infinite;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .preloader .lds-ellipsis div:nth-child(3) {
            left: 26px;
            -webkit-animation: lds-ellipsis2 0.6s infinite;
            animation: lds-ellipsis2 0.6s infinite;
        }
        .preloader .lds-ellipsis div:nth-child(4) {
            left: 45px;
            -webkit-animation: lds-ellipsis3 0.6s infinite;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @-webkit-keyframes lds-ellipsis1 {
            0% { -webkit-transform: scale(0); transform: scale(0); }
            100% { -webkit-transform: scale(1); transform: scale(1); }
        }
        @keyframes lds-ellipsis1 {
            0% { -webkit-transform: scale(0); transform: scale(0); }
            100% { -webkit-transform: scale(1); transform: scale(1); }
        }
        @-webkit-keyframes lds-ellipsis3 {
            0% { -webkit-transform: scale(1); transform: scale(1); }
            100% { -webkit-transform: scale(0); transform: scale(0); }
        }
        @keyframes lds-ellipsis3 {
            0% { -webkit-transform: scale(1); transform: scale(1); }
            100% { -webkit-transform: scale(0); transform: scale(0); }
        }
        @-webkit-keyframes lds-ellipsis2 {
            0% { -webkit-transform: translate(0, 0); transform: translate(0, 0); }
            100% { -webkit-transform: translate(19px, 0); transform: translate(19px, 0); }
        }
        @keyframes lds-ellipsis2 {
            0% { -webkit-transform: translate(0, 0); transform: translate(0, 0); }
            100% { -webkit-transform: translate(19px, 0); transform: translate(19px, 0); }
        }
    </style>
</head>

<body
    class="home wp-singular page-template page-template-elementor_header_footer page wp-embed-responsive wp-theme-hello-elementor wp-child-theme-hello-elementor-child hello-elementor-default elementor-default elementor-template-full-width elementor-page elementor-kit-7138 elementor-page-6296">

    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </div>
    
    <script>
        var preloader = document.getElementById('preloader');
        var pageLoaded = false;
        
        window.addEventListener('load', function() {
            pageLoaded = true;
            if(preloader) {
                preloader.classList.add('preloader-hidden');
                setTimeout(function(){
                    preloader.style.display = 'none';
                }, 500);
            }
        });

        // Tampilkan loading hanya jika load lebih dari 250ms
        setTimeout(function() {
            if (!pageLoaded && preloader) {
                preloader.classList.add('show');
            }
        }, 250);
    </script>

    <!-- ================= NAVBAR BARU (Desain Websekolah) ================= -->
    <header class="custom-header {{ request()->is('/') ? 'transparent-header' : '' }}" id="main-header">
        <div class="header-container">
            <!-- 1. BAGIAN KIRI: Logo -->
            <div class="header-logo">
                <a href="{{ url('/') }}" style="text-decoration: none; display: flex; align-items: baseline;">
                    <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding.id" style="height: 32px; width: auto; object-fit: contain;">
                </a>
            </div>

            <!-- Tombol Hamburger untuk Mobile -->
            <button class="mobile-toggle" id="mobile-toggle" aria-label="Toggle Navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- 2. BAGIAN TENGAH: Menu Navigasi -->
            <nav class="header-nav" id="header-nav">
                <ul class="nav-list">
                    <li><a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
                    <li><a href="{{ url('/tentang-kami') }}" class="nav-link {{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
                    <li><a href="{{ url('/program-kursus') }}" class="nav-link {{ request()->is('program-kursus*') || request()->is('bootcamp-intensif*') ? 'active' : '' }}">Program Kursus</a></li>
                    <li><a href="{{ url('/event-webinar') }}" class="nav-link {{ request()->is('event-webinar*') || request()->is('webinar-tech*') || request()->is('workshop-online*') ? 'active' : '' }}">Event & Webinar</a></li>
                    <li><a href="{{ url('/layanan') }}" class="nav-link {{ request()->is('layanan') ? 'active' : '' }}">Layanan</a></li>
                    
                    <!-- Dropdown "Lainnya" -->
                    @php
                        $isLainnyaActive = request()->is('portofolio*') || request()->is('blog*') || request()->is('kontak*');
                    @endphp
                    <li class="dropdown" id="navDropdown">
                        <a href="#" class="nav-link dropdown-toggle {{ $isLainnyaActive ? 'active' : '' }}" id="dropdownBtn">
                            Lainnya <i class="fas fa-chevron-down" style="font-size: 12px; margin-left: 3px;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/portofolio') }}" class="{{ request()->is('portofolio*') ? 'active' : '' }}">Portofolio</a></li>
                            <li><a href="{{ url('/blog') }}" class="{{ request()->is('blog*') ? 'active' : '' }}">Blog</a></li>
                            <li><a href="{{ url('/kontak') }}" class="{{ request()->is('kontak*') ? 'active' : '' }}">Kontak</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- 3. BAGIAN KANAN (Tampil di Mobile) -->
                <div class="header-actions mobile-actions">
                    <a href="https://wa.me/{{ \App\Models\Setting::getValue('contact_whatsapp_chat', '6281476652656') }}" class="btn-solid-nav" target="_blank">Konsultasi</a>
                </div>
            </nav>

            <!-- 3. BAGIAN KANAN (Tampil di Desktop) -->
            <div class="header-actions desktop-actions">
                <a href="https://wa.me/{{ \App\Models\Setting::getValue('contact_whatsapp_chat', '6281476652656') }}" class="btn-solid-nav" target="_blank">Konsultasi</a>
            </div>
        </div>
    </header>

    <!-- CSS Navbar Baru -->
    <style>
        .custom-header {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            position: sticky;
            top: 0;
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s ease;
        }
        
        /* Transparent Header Overrides (Welcome Page) */
        .custom-header.transparent-header:not(.scrolled) {
            background: transparent;
            border-bottom: none;
            box-shadow: none;
        }
        .custom-header.transparent-header:not(.scrolled) .header-logo-text,
        .custom-header.transparent-header:not(.scrolled) .nav-link,
        .custom-header.transparent-header:not(.scrolled) .mobile-toggle {
            color: #ffffff !important;
        }
        .custom-header.transparent-header:not(.scrolled) .nav-link:hover,
        .custom-header.transparent-header:not(.scrolled) .nav-link.active {
            background-color: transparent !important;
            color: #ffffff !important;
        }
        .custom-header.transparent-header:not(.scrolled) .nav-link:hover::after,
        .custom-header.transparent-header:not(.scrolled) .nav-link.active::after {
            background-color: #ffffff !important;
        }
        .custom-header.transparent-header:not(.scrolled) .btn-solid-nav {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .custom-header.transparent-header.scrolled {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }
        .header-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header-logo a {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        .header-logo img {
            height: 38px;
            width: auto;
        }
        .header-logo span {
            font-size: 24px;
            font-weight: 800;
            color: #4B6BF5; /* Warna biru khas */
            letter-spacing: -0.5px;
        }
        .nav-list {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 28px;
        }
        .nav-link {
            color: #1a202c !important;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            padding: 5px 0;
            border-radius: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            position: relative;
        }
        .nav-link:hover {
            color: #4B6BF5 !important;
            background-color: transparent !important;
        }
        .nav-link.active {
            color: #1a202c !important;
            background-color: transparent !important;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -6px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: transparent;
            transition: background-color 0.3s ease;
        }
        .nav-link:hover::after,
        .nav-link.active::after {
            background-color: #4B6BF5;
        }
        
        .btn-solid-nav {
            background-color: #4B6BF5;
            color: #ffffff !important;
            font-size: 15px;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .btn-solid-nav:hover {
            background-color: #3154f3;
            transform: translateY(-2px);
        }
        /* Dropdown Styles */
        .dropdown {
            position: relative;
        }
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            border: 1px solid #f1f5f9;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            min-width: 200px;
            list-style: none;
            padding: 10px 0;
            margin: 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        .dropdown.show .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-menu li a {
            display: block;
            padding: 10px 24px;
            color: #4B5563;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.2s;
        }
        .dropdown-menu li a:hover,
        .dropdown-menu li a.active {
            background: #eef6fc !important;
            color: #4B6BF5 !important;
        }
        /* Style Tombol Kanan */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .btn-solid {
            background: #4B6BF5;
            color: #fff !important;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-solid:hover {
            background: #4B6BF5;
            transform: translateY(-2px);
        }
        .btn-outline {
            background: transparent;
            color: #005a96 !important;
            border: 1.5px solid #005a96;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-outline:hover {
            background: #eef6fc;
        }
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: #1F2937;
            cursor: pointer;
        }
        .desktop-actions { display: flex; }
        .mobile-actions { display: none; }

        /* Responsif untuk Layar HP/Tablet */
        @media (max-width: 1024px) {
            .mobile-toggle { display: block; }
            .desktop-actions { display: none; }
            .header-nav {
                position: absolute;
                top: 80px;
                left: 0;
                width: 100%;
                background: #fff;
                padding: 20px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.05);
                display: none;
                flex-direction: column;
                border-top: 1px solid #f1f5f9;
            }
            .header-nav.active { display: flex; }
            .nav-list {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }
            .nav-list li { width: 100%; }
            .nav-link { width: 100%; padding: 14px; border-bottom: 1px solid #f1f5f9;}
            .dropdown-menu {
                position: static;
                box-shadow: none;
                border: none;
                padding-left: 20px;
                opacity: 1;
                visibility: visible;
                transform: none;
                display: none;
            }
            .dropdown.show .dropdown-menu { display: block; }
            .mobile-actions {
                display: flex;
                flex-direction: column;
                width: 100%;
                margin-top: 20px;
                gap: 10px;
            }
            .mobile-actions a {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <!-- Script Navbar Baru -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mainHeader = document.getElementById('main-header');
            if (mainHeader && mainHeader.classList.contains('transparent-header')) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        mainHeader.classList.add('scrolled');
                    } else {
                        mainHeader.classList.remove('scrolled');
                    }
                });
            }
            const mobileToggle = document.getElementById('mobile-toggle');
            const headerNav = document.getElementById('header-nav');
            const dropdownBtn = document.getElementById('dropdownBtn');
            const dropdown = document.getElementById('navDropdown');

            // Buka tutup menu mobile
            if (mobileToggle && headerNav) {
                mobileToggle.addEventListener('click', () => {
                    headerNav.classList.toggle('active');
                    const icon = mobileToggle.querySelector('i');
                    if(headerNav.classList.contains('active')){
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Buka tutup menu dropdown "Lainnya"
            if (dropdownBtn) {
                dropdownBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    dropdown.classList.toggle('show');
                });
            }

            // Tutup dropdown jika klik di luar area
            window.addEventListener('click', (e) => {
                if (dropdown && !dropdown.contains(e.target)) {
                    dropdown.classList.remove('show');
                }
            });
        });
    </script>
    <!-- ================= END NAVBAR BARU ================= -->

    <main id="main-content">
        {{ $slot }}
    </main>

    <footer class="custom-footer">
        <div class="footer-container">
            <!-- Col 1 -->
            <div class="footer-col">
                <div class="footer-logo" style="margin-bottom: 25px; display: flex; align-items: baseline;">
                    <a href="{{ url('/') }}" style="text-decoration: none;">
                        <img src="{{ asset('gambar/aset/logo.png?v=2') }}" alt="Elcoding.id" style="height: 42px; width: auto; object-fit: contain;">
                    </a>
                </div>
                <p class="footer-desc">Software House profesional penyedia jasa pembuatan aplikasi/website, sekaligus
                    Lembaga Kursus dan Pelatihan IT terpadu berbasis praktik untuk mencetak talenta digital masa depan.
                </p>

                <h3 class="footer-heading">Jam Operasional</h3>
                <ul class="footer-list icon-list">
                    <li><i class="far fa-clock"></i> Senin - Sabtu (08.00 - 17.00 WIB)</li>
                    <li><i class="far fa-calendar-times"></i> Minggu (Libur)</li>
                </ul>
            </div>

            <!-- Col 2 -->
            <div class="footer-col">
                <h3 class="footer-heading">Quick Links</h3>
                <ul class="footer-list">
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                    <li><a href="{{ url('/layanan') }}">Layanan</a></li>
                    <li><a href="{{ url('/program-kursus') }}">Program Kursus</a></li>
                    <li><a href="{{ url('/event-webinar') }}">Event & Webinar</a></li>
                    <li><a href="{{ url('/portofolio') }}">Portofolio</a></li>
                    <li><a href="{{ url('/blog') }}">Blog</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                </ul>
            </div>

            <!-- Col 3 -->
            <div class="footer-col">
                <h3 class="footer-heading">Panduan & Kebijakan</h3>
                <ul class="footer-list">
                    <li><a href="#" onclick="openFooterModal('faqModal', event)">FAQ</a></li>
                    <li><a href="#" onclick="openFooterModal('tncModal', event)">Syarat dan Ketentuan</a></li>
                    <li><a href="#" onclick="openFooterModal('privacyModal', event)">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <!-- Col 4 -->
            <div class="footer-col">
                <h3 class="footer-heading">Informasi Kontak</h3>
                <ul class="footer-list icon-list contact-list">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Kantor Utama:</strong><br>
                            {{ \App\Models\Setting::getValue('contact_address', 'Ruko Citraland, Tegal, Jawa Tengah') }}
                        </div>
                    </li>
                    @if (\App\Models\Setting::getValue('contact_address_bekasi'))
                        <li style="margin-top: 10px;">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Kantor Cabang:</strong><br>
                                {{ \App\Models\Setting::getValue('contact_address_bekasi') }}
                            </div>
                        </li>
                    @endif
                    @if (\App\Models\Setting::getValue('contact_address_jakarta'))
                        <li style="margin-top: 10px;">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Kampus USM (Jakarta):</strong><br>
                                {{ \App\Models\Setting::getValue('contact_address_jakarta') }}
                            </div>
                        </li>
                    @endif
                    <li style="margin-top: 12px;"><i class="fab fa-whatsapp"></i> Admin 1:
                        <a href="https://wa.me/6281476652656" target="_blank" style="color: inherit; text-decoration: none; font-weight: 600;">+62 814-7665-2656</a>
                    </li>
                    <li style="margin-top: 4px;"><i class="fab fa-whatsapp"></i> Admin 2:
                        <a href="https://wa.me/6287762334232" target="_blank" style="color: inherit; text-decoration: none; font-weight: 600;">+62 877-6233-4232</a>
                    </li>
                    <li><i class="fas fa-envelope"></i>
                        {{ \App\Models\Setting::getValue('contact_email', 'info@elcodingacademy.com') }}</li>
                </ul>
            </div> <!-- End Col 4 -->
        </div> <!-- End Footer Container -->

        <div class="footer-bottom">
            <div class="footer-bottom-container">
                <p>Copyright &copy;2026 All rights reserved</p>
                <div class="footer-socials-bottom">
                    <a href="{{ \App\Models\Setting::getValue('social_twitter', '#') }}"><i class="fab fa-twitter"></i></a>
                    <a href="{{ \App\Models\Setting::getValue('social_facebook', '#') }}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ \App\Models\Setting::getValue('social_website', '#') }}"><i class="fas fa-globe"></i></a>
                    <a href="{{ \App\Models\Setting::getValue('social_instagram', '#') }}"><i class="fab fa-instagram"></i></a>
                    <a href="{{ \App\Models\Setting::getValue('social_youtube', '#') }}"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <style>
        .custom-footer {
            background-color: #04091e;
            padding-top: 100px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border-top: none;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
            gap: 20px;
        }

        .footer-logo {
            margin: 0 0 15px 0;
            font-weight: 800;
            color: #1F2937;
            font-size: 28px;
        }

        .footer-desc {
            color: #7b838a;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .footer-heading {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin: 0 0 30px 0;
            position: relative;
        }

        .footer-heading::after {
            display: none;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-list li {
            margin-bottom: 15px;
            font-size: 15px;
            color: #7b838a;
        }

        .footer-list li a {
            color: #7b838a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-list li a:hover {
            color: #4B6BF5;
        }

        .icon-list li {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .icon-list li i {
            margin-top: 4px;
            color: #7b838a;
            font-size: 16px;
        }

        .contact-list li {
            line-height: 1.6;
        }

        .footer-bottom {
            background-color: transparent;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 30px 20px;
            margin-top: 80px;
            font-size: 15px;
        }

        .footer-bottom-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-bottom p {
            margin: 0;
            color: #7b838a;
        }

        .footer-socials-bottom {
            display: flex;
            gap: 20px;
        }

        .footer-socials-bottom a {
            color: #7b838a;
            font-size: 15px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-socials-bottom a:hover {
            color: #4B6BF5;
        }

        @media (max-width: 768px) {
            .footer-bottom-container {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }

        @media (max-width: 1200px) {
            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        const lazyloadRunObserver = () => {
            const lazyloadBackgrounds = document.querySelectorAll(`.e-con.e-parent:not(.e-lazyloaded)`);
            const lazyloadBackgroundObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        let lazyloadBackground = entry.target;
                        if (lazyloadBackground) {
                            lazyloadBackground.classList.add('e-lazyloaded');
                        }
                        lazyloadBackgroundObserver.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: '200px 0px 200px 0px'
            });
            lazyloadBackgrounds.forEach((lazyloadBackground) => {
                lazyloadBackgroundObserver.observe(lazyloadBackground);
            });
        };
        const events = [
            'DOMContentLoaded',
            'elementor/lazyload/observe',
        ];
        events.forEach((event) => {
            document.addEventListener(event, lazyloadRunObserver);
        });
    </script>
    <script id="jquery-core-js" src="{{ asset('assets/wp-includes/js/jquery/jquery.min.js') }}" defer></script>
    <script id="jquery-migrate-js" src="{{ asset('assets/wp-includes/js/jquery/jquery-migrate.min.js') }}" defer></script>
    <script id="smartmenus-js"
        src="{{ asset('assets/wp-content/plugins/pro-elements/assets/lib/smartmenus/jquery.smartmenus.min.js') }}" defer>
    </script>
    <script id="elementor-webpack-runtime-js"
        src="{{ asset('assets/wp-content/plugins/elementor/assets/js/webpack.runtime.min.js') }}" defer></script>
    <script id="elementor-frontend-modules-js"
        src="{{ asset('assets/wp-content/plugins/elementor/assets/js/frontend-modules.min.js') }}" defer></script>
    <script id="jquery-ui-core-js" src="{{ asset('assets/wp-includes/js/jquery/ui/core.min.js') }}" defer></script>
    <script id="elementor-frontend-js-before">
        var elementorFrontendConfig = {
            "environmentMode": {
                "edit": false,
                "wpPreview": false,
                "isScriptDebug": false
            },
            "i18n": {
                "shareOnFacebook": "Share on Facebook",
                "shareOnTwitter": "Share on Twitter",
                "pinIt": "Pin it",
                "download": "Download",
                "downloadImage": "Download image",
                "fullscreen": "Fullscreen",
                "zoom": "Zoom",
                "share": "Share",
                "playVideo": "Play Video",
                "previous": "Previous",
                "next": "Next",
                "close": "Close",
                "a11yCarouselPrevSlideMessage": "Previous slide",
                "a11yCarouselNextSlideMessage": "Next slide",
                "a11yCarouselFirstSlideMessage": "This is the first slide",
                "a11yCarouselLastSlideMessage": "This is the last slide",
                "a11yCarouselPaginationBulletMessage": "Go to slide"
            },
            "is_rtl": false,
            "breakpoints": {
                "xs": 0,
                "sm": 480,
                "md": 768,
                "lg": 1025,
                "xl": 1440,
                "xxl": 1600
            },
            "responsive": {
                "breakpoints": {
                    "mobile": {
                        "label": "Mobile Portrait",
                        "value": 767,
                        "default_value": 767,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "mobile_extra": {
                        "label": "Mobile Landscape",
                        "value": 880,
                        "default_value": 880,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "tablet": {
                        "label": "Tablet Portrait",
                        "value": 1024,
                        "default_value": 1024,
                        "direction": "max",
                        "is_enabled": true
                    },
                    "tablet_extra": {
                        "label": "Tablet Landscape",
                        "value": 1200,
                        "default_value": 1200,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "laptop": {
                        "label": "Laptop",
                        "value": 1366,
                        "default_value": 1366,
                        "direction": "max",
                        "is_enabled": false
                    },
                    "widescreen": {
                        "label": "Widescreen",
                        "value": 2400,
                        "default_value": 2400,
                        "direction": "min",
                        "is_enabled": false
                    }
                },
                "hasCustomBreakpoints": false
            },
            "version": "4.1.3",
            "is_static": false,
            "experimentalFeatures": {
                "additional_custom_breakpoints": true,
                "container": true,
                "e_optimized_markup": true,
                "theme_builder_v2": true,
                "nested-elements": true,
                "global_classes_should_enforce_capabilities": true,
                "e_variables": true,
                "e_opt_in_v4_page": true,
                "e_components": true,
                "e_interactions": true,
                "e_widget_creation": true,
                "import-export-customization": true,
                "e_pro_atomic_form": true,
                "e_pro_variables": true,
                "e_pro_interactions": true
            },
            "urls": {
                "assets": "{{ asset('assets/wp-content/plugins/elementor/assets') }}/",
                "ajaxurl": "",
                "uploadUrl": ""
            },
            "nonces": {
                "floatingButtonsClickTracking": "213a468a16",
                "atomicFormsSendForm": "3562f2742a"
            },
            "swiperClass": "swiper",
            "settings": {
                "page": [],
                "editorPreferences": []
            },
            "kit": {
                "active_breakpoints": ["viewport_mobile", "viewport_tablet"],
                "global_image_lightbox": "yes",
                "lightbox_enable_counter": "yes",
                "lightbox_enable_fullscreen": "yes",
                "lightbox_enable_zoom": "yes",
                "lightbox_enable_share": "yes",
                "lightbox_title_src": "title",
                "lightbox_description_src": "description"
            },
            "post": {
                "id": 6296,
                "title": "Elcoding Academy",
                "excerpt": ""
            }
        };
    </script>
    <script id="elementor-frontend-js" src="{{ asset('assets/wp-content/plugins/elementor/assets/js/frontend.min.js') }}"
        defer></script>
    <script id="e-sticky-js"
        src="{{ asset('assets/wp-content/plugins/pro-elements/assets/lib/sticky/jquery.sticky.min.js') }}" defer></script>
    <script id="swiper-js" src="{{ asset('assets/wp-content/plugins/elementor/assets/lib/swiper/v8/swiper.min.js') }}"
        defer></script>
    <script id="imagesloaded-js" src="{{ asset('assets/wp-includes/js/imagesloaded.min.js') }}" defer></script>
    <script id="elementor-pro-webpack-runtime-js"
        src="{{ asset('assets/wp-content/plugins/pro-elements/assets/js/webpack-pro.runtime.min.js') }}" defer></script>
    <script id="elementor-pro-frontend-js-before">
        var ElementorProFrontendConfig = {
            "ajaxurl": "",
            "nonce": "bdfd649656",
            "urls": {
                "assets": "{{ asset('assets/wp-content/plugins/pro-elements/assets') }}/",
                "rest": ""
            },
            "settings": {
                "lazy_load_background_images": true
            },
            "popup": {
                "hasPopUps": true
            },
            "shareButtonsNetworks": {
                "facebook": {
                    "title": "Facebook",
                    "has_counter": true
                },
                "twitter": {
                    "title": "Twitter"
                },
                "linkedin": {
                    "title": "LinkedIn",
                    "has_counter": true
                },
                "pinterest": {
                    "title": "Pinterest",
                    "has_counter": true
                },
                "reddit": {
                    "title": "Reddit",
                    "has_counter": true
                },
                "vk": {
                    "title": "VK",
                    "has_counter": true
                },
                "odnoklassniki": {
                    "title": "OK",
                    "has_counter": true
                },
                "tumblr": {
                    "title": "Tumblr"
                },
                "digg": {
                    "title": "Digg"
                },
                "skype": {
                    "title": "Skype"
                },
                "stumbleupon": {
                    "title": "StumbleUpon",
                    "has_counter": true
                },
                "mix": {
                    "title": "Mix"
                },
                "telegram": {
                    "title": "Telegram"
                },
                "pocket": {
                    "title": "Pocket",
                    "has_counter": true
                },
                "xing": {
                    "title": "XING",
                    "has_counter": true
                },
                "whatsapp": {
                    "title": "WhatsApp"
                },
                "email": {
                    "title": "Email"
                },
                "print": {
                    "title": "Print"
                },
                "x-twitter": {
                    "title": "X"
                },
                "threads": {
                    "title": "Threads"
                }
            },
            "facebook_sdk": {
                "lang": "en_US",
                "app_id": ""
            },
            "lottie": {
                "defaultAnimationUrl": "{{ asset('assets/wp-content/plugins/pro-elements/modules/lottie/assets/animations/default.json') }}"
            }
        };
    </script>
    <script id="elementor-pro-frontend-js"
        src="{{ asset('assets/wp-content/plugins/pro-elements/assets/js/frontend.min.js') }}" defer></script>
    <script id="pro-elements-handlers-js"
        src="{{ asset('assets/wp-content/plugins/pro-elements/assets/js/elements-handlers.min.js') }}" defer></script>

    <!-- Floating WhatsApp Widget -->
    <div class="floating-wa-container">
        <div class="floating-wa-popup" id="waPopup">
            <div class="wa-popup-header">
                <strong>Konsultasi Via WhatsApp</strong>
                <span class="wa-popup-subtitle">Pilih admin untuk konsultasi:</span>
            </div>
            <a href="https://wa.me/6281476652656?text=Halo%20Admin%201%20Elcoding,%20saya%20ingin%20berkonsultasi..." target="_blank" class="wa-admin-item">
                <i class="fab fa-whatsapp"></i>
                <div>
                    <strong>Admin 1</strong>
                    <span>0814-7665-2656</span>
                </div>
            </a>
            <a href="https://wa.me/6287762334232?text=Halo%20Admin%202%20Elcoding,%20saya%20ingin%20berkonsultasi..." target="_blank" class="wa-admin-item">
                <i class="fab fa-whatsapp"></i>
                <div>
                    <strong>Admin 2</strong>
                    <span>0877-6233-4232</span>
                </div>
            </a>
        </div>
        <button type="button" class="floating-whatsapp" id="waBtn" title="Chat WhatsApp Admin" onclick="toggleWaPopup()">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
        </button>
    </div>

    <style>
        .floating-wa-container {
            position: fixed;
            bottom: 110px;
            right: 30px;
            z-index: 9999;
        }

        .floating-whatsapp {
            width: 60px;
            height: 60px;
            background-color: #25d366;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            outline: none;
        }

        .floating-whatsapp:hover {
            transform: scale(1.1) translateY(-3px);
            box-shadow: 0 15px 35px rgba(37, 211, 102, 0.6);
        }

        .floating-whatsapp img {
            width: 35px;
            height: 35px;
        }

        .floating-wa-popup {
            display: none;
            position: absolute;
            bottom: 75px;
            right: 0;
            width: 250px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 16px;
            border: 1px solid #e2e8f0;
            flex-direction: column;
            gap: 10px;
        }

        .floating-wa-popup.show {
            display: flex;
        }

        .wa-popup-header {
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 8px;
            margin-bottom: 2px;
        }

        .wa-popup-header strong {
            display: block;
            font-size: 14px;
            color: #1e293b;
        }

        .wa-popup-subtitle {
            font-size: 12px;
            color: #64748b;
        }

        .wa-admin-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            background: #f8fafc;
            text-decoration: none;
            color: #334155;
            transition: all 0.2s ease;
            border: 1px solid #e2e8f0;
        }

        .wa-admin-item i {
            font-size: 22px;
            color: #25d366;
        }

        .wa-admin-item:hover {
            background: #25d366;
            color: #ffffff;
            border-color: #25d366;
        }

        .wa-admin-item:hover i {
            color: #ffffff;
        }

        .wa-admin-item strong {
            display: block;
            font-size: 13px;
        }

        .wa-admin-item span {
            font-size: 12px;
            opacity: 0.9;
        }

        @media (max-width: 480px) {
            .floating-wa-container {
                bottom: 85px;
                right: 20px;
            }
            .floating-whatsapp {
                width: 50px;
                height: 50px;
            }
            .floating-whatsapp img {
                width: 30px;
                height: 30px;
            }
        }
    </style>

    <script>
        function toggleWaPopup() {
            const popup = document.getElementById('waPopup');
            if (popup) {
                popup.classList.toggle('show');
            }
        }

        document.addEventListener('click', function(e) {
            const container = document.querySelector('.floating-wa-container');
            const popup = document.getElementById('waPopup');
            if (container && popup && !container.contains(e.target)) {
                popup.classList.remove('show');
            }
        });
    </script>

    <!-- Chatbot Modal terhubung ke ChatController -->
    <div id="chatbot-modal" class="chatbot-modal">
        <div class="chatbot-header">
            <div class="header-info">
                <div class="avatar-wrap">
                    <i class="fas fa-user-circle"></i>
                    <span class="status-dot"></span>
                </div>
                <div>
                    <h4>Admin Elcoding</h4>
                    <span>Online</span>
                </div>
            </div>
            <button onclick="document.getElementById('chatbot-modal').style.display='none'">&times;</button>
        </div>
        <div class="chatbot-body" id="chatbot-body">
            <div class="msg-wrapper bot-wrapper">
                <div class="msg-avatar"><i class="fas fa-user-circle"></i></div>
                <div class="chatbot-msg bot-msg">Halo Kak! Ada yang bisa dibantu terkait layanan di Elcoding? Silakan
                    pilih topik di bawah ini, atau langsung ketik pesan Kakak.</div>
            </div>
            <div class="chatbot-options" id="chatbot-options">
                <button onclick="askBot('Jasa buat aplikasi apa saja?')">Jasa buat aplikasi apa saja?</button>
                <button onclick="askBot('Berapa biaya buat aplikasi?')">Berapa biaya buat aplikasi?</button>
                <button onclick="askBot('Berapa biaya kursus IT?')">Berapa biaya kursus IT?</button>
                <button onclick="askBot('Bagaimana cara konsultasi?')">Bagaimana cara konsultasi?</button>
            </div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chat-input" placeholder="Ketik pesan di sini..."
                onkeypress="handleEnter(event)" style="background: #fff; color: #1e293b; cursor: text;">
            <button onclick="sendUserMessage()" style="background: #4B6BF5; cursor: pointer;"><i
                    class="fas fa-paper-plane"></i></button>
        </div>
    </div>

    <style>
        .chatbot-modal {
            display: none;
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 360px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            z-index: 10000;
            overflow: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 480px) {
            .chatbot-modal {
                width: calc(100% - 40px);
                right: 20px;
                bottom: 90px;
            }
        }

        .chatbot-header {
            background: #fff;
            color: #1e293b;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 2;
        }

        .header-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar-wrap {
            position: relative;
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #4B6BF5 0%, #8B5CF6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .status-dot {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            background: #22c55e;
            border: 2px solid #fff;
            border-radius: 50%;
        }

        .header-info h4 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
        }

        .header-info span {
            font-size: 12px;
            color: #22c55e;
            font-weight: 600;
        }

        .chatbot-header button {
            background: none;
            border: none;
            color: #94a3b8;
            font-size: 24px;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0;
            line-height: 1;
        }

        .chatbot-header button:hover {
            color: #0f172a;
        }

        .chatbot-body {
            padding: 20px;
            height: 380px;
            overflow-y: auto;
            background: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 16px;
            scroll-behavior: smooth;
        }

        .msg-wrapper {
            display: flex;
            gap: 10px;
            align-items: flex-end;
            animation: slideUp 0.3s ease;
        }

        .user-wrapper {
            justify-content: flex-end;
        }

        .bot-wrapper {
            justify-content: flex-start;
        }

        .msg-avatar {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #4B6BF5 0%, #8B5CF6 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 13px;
            flex-shrink: 0;
        }

        .chatbot-msg {
            padding: 12px 16px;
            font-size: 14px;
            max-width: 80%;
            line-height: 1.5;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .bot-msg {
            background: #fff;
            border: 1px solid #e2e8f0;
            color: #334155;
            border-radius: 16px 16px 16px 4px;
        }

        .user-msg {
            background: #4B6BF5;
            color: #fff;
            border-radius: 16px 16px 4px 16px;
        }

        /* Typing indicator */
        .typing-indicator {
            display: flex;
            gap: 4px;
            padding: 14px 16px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px 16px 16px 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            background: #94a3b8;
            border-radius: 50%;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes typing {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Options redesign */
        .chatbot-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 2px;
            animation: slideUp 0.4s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .chatbot-options button {
            background: #fff;
            color: #4B6BF5;
            border: 1px solid #4B6BF5;
            border-radius: 12px;
            padding: 8px 10px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            font-weight: 500;
            white-space: normal;
            text-align: left;
            line-height: 1.3;
        }

        .chatbot-options button:hover {
            background: #4B6BF5;
            color: #fff;
        }

        .chatbot-footer {
            padding: 15px;
            background: #fff;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 10px;
        }

        .chatbot-footer input {
            flex-grow: 1;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            outline: none;
            font-family: inherit;
            font-size: 14px;
        }

        .chatbot-footer button {
            background: #4B6BF5;
            color: #fff;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function toggleChatbot(e) {
            e.preventDefault();
            const modal = document.getElementById('chatbot-modal');
            modal.style.display = modal.style.display === 'block' ? 'none' : 'block';
        }

        function handleEnter(event) {
            if (event.key === 'Enter') sendUserMessage();
        }

        function sendUserMessage() {
            const inputField = document.getElementById('chat-input');
            const message = inputField.value.trim();
            if (!message) return;

            inputField.value = '';
            hideOptions();
            askGeminiAPI(message);
        }

        function askBot(question) {
            hideOptions();
            askGeminiAPI(question);
        }

        function hideOptions() {
            const options = document.getElementById('chatbot-options');
            if (options) options.style.display = 'none';
        }

        async function askGeminiAPI(message) {
            const body = document.getElementById('chatbot-body');

            const userWrap = document.createElement('div');
            userWrap.className = 'msg-wrapper user-wrapper';
            userWrap.innerHTML = '<div class="chatbot-msg user-msg">' + message + '</div>';
            body.appendChild(userWrap);
            body.scrollTop = body.scrollHeight;

            const typingWrap = document.createElement('div');
            typingWrap.className = 'msg-wrapper bot-wrapper';
            typingWrap.innerHTML =
                '<div class="msg-avatar"><i class="fas fa-user-circle"></i></div><div class="typing-indicator"><div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div></div>';
            body.appendChild(typingWrap);
            body.scrollTop = body.scrollHeight;

            try {
                const response = await fetch('/chat-gemini', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        message: message
                    })
                });

                const data = await response.json();
                body.removeChild(typingWrap);

                const botWrap = document.createElement('div');
                botWrap.className = 'msg-wrapper bot-wrapper';

                const formattedAnswer = data.answer.replace(/\n/g, '<br>');

                botWrap.innerHTML =
                    '<div class="msg-avatar"><i class="fas fa-user-circle"></i></div><div class="chatbot-msg bot-msg">' +
                    formattedAnswer + '</div>';
                body.appendChild(botWrap);
                body.scrollTop = body.scrollHeight;

            } catch (error) {
                body.removeChild(typingWrap);
                const errWrap = document.createElement('div');
                errWrap.className = 'msg-wrapper bot-wrapper';
                errWrap.innerHTML =
                    '<div class="chatbot-msg bot-msg">Mohon maaf Kak, sistem sedang terkendala. Silakan coba lagi.</div>';
                body.appendChild(errWrap);
                body.scrollTop = body.scrollHeight;
            }
        }
    </script>

    <!-- Footer Modals -->
    <div id="faqModal" class="footer-modal">
        <div class="footer-modal-content">
            <span class="footer-modal-close" onclick="closeFooterModal('faqModal')">&times;</span>
            <h2>Frequently Asked Questions (FAQ)</h2>
            <div class="footer-modal-body">
                <h4>1. Apa itu Elcoding?</h4>
                <p>Elcoding adalah Software House profesional penyedia jasa pembuatan website/aplikasi, sekaligus
                    lembaga kursus dan pelatihan IT untuk menyiapkan talenta digital yang siap kerja.</p>
                <h4>2. Berapa lama durasi program kursus?</h4>
                <p>Durasi kursus bervariasi tergantung program yang dipilih, umumnya berkisar antara 2 hingga 4 bulan
                    intensif.</p>
                <h4>3. Apakah ada fasilitas penyaluran kerja?</h4>
                <p>Ya, bagi lulusan terbaik, kami memberikan fasilitas rekomendasi dan penyaluran kerja ke mitra
                    perusahaan kami.</p>
                <h4>4. Apakah pemula bisa ikut?</h4>
                <p>Tentu, kurikulum kami dirancang mulai dari tingkat dasar (basic) sehingga sangat cocok untuk pemula.
                </p>
            </div>
        </div>
    </div>

    <div id="tncModal" class="footer-modal">
        <div class="footer-modal-content">
            <span class="footer-modal-close" onclick="closeFooterModal('tncModal')">&times;</span>
            <h2>Syarat dan Ketentuan</h2>
            <div class="footer-modal-body">
                <p>Dengan mengakses layanan Elcoding (baik jasa Software House maupun pendaftaran kursus), Anda
                    menyetujui syarat dan ketentuan berikut:</p>
                <ul>
                    <li><strong>Pendaftaran:</strong> Peserta wajib mengisi data dengan benar dan melakukan pembayaran
                        sesuai tagihan untuk mengamankan kursi kelas.</li>
                    <li><strong>Pembatalan:</strong> Pembatalan kelas hanya dapat dilakukan maksimal 7 hari sebelum
                        kelas dimulai dengan potongan administrasi.</li>
                    <li><strong>Tata Tertib:</strong> Peserta wajib mengikuti seluruh tata tertib dan menjaga
                        kondusivitas selama proses pembelajaran.</li>
                    <li><strong>Sertifikasi:</strong> Sertifikat kompetensi hanya diberikan kepada peserta yang
                        menyelesaikan seluruh modul dan final project dengan baik.</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="privacyModal" class="footer-modal">
        <div class="footer-modal-content">
            <span class="footer-modal-close" onclick="closeFooterModal('privacyModal')">&times;</span>
            <h2>Kebijakan Privasi</h2>
            <div class="footer-modal-body">
                <p>Elcoding Academy sangat menghargai privasi Anda. Kebijakan ini menjelaskan bagaimana kami melindungi
                    data Anda:</p>
                <ul>
                    <li><strong>Pengumpulan Data:</strong> Kami mengumpulkan data pribadi (nama, kontak, email) yang
                        Anda berikan secara sukarela saat pendaftaran atau konsultasi.</li>
                    <li><strong>Penggunaan Data:</strong> Data Anda digunakan secara eksklusif untuk keperluan
                        administrasi akademik, informasi promo, dan penyaluran kerja.</li>
                    <li><strong>Keamanan:</strong> Kami berkomitmen untuk tidak membagikan, menjual, atau menyewakan
                        data pribadi Anda kepada pihak ketiga tanpa persetujuan tertulis dari Anda.</li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        .footer-modal {
            display: none;
            position: fixed;
            z-index: 100000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            overflow-y: auto;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .footer-modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 40px;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .footer-modal-close {
            position: absolute;
            top: 20px;
            right: 25px;
            color: #94a3b8;
            font-size: 32px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            transition: color 0.3s ease;
        }

        .footer-modal-close:hover {
            color: #0f172a;
        }

        .footer-modal-content h2 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 800;
            margin-top: 0;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .footer-modal-body h4 {
            color: #334155;
            font-size: 16px;
            font-weight: 700;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .footer-modal-body p {
            color: #475569;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .footer-modal-body ul {
            color: #475569;
            font-size: 15px;
            line-height: 1.6;
            padding-left: 20px;
        }

        .footer-modal-body ul li {
            margin-bottom: 10px;
        }
    </style>

    <script>
        function openFooterModal(modalId, event) {
            if (event) event.preventDefault();
            document.getElementById(modalId).style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeFooterModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            document.body.style.overflow = 'auto';
        }
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('footer-modal')) {
                event.target.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    </script>

    <!-- Floating AI Chatbot Button -->
    <a href="#" class="floating-chatbot" title="Chat dengan Customer Service" onclick="toggleChatbot(event)">
        <i class="fas fa-headset" style="color: #ffffff;"></i>
    </a>
    <style>
        .floating-chatbot {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4B6BF5 0%, #8B5CF6 100%);
            color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 28px;
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.4);
            z-index: 9999;
            text-decoration: none;
            transition: all 0.3s ease;
            animation: float-pulse 2s infinite;
        }

        .floating-chatbot:hover {
            transform: scale(1.1) translateY(-5px);
            color: #fff;
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.6);
        }

        @keyframes float-pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.5);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(139, 92, 246, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(139, 92, 246, 0);
            }
        }

        @media (max-width: 480px) {
            .floating-chatbot {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 24px;
            }
        }
    </style>

    @stack('scripts')
</body>

</html>
