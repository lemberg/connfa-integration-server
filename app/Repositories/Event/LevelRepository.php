<?php

namespace App\Repositories\Event;

use app\Models\Event\Level;
use App\Repositories\BaseRepository;

class LevelRepository extends BaseRepository
{
    public function model()
    {
        return Level::class;
    }

    public function getLevelsWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
