<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\LevelRequest;
use App\Repositories\Event\LevelRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class LevelsController extends BaseController
{
    protected $viewsFolder = 'events.levels';

    public function __construct(LevelRequest $request, LevelRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

}
