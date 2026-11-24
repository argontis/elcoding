<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BengkelCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_wa',
        'plat_nomor',
        'model_kendaraan',
        'total_kunjungan',
    ];

    protected $casts = [
        'total_kunjungan' => 'integer',
    ];
}

