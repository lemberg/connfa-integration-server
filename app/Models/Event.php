<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    const event_types_available = [
        'program',
        'bof',
        'social',
    ];
    protected $table = 'events';
    protected $fillable = [
        'start_at',
        'end_at',
        'text',
        'name',
        'place',
        'version',
        'level_id',
        'type_id',
        'track_id',
        'url',
        'event_type',
    ];

    public function level()
    {
        return $this->belongsTo('App\Models\Event\Level');
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Event\Type');
    }

    public function track()
    {
        return $this->belongsTo('App\Models\Event\Track');
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class);
    }

}