<x-layout title="Event & Webinar - Elcoding Academy">
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

    /* Grid */
    .events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    /* Card */
    .event-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #f1f5f9;
    }
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    /* Card Header & Image */
    .event-img-wrapper {
        position: relative;
        padding: 15px;
        background-color: #f8fafc; /* Fallback */
        border-radius: 12px 12px 0 0;
    }
    .event-img-wrapper.bg-blue { background-color: #f0f7ff; }
    .event-img-wrapper.bg-red { background-color: #fff5f5; }
    .event-img-wrapper.bg-orange { background-color: #fff9f0; }

    .event-img {
        width: 100%;
        border-radius: 8px;
        display: block;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .event-badge {
        position: absolute;
        top: 25px;
        left: 25px;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(4px);
    }
    .badge-recommended {
        background: rgba(139, 92, 246, 0.2);
        color: #7c3aed;
        border: 1px solid rgba(139, 92, 246, 0.3);
    }
    .badge-terlaris {
        background: rgba(239, 68, 68, 0.2);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    .badge-upcoming {
        background: rgba(245, 158, 11, 0.2);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    /* Card Body */
    .event-body {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .event-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 12px;
        font-weight: 600;
    }
    .event-meta i {
        margin-right: 6px;
    }
    .event-meta .date {
        color: #005a96;
    }

    .event-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 20px 0;
        line-height: 1.4;
    }

    .event-price-section {
        margin-top: auto;
        margin-bottom: 20px;
    }
    .event-price-label {
        font-size: 12px;
        text-transform: uppercase;
        color: #9ca3af;
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 4px;
        display: block;
    }
    .event-price {
        font-size: 20px;
        font-weight: 800;
        color: #1f2937;
        display: flex;
        align-items: baseline;
        gap: 8px;
    }
    .event-price-strike {
        font-size: 14px;
        color: #9ca3af;
        text-decoration: line-through;
        font-weight: 600;
    }
    .event-price-free {
        background: #f3f4f6;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 14px;
        color: #374151;
        font-weight: 700;
        display: inline-block;
    }

    /* Card Footer (Button) */
    .event-footer {
        padding: 0 24px 24px 24px;
    }
    .btn-event {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .btn-primary {
        background: #005a96;
        color: #ffffff !important;
    }
    .btn-primary:hover {
        background: #004370;
    }
    .btn-outline {
        background: transparent;
        color: #1f2937 !important;
        border: 1px solid #d1d5db;
    }
    .btn-outline:hover {
        border-color: #9ca3af;
        background: #f9fafb;
    }
    
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
<div class="elementor elementor-11887">
    <div class="elementor-element elementor-element-691d17c hide-hero-if e-flex e-con-boxed e-con e-parent" data-id="691d17c" data-element_type="container" data-e-type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
        <div class="e-con-inner">
            <div class="elementor-element elementor-element-0b653e6 elementor-widget elementor-widget-heading" data-id="0b653e6" data-element_type="widget" data-e-type="widget" data-widget_type="heading.default">
                <h1 class="elementor-heading-title elementor-size-default">Event & Webinar</h1>
            </div>
            <div class="elementor-element elementor-element-89b3de6 elementor-align-center elementor-widget elementor-widget-breadcrumbs" data-id="89b3de6" data-element_type="widget" data-e-type="widget" data-widget_type="breadcrumbs.default">
                <p id="breadcrumbs"><span><span><a href="{{ url('/') }}">Home</a></span> » <span class="breadcrumb_last" aria-current="page">Event & Webinar</span></span></p>
            </div>
        </div>
    </div>
</div>

<section class="events-section">
    <div class="events-container">
        
        <!-- Filters -->
        <div class="filter-bar" id="dynamicFilterBar">
            <button class="filter-btn active" data-filter="all">Semua Event</button>
            <!-- Button kategori lainnya akan dibuat secara otomatis oleh Javascript -->
        </div>

        <!-- Grid -->
        <div class="events-grid" id="eventsGrid">
            
            <!-- Bootcamp 1 -->
            <div class="event-card" data-category="bootcamp" data-category-label="Bootcamp Intensif">
                <div class="event-img-wrapper bg-blue">
                    <div class="event-badge badge-recommended"><i class="fas fa-star"></i> RECOMMENDED</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="Bootcamp" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 12 Minggu Pembelajaran</span>
                    </div>
                    <h2 class="event-title">Bootcamp Intensif Full Stack Web Dev</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">INVESTASI</span>
                        <div class="event-price">
                            Rp 2.500.000 <span class="event-price-strike">Rp 5.600.000</span>
                        </div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=fullstack') }}" class="btn-event btn-primary">Daftar Bootcamp <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Bootcamp 2 -->
            <div class="event-card" data-category="bootcamp" data-category-label="Bootcamp Intensif">
                <div class="event-img-wrapper bg-red">
                    <div class="event-badge badge-terlaris"><i class="fas fa-fire"></i> TERLARIS</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="Flutter" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 10 Minggu Pembelajaran</span>
                    </div>
                    <h2 class="event-title">Mobile App Development - Flutter</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">INVESTASI</span>
                        <div class="event-price">
                            Rp 2.250.000 <span class="event-price-strike">Rp 4.500.000</span>
                        </div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=fullstack') }}" class="btn-event btn-primary">Daftar Bootcamp <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Bootcamp 3 -->
            <div class="event-card" data-category="bootcamp" data-category-label="Bootcamp Intensif">
                <div class="event-img-wrapper bg-orange">
                    <div class="event-badge badge-upcoming"><i class="fas fa-bolt"></i> UPCOMING</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="UI/UX" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 8 Minggu Pembelajaran</span>
                    </div>
                    <h2 class="event-title">UI/UX Design & Product Strategy</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">INVESTASI</span>
                        <div class="event-price">
                            Rp 1.900.000 <span class="event-price-strike">Rp 3.800.000</span>
                        </div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=ui-ux') }}" class="btn-event btn-primary">Daftar Bootcamp <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Webinar 1 -->
            <div class="event-card" data-category="webinar" data-category-label="Webinar Tech">
                <div class="event-img-wrapper bg-blue">
                    <div class="event-badge badge-upcoming"><i class="fas fa-video"></i> LIVE WEBINAR</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="AI" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 28 Aug 2026</span>
                        <span class="date">19:30 WIB</span>
                    </div>
                    <h2 class="event-title">AI & Machine Learning Essentials</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">TIKET MASUK</span>
                        <div class="event-price-free">Gratis / Free</div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=webinar') }}" class="btn-event btn-primary">Daftar Webinar <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Webinar 2 -->
            <div class="event-card" data-category="webinar" data-category-label="Webinar Tech">
                <div class="event-img-wrapper bg-red">
                    <div class="event-badge badge-upcoming"><i class="fas fa-cloud"></i> UPCOMING</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="Cloud" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 05 Sep 2026</span>
                        <span class="date">19:30 WIB</span>
                    </div>
                    <h2 class="event-title">Modern Cloud & Microservices</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">TIKET MASUK</span>
                        <div class="event-price-free">Gratis / Free</div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=webinar') }}" class="btn-event btn-primary">Daftar Webinar <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Webinar 3 -->
            <div class="event-card" data-category="webinar" data-category-label="Webinar Tech">
                <div class="event-img-wrapper bg-orange">
                    <div class="event-badge badge-recommended"><i class="fas fa-shield-alt"></i> SPECIAL SESSION</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="Security" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 12 Sep 2026</span>
                        <span class="date">19:30 WIB</span>
                    </div>
                    <h2 class="event-title">Cybersecurity Fundamentals</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">TIKET MASUK</span>
                        <div class="event-price-free">Gratis / Free</div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=webinar') }}" class="btn-event btn-primary">Daftar Webinar <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Workshop 1 -->
            <div class="event-card" data-category="workshop" data-category-label="Workshop Online">
                <div class="event-img-wrapper bg-blue">
                    <div class="event-badge badge-terlaris"><i class="fas fa-tools"></i> HANDS-ON</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="Next.js" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 2 Hari Intensif</span>
                    </div>
                    <h2 class="event-title">Web App Production-Ready dgn Next.js 15 & Prisma</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">INVESTASI</span>
                        <div class="event-price">
                            Rp 199.000 <span class="event-price-strike">Rp 500.000</span>
                        </div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=workshop') }}" class="btn-event btn-primary">Daftar Workshop <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Workshop 2 -->
            <div class="event-card" data-category="workshop" data-category-label="Workshop Online">
                <div class="event-img-wrapper bg-red">
                    <div class="event-badge badge-recommended"><i class="fas fa-paint-brush"></i> DESIGN SPRINT</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="Figma" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 1 Hari Full (Sabtu)</span>
                    </div>
                    <h2 class="event-title">Membuat Scalable Design System di Figma</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">INVESTASI</span>
                        <div class="event-price">
                            Rp 149.000 <span class="event-price-strike">Rp 450.000</span>
                        </div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=workshop') }}" class="btn-event btn-primary">Daftar Workshop <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <!-- Workshop 3 -->
            <div class="event-card" data-category="workshop" data-category-label="Workshop Online">
                <div class="event-img-wrapper bg-orange">
                    <div class="event-badge badge-upcoming"><i class="fas fa-rocket"></i> CRASH COURSE</div>
                    <img src="{{ asset('gambar/aset/ilustrasi-belajar.jpg') }}" alt="DevOps" class="event-img" style="aspect-ratio: 16/9; object-fit: cover;">
                </div>
                <div class="event-body">
                    <div class="event-meta">
                        <span><i class="far fa-calendar-alt"></i> 2 Hari (Sabtu-Minggu)</span>
                    </div>
                    <h2 class="event-title">Automasi Deployment App Menggunakan Docker</h2>
                    <div class="event-price-section">
                        <span class="event-price-label">INVESTASI</span>
                        <div class="event-price">
                            Rp 249.000 <span class="event-price-strike">Rp 550.000</span>
                        </div>
                    </div>
                </div>
                <div class="event-footer">
                    <a href="{{ url('/silabus?type=workshop') }}" class="btn-event btn-primary">Daftar Workshop <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
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

    // 3. Setup event listener untuk tombol filter
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Hapus kelas active dari semua tombol
            filterBtns.forEach(b => b.classList.remove('active'));
            // Tambahkan kelas active ke tombol yang diklik
            btn.classList.add('active');

            const filterValue = btn.getAttribute('data-filter');

            eventCards.forEach(card => {
                if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush

</x-layout>
