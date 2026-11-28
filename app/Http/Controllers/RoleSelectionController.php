<?php

namespace App\Http\Controllers;

use App\Models\SeminarCategory;
use Illuminate\Support\Facades\Auth;

class RoleSelectionController extends Controller
{
    public function show()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->isAdminOrMentor()) {
            return redirect('/dashboard');
        }

        if ($user->isPklStudent() && $user->pklProfile) {
            return redirect()->route('pkl.dashboard');
        }

        if ($user->isSeminarParticipant() && $user->seminarProfile) {
            return redirect()->route('seminar.dashboard');
        }

        $categories = SeminarCategory::active()->orderBy('name')->get();

        return view('auth.choose-role', compact('user', 'categories'));
    }
}
