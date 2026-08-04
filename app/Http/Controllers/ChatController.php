<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session; // Tambahkan library Session

class ChatController extends Controller
{
    public function askGemini(Request $request)
    {
        // 1. Cek batasan maksimal 10 chat per user
        $chatCount = Session::get('chat_count', 0);
        
        if ($chatCount >= 10) {
            return response()->json([
                'answer' => 'Mohon maaf Kak, sesi percakapan ini telah mencapai batas maksimal (10 pesan). Silakan hubungi admin kami melalui WhatsApp untuk bantuan lebih lanjut.'
            ]);
        }

        // Tambah hitungan pesan user di sesi ini
        Session::put('chat_count', $chatCount + 1);

        // 2. Ambil pesan user dan API Key
        $userMessage = $request->input('message');
        $apiKey = env('GEMINI_API_KEY');

        // 3. Masukkan Aturan/Instruksi (System Prompt)
        $systemInstruction = "Aturan menjawab:
        1. Gaya Bahasa & Nada: Gunakan bahasa Indonesia yang baku, sopan, dan sesuai EYD. Hindari bahasa gaul atau singkatan. 
        2. Sapaan & Panggilan: Gunakan sapaan sopan seperti 'Kak'. 
        3. Penutup Percakapan: Tawarkan bantuan lebih lanjut di akhir jawaban (contoh: 'Ada informasi lain yang bisa saya bantu, Kak?').
        4. Format Teks: Jawablah dengan teks biasa (plain text). DILARANG KERAS menggunakan format markdown seperti tanda bintang (**).
        5. Informasi Harga: Jika ditanya biaya, gunakan kalimat bernilai: 'Untuk investasi bootcamp di Elcoding, biayanya dimulai dari Rp 1.500.000.'
        6. Penanganan Keluhan: Jika ada keluhan, awali dengan permohonan maaf dan empati (contoh: 'Mohon maaf atas ketidaknyamanan yang Kakak alami.').
        7. Keringkasan: Berikan jawaban yang to-the-point dan tidak bertele-tele.

        PENTING - BATASAN TOPIK (JAWAB SINGKAT): 
        Jika pengguna menanyakan hal di luar topik kursus atau layanan Elcoding (misal: cuaca, politik, atau topik umum lainnya), kamu WAJIB menolaknya dengan SANGAT SINGKAT dan sopan, maksimal 2 kalimat. 
        Contoh jawaban wajib: 'Mohon maaf Kak, saya hanya dapat membantu pertanyaan seputar layanan kursus Elcoding. Ada yang bisa saya bantu terkait program kami?' 
        JANGAN berikan penjelasan panjang lebar atau alasan lain.";

        // 4. Kirim request ke Google Gemini API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=' . $apiKey, [
            'system_instruction' => [
                'parts' => [['text' => $systemInstruction]]
            ],
            'contents' => [
                [
                    'role' => 'user', 
                    'parts' => [['text' => $userMessage]]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.4, // Diturunkan sedikit agar jawabannya lebih konsisten dan baku
            ]
        ]);

        // 5. Tangkap dan kirim balasan
        if ($response->successful()) {
            $geminiAnswer = $response->json()['candidates'][0]['content']['parts'][0]['text'];
            return response()->json(['answer' => $geminiAnswer]);
        }

        // Pesan error jika API gagal
        return response()->json([
            'answer' => 'Mohon maaf Kak, sistem kami sedang mengalami sedikit kendala. Silakan coba beberapa saat lagi atau hubungi admin.'
        ], 500);
    }
}