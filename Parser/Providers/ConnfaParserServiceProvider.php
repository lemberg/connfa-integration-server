<?php

namespace Parser\Providers;

use Illuminate\Support\ServiceProvider;
use Parser\Console\Commands\ClearDatabaseCommand;
use Parser\Console\Commands\InstallCronCommand;
use Parser\Console\Commands\ParseCommand;

class ConnfaParserServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            ParseCommand::class,
            ClearDatabaseCommand::class,
            InstallCronCommand::class,
        ]);

        $this->mergeConfigFrom(realpath(__DIR__.'/../config/parser.php'), 'parser');
    }
}
