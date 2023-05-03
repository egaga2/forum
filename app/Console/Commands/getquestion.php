<?php

namespace App\Console\Commands;

use App\Http\Controllers\CronjobController;
use Illuminate\Console\Command;

class getquestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:question';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command get question';

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
        (new CronjobController())->cronQuestion();
    }
}
