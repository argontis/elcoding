<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CrmDashboardController extends Controller
{
    /**
     * Helper to get common user data and session info
     */
    private function getUserData()
    {
        $user = auth()->user();
        return [
            'name' => $user->name ?? 'Dimas Pratama',
            'username' => $user->username ?? 'crmlead',
            'email' => $user->email ?? 'crmlead@elcoding.id',
            'role' => 'Super Admin • Enterprise CRM',
            'avatar_initials' => 'DP',
        ];
    }

    /**
     * 1. Dashboard Utama Penjualan (Executive Cockpit) - Page 16 PDF
     */
    public function dashboard(Request $request)
    {
        $currentUser = $this->getUserData();

        $metrics = [
            'total_leads' => '1,482',
            'total_leads_trend' => '+12.4% vs. bulan lalu',
            'lead_baru' => '328',
            'lead_baru_trend' => '+18.2%',
            'lead_baru_target' => 'Target: 275 lead',
            'qualified_leads' => '142',
            'qualified_ratio' => 'Rasio 43.2% MQL ke SQL konversi tinggi',
            'pipeline_terbuka' => 'Rp 8,75 M',
            'pipeline_deals' => '58 deals aktif',
            'avg_deal' => 'Avg Deal: Rp 150,8 Juta',
            'revenue_won' => 'Rp 3,24 M',
            'revenue_target_pct' => '81% Target',
            'revenue_target' => 'Target: Rp 4,00 Miliar',
            'win_rate' => '28.6%',
            'win_rate_trend' => '+3.1%',
            'benchmark' => 'Benchmark B2B: 22.0%',
        ];

        $forecastChart = [
            ['month' => 'Mei', 'pct' => '93.3%', 'value' => 3.73, 'quota' => 4.0, 'is_active' => false],
            ['month' => 'Jun', 'pct' => '96.8%', 'value' => 3.87, 'quota' => 4.0, 'is_active' => false],
            ['month' => 'Jul', 'pct' => '105.8%', 'value' => 4.23, 'quota' => 4.0, 'is_active' => false],
            ['month' => 'Agu', 'pct' => '82.8%', 'value' => 3.31, 'quota' => 4.0, 'is_active' => false],
            ['month' => 'Sep', 'pct' => '102.7%', 'value' => 4.11, 'quota' => 4.0, 'is_active' => false],
            ['month' => 'Okt (Aktif)', 'pct' => 'Est. 103.7%', 'value' => 4.15, 'quota' => 4.0, 'is_active' => true],
        ];

        $prioritasTindakan = [
            [
                'badge' => 'OVERDUE 1 HARI',
                'badge_type' => 'danger',
                'tag' => 'Urgent Action',
                'title' => 'Kirim Revisi Kontrak Kerja Sama',
                'deal' => 'Bank Nusa Mandiri (Rp 640 Juta)',
                'pic' => 'Siti Rahma (AE)',
                'action_label' => 'Kirim Sekarang',
                'action_type' => 'danger',
            ],
            [
                'badge' => 'HARI INI • 14:00 WIB',
                'badge_type' => 'primary',
                'tag' => 'Skor AI: 94/100',
                'title' => 'Follow-up Pasca Demo Eksekutif',
                'deal' => 'PT Solusi Finansial Prima (Rp 920 Juta)',
                'pic' => 'Budi Santoso',
                'action_label' => 'Mulai Panggilan',
                'action_type' => 'primary',
            ],
            [
                'badge' => 'AI SMART NUDGE',
                'badge_type' => 'purple',
                'tag' => 'Inaktif 5 Hari',
                'title' => 'Rekomendasi Call Penyelamatan Deal',
                'deal' => 'PT Retail Logistik Jaya (Rp 380 Juta)',
                'insight' => 'Kompetitor sedang mendekati buyer. Segera jadwalkan meeting penyelarasan harga diskon Q4.',
                'pic' => 'Maya Indah',
                'action_label' => 'Buat Draf WhatsApp',
                'action_type' => 'success',
            ],
        ];

        $pipelineStages = [
            ['step' => '1. Lead Masuk', 'deals' => '18 Deals', 'val' => 'Rp 1,20 M', 'sub' => 'Konversi ke Kualifikasi: 68%', 'color' => '#6366f1'],
            ['step' => '2. Kualifikasi B2B', 'deals' => '14 Deals', 'val' => 'Rp 2,10 M', 'sub' => 'Avg. SLA Kualifikasi: 1.8 Hari', 'color' => '#4f46e5'],
            ['step' => '3. Demo Solusi', 'deals' => '9 Deals', 'val' => 'Rp 1,80 M', 'sub' => 'Tingkat Kepuasan Demo: 92%', 'color' => '#8b5cf6'],
            ['step' => '4. Proposal & RFP', 'deals' => '10 Deals', 'val' => 'Rp 2,40 M', 'sub' => '8 Proposal terkirim minggu ini', 'color' => '#7c3aed'],
            ['step' => '5. Negosiasi Legal', 'deals' => '7 Deals', 'val' => 'Rp 1,25 M', 'sub' => 'Win Prob. Rata-rata: 78%', 'color' => '#06b6d4'],
            ['step' => 'Closed Won', 'deals' => '24 Deals', 'val' => 'Rp 3,24 M', 'sub' => 'YTD Total: Rp 28,4 Miliar', 'color' => '#10b981'],
        ];

        $leaderboard = [
            ['rank' => '#1', 'name' => 'Budi Santoso', 'role' => 'Enterprise Lead', 'deals' => '8 Deals Won', 'val' => 'Rp 980 Juta', 'pct' => '132%', 'avatar' => 'BS', 'badge_color' => '#10b981'],
            ['rank' => '#2', 'name' => 'Siti Rahma', 'role' => 'Senior AE', 'deals' => '6 Deals Won', 'val' => 'Rp 810 Juta', 'pct' => '114%', 'avatar' => 'SR', 'badge_color' => '#3b82f6'],
            ['rank' => '#3', 'name' => 'Rian Kusuma', 'role' => 'SMB & Mid-Market', 'deals' => '7 Deals', 'val' => 'Rp 650 Juta', 'pct' => '94%', 'avatar' => 'RK', 'badge_color' => '#f59e0b'],
            ['rank' => '#4', 'name' => 'Dewi Safitri', 'role' => 'Pre-sales & Solution', 'deals' => '3 Deal', 'val' => 'Rp 480 Juta', 'pct' => '88%', 'avatar' => 'DS', 'badge_color' => '#8b5cf6'],
        ];

        $aktivitas = [
            [
                'type' => 'Panggilan Penjualan',
                'title' => 'Klarifikasi Lisensi & Add-on User',
                'time' => '10:42 WIB',
                'client' => 'PT Pertamina Retail Distribusi',
                'pic' => 'Rian Kusuma (Senior AE)',
                'detail' => 'Durasi 18m 24s • AI Transkrip Siap',
                'badge' => 'call',
            ],
            [
                'type' => 'Demo Produk Enterprise',
                'title' => 'Modul Otomasi WhatsApp Gateway',
                'time' => '09:15 WIB',
                'client' => 'PT Astra Agro Lestari Tbk',
                'pic' => 'Dewi Safitri (Pre-sales Specialist)',
                'detail' => 'Feedback: Sangat Tertarik • Deal Size: Rp 450 Juta',
                'badge' => 'demo',
            ],
            [
                'type' => 'Pengiriman Proposal Final',
                'title' => 'Draf SLA Dukungan 24/7',
                'time' => '08:30 WIB',
                'client' => 'Bank Syariah Indonesia (Divisi Kemitraan)',
                'pic' => 'Budi Santoso (Enterprise AE)',
                'detail' => 'Revisi v3.1 • Nilai: Rp 820 Juta',
                'badge' => 'doc',
            ],
            [
                'type' => 'Meeting Tatap Muka',
                'title' => 'Penandatanganan MoU Implementasi Tahap 1',
                'time' => 'Kemarin, 16:45 WIB',
                'client' => 'PT Kalbe Farma Tbk',
                'pic' => 'Agus Wicaksono (Director)',
                'detail' => 'Lokasi: Gedung Cempaka Putih',
                'badge' => 'meet',
            ],
        ];

        return view('crm.dashboard', compact(
            'currentUser',
            'metrics',
            'forecastChart',
            'prioritasTindakan',
            'pipelineStages',
            'leaderboard',
            'aktivitas'
        ));
    }

    /**
     * 2. Pengelolaan Calon Pelanggan (Leads) - Page 10 PDF
     */
    public function leads(Request $request)
    {
        $currentUser = $this->getUserData();

        $leads = [
            [
                'id' => 1,
                'name' => 'Anindya Rahmawati',
                'title' => 'Chief Commercial Officer',
                'initials' => 'AR',
                'color' => '#4c52f8',
                'company' => 'PT Artha Graha Makmur',
                'industry' => 'Fintech & Banking',
                'email' => 'anindya@arthagrahamakmur.co.id',
                'phone' => '+62 812-9231-002',
                'source' => 'Form Website',
                'score' => 94,
                'level' => 'Tinggi',
                'level_type' => 'high',
                'selected' => true,
            ],
            [
                'id' => 2,
                'name' => 'Bambang Hartono',
                'title' => 'VP Supply Chain',
                'initials' => 'BH',
                'color' => '#8b5cf6',
                'company' => 'PT Nusantara Logistik Prima',
                'industry' => 'Logistics & FMCG',
                'email' => 'bambang.h@nusantaralog.id',
                'phone' => '+62 811-9231-002',
                'source' => 'LinkedIn Campaign',
                'score' => 88,
                'level' => 'Tinggi',
                'level_type' => 'high',
                'selected' => true,
            ],
            [
                'id' => 3,
                'name' => 'Faisal Kusuma',
                'title' => 'Managing Director',
                'initials' => 'FK',
                'color' => '#059669',
                'company' => 'CV Solusi Manufaktur Jaya',
                'industry' => 'Heavy Industry & MRO',
                'email' => 'faisal@solusimanufaktur.com',
                'phone' => '+62 813-7721-9988',
                'source' => 'Event B2B Summit',
                'score' => 82,
                'level' => 'Tinggi',
                'level_type' => 'high',
                'selected' => true,
            ],
            [
                'id' => 4,
                'name' => 'Dewi Anggraini',
                'title' => 'Head of Procurement',
                'initials' => 'DA',
                'color' => '#d97706',
                'company' => 'PT Agro Makmur Sentosa',
                'industry' => 'Agribusiness',
                'email' => 'dewi.a@agromakmur.com',
                'phone' => '+62 821-4455-8810',
                'source' => 'Google Ads B2B',
                'score' => 78,
                'level' => 'Sedang',
                'level_type' => 'medium',
                'selected' => false,
            ],
            [
                'id' => 5,
                'name' => 'Taufik Nugroho',
                'title' => 'Chief Technology Officer',
                'initials' => 'TN',
                'color' => '#dc2626',
                'company' => 'PT Garda Medika Nusantara',
                'industry' => 'Healthtech & Hospitals',
                'email' => 'taufik@gardamedika.id',
                'phone' => '+62 815-6670-3341',
                'source' => 'Form Website',
                'score' => 91,
                'level' => 'Tinggi',
                'level_type' => 'high',
                'selected' => false,
            ],
            [
                'id' => 6,
                'name' => 'Rian Erlangga',
                'title' => 'Sales Director',
                'initials' => 'RE',
                'color' => '#64748b',
                'company' => 'PT Kencana Distribusi Indonesia',
                'industry' => 'Retail & Distribution',
                'email' => 'rian@kencanadist.co.id',
                'phone' => '+62 856-1120-7799',
                'source' => 'Referral Client',
                'score' => 42,
                'level' => 'Rendah',
                'level_type' => 'low',
                'selected' => false,
            ],
        ];

        return view('crm.leads', compact('currentUser', 'leads'));
    }

    /**
     * 3. Sales Pipeline Penjualan (Kanban Board) - Page 15 PDF
     */
    public function pipeline(Request $request)
    {
        $currentUser = $this->getUserData();

        $columns = [
            [
                'id' => 'lead_baru',
                'title' => '1. Lead Baru',
                'count' => 8,
                'total' => 'Rp 640 Juta',
                'deals' => [
                    [
                        'tag' => 'B2B SaaS',
                        'prob' => '15% Prob',
                        'title' => 'Implementasi HRIS Suite',
                        'company' => 'PT Sumber Alfaria Mandiri',
                        'value' => 'Rp 85.000.000',
                        'badge' => 'Momentum Baru (+3 inbound)',
                        'badge_type' => 'info',
                        'pic' => 'RH',
                        'pic_name' => 'Rian Hidayat',
                    ],
                    [
                        'tag' => 'Fintech Core',
                        'prob' => '20% Prob',
                        'title' => 'Payment Orchestrator API',
                        'company' => 'Bank Perkreditan Dana Artha',
                        'value' => 'Rp 210.000.000',
                        'badge' => 'Menunggu alokasi technical lead',
                        'badge_type' => 'neutral',
                        'pic' => 'SN',
                        'pic_name' => 'Siti Nurbaya',
                    ],
                ]
            ],
            [
                'id' => 'kontak_pertama',
                'title' => '2. Kontak Pertama',
                'count' => 12,
                'total' => 'Rp 1,15 Miliar',
                'deals' => [
                    [
                        'tag' => 'Logistik IoT',
                        'prob' => '30% Prob',
                        'title' => 'Fleet Tracking & Telematics',
                        'company' => 'PT Samudera Logistik Prima',
                        'value' => 'Rp 340.000.000',
                        'badge' => '7 hari tanpa follow up WA',
                        'badge_type' => 'danger',
                        'pic' => 'RH',
                        'pic_name' => 'Rian Hidayat',
                    ],
                ]
            ],
            [
                'id' => 'kualifikasi',
                'title' => '3. Kualifikasi Kebutuhan',
                'count' => 10,
                'total' => 'Rp 1,48 Miliar',
                'deals' => [
                    [
                        'tag' => 'Retail O2O',
                        'prob' => '45% Prob',
                        'title' => 'Omnichannel POS Rollout',
                        'company' => 'Kopi Kencana Raya (140 Gerai)',
                        'value' => 'Rp 520.000.000',
                        'badge' => 'Budget CFO Terverifikasi',
                        'badge_type' => 'success',
                        'pic' => 'DW',
                        'pic_name' => 'Dewi Lestari',
                    ],
                ]
            ],
            [
                'id' => 'proposal',
                'title' => '4. Proposal & RFP',
                'count' => 10,
                'total' => 'Rp 2,40 Miliar',
                'deals' => [
                    [
                        'tag' => 'Enterprise Cloud',
                        'prob' => '65% Prob',
                        'title' => 'Migrasi Hybrid Multi-Region',
                        'company' => 'PT Telekomunikasi Seluler Inti',
                        'value' => 'Rp 940.000.000',
                        'badge' => 'Proposal Revisi v2 Terkirim',
                        'badge_type' => 'info',
                        'pic' => 'BS',
                        'pic_name' => 'Budi Santoso',
                    ],
                ]
            ],
            [
                'id' => 'negosiasi',
                'title' => '5. Negosiasi Legal',
                'count' => 7,
                'total' => 'Rp 1,25 Miliar',
                'deals' => [
                    [
                        'tag' => 'Banking Security',
                        'prob' => '80% Prob',
                        'title' => 'SOC 2 Type II Security Vault',
                        'company' => 'Bank Nusa Mandiri',
                        'value' => 'Rp 640.000.000',
                        'badge' => 'Review Legal Dept Tahap Akhir',
                        'badge_type' => 'purple',
                        'pic' => 'SR',
                        'pic_name' => 'Siti Rahma',
                    ],
                ]
            ],
            [
                'id' => 'won',
                'title' => 'Closed Won',
                'count' => 24,
                'total' => 'Rp 3,24 Miliar',
                'deals' => [
                    [
                        'tag' => 'WhatsApp BSP',
                        'prob' => '100% Won',
                        'title' => 'AI Automated Messaging Hub',
                        'company' => 'PT Solusi Finansial Prima',
                        'value' => 'Rp 350.000.000',
                        'badge' => 'SPK Diteken • Onboarding Aktif',
                        'badge_type' => 'success',
                        'pic' => 'DP',
                        'pic_name' => 'Dimas Pratama',
                    ],
                ]
            ]
        ];

        return view('crm.pipeline', compact('currentUser', 'columns'));
    }

    /**
     * 4. Tasks & Aktivitas Penjualan - Page 11 PDF
     */
    public function tasks(Request $request)
    {
        $currentUser = $this->getUserData();

        $overdueTasks = [
            [
                'title' => 'Revisi SPK Enterprise Cloud 128-Core',
                'category' => 'Kontrak Legal',
                'delay' => 'Terlambat 1 Hari',
                'company' => 'PT Bank Central Digital Tbk',
                'value' => 'Rp 1.850.000.000',
                'pic' => 'Dimas Pratama',
                'ai_hint' => 'AI Copilot: PIC Legal Bank Central Digital menunggu addendum pasal SLA 99.95%. Draft sudah siap dikirim.',
                'action' => 'Kirim Draft AI',
                'action_icon' => 'fa-paper-plane',
            ],
            [
                'title' => 'Konfirmasi Jadwal UAT Modul Farmasi',
                'category' => 'Telepon Direksi',
                'delay' => 'Terlambat 4 Jam',
                'company' => 'PT Kalbe Medika Farma',
                'value' => 'Rp 640.000.000',
                'pic' => 'Siti Nurhaliza',
                'action' => 'WA Klien',
                'action_icon' => 'fa-whatsapp',
            ],
            [
                'title' => 'Kirim Rekap Pricing Bandwidth Fleet TMS',
                'category' => 'Email Proposal',
                'delay' => 'Terlambat 2 Hari',
                'company' => 'PT Telkom Logistik Nusantara',
                'value' => 'Rp 420.000.000',
                'pic' => 'Budi Santoso',
                'action' => 'Reschedule',
                'action_icon' => 'fa-calendar-clock',
            ],
        ];

        $todayTasks = [
            [
                'title' => 'Presentasi AI Predictive Churn ke C-Level',
                'category' => 'Demo Solusi AI',
                'time' => '14:00 WIB',
                'company' => 'PT Astra Komponen Industri Tbk',
                'link_info' => 'Google Meet Terintegrasi',
                'pic' => 'Dimas Pratama',
                'action' => 'Masuk Meet',
                'action_icon' => 'fa-video',
            ],
            [
                'title' => 'Konfirmasi Penerimaan Addendum PoC',
                'category' => 'WhatsApp Follow-up',
                'time' => '15:30 WIB',
                'company' => 'PT Samudera Shipping Lines',
                'pic' => 'Fajar Ramadhan',
                'action' => 'Chat Template WA',
                'action_icon' => 'fa-comment-dots',
            ],
            [
                'title' => 'Review Term of Payment 60 Hari vs 30 Hari',
                'category' => 'Negosiasi',
                'time' => '17:00 WIB',
                'company' => 'PT Indofood Sukses Retail',
                'pic' => 'Siti Nurhaliza',
                'action' => 'Tandai Selesai',
                'action_icon' => 'fa-check-circle',
            ],
        ];

        $nextBestActions = [
            'lead_names' => ['PT Bio Nusantara Tbk (Kirim Case Study)', 'PT Surya Energi Persada (Follow-up CIO)', 'PT Gudang Distribusi Prima (Jadwal Ulang)'],
            'win_prob' => 'Win Prob +18%',
        ];

        return view('crm.tasks', compact('currentUser', 'overdueTasks', 'todayTasks', 'nextBestActions'));
    }

    /**
     * 5. AI Sales Copilot & Asisten Percakapan - Page 9 PDF
     */
    public function copilot(Request $request)
    {
        $currentUser = $this->getUserData();

        $activeLead = [
            'name' => 'Hermawan Wijaya',
            'title' => 'Chief Technology Officer (CTO)',
            'company' => 'PT Solusi Finansial Prima',
            'industry' => 'Fintech / Multifinance',
            'email' => 'hermawan@finprima.id',
            'phone' => '+62 811-9872-334',
            'deal_value' => 'Rp 350.000.000',
            'pic' => 'Budi Santoso',
            'status' => 'HOT LEAD',
            'score' => 94,
            'grade' => 'Grade A+',
            'win_prob' => '88%',
            'breakdown' => [
                ['name' => 'Kecocokan Anggaran (Budget Fit)', 'points' => '+35 Poin', 'desc' => 'Alokasi Q4 Rp 400 Juta untuk pembaharuan tech stack CRM mikrofinance.'],
                ['name' => 'Wewenang Pengambil Keputusan', 'points' => '+30 Poin', 'desc' => 'Pak Hermawan memiliki kuasa penuh pemilihan vendor arsitektur TI.'],
                ['name' => 'Tingkat Urgensi Implementasi', 'points' => '+29 Poin', 'desc' => 'Target go-live sebelum audit OJK semester pertama tahun depan.'],
            ],
            'warning' => 'Data tanggal mulai implementasi teknis belum terisi di form deal. Disarankan ditanyakan secara spesifik saat follow-up Kamis depan untuk mengunci alokasi tim engineer.',
            'next_action' => 'Jadwalkan call klarifikasi penawaran teknis dalam kurun waktu 48 jam sebelum kompetitor lain mengajukan proposal tender.',
            'next_action_schedule' => 'Kamis, 14:00 WIB',
        ];

        $documents = [
            ['name' => 'Draft Kontrak Finansial Prima v1.2', 'type' => 'PDF', 'size' => '2.4 MB', 'date' => 'Diperbarui 12 Okt'],
            ['name' => 'Presentasi Pitch Deck B2B Enterprise', 'type' => 'PPTX', 'size' => '18.2 MB', 'date' => 'Demo Versi'],
            ['name' => 'Whitepaper Kepatuhan SOC 2 & OJK', 'type' => 'PDF', 'size' => '4.1 MB', 'date' => 'Dokumen Publik'],
        ];

        return view('crm.copilot', compact('currentUser', 'activeLead', 'documents'));
    }

    /**
     * Interactive Copilot Prompt Endpoint
     */
    public function copilotAsk(Request $request)
    {
        $prompt = $request->input('prompt', '');
        $tone = $request->input('tone', 'Profesional');

        $responseDraft = [
            'subject' => 'Tindak Lanjut Demo Nusantara CRM: Arsitektur Keamanan & Integrasi API WhatsApp',
            'content' => "Yth. Bapak Hermawan,\nCTO PT Solusi Finansial Prima,\n\nTerima kasih banyak atas waktu dan diskusi konstruktif dalam sesi demonstrasi Nusantara Enterprise CRM kemarin siang.\n\nMenindaklanjuti fokus diskusi Anda mengenai kesiapan infrastruktur serta kepatuhan perbankan mikro yang sedang diperluas oleh PT Solusi Finansial Prima, kami merangkum 2 poin utama yang menjadi prioritas tim Anda:\n\n1. Integrasi WhatsApp Cloud API Resmi Meta (Latency < 20ms, High-throughput blast aman tanpa risiko blokir).\n2. Jaminan Keamanan & Kepatuhan ISO 27001 / SOC 2 Type II serta audit perbankan OJK dengan enkripsi end-to-end data customer.\n\nKami telah menyiapkan dokumen addendum teknis yang dapat direview oleh tim arsitek TI Bapak.",
            'timestamp' => now()->format('H:i') . ' WIB',
            'confidence' => '98%',
            'tone' => $tone,
        ];

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'draft' => $responseDraft,
                'prompt' => $prompt,
            ]);
        }

        return back()->with('responseDraft', $responseDraft);
    }

    /**
     * 6. Otomasi Penjualan & Alur Kerja AI - Page 13 PDF
     */
    public function otomasi(Request $request)
    {
        $currentUser = $this->getUserData();

        $metrics = [
            'volume' => '14.280',
            'volume_sub' => 'Aksi Terotomasi Bulan Ini (+24.6%)',
            'efisiensi' => '320 Jam',
            'efisiensi_sub' => 'Pekerjaan Manual Dihemat (-18 Jam / AE)',
            'stabilitas' => '0 Loop Error',
            'stabilitas_sub' => 'Tingkat Integritas 99.98% • Latency 28ms',
        ];

        $workflows = [
            [
                'id' => 1,
                'name' => 'Pengingat Otomatis Deal Stagnan (> 5 Hari di Tahap Proposal)',
                'desc' => 'Jika deal tidak berganti status selama 120 jam -> Kirim Nudge AI ke Slack #sales-alert & Buat Priority Task Manager',
                'type' => 'Stage Aging / Waktu',
                'freq' => '842 kali',
                'success_rate' => '98.8%',
                'success_detail' => '832 Sukses / 10 Gagal',
                'pic' => 'Dimas Pratama',
                'status' => 'Aktif',
            ],
            [
                'id' => 2,
                'name' => 'Sinkronisasi Lead Google Ads & Meta Ads ke CRM Real-time',
                'desc' => 'Webhook Inbound Lead Forms -> Normalisasi nomor telepon +62 -> Evaluasi AI Fit & Tag Segmentasi Otomatis',
                'type' => 'Webhook API',
                'freq' => '6.310 kali',
                'success_rate' => '100%',
                'success_detail' => '6.310 Sukses / 0 Gagal',
                'pic' => 'Andi Saputra',
                'status' => 'Aktif',
            ],
            [
                'id' => 3,
                'name' => 'Eskalasi Otomatis Diskon Negosiasi > 20% ke VP Sales',
                'desc' => 'Deteksi permohonan diskon harga enterprise -> Kunci pipeline sebelum persetujuan -> Kirim push WhatsApp & In-app approval ke VP Sales',
                'type' => 'Field Update',
                'freq' => '119 kali',
                'success_rate' => '100%',
                'success_detail' => '119 Sukses / 0 Gagal',
                'pic' => 'Rina Wulandari',
                'status' => 'Aktif',
            ],
            [
                'id' => 4,
                'name' => 'Nurturing Lead Tidak Merespon pasca Demo (Drip Campaign 3 Hari)',
                'desc' => 'Status deal "Unresponsive" > 72 jam -> AI Copilot membuat draf email studi kasus industri & jadwalkan WhatsApp check-in santai',
                'type' => 'Status Tidak Aktif',
                'freq' => '512 kali',
                'success_rate' => '97.2%',
                'success_detail' => '498 Sukses / 14 Re-try',
                'pic' => 'Dimas Pratama',
                'status' => 'Aktif',
            ],
        ];

        return view('crm.otomasi', compact('currentUser', 'metrics', 'workflows'));
    }

    /**
     * 7. Laporan & Analitik Penjualan - Page 12 PDF
     */
    public function laporan(Request $request)
    {
        $currentUser = $this->getUserData();

        $metrics = [
            'revenue_closing' => 'Rp 12.450.000.000',
            'revenue_trend' => '+24.8% YoY • Kuota: 104%',
            'win_rate' => '31.4%',
            'win_rate_trend' => '+4.2% • Benchmark SaaS: 22%',
            'siklus_penjualan' => '21 Hari',
            'siklus_trend' => '6 Hari Lebih Cepat vs Q3 (27 Hari)',
            'sla_kepatuhan' => '96.8%',
            'sla_trend' => 'Target 95% • Respon < 2 Jam',
        ];

        $funnel = [
            ['stage' => '1. Total Leads Masuk', 'count' => '1.482 Leads', 'pct' => '100% Basis', 'bar_pct' => 100],
            ['stage' => '2. MQL / Qualified Leads', 'count' => '520 Leads', 'pct' => '35.1% Konversi', 'bar_pct' => 65],
            ['stage' => '3. Peluang & Demo Terjadwal', 'count' => '210 Deals', 'pct' => '40.4% Konversi', 'bar_pct' => 45],
            ['stage' => '4. Pengajuan Proposal & Negosiasi', 'count' => '94 Deals', 'pct' => '44.8% Konversi', 'bar_pct' => 30],
            ['stage' => '5. Closed Won (Deal Dimenangkan)', 'count' => '66 Deals', 'pct' => '70.2% Win Rate', 'bar_pct' => 20],
        ];

        $leadSources = [
            ['name' => 'WhatsApp Official Inbound', 'revenue' => 'Rp 5.200.000.000', 'leads' => '592 Leads', 'win_rate' => '38.0%', 'deals' => '28 Deals Won', 'cpl' => 'Rp 85.000', 'cac' => 'Rp 1.790.000', 'roi' => '8.4x', 'color' => '#10b981'],
            ['name' => 'Website Organic Form', 'revenue' => 'Rp 3.800.000.000', 'leads' => '420 Leads', 'win_rate' => '32.0%', 'deals' => '20 Deals Won', 'cpl' => 'Rp 120.000', 'cac' => 'Rp 2.520.000', 'roi' => '6.9x', 'color' => '#4c52f8'],
            ['name' => 'LinkedIn Outreach B2B', 'revenue' => 'Rp 2.100.000.000', 'leads' => '340 Leads', 'win_rate' => '26.0%', 'deals' => '12 Deals Won', 'cpl' => 'Rp 310.000', 'cac' => 'Rp 8.780.000', 'roi' => '4.1x', 'color' => '#0284c7'],
            ['name' => 'Referral Rekanan & Partner', 'revenue' => 'Rp 1.350.000.000', 'leads' => '130 Leads', 'win_rate' => '45.0%', 'deals' => '6 Deals Won', 'cpl' => 'Rp 45.000', 'cac' => 'Rp 975.000', 'roi' => '12.8x', 'color' => '#8b5cf6'],
        ];

        $reps = [
            [
                'name' => 'Budi Santoso',
                'team' => 'Enterprise Strategic (Fintech & Banking)',
                'deals' => '18 dari 48 deal',
                'revenue' => 'Rp 3.200.000.000',
                'target' => 'Target: Rp 2.42M',
                'achievement' => '132% Tercapai (+Rp 780 Juta Lebih)',
                'win_rate' => '37.5%',
                'sla' => '18 Menit (99.2% Kepatuhan)',
                'activities' => '142 Call • 46 Meeting • 68 Demo App',
                'avatar' => 'BS',
            ],
            [
                'name' => 'Siti Rahma',
                'team' => 'Strategic Tier-1 (BUMN & Telco)',
                'deals' => '16 dari 45 deal',
                'revenue' => 'Rp 2.800.000.000',
                'target' => 'Target: Rp 2.45M',
                'achievement' => '114% Tercapai (+Rp 350 Juta Lebih)',
                'win_rate' => '35.5%',
                'sla' => '24 Menit (98.5% Kepatuhan)',
                'activities' => '128 Call • 39 Meeting • 54 Demo App',
                'avatar' => 'SR',
            ],
            [
                'name' => 'Rian Kusuma',
                'team' => 'Commercial Growth (Retail & FMCG)',
                'deals' => '12 dari 42 deal',
                'revenue' => 'Rp 2.100.000.000',
                'target' => 'Target: Rp 2.23M',
                'achievement' => '94% Tercapai (-Rp 130 Juta Target)',
                'win_rate' => '28.5%',
                'sla' => '38 Menit (94.0% Kepatuhan)',
                'activities' => '112 Call • 34 Meeting • 41 Demo App',
                'avatar' => 'RK',
            ],
            [
                'name' => 'Dewi Safitri',
                'team' => 'Mid-Market Expansion (Logistics & Supply)',
                'deals' => '11 dari 39 deal',
                'revenue' => 'Rp 1.900.000.000',
                'target' => 'Target: Rp 2.15M',
                'achievement' => '88% Tercapai (-Rp 250 Juta Target)',
                'win_rate' => '28.2%',
                'sla' => '45 Menit (91.4% Kepatuhan)',
                'activities' => '98 Call • 29 Meeting • 36 Demo App',
                'avatar' => 'DS',
            ],
        ];

        return view('crm.laporan', compact('currentUser', 'metrics', 'funnel', 'leadSources', 'reps'));
    }

    /**
     * 8. Pengaturan & Konfigurasi Workspace - Page 14 PDF
     */
    public function pengaturan(Request $request)
    {
        $currentUser = $this->getUserData();

        $metrics = [
            'seats' => '18 / 25',
            'seats_sub' => 'Lisensi Pengguna Aktif',
            'target_kuota' => 'Rp 48,5 M',
            'target_realisasi' => 'Realisasi 78.4% (Rp 38,02 M)',
            'token_ai' => '1,42 M',
            'token_ai_sub' => 'Token Terpakai (+41% Efisiensi Draft)',
            'health_score' => '99.98%',
            'health_score_sub' => 'Uptime SLA • 4 API Aktif',
        ];

        $team = [
            ['name' => 'Dimas Pratama', 'email' => 'dimas.pratama@nusantara.id', 'role' => 'Super Admin', 'team' => 'Enterprise West', 'status' => 'Aktif', 'quota' => '15.000'],
            ['name' => 'Siti Rahma, S.E.', 'email' => 'siti.rahma@nusantara.id', 'role' => 'Sales Manager', 'team' => 'Enterprise West', 'status' => 'Aktif', 'quota' => '12.500'],
            ['name' => 'Budi Santoso', 'email' => 'budi.santoso@nusantara.id', 'role' => 'Account Exec', 'team' => 'Gov Tech & BUMN', 'status' => 'Aktif', 'quota' => '8.500'],
            ['name' => 'Fajar Ramadhan, M.Kom', 'email' => 'fajar.ramadhan@nusantara.id', 'role' => 'Pre-sales', 'team' => 'SMB Digital', 'status' => 'Aktif', 'quota' => '5.000'],
            ['name' => 'Nadia Wulandari', 'email' => 'nadia.wulandari@nusantara.id', 'role' => 'Account Exec', 'team' => 'Enterprise West', 'status' => 'Pending 2FA', 'quota' => '7.500'],
        ];

        $integrations = [
            ['name' => 'WhatsApp Cloud API', 'desc' => 'Meta Official BSP Gateway', 'status' => '14ms', 'type' => 'wa', 'badge_color' => '#10b981'],
            ['name' => 'Google Workspace', 'desc' => 'Calendar & Gmail Sync', 'status' => 'Sync OK', 'type' => 'google', 'badge_color' => '#10b981'],
            ['name' => 'ERP & PostgreSQL Bank', 'desc' => 'Invoice & Pembayaran', 'status' => '15 Aktif min', 'type' => 'database', 'badge_color' => '#10b981'],
            ['name' => 'Slack Notification Webhook', 'desc' => 'Channel: #sales-enterprise-wins', 'status' => 'Terhubung', 'type' => 'slack', 'badge_color' => '#10b981'],
        ];

        $auditLogs = [
            ['text' => 'Dimas Pratama mengubah role Siti Rahma menjadi Senior AE', 'time' => '2 jam yang lalu • IP: 103.14.22.8'],
            ['text' => 'API Token WhatsApp Cloud diperbarui oleh Admin', 'time' => '5 jam yang lalu • System Token'],
            ['text' => 'Undangan tim dikirim ke nadia.wulandari@nusantara.id', 'time' => 'Kemarin, 16:45 WIB • Dimas Pratama'],
        ];

        return view('crm.pengaturan', compact('currentUser', 'metrics', 'team', 'integrations', 'auditLogs'));
    }

    /**
     * Actions / API handlers
     */
    public function storeLead(Request $request)
    {
        return back()->with('success', 'Lead baru berhasil ditambahkan dan dianalisis oleh AI Score Engine!');
    }

    public function storeDeal(Request $request)
    {
        return back()->with('success', 'Peluang kesepakatan baru berhasil didaftarkan ke Pipeline B2B!');
    }

    public function storeTask(Request $request)
    {
        return back()->with('success', 'Tugas baru berhasil dijadwalkan dengan prioritas SLA AI!');
    }

    public function toggleWorkflow($id)
    {
        return response()->json(['success' => true, 'message' => 'Status alur kerja berhasil diperbarui.']);
    }

    public function saveSettings(Request $request)
    {
        return back()->with('success', 'Konfigurasi workspace enterprise berhasil disimpan.');
    }
}
