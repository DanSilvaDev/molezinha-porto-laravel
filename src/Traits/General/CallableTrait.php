<?php


namespace SilvaDan\Molezinha\Traits\General;


use Illuminate\Support\Facades\App;

trait CallableTrait
{

  /**
   * @param $class
   * @param array $runArguments
   * @param array $methods
   * @return mixed
   */
  public function call($class, $runArguments = [], $methods = [])
  {
    $action = App::make($class);

    foreach ($methods as $methodInfo)
    {
      if(is_array($methodInfo))
      {
        $method = key($methodInfo);
        $arguments = $methodInfo[$method];
        if(method_exists($action, $method))
        {
          $action->method(...$arguments);
        }
      }else{
        if (method_exists($action, $methodInfo))
        {
          $action->$methodInfo();
        }
      }
    }
    return $action->run(...$runArguments);
  }



}