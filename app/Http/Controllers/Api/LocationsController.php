<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\LocationRepository;
use App\Transformers\LocationTransformer;

class LocationsController extends ApiController
{
    /**
     * Get list of Locations
     *
     * @param LocationRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(LocationRepository $repository)
    {
        $locations = $repository->getLocationsWithDeleted($this->getConference()->id, $this->since);
        $this->checkModified($locations);

        return $this->response->collection($locations, new LocationTransformer(), ['key' => 'locations']);
    }

}
