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
