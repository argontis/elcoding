<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mitra;
use App\Models\ProgramKursus;
use App\Models\Portofolio;
use App\Models\Artikel;
use App\Models\Setting;

use App\Models\KategoriPortofolio;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Mitra::create(['name' => 'Partner Logo 1 (1)', 'logo_path' => 'gambar/mitra/Partner_Logo_1__1_.svg']);
        Mitra::create(['name' => 'Partner Logo 1 (2)', 'logo_path' => 'gambar/mitra/Partner_Logo_1__2_.svg']);
        Mitra::create(['name' => 'Partner Logo 1', 'logo_path' => 'gambar/mitra/Partner_Logo_1.svg']);
        Mitra::create(['name' => 'Partner Logo 2 (1)', 'logo_path' => 'gambar/mitra/Partner_Logo_2__1_.svg']);
        Mitra::create(['name' => 'Partner Logo 2', 'logo_path' => 'gambar/mitra/Partner_Logo_2.svg']);
        Mitra::create(['name' => 'Partner Logo 3 (1)', 'logo_path' => 'gambar/mitra/Partner_Logo_3__1_.svg']);
        Mitra::create(['name' => 'Partner Logo 3', 'logo_path' => 'gambar/mitra/Partner_Logo_3.png']);
        Mitra::create(['name' => 'Partner Logo 3', 'logo_path' => 'gambar/mitra/Partner_Logo_3.svg']);
        Mitra::create(['name' => 'Partner Logo 4 (1)', 'logo_path' => 'gambar/mitra/Partner_Logo_4__1_.svg']);
        Mitra::create(['name' => 'Partner Logo 4 (2)', 'logo_path' => 'gambar/mitra/Partner_Logo_4__2_.svg']);
        Mitra::create(['name' => 'Partner Logo 4', 'logo_path' => 'gambar/mitra/Partner_Logo_4.svg']);
        Mitra::create(['name' => 'Partner Logo 5 (1)', 'logo_path' => 'gambar/mitra/Partner_Logo_5__1_.svg']);
        Mitra::create(['name' => 'Partner Logo 5', 'logo_path' => 'gambar/mitra/Partner_Logo_5.svg']);

        KategoriPortofolio::firstOrCreate(['name' => 'Coding'], ['color' => 'blue']);
        KategoriPortofolio::firstOrCreate(['name' => 'Desain Grafis'], ['color' => 'purple']);
        KategoriPortofolio::firstOrCreate(['name' => 'B. Inggris & Mandarin'], ['color' => 'amber']);

        ProgramKursus::create(['title' => 'Bootcamp Intensif Full Stack Web Dev', 'duration' => '4 Bulan', 'price' => 'Rp2.500.000', 'badge' => 'Recommended']);
        ProgramKursus::create(['title' => 'Mastering Skill UI/UX Design', 'duration' => '3 Bulan', 'price' => 'Rp1.800.000', 'badge' => 'Terlaris']);
        ProgramKursus::create(['title' => 'Professional Class Digital Marketing', 'duration' => '2 Bulan', 'price' => 'Rp1.500.000', 'badge' => 'Reguler']);

        Portofolio::create(['title' => 'Film Islami Kemenag', 'category' => 'Coding', 'image_path' => 'gambar/portofolio/Film-Islami-Kemenag.webp', 'content' => 'Proyek pembuatan website untuk Kemenag dengan fitur streaming film islami.']);
        Portofolio::create(['title' => 'TOSTEM Prima Cipta', 'category' => 'Desain Grafis', 'image_path' => 'gambar/portofolio/Tostem-Prima-Cipta.webp', 'content' => 'Pembuatan desain profil perusahaan dan materi promosi untuk TOSTEM Prima Cipta.']);
        Portofolio::create(['title' => 'Tutur Bangsa', 'category' => 'B. Inggris & Mandarin', 'image_path' => 'gambar/portofolio/Tutur-Bangsa.webp', 'content' => 'Sistem e-learning interaktif untuk pembelajaran bahasa.']);

        Artikel::create(['title' => 'Mengapa Belajar Pemrograman Adalah Investasi Terbaik untuk Masa Depan Anda', 'author' => 'Admin Elcoding', 'category' => 'Teknologi', 'status' => 'Published', 'published_at' => '2026-06-24', 'content' => "Di era digital yang berkembang dengan sangat pesat, kemampuan pemrograman atau coding telah berubah dari sekadar keahlian teknis khusus menjadi salah satu keterampilan dasar yang paling dicari oleh berbagai industri di seluruh dunia.\n\nBanyak orang mengira bahwa coding hanya diperuntukkan bagi mereka yang ingin menjadi software engineer atau IT support. Faktanya, pemahaman dasar tentang cara kerja perangkat lunak dan logika pemrograman dapat memberikan keuntungan kompetitif yang besar di hampir setiap bidang karier."]);
        Artikel::create(['title' => '5 Tips Memilih Bootcamp Web Developer yang Tepat', 'author' => 'Admin Elcoding', 'category' => 'Edukasi', 'status' => 'Published', 'published_at' => '2026-06-20', 'content' => "Memilih bootcamp yang tepat adalah langkah penting. Pastikan Anda mempertimbangkan:\n1. Kurikulum yang up to date\n2. Mentor yang berpengalaman\n3. Fokus pada praktik (project-based)\n4. Dukungan penyaluran kerja\n5. Fasilitas yang memadai"]);
        Artikel::create(['title' => 'Mengenal Perbedaan UI dan UX Design untuk Pemula', 'author' => 'Tim Kreatif', 'category' => 'Desain', 'status' => 'Draft', 'published_at' => '2026-06-18', 'content' => "User Interface (UI) dan User Experience (UX) adalah dua hal yang berbeda. UI fokus pada tampilan antarmuka (warna, tombol, tipografi), sedangkan UX berfokus pada kemudahan dan pengalaman pengguna saat menggunakan aplikasi. Keduanya harus berjalan beriringan untuk menciptakan produk digital yang sukses."]);

        $defaultSettings = [
            ['key' => 'contact_address', 'value' => 'Ruko Citraland, Tegal, Jawa Tengah, Indonesia 52111'],
            ['key' => 'contact_phone', 'value' => '+62 814-7665-2656'],
            ['key' => 'contact_whatsapp_chat', 'value' => '6281476652656'],
            ['key' => 'contact_email', 'value' => 'info@elcodingacademy.com'],
            ['key' => 'social_facebook', 'value' => '#'],
            ['key' => 'social_instagram', 'value' => '#'],
            ['key' => 'social_youtube', 'value' => '#'],
            ['key' => 'contact_map_iframe', 'value' => 'https://maps.google.com/maps?q=Azzahra%20Computer%20Tegal&t=&z=17&ie=UTF8&iwloc=&output=embed']
        ];
        
        foreach ($defaultSettings as $setting) {
            Setting::create($setting);
        }
    }
}
