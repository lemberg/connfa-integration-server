<?php

namespace App\Repositories;

use App\Models\Speaker;

class SpeakerRepository extends BaseRepository
{

    public function model()
    {
        return Speaker::class;
    }

    /**
     * Get speakers with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     * @return mixed
     */
    public function getSpeakersWithDeleted($conferenceId, $since = false)
    {
        if ($since) {
            return $this->findByConference($conferenceId)->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->findByConference($conferenceId)->withTrashed()->get();
    }

    /**
     * Get limit last updated speakers
     *
     * @param int $conferenceId
     * @param int $limit
     *
     * @return mixed
     */
    public function getLimitLastUpdated($conferenceId, $limit = 5)
    {
        return $this->model
            ->whereHas('events', function ($query) use ($conferenceId) {
                $query->where('conference_id', $conferenceId);
            })
            ->orderBy('updated_at', 'DESC')
            ->limit($limit)
            ->get();
    }

}
