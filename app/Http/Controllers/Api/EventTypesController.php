<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Event\TypeRepository;
use App\Transformers\Event\TypeTransformer;

class EventTypesController extends ApiController
{
    /**
     * Get list of Event Types
     *
     * @param TypeRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(TypeRepository $repository)
    {
        $types = $repository->getTypesWithDeleted($this->getConference()->id, $this->since);
        $this->checkModified($types);

        return $this->response->collection($types, new TypeTransformer(), ['key' => 'types']);
    }
}
