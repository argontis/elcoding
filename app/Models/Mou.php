<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(MouItem::class);
    }

    public function sections()
    {
        return $this->hasMany(MouSection::class)->orderBy('order');
    }
}
