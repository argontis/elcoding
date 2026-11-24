<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlinikQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'nomor_antrean',
        'poli',
        'dokter',
        'status',
        'waktu_daftar',
    ];

    protected $casts = [
        'waktu_daftar' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(KlinikPatient::class, 'patient_id');
    }
}

