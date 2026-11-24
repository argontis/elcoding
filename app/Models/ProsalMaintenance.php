<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsalMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'tiket_code',
        'pelapor',
        'deskripsi_kendala',
        'prioritas',
        'biaya',
        'status',
        'tgl_lapor',
    ];

    protected $casts = [
        'biaya' => 'decimal:2',
        'tgl_lapor' => 'date',
    ];

    public function unit()
    {
        return $this->belongsTo(ProsalUnit::class, 'unit_id');
    }
}

