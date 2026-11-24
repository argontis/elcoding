<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbelSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'mata_pelajaran',
        'tutor',
        'ruangan',
        'kapasitas',
    ];

    protected $casts = [
        'kapasitas' => 'integer',
    ];
}

