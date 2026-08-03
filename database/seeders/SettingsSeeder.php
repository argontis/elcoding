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
            ['key' => 'contact_address', 'value' => 'Ruko Citraland, Tegal, Jawa Tengah, Indonesia 52111'],
            ['key' => 'contact_phone', 'value' => '+62 814-7665-2656'],
            ['key' => 'contact_email', 'value' => 'info@elcodingacademy.com'],
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
