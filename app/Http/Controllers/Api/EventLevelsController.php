<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Event\LevelRepository;
use App\Transformers\Event\LevelTransformer;

class EventLevelsController extends ApiController
{
    public function index(LevelRepository $repository)
    {
        $levels = $repository->getLevelsWithDeleted($this->since);
        $this->checkModified($levels);

        return $this->response->collection($levels, new LevelTransformer(), ['key' => 'levels']);
    }
}
