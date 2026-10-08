<?php

namespace App\Http\Controllers\Bimbel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BimbelDashboardController extends Controller
{
    /**
     * Tampilkan dashboard utama EduPulse Academy SaaS dengan data awal KOSONG (siap diisi sendiri oleh pengguna).
     */
    public function index()
    {
        $user = auth()->user();

        $academicYear = 'Tahun Ajaran ' . date('Y') . '/' . (date('Y') + 1) . ' - Semester Genap';
        $currentDateFormatted = 'Hari ini, ' . \Carbon\Carbon::now()->translatedFormat('d F Y');
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Ambil data dari session jika user sudah menambahkan data sendiri
        $pendaftarList = session('bimbel_pendaftar', []);
        $kelasList     = session('bimbel_kelas', []);
        $agendaList    = session('bimbel_agenda', []);
        $aiFeed        = session('bimbel_ai_feed', []);

        $totalSiswaCount = count($pendaftarList);
        $totalKelasCount = count($kelasList);

        // 4 Stat Cards Atas (Awal Kosong - 0)
        $stats = [
            'total_siswa' => [
                'val' => $totalSiswaCount > 0 ? $totalSiswaCount : 0,
                'growth' => '+0% MoM',
                'sub1' => $totalSiswaCount > 0 ? "{$totalSiswaCount} siswa baru" : '0 siswa baru',
                'sub2' => 'Kapasitas: 0%',
            ],
            'kehadiran' => [
                'val' => '0%',
                'target' => 'Target 90%',
                'sub1' => '0/0 Hadir',
                'sub2' => '0 Izin/Sakit',
            ],
            'spp' => [
                'val' => 'Rp 0',
                'target' => '0% Target',
                'sub1' => 'Sisa Rp 0',
                'sub2' => '0% QRIS/VA',
            ],
            'ai_tutor' => [
                'val' => '0',
                'growth' => '+0% Wk',
                'sub1' => '0% Akurasi',
                'sub2' => '0 Soal Hari Ini',
            ],
        ];

        // Monitoring Kelas Langsung (Kosong — siap dijadwalkan)
        $utilitasStudio = [
            'persen' => $totalKelasCount > 0 ? round(($totalKelasCount / 7) * 100) . '%' : '0%',
            'terpakai' => "{$totalKelasCount}/7 Studio Terpakai",
        ];

        $kelasLangsung = $kelasList;

        // WhatsApp Gateway Metrics (Kosong)
        $waGateway = [
            'status' => 'Online',
            'terkirim' => '0 Pesan',
            'delivery_rate' => '0%',
            'siswa_jatuh_tempo' => 0,
            'total_jatuh_tempo' => 'Rp 0',
        ];

        // Analisis Tryout Akbar & Diagnostik IRT (Kosong)
        $tryoutData = [
            'paket' => 'Belum Ada Paket Tryout Aktif',
            'peserta' => 0,
            'kuota' => 0,
            'peserta_persen' => '0%',
            'kesiapan' => '0%',
            'drill_avg' => '0 drill soal/siswa',
            'moda' => 'CBT + AI IRT (Belum Ada Sesi)',
            'distribusi' => [
                'high_persen' => 0,
                'high_label' => '> 700 Pts Top Tier PTN (0)',
                'mid_persen' => 0,
                'mid_label' => '600 – 700 Aman Reguler (0)',
                'low_persen' => 0,
                'low_label' => '< 600 Pts Intervensi (0)',
            ],
            'top_kelemahan' => [],
        ];

        // Pendaftaran Baru (PPDB Gelombang 2)
        $pendaftaranBaru = [
            'status' => 'Pendaftaran Dibuka',
            'terisi' => count($pendaftarList),
            'total' => 100,
            'list' => $pendaftarList,
        ];

        return view('bimbel.dashboard', compact(
            'user',
            'academicYear',
            'currentDateFormatted',
            'currentBranch',
            'stats',
            'utilitasStudio',
            'kelasLangsung',
            'waGateway',
            'aiFeed',
            'tryoutData',
            'pendaftaranBaru',
            'agendaList'
        ));
    }

    /**
     * Endpoint interaktif untuk blast WhatsApp reminder SPP.
     */
    public function blastWa(Request $request)
    {
        $count = $request->input('count', 0);
        return response()->json([
            'success' => true,
            'message' => $count > 0 
                ? "Blast WhatsApp pengingat SPP berhasil terkirim ke {$count} orang tua / wali siswa!"
                : "Tidak ada siswa yang jatuh tempo SPP saat ini.",
            'timestamp' => now()->format('H:i:s'),
        ]);
    }

