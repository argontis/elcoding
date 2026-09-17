<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklStudentProgress extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function pklProfile()
    {
        return $this->belongsTo(PklProfile::class, 'pkl_profile_id');
    }

    public function module()
    {
        return $this->belongsTo(ProgramModule::class, 'program_module_id');
    }
}
