<?php namespace App\Repositories;


use App\Models\Point;

class PointRepository extends BaseRepository
{

    public function model()
    {
        return 'App\Models\Point';
    }

    public function getPointsWithDeleted($since = false)
    {
        if ($since) {
            return Point::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Point::withTrashed()->get();
    }
}
