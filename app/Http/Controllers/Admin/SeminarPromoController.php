<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeminarCategory;
use App\Models\SeminarProfile;
use App\Models\SeminarPromo;
use App\Models\SeminarPromoParticipant;
use Illuminate\Http\Request;

class SeminarPromoController extends Controller
{
    public function index()
    {
        $promos = SeminarPromo::with('category')
            ->withCount([
                'promoParticipants as interested_count' => fn ($q) => $q->where('is_interested', true),
                'promoParticipants as assigned_count' => fn ($q) => $q->where('assigned_by_admin', true),
            ])
            ->latest()
            ->paginate(15);

        return view('admin.seminar.promos.index', compact('promos'));
    }

    public function create()
    {
        $categories = SeminarCategory::orderBy('name')->get();
        $participants = SeminarProfile::with(['user', 'category'])->latest()->get();

        return view('admin.seminar.promos.form', [
            'promo' => null,
            'categories' => $categories,
            'participants' => $participants,
            'selectedParticipantIds' => [],
            'targetScope' => 'all',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePromo($request);
        $benefits = $this->parseBenefits($request->input('benefits_text'));

        $scope = $validated['target_scope'];
        $isGlobal = $scope === 'all';
        $categoryId = $scope === 'category' ? $validated['seminar_category_id'] : null;

        $promo = SeminarPromo::create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'badge_text' => $validated['badge_text'] ?? null,
            'promo_code' => $validated['promo_code'] ?? null,
            'description' => $validated['description'],
            'benefits' => $benefits,
            'seminar_category_id' => $categoryId,
            'is_global' => $isGlobal,
            'valid_until' => $validated['valid_until'] ?? null,
            'cta_label' => ($validated['cta_label'] ?? null) ?: 'Saya Tertarik',
            'is_active' => $request->boolean('is_active', true),
        ]);

        if ($scope === 'specific') {
            $this->syncAssignedParticipants($promo, $validated['participant_ids'] ?? []);
        }

        return redirect()->route('admin.seminar.promos.index')->with('success', 'Promo & benefit seminar berhasil dibuat.');
    }

    public function edit($id)
    {
        $promo = SeminarPromo::findOrFail($id);
        $categories = SeminarCategory::orderBy('name')->get();
        $participants = SeminarProfile::with(['user', 'category'])->latest()->get();

        $selectedParticipantIds = SeminarPromoParticipant::where('seminar_promo_id', $promo->id)
            ->where('assigned_by_admin', true)
            ->pluck('seminar_profile_id')
            ->all();

        $targetScope = 'all';
        if ($promo->seminar_category_id) {
            $targetScope = 'category';
        } elseif (!$promo->is_global) {
            $targetScope = 'specific';
        }

        return view('admin.seminar.promos.form', compact(
            'promo',
            'categories',
            'participants',
            'selectedParticipantIds',
            'targetScope'
        ));
    }

    public function update(Request $request, $id)
    {
        $promo = SeminarPromo::findOrFail($id);
        $validated = $this->validatePromo($request);
        $benefits = $this->parseBenefits($request->input('benefits_text'));

        $scope = $validated['target_scope'];
        $isGlobal = $scope === 'all';
        $categoryId = $scope === 'category' ? $validated['seminar_category_id'] : null;

        $promo->update([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'badge_text' => $validated['badge_text'] ?? null,
            'promo_code' => $validated['promo_code'] ?? null,
            'description' => $validated['description'],
            'benefits' => $benefits,
            'seminar_category_id' => $categoryId,
            'is_global' => $isGlobal,
            'valid_until' => $validated['valid_until'] ?? null,
            'cta_label' => ($validated['cta_label'] ?? null) ?: 'Saya Tertarik',
            'is_active' => $request->boolean('is_active', false),
        ]);

        if ($scope === 'specific') {
            $this->syncAssignedParticipants($promo, $validated['participant_ids'] ?? []);
        } else {
            SeminarPromoParticipant::where('seminar_promo_id', $promo->id)
                ->where('assigned_by_admin', true)
                ->where('is_interested', false)
                ->delete();
        }

        return redirect()->route('admin.seminar.promos.index')->with('success', 'Promo & benefit seminar berhasil diperbarui.');
    }

    public function toggleActive($id)
    {
        $promo = SeminarPromo::findOrFail($id);
        $promo->update(['is_active' => !$promo->is_active]);

        return redirect()->route('admin.seminar.promos.index')->with('success', 'Status promo berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $promo = SeminarPromo::findOrFail($id);
        $promo->delete();

        return redirect()->route('admin.seminar.promos.index')->with('success', 'Promo & benefit berhasil dihapus.');
    }

    private function validatePromo(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:promo,benefit,discount,voucher',
            'badge_text' => 'nullable|string|max:60',
            'promo_code' => 'nullable|string|max:60',
            'description' => 'required|string',
            'benefits_text' => 'nullable|string',
            'target_scope' => 'required|string|in:all,category,specific',
            'seminar_category_id' => 'required_if:target_scope,category|nullable|exists:seminar_categories,id',
            'participant_ids' => 'required_if:target_scope,specific|array',
            'participant_ids.*' => 'exists:seminar_profiles,id',
            'valid_until' => 'nullable|date',
            'cta_label' => 'nullable|string|max:60',
        ]);
    }

    private function parseBenefits(?string $text): array
    {
        if (!$text) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $text))));
    }

    private function syncAssignedParticipants(SeminarPromo $promo, array $participantIds): void
    {
        $participantIds = array_map('intval', $participantIds);

        SeminarPromoParticipant::where('seminar_promo_id', $promo->id)
            ->where('assigned_by_admin', true)
            ->whereNotIn('seminar_profile_id', $participantIds)
            ->each(function (SeminarPromoParticipant $item) {
                if ($item->is_interested) {
                    $item->update(['assigned_by_admin' => false]);
                } else {
                    $item->delete();
                }
            });

        foreach ($participantIds as $profileId) {
            SeminarPromoParticipant::updateOrCreate(
                [
                    'seminar_promo_id' => $promo->id,
                    'seminar_profile_id' => $profileId,
                ],
                [
                    'assigned_by_admin' => true,
                ]
            );
        }
    }
}
