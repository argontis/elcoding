<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklQuiz extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'quiz_date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(PklProfile::class, 'pkl_profile_id');
    }
}
