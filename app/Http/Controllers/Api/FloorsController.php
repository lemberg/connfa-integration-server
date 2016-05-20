<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\FloorRepository;
use App\Transformers\FloorTransformer;

class FloorsController extends ApiController
{
    public function index(FloorRepository $repository)
    {
        $floors = $repository->getFloorsWithDeleted($this->since);
        $this->checkModified($floors);

        return $this->response->collection($floors, new FloorTransformer(), ['key' => 'housePlans']);
    }

}
