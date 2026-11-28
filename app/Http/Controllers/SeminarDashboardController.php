<?php

namespace App\Http\Controllers;

use App\Models\SeminarCategory;
use App\Models\SeminarProfile;
use App\Models\SeminarPromo;
use App\Models\SeminarPromoParticipant;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeminarDashboardController extends Controller
{
    private function getProfile(): SeminarProfile
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return SeminarProfile::with(['user', 'category'])
            ->where('user_id', $user->id)
            ->firstOrFail();
    }

    public function dashboard(Request $request)
    {
        $profile = $this->getProfile();

        $promosQuery = SeminarPromo::availableFor($profile)->with('category')->latest();

        if ($request->filled('type') && in_array($request->type, ['promo', 'benefit', 'discount', 'voucher'], true)) {
            $promosQuery->where('type', $request->type);
        }

        $promos = $promosQuery->get();

        $allAvailableCount = SeminarPromo::availableFor($profile)->count();
        $participantPromoMap = SeminarPromoParticipant::where('seminar_profile_id', $profile->id)
            ->get()
            ->keyBy('seminar_promo_id');

        $interestedPromosCount = $participantPromoMap->where('is_interested', true)->count();
        $claimedPromosCount = $participantPromoMap->whereIn('status', ['contacted', 'claimed'])->count();

        $rawWa = Setting::getValue('contact_whatsapp_chat', '');
        $adminWhatsapp = preg_replace('/\D+/', '', (string) $rawWa);
        if (str_starts_with($adminWhatsapp, '0')) {
            $adminWhatsapp = '62' . substr($adminWhatsapp, 1);
        }

        return view('seminar.dashboard', compact(
            'profile',
            'promos',
            'participantPromoMap',
            'allAvailableCount',
            'interestedPromosCount',
            'claimedPromosCount',
            'adminWhatsapp'
        ));
    }

    public function myPromos()
    {
        $profile = $this->getProfile();

        $interestedItems = SeminarPromoParticipant::with(['promo.category'])
            ->where('seminar_profile_id', $profile->id)
            ->where('is_interested', true)
            ->latest('interested_at')
            ->get();

        return view('seminar.my-promos', compact('profile', 'interestedItems'));
    }

    public function expressInterest(Request $request, SeminarPromo $promo)
    {
        $profile = $this->getProfile();

        $isAvailable = SeminarPromo::availableFor($profile)
            ->where('id', $promo->id)
            ->exists();

        if (!$isAvailable) {
            return redirect()->back()->with('error', 'Promo atau benefit ini tidak tersedia untuk akun Anda.');
        }

        $request->validate([
            'participant_note' => 'nullable|string|max:500',
        ]);

        $record = SeminarPromoParticipant::where('seminar_promo_id', $promo->id)
            ->where('seminar_profile_id', $profile->id)
            ->first();

        $newStatus = ($record && in_array($record->status, ['contacted', 'claimed'], true))
            ? $record->status
            : 'interested';

        SeminarPromoParticipant::updateOrCreate(
            [
                'seminar_promo_id' => $promo->id,
                'seminar_profile_id' => $profile->id,
            ],
            [
                'is_interested' => true,
                'interested_at' => $record?->interested_at ?? now(),
                'participant_note' => $request->participant_note,
                'status' => $newStatus,
            ]
        );

        if ($profile->followup_status === 'new') {
            $profile->update(['followup_status' => 'interested']);
        }

        return redirect()->back()->with('success', 'Terima kasih! Ketertarikan Anda pada "' . $promo->title . '" telah dicatat. Tim admin kami akan segera menghubungi Anda.');
    }

    public function cancelInterest(SeminarPromo $promo)
    {
        $profile = $this->getProfile();

        $record = SeminarPromoParticipant::where('seminar_promo_id', $promo->id)
            ->where('seminar_profile_id', $profile->id)
            ->first();

        if (!$record) {
            return redirect()->back()->with('error', 'Data ketertarikan tidak ditemukan.');
        }

        if ($record->status === 'claimed') {
            return redirect()->back()->with('error', 'Promo yang sudah diklaim tidak dapat dibatalkan.');
        }

        if ($record->assigned_by_admin) {
            $record->update([
                'is_interested' => false,
                'status' => 'available',
            ]);
        } else {
            $record->delete();
        }

        return redirect()->back()->with('success', 'Status ketertarikan pada promo berhasil dibatalkan.');
    }

    public function profile()
    {
        $profile = $this->getProfile();
        $categories = SeminarCategory::active()->orderBy('name')->get();

        return view('seminar.profile', compact('profile', 'categories'));
    }

    public function updateProfile(Request $request)
    {
        $profile = $this->getProfile();
        $hasActiveCategories = SeminarCategory::active()->exists();

        $request->validate([
            'name' => 'required|string|max:255',
            'seminar_category_id' => $hasActiveCategories
                ? 'required|exists:seminar_categories,id'
                : 'nullable|exists:seminar_categories,id',
            'phone_number' => 'required|string|max:30',
            'institution' => 'required|string|max:255',
            'occupation' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update(['name' => $request->name]);

        $profile->update([
            'seminar_category_id' => $request->seminar_category_id ?: null,
            'phone_number' => $request->phone_number,
            'institution' => $request->institution,
            'occupation' => $request->occupation,
            'city' => $request->city,
            'notes' => $request->notes,
        ]);

        return redirect()->route('seminar.profile')->with('success', 'Profil peserta seminar berhasil diperbarui.');
    }
}
