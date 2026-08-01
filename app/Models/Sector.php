<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sector extends Model
{
    protected $fillable = [
        'name', 'slug', 'tagline', 'intro', 'specialties',
        'icon', 'image', 'is_coming_soon', 'order', 'is_active',
    ];

    protected $casts = [
        'specialties' => 'array',
        'is_coming_soon' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class)->orderBy('order');
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $path = $this->image;
                if (empty($path)) {
                    return asset('images/industrial_bg.png');
                }
                if (str_starts_with($path, 'images/') || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                    return asset($path);
                }
                return asset('storage/' . $path);
            }
        );
    }
}
