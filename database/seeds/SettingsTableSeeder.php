<?php
/**
 * @author       Lemberg Solution LAMP Team
 */

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
        Setting::set('twitterWidget', "<!DOCTYPE html>\n<html lang=\"en\">\n\n<meta charset=\"UTF-8\">\n\n\n\n<a class=\"twitter-timeline\" href=\"https://twitter.com/hashtag/drupalcon\" data-widget-id=\"545145564770615297\">#drupalcon Tweets\n\n\n");
        Setting::set('timezone', 'Europe/Kiev');
        Setting::save();
    }
}