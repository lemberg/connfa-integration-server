<?php

namespace App\Repositories\Event;

use App\Models\Event\Track;
use App\Repositories\BaseRepository;

class TrackRepository extends BaseRepository
{
    public function model()
    {
        return Track::class;
    }

    /**
     * Get tracks with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     * @return mixed
     */
    public function getTracksWithDeleted($conferenceId, $since = false)
    {
        if ($since) {
            return $this->findByConference($conferenceId)->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->findByConference($conferenceId)->withTrashed()->get();
    }
}
