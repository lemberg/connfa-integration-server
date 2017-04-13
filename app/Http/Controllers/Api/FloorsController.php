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
     *     path="/getFloorPlans",
     *     summary="Get all floor plans",
     *     tags={"Floor"},
     *     description="Returns all floor plans",
     *     operationId="index",
     *     produces={"application/json"},
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
     *         response=302,
     *         description="No updates"
     *     )
     * )
     *
     * @param FloorRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(FloorRepository $repository)
    {
        $floors = $repository->getFloorsWithDeleted($this->since);
        $this->checkModified($floors);

        return $this->response->collection($floors, new FloorTransformer(), ['key' => 'floorPlans']);
    }
}
