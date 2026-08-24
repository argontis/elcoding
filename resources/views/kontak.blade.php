<x-layout title="Hubungi Kami - Elcoding Academy">
    @push('preload')
        <link rel="preload" as="image" href="{{ asset('gambar/aset/Untitled-1.png') }}">
    @endpush

    @push('styles')
        <link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset('css/post-11887.css?v=3') }}' media='all' />
        <style>
            /* Fix Hero Background Image */
            .elementor-element-691d17c::before {
                background-image: url('{{ asset('gambar/aset/Untitled-1.png') }}') !important;
                background-position: center center !important;
                background-size: cover !important;
                content: "" !important;
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                z-index: 0 !important;
            }

            .elementor-element-691d17c>.e-con-inner {
                position: relative;
                z-index: 1;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <div class="elementor elementor-11887">
        <div class="elementor-element elementor-element-691d17c hide-hero-if e-flex e-con-boxed e-con e-parent"
            data-id="691d17c" data-element_type="container" data-e-type="container"
            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-0b653e6 elementor-widget elementor-widget-heading"
                    data-id="0b653e6" data-element_type="widget" data-e-type="widget"
                    data-widget_type="heading.default">
                    <h1 class="elementor-heading-title elementor-size-default">Kontak</h1>
                </div>
                <div class="elementor-element elementor-element-89b3de6 elementor-align-center elementor-widget elementor-widget-breadcrumbs"
                    data-id="89b3de6" data-element_type="widget" data-e-type="widget"
                    data-widget_type="breadcrumbs.default">
                    <p id="breadcrumbs"><span><span><a href="{{ url('/') }}">Home</a></span> » <span
                                class="breadcrumb_last" aria-current="page">Kontak</span></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">

            <div class="contact-grid">
                <!-- Info Column -->
                <div class="contact-info-col">
                    <div class="info-card">
                        <h3>Informasi Kontak</h3>
                        <p>Tim admin kami siap membantu dan merespon pertanyaan Anda secepat mungkin pada jam kerja.</p>

                        <ul class="info-list">
                            <li>
                                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                <div class="info-text">
                                    <strong>Kantor Utama</strong>
                                    <span>{{ \App\Models\Setting::getValue('contact_address', 'CitraLand Tegal blok Belleza Plaza Lt.2, Kraton, Kota Tegal, Jawa Tengah (Gedung Training Center)') }}</span>
                                </div>
                            </li>
                            @if (\App\Models\Setting::getValue('contact_address_bekasi'))
                                <li>
                                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="info-text">
                                        <strong>Kantor Cabang</strong>
                                        <span>{{ \App\Models\Setting::getValue('contact_address_bekasi', 'Jl. Alternatif Cibubur Ruko Kranggan Blok Rt16/27, Jatisampurna, Kota Bekasi, Jawa Barat') }}</span>
                                    </div>
                                </li>
                            @endif
                            @if (\App\Models\Setting::getValue('contact_address_jakarta'))
                                <li>
                                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="info-text">
                                        <strong>Kampus USM (Jakarta)</strong>
                                        <span>{{ \App\Models\Setting::getValue('contact_address_jakarta') }}</span>
                                    </div>
                                </li>
                            @endif
                            <li>
                                <div class="info-icon"><i class="fab fa-whatsapp"></i></div>
                                <div class="info-text">
                                    <strong>Telepon / WhatsApp</strong>
                                    <span>
                                        <a href="https://wa.me/6281476652656" target="_blank" style="color: inherit; text-decoration: none; font-weight: 600;">+62 814-7665-2656</a> &nbsp;|&nbsp; 
                                        <a href="https://wa.me/6287762334232" target="_blank" style="color: inherit; text-decoration: none; font-weight: 600;">+62 877-6233-4232</a>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="info-icon"><i class="far fa-envelope"></i></div>
                                <div class="info-text">
                                    <strong>Email</strong>
                                    <span>{{ \App\Models\Setting::getValue('contact_email', 'info@elcodingacademy.com') }}</span>
                                </div>
                            </li>
                            <li>
                                <div class="info-icon"><i class="far fa-clock"></i></div>
                                <div class="info-text">
                                    <strong>Jam Operasional</strong>
                                    <span>Senin - Sabtu (08.00 - 17.00 WIB)</span>
                                </div>
                            </li>
                        </ul>

                        <div class="social-links">
                            <strong>Ikuti Kami:</strong>
                            <a href="{{ \App\Models\Setting::getValue('social_facebook', '#') }}"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="{{ \App\Models\Setting::getValue('social_instagram', '#') }}"><i
                                    class="fab fa-instagram"></i></a>
                            <a href="{{ \App\Models\Setting::getValue('social_youtube', '#') }}"><i
                                    class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>

                <div class="contact-map-col" style="display: flex;">
                    <div class="map-container"
                        style="width: 100%; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eaeaea; display: flex;">
                        <iframe
                            src="{{ \App\Models\Setting::getValue('contact_map_iframe', 'https://maps.google.com/maps?q=Azzahra%20Computer%20Tegal&t=&z=17&ie=UTF8&iwloc=&output=embed') }}"
                            width="100%" height="100%" style="border:0; min-height: 450px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
    </section>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fcfc;
        }

        /* Contact Section */
        .contact-section {
            padding: 60px 20px 100px 20px;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 40px;
            margin-bottom: 60px;
            align-items: stretch;
        }

        /* Column Wrappers */
        .contact-info-col,
        .contact-map-col {
            display: flex;
        }

        /* Info Card */
        .info-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #eaeaea;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .info-card h3 {
            font-size: 28px;
            font-weight: 800;
            color: #1F2937;
            margin: 0 0 15px 0;
        }

        .info-card>p {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .info-list {
            list-style: none;
            padding: 0;
            margin: 0 0 30px 0;
        }

        .info-list li {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: #e5f3f3;
            color: #4B6BF5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .info-text strong {
            display: block;
            font-size: 16px;
            color: #1F2937;
            margin-bottom: 5px;
        }

        .info-text span {
            font-size: 15px;
            color: #666;
            line-height: 1.5;
        }

        .social-links {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-top: 25px;
            border-top: 1px solid #eee;
            margin-top: auto;
        }

        .social-links strong {
            font-size: 16px;
            color: #1F2937;
            margin-right: 5px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: #f0f0f0;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: #4B6BF5;
            color: #fff;
            transform: translateY(-3px);
        }



        /* Responsive */
        @media (max-width: 992px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 28px;
            }

            .info-card {
                padding: 20px;
            }

            .social-links {
                flex-wrap: wrap;
            }

            .contact-section {
                padding: 48px 16px 64px 16px;
            }
        }
    </style>

    @push('schema')
        <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "ContactPage",
  "name": "Kontak Kami - Elcoding Academy",
  "url": "{{ url('/kontak') }}",
  "mainEntity": {
    "@@type": "Organization",
    "contactPoint": {
      "@@type": "ContactPoint",
      "telephone": "+6281476652656, +6287762334232",
      "contactType": "customer service",
      "areaServed": "ID",
      "availableLanguage": "Indonesian"
    }
  }
}
</script>
    @endpush
</x-layout>
