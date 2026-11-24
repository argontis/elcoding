<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestoOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_order',
        'nomor_meja',
        'tipe_order',
        'customer_name',
        'total',
        'status',
        'status_pembayaran',
        'metode_pembayaran',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];
}

