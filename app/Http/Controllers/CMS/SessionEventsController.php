<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SessionEventRequest;
use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class SessionEventsController extends BaseController
{
    protected $viewsFolder = 'session-events';
    protected $levels;
    protected $types;
    protected $tracks;

    public function __construct(SessionEventRequest $request, EventRepository $repository, ResponseFactory $response, LevelRepository $levels, TypeRepository $types, TrackRepository $tracks)
    {
        $this->levels = $levels;
        $this->types = $types;
        $this->tracks = $tracks;
        parent::__construct($request, $repository, $response);
    }

    public function create()
    {
        return $this->response->view($this->getViewName('create'), [
            'levels' => $this->levels->lists('name','id'),
            'types' => $this->types->lists('name','id'),
            'tracks' => $this->tracks->lists('name','id'),
        ]);
    }

    public function store()
    {
        $data = $this->request->all();
        dd($data);
        $this->repository->create($data);

        return $this->redirectTo('index');
    }

    public function update($id)
    {
        $data = $this->request->all();
        dd($data);
        $this->repository->updateRich($data, $id);

        return $this->redirectTo('index');
    }

    /*public function destroy($id)
    {
        $repository = $this->repository->findOrFail($id);
        if ($image = $repository->image) {
            $this->repository->deleteImage($image);
        }
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }*/
}
