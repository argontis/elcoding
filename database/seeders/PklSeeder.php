<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PklProfile;
use App\Models\PklTask;
use App\Models\PklQuiz;
use App\Models\PklHistory;
use App\Models\ProgramKursus;

class PklSeeder extends Seeder
{
    public function run(): void
    {
        // Check or create sample program if none exists
        $program = ProgramKursus::first();

        // Check if sample PKL student exists
        $user = User::where('email', 'siswa.pkl@elc.my.id')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Siswa Magang ELC',
                'email' => 'siswa.pkl@elc.my.id',
                'password' => bcrypt('password123'),
                'role' => 'pkl_student',
            ]);

            $profile = PklProfile::create([
                'user_id' => $user->id,
                'institution' => 'SMK Negeri 1 Semarang',
                'major' => 'Rekayasa Perangkat Lunak',
                'student_id_number' => '2026998811',
                'phone_number' => '081234567890',
                'address' => 'Jl. Pemuda No. 123, Semarang',
                'start_date' => now()->startOfMonth(),
                'end_date' => now()->addMonths(3),
                'status' => 'active',
                'program_id' => $program ? $program->id : null,
            ]);

            PklTask::create([
                'pkl_profile_id' => $profile->id,
                'assigned_by' => 1,
                'title' => 'Membuat ERD & Skema Database Sistem PKL',
                'description' => 'Rancanglah diagram ERD dan struktur relasi antartabel untuk portal magang.',
                'due_date' => now()->addDays(7),
                'status' => 'pending',
            ]);

            PklHistory::create([
                'pkl_profile_id' => $profile->id,
                'activity_type' => 'registration',
                'title' => 'Pendaftaran Akun PKL Berhasil',
                'description' => 'Mendaftar sebagai peserta PKL dari SMK Negeri 1 Semarang (Rekayasa Perangkat Lunak).',
                'icon' => 'fa-user-check',
                'logged_at' => now(),
            ]);
        }
    }
}
