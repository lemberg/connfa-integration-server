<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\EventRequest;
use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\SpeakerRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Yajra\Datatables\Datatables;

/**
 * Class EventsController
 * @package App\Http\Controllers\CMS
 */
class EventsController extends BaseController
{
    /**
     * @var string type of Event
     */
    protected $eventType;

    /**
     * @var SpeakerRepository
     */
    protected $speakers;

    /**
     * @var LevelRepository
     */
    protected $levels;

    /**
     * @var TypeRepository
     */
    protected $types;

    /**
     * @var TrackRepository
     */
    protected $tracks;

    /**
     * EventsController constructor.
     *
     * @param EventRequest $request
     * @param EventRepository $repository
     * @param ResponseFactory $response
     * @param SpeakerRepository $speakers
     * @param LevelRepository $levels
     * @param TypeRepository $types
     * @param TrackRepository $tracks
     */
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view($this->getViewName('index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->response->view($this->getViewName('create'), [
            'speakers' => $this->speakers->findByConference($this->conference->id)->get()->pluck('full_name', 'id')->toArray(),
            'levels' => $this->levels->findByConference($this->conference->id)->get()->pluck('name', 'id')->toArray(),
            'types' => $this->types->findByConference($this->conference->id)->get()->pluck('name', 'id')->toArray(),
            'tracks' => $this->tracks->findByConference($this->conference->id)->get()->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $conferenceAlias
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($conferenceAlias)
    {
        $data = $this->request->all();
        $data['event_type'] = $this->eventType;
        $data['conference_id'] = $this->conference->id;
        $event = $this->repository->create($data);
        $event->speakers()->sync(array_get($data, 'speakers', []));

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $conferenceAlias
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($conferenceAlias, $id)
    {
        return $this->response->view($this->getViewName('edit'), [
            'data' => $this->repository->findOrFail($id),
            'speakers' => $this->speakers->findByConference($this->conference->id)->get()->pluck('full_name', 'id')->toArray(),
            'levels' => $this->levels->findByConference($this->conference->id)->get()->pluck('name', 'id')->toArray(),
            'types' => $this->types->findByConference($this->conference->id)->get()->pluck('name', 'id')->toArray(),
            'tracks' => $this->tracks->findByConference($this->conference->id)->get()->pluck('name', 'id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $conferenceAlias
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias, $id)
    {
        $this->repository->updateWithSpeakers($id, $this->request->except('_method', '_token'));

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Datatables::of($this->repository->findWhere(['event_type' => $this->eventType, 'conference_id' => $this->conference->id]))
            ->addColumn('actions', function ($data) {
                return view('partials/actions', ['route' => $this->getRouteName(), 'id' => $data->id]);
            })
            ->make(true);
    }
}
