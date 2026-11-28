<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SeminarCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'event_date',
        'location',
        'badge_color',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'event_date' => 'date',
        ];
    }

    public function profiles()
    {
        return $this->hasMany(SeminarProfile::class, 'seminar_category_id');
    }

    public function promos()
    {
        return $this->hasMany(SeminarPromo::class, 'seminar_category_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
