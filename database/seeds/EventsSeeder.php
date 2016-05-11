<?php

use App\Models\Event\Level;
use App\Models\Event\Track;
use App\Models\Event\Type;
use App\Models\Speaker;
use App\Repositories\Event\TypeRepository;
use Illuminate\Database\Seeder;

/**
 * @author       Lemberg Solution LAMP Team
 */
class EventsSeeder extends Seeder
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
        $levels = Level::all()->pluck('id')->toArray();
        $types = Type::all()->pluck('id')->toArray();
        $tracks = Track::all()->pluck('id')->toArray();
        $speakers = Speaker::all()->pluck('id')->toArray();


        factory(App\Models\Event::class, 50)->create()->each(function ($event) use (
            $levels,
            $tracks,
            $types,
            $speakers
        ) {
            $event->level_id = array_rand($levels);
            $event->type_id = array_rand($types);
            $event->track_id = array_rand($tracks);
            $event->speakers()->sync($this->faker->randomElements($speakers));
        });
//        $data = [
//
//        ];
//
//        foreach ($data as $item) {
//            $this->repository->create($item);
//        }
    }
}