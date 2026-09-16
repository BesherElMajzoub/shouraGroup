<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('public_media_url')) {
    /**
     * Build a URL for an uploaded file stored on the public disk.
     */
    function public_media_url(string $path): string
    {
        return route('media.show', ['path' => ltrim($path, '/')]);
    }
}

if (! function_exists('setting')) {
    /**
     * Get a setting value by key.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
            try {
                $setting = Setting::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            } catch (\Exception $e) {
                // Return default if DB table doesn't exist yet (e.g. during migrations)
                return $default;
            }
        });
    }
}

if (! function_exists('localized_content')) {
    /**
     * Translate CMS-authored Arabic content for the active public locale.
     *
     * Static interface copy belongs in the regular language files. This helper
     * is for values that come from the database and therefore cannot be passed
     * to Laravel's translator by key (for example service names in URLs).
     */
    function localized_content(?string $value): ?string
    {
        if ($value === null || app()->getLocale() !== 'en') {
            return $value;
        }

        $translations = trans('site');

        return is_array($translations) ? strtr($value, $translations) : $value;
    }
}
