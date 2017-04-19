<?php

namespace App\Repositories;

use App\Models\Point;

class PointRepository extends BaseRepository
{

    public function model()
    {
        return Point::class;
    }

    /**
     * Get points of interests with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     * @return mixed
     */
    public function getPointsWithDeleted($conferenceId, $since = false)
    {
        if ($since) {
            return $this->findByConference($conferenceId)->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->findByConference($conferenceId)->withTrashed()->get();
    }
}
