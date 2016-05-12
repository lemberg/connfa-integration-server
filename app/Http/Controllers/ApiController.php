<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiController extends Controller
{
    use Helpers;

    protected $request;
    protected $requestedUser;

    protected $since;

    public function __construct(Request $request)
    {
        $this->since = false;
        $this->request = $request;

        $since = $request->header('IF-Modified-Since', false);
        if ($since) {
            $this->since = Carbon::parse($since);
        }
    }

    public function checkModified($collection)
    {
        if (!$collection->count() && $this->request->hasHeader('If-Modified-Since')) {
            throw new HttpException(304);
        }
    }
}