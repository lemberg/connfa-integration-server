<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\ApiController;
use App\Repositories\UpdateRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdatesController extends ApiController
{
    public function index(UpdateRepository $repository)
    {
        $changes = $repository->getLastUpdate($this->since);

        if (empty($changes) && $this->since) {
            throw new HttpException(304);
        }

        return $this->response->array([
            'idsForUpdate' => $changes
        ]);
    }
}