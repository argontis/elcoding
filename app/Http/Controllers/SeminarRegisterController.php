<?php

namespace App\Http\Controllers;

use App\Models\SeminarCategory;
use App\Models\SeminarProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeminarRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Silakan login atau buat akun terlebih dahulu sebelum mendaftar sebagai peserta seminar.');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $categories = SeminarCategory::active()->orderBy('name')->get();
        $profile = SeminarProfile::where('user_id', $user->id)->first();

        return view('auth.register-seminar', compact('categories', 'user', 'profile'));
    }

    public function register(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Silakan login terlebih dahulu sebelum mendaftar sebagai peserta seminar.');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $hasActiveCategories = SeminarCategory::active()->exists();

        $request->validate([
            'seminar_category_id' => $hasActiveCategories
                ? 'required|exists:seminar_categories,id'
                : 'nullable|exists:seminar_categories,id',
            'phone_number' => 'required|string|max:30',
            'institution' => 'required|string|max:255',
            'occupation' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        if (in_array($user->role, ['user', 'pending_role', 'seminar_participant', null, ''], true)) {
            $user->update(['role' => 'seminar_participant']);
        }

        SeminarProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'seminar_category_id' => $request->seminar_category_id ?: null,
                'phone_number' => $request->phone_number,
                'institution' => $request->institution,
                'occupation' => $request->occupation,
                'city' => $request->city,
                'notes' => $request->notes,
            ]
        );

        return redirect()->route('seminar.dashboard')->with('success', 'Pendaftaran Peserta Seminar berhasil disimpan! Lihat promo & benefit khusus untuk Anda di bawah ini.');
    }
}
