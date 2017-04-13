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
     *
     * @SWG\Get(
     *     path="/checkUpdates",
     *     summary="Get entities for update",
     *     tags={"Updates"},
     *     description="Return ids of entities for update: <br> 1 getTypes<br>2 getLevels<br>3 getTracks<br>4 getSpeakers<br>5 getLocations<br>6 getHousePlans<br>7 getSessions<br>8 getBofs<br>9 getSocialEvents<br>10 getPOI<br>11 getInfo<br>12 getSchedules",
     *     operationId="index",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="If-Modified-Since",
     *         in="header",
     *         required=false,
     *         type="string",
     *         description="Date, for example: Tue, 4 Apr 2017 09:50:24 +0000",
     *         default="Tue, 4 Apr 2017 09:50:24 +0000"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                  property="idsForUpdate",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="integer",
     *                      format="int32",
     *                      example=6
     *                  )
     *             )
     *         )
     *     )
     * )
     *
     * @param UpdateRepository $repository
     * @throws HttpException
     * @return \Dingo\Api\Http\Response
     */
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
