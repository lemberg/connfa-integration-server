<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository extends BaseRepository
{

    public function model()
    {
        return Event::class;
    }

    /**
     * Get events with deleted by type since $since param if passed
     *
     * @param $type
     * @param string|bool $since
     * @return mixed
     */
    public function getEventsByTypeWithDeleted($type, $since = false)
    {
        $events = $this->model->withTrashed()->where('event_type', $type);

        if ($since) {
            $events->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $events->orderBy('start_at')->get();
    }

    /**
     * Update with Speakers
     *
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateWithSpeakers($id, $data)
    {
        $event = $this->findOrFail($id);

        $event->fill($data);
        $event->speakers()->sync(array_get($data, 'speakers'));
        
        return $event->save();
    }

    /**
     * Get event by type with pagination
     *
     * @param $type
     * @param int $itemsOnPage
     *
     * @return mixed
     */
    public function getByEventTypeOnPage($type, $itemsOnPage = 25)
    {
        return $this->model->where(['event_type' => $type])->paginate($itemsOnPage);
    }
}
