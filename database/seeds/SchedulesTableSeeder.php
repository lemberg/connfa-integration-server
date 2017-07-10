<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class SchedulesTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(Faker\Factory $faker)
    {
        $this->faker = $faker->create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventIds = Event::all()->pluck('id')->toArray();

        factory(App\Models\Schedule::class, 5)->create()->each(function ($schedule) use ($eventIds) {
            $schedule->events()->attach($this->faker->randomElements($eventIds, 5));
        });

    }
}
