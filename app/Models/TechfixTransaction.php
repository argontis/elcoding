<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechfixTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_transaksi',
        'ticket_id',
        'total',
        'metode_pembayaran',
        'status',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function ticket()
    {
        return $this->belongsTo(TechfixTicket::class, 'ticket_id');
    }
}

