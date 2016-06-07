<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;

class LocationTransformer extends TransformerAbstract
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
    public function transform($location)
    {
        $data = [
            'locationId'   => $location->id,
            'locationName' => $location->name,
            'longitude'    => $location->lon,
            'latitude'     => $location->lat,
            'address'      => $location->address,
            'order'        => floatval($location->order),
            'deleted'      => $location->deleted_at ? true : false,
        ];

        return $data;
    }
}
