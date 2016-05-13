<?php namespace App\Repositories;


use App\Models\Location;

class LocationRepository extends BaseRepository
{

    public function model()
    {
        return 'App\Models\Location';
    }

    public function getLocationsWithDeleted($since = false)
    {
        if ($since) {
            return Location::withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return Location::withTrashed()->get();
    }
}
