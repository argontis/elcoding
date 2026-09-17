<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklAttendance extends Model
{
    use HasFactory;

    protected $table = 'pkl_attendances';

    protected $fillable = [
        'user_id',
        'date',
        'check_in',
        'check_out',
        'status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
