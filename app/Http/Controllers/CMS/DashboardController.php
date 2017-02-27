<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests;
use App\Repositories\ConferenceRepository;
use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;
use App\Repositories\SpeakerRepository;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * Class DashboardController
 * @package App\Http\Controllers\CMS
 */
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
     * @param Request $request
     * @param ResponseFactory $response
     * @param SpeakerRepository $speakers
     * @param EventRepository $repository
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(
        Request $request,
        ResponseFactory $response,
        SpeakerRepository $speakers,
        EventRepository $repository,
        ConferenceRepository $conferenceRepository
    ) {
        $this->middleware('auth');
        $this->response = $response;
        $this->speakers = $speakers;
        $this->repository = $repository;
        $this->isSetTimezone();

        $conferenceAlias = $request->route()->getParameter('conference_alias');
        $conference = $conferenceRepository->getByAlias($conferenceAlias);
        View::share('conference', $conference);
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

    /**
     * Set or unset Session 'settings'
     *
     * @return true
     */
    private function isSetTimezone()
    {
        $settingsRepository = \App::make(SettingsRepository::class);
        $settings = $settingsRepository->getAllSettingInSingleArray();
        if (!isset($settings['timezone'])) {
            session(['settings' => true]);
        } elseif (session()->has('settings')) {
            session()->forget('settings');
        }

        return true;
    }
}
