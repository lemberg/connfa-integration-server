<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\LevelRequest;
use App\Repositories\Event\LevelRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

/**
 * Class LevelsController
 * @package App\Http\Controllers\CMS\Events
 */
class LevelsController extends BaseController
{
    /**
     * Override the views directory
     */
    protected $viewsFolder = 'events.levels';

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
