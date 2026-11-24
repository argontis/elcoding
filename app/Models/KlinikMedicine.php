<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlinikMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'kategori',
        'stok',
        'satuan',
        'harga',
        'expired_date',
    ];

    protected $casts = [
        'stok' => 'integer',
        'harga' => 'decimal:2',
        'expired_date' => 'date',
    ];
}

