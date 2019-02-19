<?php


namespace Molezinha\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter;


class UnprocessableEntityHttpExceptionFormatter extends BaseFormatter
{

  public function format(JsonResponse $response, Exception $e, array $reporterResponses)
  {
    $response->setStatusCode($e->getCode()? $e->getCode() : '422');

    // Laravel validation errors will return JSON string
    $decoded = json_decode($e->getMessage(), true);
    // Message was not valid JSON
    // This occurs when we throw UnprocessableEntityHttpExceptions
    if (json_last_error() !== JSON_ERROR_NONE) {
      // Mimick the structure of Laravel validation errors
      $decoded = [[$e->getMessage()]];
    }
    //dd($decoded);
    $array = [];
    foreach($decoded as $key => $value  )
    {
      $r = [
        //'status' => '422',
        //'code' => $e->getCode(),
        //'title' => 'Validation error',
        'field' => $key,
        'message' => $value[0],
        //'field' => $key,
        //$key => $value[0],
      ];
      array_push($array, $r);
    }

    $data = $array;
    $response->setData([
      'errors' => $data
    ]);

    return $response;
  }


}