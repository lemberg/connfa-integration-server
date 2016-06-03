<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;

    protected $table = 'event_levels';

    protected $fillable = [
        'name',
        'order'
    ];

    public function setOrderAttribute($value)
    {
        if(!strlen($value)){
            return $this->attributes['order'] = null;
        }
    }
}
