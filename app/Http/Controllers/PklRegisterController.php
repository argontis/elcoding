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
