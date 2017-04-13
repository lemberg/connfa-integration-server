<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\SpeakerRepository;
use App\Transformers\SpeakerTransformer;

class SpeakersController extends ApiController
{
    /**
     * Get list of Speakers
     *
     * @SWG\Get(
     *     path="/getSpeakers",
     *     summary="Get all speakers",
     *     tags={"Speaker"},
     *     description="Returns all speakers",
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
     *                 property="speakers",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Speaker")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=302,
     *         description="No updates"
     *     )
     * )
     *
     * @param SpeakerRepository $speakerRepository
     * @return \Dingo\Api\Http\Response
     */
    public function index(SpeakerRepository $speakerRepository)
    {
        $speakers = $speakerRepository->getSpeakersWithDeleted($this->since);
        $this->checkModified($speakers);

        return $this->response->collection($speakers, new SpeakerTransformer(), ['key' => 'speakers']);
    }

}
