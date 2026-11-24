<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmDeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'judul_deal',
        'tahap_pipeline',
        'nominal',
        'probabilitas',
        'estimasi_closing',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'probabilitas' => 'integer',
        'estimasi_closing' => 'date',
    ];

    public function lead()
    {
        return $this->belongsTo(CrmLead::class, 'lead_id');
    }
}

