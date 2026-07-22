@props(["mode" => "marquee"])

@php
    $mitras = \App\Models\Mitra::latest()->take(15)->get();
@endphp

<section class="happy-customer-section {{ $attributes->get("class") }}" style="{{ $attributes->get("style") }}">
    <div class="happy-customer-container mode-{{ $mode }}">
        <h2 class="happy-customer-title">Mitra</h2>
        
        @if($mode === "marquee")
        @php
            $isMarqueeActive = $mitras->count() >= 10;
        @endphp
        <div class="marquee-container {{ !$isMarqueeActive ? 'static-mode' : '' }}">
            <div class="{{ $isMarqueeActive ? 'marquee-track' : 'marquee-track-static' }}" style="{{ $isMarqueeActive ? 'animation-duration: 35s;' : '' }}">
                @foreach($mitras as $mitra)
                <a href="#" class="marquee-item"><img src="{{ asset($mitra->logo_path ?? 'assets/wp-content/uploads/2026/02/Icon-Nutrition.webp') }}" alt="{{ $mitra->name }}" loading="lazy"></a>
                @endforeach
                
                @if($isMarqueeActive)
                <!-- Duplicate for seamless loop -->
                @foreach($mitras as $mitra)
                <a href="#" class="marquee-item" aria-hidden="true"><img src="{{ asset($mitra->logo_path ?? 'assets/wp-content/uploads/2026/02/Icon-Nutrition.webp') }}" alt="{{ $mitra->name }}" loading="lazy"></a>
                @endforeach
                @endif
            </div>
        </div>
        @else
        <div class="mitra-grid">
            @foreach($mitras as $mitra)
            <div class="mitra-item"><img src="{{ asset($mitra->logo_path ?? 'assets/wp-content/uploads/2026/02/Icon-Nutrition.webp') }}" alt="{{ $mitra->name }}" loading="lazy"></div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<style>
/* Base Styles */
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
}
.happy-customer-container.mode-marquee {
    background-color: #F5F3FF;
}
.happy-customer-container.mode-grid {
    background-color: transparent;
}
.happy-customer-title {
    text-align: center;
    font-size: 2.5em;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 30px;
    font-family: "Plus Jakarta Sans", sans-serif;
}

/* Marquee Styles */
.marquee-container {
    width: calc(100% - 40px);
    overflow: hidden;
    position: relative;
    margin: 5px 20px;
    padding: 5px 0;
    display: flex;
}
.marquee-container.static-mode {
    overflow: visible;
}
.marquee-track {
    display: flex;
    width: max-content;
    animation: marquee-scroll linear infinite;
    gap: 10px;
}
.marquee-track-static {
    display: flex;
    width: 100%;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}
.marquee-item {
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.marquee-item img {
    height: 140px;
    max-width: 320px;
    object-fit: contain;
    border-radius: 5px;
    border: 1px solid rgba(0,0,0,0.08);
    background: #fff;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
@keyframes marquee-scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

/* Grid Styles */
.mitra-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    padding: 0 20px;
}
.mitra-item {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border: 1px solid #3B82F6;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    transition: transform 0.2s, box-shadow 0.2s;
    width: calc(12.5% - 15px);
    min-width: 90px;
    max-width: 140px;
}
.mitra-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.05);
}
.mitra-item img {
    max-width: 100%;
    max-height: 50px;
    object-fit: contain;
}

@media (max-width: 1024px) {
    .mitra-item { width: calc(16.66% - 15px); }
}
@media (max-width: 768px) {
    .happy-customer-section { margin-top: 0; }
    .happy-customer-container { padding: 30px 0; margin: 0 10px; border-radius: 15px; }
    .happy-customer-title { font-size: 2em; }
    .marquee-item img { height: 90px; max-width: 120px; }
    .mitra-item { width: calc(25% - 15px); }
}
@media (max-width: 480px) {
    .mitra-item { width: calc(33.33% - 15px); }
}
</style>
