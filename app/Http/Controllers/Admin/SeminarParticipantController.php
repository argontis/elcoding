<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeminarCategory;
use App\Models\SeminarContactLog;
use App\Models\SeminarProfile;
use App\Models\SeminarPromo;
use App\Models\SeminarPromoParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeminarParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = SeminarProfile::with([
            'user',
            'category',
            'promoParticipants.promo',
            'contactLogs',
        ]);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                })
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%");
            });
        }

        if ($request->filled('seminar_category_id')) {
            $query->where('seminar_category_id', $request->seminar_category_id);
        }

        if ($request->filled('followup_status')) {
            $query->where('followup_status', $request->followup_status);
        }

        if ($request->interest === 'interested') {
            $query->whereHas('promoParticipants', fn ($q) => $q->where('is_interested', true));
        } elseif ($request->interest === 'not_interested') {
            $query->whereDoesntHave('promoParticipants', fn ($q) => $q->where('is_interested', true));
        }

        $participants = $query->latest()->paginate(15)->withQueryString();
        $categories = SeminarCategory::orderBy('name')->get();

        $summary = [
            'total' => SeminarProfile::count(),
            'interested' => SeminarProfile::whereHas('promoParticipants', fn ($q) => $q->where('is_interested', true))->count(),
            'contacted' => SeminarProfile::where('followup_status', 'contacted')->count(),
            'converted' => SeminarProfile::where('followup_status', 'converted')->count(),
        ];

        return view('admin.seminar.participants.index', compact('participants', 'categories', 'summary'));
    }

    public function show($id)
    {
        $profile = SeminarProfile::with([
            'user',
            'category',
            'promoParticipants.promo.category',
            'contactLogs.admin',
        ])->findOrFail($id);

        $availablePromos = SeminarPromo::where('is_active', true)->orderBy('title')->get();
        $matchingPromos = SeminarPromo::availableFor($profile)->get();

        return view('admin.seminar.participants.show', compact('profile', 'availablePromos', 'matchingPromos'));
    }

    public function updateStatus(Request $request, $id)
    {
        $profile = SeminarProfile::findOrFail($id);

        $request->validate([
            'followup_status' => 'required|string|in:new,interested,contacted,converted,closed',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $profile->update([
            'followup_status' => $request->followup_status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->back()->with('success', 'Status follow-up peserta berhasil diperbarui.');
    }

    public function assignPromo(Request $request, $id)
    {
        $profile = SeminarProfile::findOrFail($id);

        $request->validate([
            'seminar_promo_id' => 'required|exists:seminar_promos,id',
            'admin_note' => 'nullable|string|max:500',
        ]);

        SeminarPromoParticipant::updateOrCreate(
            [
                'seminar_promo_id' => $request->seminar_promo_id,
                'seminar_profile_id' => $profile->id,
            ],
            [
                'assigned_by_admin' => true,
                'admin_note' => $request->admin_note,
            ]
        );

        return redirect()->back()->with('success', 'Promo & benefit khusus berhasil diberikan kepada peserta.');
    }

    public function removePromo($id, $promoParticipantId)
    {
        $profile = SeminarProfile::findOrFail($id);

        $item = SeminarPromoParticipant::where('seminar_profile_id', $profile->id)
            ->findOrFail($promoParticipantId);

        if ($item->is_interested) {
            $item->update(['assigned_by_admin' => false]);
        } else {
            $item->delete();
        }

        return redirect()->back()->with('success', 'Penugasan promo untuk peserta berhasil dihapus.');
    }

    public function updatePromoStatus(Request $request, $id, $promoParticipantId)
    {
        $profile = SeminarProfile::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:available,interested,contacted,claimed,declined',
            'admin_note' => 'nullable|string|max:500',
        ]);

        $item = SeminarPromoParticipant::where('seminar_profile_id', $profile->id)
            ->findOrFail($promoParticipantId);

        $item->update([
            'status' => $request->status,
            'admin_note' => $request->admin_note,
            'contacted_at' => in_array($request->status, ['contacted', 'claimed'], true)
                ? ($item->contacted_at ?? now())
                : $item->contacted_at,
        ]);

        if ($request->status === 'claimed' && $profile->followup_status !== 'converted') {
            $profile->update(['followup_status' => 'converted']);
        } elseif ($request->status === 'contacted' && in_array($profile->followup_status, ['new', 'interested'], true)) {
            $profile->update(['followup_status' => 'contacted']);
        }

        return redirect()->back()->with('success', 'Status promo peserta berhasil diperbarui.');
    }

    public function logContact(Request $request, $id)
    {
        $profile = SeminarProfile::with('user')->findOrFail($id);

        $request->validate([
            'channel' => 'required|string|in:whatsapp,email,phone',
            'message' => 'nullable|string|max:2000',
        ]);

        SeminarContactLog::create([
            'seminar_profile_id' => $profile->id,
            'admin_id' => Auth::id(),
            'channel' => $request->channel,
            'message' => $request->message,
        ]);

        $updates = [
            'last_contacted_at' => now(),
            'contact_count' => $profile->contact_count + 1,
        ];

        if (in_array($profile->followup_status, ['new', 'interested'], true)) {
            $updates['followup_status'] = 'contacted';
        }

        $profile->update($updates);

        $profile->promoParticipants()
            ->where('is_interested', true)
            ->where('status', 'interested')
            ->update([
                'status' => 'contacted',
                'contacted_at' => now(),
            ]);

        $launchUrl = null;
        if ($request->channel === 'whatsapp' && $profile->whatsapp_number) {
            $text = $request->message ?: ('Halo ' . ($profile->user->name ?? 'Peserta') . ', terima kasih telah mengikuti seminar kami.');
            $launchUrl = 'https://wa.me/' . $profile->whatsapp_number . '?text=' . urlencode($text);
        } elseif ($request->channel === 'email' && $profile->user?->email) {
            $subject = 'Info Promo & Benefit Seminar - Elcoding';
            $body = $request->message ?: ('Halo ' . ($profile->user->name ?? 'Peserta') . ', berikut informasi promo & benefit seminar untuk Anda.');
            $launchUrl = 'mailto:' . $profile->user->email . '?subject=' . rawurlencode($subject) . '&body=' . rawurlencode($body);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'launch_url' => $launchUrl,
                'message' => 'Riwayat kontak berhasil dicatat.',
            ]);
        }

        return redirect()->back()->with('success', 'Riwayat kontak peserta berhasil dicatat.');
    }

    public function destroy($id)
    {
        $profile = SeminarProfile::with('user')->findOrFail($id);
        $user = $profile->user;

        $profile->delete();
        if ($user && $user->isSeminarParticipant()) {
            $user->delete();
        }

        return redirect()->route('admin.seminar.participants.index')->with('success', 'Data peserta seminar berhasil dihapus.');
    }
}
