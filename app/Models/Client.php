<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Client extends Model
{
    protected $fillable = ['name', 'logo', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected function logoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $path = $this->logo;
                if (empty($path)) {
                    // Null lets views fall back to a text card instead of showing Shora's own logo.
                    return null;
                }
                if (str_starts_with($path, 'images/') || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                    return asset($path);
                }
                return public_media_url($path);
            }
        );
    }
}
