<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlinikPatient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_rm',
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'golongan_darah',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function queues()
    {
        return $this->hasMany(KlinikQueue::class, 'patient_id');
    }
}

