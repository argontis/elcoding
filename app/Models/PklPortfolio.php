<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklPortfolio extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function profile()
    {
        return $this->belongsTo(PklProfile::class, 'pkl_profile_id');
    }
}
