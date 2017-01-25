<?php

namespace Parser\Console\Commands;

use App\Repositories\SettingsRepository;
use Illuminate\Console\Command;

class InstallCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install crontab jobs';

    public function handle()
    {
        shell_exec('echo "*/30 * * * * php artisan parse:data" | crontab');
    }
}
