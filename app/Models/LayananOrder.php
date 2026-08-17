<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananOrder extends Model
{
    protected $guarded = [];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}
