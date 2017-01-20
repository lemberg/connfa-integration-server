<?php

namespace Parser\Console\Commands;

use Illuminate\Console\Command;
use Parser\Parser;

class ParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse data.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $parser = new Parser();
        $parser->driver()->parse();
    }
}
