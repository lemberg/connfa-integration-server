<?php

namespace App\Models;

use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Floor extends Model
{
    use SoftDeletes;
    use OrderTrait;

    protected $fillable = [
        'name',
        'image',
        'order',
    ];
}
