<?php

namespace App\Transformers\Event;

use App\Repositories\SettingsRepository;
use App\Services\ConferenceService;
use App\Transformers\EmbeddedTransformer;

class SessionTransformer implements EmbeddedTransformer
{
    /**
     * @var SettingsRepository
     */
    protected $settingsRepository;

    /**
     * @var ConferenceService
     */
    protected $conferenceService;

    /**
     * SessionTransformer constructor.
     * @param SettingsRepository $settingsRepository
     * @param ConferenceService  $conferenceService
     */
    public function __construct(SettingsRepository $settingsRepository, ConferenceService $conferenceService)
    {
        $this->settingsRepository = $settingsRepository;
        $this->conferenceService = $conferenceService;
    }
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
     *      definition="Event",
     *      required={"eventId", "text", "name", "place", "version", "experienceLevel", "type", "from", "to", "speakers", "track", "order", "link", "deleted"},
     *      @SWG\Property(
     *          property="eventId",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Event id"
     *      ),
     *      @SWG\Property(
     *          property="text",
     *          type="string",
     *          example="Architecto ratione sed ipsum. Distinctio quidem nulla ut facilis ea accusamus. Magni fugiat necessitatibus est eaque quae iure amet rerum.",
     *          description="Text"
     *      ),
     *      @SWG\Property(
     *          property="name",
     *          type="string",
     *          example="Maxime quo dicta non asperiores.",
     *          description="Name"
     *      ),
     *      @SWG\Property(
     *          property="place",
     *          type="string",
     *          example="5559 Schinner Springs\nNew Orie, SC 41067-9070",
     *          description="Place address"
     *      ),
     *      @SWG\Property(
     *          property="version",
     *          type="string",
     *          example="858401",
     *          description="Version"
     *      ),
     *      @SWG\Property(
     *          property="experienceLevel",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Experience level"
     *      ),
     *      @SWG\Property(
     *          property="type",
     *          type="integer",
     *          format="int32",
     *          example=4,
     *          description="Type"
     *      ),
     *      @SWG\Property(
     *          property="from",
     *          type="string",
     *          example="2017-04-17T15:16:05+0300",
     *          description="Date from"
     *      ),
     *      @SWG\Property(
     *          property="to",
     *          type="string",
     *          example="2017-04-17T15:59:40+0300",
     *          description="Date to"
     *      ),
     *      @SWG\Property(
     *          property="speakers",
     *          type="array",
     *          description="Array of speakers",
     *          @SWG\Items(
     *              type="integer",
     *              format="int32",
     *              example=27
     *          )
     *      ),
     *      @SWG\Property(
     *          property="track",
     *          type="integer",
     *          format="int32",
     *          example=10,
     *          description="Event track"
     *      ),
     *      @SWG\Property(
     *          property="order",
     *          type="integer",
     *          format="int32",
     *          example=1,
     *          description="Position for sorting"
     *      ),
     *      @SWG\Property(
     *          property="link",
     *          type="string",
     *          example="http://www.keebler.com/non-ducimus-voluptates-quia-quisquam-soluta-quam",
     *          description="Link"
     *      ),
     *      @SWG\Property(
     *          property="deleted",
     *          type="boolean",
     *          example=false,
     *          description="Is track deleted"
     *      )
     * )
     *
     * @param  Event $event
     * @return array
     */
    public function transform($event)
    {
        $tz = $this->settingsRepository->getValueByKey('timezone', $this->conferenceService->getModel()->id, 'UTC');

        $data = [
            'eventId'         => $event->id,
            'text'            => $event->text,
            'name'            => $event->name,
            'place'           => $event->place,
            'version'         => $event->version,
            'experienceLevel' => (int)$event->level_id,
            'type'            => (int)$event->type_id,
            'from'            => $event->getFormattedStartAt($tz),
            'to'              => $event->getFormattedEndAt($tz),
            'speakers'        => $event->speakers ? $event->speakers->pluck('id')->toArray() : [],
            'track'           => $event->track ? $event->track->id : null,
            'order'           => floatval($event->order),
            'link'            => $event->url,
            'deleted'         => $event->deleted_at ? true : false,
        ];

        return $data;
    }
}
