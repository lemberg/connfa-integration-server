<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository extends BaseRepository
{

    public function model()
    {
        return Location::class;
    }

    public function getLocationsWithDeleted($since = false)
    {
        if ($since) {
            return $this->model->withTrashed()->where('updated_at', '>=', $since->toDateTimeString())->get();
        }

        return $this->model->withTrashed()->get();
    }
}
