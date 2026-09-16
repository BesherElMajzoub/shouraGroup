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
            if (app()->getLocale() === 'en') {
                // English pages must never leak Arabic content. Optional empty
                // translations stay empty and are handled by the view.
                return parent::getAttribute($key.'_en');
            }

            $value = parent::getAttribute($key);

            return filled($value) ? $value : parent::getAttribute($key.'_en');
        }

        return parent::getAttribute($key);
    }
}
