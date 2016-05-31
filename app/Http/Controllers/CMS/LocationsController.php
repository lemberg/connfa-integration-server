<?php

namespace App\Http\Controllers\CMS;

use App\Http\Requests\LocationRequest;
use App\Repositories\LocationRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

class LocationsController extends BaseController
{
    public function __construct(LocationRequest $request, LocationRepository $repository, ResponseFactory $response)
    {
        parent::__construct($request, $repository, $response);
    }
}
