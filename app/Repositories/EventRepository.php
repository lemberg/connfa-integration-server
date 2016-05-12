<?php namespace App\Repositories;

use App\Models\Event;
use App\Models\Role;

class EventRepository extends BaseRepository
{

    public function model()
    {
        return 'App\Models\Event';
    }

    public function getEventsByTypeWithDeleted($type, $since = false)
    {
        $events = Event::withTrashed()->where('event_type', $type);

        if ($since) {
            $events->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $events->orderBy('start_at')->get();
    }
}
