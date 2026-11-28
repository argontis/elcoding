<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeminarPromoParticipant extends Model
{
    protected $fillable = [
        'seminar_promo_id',
        'seminar_profile_id',
        'assigned_by_admin',
        'is_interested',
        'interested_at',
        'participant_note',
        'status',
        'contacted_at',
        'admin_note',
    ];

    protected function casts(): array
    {
        return [
            'assigned_by_admin' => 'boolean',
            'is_interested' => 'boolean',
            'interested_at' => 'datetime',
            'contacted_at' => 'datetime',
        ];
    }

    public function promo()
    {
        return $this->belongsTo(SeminarPromo::class, 'seminar_promo_id');
    }

    public function profile()
    {
        return $this->belongsTo(SeminarProfile::class, 'seminar_profile_id');
    }
}
