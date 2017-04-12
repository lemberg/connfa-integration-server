<?php

use Illuminate\Support\Facades\File;

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

/**
 * Get all image from folder
 *
 * @param string $path
 *
 * @return array
 */
$getImagesFromFolder = function ($path = 'uploads/fakers') use(&$getImagesFromFolder)
{
    $images = [];
    $path = public_path($path);
    if(checkAndMakeDirectory($path)){
        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
        $files = File::allFiles($path);
        foreach ($files as $file) {
            $contentType = mime_content_type((string)$file);
            if (in_array($contentType, $allowedMimeTypes)) {
                $images[] = stristr((string)$file, DIRECTORY_SEPARATOR . "uploads");
            }
        }

        if(empty($images) or count($images) < 5){
            uploadImages();

            return $getImagesFromFolder();
        }
    }

    return $images;
};

if (!function_exists('uploadImages')) {
    /**
     * Upload image to folder use faker
     *
     * @param int $countImages
     * @param string $path
     *
     * @return array
     */
    function uploadImages($countImages = 5, $path = 'uploads/fakers')
    {
        $faker = Faker\Factory::create();
        $path = public_path($path);
        $images = [];
        if (checkAndMakeDirectory($path)) {
            for ($i = 0; $i < $countImages; $i++) {
                $images[$i] = $faker->image($path, 200, 200);
            }
        }

        return $images;
    }
}

if (!function_exists('checkAndMakeDirectory')) {
    /**
     * Check directory, if not exist then create it
     *
     * @param $path
     *
     * @return bool
     */
    function checkAndMakeDirectory($path)
    {
        if (!File::exists($path)) {

            return File::makeDirectory($path, 0775, true);
        }

        return true;
    }
}

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Speaker::class, function (Faker\Generator $faker) use ($getImagesFromFolder) {
    $images = $getImagesFromFolder();
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'characteristic' => $faker->text(),
        'job' => $faker->jobTitle,
        'organization' => $faker->company(),
        'twitter_name' => '@' . $faker->userName(),
        'website' => $faker->url(),
        'avatar' => $faker->randomElement($images),
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Event\Type::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->word,
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Event\Track::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Event\Level::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Event::class, function (Faker\Generator $faker) {
    $start_date = $faker->dateTimeBetween('+5 days', '+8 days');
    $end_date = $faker->dateTimeBetween($start_date, strtotime('+8 hours', $start_date->getTimestamp()));

    return [
        'name' => $faker->sentence(3),
        'text' => $faker->text(),
        'start_at' => $start_date,
        'end_at' => $end_date,
        'place' => $faker->address,
        'version' => $faker->optional()->randomNumber(),
        'event_type' => $faker->randomElement(App\Models\Event::$event_types_available),
        'url' => $faker->url,
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Floor::class, function (Faker\Generator $faker) use ($getImagesFromFolder) {
    $images = $getImagesFromFolder();
    return [
        'name' => $faker->word,
        'image' => $faker->randomElement($images),
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Page::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'content' => $faker->text(),
        'alias' => $faker->slug(),
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Location::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'lat' => $faker->latitude(),
        'lon' => $faker->longitude(),
        'address' => $faker->address(),
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Point::class, function (Faker\Generator $faker) use ($getImagesFromFolder) {
    $images = $getImagesFromFolder();
    return [
        'name' => $faker->word,
        'description' => $faker->text(),
        'image' => $faker->randomElement($images),
        'details_url' => $faker->url,
        'order' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Models\Schedule::class, function (Faker\Generator $faker) {
    $repository = App::make(\App\Repositories\ScheduleRepository::class);
    return [
        'code' => $repository->generateCode()
    ];
});
