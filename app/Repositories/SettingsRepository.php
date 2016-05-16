<?php
namespace App\Repositories;

use vendocrat\Settings\Models\Setting;

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
}
