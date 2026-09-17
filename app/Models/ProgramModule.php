<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramModule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function program()
    {
        return $this->belongsTo(ProgramKursus::class, 'program_id');
    }

    public function studentProgress()
    {
        return $this->hasMany(PklStudentProgress::class, 'program_module_id');
    }
}
