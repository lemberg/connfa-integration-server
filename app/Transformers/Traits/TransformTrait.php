<?php

namespace App\Transformers;

trait TransformTrait
{

    public function transformEmbedded($data, EmbeddedTransformer $transformer, $asObject = false)
    {
        if (empty($data)) {
            return [];
        }

        $returnData = [];
        if (!$asObject) {
            foreach ($data as $item) {
                $returnData[] = $transformer->transform($item);
            }
        } else if ($asObject) {
            $returnData = $transformer->transform(array_get($data, 0, []));
        }

        return $returnData;
    }

    public function transformEmbeddedJson($data, EmbeddedTransformer $transformer)
    {
        $returnData = array();

        foreach ($data as $item) {
            // $returnData [] = $transformer->transform($item);
            array_push($returnData, $data);

        }
        $returnDataJson = json_encode($returnData);

        return $returnDataJson;
    }
}
