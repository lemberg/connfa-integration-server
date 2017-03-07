<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    /**
     *
     * Check if item belong to conference
     *
     * @param integer $id
     * @throws NotFoundHttpException
     */
    protected function checkConference($id)
    {
        if (!$this->getConference() || $id !== $this->getConference()->id) {
            throw new NotFoundHttpException();
        }
    }

}
