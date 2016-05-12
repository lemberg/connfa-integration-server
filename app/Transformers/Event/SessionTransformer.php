<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

namespace App\Transformers\Event;



use App\Transformers\EmbeddedTransformer as EmbeddedTransformer;

class SessionTransformer implements EmbeddedTransformer
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
    public function transform($event)
    {
        $tz = 'America/Chicago'; //@todo Get timezone from settings
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
            'speakers'        => $event->speakers->pluck('id')->toArray(),
            'track'           => $event->track->id,
            'order'           => $event->order,
            'link'            => $event->url,
            'deleted'         => $event->deleted_at ? 1 : 0,
        ];

        return $data;
    }
}