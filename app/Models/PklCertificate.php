<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklCertificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function profile()
    {
        return $this->belongsTo(PklProfile::class, 'pkl_profile_id');
    }
}
