<?php namespace App\Repositories;



use App\Models\Floor;

class FloorRepository extends BaseRepository
{

    public function model()
    {
        return 'App\Models\Floor';
    }

    public function getFloorsWithDeleted($since = false)
    {
        if ($since) {
            return Floor::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Floor::withTrashed()->get();
    }
}
