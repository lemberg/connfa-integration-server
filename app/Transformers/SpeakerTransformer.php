<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;

class SpeakerTransformer extends TransformerAbstract
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
    public function transform($speaker)
    {
        $speakers = [
            'speakerId'        => $speaker->id,
            'firstName'        => $speaker->first_name,
            'lastName'         => $speaker->last_name,
            'avatarImageURL'   => $speaker->avatar,
            'organizationName' => $speaker->organization,
            'jobTitle'         => $speaker->job,
            'characteristic'   => $speaker->characteristic,
            'twitterName'      => $speaker->twitter_name,
            'webSite'          => $speaker->website,
            'email'            => $speaker->email,
            'order'            => $speaker->order,
            'deleted'          => $speaker->deleted_at ? true : false,
        ];

        return $speakers;
    }
}
