<?php

namespace App\Traits;

trait HasBilingual
{
    /**
     * Get the translated attribute value based on active application locale.
     */
    public function getLocalized(string $field): string
    {
        $locale = app()->getLocale();
        $localizedField = $field . '_' . $locale;

        if (!empty($this->{$localizedField})) {
            return (string) $this->{$localizedField};
        }

        // Fallback to the other language if current is empty
        $fallback = $locale === 'gu' ? 'en' : 'gu';
        $fallbackField = $field . '_' . $fallback;

        return (string) ($this->{$fallbackField} ?? $this->{$field} ?? '');
    }
}
