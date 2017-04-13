<?php

namespace App\Transformers;

use App\Models\Schedule;
use League\Fractal\TransformerAbstract;

/**
 * Class ScheduleTransformer
 * @package App\Transformers
 */
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
     * @SWG\Definition(
     *      definition="Schedule",
     *      required={"code", "events"},
     *      @SWG\Property(
     *          property="code",
     *          type="integer",
     *          format="int32",
     *          example=3518,
     *          description="Schedule code"
     *      ),
     *      @SWG\Property(
     *          property="events",
     *          type="array",
     *          description="List of events",
     *          @SWG\Items(
     *              type="integer",
     *              format="int32",
     *              example=54
     *         )
     *      )
     *  )
     *
     *
     * @param Schedule $schedule
     * @return array
     */
    public function transform($schedule)
    {
        return ['code' => $schedule->code, 'events' => $schedule->events()->lists('id')];
    }
}
