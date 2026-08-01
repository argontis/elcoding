@props(["theme" => "default"])

@php
    $mitras = \App\Models\Mitra::latest()->take(15)->get();
@endphp

<!-- Memanggil CSS Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="happy-customer-section {{ $attributes->get('class') }}" style="{{ $attributes->get('style') }}">
    <div class="happy-customer-container theme-{{ $theme }}">
        <h2 class="happy-customer-title">Mitra</h2>
        
        <div class="swiper-container-wrapper">
            <div class="swiper mitraSwiper">
                <div class="swiper-wrapper">
                    @foreach($mitras as $mitra)
                    <div class="swiper-slide">
                        <div class="mitra-item">
                            <img src="{{ asset($mitra->logo_path ?? 'assets/wp-content/uploads/2026/02/Icon-Nutrition.webp') }}" alt="{{ $mitra->name }}" loading="lazy">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script Inisialisasi Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper(".mitraSwiper", {
            loop: true,
            speed: 4000, // Kecepatan konstan
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
            },
            // PENGATURAN RESPONSIF SUPER DETAIL (PER LAYER)
            breakpoints: {
                // Layar HP Kecil (Portrait)
                0: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                // Layar HP Besar / Landscape
                480: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                // Layar Tablet
                768: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                // Layar Laptop Normal
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 25,
                },
                // Layar Monitor Besar / PC
                1280: {
                    slidesPerView: 6,
                    spaceBetween: 30,
                }
            }
        });
    });
</script>

<style>
/* --- Gaya Dasar Bagian Mitra --- */
.happy-customer-section {
    padding: 0 0 60px 0;
    margin-top: var(--mitra-margin-top, -80px);
    position: relative;
    z-index: 10;
}
.happy-customer-container {
    border-radius: 20px;
    padding: 40px 0;
    max-width: 1300px;
    margin-left: auto;
    margin-right: auto;
    transition: all 0.3s ease; /* Transisi halus saat ukuran layar berubah */
}
.happy-customer-container.theme-default {
    background-color: #F5F3FF;
}
.happy-customer-container.theme-transparent {
    background-color: transparent;
}
.happy-customer-title {
    text-align: center;
    font-size: 2.5em;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 30px;
    font-family: "Plus Jakarta Sans", sans-serif;
    transition: font-size 0.3s ease;
}

/* --- Area Slider --- */
.swiper-container-wrapper {
    position: relative;
    width: 100%;
    margin: 0 auto;
    padding: 0 20px; 
}

/* Efek Marquee Linear */
.mitraSwiper .swiper-wrapper {
    transition-timing-function: linear !important;
}

/* --- Desain Kotak Logo --- */
.mitra-item {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    width: 100%;
    aspect-ratio: 4 / 3;
    pointer-events: none;
}
.theme-default .mitra-item { background: #fff; border: none; }
.theme-transparent .mitra-item { background: transparent; border: 2px solid #6D28D9; }
.mitra-item img {
    width: 90%;
    height: 90%;
    object-fit: contain;
}

/* --- CSS MEDIA QUERIES (RESPONSIF PER LAYER) --- */

/* 1. Layar Monitor Sangat Besar (Ultrawide) */
@media (min-width: 1440px) {
    .happy-customer-title { font-size: 2.8em; }
    .swiper-container-wrapper { padding: 0 40px; }
}

/* 2. Layar Laptop / Tablet Landscape */
@media (max-width: 1024px) {
    .happy-customer-section { margin-top: -40px; }
    .happy-customer-title { font-size: 2.2em; margin-bottom: 25px; }
    .happy-customer-container { padding: 35px 0; }
}

/* 3. Layar Tablet Portrait */
@media (max-width: 768px) {
    .happy-customer-section { margin-top: 0; padding-bottom: 40px; }
    .happy-customer-container { padding: 30px 0; margin: 0 15px; border-radius: 15px; }
    .happy-customer-title { font-size: 1.8em; margin-bottom: 20px; }
    .swiper-container-wrapper { padding: 0 15px; }
}

/* 4. Layar HP Besar (Phablet) */
@media (max-width: 576px) {
    .happy-customer-container { margin: 0 10px; padding: 25px 0; }
    .happy-customer-title { font-size: 1.6em; }
    .mitra-item { padding: 8px; border-radius: 6px; }
}

/* 5. Layar HP Kecil */
@media (max-width: 375px) {
    .happy-customer-title { font-size: 1.4em; margin-bottom: 15px; }
    .swiper-container-wrapper { padding: 0 10px; }
    .mitra-item { padding: 6px; aspect-ratio: 1 / 1; /* Ubah ke kotak simetris di HP kecil agar logo tidak terlalu kecil */ }
}
</style>