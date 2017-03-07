<?php

namespace App\Http\Controllers;

use App\Services\ConferenceService;
use App\Models\Conference;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * Get Conference model
     *
     * @return Conference
     */
    public function getConference()
    {
        return \App::make(ConferenceService::class)->getModel();
    }
}
