<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SeminarPromo extends Model
{
    protected $fillable = [
        'title',
        'type',
        'badge_text',
        'promo_code',
        'description',
        'benefits',
        'seminar_category_id',
        'is_global',
        'valid_until',
        'cta_label',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'benefits' => 'array',
            'is_global' => 'boolean',
            'is_active' => 'boolean',
            'valid_until' => 'date',
        ];
    }

    public function category()
    {
        return $this->belongsTo(SeminarCategory::class, 'seminar_category_id');
    }

    public function promoParticipants()
    {
        return $this->hasMany(SeminarPromoParticipant::class, 'seminar_promo_id');
    }

    public function participants()
    {
        return $this->belongsToMany(SeminarProfile::class, 'seminar_promo_participants', 'seminar_promo_id', 'seminar_profile_id')
            ->withPivot([
                'assigned_by_admin',
                'is_interested',
                'interested_at',
                'participant_note',
                'status',
                'contacted_at',
                'admin_note',
            ])
            ->withTimestamps();
    }

    public function scopeAvailableFor(Builder $query, SeminarProfile $profile): Builder
    {
        return $query->where('is_active', true)
            ->where(function (Builder $q) {
                $q->whereNull('valid_until')
                    ->orWhereDate('valid_until', '>=', now()->toDateString());
            })
            ->where(function (Builder $q) use ($profile) {
                $q->where(function (Builder $globalQ) {
                    $globalQ->where('is_global', true)
                        ->whereNull('seminar_category_id');
                });

                if ($profile->seminar_category_id) {
                    $q->orWhere('seminar_category_id', $profile->seminar_category_id);
                }

                $q->orWhereHas('promoParticipants', function (Builder $pp) use ($profile) {
                    $pp->where('seminar_profile_id', $profile->id)
                        ->where('assigned_by_admin', true);
                });
            });
    }
}
