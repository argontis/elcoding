<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelFleet extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_armada',
        'nama_kendaraan',
        'kapasitas',
        'plat_nomor',
        'vendor',
        'status',
        'driver',
        'rute_tujuan',
    ];
}

