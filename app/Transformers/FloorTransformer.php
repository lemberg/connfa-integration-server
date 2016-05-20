<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;

class FloorTransformer extends TransformerAbstract
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
    public function transform($floor)
    {
        $data = [
            'housePlanId'       => $floor->id,
            'housePlanName'     => $floor->name,
            'housePlanImageURL' => $floor->url,
            'order'             => $floor->order,
            'deleted'           => $floor->deleted_at ? 1 : 0,
        ];

        return $data;
    }
}
