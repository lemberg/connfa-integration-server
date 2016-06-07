<?php

namespace App\Models;

use App\Models\Traits\UrlableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;
    use UrlableTrait;

    protected $fillable = [
        'name',
        'image',
        'order',
    ];

    protected $urlable = [
        'image'
    ];
}
