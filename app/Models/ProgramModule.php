<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramModule extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
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

    public function questions()
    {
        return $this->hasMany(ProgramModuleQuestion::class, 'program_module_id');
    }
}
