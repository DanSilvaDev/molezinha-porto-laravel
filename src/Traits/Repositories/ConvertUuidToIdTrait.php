<?php

namespace Molezinha\Traits\Repositories;

/**
 * Trait ConvertUuidToIdTrait
 * @package App\Traits\Repositories only use this specific trait inside repository class
 */
Trait ConvertUuidToIdTrait
{
  /**
   * @param string $uuid
   * @param bool $getModel if true will return the Eloquent object, otherwise only ID number is returned, default false
   * @return mixed
   */
    public function getInternalId(string  $uuid, bool $getModel=false)
    {
        $model = $this->model()::where('uuid', $uuid)->first();
        if($getModel)
          return $model;

        return $model->id;
    }
}