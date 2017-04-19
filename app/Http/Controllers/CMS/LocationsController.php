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
class LocationsController extends BaseController
{

    /**
     * @var string
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
        parent::__construct($request, $repository, $response);
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
     * @param  string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($conferenceAlias, $id = null)
    {
        $location = $this->repository->findByConference($this->getConference()->id)->first();
        if (!$location) {
            $location = new Location();
        }

        return $this->response->view($this->getViewName('edit'), ['data' => $location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias, $id = null)
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

}
