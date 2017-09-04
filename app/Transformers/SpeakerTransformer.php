<?php

namespace App\Transformers;

use App\Models\Speaker;
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
     * @SWG\Definition(
     *      definition="Speaker",
     *      required={"speakerId", "firstName", "lastName", "avatarImageURL", "organizationName", "jobTitle", "characteristic", "twitterName", "webSite", "email", "order", "deleted"},
     *      @SWG\Property(
     *          property="speakerId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Speaker id"
     *      ),
     *      @SWG\Property(
     *          property="firstName",
     *          type="string",
     *          example="Tony",
     *          description="First name"
     *      ),
     *      @SWG\Property(
     *          property="lastName",
     *          type="string",
     *          example="Klein",
     *          description="Last name"
     *      ),
     *      @SWG\Property(
     *          property="avatarImageURL",
     *          type="string",
     *          example="https://www.w3schools.com/css/img_fjords.jpg",
     *          description="Image url"
     *      ),
     *      @SWG\Property(
     *          property="organizationName",
     *          type="string",
     *          example="Berge-Schuppe",
     *          description="Organization name"
     *      ),
     *      @SWG\Property(
     *          property="jobTitle",
     *          type="string",
     *          example="Private Sector Executive",
     *          description="Job title"
     *      ),
     *      @SWG\Property(
     *          property="characteristic",
     *          type="string",
     *          example="Quae quod qui natus aliquid. Id ipsa assumenda illum laudantium cupiditate cupiditate",
     *          description="First name"
     *      ),
     *      @SWG\Property(
     *          property="twitterName",
     *          type="string",
     *          example="@yreilly",
     *          description="Twitter name"
     *      ),
     *      @SWG\Property(
     *          property="webSite",
     *          type="string",
     *          example="https://www.legros.com/et-a-numquam-at-totam-sit-non-ut",
     *          description="Web site"
     *      ),
     *      @SWG\Property(
     *          property="email",
     *          type="string",
     *          example="virginia.thompson@example.org",
     *          description="Email"
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
     *  )
     *
     * @param Speaker $speaker
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
            'order'            => floatval($speaker->order),
            'deleted'          => $speaker->deleted_at ? true : false,
        ];

        return $speakers;
    }
}
