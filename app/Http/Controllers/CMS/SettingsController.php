<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\SettingRequest;
use App\Repositories\SettingsRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class SettingsController
 * @package App\Http\Controllers\CMS
 */
class SettingsController extends BaseController
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
     */
    public function __construct(SettingRequest $request, SettingsRepository $repository, ResponseFactory $response)
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
        return $this->response->view('settings.index', ['data' => $this->repository->getAllSettingInSingleArray($this->getConference()->id)]);
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
        return $this->response->view('settings.edit', [
            'data' => $this->repository->getAllSettingInSingleArray($this->getConference()->id),
            'timezoneList' => $this->repository->getTimezoneList(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string  $conferenceAlias
     * @param int     $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($conferenceAlias, $id = null)
    {
        $this->repository->saveSettings($this->request->except('_method', '_token'), $this->getConference()->id);
        if (session()->has('settings')) {
            session()->forget('settings');
        }

        return $this->response->redirectToRoute('settings.index', ['conference_alias' => $conferenceAlias]);
    }
}
