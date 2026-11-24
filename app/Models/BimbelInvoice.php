<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbelInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'nomor_tagihan',
        'bulan',
        'nominal',
        'status_pembayaran',
        'jatuh_tempo',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'jatuh_tempo' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(BimbelStudent::class, 'student_id');
    }
}

