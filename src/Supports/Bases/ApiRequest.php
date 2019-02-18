<?php

namespace SilvaDan\Molezinha\Supports\Bases;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

abstract class ApiRequest extends FormRequest
{
  protected function failedValidation(Validator $validator)
  {
    $x = $validator->errors()->ToJson();
    throw new UnprocessableEntityHttpException($x,null,422);
  }

  protected function failedAuthorization()
  {
    throw new HttpException(403);
  }
}
