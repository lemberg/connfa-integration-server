<?php

namespace App\Models;

use App\Models\Traits\OrderTrait;
use App\Models\Traits\UrlableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use SoftDeletes;
    use OrderTrait;
    use UrlableTrait;

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
        'conference_id'
    ];

    protected $urlable = [
        'avatar'
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
        $value = str_replace(' ', '', $value);
        if (strlen($value) and !starts_with($value, '@')) {
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

    /**
     * Get full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
         return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
}
