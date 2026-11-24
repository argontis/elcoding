<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechfixTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_tiket',
        'customer_name',
        'customer_phone',
        'device_type',
        'device_brand',
        'device_model',
        'serial_number',
        'keluhan',
        'status',
        'estimasi_biaya',
        'teknisi',
        'garansi_hari',
    ];

    protected $casts = [
        'estimasi_biaya' => 'decimal:2',
        'garansi_hari' => 'integer',
    ];

    public function transactions()
    {
        return $this->hasMany(TechfixTransaction::class, 'ticket_id');
    }
}

