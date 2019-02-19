<?php

namespace Molezinha\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateModelCommand extends GeneratorCommand
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'molezinha:make:model {container : The Container Name} {name : The Model Name} {--pivot}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create the Model Class inside the container specified';

  /**
   * The type of class being generated.
   *
   * @var string
   */
  protected $type = 'Model';


  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {

    if(parent::handle() == false)
      return;

    $this->info("Model " . $this->argument('name') . " Created Successfully");

  }

  /**
   * Get the stub file for the generator.
   *
   * @return string
   */
  protected function getStub()
  {
    if ($this->option('pivot'))
    {
      return __DIR__ . '/stubs/pivot.model.stub';
    }

    return __DIR__ . '/stubs/model.stub';
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return [

      ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],

      ['transformers', 't', InputOption::VALUE_NONE, 'Indicates if should be generated a Transformer for this model'],
    ];
  }

  /**
   * Get the default namespace for the class.
   *
   * @param  string  $rootNamespace
   * @return string
   */
  protected function getDefaultNamespace($rootNamespace)
  {
    return $rootNamespace;
  }


  /**
   * Get the root namespace for the class.
   *
   * @return string
   */
 /* protected function rootNamespace()
  {
    $container = $this->argument('container');
    $dir = 'App/Containers/' . $container . '/Models/';

    $this->info($dir);
    return $dir;
  }*/

  /**
   * Get the desired class name from the input.
   *
   * @return string
   */
  protected function getNameInput()
  {
    $container = trim($this->argument('container'));
    $model = trim($this->argument('name'));
    $dir = 'App\\Containers\\' . $container . '\\Models\\'.$model;
    return $dir;
  }


  /*protected function getPath($name)
  {
    $container = $this->argument('container');
    $dir = base_path() . '/app/Containers/' . $container . '/Models/';

    $this->info($dir);

    return $dir;

  }*/

}