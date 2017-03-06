<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use App\Repositories\LocationRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class LocationsController
 * @package App\Http\Controllers\CMS
 */
class LocationsController extends Controller
{
    /**
     * @var LocationRequest|null
     */
    protected $request = null;

    /**
     * @var LocationRepository|null
     */
    protected $repository = null;

    /**
     * @var ResponseFactory|null
     */
    protected $response = null;

    /**
     * @var string
     *
     */
    protected $viewsFolder = 'locations';

    /**
     * @var string
     */
    protected $routeName = 'location';

    /**
     * LocationsController constructor.
     *
     * @param LocationRequest $request
     * @param LocationRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(LocationRequest $request, LocationRepository $repository, ResponseFactory $response)
    {
        parent::__construct();
        $this->request = $request;
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = $this->repository->findByConference($this->getConference()->id)->first();
        if (!$location) {
            $location = new Location();
        }
        return $this->response->view($this->getViewName('index'), ['data' => $location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $location = $this->repository->findByConference($this->getConference()->id)->first();
        if (!$location) {
            $location = new Location();
        }
        return $this->response->view($this->getViewName('edit'), ['data' => $location]);
    }

    /** Update the specified resource in storage.
     *
     * @param string $conferenceAlias
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias)
    {
        $location = $this->repository->findByConference($this->getConference()->id)->first();
        if (!$location) {
            $location = new Location();
            $location->conference_id = $this->getConference()->id;
            $location->save();
        }
        $this->repository->updateRich($this->request->except('_method', '_token'), $location->id);

        return $this->response->redirectToRoute($this->routeName . '.index', ['conference_alias' => $conferenceAlias]);
    }

    /**
     * Get view name
     *
     * @param string $viewName
     *
     * @return string
     */
    protected function getViewName($viewName)
    {
        return $this->viewsFolder . '.' . $viewName;
    }
}
