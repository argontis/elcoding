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
        $programs = ProgramKursus::all();
        return view('auth.register-pkl', compact('programs'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'student_id_number' => 'nullable|string|max:100',
            'phone_number' => 'required|string|max:30',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'program_id' => 'nullable|exists:program_kursuses,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pkl_student',
        ]);

        $profile = PklProfile::create([
            'user_id' => $user->id,
            'institution' => $request->institution,
            'major' => $request->major,
            'student_id_number' => $request->student_id_number,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'active',
            'program_id' => $request->program_id,
        ]);

        // Record history log
        PklHistory::create([
            'pkl_profile_id' => $profile->id,
            'activity_type' => 'registration',
            'title' => 'Pendaftaran Akun PKL Berhasil',
            'description' => 'Mendaftar sebagai peserta PKL dari ' . $request->institution . ' (' . $request->major . ').',
            'icon' => 'fa-user-check',
            'logged_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('pkl.dashboard')->with('success', 'Selamat datang! Akun PKL Anda telah berhasil dibuat.');
    }
}
