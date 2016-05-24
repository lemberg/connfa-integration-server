<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\TrackRequest;
use App\Repositories\Event\TrackRepository;
use Illuminate\Contracts\Routing\ResponseFactory;

class TracksController extends BaseController
{

    /**
     * TracksController constructor.
     *
     * @param TrackRequest $request
     * @param TrackRepository $repository
     * @param ResponseFactory $response
     */
    public function __construct(TrackRequest $request, TrackRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

}
