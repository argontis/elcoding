<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlinikDoctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'spesialisasi',
        'jadwal_praktek',
        'ruangan',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}

