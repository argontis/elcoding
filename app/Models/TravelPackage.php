<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_paket',
        'nama',
        'kategori',
        'durasi',
        'tanggal_berangkat',
        'kuota_total',
        'kuota_terisi',
        'harga',
        'status',
        'tour_leader',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'tanggal_berangkat' => 'date',
        'kuota_total' => 'integer',
        'kuota_terisi' => 'integer',
    ];

    public function participants()
    {
        return $this->hasMany(TravelParticipant::class, 'package_id');
    }
}

