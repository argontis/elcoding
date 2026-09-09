<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklHistory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(PklProfile::class, 'pkl_profile_id');
    }
}
