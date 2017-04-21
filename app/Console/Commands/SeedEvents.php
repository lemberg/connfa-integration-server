<?php

namespace App\Console\Commands;

use App\Models\Conference;
use App\Models\Event;
use App\Repositories\Event\LevelRepository;
use App\Repositories\Event\TrackRepository;
use App\Repositories\Event\TypeRepository;
use App\Repositories\EventRepository;
use App\Repositories\SpeakerRepository;
use Faker\Generator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

class SeedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:seed {--conference_id=0} {--count=50} {--start_date=+5 days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed events database';

    /**
     * @var Generator
     */
    protected $faker;

    /**
     * @var EventRepository
     */
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
        $conferenceId = $this->option('conference_id');
        $count = $this->option('count');
        $startDate = $this->option('start_date');

        $clearEvents = $this->confirm('Do you want to clear existing events before seeding new?
         Note that tables will be truncated so mobile clients will no receive them as deleted', true);

        if ($clearEvents) {
            DB::table('event_speaker')->truncate();
            DB::table('events')->truncate();
        }

        $conference = null;
        if ($conferenceId) {
            $conference = Conference::find($conferenceId);
        } else {
            $conference = Conference::first();
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
            $conference,
            $startDate
        ) {
            $startDate = $this->faker->dateTimeBetween($startDate, strtotime('+3 days', strtotime($startDate)));
            $endDate = $this->faker->dateTimeBetween($startDate, strtotime('+8 hours', $startDate->getTimestamp()));

            $event->conference_id = $conference->id;
            $event->start_at = $startDate->format('Y-m-d H:00:00');
            $event->end_at = $endDate->format('Y-m-d H:00:00');
            $event->level_id = $this->faker->randomElement($levels);
            $event->type_id = $this->faker->randomElement($types);
            $event->track_id = $this->faker->randomElement($tracks);
            $event->speakers()->sync($this->faker->randomElements($speakers));
            $event->save();
        });

        $this->info("{$count} events created");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('count', null, InputOption::VALUE_OPTIONAL, 'count of events to create (50 by default)'),
        );
    }
}
