<?php

use Illuminate\Database\Seeder;
use vendocrat\Settings\Facades\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::set('titleMajor', 'Barcelona');
        Setting::set('titleMinor', 'Drupalcon 2015');
        Setting::set('twitterSearchQuery', '#drupalcon');
        Setting::set('timezone', 'Europe/Kiev');
        Setting::save();
    }
}
