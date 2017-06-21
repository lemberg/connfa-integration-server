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
     * @SWG\Get(
     *     path="/{conference_alias}/getSettings",
     *     summary="Get settings",
     *     tags={"Settings"},
     *     description="Returns settings",
     *     operationId="index",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="Conference alias",
     *         in="path",
     *         name="conference_alias",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="settings",
     *                 type="object",
     *                 ref="#/definitions/Setting"
     *             )
     *         )
     *     )
     * )
     *
     * @param SettingsRepository $repository
     * @return array
     */
    public function index(SettingsRepository $repository)
    {
        $settings = $repository->getSettingsWithDeleted($this->getConference()->id, $this->since);
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
        $value = $repository->getByKeyWithDeleted($this->getConference()->id, $setting, $this->since);
        $this->checkModified($value);

        return $this->response->array([$setting => $value]);
    }
}
