<?php

namespace App\Models;

use App\Models\Traits\UrlableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use SoftDeletes;
    use UrlableTrait;

    protected $fillable = [
        'first_name',
        'last_name',
        'characteristic',
        'job',
        'organization',
        'twitter_name',
        'website',
        'avatar',
        'email',
        'order',
    ];

    protected $urlable = [
        'avatar'
    ];
}
