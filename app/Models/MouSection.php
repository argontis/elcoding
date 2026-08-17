<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MouSection extends Model
{
    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
    ];

    public function mou()
    {
        return $this->belongsTo(Mou::class);
    }
}
