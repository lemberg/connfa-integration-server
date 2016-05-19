<?php
namespace App\Repositories;

use vendocrat\Settings\Models\Setting;
use vendocrat\Settings\Facades\Setting as SettingFacade;

class SettingsRepository extends BaseRepository
{

    public function model()
    {
        return Setting::class;
    }

    public function getSettingsWithDeleted($since = false)
    {
        $settings = $this->model->withTrashed();

        if ($since) {
            $settings->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $settings->get();
    }

    public function getByKeyWithDeleted($setting, $since)
    {
        $settings = $this->model->withTrashed()->where('key', $setting);

        if ($since) {
            $settings->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $settings->first();
    }

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
}
