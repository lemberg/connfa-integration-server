<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\SettingsRepository;
use App\Transformers\SettingsTransformer;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
        $value = $repository->getByKeyWithDeleted($setting, $this->since);
        $this->checkModified($value);

        return $this->response->array([$setting => $value]);
    }

    /**
     * Get Twitter HTML and Search Query settings
     *
     * @param SettingsRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function getTwitter(SettingsRepository $repository)
    {
        $html = $repository->getByKeyWithDeleted('twitterWidget', $this->since);
        $searchQuery = $repository->getByKeyWithDeleted('twitterSearchQuery', $this->since);

        if (!$html && !$searchQuery && $this->request->hasHeader('If-Modified-Since')) {
            throw new HttpException(304);
        }

        $data = [];

        if ($html) {
            $data['twitterWidgetHTML'] = $html->value;
        }

        if ($searchQuery) {
            $data['twitterSearchQuery'] = $searchQuery->value;
        }

        return $this->response->array($data);
    }
}
