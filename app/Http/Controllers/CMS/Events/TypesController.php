<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Requests\TypeRequest;
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
     */
    public function __construct(TypeRequest $request, TypeRepository $repository, ResponseFactory $response, EventRepository $event)
    {
        parent::__construct($request, $repository, $response);
        $this->event = $event;
    }

    /**
     * Overridden parent method, added delete image
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->event->updateByField('type_id', $id);
        $this->repository->delete($id);

        return $this->redirectTo('index');
    }
}
