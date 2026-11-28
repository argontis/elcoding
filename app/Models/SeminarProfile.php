<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeminarProfile extends Model
{
    protected $fillable = [
        'user_id',
        'seminar_category_id',
        'phone_number',
        'institution',
        'occupation',
        'city',
        'notes',
        'followup_status',
        'admin_notes',
        'last_contacted_at',
        'contact_count',
    ];

    protected function casts(): array
    {
        return [
            'last_contacted_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(SeminarCategory::class, 'seminar_category_id');
    }

    public function promoParticipants()
    {
        return $this->hasMany(SeminarPromoParticipant::class, 'seminar_profile_id');
    }

    public function promos()
    {
        return $this->belongsToMany(SeminarPromo::class, 'seminar_promo_participants', 'seminar_profile_id', 'seminar_promo_id')
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

    public function contactLogs()
    {
        return $this->hasMany(SeminarContactLog::class, 'seminar_profile_id')->latest();
    }

    public function getWhatsappNumberAttribute(): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->phone_number);
        if ($digits === '') {
            return null;
        }
        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }
        if (str_starts_with($digits, '8')) {
            return '62' . $digits;
        }
        return $digits;
    }
}
