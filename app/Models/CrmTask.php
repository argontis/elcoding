<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrmTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tipe',
        'prioritas',
        'due_date',
        'status',
        'assigned_to',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];
}

