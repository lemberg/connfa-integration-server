<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\Event\TrackRepository;
use App\Transformers\Event\TrackTransformer;

class EventTracksController extends ApiController
{
    /**
     * Get list of Events Tracks
     *
     *  @SWG\Get(
     *     path="/getTracks",
     *     summary="Get all event tracks",
     *     tags={"Event"},
     *     description="Returns all event tracks, since 'If-Modified-Since'",
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
     *                 property="tracks",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Track")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=302,
     *         description="No updates"
     *     )
     * )
     *
     * @param TrackRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(TrackRepository $repository)
    {
        $tracks = $repository->getTracksWithDeleted($this->getConference()->id, $this->since);
        $this->checkModified($tracks);

        return $this->response->collection($tracks, new TrackTransformer(), ['key' => 'tracks']);
    }
}
