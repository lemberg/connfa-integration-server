<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SpeakerRepository;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

class DashboardController extends Controller
{
    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * @var SpeakerRepository
     */
    protected $speakers;

    /**
     * @var EventRepository
     */
    protected $repository;

    /**
     * DashboardController constructor.
     *
     * @param ResponseFactory $response
     * @param SpeakerRepository $speakers
     * @param EventRepository $repository
     */
    public function __construct(
        ResponseFactory $response,
        SpeakerRepository $speakers,
        EventRepository $repository
    ) {
        $this->middleware('auth');
        $this->response = $response;
        $this->speakers = $speakers;
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view('dashboard', [
            'speakers' => $this->speakers->getLimitLastUpdated(),
            'sessions' => $this->repository->getEventByTypeOrderAndLimit('session'),
            'social' => $this->repository->getEventByTypeOrderAndLimit('social'),
            'bofs' => $this->repository->getEventByTypeOrderAndLimit('bof'),
        ]);
    }
}
