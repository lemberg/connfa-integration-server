<?php

namespace App\Models;


use App\Models\Traits\OrderTrait;
use App\Models\Traits\UrlableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;
    use OrderTrait;
    use UrlableTrait;

    protected $fillable = [
        'name',
        'description',
        'image',
        'details_url',
        'order',
        'conference_id'
    ];

    protected $urlable = [
        'image',
    ];
}
