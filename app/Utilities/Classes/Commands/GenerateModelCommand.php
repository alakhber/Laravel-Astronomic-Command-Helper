<?php

namespace App\Utilities\Classes\Commands;

use Exception;
use Illuminate\Support\Facades\Schema;

class GenerateModelCommand
{

    private $modelSuffix = 'Translation';
    private $mainModel;
    private $mainModelFile;
    private $namespace;
    private $stub;
    private $consoleOutput;
    private $argument;
    private $columns;

    public function __construct()
    {

        $this->consoleOutput = new \Symfony\Component\Console\Output\ConsoleOutput();
        $this->stub = file_get_contents(base_path('stubs/translation.model.stub'));
        $this->namespace = '\App\Models\\';
    }

    public function run($argument) : void
    {
        if (empty($argument)){
            $this->consoleOutput->writeln("<error>Argument Not Found !</error>");
            die;
        } 
        $this->argument = $argument;
        $this->setMainModelAndFile();
        $this->buildMigration();
        
    }

    private function setMainModelAndFile() : void
    {
        $modelFile = app_path('Models/' . ucfirst($this->argument) . '.php');
        if (!file_exists($modelFile)) {
            $this->consoleOutput->writeln("<error>" . ucfirst($this->argument) . " Not Found !</error>");
        }
        $this->mainModel = strtolower($this->argument);
        $this->mainModelFile = $this->argument;
    }

    private function buildMigration() : void
    {
        $this->columns = $this->getTranslatedAttributes();
        dd($this->columns);
        // $this->controlColumnsName();
        // $this->setTableName();
        // $this->makeMigration();
    }

    private function getTranslatedAttributes()
    {
        $modelName = $this->namespace . $this->getMainModel();

        return  (new  $modelName())->translatedAttributes ;
    }

    private function getMainModel(): string
    {
        return ucfirst($this->mainModel);
    }
  
}
