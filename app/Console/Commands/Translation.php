<?php

namespace App\Console\Commands;

use App\Utilities\Classes\Commands\GenerateMigrationCommand;
use App\Utilities\Classes\Commands\GenerateMigrationCommandClass;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class Translation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:translation {ModelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        (new GenerateMigrationCommand())->run($this->argument('ModelName'));
        
    }
}
