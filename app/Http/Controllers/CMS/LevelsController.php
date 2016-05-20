<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\CMS\BaseController;
use App\Http\Requests\LevelRequest;
use App\Repositories\Event\LevelRepository;

class LevelsController extends BaseController
{
    /**
     * @var string
     */
    protected $viewsFolder = 'levels';

    /**
     * LevelsController constructor.
     * @param LevelRequest $request
     * @param LevelRepository $levelRepository
     */
    public function __construct(LevelRequest $request, LevelRepository $levelRepository)
    {
        parent::__construct($this->viewsFolder, $request, $levelRepository);
    }

}
