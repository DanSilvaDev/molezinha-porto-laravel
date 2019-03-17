<?php

namespace Molezinha\Supports\Bases;

use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

abstract class BaseRepository extends PrettusBaseRepository
{

  /**
   * @param $relations
   * @return $this
   */
  public function present($relations)
  {
    $this->presenter->parseIncludes($relations);
    return $this;
  }

  public function getInternalId($uuid)
  {
    $class = $this->model();
    $model = $class::where('uuid', $uuid)->first();
    return $model->id;
  }

}
