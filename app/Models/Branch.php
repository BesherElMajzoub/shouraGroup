<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name', 'city', 'address', 'description', 'phone', 'mobile',
        'map_top', 'map_left', 'map_embed', 'order', 'is_active',
    ];

    protected $casts = [
        'map_top' => 'float',
        'map_left' => 'float',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
