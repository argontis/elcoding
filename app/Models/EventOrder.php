<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventOrder extends Model
{
    protected $fillable = [
        'external_id',
        'user_name',
        'user_email',
        'user_phone',
        'amount',
        'status',
        'xendit_invoice_id',
        'xendit_invoice_url',
        'paid_at'
    ];
}
