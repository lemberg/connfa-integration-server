<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SessionEventRequest;
use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\SpeakerRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class SessionEventsController extends BaseController
{
    protected $viewsFolder = 'session-events';
    protected $routeName = 'sessions';
    protected $levels;
    protected $types;
    protected $tracks;
    protected $speakers;

    public function __construct(
        SessionEventRequest $request,
        EventRepository $repository,
        ResponseFactory $response,
        LevelRepository $levels,
        TypeRepository $types,
        TrackRepository $tracks,
        SpeakerRepository $speakers
    ) {
        $this->levels = $levels;
        $this->types = $types;
        $this->tracks = $tracks;
        $this->speakers = $speakers;
        parent::__construct($request, $repository, $response);
    }

    public function create()
    {
        return $this->response->view($this->getViewName('create'), [
            'speakers' => $this->speakers->all()->pluck('full_name', 'id'),
            'levels' => $this->levels->lists('name', 'id'),
            'types' => $this->types->lists('name', 'id'),
            'tracks' => $this->tracks->lists('name', 'id'),
        ]);
    }

    public function store()
    {
        $data = $this->request->all();
        $data['event_type'] = 'session';
        $event = $this->repository->create($data);
        $event->speakers()->sync(array_get($data, 'speakers'));

        return $this->redirectTo('index');
    }

    public function edit($id)
    {
        return $this->response->view($this->getViewName('edit'), [
            'data' => $this->repository->findOrFail($id),
            'speakers' => $this->speakers->all()->pluck('full_name', 'id'),
            'levels' => $this->levels->lists('name', 'id'),
            'types' => $this->types->lists('name', 'id'),
            'tracks' => $this->tracks->lists('name', 'id'),
        ]);
    }

    public function update($id)
    {
        $data = $this->request->all();
        if ($this->repository->updateRich($data, $id)) {
            $event = $this->repository->findOrFail($id);
            $event->speakers()->sync(array_get($data, 'speakers'));
        }


        return $this->redirectTo('index');
    }
}
