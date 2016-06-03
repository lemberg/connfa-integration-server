<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'order',
    ];

    public function setOrderAttribute($value)
    {
        if(!strlen($value)){
            return $this->attributes['order'] = null;
        }
    }
}
