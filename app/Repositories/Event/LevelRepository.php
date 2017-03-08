<?php

namespace App\Repositories\Event;

use App\Models\Event\Level;
use App\Repositories\BaseRepository;

class LevelRepository extends BaseRepository
{
    public function model()
    {
        return Level::class;
    }

    /**
     * Get levels with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     * @return mixed
     */
    public function getLevelsWithDeleted($conferenceId, $since = false)
    {
        if ($since) {
            return $this->findByConference($conferenceId)->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->findByConference($conferenceId)->withTrashed()->get();
    }
}
