<?php

namespace App\Transformers\Event;

use App\Models\Event\Track;
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
     * @SWG\Definition(
     *      definition="Track",
     *      required={"trackId", "trackName", "order", "deleted"},
     *      @SWG\Property(
     *          property="trackId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Track id"
     *      ),
     *      @SWG\Property(
     *          property="trackName",
     *          type="string",
     *          example="Coding and Development",
     *          description="Track name"
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
     *          description="Is track deleted"
     *      )
     *  )
     *
     * @param  Track $track
     * @return array
     */
    public function transform($track)
    {
        $tracks = [
            'trackId'   => $track->id,
            'trackName' => $track->name,
            'order'     => floatval($track->order),
            'deleted'   => $track->deleted_at ? true : false,
        ];

        return $tracks;
    }
}
