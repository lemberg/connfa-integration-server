<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\EventRequest;
use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\SpeakerRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

class EventsController extends BaseController
{
    protected $eventType;
    protected $speakers;
    protected $levels;
    protected $types;
    protected $tracks;

    public function __construct(
        EventRequest $request,
        EventRepository $repository,
        ResponseFactory $response,
        SpeakerRepository $speakers,
        LevelRepository $levels,
        TypeRepository $types,
        TrackRepository $tracks
    ) {
        $this->speakers = $speakers;
        $this->levels = $levels;
        $this->types = $types;
        $this->tracks = $tracks;
        parent::__construct($request, $repository, $response);
    }

    public function index()
    {
        return $this->response->view($this->getViewName('index'), ['data' => $this->repository->getByEventTypeOnPage($this->eventType, 25)]);
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
        $data['event_type'] = $this->eventType;
        $event = $this->repository->create($data);
        $event->speakers()->sync(array_get($data, 'speakers', []));

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
        $this->repository->updateWithSpeakers($id, $data);

        return $this->redirectTo('index');
    }
}
