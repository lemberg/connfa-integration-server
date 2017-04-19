<?php

namespace App\Models;

use App\Models\Traits\OrderTrait;
use App\Models\Traits\UrlableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;
    use OrderTrait;
    use UrlableTrait;

    protected $fillable = [
        'name',
        'image',
        'order',
        'conference_id'
    ];

    protected $urlable = [
        'image'
    ];
}
