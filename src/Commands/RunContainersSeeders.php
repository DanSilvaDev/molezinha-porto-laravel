<?php

namespace Molezinha\Commands;

use Illuminate\Console\Command;
use Molezinha\Loaders\Classes\MolezinhaSeeder;

class RunContainersSeeders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'molezinha:run:seeders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run All Seeders in the Containers';

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
      if(config('app.env') == 'production')
      {
          $this->error('Production Mode. Not Running! Aborting');
          return;
      }
      $seeder = new MolezinhaSeeder();
      $seeder->run();
      $this->info('Seeder Executed');

    }
}
