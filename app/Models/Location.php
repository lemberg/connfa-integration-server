<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'lat',
        'lon',
        'address',
        'order',
    ];

    public function setOrderAttribute($value)
    {
        if(!strlen($value)){
            return $this->attributes['order'] = null;
        }
    }
}
