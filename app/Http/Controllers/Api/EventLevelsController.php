<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\Event\LevelRepository;
use App\Transformers\Event\LevelTransformer;

class EventLevelsController extends ApiController
{
    public function index(LevelRepository $repository)
    {
        $types = $repository->getLevelsWithDeleted($this->since);

        return $this->response->collection($types, new LevelTransformer(), ['key' => 'levels']);
    }
}