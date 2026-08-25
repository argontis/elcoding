<x-layout>
    <x-slot:title>Portfolio Details - {{ $portofolio->title }}</x-slot>

    <style>
        body { background-color: #ffffff; }
        
        .breadcrumbs {
            padding: 20px 0;
            background-color: #f6f9fd;
            min-height: 40px;
            margin-top: 0px; /* Removed offset to stick to navbar */
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .breadcrumbs .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .breadcrumbs h2 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            color: #111;
        }
        
        .breadcrumbs ol {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 14px;
        }
        
        .breadcrumbs ol li + li {
            padding-left: 10px;
        }
        
        .breadcrumbs ol li + li::before {
            display: inline-block;
            padding-right: 10px;
            color: #6c757d;
            content: "/";
        }
        
        .breadcrumbs ol li a {
            color: #4B6BF5;
            text-decoration: none;
            transition: 0.3s;
        }
        
        .breadcrumbs ol li a:hover {
            color: #1a202c;
        }

        .portfolio-details {
            padding: 60px 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .portfolio-details .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .portfolio-details-layout {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        
        .portfolio-details-slider {
            flex: 0 0 calc(66.666% - 15px);
            max-width: calc(66.666% - 15px);
        }
        
        .portfolio-details-slider img {
            width: 100%;
            height: auto;
            border-radius: 4px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            display: block;
        }
        
        .portfolio-details-content {
            flex: 0 0 calc(33.333% - 15px);
            max-width: calc(33.333% - 15px);
        }
        
        .portfolio-info {
            padding: 30px;
            box-shadow: 0px 0 30px rgba(0, 0, 0, 0.08);
            background: #fff;
            border-radius: 4px;
        }
        
        .portfolio-info h3 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            color: #111;
        }
        
        .portfolio-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
            font-size: 15px;
            color: #444;
        }
        
        .portfolio-info ul li + li {
            margin-top: 15px;
        }
        
        .portfolio-info ul li strong {
            color: #111;
            display: inline-block;
            width: 120px;
            font-weight: 600;
        }
        
        .portfolio-info ul a {
            color: #4B6BF5;
            text-decoration: none;
        }
        
        .portfolio-info ul a:hover {
            color: #111;
        }
        
        .portfolio-description {
            padding-top: 30px;
        }
        
        .portfolio-description h2 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #111;
        }
        
        .portfolio-description p {
            padding: 0;
            color: #555;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        @media (max-width: 992px) {
            .portfolio-details-slider, .portfolio-details-content {
                flex: 0 0 100%;
                max-width: 100%;
            }
            .breadcrumbs .container {
                flex-direction: column-reverse;
                align-items: flex-start;
                gap: 10px;
            }
            .breadcrumbs h2 {
                margin-bottom: 5px;
            }
        }
    </style>

    <main id="main">
        <!-- Breadcrumbs Section -->
        <section class="breadcrumbs">
            <div class="container">
                <h2>Portfolio Details</h2>
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Portfolio Details</li>
                </ol>
            </div>
        </section>

        <!-- Portfolio Details Section -->
        <section id="portfolio-details" class="portfolio-details">
            <div class="container">
                <div class="portfolio-details-layout">
                    
                    <div class="portfolio-details-slider">
                        <img src="{{ asset($portofolio->image_path ?? 'gambar/portofolio/Film-Islami-Kemenag.webp') }}" alt="{{ $portofolio->title }}">
                    </div>

                    <div class="portfolio-details-content">
                        <div class="portfolio-info">
                            <h3>Project information</h3>
                            <ul>
                                <li><strong>Category</strong>: {{ $portofolio->category }}</li>
                                <li><strong>Client</strong>: {{ $portofolio->client ?? 'Elcoding Team' }}</li>
                                <li><strong>Project date</strong>: {{ $portofolio->date ? \Carbon\Carbon::parse($portofolio->date)->format('d F, Y') : $portofolio->created_at->format('d F, Y') }}</li>
                                @if($portofolio->url)
                                <li><strong>Project URL</strong>: <a href="{{ $portofolio->url }}" target="_blank">View Project</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="portfolio-description">
                            <h2>{{ $portofolio->title }}</h2>
                            @if($portofolio->content)
                                {!! $portofolio->content !!}
                            @else
                                <p>Deskripsi detail untuk portofolio ini belum tersedia. Proyek ini mencerminkan komitmen Elcoding Academy dalam memberikan solusi pengembangan terbaik.</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
</x-layout>
