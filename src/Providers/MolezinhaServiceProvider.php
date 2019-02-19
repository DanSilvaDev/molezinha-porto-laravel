<?php

namespace Molezinha\Providers;

use Illuminate\Support\ServiceProvider;
use Molezinha\Core\Molezinha;

class MolezinhaServiceProvider extends ServiceProvider
{

  /**
   * The commands to be registered.
   *
   * @var array
   */
  protected $commands = [
    'CreateContainer' => 'command.molezinha.createcontainer',

  ];


  public function boot()
  {
  }

  public function register()
  {
    $this->registerMolezinha();
    $this->registerCommands();

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
   * Register the given commands.
   *
   * @return void
   */
  protected function registerCommands()
  {
    foreach (array_keys($this->commands) as $command) {
      $method = "register{$command}Command";

      call_user_func_array([$this, $method], []);
    }

    $this->commands(array_values($this->commands));
  }

  /**
   * Get the services provided.
   *
   * @return array
   */
  public function provides()
  {
    return array_values($this->commands);
  }

  protected function registerCreateContainerCommand()
  {
    $this->app->singleton('command.molezinha.createcontainer', function () {
      return new \Molezinha\Commands\CreateContainerCommand();
    });
  }

}