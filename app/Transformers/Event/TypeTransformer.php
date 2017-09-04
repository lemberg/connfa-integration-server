<?php

namespace App\Transformers\Event;

use App\Models\Event\Type;
use League\Fractal\TransformerAbstract;

class TypeTransformer extends TransformerAbstract
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
     *      definition="Type",
     *      required={"typeId", "typeName", "typeIconURL", "order", "deleted"},
     *      @SWG\Property(
     *          property="typeId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Type id"
     *      ),
     *      @SWG\Property(
     *          property="typeName",
     *          type="string",
     *          example="Speech",
     *          description="Type name"
     *      ),
     *      @SWG\Property(
     *          property="typeIconURL",
     *          type="string|null",
     *          example="https://www.w3schools.com/css/img_fjords.jpg",
     *          description="Icon url"
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
     *          description="Is type deleted"
     *      )
     *  )
     *
     * @param Type $type
     * @return array
     */
    public function transform(Type $type)
    {
        $data = [
            'typeId'      => $type->id,
            'typeName'    => $type->name,
            'typeIconURL' => $type->icon,
            'order'       => floatval($type->order),
            'deleted'     => $type->deleted_at ? true : false,
        ];

        return $data;
    }
}
