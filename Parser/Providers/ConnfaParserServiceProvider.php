<?php

namespace Parser\Providers;

use Illuminate\Support\ServiceProvider;
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
            ParseCommand::class
        ]);

        $this->mergeConfigFrom(realpath(__DIR__.'/../config/parser.php'), 'parser');
    }
}
