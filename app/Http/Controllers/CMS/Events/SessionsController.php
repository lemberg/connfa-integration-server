<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Controllers\CMS\EventsController;

/**
 * Class SessionsController
 * @package App\Http\Controllers\CMS\Events
 */
class SessionsController extends EventsController
{
    /**
     * Overridden base parameters
     */
    protected $viewsFolder = 'events/sessions';
    protected $routeName = 'sessions';
    protected $eventType = 'session';
}
