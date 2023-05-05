<?php
namespace App\Utilities\Classes\Commands;

class TranslateCommand {

    private $tableName;
    private $argument;
    private $consoleOutput;
    private $columns;
    private $namespace = '\App\Models\\';

   
    public function __construct()
    {
        $this->consoleOutput = new \Symfony\Component\Console\Output\ConsoleOutput();
    }

    public function run($argument){
        if (empty($argument)){
            $this->consoleOutput->writeln("<error>Argument Not Found !</error>");
            die;
        } 

        $modelFile = app_path('Models/' . ucfirst($argument) . '.php');
        if (!file_exists($modelFile)) {
            $this->consoleOutput->writeln("<error>" . ucfirst($argument) . " Model Not Found !</error>");
        }

        $this->argument = $argument;
        $this->tableName = strtolower($this->argument);
        $this->getTranslatedAttributes();
        $this->makeMigration();
        $this->makeModel();
    }

    private function makeModel(){
        return (new GenerateModelCommand())->run($this->argument,$this->columns);
    }

    private function makeMigration(){
        return (new GenerateMigrationCommand())->run($this->argument,$this->columns);
    }

 

    private function getTranslatedAttributes()
    {
        $modelName = $this->namespace. ucfirst($this->tableName);

        $this->columns =  (new  $modelName())->translatedAttributes;
    }
}