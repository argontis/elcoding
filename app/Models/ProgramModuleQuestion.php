<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramModuleQuestion extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'options' => 'array',
    ];

    public function module()
    {
        return $this->belongsTo(ProgramModule::class, 'program_module_id');
    }
}
