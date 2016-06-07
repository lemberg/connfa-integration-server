<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\PageRepository;
use App\Transformers\InfoTransformer;
use vendocrat\Settings\SettingsManager;

class PagesController extends ApiController
{
    /**
     * Get lists of info pages and info titles
     *
     * @param PageRepository $repository
     * @param SettingsManager $settings
     * @return \Dingo\Api\Http\Response
     */
    public function index(PageRepository $repository, SettingsManager $settings)
    {
        $pages = $repository->getPagesWithDeleted($this->since);
        $this->checkModified($pages);

        $response = [
            'info'  => $pages,
            'title' => [
                'titleMajor' => $settings->get('titleMajor'),
                'titleMinor' => $settings->get('titleMinor'),
            ]
        ];

        $transformer = $this->app->make(InfoTransformer::class);

        return $this->response->array($transformer->transform($response));
    }
}
