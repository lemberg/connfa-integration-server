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
     * @param LevelRepository $levelRepository
     * @param ResponseFactory $response
     */
    public function __construct(LevelRequest $request, LevelRepository $levelRepository, ResponseFactory $response)
    {
        parent::__construct($request, $levelRepository, $response);
    }

}
