<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'alias',
        'content',
        'order',
    ];

    public function setOrderAttribute($value)
    {
        if(!strlen($value)){
            return $this->attributes['order'] = null;
        }
    }
}
