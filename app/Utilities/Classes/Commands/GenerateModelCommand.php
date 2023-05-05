<?php

namespace App\Utilities\Classes\Commands;

use Exception;
use Illuminate\Support\Facades\Schema;

class GenerateModelCommand
{

    private $tableName;
    private $argument;
    private $consoleOutput;
    private $columns;
    private $namespace = 'App\Models\Translation';
    private $stub ;

    public function __construct()
    {

        $this->consoleOutput = new \Symfony\Component\Console\Output\ConsoleOutput();
        $this->stub = file_get_contents(base_path('stubs/translation.model.stub'));
    }

    public function run($argument, $transledColumns): void
    {
        $this->argument = $argument;
        $this->columns = $transledColumns;
        $this->makeModel();
    }

    private function makeModel() : void
    {
        $this->stub = str_replace('{{ namespace }}', $this->namespace , $this->stub);
        $columns = $this->generateTranslateColumns();
        $this->stub = str_replace('{{ class }}', ucfirst($this->argument).'Translation', $this->stub);
        $this->stub = str_replace('{{ fileds }}', $columns, $this->stub);
        file_put_contents($this->generateMigrationFileName(), $this->stub);
        $this->consoleOutput->writeln("<info>Migration Created</info>");
    }

    public function generateTranslateColumns(){
        return "'".implode("','",$this->columns)."'";
    }
    public function generateMigrationFileName(){
        return app_path('Models/Translation/'.ucfirst($this->argument).'Translation.php');
    }
}
