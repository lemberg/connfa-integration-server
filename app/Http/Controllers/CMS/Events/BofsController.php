<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Controllers\CMS\EventsController;

class BofsController extends EventsController
{
    protected $viewsFolder = 'events/bofs';
    protected $routeName = 'bofs';
    protected $eventType = 'bof';
}
