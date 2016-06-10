<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Controllers\CMS\EventsController;

/**
 * Class BofsController
 * @package App\Http\Controllers\CMS\Events
 */
class BofsController extends EventsController
{

    /**
     * Overridden base parameters
     */
    protected $viewsFolder = 'events/bofs';
    protected $routeName = 'bofs';
    protected $eventType = 'bof';
}
