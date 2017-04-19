<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository extends BaseRepository
{

    public function model()
    {
        return Location::class;
    }

    /**
     * Get locations with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     * @return mixed
     */
    public function getLocationsWithDeleted($conferenceId, $since = false)
    {
        if ($since) {
            return $this->findByConference($conferenceId)->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->findByConference($conferenceId)->withTrashed()->get();
    }
}
