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

    public function getTracksWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
