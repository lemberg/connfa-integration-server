<?php
namespace App\Repositories;

use App\Models\Event;

class EventRepository extends BaseRepository
{

    public function model()
    {
        return Event::class;
    }

    public function getEventsByTypeWithDeleted($type, $since = false)
    {
        $events = $this->model->withTrashed()->where('event_type', $type);

        if ($since) {
            $events->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $events->orderBy('start_at')->get();
    }
}
