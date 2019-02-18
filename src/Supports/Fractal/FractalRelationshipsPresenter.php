<?php

namespace SilvaDan\Molezinha\Supports\Fractal;

use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class FractalRelationshipsPresenter
 *
 * @package App\Supports\Fractal
 */
abstract class FractalRelationshipsPresenter extends FractalPresenter
{

  /**
   * @param array $includes
   * @return $this
   */
  public function parseIncludes($includes = array())
  {

    $request = app('Illuminate\Http\Request');
    $paramIncludes = config('repository.fractal.params.include', 'include');

    if ($request->has($paramIncludes)) {
      $includes = array_merge($includes, explode(',', $paramIncludes));
    }

    $this->fractal->parseIncludes($includes);

    return $this;
  }

}
