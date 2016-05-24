<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\LevelRequest;
use App\Repositories\Event\LevelRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

class LevelsController extends BaseController
{

    /**
     * LevelsController constructor.
     *
     * @param LevelRequest $request
     * @param LevelRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(LevelRequest $request, LevelRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

}
