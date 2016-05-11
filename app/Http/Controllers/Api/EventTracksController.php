<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\Event\TrackRepository;
use App\Transformers\Event\TrackTransformer;

class EventTracksController extends ApiController
{
    public function index(TrackRepository $repository)
    {
        $types = $repository->getTracksWithDeleted($this->since);

        return $this->response->collection($types, new TrackTransformer(), ['key' => 'tracks']);
    }
}