<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Transformers\Event;


use League\Fractal\TransformerAbstract;

class TrackTransformer extends TransformerAbstract
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
     * @var  object
     * @return array
     */
    public function transform($track)
    {
        $tracks = [
            'trackId'   => $track->id,
            'trackName' => $track->name,
            'order'     => $track->order,
            'deleted'   => $track->deleted_at ? 1 : 0,
        ];

        return $tracks;
    }
}