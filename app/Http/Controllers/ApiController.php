<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    use Helpers;

    protected $request;
    protected $requestedUser;

    protected $since;

    public function __construct(Request $request)
    {
        $this->since = Carbon::parse($request->header('IF-Modified-Since', false));
    }
}