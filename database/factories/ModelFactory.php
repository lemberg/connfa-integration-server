<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Speaker::class, function (Faker\Generator $faker) {
    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->safeEmail,
        'characteristic' => $faker->sentence(),
        'job'            => $faker->jobTitle,
        'organization'   => $faker->company(),
        'twitter_name'   => '@' . $faker->userName(),
        'website'        => $faker->url(),
        'avatar'         => $faker->imageUrl(),
    ];
});

$factory->define(App\Models\Event::class, function (Faker\Generator $faker) {
    $start_date = $faker->dateTimeBetween('+5 days', '+8 days');
    $end_date = $faker->dateTimeBetween($start_date, strtotime('+8 hours', $start_date->getTimestamp()));

    return [
        'name'       => $faker->words(3),
        'text'       => $faker->text(),
        'start_at'   => $start_date,
        'end_at'     => $end_date,
        'place'      => $faker->address,
        'version'    => $faker->optional()->randomNumber(),
        'event_type' => $faker->randomElement(App\Models\Event::event_types_available),
        'url'        => $faker->url,
    ];
});