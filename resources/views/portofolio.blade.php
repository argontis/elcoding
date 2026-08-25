<x-layout title="Portofolio - Elcoding Academy">

@push('styles')
    <link rel='stylesheet' id='elementor-post-10899-css' href='{{ asset("css/post-10899.css?v=3") }}' media='all' />
    <link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset("css/post-11887.css?v=3") }}' media='all' />
    <style>
        .custom-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin: 40px 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .custom-pagination .page-numbers {
            font-size: 16px;
            font-weight: 500;
            color: #4B5563;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .custom-pagination .page-numbers:hover {
            color: #4B6BF5;
        }
        .custom-pagination .page-numbers.current {
            color: #4B6BF5;
        }
        .custom-pagination .dots {
            color: #4B5563;
        }
        .custom-pagination .elementor-screen-only {
            display: none;
        }
    </style>
    @endpush
    <!-- Hero Section -->
    <section class="ve-page-hero" style="background-image:url('{{ asset('gambar/aset/Untitled-1.png') }}');">
        <div class="ve-page-hero-overlay"></div>
        <div class="container ve-page-hero-content">
            <span class="ve-section-tag">Elcoding Academy</span>
            <h1>Portofolio <span>Kami</span></h1>
            <nav aria-label="breadcrumb">
                <ol class="ve-breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Portofolio</li>
                </ol>
            </nav>
        </div>
    </section>

    @if(isset($portofolios) && $portofolios->count() > 0)
    <section class="presento-portfolio-section" id="Portofolio">
        @php
            $portfolioCategories = $portofolios->pluck('category')->unique();
        @endphp
        
        <ul class="presento-portfolio-filter">
            <li class="filter-active" data-filter="all">All</li>
            @foreach($portfolioCategories as $cat)
                @if($cat)
                    <li data-filter="{{ Str::slug($cat) }}">{{ $cat }}</li>
                @endif
            @endforeach
        </ul>

        <div class="presento-portfolio-grid">
            @foreach($portofolios as $portofolio)
            <div class="presento-portfolio-item" data-category="{{ Str::slug($portofolio->category) }}">
                <img src="{{ asset($portofolio->image_path ?? 'assets/wp-content/uploads/2026/02/Garap-Edu.webp') }}" alt="{{ $portofolio->title }}" loading="lazy">
                
                <div class="portfolio-links">
                    <a href="{{ url('/portofolio/' . $portofolio->id) }}" title="More Details"><i class="fas fa-link"></i></a>
                    @if($portofolio->url)
                        <a href="{{ $portofolio->url }}" target="_blank" rel="noopener noreferrer" title="Web"><i class="fas fa-external-link-alt"></i></a>
                    @endif
                </div>
                
                <div class="portfolio-info-overlay">
                    <h4>{{ $portofolio->title }}</h4>
                    <p>{{ $portofolio->category }}</p>
                </div>
            </div>
            @endforeach
        </div>

        @if($portofolios->hasPages())
        <nav class="elementor-pagination custom-pagination" aria-label="Pagination">
            {{ $portofolios->links() }}
        </nav>
        @endif
    </section>

    <style>
    .presento-portfolio-section { padding: 40px 0 80px; background: #fff; font-family: 'Plus Jakarta Sans', sans-serif; }
    
    .presento-portfolio-filter { list-style: none; padding: 0; margin: 0 auto 40px auto; text-align: center; }
    .presento-portfolio-filter li { cursor: pointer; display: inline-block; padding: 10px 15px; font-size: 15px; font-weight: 600; color: #444; transition: all 0.3s ease; text-transform: capitalize; margin: 0 5px; }
    .presento-portfolio-filter li:hover, .presento-portfolio-filter li.filter-active { color: #4B6BF5; }

    .presento-portfolio-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; padding: 0 20px; }
    .presento-portfolio-item { position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); transition: opacity 0.3s ease; }
    .presento-portfolio-item img { width: 100%; height: 100%; object-fit: cover; aspect-ratio: 4/3; transition: all 0.3s ease; display: block; }

    .presento-portfolio-item .portfolio-info-overlay { opacity: 0; position: absolute; bottom: -20px; left: 0; right: 0; text-align: center; z-index: 3; transition: all 0.3s ease; padding: 15px; background: rgba(255,255,255,0.95); }
    .presento-portfolio-item:hover .portfolio-info-overlay { opacity: 1; bottom: 0; }
    .presento-portfolio-item .portfolio-info-overlay h4 { font-size: 18px; color: #111; font-weight: 700; margin-bottom: 5px; }
    .presento-portfolio-item .portfolio-info-overlay p { color: #4B6BF5; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase; }

    .presento-portfolio-item .portfolio-links { opacity: 0; position: absolute; top: 50%; left: 0; right: 0; text-align: center; z-index: 3; transition: all 0.3s ease; transform: translateY(-50%); }
    .presento-portfolio-item:hover .portfolio-links { opacity: 1; }
    .presento-portfolio-item .portfolio-links a { color: #fff; background: #4B6BF5; display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; margin: 0 4px; font-size: 16px; transition: 0.3s; text-decoration: none; }
    .presento-portfolio-item .portfolio-links a:hover { background: #1a202c; }
    
    .presento-portfolio-item:hover img { transform: scale(1.1); }
    .presento-portfolio-item::before { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0.4); opacity: 0; transition: all 0.3s ease; z-index: 2; pointer-events: none; }
    .presento-portfolio-item:hover::before { opacity: 1; }

    @media (max-width: 992px) { .presento-portfolio-grid { grid-template-columns: repeat(2, 1fr); gap: 20px; } }
    @media (max-width: 768px) { .presento-portfolio-grid { grid-template-columns: 1fr; gap: 20px; } }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('.presento-portfolio-filter li');
        const items = document.querySelectorAll('.presento-portfolio-item');

        filters.forEach(filter => {
            filter.addEventListener('click', function() {
                filters.forEach(f => f.classList.remove('filter-active'));
                this.classList.add('filter-active');

                const filterValue = this.getAttribute('data-filter');

                items.forEach(item => {
                    if(filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        setTimeout(() => item.style.opacity = '1', 50);
                    } else {
                        item.style.opacity = '0';
                        setTimeout(() => item.style.display = 'none', 300);
                    }
                });
            });
        });
    });
    </script>
    @endif

</x-layout>