<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{

    use SoftDeletes;

    protected $table = 'schedules';

    protected $fillable = [
        'code'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get events
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'schedule_event');
    }

}