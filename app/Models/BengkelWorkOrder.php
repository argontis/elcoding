<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BengkelWorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_wo',
        'customer_name',
        'customer_phone',
        'vehicle_plate',
        'vehicle_model',
        'service_package',
        'estimasi_biaya',
        'pit_bay',
        'mekanik',
        'status',
        'keluhan',
        'entry_time',
        'completed_time',
    ];

    protected $casts = [
        'estimasi_biaya' => 'decimal:2',
        'entry_time' => 'datetime',
        'completed_time' => 'datetime',
    ];
}

