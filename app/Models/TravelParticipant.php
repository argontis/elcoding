<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'kode_jamaah',
        'nama',
        'no_wa',
        'paspor',
        'status_dokumen',
        'status_pembayaran',
        'total_tagihan',
        'tanggal_daftar',
    ];

    protected $casts = [
        'total_tagihan' => 'decimal:2',
        'tanggal_daftar' => 'date',
    ];

    public function package()
    {
        return $this->belongsTo(TravelPackage::class, 'package_id');
    }
}

