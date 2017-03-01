<?php

namespace App\Services;

use App\Repositories\ConferenceRepository;

class ConferenceService
{

    /**
     * @var ConferenceRepository
     */
    private $repository;

    /**
     * ConferenceService constructor.
     * @param ConferenceRepository $repository
     */
    public function __construct(ConferenceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getList()
    {
        return $this->repository->getAllOrderedByName()->lists('name', 'id');
    }

}