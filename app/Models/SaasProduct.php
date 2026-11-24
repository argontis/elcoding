<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaasProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'tagline',
        'description',
        'thumbnail',
        'target_url',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}