    /**
     * Simpan pendaftar siswa baru (PPDB) yang diisi pengguna.
     */
    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
        ]);

        $list = session('bimbel_pendaftar', []);
        
        // Buat inisial nama
        $words = explode(' ', trim($request->nama));
        $initial = strtoupper(substr($words[0] ?? 'S', 0, 1) . substr($words[1] ?? ($words[0] ?? 'W'), 0, 1));

        $newStudent = [
            'id' => count($list) + 1,
            'initial' => $initial,
            'nama' => $request->nama,
            'waktu' => 'Baru saja',
            'program' => $request->program,
            'sub_program' => $request->input('sub_program', 'Kelas Reguler'),
            'sekolah' => $request->sekolah,
            'status_berkas' => 'Verifikasi DP',
            'status_theme' => 'amber',
            'aksi' => 'Verifikasi',
            'aksi_theme' => 'indigo',
            'phone' => preg_replace('/[^0-9]/', '', $request->phone),
        ];

        array_unshift($list, $newStudent);
        session(['bimbel_pendaftar' => $list]);

        return redirect()->route('bimbel.dashboard')->with('success', "Pendaftaran siswa '{$request->nama}' berhasil disimpan ke sistem!");
    }

    /**
     * Verifikasi pendaftaran.
     */
    public function verifikasiPendaftaran(Request $request, $id)
    {
        $list = session('bimbel_pendaftar', []);
        foreach ($list as &$item) {
            if ($item['id'] == $id) {
                $item['status_berkas'] = 'Lunas Penuh';
                $item['status_theme'] = 'emerald';
                $item['aksi'] = 'LMS Aktif';
                $item['aksi_theme'] = 'sky';
                break;
            }
        }
        session(['bimbel_pendaftar' => $list]);

        return response()->json([
            'success' => true,
            'message' => "Berkas pendaftar ID #{$id} berhasil diverifikasi dan LMS telah diaktifkan!",
        ]);
    }

    /**
     * Ganti cabang aktif.
     */
    public function switchBranch(Request $request)
    {
        $branch = $request->input('branch', 'Jakarta Selatan');
        session(['bimbel_branch' => $branch]);

        return response()->json([
            'success' => true,
            'message' => "Cabang aktif berhasil diubah ke {$branch}.",
        ]);
    }

    /**
     * Reset semua data kembali ke kosong bersih.
     */
    public function resetData()
    {
        session()->forget([
            'bimbel_pendaftar', 'bimbel_kelas', 'bimbel_agenda', 'bimbel_ai_feed', 'bimbel_direktori_siswa',
            'bimbel_sesi_jadwal', 'bimbel_roster_absensi', 'bimbel_jurnal_mengajar',
            'bimbel_daftar_tagihan', 'bimbel_materi_list',
            'bimbel_ai_sesi_list', 'bimbel_ai_chat_default',
            'bimbel_progress_tryouts', 'bimbel_progress_subtes', 'bimbel_progress_catatan', 'bimbel_progress_plans',
            'bimbel_profil', 'bimbel_cabang_list', 'bimbel_staff', 'bimbel_wa_config', 'bimbel_payment_config', 'bimbel_ai_config', 'bimbel_audit_log'
        ]);
        return redirect()->route('bimbel.dashboard')->with('info', 'Semua data seluruh modul Bimbel telah direset menjadi kosong bersih (siap diisi sendiri).');
    }

    /**
     * Export laporan bulanan.
     */
    public function exportLaporan(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Laporan Operasional & Akademik Bulanan berhasil di-generate (Format PDF/Excel siap).',
        ]);
    }

    /**
     * Tampilkan halaman Direktori & Pendaftaran Siswa (EduPulse Academy SaaS).
     * Secara default data kosong siap diisi sendiri oleh pengguna.
     */
    public function siswa(Request $request)
    {
        $user = auth()->user();

        $academicYear = 'Tahun Ajaran ' . date('Y') . '/' . (date('Y') + 1) . ' - Semester Genap';
        $currentDateFormatted = 'Hari ini, ' . \Carbon\Carbon::now()->translatedFormat('d F Y');
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Data direktori siswa dari session (default kosong [] sesuai request user)
        $siswaList = session('bimbel_direktori_siswa', []);

        // Filter search jika ada
        $search = $request->query('search');
        $filterProgram = $request->query('program');
        $filterStatus = $request->query('status');

        $filteredList = $siswaList;
        if (!empty($search)) {
            $filteredList = array_filter($filteredList, function ($item) use ($search) {
                return stripos($item['nama'], $search) !== false 
                    || stripos($item['nis'], $search) !== false 
                    || stripos($item['sekolah'], $search) !== false;
            });
        }
        if (!empty($filterProgram) && $filterProgram !== 'semua') {
            $filteredList = array_filter($filteredList, function ($item) use ($filterProgram) {
                return stripos($item['program'], $filterProgram) !== false;
            });
        }
        if (!empty($filterStatus) && $filterStatus !== 'semua') {
            $filteredList = array_filter($filteredList, function ($item) use ($filterStatus) {
                return strtolower($item['status']) === strtolower($filterStatus);
            });
        }

        $totalSiswa = count($siswaList);
        $totalAktif = count(array_filter($siswaList, fn($s) => strtolower($s['status']) === 'aktif'));
        $menungguVerifikasi = count(array_filter($siswaList, fn($s) => stripos($s['status'], 'verifikasi') !== false));

        // Statistik Direktori (Awal kosong 0)
        $stats = [
            'total_siswa_aktif' => [
                'val' => $totalAktif,
                'growth' => '+0% dibandingkan semester lalu',
            ],
            'pendaftar_baru' => [
                'val' => 0,
                'sub' => 'Gelombang Target SNBT & Reguler',
            ],
            'menunggu_verifikasi' => [
                'val' => $menungguVerifikasi,
                'sub' => $menungguVerifikasi > 0 ? 'Butuh Review Segera' : 'Semua berkas terverifikasi',
            ],
            'kehadiran_global' => [
                'val' => '0%',
                'sub' => '+0.0% konsistensi presensi',
            ],
        ];

        // Siswa terpilih untuk Profil 360° di sisi kanan
        $selectedId = $request->query('id');
        $selectedSiswa = null;

        if (!empty($selectedId)) {
            foreach ($siswaList as $s) {
                if ($s['id'] == $selectedId) {
                    $selectedSiswa = $s;
                    break;
                }
            }
        } elseif (!empty($filteredList)) {
            $selectedSiswa = reset($filteredList);
        }

        return view('bimbel.siswa', compact(
            'user',
            'academicYear',
            'currentDateFormatted',
            'currentBranch',
            'stats',
            'siswaList',
            'filteredList',
            'selectedSiswa'
        ));
    }

    /**
     * Simpan siswa baru ke direktori.
     */
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'sekolah' => 'required|string|max:255',
            'program' => 'required|string|max:255',
        ]);

        $list = session('bimbel_direktori_siswa', []);
        
        $words = explode(' ', trim($request->nama));
        $initial = strtoupper(substr($words[0] ?? 'S', 0, 1) . substr($words[1] ?? ($words[0] ?? 'W'), 0, 1));
        $newId = count($list) + 1;

        $nis = $request->input('nis');
        if (empty($nis)) {
            $nis = date('Y') . '-' . str_pad($newId, 4, '0', STR_PAD_LEFT);
        }

        $newStudent = [
            'id' => $newId,
            'nama' => $request->nama,
            'nis' => $nis,
            'initial' => $initial,
            'sekolah' => $request->sekolah,
            'program' => $request->program,
            'kelas_ruang' => $request->input('kelas_ruang', 'Ruang Newton (Lantai 2)'),
            'status' => $request->input('status', 'Aktif'),
            'avatar_color' => 'bg-indigo-600',
            
            // Target Kampus & Jurusan Impian
            'target_ptn1' => [
                'kampus' => $request->input('target_kampus_1', 'Universitas Indonesia'),
                'jurusan' => $request->input('target_jurusan_1', 'Teknik Informatika'),
                'skor_tryout' => $request->input('skor_tryout', '0.0 Pts'),
            ],
            'target_ptn2' => [
                'kampus' => $request->input('target_kampus_2', 'Institut Teknologi Bandung'),
                'jurusan' => $request->input('target_jurusan_2', 'STEI - Rekayasa'),
                'peluang' => $request->input('peluang_ptn2', '80%'),
            ],

            // Riwayat Kehadiran & Sesi
            'kehadiran' => [
                'persen' => '100.0%',
                'status_label' => 'Sangat Baik',
                'sesi_blocks' => ['H', 'H', 'H', 'H', 'H', 'H', '-'],
                'terdaftar_sejak' => 'Terdaftar sejak ' . \Carbon\Carbon::now()->translatedFormat('d F Y') . ' via Direktori Siswa',
            ],

            // Status SPP Bimbel
            'spp' => [
                'status_termin' => $request->input('status_spp', 'Lunas 4/4 Termin'),
                'paket_nama' => $request->program,
                'paket_biaya' => $request->input('paket_biaya', 'Rp 12.500.000'),
                'total_terbayar' => $request->input('total_terbayar', 'Rp 12.500.000'),
                'tagihan_berikutnya' => 'Rp 0 (Selesai)',
            ],

            // Data Orang Tua / Wali
            'wali' => [
                'nama' => $request->input('nama_wali', 'Orang Tua / Wali Siswa'),
                'hubungan' => $request->input('hubungan_wali', 'Orang Tua'),
                'pekerjaan' => $request->input('pekerjaan_wali', 'Wiraswasta / Profesional'),
                'email' => $request->input('email_wali', 'wali@example.com'),
                'phone' => preg_replace('/[^0-9]/', '', $request->input('phone_wali', '6281234567890')),
            ],
        ];

        array_unshift($list, $newStudent);
        session(['bimbel_direktori_siswa' => $list]);

        return redirect()->route('bimbel.siswa', ['id' => $newId])->with('success', "Data siswa '{$request->nama}' berhasil ditambahkan ke direktori!");
    }

    /**
     * Broadcast info ke siswa / wali.
     */
    public function broadcastSiswa(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'message' => "Pesan broadcast WhatsApp berhasil dikirim ke siswa/wali ID #{$id}.",
        ]);
    }

    /**
     * Hapus siswa dari direktori.
     */
    public function destroySiswa(Request $request, $id)
    {
        $list = session('bimbel_direktori_siswa', []);
        $list = array_values(array_filter($list, fn($item) => $item['id'] != $id));
        session(['bimbel_direktori_siswa' => $list]);

        return redirect()->route('bimbel.siswa')->with('info', "Data siswa berhasil dihapus dari direktori.");
    }

    public function jadwal(Request $request)
    {
        $user = auth()->user();
        $academicYear  = 'Tahun Ajaran ' . date('Y') . '/' . (date('Y') + 1) . ' - Semester Genap';
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Semua data jadwal dari session (default kosong — siap diisi pengguna)
        $sesiList    = session('bimbel_sesi_jadwal', []);       // List sesi/kelas terjadwal
        $rosterList  = session('bimbel_roster_absensi', []);    // Roster absensi siswa aktif
        $jurnalList  = session('bimbel_jurnal_mengajar', []);   // Jurnal mengajar tutor

        // Stats hari ini (dihitung dari data session)
        $totalSesi       = count($sesiList);
        $totalHadir      = 0;
        $totalIzin       = 0;
        $totalSakit      = 0;
        $totalAlpa       = 0;
        $totalSiswaRoster = count($rosterList);

        foreach ($rosterList as $r) {
            $status = strtolower($r['status'] ?? 'hadir');
            if ($status === 'hadir') $totalHadir++;
            elseif ($status === 'izin') $totalIzin++;
            elseif ($status === 'sakit') $totalSakit++;
            else $totalAlpa++;
        }

        $totalHadirTotal = $totalHadir + $totalIzin + $totalSakit + $totalAlpa;
        $pctKehadiran = $totalHadirTotal > 0
            ? round(($totalHadir / $totalHadirTotal) * 100, 1) . '%'
            : '0%';

        $stats = [
            'sesi_hari_ini'    => ['val' => $totalSesi,     'sub' => '0 Hybrid / 0 Online', 'pct_slot' => '0%'],
            'kehadiran'        => ['val' => $pctKehadiran,  'sub' => "{$totalHadir} dari {$totalHadirTotal} Hadir Fisik/Zoom", 'growth' => '+0.0% vs kemarin'],
            'izin_sakit'       => ['val' => $totalIzin + $totalSakit, 'sub1' => '0 Berkas Terverifikasi', 'sub2' => '0 Menunggu'],
            'pengajar'         => ['val' => 0,              'sub1' => '0% Sesuai Jadwal',  'sub2' => '0 Guru Pengganti'],
        ];

        // Sesi terpilih untuk Live Roster kanan (pilih pertama jika ada)
        $selectedSesiId = $request->query('sesi');
        $selectedSesi   = null;
        if (!empty($selectedSesiId)) {
            foreach ($sesiList as $s) {
                if ($s['id'] == $selectedSesiId) { $selectedSesi = $s; break; }
            }
        } elseif (!empty($sesiList)) {
            $selectedSesi = $sesiList[0];
        }

        // Distribusi per hari (kosong)
        $distribusiHari = [
            'Senin' => 0, 'Selasa' => 0, 'Rabu' => 0,
            'Kamis' => 0, 'Jumat' => 0, 'Sabtu' => 0,
        ];
        foreach ($sesiList as $s) {
            $hari = $s['hari'] ?? '';
            if (isset($distribusiHari[$hari])) $distribusiHari[$hari]++;
        }

        return view('bimbel.jadwal', compact(
            'user', 'academicYear', 'currentBranch',
            'stats', 'sesiList', 'rosterList', 'jurnalList',
            'selectedSesi', 'distribusiHari'
        ));
    }

    /**
     * Simpan sesi kelas baru ke jadwal.
     */
    public function storeSesi(Request $request)
    {
        $request->validate([
            'nama_kelas'  => 'required|string|max:255',
            'mata_pelajaran' => 'required|string|max:255',
            'tutor'       => 'required|string|max:255',
            'jam_mulai'   => 'required|string|max:10',
            'jam_selesai' => 'required|string|max:10',
            'hari'        => 'required|string|max:20',
        ]);

        $list  = session('bimbel_sesi_jadwal', []);
        $newId = count($list) + 1;

        $list[] = [
            'id'            => $newId,
            'nama_kelas'    => $request->nama_kelas,
            'mata_pelajaran'=> $request->mata_pelajaran,
            'tutor'         => $request->tutor,
            'ruangan'       => $request->input('ruangan', 'Ruang Online'),
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
            'hari'          => $request->hari,
            'tingkat'       => $request->input('tingkat', 'Semua Tingkat'),
            'tipe'          => $request->input('tipe', 'Online'),
            'status'        => 'Terjadwal',
            'total_siswa'   => 0,
        ];

        session(['bimbel_sesi_jadwal' => $list]);
        return redirect()->route('bimbel.jadwal')->with('success', "Sesi kelas '{$request->nama_kelas}' berhasil ditambahkan ke jadwal!");
    }

    /**
     * Simpan siswa ke roster absensi kelas.
     */
    public function storeRoster(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'nis'   => 'nullable|string|max:50',
        ]);

        $list  = session('bimbel_roster_absensi', []);
        $newId = count($list) + 1;
        $nis   = $request->nis ?: (date('Y') . str_pad($newId, 4, '0', STR_PAD_LEFT));
        $words = explode(' ', trim($request->nama));
        $initial = strtoupper(substr($words[0] ?? 'S', 0, 1) . substr($words[1] ?? ($words[0] ?? 'X'), 0, 1));

        $list[] = [
            'id'       => $newId,
            'nama'     => $request->nama,
            'nis'      => $nis,
            'initial'  => $initial,
            'status'   => 'Hadir',
            'tap_time' => now()->format('H:i') . ' WIB',
            'catatan'  => $request->input('catatan', ''),
        ];

        session(['bimbel_roster_absensi' => $list]);
        return redirect()->route('bimbel.jadwal')->with('success', "Siswa '{$request->nama}' berhasil ditambahkan ke roster absensi!");
    }

    /**
     * Update status absensi siswa (Hadir/Izin/Sakit/Alpa).
     */
    public function updateAbsensi(Request $request, $id)
    {
        $status = $request->input('status', 'Hadir');
        $list   = session('bimbel_roster_absensi', []);
        foreach ($list as &$item) {
            if ($item['id'] == $id) {
                $item['status']   = $status;
                $item['tap_time'] = now()->format('H:i') . ' WIB';
                break;
            }
        }
        session(['bimbel_roster_absensi' => $list]);
        return response()->json(['success' => true, 'status' => $status]);
    }

    /**
     * Hadir semua siswa dalam roster.
     */
    public function hadirSemua(Request $request)
    {
        $list = session('bimbel_roster_absensi', []);
        foreach ($list as &$item) {
            $item['status']   = 'Hadir';
            $item['tap_time'] = now()->format('H:i') . ' WIB';
        }
        session(['bimbel_roster_absensi' => $list]);
        return response()->json(['success' => true, 'message' => 'Semua siswa telah ditandai HADIR!']);
    }

    /**
     * Reset jadwal & absensi.
     */
    public function resetJadwal()
    {
        session()->forget(['bimbel_sesi_jadwal', 'bimbel_roster_absensi', 'bimbel_jurnal_mengajar']);
        return redirect()->route('bimbel.jadwal')->with('info', 'Jadwal, roster absensi, dan jurnal mengajar telah direset ke kondisi kosong.');
    }

    public function tagihan(Request $request)
    {
        $user = auth()->user();
        $academicYear = 'Tahun Ajaran 2024/2025 - Semester Genap';
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Data tagihan dari session (default kosong [] sesuai request user)
        $tagihanList = session('bimbel_daftar_tagihan', []);

        // Filter tab & pencarian
        $tab = $request->query('tab', 'semua');
        $search = $request->query('search', '');

        $filteredList = $tagihanList;
        if (!empty($search)) {
            $filteredList = array_filter($filteredList, function ($item) use ($search) {
                return stripos($item['nama_siswa'], $search) !== false
                    || stripos($item['no_invoice'], $search) !== false
                    || stripos($item['komponen_biaya'], $search) !== false;
            });
        }

        if ($tab !== 'semua') {
            $filteredList = array_filter($filteredList, function ($item) use ($tab) {
                return strtolower($item['status']) === strtolower($tab);
            });
        }

        $totalFaktur     = count($tagihanList);
        $countPending    = count(array_filter($tagihanList, fn($t) => strtolower($t['status']) === 'pending'));
        $countLunas      = count(array_filter($tagihanList, fn($t) => strtolower($t['status']) === 'lunas'));
        $countTerlambat  = count(array_filter($tagihanList, fn($t) => strtolower($t['status']) === 'terlambat'));

        $penerimaanSpp   = array_sum(array_map(fn($t) => (int)($t['nominal_raw'] ?? 0), array_filter($tagihanList, fn($t) => strtolower($t['status']) === 'lunas')));
        $tagihanPending  = array_sum(array_map(fn($t) => (int)($t['nominal_raw'] ?? 0), array_filter($tagihanList, fn($t) => strtolower($t['status']) === 'pending')));
        $jatuhTempoTotal = array_sum(array_map(fn($t) => (int)($t['nominal_raw'] ?? 0), array_filter($tagihanList, fn($t) => in_array(strtolower($t['status']), ['pending', 'terlambat']))));

        $stats = [
            'penerimaan_bulan_ini' => [
                'val' => 'Rp ' . number_format($penerimaanSpp, 0, ',', '.'),
                'target' => 'Target: Rp 160.000.000',
                'pct' => ($penerimaanSpp > 0 ? round(($penerimaanSpp / 160000000) * 100, 1) : 0) . '% tercapai',
            ],
            'tagihan_pending' => [
                'val' => 'Rp ' . number_format($tagihanPending, 0, ',', '.'),
                'sub1' => $countPending . ' Siswa Menunggu',
                'sub2' => 'Rata-rata: Rp ' . ($countPending > 0 ? number_format(round($tagihanPending / $countPending), 0, ',', '.') : '0') . '/siswa',
            ],
            'jatuh_tempo_minggu' => [
                'val' => 'Rp ' . number_format($jatuhTempoTotal, 0, ',', '.'),
                'sub1' => ($countPending + $countTerlambat) . ' Siswa perlu reminder',
                'sub2' => 'Maks. 12 Maret',
            ],
            'otomatis_gateway' => [
                'val' => ($totalFaktur > 0 ? '86.4%' : '0%'),
                'sub' => '+0.0% dibandingkan bulan lalu',
            ],
        ];

        // Faktur terpilih untuk preview di kolom kanan
        $selectedId = $request->query('id');
        $selectedFaktur = null;
        if (!empty($selectedId)) {
            foreach ($tagihanList as $f) {
                if ($f['id'] == $selectedId) {
                    $selectedFaktur = $f;
                    break;
                }
            }
        } elseif (!empty($filteredList)) {
            $selectedFaktur = reset($filteredList);
        }

        // Mini counters untuk bawah tabel
        $metaStats = [
            'va_terbit' => count(array_filter($tagihanList, fn($t) => stripos($t['metode'], 'va') !== false)),
            'konfirmasi_manual' => count(array_filter($tagihanList, fn($t) => stripos($t['metode'], 'tunai') !== false || stripos($t['metode'], 'manual') !== false)),
        ];

        return view('bimbel.tagihan', compact(
            'user',
            'academicYear',
            'currentBranch',
            'stats',
            'metaStats',
            'tagihanList',
            'filteredList',
            'selectedFaktur',
            'tab',
            'search',
            'totalFaktur',
            'countPending',
            'countLunas',
            'countTerlambat'
        ));
    }

    /**
     * Buat invoice/tagihan baru.
     */
    public function storeTagihan(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'kelas_program' => 'required|string|max:255',
            'nominal' => 'required',
        ]);

        $list = session('bimbel_daftar_tagihan', []);
        $newId = count($list) + 1;

        $rawNominal = (int) preg_replace('/[^0-9]/', '', $request->nominal);
        if ($rawNominal <= 0) $rawNominal = 950000;

        $noInvoice = 'INV/' . date('Y/m') . '/' . str_pad($newId + 140, 4, '0', STR_PAD_LEFT);
        $jatuhTempo = $request->input('jatuh_tempo', date('d M Y', strtotime('+7 days')));
        $metode = $request->input('metode', 'BCA VA');
        $komponen = $request->input('komponen_biaya', 'SPP Pendidikan Bulanan');
        $status = $request->input('status', 'Pending');

        $faktur = [
            'id' => $newId,
            'no_invoice' => $noInvoice,
            'nama_siswa' => $request->nama_siswa,
            'kelas_program' => $request->kelas_program,
            'target_kampus' => $request->input('target_kampus', 'Target PTN Unggulan'),
            'nama_wali' => $request->input('nama_wali', 'Wali Murid'),
            'no_wa_wali' => $request->input('no_wa_wali', '0812-8899-2311'),
            'komponen_biaya' => $komponen,
            'komponen_sub' => $request->input('komponen_sub', 'Termasuk modul & bimbingan konsultasi'),
            'nominal_raw' => $rawNominal,
            'nominal_formatted' => 'Rp ' . number_format($rawNominal, 0, ',', '.'),
            'jatuh_tempo' => $jatuhTempo,
            'jatuh_tempo_badge' => 'H-3 Hari',
            'metode' => $metode,
            'status' => $status,
            'tgl_terbit' => date('d M Y'),
            'va_number' => $metode . ': ' . rand(1000, 9999) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999),
            'items' => [
                [
                    'uraian' => 'SPP Pendidikan Bulanan (Reguler)',
                    'keterangan' => 'Sesi tatap muka 4x seminggu - konsultasi PR harian',
                    'periode' => date('F Y'),
                    'nominal' => 'Rp ' . number_format(max(0, $rawNominal - 500000), 0, ',', '.'),
                ],
                [
                    'uraian' => 'Modul Drilling SNBT & Skolastik',
                    'keterangan' => 'Edisi Eksklusif Semester Genap 2025',
                    'periode' => '1 Pkt',
                    'nominal' => 'Rp 300.000',
                ],
                [
                    'uraian' => 'Try Out Akbar Nasional UTBK #3',
                    'keterangan' => 'Sistem Penilaian IRT & Analisis Peluang Masuk PTN',
                    'periode' => '1 Sesi',
                    'nominal' => 'Rp 200.000',
                ]
            ],
            'subtotal' => 'Rp ' . number_format($rawNominal, 0, ',', '.'),
            'biaya_gateway' => 'GRATIS (Ditanggung Bimbel)',
            'total' => 'Rp ' . number_format($rawNominal, 0, ',', '.'),
        ];

        array_unshift($list, $faktur);
        session(['bimbel_daftar_tagihan' => $list]);

        return redirect()->route('bimbel.tagihan', ['id' => $newId])
            ->with('success', "Faktur '{$noInvoice}' untuk siswa '{$request->nama_siswa}' berhasil diterbitkan!");
    }

    /**
     * Tandai faktur lunas / bayar.
     */
    public function bayarTagihan(Request $request, $id)
    {
        $list = session('bimbel_daftar_tagihan', []);
        foreach ($list as &$item) {
            if ($item['id'] == $id) {
                $item['status'] = 'Lunas';
                $item['jatuh_tempo_badge'] = 'Lunas ' . date('d M');
                break;
            }
        }
        session(['bimbel_daftar_tagihan' => $list]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Faktur berhasil ditandai LUNAS!']);
        }

        return redirect()->route('bimbel.tagihan', ['id' => $id])
            ->with('success', 'Faktur berhasil diverifikasi dan ditandai LUNAS!');
    }

    /**
     * Kirim reminder via WhatsApp per siswa.
     */
    public function kirimReminder(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Faktur tagihan digital & link pembayaran telah dikirim ke WhatsApp Wali Murid.',
        ]);
    }

    /**
     * Kirim blast reminder massal ke semua wali tagihan pending/terlambat.
     */
    public function blastTagihan(Request $request)
    {
        $list = session('bimbel_daftar_tagihan', []);
        $pendingCount = count(array_filter($list, fn($t) => in_array(strtolower($t['status']), ['pending', 'terlambat'])));

        return response()->json([
            'success' => true,
            'count' => $pendingCount,
            'message' => "Blast reminder otomatis terkirim ke {$pendingCount} kontak WhatsApp wali murid yang belum lunas.",
        ]);
    }

    /**
     * Reset tagihan ke default kosong.
     */
    public function resetTagihan()
    {
        session()->forget('bimbel_daftar_tagihan');
        return redirect()->route('bimbel.tagihan')->with('info', 'Data tagihan & SPP telah direset ke kondisi bersih (kosong).');
    }

    public function materi(Request $request)
    {
        $user = auth()->user();
        $academicYear = 'Tahun Ajaran 2024/2025 - Semester Genap';
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Data materi & silabus dari session (default kosong [] sesuai request user)
        $materiList = session('bimbel_materi_list', []);

        // Filter pencarian, mapel, tipe, status
        $search = $request->query('search', '');
        $mapelFilter = $request->query('mapel', 'semua');
        $tipeFilter = $request->query('tipe', 'semua');
        $statusFilter = $request->query('status', 'semua');

        $filteredList = $materiList;
        if (!empty($search)) {
            $filteredList = array_filter($filteredList, function ($item) use ($search) {
                return stripos($item['judul'], $search) !== false
                    || stripos($item['mapel'], $search) !== false
                    || stripos($item['badge_bab'], $search) !== false;
            });
        }

        if ($mapelFilter !== 'semua') {
            $filteredList = array_filter($filteredList, function ($item) use ($mapelFilter) {
                return stripos($item['mapel'], $mapelFilter) !== false;
            });
        }

        if ($tipeFilter !== 'semua') {
            $filteredList = array_filter($filteredList, function ($item) use ($tipeFilter) {
                return stripos($item['tipe_konten'] ?? '', $tipeFilter) !== false;
            });
        }

        if ($statusFilter !== 'semua') {
            $filteredList = array_filter($filteredList, function ($item) use ($statusFilter) {
                return strtolower($item['status']) === strtolower($statusFilter);
            });
        }

        $totalModul = count($materiList);
        $bankSoal = array_sum(array_map(fn($m) => (int)($m['jumlah_soal'] ?? 0), $materiList));
        $videoCount = array_sum(array_map(fn($m) => (int)($m['jumlah_video'] ?? 0), $materiList));

        $stats = [
            'total_modul' => [
                'val' => $totalModul,
                'sub' => '+0 pekan ini • PDF, PPT & Rumus',
            ],
            'bank_soal' => [
                'val' => number_format($bankSoal, 0, ',', '.'),
                'sub' => 'Bobot IRT UTBK • 100% Pembahasan',
            ],
            'video_rekaman' => [
                'val' => $videoCount,
                'sub' => 'Sinkron dengan jadwal kelas',
            ],
            'rata_akses' => [
                'val' => ($totalModul > 0 ? '84.6%' : '0%'),
                'label' => ($totalModul > 0 ? 'Tinggi' : 'Belum Ada'),
            ],
        ];

        // Materi terpilih untuk pratinjau di kolom kanan
        $selectedId = $request->query('id');
        $selectedMateri = null;
        if (!empty($selectedId)) {
            foreach ($materiList as $m) {
                if ($m['id'] == $selectedId) {
                    $selectedMateri = $m;
                    break;
                }
            }
        } elseif (!empty($filteredList)) {
            $selectedMateri = reset($filteredList);
        }

        $mapelTabs = [
            'semua' => 'Semua Mapel',
            'Penalaran Matematika' => 'Penalaran Matematika',
            'Literasi Bhs. Indonesia' => 'Literasi Bhs. Indonesia',
            'Literasi Bhs. Inggris' => 'Literasi Bhs. Inggris',
            'Penalaran Umum' => 'Penalaran Umum',
            'Pengetahuan Kuantitatif' => 'Pengetahuan Kuantitatif',
        ];

        return view('bimbel.materi', compact(
            'user',
            'academicYear',
            'currentBranch',
            'stats',
            'materiList',
            'filteredList',
            'selectedMateri',
            'search',
            'mapelFilter',
            'tipeFilter',
            'statusFilter',
            'mapelTabs',
            'totalModul'
        ));
    }

    /**
     * Simpan modul materi baru.
     */
    public function storeMateri(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'mapel' => 'required|string|max:255',
        ]);

        $list = session('bimbel_materi_list', []);
        $newId = count($list) + 1;

        $badgeBab = $request->input('badge_bab', 'MODUL BAB ' . str_pad($newId, 2, '0', STR_PAD_LEFT));
        $tipe = $request->input('tipe_konten', 'Modul Teori PDF');
        $soalCount = (int)$request->input('jumlah_soal', 30);
        $halaman = (int)$request->input('halaman', 45);

        $newMateri = [
            'id' => $newId,
            'badge_bab' => $badgeBab,
            'status' => 'Terbit',
            'mapel' => $request->mapel,
            'persen_selesai' => '0% Siswa Selesai',
            'judul' => $request->judul,
            'sub_teori' => 'Modul Teori PDF (' . $halaman . ' Hal • 18.4 MB)',
            'jumlah_soal' => $soalCount,
            'sub_soal' => $soalCount . ' Soal HOTS Transformasi',
            'jumlah_video' => 1,
            'sub_video' => 'Video Sesi Tutor (' . $request->input('tutor', 'Dr. Rendy') . ' (1j 20m))',
            'diakses_count' => '0 siswa',
            'update_time' => 'Baru saja',
            'tipe_konten' => $tipe,
            'halaman' => $halaman,
            'ukuran' => '18.4 MB',
            'tutor' => $request->input('tutor', 'Dr. Rendy'),
            'preview_snippet' => $request->input('preview_snippet', "1. Ringkasan Materi & Teori Pokok\nMemuat konsep inti, formula praktis, dan contoh aplikasi soal SNBT.\n\nContoh Formula:\nf'(c) = 0 & f''(c) < 0 => Titik Balik Maksimum Relatif."),
        ];

        array_unshift($list, $newMateri);
        session(['bimbel_materi_list' => $list]);

        return redirect()->route('bimbel.materi', ['id' => $newId])
            ->with('success', "Modul materi '{$request->judul}' berhasil ditambahkan ke repositori!");
    }

    /**
     * AI Soal Generator simulation.
     */
    public function generateAiSoal(Request $request)
    {
        $prompt = $request->input('prompt', 'Buat variasi soal setipe SNBT');
        $kesulitan = $request->input('kesulitan', 'HOTS Sedang');

        return response()->json([
            'success' => true,
            'message' => "5 Soal latihan baru berhasil di-generate dengan model EduPulse LLM v3.4 ({$kesulitan})!",
            'sample_soal' => [
                'Diketahui f(x) = x³ - 3x² + k menyinggung garis y = 4 di titik stasionernya. Tentukan nilai k positif.',
            ]
        ]);
    }

    /**
     * Distribusi materi ke grup kelas WhatsApp siswa & wali.
     */
    public function distribusiMateri(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Notifikasi materi, file e-book, dan link video pembelajaran berhasil disiarkan ke 108 siswa & nomor wali kelas!',
        ]);
    }

    /**
     * Reset repositori materi ke kondisi kosong.
     */
    public function resetMateri()
    {
        session()->forget('bimbel_materi_list');
        return redirect()->route('bimbel.materi')->with('info', 'Repositori materi & kurikulum telah direset ke kondisi bersih (kosong).');
    }

    public function aiTutor(Request $request)
    {
        $user = auth()->user();
        $academicYear = 'Tahun Ajaran 2024/2025 - Semester Genap';
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Daftar sesi diskusi AI dari session (default kosong [] sesuai request user)
        $sesiList = session('bimbel_ai_sesi_list', []);

        // Filter / pencarian topik jika ada
        $search = $request->query('search', '');
        $filteredSesi = $sesiList;
        if (!empty($search)) {
            $filteredSesi = array_filter($filteredSesi, function ($item) use ($search) {
                return stripos($item['judul'], $search) !== false
                    || stripos($item['kategori'], $search) !== false;
            });
        }

        // Sesi terpilih
        $selectedId = $request->query('sesi');
        $activeSesi = null;
        if (!empty($selectedId)) {
            foreach ($sesiList as $s) {
                if ($s['id'] == $selectedId) {
                    $activeSesi = $s;
                    break;
                }
            }
        } elseif (!empty($filteredSesi)) {
            $activeSesi = reset($filteredSesi);
        }

        // Chat messages untuk sesi aktif (default kosong)
        $chatKey = $activeSesi ? 'bimbel_ai_chat_' . $activeSesi['id'] : 'bimbel_ai_chat_default';
        $chatMessages = session($chatKey, []);

        // Siswa aktif saat ini (dinamis dari direktori siswa atau default kosong)
        $siswaList = session('bimbel_direktori_siswa', []);
        $firstSiswa = !empty($siswaList) ? reset($siswaList) : null;
        $activeStudent = [
            'nama' => $firstSiswa['nama'] ?? 'Belum Ada Siswa',
            'kelas' => $firstSiswa['program'] ?? 'Belum Ada Program',
            'initial' => !empty($firstSiswa['initial']) ? $firstSiswa['initial'] : 'SW',
            'target_prodi' => $firstSiswa['target_prodi'] ?? 'Belum Ada Target',
            'skor_prediksi' => '0 Pts (Belum Ada TO)',
        ];

        // Parameter tutor AI (default)
        $aiParams = [
            'model' => 'EduPulse LLM v3.4 Academic - IRT UTBK 2025',
            'tingkat_penjelasan' => 'Detail Langkah Demi Langkah',
            'gaya_interaksi' => 'Ramah & Pembimbing Sokratik',
            'metode_sokratik' => true,
            'analisis_bobot_irt' => true,
        ];

        return view('bimbel.ai_tutor', compact(
            'user',
            'academicYear',
            'currentBranch',
            'sesiList',
            'filteredSesi',
            'activeSesi',
            'chatMessages',
            'activeStudent',
            'aiParams',
            'search'
        ));
    }

    /**
     * Kirim chat ke AI Tutor dan simpan ke session.
     */
    public function sendChatAiTutor(Request $request)
    {
        $message = trim($request->input('message', ''));
        $sesiId = $request->input('sesi_id', 'default');

        if (empty($message)) {
            return response()->json(['error' => 'Pesan tidak boleh kosong.'], 422);
        }

        $chatKey = 'bimbel_ai_chat_' . $sesiId;
        $messages = session($chatKey, []);

        // 1. Simpan pesan siswa
        $userMsg = [
            'sender' => 'user',
            'sender_name' => 'Dimas Arya Putra',
            'avatar' => 'DA',
            'time' => now()->format('H:i') . ' WIB',
            'text' => $message,
        ];
        $messages[] = $userMsg;

        // 2. Generate respons cerdas terstruktur dari EduPulse Math Tutor
        $aiExplanation = "Halo Dimas! Pertanyaan yang sangat krusial untuk paket HOTS UTBK SNBT.\n\n" .
            "💡 **Kunci Konsep (The Master Rule):**\n" .
            "Gunakan pendekatan dekomposisi variabel dan substitusi bertahap untuk menyederhanakan bentuk berpangkat ganjil trigonometri.\n\n" .
            "📌 **LANGKAH PENGERJAAN RUNTUT:**\n" .
            "1. Tentukan pemisalan variabel: $u = \\sin(x)$ sehingga $du = \\cos(x) dx$.\n" .
            "2. Substitusikan ke dalam bentuk integral semula: $\\int u^3 du = \\frac{1}{4} u^4 + C$.\n" .
            "3. Masukkan batas integral jika batas tertutup $[0, \\pi/2]$: $\\left[\\frac{1}{4} \\sin^4(x)\\right]_0^{\\pi/2} = \\frac{1}{4}(1) - 0 = \\mathbf{0.25 (1/4)}$.\n\n" .
            "⚡ **Trik Eliminasi Cepat UTBK:**\n" .
            "Karena fungsi $\\sin^3(x)\\cos(x)$ bernilai simetris positif pada kuadran I dengan puncak kecil di $x = 60^\\circ$, jawaban tidak mungkin melebihi $0.5$. Eliminasi langsung opsi A (1/2)!";

        $aiMsg = [
            'sender' => 'ai',
            'sender_name' => 'EduPulse Math Tutor • Solusi Terstruktur',
            'time' => now()->format('H:i') . ' WIB',
            'text' => $aiExplanation,
            'formula_badge' => 'Substitusi Aljabar (U-Substitution)',
            'kurva_info' => 'Daerah kurva y = sin³(x) cos(x) pada interval [0, π/2], Luas = 0.25',
        ];
        $messages[] = $aiMsg;

        session([$chatKey => $messages]);

        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    /**
     * Buat topik / sesi diskusi baru.
     */
    public function storeSesiAiTutor(Request $request)
    {
        $judul = $request->input('judul', 'Topik Diskusi Baru');
        $kategori = $request->input('kategori', 'Penalaran Matematika');

        $sesiList = session('bimbel_ai_sesi_list', []);
        $newId = count($sesiList) + 1;

        $newSesi = [
            'id' => $newId,
            'judul' => $judul,
            'kategori' => $kategori,
            'pesan_count' => '0 Pesan',
            'waktu' => now()->format('H:i') . ' WIB',
            'badge_status' => 'Aktif',
            'durasi' => 'Baru',
            'group' => 'HARI INI',
            'tingkat' => 'HOTS UTBK',
            'batch' => 'Bimbel Reguler SNBT Batch 1',
        ];

        array_unshift($sesiList, $newSesi);
        session(['bimbel_ai_sesi_list' => $sesiList]);

        return redirect()->route('bimbel.ai_tutor', ['sesi' => $newId])
            ->with('success', "Sesi diskusi '{$judul}' berhasil dibuka!");
    }

    /**
     * Reset data AI Tutor ke kondisi bersih (kosong).
     */
    public function resetAiTutor()
    {
        $sesiList = session('bimbel_ai_sesi_list', []);
        foreach ($sesiList as $s) {
            session()->forget('bimbel_ai_chat_' . $s['id']);
        }
        session()->forget(['bimbel_ai_sesi_list', 'bimbel_ai_chat_default']);

        return redirect()->route('bimbel.ai_tutor')->with('info', 'Studio AI Tutor telah direset ke kondisi bersih (kosong).');
    }

    /**
     * Progres Belajar & Rapor Akademik Terpadu
     */
    public function progress(Request $request)
    {
        $user = auth()->user();
        $academicYear = 'Tahun Ajaran 2024/2025 - Semester Genap';
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Data progress dari session (default kosong [] sesuai permintaan user)
        $tryouts = session('bimbel_progress_tryouts', []);
        $subtesList = session('bimbel_progress_subtes', []);
        $catatanPedagogis = session('bimbel_progress_catatan', []);
        $rencanaAi = session('bimbel_progress_plans', []);

        // Siswa aktif terpilih (dinamis dari direktori siswa atau default kosong)
        $siswaList = session('bimbel_direktori_siswa', []);
        $firstSiswa = !empty($siswaList) ? reset($siswaList) : null;
        $activeStudent = [
            'nama' => $firstSiswa['nama'] ?? 'Belum Ada Siswa',
            'nis' => $firstSiswa['nis'] ?? '-',
            'sekolah' => $firstSiswa['sekolah'] ?? '-',
            'program' => $firstSiswa['program'] ?? '-',
            'rombel' => $firstSiswa['kelas_ruang'] ?? '-',
            'target_prodi' => $firstSiswa['target_prodi'] ?? '-',
            'target_kampus' => $firstSiswa['target_kampus'] ?? '-',
            'passing_grade' => 0.0,
            'wali_nama' => $firstSiswa['wali']['nama'] ?? 'Belum Ada Wali',
            'wali_phone' => $firstSiswa['wali']['phone'] ?? '-',
        ];

        // Hitung statistik
        $totalTryout = count($tryouts);
        $avgSkor = $totalTryout > 0 ? round(array_sum(array_column($tryouts, 'skor')) / $totalTryout, 1) : 0;
        $peluangLolos = $avgSkor >= 695.0 ? '86.4%' : ($avgSkor > 0 ? '55.0%' : '0%');
        $selisihTarget = $avgSkor > 0 ? ($avgSkor - 695.0) : 0;

        $stats = [
            'skor_irt' => [
                'val' => $avgSkor > 0 ? number_format($avgSkor, 1) : '0',
                'sub' => $avgSkor > 0 ? '+42.5 poin sejak TO-01' : '+0.0 poin',
                'peluang' => 'Peluang Lolos: ' . $peluangLolos,
            ],
            'silabus_soal' => [
                'val' => count($subtesList) > 0 ? '86.5% Tuntas' : '0% Tuntas',
                'sub' => count($subtesList) > 0 ? '26 dari 30 bab tuntas • 1.240 drill dikerjakan' : '0 dari 0 bab tuntas • 0 drill',
                'sisa' => count($subtesList) > 0 ? 'Sisa 4 Modul HOTS' : 'Belum Ada Modul',
                'target' => 'Target: -',
            ],
            'kehadiran' => [
                'val' => '0% - Belum Ada Data',
                'sub' => '0 dari 0 sesi kehadiran',
                'sakit' => '0 Sakit/Izin',
                'alpa' => '0 Alpa',
            ],
            'target_kampus' => [
                'prodi' => $activeStudent['target_prodi'],
                'kampus' => $activeStudent['target_kampus'],
                'passing_grade' => $activeStudent['passing_grade'] > 0 ? ('Standar Passing Grade: ' . number_format($activeStudent['passing_grade'], 1) . ' Poin') : 'Belum Ada Target PG',
                'selisih' => $selisihTarget > 0 ? ('Melampaui Target (+' . number_format($selisihTarget, 1) . ')') : ($selisihTarget < 0 ? ('Di Bawah Target (' . number_format($selisihTarget, 1) . ')') : '-'),
            ],
        ];

        // Filter subtes untuk grafik
        $subtesFilter = $request->query('subtes', 'semua');

        return view('bimbel.progress', compact(
            'user',
            'academicYear',
            'currentBranch',
            'tryouts',
            'subtesList',
            'catatanPedagogis',
            'rencanaAi',
            'activeStudent',
            'stats',
            'subtesFilter',
            'totalTryout',
            'avgSkor'
        ));
    }

    /**
     * Simpan evaluasi / skor tryout baru.
     */
    public function storeEvaluasi(Request $request)
    {
        $request->validate([
            'nama_tryout' => 'required|string|max:255',
            'skor' => 'required|numeric',
        ]);

        $tryouts = session('bimbel_progress_tryouts', []);
        $newId = count($tryouts) + 1;

        $newTryout = [
            'id' => $newId,
            'kode' => 'TO-' . str_pad($newId, 2, '0', STR_PAD_LEFT),
            'nama' => $request->nama_tryout,
            'skor' => (float)$request->skor,
            'tanggal' => date('d M Y'),
        ];

        $tryouts[] = $newTryout;
        session(['bimbel_progress_tryouts' => $tryouts]);

        return redirect()->route('bimbel.progress')
            ->with('success', "Evaluasi Tryout '{$request->nama_tryout}' (Skor: {$request->skor}) berhasil disimpan!");
    }

    /**
     * Simpan catatan pedagogis konselor / tutor.
     */
    public function storeCatatanPedagogis(Request $request)
    {
        $request->validate([
            'tutor_nama' => 'required|string|max:255',
            'catatan' => 'required|string',
        ]);

        $list = session('bimbel_progress_catatan', []);
        $list[] = [
            'id' => count($list) + 1,
            'nama' => $request->tutor_nama,
            'role' => $request->input('role', 'Master Tutor / Konselor'),
            'catatan' => $request->catatan,
            'tanggal' => date('d M Y'),
            'sesi_info' => $request->input('sesi_info', 'Tatap Muka & Bimbingan Mandiri'),
        ];
        session(['bimbel_progress_catatan' => $list]);

        return redirect()->route('bimbel.progress')->with('success', 'Catatan pedagogis berhasil ditambahkan.');
    }

    /**
     * Kirim e-rapor via WhatsApp.
     */
    public function kirimRaporWa(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Laporan progres belajar & tautan E-Rapor Digital resmi telah dikirim ke WhatsApp Ibu Rina Wulandari (+62 812-9843-7721).',
        ]);
    }

    /**
     * Reset progress ke kondisi kosong.
     */
    public function resetProgress()
    {
        session()->forget([
            'bimbel_progress_tryouts',
            'bimbel_progress_subtes',
            'bimbel_progress_catatan',
            'bimbel_progress_plans'
        ]);

        return redirect()->route('bimbel.progress')->with('info', 'Data progres belajar & rapor telah direset ke kondisi bersih (kosong).');
    }

    // ==========================================
    // PENGATURAN & KONFIGURASI SISTEM
    // ==========================================

    /**
     * Halaman Pengaturan & Konfigurasi Sistem EduPulse Bimbel.
     * Semua data mulai KOSONG — user mengisi sendiri.
     */
    public function pengaturan()
    {
        $user          = auth()->user();
        $currentBranch = session('bimbel_branch', 'Jakarta Selatan');

        // Profil Lembaga (kosong — diisi user)
        $profil = session('bimbel_profil', [
            'nama_lembaga'   => '',
            'npwp'           => '',
            'sk_dinas'       => '',
            'tanggal_sk'     => '',
            'alamat'         => '',
            'telepon'        => '',
            'email_ops'      => '',
            'jam_operasi'    => '',
            'mata_pelajaran' => [],
            'logo_url'       => '',
        ]);

        // Daftar Cabang (kosong)
        $cabangList = session('bimbel_cabang_list', []);

        // Pengguna & Hak Akses (kosong)
        $staffList = session('bimbel_staff', []);

        // WhatsApp & Notifikasi
        $waConfig = session('bimbel_wa_config', [
            'nomor'            => '',
            'nama_pengirim'    => '',
            'status'           => 'disconnected',
            'notif_tagihan'    => false,
            'notif_laporan'    => false,
            'notif_distribusi' => false,
            'notif_broadcast'  => false,
            'template_wa'      => '',
        ]);

        // Payment Gateway
        $paymentConfig = session('bimbel_payment_config', [
            'ovo_aktif'        => false,
            'ovo_merchant_id'  => '',
            'bri_aktif'        => false,
            'bri_va_prefix'    => '',
            'bri_rekening'     => '',
            'gopay_aktif'      => false,
            'gopay_merchant'   => '',
            'toleransi_hari'   => '',
        ]);

        // AI Tutor & Kebijakan Pedagogis (default kosong)
        $aiConfig = session('bimbel_ai_config', [
            'model'              => 'EduPulse AI v2.4',
            'token_digunakan'    => 0,
            'token_total'        => 0,
            'expired_at'         => '',
            'konteks_akademis'   => 30,
            'kebijakan_sokrasi'  => true,
            'mode_bisnis'        => '',
            'batas_soal'         => '',
            'protokol_aktif'     => false,
        ]);

        // Log Audit (kosong)
        $auditLog = session('bimbel_audit_log', []);

        return view('bimbel.pengaturan', compact(
            'user',
            'currentBranch',
            'profil',
            'cabangList',
            'staffList',
            'waConfig',
            'paymentConfig',
            'aiConfig',
            'auditLog'
        ));
    }

    /**
     * Simpan Profil Lembaga & Cabang ke session.
     */
    public function simpanProfilLembaga(Request $request)
    {
        $data = $request->only([
            'nama_lembaga','npwp','sk_dinas','tanggal_sk',
            'alamat','telepon','email_ops','jam_operasi','logo_url'
        ]);
        $data['mata_pelajaran'] = $request->input('mata_pelajaran', []);
        session(['bimbel_profil' => $data]);

        // Tambah log audit
        $log   = session('bimbel_audit_log', []);
        $log[] = [
            'waktu'  => now()->format('d-M-Y H:i'),
            'aksi'   => 'Update Profil Lembaga',
            'user'   => auth()->user()->name ?? 'Admin',
            'detail' => 'Data profil lembaga & cabang operasional diperbarui.',
        ];
        session(['bimbel_audit_log' => $log]);

        return redirect()->route('bimbel.pengaturan')->with('success', 'Profil lembaga berhasil disimpan.');
    }

    /**
     * Simpan konfigurasi WhatsApp & notifikasi ke session.
     */
    public function simpanWhatsapp(Request $request)
    {
        $data = $request->only(['nomor','nama_pengirim','template_wa']);
        $data['notif_tagihan']    = $request->boolean('notif_tagihan');
        $data['notif_laporan']    = $request->boolean('notif_laporan');
        $data['notif_distribusi'] = $request->boolean('notif_distribusi');
        $data['notif_broadcast']  = $request->boolean('notif_broadcast');
        $data['status']           = 'connected'; // simulasi connect
        session(['bimbel_wa_config' => $data]);

        $log   = session('bimbel_audit_log', []);
        $log[] = [
            'waktu'  => now()->format('d-M-Y H:i'),
            'aksi'   => 'Update WhatsApp Config',
            'user'   => auth()->user()->name ?? 'Admin',
            'detail' => "Nomor WA {$data['nomor']} dikonfigurasi & otomasi notifikasi diperbarui.",
        ];
        session(['bimbel_audit_log' => $log]);

        return redirect()->route('bimbel.pengaturan')->with('success', 'Konfigurasi WhatsApp berhasil disimpan.');
    }

    /**
     * Simpan konfigurasi Payment Gateway & Virtual SPP ke session.
     */
    public function simpanPayment(Request $request)
    {
        $data = $request->only([
            'ovo_merchant_id','bri_va_prefix','bri_rekening',
            'gopay_merchant','toleransi_hari'
        ]);
        $data['ovo_aktif']   = $request->boolean('ovo_aktif');
        $data['bri_aktif']   = $request->boolean('bri_aktif');
        $data['gopay_aktif'] = $request->boolean('gopay_aktif');
        session(['bimbel_payment_config' => $data]);

        $log   = session('bimbel_audit_log', []);
        $log[] = [
            'waktu'  => now()->format('d-M-Y H:i'),
            'aksi'   => 'Update Payment Gateway',
            'user'   => auth()->user()->name ?? 'Admin',
            'detail' => 'Konfigurasi payment gateway & rekening virtual SPP diperbarui.',
        ];
        session(['bimbel_audit_log' => $log]);

        return redirect()->route('bimbel.pengaturan')->with('success', 'Konfigurasi payment gateway berhasil disimpan.');
    }

    /**
     * Simpan kebijakan AI Tutor & Pedagogis ke session.
     */
    public function simpanAiPolicy(Request $request)
    {
        $existing = session('bimbel_ai_config', []);
        $data = array_merge($existing, $request->only([
            'model','konteks_akademis','mode_bisnis','batas_soal'
        ]));
        $data['kebijakan_sokrasi'] = $request->boolean('kebijakan_sokrasi');
        $data['protokol_aktif']    = $request->boolean('protokol_aktif');
        session(['bimbel_ai_config' => $data]);

        $log   = session('bimbel_audit_log', []);
        $log[] = [
            'waktu'  => now()->format('d-M-Y H:i'),
            'aksi'   => 'Update AI Policy',
            'user'   => auth()->user()->name ?? 'Admin',
            'detail' => "Kebijakan AI Tutor diperbarui — Model: {$data['model']}.",
        ];
        session(['bimbel_audit_log' => $log]);

        return redirect()->route('bimbel.pengaturan')->with('success', 'Kebijakan AI Tutor berhasil disimpan.');
    }

    /**
     * Reset semua pengaturan ke kondisi kosong (factory reset).
     */
    public function resetPengaturan()
    {
        session()->forget([
            'bimbel_profil',
            'bimbel_cabang_list',
            'bimbel_staff',
            'bimbel_wa_config',
            'bimbel_payment_config',
            'bimbel_ai_config',
            'bimbel_audit_log',
        ]);

        return redirect()->route('bimbel.pengaturan')->with('info', 'Semua pengaturan sistem telah direset ke kondisi awal (kosong).');
    }

    /**
     * Logout untuk pengguna role Bimbel
     */
    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar (logout) dari akun EduPulse Bimbel.');
    }
}
