<?php

namespace Parser\Console\Commands;

use App\Repositories\SettingsRepository;
use Illuminate\Console\Command;

class ClearDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:clear:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear data from database.';
    /**
     * @var SettingsRepository
     */
    private $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
        parent::__construct();
    }

    public function handle()
    {
        if ($this->settingsRepository->getByKey('last_update')) {
            $this->settingsRepository->getByKey('last_update')->forceDelete();
        }

        if ($this->confirm("Do you want to clear database ?", true)) {
            \DB::table('settings')->where('key', 'last_update')->delete();
            \DB::table('event_tracks')->truncate();
            \DB::table('event_levels')->truncate();
            \DB::table('event_types')->truncate();
            \DB::table('event_speaker')->truncate();
            \DB::table('speakers')->truncate();
            \DB::table('events')->truncate();
        }
    }
}
