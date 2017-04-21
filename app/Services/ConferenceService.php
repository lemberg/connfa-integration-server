<?php

namespace App\Services;

use App\Models\Conference;
use App\Repositories\ConferenceRepository;
use Illuminate\Http\Request;

class ConferenceService
{

    /**
     * @var ConferenceRepository
     */
    private $repository;

    /**
     * @var Request
     */
    private $request;

    /**
     * ConferenceService constructor.
     * @param ConferenceRepository $repository
     * @param Request              $request
     */
    public function __construct(ConferenceRepository $repository, Request $request)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * Get array for conference selectbox
     *
     * @return array
     */
    public function getList()
    {
        return $this->repository->getAllOrderedByName()->lists('name', 'id');
    }

    /**
     * Get conference model
     *
     * @return Conference
     */
    public function getModel()
    {
        $conferenceAlias = $this->request->route()->parameter('conference_alias');
        return $this->repository->getByAlias($conferenceAlias);
    }

}