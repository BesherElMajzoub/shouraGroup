<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasLocalizedFields;

    protected array $localizedFields = ['value'];

    protected $fillable = ['key', 'value', 'value_en', 'group'];

    protected static function booted()
    {
        static::saved(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget("setting.{$setting->key}.ar");
            Cache::forget("setting.{$setting->key}.en");
        });

        static::deleted(function ($setting) {
            Cache::forget("setting.{$setting->key}");
            Cache::forget("setting.{$setting->key}.ar");
            Cache::forget("setting.{$setting->key}.en");
        });
    }
}
