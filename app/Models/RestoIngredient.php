<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestoIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'stok',
        'satuan',
        'minimum_stok',
        'harga_satuan',
    ];

    protected $casts = [
        'stok' => 'decimal:2',
        'minimum_stok' => 'decimal:2',
        'harga_satuan' => 'decimal:2',
    ];
}

