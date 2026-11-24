<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestoMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_menu',
        'nama',
        'kategori',
        'harga',
        'status',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];
}

