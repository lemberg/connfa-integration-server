<?php

namespace App\Models;

use App\Models\Event\Level;
use App\Models\Event\Track;
use App\Models\Event\Type;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    public static $event_types_available = [
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
        return $this->belongsTo(Level::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
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
