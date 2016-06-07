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
     * @param TrackRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(TrackRepository $repository)
    {
        $tracks = $repository->getTracksWithDeleted($this->since);
        $this->checkModified($tracks);

        return $this->response->collection($tracks, new TrackTransformer(), ['key' => 'tracks']);
    }
}
