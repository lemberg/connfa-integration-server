<?php

namespace App\Repositories\Event;

use App\Models\Event\Track;
use App\Repositories\BaseRepository;

class TrackRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Event\Track';
    }

    public function getTracksWithDeleted($since = false)
    {
        if ($since) {
            return Track::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Track::withTrashed()->get();
    }
}
