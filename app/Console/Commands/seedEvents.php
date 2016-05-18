<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\SpeakerRepository;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class seedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:events {--count=50} {--start_date=+5 days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $faker;
    protected $repository;

    /**
     * Create a new command instance.
     *
     * @param Generator $faker
     * @param EventRepository $repository
     */
    public function __construct(Generator $faker, EventRepository $repository)
    {
        parent::__construct();
        $this->faker = $faker;
        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @param LevelRepository $levelRepository
     * @param TypeRepository $typeRepository
     * @param TrackRepository $trackRepository
     * @param SpeakerRepository $speakerRepository
     * @return mixed
     */
    public function handle(
        LevelRepository $levelRepository,
        TypeRepository $typeRepository,
        TrackRepository $trackRepository,
        SpeakerRepository $speakerRepository
    ) {
        $count = $this->option('count');
        $start_date = $this->option('start_date');

        $clear_events = $this->confirm('Do you want to clear existing events before seeding new?
         Note that tables will be truncated so mobile clients will no receive them as deleted', true);

        if ($clear_events) {
            DB::table('event_speaker')->truncate();
            DB::table('events')->truncate();
        }

        $levels = $levelRepository->all()->pluck('id')->toArray();
        $types = $typeRepository->all()->pluck('id')->toArray();
        $tracks = $trackRepository->all()->pluck('id')->toArray();
        $speakers = $speakerRepository->all()->pluck('id')->toArray();


        $events = factory(Event::class)->times($count)->create()->each(function ($event) use (
            $levels,
            $types,
            $tracks,
            $speakers,
            $start_date
        ) {
            $start_date = $this->faker->dateTimeBetween($start_date, strtotime('+3 days', strtotime($start_date)));
            $end_date = $this->faker->dateTimeBetween($start_date, strtotime('+8 hours', $start_date->getTimestamp()));

            $event->start_at = $start_date->format('Y-m-d H:00:00');
            $event->end_at = $end_date->format('Y-m-d H:00:00');
            $event->level_id = $this->faker->randomElement($levels);
            $event->type_id = $this->faker->randomElement($types);
            $event->track_id = $this->faker->randomElement($tracks);
            $event->speakers()->sync($this->faker->randomElements($speakers));
            $event->save();
        });

        $this->info("{$count} events created");
    }


}
