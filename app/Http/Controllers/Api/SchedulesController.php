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
     *  Get schedules
     *
     * @SWG\Get(
     *     path="/getSchedules",
     *     summary="Get all schedules",
     *     tags={"Schedule"},
     *     description="Returns all schedules by codes, since 'If-Modified-Since'",
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
     *     @SWG\Parameter(
     *         name="codes[]",
     *         in="query",
     *         description="Array of codes. Request example: /getSchedules?codes[]=2341&codes[]=8614",
     *         required=true,
     *         type="array",
     *         @SWG\Items(type="integer"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="schedules",
     *                 type="array",
     *                 @SWG\Items(ref="#/definitions/Schedule")
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=302,
     *         description="No updates"
     *     )
     * )
     *
     *
     * @param ScheduleRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function index(ScheduleRepository $repository)
    {
        $codes = $this->request->query('codes', []);
        $schedules = $repository->findByCodes($codes, $this->since);
        $this->checkModified($schedules);

        return $this->response->collection($schedules, new ScheduleTransformer(), ['key' => 'schedules']);
    }

    /**
     * Create schedule
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
     *                      example=15
     *                 )
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation, schedule created",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="code",
     *                 type="integer",
     *                 format="int32",
     *                 example=2431,
     *                 description="Successful operation, schedule created",
     *             )
     *         )
     *     )
     * )
     *
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
     * Update schedule
     *
     * @SWG\Put(
     *     path="/updateSchedule/{code}",
     *     summary="Update schedule",
     *     tags={"Schedule"},
     *     description="Update schedule",
     *     operationId="update",
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         description="Schedule unique code",
     *         in="path",
     *         name="code",
     *         required=true,
     *         type="integer",
     *         format="int32"
     *     ),
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
     *                      example=15
     *                 )
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Successful operation, schedule updated",
     *         @SWG\Schema(
     *              @SWG\Property(
     *                 property="code",
     *                 type="integer",
     *                 format="int32",
     *                 example=2431
     *             )
     *         )
     *     ),
     *     @SWG\Response(
     *          response=404,
     *          description="Schedule not found"
     *     )
     * )
     *
     *
     * @param string $conferenceAlias
     * @param integer $code
     * @param ScheduleRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function update($conferenceAlias, $code, ScheduleRepository $repository)
    {
        $eventIds = $this->request->json('data');
        /** @var Schedule $schedule */
        $schedule = $repository->findOneByCode($code);
        if (!$schedule) {
            throw new NotFoundHttpException('Schedule not found.');
        }
        // Delete events from schedule
        $detachIds = [];
        foreach ($schedule->events as $event) {
            if (!in_array($event->id, $eventIds)) {
                $detachIds[] = $event->id;
            }
        }
        if (count($detachIds)) {
            $schedule->events()->detach($detachIds);
        }
        // Add events to schedule
        $attachIds = [];
        foreach ($eventIds as $id) {
            if (!$schedule->events->contains($id)) {
                $attachIds[] = $id;
            }
        }
        if (count($attachIds)) {
            $schedule->events()->attach($attachIds);
        }

        return $this->response->array(['code' => $schedule->code]);
    }

}
