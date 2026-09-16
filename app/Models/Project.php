<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'category_id', 'slug', 'title_ar', 'title_en', 'client_ar', 'client_en',
        'location_ar', 'location_en', 'year', 'status_ar', 'status_en',
        'summary_ar', 'summary_en', 'description_ar', 'description_en',
        'challenge_ar', 'challenge_en', 'solution_ar', 'solution_en',
        'scope_ar', 'scope_en', 'equipment_ar', 'equipment_en',
        'duration_ar', 'duration_en', 'results_ar', 'results_en',
        'image', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order')->orderBy('id');
    }

    protected function title(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('title'));
    }

    protected function client(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('client'));
    }

    protected function location(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('location'));
    }

    protected function status(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('status'));
    }

    protected function summary(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('summary') ?: $this->localized('description'));
    }

    protected function description(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('description'));
    }

    protected function challenge(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('challenge'));
    }

    protected function solution(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('solution'));
    }

    protected function scope(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('scope'));
    }

    protected function equipment(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('equipment'));
    }

    protected function duration(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('duration'));
    }

    protected function results(): Attribute
    {
        return Attribute::make(get: fn () => $this->localized('results'));
    }

    private function localized(string $field): ?string
    {
        $preferred = app()->getLocale() === 'en' ? $field.'_en' : $field.'_ar';
        $fallback = app()->getLocale() === 'en' ? $field.'_ar' : $field.'_en';

        return $this->attributes[$preferred] ?: ($this->attributes[$fallback] ?? null);
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
