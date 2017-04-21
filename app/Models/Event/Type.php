<?php

namespace App\Models\Event;

use App\Models\Traits\OrderTrait;
use App\Models\Traits\UrlableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;
    use OrderTrait;
    use UrlableTrait;

    protected $table = 'event_types';

    protected $fillable = [
        'name',
        'order',
        'conference_id'
    ];
}
