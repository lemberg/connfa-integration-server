<?php

namespace App\Repositories;

use App\Models\Floor;

class FloorRepository extends BaseRepository
{

    public function model()
    {
        return Floor::class;
    }

    public function getFloorsWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
