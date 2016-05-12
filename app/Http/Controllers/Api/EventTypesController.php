<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\Event\TypeRepository;
use App\Transformers\Event\TypeTransformer;

class EventTypesController extends ApiController
{
    public function index(TypeRepository $repository)
    {
        $types = $repository->getTypesWithDeleted($this->since);
        $this->checkModified($types);

        return $this->response->collection($types, new TypeTransformer(), ['key' => 'types']);
    }
}