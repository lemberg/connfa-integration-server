<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\TrackRequest;
use App\Repositories\Event\TrackRepository;
use App\Repositories\EventRepository;
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
     * @var EventRepository
     */
    protected $event;

    /**
     * TracksController constructor.
     *
     * @param TrackRequest $request
     * @param TrackRepository $repository
     * @param ResponseFactory $response
     * @param EventRepository $event
     */
    public function __construct(TrackRequest $request, TrackRepository $repository, ResponseFactory $response, EventRepository $event)
    {
        parent::__construct($request, $repository, $response);
        $this->event = $event;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $conferenceAlias
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($conferenceAlias, $id)
    {
        $this->event->updateByField('track_id', $id);
        $this->repository->delete($id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }
}
