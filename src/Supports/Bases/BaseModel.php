<?php

namespace Molezinha\Supports\Bases;


abstract class BaseModel
{
  public function __construct($args = null)
  {
    if  ($args == null) {
      return $this; //Returns the Child not the Parent
    }

    // $var = get_object_vars($this);
    $data = get_object_vars($args);
    foreach ($data as $key => $value)
    {
      if(property_exists($this,$key))
      {
        $this->{$key} = $value;
      }
    }
  }
}