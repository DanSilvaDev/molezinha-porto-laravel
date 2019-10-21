<?php

namespace Molezinha\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CreateApiRequestCommand extends GeneratorCommand
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'molezinha:make:apirequest {container : The Container Name} {name : The Model Name}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create the Api Request Class inside the specified container';

  /**
   * The type of class being generated.
   *
   * @var string
   */
  protected $type = 'Request';


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
  public function handle()
  {

    if(parent::handle() == false)
      return;

    $this->info("Request " . $this->argument('name') . " Created Successfully");

  }

  /**
   * Get the stub file for the generator.
   *
   * @return string
   */
  protected function getStub()
  {
    return __DIR__ . '/stubs/request.stub';
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return [];
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
   * Get the desired class name from the input.
   *
   * @return string
   */
  protected function getNameInput()
  {
    $container = trim($this->argument('container'));
    $model = trim($this->argument('name'));
    $dir = 'Containers\\' . $container . '\\UI\\API\\Requests\\'.$model;
    return $dir;
  }

}
