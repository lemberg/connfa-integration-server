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
     * @var  object
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
