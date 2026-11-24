<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechfixPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_part',
        'nama_part',
        'kategori',
        'stok',
        'harga_beli',
        'harga_jual',
    ];

    protected $casts = [
        'stok' => 'integer',
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2',
    ];
}

