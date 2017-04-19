<?php

namespace App\Models;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    use OrderTrait;

    protected $fillable = [
        'name',
        'lat',
        'lon',
        'address',
        'order',
        'conference_id'
    ];
}
