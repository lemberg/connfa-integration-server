<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use SoftDeletes;

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
}