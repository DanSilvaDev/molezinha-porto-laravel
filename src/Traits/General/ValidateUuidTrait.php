<?php


namespace SilvaDan\Molezinha\Traits\General;


/**
 * Trait ValidateUuidTrait
 * @package App\Traits
 *
 * This trait should be only used with Pretus Repository
 * because of the function model()
 */
trait ValidateUuidTrait
{

  public function isValid($uuid, $returnObject = false)
  {

    $crypto = $this->decrypt($uuid);

    if($crypto === null)
    {
      return false;
    }

    $instance = $this->model();

    $model = $instance::where('uuid', $crypto)->first();
    if ($model == null)
    {
      return false;
    }

    if($returnObject)
    {
      return $model;
    }

    return true;
  }
}