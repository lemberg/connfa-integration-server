<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'characteristic',
        'job',
        'organization',
        'twitter_name',
        'website',
        'avatar',
        'email',
        'order',
    ];

    /**
     * Check and change first symbol in twitter name
     *
     * @param $value
     *
     * @return mixed
     */
    public function setTwitterNameAttribute($value)
    {
        if (!is_null($value) and !starts_with($value, '@')) {
            return $this->attributes['twitter_name'] = '@' . $value;
        }

        return $this->attributes['twitter_name'] = $value;
    }

    /**
     * Get twitter name without at
     *
     * @return mixed
     */
    public function getTwitterNameWithoutAtAttribute()
    {
        $this->attributes['twitter_name_without_at'] = $this->twitter_name;
        if (!empty($this->twitter_name) and starts_with($this->twitter_name, '@')) {
            $this->attributes['twitter_name_without_at'] = substr($this->twitter_name, 1);
        }

        return $this->attributes['twitter_name_without_at'];
    }
}
