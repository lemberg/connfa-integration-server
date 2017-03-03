<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\SettingsRepository;
use App\Transformers\SettingsTransformer;

class SettingsController extends ApiController
{
    /**
     * Get list of Settings
     *
     * @param SettingsRepository $repository
     * @return array
     */
    public function index(SettingsRepository $repository)
    {
        $settings = $repository->getSettingsWithDeleted($this->since);
        $this->checkModified($settings);

        $transformer = new SettingsTransformer();

        return $transformer->transform($settings);
    }

    /**
     * Get setting by key
     *
     * @param $setting
     * @param SettingsRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function show($setting, SettingsRepository $repository)
    {
        $value = $repository->getByKeyWithDeleted($setting, $this->since, $this->conference->id);
        $this->checkModified($value);

        return $this->response->array([$setting => $value]);
    }
}
