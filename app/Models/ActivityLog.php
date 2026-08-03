<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['type', 'title', 'description', 'color', 'icon'];

    public static function add($type, $title, $description = null, $color = 'blue', $icon = 'fa-info-circle')
    {
        return self::create([
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'color' => $color,
            'icon' => $icon,
        ]);
    }
}
