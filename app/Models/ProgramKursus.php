<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKursus extends Model
{
    protected $guarded = [];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Parse numeric amount from string price (e.g., 'Rp2.500.000' -> 2500000)
     */
    public function getPriceAmountAttribute()
    {
        if (!$this->price) {
            return 0;
        }
        $priceStr = preg_replace('/[^0-9]/', '', $this->price);
        return (int) $priceStr;
    }
}
