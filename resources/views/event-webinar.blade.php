<x-layout title="Event & Webinar - Elcoding Academy">
@push('preload')
<link rel="preload" as="image" href="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80">
@endpush

@push('styles')
<link rel='stylesheet' id='elementor-post-11887-css' href='{{ asset("css/post-11887.css?v=3") }}' media='all' />
<style>

    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    
    /* Events Section */
    .events-section {
        padding: 60px 20px 100px 20px;
        background-color: #f8fafc;
    }
    .events-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Filters */
    .filter-bar {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        background: #ffffff;
        padding: 15px 30px;
        border-radius: 50px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-bottom: 50px;
        max-width: fit-content;
        margin-left: auto;
        margin-right: auto;
    }
    .filter-btn {
        background: transparent;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 14px;
        color: #4B5563;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .filter-btn:hover {
        color: #005a96;
    }
    .filter-btn.active {
        background: #005a96;
        color: #ffffff;
    }
    
    .filter-select {
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        color: #4B5563;
        outline: none;
        cursor: pointer;
        background-color: #f8fafc;
    }
    .filter-select:focus {
        border-color: #005a96;
    }

    /* Grid */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    /* Card */
    .program-card {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease;
        position: relative;
        background: #ffffff;
    }
    .program-card.card-theme-1 { background-color: #F4F7FE; }
    .program-card.card-theme-2 { background-color: #F4F7FE; }
    .program-card.card-theme-3 { background-color: #F4F7FE; }
    .program-card:hover { transform: translateY(-5px); }
    
    .program-card-header {
        background-size: cover;
        background-position: center;
        height: 180px;
        position: relative;
    }
    .program-badge {
            position: absolute;
            top: 15px; 
            left: 0;
            background: #8B5CF6;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 0 16px 16px 0;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
            z-index: 2;
            text-transform: uppercase;
        }
        .program-badge.badge-terlaris {
            background: #EF4444;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }
        .program-badge.badge-unggulan, .program-badge.badge-recommended {
            background: #10B981;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        .program-badge.badge-upcoming {
            background: #F59E0B;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
        }
        .program-badge.badge-special {
            background: #EC4899;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.4);
        }
    
    .program-badge.badge-handson { background: #3B82F6; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4); }
        .program-badge.badge-design { background: #6366F1; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4); }
        .program-badge.badge-crash { background: #14B8A6; box-shadow: 0 4px 15px rgba(20, 184, 166, 0.4); }
        
        .program-header-info {
        text-align: center;
        margin-bottom: 30px;
    }
    .program-title {
        font-size: 18px !important;
        font-weight: 700;
        color: #4B5563;
        margin: 0 0 8px 0;
        line-height: 1.4;
    }
    .start-from {
        font-size: 16px;
        font-weight: 600;
        display: block;
        margin-bottom: 5px;
    }
    .start-from.text-theme-1 { color: #D2A882; }
    .start-from.text-theme-2 { color: #132252; }
    .start-from.text-theme-3 { color: #1D667F; }
    
    .price-value {
        font-size: 32px !important;
        font-weight: 800;
        color: #1F2937;
        line-height: 1;
    }

    .program-card-body {
        flex-grow: 1;
        padding: 30px 20px 0 20px;
    }
    
    .program-card-footer {
        padding: 30px 10px 0 10px;
        display: flex;
        justify-content: center;
    }
    .program-btn {
        display: inline-block;
        text-align: center;
        font-weight: 600;
        font-size: 15px;
        padding: 12px 30px;
        border-radius: 30px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        margin-bottom: 30px;
    }
    .program-btn.btn-theme-1 { background: #D2A882; color: #ffffff !important; }
    .program-btn.btn-theme-1:hover { background: #b89270; transform: translateY(-2px); }
    .program-btn.btn-theme-2 { background: #132252; color: #ffffff !important; }
    .program-btn.btn-theme-2:hover { background: #0c1638; transform: translateY(-2px); }
    .program-btn.btn-theme-3 { background: #1D667F; color: #ffffff !important; }
    .program-btn.btn-theme-3:hover { background: #14495c; transform: translateY(-2px); }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .events-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .events-grid { grid-template-columns: 1fr; }
        .filter-bar { border-radius: 12px; padding: 10px; }
        .filter-btn { width: 100%; text-align: center; border-radius: 8px; }
    }
</style>
@endpush

<!-- Hero Section -->
<section class="ve-page-hero" style="background-image:url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80');">
    <div class="ve-page-hero-overlay"></div>
    <div class="container ve-page-hero-content">
        <span class="ve-section-tag">Elcoding Academy</span>
        <h1>Event & <span>Webinar</span></h1>
        <nav aria-label="breadcrumb">
            <ol class="ve-breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Event & Webinar</li>
            </ol>
        </nav>
    </div>
</section>

<?php
$events = [
    [
        'category' => 'bootcamp',
        'category_label' => 'Bootcamp Intensif',
        'date' => 'flexible',
        'badge_icon' => 'fas fa-star',
        'badge_text' => 'RECOMMENDED',
        'meta_text1' => '12 Minggu Pembelajaran',
        'meta_text2' => '19:30 WIB',
        'title' => 'AI & Machine Learning Essentials',
        'price_label' => 'TIKET MASUK',
        'price' => 'Gratis / Free',
        'price_strike' => '',
        'link' => url('/silabus?type=webinar'),
        'btn_text' => 'Daftar Webinar',
    ],
    [
        'category' => 'webinar',
        'category_label' => 'Webinar Tech',
        'date' => '2026-09',
        'badge_icon' => 'fas fa-cloud',
        'badge_text' => 'UPCOMING',
        'meta_text1' => '05 Sep 2026',
        'meta_text2' => '19:30 WIB',
        'title' => 'Modern Cloud & Microservices',
        'price_label' => 'TIKET MASUK',
        'price' => 'Gratis / Free',
        'price_strike' => '',
        'link' => url('/silabus?type=webinar'),
        'btn_text' => 'Daftar Webinar',
    ],
    [
        'category' => 'webinar',
        'category_label' => 'Webinar Tech',
        'date' => '2026-09',
        'badge_icon' => 'fas fa-shield-alt',
        'badge_text' => 'SPECIAL SESSION',
        'meta_text1' => '12 Sep 2026',
        'meta_text2' => '19:30 WIB',
        'title' => 'Cybersecurity Fundamentals',
        'price_label' => 'TIKET MASUK',
        'price' => 'Gratis / Free',
        'price_strike' => '',
        'link' => url('/silabus?type=webinar'),
        'btn_text' => 'Daftar Webinar',
    ],
    [
        'category' => 'workshop',
        'category_label' => 'Workshop Online',
        'date' => 'flexible',
        'badge_icon' => 'fas fa-tools',
        'badge_text' => 'HANDS-ON',
        'meta_text1' => '2 Hari Intensif',
        'meta_text2' => '',
        'title' => 'Web App Production-Ready dgn Next.js 15 & Prisma',
        'price_label' => 'INVESTASI',
        'price' => 'Rp 199.000',
        'price_strike' => 'Rp 500.000',
        'link' => url('/silabus?type=workshop'),
        'btn_text' => 'Daftar Workshop',
    ],
    [
        'category' => 'workshop',
        'category_label' => 'Workshop Online',
        'date' => 'flexible',
        'badge_icon' => 'fas fa-paint-brush',
        'badge_text' => 'DESIGN SPRINT',
        'meta_text1' => '1 Hari Full (Sabtu)',
        'meta_text2' => '',
        'title' => 'Membuat Scalable Design System di Figma',
        'price_label' => 'INVESTASI',
        'price' => 'Rp 149.000',
        'price_strike' => 'Rp 450.000',
        'link' => url('/silabus?type=workshop'),
        'btn_text' => 'Daftar Workshop',
    ],
    [
        'category' => 'workshop',
        'category_label' => 'Workshop Online',
        'date' => 'flexible',
        'badge_icon' => 'fas fa-rocket',
        'badge_text' => 'CRASH COURSE',
        'meta_text1' => '2 Hari (Sabtu-Minggu)',
        'meta_text2' => '',
        'title' => 'Automasi Deployment App Menggunakan Docker',
        'price_label' => 'INVESTASI',
        'price' => 'Rp 249.000',
        'price_strike' => 'Rp 550.000',
        'link' => url('/silabus?type=workshop'),
        'btn_text' => 'Daftar Workshop',
    ],
];
?>
<section class="events-section">
    <div class="events-container">
        
        <!-- Filters -->
        <div class="filter-bar" id="dynamicFilterBar">
            <button class="filter-btn active" data-filter="all">Semua Kategori</button>
            <!-- Button kategori lainnya akan dibuat secara otomatis oleh Javascript -->
            
            <div style="margin-left: 10px; padding-left: 10px; border-left: 2px solid #e2e8f0; display: flex; align-items: center;">
                <select id="dateFilter" class="filter-select">
                    <option value="all">Semua Waktu</option>
                    <option value="2026-08">Agustus 2026</option>
                    <option value="2026-09">September 2026</option>
                    <option value="flexible">Waktu Fleksibel</option>
                </select>
            </div>
        </div>

        <!-- Grid -->
        <div class="events-grid" id="eventsGrid">

            @foreach($events as $event)
            @php
                $themes = ['theme-1', 'theme-2', 'theme-3'];
                $theme = $themes[$loop->index % 3];
                $bgClass = 'card-' . $theme;
                $btnClass = 'btn-' . $theme;
                $textClass = 'text-' . $theme;
            @endphp
            <div class="program-card {{ $bgClass }} event-card" data-category="{{ $event['category'] }}" data-category-label="{{ $event['category_label'] }}" data-date="{{ $event['date'] }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}">
                <div class="program-card-header" style="background-image: url('{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}');">
                    @php
                            $badgeText = strtolower(trim($event['badge_text']));
                            $badgeClass = 'badge-special'; // Default color
                            $badgeIcon = 'fa-star'; // Default icon
                            
                            // Status Badges
                            if (str_contains($badgeText, 'terlaris') || str_contains($badgeText, 'populer')) { $badgeClass = 'badge-terlaris'; $badgeIcon = 'fa-fire'; }
                            elseif (str_contains($badgeText, 'unggulan') || str_contains($badgeText, 'recommended') || str_contains($badgeText, 'rekomendasi')) { $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-thumbs-up'; }
                            elseif (str_contains($badgeText, 'upcoming') || str_contains($badgeText, 'baru')) { $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-clock'; }
                            elseif (str_contains($badgeText, 'special') || str_contains($badgeText, 'promo') || str_contains($badgeText, 'diskon')) { $badgeClass = 'badge-special'; $badgeIcon = 'fa-gem'; }
                            
                            // Category Badges (Layanan & Programs)
                            elseif (str_contains($badgeText, 'website') || str_contains($badgeText, 'web')) { $badgeClass = 'badge-handson'; $badgeIcon = 'fa-globe'; }
                            elseif (str_contains($badgeText, 'hosting') || str_contains($badgeText, 'server')) { $badgeClass = 'badge-design'; $badgeIcon = 'fa-server'; }
                            elseif (str_contains($badgeText, 'perpustakaan') || str_contains($badgeText, 'digital')) { $badgeClass = 'badge-crash'; $badgeIcon = 'fa-book-reader'; }
                            elseif (str_contains($badgeText, 'aplikasi') || str_contains($badgeText, 'app')) { $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-mobile-alt'; }
                            elseif (str_contains($badgeText, 'sistem') || str_contains($badgeText, 'informasi')) { $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-cogs'; }
                            
                            // Fallbacks for specific course types
                            elseif (str_contains($badgeText, 'hands-on') || str_contains($badgeText, 'praktek')) { $badgeClass = 'badge-handson'; $badgeIcon = 'fa-laptop-code'; }
                            elseif (str_contains($badgeText, 'design') || str_contains($badgeText, 'desain')) { $badgeClass = 'badge-design'; $badgeIcon = 'fa-paint-brush'; }
                            elseif (str_contains($badgeText, 'crash') || str_contains($badgeText, 'kilat')) { $badgeClass = 'badge-crash'; $badgeIcon = 'fa-rocket'; }
                        @endphp
                        @if($event['badge_text'])
                        <div class="program-badge {{ $badgeClass }}"><i class="fas {{ $badgeIcon }}"></i> {{ $event['badge_text'] }}</div>
                        @endif
                </div>
                <div class="program-card-body">
                    <div class="program-header-info">
                        <h2 class="program-title">{!! nl2br(e($event['title'])) !!}</h2>
                        <span class="start-from {{ $textClass }}">{{ $event['price_label'] }}</span>
                        <div class="price-value">{{ $event['price'] }} 
                            @if($event['price_strike'])
                            <span style="font-size: 14px; font-weight: normal; text-decoration: line-through; color: #9ca3af;">{{ $event['price_strike'] }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="program-features-content">
                        <p style="color: #4B5563; font-size: 14px; line-height: 1.6; margin-top: 15px; text-align: center;">
                            <i class="far fa-calendar-alt"></i> {{ $event['meta_text1'] }}
                            @if($event['meta_text2'])
                            <br><span style="font-size: 12px; margin-top: 5px; display: block;">{{ $event['meta_text2'] }}</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="program-card-footer">
                    <a href="{{ $event['link'] }}" class="program-btn {{ $btnClass }}">{{ $event['btn_text'] }}</a>
                </div>
            </div>
            @endforeach
</div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBar = document.getElementById('dynamicFilterBar');
    const eventCards = document.querySelectorAll('.event-card');
    
    // 1. Ekstrak kategori unik dari class card
    const categories = new Map();
    eventCards.forEach(card => {
        const cat = card.getAttribute('data-category');
        let label = card.getAttribute('data-category-label');
        
        if (cat && !categories.has(cat)) {
            // Jika tidak ada data-category-label, buat default label yang rapi (Title Case)
            if (!label) {
                label = cat.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
            }
            categories.set(cat, label);
        }
    });

    // 2. Buat tombol filter secara dinamis
    categories.forEach((label, cat) => {
        const btn = document.createElement('button');
        btn.className = 'filter-btn';
        btn.setAttribute('data-filter', cat);
        btn.textContent = label;
        filterBar.appendChild(btn);
    });

    // 3. Setup event listener untuk tombol filter kategori
    const filterBtns = document.querySelectorAll('.filter-btn');
    const dateFilter = document.getElementById('dateFilter');
    
    function filterEvents() {
        const activeCategory = document.querySelector('.filter-btn.active').getAttribute('data-filter');
        const activeDate = dateFilter.value;

        eventCards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            const cardDate = card.getAttribute('data-date');
            
            const matchCategory = (activeCategory === 'all' || cardCat === activeCategory);
            const matchDate = (activeDate === 'all' || cardDate === activeDate);
            
            if (matchCategory && matchDate) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            filterEvents();
        });
    });
    
    dateFilter.addEventListener('change', filterEvents);
});
</script>
@endpush

</x-layout>
