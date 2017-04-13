<?php

namespace App\Transformers\Event;

use App\Models\Event\Level;
use League\Fractal\TransformerAbstract;

class LevelTransformer extends TransformerAbstract
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
     *      definition="Level",
     *      required={"levelId", "levelName", "order", "deleted"},
     *      @SWG\Property(
     *          property="levelId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Level id"
     *      ),
     *      @SWG\Property(
     *          property="levelName",
     *          type="string",
     *          example="Beginner",
     *          description="Level name"
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
     *          description="Is level deleted"
     *      )
     *  )
     *
     *
     * @param Level $level
     * @return array
     */
    public function transform(Level $level)
    {
        $data = [
            'levelId'   => $level->id,
            'levelName' => $level->name,
            'order'     => floatval($level->order),
            'deleted'   => $level->deleted_at ? true : false,
        ];

        return $data;
    }
}
