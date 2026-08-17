<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $guarded = [];

    protected $casts = [
        'features_main' => 'array',
        'pricing_includes' => 'array',
        'features_full' => 'array',
    ];
}
