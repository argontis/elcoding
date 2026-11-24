<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'perusahaan',
        'email',
        'no_wa',
        'status',
        'nilai_potensial',
        'sumber',
        'sales_owner',
    ];

    protected $casts = [
        'nilai_potensial' => 'decimal:2',
    ];

    public function deals()
    {
        return $this->hasMany(CrmDeal::class, 'lead_id');
    }
}

