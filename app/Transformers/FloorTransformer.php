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
     * @SWG\Definition(
     *      definition="Floor",
     *      required={"floorPlanId", "floorPlanName", "floorPlanImageURL", "order", "deleted"},
     *      @SWG\Property(
     *          property="floorPlanId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Floor plan id"
     *      ),
     *      @SWG\Property(
     *          property="floorPlanName",
     *          type="string",
     *          example="First",
     *          description="Floor plan name"
     *      ),
     *      @SWG\Property(
     *          property="floorPlanImageURL",
     *          type="string",
     *          example="https://www.w3schools.com/css/img_fjords.jpg",
     *          description="Image url"
     *      ),
     *      @SWG\Property(
     *          property="order",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Position for sorting"
     *      ),
     *      @SWG\Property(
     *          property="deleted",
     *          type="boolean",
     *          example=false,
     *          description="Is item deleted"
     *      )
     * )
     *
     * @var  object
     * @return array
     */
    public function transform($floor)
    {
        $data = [
            'floorPlanId'       => $floor->id,
            'floorPlanName'     => $floor->name,
            'floorPlanImageURL' => $floor->image,
            'order'             => floatval($floor->order),
            'deleted'           => $floor->deleted_at ? true : false,
        ];

        return $data;
    }
}
