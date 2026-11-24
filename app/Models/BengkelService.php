<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BengkelService extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_servis',
        'nama_servis',
        'kategori',
        'harga',
        'durasi_menit',
        'deskripsi',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'durasi_menit' => 'integer',
    ];
}

