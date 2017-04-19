<?php

use App\Models\Event\Level;
use App\Models\Event\Track;
use App\Models\Event\Type;
use App\Models\Speaker;
use App\Models\Conference;
use App\Repositories\Event\TypeRepository;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    private $repository;
    private $faker;

    public function __construct(TypeRepository $repository, Faker\Factory $faker)
    {
        $this->repository = $repository;
        $this->faker = $faker->create();
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $conference = Conference::first();
        $levels = Level::all()->pluck('id')->toArray();
        $types = Type::all()->pluck('id')->toArray();
        $tracks = Track::all()->pluck('id')->toArray();
        $speakers = Speaker::all()->pluck('id')->toArray();


        factory(App\Models\Event::class, 50)->create()->each(function ($event) use (
            $levels,
            $tracks,
            $types,
            $speakers,
            $conference
        ) {
            $event->conference_id = $conference->id;
            $event->level_id = $this->faker->randomElement($levels);
            $event->type_id = $this->faker->randomElement($types);
            $event->track_id = $this->faker->randomElement($tracks);
            $event->speakers()->sync($this->faker->randomElements($speakers));
            $event->save();
        });

    }
}
