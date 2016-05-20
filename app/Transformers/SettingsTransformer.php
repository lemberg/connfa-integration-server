<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class SettingsTransformer extends TransformerAbstract
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
    public function transform($data)
    {
        $result = array();

       foreach ($data as $setting) {
           $result['settings'][$setting->key] = $setting->value;
       }

        return $result;
    }
}