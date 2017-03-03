<?php

namespace App\Http\Controllers;

use App\Models\Conference;
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

    /**
     * @var Conference
     */
    protected $conference;

    /**
     * ApiController constructor.
     *
     * @param Request $request
     * @param Container $app
     */
    public function __construct(Request $request, Container $app)
    {
        $this->since = false;
        $this->request = $request;
        $this->app = $app;

        $since = $request->header('IF-Modified-Since', false);
        if ($since) {
            $this->since = Carbon::parse($since);
        }

        $this->conference = $this->app->make('conference_service')->getModel();

    }

    /**
     * Check if collection was modified since HTTP header If-Modified-Since
     *
     * @param $collection
     */
    public function checkModified($collection)
    {
        if (!$collection->count() && $this->request->hasHeader('If-Modified-Since')) {
            throw new HttpException(304);
        }
    }
}
