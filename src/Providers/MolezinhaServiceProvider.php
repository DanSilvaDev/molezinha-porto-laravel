<?php

namespace Molezinha\Providers;

use Illuminate\Support\ServiceProvider;
use Molezinha\Commands\CreateContainerCommand;
use Molezinha\Commands\CreateMigrationCommand;
use Molezinha\Commands\CreateModelCommand;
use Molezinha\Commands\CreateApiRequestCommand;
use Molezinha\Core\Molezinha;

/**
 * Class MolezinhaServiceProvider
 * @package Molezinha\Providers
 *
 * Inspired by : https://github.com/apiato/core/blob/master/Generator/GeneratorsServiceProvider.php
 *
 */
class MolezinhaServiceProvider extends ServiceProvider
{

  public function boot()
  {
      //
  }

  public function register()
  {
    $this->registerMolezinha();
    $this->registerCommands([
        CreateMigrationCommand::class,
        CreateContainerCommand::class,
        CreateModelCommand::class,
        CreateApiRequestCommand::class
    ]);

  }

  /**
   * Register the application bindings.
   *
   * @return void
   */
  private function registerMolezinha()
  {
    $this->app->bind('molezinha', function () {
      return new Molezinha();
    });

    $this->app->alias('molezinha', 'Molezinha\Core\Molezinha');
  }

    /**
     * Register the commandsrising.
     * @param array $classes
     */
    protected function registerCommands(array $classes)
    {
        foreach ($classes as $class)
        {
            $lowerClass = strtolower($class);
            $this->app->singleton("command.molezinha.$lowerClass", function ($app) use ($class)
            {
                return $app[$class];
            });
            $this->commands("command.molezinha.$lowerClass");
        }
    }
}
