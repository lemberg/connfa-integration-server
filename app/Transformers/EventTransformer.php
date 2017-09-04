<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class EventTransformer extends TransformerAbstract
{
    use TransformTrait;
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
     * Embedded transformer
     */
    public $embeddedTransformer;

    /**
     * Transform object into a generic array
     *
     * @SWG\Definition(
     *      definition="EventList",
     *      required={"date", "events"},
     *      @SWG\Property(
     *          property="date",
     *          type="string",
     *          example="17-04-2017",
     *          description="Date of event"
     *      ),
     *      @SWG\Property(
     *          property="events",
     *          type="array",
     *          @SWG\Items(ref="#/definitions/Event")
     *      )
     * )
     *
     * @param  $data
     * @return array
     */
    public function transform($data)
    {
        $result = array();

        $dates = array_values(array_unique(array_pluck($data, 'date')));

        foreach ($dates as $key => $date) {

            $dayEvents = array_where($data, function ($key, $event) use ($date) {
                return $event['date'] == $date;
            });

            $result['days'][$key]['date'] = $date;
            $result['days'][$key]['events'] = $this->transformEmbedded($dayEvents, $this->embeddedTransformer);
        }

        return $result;
    }
}
