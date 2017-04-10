<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Schedule;
use App\Repositories\ScheduleRepository;
use App\Transformers\ScheduleTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SchedulesController extends ApiController
{

    /**
     *
     * @SWG\Get(
     *     path="/getSchedules",
     *     summary="Get all schedules",
     *     tags={"Schedule"},
     *     description="Returns all schedules by codes",
     *     operationId="index",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="codes[]",
     *         in="query",
     *         description="Array of codes",
     *         required=true,
     *         type="array",
     *         @SWG\Items(type="integer"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Schedules response",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="schedules",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Transformers.ScheduleTransformer")
     *             )
     *         )
     *     )
     * )
     *
     * Get schedules
     *
     * @param ScheduleRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(ScheduleRepository $repository)
    {
        $codes = $this->request->query('codes', []);
        $schedules = $repository->findByCodes($codes);

        return $this->response->collection($schedules, new ScheduleTransformer(), ['key' => 'schedules']);
    }

    /**
     *
     *
     * @SWG\Post(
     *     path="/createSchedule",
     *     summary="Create schedule",
     *     tags={"Schedule"},
     *     description="Create schedule",
     *     operationId="create",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Array of events id",
     *         required=true,
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="data",
     *                 type="array",
     *                 @SWG\Items(
     *                      type="integer",
     *                      format="int32",
     *                      example=1212
     *                 )
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Schedules response",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="code",
     *                 type="integer",
     *                 format="int32",
     *                 example=2431
     *             )
     *         )
     *     )
     * )
     *
     * Create schedule
     *
     * @param ScheduleRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function create(ScheduleRepository $repository)
    {
        $eventIds = $this->request->json('data');
        $code = $repository->generateCode();
        /** @var Schedule $schedule */
        $schedule = Schedule::create(['code' => $code]);
        $schedule->events()->attach($eventIds);

        return $this->response->array(['code' => $schedule->code]);
    }

    /**
     * Create schedule
     *
     * @param ScheduleRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function update(ScheduleRepository $repository)
    {

        return $this->response->array(['code' => '']);
    }

}
