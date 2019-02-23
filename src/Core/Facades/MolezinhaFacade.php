<?php

namespace Molezinha\Core\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * Class Molezinha
 *
 * Base:https://github.com/ProgramadorDeValor/core/blob/master/Foundation/Facades/Apiato.php
 */
class Molezinha extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return 'molezinha';
  }
}