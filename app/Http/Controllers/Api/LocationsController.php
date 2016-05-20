<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\LocationRepository;
use App\Transformers\LocationTransformer;

class LocationsController extends ApiController
{
    public function index(LocationRepository $repository)
    {
        $locations = $repository->getLocationsWithDeleted($this->since);
        $this->checkModified($locations);

        return $this->response->collection($locations, new LocationTransformer(), ['key' => 'locations']);
    }

}
