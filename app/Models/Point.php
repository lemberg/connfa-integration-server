<?php

namespace App\Models;

use App\Models\Traits\UrlableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes;
    use UrlableTrait;

    protected $fillable = [
        'name',
        'description',
        'image',
        'detail_url',
        'order'
    ];

    protected $urlable = [
        'image',
    ];
}
