<?php

namespace App\Repositories;

use App\Models\Event;
use Carbon\Carbon;

class EventRepository extends BaseRepository
{

    public function model()
    {
        return Event::class;
    }

    /**
     * Get events with deleted by type since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string      $type
     * @param string|bool $since
     *
     * @return mixed
     */
    public function getEventsByTypeWithDeleted($conferenceId, $type, $since = false)
    {
        $events = $this->findByConference($conferenceId)->withTrashed()->where('event_type', $type);

        if ($since) {
            $events->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $events->orderBy('start_at')->get();
    }

    public function findOrNewByIdWithDeleted($id)
    {
        $obj = $this->model->withTrashed()->where('id', $id)->first();
        if (!$obj) {
            $obj = $this->model->firstOrNew(['id' => $id]);
        }

        return $obj;
    }

    /**
     * Update with Speakers
     *
     * @param $event
     * @param $data
     *
     * @return mixed
     */
    public function updateWithSpeakers($event, $data)
    {
        $speakers = $event->speakers()->sync(array_get($data, 'speakers', []));
        if (array_get($speakers, 'attached') or array_get($speakers, 'detached') or array_get($speakers, 'updated')) {
            unset($data['speakers']);

            return $event->where('id', '=', $event->id)->update($data);
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
     * @param int $conferenceId
     * @param string $type
     * @param string $orderBy
     * @param int $limit
     *
     * @return mixed
     */
    public function getEventByTypeOrderAndLimit($conferenceId, $type, $orderBy = 'updated_at', $limit = 5)
    {
        return $this->model->where(['conference_id' => $conferenceId, 'event_type' => $type])->orderBy($orderBy, 'DESC')->limit($limit)->get();
    }

    /**
     * Update collection by field (track, level, type)
     *
     * @param $field
     * @param $id
     *
     * @return mixed
     */
    public function updateByField($field, $id)
    {
        return $this->model->where([$field => $id])->update([$field => null]);
    }

    public function forceUpdateAllEvents()
    {
        $this->model->all()->each(function ($event){
            $event->update(['updated_at' => Carbon::now()]);
        });
    }
}
