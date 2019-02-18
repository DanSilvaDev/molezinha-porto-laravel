<?php

namespace SilvaDan\Molezinha\Commands;

use Illuminate\Console\Command;

class CreateContainer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'container:make {name : The Container Name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Container folders structured';
    protected $paths = [
      'Actions',
      'Models',
      'Tasks',
      'Data',
      'Data/Seeders',
      'Data/Factories',
      'Data/Criteria',
      'Data/Repositories',
      'Data/Validators',
      'Data/Transporters',
      'Data/Migration',
      'Events',
      'Listeners',
      'Tests',
      'Tests/Unit',
      'Tests/Traits',
      'UI',
      'UI/API/Controllers',
      'UI/API/Presenters',
      'UI/API/Repositories',
      'UI/API/Requests',
      'UI/API/Routes',
      'UI/API/Transformers',
    ];

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
      $name = $this->argument('name');
      $root = base_path() . '/app/Containers/'.$name . '/';


      if (! is_dir($root)) {
        mkdir($root, 0755, true);
      }

      foreach ($this->paths as $path)
      {
        $dir = $root.$path;
        if (! is_dir($dir)) {
          mkdir($dir, 0755, true);
        }
      }


      $this->info('Container Created Successfully');

    }
}
