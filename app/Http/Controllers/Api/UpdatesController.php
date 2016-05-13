<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\UpdateRepository;

class UpdatesController extends ApiController
{
    public function index(UpdateRepository $repository)
    {
        $changes = $repository->getLastUpdate($this->since);
        dd($changes);
    }
}