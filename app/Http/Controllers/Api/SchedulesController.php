<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Schedule;
use App\Repositories\ScheduleRepository;

class SchedulesController extends ApiController
{
    /**
     * Get schedule
     *
     * @param integer            $code
     * @param ScheduleRepository $repository
     * @return \Dingo\Api\Http\Response
     */
    public function show($code, ScheduleRepository $repository)
    {
        return $this->response->array([]);
    }

    /**
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
}
