<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // Kantor Utama
            ['key' => 'contact_address', 'value' => 'CitraLand Tegal blok Belleza Plaza Lt.2, Kraton, Kota Tegal, Jawa Tengah (Gedung Training Center)'],
            ['key' => 'contact_phone', 'value' => '+62 814-7665-2656'],
            ['key' => 'contact_email', 'value' => 'info@elcodingacademy.com'],

            //Kantor Bekasi
            ['key' => 'contact_address_bekasi', 'value' => 'Jl. Alternatif Cibubur Ruko Kranggan Blok Rt16/27, Jatisampurna, Kota Bekasi, Jawa Barat'],
            ['key' => 'contact_phone_bekasi', 'value' => '+62 877 6233 4232'],
            ['key' => 'contact_email_bekasi', 'value' => 'info@elcodingacademy.com'],

            ['key' => 'contact_map_iframe', 'value' => 'https://maps.google.com/maps?q=Azzahra%20Computer%20Tegal&t=&z=17&ie=UTF8&iwloc=&output=embed'],
            ['key' => 'social_facebook', 'value' => '#'],
            ['key' => 'social_instagram', 'value' => 'https://www.instagram.com/elcoding.id?igsh=c2pndTFlYW5laXk0&utm_source=qr'],
            ['key' => 'social_youtube', 'value' => '#'],
            ['key' => 'contact_whatsapp_chat', 'value' => '+6281476652656'] // Just the number for API link
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
