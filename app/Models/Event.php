<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

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

    protected $dates = ['start_at', 'end_at'];

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

    public function getFormattedStartAt($tz, $format = 'Iso8601String')
    {
        return Carbon::parse($this->start_at, $tz)->{'to'.$format}();
    }

    public function getFormattedEndAt($tz, $format = 'Iso8601String')
    {
        return Carbon::parse($this->end_at, $tz)->{'to'.$format}();
    }

    public function getDateAttribute()
    {
        return $this->start_at->format('Y-m-d');
    }

}