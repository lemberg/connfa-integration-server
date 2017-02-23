<?php

namespace App\Transformers\Event;

use App\Repositories\SettingsRepository;
use App\Transformers\EmbeddedTransformer as EmbeddedTransformer;

class SessionTransformer implements EmbeddedTransformer
{
    /**
     * @var SettingsRepository
     */
    protected $settingsRepository;

    /**
     * SessionTransformer constructor.
     * @param SettingsRepository $settingsRepository
     */
    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
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
     * @var  object
     * @return array
     */
    public function transform($event)
    {
        $tz = $this->settingsRepository->getValueByKey('timezone', 'UTC');

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
