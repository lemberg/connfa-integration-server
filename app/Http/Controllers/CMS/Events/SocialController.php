<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Controllers\CMS\EventsController;

class SocialController extends EventsController
{
    protected $viewsFolder = 'events/social';
    protected $routeName = 'social';
    protected $eventType = 'social';
}
