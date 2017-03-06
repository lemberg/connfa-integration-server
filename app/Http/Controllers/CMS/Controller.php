<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\View;

/**
 * Class Controller
 * @package App\Http\Controllers\CMS
 */
class Controller extends BaseController
{

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        View::share('conference', $this->getConference());
    }

}
