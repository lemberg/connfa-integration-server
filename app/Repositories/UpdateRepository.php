<?php

namespace App\Repositories;

use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;

class UpdateRepository
{

    /**
     * ObjectsMap with resource id, repository and additional params
     * @var array
     */
    protected $objectsMap = array(
        'settings'  => array(
            'id'         => 0,
            'repository' => SettingsRepository::class,
        ),
        'types'     => array(
            'id'         => 1,
            'repository' => TypeRepository::class,
        ),
        'levels'    => array(
            'id'         => 2,
            'repository' => LevelRepository::class,
        ),
        'tracks'    => array(
            'id'         => 3,
            'repository' => TrackRepository::class,
        ),
        'speaker'   => array(
            'id'         => 4,
            'repository' => SpeakerRepository::class,
        ),
        'locations' => array(
            'id'         => 5,
            'repository' => LocationRepository::class,
        ),
        'plans'     => array(
            'id'         => 6,
            'repository' => FloorRepository::class,
        ),
        'sessions'  => array(
            'id'         => 7,
            'repository' => EventRepository::class,
            'params'     => ['event_type' => 'program'],
        ),
        'bofs'      => array(
            'id'         => 8,
            'repository' => EventRepository::class,
            'params'     => ['event_type' => 'bof'],
        ),
        'social'    => array(
            'id'         => 9,
            'repository' => EventRepository::class,
            'params'     => ['event_type' => 'social'],
        ),
        'poi'       => array(
            'id'         => 10,
            'repository' => PointRepository::class,
        ),
        'info'      => array(
            'id'         => 11,
            'repository' => PageRepository::class,
        ),
        'tweets'    => array(
            'id'         => 12,
            'repository' => SettingsRepository::class,
        ),
    );

    /**
     * Get array of updated resources
     *
     * @param $since
     * @param array $params
     * @return array
     */
    public function getLastUpdate($since, $params = [])
    {
        $updates = [];

        foreach ($this->objectsMap as $item) {
            $repository = app($item['repository']);

            $params = array_get($item, 'params', []);

            if ($repository->checkLastUpdate($since, $params)) {
                $updates[] = $item['id'];
            }
        }

        return $updates;
    }
}
