<x-layout title="Tentang Kami - Elcoding Academy">
@push('preload')
<link rel="preload" as="image" href="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80">
@endpush

@push('styles')
<style>
/* Custom VaultEdge Styles for About Page */
body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }

/* Custom Grid */
.ve-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.ve-about-row { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center; }
.ve-about-col { width: 100%; }

/* ABOUT SPLIT */
.ve-about-section { padding: 100px 0; background: #fff; }
.ve-about-img-stack { position: relative; min-height: 520px; }
.ve-about-img-1 { position: absolute; top: 30px; left: 30px; width: 75%; height: 85%; border-radius: 12px; background-size: cover; background-position: center; box-shadow: 0 10px 30px rgba(0,0,0,0.1); z-index: 1; }
.ve-about-img-2 { position: absolute; bottom: 0; right: 0; width: 55%; height: 50%; border-radius: 12px; background-size: cover; background-position: center; box-shadow: 0 15px 40px rgba(0,0,0,0.15); border: 10px solid #fff; z-index: 2; }
.ve-about-ribbon { position: absolute; top: 0; left: 0; background: #4B6BF5; color: #fff; padding: 25px 30px; border-radius: 8px; z-index: 3; box-shadow: 0 10px 20px rgba(75, 107, 245, 0.3); text-align: center; }
.ve-about-ribbon strong { display: block; font-size: 32px; font-weight: 900; line-height: 1; margin-bottom: 5px; }
.ve-about-ribbon span { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

.ve-about-text { padding-left: 20px; }
.ve-about-text h2 { font-size: 40px; font-weight: 800; color: #1a202c; margin: 15px 0 25px; line-height: 1.2; }
.ve-about-text h2 span { color: #4B6BF5; }
.ve-lead { font-size: 16px; font-weight: 600; color: #4a5568; margin-bottom: 20px; line-height: 1.6; }
.ve-about-text p { font-size: 15px; color: #718096; margin-bottom: 30px; line-height: 1.7; }
.ve-section-tag-gold { display: inline-block; background: rgba(75, 107, 245, 0.08); color: #4B6BF5; border: 1px solid rgba(75, 107, 245, 0.2); border-radius: 50px; padding: 6px 16px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; }

.ve-about-features { margin-bottom: 40px; display: flex; flex-direction: column; gap: 12px; }
.ve-af-item { display: flex; align-items: center; font-size: 15px; font-weight: 600; color: #2d3748; }
.ve-af-item i { color: #4B6BF5; font-size: 14px; margin-right: 12px; }

.ve-btn-gold { display: inline-block; background: #4B6BF5; color: #fff !important; font-weight: 700; padding: 14px 30px; border-radius: 6px; text-decoration: none; font-size: 15px; transition: 0.3s; }
.ve-btn-gold:hover { background: #355EFC; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(75, 107, 245, 0.4); }

/* COUNTER SECTION */
.ve-counter-section { padding: 80px 0; background: #162133; color: #fff; }
.ve-counter-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; text-align: center; }
.ve-counter-item i { font-size: 36px; color: #4B6BF5; margin-bottom: 20px; display: block; }
.ve-counter-item strong { font-size: 42px; font-weight: 800; color: #fff; }
.ve-counter-item span { font-size: 24px; font-weight: 700; color: #4B6BF5; margin-left: 2px; }
.ve-counter-item p { font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; color: #a0aec0; margin-top: 10px; margin-bottom: 0; }

/* MVV SECTION */
.ve-mvv-section { padding: 80px 0; background: #162133; color: #fff; }
.ve-section-header { margin-bottom: 50px; text-align: center; }
.ve-section-header h2 { font-size: 40px; font-weight: 800; color: #1F2937; margin: 15px 0; }
.ve-mvv-section .ve-section-header h2 { color: #fff; }
.ve-section-header h2 span { color: #4B6BF5; }
.ve-section-header p { font-size: 16px; color: #6B7280; max-width: 600px; margin: 0 auto; }
.ve-mvv-section .ve-section-header p { color: #a0aec0; }
.ve-section-tag-dark { display: inline-block; background: transparent; color: #4B6BF5; border: 1px solid #4B6BF5; border-radius: 50px; padding: 6px 16px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 14px; }

.ve-mvv-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
.ve-mvv-card { background: #1f2d42; padding: 40px 30px; border-radius: 12px; transition: transform 0.3s ease; text-align: center; }
.ve-mvv-card:hover { transform: translateY(-5px); box-shadow: 0 15px 40px rgba(0,0,0,0.2); }
.ve-mvv-icon { width: 60px; height: 60px; margin: 0 auto 25px; background: #4B6BF5; color: #fff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; }
.ve-mvv-card h4 { font-size: 20px; font-weight: 800; color: #fff; margin-bottom: 15px; }
.ve-mvv-card p { font-size: 14px; color: #a0aec0; line-height: 1.7; margin: 0; }

/* CLIENTS/MITRA */
.clients-section { padding: 80px 0; background: #fff; border-top: 1px solid #f1f5f9; }
.clients-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.clients-grid { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 30px; }
.client-logo { flex: 0 0 calc(20% - 30px); display: flex; justify-content: center; align-items: center; padding: 10px; height: 120px; }
.client-logo img { width: 100%; height: 100%; max-height: 100px; object-fit: contain; transition: transform 0.3s ease; }
.client-logo img:hover { transform: scale(1.15); }

@media (max-width: 992px) {
    .ve-about-row { grid-template-columns: 1fr; }
    .ve-about-img-stack { min-height: 400px; margin-bottom: 50px; }
    .ve-about-text { padding-left: 0; }
    .ve-mvv-grid { grid-template-columns: repeat(2, 1fr); }
    .ve-counter-grid { grid-template-columns: repeat(2, 1fr); gap: 40px; }
    .client-logo { flex: 0 0 calc(33.333% - 30px); }
}
@media (max-width: 768px) {
    .ve-mvv-grid { grid-template-columns: 1fr; }
    .ve-counter-grid { grid-template-columns: 1fr; gap: 40px; }
    .client-logo { flex: 0 0 calc(50% - 30px); height: 100px; }
    .client-logo img { max-height: 80px; }
    .ve-about-img-stack { min-height: 350px; }
    .ve-about-img-1 { width: 90%; }
    .ve-about-img-2 { width: 70%; }
}
</style>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

<!-- Hero Section -->
<section class="ve-page-hero" style="background-image:url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80');">
    <div class="ve-page-hero-overlay"></div>
    <div class="container ve-page-hero-content">
        <span class="ve-section-tag">Elcoding Academy</span>
        <h1>Tentang <span>Kami</span></h1>
        <nav aria-label="breadcrumb">
            <ol class="ve-breadcrumb">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</section>

<!-- ABOUT SPLIT -->
<section class="ve-about-section">
    <div class="ve-container">
        <div class="ve-about-row">
            <div class="ve-about-col" data-aos="fade-right">
                <div class="ve-about-img-stack">
                    <div class="ve-about-img-1" style="background-image:url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="ve-about-img-2" style="background-image:url('https://images.unsplash.com/photo-1461749280684-dccba630e2f6?auto=format&fit=crop&w=800&q=80');"></div>
                    <div class="ve-about-ribbon"><strong>2+</strong><span>Tahun Berdiri</span></div>
                </div>
            </div>
            <div class="ve-about-col" data-aos="fade-left">
                <div class="ve-about-text">
                    <span class="ve-section-tag-gold">Who We Are</span>
                    <h2>Learn and Code with <span>Integrity</span></h2>
                    <p class="ve-lead">Elcoding adalah lembaga kursus dan pelatihan IT profesional yang didedikasikan untuk menjembatani talenta muda dengan industri digital masa depan.</p>
                    <p>Berdiri di Tegal sejak tahun 2022, Elcoding memulai misinya dengan sederhana: membuat pelatihan keahlian teknologi dapat diakses oleh semua kalangan. Saat ini, kami telah membantu ratusan siswa bertransformasi menjadi tenaga ahli.</p>
                    
                    <div class="ve-about-features">
                        <div class="ve-af-item"><i class="fas fa-check"></i><span>Mentor Praktisi Profesional di Industri</span></div>
                        <div class="ve-af-item"><i class="fas fa-check"></i><span>Kurikulum Fokus Praktik (80%)</span></div>
                        <div class="ve-af-item"><i class="fas fa-check"></i><span>Project Based Learning Terarah</span></div>
                        <div class="ve-af-item"><i class="fas fa-check"></i><span>Fasilitas Bimbingan Karir & Portofolio</span></div>
                    </div>
                    
                    <a href="/program-kursus" class="ve-btn-gold mt-3">View Our Programs</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MISSION / VISION / VALUES -->
<section class="ve-mvv-section">
    <div class="ve-container">
        <div class="ve-section-header text-center" data-aos="fade-up">
            <span class="ve-section-tag-dark">Fondasi Kami</span>
            <h2>Visi, Misi &amp; <span>Goals</span></h2>
        </div>
        <div class="ve-mvv-grid">
            <div class="ve-mvv-card" data-aos="fade-up" data-aos-delay="100">
                <div class="ve-mvv-icon"><i class="fas fa-eye"></i></div>
                <h4>Visi</h4>
                <p>Menjadi pusat pelatihan IT dan pengembangan skill digital terdepan yang menghasilkan SDM unggul, kompeten, dan siap kerja di era digital.</p>
            </div>
            <div class="ve-mvv-card" data-aos="fade-up" data-aos-delay="250">
                <div class="ve-mvv-icon"><i class="fas fa-bullseye"></i></div>
                <h4>Misi</h4>
                <p>Menyediakan program pembelajaran berbasis praktik nyata dan magang untuk membekali talenta muda dengan keterampilan kerja, serta menghadirkan solusi IT.</p>
            </div>
            <div class="ve-mvv-card" data-aos="fade-up" data-aos-delay="400">
                <div class="ve-mvv-icon"><i class="fas fa-flag-checkered"></i></div>
                <h4>Goals</h4>
                <p>Mencetak lulusan mumpuni dengan portofolio nyata, dan menjadi mitra strategis bagi individu atau bisnis untuk transformasi digital.</p>
            </div>
        </div>
    </div>
</section>

<!-- TEAM MENTORS & INSTRUCTORS SECTION -->
<section class="ve-mentors-section" style="padding: 90px 0; background: #f8fafc;">
    <div class="ve-container">
        <!-- Section Header -->
        <div class="ve-section-header text-center" data-aos="fade-up">
            <span class="ve-section-tag-gold">Pengajar Profesional</span>
            <h2>Belajar Langsung dari <span>Praktisi Industri</span></h2>
            <p>Mentor kami adalah praktisi aktif di perusahaan teknologi ternama yang siap membimbing Anda step-by-step.</p>
        </div>

        <!-- Mentors Grid (Centered, No Card) -->
        <div style="display: flex; justify-content: center; max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            @php
            $mentors = [
                [
                    'name' => 'Zaky Afrizal, S.Kom',
                    'role' => 'Lead Web Development',
                    'company' => 'Elcoding Academy',
                    'image' => asset('gambar/aset/mentor-zaky.png'),
                    'skills' => ['Laravel', 'React.js', 'Tailwind CSS', 'Digital Marketing'],
                    'linkedin' => 'https://linkedin.com',
                    'github' => 'https://github.com/zakyafrz2605',
                    'portfolio' => 'https://github.com/zakyafrz2605'
                ]
            ];
            @endphp

            @foreach($mentors as $index => $mentor)
            <div style="text-align: center; max-width: 900px; width: 100%;" data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                
                <!-- Image Container -->
                <div style="position: relative; display: flex; justify-content: center; margin-bottom: 40px;">
                    <img src="{{ $mentor['image'] }}" alt="{{ $mentor['name'] }}" style="width: 100%; max-width: 650px; height: auto; object-fit: contain; object-position: bottom;">
                </div>

                <!-- Mentor Name & Role -->
                <h3 style="font-size: 32px; font-weight: 800; color: #1a202c; margin: 0 0 12px;">{{ $mentor['name'] }}</h3>
                
                <div style="font-size: 16px; font-weight: 600; color: #4B6BF5; display: flex; justify-content: center; align-items: center; gap: 8px; margin-bottom: 25px;">
                    <i class="fas fa-briefcase"></i>
                    <span>{{ $mentor['role'] }} {{ !empty($mentor['company']) ? '· ' . $mentor['company'] : '' }}</span>
                </div>

                <!-- Tech Stack Pills -->
                @if(!empty($mentor['skills']) && is_array($mentor['skills']))
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; margin-bottom: 35px;">
                    @foreach($mentor['skills'] as $skill)
                    <span style="background: #f1f5f9; color: #4a5568; font-size: 14px; font-weight: 600; padding: 8px 18px; border-radius: 8px;">
                        {{ $skill }}
                    </span>
                    @endforeach
                </div>
                @endif

                <!-- Interactive Footer -->
                <div style="border-top: 1px solid #e2e8f0; padding-top: 30px; display: flex; flex-direction: column; align-items: center; gap: 20px;">
                    <div style="display: flex; gap: 20px; justify-content: center;">
                        @if(!empty($mentor['linkedin']))
                        <a href="{{ $mentor['linkedin'] }}" target="_blank" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 20px; background: #f1f5f9; color: #4a5568; border-radius: 50%; text-decoration: none; transition: 0.3s;" onmouseover="this.style.background='#0A66C2'; this.style.color='#fff';" onmouseout="this.style.background='#f1f5f9'; this.style.color='#4a5568';">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        @endif
                        @if(!empty($mentor['github']))
                        <a href="{{ $mentor['github'] }}" target="_blank" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 20px; background: #f1f5f9; color: #4a5568; border-radius: 50%; text-decoration: none; transition: 0.3s;" onmouseover="this.style.background='#1a202c'; this.style.color='#fff';" onmouseout="this.style.background='#f1f5f9'; this.style.color='#4a5568';">
                            <i class="fab fa-github"></i>
                        </a>
                        @endif
                        @if(!empty($mentor['portfolio']))
                        <a href="{{ $mentor['portfolio'] }}" target="_blank" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; font-size: 20px; background: #f1f5f9; color: #4a5568; border-radius: 50%; text-decoration: none; transition: 0.3s;" onmouseover="this.style.background='#4B6BF5'; this.style.color='#fff';" onmouseout="this.style.background='#f1f5f9'; this.style.color='#4a5568';">
                            <i class="fas fa-globe"></i>
                        </a>
                        @endif
                    </div>

                    <a href="{{ $mentor['portfolio'] ?? '#' }}" target="_blank" style="color: #4B6BF5; font-weight: bold; font-size: 16px; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        Lihat Profil Lengkap <i class="fas fa-arrow-right" style="font-size: 14px;"></i>
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- MITRA / CLIENTS -->
<section class="clients-section">
    <div class="ve-container">
        <div class="ve-section-header text-center" data-aos="fade-up">
            <span class="ve-section-tag">Kepercayaan</span>
            <h2>Mitra &amp; <span>Klien</span> Kami</h2>
        </div>
        <div class="clients-container" data-aos="fade-up" data-aos-delay="100">
            <div class="clients-grid">
                @php $mitras = \App\Models\Mitra::latest()->get(); @endphp
                @foreach($mitras as $mitra)
                <div class="client-logo">
                    <img src="{{ asset($mitra->logo_path ?? 'assets/wp-content/uploads/2026/02/Icon-Nutrition.webp') }}" alt="{{ $mitra->name }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- COUNTER SECTION -->
<section class="ve-counter-section">
    <div class="ve-container">
        <div class="ve-counter-grid">
            <div class="ve-counter-item" data-aos="fade-up" data-aos-delay="100">
                <i class="fas fa-users"></i>
                <strong class="counter">500</strong><span>+</span>
                <p>Happy Students</p>
            </div>
            <div class="ve-counter-item" data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-laptop-code"></i>
                <strong class="counter">120</strong><span>+</span>
                <p>Real Projects Built</p>
            </div>
            <div class="ve-counter-item" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-chalkboard-teacher"></i>
                <strong class="counter">15</strong><span>+</span>
                <p>Expert Mentors</p>
            </div>
            <div class="ve-counter-item" data-aos="fade-up" data-aos-delay="400">
                <i class="fas fa-building"></i>
                <strong class="counter">30</strong><span>+</span>
                <p>Hiring Partners</p>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });
    });
</script>
@endpush
</x-layout>