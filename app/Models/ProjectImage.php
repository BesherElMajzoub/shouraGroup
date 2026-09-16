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
            if (app()->getLocale() === 'en') {
                return $this->attributes['caption_en'] ?? null;
            }

            return $this->attributes['caption_ar'] ?? ($this->attributes['caption_en'] ?? null);
        });
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(get: fn () => public_media_url($this->image));
    }
}
