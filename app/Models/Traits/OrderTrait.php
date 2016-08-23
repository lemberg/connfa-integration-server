<?php

namespace App\Models\Traits;

trait OrderTrait
{
    /**
     * If order empty set null
     *
     * @param $value
     *
     * @return null
     */
    public function setOrderAttribute($value)
    {
        if (!strlen($value)) {
            return $this->attributes['order'] = null;
        }

        return $this->attributes['order'] = $value;
    }
}
