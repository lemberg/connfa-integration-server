<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Controllers\CMS\EventsController;

class SessionEventsController extends EventsController
{
    protected $viewsFolder = 'events/sessions';
    protected $routeName = 'sessions';
    protected $eventType = 'session';

}
