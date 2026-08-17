<x-layout>
    <x-slot name="title">Produk & Layanan</x-slot>

    @push('preload')
    <link rel="preload" as="image" href="{{ asset('gambar/aset/Untitled-1.png') }}">
    @endpush

    @push('styles')
    <link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset("css/post-11887.css") }}' media='all' />
    <style>
        /* Fix Hero Background Image */
        .elementor-element-691d17c::before {
            background-image: url('{{ asset("gambar/aset/Untitled-1.png") }}') !important;
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
        .elementor-element-691d17c > .e-con-inner {
            position: relative;
            z-index: 1;
        }
    </style>
    @endpush

    <!-- Hero Section -->
    <div class="elementor elementor-11887">
        <div class="elementor-element elementor-element-691d17c hide-hero-if e-flex e-con-boxed e-con e-parent" data-id="691d17c" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="e-con-inner">
                <div class="elementor-element elementor-element-0b653e6 elementor-widget elementor-widget-heading" data-id="0b653e6" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
                    <h1 class="elementor-heading-title elementor-size-default">Layanan</h1>
                </div>
                <div class="elementor-element elementor-element-89b3de6 elementor-align-center elementor-widget elementor-widget-breadcrumbs" data-id="89b3de6" data-element_type="widget" data-e-type="widget" data-widget_type="breadcrumbs.default">
                    <p id="breadcrumbs"><span><span><a href="{{ url('/') }}">Home</a></span> » <span class="breadcrumb_last" aria-current="page">Layanan</span></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. GRID PRODUK & LAYANAN -->
    <section class="service-content">
        <div class="container">
            <div class="service-grid">
                
                @forelse($layanans as $layanan)
                <!-- Card -->
                <div class="service-card {{ request()->is('layanan/detail/'.$layanan->slug) ? 'active-card' : '' }}">
                    <div class="card-icon"><i class="{{ $layanan->icon }}"></i></div>
                    <h3 class="card-title">{{ $layanan->title }}</h3>
                    @if($layanan->badge)
                        <span class="card-badge">{{ $layanan->badge }}</span>
                    @endif
                    <p class="card-desc">{{ $layanan->short_description }}</p>
                    <div class="card-price-wrap">
                        <span class="price-label">{{ $layanan->price_label }}</span>
                        <div class="price-value-row">
                            <span class="price-value">{{ $layanan->price }}</span> <span class="price-period">{{ $layanan->price_period }}</span>
                        </div>
                    </div>
                    <a href="{{ url('/layanan/detail/'.$layanan->slug) }}" class="btn-detail"><i class="far fa-arrow-alt-circle-right"></i> Detail</a>
                </div>
                @empty
                <div class="col-span-3 text-center text-slate-500 py-10">Belum ada layanan tersedia.</div>
                @endforelse

            </div>
        </div>
    </section>


    <!-- CSS STYLING MURNI (Mirip Websekolah) -->
    <style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .text-center { text-align: center; }


        /* Grid Cards */
        .service-content {
            padding: 40px 0 80px;
        }
        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }
        .service-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 30px;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .service-card:hover {
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
            border-color: #20689b;
        }
        .card-icon {
            width: 45px;
            height: 45px;
            background-color: #20689b;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 10px;
            line-height: 1.4;
        }
        .card-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #20689b;
            font-size: 11px;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 50px;
            align-self: flex-start;
            margin-bottom: 20px;
        }
        .card-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 20px;
            flex-grow: 1;
        }
        .card-price-wrap {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
        }
        .price-label {
            font-size: 12px;
            color: #94a3b8;
            margin-bottom: 5px;
        }
        .price-value-row {
            display: flex;
            align-items: baseline;
            gap: 5px;
        }
        .price-value {
            font-size: 18px;
            font-weight: 800;
            color: #20689b;
        }
        .price-period {
            font-size: 12px;
            color: #94a3b8;
        }
        .btn-detail {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: white;
            color: #20689b;
            border: 1px solid #e2e8f0;
            padding: 10px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: 0.3s;
        }
        .service-card:hover .btn-detail {
            border-color: #cce0f5;
            background-color: #f8fafc;
        }


        /* Responsif Mobile & Tablet */
        @media (max-width: 1024px) {
            .service-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .page-title { font-size: 32px; }
            .service-grid { grid-template-columns: 1fr; }
            .service-card { padding: 20px; }
        }
    </style>
</x-layout>