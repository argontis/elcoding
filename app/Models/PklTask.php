<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklTask extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'due_date' => 'date',
        'submitted_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->belongsTo(PklProfile::class, 'pkl_profile_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
