<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\TrackRequest;
use App\Repositories\Event\TrackRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class TracksController extends BaseController
{

    protected $viewsFolder = 'events.tracks';

    public function __construct(TrackRequest $request, TrackRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }

}
