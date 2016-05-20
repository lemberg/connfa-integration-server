<?php

namespace App\Repositories\Event;

use app\Models\Event\Level;
use App\Repositories\BaseRepository;

class LevelRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Event\Level';
    }

    public function getLevelsWithDeleted($since = false)
    {
        if ($since) {
            return Level::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Level::withTrashed()->get();
    }
}
