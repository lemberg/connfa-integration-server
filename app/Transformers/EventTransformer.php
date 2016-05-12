<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Transformers;


use App\Transformers\Event\SessionTransformer;
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
     * @var  object
     * @return array
     */
    public function transform($data)
    {
        $result = array();

        $dates = array_values(array_unique(array_pluck($data, 'date')));

        foreach ($dates as $key => $date) {

            $day_events = array_where($data, function ($key, $event) use ($date) {
                return $event['date'] == $date;
            });

            $result['days'][$key]['date'] = $date;
            $result['days'][$key]['events'] = $this->transformEmbedded($day_events, $this->embeddedTransformer);
        }

        return $result;
    }
}