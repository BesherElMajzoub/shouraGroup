<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasLocalizedFields;

    /**
     * These values are shared by both locales. In particular, uploaded media
     * must never be read from value_en, which may be empty or contain an older
     * path after an administrator replaces an image.
     */
    private const NON_LOCALIZED_VALUE_KEYS = [
        'home_about_main_image',
        'home_about_secondary_image',
        'home_about_logo',
        'story_overview_image',
        'contact_email',
        'sales_email',
        'hr_email',
        'phone_main',
        'contact_whatsapp',
        'wholesale_whatsapp',
    ];

    protected array $localizedFields = ['value'];

    protected $fillable = ['key', 'value', 'value_en', 'group'];

    public static function isLocalizedValueKey(string $key): bool
    {
        return ! in_array($key, self::NON_LOCALIZED_VALUE_KEYS, true);
    }

    protected function shouldLocalizeField(string $field): bool
    {
        return $field !== 'value'
            || self::isLocalizedValueKey($this->key);
    }

    protected static function booted()
    {
        static::saved(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget("setting.{$setting->key}.ar");
            Cache::forget("setting.{$setting->key}.en");
            Cache::forget("setting.shared.{$setting->key}");
        });

        static::deleted(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget("setting.{$setting->key}.ar");
            Cache::forget("setting.{$setting->key}.en");
            Cache::forget("setting.shared.{$setting->key}");
        });
    }
}
