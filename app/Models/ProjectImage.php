<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = ['image', 'caption_ar', 'caption_en', 'order'];

    protected $casts = [
        'order' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected function caption(): Attribute
    {
        return Attribute::make(get: function () {
            $preferred = app()->getLocale() === 'en' ? 'caption_en' : 'caption_ar';
            $fallback = app()->getLocale() === 'en' ? 'caption_ar' : 'caption_en';

            return $this->attributes[$preferred] ?: ($this->attributes[$fallback] ?? null);
        });
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(get: fn () => public_media_url($this->image));
    }
}
