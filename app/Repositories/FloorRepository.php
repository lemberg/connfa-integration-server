<?php

namespace App\Repositories;

use App\Models\Floor;

class FloorRepository extends BaseRepository
{

    public function model()
    {
        return Floor::class;
    }
    /**
     * Get floors with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     * @return mixed
     */
    public function getFloorsWithDeleted($conferenceId, $since = false)
    {
        if ($since) {
            return $this->findByConference($conferenceId)->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->findByConference($conferenceId)->withTrashed()->get();
    }
}
