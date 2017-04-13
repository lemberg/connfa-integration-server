<?php

namespace App\Transformers;

use App\Models\Location;
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
     * @SWG\Definition(
     *      definition="Location",
     *      required={"locationId", "locationName", "longitude", "latitude", "address", "order", "deleted"},
     *       @SWG\Property(
     *          property="locationId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Location id"
     *      ),
     *      @SWG\Property(
     *          property="locationName",
     *          type="string",
     *          example="qui",
     *          description="Location name"
     *      ),
     *      @SWG\Property(
     *          property="longitude",
     *          type="string",
     *          example="-63.205246",
     *          description="Longitude"
     *      ),
     *      @SWG\Property(
     *          property="latitude",
     *          type="string",
     *          example="-33.699515",
     *          description="Latitude"
     *      ),
     *      @SWG\Property(
     *          property="address",
     *          type="string",
     *          example="3406 Rick Port\nNorth Javon, AK 73663-945",
     *          description="Address"
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
     * @param Location $location
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
