<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PklMaterial extends Model
{
    protected $fillable = [
        'pkl_profile_id',
        'title',
        'file_path',
    ];

    public function profile()
    {
        return $this->belongsTo(PklProfile::class, 'pkl_profile_id');
    }
}
