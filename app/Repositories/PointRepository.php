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
     * @param string|bool $since
     * @return mixed
     */
    public function getPointsWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
