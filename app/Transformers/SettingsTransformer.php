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
     * @SWG\Definition(
     *      definition="Setting",
     *      required={"titleMajor", "titleMinor", "twitterSearchQuery", "timezone"},
     *      @SWG\Property(
     *          property="titleMajor",
     *          type="string",
     *          example="Barcelona"
     *      ),
     *      @SWG\Property(
     *          property="titleMinor",
     *          type="string",
     *          example="Drupalcon 2015"
     *      ),
     *      @SWG\Property(
     *          property="twitterSearchQuery",
     *          type="string",
     *          example="#drupalcon"
     *      ),
     *      @SWG\Property(
     *          property="timezone",
     *          type="string",
     *          example="Europe/Kiev",
     *      )
     * )
     *
     * @param  $data
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