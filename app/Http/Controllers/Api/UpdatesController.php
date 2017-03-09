<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Repositories\UpdateRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdatesController extends ApiController
{
    /**
     * Get list of methods updated
     *
     * @param UpdateRepository $repository
     * @throws HttpException
     * @return \Dingo\Api\Http\Response
     */
    public function index(UpdateRepository $repository)
    {
        $changes = $repository->getLastUpdate($this->getConference()->id, $this->since);

        if (empty($changes) && $this->since) {
            throw new HttpException(304);
        }

        return $this->response->array([
            'idsForUpdate' => $changes
        ]);
    }
}
