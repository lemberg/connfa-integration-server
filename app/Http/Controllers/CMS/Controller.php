<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Conference;
use Illuminate\Support\Facades\View;

/**
 * Class Controller
 * @package App\Http\Controllers\CMS
 */
class Controller extends BaseController
{

    /**
     * @var Conference
     */
    protected $conference;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->conference = \App::make('conference_service')->getModel();
        View::share('conference', $this->conference);
    }
}
