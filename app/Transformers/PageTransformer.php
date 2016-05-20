<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
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
            'order'     => $page->order,
            'deleted'   => $page->deleted_at ? 1 : 0,
        ];

        return $data;
    }
}
