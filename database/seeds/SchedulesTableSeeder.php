<?php

use Illuminate\Database\Seeder;
use App\Repositories\ScheduleRepository;
use App\Models\Event;
use App\Models\Schedule;

class SchedulesTableSeeder extends Seeder
{
    /**
     * @var ScheduleRepository
     */
    private $repository;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    public function __construct(ScheduleRepository $repository, Faker\Factory $faker)
    {
        $this->repository = $repository;
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
        $length = 5;

        for ($i = 0; $i < $length; $i++) {
            $schedule = new Schedule();
            $schedule->code = $this->repository->generateCode();
            $schedule->save();
            $schedule->events()->attach($this->faker->randomElements($eventIds, 5));
        }

    }
}
