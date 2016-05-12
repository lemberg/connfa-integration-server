<?php namespace App\Repositories;


use vendocrat\Settings\Models\Setting;

class SettingsRepository extends BaseRepository
{

    public function model()
    {
        return 'vendocrat\Settings\Models\Setting';
    }

    public function getSettingsWithDeleted($since = false)
    {
        $settings = Setting::withTrashed();

        if ($since) {
            $settings->where('updated_at', '>=', $since->toDateTimeString());
        }

        return $settings->get();
    }
}
