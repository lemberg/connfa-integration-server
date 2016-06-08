<?php

namespace App\Repositories;

use vendocrat\Settings\Models\Setting;
use vendocrat\Settings\Facades\Setting as SettingFacade;
use \DateTimeZone;

class SettingsRepository extends BaseRepository
{

    public function model()
    {
        return Setting::class;
    }

    /**
     * Get settings with deleted since $since param if passed
     *
     * @param string|bool $since
     *
     * @return mixed
     */
    public function getSettingsWithDeleted($since = false)
    {
        $settings = $this->model->withTrashed();

        if ($since) {
            $settings->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $settings->get();
    }

    /**
     * Get Setting by key since $since param if passed
     *
     * @param $setting
     * @param $since
     *
     * @return mixed
     */
    public function getByKeyWithDeleted($setting, $since)
    {
        $settings = $this->model->withTrashed()->where('key', $setting);

        if ($since) {
            $settings->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $settings->first();
    }

    /**
     * Create twitter objects
     *
     * @param $data
     */
    public function createTwitter($data)
    {
        if (array_get($data, 'twitterSearchQuery')) {
            SettingFacade::set('twitterSearchQuery', array_get($data, 'twitterSearchQuery'));
        }
        if (array_get($data, 'twitterWidget')) {
            SettingFacade::set('twitterWidget', array_get($data, 'twitterWidget'));
        }
        SettingFacade::save();
    }

    /**
     * Save settings
     *
     * @param array $settings
     *
     * @return mixed
     */
    public function saveSettings(array $settings = [])
    {
        if (empty($settings)) {
            return false;
        }

        foreach ($settings as $key => $value) {
            SettingFacade::set($key, $value);
        }

        return SettingFacade::save();
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
     * @return array
     */
    public function getAllSettingInSingleArray()
    {
        $transformSettings = [];
        $settings = $this->model->all()->toArray();
        if (!empty($settings)) {
            foreach ($settings as $setting) {
                $transformSettings[$setting['key']] = $setting['value'];
            }
        }

        return $transformSettings;
    }
}
