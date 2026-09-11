<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PklProfile;
use App\Models\PklHistory;
use App\Models\ProgramKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PklRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Must login first before choosing program PKL
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Silakan login atau buat akun terlebih dahulu sebelum mendaftar & memilih program PKL / Magang.');
        }

        $programs = ProgramKursus::all();
        $user = Auth::user();
        $profile = PklProfile::where('user_id', $user->id)->first();

        return view('auth.register-pkl', compact('programs', 'user', 'profile'));
    }

    public function register(Request $request)
    {
        // Must login first
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Silakan login terlebih dahulu sebelum memilih program PKL / Magang.');
        }

        $user = Auth::user();

        $request->validate([
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'student_id_number' => 'nullable|string|max:100',
            'phone_number' => 'required|string|max:30',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'program_id' => 'required|exists:program_kursuses,id',
            'address' => 'nullable|string',
        ]);

        // Update role if user is regular user or pkl_student
        if ($user->role === 'user' || empty($user->role)) {
            $user->update(['role' => 'pkl_student']);
        }

        $profile = PklProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'institution' => $request->institution,
                'major' => $request->major,
                'student_id_number' => $request->student_id_number,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'active',
                'program_id' => $request->program_id,
            ]
        );

        $program = ProgramKursus::find($request->program_id);

        // Auto-generate Invoice for selected program if none exists
        $existingInvoice = \App\Models\PklInvoice::where('pkl_profile_id', $profile->id)->first();
        if (!$existingInvoice) {
            $rawPrice = preg_replace('/[^0-9]/', '', $program->price ?? '0');
            $amount = floatval($rawPrice) > 0 ? floatval($rawPrice) : 0;
            $invoiceStatus = $amount == 0 ? 'paid' : 'pending';

            \App\Models\PklInvoice::create([
                'pkl_profile_id' => $profile->id,
                'invoice_code' => 'INV-PKL-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4)),
                'amount' => $amount,
                'description' => 'Biaya Pendaftaran & Akses Kelas ' . ($program->title ?? $program->name ?? 'PKL / Magang'),
                'status' => $invoiceStatus,
                'paid_at' => $invoiceStatus === 'paid' ? now() : null,
            ]);
        }

        // Initialize default modules if program has no modules yet
        $modulesCount = \App\Models\ProgramModule::where('program_id', $program->id)->count();
        if ($modulesCount === 0) {
            $defaultModules = [
                [
                    'title' => 'Materi 1: Pengenalan & Fundamental Program',
                    'type' => 'materi',
                    'description' => 'Memahami gambaran umum divisi, alur kerja tim, dan aturan pelaksanaan magang.',
                    'content' => 'Selamat datang di program magang! Di modul ini Anda akan mempelajari dasar-dasar industri dan workflow tim.',
                    'order_index' => 1,
                ],
                [
                    'title' => 'Quiz 1: Evaluasi Pemahaman Fundamental',
                    'type' => 'quiz',
                    'description' => 'Kuis evaluasi tingkat dasar untuk menguji pemahaman konsep awal.',
                    'order_index' => 2,
                ],
                [
                    'title' => 'Tugas 1: Setup Development Environment & Laporan Awal',
                    'type' => 'tugas',
                    'description' => 'Instalasi tools kerja, setup environment, dan pembuatan laporan rencana kerja.',
                    'order_index' => 3,
                ],
                [
                    'title' => 'Materi 2: Arsitektur Sistem & Best Practices Coding',
                    'type' => 'materi',
                    'description' => 'Teknik penulisan kode bersih, struktur arsitektur project, dan integrasi database.',
                    'content' => 'Modul ini mendalami implementasi teknis, clean code, serta penggunaan git repository.',
                    'order_index' => 4,
                ],
                [
                    'title' => 'Quiz 2: Evaluasi Teknikal & Problem Solving',
                    'type' => 'quiz',
                    'description' => 'Kuis evaluasi tingkat menengah mencakup logika program dan penanganan masalah.',
                    'order_index' => 5,
                ],
                [
                    'title' => 'Final Project: Pengembangan Sistem / Aplikasi Akhir',
                    'type' => 'project',
                    'description' => 'Proyek akhir mandiri/kelompok sebagai syarat kelulusan sertifikasi magang.',
                    'order_index' => 6,
                ],
            ];

            foreach ($defaultModules as $mod) {
                \App\Models\ProgramModule::create(array_merge($mod, ['program_id' => $program->id]));
            }
        }

        // Initialize Student Progress for all program modules
        $programModules = \App\Models\ProgramModule::where('program_id', $program->id)->orderBy('order_index')->get();
        foreach ($programModules as $module) {
            \App\Models\PklStudentProgress::firstOrCreate(
                [
                    'pkl_profile_id' => $profile->id,
                    'program_module_id' => $module->id,
                ],
                [
                    'status' => 'pending',
                ]
            );
        }

        // Record history log
        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'registration',
            'title' => 'Pendaftaran & Pemilihan Program PKL Berhasil',
            'description' => 'Memilih divisi/program ' . ($program->title ?? $program->name ?? '-') . ' dari ' . $request->institution . ' (' . $request->major . ').',
            'icon' => 'fa-graduation-cap',
            'logged_at' => now(),
        ]);

        return redirect()->route('pkl.dashboard')->with('success', 'Selamat! Pendaftaran & pemilihan program PKL Anda berhasil disimpan.');
    }
}
