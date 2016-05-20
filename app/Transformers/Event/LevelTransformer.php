<?php

namespace App\Transformers\Event;

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
     * @var  object
     * @return array
     */
    public function transform($level)
    {
        $data = [
            'levelId'   => $level->id,
            'levelName' => $level->name,
            'order'     => $level->order,
            'deleted'   => $level->deleted_at ? 1 : 0,
        ];

        return $data;
    }
}
