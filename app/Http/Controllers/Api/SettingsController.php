<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\SettingsRepository;
use App\Transformers\SettingsTransformer;

class SettingsController extends ApiController
{
    public function index(SettingsRepository $repository)
    {
        $settings = $repository->getSettingsWithDeleted($this->since);
        $this->checkModified($settings);

        $transformer = new SettingsTransformer();
        return $transformer->transform($settings);
    }
}