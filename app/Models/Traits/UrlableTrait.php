<?php

namespace App\Models\Traits;

trait UrlableTrait
{
    public function getAttribute($key)
    {
        // get value by original eloquent scope
        $value = parent::getAttribute($key);

        if (!isset($this->urlable)) {
            return $value;
        }

        // check if attribute is urlable and url is not external if not return full url
        if (in_array($key, $this->urlable) && !starts_with($value, 'http') || starts_with($value, 'https')) {
            return url($value);
        }

        return $value;
    }
}
