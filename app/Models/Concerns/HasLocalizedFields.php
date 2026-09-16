<?php

namespace App\Models\Concerns;

trait HasLocalizedFields
{
    /**
     * Return the active locale's database column for declared translatable fields.
     *
     * Arabic remains in the legacy column for backwards compatibility; English
     * is stored in the matching *_en column. Direct access to either physical
     * column (for admin forms) is never altered.
     */
    public function getAttribute($key)
    {
        if (is_string($key)
            && ! request()->is('admin*')
            && ! str_ends_with($key, '_en')
            && in_array($key, $this->localizedFields ?? [], true)) {
            $preferred = app()->getLocale() === 'en' ? $key.'_en' : $key;
            $fallback = app()->getLocale() === 'en' ? $key : $key.'_en';
            $value = parent::getAttribute($preferred);

            return filled($value) ? $value : parent::getAttribute($fallback);
        }

        return parent::getAttribute($key);
    }
}
