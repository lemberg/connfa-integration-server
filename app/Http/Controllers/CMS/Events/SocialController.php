<?php

namespace App\Http\Controllers\CMS\Events;

use App\Http\Controllers\CMS\EventsController;

/**
 * Class SocialController
 * @package App\Http\Controllers\CMS\Events
 */
class SocialController extends EventsController
{
    /**
     * Overridden base parameters
     */
    protected $viewsFolder = 'events/social';
    protected $routeName = 'social';
    protected $eventType = 'social';
}
