<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'syllabus' => 'array',
    ];

    /**
     * Set the price_amount attribute based on the string price.
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value;
        
        if (!$value) {
            $this->attributes['price_amount'] = 0;
            return;
        }

        $priceStr = preg_replace('/[^0-9]/', '', $value);
        $this->attributes['price_amount'] = $priceStr ? (int) $priceStr : 0;
    }
}
