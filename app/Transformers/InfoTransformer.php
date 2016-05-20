<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class InfoTransformer extends TransformerAbstract
{
    use TransformTrait;
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
    public function transform($info)
    {
        $data = [
            'title'    => array_get($info, 'title'),
            'info' => $this->transformEmbedded(array_get($info, 'info'), new PageTransformer()),
        ];

        return $data;
    }
}