<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\LevelRequest;
use App\Repositories\Event\LevelRepository;
use App\Repositories\EventRepository;
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
     * @var EventRepository
     */
    protected $event;
    
    /**
     * LevelsController constructor.
     *
     * @param LevelRequest $request
     * @param LevelRepository $repository
     * @param ResponseFactory $response
     * @param EventRepository $event
     */
    public function __construct(LevelRequest $request, LevelRepository $repository, ResponseFactory $response, EventRepository $event)
    {
        parent::__construct($request, $repository, $response);
        $this->event = $event;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->event->updateByField('level_id', $id);
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }
}
