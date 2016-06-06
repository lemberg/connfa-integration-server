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
        Setting::set('twitterWidget', "<!DOCTYPE html>
<html lang=\"en\">
<head>
<meta charset=\"UTF-8\">
<title>Document</title>
</head>
<body>
<a class=\"twitter-timeline\" href=\"https://twitter.com/hashtag/drupalcon\" data-widget-id=\"545145564770615297\">#drupalcon Tweets</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\"://platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>
</body>
</html>");
        Setting::set('twitterSearchQuery', '#drupalcon');
        Setting::set('timezone', 'Europe/Kiev');
        Setting::save();
    }
}
