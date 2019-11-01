<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\readRssJob;

class getFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getFeeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Llama a un job para que traiga los RSS del día';

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
     * @return mixed
     */
    public function handle()
    {
        $this->comment('INICIO - getFeeds');
        readRssJob::dispatch();
        $this->comment('FIN - getFeeds');
    }
}
