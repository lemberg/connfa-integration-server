<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dingo\Api\Routing\Helpers;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiController extends Controller
{
    use Helpers;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Carbon
     */
    protected $since;

    /**
     * @var Container
     */
    protected $app;

    public function __construct(Request $request, Container $app)
    {
        $this->since = false;
        $this->request = $request;
        $this->app = $app;

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
