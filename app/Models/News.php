<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class News extends Model
{
    protected $fillable = ['category_id', 'title_ar', 'title_en', 'slug', 'excerpt_ar', 'excerpt_en', 'body_ar', 'body_en', 'image', 'published_at', 'is_published', 'order'];

    protected $casts = [
        'is_published' => 'boolean',
        'order' => 'integer',
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Locale-aware display value: the English column when the site is in
     * English AND an English translation has been entered, Arabic otherwise.
     * Lets every existing $news->title / ->excerpt / ->body call keep working
     * unchanged while the admin form now captures both languages.
     */
    protected function title(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('title'));
    }

    protected function excerpt(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('excerpt'));
    }

    protected function body(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('body'));
    }

    private function localized(string $field): ?string
    {
        if (app()->getLocale() === 'en' && filled($this->attributes[$field.'_en'] ?? null)) {
            return $this->attributes[$field.'_en'];
        }

        return $this->attributes[$field.'_ar'] ?? null;
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
