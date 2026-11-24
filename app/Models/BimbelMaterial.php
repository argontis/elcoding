<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbelMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'tingkat',
        'tipe_materi',
        'file_url',
    ];
}

