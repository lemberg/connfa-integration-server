<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\PageRepository;
use App\Repositories\SettingsRepository;
use App\Transformers\InfoTransformer;

class PagesController extends ApiController
{
    /**
     * Get lists of info pages and info titles
     *
     * @SWG\Get(
     *     path="/{conference_alias}/getInfo",
     *     summary="Get all info",
     *     tags={"Info"},
     *     description="Returns all info, since 'If-Modified-Since'",
     *     operationId="index",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="Conference alias",
     *         in="path",
     *         name="conference_alias",
     *         required=true,
     *         type="string"
     *     ),
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
     *         response=304,
     *         description="No updates"
     *     )
     * )
     *
     * @param PageRepository $repository
     * @param SettingsRepository $settingsRepository
     * @return \Dingo\Api\Http\Response
     */
    public function index(PageRepository $repository, SettingsRepository $settingsRepository)
    {
        $pages = $repository->getPagesWithDeleted($this->getConference()->id, $this->since);
        $this->checkModified($pages);

        $response = [
            'info'  => $pages,
            'title' => [
                'titleMajor' => $settingsRepository->getValueByKey('titleMajor', $this->getConference()->id),
                'titleMinor' => $settingsRepository->getValueByKey('titleMinor', $this->getConference()->id),
            ]
        ];

        $transformer = $this->app->make(InfoTransformer::class);

        return $this->response->array($transformer->transform($response));
    }
}
