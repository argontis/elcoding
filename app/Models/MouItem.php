<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MouItem extends Model
{
    protected $guarded = [];

    public function mou()
    {
        return $this->belongsTo(Mou::class);
    }
}
