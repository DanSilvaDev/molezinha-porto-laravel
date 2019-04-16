<?php

namespace Molezinha\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Mockery\Exception;
use Molezinha\Core\Facades\Molezinha;

class CreateMigrationCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'molezinha:make:migration {container : The Container Name} {name : The Migration File Name}
                          {--create= : The table to be created}
                          {--table= : The table to migrate}';


  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create Migration File inside the Container Specified';

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
    try
    {
      $containerPath = Molezinha::getContainerPathByName($this->argument('container'));
      $savePath = $containerPath . '/Data/Migrations';

      if (!file_exists($containerPath))
      {
        $this->call("molezinha:make:container", ['name' => $this->argument('container')]);
      } else if (!file_exists($savePath))
      {
        File::makeDirectory($savePath,0755, 'true');
      }


      $args =
        [
          'name' => $this->argument('name'),
          '--path' => $savePath,
          '--realpath' => true,
        ];


      if ($this->input->getOption('create'))
        $args['--create'] = $this->input->getOption('create');
      if ($this->input->getOption('table'))
        $args['--table'] = $this->input->getOption('table');

      $this->call("make:migration", $args);
    }
    catch (Exception $e)
    {
      throw $e;
    }

  }

}