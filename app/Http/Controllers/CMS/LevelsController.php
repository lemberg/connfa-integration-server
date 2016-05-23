<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\LevelRequest;
use App\Repositories\Event\LevelRepository;

class LevelsController extends BaseController
{
    /**
     * The views folder
     *
     * @var string
     */
    protected $viewsFolder = 'levels';

    /**
     * Where to redirect users after create / update.
     *
     * @var string
     */
    protected $redirectTo = '/levels';

    /**
     * LevelsController constructor.
     *
     * @param LevelRequest $request
     * @param LevelRepository $levelRepository
     */
    public function __construct(LevelRequest $request, LevelRepository $levelRepository)
    {
        parent::__construct($request, $levelRepository);
    }

}
