<?php

namespace App\Models\Event;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;
    use OrderTrait;

    protected $table = 'event_types';

    protected $fillable = [
        'name',
        'icon',
    ];
}
