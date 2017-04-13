<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\PointRepository;
use App\Transformers\PointTransformer;

class PointsController extends ApiController
{
    /**
     * Get list of Points of Interests
     *
     * @SWG\Get(
     *     path="/getPOI",
     *     summary="Get all points",
     *     tags={"Point"},
     *     description="Returns all points",
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
     *                 property="poi",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Point")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=302,
     *         description="No updates"
     *     )
     * )
     *
     * @param PointRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(PointRepository $repository)
    {
        $points = $repository->getPointsWithDeleted($this->since);
        $this->checkModified($points);

        return $this->response->collection($points, new PointTransformer(), ['key' => 'poi']);
    }

}
