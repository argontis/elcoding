<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbelStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'program',
        'no_wa',
        'nama_ortu',
        'status',
        'tanggal_daftar',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
    ];

    public function invoices()
    {
        return $this->hasMany(BimbelInvoice::class, 'student_id');
    }
}

