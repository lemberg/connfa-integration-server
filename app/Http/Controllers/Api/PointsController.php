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
