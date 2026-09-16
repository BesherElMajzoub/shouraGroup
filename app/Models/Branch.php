<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['name', 'city', 'address', 'description'];

    protected $fillable = [
        'name', 'name_en', 'city', 'city_en', 'address', 'address_en', 'description', 'description_en', 'phone', 'mobile',
        'map_top', 'map_left', 'map_embed', 'order', 'is_active',
    ];

    protected $casts = [
        'map_top' => 'float',
        'map_left' => 'float',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
