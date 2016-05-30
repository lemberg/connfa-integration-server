<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;

class PointTransformer extends TransformerAbstract
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
    public function transform($point)
    {
        $data = [
            'poiId'          => $point->id,
            'poiName'        => $point->name,
            'poiDescription' => $point->description,
            'poiImageURL'    => $point->image,
            'poiDetailURL'   => $point->details_url,
            'order'          => $point->order,
            'deleted'        => $point->deleted_at ? true : false,
        ];

        return $data;
    }
}
