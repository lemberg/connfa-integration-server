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
     * @SWG\Get(
     *     path="/getInfo",
     *     summary="Get all info",
     *     tags={"Info"},
     *     description="Returns all info, since 'If-Modified-Since'",
     *     operationId="index",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="If-Modified-Since",
     *         in="header",
     *         required=false,
     *         type="string",
     *         description="Date, for example: Tue, 4 Apr 2017 09:50:24 +0000",
     *         default="Tue, 4 Apr 2017 09:50:24 +0000"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                  property="title",
     *                  type="object",
     *                  @SWG\Property(
     *                      property="titleMajor",
     *                      type="string",
     *                      example="Barcelona"
     *                  ),
     *                  @SWG\Property(
     *                      property="titleMinor",
     *                      type="string",
     *                      example="Drupalcon 2015"
     *                  )
     *              ),
     *              @SWG\Property(
     *                 property="info",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Page")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=302,
     *         description="No updates"
     *     )
     * )
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
