<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    protected $fillable = ['category_id', 'title', 'client', 'location', 'year', 'description', 'image', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
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
                return public_media_url($path);
            }
        );
    }
}
