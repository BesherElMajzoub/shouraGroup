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
        $locale = app()->getLocale();

        return Cache::rememberForever("setting.{$key}.{$locale}", function () use ($key, $default) {
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
