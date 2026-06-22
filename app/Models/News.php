<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class News extends Model
{
    protected $fillable = ['category_id', 'title', 'slug', 'excerpt', 'body', 'image', 'published_at', 'is_published', 'order'];

    protected $casts = [
        'is_published' => 'boolean',
        'order' => 'integer',
        'published_at' => 'datetime',
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
                return asset('storage/' . $path);
            }
        );
    }
}
