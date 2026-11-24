<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsalUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_code',
        'nama',
        'kategori',
        'lokasi',
        'tipe',
        'harga',
        'status',
        'penyewa',
        'jatuh_tempo',
        'catatan',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'jatuh_tempo' => 'date',
    ];

    public function tenants()
    {
        return $this->hasMany(ProsalTenant::class, 'unit_id');
    }

    public function maintenances()
    {
        return $this->hasMany(ProsalMaintenance::class, 'unit_id');
    }
}

