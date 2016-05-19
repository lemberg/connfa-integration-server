<?php

namespace App\Console\Commands;

use App\Repositories\EventRepository;
use Illuminate\Console\Command;

class EmulateEventsUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:emulate:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Emulate updating of events';

    /**
     * @var EventRepository
     */
    protected $eventRepository;

    /**
     * Create a new command instance.
     *
     * @param EventRepository $eventRepository
     */
    public function __construct(EventRepository $eventRepository)
    {
        parent::__construct();

        $this->eventRepository = $eventRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = $this->eventRepository->all();

        $count_changes = rand(1, $events->count());
        $events_to_change = array_rand($events->toArray(), $count_changes);
        $changes = ['update', 'delete'];
        $updated_count = 0;
        $deleted_count = 0;

        foreach ($events_to_change as $event_key) {
            $action = $changes[array_rand($changes)];

            if ($action == 'update') {
                $events[$event_key]->text .= "<br/>Changed";
                $events[$event_key]->save();
                $updated_count++;
            }

            if ($action == 'delete') {
                $events[$event_key]->delete();
                $deleted_count++;
            }
        }

        return $this->info("Events updated successfuly: {$updated_count} events updated, {$deleted_count} events deleted");

    }
}
