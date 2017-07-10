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
     * @SWG\Definition(
     *      definition="Point",
     *      required={"poiId", "poiName", "poiDescription", "poiImageURL", "poiDetailURL", "order", "deleted"},
     *      @SWG\Property(
     *          property="poiId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Point id"
     *      ),
     *      @SWG\Property(
     *          property="poiName",
     *          type="string",
     *          example="consequuntur",
     *          description="Poi name"
     *      ),
     *      @SWG\Property(
     *          property="poiDescription",
     *          type="string",
     *          example="Quas commodi at a. Adipisci fugiat beatae consequatur cum impedit. Et quia aut dolores perferendis minima.",
     *          description="Poi description"
     *      ),
     *      @SWG\Property(
     *          property="poiImageURL",
     *          type="string",
     *          example="https://www.w3schools.com/css/img_fjords.jpg",
     *          description="Poi image url"
     *      ),
     *      @SWG\Property(
     *          property="poiDetailURL",
     *          type="string",
     *          example="http://www.oreilly.com/",
     *          description="Poi detail url"
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
     *  )
     *
     * @param  $point
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
            'order'          => floatval($point->order),
            'deleted'        => $point->deleted_at ? true : false,
        ];

        return $data;
    }
}
