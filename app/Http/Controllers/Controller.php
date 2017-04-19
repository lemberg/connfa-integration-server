<?php

namespace App\Http\Controllers;

use App\Services\ConferenceService;
use App\Models\Conference;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Is user has role
     *
     * @param string $roleName
     *
     * @return bool
     */
    public function isRole($roleName = 'admin')
    {
        if ($roles = Auth::user()->roles->toArray()) {
            foreach ($roles as $role) {
                if (array_get($role, 'name') == $roleName) {

                    return true;
                }
            }
        }

        return false;
    }
}
