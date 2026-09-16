<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Service extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['title', 'dept', 'description', 'features'];

    protected $fillable = ['title', 'title_en', 'dept', 'dept_en', 'whatsapp', 'group', 'description', 'description_en', 'icon', 'image', 'features', 'features_en', 'order', 'is_active'];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * WhatsApp number for this service in wa.me format. A service without its
     * own number uses the general contact number configured in the CMS.
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
                    return asset('images/industrial_bg.png'); // fallback default
                }
                if (str_starts_with($path, 'images/') || str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                    return asset($path);
                }
                return public_media_url($path);
            }
        );
    }
}
