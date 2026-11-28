<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeminarContactLog extends Model
{
    protected $fillable = [
        'seminar_profile_id',
        'admin_id',
        'channel',
        'message',
    ];

    public function profile()
    {
        return $this->belongsTo(SeminarProfile::class, 'seminar_profile_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
