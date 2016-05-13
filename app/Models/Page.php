<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'alias',
        'content',
        'order',
    ];
}