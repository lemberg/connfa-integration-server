<?php

namespace App\Transformers;

use League\Fractal;

class PageTransformer implements EmbeddedTransformer
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
     *      definition="Page",
     *      required={"infoId", "infoTitle", "html", "order", "deleted"},
     *      @SWG\Property(
     *          property="infoId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Info id"
     *      ),
     *      @SWG\Property(
     *          property="infoTitle",
     *          type="string",
     *          example="sapiente",
     *          description="Info title"
     *      ),
     *      @SWG\Property(
     *          property="html",
     *          type="string",
     *          example="Qui ea et nobis adipisci pariatur. Quisquam laborum vitae veniam non. Quas et possimus ea eos vel exercitationem fuga eius.",
     *          description="Content"
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
     * @param  $page
     * @return array
     */
    public function transform($page)
    {
        $data = [
            'infoId'    => $page->id,
            'infoTitle' => $page->name,
            'html'      => $page->content,
            'order'     => floatval($page->order),
            'deleted'   => $page->deleted_at ? true : false,
        ];

        return $data;
    }
}
