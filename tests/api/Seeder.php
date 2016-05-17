<?php

use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\LocationRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\SpeakerRepository;
use Faker\Factory as Faker;

class Seeder
{
    public function __construct(ApiTester $I)
    {
        $this->I = $I;
        $this->faker = Faker::create();
        $this->app = app();
    }

    public function speaker($data = [])
    {
        $data = array_merge([
            'first_name'     => $this->faker->firstName,
            'last_name'      => $this->faker->lastName,
            'characteristic' => $this->faker->text(),
            'job'            => $this->faker->jobTitle(),
            'email'          => $this->faker->safeEmail,
            'organization'   => $this->faker->company,
            'twitter_name'   => '@' . $this->faker->userName,
            'website'        => $this->faker->url(),
            'avatar'         => $this->faker->imageUrl(),
            'order'          => $this->faker->randomFloat(),
        ], $data);

        return $this->make(SpeakerRepository::class)->create($data);
    }

    public function level($data = [])
    {
        $data = array_merge([
            'name'  => $this->faker->word,
            'order' => $this->faker->randomFloat(),
        ], $data);

        return $this->make(LevelRepository::class)->create($data);
    }

    public function track($data = [])
    {
        $data = array_merge([
            'name'  => $this->faker->word,
            'order' => $this->faker->randomFloat(),
        ], $data);

        return $this->make(TrackRepository::class)->create($data);
    }

    public function type($data = [])
    {
        $data = array_merge([
            'name'  => $this->faker->word,
            'icon'  => $this->faker->imageUrl(),
            'order' => $this->faker->randomFloat(),
        ], $data);

        return $this->make(TypeRepository::class)->create($data);
    }

    public function event($data = [])
    {
        $start_date = $this->faker->dateTimeBetween('+5 days', '+8 days');
        $end_date = $this->faker->dateTimeBetween($start_date, strtotime('+8 hours', $start_date->getTimestamp()));

        $data = array_merge([
            'name'       => $this->faker->words(3),
            'text'       => $this->faker->text(),
            'start_at'   => $start_date,
            'end_at'     => $end_date,
            'place'      => $this->faker->address,
            'version'    => $this->faker->optional()->randomNumber(),
            'event_type' => $this->faker->randomElement(App\Models\Event::event_types_available),
            'url'        => $this->faker->url,
        ], $data);

        return $this->make(EventRepository::class)->create($data);
    }

    public function page($data = [])
    {
        $data = array_merge([
            'name'    => $this->faker->word,
            'content' => $this->faker->text(),
            'alias'   => $this->faker->slug(),
            'order'   => $this->faker->randomFloat(),
        ], $data);

        return $this->make(PageRepository::class)->create($data);
    }

    public function location($data = [])
    {
        $data = array_merge([
            'name'    => $this->faker->word,
            'lat'     => $this->faker->latitude(),
            'lon'     => $this->faker->longitude(),
            'address' => $this->faker->address(),
            'order'   => $this->faker->randomFloat(),
        ], $data);

        return $this->make(LocationRepository::class)->create($data);
    }

    public function twitter($data = [])
    {
        $data = array_merge([
            'twitterWidget'      => $this->faker->word,
            'twitterSearchQuery' => '#' . $this->faker->word(),
        ], $data);

        return $this->make(SettingsRepository::class)->createTwitter($data);
    }

    protected function make($class, $attributes = [])
    {
        return $this->app->make($class, $attributes);
    }
}