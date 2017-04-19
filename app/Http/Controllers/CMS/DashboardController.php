<?php

namespace App\Http\Controllers\CMS;

use App\Repositories\SettingsRepository;
use App\Repositories\SpeakerRepository;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 * @package App\Http\Controllers\CMS
 */
class DashboardController extends BaseController
{

    /**
     * @var SpeakerRepository
     */
    protected $speakers;

    /**
     * @var string
     */
    protected $viewsFolder = '';

    /**
     * DashboardController constructor.
     *
     * @param Request $request
     * @param ResponseFactory $response
     * @param SpeakerRepository $speakers
     * @param EventRepository $repository
     */
    public function __construct(
        Request $request,
        ResponseFactory $response,
        SpeakerRepository $speakers,
        EventRepository $repository
    ) {
        parent::__construct($request, $repository, $response);
        $this->middleware('auth');
        $this->speakers = $speakers;

        $this->isSetTimezone();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view('dashboard', [
            'speakers' => $this->speakers->getLimitLastUpdated($this->getConference()->id),
            'sessions' => $this->repository->getEventByTypeOrderAndLimit($this->getConference()->id, 'session'),
            'social' => $this->repository->getEventByTypeOrderAndLimit($this->getConference()->id, 'social'),
            'bofs' => $this->repository->getEventByTypeOrderAndLimit($this->getConference()->id, 'bof'),
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
        $settings = $settingsRepository->getAllSettingInSingleArray($this->getConference()->id);
        if (!isset($settings['timezone'])) {
            session(['settings' => true]);
        } elseif (session()->has('settings')) {
            session()->forget('settings');
        }

        return true;
    }
}
