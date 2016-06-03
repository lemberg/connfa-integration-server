<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    protected $table = 'event_types';

    protected $fillable = [
        'name',
        'icon'
    ];

    public function setOrderAttribute($value)
    {
        if(!strlen($value)){
            return $this->attributes['order'] = null;
        }
    }
}
