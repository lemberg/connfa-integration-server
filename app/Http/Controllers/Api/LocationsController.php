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
     * @SWG\Get(
     *     path="/{conference_alias}/getLocations",
     *     summary="Get all locations",
     *     tags={"Location"},
     *     description="Returns all locations, since 'If-Modified-Since'",
     *     operationId="index",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="Conference alias",
     *         in="path",
     *         name="conference_alias",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="If-Modified-Since",
     *         in="header",
     *         required=false,
     *         type="string",
     *         description="Date, for example: Tue, 4 Apr 2017 09:50:24 +0000",
     *         default="Tue, 4 Apr 2017 09:50:24 +0000"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="locations",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Location")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=304,
     *         description="No updates"
     *     )
     * )
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
