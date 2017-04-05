<?php

namespace App\Transformers;

use App\Models\Schedule;
use League\Fractal\TransformerAbstract;

class ScheduleTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @param Schedule $schedule
     * @return array
     */
    public function transform($schedule)
    {
        return ['code' => $schedule->code, 'events' => $schedule->events()->lists('id')];
    }
}
