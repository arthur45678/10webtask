<?php

namespace App\Console\Commands\techcrunch;

use Illuminate\Console\Command;
use voku\helper\HtmlDomParser;

class Runner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'techcrunch:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing latest 10 news techcrunch.com';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $parser = new TechcrunchImport();

        $parser->delete();
        $parser->read();
        $parser->write();

        return 0;
    }
}
