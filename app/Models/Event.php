<?php

namespace App\Models;

use App\Models\Event\Level;
use App\Models\Event\Track;
use App\Models\Event\Type;
use App\Models\Traits\DateFormatterTrait;
use App\Models\Traits\OrderTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    use DateFormatterTrait;
    use OrderTrait;

    public static $event_types_available = [
        'session',
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
        'order',
        'updated_at',
        'conference_id'
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

    /**
     * Get users with a certain role
     */
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'schedule_event');
    }

    public function getFormattedStartAt($tz)
    {
        return $this->getFormattedDate($this->start_at, $tz);
    }

    public function getFormattedEndAt($tz)
    {
        return $this->getFormattedDate($this->end_at, $tz);
    }

    public function getDateAttribute()
    {
        return $this->start_at->format('d-m-Y');
    }
}