<?php

namespace Parser\Drivers;

use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\SpeakerRepository;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Parser\Contracts\ParserContract;

class DrupalcampLondon implements ParserContract
{
    protected $sessions_endpoint = 'getSessions';
    protected $speakers_endpoint = 'getSpeakers';
    protected $tracks_endpoint = 'getTracks';
    protected $levels_endpoint = 'getLevels';
    protected $types_endpoint = 'getTypes';
    /**
     * @var SpeakerRepository
     */
    protected $speakerRepository;
    /**
     * @var LevelRepository
     */
    protected $levelRepository;
    /**
     * @var TrackRepository
     */
    protected $trackRepository;
    /**
     * @var TypeRepository
     */
    protected $typeRepository;
    /**
     * @var EventRepository
     */
    protected $eventRepository;
    /**
     * @var SettingsRepository
     */
    protected $settingsRepository;
    protected $last_updates;

    public function __construct()
    {
        $this->trackRepository = app()->make(TrackRepository::class);
        $this->speakerRepository = app()->make(SpeakerRepository::class);
        $this->levelRepository = app()->make(LevelRepository::class);
        $this->typeRepository = app()->make(TypeRepository::class);
        $this->eventRepository = app()->make(EventRepository::class);
        $this->settingsRepository = app()->make(SettingsRepository::class);
        $last_updated = $this->settingsRepository->getByKey('last_update');
        if ($last_updated) {
            $this->last_updates = $last_updated->value;
        } else {
            $this->last_updates = false;
        }
    }


    public function storeSessions($sessions)
    {
        $days = array_get($sessions, 'days');
        foreach ($days as $day) {
            $events = array_get($day, 'events');

            foreach ($events as $event) {
                date_default_timezone_set('UTC');
                $data = array(
                    'id' => array_get($event, 'eventId'),
                    'text' => array_get($event, 'text', ''),
                    'name' => array_get($event, 'name'),
                    'place' => array_get($event, 'place'),
                    'level_id' => array_get($event, 'experienceLevel'),
                    'type_id' => array_get($event, 'type'),
                    'start_at' => Carbon::parse(array_get($event, 'from')),
                    'end_at' => Carbon::parse(array_get($event, 'to')),
                    'event_type' => 'session',
                    'url' => array_get($event, 'link'),
                    'track_id' => array_get($event, 'track'),
                    'deleted_at' => null,
                );

                $event_obj = $this->eventRepository->findOrNewByIdWithDeleted($data['id']);

                if (array_get($event, 'speakers')) {
                    $event_obj->speakers()->sync([array_get($event, 'speakers')]);
                }

                $event_obj->fill($data);
                $event_obj->save();
            }
        }

        $deleted = array_get($sessions, 'deleted', []);
        foreach ($deleted as $item) {
            $this->eventRepository->delete($item['eventId']);
        }
    }

    public function storeSpeakers($speakers)
    {
        foreach (array_get($speakers, 'speakers') as $item) {
            $speaker = $this->speakerRepository->firstOrCreate([
                'id' => array_get($item, 'speakerId'),
            ]);
            $speaker->first_name = array_get($item, 'first_name');
            $speaker->avatar = array_get($item, 'avatarImageURL');
            $speaker->organization = array_get($item, 'organizationName');
            $speaker->save();
        }
    }

    public function storeLevels($levels)
    {
        foreach (array_get($levels, 'levels') as $item) {
            $level = $this->levelRepository->firstOrCreate([
                'id' => array_get($item, 'levelId'),
            ]);
            $level->name = array_get($item, 'levelName');
            $level->save();
        }
    }

    public function storeTracks($tracks)
    {
        // @todo check when drupalcamp team will fix this
        foreach (array_get($tracks, 'tracks') as $item) {
            $track = $this->trackRepository->firstOrCreate([
                'id' => array_get($item, 'trackID'),
            ]);
            $track->name = array_get($item, 'trackName');
            $track->save();
        }
    }

    public function storeTypes($types)
    {
        foreach (array_get($types, 'types') as $item) {
            $type = $this->typeRepository->firstOrCreate([
                'id' => array_get($item, 'typeID'),
            ]);
            $type->name = array_get($item, 'typeName');
            $type->save();
        }
    }

    public function fetchData($endpoint)
    {
        $basePath = \Config::get('parser.baseUrl');
        $client = new Client();

        try {
            $res = $client->get($basePath . $endpoint, ['since' => $this->last_updates]);
            if ($res->getStatusCode() == 200) {
                $body = $res->getBody();

                return json_decode($body, true);
            }
        } catch (\Exception $e) {

        }

        return false;
    }


    public function parse()
    {
        Model::unguard();

        $tracks = $this->fetchData($this->tracks_endpoint);
        if ($tracks) {
            $this->storeTracks($tracks);
        }

        $speakers = $this->fetchData($this->speakers_endpoint);
        if ($speakers) {
            $this->storeSpeakers($speakers);
        }

        $levels = $this->fetchData($this->levels_endpoint);
        if ($levels) {
            $this->storeLevels($levels);
        }

        $types = $this->fetchData($this->types_endpoint);
        if ($types) {
            $this->storeTypes($types);
        }

        $sessions = $this->fetchData($this->sessions_endpoint);
        if ($sessions) {
            $this->storeSessions($sessions);
        }

        $this->settingsRepository->saveSettings(['last_update' => time()]);
    }
}
