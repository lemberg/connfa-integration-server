<?php

namespace App\Http\Controllers\CMS;


use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Repositories\SettingsRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

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

    public function __construct(SettingRequest $request, SettingsRepository $repository, ResponseFactory $response)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->response = $response;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response->view('settings.index', ['data' => $this->repository->all()]);
    }

    public function edit()
    {
        return $this->response->view('settings.edit', ['data' => $this->repository->all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $this->repository->saveSettings($this->request->except('_method', '_token'));

        return $this->response->redirectToRoute('settings.index');
    }

}
