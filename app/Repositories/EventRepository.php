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
     *
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
     *
     * @return mixed
     */
    public function updateWithSpeakers($id, $data)
    {
        $event = $this->findOrFail($id);
        $speakers = $event->speakers()->sync(array_get($data, 'speakers', []));
        if (array_get($speakers, 'attached') or array_get($speakers, 'detached') or array_get($speakers, 'updated')) {
            unset($data['speakers']);

            return $event->where('id', '=', $id)->update($data);
        } else {
            $event->fill($data);

            return $event->save();
        }
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

    /**
     * Get events by type sort DESC and limit
     *
     * @param $type
     * @param string $orderBy
     * @param int $limit
     *
     * @return mixed
     */
    public function getEventByTypeOrderAndLimit($type, $orderBy = 'updated_at', $limit = 5)
    {
        return $this->model->where(['event_type' => $type])->orderBy($orderBy, 'DESC')->limit($limit)->get();
    }
}
