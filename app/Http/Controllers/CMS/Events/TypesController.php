<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\TypeRequest;
use App\Repositories\ConferenceRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\CMS\BaseController;

/**
 * Class TypesController
 * @package App\Http\Controllers\CMS\Events
 */
class TypesController extends BaseController
{
    /**
     * Overridden the views directory
     */
    protected $viewsFolder = 'events.types';

    /**
     * @var EventRepository
     */
    protected $event;

    /**
     * TypesController constructor.
     *
     * @param TypeRequest $request
     * @param TypeRepository $repository
     * @param ResponseFactory $response
     * @param EventRepository $event
     * @param ConferenceRepository $conferenceRepository
     */
    public function __construct(TypeRequest $request, TypeRepository $repository, ResponseFactory $response, EventRepository $event, ConferenceRepository $conferenceRepository)
    {
        parent::__construct($request, $repository, $response, $conferenceRepository);
        $this->event = $event;
    }

    /**
     * Overridden parent method, added delete image
     *
     * @param  string $conferenceAlias
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($conferenceAlias, $id)
    {
        $this->event->updateByField('type_id', $id);
        $this->repository->delete($id);

        return $this->redirectTo('index', ['conference_alias' => $conferenceAlias]);
    }
}
