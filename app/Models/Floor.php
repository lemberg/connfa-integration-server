<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'url',
        'order',
    ];
}