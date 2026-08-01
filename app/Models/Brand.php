<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Brand extends Model
{
    protected $fillable = [
        'name', 'slug', 'country', 'description', 'logo',
        'is_agency', 'show_on_home', 'order', 'is_active',
    ];

    protected $casts = [
        'is_agency' => 'boolean',
        'show_on_home' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function sectors()
    {
        return $this->belongsToMany(Sector::class)->orderBy('order');
    }

    /**
     * Null when no logo file is set, so views can fall back to a text card.
     */
    protected function logoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $path = $this->logo;
                if (empty($path)) {
                    return null;
                }
                if (str_starts_with($path, 'images/') || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                    return asset($path);
                }
                return asset('storage/' . $path);
            }
        );
    }
}
