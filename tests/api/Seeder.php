<?php

use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TypeRepository;
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
            'name' => $this->faker->word,
            'order' => $this->faker->randomFloat(),
        ],$data);

        return $this->make(LevelRepository::class)->create($data);
    }

    public function type($data = [])
    {
        $data = array_merge([
            'name' => $this->faker->word,
            'icon' => $this->faker->imageUrl(),
            'order' => $this->faker->randomFloat(),
        ],$data);

        return $this->make(TypeRepository::class)->create($data);
    }

    protected function make($class, $attributes = [])
    {
        return $this->app->make($class, $attributes);
    }
}