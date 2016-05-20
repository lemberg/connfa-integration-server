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

        $countChanges = rand(1, $events->count());
        $eventsToChange = array_rand($events->toArray(), $countChanges);
        $changes = ['update', 'delete'];
        $updatedCount = 0;
        $deletedCount = 0;

        foreach ($eventsToChange as $eventKey) {
            $action = $changes[array_rand($changes)];

            if ($action == 'update') {
                $events[$eventKey]->text .= "<br/>Changed";
                $events[$eventKey]->save();
                $updatedCount++;
            }

            if ($action == 'delete') {
                $events[$eventKey]->delete();
                $deletedCount++;
            }
        }

        return $this->info("Events updated successfully: {$updatedCount} events updated, {$deletedCount} events deleted");
    }
}
