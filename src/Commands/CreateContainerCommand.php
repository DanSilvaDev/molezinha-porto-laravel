<?php

namespace Molezinha\Commands;

use Illuminate\Console\Command;

class CreateContainerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'molezinha:make:container {name : The Container Name}';

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
      'Traits',
      'Jobs',
      'Data',
      'Data/Seeders',
      'Data/Factories',
      'Data/Criterias',
      'Data/Repositories',
      'Data/Validators',
      'Data/Transporters',
      'Data/Migrations',
      'Data/Validators',
      'Data/Rules',
      'Events',
      'Listeners',
      'Notifications',
      'Providers',
      'Mails',
      'Mails/Templates',
      'Tests',
      'Tests/Unit',
      'Tests/Traits',
      'UI',
      'UI/API/Controllers',
      'UI/API/Presenters',
      'UI/API/Requests',
      'UI/API/Routes',
      'UI/API/Transformers',
      'UI/API/Tests',
      'UI/API/Tests/Functional',
      'UI/CLI',
      'UI/CLI/Commands',
      'UI/CLI/Routes',
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
