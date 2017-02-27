<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Repositories\ConferenceRepository;
use App\Repositories\SettingsRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;

/**
 * Class SettingsController
 * @package App\Http\Controllers\CMS
 */
class SettingsController extends Controller
{
    /**
     * @var SettingRequest|null
     */
    protected $request = null;

    /**
     * @var SettingsRepository|null
     */
    protected $repository = null;

    /**
     * @var ResponseFactory
     */
    protected $response = null;

    /**
     * SettingsController constructor.
     *
     * @param SettingRequest $request
     * @param SettingsRepository $repository
     * @param ResponseFactory $response\
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(SettingRequest $request, SettingsRepository $repository, ResponseFactory $response, ConferenceRepository $conferenceRepository)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->response = $response;

        $conferenceAlias = $request->route()->getParameter('conference_alias');
        $conference = $conferenceRepository->getByAlias($conferenceAlias);
        View::share('conference', $conference);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view('settings.index', ['data' => $this->repository->getAllSettingInSingleArray()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return $this->response->view('settings.edit', [
            'data' => $this->repository->getAllSettingInSingleArray(),
            'timezoneList' => $this->repository->getTimezoneList(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string  $conferenceAlias
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias)
    {
        $this->repository->saveSettings($this->request->except('_method', '_token'));
        if (session()->has('settings')) {
            session()->forget('settings');
        }

        return $this->response->redirectToRoute('settings.index', ['conference_alias' => $conferenceAlias]);
    }
}
