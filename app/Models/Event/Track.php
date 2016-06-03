<?php

namespace App\Models\Event;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
    use SoftDeletes;
    use OrderTrait;

    protected $table = 'event_tracks';

    protected $fillable = [
        'name',
        'order'
    ];
}
