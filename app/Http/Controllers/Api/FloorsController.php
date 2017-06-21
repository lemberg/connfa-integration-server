<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\FloorRepository;
use App\Transformers\FloorTransformer;

class FloorsController extends ApiController
{
    /**
     * Get list of Floor plans
     *
     * @SWG\Get(
     *     path="/{conference_alias}/getFloorPlans",
     *     summary="Get all floor plans",
     *     tags={"Floor"},
     *     description="Returns all floor plans, since 'If-Modified-Since'",
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
     *                 property="floorPlans",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Floor")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=304,
     *         description="No updates"
     *     )
     * )
     *
     * @param FloorRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(FloorRepository $repository)
    {
        $floors = $repository->getFloorsWithDeleted($this->getConference()->id, $this->since);
        $this->checkModified($floors);

        return $this->response->collection($floors, new FloorTransformer(), ['key' => 'floorPlans']);
    }
}
