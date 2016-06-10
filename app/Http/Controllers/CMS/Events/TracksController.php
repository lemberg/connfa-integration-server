<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\TrackRequest;
use App\Repositories\Event\TrackRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

/**
 * Class TracksController
 * @package App\Http\Controllers\CMS\Events
 */
class TracksController extends BaseController
{

    /**
     * Override the views directory
     */
    protected $viewsFolder = 'events.tracks';

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
