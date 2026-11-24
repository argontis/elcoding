<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsalTenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'nama',
        'no_wa',
        'email',
        'ktp_nik',
        'tgl_masuk',
        'tgl_habis',
        'sewa_bulanan',
        'deposit',
        'status_pembayaran',
    ];

    protected $casts = [
        'sewa_bulanan' => 'decimal:2',
        'deposit' => 'decimal:2',
        'tgl_masuk' => 'date',
        'tgl_habis' => 'date',
    ];

    public function unit()
    {
        return $this->belongsTo(ProsalUnit::class, 'unit_id');
    }
}

