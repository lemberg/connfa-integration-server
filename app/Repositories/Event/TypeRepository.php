<?php

namespace App\Repositories\Event;

use App\Models\Event\Type;
use App\Repositories\BaseRepository;

class TypeRepository extends BaseRepository
{
    public function model()
    {
        return Type::class;
    }

    /**
     * Get types with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     * @return mixed
     */
    public function getTypesWithDeleted($conferenceId, $since = false)
    {
        if ($since) {
            return $this->findByConference($conferenceId)->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->findByConference($conferenceId)->withTrashed()->get();
    }
}
