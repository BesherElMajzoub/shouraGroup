<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Sector extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['name', 'tagline', 'intro', 'specialties'];

    protected $fillable = [
        'name', 'name_en', 'slug', 'email', 'whatsapp', 'tagline', 'tagline_en', 'intro', 'intro_en', 'specialties', 'specialties_en',
        'icon', 'image', 'is_coming_soon', 'order', 'is_active',
    ];

    protected $casts = [
        'specialties' => 'array',
        'specialties_en' => 'array',
        'is_coming_soon' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class)->orderBy('order');
    }

    /**
     * Sector enquiries reach the sector inbox, falling back to the central one.
     */
    protected function contactEmail(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->email ?: setting('contact_email')
        );
    }

    /**
     * WhatsApp number for this sector in wa.me form (digits only), falling back
     * to the central number; null when neither is configured.
     */
    protected function contactWhatsapp(): Attribute
    {
        return Attribute::make(
            get: function () {
                $number = preg_replace('/\D/', '', $this->whatsapp ?: (string) setting('contact_whatsapp'));

                return $number ?: null;
            }
        );
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
