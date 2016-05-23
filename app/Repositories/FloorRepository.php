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
     * @param string|bool $since
     * @return mixed
     */
    public function getFloorsWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
