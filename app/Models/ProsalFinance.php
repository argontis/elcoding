<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsalFinance extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'tipe',
        'kategori',
        'keterangan',
        'nominal',
        'tanggal',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'tanggal' => 'date',
    ];
}

