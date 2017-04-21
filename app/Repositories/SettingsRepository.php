<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;
use \DateTimeZone;

class SettingsRepository extends BaseRepository
{
    /**
     * @var EventRepository
     */
    protected $eventRepository;

    /**
     * SettingsRepository constructor.
     *
     * @param App $app
     * @param Collection $collection
     * @param EventRepository $eventRepository
     */
    public function __construct(App $app, Collection $collection, EventRepository $eventRepository)
    {
        parent::__construct($app, $collection);
        $this->eventRepository = $eventRepository;
    }

    public function model()
    {
        return Setting::class;
    }

    /**
     * Get settings with deleted since $since param if passed
     *
     * @param integer     $conferenceId
     * @param string|bool $since
     *
     * @return mixed
     */
    public function getSettingsWithDeleted($conferenceId, $since = false)
    {
        $settings = $this->findByConference($conferenceId)->withTrashed();

        if ($since) {
            $settings->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $settings->get();
    }

    /**
     * Get Setting by key since $since param if passed
     *
     * @param integer $conferenceId
     * @param $setting
     * @param $since
     *
     * @return mixed
     */
    public function getByKeyWithDeleted($conferenceId, $setting, $since = false)
    {
        $settings = $this->findByConference($conferenceId)->withTrashed()->where('key', $setting);

        if ($since) {
            $settings->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $settings->first();
    }

    /**
     * Get setting value by key
     *
     * @param string $setting
     * @param integer $conferenceId
     * @return mixed
     */
    public function getByKey($setting, $conferenceId)
    {
        $settings = $this->findByConference($conferenceId)->where('key', $setting);

        return $settings->first();
    }

    /**
     * Create twitter objects
     *
     * @param array $data
     * @param integer $conferenceId
     */
    public function createTwitter($data, $conferenceId)
    {
        if (array_get($data, 'twitterSearchQuery')) {
            $setting = $this->getByKey('twitterSearchQuery', $conferenceId);
            $setting->value = array_get($data, 'twitterSearchQuery');
            $setting->conference_id = $conferenceId;
            $setting->save();
        }
        if (array_get($data, 'twitterWidget')) {
            $setting = $this->getByKey('twitterWidget', $conferenceId);
            $setting->value = array_get($data, 'twitterWidget');
            $setting->conference_id = $conferenceId;
            $setting->save();
        }
    }

    /**
     * Save settings
     *
     * @param array $settings
     * @param int $conferenceId
     *
     * @return mixed
     */
    public function saveSettings(array $settings = [], $conferenceId)
    {
        if (empty($settings)) {
            return false;
        }

        foreach ($settings as $key => $value) {
            $setting = $this->getByKey($key, $conferenceId);
            if ($key == 'timezone' && $setting && $setting->value != $value) {
                $this->eventRepository->forceUpdateAllEvents();
            }
            if (!$setting) {
                $setting = new Setting();
                $setting->key = $key;
                $setting->value = $value;
                $setting->conference_id = $conferenceId;
            } else {
                $setting->value = $value;
            }
            $setting->save();
        }

        return true;
    }


    /**
     * Get all timezone
     *
     * @return array
     */
    public function getTimezoneList()
    {
        $timezones = DateTimeZone::listIdentifiers();

        return array_combine($timezones, $timezones);
    }

    /**
     * Get settings in single array
     *
     * @param int $conferenceId
     *
     * @return array
     */
    public function getAllSettingInSingleArray($conferenceId)
    {
        $transformSettings = [];
        $settings = $this->findByConference($conferenceId)->get()->toArray();
        if (!empty($settings)) {
            foreach ($settings as $setting) {
                $transformSettings[$setting['key']] = $setting['value'];
            }
        }

        return $transformSettings;
    }

    /**
     * Get value of setting by key or return default vale
     *
     * @param string $key
     * @param integer $conferenceId
     * @param string|null $default
     *
     * @return string
     */
    public function getValueByKey($key, $conferenceId, $default = null)
    {
        $setting = $this->getByKey($key, $conferenceId);

        return $setting ? $setting->value : $default;
    }
}
