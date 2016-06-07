<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Transformers\Event\BofTransformer;
use App\Transformers\Event\SocialEventTransformer;
use App\Transformers\EventTransformer;
use App\Transformers\Event\SessionTransformer;
use Illuminate\Contracts\Container\Container;

class EventsController extends ApiController
{
    /**
     * @var EventRepository
     */
    protected $repository;

    /**
     * EventsController constructor.
     *
     * @param EventRepository $repository
     * @param Request $request
     * @param Container $app
     */
    public function __construct(EventRepository $repository, Request $request, Container $app)
    {
        parent::__construct($request, $app);
        $this->repository = $repository;
    }

    /**
     * Get list of sessions
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getSessions()
    {
        $events = $this->fetchEventsByType('session');

        $transformer = $this->app->make(EventTransformer::class);
        $transformer->embeddedTransformer = $this->app->make(SessionTransformer::class);

        return $this->response->array($transformer->transform($events));
    }

    /**
     * Get list of bofs
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getBofs()
    {
        $events = $this->fetchEventsByType('bof');

        $transformer = $this->app->make(EventTransformer::class);
        $transformer->embeddedTransformer = $this->app->make(BofTransformer::class);

        return $this->response->array($transformer->transform($events));
    }

    /**
     * Get list of social events
     *
     * @return \Dingo\Api\Http\Response
     */
    public function getSocialEvents()
    {
        $events = $this->fetchEventsByType('social');

        $transformer = $this->app->make(EventTransformer::class);
        $transformer->embeddedTransformer = $this->app->make(SocialEventTransformer::class);

        return $this->response->array($transformer->transform($events));
    }

    /**
     * Fetch events by type
     *
     * @param $type
     * @return mixed
     */
    private function fetchEventsByType($type)
    {
        $events = $this->repository->getEventsByTypeWithDeleted($type, $this->since);
        $this->checkModified($events);

        return $events;
    }
}
