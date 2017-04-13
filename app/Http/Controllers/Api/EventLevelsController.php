<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Event\LevelRepository;
use App\Transformers\Event\LevelTransformer;

class EventLevelsController extends ApiController
{
    /**
     * Get list of Event Levels
     *
     * @SWG\Get(
     *     path="/getLevels",
     *     summary="Get all event levels",
     *     tags={"Event"},
     *     description="Returns all event levels",
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
     *                 property="levels",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Level")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=302,
     *         description="No updates"
     *     )
     * )
     *
     * @param LevelRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(LevelRepository $repository)
    {
        $levels = $repository->getLevelsWithDeleted($this->since);
        $this->checkModified($levels);

        return $this->response->collection($levels, new LevelTransformer(), ['key' => 'levels']);
    }
}
