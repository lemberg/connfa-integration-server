<?php

namespace App\Models\Event;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use SoftDeletes;
    use OrderTrait;

    protected $table = 'event_levels';

    protected $fillable = [
        'name',
        'order',
        'conference_id'
    ];
}
