<?php

use App\Repositories\SettingsRepository;
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
        $factory = factory(App\Models\Speaker::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function level($data = [])
    {
        $factory = factory(App\Models\Event\Level::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function track($data = [])
    {
        $factory = factory(App\Models\Event\Track::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function type($data = [])
    {
        $factory = factory(App\Models\Event\Type::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function event($data = [])
    {
        $factory = factory(App\Models\Event::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function page($data = [])
    {
        $factory = factory(App\Models\Page::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function location($data = [])
    {
        $factory = factory(App\Models\Location::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function point($data = [])
    {
        $factory = factory(App\Models\Point::class, 1)->make($data);
        $factory->save();

        return $factory;
    }

    public function floor($data = [])
    {
        $factory = factory(App\Models\Floor::class, 1)->make($data);
        $factory->save();

        return $factory;
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